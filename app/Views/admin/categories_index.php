<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-end mb-4">
    <a href="<?= base_url('admin/categories/create') ?>" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Add Category
    </a>
</div>

<div class="row g-3">
    <?php foreach ($categories as $category): ?>
    <div class="col-md-4">
        <div class="admin-card" style="position:relative;">
            <i class="bi bi-cup-hot-fill" style="font-size: 1.5rem; color: var(--accent); margin-bottom: 0.75rem; display: block;"></i>
            <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;"><?= esc($category['name']) ?></h3>
            <p style="font-size: 0.78rem; color: var(--text-muted); margin-bottom: 1rem;">
                <?= number_format($category['product_count'] ?? 0) ?> products available
            </p>
            <a href="<?= base_url('admin/categories/edit/' . $category['id']) ?>"
               style="font-size: 0.8rem; font-weight: 600; color: var(--accent); text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; margin-right: 15px;">
                EDIT
            </a>
            <button type="button" 
               onclick="confirmDelete(<?= $category['id'] ?>, '<?= esc(addslashes($category['name'])) ?>')"
               style="font-size: 0.8rem; font-weight: 600; color: #dc2626; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; background: none; border: none; padding: 0; cursor: pointer;">
                DELETE
            </button>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Add New Category Card -->
    <div class="col-md-4">
        <a href="<?= base_url('admin/categories/create') ?>" class="admin-card d-flex flex-column align-items-center justify-content-center text-decoration-none"
           style="min-height: 140px; border: 2px dashed #e0d5ce; cursor: pointer;">
            <i class="bi bi-plus-circle" style="font-size: 1.5rem; color: var(--accent); margin-bottom: 0.5rem;"></i>
            <span style="font-size: 0.85rem; font-weight: 600; color: var(--accent);">Add New Category</span>
        </a>
    </div>
</div>

<?= $this->endSection() ?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-danger text-white p-4">
                <h5 class="modal-title fw-700">Delete Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-exclamation-triangle display-1 text-danger opacity-25 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Are you sure?</h4>
                <p class="text-muted mb-0">You are about to permanently delete the category <strong id="deleteCategoryName"></strong>. If there are any products attached to this category, the deletion will be blocked.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="btn btn-danger rounded-pill px-4 fw-700">Delete Permanently</a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('deleteCategoryName').innerText = name;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url('admin/categories/delete/') ?>' + id;
    modal.show();
}
</script>
