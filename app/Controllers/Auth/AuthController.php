<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Template;

class AuthController extends BaseController
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

    public function register(){
        $data = [
            'title' => 'Register Page',
        ];
        return $this->template->render('auth/register', $data);
    }
}
