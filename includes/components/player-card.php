<?php
/** @var array $player */
$initial = strtoupper(substr($player['nick'], 0, 1));
?>
<article class="player-card card-glow reveal">
    <div class="player-card__avatar" aria-hidden="true"><?= e($initial) ?></div>
    <div class="player-card__body">
        <h3 class="player-card__nick"><?= e($player['nick']) ?></h3>
        <p class="player-card__role"><?= e($player['role']) ?></p>
        <p class="player-card__meta">
            <span class="player-card__country"><?= e($player['country']) ?></span>
            <?php if (!empty($player['name'])): ?>
                <span class="player-card__name"><?= e($player['name']) ?></span>
            <?php endif; ?>
        </p>
    </div>
</article>
