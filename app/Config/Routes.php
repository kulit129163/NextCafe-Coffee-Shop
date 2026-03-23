<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Storefront Routes (Filtered to prevent Admin access)
$routes->group('', ['filter' => 'storefront'], static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'Home::about');
    $routes->get('contact', 'Home::contact');
    $routes->post('contact', 'Home::submitContact');

    // Auth Routes
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::attemptLogin');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::attemptRegister');
    $routes->get('logout', 'Auth::logout');

    // Product/Menu Routes
    $routes->get('menu', 'Product::index');
    $routes->get('product/(:num)', 'Product::view/$1');
    $routes->get('menu/product/(:num)', 'Product::view/$1');
    $routes->post('review/submit', 'Review::submit');

    // Cart Routes
    $routes->get('cart', 'Cart::index');
    $routes->post('cart/add', 'Cart::add');
    $routes->get('cart/remove/(:num)', 'Cart::remove/$1');
    $routes->get('cart/increase/(:num)', 'Cart::increase/$1');
    $routes->get('cart/decrease/(:num)', 'Cart::decrease/$1');

    // Checkout Routes
    $routes->get('checkout', 'Checkout::index');
    $routes->post('checkout/process', 'Checkout::process');

    // Profile/Orders
    $routes->get('profile', 'User::profile');
    $routes->post('profile/update', 'User::updateProfile');
    $routes->post('profile/password', 'User::updatePassword');
    $routes->get('orders', 'User::orders');

    // Wishlist Routes
    $routes->get('wishlist', 'Wishlist::index');
    $routes->get('wishlist/toggle/(:num)', 'Wishlist::toggle/$1');
    $routes->get('wishlist/remove/(:num)', 'Wishlist::remove/$1');
});

// Admin Auth (Unfiltered)
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::attemptLogin');
$routes->get('admin/logout', 'Admin\Auth::logout');

// Admin Routes (Filtered)
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Orders
    $routes->get('orders', 'Admin\Order::index');
    $routes->get('orders/view/(:num)', 'Admin\Order::view/$1');
    $routes->post('orders/updateStatus/(:num)', 'Admin\Order::updateStatus/$1');
    
    // Categories
    $routes->get('categories', 'Admin\Category::index');
    $routes->get('categories/create', 'Admin\Category::create');
    $routes->post('categories/store', 'Admin\Category::store');
    $routes->get('categories/edit/(:num)', 'Admin\Category::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Category::update/$1');
    $routes->get('categories/delete/(:num)', 'Admin\Category::delete/$1');
    
    // Products
    $routes->get('products', 'Admin\Product::index');
    $routes->get('products/create', 'Admin\Product::create');
    $routes->post('products/store', 'Admin\Product::store');
    $routes->get('products/edit/(:num)', 'Admin\Product::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Product::update/$1');
    $routes->get('products/delete/(:num)', 'Admin\Product::delete/$1');
    $routes->get('products/toggleStatus/(:num)', 'Admin\Product::toggleStatus/$1');
    
    // Users
    $routes->get('users', 'Admin\User::index');
    $routes->post('users/updateRole/(:num)', 'Admin\User::updateRole/$1');
    $routes->get('users/toggleStatus/(:num)', 'Admin\User::toggleStatus/$1');
    $routes->get('users/delete/(:num)', 'Admin\User::delete/$1');
});
