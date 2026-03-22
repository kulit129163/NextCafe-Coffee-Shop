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
                    <div class="d-flex gap-2 align-items-center flex-wrap">

                        <!-- View -->
                        <a href="<?= base_url('admin/orders/view/' . $o['id']) ?>"
                           title="View Order"
                           style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #7c3aed;color:#7c3aed;background:rgba(124,58,237,.08);transition:all .2s;"
                           onmouseover="this.style.background='#7c3aed';this.style.color='#fff';"
                           onmouseout="this.style.background='rgba(124,58,237,.08)';this.style.color='#7c3aed';">
                            <i class="bi bi-eye-fill"></i> View
                        </a>

                        <?php if (!in_array($o['status'], ['delivered', 'cancelled'])): ?>

                        <!-- Mark Delivered -->
                        <form action="<?= base_url('admin/orders/updateStatus/' . $o['id']) ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="delivered">
                            <button type="submit"
                                    title="Mark as Delivered"
                                    style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #16a34a;color:#16a34a;background:rgba(22,163,74,.08);transition:all .2s;"
                                    onmouseover="this.style.background='#16a34a';this.style.color='#fff';"
                                    onmouseout="this.style.background='rgba(22,163,74,.08)';this.style.color='#16a34a';">
                                <i class="bi bi-check-circle-fill"></i> Delivered
                            </button>
                        </form>

                        <!-- Cancel -->
                        <form action="<?= base_url('admin/orders/updateStatus/' . $o['id']) ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to cancel this order?')"
                                    title="Cancel Order"
                                    style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #dc2626;color:#fff;background:#dc2626;transition:all .2s;box-shadow:0 2px 8px rgba(220,38,38,.3);"
                                    onmouseover="this.style.background='#b91c1c';this.style.boxShadow='0 4px 14px rgba(185,28,28,.4)';"
                                    onmouseout="this.style.background='#dc2626';this.style.boxShadow='0 2px 8px rgba(220,38,38,.3)';">
                                <i class="bi bi-x-circle-fill"></i> Cancel
                            </button>
                        </form>

                        <?php endif; ?>
                    </div>
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
