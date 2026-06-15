---
name: wp-classic-onepager
description: Build a custom WordPress Classic PHP theme as a long-form onepager — NOT FSE/Block. Use when the user wants full design freedom over a WP site, lets a non-tech client edit content later via WP-Admin, runs locally on wp-now (no Docker/Homebrew). Covers theme skeleton, sections-pattern with edi_section() helper, Schema.org auto-emission from a single data source, font enqueue without Inter/Roboto, mobile sticky callbar, FAQPage auto-generation, and common pitfalls (Block→Classic migration crashes, wp-now restart triggers).
---

# WordPress Classic PHP Theme — Onepager Workflow

## When to use this (and when not)

**Use Classic Theme when:**
- Maximum design freedom — own CSS architecture, own JS, no Block-Editor compromises.
- Onepager or shallow multi-page (≤ 5 pages).
- Performance matters (no FSE overhead, no theme.json patterns scanning).
- Client edits content later but doesn't compose layouts.

**Use FSE/Block Theme when:**
- Client needs to compose layouts via Block Editor.
- Site is deep multi-page with editorial CMS-Charakter.
- Designer wants to ship without writing PHP.

## File structure (proven layout)

```
my-theme/
├── style.css                    ← Theme-header + all visual styles (one file, ~1500-2000 lines)
├── functions.php                ← Theme setup, font enqueue, section()-helper, Schema.org JSON-LD
├── header.php                   ← <head>, sticky nav header
├── footer.php                   ← Footer + mobile callbar + wp_footer()
├── front-page.php               ← Onepager composition (calls section() helpers)
├── index.php                    ← Fallback identical to front-page
├── inc/sections/
│   ├── hero.php
│   ├── intro.php
│   ├── leistungen.php
│   ├── referenzen.php
│   ├── zusammenarbeit.php       ← Process-Steps
│   ├── faq.php                  ← Reads from edi_faqs() — same data feeds Schema.org
│   ├── team.php
│   └── kontakt.php
└── assets/
    ├── images/                  ← logo, hero, services
    ├── js/main.js               ← Vanilla JS, IntersectionObserver, scroll handlers
    └── bauphasen/               ← (optional) frame sequence for scroll-cinema
```

## Local dev with wp-now

```bash
cd /path/to/site
npx @wp-now/wp-now start --path=./wp-content/themes/my-theme --port=8881
```

- Frontend: `http://localhost:8881/`
- WP-Admin: `http://localhost:8881/wp-admin` (admin/password by default)
- DB state lives in `~/.wp-now/sites/` keyed by path — eine Theme-Dir = eine DB
- **Restart required** wenn: Block→Classic conversion, `theme.json` removed, structural changes that trigger `_register_theme_block_patterns()` fatal

Port-Konvention bei parallelen Theme-Varianten: 8881 (v1), 8895 (v2), 8896 (v3), 8897 (v4) — verschiedene Theme-Pfade, kein DB-Konflikt.

## functions.php — proven boilerplate

```php
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
define( 'MYTHEME_VERSION', '0.1.0' );

// Theme setup
add_action( 'after_setup_theme', static function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery' ] );
    register_nav_menus( [ 'primary' => __( 'Hauptnav', 'mytheme' ) ] );
} );

// Asset enqueue — NO Inter/Roboto/Arial; use Space Grotesk + Manrope + JetBrains Mono
add_action( 'wp_enqueue_scripts', static function () {
    wp_enqueue_style(
        'mytheme-fonts',
        'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap',
        [], null
    );
    wp_enqueue_style( 'mytheme', get_stylesheet_uri(), [ 'mytheme-fonts' ], MYTHEME_VERSION );
    wp_enqueue_script( 'mytheme-main', get_template_directory_uri() . '/assets/js/main.js', [], MYTHEME_VERSION, true );
} );

// Preconnect for fonts + meta description + theme-color
add_action( 'wp_head', static function () {
    echo "<link rel='preconnect' href='https://fonts.googleapis.com'>\n";
    echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>\n";
    echo '<meta name="theme-color" content="#0a0a0c">' . "\n";
}, 1 );

// Single source of truth for nav anchors
function mytheme_sections(): array {
    return [
        [ 'slug' => 'leistungen',     'label' => 'Leistungen' ],
        [ 'slug' => 'referenzen',     'label' => 'Referenzen' ],
        [ 'slug' => 'zusammenarbeit', 'label' => 'Zusammenarbeit' ],
        [ 'slug' => 'faq',            'label' => 'FAQ' ],
        [ 'slug' => 'kontakt',        'label' => 'Kontakt' ],
    ];
}

// Section renderer
function mytheme_section( string $name ): void {
    $path = get_template_directory() . "/inc/sections/{$name}.php";
    if ( file_exists( $path ) ) include $path;
}

// FAQ data — feeds Section AND Schema.org JSON-LD (single source of truth!)
function mytheme_faqs(): array {
    return [
        [ 'q' => 'Frage 1?', 'a' => 'Antwort 1.' ],
        // ... 5-6 items optimal
    ];
}

// Schema.org auto-emission
add_action( 'wp_head', static function () {
    $base = home_url( '/' );

    // GeneralContractor (or LocalBusiness / HomeAndConstructionBusiness)
    $contractor = [
        '@context'    => 'https://schema.org',
        '@type'       => 'GeneralContractor',
        '@id'         => $base . '#organization',
        'name'        => 'Firma XYZ',
        'url'         => $base,
        'logo'        => get_template_directory_uri() . '/assets/images/logo.png',
        'telephone'   => '+49 …',
        'address'     => [ '@type' => 'PostalAddress', 'streetAddress' => '…', 'addressLocality' => 'Berlin', 'addressCountry' => 'DE' ],
        'areaServed'  => [
            [ '@type' => 'City', 'name' => 'Berlin' ],
            [ '@type' => 'City', 'name' => 'Potsdam' ],
            // ... all served cities
        ],
        'serviceArea' => [ '@type' => 'GeoCircle', 'geoMidpoint' => [ '@type' => 'GeoCoordinates', 'latitude' => 52.52, 'longitude' => 13.40 ], 'geoRadius' => '120000' ],
    ];
    echo "\n<script type='application/ld+json'>" . wp_json_encode( $contractor, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";

    // FAQPage — built from mytheme_faqs() so it can never drift from visible FAQ
    $entities = array_map( static fn( $f ) => [
        '@type'          => 'Question',
        'name'           => $f['q'],
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $f['a'] ],
    ], mytheme_faqs() );
    $faq_schema = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ];
    echo "\n<script type='application/ld+json'>" . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 99 );
```

