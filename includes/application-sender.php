<?php

function sendApplicationEmail(array $mailConfig, array $application): bool
{
    if (empty($mailConfig['mail_enabled']) || empty($mailConfig['email'])) {
        return false;
    }

    $body = implode("\n", [
        'Position: ' . ($application['position'] ?? ''),
        'Game: ' . ($application['game'] ?? ''),
        'Name: ' . ($application['name'] ?? ''),
        'Email: ' . ($application['email'] ?? ''),
        'Discord: ' . ($application['discord'] ?? '-'),
        '',
        ($application['message'] ?? ''),
    ]);

    $headers = [
        'From: ' . $mailConfig['email'],
        'Reply-To: ' . ($application['email'] ?? $mailConfig['email']),
        'Content-Type: text/plain; charset=UTF-8',
    ];

    return @mail(
        $mailConfig['email'],
        '[NeonPulse Recruitment] ' . ($application['position'] ?? 'Application'),
        $body,
        implode("\r\n", $headers)
    );
}

function sendDiscordWebhook(string $webhookUrl, array $application): bool
{
    if ($webhookUrl === '') {
        return false;
    }

    $payload = [
        'embeds' => [[
            'title' => '🎮 Nowa aplikacja rekrutacyjna / New recruitment application',
            'color' => 65535,
            'fields' => [
                ['name' => 'Stanowisko / Position', 'value' => $application['position'] ?? '-', 'inline' => false],
                ['name' => 'Gra / Game', 'value' => $application['game'] ?? '-', 'inline' => true],
                ['name' => 'Nick / Name', 'value' => $application['name'] ?? '-', 'inline' => true],
                ['name' => 'E-mail', 'value' => $application['email'] ?? '-', 'inline' => true],
                ['name' => 'Discord', 'value' => $application['discord'] ?? '-', 'inline' => true],
                ['name' => 'Wiadomość / Message', 'value' => mb_substr($application['message'] ?? '-', 0, 1000), 'inline' => false],
            ],
            'footer' => ['text' => 'NeonPulse Esports Recruitment'],
            'timestamp' => gmdate('c'),
        ]],
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($payload, JSON_UNESCAPED_UNICODE),
            'timeout' => 10,
            'ignore_errors' => true,
        ],
    ]);

    $response = @file_get_contents($webhookUrl, false, $context);

    if ($response === false) {
        return false;
    }

    if (isset($http_response_header[0]) && strpos($http_response_header[0], '204') !== false) {
        return true;
    }

    if (isset($http_response_header[0]) && strpos($http_response_header[0], '200') !== false) {
        return true;
    }

    return $response !== false;
}

function logApplication(string $logPath, array $application): void
{
    $logDir = dirname($logPath);
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $entry = sprintf(
        "[%s] %s | %s <%s> | Discord: %s | %s\n%s\n---\n",
        date('Y-m-d H:i:s'),
        $application['position'] ?? '',
        $application['name'] ?? '',
        $application['email'] ?? '',
        $application['discord'] ?? '-',
        $application['game'] ?? '',
        $application['message'] ?? ''
    );

    file_put_contents($logPath, $entry, FILE_APPEND | LOCK_EX);
}

function processRecruitmentApplication(array $recruitmentConfig, array $application): bool
{
    $emailSent = sendApplicationEmail($recruitmentConfig, $application);
    $discordSent = false;

    if (!empty($recruitmentConfig['discord_enabled']) && !empty($recruitmentConfig['discord_webhook'])) {
        $discordSent = sendDiscordWebhook($recruitmentConfig['discord_webhook'], $application);
    }

    if (!$emailSent && !$discordSent) {
        logApplication($recruitmentConfig['log_path'], $application);
    }

    return $emailSent || $discordSent || true;
}
