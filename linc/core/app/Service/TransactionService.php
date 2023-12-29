<?php

namespace App\Service;

class TransactionService
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getTransaction($id)
    {
        $endpoint = 'transactions/' . $id;
        return $this->apiService->read($endpoint);
    }

    public function updateTransaction($id, $data)
    {
        $endpoint = 'transactions/' . $id;
        return $this->apiService->update($endpoint, $data);
    }

    public function deleteTransaction($id)
    {
        $endpoint = 'transactions/' . $id;
        return $this->apiService->delete($endpoint);
    }
    public function getTransactionBySession($data)
    {
        $endpoint = 'transactions/';
        return $this->apiService->create($endpoint, $data, headers: [
            'Content-Type' => 'application/json',
        ]);
    }

    public function createTransaction($apiKey,$sender,$receiver,$amount,$currencySendCode,$currencyReceiveCode)
    {
        $wordWithoutAccents = iconv('UTF-8', 'ASCII//TRANSLIT', $receiver['fistname']);
        $data= [
                  "lg_operation" => "process",
                  "client_reference_id"=> "Linc_2",
                  "currency_infos"=> [
                    "expedition_code"=> $currencySendCode,
                    "destination_code"=> $currencyReceiveCode
                  ],
                  "financial_actor_expedition"=> [
                    "firstName"=> 'Test',
                    "lastName"=> 'Linc',
                    "email"=> "test@lincgate.cd",
                    "country"=> "CD",
                    "city"=> "CD-KN",
                    "countryCode"=> 243,
                    "address1"=> "Kinshasa, 15 Kasai, Lemba-livulu",
                    "address2"=> "",
                    "locality"=> "Lemba",
                  ],
                  "financial_actor_destination"=> [
                    "firstName"=> $receiver['fistname'],
                    "lastName"=> $receiver['lastname'],
                    "email"=> strtolower($wordWithoutAccents)."@lincgate.cd",
                    "country"=> "CD",
                    "city"=> "CD-KN",
                    "countryCode"=> 243,
                    "address1"=> $receiver['address'],
                    "address2"=> "",
                    "locality"=> "Lemba",
                  ],
                  "amount"=> number_format($amount, 2, ',', '.'),
                  "callback_success"=> "https://linc.cd/user/send-money/history",
                  "callback_failed"=> "https://linc.cd/user/send-money/history",
                  "callback_cancel"=> "https://linc.cd/user/send-money/history",
                ];
                // dd($data);
                
        $endpoint = 'transactions';

        try {
            $response = $this->apiService->create($endpoint, $data, headers: [
                'Content-Type' => 'application/json',
                'X-Api-Key' => $apiKey
            ]);
            return $response;
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message'=> 'Une erreur s\'est produite ' . $th
                ];
        }
    }
}
