<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $orderModel   = new OrderModel();
        $productModel = new ProductModel();
        $userModel    = new UserModel();

        $totalRevenue = $orderModel->selectSum('total_amount')->get()->getRowArray()['total_amount'] ?? 0;
        $totalOrders  = $orderModel->countAllResults();
        $totalProducts = $productModel->where('status', 'active')->countAllResults();
        $totalUsers   = $userModel->countAllResults();

        $recentOrders = $orderModel
            ->select('orders.*, users.username, users.email, users.first_name, users.last_name')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->orderBy('orders.created_at', 'DESC')
            ->limit(10)
            ->findAll();

        return view('admin/dashboard', [
            'title'         => 'Dashboard Overview - Admin',
            'page_title'    => 'Dashboard Overview',
            'totalRevenue'  => $totalRevenue,
            'totalOrders'   => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalUsers'    => $totalUsers,
            'recentOrders'  => $recentOrders,
        ]);
    }
}
