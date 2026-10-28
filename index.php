<?php
declare(strict_types=1);

$pageTitle = 'Home';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero-slider" data-slider aria-label="Featured highlights">
    <div class="hero-slide is-active" data-slide style="--slide-image: url('assets/images/concept-slider.svg')" aria-hidden="false">
        <div class="hero-content">
            <p class="eyebrow">Welcome to <?= e($businessName) ?></p>
            <h1>Ideas made practical.</h1>
            <p>We turn ambitious concepts into clear, useful solutions for modern businesses.</p>
            <a class="button" href="services.php">Explore our services</a>
        </div>
    </div>
    <div class="hero-slide" data-slide style="--slide-image: url('assets/images/strategy-slider.svg')" aria-hidden="true">
        <div class="hero-content">
            <p class="eyebrow">Plan with purpose</p>
            <h2>Strategy that moves you forward.</h2>
            <p>Build a focused roadmap and turn business goals into measurable progress.</p>
            <a class="button button-light" href="about.php">Discover our approach</a>
        </div>
    </div>
    <div class="hero-slide" data-slide style="--slide-image: url('assets/images/digital-slider.svg')" aria-hidden="true">
        <div class="hero-content">
            <p class="eyebrow">Designed for tomorrow</p>
            <h2>Digital experiences that connect.</h2>
            <p>Modern design, thoughtful experiences, and reliable solutions for your audience.</p>
            <a class="button button-light" href="contact.php">Start a project</a>
        </div>
    </div>

    <div class="slider-controls" aria-label="Slider controls">
        <button type="button" class="slider-arrow" data-slider-prev aria-label="Previous slide">←</button>
        <div class="slider-dots">
            <button type="button" data-slide-dot aria-label="Show slide 1" aria-current="true"></button>
            <button type="button" data-slide-dot aria-label="Show slide 2" aria-current="false"></button>
            <button type="button" data-slide-dot aria-label="Show slide 3" aria-current="false"></button>
        </div>
        <button type="button" class="slider-arrow" data-slider-next aria-label="Next slide">→</button>
    </div>
</section>
<section class="feature-grid" aria-label="Highlights">
    <article><h2>Creative thinking</h2><p>Fresh perspectives built around your goals.</p></article>
    <article><h2>Reliable delivery</h2><p>Structured, transparent work from start to finish.</p></article>
    <article><h2>Long-term value</h2><p>Solutions designed to support sustainable growth.</p></article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
