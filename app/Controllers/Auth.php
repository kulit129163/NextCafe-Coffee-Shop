<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('login', ['title' => 'Login - NextCafe']);
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $user = $userModel->groupStart()
                          ->where('email', $login)
                          ->orWhere('username', $login)
                          ->groupEnd()
                          ->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Invalid username/email or password');
        }
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('register', ['title' => 'Register - NextCafe']);
    }

    public function attemptRegister()
    {
        $userModel = new UserModel();
        
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => 'customer',
            'status'   => 'active'
        ];

        if ($userModel->save($data)) {
            // Send Welcome Email
            $email = \Config\Services::email();
            $email->setTo($data['email']);
            $email->setSubject('Welcome to NextCafe!');
            $email->setMessage('
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; text-align: center;">
                    <h1 style="color: #C69276;">Welcome ' . esc($data['username']) . '!</h1>
                    <p style="font-size: 16px; color: #333;">Thank you for registering at <strong>NextCafe Coffee Shop</strong>.</p>
                    <p style="font-size: 16px; color: #333;">We are thrilled to have you join our community of premium coffee lovers. You can now log into your account and place orders immediately.</p>
                </div>
            ');
            $email->send();

            return redirect()->to('login')->with('success', 'Registration successful! Please login.');
        } else {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }
}
