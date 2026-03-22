<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row g-5">
    <?php if (!empty($items)): ?>
        <div class="col-lg-8">
            <h3 class="fw-800 mb-4">Your Shopping Cart</h3>
            <div class="row g-4">
                <?php foreach ($items as $item): ?>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <?php 
                                        $image = !empty($item['image']) ? base_url($item['image']) : 'https://via.placeholder.com/100x100?text=Coffee';
                                    ?>
                                    <div class="rounded-4 overflow-hidden" style="height: 80px;">
                                        <img src="<?= $image ?>" class="w-100 h-100 object-fit-cover" alt="<?= esc($item['name']) ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-0 text-truncate"><?= esc($item['name']) ?></h6>
                                    <p class="text-muted x-small mb-0">Premium Espresso Blend</p>
                                </div>
                                <div class="col-md-2 text-center text-md-start">
                                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                        <a href="<?= base_url('cart/decrease/' . $item['id']) ?>" class="btn btn-sm btn-light rounded-circle fw-bold px-2 py-1 text-decoration-none">-</a>
                                        <span class="fw-bold mx-3"><?= $item['quantity'] ?></span>
                                        <a href="<?= base_url('cart/increase/' . $item['id']) ?>" class="btn btn-sm btn-light rounded-circle fw-bold px-2 py-1 text-decoration-none">+</a>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <span class="fw-800 text-primary">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="<?= base_url('cart/remove/' . $item['id']) ?>" class="btn btn-light rounded-circle text-danger p-2 hover-shadow">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-4">
                <a href="<?= base_url('menu') ?>" class="btn btn-light rounded-pill px-4 fw-600">
                    <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-5 p-4 bg-white sticky-top" style="top: 2rem;">
                <h4 class="fw-800 mb-4">Order Summary</h4>
                
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-bold">₱<?= number_format($total_price, 2) ?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Estimated Tax</span>
                    <span class="fw-bold">₱0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted">Shipping</span>
                    <span class="text-success fw-bold">Free</span>
                </div>
                
                <hr class="mb-4">
                
                <div class="d-flex justify-content-between mb-5">
                    <h5 class="fw-800">Total</h5>
                    <h5 class="fw-800 text-primary">₱<?= number_format($total_price, 2) ?></h5>
                </div>
                
                <div class="d-grid gap-2">
                    <a href="<?= base_url('checkout') ?>" class="btn btn-primary rounded-pill py-3 fw-bold shadow">
                        Place Order
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <div class="card bg-white p-5 rounded-5 shadow-sm border-0">
                <i class="bi bi-cart-x display-1 text-muted opacity-25 mb-4"></i>
                <h3 class="fw-bold">Your cart is empty</h3>
                <p class="text-muted">Explore our delicious menu and find your favorite coffee!</p>
                <div class="mt-4">
                    <a href="<?= base_url('menu') ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow">Browse Menu</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        background-color: #fff !important;
    }
    .x-small {
        font-size: 0.75rem;
    }
</style>

<?= $this->endSection() ?>
