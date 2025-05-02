<?php

namespace App\Controllers\Home;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CityModel;
use App\Libraries\Template;

class HomeController extends BaseController
{
    protected $template;
    public function __construct()
    {
        $this->template = new Template();
    }


    public function index()
    {
        //
    }

    public function getCitySuggestions()
    {
        $term = $this->request->getGet('term');

        if (!$term || strlen($term) < 2) {
            return $this->response->setJSON([]);
        }

        $cityModel = new \App\Models\CityModel();
        $results = $cityModel->getCitySuggestions($term);

        return $this->response->setJSON($results);
    }


// old working perfect now down i am trying to communicate with json files to play with data 
//    public function searchHotels()
//     {
//         helper('generic_helper');
//         $session = session();

//         $destination = $this->request->getPost('destination');
//         $checkInRaw = $this->request->getPost('checkin');
//         $checkOutRaw = $this->request->getPost('checkout');
//         $rooms = (int) $this->request->getPost('rooms');
//         $passenger = $this->request->getPost('passenger');

//         $adults = (int) $this->request->getPost('adults');
//         $children = (int) $this->request->getPost('children');
        
        
//         $infants = (int) $this->request->getPost('infants');
//         // var_dump($infants);die();

//         $checkIn = date('Y-m-d', strtotime($checkInRaw));
//         $checkOut = date('Y-m-d', strtotime($checkOutRaw));


//         $cityModel = new \App\Models\CityModel();
//         $city = $cityModel->where('name', $destination)->first();

//         if (!$city) {
//             return $this->response->setJSON([
//                 'error' => 'City not found'
//             ]);
//         }

//         $latitude = (float)$city['latitude'];
//         $longitude = (float)$city['longitude'];

//         $payload = [
//             "stay" => [
//                 "checkIn" => $checkIn,
//                 "checkOut" => $checkOut
//             ],
//             "occupancies" => [
//                 [
//                     "rooms" => $rooms,
//                     "adults" => $adults,
//                     "children" => 0,
//                     // "infants" => $infants,
//                 ]
//             ],
//             "geolocation" => [
//                 "latitude" => $latitude,
//                 "longitude" => $longitude,
//                 "radius" => 20,
//                 "unit" => "km"
//             ]
//         ];

//         // log_message('debug', 'Hotel Search Payload: ' . json_encode($payload));

//         $apiKey = getenv('HOTELBEDS_API_KEY');
//         $secret = getenv('HOTELBEDS_SECRET');

//         $timestamp = time();
//         $signature = hash('sha256', $apiKey . $secret . $timestamp);
//         // dd($signature);die();

//         $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/hotels';
//         $client = \Config\Services::curlrequest();
//         try {
//             $response = $client->post($url, [
//                 'headers' => [
//                     'Api-Key' => $apiKey,
//                     'X-Signature' => $signature,
//                     'Accept' => 'application/json',
//                     'Content-Type' => 'application/json'
//                 ],
//                 'body' => json_encode($payload)
//             ]);
        
//             $responseBody = json_decode($response->getBody(), true);

//             file_put_contents(WRITEPATH . 'hotelbeds_search_response.json', json_encode($responseBody, JSON_PRETTY_PRINT));
        
//             log_message('debug', 'Hotel Search Response: ' . json_encode($responseBody));

//             $maxPrice = 0;
//             if (isset($responseBody['hotels']) && !empty($responseBody['hotels'])) {
//                 foreach ($responseBody['hotels'] as $hotel) {
//                     $rate = isset($hotel['rooms'][0]['rates'][0]['net']) ? $hotel['rooms'][0]['rates'][0]['net'] : 0;
//                     $sellingPrice = calculateProfitPrice($rate); // Calculate with 10% markup
//                     $maxPrice = max($maxPrice, $sellingPrice);
//                 }
//             }
        
//             // savr to session
//             $session->set('hotel_search_results', $responseBody);
//              $session->set('maxPrice', $maxPrice);
             
        
//             return $this->response->setJSON([
//                 'success' => true
//             ]);
        
//         } catch (\Exception $e) {
//             log_message('error', 'Hotel Search Error: ' . $e->getMessage());
//             // return $this->response->setJSON([
//             //     'success' => false,
//             //     'error' => $e->getMessage()
//             // ]);
//             return $this->response->setJSON([
//                 'success' => false,
//                 'error' => $e->getMessage() ?: 'Something went wrong'
//             ]);
//         }
    
//     }





