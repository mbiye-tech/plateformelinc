<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

// ...

class ApiService
{
    protected $baseUrl = 'https://api.lingate.cd/api/';

    public function create($endpoint, $data, $headers = [])
    {
        $url = $this->baseUrl . $endpoint;

        $response = Http::withHeaders($headers)->post($url, $data);
        return $response->json();
    }

    public function read($endpoint, $headers = [])
    {
        $url = $this->baseUrl . $endpoint;

        $response = Http::withHeaders($headers)->get($url);

        return $response->json();
    }

    public function update($endpoint, $data, $headers = [])
    {
        $url = $this->baseUrl . $endpoint;

        $response = Http::withHeaders($headers)->put($url, $data);

        return $response->json();
    }

    public function delete($endpoint, $headers = [])
    {
        $url = $this->baseUrl . $endpoint;

        $response = Http::withHeaders($headers)->delete($url);

        return $response->json();
    }

    // ...
}
