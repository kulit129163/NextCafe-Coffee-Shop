<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-5 p-4 text-center bg-white mb-4 overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-25" style="background-color: #1A0B05; z-index: 1;"></div>
            <div class="position-relative" style="z-index: 2; margin-top: 2rem;">
                <img src="https://ui-avatars.com/api/?name=<?= $user['username'] ?>&background=C69276&color=fff&size=128" 
                     class="rounded-circle border border-4 border-white shadow-sm mb-3" width="120" height="120">
                <h4 class="fw-800 mb-1 text-uppercase"><?= $user['username'] ?></h4>
                <p class="text-muted small fw-600 mb-3"><?= $user['email'] ?></p>
                <div class="d-flex justify-content-center gap-2 mb-4">
                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 text-uppercase x-small fw-800">
                        <?= $user['role'] ?>
                    </span>
                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2 text-uppercase x-small fw-800">
                        <?= $user['status'] ?>
                    </span>
                </div>
            </div>
            <div class="border-top pt-4">
                <div class="row g-0">
                    <div class="col-6 border-end">
                        <span class="d-block fw-800 text-dark">Member</span>
                        <span class="text-muted x-small fw-600">Since 2024</span>
                    </div>
                    <div class="col-6">
                        <span class="d-block fw-800 text-dark">Gold</span>
                        <span class="text-muted x-small fw-600">Reward Tier</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white">
            <h6 class="fw-800 mb-4">Account Quick Links</h6>
            <div class="list-group list-group-flush">
                <a href="<?= base_url('orders') ?>" class="list-group-item list-group-item-action border-0 rounded-4 mb-2 py-3 px-3 d-flex align-items-center bg-light">
                    <i class="bi bi-receipt me-3 fs-5 text-primary"></i>
                    <span class="fw-600 small">Order History</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action border-0 rounded-4 mb-2 py-3 px-3 d-flex align-items-center">
                    <i class="bi bi-shield-lock me-3 fs-5 text-muted"></i>
                    <span class="fw-600 small text-muted">Security Settings</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action border-0 rounded-4 mb-2 py-3 px-3 d-flex align-items-center">
                    <i class="bi bi-bell me-3 fs-5 text-muted"></i>
                    <span class="fw-600 small text-muted">Notifications</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-5 p-5 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-800 mb-0">Profile Information</h5>
            </div>
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            
            <form action="<?= base_url('profile/update') ?>" method="POST">
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label x-small fw-800 text-muted mb-2">USERNAME (READ-ONLY)</label>
                        <input type="text" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" value="<?= $user['username'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label x-small fw-800 text-muted mb-2">EMAIL ADDRESS (READ-ONLY)</label>
                        <input type="email" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" value="<?= $user['email'] ?>" readonly>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label x-small fw-800 text-muted mb-2">FIRST NAME</label>
                        <input type="text" name="first_name" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" value="<?= $user['first_name'] ?? '' ?>" placeholder="Enter first name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label x-small fw-800 text-muted mb-2">LAST NAME</label>
                        <input type="text" name="last_name" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" value="<?= $user['last_name'] ?? '' ?>" placeholder="Enter last name">
                    </div>
                </div>
                
                <div class="mb-5 text-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-800 shadow-sm">Save Profile Changes</button>
                </div>
            </form>

            <div class="mt-4 pt-4 border-top">
                <h5 class="fw-800 mb-4">Change Password</h5>
                <form action="<?= base_url('profile/password') ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label class="form-label x-small fw-800 text-muted mb-2">CURRENT PASSWORD</label>
                            <input type="password" name="current_password" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label x-small fw-800 text-muted mb-2">NEW PASSWORD</label>
                            <input type="password" name="new_password" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label x-small fw-800 text-muted mb-2">CONFIRM NEW PASSWORD</label>
                            <input type="password" name="confirm_password" class="form-control bg-light border-0 rounded-pill px-4 py-2 fw-600" required>
                        </div>
                    </div>
                    <div class="mb-4 text-end">
                        <button type="submit" class="btn btn-secondary rounded-pill px-5 py-2 fw-800 shadow-sm">Update Password</button>
                    </div>
                </form>
            </div>
            
            <div class="mt-4 pt-4 border-top">
                <h6 class="fw-800 text-danger mb-3">Danger Zone</h6>
                <p class="small text-muted mb-4 font-italic">Once you delete your account, there is no going back. Please be certain.</p>
                <button class="btn btn-outline-danger rounded-pill px-4 fw-700 small">Delete Account</button>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .x-small { font-size: 0.75rem; }
    .bg-sidebar-coffee { background-color: #1A0B05 !important; }
</style>

<?= $this->endSection() ?>
