<?php

namespace App\Lib;

use App\Models\AdminNotification;
use App\Models\Country;
use App\Models\SendingPurpose;
use App\Models\SendMoney;
use App\Models\SourceOfFund;
use App\Models\Transaction;

class ProcessSendMoney
{

    public $user;
    public $columnName;
    public $sendingAmount;
    public $sendingCountry;
    public $recipientCountry;
    public $sourceOfFunds;
    public $sendingPurpose;

    public $sendingAmountInBaseCurrency;
    public $chargeInBaseCurrency;

    public $chargeInSendingCurrency;
    public $receivableAmount;

    public $amountWithCharge;

    public $trx;
    public $sendMoneyId;

    public function __construct()
    {
        $request                = request();
        $this->sendingCountry   = Country::findOrFail($request->sending_country);
        $this->recipientCountry = Country::findOrFail($request->recipient_country);
        $this->sourceOfFunds    = SourceOfFund::findOrFail($request->source_of_funds);
        $this->sendingPurpose   = SendingPurpose::findOrFail($request->sending_purpose);
        $this->sendingAmount    = $request->sending_amount;
        $this->trx = getTrx();
        $this->setAmountVariables();
    }


    public function createSendMoney($request)
    {

        $sendMoney = new SendMoney();
        $column    = $this->columnName;
        $sender    = $request->sender;
        $recipient = $request->recipient;

        $sendMoney->$column          = $this->user->id;
        $sender['mobile']    = $this->sendingCountry->dial_code . @$request['sender']['mobile'];
        $recipient['mobile'] = $this->recipientCountry->dial_code . @$request['recipient']['mobile'];

        $sendMoney->base_currency_amount = $this->sendingAmountInBaseCurrency;
        $sendMoney->base_currency_charge = $this->chargeInBaseCurrency;

        $sendMoney->sending_country    = $this->sendingCountry->name;
        $sendMoney->sending_currency   = $this->sendingCountry->currency;
        $sendMoney->sending_amount     = $this->sendingAmount;
        $sendMoney->sending_charge     = $this->chargeInSendingCurrency;
        $sendMoney->recipient_country  = $this->recipientCountry->name;
        $sendMoney->recipient_currency = $this->recipientCountry->currency;
        $sendMoney->recipient_amount   = $this->receivableAmount;
        $sendMoney->source_of_fund     = $this->sourceOfFunds->name;
        $sendMoney->sending_purpose    = $this->sendingPurpose->name;
        $sendMoney->trx                = $this->trx;
        $sendMoney->sender             = $sender;
        $sendMoney->recipient          = $recipient;
        $sendMoney->save();

        $this->sendMoneyId = $sendMoney->id;
        return $sendMoney;
    }

    public function setAmountVariables()
    {
        $conversionRate              = $this->recipientCountry->rate / $this->sendingCountry->rate;
        $receivableAmount            = $conversionRate * $this->sendingAmount;  //In Recipient's currency
        $percentCharge               = $receivableAmount * $this->recipientCountry->percent_charge / 100;
        $chargeInRecipientCurrency   = $this->recipientCountry->fixed_charge + $percentCharge;
        $chargeInSendingCurrency     = $chargeInRecipientCurrency / $conversionRate;

        $this->chargeInBaseCurrency        = $chargeInSendingCurrency / $this->sendingCountry->rate;
        $this->sendingAmountInBaseCurrency = $this->sendingAmount / $this->sendingCountry->rate;
        $this->chargeInSendingCurrency     = $chargeInSendingCurrency;
        $this->receivableAmount            = $receivableAmount;
        $this->amountWithCharge            = $this->sendingAmountInBaseCurrency + $this->chargeInBaseCurrency;
    }


    public static function updateSendMoney($sendMoney, $user)
    {
        $sendMoney->status = 1;
        $sendMoney->save();
        notify($user, 'SEND_MONEY_COMPLETE', [
            'trx'                => $sendMoney->trx,
            'sending_country'    => $sendMoney->sending_country,
            'sending_amount'     => showAmount($sendMoney->sending_amount),
            'sending_currency'   => $sendMoney->sending_currency,
            'recipient__country' => $sendMoney->recipient_country,
            'recipient_amount'   => showAmount($sendMoney->recipient_amount),
            'recipient_currency' => $sendMoney->recipient_currency,
        ]);
    }

    public function createTransaction()
    {
        $this->user->balance -= $this->amountWithCharge;
        $this->user->save();

        $adminNotification            = new AdminNotification();
        $user                         = $this->user;
        $column                       = $this->columnName;
        $adminNotification->$column   = $user->id;

        $adminNotification->title     = 'Send money to ' . $this->recipientCountry->name;
        $adminNotification->click_url = urlPath('admin.send.money.details', $this->sendMoneyId);
        $adminNotification->save();

        $transaction                  = new Transaction();
        $transaction->agent_id        = $this->user->id;
        $transaction->amount          = $this->amountWithCharge;
        $transaction->post_balance    = $this->user->balance;
        $transaction->charge          = 0;
        $transaction->trx_type        = '-';
        $transaction->details         = 'Send money to ' . $this->recipientCountry->name;;
        $transaction->remark          = 'send_money_payment';
        $transaction->trx             = $this->trx;
        $transaction->save();
    }
}
