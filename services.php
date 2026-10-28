<?php
declare(strict_types=1);

$pageTitle = 'Services';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-heading">
    <p class="eyebrow">What we do</p>
    <h1>Services</h1>
</section>
<section class="service-grid">
    <?php foreach ($services as $service): ?>
        <?= renderServiceCard($service) ?>
    <?php endforeach; ?>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
