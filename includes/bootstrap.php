<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/../config/config.php';

$allowedLangs = ['pl', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLangs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$currentLang = $_SESSION['lang'] ?? $config['default_lang'];

if (!in_array($currentLang, $allowedLangs, true)) {
    $currentLang = $config['default_lang'];
}

$lang = require __DIR__ . '/../config/lang/' . $currentLang . '.php';

function __($key): string
{
    global $lang;
    return $lang[$key] ?? $key;
}

function langUrl(string $targetLang): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = strtok($uri, '?');
    $query = $_GET;
    $query['lang'] = $targetLang;
    return $path . '?' . http_build_query($query);
}

function pageUrl(string $page): string
{
    if ($page === 'index') {
        return 'index.php';
    }
    return $page . '.php';
}

function loadData(string $name): array
{
    $path = __DIR__ . '/../config/data/' . $name . '.php';
    if (!file_exists($path)) {
        return [];
    }
    return require $path;
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function currentPage(): string
{
    $script = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php', '.php');
    return $script === 'index' ? 'index' : $script;
}

function tagline(): string
{
    global $config, $currentLang;
    return $config['tagline'][$currentLang] ?? $config['tagline']['pl'];
}

function gameLabel(string $gameId): string
{
    $map = [
        'cs2' => 'game.cs2',
        'lol' => 'game.lol',
        'valorant' => 'game.valorant',
    ];
    return __($map[$gameId] ?? $gameId);
}

function formatDate(string $date, string $format = 'd.m.Y'): string
{
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return $date;
    }
    return date($format, $timestamp);
}

function newsById(int $id): ?array
{
    $news = loadData('news');
    foreach ($news as $item) {
        if ((int) ($item['id'] ?? 0) === $id) {
            return $item;
        }
    }
    return null;
}

function localized(array $item, string $field): string
{
    global $currentLang;
    $key = $field . '_' . $currentLang;
    if (!empty($item[$key])) {
        return $item[$key];
    }
    return $item[$field . '_pl'] ?? $item[$field] ?? '';
}
