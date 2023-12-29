<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\SendMoney;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class PayoutController extends Controller
{

    public function payoutHistory()
    {
        $pageTitle    = 'Payout History';
        $emptyMessage = 'No transfers found';
        $agent        = authAgent();
        $transfers    = SendMoney::payout()->where('payout_by', $agent->id)->searchable(['trx'])->latest()->paginate(getPaginate());
        return view('agent.payout.history', compact('pageTitle', 'emptyMessage', 'transfers'));
    }


    public function payout()
    {
        $pageTitle = 'Payout Money';
        return view('agent.payout.payout_money', compact('pageTitle'));
    }


    public function payoutInfo(Request $request)
    {
        $request->validate([
            'trx' => 'required|string'
        ]);

        $sendMoney = SendMoney::where('trx', $request->trx)->whereIn('status', [1, 2])->orderBy('id', 'DESC')->first();

        $checkAbility = $this->checkSendAbility($sendMoney);

        if (!$checkAbility['status']) {
            $notify[] = ['error', $checkAbility['message']];
            return to_route('agent.payout')->withNotify($notify);
        }

        $pageTitle  = 'Confirm Payout';
        $general    = GeneralSetting::first();
        $commission = $general->fixed_commission + $general->percent_commission * $sendMoney->base_currency_amount / 100;
        return view('agent.payout.payout_info', compact('pageTitle', 'sendMoney', 'commission'));
    }

    public function payoutConfirm(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $sendMoney    = SendMoney::where('id', $id)->whereIn('status', [1, 2])->orderBy('id', 'DESC')->first();
        $checkAbility = $this->checkSendAbility($sendMoney);

        if (!$checkAbility['status']) {
            $notify[] = ['error', $checkAbility['message']];
            return to_route('agent.payout')->withNotify($notify);
        }

        if ($sendMoney->verification_code != $request->code) {
            $notify[] = ['error', 'Verification code doesn\'t matched'];
            return back()->withNotify($notify);
        }

        $general                = GeneralSetting::first();
        $agent                  = authAgent();
        $trx                    = $sendMoney->trx;
        $amount                 = $sendMoney->base_currency_amount;

        $sendMoney->received_at = Carbon::now();
        $sendMoney->status      = 2;
        $sendMoney->payout_by   = $agent->id;
        $sendMoney->save();

        $agent->balance = $agent->balance + $amount;
        $agent->save();


        $transaction               = new Transaction();
        $transaction->agent_id     = $agent->id;
        $transaction->amount       = $sendMoney->base_currency_amount;
        $transaction->post_balance = $agent->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Payout completed';
        $transaction->trx          = $trx;
        $transaction->remark       = 'payout_completed';
        $transaction->remark       = 'Payout';
        $transaction->save();

        $commission = $general->fixed_commission + $general->percent_commission * $amount / 100;

        if ($commission) {

            $agent->balance = $agent->balance + $commission;
            $agent->save();

            $transaction               = new Transaction();
            $transaction->agent_id     = $agent->id;
            $transaction->amount       = $commission;
            $transaction->post_balance = $agent->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Payout commission received';
            $transaction->trx          = $sendMoney->trx;
            $transaction->remark       = 'payout_commission';
            $transaction->save();
        }

        if ($sendMoney->user_id) {
            $user = $sendMoney->user;
        } else {
            $user = $sendMoney->agent;
        }

        notify($user, 'SEND_MONEY_RECEIVED', [
            'recipient_country'  => $sendMoney->recipient_country,
            'recipient_amount'   => showAmount($sendMoney->recipient_amount),
            'recipient_currency' => $sendMoney->recipient_currency,
            'trx'                => $sendMoney->trx,
        ]);

        $notify[] = ['success', 'Payout completed successfully'];
        return to_route('agent.payout.history')->withNotify($notify);
    }

    public function payoutVerificationCode()
    {
        $sendMoney    = SendMoney::where('id', request()->id)->first();
        $general      = GeneralSetting::first();
        $duration     = $general->resent_code_duration;
        $codeSentTime = Carbon::now()->diffInSeconds($sendMoney->verification_time);

        if (!$sendMoney) {
            $response['status']  = 'error';
            $response['message'] = 'Transaction not found';
        } elseif ($sendMoney->status != 1) {
            $response['status']  = 'error';
            $response['message'] = 'Unauthorized access.';
        } elseif ($codeSentTime < $duration) {
            $response['status']  = 'error';
            $response['message'] = 'Please try after ' . ($duration - $codeSentTime) . ' seconds';
        } else {
            $code                         = verificationCode(6);
            $sendMoney->verification_code = $code;
            $sendMoney->verification_time = Carbon::now();
            $sendMoney->save();

            $mobile          = @$sendMoney->recipient->mobile;
            $guest           = new stdClass();
            $guest->username = 'Recipient';
            $guest->fullname = @$sendMoney->recipient->name;
            $guest->mobile   = $mobile;

            notify($guest, 'DEFAULT', [
                'message' => 'Your ' . $general->sitename . ' payout verification is ' . $code,
            ], ['sms']);

            $response['status']  = 'success';
            $response['message'] = 'A 6 digit verification code sent to +' . showMobileNumber($mobile);
        }
        return $response;
    }


    private function checkSendAbility($sendMoney)
    {
        if (!$sendMoney) {
            return [
                'status' => false,
                'message' => 'Invalid transaction number'
            ];
        }

        if ($sendMoney->agent_id == authAgent()->id) {
            return [
                'status' => false,
                'message' => 'Sender cannot payout money'
            ];
        }

        if ($sendMoney->status == 2) {
            return [
                'status' => false,
                'message' => 'Payout already completed'
            ];
        }

        return ['status' => true];
    }
}
