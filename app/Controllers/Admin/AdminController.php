<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Libraries\AdminTemplate;

class AdminController extends BaseController
{
    protected $template;

    public function __construct()
    {
        if (!session()->get('admin_logged_in') || session()->get('admin_data')['is_admin'] != 1) {
            header("Location: " . site_url('/admin/login'));
            exit;
        }

        $this->template = new AdminTemplate();
    }

    public function index()
    {
        $data = [
            'admin' => session()->get('admin_data'),
            'title' => 'Admin Dashboard'
        ];
        return $this->template->render('admin/index', $data);
    }

    public function listUsers()
    {
        $userModel = new UserModel();
        $data = [
            'admin' => session()->get('admin_data'),
            'users' => $userModel->findAll(),
            'title' => 'All Users'
        ];
        return $this->template->render('admin/all-users', $data);
    }
    public function listBookings()
{
    $bookingModel = new \App\Models\BookingModel();

    $data = [
        'admin' => session()->get('admin_data'),
        'bookings' => $bookingModel->getBookingsWithUser(),
        'title' => 'All Bookings'
    ];

    return $this->template->render('admin/all-bookings', $data);
}
    public function hotels()
    {
        $userModel = new UserModel();
        $data = [
            'admin' => session()->get('admin_data'),
            // 'users' => $userModel->findAll(),
            'title' => 'Hotels'
        ];
        return $this->template->render('admin/hotels', $data);
    }

    public function deleteUser($id)
    {
        $bookingModel = new BookingModel();
        $bookingModel->where('user_id', $id)->delete(); // delete related bookings
    
        $userModel = new UserModel();
        if ($userModel->delete($id)) {
            return redirect()->to('/admin/all-users')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->to('/admin/all-users')->with('error', 'Failed to delete user.');
        }
    }
}
