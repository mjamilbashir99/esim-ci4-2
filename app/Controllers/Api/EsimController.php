<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MarkupModel;
use App\Models\UserModel;
use App\Libraries\EsimTemplate;

class EsimController extends BaseController
{
     protected $template;
     protected $userModel;
     public function __construct()
    {
        $this->template = new EsimTemplate();
        $this->userModel = new UserModel();
    }
    public function getApiInfo()
    {
        $client = \Config\Services::curlrequest();
        $apiKey = getenv('ESIM_API_KEY');
        try {
            $response = $client->get('https://api.esim-go.com/v2.3/', [
                'headers' => [
                    'X-API-Key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            return $this->response->setJSON([
                'available_endpoints' => $body
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Request failed: ' . $e->getMessage()
            ]);
        }
    }

    // get all bundeles
    public function getBundles()
    {
        $client = \Config\Services::curlrequest();
        $apiKey = getenv('ESIM_API_KEY');

        try {
            $response = $client->get('https://api.esim-go.com/v2.3/catalogue', [
                'headers' => [
                    'X-API-Key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            return $this->response->setJSON([
                'bundles' => $body
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Failed to fetch bundles: ' . $e->getMessage()
            ]);
        }
    }

    // get bundles by country
    // http://localhost:8080/api/bundles/United%20Arab%20Emirates
    public function getBundlesByCountry($countryName)
    {
        $client = \Config\Services::curlrequest();
        $apiKey = getenv('ESIM_API_KEY');

        try {
            $response = $client->get('https://api.esim-go.com/v2.3/catalogue', [
                'headers' => [
                    'X-API-Key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $bundles = $body['bundles'] ?? [];

            // Filter by country
            $filtered = array_filter($bundles, function ($bundle) use ($countryName) {
                foreach ($bundle['countries'] as $country) {
                    if (strtolower($country['name']) === strtolower($countryName)) {
                        return true;
                    }
                }
                return false;
            });

            return $this->response->setJSON([
                'country' => $countryName,
                'bundles' => array_values($filtered)
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Failed to fetch bundles: ' . $e->getMessage()
            ]);
        }
    }

    public function showBundles()
    {
        $client = \Config\Services::curlrequest();
        $apiKey = getenv('ESIM_API_KEY');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $selectedCountry = $this->request->getGet('country');
        $searchQuery = $this->request->getGet('search');  // Get search query
        $perPage = 12;

        try {
            $response = $client->get('https://api.esim-go.com/v2.3/catalogue', [
                'headers' => [
                    'X-API-Key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $allBundles = $body['bundles'] ?? [];

            // Extract unique countries
            $countryList = [];
            foreach ($allBundles as $bundle) {
                foreach ($bundle['countries'] as $country) {
                    $countryList[$country['name']] = true;
                }
            }
            $countries = array_keys($countryList);

            // Search functionality: Filter bundles based on search query
            if ($searchQuery) {
                $allBundles = array_filter($allBundles, function ($bundle) use ($searchQuery) {
                    foreach ($bundle['countries'] as $country) {
                        if (stripos($country['name'], $searchQuery) !== false) {
                            return true;
                        }
                    }
                    return false;
                });
                $allBundles = array_values($allBundles); // Re-index after filtering
            }

            // Filter by selected country if exists
            if ($selectedCountry) {
                $allBundles = array_filter($allBundles, function ($bundle) use ($selectedCountry) {
                    foreach ($bundle['countries'] as $country) {
                        if (strtolower($country['name']) === strtolower($selectedCountry)) {
                            return true;
                        }
                    }
                    return false;
                });
                $allBundles = array_values($allBundles); // Re-index after filtering
            }

            // Manual pagination
            $total = count($allBundles);
            $start = ($page - 1) * $perPage;
            $bundles = array_slice($allBundles, $start, $perPage);
            // After array_slice:
            $bundles = array_slice($allBundles, $start, $perPage);

            // Add selling price
            foreach ($bundles as &$bundle) {
                if (isset($bundle['price'])) {
                    $bundle['selling_price'] = $this->calculateSellingPrice($bundle['price']);
                }
            }
            //  return $this->template->render('admin/all-users', $data);
            return $this->template->render('bundles_list', [
                'bundles' => $bundles,
                'currentPage' => $page,
                'totalPages' => ceil($total / $perPage),
                'countries' => $countries,
                'selectedCountry' => $selectedCountry,
                'searchQuery' => $searchQuery // Pass search query to the view
            ]);

        } catch (\Exception $e) {
            return $this->template->render('bundles_list', ['bundles' => [], 'error' => $e->getMessage()]);
        }
    }
    public function getCountrySuggestions()
    {
        $searchQuery = $this->request->getGet('query');

        if (empty($searchQuery)) {
            return $this->response->setJSON([]);
        }

        // List of all available countries from the previous bundles data
        $client = \Config\Services::curlrequest();
        $apiKey = getenv('ESIM_API_KEY');
        
        try {
            $response = $client->get('https://api.esim-go.com/v2.3/catalogue', [
                'headers' => [
                    'X-API-Key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $allBundles = $body['bundles'] ?? [];

            $countryList = [];
            foreach ($allBundles as $bundle) {
                foreach ($bundle['countries'] as $country) {
                    $countryList[] = $country['name'];
                }
            }

            // Filter countries based on search query
            $matchingCountries = array_filter($countryList, function ($country) use ($searchQuery) {
                return stripos($country, $searchQuery) !== false;
            });

            // Return unique matching countries and limit to top 10 suggestions
            $matchingCountries = array_unique($matchingCountries);
            $matchingCountries = array_slice($matchingCountries, 0, 10); // Limit to top 10

            return $this->response->setJSON($matchingCountries);

        } catch (\Exception $e) {
            return $this->response->setJSON([]);
        }
    }


    public function viewbundle($bundleName)
    {
        $client = \Config\Services::curlrequest();
        $apiKey = getenv('ESIM_API_KEY');

        try {
            $response = $client->get('https://api.esim-go.com/v2.3/catalogue', [
                'headers' => [
                    'X-API-Key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $allBundles = $body['bundles'] ?? [];

            // Find and return only the main bundle
            foreach ($allBundles as $b) {
                if ($b['name'] === $bundleName) {
                    // Add selling price here also
                    if (isset($b['price'])) {
                        $b['selling_price'] = $this->calculateSellingPrice($b['price']);
                    }
                    return $this->template->render('bundle_detail', ['bundle' => $b]);
                }
            }

            throw new \Exception("Bundle not found.");

        } catch (\Exception $e) {
            return $this->response->setStatusCode(404)->setBody("Bundle not found or error: " . $e->getMessage());
        }
    }


    public function viewCart()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        return $this->template->render('cart_view', ['cart' => $cart]);
    }

    public function addToCart()
    {
        $request = service('request');
        $session = session();

        $data = $request->getJSON(true);

        $bundleName = $data['bundleName'] ?? '';
        $country = $data['country'] ?? 'N/A';
        $price = $data['price'] ?? 0;
        $quantity = $data['quantity'] ?? 1;

        if (!$bundleName || $quantity < 1) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid input']);
        }

        $cart = $session->get('cart') ?? [];

        if (isset($cart[$bundleName])) {
            $cart[$bundleName]['quantity'] += $quantity;
        } else {
            $cart[$bundleName] = [
                'name' => $bundleName,
                'country' => $country,
                'price' => $price,
                'quantity' => $quantity
            ];
        }

        $session->set('cart', $cart);

        return $this->response->setJSON(['success' => true, 'message' => 'Bundle added to cart', 'cartCount' => count($cart)]);
    }


    public function removeFromCart()
    {
        $request = service('request');
        $session = session();

        $bundleName = $request->getPost('bundleName');

        $cart = $session->get('cart') ?? [];

        if (isset($cart[$bundleName])) {
            unset($cart[$bundleName]);
            $session->set('cart', $cart);
        }

        return redirect()->to(site_url('cart'))->with('success', 'Bundle removed from cart');
    }
    public function cartCount()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];
        $count = count($cart);

        return $this->response->setJSON(['count' => $count]);
    }

    public function checkout()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/')->with('message', 'Your cart is empty.');
        }

        return $this->template->render('checkout', ['cart' => $cart]);
    }

    private function calculateSellingPrice($costPrice)
    {
        $profitMargin = $this->getB2CMarkup();  // dynamic markup
        return round($costPrice + ($costPrice * $profitMargin), 2);
    }

    private function getB2CMarkup()
    {
        $markupModel = new MarkupModel();

        // status column mai 'enabled' value check karo
        $markup = $markupModel->where('status', 'enabled')->first();
        // echo 'b2c markup:' . $markup['b2c_markup'];die;
        if ($markup && isset($markup['b2c_markup'])) {
            return (float) $markup['b2c_markup'];
        }

        // Default markup agar koi enabled record na mile
        return 2.20;
    }

    public function book()
    {
        $data = $this->request->getJSON(true);

        $paymentMethodId = $data['payment_method'] ?? '';
        $cartItems = $data['cart_items'] ?? [];
        $grandTotal = $data['grand_total'] ?? 0;
        $iccids = $data['iccids'] ?? [];

        if (empty($paymentMethodId) || empty($cartItems) || empty($iccids)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required data.'
            ]);
        }

        $apiKey = getenv('ESIM_API_KEY');
        // echo $apiKey; exit;


        // Prepare Order Data
        $order = [];
        foreach ($cartItems as $item) {
            $bundleName = $item['name'] ?? '';
            $quantity = $item['quantity'] ?? 1;

            if (isset($iccids[$bundleName])) {
                $order[] = [
                    'type' => 'bundle',
                    'quantity' => $quantity,
                    'item' => $bundleName,
                    'iccids' => $iccids[$bundleName],
                    'allowReassign' => true
                ];
            }
        }

        if (empty($order)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No valid order data found.'
            ]);
        }

        $postData = [
            'type' => 'transaction',
            'assign' => true,
            'order' => $order
        ];


        $logDir = WRITEPATH . 'esim_logs/';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $filename = $logDir . 'payload_' . date('Ymd_His') . '.json';

        file_put_contents($filename, json_encode($postData, JSON_PRETTY_PRINT));


        // cURL API Call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.esim-go.com/v2.4/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-API-Key: ' . $apiKey
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $logDir = WRITEPATH . 'esim_logs/';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $filename = $logDir . 'response_' . date('Ymd_His') . '.json';

        file_put_contents($filename, json_encode($response, JSON_PRETTY_PRINT));


        if ($httpCode === 200) {
            $responseData = json_decode($response, true);
            return $this->response->setJSON([
                'success' => true,
                'data' => $responseData
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'eSIM Go API call failed',
                'http_code' => $httpCode,
                'response' => $response
            ]);
        }
    }

    public function viewProfile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return $this->template->render('profile/edit', ['user' => $user]);
    }

    public function updateProfile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if(!$user){
            return redirect()->back()->with('error', 'No user found.');
        }

        $rules = [
            'name'          => 'required',
            'phone'         => 'required',
            'email'         => 'required|valid_email',
            'password'      => 'permit_empty|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'         => $this->request->getPost('name'),
            'phone'        => $this->request->getPost('phone'),
            'email'        => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($userId, $data);

        session()->set([
            'user_name'         => $data['name'],
            'user_email'        => $data['email'],
            'user_phone'        => $data['phone'],
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function set()
    {
        $session = session();
        $currency = $this->request->getGet('currency');

        $allowed = ['USD', 'EUR', 'GBP', 'CAD', 'AUD', 'INR', 'CNY', 'JPY', 'SAR', 'AED'];

        if (in_array($currency, $allowed)) {
            $session->set('currency', $currency);
        }

        return redirect()->back();
    }



}
