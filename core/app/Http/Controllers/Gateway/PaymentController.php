<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\ProcessSendMoney;
use App\Models\AdminNotification;
use App\Models\Agent;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\GeneralSetting;
use App\Models\SendMoney;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Helpers\SendRequest;

class PaymentController extends Controller
{

    public function deposit()
    {
        $pageTitle       = 'Deposit Methods';
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        return view('agent.payment.deposit', compact('gatewayCurrency', 'pageTitle'));
    }

    public function depositInsert(Request $request)
    {
        $request->validate([
            'amount'      => 'required|numeric|gt:0',
            'method_code' => 'required',
            'currency'    => 'required',
        ]);
        
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        $data = new Deposit();
        $trx  = session()->get('payment_trx');

        if (auth()->user()) {
            $sendMoney    = SendMoney::where('trx', $trx)->first();
            $userType     = 'user';

            if (!$sendMoney) {
                $notify[] = ['error', 'Session invalid'];
                return to_route('user.send.money.history')->withNotify($notify);
            }

            if ($sendMoney->status != 0) {
                $notify[] = ['error', 'Payment for this send-money is already completed'];
                return to_route('user.send.money.history')->withNotify($notify);
            }

            $data->user_id       = auth()->user()->id;
            $amount              = $sendMoney->base_currency_amount + $sendMoney->base_currency_charge;
            $data->trx           = $trx;
            $data->send_money_id = $sendMoney->id;
        } else {
            $data->agent_id = authAgent()->id;
            $amount         = $request->amount;
            $data->trx      = getTrx();
            $userType       = 'agent';
        }


        if ($gate->min_amount > $amount || $gate->max_amount < $amount) {
            $notify[] = ['error', 'Please follow the limit'];
            return back()->withNotify($notify);
        }

        $charge                = $gate->fixed_charge + ($amount * $gate->percent_charge / 100);
        $payable               = $amount + $charge;
        $final_amo             = $payable * $gate->rate;

        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount          = $amount;
        $data->charge          = $charge;
        $data->rate            = $gate->rate;
        $data->final_amo       = $final_amo;
        $data->btc_amo         = 0;
        $data->btc_wallet      = "";
        $data->try             = 0;
        $data->status          = 0;
        $data->save();
        
        if($gate->gateway_alias === 'lincgate'){
            $apiKeyArray = json_decode($gate->gateway_parameter);
            $response = SendRequest::post('https://apilgtest.linc.cd/api/transactions',$apiKeyArray->api_key,$data);
            if($response->successful()){
                dd($response);
            }else{
                dd(['error'=>$response]);
            }
        }
        
        session()->forget('payment_trx');
        session()->put('track', $data->trx);
        // return to_route($userType . '.deposit.confirm');
    }

    public function appDepositConfirm($hash)
    {

        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            return "Sorry, invalid URL.";
        }

        $data = Deposit::where('id', $id)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $user = User::findOrFail($data->user_id);

        auth()->login($user);
        session()->put('track', $data->trx);

