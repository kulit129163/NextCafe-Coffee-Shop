<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
    <!-- Category Chips (Horizontal Scroll on Mobile) -->
    <div class="d-flex flex-nowrap overflow-auto pb-2 gap-2 no-scrollbar flex-grow-1">
        <a href="<?= base_url('menu') ?>" class="btn <?= empty($category_id) ? 'btn-primary' : 'btn-light text-muted' ?> rounded-pill px-4 fw-600">
            All Items
        </a>
        <?php foreach ($categories as $cat): ?>
            <a href="<?= base_url('menu?category=' . $cat['slug']) ?>" class="btn <?= ($category_id ?? '') == $cat['slug'] ? 'btn-primary' : 'btn-light text-muted' ?> rounded-pill px-4 fw-600 text-nowrap">
                <?= esc($cat['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>
    
    <!-- Sort Dropdown -->
    <div class="flex-shrink-0">
        <form action="<?= base_url('menu') ?>" method="GET" class="d-inline-block m-0">
            <?php if (!empty($category_id)): ?>
                <input type="hidden" name="category" value="<?= esc($category_id) ?>">
            <?php endif; ?>
            <?php if (!empty($search_query)): ?>
                <input type="hidden" name="search" value="<?= esc($search_query) ?>">
            <?php endif; ?>
            <select name="sort" class="form-select bg-light border-0 fw-bold rounded-pill ps-4 pe-5 py-2 shadow-sm" onchange="this.form.submit()">
                <option value="">Sort By</option>
                <option value="price_asc" <?= ($sort_param ?? '') == 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                <option value="price_desc" <?= ($sort_param ?? '') == 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                <option value="name_asc" <?= ($sort_param ?? '') == 'name_asc' ? 'selected' : '' ?>>Name: A to Z</option>
                <option value="name_desc" <?= ($sort_param ?? '') == 'name_desc' ? 'selected' : '' ?>>Name: Z to A</option>
            </select>
        </form>
    </div>
</div>

<div class="row g-4">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 shadow-sm border-0 bg-white p-3">
                    <div class="position-relative mb-3 overflow-hidden rounded-4" style="height: 200px;">
                        <?php 
                            $image = !empty($product['image']) ? base_url($product['image']) : 'https://via.placeholder.com/300x300?text=Coffee';
                        ?>
                        <img src="<?= $image ?>" class="w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($product['name']) ?>">
                    </div>
                    <div class="card-body p-0 d-flex flex-column">
                        <h5 class="fw-bold fs-6 mb-1 text-truncate"><?= esc($product['name']) ?></h5>
                        <p class="text-muted small mb-3 flex-grow-1 line-clamp-2">
                            <?= esc($product['description'] ?? 'No description available.') ?>
                        </p>
                        <div class="d-flex align-items-center justify-content-between mt-auto pt-2">
                            <span class="fs-5 fw-800 text-primary">₱<?= number_format($product['price'], 2) ?></span>
                            <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-primary rounded-pill btn-sm px-3 py-1">
                                View Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <div class="card bg-white p-5 rounded-5 shadow-sm border-0">
                <i class="bi bi-search display-1 text-muted opacity-25 mb-4"></i>
                <h3 class="fw-bold">No items found</h3>
                <p class="text-muted">We couldn't find any coffee matching your search.</p>
                <div class="mt-4">
                    <a href="<?= base_url('menu') ?>" class="btn btn-primary rounded-pill px-5">Refresh Menu</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .transition-transform:hover {
        transform: scale(1.05);
    }
</style>

<?= $this->endSection() ?>
