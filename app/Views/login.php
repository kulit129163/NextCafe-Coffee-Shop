<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>

<div class="card border-0 shadow-lg rounded-5 p-4 p-md-5 bg-white">
    <div class="text-center mb-5">
        <div class="bg-light rounded-circle p-3 d-inline-block mb-3">
            <i class="bi bi-person-lock fs-1 text-primary"></i>
        </div>
        <h2 class="fw-800">Welcome Back</h2>
        <p class="text-muted">Login to your NextCafe account</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 rounded-4 small py-2">
            <i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-4 small py-2">
            <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="POST">
        <div class="mb-4">
            <label class="form-label small fw-bold text-muted">USERNAME OR EMAIL</label>
            <div class="input-group bg-light rounded-pill px-3">
                <span class="input-group-text bg-transparent border-0"><i class="bi bi-person text-muted"></i></span>
                <input type="text" name="login" class="form-control bg-transparent border-0 py-2" placeholder="Enter your username or email" required>
            </div>
        </div>
        
        <div class="mb-5">
            <div class="d-flex justify-content-between">
                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                <a href="#" class="small text-primary text-decoration-none fw-bold">Forgot?</a>
            </div>
            <div class="input-group bg-light rounded-pill px-3">
                <span class="input-group-text bg-transparent border-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="password" class="form-control bg-transparent border-0 py-2" placeholder="Enter your password" required>
            </div>
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold shadow-sm">Sign In</button>
        </div>

        <div class="text-center">
            <p class="small text-muted mb-0">Don't have an account? <a href="<?= base_url('register') ?>" class="text-primary fw-bold text-decoration-none">Create Account</a></p>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
