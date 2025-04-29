<?php

namespace App\Controllers;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use App\Libraries\Template;

class Home extends BaseController
{
    protected $template;
    // public function index(): ResponseInterface
    // {
    //     helper('hotelbeds');
    //     $result = check_hotelbeds_status();
    //     return $this->response->setJSON($result);
    // }


    public function __construct()
    {
        $this->template = new Template();
    }


    public function index()
    {
        
        $data = [
            'title' => 'Register',
        ];

        return $this->template->render('welcome_message', $data);
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
