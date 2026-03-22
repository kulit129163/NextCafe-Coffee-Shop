<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>

<div class="card border-0 shadow-lg rounded-5 p-4 p-md-5 bg-white">
    <div class="text-center mb-5">
        <div class="bg-light rounded-circle p-3 d-inline-block mb-3">
            <i class="bi bi-person-plus fs-1 text-primary"></i>
        </div>
        <h2 class="fw-800">Create Account</h2>
        <p class="text-muted">Join the NextCafe community today</p>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger border-0 rounded-4 small py-2">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('register') ?>" method="POST">
        <div class="mb-4">
            <label class="form-label small fw-bold text-muted">USERNAME</label>
            <div class="input-group bg-light rounded-pill px-3">
                <span class="input-group-text bg-transparent border-0"><i class="bi bi-person text-muted"></i></span>
                <input type="text" name="username" class="form-control bg-transparent border-0 py-2" placeholder="Choose a username" value="<?= old('username') ?>" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-muted">EMAIL ADDRESS</label>
            <div class="input-group bg-light rounded-pill px-3">
                <span class="input-group-text bg-transparent border-0"><i class="bi bi-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control bg-transparent border-0 py-2" placeholder="Enter your email" value="<?= old('email') ?>" required>
            </div>
        </div>
        
        <div class="mb-5">
            <label class="form-label small fw-bold text-muted">PASSWORD</label>
            <div class="input-group bg-light rounded-pill px-3">
                <span class="input-group-text bg-transparent border-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="password" class="form-control bg-transparent border-0 py-2" placeholder="Create a strong password" required>
            </div>
            <p class="x-small text-muted mt-2 px-3">Must be at least 8 characters long.</p>
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold shadow-sm">Create My Account</button>
        </div>

        <div class="text-center">
            <p class="small text-muted mb-0">Already have an account? <a href="<?= base_url('login') ?>" class="text-primary fw-bold text-decoration-none">Sign In</a></p>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
