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
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <!-- Toggle Status -->
                        <?php if ($product['status'] === 'active'): ?>
                            <a href="<?= base_url('admin/products/toggleStatus/' . $product['id']) ?>"
                               title="Mark as Sold Out"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #16a34a;color:#16a34a;background:rgba(22,163,74,.08);transition:all .2s;"
                               onmouseover="this.style.background='#16a34a';this.style.color='#fff';"
                               onmouseout="this.style.background='rgba(22,163,74,.08)';this.style.color='#16a34a';">
                                <i class="bi bi-check-circle-fill"></i> Available
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('admin/products/toggleStatus/' . $product['id']) ?>"
                               title="Make Available"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #dc2626;color:#dc2626;background:rgba(220,38,38,.08);transition:all .2s;"
                               onmouseover="this.style.background='#dc2626';this.style.color='#fff';"
                               onmouseout="this.style.background='rgba(220,38,38,.08)';this.style.color='#dc2626';">
                                <i class="bi bi-x-circle-fill"></i> Sold Out
                            </a>
                        <?php endif; ?>

                        <!-- Edit -->
                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>"
                           title="Edit Product"
                           style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #2563eb;color:#2563eb;background:rgba(37,99,235,.08);transition:all .2s;"
                           onmouseover="this.style.background='#2563eb';this.style.color='#fff';"
                           onmouseout="this.style.background='rgba(37,99,235,.08)';this.style.color='#2563eb';">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>

                        <!-- Delete -->
                        <a href="<?= base_url('admin/products/delete/' . $product['id']) ?>"
                           title="Delete Product"
                           onclick="return confirm('Are you sure you want to delete <?= esc($product['name']) ?>?')"
                           style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #dc2626;color:#fff;background:#dc2626;transition:all .2s;box-shadow:0 2px 8px rgba(220,38,38,.3);"
                           onmouseover="this.style.background='#b91c1c';this.style.boxShadow='0 4px 14px rgba(185,28,28,.4)';"
                           onmouseout="this.style.background='#dc2626';this.style.boxShadow='0 2px 8px rgba(220,38,38,.3)';">
                            <i class="bi bi-trash-fill"></i> Delete
                        </a>
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
