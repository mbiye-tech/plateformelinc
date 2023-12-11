<?php

namespace App\Http\Controllers\Gateway\lincgate;

use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;

class ProcessController extends Controller
{
    /*
     * flutterwave Gateway
     */

    public static function process($deposit)
    {
        if ($deposit->user_id) {
            $user = auth()->user();
        } else {
            $user = authAgent();
        }

        $flutterAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $send['Api_Key'] = $flutterAcc->api_key;
        $send['customer_email'] = $user->email;
        $send['amount'] = round($deposit->final_amo, 2);
        $send['customer_phone'] = $user->mobile;
        $send['currency'] = $deposit->method_currency;
        $send['txref'] = $deposit->trx;
        $send['notify_url'] = url('ipn/lincgate');



        $alias = $deposit->gateway->alias;
        $send['view'] = 'payment.' . $alias;
        return json_encode($send);
    }

    public function ipn($track, $type)
    {

        $deposit = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        if ($type == 'error') {
            $message = 'Transaction failed, Ref: ' . $track;
            $notify[] = ['error', $message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }

        if (!isset($track)) {

            $message = 'Unable to process';
            $notify[] = ['error', $message];
            $notifyApi[] = $message;

            
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        
        $deposit->sendMoney->status = 1;
        $deposit->sendMoney->save();
        PaymentController::userDataUpdate($deposit);
        $message = 'Transaction was successful, Ref: ' . $track;
        $notify[] = ['success', $message];
        return to_route(gatewayRedirectUrl(true))->withNotify($notify);
    }
}
