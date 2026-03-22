<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-5 align-items-center">
    <div class="col">
        <h6 class="text-primary fw-800 text-uppercase mb-2">My Saved Items</h6>
        <h2 class="display-5 fw-800 text-dark mb-0">My <span class="text-primary">Wishlist</span></h2>
    </div>
    <div class="col-auto">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-700 shadow-sm"><?= count($wishlist) ?> Items</span>
    </div>
</div>

<?php if (empty($wishlist)): ?>
    <div class="row justify-content-center my-5 py-5">
        <div class="col-md-6 text-center">
            <div class="mb-4 display-1 text-primary opacity-25">
                <i class="bi bi-heart"></i>
            </div>
            <h3 class="fw-800 text-dark mb-3">Your wishlist is empty</h3>
            <p class="text-muted mb-5 px-md-5">Explore our premium selection of coffees and treats, and save your favorites here for later!</p>
            <a href="<?= base_url('menu') ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-800 shadow-sm shadow-hover">Explore Menu</a>
        </div>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($wishlist as $item): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 hover-lift transition-all">
                    <div class="position-relative">
                        <?php $image = !empty($item['product_image']) ? base_url($item['product_image']) : 'https://via.placeholder.com/300x300?text=Coffee'; ?>
                        <img src="<?= $image ?>" 
                             class="card-img-top" 
                             style="height: 220px; object-fit: cover;" 
                             alt="<?= $item['product_name'] ?>">
                        <div class="position-absolute top-0 end-0 p-3">
                            <a href="<?= base_url('wishlist/toggle/' . $item['product_id']) ?>" 
                               class="btn btn-light rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center p-0" 
                               style="width: 40px; height: 40px;"
                               title="Remove from wishlist">
                                <i class="bi bi-heart-fill text-danger"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-800 text-dark mb-0"><?= $item['product_name'] ?></h5>
                            <span class="fw-800 text-primary">₱<?= number_format($item['product_price'], 2) ?></span>
                        </div>
                        <p class="text-muted small mb-4 flex-grow-1"><?= substr($item['product_description'], 0, 80) . '...' ?></p>
                        <hr class="border-light opacity-50 mb-4">
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="<?= base_url('product/' . $item['product_id']) ?>" class="btn btn-outline-dark rounded-pill w-100 py-2 fw-700 small">View Details</a>
                            </div>
                            <div class="col-6">
                                <form action="<?= base_url('cart/add') ?>" method="post">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 fw-800 small shadow-sm">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<style>
.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1) !important;
}
.transition-all {
    transition: all 0.3s ease;
}
</style>
<?= $this->endSection() ?>
