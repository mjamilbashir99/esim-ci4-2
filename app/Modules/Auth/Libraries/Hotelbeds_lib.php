<?php

namespace Modules\Auth\Libraries;

use Modules\Auth\Config\Config as AuthConfig;

class Hotelbeds_lib
{
    protected AuthConfig $config;

    public function __construct()
    {
        $this->config = new AuthConfig();
    }

    public function checkStatus(): array
    {
        $apiKey = $this->config->hotelbedsApiKey;
        $secret = $this->config->hotelbedsSecret;
        $timestamp = time();
        $signature = hash('sha256', $apiKey . $secret . $timestamp);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->config->hotelbedsStatusUrl,
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
