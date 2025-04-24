<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'My Website' ?></title>
</head>
<body>
    <header>
        <h1>My Website</h1>
    </header>

    <div class="content">
        <?= $content ?>
    </div>

    <footer>
        <p>&copy; 2025 Your Website</p>
    </footer>
</body>
</html>
