<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.recruitment');
$positions = loadData('recruitment');
$openPositions = array_filter($positions, fn($p) => !empty($p['open']));

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('recruitment.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('recruitment.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <h2 class="section-title reveal" style="font-size:1.25rem;margin-bottom:2rem;text-align:center;"><?= e(__('recruitment.open')) ?></h2>

        <?php if (empty($openPositions)): ?>
            <p class="section-desc reveal"><?= e(__('recruitment.closed')) ?></p>
        <?php else: ?>
            <div class="recruitment-list">
                <?php foreach ($openPositions as $pos): ?>
                    <article class="recruitment-card card-glow reveal">
                        <div class="recruitment-card__header">
                            <h3 class="recruitment-card__title"><?= e(localized($pos, 'title')) ?></h3>
                            <span class="game-badge game-badge--<?= e($pos['game']) ?>"><?= e(gameLabel($pos['game'])) ?></span>
                        </div>
                        <p class="recruitment-card__desc"><?= e(localized($pos, 'desc')) ?></p>
                        <div class="recruitment-card__requirements">
                            <h4><?= e(__('recruitment.requirements')) ?></h4>
                            <ul>
                                <?php
                                $reqKey = 'requirements_' . $currentLang;
                                $reqs = $pos[$reqKey] ?? $pos['requirements_pl'] ?? [];
                                foreach ($reqs as $req):
                                ?>
                                    <li><?= e($req) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php
                        $subject = urlencode(localized($pos, 'title'));
                        ?>
                        <a class="btn btn-neon" href="contact.php?subject=<?= e($subject) ?>"><?= e(__('btn.apply')) ?></a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
