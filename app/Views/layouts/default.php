<!-- app/Views/layouts/default.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'My App') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

    <?= view('partials/header') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= view('partials/footer') ?>

</body>
</html>
