<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;



class SendRequest {
    
    public static function post($url, $apiKey, $data)
    {
         $headers = [
        'X-Api-Key' => $apiKey,
        'Content-Type' => 'application/json',
        ];
        
        $response = Http::withHeaders($headers)->post($url, $data);
        $success = false;
        dd($response);
        if ($response->successful()) {
            $success = true;
        }
        return [
                'success' => $success,
                'data' => $response
            ];
    }
}