    </main>

    <footer class="site-footer">
        <div class="container site-footer__grid">
            <div class="site-footer__brand">
                <p class="site-footer__name"><?= e($config['site_name']) ?></p>
                <p class="site-footer__tagline"><?= e(tagline()) ?></p>
            </div>

            <div class="site-footer__social">
                <?php foreach ($config['social'] as $network => $url): ?>
                    <a href="<?= e($url) ?>" target="_blank" rel="noopener noreferrer" class="social-link">
                        <?= e(ucfirst($network)) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="site-footer__legal">
                <p>&copy; <?= date('Y') ?> <?= e($config['site_name']) ?>. <?= e(__('footer.rights')) ?></p>
                <p class="site-footer__license">
                    <?= e(__('footer.license')) ?>
                    <a href="<?= e($config['repo_url']) ?>" target="_blank" rel="noopener noreferrer">
                        <?= e(__('footer.repo')) ?> (<?= e($config['author']) ?>)
                    </a>
                </p>
            </div>
        </div>
    </footer>

    <div class="lightbox" id="lightbox" hidden>
        <button class="lightbox__close" id="lightbox-close" aria-label="Close">&times;</button>
        <div class="lightbox__content" id="lightbox-content"></div>
    </div>

    <script src="assets/js/particles.js?v=1.0.2" defer></script>
    <script src="assets/js/animations.js?v=1.0.2" defer></script>
    <script src="assets/js/main.js?v=1.0.2" defer></script>
</body>
</html>
