<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewModel;

class Review extends BaseController
{
    public function index()
    {
        $reviewModel = new ReviewModel();
        
        $data = [
            'title' => 'Manage Reviews - NextCafe Admin',
            'page_title' => 'Product Reviews',
            'reviews' => $reviewModel->select('reviews.*, users.username, products.name as product_name')
                                     ->join('users', 'users.id = reviews.user_id')
                                     ->join('products', 'products.id = reviews.product_id')
                                     ->orderBy('reviews.created_at', 'DESC')
                                     ->findAll()
        ];

        return view('admin/reviews_index', $data);
    }

    public function delete($id)
    {
        $reviewModel = new ReviewModel();
        
        if ($reviewModel->delete($id)) {
            return redirect()->to(base_url('admin/reviews'))->with('success', 'Review deleted successfully.');
        }

        return redirect()->to(base_url('admin/reviews'))->with('error', 'Failed to delete review.');
    }
}
