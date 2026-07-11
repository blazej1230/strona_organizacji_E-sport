<?php
/** @var array $match */
$statusClass = 'match-row--' . ($match['status'] ?? 'upcoming');
?>
<article class="match-row card-glow reveal <?= e($statusClass) ?>">
    <div class="match-row__game">
        <span class="game-badge game-badge--<?= e($match['game']) ?>"><?= e(gameLabel($match['game'])) ?></span>
    </div>
    <div class="match-row__teams">
        <span class="match-row__team"><?= e($match['team']) ?></span>
        <span class="match-row__vs"><?= __('schedule.vs') ?></span>
        <span class="match-row__team"><?= e($match['opponent']) ?></span>
    </div>
    <div class="match-row__info">
        <span class="match-row__tournament"><?= e($match['tournament']) ?></span>
        <time datetime="<?= e($match['date']) ?>"><?= e(formatDate($match['date'], 'd.m.Y H:i')) ?></time>
    </div>
    <div class="match-row__status">
        <?php if ($match['status'] === 'live'): ?>
            <span class="status-badge status-badge--live"><?= __('schedule.live') ?></span>
        <?php elseif ($match['status'] === 'finished'): ?>
            <span class="status-badge status-badge--finished"><?= e($match['score']) ?></span>
        <?php else: ?>
            <span class="status-badge status-badge--upcoming"><?= __('schedule.upcoming') ?></span>
        <?php endif; ?>
    </div>
</article>
