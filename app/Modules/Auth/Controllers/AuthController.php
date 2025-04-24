<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;
use Modules\Auth\Models\UserModel;
use Modules\Auth\Libraries\Hotelbeds_lib;
use Config\Database;
use CodeIgniter\Database\Config;

class AuthController extends BaseController
{


    // public function register()
    // {
    //     $db = \Config\Database::connect();
    //     if($db){
    //        echo  "connected successfully";
    //     }
    //     else{
    //         echo "not connected";
    //     } 
        
    // }
    public function register()
    {
        helper(['form']);

        // Try DB connection and catch connection errors
        try {
            $db = \Config\Database::connect();
            if (!$db->connID) {
                throw new \Exception("Database connection failed.");
            }
        } catch (\Exception $e) {
            return view('Modules\Auth\Views\register', [
                'dbError' => $e->getMessage()
            ]);
        }

        // If form submitted
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name'             => 'required|min_length[3]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'phone'            => 'required|numeric|min_length[10]',
                'password'         => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if (!$this->validate($rules)) {
                return view('Modules\Auth\Views\register', [
                    'validation' => $this->validator
                ]);
            }

            $model = new UserModel();

            $data = [
                'name'     => esc($this->request->getPost('name')),
                'email'    => esc($this->request->getPost('email')),
                'phone'    => esc($this->request->getPost('phone')),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ];

            if (!$model->save($data)) {
                return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }

            return redirect()->to('/login')->with('success', 'Registration successful!');
        }

        return view('Modules\Auth\Views\register');
    }


    
    public function testHotelbeds()
    {
        $hotelbeds = new Hotelbeds_lib();

        $result = $hotelbeds->checkStatus();

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}
