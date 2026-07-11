<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = __('meta.contact');
$flash = $_SESSION['contact_flash'] ?? null;
unset($_SESSION['contact_flash']);

$prefillSubject = isset($_GET['subject']) ? (string) $_GET['subject'] : '';

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
    <div class="container reveal">
        <h1 class="page-header__title"><?= e(__('contact.title')) ?></h1>
        <p class="page-header__subtitle"><?= e(__('contact.subtitle')) ?></p>
    </div>
</header>

<section class="section">
    <div class="container">
        <?php if ($flash): ?>
            <div class="alert alert--<?= $flash['type'] === 'success' ? 'success' : 'error' ?> reveal">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="contact-grid">
            <div class="contact-info card-glow reveal">
                <h2 class="section-title" style="font-size:1.1rem;"><?= e($config['site_name']) ?></h2>
                <a class="contact-info__email" href="mailto:<?= e($config['contact']['email']) ?>">
                    <?= e($config['contact']['email']) ?>
                </a>
                <div class="site-footer__social">
                    <?php foreach ($config['social'] as $network => $url): ?>
                        <a href="<?= e($url) ?>" target="_blank" rel="noopener noreferrer" class="social-link">
                            <?= e(ucfirst($network)) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <form class="contact-form card-glow reveal" id="contact-form" method="post" action="contact-handler.php" novalidate>
                <div class="form-group">
                    <label for="name"><?= e(__('contact.name')) ?></label>
                    <input type="text" id="name" name="name" required autocomplete="name"
                           value="<?= e($flash['old']['name'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="email"><?= e(__('contact.email')) ?></label>
                    <input type="email" id="email" name="email" required autocomplete="email"
                           value="<?= e($flash['old']['email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="subject"><?= e(__('contact.subject')) ?></label>
                    <input type="text" id="subject" name="subject" required
                           value="<?= e($flash['old']['subject'] ?? $prefillSubject) ?>">
                </div>
                <div class="form-group">
                    <label for="message"><?= e(__('contact.message')) ?></label>
                    <textarea id="message" name="message" required><?= e($flash['old']['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-neon"><?= e(__('btn.send')) ?></button>
            </form>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
