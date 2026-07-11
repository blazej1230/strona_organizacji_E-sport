(function () {
    'use strict';

    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.addEventListener('DOMContentLoaded', function () {
        if (!reducedMotion) {
            initReveal();
            initCounters();
            initParallax();
        } else {
            document.querySelectorAll('.reveal').forEach(function (el) {
                el.classList.add('visible');
            });
        }

        initTeamFilter();
        initLightbox();
    });

    function initReveal() {
        var elements = document.querySelectorAll('.reveal');
        if (!elements.length || !('IntersectionObserver' in window)) {
            elements.forEach(function (el) { el.classList.add('visible'); });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        elements.forEach(function (el) { observer.observe(el); });
    }

    function initCounters() {
        var counters = document.querySelectorAll('[data-count]');
        if (!counters.length) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;

                var el = entry.target;
                var target = parseInt(el.getAttribute('data-count'), 10);
                var suffix = el.getAttribute('data-suffix') || '';
                var duration = 2000;
                var start = performance.now();

                function update(now) {
                    var progress = Math.min((now - start) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(target * eased) + suffix;
                    if (progress < 1) requestAnimationFrame(update);
                }

                requestAnimationFrame(update);
                observer.unobserve(el);
            });
        }, { threshold: 0.5 });

        counters.forEach(function (c) { observer.observe(c); });
    }

    function initParallax() {
        var hero = document.querySelector('.hero__content');
        if (!hero) return;

        var ticking = false;

        window.addEventListener('scroll', function () {
            if (!ticking) {
                requestAnimationFrame(function () {
                    var scrollY = window.scrollY;
                    hero.style.transform = 'translateY(' + (scrollY * 0.25) + 'px)';
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    function initTeamFilter() {
        var tabs = document.querySelectorAll('.filter-tab');
        var sections = document.querySelectorAll('[data-team-game]');

        if (!tabs.length || !sections.length) return;

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var game = tab.getAttribute('data-game');

                tabs.forEach(function (t) { t.classList.remove('is-active'); });
                tab.classList.add('is-active');

                sections.forEach(function (section) {
                    if (game === 'all' || section.getAttribute('data-team-game') === game) {
                        section.style.display = '';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });
    }

    function initLightbox() {
        var lightbox = document.getElementById('lightbox');
        var content = document.getElementById('lightbox-content');
        var closeBtn = document.getElementById('lightbox-close');
        var items = document.querySelectorAll('.gallery-item');

        if (!lightbox || !content || !items.length) return;

        items.forEach(function (item) {
            item.addEventListener('click', function () {
                var title = item.getAttribute('data-title') || '';
                var color = item.getAttribute('data-color') || '#12121a';

                content.style.background = 'linear-gradient(to top, rgba(0,0,0,0.8), transparent), ' + color;
                content.innerHTML = '<span class="gallery-item__title">' + escapeHtml(title) + '</span>';
                lightbox.hidden = false;
                document.body.style.overflow = 'hidden';
            });
        });

        function closeLightbox() {
            lightbox.hidden = true;
            document.body.style.overflow = '';
        }

        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !lightbox.hidden) closeLightbox();
        });
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }
})();
