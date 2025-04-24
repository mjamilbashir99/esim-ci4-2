<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<h2>Register</h2>

<?php if (isset($validation)) : ?>
    <div style="color:red;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= site_url('register') ?>" method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?= old('name') ?>"><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= old('email') ?>"><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= old('phone') ?>"><br>

    <label>Password:</label>
    <input type="password" name="password"><br>

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password"><br>

    <button type="submit">Register</button>
</form>

<?= $this->endSection() ?>