        if ($data->user_id) {
            return to_route('user.deposit.confirm');
        } else {
            return to_route('agent.deposit.confirm');
        }
    }

    public function depositConfirm()
    {
        $track = session()->get('track');
        $deposit = Deposit::where('trx', $track)->where('status', 0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            if ($deposit->user_id) {
                return to_route('user.deposit.manual.confirm');
            }
            return to_route('agent.deposit.manual.confirm');
        }

        $dirName = $deposit->gateway->alias;
        $new     = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';
        $data    = $new::process($deposit);
        $data    = json_decode($data);
        

        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        if ($deposit->user_id) {
            $pageTitle = 'Confirm Payment';
            return view($this->activeTemplate . 'user.' . $data->view, compact('data', 'pageTitle', 'deposit'));
        }
        $pageTitle = 'Confirm Deposit';
       
        return view('agent.' . $data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($deposit, $isManual = null)
    {
        if ($deposit->status == 0 || $deposit->status == 2) {
            $deposit->status = 1;
            $deposit->save();
            if ($deposit->user_id) {
                $sendMoney = $deposit->sendMoney;
                if (@$sendMoney->status == 0 || @$sendMoney->status == 4) {
                    ProcessSendMoney::updateSendMoney($sendMoney, $sendMoney->user);
                }
                $transaction               = new Transaction();
                $transaction->user_id     = $deposit->user_id;
                $transaction->amount       = $deposit->amount;
                $transaction->post_balance = $deposit->user->balance + $deposit->amount;
                $transaction->charge       = $deposit->charge;
                $transaction->trx_type     = '+';
                $transaction->remark       = 'send_money_in';
                $transaction->details      = 'Money added for payment via' . $deposit->gatewayCurrency()->name;
                $transaction->trx          = $deposit->trx;
                $transaction->save();

                $transaction               = new Transaction();
                $transaction->user_id     = $deposit->user_id;
                $transaction->amount       = $deposit->amount;
                $transaction->post_balance = $deposit->user->balance;
                $transaction->charge       = 0;
                $transaction->trx_type     = '-';
                $transaction->remark       = 'send_money_out';
                $transaction->details      = 'Amount subtracted to pay';
                $transaction->trx          = $deposit->trx;
                $transaction->save();
            } else if ($deposit->agent_id) {
                $agent = Agent::find($deposit->agent_id);
                $agent->balance += $deposit->amount;
                $agent->save();

                $transaction               = new Transaction();
                $transaction->agent_id     = $deposit->agent_id;
                $transaction->amount       = $deposit->amount;
                $transaction->post_balance = $agent->balance;
                $transaction->charge       = $deposit->charge;
                $transaction->trx_type     = '+';
                $transaction->remark       = 'deposits';
                $transaction->details      = 'Deposited via ' . $deposit->gatewayCurrency()->name;
                $transaction->trx          = $deposit->trx;
                $transaction->save();
                if (!$isManual) {
                    $adminNotification            = new AdminNotification();
                    $adminNotification->agent_id  = $agent->id;
                    $adminNotification->title     = 'Deposit succeeded via ' . $deposit->gatewayCurrency()->name;
                    $adminNotification->click_url = urlPath('admin.deposit.successful');
                    $adminNotification->save();
                }
                if ($deposit->agent_id) {
                    notify($agent, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                        'method_name'     => $deposit->gatewayCurrency()->name,
                        'method_currency' => $deposit->method_currency,
                        'method_amount'   => showAmount($deposit->final_amo),
                        'amount'          => showAmount($deposit->amount),
                        'charge'          => showAmount($deposit->charge),
                        'rate'            => showAmount($deposit->rate),
                        'trx'             => $deposit->trx,
                        'post_balance'    => showAmount($agent->balance)
                    ]);
                }
            }
        }
    }

    public function manualDepositConfirm()
    {
        
        $track = session()->get('track');
        $data  = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->orderBy('id', 'desc')->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }

        if ($data->method_code > 999) {
            $method    = $data->gatewayCurrency();
            $gateway   = $method->method;
            $pageTitle = 'Payment Confirm (' . $gateway->name . ')';

            if ($data->user_id) {
                return view($this->activeTemplate . 'user.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
            }

            $pageTitle = 'Deposit via ' . $gateway->name;
            return view('agent.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
        }

        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->orderBy('id', 'desc')->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway         = $gatewayCurrency->method;
        $formData        = $gateway->form->form_data;

        $formProcessor   = new FormProcessor();
        $validationRule  = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData        = $formProcessor->processFormData($request, $formData);

        $data->detail    = $userData;
        $data->status    = 2; // pending
        $data->save();

        $adminNotification = new AdminNotification();

        if ($data->user_id) {
            $user                       = $data->user;
            $adminNotification->user_id = $user->id;
            $sendMoney = @$data->sendMoney;
            $sendMoney->status = 4;
            $sendMoney->save();


            $notify[] = ['success', 'Your payment request has been taken'];
        } else {
            $user                        = $data->agent;
            $adminNotification->agent_id = $user->id;

            $notify[] = ['success', 'Your deposit request has been taken'];
            notify($user, 'DEPOSIT_REQUEST', [
                'method_name'     => $data->gatewayCurrency()->name,
                'method_currency' => $data->method_currency,
                'method_amount'   => showAmount($data->final_amo),
                'amount'          => showAmount($data->amount),
                'charge'          => showAmount($data->charge),
                'rate'            => showAmount($data->rate),
                'trx'             => $data->trx
            ]);
        }

        $adminNotification->title     = 'Deposit request from ' . $data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();
        return to_route(gatewayRedirectUrl())->withNotify($notify);
    }
}
