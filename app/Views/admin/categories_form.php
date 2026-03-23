<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold"><?= isset($category) ? 'Edit Category' : 'Create Category' ?></h4>
                <a href="<?= base_url('admin/categories') ?>" class="btn btn-light rounded-pill px-4 text-muted border">Back to List</a>
            </div>
            <div class="card-body p-4">
                
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger rounded-4">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php 
                    $action = isset($category) ? base_url('admin/categories/update/' . $category['id']) : base_url('admin/categories/store');
                ?>

                <form action="<?= $action ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-600">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-3 bg-light border-0" id="name" name="name" value="<?= old('name', $category['name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="form-label fw-600">Slug Identifier <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-3 bg-light border-0" id="slug" name="slug" value="<?= old('slug', $category['slug'] ?? '') ?>" placeholder="e.g. cold-brew" required>
                        <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>URL-friendly string. Try to keep it lowercase with no spaces (use hyphens).</div>
                    </div>

                    <?php if (isset($category)): ?>
                    <div class="mb-5">
                        <label for="status" class="form-label fw-600">Status</label>
                        <select class="form-select form-select-lg rounded-3 bg-light border-0" id="status" name="status">
                            <option value="active" <?= (old('status', $category['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= (old('status', $category['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold">
                            <?= isset($category) ? 'Save Changes' : 'Create Category' ?>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
