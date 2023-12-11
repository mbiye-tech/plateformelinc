<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SendMoney;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    protected $pageTitle;

    protected function filterSendMoney($scope)
    {
        $this->pageTitle    = ucfirst($scope) . ' Money Transfers';
        $query = SendMoney::latest()->whereNotIn('status', [0]);
        if ($scope != 'all') {
            $query = $query->$scope();
        }
        $search = request()->search;
        if ($search) {
            $this->pageTitle .= ' - ' . $search;
            $query = $query->where(function ($q) use ($search) {
                $q->where('trx', 'like', '%' . $search . '%')
                    ->orWhere('sender', 'like', '%' . $search . '%')
                    ->orWhere('recipient', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('username', 'like', "%$search%");
                    })->orWhereHas('agent', function ($agent) use ($search) {
                        $agent->where('username', 'like', "%$search%");
                    });
            });
        }

        $sendMoneys = $query->with(['user', 'agent'])->paginate(getPaginate());
        return $sendMoneys;
    }
    public function index()
    {
        $segments     = request()->segments();
        $sendMoneys   = $this->filterSendMoney(end($segments));
        $pageTitle    = $this->pageTitle;
        return view('admin.send_money.list', compact('pageTitle', 'sendMoneys'));
    }
    public function details($id = null)
    {
        $sendMoney = SendMoney::with(['user', 'agent', 'payoutBy'])->findOrFail($id);
        $pageTitle = 'Send money to ' . $sendMoney->recipient_country . ' from ' . $sendMoney->sending_country;
        return view('admin.send_money.detail', compact('pageTitle', 'sendMoney'));
    }
    public function refundMoney(Request $request, $id = null)
    {
        $request->validate(
            [
                'message' => 'required'
            ],
            [
                'message.required' => 'Please write feedback'
            ]
        );
        $sendMoney                 = SendMoney::where('status', 1)->findOrFail($id);
        $sendMoney->status         = 3;
        $sendMoney->admin_feedback = $request->message;
        $sendMoney->save();

        $transaction = new Transaction();
        if ($sendMoney->user_id) {
            $user                 = $sendMoney->user;
            $transaction->user_id = $sendMoney->user_id;
        } else {
            $user                  = $sendMoney->agent;
            $transaction->agent_id = $sendMoney->agent_id;
        }
        $user->balance += $sendMoney->base_currency_amount;
        $user->save();
        $transaction->amount       = $sendMoney->base_currency_amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Refunded sent money. Message: ' . $request->message;
        $transaction->trx          = $sendMoney->trx;
        $transaction->save();
        notify($user, 'SEND_MONEY_REFUND', [
            'trx'                => $sendMoney->trx,
            'sending_country'    => $sendMoney->sending_country,
            'sending_amount'     => showAmount($sendMoney->sending_amount),
            'sending_currency'   => $sendMoney->sending_currency,
            'recipient__country' => $sendMoney->recipient_country,
            'recipient_amount'   => showAmount($sendMoney->recipient_amount),
            'recipient_currency' => $sendMoney->recipient_currency,
            'message'            => $request->message,
        ]);
        $notify[] = ['success', 'This send money is refunded successfully'];
        return back()->withNotify($notify);
    }
}
