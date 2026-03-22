<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold"><?= isset($product) ? 'Edit Coffee Product' : 'Add New Coffee' ?></h4>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-light rounded-pill px-4 text-muted border">
                    <i class="bi bi-arrow-left me-2"></i> Back to Inventory
                </a>
            </div>
            <div class="card-body p-4">
                
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger rounded-4 shadow-sm border-0 border-start border-danger border-4">
                        <ul class="mb-0 fw-600">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php 
                    $action = isset($product) ? base_url('admin/products/update/' . $product['id']) : base_url('admin/products/store');
                ?>

                <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="name" class="form-label fw-800 text-uppercase small text-muted">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg rounded-3 bg-light border-0 fw-bold" id="name" name="name" value="<?= old('name', $product['name'] ?? '') ?>" placeholder="e.g. Caramel Macchiato" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-800 text-uppercase small text-muted">Rich Description <span class="text-danger">*</span></label>
                                <textarea class="form-control rounded-3 bg-light border-0" id="description" name="description" rows="5" placeholder="Describe the flavor profile, roast, and origin..." required><?= old('description', $product['description'] ?? '') ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="form-label fw-800 text-uppercase small text-muted">Price (₱) <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-lg border-0 bg-light rounded-3 overflow-hidden">
                                        <span class="input-group-text border-0 bg-transparent text-primary fw-bold">₱</span>
                                        <input type="number" step="0.01" class="form-control border-0 bg-transparent px-1 fw-bold" id="price" name="price" value="<?= old('price', $product['price'] ?? '') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="slug" class="form-label fw-800 text-uppercase small text-muted">URL Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg rounded-3 bg-light border-0 fw-bold" id="slug" name="slug" value="<?= old('slug', $product['slug'] ?? '') ?>" placeholder="e.g. cold-brew" required>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-4">
                            
                            <div class="mb-4 p-4 bg-light rounded-4 border">
                                <label class="form-label fw-800 text-uppercase small text-muted d-block mb-3">Product Image <?= !isset($product) ? '<span class="text-danger">*</span>' : '' ?></label>
                                
                                <?php if (isset($product) && !empty($product['image'])): ?>
                                    <img src="<?= base_url(esc($product['image'])) ?>" class="img-fluid rounded-3 mb-3 shadow-sm w-100 object-fit-cover" style="height: 200px;" alt="Current Image">
                                <?php endif; ?>

                                <input class="form-control form-control-sm" type="file" id="image_file" name="image_file" accept="image/*" <?= !isset($product) ? 'required' : '' ?>>
                                <div class="form-text mt-2 small text-muted">Max size: 2MB. JPG, PNG only. Square ratio recommended.</div>
                            </div>

                            <div class="mb-4">
                                <label for="category" class="form-label fw-800 text-uppercase small text-muted">Category <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg rounded-3 bg-light border-0 fw-bold" id="category" name="category" required>
                                    <option value="" disabled <?= empty($product) ? 'selected' : '' ?>>Choose category...</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= esc($cat['slug']) ?>" <?= (old('category', $product['category'] ?? '') == $cat['slug']) ? 'selected' : '' ?>>
                                            <?= esc($cat['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-800 text-uppercase small text-muted">Status <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg rounded-3 bg-light border-0 fw-bold" id="status" name="status" required>
                                    <option value="active" <?= (old('status', $product['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active (Visible)</option>
                                    <option value="inactive" <?= (old('status', $product['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Hidden)</option>
                                </select>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-800 text-uppercase fs-6 py-3">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <?= isset($product) ? 'Save Details' : 'Publish Product' ?>
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
