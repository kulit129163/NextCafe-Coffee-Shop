<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'NextCafe - Premium Coffee Shop' ?></title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-coffee: #C69276;
            --sidebar-bg: #1A0B05;
            --app-bg: #FDFBF7;
            --card-bg: #FFFFFF;
            --text-dark: #2D1A12;
            --text-muted: #8D7B74;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--app-bg);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            height: 100vh;
            background-color: var(--sidebar-bg) !important;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding: 2.5rem 1.5rem;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            color: #FFFFFF !important;
            font-size: 1.75rem;
            font-weight: 800;
            text-decoration: none;
            margin-bottom: 3.5rem;
            display: flex;
            align-items: center;
        }

        .sidebar-brand i {
            color: var(--primary-coffee);
            margin-right: 0.75rem;
            font-size: 2rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.6) !important;
            padding: 0.9rem 1.25rem;
            border-radius: 14px;
            margin-bottom: 0.6rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
            text-decoration: none;
        }

        .nav-link i {
            font-size: 1.4rem;
            margin-right: 1.25rem;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--primary-coffee) !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 12px rgba(198, 146, 118, 0.3);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 2rem;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            padding: 3rem 4rem;
            min-height: 100vh;
            position: relative;
        }

        /* Top Header in Content */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3.5rem;
        }

        .search-wrapper {
            width: 400px;
        }

        .rounded-pill-search {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            border: 1px solid rgba(0,0,0,0.08);
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .rounded-pill-search input {
            border: none;
            outline: none;
            padding-left: 1rem;
            width: 100%;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        /* High-Fidelity Cards */
        .card {
            border: none;
            border-radius: 32px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #FFFFFF;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.07) !important;
        }

        .btn-primary {
            background-color: var(--primary-coffee) !important;
            border: none !important;
            padding: 0.75rem 2rem;
            border-radius: 40px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(198, 146, 118, 0.2);
        }

        .text-primary { color: var(--primary-coffee) !important; }
        .fw-800 { font-weight: 800; }
        .fw-600 { font-weight: 600; }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
                padding: 2rem;
            }
            .search-wrapper {
                width: 100%;
                margin-top: 1rem;
            }
            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="<?= base_url() ?>" class="sidebar-brand">
            <i class="bi bi-cup-hot-fill"></i>
            NextCafe
        </a>
        
        <nav class="nav flex-column mb-auto">
            <a class="nav-link <?= current_url() == base_url() ? 'active' : '' ?>" href="<?= base_url() ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link <?= current_url() == base_url('menu') ? 'active' : '' ?>" href="<?= base_url('menu') ?>">
                <i class="bi bi-grid-3x3-gap"></i> Menu
            </a>
            <a class="nav-link <?= current_url() == base_url('about') ? 'active' : '' ?>" href="<?= base_url('about') ?>">
                <i class="bi bi-info-circle"></i> About Us
            </a>
            <a class="nav-link <?= current_url() == base_url('contact') ? 'active' : '' ?>" href="<?= base_url('contact') ?>">
                <i class="bi bi-envelope"></i> Contact
            </a>
            <a class="nav-link <?= strpos(current_url(), 'orders') !== false ? 'active' : '' ?>" href="<?= base_url('orders') ?>">
                <i class="bi bi-receipt"></i> Orders
            </a>
            <div class="my-4" style="border-top: 1px solid rgba(255,255,255,0.1);"></div>
            <a class="nav-link <?= current_url() == base_url('cart') ? 'active' : '' ?>" href="<?= base_url('cart') ?>">
                <i class="bi bi-cart3"></i> My Cart
            </a>
            


            <div class="my-4" style="border-top: 1px solid rgba(255,255,255,0.1);"></div>
            <a class="nav-link text-danger" href="<?= base_url('logout') ?>" onclick="return confirm('Are you sure you want to logout?')">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>

        <div class="sidebar-footer">
            <?php if (session()->get('isLoggedIn')): ?>
                <div class="d-flex align-items-center mb-0 p-3 bg-white bg-opacity-10 rounded-4">
                    <img src="https://ui-avatars.com/api/?name=<?= session()->get('username') ?>&background=C69276&color=fff" class="rounded-circle" width="45" alt="User">
                    <div class="ms-3 overflow-hidden">
                        <p class="text-white small mb-0 fw-bold text-truncate"><?= session()->get('username') ?></p>
                        <p class="text-white-50 x-small mb-0">Premium Member</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="d-grid gap-2">
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-light rounded-pill py-2">Login</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-primary rounded-pill py-2">Sign Up</a>
                </div>
            <?php endif; ?>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Dashboard Header -->
        <header class="content-header">
            <div>
                <h1 class="fw-800 display-6 mb-1 text-uppercase"><?= $page_title ?? 'Explore Menu' ?></h1>
                <p class="text-muted small fw-600 mb-0">CAREFULLY CRAFTED COFFEE & TREATS</p>
            </div>
            <div class="search-wrapper">
                <form action="<?= base_url('menu') ?>" method="GET">
                    <div class="rounded-pill-search shadow-sm">
                        <i class="bi bi-search text-muted"></i>
                        <input type="text" name="search" placeholder="Explore our coffee..." value="<?= $search_query ?? '' ?>">
                    </div>
                </form>
            </div>
        </header>

        <?= $this->renderSection('content') ?>
        
        <footer class="mt-5 pt-5 opacity-50">
            <div class="d-flex justify-content-between x-small fw-600">
                <p>&copy; 2024 NEXTCAFE COFFEE SHOP. ALL RIGHTS RESERVED.</p>
                <div>
                    <a href="#" class="text-dark text-decoration-none me-4">PRIVACY POLICY</a>
                    <a href="#" class="text-dark text-decoration-none">TERMS OF SERVICE</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
