<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table            = 'wishlist';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'product_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get user's wishlist with product details
     */
    public function getWishlistWithProducts($userId)
    {
        return $this->select('wishlist.*, products.name as product_name, products.price as product_price, products.image as product_image, products.description as product_description')
                    ->join('products', 'products.id = wishlist.product_id')
                    ->where('wishlist.user_id', $userId)
                    ->findAll();
    }

    /**
     * Check if product is in user's wishlist
     */
    public function isInWishlist($userId, $productId)
    {
        return $this->where(['user_id' => $userId, 'product_id' => $productId])->first() !== null;
    }
}
