<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-8">
        <?php if (empty($orders)): ?>
            <div class="card border-0 shadow-sm rounded-5 p-5 text-center bg-white mb-4">
                <div class="mb-4">
                    <i class="bi bi-receipt text-light-coffee display-1 opacity-25"></i>
                </div>
                <h3 class="fw-800">No Orders Yet</h3>
                <p class="text-muted mb-4 text-uppercase small fw-600">Seems like you haven't placed any orders yet. Start exploring our menu!</p>
                <div>
                    <a href="<?= base_url('menu') ?>" class="btn btn-primary rounded-pill px-5 py-3">Browse Menu</a>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="card border-0 shadow-sm rounded-5 mb-4 overflow-hidden bg-white">
                    <div class="card-header bg-light bg-opacity-50 border-0 p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted x-small fw-800 text-uppercase d-block mb-1">Order #<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></span>
                            <span class="small fw-600 text-dark"><?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></span>
                        </div>
                        <div class="text-end">
                            <span class="badge rounded-pill px-3 py-2 text-uppercase 
                                <?php 
                                    if ($order['status'] == 'delivered') echo 'bg-success bg-opacity-10 text-success';
                                    elseif ($order['status'] == 'pending') echo 'bg-warning bg-opacity-10 text-warning';
                                    elseif ($order['status'] == 'cancelled') echo 'bg-danger bg-opacity-10 text-danger';
                                    else echo 'bg-primary bg-opacity-10 text-primary';
                                ?>">
                                <?= $order['status'] ?>
                            </span>
                            <span class="d-block mt-1 fw-800 text-primary">₱<?= number_format($order['total_amount'], 2) ?></span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom border-light">
                                <div class="flex-shrink-0">
                                    <img src="<?= base_url('uploads/products/' . ($item['product_image'] ?: 'default-coffee.jpg')) ?>" 
                                         class="rounded-4 object-fit-cover" width="60" height="60" 
                                         onerror="this.src='https://images.unsplash.com/photo-1541167760496-162955ed8a9f?q=80&w=200&auto=format&fit=crop'">
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 fw-700"><?= $item['product_name'] ?></h6>
                                    <span class="x-small text-muted fw-600 text-uppercase">Qty: <?= $item['quantity'] ?> &times; ₱<?= number_format($item['price'], 2) ?></span>
                                </div>
                                <div class="text-end">
                                    <span class="fw-700">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                <i class="bi bi-geo-alt me-1"></i> <?= $order['shipping_address'] ?>
                            </div>
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-700">Order Details</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-sidebar-coffee text-white mb-4">
            <h5 class="fw-800 mb-4">Order Summary</h5>
            <div class="d-flex justify-content-between mb-3 small opacity-75">
                <span>Total Orders</span>
                <span class="fw-800"><?= count($orders) ?></span>
            </div>
            <div class="d-flex justify-content-between mb-4 small opacity-75">
                <span>Total Spent</span>
                <span class="fw-800">₱<?= number_format(array_sum(array_column($orders, 'total_amount')), 2) ?></span>
            </div>
            <hr class="opacity-10">
            <p class="x-small fw-600 opacity-50 mb-0">Track all your coffee adventures here. We appreciate your loyalty!</p>
        </div>
        
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white">
            <h6 class="fw-800 mb-3">Questions?</h6>
            <p class="small text-muted mb-4">If you have any issues with your orders, please reach out to our support team.</p>
            <a href="#" class="btn btn-primary rounded-pill w-100 py-3 fw-700 shadow-sm">Contact Support</a>
        </div>
    </div>
</div>

<style>
    .bg-sidebar-coffee { background-color: #1A0B05 !important; }
    .text-light-coffee { color: #C69276 !important; }
    .fw-700 { font-weight: 700; }
    .object-fit-cover { object-fit: cover; }
    .x-small { font-size: 0.75rem; }
</style>

<?= $this->endSection() ?>
