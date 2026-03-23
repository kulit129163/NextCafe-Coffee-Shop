<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'product_id', 'rating', 'comment'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'user_id'    => 'required|integer',
        'product_id' => 'required|integer',
        'rating'     => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
        'comment'    => 'permit_empty|string|max_length[1000]'
    ];

    public function getAverageRating($productId)
    {
        $result = $this->where('product_id', $productId)
                       ->selectAvg('rating', 'average')
                       ->first();
        
        return $result ? round($result['average'], 1) : 0;
    }

    public function getReviewCount($productId)
    {
        return $this->where('product_id', $productId)->countAllResults();
    }

    public function getReviewsWithUser($productId)
    {
        return $this->select('reviews.*, users.username, users.first_name, users.last_name')
                    ->join('users', 'users.id = reviews.user_id')
                    ->where('product_id', $productId)
                    ->orderBy('reviews.created_at', 'DESC')
                    ->findAll();
    }
}
