<?php

return [
    'site_name' => 'NeonPulse Esports',
    'site_url' => '',
    'default_lang' => 'pl',
    'author' => 'Błazej',
    'repo_url' => 'https://github.com/blazej1230/strona_organizacji_E-sport',
    'tagline' => [
        'pl' => 'Pulsujemy razem z grą',
        'en' => 'We pulse with the game',
    ],
    'colors' => [
        'primary' => '#00f0ff',
        'secondary' => '#ff006e',
        'accent' => '#7b2ff7',
        'bg' => '#0a0a0f',
        'bg_card' => '#12121a',
        'text' => '#e8e8f0',
        'text_muted' => '#8888a0',
    ],
    'stats' => [
        ['value' => 3, 'suffix' => '', 'key' => 'stats.teams'],
        ['value' => 15, 'suffix' => '+', 'key' => 'stats.trophies'],
        ['value' => 50, 'suffix' => 'K', 'key' => 'stats.followers'],
        ['value' => 3, 'suffix' => '', 'key' => 'stats.games'],
    ],
    'social' => [
        'discord' => 'https://discord.gg/neonpulse',
        'twitter' => 'https://twitter.com/neonpulsegg',
        'twitch' => 'https://twitch.tv/neonpulsegg',
        'youtube' => 'https://youtube.com/@neonpulsegg',
        'instagram' => 'https://instagram.com/neonpulsegg',
    ],
    'contact' => [
        'email' => 'contact@neonpulse.gg',
        'mail_enabled' => true,
        'log_path' => __DIR__ . '/../logs/contact.log',
    ],
    'nav' => [
        ['page' => 'index', 'key' => 'nav.home'],
        ['page' => 'teams', 'key' => 'nav.teams'],
        ['page' => 'achievements', 'key' => 'nav.achievements'],
        ['page' => 'news', 'key' => 'nav.news'],
        ['page' => 'schedule', 'key' => 'nav.schedule'],
        ['page' => 'partners', 'key' => 'nav.partners'],
        ['page' => 'gallery', 'key' => 'nav.gallery'],
        ['page' => 'recruitment', 'key' => 'nav.recruitment'],
        ['page' => 'contact', 'key' => 'nav.contact'],
    ],
];
