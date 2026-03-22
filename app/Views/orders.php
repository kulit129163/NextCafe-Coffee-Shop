<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="account-wrapper">
    <div class="account-header mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="account-title">Order History</h2>
                <p class="account-subtitle">All your orders in one place</p>
            </div>
            <a href="<?= base_url('profile') ?>" class="btn-back-link">
                <i class="bi bi-arrow-left me-1"></i> Back to Profile
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Orders List -->
        <div class="col-lg-8">
            <?php if (empty($orders)): ?>
                <div class="account-card">
                    <div class="orders-empty">
                        <i class="bi bi-bag-x"></i>
                        <h6>No Orders Yet</h6>
                        <p>You haven't placed any orders. Start exploring our menu!</p>
                        <a href="<?= base_url('menu') ?>" class="btn-account-primary mt-2">
                            <i class="bi bi-cup-hot me-2"></i>Browse Menu
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="orders-list-standalone">
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <div class="order-card-header">
                            <div class="order-meta">
                                <span class="order-number">#ORD-<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></span>
                                <span class="order-date"><?= date('F j, Y · g:i a', strtotime($order['created_at'])) ?></span>
                            </div>
                            <div class="order-right">
                                <span class="order-status-badge status-<?= strtolower($order['status']) ?>">
                                    <?= ucfirst($order['status']) ?>
                                </span>
                                <span class="order-total">₱<?= number_format($order['total_amount'], 2) ?></span>
                            </div>
                        </div>
                        <div class="order-card-body">
                            <?php foreach ($order['items'] as $item): ?>
                            <div class="order-product-row">
                                <img src="<?= base_url('uploads/products/' . ($item['product_image'] ?: 'default-coffee.jpg')) ?>"
                                     class="order-product-img"
                                     onerror="this.src='https://images.unsplash.com/photo-1541167760496-162955ed8a9f?q=80&w=100&auto=format&fit=crop'"
                                     alt="<?= esc($item['product_name']) ?>">
                                <div class="order-product-info">
                                    <span class="order-product-name"><?= esc($item['product_name']) ?></span>
                                    <?php if(!empty($item['decoded_options'])): ?>
                                    <span class="order-product-opts">
                                        <?= $item['decoded_options']['drink_type'] ?? '' ?>
                                        <?php if(!empty($item['decoded_options']['size'])): ?> · <?= $item['decoded_options']['size'] ?><?php endif; ?>
                                        <?php if(!empty($item['decoded_options']['sugar_level'])): ?> · Sugar: <?= $item['decoded_options']['sugar_level'] ?><?php endif; ?>
                                        <?php if(!empty($item['decoded_options']['addons'])): ?>
                                            <span class="d-block">Add-ons: <?= implode(', ', $item['decoded_options']['addons']) ?></span>
                                        <?php endif; ?>
                                    </span>
                                    <?php endif; ?>
                                    <span class="order-product-qty">Qty: <?= $item['quantity'] ?> × ₱<?= number_format($item['price'], 2) ?></span>
                                </div>
                                <span class="order-product-price">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                            </div>
                            <?php endforeach; ?>
                            <?php if(!empty($order['shipping_address'])): ?>
                            <div class="order-address">
                                <i class="bi bi-geo-alt me-1"></i><?= esc($order['shipping_address']) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar Summary -->
        <div class="col-lg-4">
            <div class="order-summary-card">
                <h6 class="summary-title">Order Summary</h6>
                <div class="summary-row">
                    <span>Total Orders</span>
                    <span class="summary-val"><?= count($orders) ?></span>
                </div>
                <div class="summary-row">
                    <span>Total Spent</span>
                    <span class="summary-val">₱<?= number_format(array_sum(array_column($orders, 'total_amount')), 2) ?></span>
                </div>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">
                <p class="summary-note">Thank you for choosing NextCafe! We appreciate your loyalty.</p>
                <a href="<?= base_url('menu') ?>" class="btn-summary-cta">
                    <i class="bi bi-cup-hot me-2"></i>Order Again
                </a>
            </div>

            <div class="help-card mt-3">
                <h6 class="fw-800 mb-2">Need Help?</h6>
                <p class="text-muted small mb-3">If you have any issues with your orders, reach out to us.</p>
                <a href="<?= base_url('contact') ?>" class="btn-account-primary w-100 justify-content-center">
                    <i class="bi bi-chat-dots me-2"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.account-wrapper { max-width: 1100px; margin: 0 auto; padding-bottom: 3rem; }
