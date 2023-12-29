<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;
use App\Service\ApiService;
use App\Service\TransactionService;



class SendRequest {
    
    public static function post($apiKey, $data, $sendMoney)
    {
        $recipient = json_decode(json_encode($sendMoney->recipient), true);
        $sender = json_decode(json_encode($sendMoney->sender), true);
         $senderReq =[];
         $recipientReq = [];
        if(isset($recipient['name']) && isset($recipient['address'])){
            $senderReq = [
                'fistname' => "Sender",
                'lastname' => 'User Test',
                'address' => 'Linc SARL Kinshasa/RDC',
                ];
            $recipientReq = [
                'fistname' => $recipient['name'],
                'lastname' => 'User Test',
                'address' => $recipient['address'],
            ];
            $amount = $data->final_amo;
            $service = new TransactionService(new ApiService());
            if($sendMoney['sending_currency'] == 'USD'){
                $currencySendCode = 840;
            }elseif($sendMoney['sending_currency'] == 'EUR')
                $currencySendCode = 978;
            else{
                $currencySendCode = 976;
            }
            
            if($sendMoney['recipient_currency'] == 'USD'){
                $currencyReceiveCode = 840;
            }elseif($sendMoney['recipient_currency'] == 'EUR')
                $currencyReceiveCode = 978;
            else{
                $currencyReceiveCode = 976;
            }
            
            $response = $service->createTransaction(
                $apiKey,
                $senderReq,
                $recipientReq,
                $amount,
                $currencySendCode,
                $currencyReceiveCode
            );
            
            return $response;
            
        }else{
            return [
                'message'=> 'Please, completed the informations of sender and recipient',
                'success' => false,
                ];
        }

    }
}