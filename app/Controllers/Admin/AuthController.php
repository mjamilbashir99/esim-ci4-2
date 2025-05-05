<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel; // Your existing user model

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->isAdminLoggedIn()) {
            return redirect()->to('/admin/all-bookings');
        }

        return view('admin/auth/login');
    }

    public function loginSubmit()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        // Verify password and check if user is admin
        if (!$user || !password_verify($password, $user['password']) || $user['is_admin'] != 1) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials or not an admin');
        }

        $this->setAdminSession($user);

        return redirect()->to('/admin/all-bookings');
    }

    public function logout()
    {
        session()->remove('admin_logged_in');
        session()->remove('admin_data');
        return redirect()->to('/admin/login');
    }

    protected function setAdminSession($user)
{
    $adminData = [
        'id' => $user['id'],
        'email' => $user['email'],
        'is_admin' => $user['is_admin'],
        'is_logged_in' => true
    ];

    session()->set('admin_logged_in', true);
    session()->set('admin_data', $adminData);
}
    protected function isAdminLoggedIn()
    {
        return session()->get('admin_logged_in') === true;
    }
}