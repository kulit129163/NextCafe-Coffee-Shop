<?php

namespace App\Controllers;

use App\Models\WishlistModel;
use App\Models\ProductModel;

class Wishlist extends BaseController
{
    protected $wishlistModel;
    protected $productModel;

    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
        $this->productModel = new ProductModel();
    }

    /**
     * Display the wishlist page
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to view your wishlist.');
        }

        $userId = session()->get('id');
        $wishlistItems = $this->wishlistModel->getWishlistWithProducts($userId);

        $data = [
            'title' => 'My Wishlist',
            'wishlist' => $wishlistItems
        ];

        return view('wishlist', $data);
    }

    /**
     * Toggle product in wishlist (AJAX ready)
     */
    public function toggle($productId)
    {
        if (!session()->get('isLoggedIn')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Please login first.']);
            }
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $userId = session()->get('id');
        $existing = $this->wishlistModel->where(['user_id' => $userId, 'product_id' => $productId])->first();

        if ($existing) {
            $this->wishlistModel->delete($existing['id']);
            $status = 'removed';
            $message = 'Product removed from wishlist.';
        } else {
            $this->wishlistModel->insert([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            $status = 'added';
            $message = 'Product added to wishlist.';
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'action' => $status,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove item from wishlist
     */
    public function remove($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $item = $this->wishlistModel->find($id);

        if ($item && $item['user_id'] == $userId) {
            $this->wishlistModel->delete($id);
            return redirect()->to('/wishlist')->with('success', 'Item removed from wishlist.');
        }

        return redirect()->to('/wishlist')->with('error', 'Unable to remove item.');
    }
}
