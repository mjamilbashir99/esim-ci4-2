<?php

namespace App\Controllers\Home;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CityModel;

class HomeController extends BaseController
{
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


}
