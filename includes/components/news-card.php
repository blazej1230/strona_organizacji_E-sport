<?php
/** @var array $item */
$href = 'news.php?id=' . (int) $item['id'];
?>
<article class="news-card card-glow reveal">
    <div class="news-card__meta">
        <span class="news-card__category"><?= e(localized($item, 'category')) ?></span>
        <time datetime="<?= e($item['date']) ?>"><?= e(formatDate($item['date'])) ?></time>
    </div>
    <h3 class="news-card__title">
        <a href="<?= e($href) ?>"><?= e(localized($item, 'title')) ?></a>
    </h3>
    <p class="news-card__excerpt"><?= e(localized($item, 'excerpt')) ?></p>
    <a class="btn btn-neon btn-sm" href="<?= e($href) ?>"><?= __('btn.read_more') ?></a>
</article>
