<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-800 mb-0">Order #<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></h4>
            <a href="<?= base_url('admin/orders') ?>" class="btn btn-outline-secondary rounded-pill fw-bold small">Back to Orders</a>
        </div>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success rounded-4 border-0 shadow-sm"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger rounded-4 border-0 shadow-sm"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white mb-4">
            <h6 class="fw-800 mb-4">Items Ordered</h6>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="text-muted small text-uppercase">
                        <tr>
                            <th class="border-0">Product</th>
                            <th class="border-0 text-center">Unit Price</th>
                            <th class="border-0 text-center">Qty</th>
                            <th class="border-0 text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php foreach($items as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url($item['product_image']) ?>" class="rounded-3 me-3" style="object-fit: cover; width: 50px; height: 50px;">
                                    <span class="fw-bold"><?= htmlspecialchars($item['product_name']) ?></span>
                                </div>
                            </td>
                            <td class="text-center text-muted">₱<?= number_format($item['price'], 2) ?></td>
                            <td class="text-center fw-bold"><?= $item['quantity'] ?></td>
                            <td class="text-end fw-bold text-primary">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end fw-bold text-muted border-0 pt-4">Grand Total:</td>
                            <td class="text-end fw-900 fs-5 text-dark border-0 pt-4">₱<?= number_format($order['total_amount'], 2) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white mb-4">
            <h6 class="fw-800 mb-4">Customer Details</h6>
            <p class="mb-2"><span class="text-muted small d-block">Name:</span> <span class="fw-bold"><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></span></p>
            <p class="mb-2"><span class="text-muted small d-block">Username:</span> <span class="fw-bold"><?= htmlspecialchars($order['username']) ?></span></p>
            <p class="mb-0"><span class="text-muted small d-block">Email:</span> <span class="fw-bold"><?= htmlspecialchars($order['email']) ?></span></p>
        </div>
        
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white mb-4">
            <h6 class="fw-800 mb-4">Shipping & Payment</h6>
            <p class="mb-3"><span class="text-muted small d-block">Address:</span>
                <strong class="fw-bold"><?= nl2br(htmlspecialchars($order['shipping_address'] ?? 'N/A')) ?></strong>
            </p>
            <p class="mb-0"><span class="text-muted small d-block">Payment Method:</span>
                <strong class="fw-bold"><?= htmlspecialchars($order['payment_method'] ?? 'N/A') ?></strong>
            </p>
        </div>
        
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white">
            <h6 class="fw-800 mb-4">Update Status</h6>
            <form action="<?= base_url('admin/orders/updateStatus/' . $order['id']) ?>" method="POST">
                <div class="mb-3">
                    <select name="status" class="form-select bg-light border-0 rounded-pill py-2 fw-bold px-3">
                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Processing</option>
                        <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                        <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                        <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2">Update Order</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
