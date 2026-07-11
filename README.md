# strona_organizacji_E-sport

Portfolio project — bilingual (PL/EN) website for a fictional esports organization **NeonPulse Esports** (CS2, LoL, Valorant).

Built with HTML, CSS, JavaScript and PHP. All content and translations are driven by config files — no database required.

## Features

- 9 pages: Home, Teams, Achievements, News, Schedule, Partners, Gallery, Recruitment, Contact
- Dark gaming UI with neon effects, particles, scroll animations
- PL / EN language switch (session-based)
- Contact form with PHP validation (`mail()` + fallback to log file)
- Fully responsive layout

## Requirements

- PHP 8.0+ (7.4 should work)
- Web server (Apache/Nginx) or PHP built-in server

## Quick start

### Option 1 — PHP built-in server

```bash
cd strona_organizacji_E-sport
php -S localhost:8000
```

Open [http://localhost:8000](http://localhost:8000)

### Option 2 — XAMPP / Laragon

Copy the project folder into `htdocs` (XAMPP) or `www` (Laragon) and open it in the browser.

## Project structure

```
config/
  config.php          # Site settings, colors, social links, stats
  lang/pl.php         # Polish UI strings
  lang/en.php         # English UI strings
  data/               # Teams, news, schedule, etc.
includes/
  bootstrap.php       # Session, language, helpers
  header.php / footer.php
  components/         # Reusable card partials
assets/css/           # style.css, animations.css
assets/js/            # main.js, animations.js, particles.js
*.php                 # Page entry points
logs/                 # Contact form fallback (auto-created)
```

## Configuration

Edit [`config/config.php`](config/config.php) for:

- Organization name, colors, social media URLs
- Contact email and mail settings
- Navigation and homepage statistics

Edit files in [`config/data/`](config/data/) for teams, news, matches, partners, gallery and recruitment listings.

Edit [`config/lang/pl.php`](config/lang/pl.php) and [`config/lang/en.php`](config/lang/en.php) for UI translations.

## Contact form

- Set `contact.mail_enabled` to `true` in config to use PHP `mail()`
- On localhost (no SMTP), messages are saved to `logs/contact.log`

## License

Copyright (c) 2026 Błazej — see [LICENSE](LICENSE). Attribution required.
