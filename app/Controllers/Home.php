<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $data = [
            'title' => 'Welcome to NextCafe - Finest Brewed Coffee',
            'products' => $productModel->limit(4)->find(),
            'categories' => $categoryModel->findAll(),
            'search_query' => ''
        ];

        return view('home', $data);
    }

    public function about()
    {
        return view('about', ['title' => 'About Us - NextCafe']);
    }

    public function contact()
    {
        return view('contact', ['title' => 'Contact Us - NextCafe']);
    }

    public function submitContact()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'subject' => 'required|min_length[5]|max_length[150]',
            'message' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = \Config\Services::email();
        $email->setTo('support@nextcafe.com');
        $email->setReplyTo($this->request->getPost('email'), $this->request->getPost('name'));
        $email->setSubject('Support Request: ' . $this->request->getPost('subject'));
        
        $message = '<div style="font-family: Arial, sans-serif; padding: 20px;">';
        $message .= '<h3 style="color: #C69276; border-bottom: 2px solid #eee; padding-bottom: 10px;">New Contact Message</h3>';
        $message .= '<p><strong>From:</strong> ' . esc($this->request->getPost('name')) . ' (' . esc($this->request->getPost('email')) . ')</p>';
        $message .= '<p><strong>Message:</strong><br><br>' . nl2br(esc($this->request->getPost('message'))) . '</p>';
        $message .= '</div>';

        $email->setMessage($message);
        
        if ($email->send()) {
            return redirect()->back()->with('success', 'Thank you! Your message has been sent to our support team.');
        } else {
            // For production, maybe log $email->printDebugger(['headers'])
            return redirect()->back()->with('error', 'Sorry, there was a problem dispatching your email. Please try again later.');
        }
    }
}
