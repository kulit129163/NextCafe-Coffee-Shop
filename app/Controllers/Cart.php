<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class Cart extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $cartModel = new CartModel();
        $items = $cartModel->select('cart.*, products.name, products.price, products.image')
                          ->join('products', 'products.id = cart.product_id')
                          ->where('user_id', session()->get('id'))
                          ->findAll();

        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $data = [
            'title' => 'Your Shopping Cart - NextCafe',
            'items' => $items,
            'total_price' => $totalPrice
        ];

        return view('cart', $data);
    }

    public function add()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $cartModel = new CartModel();
        
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?? 1;
        $userId = session()->get('id');

        // Check if item already in cart
        $existing = $cartModel->where('user_id', $userId)
                              ->where('product_id', $productId)
                              ->first();

        if ($existing) {
            $cartModel->update($existing['id'], [
                'quantity' => $existing['quantity'] + $quantity
            ]);
        } else {
            $cartModel->save([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Item added to your cart!');
    }

    public function remove($id)
    {
        $cartModel = new CartModel();
        $cartModel->delete($id);
        return redirect()->to('cart')->with('success', 'Item removed from cart.');
    }

    public function increase($id)
    {
        $cartModel = new CartModel();
        $item = $cartModel->find($id);
        if ($item && $item['user_id'] == session()->get('id')) {
            $cartModel->update($id, ['quantity' => $item['quantity'] + 1]);
        }
        return redirect()->to('cart');
    }

    public function decrease($id)
    {
        $cartModel = new CartModel();
        $item = $cartModel->find($id);
        if ($item && $item['user_id'] == session()->get('id')) {
            if ($item['quantity'] > 1) {
                $cartModel->update($id, ['quantity' => $item['quantity'] - 1]);
            } else {
                $cartModel->delete($id);
                return redirect()->to('cart')->with('success', 'Item removed from cart.');
            }
        }
        return redirect()->to('cart');
    }
}
