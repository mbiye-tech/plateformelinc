<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Lib\ProcessSendMoney;
use App\Models\Country;
use App\Models\SendingPurpose;
use App\Models\SendMoney;
use App\Models\SourceOfFund;
use Exception;
use Illuminate\Http\Request;

class AgentSendMoneyController extends Controller
{
    public function transferHistory()
    {
        $pageTitle = 'Send Money History';
        $transfers = SendMoney::filterAgent()->whereNotIn('status', [0])->searchable(['trx'])->latest()->paginate(getPaginate());
        return view('agent.send.transfer_history', compact('pageTitle', 'transfers'));
    }

    public function sendMoney()
    {
        $pageTitle        = 'Send Money';
        $countries        = Country::active()->get();
        $sources          = SourceOfFund::active()->get();
        $purposes         = SendingPurpose::active()->get();
        $sendingCountry   = $countries->first()->id;
        $recipientCountry = $countries->where('id', '!=', $sendingCountry)->first()->id;
        return view('agent.send.send_money', compact('pageTitle', 'countries', 'sources', 'purposes', 'sendingCountry', 'recipientCountry'));
    }

    public function sendMoneyInsert(Request $request)
    {
        $this->validation($request);

        $agent               = authAgent();
        $payment             = new ProcessSendMoney();
        $payment->user       = $agent;
        $payment->columnName = 'agent_id';

        if ($payment->amountWithCharge > $agent->balance) {
            $notify[] = ['error', 'Insufficient Balance.'];
            return to_route('agent.transfer.history')->withNotify($notify);
        }

        $sendMoney = $payment->createSendMoney($request);
        $payment->createTransaction();
        ProcessSendMoney::updateSendMoney($sendMoney, $agent);

        $notify[] = ['success', 'Send money request sent successfully'];
        return to_route('agent.transfer.history')->withNotify($notify);
    }

    public function validation($request)
    {
        $request->validate(
            [
                'sending_country'   => 'required|gt:0',
                'sending_amount'    => 'required|numeric|min:0',
                'recipient_country' => 'required|gt:0',
                'source_of_funds'   => 'required|gt:0',
                'sending_purpose'   => 'required|gt:0',
                'recipient'         => 'required|array|min:3',
                'recipient.name'    => 'required',
                'recipient.mobile'  => 'required',
                'recipient.address' => 'required',
                'sender'            => 'required|array|min:3',
                'sender.name'       => 'required',
                'sender.mobile'     => 'required',
                'sender.address'    => 'required',
            ],
            [
                'recipient.name.required'    => 'Please enter recipient name',
                'recipient.mobile.required'  => 'Please enter recipient mobile number',
                'recipient.address.required' => 'Please enter recipient address',
                'sender.name.required'       => 'Please enter sender name',
                'sender.mobile.required'     => 'Please enter sender mobile number',
                'sender.address.required'    => 'Please enter sender address',
            ]
        );
    }
}
