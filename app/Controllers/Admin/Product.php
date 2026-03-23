<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data = [
            'title'      => 'Product Management - Admin',
            'page_title' => 'Product Management',
            'products'   => $productModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/products_index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        return view('admin/products_form', [
            'title' => 'Add New Product',
            'categories' => $categoryModel->where('status', 'active')->findAll()
        ]);
    }

    public function store()
    {
        $productModel = new ProductModel();
        
        $rules = [
            'category' => 'required',
            'name' => 'required|min_length[3]|max_length[255]',
            'slug' => 'required|is_unique[products.slug]',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'image_file' => 'uploaded[image_file]|max_size[image_file,2048]|is_image[image_file]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image_file');
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/products', $newName);

        $productModel->save([
            'category' => $this->request->getPost('category'),
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'status' => $this->request->getPost('status'),
            'image' => 'uploads/products/' . $newName
        ]);

        return redirect()->to('admin/products')->with('success', 'Product successfully created.');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        
        $product = $productModel->find($id);
        if (!$product) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('admin/products_form', [
            'title' => 'Edit Product',
            'product' => $product,
            'categories' => $categoryModel->where('status', 'active')->findAll()
        ]);
    }

    public function update($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        
        if (!$product) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $rules = [
            'category' => 'required',
            'name' => 'required|min_length[3]|max_length[255]',
            'slug' => "required|is_unique[products.slug,id,{$id}]",
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required'
        ];

        // Only validate image if a new one is uploaded
        $file = $this->request->getFile('image_file');
        if ($file->isValid() && !$file->hasMoved()) {
            $rules['image_file'] = 'max_size[image_file,2048]|is_image[image_file]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataToUpdate = [
            'category' => $this->request->getPost('category'),
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'status' => $this->request->getPost('status')
        ];

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/products', $newName);
            $dataToUpdate['image'] = 'uploads/products/' . $newName;
            
            // Optionally delete old image
            if (!empty($product['image']) && file_exists(FCPATH . $product['image'])) {
                @unlink(FCPATH . $product['image']);
            }
        }

        $productModel->update($id, $dataToUpdate);

        return redirect()->to('admin/products')->with('success', 'Product successfully updated.');
    }

    public function toggleStatus($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $newStatus = ($product['status'] === 'active') ? 'sold_out' : 'active';
        $productModel->update($id, ['status' => $newStatus]);

        $msg = $newStatus === 'active' ? 'Product is now available.' : 'Product marked as sold out.';
        return redirect()->to('admin/products')->with('success', $msg);
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        
        if ($product) {
            try {
                // Delete image if it exists
                if (!empty($product['image']) && file_exists(FCPATH . $product['image'])) {
                    @unlink(FCPATH . $product['image']);
                }
                $productModel->delete($id);
                return redirect()->to('admin/products')->with('success', 'Product successfully deleted.');
            } catch (\Exception $e) {
                return redirect()->to('admin/products')->with('error', 'Cannot delete product because it has been ordered in the past. Mark it as Sold Out instead.');
            }
        }

        return redirect()->to('admin/products')->with('error', 'Product not found.');
    }
}
