<?php

namespace App\Controllers;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

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

    public function testDatabaseConnection()
    {
        try {
            $db = \Config\Database::connect();
            
            $query = $db->query('SELECT 1');
            
            if ($query) {
                return 'Database connection is successful.';
            } else {
                return 'Database connection failed.';
            }
        } catch (DatabaseException $e) {
            // If an exception is thrown, there is an issue with the connection
            return 'Database connection failed: ' . $e->getMessage();
        }
    }
}
