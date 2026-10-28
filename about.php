<?php
declare(strict_types=1);

$pageTitle = 'About';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-heading">
    <p class="eyebrow">About us</p>
    <h1>Built on initiative and practical thinking</h1>
</section>
<section class="content-panel">
    <h2>Our story</h2>
    <p><?= e($businessName) ?> is a fictional creative business focused on useful ideas, thoughtful collaboration, and measurable outcomes.</p>
    <p>Our approach combines curiosity with a strong focus on quality, simplicity, and the needs of every client.</p>
</section>
<section class="team-section">
    <h2>Meet the team</h2>
    <div class="team-grid">
        <?php foreach ($team as $member): ?>
            <article class="team-card">
                <h3><?= e((string) $member['name']) ?></h3>
                <p class="team-role"><?= e((string) $member['role']) ?></p>
                <p><?= e((string) $member['bio']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
