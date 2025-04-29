<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        // Check if user is logged in AND is admin
        if (!session()->get('admin_logged_in') || session()->get('admin_data')['is_admin'] != 1) {
            return redirect()->to('/admin/login');
        }
    }

    public function index()
    {
        $data = [
            'admin' => session()->get('admin_data')
        ];
        return view('admin/index', $data);
    }

    public function listUsers()
    {
        $data = [
            'admin' => session()->get('admin_data')
        ];
        return view('admin/all-users', $data);
    }
}