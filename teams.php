<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.teams');
$teams = loadData('teams');

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('teams.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('teams.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <div class="filter-tabs reveal">
            <button class="filter-tab is-active" data-game="all" type="button"><?= e(__('teams.filter_all')) ?></button>
            <?php foreach ($teams as $team): ?>
                <button class="filter-tab" data-game="<?= e($team['game']) ?>" type="button">
                    <?= e(gameLabel($team['game'])) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <?php foreach ($teams as $team): ?>
            <div class="team-section reveal" id="team-<?= e($team['id']) ?>" data-team-game="<?= e($team['game']) ?>">
                <div class="team-section__header">
                    <span class="game-badge game-badge--<?= e($team['game']) ?>"><?= e(gameLabel($team['game'])) ?></span>
                    <h2 class="team-section__title"><?= e($config['site_name']) ?> — <?= e(gameLabel($team['game'])) ?></h2>
                </div>

                <div class="staff-grid">
                    <?php
                    $staffRoles = ['coach' => 'teams.coach', 'analyst' => 'teams.analyst', 'manager' => 'teams.manager'];
                    foreach ($staffRoles as $key => $labelKey):
                        if (empty($team[$key])) continue;
                        $staff = $team[$key];
                    ?>
                        <div class="staff-card card-glow">
                            <?php $member = $staff; include __DIR__ . '/includes/components/member-avatar.php'; ?>
                            <p class="staff-card__role"><?= e(__($labelKey)) ?></p>
                            <p class="staff-card__nick"><?= e($staff['nick']) ?></p>
                            <p class="player-card__meta"><?= e($staff['name']) ?> · <?= e($staff['country']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h3 class="section-title" style="font-size:1.1rem;margin-bottom:1.25rem;"><?= e(__('teams.players')) ?></h3>
                <div class="players-grid">
                    <?php foreach ($team['players'] as $player): ?>
                        <?php include __DIR__ . '/includes/components/player-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
