<?php
/** @var array $member */
$photoUrl = memberPhoto($member['photo'] ?? null);
$alt = e($member['nick'] ?? 'Player');
$placeholder = memberPhotoPlaceholder();
?>
<div class="member-avatar">
    <?php if ($photoUrl): ?>
        <img src="<?= e($photoUrl) ?>" alt="<?= $alt ?>" class="member-avatar__img" loading="lazy" width="64" height="64">
    <?php else: ?>
        <img src="<?= e($placeholder) ?>" alt="" class="member-avatar__img member-avatar__img--placeholder" aria-hidden="true" width="64" height="64">
    <?php endif; ?>
</div>
