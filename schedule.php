<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.schedule');
$schedule = loadData('schedule');
$upcoming = array_filter($schedule, fn($m) => in_array($m['status'], ['upcoming', 'live'], true));
$finished = array_filter($schedule, fn($m) => $m['status'] === 'finished');

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('schedule.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('schedule.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <h2 class="section-title reveal" style="font-size:1.25rem;margin-bottom:1.5rem;"><?= e(__('schedule.upcoming')) ?></h2>
        <div class="matches-list" style="margin-bottom:3rem;">
            <?php if (empty($upcoming)): ?>
                <p class="section-desc reveal">—</p>
            <?php else: ?>
                <?php foreach ($upcoming as $match): ?>
                    <?php include __DIR__ . '/includes/components/match-row.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <h2 class="section-title reveal" style="font-size:1.25rem;margin-bottom:1.5rem;"><?= e(__('schedule.finished')) ?></h2>
        <div class="matches-list">
            <?php foreach ($finished as $match): ?>
                <?php include __DIR__ . '/includes/components/match-row.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
