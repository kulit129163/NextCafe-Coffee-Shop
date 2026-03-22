<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'NextCafe - Authentication' ?></title>
    
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
        }
        
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Outfit', sans-serif;
        }

        /* ── FULL-PAGE BACKGROUND ── */
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
            background: linear-gradient(135deg, rgba(45,27,20,0.82) 0%, rgba(124,74,45,0.65) 60%, rgba(45,27,20,0.80) 100%);
            z-index: 0;
        }

        /* ── MAIN CARD CONTAINER ── */
        .auth-card {
            position: relative;
            z-index: 1;
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 560px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.45), 0 0 0 1px rgba(255,255,255,0.08);
        }

        /* ── LEFT PANEL (info) ── */
        .auth-left {
            flex: 0 0 42%;
            position: relative;
            background: linear-gradient(160deg, rgba(45,27,20,0.92) 0%, rgba(124,74,45,0.80) 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            overflow: hidden;
        }

        /* decorative circles */
        .auth-left::before {
            content: '';
            position: absolute;
            width: 250px; height: 250px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,0.05);
            bottom: -60px; left: -60px;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            width: 180px; height: 180px;
            border-radius: 50%;
            border: 30px solid rgba(255,255,255,0.05);
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
        .brand-link i  { font-size: 1.9rem; color: var(--coffee-light); }
        .brand-link span { font-size: 1.5rem; font-weight: 800; color: #fff; letter-spacing: -.5px; }

        .left-tagline {
            position: relative;
            z-index: 2;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.22);
            backdrop-filter: blur(6px);
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
            color: rgba(255,255,255,.65);
            line-height: 1.65;
        }

        /* feature pills at bottom */
        .feature-list {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            gap: .55rem;
            margin-top: auto;
            padding-top: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .8rem;
            color: rgba(255,255,255,.7);
            font-weight: 500;
        }

        .feature-item i {
            width: 28px; height: 28px;
            background: rgba(255,255,255,.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            color: var(--coffee-light);
            flex-shrink: 0;
        }

        /* ── RIGHT PANEL (form) ── */
        .auth-right {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.8rem;
        }

        .auth-form-inner {
            width: 100%;
            max-width: 360px;
        }

        /* Logo on mobile */
        .mobile-logo {
            display: none;
            align-items: center;
            gap: .5rem;
            margin-bottom: 2rem;
            text-decoration: none;
        }
        .mobile-logo i    { font-size: 1.5rem; color: var(--coffee-tan); }
        .mobile-logo span { font-size: 1.3rem; font-weight: 800; color: var(--coffee-dark); }

        @media (max-width: 700px) {
            .auth-card { flex-direction: column; max-width: 440px; min-height: auto; }
            .auth-left  { flex: none; padding: 2rem 1.8rem; min-height: 220px; }
            .auth-right { padding: 2.2rem 1.8rem; }
            .mobile-logo { display: flex; }
            .feature-list { display: none; }
        }

        /* Divider */
        .form-divider {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.6rem;
        }
        .form-divider::before, .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #EDE8E5;
        }
        .form-divider span {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        /* Form title */
        .form-title {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--coffee-dark);
            letter-spacing: -.4px;
            margin-bottom: .25rem;
        }
        .form-subtitle {
            font-size: .83rem;
            color: var(--muted);
            margin-bottom: 1.8rem;
        }

        /* Fields */
        .field-group { margin-bottom: 1.1rem; }
        .field-label {
            display: block;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .45rem;
        }

        .field-wrap {
            position: relative;
        }

        .field-wrap .fi {
            position: absolute;
            left: .95rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--coffee-tan);
            font-size: 1rem;
            pointer-events: none;
            z-index: 1;
        }

        .field-wrap input {
            width: 100%;
            border: 1.5px solid #E5DDD8;
            border-radius: 12px;
            padding: .78rem 1rem .78rem 2.7rem;
            font-family: 'Outfit', sans-serif;
            font-size: .9rem;
            color: var(--coffee-dark);
            background: var(--cream);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .field-wrap input::placeholder { color: #C4B5AD; }
        .field-wrap input:focus {
            border-color: var(--coffee-tan);
            box-shadow: 0 0 0 3.5px rgba(198,146,118,.18);
            background: #fff;
        }

        .toggle-pw {
            position: absolute;
            right: .9rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            font-size: 1rem;
            padding: 0;
            line-height: 1;
        }

        /* Options row */
        .form-opts {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            margin-top: .2rem;
        }
        .form-opts label {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .82rem;
            color: var(--muted);
            cursor: pointer;
            user-select: none;
        }
        .form-opts label input[type="checkbox"] {
            accent-color: var(--coffee-tan);
            width: 14px; height: 14px;
        }
        .form-opts a {
            font-size: .82rem;
            font-weight: 600;
            color: var(--coffee-tan);
            text-decoration: none;
        }
        .form-opts a:hover { text-decoration: underline; }

        /* Submit button */
        .btn-auth {
            width: 100%;
            padding: .85rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--coffee-tan) 0%, var(--coffee-mid) 100%);
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: .92rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 5px 20px rgba(198,146,118,.42);
        }
        .btn-auth:hover {
            opacity: .92;
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(124,74,45,.38);
        }
        .btn-auth:active { transform: translateY(0); }

        /* Alt link */
        .auth-alt {
            text-align: center;
            margin-top: 1.4rem;
            font-size: .83rem;
            color: var(--muted);
        }
        .auth-alt a { color: var(--coffee-mid); font-weight: 700; text-decoration: none; }
        .auth-alt a:hover { text-decoration: underline; }

        /* Alerts */
        .auth-alert {
            border-radius: 10px;
            padding: .65rem .9rem;
            font-size: .8rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: .5rem;
        }
        .auth-alert.danger  { background: #FEF2F2; color: #b91c1c; border: 1px solid #FECACA; }
        .auth-alert.success { background: #F0FDF4; color: #15803d; border: 1px solid #BBF7D0; }
        .auth-alert i { margin-top: 1px; flex-shrink: 0; }
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
            <div class="badge-pill"><i class="bi bi-stars"></i> Premium Coffee</div>
            <h2><?= $left_heading ?? 'Welcome<br>to NextCafe' ?></h2>
            <p><?= $left_subtext ?? 'NextCafe brings you the finest beans, crafting every cup with passion. Your journey starts here.' ?></p>
        </div>

        <div class="feature-list">
            <div class="feature-item"><i class="bi bi-bag-heart"></i> Easy online ordering</div>
            <div class="feature-item"><i class="bi bi-heart"></i> Save your wishlist</div>
            <div class="feature-item"><i class="bi bi-clock-history"></i> Track order history</div>
        </div>
    </div>

    <!-- ── RIGHT PANEL ── -->
    <div class="auth-right">
        <div class="auth-form-inner">

            <!-- Mobile logo -->
            <a href="<?= base_url() ?>" class="mobile-logo">
                <i class="bi bi-cup-hot-fill"></i>
                <span>NextCafe</span>
            </a>

            <?= $this->renderSection('content') ?>
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
