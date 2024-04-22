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




}
