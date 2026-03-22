<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Checkout extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $cartModel = new CartModel();
        $items = $cartModel->select('cart.*, products.name as product_name, products.image as product_image')
                           ->join('products', 'products.id = cart.product_id')
                           ->where('user_id', session()->get('id'))
                           ->findAll();

        $totalPrice = 0;
        foreach ($items as &$item) {
            $item['item_total'] = $item['unit_price'] * $item['quantity'];
            $totalPrice += $item['item_total'];
            $item['decoded_options'] = $item['options'] ? json_decode($item['options'], true) : null;
        }

        $data = [
            'title' => 'Checkout - NextCafe',
            'items' => $items,
            'total_price' => $totalPrice
        ];

        return view('checkout', $data);
    }

    public function process()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $cartModel = new CartModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $userId = session()->get('id');

        $items = $cartModel->where('user_id', $userId)->findAll();

        if (empty($items)) {
            return redirect()->to('cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['unit_price'] * $item['quantity'];
        }

        $shippingAddress = $this->request->getPost('shipping_address');
        $paymentMethod = $this->request->getPost('payment_method');

        $db = \Config\Database::connect();
        $db->transStart();

        // Create Order
        $orderData = [
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'shipping_address' => $shippingAddress,
            'payment_method' => $paymentMethod
        ];
        
        if (!$orderModel->insert($orderData)) {
            $db->transRollback();
            $errorMsg = empty($orderModel->errors()) ? $db->error()['message'] : implode(', ', $orderModel->errors());
            return redirect()->back()->with('error', 'Order failed: ' . $errorMsg);
        }
        $orderId = $orderModel->getInsertID();

        // Create Order Items
        foreach ($items as $item) {
            $itemData = [
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['unit_price'], // Storing the customized price
                'unit_price' => $item['unit_price'],
                'options' => $item['options']
            ];
            if (!$orderItemModel->insert($itemData)) {
                $db->transRollback();
                $errorMsg = empty($orderItemModel->errors()) ? $db->error()['message'] : implode(', ', $orderItemModel->errors());
                return redirect()->back()->with('error', 'Item failed: ' . $errorMsg);
            }
        }

        // Clear Cart
        $cartModel->where('user_id', $userId)->delete();
        
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Transaction Failed: ' . $db->error()['message']);
        }

        return redirect()->to('orders')->with('success', 'Order placed successfully!');
    }
}
