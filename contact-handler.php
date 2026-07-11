<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$old = compact('name', 'email', 'subject', 'message');
$errors = [];

if ($name === '' || mb_strlen($name) < 2) {
    $errors[] = 'name';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email';
}

if ($subject === '' || mb_strlen($subject) < 3) {
    $errors[] = 'subject';
}

if ($message === '' || mb_strlen($message) < 10) {
    $errors[] = 'message';
}

if (!empty($errors)) {
    $_SESSION['contact_flash'] = [
        'type' => 'error',
        'message' => __('contact.validation'),
        'old' => $old,
    ];
    header('Location: contact.php');
    exit;
}

$body = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\n{$message}";
$sent = false;
$contactConfig = $config['contact'];

if (!empty($contactConfig['mail_enabled'])) {
    $headers = [
        'From: ' . $contactConfig['email'],
        'Reply-To: ' . $email,
        'Content-Type: text/plain; charset=UTF-8',
    ];
    $sent = @mail($contactConfig['email'], '[NeonPulse] ' . $subject, $body, implode("\r\n", $headers));
}

if (!$sent) {
    $logDir = dirname($contactConfig['log_path']);
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $logEntry = sprintf(
        "[%s] %s <%s> | %s\n%s\n---\n",
        date('Y-m-d H:i:s'),
        $name,
        $email,
        $subject,
        $message
    );

    file_put_contents($contactConfig['log_path'], $logEntry, FILE_APPEND | LOCK_EX);
}

$_SESSION['contact_flash'] = [
    'type' => 'success',
    'message' => __('contact.success'),
    'old' => [],
];

header('Location: contact.php');
exit;
