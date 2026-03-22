<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn') && session()->get('role') === 'admin') {
            return redirect()->to('admin');
        }
        
        // If a customer is logged in, but hits backend login, destroy their session to allow admin login
        if (session()->get('isLoggedIn') && session()->get('role') !== 'admin') {
             session()->destroy();
        }

        return view('admin/login', ['title' => 'Admin Login - NextCafe']);
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

        // Strictly verify password AND Role
        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] !== 'admin') {
                return redirect()->back()->with('error', 'Unauthorized: Account does not have Administrator privileges.');
            }
            
            $this->setUserSession($user);
            return redirect()->to(base_url('admin/dashboard'))->with('success', 'Welcome to the NextCafe Control Panel, ' . esc($user['username']) . '.');
        } else {
            return redirect()->back()->with('error', 'Invalid admin credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login')->with('success', 'Admin session terminated successfully.');
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
