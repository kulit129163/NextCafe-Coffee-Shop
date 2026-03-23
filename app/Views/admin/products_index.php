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
                            <button type="button" 
                               title="Mark as Sold Out"
                               onclick="confirmSoldOut(<?= $product['id'] ?>, '<?= esc(addslashes($product['name'])) ?>')"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #16a34a;color:#16a34a;background:rgba(22,163,74,.08);transition:all .2s;"
                               onmouseover="this.style.background='#16a34a';this.style.color='#fff';"
                               onmouseout="this.style.background='rgba(22,163,74,.08)';this.style.color='#16a34a';">
                                <i class="bi bi-check-circle-fill"></i> Available
                            </button>
                        <?php else: ?>
                            <button type="button" 
                               title="Make Available"
                               onclick="confirmAvailable(<?= $product['id'] ?>, '<?= esc(addslashes($product['name'])) ?>')"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #dc2626;color:#dc2626;background:rgba(220,38,38,.08);transition:all .2s;"
                               onmouseover="this.style.background='#dc2626';this.style.color='#fff';"
                               onmouseout="this.style.background='rgba(220,38,38,.08)';this.style.color='#dc2626';">
                                <i class="bi bi-x-circle-fill"></i> Sold Out
                            </button>
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
                        <button type="button" 
                           title="Delete Product"
                           onclick="confirmDelete(<?= $product['id'] ?>, '<?= esc(addslashes($product['name'])) ?>')"
                           style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #dc2626;color:#fff;background:#dc2626;transition:all .2s;box-shadow:0 2px 8px rgba(220,38,38,.3);"
                           onmouseover="this.style.background='#b91c1c';this.style.boxShadow='0 4px 14px rgba(185,28,28,.4)';"
                           onmouseout="this.style.background='#dc2626';this.style.boxShadow='0 2px 8px rgba(220,38,38,.3)';">
                            <i class="bi bi-trash-fill"></i> Delete
                        </button>
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

<!-- Sold Out Confirmation Modal -->
<div class="modal fade" id="soldOutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-4">
            <div class="modal-header border-0 bg-warning text-dark p-4">
                <h5 class="modal-title fw-700">Mark Product Sold Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-dash-circle display-1 text-warning opacity-50 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Mark as Sold Out?</h4>
                <p class="text-muted mb-0">Are you sure you want to mark <strong><span id="soldOutProductName"></span></strong> as sold out? Customers will not be able to order this item.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="soldOutConfirmBtn" class="btn btn-warning rounded-pill px-4 fw-700">Yes, Mark Sold Out</a>
            </div>
        </div>
    </div>
</div>

<!-- Available Confirmation Modal -->
<div class="modal fade" id="availableModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-4">
            <div class="modal-header border-0 bg-success text-white p-4">
                <h5 class="modal-title fw-700">Mark Product Available</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-check-circle display-1 text-success opacity-50 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Make Available Again?</h4>
                <p class="text-muted mb-0">You are about to make <strong><span id="availableProductName"></span></strong> available for customers to order again.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="availableConfirmBtn" class="btn btn-success rounded-pill px-4 fw-700">Yes, Make Available</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-danger text-white p-4">
                <h5 class="modal-title fw-700">Delete Product</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-exclamation-triangle display-1 text-danger opacity-25 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Are you sure?</h4>
                <p class="text-muted mb-0">You are about to permanently delete <strong><span id="deleteProductName"></span></strong>. This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="btn btn-danger rounded-pill px-4 fw-700">Delete Permanently</a>
            </div>
        </div>
    </div>
</div>

<script>
function filterProducts() {
    const q = document.getElementById('productSearch').value.toLowerCase();
    document.querySelectorAll('#productsTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}

function confirmSoldOut(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('soldOutModal'));
    document.getElementById('soldOutProductName').innerText = name;
    document.getElementById('soldOutConfirmBtn').href = '<?= base_url('admin/products/toggleStatus/') ?>' + id;
    modal.show();
}

function confirmAvailable(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('availableModal'));
    document.getElementById('availableProductName').innerText = name;
    document.getElementById('availableConfirmBtn').href = '<?= base_url('admin/products/toggleStatus/') ?>' + id;
    modal.show();
}

function confirmDelete(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('deleteProductName').innerText = name;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url('admin/products/delete/') ?>' + id;
    modal.show();
}
</script>

<?= $this->endSection() ?>
