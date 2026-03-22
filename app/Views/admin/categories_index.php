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
               style="font-size: 0.8rem; font-weight: 600; color: var(--accent); text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">
                EDIT
            </a>
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
