<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-700 mb-0">Customer Feedback</h5>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reviews)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No reviews found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td class="text-nowrap"><?= date('M d, Y', strtotime($review['created_at'])) ?></td>
                            <td class="fw-600"><?= esc($review['username']) ?></td>
                            <td><?= esc($review['product_name']) ?></td>
                            <td>
                                <div class="text-warning">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi <?= $i <= $review['rating'] ? 'bi-star-fill' : 'bi-star' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 300px;" class="text-truncate" title="<?= esc($review['comment']) ?>">
                                    <?= esc($review['comment']) ?>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                    <a href="<?= base_url('product/' . $review['product_id']) ?>" 
                                       title="View Product" target="_blank"
                                       style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #7c3aed;color:#7c3aed;background:rgba(124,58,237,.08);transition:all .2s;"
                                       onmouseover="this.style.background='#7c3aed';this.style.color='#fff';"
                                       onmouseout="this.style.background='rgba(124,58,237,.08)';this.style.color='#7c3aed';">
                                        <i class="bi bi-eye-fill"></i> View
                                    </a>

                                    <button type="button" 
                                            onclick="confirmDelete(<?= $review['id'] ?>)" 
                                            title="Delete Review"
                                            style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #dc2626;color:#fff;background:#dc2626;transition:all .2s;box-shadow:0 2px 8px rgba(220,38,38,.3);"
                                            onmouseover="this.style.background='#b91c1c';this.style.boxShadow='0 4px 14px rgba(185,28,28,.4)';"
                                            onmouseout="this.style.background='#dc2626';this.style.boxShadow='0 2px 8px rgba(220,38,38,.3)';">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-danger text-white p-4">
                <h5 class="modal-title fw-700">Delete Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-exclamation-triangle display-1 text-danger opacity-25 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Are you sure?</h4>
                <p class="text-muted mb-0">This review will be permanently removed. This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <form id="deleteForm" method="POST">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-700">Delete Permanently</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('deleteForm').action = '<?= base_url('admin/reviews/delete/') ?>' + id;
    modal.show();
}
</script>

<?= $this->endSection() ?>
