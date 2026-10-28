<?php
$pageTitle = 'Contact';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-heading">
    <p class="eyebrow">Get in touch</p>
    <h1>Let's start a conversation</h1>
</section>
<section class="content-panel contact-panel">
    <p>Have a project or an idea? Send us an email and tell us what you have in mind.</p>
    <a class="button" href="mailto:<?= htmlspecialchars($contactEmail) ?>">Email <?= htmlspecialchars($contactEmail) ?></a>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
