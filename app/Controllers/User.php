<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\UserModel;

class User extends BaseController
{
    public function profile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userModel = new UserModel();
        $user = $userModel->find(session()->get('id'));

        $data = [
            'title' => 'My Profile - NextCafe',
            'user'  => $user,
        ];

        return view('profile', $data);
    }

    public function orders()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // Get orders for the logged-in user
        $orders = $orderModel->where('user_id', session()->get('id'))
                            ->orderBy('created_at', 'DESC')
                            ->findAll();

        // For each order, get its items with product details
        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel->select('order_items.*, products.name as product_name, products.image as product_image')
                                            ->join('products', 'products.id = order_items.product_id')
                                            ->where('order_id', $order['id'])
                                            ->findAll();
        }

        $data = [
            'title'      => 'My Orders - NextCafe',
            'page_title' => 'Order History',
            'orders'     => $orders,
        ];

        return view('orders', $data);
    }

    public function updateProfile()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('login');

        $userModel = new UserModel();
        $id = session()->get('id');

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name')
        ];

        $userModel->update($id, $data);

        return redirect()->to('profile')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('login');

        $userModel = new UserModel();
        $id = session()->get('id');
        $user = $userModel->find($id);

        $current = $this->request->getPost('current_password');
        $new = $this->request->getPost('new_password');
        $confirm = $this->request->getPost('confirm_password');

        if (!password_verify($current, $user['password'])) {
            return redirect()->to('profile')->with('error', 'Current password is incorrect.');
        }

        if ($new !== $confirm) {
            return redirect()->to('profile')->with('error', 'New passwords do not match.');
        }

        if (strlen($new) < 8) {
            return redirect()->to('profile')->with('error', 'Password must be at least 8 characters long.');
        }

        $userModel->update($id, ['password' => $new]);

        return redirect()->to('profile')->with('success', 'Password updated successfully.');
    }
}
