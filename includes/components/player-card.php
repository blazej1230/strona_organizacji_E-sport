<?php
/** @var array $player */
$member = $player;
?>
<article class="player-card card-glow reveal">
    <?php include __DIR__ . '/member-avatar.php'; ?>
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
