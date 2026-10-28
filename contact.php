<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$pageTitle = 'Contact';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$values = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'service' => '',
    'message' => '',
];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = (string) $_SESSION['csrf_token'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $field => $unusedValue) {
        $values[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    $submittedToken = trim((string) ($_POST['csrf_token'] ?? ''));
    if (!hash_equals($csrfToken, $submittedToken)) {
        $errors['csrf'] = 'Your form session has expired. Please try again.';
    }

    if ($values['name'] === '') {
        $errors['name'] = 'Please enter your name.';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'Please enter your email address.';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    $validServiceSlugs = array_column($services, 'slug');
    if ($values['service'] === '') {
        $errors['service'] = 'Please select a service.';
    } elseif (!in_array($values['service'], $validServiceSlugs, true)) {
        $errors['service'] = 'Please select a valid service.';
    }

    $messageLength = mb_strlen($values['message'], 'UTF-8');
    if ($values['message'] === '') {
        $errors['message'] = 'Please enter a message.';
    } elseif ($messageLength < 10 || $messageLength > 1000) {
        $errors['message'] = 'Your message must be between 10 and 1000 characters.';
    }

    if ($errors === []) {
        $storageDirectory = __DIR__ . '/storage';
        if (!is_dir($storageDirectory) && !mkdir($storageDirectory, 0755, true) && !is_dir($storageDirectory)) {
            $errors['form'] = 'Sorry, your message could not be saved. Please try again.';
        } else {
            $submission = [
                'timestamp' => gmdate('c'),
                'name' => $values['name'],
                'email' => $values['email'],
                'phone' => $values['phone'],
                'service' => $values['service'],
                'message' => $values['message'],
            ];

            $jsonLine = json_encode($submission, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if ($jsonLine === false || file_put_contents($storageDirectory . '/messages.jsonl', $jsonLine . PHP_EOL, FILE_APPEND | LOCK_EX) === false) {
                $errors['form'] = 'Sorry, your message could not be saved. Please try again.';
            } else {
                header('Location: contact.php?sent=1');
                exit;
            }
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="page-heading">
    <p class="eyebrow">Get in touch</p>
    <h1>Let's start a conversation</h1>
</section>

<?php if (isset($_GET['sent']) && $_GET['sent'] === '1'): ?>
    <div class="alert success" role="alert">
        Thank you! Your message has been sent successfully.
    </div>
<?php endif; ?>

<?php if (isset($errors['csrf'])): ?>
    <div class="alert error" role="alert"><?= e($errors['csrf']) ?></div>
<?php endif; ?>
<?php if (isset($errors['form'])): ?>
    <div class="alert error" role="alert"><?= e($errors['form']) ?></div>
<?php endif; ?>

<section class="content-panel contact-panel">
    <form class="contact-form" method="post" action="contact.php" novalidate>
        <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

        <div class="form-field">
            <label for="name">Name <span aria-hidden="true">*</span></label>
            <input id="name" name="name" type="text" value="<?= e($values['name']) ?>" required aria-describedby="name-error">
            <?php if (isset($errors['name'])): ?><small id="name-error" class="field-error"><?= e($errors['name']) ?></small><?php endif; ?>
        </div>

        <div class="form-field">
            <label for="email">Email <span aria-hidden="true">*</span></label>
            <input id="email" name="email" type="email" value="<?= e($values['email']) ?>" required aria-describedby="email-error">
            <?php if (isset($errors['email'])): ?><small id="email-error" class="field-error"><?= e($errors['email']) ?></small><?php endif; ?>
        </div>

        <div class="form-field">
            <label for="phone">Phone <small>(optional)</small></label>
            <input id="phone" name="phone" type="tel" value="<?= e($values['phone']) ?>">
        </div>

        <div class="form-field">
            <label for="service">Service <span aria-hidden="true">*</span></label>
            <select id="service" name="service" required aria-describedby="service-error">
                <option value="">Choose a service</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= e((string) $service['slug']) ?>" <?= $values['service'] === $service['slug'] ? 'selected' : '' ?>><?= e((string) $service['title']) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['service'])): ?><small id="service-error" class="field-error"><?= e($errors['service']) ?></small><?php endif; ?>
        </div>

        <div class="form-field form-field-full">
            <label for="message">Message <span aria-hidden="true">*</span></label>
            <textarea id="message" name="message" rows="6" required aria-describedby="message-error"><?= e($values['message']) ?></textarea>
            <?php if (isset($errors['message'])): ?><small id="message-error" class="field-error"><?= e($errors['message']) ?></small><?php endif; ?>
        </div>

        <button class="button form-button" type="submit">Send message</button>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
