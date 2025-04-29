<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/index');
        //
    }

    
    public function listUsers()
    {
        return view('admin/all-users');
        //
    }
}
