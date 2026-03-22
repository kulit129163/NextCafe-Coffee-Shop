<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row g-5 align-items-center">
    <!-- Product Image -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
            <?php 
                $image = !empty($product['image']) ? base_url($product['image']) : 'https://via.placeholder.com/600x600?text=Coffee';
            ?>
            <img src="<?= $image ?>" class="img-fluid w-100 h-100 object-fit-cover" alt="<?= esc($product['name']) ?>" style="min-height: 500px;">
        </div>
    </div>

    <!-- Product Details -->
    <div class="col-lg-6">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('menu') ?>" class="text-primary text-decoration-none fw-bold">Menu</a></li>
                <li class="breadcrumb-item active text-muted fw-600" aria-current="page"><?= esc($product['name']) ?></li>
            </ol>
        </nav>

        <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3 fw-bold shadow-sm">PREMIUM CHOICE</span>
        <h1 class="display-4 fw-800 mb-2"><?= esc($product['name']) ?></h1>
        <div class="d-flex align-items-center mb-4">
            <div class="text-warning me-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
            </div>
            <span class="text-muted small fw-600">(120+ Reviews)</span>
        </div>

        <h2 class="text-primary fw-800 mb-4">₱<?= number_format($product['price'], 2) ?></h2>
        
        <p class="lead text-muted mb-5 fw-400">
            <?= esc($product['description'] ?? 'Indulge in the rich, aromatic experience of our ' . ($product['name'] ?? 'Selection') . '. Crafted with passion and the finest coffee beans from sustainable farms.') ?>
        </p>

        <form action="<?= base_url('cart/add') ?>" method="POST" class="mb-5">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="input-group bg-light rounded-pill px-2">
                        <button class="btn btn-link text-dark text-decoration-none py-2" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="bi bi-dash"></i></button>
                        <input type="number" name="quantity" class="form-control bg-transparent border-0 text-center fw-bold px-0 py-2" value="1" min="1" readonly>
                        <button class="btn btn-link text-dark text-decoration-none py-2" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="bi bi-plus"></i></button>
                    </div>
                </div>
                <div class="col-md-9 d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold shadow-sm">
                        <i class="bi bi-cart-plus me-2"></i> Add to Cart
                    </button>
                </div>
            </div>
        </form>

        <div class="row g-4">
            <div class="col-sm-6">
                <div class="d-flex align-items-center p-3 bg-white rounded-4 shadow-sm">
                    <div class="bg-light rounded-circle p-2 me-3 text-primary">
                        <i class="bi bi-truck fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Fast Delivery</h6>
                        <small class="text-muted">30-45 mins</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="d-flex align-items-center p-3 bg-white rounded-4 shadow-sm">
                    <div class="bg-light rounded-circle p-2 me-3 text-primary">
                        <i class="bi bi-award fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Quality Guaranteed</h6>
                        <small class="text-muted">100% Organic</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>

<?= $this->endSection() ?>
