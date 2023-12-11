<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\ProcessSendMoney;
use App\Models\Country;
use App\Models\GatewayCurrency;
use App\Models\SendingPurpose;
use App\Models\SendMoney;
use App\Models\SourceOfFund;
use Illuminate\Http\Request;

class UserSendMoneyController extends Controller
{
    /*
     * Return Send Money View Page
     */
    public function sendMoney()
    {
        $pageTitle        = 'Send Money';
        $countries        = Country::active()->get();
        $sources          = SourceOfFund::active()->get();
        $purposes         = SendingPurpose::active()->get();

        $sessionData      = session()->get('send_money') ?? [];
        $recipientCountry = null;

        if ($sessionData) {
            $sendingCountry   = $countries->where('id', $sessionData['sending_country'])->first()->id;
            $recipientCountry = $countries->where('id', $sessionData['recipient_country'])->first()->id;
        } else {
            $ipInfo           = json_decode(json_encode(getIpInfo()), true);
            $countryName      = @implode(',', $ipInfo['country']);
            $sendingCountry   = $countries->where('name', $countryName)->first()->id ?? $countries->first()->id;
        }

        if (!$recipientCountry) {
            $recipientCountry = $countries->where('id', '!=', $sendingCountry)->first()->id;
        }

        $sendingAmount      = @$sessionData['sending_amount'];
        $recipientAmount    = @$sessionData['recipient_amount'];
        $countries_world = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        session()->forget('send_money');
        return view($this->activeTemplate . 'user.send_money.form', compact('pageTitle','countries_world', 'countries', 'sources', 'purposes', 'sendingAmount', 'recipientAmount', 'sendingCountry', 'recipientCountry'));
    }

    /*
     * Initially save the send-money data
     */
    public function save(Request $request)
    {
        $request->validate(
            [
                'sending_amount'    => 'required|numeric|gt:0',
                'sending_country'   => 'required|gt:0',
                'recipient_country' => 'required|gt:0',
                'payment_type'      => 'required|in:1,2',
                'source_of_funds'   => 'required|gt:0',
                'sending_purpose'   => 'required|gt:0',
                'recipient'         => 'required|array|min:3',
                //'recipient.*'       => 'required|string',
            ],
            [
                'recipient.name.required'    => 'Recipient name field is required',
                'recipient.address.required' => 'Recipient address field is required',
            ]
        );

        if (!$request->receiving_mode) {
            return redirect()->back()->withErrors(['receiving_mode.required' => 'Receiving mode is required'])->withInput();
        }

        switch ($request->receiving_mode) {
            case 'mode__mobile':
                if (!$request->recipient['mobile']) {
                    return redirect()->back()->withErrors(['recipient.mobile.required' => 'Recipient mobile number field is required'])->withInput();
                }
                break;

            case 'mode__card':
                if (!$request->recipient['card']) {
                    return redirect()->back()->withErrors(['recipient.card.required' => 'Recipient card number field is required'])->withInput();
                }
                break;

            case 'mode__atm':
                if (!$request->recipient['mobile_atm']) {
                    return redirect()->back()->withErrors(['recipient.mobile_atm.required' => 'Recipient mobile number field is required'])->withInput();
                }
                break;

            default:
                # code...
                break;
        }


        $user                = auth()->user();
        $payment             = new ProcessSendMoney();
        $payment->user       = $user;
        $payment->columnName = 'user_id';

        $sendMoney           = $payment->createSendMoney($request);


        if ($request->payment_type == 1) {

            if ($payment->amountWithCharge > $user->balance) {
                $notify[] = ['error', 'Insufficient Balance.'];
            } else {
                $notify[] = ['success', 'Send money request submitted successfully'];
                $payment->createTransaction();
                ProcessSendMoney::updateSendMoney($sendMoney, $user);
            }
            return to_route('user.send.money.history')->withNotify($notify);
        }
        session()->put('payment_trx', $sendMoney->trx);
        return to_route('user.send.money.pay.now');
    }

    /*
     * Redirect to payment page
     */
    public function payNow()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();

        $pageTitle = 'Pay Money';
        $trx       = session()->get('payment_trx');
        $sendMoney = SendMoney::filterUser()->where('trx', $trx)->first();
        if (!$sendMoney) {
            $notify[] = ['error', 'Session invalidate'];
            return to_route('user.home')->withNotify($notify);
        }

        return view($this->activeTemplate . 'user.payment.payment', compact('gatewayCurrency', 'pageTitle', 'sendMoney'));
    }

    /*
     * Redirect to payment page to pay for previously initialized send-money
     */
    public function pay(Request $request)
    {
        $sendMoney = SendMoney::filterUser()->initiated()->findOrFail(decrypt($request->id));
        session()->put('payment_trx', $sendMoney->trx);
        return to_route('user.send.money.pay.now');
    }

    /*
     * Transfer History
     */
    public function history()
    {
        $pageTitle    = 'Send Money History';
        $emptyMessage = 'No transfers found';
        $transfers    = SendMoney::filterUser()->latest()->paginate(getPaginate());

        return view($this->activeTemplate . 'user.send_money.history', compact('pageTitle', 'emptyMessage', 'transfers'));
    }
}
