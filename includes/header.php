<?php require_once __DIR__ . '/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?> | <?= htmlspecialchars($businessName) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="index.php">
            <strong><?= htmlspecialchars($businessName) ?></strong>
            <span><?= htmlspecialchars($tagline) ?></span>
        </a>
        <nav class="site-nav" aria-label="Main navigation">
            <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
            <?php foreach ($navItems as $label => $file): ?>
                <?php if ($currentPage === $file): ?>
                    <a class="active" href="<?= htmlspecialchars($file) ?>" aria-current="page"><?= htmlspecialchars($label) ?></a>
                <?php else: ?>
                    <a href="<?= htmlspecialchars($file) ?>"><?= htmlspecialchars($label) ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    </header>
    <main class="site-main">
