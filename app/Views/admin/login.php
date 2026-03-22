<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Login - NextCafe' ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --coffee-dark:  #2D1B14;
            --coffee-mid:   #7C4A2D;
            --coffee-tan:   #C69276;
            --coffee-light: #E9C9B0;
            --cream:        #FDFBF7;
            --muted:        #9E8C83;

            /* Admin accents — cooler, darker */
            --admin-accent: #5C3D2E;
            --admin-deep:   #1C0F09;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body { height: 100%; font-family: 'Outfit', sans-serif; }

        body {
            background: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(28,15,9,0.92) 0%, rgba(92,61,46,0.78) 60%, rgba(28,15,9,0.90) 100%);
            z-index: 0;
        }

        /* ── MAIN CARD ── */
        .auth-card {
            position: relative;
            z-index: 1;
            display: flex;
            width: 100%;
            max-width: 880px;
            min-height: 540px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.07);
        }

        /* ── LEFT PANEL ── */
        .auth-left {
            flex: 0 0 42%;
            position: relative;
            background: linear-gradient(160deg, rgba(28,15,9,0.97) 0%, rgba(92,61,46,0.88) 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            width: 250px; height: 250px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,0.04);
            bottom: -60px; left: -60px;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            width: 180px; height: 180px;
            border-radius: 50%;
            border: 30px solid rgba(255,255,255,0.04);
            top: -40px; right: -50px;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            text-decoration: none;
            position: relative;
            z-index: 2;
        }
        .brand-link i    { font-size: 1.9rem; color: var(--coffee-light); }
        .brand-link span { font-size: 1.5rem; font-weight: 800; color: #fff; letter-spacing: -.5px; }

        .left-tagline { position: relative; z-index: 2; }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: .35rem 1rem;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .6px;
            color: var(--coffee-light);
            margin-bottom: 1.4rem;
        }

        .left-tagline h2 {
            font-size: clamp(1.7rem, 2.6vw, 2.2rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: .8rem;
            color: #fff;
        }
        .left-tagline p {
            font-size: .875rem;
            color: rgba(255,255,255,.55);
            line-height: 1.65;
        }

        .feature-list {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            gap: .55rem;
            padding-top: 2rem;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .8rem;
            color: rgba(255,255,255,.6);
            font-weight: 500;
        }
        .feature-item i {
            width: 28px; height: 28px;
            background: rgba(255,255,255,.08);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            color: var(--coffee-light);
            flex-shrink: 0;
        }

        /* ── RIGHT PANEL ── */
        .auth-right {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.8rem;
        }

        .auth-form-inner { width: 100%; max-width: 360px; }

        /* Form elements */
        .form-divider {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.6rem;
        }
        .form-divider::before, .form-divider::after {
            content: ''; flex: 1; height: 1px; background: #EDE8E5;
        }
        .form-divider span {
            font-size: .7rem; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--muted); white-space: nowrap;
        }

        .form-title {
            font-size: 1.55rem; font-weight: 800;
            color: var(--coffee-dark); letter-spacing: -.4px; margin-bottom: .25rem;
        }
        .form-subtitle { font-size: .83rem; color: var(--muted); margin-bottom: 1.8rem; }

        .field-group { margin-bottom: 1.1rem; }
        .field-label {
            display: block; font-size: .7rem; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase;
            color: var(--muted); margin-bottom: .45rem;
        }
        .field-wrap { position: relative; }
        .field-wrap .fi {
            position: absolute; left: .95rem; top: 50%;
            transform: translateY(-50%); color: var(--coffee-tan);
            font-size: 1rem; pointer-events: none; z-index: 1;
        }
        .field-wrap input {
            width: 100%; border: 1.5px solid #E5DDD8; border-radius: 12px;
            padding: .78rem 1rem .78rem 2.7rem;
            font-family: 'Outfit', sans-serif; font-size: .9rem;
            color: var(--coffee-dark); background: var(--cream);
            transition: border-color .2s, box-shadow .2s; outline: none;
        }
        .field-wrap input::placeholder { color: #C4B5AD; }
        .field-wrap input:focus {
            border-color: var(--coffee-tan);
            box-shadow: 0 0 0 3.5px rgba(198,146,118,.18);
            background: #fff;
        }
        .toggle-pw {
            position: absolute; right: .9rem; top: 50%;
            transform: translateY(-50%); background: none; border: none;
            cursor: pointer; color: var(--muted); font-size: 1rem;
            padding: 0; line-height: 1;
        }

        .btn-auth {
            width: 100%; padding: .85rem; border: none; border-radius: 12px;
            background: linear-gradient(135deg, var(--coffee-tan) 0%, var(--coffee-mid) 100%);
            color: #fff; font-family: 'Outfit', sans-serif;
            font-size: .92rem; font-weight: 700; letter-spacing: 1.2px;
            text-transform: uppercase; cursor: pointer;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 5px 20px rgba(198,146,118,.42);
        }
        .btn-auth:hover { opacity: .9; transform: translateY(-2px); box-shadow: 0 8px 26px rgba(124,74,45,.38); }
        .btn-auth:active { transform: translateY(0); }

        .back-link {
            display: block; text-align: center; margin-top: 1.4rem;
            font-size: .83rem; color: var(--muted); text-decoration: none;
        }
        .back-link:hover { color: var(--coffee-tan); }

        /* Alerts */
        .auth-alert {
            border-radius: 10px; padding: .65rem .9rem; font-size: .8rem;
            margin-bottom: 1rem; display: flex; align-items: flex-start; gap: .5rem;
        }
        .auth-alert.danger  { background: #FEF2F2; color: #b91c1c; border: 1px solid #FECACA; }
        .auth-alert.success { background: #F0FDF4; color: #15803d; border: 1px solid #BBF7D0; }
        .auth-alert i { margin-top: 1px; flex-shrink: 0; }

        @media (max-width: 700px) {
            .auth-card { flex-direction: column; max-width: 440px; min-height: auto; }
            .auth-left  { flex: none; padding: 2rem 1.8rem; min-height: 200px; }
            .auth-right { padding: 2.2rem 1.8rem; }
            .feature-list { display: none; }
        }
    </style>
</head>
<body>

<div class="auth-card">

    <!-- ── LEFT PANEL ── -->
    <div class="auth-left">
        <a href="<?= base_url() ?>" class="brand-link">
            <i class="bi bi-cup-hot-fill"></i>
            <span>NextCafe</span>
        </a>

        <div class="left-tagline">
            <div class="badge-pill"><i class="bi bi-shield-lock-fill"></i> Admin Control Panel</div>
            <h2>Admin<br>Dashboard</h2>
            <p>Manage products, orders, and users — all in one secure place.</p>
        </div>

        <div class="feature-list">
            <div class="feature-item"><i class="bi bi-bag-check"></i> Manage orders</div>
            <div class="feature-item"><i class="bi bi-box-seam"></i> Manage products</div>
            <div class="feature-item"><i class="bi bi-people"></i> Manage users</div>
        </div>
    </div>

    <!-- ── RIGHT PANEL ── -->
    <div class="auth-right">
        <div class="auth-form-inner">

            <h1 class="form-title">Admin Login</h1>
            <p class="form-subtitle">Sign in to access the NextCafe control panel.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="auth-alert danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="auth-alert success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <div class="form-divider"><span>Secure access only</span></div>

            <form action="<?= base_url('admin/login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="field-group">
                    <label class="field-label" for="login-id">Username or Email</label>
                    <div class="field-wrap">
                        <i class="bi bi-shield-lock fi"></i>
                        <input type="text" id="login-id" name="login" value="<?= old('login') ?>"
                               placeholder="admin@nextcafe.com" required autofocus>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="login-pw">Secure Password</label>
                    <div class="field-wrap">
                        <i class="bi bi-lock fi"></i>
                        <input type="password" id="login-pw" name="password" placeholder="••••••••" required>
                        <button type="button" class="toggle-pw" aria-label="Show/hide password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-auth" style="margin-top:.8rem;">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Authenticate
                </button>
            </form>

            <a href="<?= base_url() ?>" class="back-link">
                <i class="bi bi-arrow-left me-1"></i> Return to Storefront
            </a>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.closest('.field-wrap').querySelector('input');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.querySelector('i').className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    });
</script>
</body>
</html>
