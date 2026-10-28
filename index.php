<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div>
        <p class="eyebrow">Welcome to <?= htmlspecialchars($businessName) ?></p>
        <h1>Ideas made practical.</h1>
        <p>We turn ambitious concepts into clear, useful solutions for modern businesses.</p>
        <a class="button" href="services.php">Explore our services</a>
    </div>
</section>
<section class="feature-grid" aria-label="Highlights">
    <article><h2>Creative thinking</h2><p>Fresh perspectives built around your goals.</p></article>
    <article><h2>Reliable delivery</h2><p>Structured, transparent work from start to finish.</p></article>
    <article><h2>Long-term value</h2><p>Solutions designed to support sustainable growth.</p></article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
