<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Purchase;

class TokenApiService
{
    public function generateToken($payload)
    {
        $response = Http::post('http://47.90.189.157:5003/api/POS_Purchase', $payload);

        return $response->json();
    }

    public function send_sms($phone, $message) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post('https://www.bulksmsnigeria.com/api/v2/sms', [
            'body' => $message,
            'from' => 'Entak Ltd.',
            'to' => $phone,
            'api_token' => env("SMS_API_KEY"),
            'gateway' => 'direct-refund',
            'callback_url' => 'https://www.airtimenigeria.com/api/reports/sms'
        ]);
    }




}
