<?= $this->extend('layout/split_auth') ?>

<?php $this->setData([
    'left_heading' => 'Join the<br>NextCafe Family',
    'left_subtext'  => 'Create your account and start exploring our premium coffee collection. Your perfect cup is just a click away.'
]) ?>

<?= $this->section('content') ?>

<h1 class="form-title">Create account</h1>
<p class="form-subtitle">Join NextCafe and start your coffee journey today.</p>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="auth-alert danger">
        <i class="bi bi-exclamation-circle-fill"></i>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="form-divider"><span>Fill in your details</span></div>

<form action="<?= base_url('register') ?>" method="POST">

    <div class="field-group">
        <label class="field-label" for="reg-usr">Username</label>
        <div class="field-wrap">
            <i class="bi bi-person fi"></i>
            <input type="text" id="reg-usr" name="username" placeholder="Choose a username" value="<?= old('username') ?>" required>
        </div>
    </div>

    <div class="field-group">
        <label class="field-label" for="reg-email">Email Address</label>
        <div class="field-wrap">
            <i class="bi bi-envelope fi"></i>
            <input type="email" id="reg-email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
        </div>
    </div>

    <div class="field-group">
        <label class="field-label" for="reg-pw">Password</label>
        <div class="field-wrap">
            <i class="bi bi-lock fi"></i>
            <input type="password" id="reg-pw" name="password" placeholder="Min. 8 characters" required>
            <button type="button" class="toggle-pw" aria-label="Show/hide password">
                <i class="bi bi-eye"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn-auth" style="margin-top:.6rem;">Create Account</button>

</form>

<p class="auth-alt">Already have an account? <a href="<?= base_url('login') ?>">Sign In</a></p>

<?= $this->endSection() ?>
