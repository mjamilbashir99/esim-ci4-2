<?php

namespace App\Controllers;

class PaymentController extends BaseController
{
    public function process()
    {
        $email = $this->request->getPost('email');
        $bundleId = $this->request->getPost('bundleId');

        // Simulate payment success — here you'll later add Stripe
        $paymentSuccess = true;

        if ($paymentSuccess) {
            // Call eSIM Go API to make purchase
            $client = \Config\Services::curlrequest();
            $apiKey = getenv('ESIM_API_KEY');

            try {
                $response = $client->post('https://api.esim-go.com/v2.3/purchases', [
                    'headers' => [
                        'X-API-Key' => $apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'bundleId' => $bundleId,
                        'email' => $email
                    ]
                ]);

                $result = json_decode($response->getBody(), true);

                return view('purchase_success', ['result' => $result]);

            } catch (\Exception $e) {
                return view('purchase_failed', ['error' => $e->getMessage()]);
            }
        } else {
            return view('purchase_failed', ['error' => 'Payment failed.']);
        }
    }
}
