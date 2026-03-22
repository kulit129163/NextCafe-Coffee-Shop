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
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar::-webkit-scrollbar { width: 8px; }
        .sidebar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); border-radius: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.45); border-radius: 4px; }
        .sidebar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.7); }

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
        .x-small { font-size: 0.75rem; }
        
        .transition-all { transition: all 0.3s ease; }
        .hover-primary:hover { color: var(--primary-coffee) !important; }
        
        .object-fit-cover { object-fit: cover; }

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
            <a class="nav-link <?= strpos(current_url(), 'profile') !== false ? 'active' : '' ?>" href="<?= base_url('profile') ?>">
                <i class="bi bi-person-circle"></i> My Profile
            </a>
            <div class="my-4" style="border-top: 1px solid rgba(255,255,255,0.1);"></div>
             <a class="nav-link <?= current_url() == base_url('cart') ? 'active' : '' ?>" href="<?= base_url('cart') ?>">
                <i class="bi bi-cart3"></i> My Cart
                <?php if (session()->get('isLoggedIn')): ?>
                    <?php 
                        $cartCount = (new \App\Models\CartModel())->where('user_id', session()->get('id'))->countAllResults();
                        if ($cartCount > 0): 
                    ?>
                        <span class="badge bg-primary rounded-pill ms-auto x-small fw-800"><?= $cartCount ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </a>
            <a class="nav-link <?= current_url() == base_url('wishlist') ? 'active' : '' ?>" href="<?= base_url('wishlist') ?>">
                <i class="bi bi-heart"></i> My Wishlist
                <?php if (session()->get('isLoggedIn')): ?>
                    <?php 
                        $wishlistCount = (new \App\Models\WishlistModel())->where('user_id', session()->get('id'))->countAllResults();
                        if ($wishlistCount > 0): 
                    ?>
                        <span class="badge bg-danger rounded-pill ms-auto x-small fw-800"><?= $wishlistCount ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </a>
            


            <div class="my-4" style="border-top: 1px solid rgba(255,255,255,0.1);"></div>
            <a class="nav-link text-danger" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>

        <div class="sidebar-footer">
            <?php if (session()->get('isLoggedIn')): ?>
                <div class="d-flex align-items-center mb-0 p-3 bg-white bg-opacity-10 rounded-4">
                    <img src="https://ui-avatars.com/api/?name=<?= session()->get('username') ?>&background=C69276&color=fff&bold=true" class="rounded-circle border border-2 border-primary border-opacity-25" width="45" alt="User">
                    <div class="ms-3 overflow-hidden">
                        <p class="text-white small mb-0 fw-bold text-truncate"><?= session()->get('username') ?></p>
                        <p class="text-white-50 x-small mb-0">Premium Member</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="d-grid gap-2">
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-light rounded-pill py-2 fw-600">Login</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-primary rounded-pill py-2 fw-600">Sign Up</a>
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
        
        <footer class="mt-5 pt-5 border-top border-light">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-cup-hot-fill text-primary fs-3 me-2"></i>
                        <h4 class="fw-800 mb-0">NextCafe</h4>
                    </div>
                    <p class="text-muted mb-4 pe-lg-4">Experience the art of artisanal coffee. We source the finest beans globally and roast them in small batches to deliver the perfect cup every time.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-800 mb-4 text-uppercase">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url() ?>" class="text-decoration-none text-muted hover-primary transition-all small fw-600">Home</a></li>
                        <li class="mb-2"><a href="<?= base_url('menu') ?>" class="text-decoration-none text-muted hover-primary transition-all small fw-600">Menu</a></li>
                        <li class="mb-2"><a href="<?= base_url('about') ?>" class="text-decoration-none text-muted hover-primary transition-all small fw-600">About Us</a></li>
                        <li class="mb-2"><a href="<?= base_url('contact') ?>" class="text-decoration-none text-muted hover-primary transition-all small fw-600">Contact</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="fw-800 mb-4 text-uppercase">Contact Info</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <span class="text-muted small fw-600">123 Brew Lane, Coffee Heights, Metro Manila, Philippines</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-envelope text-primary me-2"></i>
                            <span class="text-muted small fw-600">hello@nextcafe.com</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-phone text-primary me-2"></i>
                            <span class="text-muted small fw-600">+63 (912) 345 6789</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="fw-800 mb-4 text-uppercase">Opening Hours</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex justify-content-between">
                            <span class="text-muted small fw-600">Mon - Fri</span>
                            <span class="text-dark small fw-800">7:00 AM - 9:00 PM</span>
                        </li>
                        <li class="mb-2 d-flex justify-content-between">
                            <span class="text-muted small fw-600">Saturday</span>
                            <span class="text-dark small fw-800">8:00 AM - 10:00 PM</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted small fw-600">Sunday</span>
                            <span class="text-dark small fw-800">Closed</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-between x-small fw-600 py-4 border-top border-light">
                <p class="mb-0 text-muted">&copy; 2026 NEXTCAFE COFFEE SHOP. ALL RIGHTS RESERVED.</p>
                <div>
                    <a href="#" class="text-muted text-decoration-none me-4 hover-primary">PRIVACY POLICY</a>
                    <a href="#" class="text-muted text-decoration-none hover-primary">TERMS OF SERVICE</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="modal-header border-0 bg-dark text-white p-4">
                    <h5 class="modal-title fw-800" id="logoutModalLabel">Ready to leave?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 text-center">
                    <div class="mb-4 text-primary">
                        <i class="bi bi-cup-hot-fill display-1 opacity-25"></i>
                    </div>
                    <h4 class="fw-800 text-dark mb-2">Wait, one more cup?</h4>
                    <p class="text-muted fw-500 mb-0">Are you sure you want to logout and end your current session?</p>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-5 py-2 fw-700 me-2" data-bs-dismiss="modal">Stay here</button>
                    <a href="<?= base_url('logout') ?>" class="btn btn-primary rounded-pill px-5 py-2 fw-800 shadow-sm">Yes, Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