    public function searchHotels()
    {
        helper('generic_helper');
        $session = session();

        $destination = $this->request->getPost('destination');
        $checkInRaw = $this->request->getPost('checkin');
        $checkOutRaw = $this->request->getPost('checkout');
        $rooms = (int) $this->request->getPost('rooms');
        $passenger = $this->request->getPost('passenger');

        $adults = (int) $this->request->getPost('adults');
        $children = (int) $this->request->getPost('children');
        
        
        $infants = (int) $this->request->getPost('infants');
        // var_dump($infants);die();

        $checkIn = date('Y-m-d', strtotime($checkInRaw));
        $checkOut = date('Y-m-d', strtotime($checkOutRaw));


        $cityModel = new \App\Models\CityModel();
        $city = $cityModel->where('name', $destination)->first();

        if (!$city) {
            return $this->response->setJSON([
                'error' => 'City not found'
            ]);
        }

        $latitude = (float)$city['latitude'];
        $longitude = (float)$city['longitude'];

        $payload = [
            "stay" => [
                "checkIn" => $checkIn,
                "checkOut" => $checkOut
            ],
            "occupancies" => [
                [
                    "rooms" => $rooms,
                    "adults" => $adults,
                    "children" => 0,
                    // "infants" => $infants,
                ]
            ],
            "geolocation" => [
                "latitude" => $latitude,
                "longitude" => $longitude,
                "radius" => 20,
                "unit" => "km"
            ]
        ];

        // log_message('debug', 'Hotel Search Payload: ' . json_encode($payload));

        $apiKey = getenv('HOTELBEDS_API_KEY');
        $secret = getenv('HOTELBEDS_SECRET');

        $timestamp = time();
        $signature = hash('sha256', $apiKey . $secret . $timestamp);
        // dd($signature);die();

        $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/hotels';
        $client = \Config\Services::curlrequest();
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Api-Key' => $apiKey,
                    'X-Signature' => $signature,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($payload)
            ]);
        
            // remove nichy wala to get real data and uncomment this
            // $responseBody = json_decode($response->getBody(), true);

            $filePath = WRITEPATH . 'cache/hotel_472781_details.json';

            if (file_exists($filePath)) {
                $jsonData = file_get_contents($filePath);
                $responseBody = json_decode($jsonData, true);
                // var_dump($responseBody);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'error' => 'Hotel details file not found.'
                ]);
            }

            // var_dump($responseBody);
            file_put_contents(WRITEPATH . 'hotelbeds_search_response.json', json_encode($responseBody, JSON_PRETTY_PRINT));
        
            log_message('debug', 'Hotel Search Response: ' . json_encode($responseBody));

            $maxPrice = 0;
            if (isset($responseBody['hotels']) && !empty($responseBody['hotels'])) {
                foreach ($responseBody['hotels'] as $hotel) {
                    $rate = isset($hotel['rooms'][0]['rates'][0]['net']) ? $hotel['rooms'][0]['rates'][0]['net'] : 0;
                    $sellingPrice = calculateProfitPrice($rate); // Calculate with 10% markup
                    $maxPrice = max($maxPrice, $sellingPrice);
                }
            }
        
            // savr to session
            // var_dump($session->set('hotel_search_results', $responseBody));die();
            $session->set('hotel_search_results', $responseBody);

