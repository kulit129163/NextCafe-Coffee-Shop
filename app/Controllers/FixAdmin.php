<?php

namespace App\Controllers;

class FixAdmin extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        
        // Update user with username 'admin' or email 'admin@example.com'
        $builder->where('username', 'admin');
        $builder->orWhere('email', 'admin@example.com');
        $builder->update(['role' => 'admin']);
        
        return "Admin role fixed! You can now log in with admin@example.com / admin123. <br><a href='/login'>Go to Login</a>";
    }
}
