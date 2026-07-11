# strona_organizacji_E-sport

**PL:** Projekt portfolio — dwujęzyczna strona (PL/EN) fikcyjnej organizacji esportowej **NeonPulse Esports** (CS2, LoL, Valorant). Zbudowana w HTML, CSS, JavaScript i PHP. Cała treść i tłumaczenia pochodzą z plików config — bez bazy danych.

**EN:** Portfolio project — bilingual (PL/EN) website for a fictional esports organization **NeonPulse Esports** (CS2, LoL, Valorant). Built with HTML, CSS, JavaScript and PHP. All content and translations are driven by config files — no database required.

---

## Funkcje / Features

| PL | EN |
|----|-----|
| 9 stron: Strona główna, Drużyny, Osiągnięcia, Aktualności, Harmonogram, Partnerzy, Galeria, Rekrutacja, Kontakt | 9 pages: Home, Teams, Achievements, News, Schedule, Partners, Gallery, Recruitment, Contact |
| Ciemny interfejs gamingowy z efektami neon, particles i animacjami scroll | Dark gaming UI with neon effects, particles, scroll animations |
| Przełącznik języka PL / EN (sesja) | PL / EN language switch (session-based) |
| Formularz kontaktowy z walidacją PHP (`mail()` + zapis do logu) | Contact form with PHP validation (`mail()` + fallback to log file) |
| W pełni responsywny layout | Fully responsive layout |

---

## Wymagania / Requirements

- PHP 8.0+ (powinno działać też na 7.4 / 7.4 should work)
- Serwer WWW (Apache/Nginx) lub wbudowany serwer PHP / Web server (Apache/Nginx) or PHP built-in server

---

## Szybki start / Quick start

### Opcja 1 / Option 1 — wbudowany serwer PHP / PHP built-in server

```bash
cd strona_organizacji_E-sport
php -S localhost:8000
```

Otwórz / Open [http://localhost:8000](http://localhost:8000)

### Opcja 2 / Option 2 — XAMPP / Laragon

**PL:** Skopiuj folder projektu do `htdocs` (XAMPP) lub `www` (Laragon) i otwórz w przeglądarce.

**EN:** Copy the project folder into `htdocs` (XAMPP) or `www` (Laragon) and open it in the browser.

---

## Struktura projektu / Project structure

```
config/
  config.php          # Ustawienia strony / Site settings, colors, social links, stats
  lang/pl.php         # Polskie teksty / Polish UI strings
  lang/en.php         # Angielskie teksty / English UI strings
  data/               # Drużyny, newsy, harmonogram / Teams, news, schedule, etc.
includes/
  bootstrap.php       # Sesja, język, helpery / Session, language, helpers
  header.php / footer.php
  components/         # Komponenty kart / Reusable card partials
assets/css/           # style.css, animations.css
assets/js/            # main.js, animations.js, particles.js
*.php                 # Pliki stron / Page entry points
logs/                 # Fallback formularza / Contact form fallback (auto-created)
```

---

## Konfiguracja / Configuration

Edytuj / Edit [`config/config.php`](config/config.php):

| PL | EN |
|----|-----|
| nazwę organizacji, kolory, linki do social media | organization name, colors, social media URLs |
| e-mail kontaktowy i ustawienia poczty | contact email and mail settings |
| nawigację i statystyki na stronie głównej | navigation and homepage statistics |

- **PL:** Pliki w [`config/data/`](config/data/) — drużyny, newsy, mecze, partnerzy, galeria, rekrutacja.
- **EN:** Files in [`config/data/`](config/data/) — teams, news, matches, partners, gallery, recruitment.

- **PL:** [`config/lang/pl.php`](config/lang/pl.php) i [`config/lang/en.php`](config/lang/en.php) — tłumaczenia interfejsu.
- **EN:** [`config/lang/pl.php`](config/lang/pl.php) and [`config/lang/en.php`](config/lang/en.php) — UI translations.

---

## Formularz kontaktowy / Contact form

| PL | EN |
|----|-----|
| Ustaw `contact.mail_enabled` na `true` w config, aby używać PHP `mail()` | Set `contact.mail_enabled` to `true` in config to use PHP `mail()` |
| Na localhost (bez SMTP) wiadomości trafiają do `logs/contact.log` | On localhost (no SMTP), messages are saved to `logs/contact.log` |

---

## Licencja / License

Copyright (c) 2026 iwo2003 — zobacz / see [LICENSE](LICENSE).

| PL | EN |
|----|-----|
| **Wolne użycie** w projektach osobistych, edukacyjnych i portfolio | **Free to use** for personal, educational and portfolio projects |
| **Tylko niekomercyjnie** — bez celów zarobkowych ani płatnego użytku komercyjnego | **Non-commercial only** — no profit or paid/commercial use |
| **Wymagana atrybucja** — zachowaj licencję i link do [repozytorium źródłowego](https://github.com/blazej1230/strona_organizacji_E-sport) w stopce lub sekcji „O nas” | **Attribution required** — keep the license and link to [the source repository](https://github.com/blazej1230/strona_organizacji_E-sport) in the footer or About section |