// Check what's stored
// var_dump($session->get('hotel_search_results'));die();

             $session->set('maxPrice', $maxPrice);
             
        
            return $this->response->setJSON([
                'success' => true
            ]);
        
        } catch (\Exception $e) {
            log_message('error', 'Hotel Search Error: ' . $e->getMessage());
            // return $this->response->setJSON([
            //     'success' => false,
            //     'error' => $e->getMessage()
            // ]);
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage() ?: 'Something went wrong'
            ]);
        }
    
    }


    public function searchResult()
    {
        $session = session();
        $results = $session->get('hotel_search_results');
    
        // if (!$results) {
        //     return redirect()->to('/');
        // }
    
        
        if (isset($results['hotels'])) {
            $hotels = $results['hotels']; 
        } else {
            $hotels = [];
        }
    
        return $this->template->render('Home/search_result', ['hotels' => $hotels]);
    }







    public function fetchHotelData()
    {
        $client = \Config\Services::curlrequest();

        $apiKey = getenv('HOTELBEDS_API_KEY');
        $secret = getenv('HOTELBEDS_SECRET');
        $timestamp = time();
        $signature = hash('sha256', $apiKey . $secret . $timestamp);

        $url = 'https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/681970/details';

        $headers = [
            'Accept'       => 'application/json',
            'Api-Key'      => $apiKey,
            'X-Signature'  => $signature
        ];

        try {
            $response = $client->get($url, ['headers' => $headers]);
            $body = $response->getBody();

            $filePath = WRITEPATH . 'cache/hotel_681970.json';
            file_put_contents($filePath, $body);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data fetched and saved.',
                'file' => $filePath
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    // public function useHotelData()
    // {
    //     $filePath = WRITEPATH . 'cache/hotel_681970.json';

    //     if (file_exists($filePath)) {
    //         $data = json_decode(file_get_contents($filePath), true);
    //         // Do what you want with $data
    //         return view('hotel_details', ['hotel' => $data]);
    //     }

    //     return 'Hotel data not found. Please fetch it first.';
    // }



    // public function hotelDetails($code)
    // {
    //     $cacheFile = WRITEPATH . "cache/hotel_{$code}_details.json";

    //     if (file_exists($cacheFile)) {
    //         $responseBody = json_decode(file_get_contents($cacheFile), true);
    //     } else {
    //         $apiKey = getenv('HOTELBEDS_API_KEY');
    //         $secret = getenv('HOTELBEDS_SECRET');
    //         $timestamp = time();
    //         $signature = hash('sha256', $apiKey . $secret . $timestamp);
        

    //         $url = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/{$code}/details";

    //         $client = \Config\Services::curlrequest();

    //         try {
    //             $response = $client->get($url, [
    //                 'headers' => [
    //                     'Api-Key' => $apiKey,
    //                     'X-Signature' => $signature,
    //                     'Accept' => 'application/json',
    //                 ]
    //             ]);

    //             $responseBody = json_decode($response->getBody(), true);

    //             file_put_contents($cacheFile, json_encode($responseBody));

    //         } catch (\Exception $e) {
    //             return $this->response->setJSON(['error' => $e->getMessage()]);
    //         }
    //     }

    //     return view('Home/hotel_details', ['hotelDetails' => $responseBody]);
    // }


//     public function hotelDetails($code)
// {

//     $session = session();
//     $search_results_session = $session->get('hotel_search_results');
//     var_dump($search_results_session);die();
//     $cacheFile = WRITEPATH . "cache/hotel_{$code}_details.json";

//     if (file_exists($cacheFile)) {
//         $responseBody = json_decode(file_get_contents($cacheFile), true);
//     } else {
//         $apiKey = getenv('HOTELBEDS_API_KEY');
//         $secret = getenv('HOTELBEDS_SECRET');
//         $timestamp = time();
//         $signature = hash('sha256', $apiKey . $secret . $timestamp);

//         $url = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/{$code}/details";

//         $client = \Config\Services::curlrequest();

//         try {
//             $response = $client->get($url, [
//                 'headers' => [
//                     'Api-Key' => $apiKey,
//                     'X-Signature' => $signature,
//                     'Accept' => 'application/json',
//                 ]
//             ]);

//             $responseBody = json_decode($response->getBody(), true);

//             file_put_contents($cacheFile, json_encode($responseBody));
//         } catch (\Exception $e) {
//             return $this->response->setJSON(['error' => $e->getMessage()]);
//         }
//     }

//     return $this->template->render('Home/hotel_details', ['hotelDetails' => $responseBody]);
// }





    public function hotelDetails($code)
    {
        $session = session();
        $searchResults = $session->get('hotel_search_results');
        // var_dump($searchResults);
        $cacheFile = WRITEPATH . "cache/hotel_{$code}_details.json";

        $hotelRates = null;
        
            if (isset($searchResults['hotels']['hotels'])) {
                foreach ($searchResults['hotels']['hotels'] as $hotel) {
                    if ((int)$hotel['code'] === (int)$code) {
                        $hotelRates = $hotel;
                        break;
                    }
                }
            }
        // var_dump($cacheFile);die();

        if (file_exists($cacheFile)) {
            $responseBody = json_decode(file_get_contents($cacheFile), true);
        } else {
            $apiKey = getenv('HOTELBEDS_API_KEY');
            $secret = getenv('HOTELBEDS_SECRET');
            $timestamp = time();
            $signature = hash('sha256', $apiKey . $secret . $timestamp);

            $url = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/{$code}/details";

            $client = \Config\Services::curlrequest();

            try {
                $response = $client->get($url, [
                    'headers' => [
                        'Api-Key' => $apiKey,
                        'X-Signature' => $signature,
                        'Accept' => 'application/json',
                    ]
                ]);

                $responseBody = json_decode($response->getBody(), true);
                file_put_contents($cacheFile, json_encode($responseBody));
            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()]);
            }
        }

        
        return $this->template->render('Home/hotel_details', [
            'hotelDetails' => $responseBody,
            'rateData' => $hotelRates
        ]);
    }





    // working but not good error messgaes

    // public function checkRate()
    // {
    //     $rateKey = $this->request->getPost('rateKey');

    //     if (!$rateKey) {
    //         return $this->response->setJSON(['error' => 'RateKey is required']);
    //     }

    //     $hash = md5($rateKey);
    //     $cacheFile = WRITEPATH . "logs/check_rate_cache_{$hash}.json";

    //     if (file_exists($cacheFile)) {
    //         $cached = file_get_contents($cacheFile);
    //         return $this->response->setJSON(json_decode($cached, true));
    //     }

    //     $apiKey = getenv('HOTELBEDS_API_KEY');
    //     $secret = getenv('HOTELBEDS_SECRET');
    //     $timestamp = time();
    //     $signature = hash('sha256', $apiKey . $secret . $timestamp);

    //     $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/checkrates';
    //     $client = \Config\Services::curlrequest();

    //     $payload = [
    //         'rooms' => [
    //             [
    //                 'rateKey' => $rateKey
    //             ]
    //         ]
    //     ];

    //     try {
    //         $response = $client->post($url, [
    //             'headers' => [
    //                 'Api-Key' => $apiKey,
    //                 'X-Signature' => $signature,
    //                 'Accept' => 'application/json',
    //                 'Content-Type' => 'application/json'
    //             ],
    //             'body' => json_encode($payload)
    //         ]);

    //         $result = json_decode($response->getBody(), true);

    //         $timestampedFile = WRITEPATH . 'logs/check_rate_' . date('Ymd_His') . '.json';
    //         file_put_contents($timestampedFile, json_encode($result, JSON_PRETTY_PRINT));
    //         file_put_contents($cacheFile, json_encode($result, JSON_PRETTY_PRINT));

    //         return $this->response->setJSON($result);
    //     } catch (\Exception $e) {
    //         $errorLog = [
    //             'error' => $e->getMessage(),
    //             'rateKey' => $rateKey,
    //             'timestamp' => date('Y-m-d H:i:s')
    //         ];

    //         $errorFile = WRITEPATH . 'logs/check_rate_error_' . date('Ymd_His') . '.json';
    //         file_put_contents($errorFile, json_encode($errorLog, JSON_PRETTY_PRINT));

    //         return $this->response->setJSON($errorLog);
    //     }
    // }



    public function checkRate()
    {
        $rateKey = $this->request->getPost('rateKey');

        if (!$rateKey) {
            return $this->response->setJSON(['error' => 'RateKey is required']);
        }

        $hash = md5($rateKey);
        $cacheFile = WRITEPATH . "logs/check_rate_cache_{$hash}.json";

        if (file_exists($cacheFile)) {
            $cached = file_get_contents($cacheFile);
            return $this->response->setJSON(json_decode($cached, true));
        }

        $apiKey = getenv('HOTELBEDS_API_KEY');
        $secret = getenv('HOTELBEDS_SECRET');
        $timestamp = time();
        $signature = hash('sha256', $apiKey . $secret . $timestamp);

        $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/checkrates';
        $client = \Config\Services::curlrequest();

        $payload = [
            'rooms' => [
                ['rateKey' => $rateKey]
            ]
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Api-Key' => $apiKey,
                    'X-Signature' => $signature,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($payload),
                'http_errors' => false 
            ]);

            $status = $response->getStatusCode();
            $body = (string) $response->getBody();
            $decoded = json_decode($body, true);

            $timestampedFile = WRITEPATH . 'logs/check_rate_' . date('Ymd_His') . '.json';
            file_put_contents($timestampedFile, json_encode([
                'status' => $status,
                'response' => $decoded ?? $body,
            ], JSON_PRETTY_PRINT));

            if ($status !== 200 || isset($decoded['error'])) {
                $errorMessage = $decoded['error'] ?? "HTTP Error: $status";
                return $this->response->setJSON([
                    'error' => $errorMessage,
                    'status' => $status
                ]);
            }

            file_put_contents($cacheFile, json_encode($decoded, JSON_PRETTY_PRINT));
            return $this->response->setJSON($decoded);
        } catch (\Exception $e) {
            $errorLog = [
                'error' => $e->getMessage(),
                'rateKey' => $rateKey,
                'timestamp' => date('Y-m-d H:i:s')
            ];

            $errorFile = WRITEPATH . 'logs/check_rate_error_' . date('Ymd_His') . '.json';
            file_put_contents($errorFile, json_encode($errorLog, JSON_PRETTY_PRINT));

            return $this->response->setJSON(['error' => 'Unexpected server error']);
        }
    }








 









}
