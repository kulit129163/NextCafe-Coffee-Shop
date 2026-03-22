<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">₱<?= number_format($totalRevenue, 2) ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-receipt"></i></div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value"><?= $totalOrders ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            <div class="stat-label">Menu Products</div>
            <div class="stat-value"><?= $totalProducts ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value"><?= $totalUsers ?></div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 style="font-size: 1rem; font-weight: 700;">Recent Orders</h2>
        <a href="<?= base_url('admin/orders') ?>" style="font-size: 0.8rem; color: var(--accent); text-decoration: none;">View All</a>
    </div>
    <?php if (empty($recentOrders)): ?>
        <p class="text-muted text-center py-4" style="font-size: 0.875rem;">No orders yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <tbody>
                <?php foreach ($recentOrders as $order): ?>
                <tr onclick="window.location='<?= base_url('admin/orders/view/' . $order['id']) ?>'" style="cursor:pointer;">
                    <td style="width: 50px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: <?= $order['status'] === 'delivered' || $order['status'] === 'completed' ? '#E6FAF0' : '#FFF8E6' ?>; display: flex; align-items: center; justify-content: center;">
                            <i class="bi <?= in_array($order['status'], ['delivered', 'completed']) ? 'bi-check-circle-fill' : 'bi-clock-fill' ?>" style="font-size: 0.85rem; color: <?= in_array($order['status'], ['delivered', 'completed']) ? '#2F855A' : '#D4943A' ?>"></i>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 600; font-size: 0.875rem;">#ORD-<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);"><?= date('n/j/Y, g:i A', strtotime($order['created_at'])) ?></div>
                    </td>
                    <td style="text-align: right; font-weight: 700; color: var(--accent);">₱<?= number_format($order['total_amount'], 2) ?></td>
                    <td style="text-align: right; width: 100px;">
                        <span class="status-badge status-<?= $order['status'] ?>"><?= strtoupper($order['status']) ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
