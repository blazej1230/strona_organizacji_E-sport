<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.home');
$teams = loadData('teams');
$news = array_slice(loadData('news'), 0, 3);
$schedule = loadData('schedule');
$upcoming = array_values(array_filter($schedule, fn($m) => $m['status'] === 'upcoming' || $m['status'] === 'live'));
$upcoming = array_slice($upcoming, 0, 3);

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <canvas class="hero__canvas" id="hero-particles" aria-hidden="true"></canvas>
    <div class="hero__content parallax-layer">
        <h1 class="hero__title"><?= e(__('hero.title')) ?></h1>
        <p class="hero__subtitle"><?= e(tagline()) ?></p>
        <div class="hero__actions">
            <a class="btn btn-neon" href="teams.php"><?= e(__('hero.cta_teams')) ?></a>
            <a class="btn btn-outline" href="recruitment.php"><?= e(__('hero.cta_recruit')) ?></a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($config['stats'] as $i => $stat): ?>
                <div class="stat-card card-glow reveal reveal-delay-<?= min($i + 1, 3) ?>">
                    <div class="stat-card__value" data-count="<?= (int) $stat['value'] ?>" data-suffix="<?= e($stat['suffix']) ?>">0</div>
                    <div class="stat-card__label"><?= e(__($stat['key'])) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section--alt">
    <div class="container">
        <header class="section-header reveal">
            <h2 class="section-title"><?= e(__('section.teams')) ?></h2>
            <p class="section-desc"><?= e(__('section.teams_desc')) ?></p>
        </header>
        <div class="teams-grid">
            <?php foreach ($teams as $i => $team): ?>
                <article class="team-card card-glow reveal reveal-delay-<?= min($i + 1, 3) ?>" style="--team-color: <?= e($team['color']) ?>">
                    <div class="team-card__icon" style="color: <?= e($team['color']) ?>">
                        <?= e(strtoupper(substr($team['game'], 0, 2))) ?>
                    </div>
                    <h3 class="team-card__title"><?= e(gameLabel($team['game'])) ?></h3>
                    <p class="team-card__count"><?= count($team['players']) ?> <?= e(__('teams.players')) ?></p>
                    <a class="btn btn-neon btn-sm" href="teams.php#team-<?= e($team['id']) ?>"><?= e(__('btn.view_all')) ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <header class="section-header reveal">
            <h2 class="section-title"><?= e(__('section.news')) ?></h2>
            <p class="section-desc"><?= e(__('section.news_desc')) ?></p>
        </header>
        <div class="news-grid">
            <?php foreach ($news as $item): ?>
                <?php include __DIR__ . '/includes/components/news-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <div class="section-footer reveal">
            <a class="btn btn-outline" href="news.php"><?= e(__('btn.view_all')) ?></a>
        </div>
    </div>
</section>

<section class="section section--alt">
    <div class="container">
        <header class="section-header reveal">
            <h2 class="section-title"><?= e(__('section.schedule')) ?></h2>
            <p class="section-desc"><?= e(__('section.schedule_desc')) ?></p>
        </header>
        <div class="matches-list">
            <?php foreach ($upcoming as $match): ?>
                <?php include __DIR__ . '/includes/components/match-row.php'; ?>
            <?php endforeach; ?>
        </div>
        <div class="section-footer reveal">
            <a class="btn btn-outline" href="schedule.php"><?= e(__('btn.view_all')) ?></a>
        </div>
    </div>
</section>

<section class="section cta-section card-glow reveal">
    <div class="container">
        <h2 class="cta-section__title"><?= e(__('section.cta')) ?></h2>
        <p class="cta-section__desc"><?= e(__('section.cta_desc')) ?></p>
        <div class="cta-section__actions">
            <a class="btn btn-neon" href="contact.php"><?= e(__('section.cta_contact')) ?></a>
            <a class="btn btn-outline" href="recruitment.php"><?= e(__('section.cta_recruit')) ?></a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
