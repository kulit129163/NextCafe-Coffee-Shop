<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin - NextCafe' ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-bg: #110905;
            --sidebar-hover: rgba(255,255,255,0.05);
            --sidebar-active-bg: rgba(255,255,255,0.1);
            --sidebar-text: #FFFFFF;
            --sidebar-text-muted: rgba(255,255,255,0.6);
            --accent: #C69276;
            --accent-light: #f5ede8;
            --app-bg: #F8F5F2;
            --card-bg: #FFFFFF;
            --border-color: #EEE8E3;
            --text-dark: #1a1a1a;
            --text-muted: #888;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--app-bg);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 220px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            padding: 0;
        }

        .sidebar-logo {
            padding: 2.5rem 1.8rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .sidebar-logo .logo-icon {
            font-size: 2.2rem;
            color: #C69276; /* Match the cup color in screenshot */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo span {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            font-family: 'Inter', sans-serif;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0.75rem 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding: 0.9rem 2rem;
            color: var(--sidebar-text-muted);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-nav a i {
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .sidebar-nav a:hover {
            color: var(--sidebar-text);
        }

        .sidebar-nav a.active {
            color: var(--sidebar-text);
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,0.07);
            margin: 0.5rem 0;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--sidebar-text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.5rem 0;
            transition: color 0.2s;
        }

        .sidebar-footer a:hover { 
            color: var(--sidebar-text);
            background: var(--sidebar-hover);
            border-radius: 8px;
        }

        /* Main Content */
        .admin-main {
            margin-left: 220px;
            flex: 1;
            padding: 2rem 2.5rem;
            min-height: 100vh;
        }

        /* Top Bar */
        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .admin-topbar h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-date {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.8rem;
        }

        /* Cards */
        .admin-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        /* Stat Cards */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .stat-card .stat-icon {
            font-size: 1.1rem;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Search Box */
        .admin-search {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            min-width: 240px;
        }

        .admin-search input {
            border: none;
            outline: none;
            font-size: 0.85rem;
            color: var(--text-dark);
            background: transparent;
            width: 100%;
        }

        .admin-search i { color: var(--text-muted); }

        /* Buttons */
        .btn-accent {
            background: var(--accent-light);
            color: var(--accent);
            border: 1px solid #e8d4c8;
            border-radius: 10px;
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s;
        }

        .btn-accent:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        /* Tables */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table thead th {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-table tbody tr {
            border-bottom: 1px solid #F5F0EC;
            transition: background 0.15s;
        }

        .admin-table tbody tr:hover { background: #FDFAF8; }
        .admin-table tbody tr:last-child { border-bottom: none; }

        .admin-table td {
            padding: 0.9rem 1rem;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .status-pending   { background: #FFF8E6; color: #D4943A; }
        .status-processing { background: #EBF5FF; color: #2B6CB0; }
        .status-shipped   { background: #EBF5FF; color: #553C9A; }
        .status-delivered, .status-completed { background: #E6FAF0; color: #2F855A; }
        .status-cancelled { background: #FFF5F5; color: #C53030; }

        .role-admin    { background: rgba(198,146,118,0.15); color: #8C4A2F; }
        .role-customer { background: #EBF8FF; color: #2C7A7B; }

        .availability-available { color: #2F855A; font-weight: 600; font-size: 0.8rem; }
        .availability-sold_out  { color: #C53030; font-weight: 600; font-size: 0.8rem; }

        /* Action Icon Buttons */
        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }

        .action-btn.edit   { background: #FFF8E6; color: #D4943A; }
        .action-btn.view   { background: #EBF5FF; color: #2B6CB0; }
        .action-btn.delete { background: #FFF5F5; color: #C53030; }
        .action-btn.approve { background: #E6FAF0; color: #2F855A; }

        .action-btn:hover { opacity: 0.75; }

        /* Flash Messages */
        .flash-success {
            background: #E6FAF0; color: #2F855A;
            border: 1px solid #9AE6B4;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
        .flash-error {
            background: #FFF5F5; color: #C53030;
            border: 1px solid #FEB2B2;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
        .flash-info {
            background: #EBF8FF; color: #2B6CB0;
            border: 1px solid #BEE3F8;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
    </style>
</head>
<body>

    <!-- Admin Sidebar -->
    <aside class="admin-sidebar">
        <a href="<?= base_url('admin') ?>" class="sidebar-logo">
            <div class="logo-icon"><i class="bi bi-cup-hot"></i></div>
            <span>NextCafe</span>
        </a>

        <nav class="sidebar-nav">
            <a href="<?= base_url('admin') ?>" class="<?= current_url() === base_url('admin') || current_url() === base_url('admin/') || strpos(current_url(), 'admin/dashboard') !== false ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/products') ?>" class="<?= strpos(current_url(), 'admin/products') !== false ? 'active' : '' ?>">
                <i class="bi bi-grid"></i> Products
            </a>
            <a href="<?= base_url('admin/orders') ?>" class="<?= strpos(current_url(), 'admin/orders') !== false ? 'active' : '' ?>">
                <i class="bi bi-receipt"></i> Orders
            </a>
            <a href="<?= base_url('admin/categories') ?>" class="<?= strpos(current_url(), 'admin/categories') !== false ? 'active' : '' ?>">
                <i class="bi bi-tags"></i> Categories
            </a>
            <a href="<?= base_url('admin/users') ?>" class="<?= strpos(current_url(), 'admin/users') !== false ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Users
            </a>
            <a href="<?= base_url('admin/reviews') ?>" class="<?= strpos(current_url(), 'admin/reviews') !== false ? 'active' : '' ?>">
                <i class="bi bi-chat-left-text"></i> Reviews
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-divider"></div>

            <a href="javascript:void(0)" class="px-3" data-bs-toggle="modal" data-bs-target="#adminLogoutModal">
                <i class="bi bi-box-arrow-right" style="font-size: 1.2rem;"></i> 
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Top Bar -->
        <div class="admin-topbar">
            <h1><?= $page_title ?? 'Dashboard' ?></h1>
            <div class="topbar-right">
                <span class="topbar-date"><?= date('M j, Y') ?></span>
                <div class="topbar-avatar"><?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?></div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-success"><i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-error"><i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('info')): ?>
            <div class="flash-info"><i class="bi bi-info-circle me-2"></i><?= session()->getFlashdata('info') ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <!-- Admin Logout Modal -->
    <div class="modal fade" id="adminLogoutModal" tabindex="-1" aria-labelledby="adminLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header border-0 bg-dark text-white p-4">
                    <h5 class="modal-title fw-700" id="adminLogoutModalLabel">Admin Session</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 text-center text-dark">
                    <div class="mb-4">
                        <i class="bi bi-shield-lock display-3 opacity-25" style="color: var(--accent);"></i>
                    </div>
                    <h4 class="fw-700 mb-2">End Session?</h4>
                    <p class="text-muted fw-500 mb-0">Are you sure you want to exit the admin dashboard?</p>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                    <button type="button" class="btn btn-light rounded-3 px-4 py-2 fw-600 me-2" data-bs-dismiss="modal">Go back</button>
                    <a href="<?= base_url('admin/logout') ?>" class="btn btn-dark rounded-3 px-4 py-2 fw-700 shadow-sm" style="background: var(--sidebar-bg); border-color: var(--sidebar-bg);">Yes, logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
