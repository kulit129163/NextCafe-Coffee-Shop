<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'NextCafe - Authentication' ?></title>
    
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
            --app-bg: #FDFBF7;
            --text-dark: #2D1A12;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--app-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 480px;
        }

        .btn-primary {
            background-color: var(--primary-coffee) !important;
            border: none !important;
        }

        .text-primary { color: var(--primary-coffee) !important; }
        .fw-800 { font-weight: 800; }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="text-center mb-5">
            <a href="<?= base_url() ?>" class="text-decoration-none text-dark d-inline-flex align-items-center">
                <i class="bi bi-cup-hot-fill fs-1 text-primary me-2"></i>
                <span class="fs-2 fw-800">NextCafe</span>
            </a>
        </div>
        
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
