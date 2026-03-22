<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row g-4 mb-5">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm rounded-5 overflow-hidden position-relative" style="background-color: #F5E6DA; min-height: 400px;">
            <div class="card-body p-5 d-flex align-items-center">
                <div class="col-md-7">
                    <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 fw-bold shadow-sm">EXCLUSIVE OFFER</span>
                    <h1 class="display-3 fw-800 mb-3" style="color: #2D1A12;">Get <span class="text-primary">50% Off</span> Your First Coffee</h1>
                    <p class="lead text-muted mb-4 fw-600">Experience the world's finest coffee beans, roasted to perfection and delivered fresh to your door.</p>
                    <a href="<?= base_url('menu') ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow">Explore Menu</a>
                </div>
                <div class="col-md-5 d-none d-md-block text-center position-relative">
                    <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?q=80&w=600" class="img-fluid rounded-circle shadow-lg border border-5 border-white" alt="Coffee" style="width: 300px; height: 300px; object-fit: cover;">
                    <div class="position-absolute top-100 start-0 translate-middle badge bg-white p-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                         <div class="text-primary fw-800 fs-4">₱45</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-center justify-content-between mb-4 mt-5">
    <h3 class="fw-800 mb-0">Featured Categories</h3>
    <a href="<?= base_url('menu') ?>" class="text-primary fw-600 text-decoration-none">View All <i class="bi bi-arrow-right"></i></a>
</div>

<div class="row g-4 mb-5">
    <?php foreach ($categories as $cat): ?>
        <div class="col-6 col-md-3">
            <a href="<?= base_url('menu?category=' . $cat['id']) ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-lift">
                    <div class="bg-light rounded-circle p-3 d-inline-block mb-3 mx-auto">
                        <i class="bi bi-cup-hot fs-3 text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-0"><?= esc($cat['name']) ?></h6>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex align-items-center justify-content-between mb-4 mt-5">
    <h3 class="fw-800 mb-0">Best Sellers</h3>
    <a href="<?= base_url('menu') ?>" class="text-primary fw-600 text-decoration-none">Explore Menu <i class="bi bi-arrow-right"></i></a>
</div>

<div class="row g-4">
    <?php foreach ($products as $product): ?>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 bg-white p-3">
                <div class="position-relative mb-3 overflow-hidden rounded-4" style="height: 180px;">
                    <?php 
                        $image = !empty($product['image']) ? base_url($product['image']) : 'https://via.placeholder.com/300x300?text=Coffee';
                    ?>
                    <img src="<?= $image ?>" class="w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($product['name']) ?>">
                </div>
                <div class="card-body p-0">
                    <h5 class="fw-bold fs-6 mb-1 text-truncate"><?= esc($product['name']) ?></h5>
                    <p class="text-muted small mb-2">Espresso Based</p>
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="fs-5 fw-800 text-primary">₱<?= number_format($product['price'], 2) ?></span>
                        <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-primary rounded-pill btn-sm px-3 py-1">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
</style>

<?= $this->endSection() ?>
