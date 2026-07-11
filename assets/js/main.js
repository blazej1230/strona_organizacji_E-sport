(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initNav();
        initContactForm();
    });

    function initNav() {
        var toggle = document.getElementById('nav-toggle');
        var nav = document.getElementById('site-nav');

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            toggle.classList.toggle('is-active', isOpen);
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        nav.querySelectorAll('.site-nav__link').forEach(function (link) {
            link.addEventListener('click', function () {
                nav.classList.remove('is-open');
                toggle.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    function initContactForm() {
        var form = document.getElementById('contact-form');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            var valid = true;
            var fields = form.querySelectorAll('[required]');

            fields.forEach(function (field) {
                field.classList.remove('is-invalid');
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    valid = false;
                }
                if (field.type === 'email' && field.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
                    field.classList.add('is-invalid');
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault();
            }
        });
    }
})();
