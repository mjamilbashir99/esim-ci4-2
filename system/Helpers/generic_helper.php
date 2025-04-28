<?php

if (!function_exists('fetch_hotelbeds_hotels')) {
    function fetch_hotelbeds_hotels($hotelCodes = [])
    {
        $apiKey = getenv('HOTELBEDS_API_KEY');
        $secret = getenv('HOTELBEDS_SECRET');
        $timestamp = time();
        $signature = hash('sha256', $apiKey . $secret . $timestamp);

        $version = "1.0";
        $baseUrl = "https://api.test.hotelbeds.com/hotel-content-api/$version/hotels";

        $queryString = '';
        if (!empty($hotelCodes)) {
            $codesParam = implode(',', $hotelCodes);
            $queryString = '?codes=' . urlencode($codesParam);
        }

        $url = $baseUrl . $queryString;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
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



    if (!function_exists('calculateProfitPrice')) {
        function calculateProfitPrice($netPrice)
        {
            $profitMultiplier = 1;
            return round($netPrice * $profitMultiplier, 2);
        }
    }






   
}
