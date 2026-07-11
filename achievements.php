<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.achievements');
$achievements = loadData('achievements');
$wins = count(array_filter($achievements, fn($a) => (int) $a['place'] === 1));

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('achievements.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('achievements.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <div class="achievements-counter reveal">
            <div class="achievements-counter__value" data-count="<?= $wins ?>" data-suffix="">0</div>
            <p class="achievements-counter__label"><?= e(__('achievements.total')) ?></p>
        </div>

        <div class="achievements-grid">
            <?php foreach ($achievements as $item): ?>
                <article class="achievement-card card-glow reveal">
                    <div class="achievement-card__place">#<?= (int) $item['place'] ?></div>
                    <h3 class="achievement-card__tournament"><?= e($item['tournament']) ?></h3>
                    <div class="achievement-card__meta">
                        <span class="game-badge game-badge--<?= e($item['game']) ?>"><?= e(gameLabel($item['game'])) ?></span>
                        <span><?= e(formatDate($item['date'])) ?></span>
                        <?php if (!empty($item['prize'])): ?>
                            <span> · <?= e($item['prize']) ?></span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
