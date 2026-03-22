<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
    $wishlistIds = [];
    if (session()->get('isLoggedIn')) {
        $wishlistModel = new \App\Models\WishlistModel();
        $wishlistIds = array_column($wishlistModel->where('user_id', session()->get('id'))->findAll(), 'product_id');
    }
?>

<div class="row g-4 mb-5">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm rounded-5 overflow-hidden position-relative hero-banner" style="background: linear-gradient(135deg, #2D1A12 0%, #1A0B05 100%); min-height: 450px;">
            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
            <div class="card-body p-5 d-flex align-items-center position-relative">
                <div class="col-lg-7 text-white">
                    <span class="badge bg-primary text-white rounded-pill px-3 py-2 mb-4 fw-bold shadow-sm">EST. 2024</span>
                    <h1 class="display-2 fw-800 mb-3 line-height-1">Premium <span class="text-primary">Coffee</span> Experience</h1>
                    <p class="lead mb-5 opacity-75 fw-400 pe-lg-5" style="font-size: 1.25rem;">Discover the perfect blend of tradition and innovation. Our beans are ethically sourced and roasted to perfection for the ultimate coffee enthusiast.</p>
                    <div class="d-flex gap-3">
                        <a href="<?= base_url('menu') ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-lg">Order Now</a>
                        <a href="<?= base_url('about') ?>" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold">Our Story</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <div class="position-relative d-inline-block">
                        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=800" class="img-fluid rounded-4 shadow-2xl floating-img" alt="Coffee Cup" style="width: 380px; transform: rotate(-3deg);">
                        <div class="position-absolute -top-4 -right-4 bg-white p-4 rounded-circle shadow-lg d-flex flex-column align-items-center justify-content-center text-dark" style="width: 110px; height: 110px; transform: rotate(10deg);">
                             <span class="small fw-800 text-muted text-uppercase mb-0">From</span>
                             <div class="text-primary fw-800 fs-3 line-height-1">₱95</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-center justify-content-between mb-4 mt-5">
    <div>
        <h2 class="fw-800 mb-1">Featured Categories</h2>
        <p class="text-muted small fw-600 mb-0">FIND YOUR FAVORITE FLAVORS</p>
    </div>
    <a href="<?= base_url('menu') ?>" class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold">View All <i class="bi bi-arrow-right ms-1"></i></a>
</div>

<div class="row g-4 mb-5">
    <?php foreach ($categories as $cat): ?>
        <div class="col-6 col-md-3">
            <a href="<?= base_url('menu?category=' . $cat['slug']) ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-lift transition-all">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3 mx-auto transition-all category-icon-wrapper">
                        <i class="bi bi-cup-hot fs-3 text-primary"></i>
                    </div>
                    <h6 class="fw-800 mb-0"><?= esc($cat['name']) ?></h6>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex align-items-center justify-content-between mb-4 mt-5">
    <div>
        <h2 class="fw-800 mb-1">Featured Products</h2>
        <p class="text-muted small fw-600 mb-0">OUR MOST POPULAR BREWS</p>
    </div>
    <a href="<?= base_url('menu') ?>" class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold">Full Menu <i class="bi bi-arrow-right ms-1"></i></a>
</div>

<div class="row g-4">
    <?php foreach ($products as $product): ?>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 bg-white p-3 product-card overflow-hidden">
                <div class="position-relative mb-3 overflow-hidden rounded-4" style="height: 200px;">
                    <?php 
                        $image = !empty($product['image']) ? base_url($product['image']) : 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=400';
                    ?>
                    <img src="<?= $image ?>" class="w-100 h-100 object-fit-cover transition-transform duration-500 product-img" alt="<?= esc($product['name']) ?>">
                    <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 transition-all">
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-white rounded-pill px-4 fw-bold shadow-sm">Quick View</a>
                            <a href="<?= base_url('wishlist/toggle/' . $product['id']) ?>" class="btn btn-white rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;">
                                <i class="bi <?= in_array($product['id'], $wishlistIds) ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-800 fs-6 mb-0 text-truncate" style="max-width: 150px;"><?= esc($product['name']) ?></h5>
                        <span class="badge bg-light text-primary small rounded-pill">Popular</span>
                    </div>
                    <p class="text-muted small mb-3">Premium roasted beans</p>
                    <div class="d-flex align-items-center justify-content-between pt-2 mt-auto border-top border-light">
                        <span class="fs-5 fw-800 text-primary">₱<?= number_format($product['price'], 2) ?></span>
                        <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 35px; height: 35px;">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .hero-banner {
        background-size: cover;
        background-position: center;
    }
    .line-height-1 { line-height: 1.1; }
    .floating-img {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px) rotate(-3deg); }
        50% { transform: translateY(-20px) rotate(-1deg); }
        100% { transform: translateY(0px) rotate(-3deg); }
    }
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .category-icon-wrapper {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hover-lift:hover .category-icon-wrapper {
        background-color: var(--primary-coffee) !important;
    }
    .hover-lift:hover .category-icon-wrapper i {
        color: #fff !important;
    }
    .product-card:hover .product-img {
        transform: scale(1.1);
    }
    .product-card:hover .product-overlay {
        opacity: 1;
        background: rgba(0,0,0,0.2);
    }
    .duration-500 { transition-duration: 500ms; }
    .btn-white {
        background: #fff;
        color: var(--text-dark);
        border: none;
    }
    .btn-white:hover {
        background: var(--primary-coffee);
        color: #fff;
    }
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>

<?= $this->endSection() ?>
