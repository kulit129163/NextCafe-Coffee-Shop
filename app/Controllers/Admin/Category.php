<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $productModel = new \App\Models\ProductModel();
        
        $categories = $categoryModel->findAll();
        foreach ($categories as &$cat) {
            $cat['product_count'] = $productModel->where('category', $cat['slug'])->countAllResults();
        }
        unset($cat);
        
        $data = [
            'title'         => 'Categories Management - Admin',
            'page_title'    => 'Categories Management',
            'categories'    => $categories
        ];
        return view('admin/categories_index', $data);
    }

    public function create()
    {
        return view('admin/categories_form', ['title' => 'Add Category - Admin Dashboard']);
    }

    public function store()
    {
        $categoryModel = new CategoryModel();
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'slug' => 'required|alpha_dash|is_unique[categories.slug]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $categoryModel->save([
            'name' => $this->request->getPost('name'),
            'slug' => strtolower($this->request->getPost('slug')),
            'status' => 'active'
        ]);

        return redirect()->to('admin/categories')->with('success', 'Category successfully created.');
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if (!$category) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('admin/categories_form', [
            'title' => 'Edit Category',
            'category' => $category
        ]);
    }

    public function update($id)
    {
        $categoryModel = new CategoryModel();
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'slug' => "required|alpha_dash|is_unique[categories.slug,id,{$id}]",
            'status' => 'required|in_list[active,inactive]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
            'slug' => strtolower($this->request->getPost('slug')),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('admin/categories')->with('success', 'Category successfully updated.');
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if (!$category) {
            return redirect()->to('admin/categories')->with('error', 'Category not found.');
        }
        
        $productModel = new \App\Models\ProductModel();
        if ($productModel->where('category', $category['slug'])->countAllResults() > 0) {
            return redirect()->to('admin/categories')->with('error', 'Cannot delete this category because it contains products.');
        }

        $categoryModel->delete($id);
        return redirect()->to('admin/categories')->with('success', 'Category successfully deleted.');
    }
}
