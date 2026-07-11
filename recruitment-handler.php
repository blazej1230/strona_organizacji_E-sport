<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/application-sender.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: recruitment.php');
    exit;
}

$positionId = (int) ($_POST['position_id'] ?? 0);
$position = recruitmentById($positionId);

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$discord = trim($_POST['discord'] ?? '');
$message = trim($_POST['message'] ?? '');

$old = compact('name', 'email', 'discord', 'message', 'positionId');
$errors = [];

if (!$position || empty($position['open'])) {
    $errors[] = 'position';
}

if ($name === '' || mb_strlen($name) < 2) {
    $errors[] = 'name';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email';
}

if ($message === '' || mb_strlen($message) < 20) {
    $errors[] = 'message';
}

if (!empty($errors)) {
    $_SESSION['recruitment_flash'] = [
        'type' => 'error',
        'message' => __('recruitment.validation'),
        'old' => $old,
    ];
    header('Location: recruitment.php' . ($positionId ? '#apply-' . $positionId : ''));
    exit;
}

$application = [
    'position' => localized($position, 'title'),
    'game' => gameLabel($position['game']),
    'name' => $name,
    'email' => $email,
    'discord' => $discord !== '' ? $discord : '-',
    'message' => $message,
];

processRecruitmentApplication($config['recruitment'], $application);

$_SESSION['recruitment_flash'] = [
    'type' => 'success',
    'message' => __('recruitment.success'),
    'old' => [],
];

header('Location: recruitment.php');
exit;
