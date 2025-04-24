<?php

namespace App\Controllers;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    // public function index(): ResponseInterface
    // {
    //     helper('hotelbeds');
    //     $result = check_hotelbeds_status();
    //     return $this->response->setJSON($result);
    // }

    public function index(){
        return view('welcome_message');
    }
}
