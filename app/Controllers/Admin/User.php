<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'title'      => 'Users Management - Admin',
            'page_title' => 'Users Management',
            'users'      => $userModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/users_index', $data);
    }

    public function updateRole($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Prevent self-demotion
        if ($id == session()->get('id') && $this->request->getPost('role') === 'customer') {
            return redirect()->back()->with('error', 'You cannot demote yourself from the admin position.');
        }

        $userModel->update($id, [
            'role' => $this->request->getPost('role')
        ]);

        return redirect()->to('admin/users')->with('success', "User role updated successfully to " . esc($this->request->getPost('role')) . ".");
    }
}
