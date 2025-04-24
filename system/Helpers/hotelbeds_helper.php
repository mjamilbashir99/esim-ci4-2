<?php

if (!function_exists('check_hotelbeds_status')) {
    function check_hotelbeds_status()
    {
        $apiKey = getenv('HOTELBEDS_API_KEY');
        $secret = getenv('HOTELBEDS_SECRET');
        $timestamp = time();
        $signature = hash('sha256', $apiKey . $secret . $timestamp);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.test.hotelbeds.com/hotel-api/1.0/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Api-key: $apiKey",
                "X-Signature: $signature"
            ]
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return ['error' => $error];
        }

        return ['status_code' => $httpCode, 'response' => json_decode($response, true)];
    }
}
