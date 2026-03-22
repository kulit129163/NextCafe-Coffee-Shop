<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-5">
    <div class="col-12">
        <div class="position-relative overflow-hidden rounded-5 shadow-sm hero-banner" style="height: 450px; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2000'); background-size: cover; background-position: center;">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100 px-3">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-3 fw-bold shadow-sm">SINCE 2026</span>
                <h1 class="display-2 fw-800 mb-3 text-shadow">Our Journey</h1>
                <p class="lead fw-600 mb-0 opacity-75">Crafting the perfect cup, one bean at a time.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-5 align-items-center mb-5 pb-5 border-bottom border-light">
    <div class="col-lg-6">
        <h6 class="text-primary fw-800 text-uppercase mb-2">Our Story</h6>
        <h2 class="display-5 fw-800 text-dark mb-4">Our Story of <span class="text-primary">Passion &amp; Beans</span></h2>
        <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">Founded in 2026, NextCafe was born from the shared dreams of three young and talented students from FEU Institute of Technology. What started as a late-night idea during a coding session has blossomed into a real haven for coffee lovers. We built this not just as a shop, but as a testament to our passion for technology and great brewing.</p>
        <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">We believe that every line of code and every cup of coffee requires the same thing—patience, precision, and an undeniable love for the craft. NextCafe is our perfect blend of innovation and tradition, serving the community one perfect cup at a time.</p>
        <div class="d-flex gap-4 mt-5">
            <div class="text-center">
                <h4 class="fw-800 text-primary mb-0">10k+</h4>
                <p class="small text-muted fw-600">Cups Served</p>
            </div>
            <div class="text-center">
                <h4 class="fw-800 text-primary mb-0">15+</h4>
                <p class="small text-muted fw-600">Global Origins</p>
            </div>
            <div class="text-center">
                <h4 class="fw-800 text-primary mb-0">20+</h4>
                <p class="small text-muted fw-600">Expert Baristas</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="position-relative p-4">
            <div class="bg-primary bg-opacity-10 position-absolute top-0 end-0 w-75 h-75 rounded-5 -z-1"></div>
            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=800" class="img-fluid rounded-5 shadow-lg position-relative" alt="Coffee pouring">
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-5 p-5 h-100 bg-white hover-lift transition-all">
            <div class="display-5 text-primary mb-4"><i class="bi bi-eye"></i></div>
            <h3 class="fw-800 mb-3">Our Vision</h3>
            <p class="text-muted mb-0">To become the gold standard of coffee culture, where quality meets community in every neighborhood we serve.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-5 p-5 h-100 bg-white hover-lift transition-all">
            <div class="display-5 text-primary mb-4"><i class="bi bi-rocket-takeoff"></i></div>
            <h3 class="fw-800 mb-3">Our Mission</h3>
            <p class="text-muted mb-0">To deliver an unparalleled coffee experience through ethical sourcing, artisan roasting, and exceptional service.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-5 p-5 h-100 bg-white hover-lift transition-all">
            <div class="display-5 text-primary mb-4"><i class="bi bi-heart"></i></div>
            <h3 class="fw-800 mb-3">Our Values</h3>
            <p class="text-muted mb-0">Integrity, Sustainability, and Community are at the core of everything we do, from farm to cup.</p>
        </div>
    </div>
</div>

<div class="row bg-dark rounded-5 shadow-2xl p-5 text-center text-white my-5 overflow-hidden position-relative">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="col-12 position-relative">
        <h2 class="display-6 fw-800 mb-4">Quality in Every Drop</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="fs-1 text-primary mb-2"><i class="bi bi-cup-hot"></i></div>
                <h5 class="fw-bold">Artisan Roasts</h5>
                <p class="small opacity-50">Small-batch roasted daily.</p>
            </div>
            <div class="col-md-3">
                <div class="fs-1 text-primary mb-2"><i class="bi bi-globe-americas"></i></div>
                <h5 class="fw-bold">Fair Trade</h5>
                <p class="small opacity-50">Ethically sourced global beans.</p>
            </div>
            <div class="col-md-3">
                <div class="fs-1 text-primary mb-2"><i class="bi bi-people"></i></div>
                <h5 class="fw-bold">Community</h5>
                <p class="small opacity-50">A space for everyone.</p>
            </div>
        </div>
    </div>
</div>

<style>
.text-shadow {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}
</style>

<div class="row my-5 text-center">
    <div class="col-12 mb-5">
        <h2 class="fw-800" style="font-style: italic;">Meet the Team</h2>
        <p class="text-muted">A young and talented students at FEU Institute of Technology</p>
    </div>
    <div class="col-6 col-md-4 mb-4">
        <div class="d-flex flex-column align-items-center">
            <img src="<?= base_url('images/martin_ore.jpg') ?>"
                 class="rounded-circle border border-4 border-white shadow mb-3"
                 width="140" height="140" alt="Ore, Martin Clifford">
            <span class="text-primary fw-800 text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Front-End and Back-End Developer</span>
            <h6 class="fw-800 mt-1 mb-0">Ore, Martin Clifford</h6>
        </div>
    </div>
    <div class="col-6 col-md-4 mb-4">
        <div class="d-flex flex-column align-items-center">
            <img src="<?= base_url('images/saira_salumbides.jpg') ?>"
                 class="rounded-circle border border-4 border-white shadow mb-3"
                 width="140" height="140" alt="Salumbides, Saira Joyce">
            <span class="text-primary fw-800 text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">UI/UX Designer</span>
            <h6 class="fw-800 mt-1 mb-0">Salumbides, Saira Joyce</h6>
        </div>
    </div>
    <div class="col-6 col-md-4 mb-4">
        <div class="d-flex flex-column align-items-center">
            <img src="<?= base_url('images/angela_arrozal.jpg') ?>"
                 class="rounded-circle border border-4 border-white shadow mb-3"
                 width="140" height="140" alt="Arrozal, Angela">
            <span class="text-primary fw-800 text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Documentation</span>
            <h6 class="fw-800 mt-1 mb-0">Arrozal, Angela</h6>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
