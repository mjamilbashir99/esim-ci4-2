<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Template;
use App\Models\HotelModel;


class AuthController extends BaseController
{
    protected $template;

    public function __construct()
    {
        $this->template = new Template();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
        ];
        return $this->template->render('home/index', $data);
    }

    public function register(){
        $data = [
            'title' => 'Register Page',
        ];
        return $this->template->render('auth/register', $data);
    }


    // fetching correct info but not storing into db 
    public function hotelBedsApi(): ResponseInterface
    {
        helper('generic_helper');

        $result = fetch_hotelbeds_hotels();
        
        if (isset($result['error'])) {
            return $this->response->setJSON(['error' => $result['error']]);
        }

        $hotelsData = [];
        
        if (isset($result['response']['hotels'])) {
            foreach ($result['response']['hotels'] as $hotel) {
                // For db insertioon of hotels
                // $hotelModel = new HotelModel();
                // $hotelToInsert = [
                //     'hotel_code' => $hotel['code'],
                //     'name' => $hotel['name']['content'] ?? '',
                //     'country_code' => $hotel['countryCode'] ?? '',
                //     'destination_code' => $hotel['destinationCode'] ?? '',
                //     'category' => $hotel['categoryCode'] ?? '',
                //     'latitude' => $hotel['coordinates']['latitude'] ?? '',
                //     'longitude' => $hotel['coordinates']['longitude'] ?? '',
                //     'address' => $hotel['address']['content'] ?? '', 
                //     'description' => $hotel['description']['content'] ?? '',
                //     'rating' => $hotel['S2C'] ?? '',
                // ];

                // $hotelModel->insert($hotelToInsert);

                $hotelDetails = [
                    'code' => $hotel['code'],
                    'name' => $hotel['name']['content'] ?? '',
                    'description' => $hotel['description']['content'] ?? '',
                    'country_code' => $hotel['countryCode'] ?? '',
                    'state_code' => $hotel['stateCode'] ?? '',
                    'destination_code' => $hotel['destinationCode'] ?? '',
                    'coordinates' => [
                        'latitude' => $hotel['coordinates']['latitude'] ?? '',
                        'longitude' => $hotel['coordinates']['longitude'] ?? ''
                    ],
                    'categoryCode' =>  $hotel['categoryCode'] ?? '',
                    'address' => [
                        'content' => $hotel['address']['content'] ?? '',
                        'street' => $hotel['address']['street'] ?? '',
                        'number' => $hotel['address']['number'] ?? '',
                    ],
                    'postalCode' =>  $hotel['postalCode'] ?? '',
                    'city' => [
                        'content' => $hotel['city']['content'] ?? '',
                    ],
                    "S2C" => $hotel['S2C'] ?? '',

                ];


                $imagesData = [];
                if (isset($hotel['images'])) {
                    foreach ($hotel['images'] as $image) {
                        $imageDetails = [
                            'image_type_code' => $image['imageTypeCode'] ?? '',
                            'path' => $image['path'] ?? '',
                            'order' => $image['order'] ?? '',
                            'visual_order' => $image['visualOrder'] ?? '',
                        ];

                        if (isset($image['roomCode'])) {
                            $imageDetails['room_code'] = $image['roomCode'];
                            $imageDetails['room_type'] = $image['roomType'];
                            $imageDetails['characteristic_code'] = $image['characteristicCode'];
                        }

                        $imagesData[] = $imageDetails;
                    }
                }


                $roomsData = [];
                if (isset($hotel['rooms'])) {
                    foreach ($hotel['rooms'] as $room) {
                        $roomDetails = [
                            'room_code' => $room['roomCode'] ?? '',
                            'is_parent_room' => $room['isParentRoom'] ?? false,
                            'min_pax' => $room['minPax'] ?? 1,
                            'max_pax' => $room['maxPax'] ?? 1,
                            'max_adults' => $room['maxAdults'] ?? 1,
                            'max_children' => $room['maxChildren'] ?? 0,
                            'min_adults' => $room['minAdults'] ?? 1,
                            'room_type' => $room['roomType'] ?? '',
                            'characteristic_code' => $room['characteristicCode'] ?? ''
                        ];

                        $roomsData[] = $roomDetails;
                    }
                }

                $hotelDetails['rooms'] = $roomsData;

                $hotelDetails['images'] = $imagesData;

                $hotelsData[] = $hotelDetails;
            }
        }
        
        return $this->response->setJSON([
            'status_code' => $result['status_code'],
            'total_hotels' => $result['response']['total'],
            'hotels' => $hotelsData,
        ]);
    }









    public function searchNearbyHotels(): ResponseInterface
    {
        helper('generic_helper');
        $request = $this->request->getJSON(true); // Get POST body as array
    
        // Validate input
        if (
            !isset($request['stay'], $request['occupancies'], $request['geolocation']) ||
            !isset($request['stay']['checkIn'], $request['stay']['checkOut']) ||
            !isset($request['geolocation']['latitude'], $request['geolocation']['longitude'])
        ) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request body.']);
        }
    
        $checkIn = $request['stay']['checkIn'];
        $checkOut = $request['stay']['checkOut'];
        $occupancies = $request['occupancies'];
        $lat = $request['geolocation']['latitude'];
        $lng = $request['geolocation']['longitude'];
        $radius = $request['geolocation']['radius'] ?? 20;
        $unit = $request['geolocation']['unit'] ?? 'km';
    
        // For now, just return the request data + mock response
        $mockResponse = [
            'search_summary' => [
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => $occupancies,
                'location' => [
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'radius' => $radius,
                    'unit' => $unit
                ]
            ],
            'hotels_found' => [
                [
                    'hotel_code' => '000001',
                    'name' => 'Mock Hotel Palma',
                    'distance' => 1.2,
                    'category' => '4*',
                    'latitude' => 39.57125,
                    'longitude' => 2.64660,
                ],
                [
                    'hotel_code' => '000002',
                    'name' => 'Sea View Hotel',
                    'distance' => 3.5,
                    'category' => '3*',
                    'latitude' => 39.56800,
                    'longitude' => 2.64500,
                ]
            ]
        ];
    
        return $this->response->setJSON($mockResponse);
    }
    



    // public function hotelBedsApi(): ResponseInterface
    // {
    //     helper('generic_helper');
    //     $result = fetch_hotelbeds_hotels();
    //     return $this->response->setJSON($result);
    // }


}
