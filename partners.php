<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.partners');
$partners = loadData('partners');
$tiers = [
    'main' => 'partners.main',
    'gold' => 'partners.gold',
    'community' => 'partners.community',
];

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('partners.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('partners.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <?php foreach ($tiers as $tier => $labelKey): ?>
            <?php
            $tierPartners = array_filter($partners, fn($p) => $p['tier'] === $tier);
            if (empty($tierPartners)) continue;
            ?>
            <div class="partners-tier reveal">
                <h2 class="partners-tier__title"><?= e(__($labelKey)) ?></h2>
                <div class="partners-grid">
                    <?php foreach ($tierPartners as $partner): ?>
                        <a href="<?= e($partner['url']) ?>" target="_blank" rel="noopener noreferrer"
                           class="partner-card card-glow<?= $tier === 'main' ? ' partner-card--main' : '' ?>">
                            <div class="partner-card__logo"><?= e(strtoupper(substr($partner['name'], 0, 1))) ?></div>
                            <span class="partner-card__name"><?= e($partner['name']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
