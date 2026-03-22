<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $categorySlug = $this->request->getGet('category');
        
        if ($categorySlug) {
            $productModel->where('category', $categorySlug);
        }

        $search = $this->request->getGet('search');
        if ($search) {
            $productModel->like('name', $search);
        }

        $sort = $this->request->getGet('sort');
        switch ($sort) {
            case 'price_asc':
                $productModel->orderBy('price', 'ASC');
                break;
            case 'price_desc':
                $productModel->orderBy('price', 'DESC');
                break;
            case 'name_asc':
                $productModel->orderBy('name', 'ASC');
                break;
            case 'name_desc':
                $productModel->orderBy('name', 'DESC');
                break;
            default:
                $productModel->orderBy('id', 'DESC');
                break;
        }

        $data = [
            'title' => 'Our Menu - NextCafe',
            'products' => $productModel->where('status', 'active')->findAll(),
            'categories' => $categoryModel->where('status', 'active')->findAll(),
            'category_id' => $categorySlug,
            'search_query' => $search,
            'sort_param' => $sort
        ];

        return view('menu', $data);
    }

    public function view($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product || $product['status'] !== 'active') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => ($product['name'] ?? 'Product') . ' - NextCafe',
            'product' => $product
        ];

        return view('product_detail', $data);
    }
}
