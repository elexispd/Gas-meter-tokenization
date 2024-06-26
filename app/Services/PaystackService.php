<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Purchase;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    public function initiatePayment($amount, $email, $metadata)
    {
        $response = Http::post('https://api.paystack.co/transaction/initialize', [
            'amount' => $amount * 100, // Convert amount to kobo
            'email' => $email,
            'metadata' => $metadata,
        ]);

        return $response->json();
    }

    // public function verifyPayment($reference,)
    // {
    //     $response = Http::get("https://api.paystack.co/transaction/verify/{$reference}");

    //     return $response->json();
    // }

    public function verifyPayment($reference)
    {
        // Get the Paystack API key from your environment configuration
        $paystackApiKey = env('PAYSTACK_SK_API_KEY');

        // Include the authorization header with the Paystack API key
        $headers = [
            'Authorization' => 'Bearer ' . $paystackApiKey,
        ];

        // Make the request to verify the payment with the provided reference
        $response = Http::withHeaders($headers)->get("https://api.paystack.co/transaction/verify/{$reference}");

        // Return the response as JSON
        return $response->json();
    }

    public function handlePaymentResponse($response, $order_id)
    {
        // Update the database based on payment status
        if ($response['status'] === true) {
            $purchase = Purchase::where('order_id', $order_id)->first();
            $purchase->status = 'completed';
            $purchase->save();

            // Log payment success or perform other actions
            // ...
        } else {
            // Handle failed payment scenario
            // ...
        }
    }

    public function getOrderDetails_($orderId)
    {
        try {
            $response = Http::get('https://api.paystack.co/transaction/verify/' . $orderId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('PAYSTACK_SK_API_KEY'),
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            if ($body['status'] === true) {
                return $body['data'];
            } else {
                Log::error('Paystack API Error: ' . $body['message']);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Paystack API Exception: ' . $e->getMessage());
            return null;
        }
    }


    public function  getOrderDetails($reference)
    {
        // Get the Paystack API key from your environment configuration
        $paystackApiKey = env('PAYSTACK_SK_API_KEY');

        // Include the authorization header with the Paystack API key
        $headers = [
            'Authorization' => 'Bearer ' . $paystackApiKey,
        ];

        // Make the request to verify the payment with the provided reference
        $response = Http::withHeaders($headers)->get("https://api.paystack.co/transaction/verify/{$reference}");

        // Return the response as JSON
        return $response->json();
    }



}

