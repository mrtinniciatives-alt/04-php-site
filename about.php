<?php
$pageTitle = 'About';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-heading">
    <p class="eyebrow">About us</p>
    <h1>Built on initiative and practical thinking</h1>
</section>
<section class="content-panel">
    <h2>Our story</h2>
    <p><?= htmlspecialchars($businessName) ?> is a fictional creative business focused on useful ideas, thoughtful collaboration, and measurable outcomes.</p>
    <p>Our approach combines curiosity with a strong focus on quality, simplicity, and the needs of every client.</p>
    <h2>Our values</h2>
    <ul>
        <li>Clear communication</li>
        <li>Creative initiative</li>
        <li>Responsible delivery</li>
    </ul>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
