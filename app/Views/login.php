<?= $this->extend('layout/split_auth') ?>

<?= $this->section('content') ?>

<h1 class="form-title">Welcome back</h1>
<p class="form-subtitle">Sign in to your NextCafe account to continue.</p>

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

<div class="form-divider"><span>Login to your account</span></div>

<form action="<?= base_url('login') ?>" method="POST">

    <div class="field-group">
        <label class="field-label" for="login-id">Username or Email</label>
        <div class="field-wrap">
            <i class="bi bi-person fi"></i>
            <input type="text" id="login-id" name="login" placeholder="Enter your username or email" required>
        </div>
    </div>

    <div class="field-group">
        <label class="field-label" for="login-pw">Password</label>
        <div class="field-wrap">
            <i class="bi bi-lock fi"></i>
            <input type="password" id="login-pw" name="password" placeholder="Enter your password" required>
            <button type="button" class="toggle-pw" aria-label="Show/hide password">
                <i class="bi bi-eye"></i>
            </button>
        </div>
    </div>

    <div class="form-opts">
        <label><input type="checkbox" name="remember"> Remember me</label>
        <a href="#">Forgot password?</a>
    </div>

    <button type="submit" class="btn-auth">Login</button>

</form>

<p class="auth-alt">Don't have an account? <a href="<?= base_url('register') ?>">Register Now</a></p>

<?= $this->endSection() ?>
