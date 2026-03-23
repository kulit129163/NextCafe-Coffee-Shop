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

        $db = \Config\Database::connect();
        $db->table('users')->where('id', $id)->update([
            'role' => $this->request->getPost('role')
        ]);

        return redirect()->to('admin/users')->with('success', "User role updated successfully to " . esc($this->request->getPost('role')) . ".");
    }

    public function toggleStatus($id)
    {
        log_message('error', 'toggleStatus hit for ID: ' . $id);
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            log_message('error', 'User not found in DB');
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($id == session()->get('id')) {
            log_message('error', 'Tried to deactivate self');
            return redirect()->back()->with('error', 'You cannot deactivate your own account.');
        }

        $newStatus = ($user['status'] ?? 'active') === 'active' ? 'inactive' : 'active';
        log_message('error', 'Changing status to: ' . $newStatus);
        $db = \Config\Database::connect();
        $db->table('users')->where('id', $id)->update(['status' => $newStatus]);
        log_message('error', 'DB update finished');

        $msg = $newStatus === 'active' ? 'activated' : 'deactivated';
        return redirect()->to('admin/users')->with('success', "User account has been {$msg}.");
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($id == session()->get('id')) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        try {
            $db = \Config\Database::connect();
            $db->table('users')->where('id', $id)->delete();
            return redirect()->to('admin/users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->to('admin/users')->with('error', 'Cannot delete user because they have existing orders or reviews.');
        }
    }
}
