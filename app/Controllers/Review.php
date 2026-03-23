<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Review extends BaseController
{
    public function submit()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->back()->with('error', 'You must be logged in to leave a review.');
        }

        $userId = session()->get('id');
        $productId = $this->request->getPost('product_id');
        $rating = $this->request->getPost('rating');
        $comment = $this->request->getPost('comment');

        // Check if user has purchased this product
        $orderModel = new OrderModel();
        $hasPurchased = $orderModel->join('order_items', 'order_items.order_id = orders.id')
                                   ->where('orders.user_id', $userId)
                                   ->where('order_items.product_id', $productId)
                                   ->where('orders.status', 'delivered')
                                   ->countAllResults() > 0;

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'You can only review products you have successfully purchased.');
        }

        // Check if user already reviewed this product
        $reviewModel = new ReviewModel();
        $existingReview = $reviewModel->where('user_id', $userId)
                                      ->where('product_id', $productId)
                                      ->first();

        $data = [
            'user_id'    => $userId,
            'product_id' => $productId,
            'rating'     => $rating,
            'comment'    => $comment
        ];

        if ($existingReview) {
            $reviewModel->update($existingReview['id'], $data);
            $message = 'Your review has been updated!';
        } else {
            $reviewModel->insert($data);
            $message = 'Thank you for your review!';
        }

        return redirect()->back()->with('success', $message);
    }
}
