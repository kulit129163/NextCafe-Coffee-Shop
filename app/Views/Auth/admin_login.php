<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - NextCafe</title>
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #422c1d;
            --admin-accent: #d4a574;
            --admin-bg: #fffaf0;
        }

        body {
            background-color: var(--admin-bg);
            font-family: 'Inter', sans-serif;
        }

        .auth-wrapper {
            background: white;
            box-shadow: 0 20px 60px rgba(66, 44, 29, 0.1);
        }

        .side-panel {
            background: linear-gradient(rgba(66, 44, 29, 0.8), rgba(66, 44, 29, 0.8)), 
                        url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }

        .form-panel h2 {
            color: var(--admin-primary);
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
        }

        .btn-login {
            background: var(--admin-primary);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--admin-accent);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.4);
        }

        .form-group input:focus {
            border-color: var(--admin-accent);
        }

        .admin-badge {
            display: inline-block;
            padding: 4px 12px;
            background: var(--admin-accent);
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="side-panel">
            <div class="welcome-text">
                <img src="<?= base_url('images/logo.png') ?>" alt="NextCafe" style="max-width: 180px; margin-bottom: 2rem; filter: brightness(0) invert(1);">
                <h1>Management Portal</h1>
                <p>Welcome to the NextCafe Administration System. Please authenticate to manage products, orders, and customer relations.</p>
            </div>
        </div>

        <div class="form-panel">
            <div class="admin-badge">Admin Portal Only</div>
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">ADMIN LOGIN</h2>
            <p style="color: var(--admin-accent); font-weight: 600; margin-bottom: 1.5rem; font-size: 0.8rem;">AUTHORIZED PERSONNEL ONLY</p>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" style="background: #fff5f5; color: #e53e3e; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; border: 1px solid #fed7d7;">
                    <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/login') ?>" method="POST" class="login-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <span class="icon-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </span>
                    <input type="email" id="email" name="email" placeholder="Admin Email" required autofocus>
                </div>

                <div class="form-group">
                    <span class="icon-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn-login">ACCESS DASHBOARD</button>
            </form>
            
            <a href="<?= base_url('login') ?>" class="back-home" style="margin-top: 2rem; display: block; color: var(--admin-primary); opacity: 0.7; text-decoration: none; font-size: 0.9rem;">
                ← Customer Login
            </a>
        </div>
    </div>

    <!-- Success Modal (Shared Logic) -->
    <?php if (isset($login_success) && $login_success): ?>
        <div id="loginSuccessModal" class="modal-overlay" style="display: flex;">
            <div class="modal-card active">
                <div class="modal-icon">☕</div>
                <h3>Authentication Success</h3>
                <p>Establishing secure connection to admin panel...</p>
                <div style="margin-top: 2rem;">
                    <div class="loader" style="margin: 0 auto;"></div>
                </div>
            </div>
        </div>
        <style>
            .loader { width: 30px; height: 30px; border: 3px solid #f3f3f3; border-top: 3px solid var(--admin-primary); border-radius: 50%; animation: spin 1s linear infinite; }
            @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
            .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; z-index: 9999; }
            .modal-card { background: white; padding: 3rem; border-radius: 24px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
            .modal-card h3 { color: var(--admin-primary); font-family: 'Playfair Display', serif; margin-bottom: 1rem; }
        </style>
        <script>
            setTimeout(function() { window.location.href = '<?= site_url($redirect_url) ?>'; }, 1500);
        </script>
    <?php endif; ?>
</body>
</html>
