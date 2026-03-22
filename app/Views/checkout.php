<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row g-5">
    <div class="col-lg-8">
        <h3 class="fw-800 mb-4">Checkout</h3>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger rounded-4 border-0 shadow-sm"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('checkout/process') ?>" method="POST" id="checkout-form">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <h5 class="fw-bold mb-4">Shipping Information</h5>
                <div class="mb-3">
                    <label class="form-label fw-600">Full Name</label>
                    <input type="text" class="form-control rounded-pill px-3 py-2" value="<?= esc(session()->get('username') ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-600">Shipping Address</label>
                    <textarea name="shipping_address" class="form-control rounded-4 px-3 py-2" rows="3" placeholder="123 Coffee Street, City, Zip Code" required></textarea>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h5 class="fw-bold mb-4">Payment Method</h5>
                <div class="form-check mb-3 p-3 border rounded-4 bg-light">
                    <input class="form-check-input ms-2 mt-2" type="radio" name="payment_method" id="payment1" value="Cash on Delivery" checked>
                    <label class="form-check-label px-3 w-100 fw-600" for="payment1">
                        Cash on Delivery (COD)
                    </label>
                </div>
                <div class="form-check mb-3 p-3 border rounded-4 bg-light">
                    <input class="form-check-input ms-2 mt-2" type="radio" name="payment_method" id="payment2" value="credit_card" disabled>
                    <label class="form-check-label px-3 w-100 fw-600 text-muted" for="payment2">
                        Credit Card (Coming Soon)
                    </label>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-lg rounded-5 p-4 bg-white sticky-top" style="top: 2rem;">
            <h4 class="fw-800 mb-4">Order Summary</h4>
            
            <ul class="list-unstyled mb-4">
                <?php foreach ($items as $item): ?>
                <li class="mb-3 pb-3 border-bottom border-light">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="my-0 fw-bold"><?= esc($item['product_name']) ?></h6>
                            <div class="text-muted smaller mt-1">
                                <?php if (!empty($item['decoded_options'])): ?>
                                    <span class="d-block"><?= $item['decoded_options']['drink_type'] ?? 'Iced' ?> | <?= $item['decoded_options']['size'] ?? 'Small' ?></span>
                                    <span class="d-block">Sugar: <?= $item['decoded_options']['sugar_level'] ?? '100%' ?></span>
                                    <?php if (!empty($item['decoded_options']['addons'])): ?>
                                        <span class="d-block">Add-ons: <?= implode(', ', $item['decoded_options']['addons']) ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="d-block mt-1">Qty: <?= $item['quantity'] ?></span>
                            </div>
                        </div>
                        <span class="fw-bold">₱<?= number_format($item['item_total'], 2) ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>

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
                <button type="button" onclick="document.getElementById('checkout-form').submit();" class="btn btn-primary rounded-pill py-3 fw-bold shadow">
                    Confirm Order
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
