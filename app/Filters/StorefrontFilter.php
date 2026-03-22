<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class StorefrontFilter implements FilterInterface
{
    /**
     * Prevent Admins from accessing the customer-facing storefront.
     * If an admin tries to access a storefront route, redirect them to their dashboard.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn') && session()->get('role') === 'admin') {
            return redirect()->to(base_url('admin/dashboard'))->with('info', 'Admins are restricted to the dashboard.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