## front-page.php — compose the onepager

```php
<?php get_header();
mytheme_section( 'hero' );
mytheme_section( 'intro' );
mytheme_section( 'leistungen' );
mytheme_section( 'referenzen' );
mytheme_section( 'zusammenarbeit' );
mytheme_section( 'faq' );
mytheme_section( 'team' );
mytheme_section( 'kontakt' );
get_footer();
```

Always mirror `front-page.php` content into `index.php` as fallback. Pages built via WP-Admin go through default template.

## CSS architecture — token-driven

Single `style.css` file, organized:
```
1. TOKENS (`:root { --c-bg, --c-text, --c-line, --c-gold, ff-*, fs-* }`)
2. RESET / GLOBAL
3. TYPOGRAPHY UTILS
4. LAYOUT (container, section, grid)
5. BUTTONS
6. HEADER / NAV
7. HERO
8. INTRO
9. LEISTUNGEN
...
N. FOOTER
N+1. REVEAL animations
N+2. STICKY CALLBAR
```

Token-driven means: switch from dark to light by flipping ~20 values in `:root` — see `multi-variant-theme-tokens` skill.

## Pitfalls (real production lessons)

1. **Block→Classic conversion fatal:** wenn `theme.json` entfernt wird ohne `wp-now restart`, WP wirft Fatal in `_register_theme_block_patterns()`. Immer wp-now killen + neu starten bei structural changes.

2. **Bilder `object-fit: cover` in zu kleinen Strips** wird oft als "komisch abgeschnitten" abgelehnt. Hero-Bilder mit `aspect-ratio` halten oder vollwertig zeigen.

3. **Italic-Akzente** (Fraunces WONK, native `<em>`) werden oft als "geschnörkelt" verworfen. Globalen Override setzen:
   ```css
   em, i, cite, dfn, var, address, blockquote, q { font-style: normal; }
   ```

4. **Form-Backend nicht verdrahtet** beim ersten Build. Plan: Contact Form 7 / Forminator nach Content-Finalisierung einbinden, manuelles `<form action="#">` durch Shortcode ersetzen.

5. **Telefonnummern + Adresse hardcoded** im Theme — bei Klienten-Edits später schmerzhaft. Plan: ACF integration in zweiter Iteration (`the_field()` statt `echo esc_html()`).

6. **Logo als JPG** wird auf Retina + High-DPI suboptimal. SVG-Variante besorgen oder PNG mit 2x.

7. **Hero text-shadow nicht setzen** wenn Foto darunter — Headline wird auf hellen Foto-Bereichen unleserlich. Immer `text-shadow: 0 2px 30px rgba(0,0,0,0.4)` oder veil-Gradient.

## JS — vanilla pattern (no framework)

`assets/js/main.js` proven structure:
```js
(function() {
  'use strict';
  // 1. Header scroll state
  // 2. Mobile nav toggle
  // 3. Reveal-on-scroll (IntersectionObserver + animation-timeline fallback)
  // 4. FAQ: one-open-per-group (details/toggle event)
  // 5. File input: show filename in drop label
})();
```

No jQuery. Native `scroll-behavior: smooth`, `details/summary` for accordions, `IntersectionObserver` for reveals.

## Mobile-first patterns

- **Sticky callbar at bottom** with Tel + WhatsApp buttons (Bau-Handschuh-Finger-tauglich, 48-56 px tap-targets):
  ```html
  <nav class="callbar"><a href="tel:…">Anrufen</a><a href="https://wa.me/…">WhatsApp</a></nav>
  ```
- **Mobile callbar pushes body padding** so it doesn't overlap content: `@media (max-width:760px) { body { padding-bottom: 64px; } }`
- **Off-canvas nav** for hamburger — siehe header.php + style.css `.nav-toggle` + `.site-header.nav-open` patterns.

## Related skills

- **construction-website-builder** — Was reingehört (Copy, SEO, FAQ-Templates)
- **multi-variant-theme-tokens** — Mehrere Color-Varianten parallel testen
- **scroll-cinema-patterns** — Bauphasen/Process scroll-driven canvas
