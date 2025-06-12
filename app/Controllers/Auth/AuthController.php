<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\EsimTemplate;
use App\Models\HotelModel;
use App\Models\UserModel;
use App\Models\EmailTemplateModel;


class AuthController extends BaseController
{
    protected $template;

    public function __construct()
    {
        $this->template = new EsimTemplate();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
        ];
        return $this->template->render('home/index', $data);
    }

    public function register(){
        $data = [
            'title' => 'Register Page',
        ];
        return $this->template->render('auth/register', $data);
    }



    private function sendOtpToUser($email, $userId)
    {
        // Generate OTP
        $otp = rand(100000, 999999);
    
        $userModel = new \App\Models\UserModel();
        $userModel->update($userId, [
            'otp' => $otp,
            'otp_created_at' => date('Y-m-d H:i:s')
        ]);
    
        $user = $userModel->find($userId);
        $name = $user['name'] ?? 'User';
    
        $templateModel = new \App\Models\EmailTemplateModel();
        $slug = 'OTP-template'; 
        $template = $templateModel->where('slug', $slug)->first();  
    
        if (!$template) {
            return false; 
        }
    
        $templateContent = $template['content'];
    
        $templateContent = str_replace('<?= esc($name) ?>', esc($name), $templateContent);
        $templateContent = str_replace('<?= esc($otp) ?>', $otp, $templateContent);
    
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject($template['subject']);
        $emailService->setMessage($templateContent);
        $emailService->setMailType('html');
    
        return $emailService->send();
    }

    public function submit()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'            => 'required|min_length[3]',
            'email'           => 'required|valid_email|is_unique[users.email]',
            'phone'           => 'required|min_length[10]',
            'password'        => 'required|min_length[6]',
            'confirm_password'=> 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();

        $data = [
            'name'         => $this->request->getPost('name'),
            'email'        => $this->request->getPost('email'),
            'phone'        => $this->request->getPost('phone'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'otp'          => 0, // placeholder
            'is_verified'  => 0,
        ];

        $userModel->insert($data);
        $userId = $userModel->getInsertID();

        if ($this->sendOtpToUser($data['email'], $userId)) {
            // return redirect()->to('verify-otp?email=' . urlencode($data['email']));

            $redirectUrl = session()->get('redirect_url') ?? '/home';
            session()->remove('redirect_url');

            // After OTP verification redirect to $redirectUrl
            session()->set('post_verification_redirect', $redirectUrl);
            return redirect()->to('verify-otp?email=' . urlencode($data['email']));
        } else {
            return redirect()->back()->with('error', 'Failed to send verification email.');
        }
    }


    

    public function verifyOtpSubmit()
    {
        $email = $this->request->getPost('email');
        $otpArray = $this->request->getPost('otp');
        $otp = implode('', $otpArray);

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('register')->with('error', 'User not found.');
        }

        // Check if OTP is expired (60 seconds validity)
        $otpCreatedAt = strtotime($user['otp_created_at']);
        if (!$otpCreatedAt || (time() - $otpCreatedAt > 60)) {
            return redirect()->to('verify-otp?email=' . urlencode($email))
                            ->with('error', 'OTP has expired. Please request a new one.');
        }

        // Verify OTP
        if ($user['otp'] === $otp) {
            $userModel->update($user['id'], [
                'otp' => null,
                'otp_created_at' => null,
                'is_verified' => 1
            ]);

            session()->set([
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'logged_in'  => true,
            ]);

            // ✅ Send Welcome Email
            $this->sendWelcomeEmail($user['email'], $user['name']);

            // Redirect user to /index.php/esim after verification
            return redirect()->to('/esim')->with('success', 'Email verified successfully.');
        }

        return redirect()->to('verify-otp?email=' . urlencode($email))
                        ->with('error', 'Invalid OTP. Please try again.');
    }

    public function verifyOtpView()
    {
        // return view('auth/verify_otp');
        return $this->template->render('auth/verify_otp');
    }


    public function login()
    {
        // return view('auth/login');
        $data = [
                'title' => 'Login',
            ];
        return $this->template->render('auth/login', $data);
    }


    public function loginSubmit()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {

            if ($user['is_verified'] == 0) {
                $this->sendOtpToUser($email, $user['id']);
                return redirect()->to('/verify-otp?email=' . urlencode($email));
            }

            $session->set([
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'logged_in'  => true,
            ]);

            $redirectUrl = session()->get('redirect_url') ?? '/esim';
            session()->remove('redirect_url');

            return redirect()->to($redirectUrl);
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Logged out successfully.');
    }

    private function checkLogin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login to continue.');
        }
    }

    public function resendOtp()
    {
        $email = $this->request->getGet('email');
        if (!$email) {
            return redirect()->to('register')->with('error', 'Invalid request.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('register')->with('error', 'User not found.');
        }

        $success = $this->sendOtpToUser($email, $user['id']);

        if ($success) {
            return redirect()->to('verify-otp?email=' . urlencode($email))
                            ->with('success', 'OTP has been resent to your email.');
        } else {
            return redirect()->to('verify-otp?email=' . urlencode($email))
                            ->with('error', 'Failed to resend OTP. Please try again.');
        }
    }


    private function sendWelcomeEmail($email, $name)
    {
        $templateModel = new \App\Models\EmailTemplateModel();
        $slug = 'Welcome-User';
        $template = $templateModel->where('slug', $slug)->first(); 
    
        if (!$template) {
            return false;
        }
    
      
        $templateContent = $template['content'];
    
       
        $templateContent = str_replace('<?= esc($name) ?>', esc($name), $templateContent);
        $templateContent = str_replace('<?= base_url("login") ?>', base_url('login'), $templateContent);
    
        
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject($template['subject']); 
        $emailService->setMessage($templateContent);
        $emailService->setMailType('html');
        return $emailService->send();
    }
    
    public function isLoggedIn()
    {
        $session = session();
        return $this->response->setJSON([
            'logged_in' => $session->get('logged_in') === true
        ]);
    }


    public function setRedirectUrl()
    {
        $url = $this->request->getPost('url');
        if ($url) {
            session()->set('redirect_url', $url);
        }
        return $this->response->setJSON(['status' => 'ok']);
    }




      
}
