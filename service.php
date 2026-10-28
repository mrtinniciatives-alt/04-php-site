<?php
declare(strict_types=1);

$pageTitle = 'Service Details';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';

$slug = isset($_GET['slug']) ? (string) $_GET['slug'] : '';
$service = null;

foreach ($services as $item) {
    if ($item['slug'] === $slug) {
        $service = $item;
        break;
    }
}

if ($service === null) {
    http_response_code(404);
    $pageTitle = 'Service Not Found';
}

require_once __DIR__ . '/includes/header.php';

if ($service === null): ?>
    <section class="page-heading">
        <p class="eyebrow">404 error</p>
        <h1>Service not found</h1>
    </section>
    <section class="content-panel">
        <p>Sorry, we couldn't find the service you were looking for.</p>
        <a class="button" href="services.php">View all services</a>
    </section>
<?php else: ?>
    <article class="service-detail">
        <span class="service-icon" aria-hidden="true"><?= e((string) $service['icon']) ?></span>
        <p class="eyebrow">Our service</p>
        <h1><?= e((string) $service['title']) ?></h1>
        <p><?= e((string) $service['description']) ?></p>
        <p class="service-price"><strong>From <?= e(formatPrice((float) $service['price'])) ?></strong></p>
        <a class="button" href="contact.php">Request this service</a>
    </article>
<?php endif;

require_once __DIR__ . '/includes/footer.php';
