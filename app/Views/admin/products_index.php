<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-2 flex-wrap" style="font-size: 0.8rem;">
        <input type="text" class="admin-search" id="productSearch" placeholder="Search product..." oninput="filterProducts()" style="min-width:180px;max-width:220px;">
    </div>
    <a href="<?= base_url('admin/products/create') ?>" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Add Product
    </a>
</div>

<div class="admin-card">
    <table class="admin-table" id="productsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($products as $product): ?>
            <tr>
                <td style="color:var(--text-muted);"><?= $i++ ?></td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <img src="<?= base_url(esc($product['image'])) ?>" width="40" height="40" style="border-radius:8px;object-fit:cover;border:1px solid #eee;" onerror="this.src='https://placehold.co/40x40/eee/999?text=?'">
                        <strong><?= esc($product['name']) ?></strong>
                    </div>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= esc($product['description'] ?? '—') ?></td>
                <td>₱<?= number_format($product['price'], 2) ?></td>
                <td><?= esc(ucfirst($product['category'])) ?></td>
                <td>
                    <?php if ($product['status'] === 'active'): ?>
                        <span class="availability-available"><i class="bi bi-check-circle me-1"></i>AVAILABLE</span>
                    <?php else: ?>
                        <span class="availability-sold_out"><i class="bi bi-x-circle me-1"></i>SOLD OUT</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="<?= base_url('admin/products/toggleStatus/' . $product['id']) ?>" class="action-btn <?= $product['status'] === 'active' ? 'delete' : 'approve' ?>" title="<?= $product['status'] === 'active' ? 'Mark Sold Out' : 'Make Available' ?>">
                            <i class="bi <?= $product['status'] === 'active' ? 'bi-x-circle' : 'bi-check-circle' ?>"></i>
                        </a>
                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="action-btn edit" title="Edit"><i class="bi bi-pencil"></i></a>
                        <a href="<?= base_url('admin/products/delete/' . $product['id']) ?>" class="action-btn delete" title="Delete" onclick="return confirm('Delete <?= esc($product['name']) ?>?')"><i class="bi bi-trash"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($products)): ?>
            <tr><td colspan="7" class="text-center py-5" style="color:var(--text-muted);">No products found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function filterProducts() {
    const q = document.getElementById('productSearch').value.toLowerCase();
    document.querySelectorAll('#productsTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>

<?= $this->endSection() ?>
