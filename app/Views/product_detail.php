<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
    $isInWishlist = false;
    if (session()->get('isLoggedIn')) {
        $wishlistModel = new \App\Models\WishlistModel();
        $isInWishlist = $wishlistModel->isInWishlist(session()->get('id'), $product['id']);
    }
?>

<div class="row g-5">
    <!-- Product Image -->
    <div class="col-lg-6">
        <div class="position-sticky" style="top: 2rem;">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden position-relative">
                <?php 
                    $image = !empty($product['image']) ? base_url($product['image']) : 'https://via.placeholder.com/600x600?text=Coffee';
                ?>
                <img src="<?= $image ?>" class="img-fluid w-100 h-100 object-fit-cover" alt="<?= esc($product['name']) ?>" style="min-height: 500px;">
                
                <!-- Favorite Toggle Status -->
                <a href="<?= base_url('wishlist/toggle/' . $product['id']) ?>" 
                   class="btn btn-dark rounded-circle position-absolute bottom-0 end-0 m-4 shadow d-flex align-items-center justify-content-center" 
                   style="width: 50px; height: 50px; background-color: #2D1B14; border: none;"
                   title="<?= $isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' ?>">
                    <i class="bi <?= $isInWishlist ? 'bi-heart-fill text-danger' : 'bi-heart text-white' ?> fs-4"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="col-lg-6">
        <div class="ps-lg-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('menu') ?>" class="text-primary text-decoration-none fw-bold">Menu</a></li>
                    <li class="breadcrumb-item active text-muted fw-600" aria-current="page"><?= esc($product['name']) ?></li>
                </ol>
            </nav>

            <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3 fw-bold shadow-sm text-uppercase letter-spacing-1"><?= esc($product['category'] ?? 'Coffee') ?></span>
            <h1 class="display-4 fw-800 mb-2"><?= esc($product['name']) ?></h1>
            
            <div class="d-flex align-items-center mb-4">
                <div class="text-warning me-2">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <span class="text-muted small fw-600">(124+ Reviews)</span>
            </div>

            <p class="text-muted mb-5 fs-5">
                <?= esc($product['description'] ?? 'Indulge in the rich, aromatic experience of our ' . ($product['name'] ?? 'Selection') . '. Crafted with passion and the finest coffee beans from sustainable farms.') ?>
            </p>

            <form id="customizationForm" action="<?= base_url('cart/add') ?>" method="POST">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" id="base_price" value="<?= $product['price'] ?>">
                
                <!-- Customization Panel -->
                <div class="card border-0 rounded-4 bg-light p-4 mb-5 shadow-sm">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary rounded-circle p-2 me-3 text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-cup-hot-fill small"></i>
                        </div>
                        <h6 class="fw-800 text-uppercase mb-0 small letter-spacing-1">Customize your drink</h6>
                    </div>

                    <!-- Drink Type -->
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-800 text-uppercase mb-2">Drink Type</label>
                        <select name="options[drink_type]" class="form-select border-0 shadow-sm rounded-3 py-2 px-3 fw-600">
                            <option value="Iced">🧊 Iced</option>
                            <option value="Hot">🔥 Hot</option>
                        </select>
                    </div>

                    <!-- Cup Size -->
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-800 text-uppercase mb-2">Cup Size</label>
                        <select name="options[size]" id="cupSize" class="form-select border-0 shadow-sm rounded-3 py-2 px-3 fw-600">
                            <option value="Small (12oz)" data-extra="0">Small (12oz)</option>
                            <option value="Medium (16oz)" data-extra="20">Medium (16oz) +₱20.00</option>
                            <option value="Large (22oz)" data-extra="40">Large (22oz) +₱40.00</option>
                        </select>
                    </div>

                    <!-- Sugar Level -->
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-800 text-uppercase mb-2">Sugar Level</label>
                        <select name="options[sugar_level]" class="form-select border-0 shadow-sm rounded-3 py-2 px-3 fw-600">
                            <option value="100% (Full Sweet)">100% (Full Sweet)</option>
                            <option value="75% (Less Sweet)">75% (Less Sweet)</option>
                            <option value="50% (Half Sweet)">50% (Half Sweet)</option>
                            <option value="25% (Mild)">25% (Mild)</option>
                            <option value="0% (No Sugar)">0% (No Sugar)</option>
                        </select>
                    </div>

                    <!-- Add-ons -->
                    <div>
                        <label class="form-label text-muted small fw-800 text-uppercase mb-3 d-block">Add-ons (Optional)</label>
                        <div class="row g-3">
                            <?php 
                            $addons = [
                                ['id' => 'extra_shot', 'name' => 'Extra Espresso Shot', 'price' => 30],
                                ['id' => 'whipped_cream', 'name' => 'Whipped Cream', 'price' => 20],
                                ['id' => 'caramel_drizzle', 'name' => 'Caramel Drizzle', 'price' => 15],
                                ['id' => 'vanilla_syrup', 'name' => 'Vanilla Syrup', 'price' => 15],
                                ['id' => 'oat_milk', 'name' => 'Oat Milk Sub', 'price' => 25],
                                ['id' => 'choco_drizzle', 'name' => 'Chocolate Drizzle', 'price' => 15],
                            ];
                            foreach ($addons as $addon):
                            ?>
                            <div class="col-md-6">
                                <label class="form-check bg-white p-3 rounded-3 shadow-sm d-flex align-items-center justify-content-between mb-0 pointer border">
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input addon-checkbox me-2 ms-0 mt-0" type="checkbox" name="options[addons][]" value="<?= $addon['name'] ?>" data-price="<?= $addon['price'] ?>" id="addon_<?= $addon['id'] ?>">
                                        <span class="small fw-600 text-dark"><?= $addon['name'] ?></span>
                                    </div>
                                    <span class="text-primary small fw-800">+₱<?= $addon['price'] ?></span>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Price and Add to Cart -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <span class="text-muted small fw-800 text-uppercase d-block mb-1">Total Price</span>
                        <h2 class="text-primary fw-800 mb-0" id="totalPriceDisplay">₱<?= number_format($product['price'], 2) ?></h2>
                    </div>
                    
                    <div class="quantity-container d-flex align-items-center bg-white rounded-pill px-3 py-2 border shadow-sm">
                        <button class="btn btn-link text-dark text-decoration-none py-0 px-2 fs-5" type="button" onclick="updateQty(-1)"><i class="bi bi-dash-lg"></i></button>
                        <input type="number" name="quantity" id="quantityInput" class="form-control bg-transparent border-0 text-center fw-800 px-0 py-0" value="1" min="1" readonly style="width: 40px;">
                        <button class="btn btn-link text-dark text-decoration-none py-0 px-2 fs-5" type="button" onclick="updateQty(1)"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>

                <div class="d-grid gap-3 mb-5">
                    <button type="submit" class="btn btn-dark rounded-pill py-3 fw-bold shadow-lg flex-grow-1 fs-5" style="background-color: #1A0D08; border: none;">
                        <i class="bi bi-cart3 me-2"></i> Add to My Order
                    </button>
                    
                    <div class="text-center mt-2">
                        <a href="<?= base_url('cart') ?>" class="text-primary text-decoration-none fw-700 small text-uppercase letter-spacing-1">
                            Proceed to Cart <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </form>

            <!-- Product Features -->
            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center p-3 bg-white rounded-4 shadow-sm border">
                        <div class="bg-light rounded-circle p-2 me-3 text-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="bi bi-truck fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 small">Fast Delivery</h6>
                            <small class="text-muted smaller">30-45 mins</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center p-3 bg-white rounded-4 shadow-sm border">
                        <div class="bg-light rounded-circle p-2 me-3 text-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="bi bi-award fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 small">Quality Guaranteed</h6>
                            <small class="text-muted smaller">100% Organic</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .rounded-5 { border-radius: 2rem !important; }
    .rounded-4 { border-radius: 1.5rem !important; }
    .pointer { cursor: pointer; }
    .smaller { font-size: 0.75rem; }
    .object-fit-cover { object-fit: cover; }
    
    .form-check-input:checked { 
        background-color: #C68E17; 
        border-color: #C68E17; 
    }
    
    #customizationForm .form-select {
        color: #2D1B14;
        cursor: pointer;
    }
    
    .form-check {
        transition: all 0.2s ease;
    }
    .form-check:hover {
        background-color: #f8f9fa !important;
        border-color: #C68E17 !important;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F285";
        font-family: "bootstrap-icons";
        font-size: 0.7rem;
        vertical-align: middle;
    }
