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


    // public function searchHotels()
    // {
    //     // echo "hello";die();
    //     $destination = "Lahore";
    //     $checkIn = "2020-06-15";
    //     // var_dump($destination);die();
    //     $checkOut = "2020-06-16";
    //     $passenger = 1;
    //     $rooms = 1;
    
    //     $adults = 1;
    //     $children = 0;
    //     $infants = 0;
    
    //     if (strpos($passenger, 'Adults') !== false) {
    //         preg_match('/(\d+) Adults/', $passenger, $matches);
    //         $adults = $matches[1] ?? 1;
    //     }
    //     if (strpos($passenger, 'Children') !== false) {
    //         preg_match('/(\d+) Children/', $passenger, $matches);
    //         $children = $matches[1] ?? 0;
    //     }
    //     if (strpos($passenger, 'Infants') !== false) {
    //         preg_match('/(\d+) Infants/', $passenger, $matches);
    //         $infants = $matches[1] ?? 0;
    //     }
    
    //     $cityModel = new \App\Models\CityModel();
    //     $city = $cityModel->where('name', $destination)->first();
    
    //     if (!$city) {
    //         return $this->response->setJSON(['error' => 'City not found']);
    //     }
    
    //     $payload = [
    //         "stay" => [
    //             "checkIn" => $checkIn,
    //             "checkOut" => $checkOut
    //         ],
    //         "occupancies" => [
    //             [
    //                 "rooms" => (int)$rooms,
    //                 "adults" => (int)$adults,
    //                 "children" => (int)$children
    //             ]
    //         ],
    //         "geolocation" => [
    //             // "latitude" => (float)$city['latitude'],
    //             // "longitude" => (float)$city['longitude'],
    //             "latitude" => 39.57119,
    //             "longitude" => 2.646633999999949,
    //             "radius" => 20,
    //             "unit" => "km"
    //         ]
    //     ];

    //     // echo "<pre>";
    //     // var_dump($payload);  // Or use print_r($payload);
    //     // echo "</pre>";
    //     // die();
    
    //     $apiKey = getenv('HOTELBEDS_API_KEY');
       
    //     $secret = getenv('HOTELBEDS_SECRET');
    //     // var_dump($secret);die();
    //     $timestamp = time();
    //     $signature = hash('sha256', $apiKey . $secret . $timestamp);
    //     var_dump($signature);die();
    
    //     $url = 'https://api.test.hotelbeds.com//hotel-api/1.0/hotels';
    
    //     $client = \Config\Services::curlrequest();
    //     $response = $client->post($url, [
    //         'headers' => [
    //             'Api-Key' => $apiKey,
    //             'X-Signature' => $signature,
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json'
    //         ],
    //         'body' => json_encode($payload)
    //     ]);
    //     var_dump($response);die();
        
    //     log_message('error', 'API Response: ' . $response->getBody());
        
    //     $responseBody = json_decode($response->getBody(), true);
    //     log_message('error', 'Error Details: ' . print_r($responseBody, true));
        
    
    //     return $this->response->setJSON(json_decode($response->getBody(), true));
    // }




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
        
            $responseBody = json_decode($response->getBody(), true);

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
            $session->set('hotel_search_results', $responseBody);
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
        // var_dump($hotelRates);die();

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





}
