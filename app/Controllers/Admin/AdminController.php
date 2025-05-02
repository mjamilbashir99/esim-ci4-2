<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Libraries\AdminTemplate;
use App\Models\MarkupModel;

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

    $users = $userModel
                ->orderBy('id', 'DESC') // ya 'created_at', 'DESC' agar column hai
                ->findAll();

    $data = [
        'admin' => session()->get('admin_data'),
        'users' => $users,
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
    $markupModel = new MarkupModel();
    $markups = $markupModel->findAll(); 

    $data = [
        'admin' => session()->get('admin_data'),
        'markups' => $markups,
        'title' => 'Hotels'
    ];

    return $this->template->render('admin/hotels', $data);
}

public function saveHotel()
{
    $request = service('request');
    $status = $request->getPost('status');
    $b2cMarkup = $request->getPost('b2cMarkup');
    $b2bMarkup = $request->getPost('b2bMarkup');
    $fromDate = $request->getPost('fromDate');
    $toDate = $request->getPost('toDate');
    $moduleId = $request->getPost('moduleId');

    $markupModel = new MarkupModel();

    $data = [
        'status' => $status,
        'b2c_markup' => $b2cMarkup,
        'b2b_markup' => $b2bMarkup,
        'from_date' => $fromDate,
        'to_date' => $toDate,
        'module_id' => $moduleId
    ];

    try {
        $markupModel->save($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Markup saved successfully.']);
    } catch (\Exception $e) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save markup.']);
    }
}

public function deleteHotel()
{
    $id = $this->request->getPost('id');
    if ($id) {
        $markupModel = new MarkupModel();
        $deleted = $markupModel->delete($id);
        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Markup deleted successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete entry']);
        }
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid ID']);
    }
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

    public function updateUser()
{
    $request = service('request');
    $id = $request->getPost('id');

    $email = $request->getPost('email');

    $userModel = new \App\Models\UserModel();

    // Check if email exists for another user
    $existingUser = $userModel
        ->where('email', $email)
        ->where('id !=', $id)
        ->first();

    if ($existingUser) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Email already exists.'
        ]);
    }

    $data = [
        'name'     => $request->getPost('name'),
        'email'    => $email,
        'phone'    => $request->getPost('phone'),
        'is_admin' => $request->getPost('is_admin'),
    ];

    try {
        $userModel->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Update failed: ' . $e->getMessage()
        ]);
    }
}

public function markups()
{
    // MarkupModel ka instance
    $markupModel = new MarkupModel();

    // Markups ko fetch karna
    $data = [
        'admin'   => session()->get('admin_data'),
        'markups' => $markupModel->findAll(), // Markups ko fetch kar rahe hain
        'title'   => 'Hotels'
    ];

    // Template render karna aur data pass karna
    return $this->template->render('admin/hotels', $data);
}


}
