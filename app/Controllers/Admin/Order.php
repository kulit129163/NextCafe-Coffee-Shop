<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Order extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        
        $orders = $orderModel->select('orders.*, users.username, users.email')
                             ->join('users', 'users.id = orders.user_id', 'left')
                             ->orderBy('orders.created_at', 'DESC')
                             ->findAll();

        $data = [
            'title'      => 'Orders Management - Admin',
            'page_title' => 'Orders Management',
            'orders'     => $orders
        ];

        return view('admin/orders_index', $data);
    }

    public function view($id)
    {
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        
        $order = $orderModel->select('orders.*, users.username, users.email, users.first_name, users.last_name')
                            ->join('users', 'users.id = orders.user_id', 'left')
                            ->find($id);

        if (!$order) {
            return redirect()->to('admin/orders')->with('error', 'Order not found.');
        }

        $items = $orderItemModel->select('order_items.*, products.name as product_name, products.image as product_image')
                                ->join('products', 'products.id = order_items.product_id')
                                ->where('order_id', $id)
                                ->findAll();

        $data = [
            'title' => 'Order Details #' . $order['id'],
            'order' => $order,
            'items' => $items
        ];

        return view('admin/orders_view', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status selected.');
        }

        $orderModel = new OrderModel();
        $orderModel->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Order status updated to ' . ucfirst($status) . '.');
    }
}
