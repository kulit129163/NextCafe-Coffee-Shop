<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="account-wrapper">
    <!-- Page Header -->
    <div class="account-header mb-4">
        <h2 class="account-title">My Account</h2>
        <p class="account-subtitle">Manage your profile, password, and order history</p>
    </div>

    <div class="row g-4">
        <!-- LEFT: Profile Card -->
        <div class="col-lg-3">
            <div class="profile-sidebar-card mb-4">
                <div class="profile-banner"></div>
                <div class="profile-avatar-wrap">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['username']) ?>&background=C69276&color=fff&size=128"
                         class="profile-avatar" alt="Avatar">
                </div>
                <div class="profile-info-text">
                    <h5 class="profile-name"><?= esc($user['username']) ?></h5>
                    <p class="profile-email"><?= esc($user['email']) ?></p>
                    <span class="profile-role-badge"><?= ucfirst(esc($user['role'])) ?></span>
                </div>
                <div class="profile-stats">
                    <div class="profile-stat">
                        <span class="stat-num"><?= count($orders ?? []) ?></span>
                        <span class="stat-label">Orders</span>
                    </div>
                    <div class="profile-stat border-start">
                        <span class="stat-num">₱<?= number_format(array_sum(array_column($orders ?? [], 'total_amount')), 0) ?></span>
                        <span class="stat-label">Spent</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="account-nav-card">
                <a href="#profile" class="account-nav-link active" data-tab="profile">
                    <i class="bi bi-person-fill"></i>
                    <span>Profile Info</span>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>
                <a href="#security" class="account-nav-link" data-tab="security">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Security</span>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>
                <a href="#orders" class="account-nav-link" data-tab="orders">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span>Order History</span>
                    <?php if(!empty($orders)): ?>
                    <span class="order-count-badge ms-auto"><?= count($orders) ?></span>
                    <?php else: ?>
                    <i class="bi bi-chevron-right ms-auto"></i>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <!-- RIGHT: Tab Content -->
        <div class="col-lg-9">
            <!-- Flash Messages -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="account-alert account-alert-success mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="account-alert account-alert-error mb-4">
                    <i class="bi bi-exclamation-circle-fill me-2"></i><?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- TAB: Profile Info -->
            <div id="tab-profile" class="account-tab active">
                <div class="account-card">
                    <div class="account-card-header">
                        <div class="account-card-icon"><i class="bi bi-person-fill"></i></div>
                        <div>
                            <h5 class="account-card-title">Profile Information</h5>
                            <p class="account-card-subtitle">Update your personal details</p>
                        </div>
                    </div>
                    <form action="<?= base_url('profile/update') ?>" method="POST" class="account-form">
                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label-styled">USERNAME</label>
                                <input type="text" class="form-field-styled" value="<?= esc($user['username']) ?>" readonly>
                                <span class="field-hint">Username cannot be changed</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label-styled">EMAIL ADDRESS</label>
                                <input type="email" class="form-field-styled" value="<?= esc($user['email']) ?>" readonly>
                                <span class="field-hint">Contact support to change your email</span>
                            </div>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label-styled">FIRST NAME</label>
                                <input type="text" name="first_name" class="form-field-styled editable"
                                       value="<?= esc($user['first_name'] ?? '') ?>" placeholder="Enter first name">
                            </div>
                            <div class="form-group">
                                <label class="form-label-styled">LAST NAME</label>
                                <input type="text" name="last_name" class="form-field-styled editable"
                                       value="<?= esc($user['last_name'] ?? '') ?>" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-account-primary">
                                <i class="bi bi-check-lg me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TAB: Security -->
            <div id="tab-security" class="account-tab">
                <div class="account-card">
                    <div class="account-card-header">
                        <div class="account-card-icon"><i class="bi bi-shield-lock-fill"></i></div>
                        <div>
                            <h5 class="account-card-title">Change Password</h5>
                            <p class="account-card-subtitle">Keep your account secure with a strong password</p>
                        </div>
                    </div>
                    <form action="<?= base_url('profile/password') ?>" method="POST" class="account-form">
                        <div class="form-group">
                            <label class="form-label-styled">CURRENT PASSWORD</label>
                            <div class="password-input-wrap">
                                <input type="password" name="current_password" id="currentPass" class="form-field-styled editable" 
                                       placeholder="Enter your current password" required>
                                <button type="button" class="toggle-pass" onclick="togglePass('currentPass')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label-styled">NEW PASSWORD</label>
                                <div class="password-input-wrap">
                                    <input type="password" name="new_password" id="newPass" class="form-field-styled editable"
                                           placeholder="Min. 8 characters" required>
                                    <button type="button" class="toggle-pass" onclick="togglePass('newPass')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label-styled">CONFIRM NEW PASSWORD</label>
                                <div class="password-input-wrap">
                                    <input type="password" name="confirm_password" id="confirmPass" class="form-field-styled editable"
                                           placeholder="Repeat new password" required>
                                    <button type="button" class="toggle-pass" onclick="togglePass('confirmPass')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="password-tips">
                            <i class="bi bi-lightbulb me-2"></i>
                            Use at least 8 characters with a mix of uppercase, numbers, and symbols.
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-account-secondary">
                                <i class="bi bi-shield-check me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TAB: Orders -->
            <div id="tab-orders" class="account-tab">
                <div class="account-card">
                    <div class="account-card-header">
                        <div class="account-card-icon"><i class="bi bi-receipt-cutoff"></i></div>
                        <div>
                            <h5 class="account-card-title">Order History</h5>
                            <p class="account-card-subtitle">All your previous orders in one place</p>
                        </div>
                    </div>
                    
                    <?php if(empty($orders)): ?>
                        <div class="orders-empty">
                            <i class="bi bi-bag-x"></i>
                            <h6>No orders yet</h6>
                            <p>You haven't placed any orders. Start exploring our menu!</p>
                            <a href="<?= base_url('menu') ?>" class="btn-account-primary mt-2">
                                <i class="bi bi-cup-hot me-2"></i>Browse Menu
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="orders-list">
                        <?php foreach($orders as $i => $order): ?>
                            <div class="order-item">
                                <button class="order-item-header" 
                                        onclick="toggleOrder('order-<?= $order['id'] ?>')"
                                        aria-expanded="false">
                                    <div class="order-meta">
                                        <span class="order-number">#ORD-<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></span>
                                        <span class="order-date"><?= date('M j, Y · g:i a', strtotime($order['created_at'])) ?></span>
                                    </div>
                                    <div class="order-right">
                                        <span class="order-status-badge status-<?= strtolower($order['status']) ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                        <span class="order-total">₱<?= number_format($order['total_amount'], 2) ?></span>
                                        <i class="bi bi-chevron-down order-chevron"></i>
                                    </div>
                                </button>
                                <div class="order-details" id="order-<?= $order['id'] ?>" style="display:none;">
                                    <?php foreach($order['items'] as $item): ?>
                                    <div class="order-product-row">
                                        <img src="<?= base_url('uploads/products/' . ($item['product_image'] ?: 'default-coffee.jpg')) ?>"
                                             class="order-product-img"
                                             onerror="this.src='https://images.unsplash.com/photo-1541167760496-162955ed8a9f?q=80&w=100&auto=format&fit=crop'"
                                             alt="<?= esc($item['product_name']) ?>">
                                        <div class="order-product-info">
                                            <span class="order-product-name"><?= esc($item['product_name']) ?></span>
                                            <?php if(!empty($item['decoded_options'])): ?>
                                            <span class="order-product-opts">
                                                <?= $item['decoded_options']['drink_type'] ?? '' ?>
                                                <?php if(!empty($item['decoded_options']['size'])): ?>
                                                    · <?= $item['decoded_options']['size'] ?>
                                                <?php endif; ?>
                                                <?php if(!empty($item['decoded_options']['sugar_level'])): ?>
                                                    · Sugar: <?= $item['decoded_options']['sugar_level'] ?>
                                                <?php endif; ?>
                                            </span>
                                            <?php endif; ?>
                                            <span class="order-product-qty">Qty: <?= $item['quantity'] ?></span>
                                        </div>
                                        <span class="order-product-price">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="order-footer">
                                        <span class="text-muted small">
                                            <i class="bi bi-geo-alt me-1"></i><?= esc($order['shipping_address'] ?? 'N/A') ?>
                                        </span>
                                        <span class="order-grand-total">Total: ₱<?= number_format($order['total_amount'], 2) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Account Wrapper */
