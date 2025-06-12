<?php

function convertCurrency($amount, $base = 'USD')
{
    $session = session();
    $target = strtolower($session->get('currency') ?? 'USD');
    $base = strtolower($base);

    if ($target === $base) return number_format($amount, 2) . " " . strtoupper($target);

    $cacheKey = "rate_{$base}_{$target}";
    $rate = cache($cacheKey);

    if (!$rate) {
        $url = "https://www.floatrates.com/daily/{$base}.json";

        $response = @file_get_contents($url); 
        if (!$response) {
            return number_format($amount, 2) . " " . strtoupper($target);
        }

        $data = json_decode($response, true);
        $rate = $data[$target]['rate'] ?? 1;

        cache()->save($cacheKey, $rate, 3600);
    }

    return number_format($amount * $rate, 2) . " " . strtoupper($target);
}
