<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.recruitment');
$positions = loadData('recruitment');
$openPositions = array_filter($positions, fn($p) => !empty($p['open']));
$flash = $_SESSION['recruitment_flash'] ?? null;
unset($_SESSION['recruitment_flash']);

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
        <?php if ($flash): ?>
            <div class="alert alert--<?= $flash['type'] === 'success' ? 'success' : 'error' ?> reveal">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <h2 class="section-title reveal" style="font-size:1.25rem;margin-bottom:2rem;text-align:center;"><?= e(__('recruitment.open')) ?></h2>

        <?php if (empty($openPositions)): ?>
            <p class="section-desc reveal"><?= e(__('recruitment.closed')) ?></p>
        <?php else: ?>
            <div class="recruitment-list">
                <?php foreach ($openPositions as $pos): ?>
                    <?php
                    $posId = (int) $pos['id'];
                    $isActiveForm = isset($flash['old']['positionId']) && (int) $flash['old']['positionId'] === $posId;
                    $old = $isActiveForm ? ($flash['old'] ?? []) : [];
                    ?>
                    <article class="recruitment-card card-form visible" id="apply-<?= $posId ?>">
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

                        <form class="recruitment-form validated-form" method="post" action="recruitment-handler.php" novalidate>
                            <input type="hidden" name="position_id" value="<?= $posId ?>">
                            <div class="form-group">
                                <label for="name-<?= $posId ?>"><?= e(__('recruitment.name')) ?></label>
                                <input type="text" id="name-<?= $posId ?>" name="name" required autocomplete="name"
                                       value="<?= e($old['name'] ?? '') ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email-<?= $posId ?>"><?= e(__('recruitment.email')) ?></label>
                                    <input type="email" id="email-<?= $posId ?>" name="email" required autocomplete="email"
                                           value="<?= e($old['email'] ?? '') ?>">
                                </div>
                                <div class="form-group">
                                    <label for="discord-<?= $posId ?>"><?= e(__('recruitment.discord')) ?></label>
                                    <input type="text" id="discord-<?= $posId ?>" name="discord" autocomplete="off"
                                           placeholder="<?= e(__('recruitment.discord_placeholder')) ?>"
                                           value="<?= e($old['discord'] ?? '') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-<?= $posId ?>"><?= e(__('recruitment.message')) ?></label>
                                <textarea id="message-<?= $posId ?>" name="message" required
                                          placeholder="<?= e(__('recruitment.message_placeholder')) ?>"><?= e($old['message'] ?? '') ?></textarea>
                            </div>
                            <p class="recruitment-form__note"><?= e(__('recruitment.note')) ?></p>
                            <button type="submit" class="btn btn-neon"><?= e(__('btn.apply')) ?></button>
                        </form>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
