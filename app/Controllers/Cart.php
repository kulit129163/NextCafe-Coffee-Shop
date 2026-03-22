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
        $items = $cartModel->select('cart.*, products.name as product_name, products.price as product_price, products.image as product_image')
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
        $options = $this->request->getPost('options');
        $optionsJson = $options ? json_encode($options) : null;
        $userId = session()->get('id');

        $productModel = new ProductModel();
        $product = $productModel->find($productId);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Calculate unit price based on options
        $unitPrice = $product['price'];
        
        if ($options) {
            // Size extras
            if (isset($options['size'])) {
                if ($options['size'] == 'Medium (16oz)') $unitPrice += 20;
                if ($options['size'] == 'Large (22oz)') $unitPrice += 40;
            }
            
            // Addons extras
            if (isset($options['addons']) && is_array($options['addons'])) {
                $addonPrices = [
                    'Extra Espresso Shot' => 30,
                    'Whipped Cream' => 20,
                    'Caramel Drizzle' => 15,
                    'Vanilla Syrup' => 15,
                    'Oat Milk Sub' => 25,
                    'Chocolate Drizzle' => 15,
                ];
                foreach ($options['addons'] as $addonName) {
                    if (isset($addonPrices[$addonName])) {
                        $unitPrice += $addonPrices[$addonName];
                    }
                }
            }
        }

        // Check if item with same options already in cart
        $existing = $cartModel->where('user_id', $userId)
                              ->where('product_id', $productId)
                              ->where('options', $optionsJson)
                              ->first();

        if ($existing) {
            $cartModel->update($existing['id'], [
                'quantity' => $existing['quantity'] + $quantity
            ]);
        } else {
            $cartModel->save([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'options' => $optionsJson
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
