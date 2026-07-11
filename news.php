<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.news');
$news = loadData('news');
$articleId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$article = $articleId > 0 ? newsById($articleId) : null;

require __DIR__ . '/includes/header.php';
?>

<?php if ($article): ?>
    <article class="container news-article reveal">
        <a class="btn btn-outline btn-sm" href="news.php" style="margin-bottom:1.5rem;display:inline-flex;"><?= e(__('news.back')) ?></a>
        <div class="news-article__meta">
            <span class="news-card__category"><?= e(localized($article, 'category')) ?></span>
            · <time datetime="<?= e($article['date']) ?>"><?= e(formatDate($article['date'])) ?></time>
        </div>
        <h1 class="news-article__title"><?= e(localized($article, 'title')) ?></h1>
        <div class="news-article__content">
            <p><?= e(localized($article, 'content')) ?></p>
        </div>
    </article>
<?php else: ?>
    <header class="page-header">
        <div class="container reveal">
            <h1 class="page-header__title"><?= e(__('news.title')) ?></h1>
            <p class="page-header__subtitle"><?= e(__('news.subtitle')) ?></p>
        </div>
    </header>

    <section class="section">
        <div class="container">
            <div class="news-grid">
                <?php foreach ($news as $item): ?>
                    <?php include __DIR__ . '/includes/components/news-card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
