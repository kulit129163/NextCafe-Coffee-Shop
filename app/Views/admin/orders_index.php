<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="admin-search">
        <i class="bi bi-search"></i>
        <input type="text" id="orderSearch" placeholder="Search Order ID or Customer..." oninput="filterOrders()">
    </div>
</div>

<div class="admin-card">
    <table class="admin-table" id="ordersTable">
        <thead>
            <tr>
                <th>Orders ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
            <tr>
                <td><strong>#ORD-<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></strong></td>
                <td>
                    <div style="font-weight: 600;"><?= esc(trim(($o['first_name'] ?? '') . ' ' . ($o['last_name'] ?? '')) ?: ($o['username'] ?? 'Unknown')) ?></div>
                    <div style="font-size:0.75rem;color:var(--text-muted);"><?= esc($o['email'] ?? '') ?></div>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;"><?= date('n/j/Y, g:i A', strtotime($o['created_at'])) ?></td>
                <td>—</td>
                <td style="font-weight:700;color:var(--accent);">₱<?= number_format($o['total_amount'], 2) ?></td>
                <td><span class="status-badge status-<?= $o['status'] ?>"><?= ucfirst($o['status']) ?></span></td>
                <td>
                    <a href="<?= base_url('admin/orders/view/' . $o['id']) ?>" class="action-btn view" title="View"><i class="bi bi-eye"></i></a>
                    <?php if (!in_array($o['status'], ['delivered', 'cancelled'])): ?>
                    <form action="<?= base_url('admin/orders/updateStatus/' . $o['id']) ?>" method="POST" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="status" value="delivered">
                        <button type="submit" class="action-btn approve" title="Mark Delivered"><i class="bi bi-check-lg"></i></button>
                    </form>
                    <form action="<?= base_url('admin/orders/updateStatus/' . $o['id']) ?>" method="POST" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="action-btn delete" title="Cancel" onclick="return confirm('Cancel this order?')"><i class="bi bi-x-lg"></i></button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($orders)): ?>
            <tr><td colspan="7" class="text-center py-5" style="color:var(--text-muted);">No orders found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function filterOrders() {
    const q = document.getElementById('orderSearch').value.toLowerCase();
    document.querySelectorAll('#ordersTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>

<?= $this->endSection() ?>
