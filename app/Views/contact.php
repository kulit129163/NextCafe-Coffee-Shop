<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-5 mt-3">
    <div class="col-12 text-center">
        <h1 class="display-4 fw-900 text-dark mb-3">Get in Touch</h1>
        <p class="lead text-muted">We'd love to hear from you. Drop us a line or swing by the cafe!</p>
    </div>
</div>

<div class="row g-5">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-5 bg-white p-5 h-100">
            <h4 class="fw-800 mb-4">Contact Information</h4>
            
            <div class="d-flex mb-4">
                <div class="fs-4 text-primary me-3 flex-shrink-0"><i class="bi bi-geo-alt-fill"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Our Location</h6>
                    <p class="text-muted mb-0">123 Brew Avenue<br>Coffee District, CD 10012</p>
                </div>
            </div>
            
            <div class="d-flex mb-4">
                <div class="fs-4 text-primary me-3 flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Email Us</h6>
                    <p class="text-muted mb-0">hello@nextcafe.com<br>support@nextcafe.com</p>
                </div>
            </div>
            
            <div class="d-flex mb-5">
                <div class="fs-4 text-primary me-3 flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Call Us</h6>
                    <p class="text-muted mb-0">(555) 123-4567</p>
                </div>
            </div>
            
            <h5 class="fw-800 mb-3 mt-4">Operating Hours</h5>
            <div class="d-flex justify-content-between text-muted border-bottom py-2">
                <span>Monday - Friday</span>
                <span class="fw-bold text-dark">7:00 AM - 8:00 PM</span>
            </div>
            <div class="d-flex justify-content-between text-muted border-bottom py-2">
                <span>Saturday</span>
                <span class="fw-bold text-dark">8:00 AM - 9:00 PM</span>
            </div>
            <div class="d-flex justify-content-between text-muted py-2">
                <span>Sunday</span>
                <span class="fw-bold text-dark">8:00 AM - 6:00 PM</span>
            </div>
        </div>
    </div>
    
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-5 bg-white p-5 h-100">
            <h4 class="fw-800 mb-4">Send a Message</h4>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success rounded-4 fw-600 mb-4"><i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-4 fw-600 mb-4"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger rounded-4 fw-600 mb-4">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $e): ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('contact') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label x-small fw-800 text-muted mb-2">YOUR NAME</label>
                        <input type="text" name="name" class="form-control bg-light border-0 rounded-pill px-4 py-3 fw-600" placeholder="John Doe" value="<?= old('name') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label x-small fw-800 text-muted mb-2">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control bg-light border-0 rounded-pill px-4 py-3 fw-600" placeholder="john@example.com" value="<?= old('email') ?>" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label x-small fw-800 text-muted mb-2">SUBJECT</label>
                    <input type="text" name="subject" class="form-control bg-light border-0 rounded-pill px-4 py-3 fw-600" placeholder="How can we help?" value="<?= old('subject') ?>" required>
                </div>
                
                <div class="mb-5">
                    <label class="form-label x-small fw-800 text-muted mb-2">MESSAGE</label>
                    <textarea name="message" class="form-control bg-light border-0 rounded-4 px-4 py-3 fw-600" rows="5" placeholder="Write your message here..." required><?= old('message') ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-800 w-100 shadow-sm fs-5">Send Message</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
