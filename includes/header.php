<?php
/** @var string $pageTitle */
/** @var string $pageKey meta key e.g. meta.home */
$pageTitle = $pageTitle ?? __('meta.home');
$fullTitle = $pageTitle . ' | ' . $config['site_name'];
$activePage = currentPage();
?>
<!DOCTYPE html>
<html lang="<?= e($currentLang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($config['site_name'] . ' — ' . tagline()) ?>">
    <title><?= e($fullTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <style>
        :root {
            --color-primary: <?= e($config['colors']['primary']) ?>;
            --color-secondary: <?= e($config['colors']['secondary']) ?>;
            --color-accent: <?= e($config['colors']['accent']) ?>;
            --color-bg: <?= e($config['colors']['bg']) ?>;
            --color-bg-card: <?= e($config['colors']['bg_card']) ?>;
            --color-text: <?= e($config['colors']['text']) ?>;
            --color-text-muted: <?= e($config['colors']['text_muted']) ?>;
        }
    </style>
</head>
<body>
    <a class="skip-link" href="#main-content"><?= $currentLang === 'pl' ? 'Przejdź do treści' : 'Skip to content' ?></a>

    <header class="site-header" id="site-header">
        <div class="container site-header__inner">
            <a class="logo" href="index.php" aria-label="<?= e($config['site_name']) ?>">
                <svg class="logo__svg" viewBox="0 0 240 40" aria-hidden="true">
                    <defs>
                        <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="var(--color-primary)"/>
                            <stop offset="100%" stop-color="var(--color-secondary)"/>
                        </linearGradient>
                    </defs>
                    <text x="0" y="30" fill="url(#logoGrad)" font-family="Orbitron, sans-serif" font-size="22" font-weight="700">NEONPULSE</text>
                </svg>
            </a>

            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="site-nav">
                <span></span><span></span><span></span>
            </button>

            <nav class="site-nav" id="site-nav" aria-label="Main">
                <ul class="site-nav__list">
                    <?php foreach ($config['nav'] as $navItem): ?>
                        <?php $isActive = $activePage === $navItem['page']; ?>
                        <li>
                            <a class="site-nav__link<?= $isActive ? ' is-active' : '' ?>"
                               href="<?= e(pageUrl($navItem['page'])) ?>"
                               <?= $isActive ? 'aria-current="page"' : '' ?>>
                                <?= e(__($navItem['key'])) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="lang-switch" aria-label="Language">
                <a class="lang-switch__btn<?= $currentLang === 'pl' ? ' is-active' : '' ?>" href="<?= e(langUrl('pl')) ?>">PL</a>
                <span class="lang-switch__sep">|</span>
                <a class="lang-switch__btn<?= $currentLang === 'en' ? ' is-active' : '' ?>" href="<?= e(langUrl('en')) ?>">EN</a>
            </div>
        </div>
    </header>

    <main id="main-content">