</style>

<script>
    function updateQty(val) {
        const input = document.getElementById('quantityInput');
        let current = parseInt(input.value);
        if (current + val >= 1) {
            input.value = current + val;
            calculateTotal();
        }
    }

    function calculateTotal() {
        const basePrice = parseFloat(document.getElementById('base_price').value);
        const qty = parseInt(document.getElementById('quantityInput').value);
        
        // Size extra
        const sizeSelect = document.getElementById('cupSize');
        const sizeExtra = parseFloat(sizeSelect.options[sizeSelect.selectedIndex].dataset.extra || 0);
        
        // Addons total
        let addonsTotal = 0;
        document.querySelectorAll('.addon-checkbox:checked').forEach(cb => {
            addonsTotal += parseFloat(cb.dataset.price);
        });
        
        const unitPrice = basePrice + sizeExtra + addonsTotal;
        const total = unitPrice * qty;
        
        document.getElementById('totalPriceDisplay').innerText = '₱' + unitPrice.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    document.getElementById('cupSize').addEventListener('change', calculateTotal);
    document.querySelectorAll('.addon-checkbox').forEach(cb => {
        cb.addEventListener('change', calculateTotal);
    });

    // Initial calculation
    document.addEventListener('DOMContentLoaded', calculateTotal);
</script>

<?= $this->endSection() ?>
