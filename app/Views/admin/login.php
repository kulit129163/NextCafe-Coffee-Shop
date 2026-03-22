<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Login - NextCafe' ?></title>
    
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
            --admin-primary: #8C5E45;
            --admin-bg: #1A1A1A;
            --admin-surface: #2D2D2D;
            --text-light: #F5F5F5;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--admin-bg);
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-image: radial-gradient(circle at 50% 0%, #2a2a2a 0%, #1a1a1a 100%);
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
        }

        .admin-card {
            background-color: var(--admin-surface);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 3rem;
        }

        .form-control {
            background-color: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-light);
            padding: 0.8rem 1rem;
        }
        
        .form-control:focus {
            background-color: rgba(0,0,0,0.3);
            border-color: var(--admin-primary);
            color: var(--text-light);
            box-shadow: 0 0 0 0.25rem rgba(140, 94, 69, 0.25);
        }

        .form-label {
            color: #aaa;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-admin {
            background-color: var(--admin-primary);
            color: white;
            border: none;
            padding: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-admin:hover {
            background-color: #724A35;
            color: white;
            transform: translateY(-2px);
        }

        .admin-badge {
            background: rgba(140, 94, 69, 0.2);
            color: var(--admin-primary);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        
        <div class="admin-card text-center">
            
            <a href="<?= base_url() ?>" class="text-decoration-none text-light d-inline-flex flex-column align-items-center mb-4">
                <i class="bi bi-shield-lock-fill display-4 text-muted mb-2"></i>
                <span class="fs-3 fw-800">NextCafe</span>
            </a>
            
            <div>
                <span class="admin-badge"><i class="bi bi-cpu me-1"></i> Control Panel</span>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger bg-danger bg-opacity-10 border-danger text-danger border-opacity-25 rounded-3 mb-4 text-start small">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success bg-success bg-opacity-10 border-success text-success border-opacity-25 rounded-3 mb-4 text-start small">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/login') ?>" method="post" class="text-start">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label for="login" class="form-label">Username or Email</label>
                    <input type="text" class="form-control rounded-3" id="login" name="login" value="<?= old('login') ?>" required autofocus placeholder="admin@nextcafe.com">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Secure Password</label>
                    <input type="password" class="form-control rounded-3" id="password" name="password" required placeholder="••••••••">
                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-admin rounded-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Authenticate
                    </button>
                </div>
            </form>
            
            <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                <a href="<?= base_url() ?>" class="text-muted text-decoration-none small hover-primary transition">
                    <i class="bi bi-arrow-left me-1"></i> Return to Storefront
                </a>
            </div>

        </div>
    </div>

</body>
</html>