.account-header { border-bottom: 2px solid #f0e9e2; padding-bottom: 1rem; }
.account-title { font-size: 1.7rem; font-weight: 800; color: #2D1A12; margin-bottom: 0.2rem; }
.account-subtitle { color: #8D7B74; font-size: 0.85rem; margin: 0; }

.btn-back-link {
    display: inline-flex; align-items: center;
    color: #8D7B74; font-size: 0.85rem; font-weight: 600;
    text-decoration: none; transition: color 0.2s;
}
.btn-back-link:hover { color: #C69276; }

/* Order Cards */
.orders-list-standalone { display: flex; flex-direction: column; gap: 1rem; }
.order-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    overflow: hidden;
}
.order-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.1rem 1.5rem;
    background: #fdfaf8;
    border-bottom: 1px solid #f0e9e2;
}
.order-meta { display: flex; flex-direction: column; }
.order-number { font-weight: 800; font-size: 0.85rem; color: #2D1A12; }
.order-date { font-size: 0.75rem; color: #8D7B74; margin-top: 0.1rem; }
.order-right { display: flex; align-items: center; gap: 1rem; }
.order-total { font-weight: 800; font-size: 0.9rem; color: #C69276; }
.order-status-badge {
    padding: 0.25rem 0.65rem; border-radius: 20px;
    font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
}
.status-delivered, .status-completed { background: #e6faf0; color: #2F855A; }
.status-pending { background: #fff8e6; color: #D4943A; }
.status-processing { background: #ebf5ff; color: #2B6CB0; }
.status-cancelled { background: #fff5f5; color: #c53030; }
.status-shipped { background: #f3ebff; color: #553C9A; }

.order-card-body { padding: 1rem 1.5rem; }
.order-product-row {
    display: flex; align-items: center; gap: 0.85rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f5f0ec;
}
.order-product-row:last-of-type { border-bottom: none; }
.order-product-img { width: 55px; height: 55px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
.order-product-info { flex: 1; display: flex; flex-direction: column; }
.order-product-name { font-weight: 700; font-size: 0.875rem; color: #2D1A12; }
.order-product-opts { font-size: 0.72rem; color: #8D7B74; }
.order-product-qty { font-size: 0.72rem; color: #aaa; }
.order-product-price { font-weight: 700; font-size: 0.875rem; white-space: nowrap; }
.order-address { font-size: 0.78rem; color: #8D7B74; padding-top: 0.75rem; border-top: 1px solid #f0e9e2; margin-top: 0.5rem; }

/* Summary Card */
.order-summary-card {
    background: #1A0B05;
    border-radius: 16px;
    padding: 1.5rem;
    color: #fff;
}
.summary-title { font-weight: 800; font-size: 1rem; margin-bottom: 1.25rem; color: #fff; }
.summary-row { display: flex; justify-content: space-between; margin-bottom: 0.75rem; font-size: 0.85rem; opacity: 0.75; }
.summary-val { font-weight: 800; }
.summary-note { font-size: 0.75rem; opacity: 0.5; margin-bottom: 1rem; }
.btn-summary-cta {
    display: flex; align-items: center; justify-content: center;
    background: #C69276; color: #fff;
    padding: 0.7rem 1.5rem; border-radius: 10px;
    font-size: 0.875rem; font-weight: 700;
    text-decoration: none; transition: background 0.2s; width: 100%;
}
.btn-summary-cta:hover { background: #b07d60; color: #fff; }

.help-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 1.25rem 1.5rem;
}

/* Account Card empty state */
.account-card { background: #fff; border-radius: 20px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); overflow: hidden; }
.orders-empty { display: flex; flex-direction: column; align-items: center; padding: 3rem 2rem; text-align: center; color: #8D7B74; }
.orders-empty i { font-size: 3rem; margin-bottom: 1rem; opacity: 0.3; }
.orders-empty h6 { font-weight: 800; color: #2D1A12; margin-bottom: 0.4rem; }
.orders-empty p { font-size: 0.85rem; }
.btn-account-primary {
    display: inline-flex; align-items: center;
    background: #C69276; color: #fff;
    border: none; border-radius: 12px;
    padding: 0.65rem 1.75rem;
    font-size: 0.875rem; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    font-family: 'Outfit', sans-serif;
    text-decoration: none;
}
.btn-account-primary:hover { background: #b07d60; color: #fff; }

@media (max-width: 768px) {
    .order-card-header { flex-direction: column; align-items: flex-start; gap: 0.5rem; }
    .order-right { gap: 0.5rem; }
}
</style>

<?= $this->endSection() ?>
