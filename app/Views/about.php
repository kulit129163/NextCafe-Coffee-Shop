<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-5">
    <div class="col-12">
        <div class="position-relative overflow-hidden rounded-5 shadow-sm" style="height: 400px;">
            <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2000&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" alt="Coffee Shop Interior">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100 px-3">
                <h1 class="display-3 fw-900 mb-3 text-shadow">Our Story</h1>
                <p class="lead fw-600 mb-0">Crafting the perfect cup since 2024</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-5 align-items-center mb-5">
    <div class="col-lg-6">
        <h2 class="fw-800 text-dark mb-4">Born from a passion for great coffee</h2>
        <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">NextCafe started with a simple idea: coffee should be an experience, not just a morning routine. We source our beans from sustainable, fair-trade farms across the globe, ensuring every cup supports the communities that grow them.</p>
        <p class="text-muted fs-5 mb-0" style="line-height: 1.8;">Our expert roasters and baristas are dedicated to bringing out the unique flavor profile of every origin. Whether you prefer a bright, fruity pour-over or a rich, chocolatey espresso, we've got something special waiting for you.</p>
    </div>
    <div class="col-lg-6">
        <div class="row g-4">
            <div class="col-6">
                <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm h-100 object-fit-cover" alt="Barista pouring coffee">
            </div>
            <div class="col-6 mt-lg-5">
                <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm h-100 object-fit-cover" alt="Coffee beans">
            </div>
        </div>
    </div>
</div>

<div class="row bg-white rounded-5 shadow-sm p-5 text-center g-4">
    <div class="col-md-4">
        <div class="display-4 text-primary mb-3"><i class="bi bi-cup-hot"></i></div>
        <h3 class="fw-bold mb-2">Artisan Roasts</h3>
        <p class="text-muted">Small-batch roasted daily to ensure maximum freshness and flavor.</p>
    </div>
    <div class="col-md-4">
        <div class="display-4 text-primary mb-3"><i class="bi bi-globe-americas"></i></div>
        <h3 class="fw-bold mb-2">Fair Trade</h3>
        <p class="text-muted">Ethically sourced beans that empower local farmers and communities.</p>
    </div>
    <div class="col-md-4">
        <div class="display-4 text-primary mb-3"><i class="bi bi-people"></i></div>
        <h3 class="fw-bold mb-2">Community First</h3>
        <p class="text-muted">More than a cafe, we are a gathering space for friends and neighbors.</p>
    </div>
</div>

<style>
.text-shadow {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}
</style>
<?= $this->endSection() ?>
