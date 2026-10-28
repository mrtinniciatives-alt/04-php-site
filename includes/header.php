<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> | <?= e($businessName) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/slider.js" defer></script>
</head>
<body>
    <header class="site-header">
        <a class="brand" href="index.php">
            <strong><?= e($businessName) ?></strong>
            <span><?= e($tagline) ?></span>
        </a>
        <nav class="site-nav" aria-label="Main navigation">
            <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
            <?php foreach ($navItems as $label => $file): ?>
                <?php $isActive = $currentPage === $file || ($file === 'services.php' && $currentPage === 'service.php'); ?>
                <?php if ($isActive): ?>
                    <a class="active" href="<?= e($file) ?>" aria-current="page"><?= e($label) ?></a>
                <?php else: ?>
                    <a href="<?= e($file) ?>"><?= e($label) ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    </header>
    <main class="site-main">