.account-wrapper { max-width: 1100px; margin: 0 auto; padding-bottom: 3rem; }
.account-header { padding-bottom: 0.5rem; border-bottom: 2px solid #f0e9e2; margin-bottom: 1.5rem; }
.account-title { font-size: 1.7rem; font-weight: 800; color: #2D1A12; margin-bottom: 0.2rem; }
.account-subtitle { color: #8D7B74; font-size: 0.85rem; margin: 0; }

/* Profile Sidebar Card */
.profile-sidebar-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    overflow: hidden;
    text-align: center;
}
.profile-banner { height: 70px; background: linear-gradient(135deg, #1A0B05, #C69276); }
.profile-avatar-wrap { margin-top: -40px; padding: 0 1rem; }
.profile-avatar {
    width: 80px; height: 80px;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.profile-info-text { padding: 0.75rem 1.5rem 0; }
.profile-name { font-weight: 800; font-size: 1rem; color: #2D1A12; margin-bottom: 0.2rem; }
.profile-email { font-size: 0.75rem; color: #8D7B74; margin-bottom: 0.5rem; word-break: break-all; }
.profile-role-badge {
    display: inline-block;
    background: rgba(198,146,118,0.15);
    color: #C69276;
    font-size: 0.65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    margin-bottom: 1rem;
}
.profile-stats { display: flex; border-top: 1px solid #f0e9e2; }
.profile-stat { flex: 1; padding: 0.9rem 0.5rem; }
.stat-num { display: block; font-weight: 800; font-size: 1rem; color: #2D1A12; }
.stat-label { font-size: 0.7rem; color: #8D7B74; font-weight: 600; text-transform: uppercase; }

/* Account Nav Card */
.account-nav-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    overflow: hidden;
}
.account-nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.2rem;
    color: #8D7B74;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    border-bottom: 1px solid #f5f0ec;
    transition: all 0.2s;
    cursor: pointer;
}
.account-nav-link:last-child { border-bottom: none; }
.account-nav-link i { font-size: 1rem; }
.account-nav-link:hover, .account-nav-link.active {
    background: #fdf6f2;
    color: #C69276;
}
.account-nav-link.active { border-left: 3px solid #C69276; }
.order-count-badge {
    background: #C69276;
    color: #fff;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 800;
    padding: 0.2rem 0.5rem;
}

/* Tabs */
.account-tab { display: none; }
.account-tab.active { display: block; }

/* Account Card */
.account-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    overflow: hidden;
}
.account-card-header {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem 1.75rem;
    border-bottom: 1px solid #f0e9e2;
    background: #fdfaf8;
}
.account-card-icon {
    width: 44px; height: 44px;
    background: rgba(198,146,118,0.12);
    color: #C69276;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.account-card-title { font-weight: 800; font-size: 1rem; color: #2D1A12; margin: 0 0 0.2rem; }
.account-card-subtitle { font-size: 0.78rem; color: #8D7B74; margin: 0; }

/* Account Form */
.account-form { padding: 1.75rem; }
.form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
.form-group { display: flex; flex-direction: column; margin-bottom: 1.25rem; }
.form-group:last-child { margin-bottom: 0; }
.form-label-styled {
    font-size: 0.68rem;
    font-weight: 800;
    color: #8D7B74;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
}
.form-field-styled {
    border: 1.5px solid #e8ddd7;
    border-radius: 12px;
    padding: 0.65rem 1rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #2D1A12;
    background: #faf7f5;
    outline: none;
    transition: border-color 0.2s;
    font-family: 'Outfit', sans-serif;
    width: 100%;
}
.form-field-styled:focus { border-color: #C69276; background: #fff; }
.form-field-styled[readonly] { background: #f5f0ec; color: #8D7B74; cursor: not-allowed; }
.form-field-styled.editable { background: #fff; }
.field-hint { font-size: 0.7rem; color: #aaa; margin-top: 0.25rem; }

/* Password toggle */
.password-input-wrap { position: relative; }
.password-input-wrap .form-field-styled { padding-right: 2.5rem; }
.toggle-pass {
    position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer; color: #8D7B74;
    font-size: 1rem; padding: 0;
}
.toggle-pass:hover { color: #C69276; }

.password-tips {
    background: #fdf6f2;
    border: 1px solid #f0e2d8;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 0.78rem;
    color: #8D7B74;
    margin-bottom: 1.25rem;
}

/* Buttons */
.form-actions { text-align: right; padding-top: 0.5rem; }
.btn-account-primary {
    display: inline-flex; align-items: center;
    background: #C69276; color: #fff;
    border: none; border-radius: 12px;
    padding: 0.65rem 1.75rem;
    font-size: 0.875rem; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    font-family: 'Outfit', sans-serif;
    text-decoration: none;
}
.btn-account-primary:hover { background: #b07d60; color: #fff; }
.btn-account-secondary {
    display: inline-flex; align-items: center;
    background: #1A0B05; color: #fff;
    border: none; border-radius: 12px;
    padding: 0.65rem 1.75rem;
    font-size: 0.875rem; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    font-family: 'Outfit', sans-serif;
}
.btn-account-secondary:hover { background: #2e1408; }

/* Flash Alerts */
.account-alert {
    display: flex; align-items: center;
    border-radius: 12px;
    padding: 0.85rem 1.2rem;
    font-size: 0.875rem; font-weight: 600;
}
.account-alert-success { background: #e6faf0; color: #2F855A; }
.account-alert-error { background: #fff5f5; color: #c53030; }

/* Orders */
.orders-list { padding: 0.5rem 0; }
.orders-empty {
    display: flex; flex-direction: column; align-items: center;
    padding: 3rem 2rem; text-align: center;
    color: #8D7B74;
}
.orders-empty i { font-size: 3rem; margin-bottom: 1rem; opacity: 0.3; }
.orders-empty h6 { font-weight: 800; color: #2D1A12; margin-bottom: 0.4rem; }
.orders-empty p { font-size: 0.85rem; margin-bottom: 0.5rem; }

.order-item { border-bottom: 1px solid #f5f0ec; }
.order-item:last-child { border-bottom: none; }
.order-item-header {
    width: 100%;
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.75rem;
    background: none; border: none; cursor: pointer;
    text-align: left; transition: background 0.15s;
}
.order-item-header:hover { background: #fdfaf8; }
.order-meta { display: flex; flex-direction: column; }
.order-number { font-weight: 800; font-size: 0.85rem; color: #2D1A12; }
.order-date { font-size: 0.75rem; color: #8D7B74; margin-top: 0.1rem; }
.order-right { display: flex; align-items: center; gap: 1rem; }
.order-total { font-weight: 800; font-size: 0.9rem; color: #C69276; }
.order-status-badge {
    padding: 0.25rem 0.65rem; border-radius: 20px;
    font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
}
.status-delivered, .status-completed { background: #e6faf0; color: #2F855A; }
.status-pending { background: #fff8e6; color: #D4943A; }
.status-processing { background: #ebf5ff; color: #2B6CB0; }
.status-cancelled { background: #fff5f5; color: #c53030; }
.status-shipped { background: #f3ebff; color: #553C9A; }
.order-chevron { font-size: 0.75rem; color: #8D7B74; transition: transform 0.25s; }
.order-chevron.open { transform: rotate(180deg); }

.order-details { padding: 0 1.75rem 1.25rem; }
.order-product-row {
    display: flex; align-items: center; gap: 0.85rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f5f0ec;
}
.order-product-row:last-child { border-bottom: none; }
.order-product-img {
    width: 50px; height: 50px;
    border-radius: 10px; object-fit: cover; flex-shrink: 0;
}
.order-product-info { flex: 1; display: flex; flex-direction: column; }
.order-product-name { font-weight: 700; font-size: 0.85rem; color: #2D1A12; }
.order-product-opts { font-size: 0.72rem; color: #8D7B74; }
.order-product-qty { font-size: 0.72rem; color: #aaa; }
.order-product-price { font-weight: 700; font-size: 0.875rem; color: #2D1A12; white-space: nowrap; }
.order-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 0.85rem; margin-top: 0.5rem; border-top: 1px solid #f0e9e2;
}
.order-grand-total { font-weight: 800; color: #C69276; }

@media (max-width: 768px) {
    .form-row-2 { grid-template-columns: 1fr; }
    .order-right { gap: 0.5rem; }
}
</style>

<script>
// Tab navigation
document.querySelectorAll('.account-nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const tabId = this.dataset.tab;

        // Update active link
        document.querySelectorAll('.account-nav-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');

        // Show correct tab
        document.querySelectorAll('.account-tab').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');
    });
});

// Auto-switch to security tab if there's an error with password
<?php if(session()->getFlashdata('error')): ?>
    document.querySelector('[data-tab="security"]').click();
<?php endif; ?>

// Toggle order details
function toggleOrder(id) {
    const el = document.getElementById(id);
    const btn = el.previousElementSibling;
    const chevron = btn.querySelector('.order-chevron');
    const isOpen = el.style.display !== 'none';
    el.style.display = isOpen ? 'none' : 'block';
    chevron.classList.toggle('open', !isOpen);
}

// Toggle password visibility
function togglePass(id) {
    const input = document.getElementById(id);
    const btn = input.nextElementSibling || input.parentElement.querySelector('.toggle-pass');
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>

<?= $this->endSection() ?>
