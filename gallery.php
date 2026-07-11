<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.gallery');
$gallery = loadData('gallery');

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('gallery.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('gallery.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <div class="gallery-grid">
            <?php foreach ($gallery as $item): ?>
                <div class="gallery-item reveal"
                     data-title="<?= e(localized($item, 'title')) ?>"
                     data-color="<?= e($item['color']) ?>"
                     role="button"
                     tabindex="0"
                     aria-label="<?= e(localized($item, 'title')) ?>">
                    <div class="gallery-item__img" style="background: linear-gradient(135deg, <?= e($item['color']) ?>, var(--color-bg-card));">
                        <span class="gallery-item__title"><?= e(localized($item, 'title')) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
