<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$pageTitle = 'Messages';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

if (empty($_SESSION['messages_csrf_token'])) {
    $_SESSION['messages_csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = (string) $_SESSION['messages_csrf_token'];
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    $submittedToken = trim((string) ($_POST['csrf_token'] ?? ''));
    if (hash_equals($csrfToken, $submittedToken)) {
        unset($_SESSION['messages_authenticated']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $submittedToken = trim((string) ($_POST['csrf_token'] ?? ''));
    $submittedPassword = trim((string) ($_POST['password'] ?? ''));

    if (!hash_equals($csrfToken, $submittedToken)) {
        $loginError = 'Your login session has expired. Please try again.';
    } elseif (hash_equals($adminPassword, $submittedPassword)) {
        $_SESSION['messages_authenticated'] = true;
        session_regenerate_id(true);
    } else {
        $loginError = 'Incorrect password.';
    }
}

$isAuthenticated = isset($_SESSION['messages_authenticated']) && $_SESSION['messages_authenticated'] === true;

require_once __DIR__ . '/includes/header.php';
?>
<section class="page-heading">
    <p class="eyebrow">Admin</p>
    <h1>Contact messages</h1>
</section>

<?php if (!$isAuthenticated): ?>
    <section class="content-panel login-panel">
        <h2>Protected access</h2>
        <p>Enter the local administrator password to view submissions.</p>
        <?php if ($loginError !== ''): ?>
            <div class="alert error" role="alert"><?= e($loginError) ?></div>
        <?php endif; ?>
        <form method="post" action="messages.php" class="login-form">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autofocus>
            <button class="button form-button" type="submit">Log in</button>
        </form>
    </section>
<?php else: ?>
    <?php
    $messages = [];
    $messageFile = __DIR__ . '/storage/messages.jsonl';

    if (is_file($messageFile)) {
        $lines = file($messageFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines !== false) {
            foreach ($lines as $line) {
                $message = json_decode($line, true);
                if (is_array($message)) {
                    $messages[] = $message;
                }
            }
        }
    }

    $messages = array_reverse($messages);
    ?>

    <div class="messages-toolbar">
        <span class="count-badge"><?= count($messages) ?> <?= count($messages) === 1 ? 'message' : 'messages' ?></span>
        <form method="post" action="messages.php">
            <input type="hidden" name="action" value="logout">
            <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
            <button class="button secondary-button" type="submit">Log out</button>
        </form>
    </div>

    <?php if ($messages === []): ?>
        <section class="content-panel">
            <p>No contact messages have been submitted yet.</p>
        </section>
    <?php else: ?>
        <div class="messages-table-wrap">
            <table class="messages-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?= e((string) ($message['timestamp'] ?? '')) ?></td>
                            <td><?= e((string) ($message['name'] ?? '')) ?></td>
                            <td><?= e((string) ($message['email'] ?? '')) ?></td>
                            <td><?= e((string) ($message['phone'] ?? '')) ?></td>
                            <td><?= e((string) ($message['service'] ?? '')) ?></td>
                            <td><?= e((string) ($message['message'] ?? '')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<?php endif;

require_once __DIR__ . '/includes/footer.php';
