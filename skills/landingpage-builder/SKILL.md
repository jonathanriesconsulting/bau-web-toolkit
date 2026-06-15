---
name: landingpage-builder
description: Build premium, data-driven niche landing pages in pure vanilla HTML/CSS/JS — one template renders many industry variants from a JS data file, with calm "Apple-luxury" aesthetics (lots of white, muted dark-green accent, Inter + JetBrains Mono, no italic/serif) and tastefully restrained modern animations (Aurora, text-shimmer, marquee, cursor-spotlight, border-beam, scroll-reveal, count-up, before/after slider). Includes a dependency-free static-build that emits one real SEO URL per niche (dist/<slug>/index.html) with FAQPage/Service/Breadcrumb schema, sitemap.xml and robots.txt. Use when the user wants lead-gen landing pages for service industries (dentists, lawyers, clinics, real-estate, trades, hotels, etc.), a niche/vertical page system, Google-Ads landing pages, or a calm-but-impressive premium agency homepage. Built and validated on the Netzformat niche system (16 industries, May 2026).
---

# Landingpage Builder

Du baust **datengetriebene Nischen-Landingpages** in reinem HTML/CSS/JS — kein Framework, kein Tailwind, kein Build-Tool außer einem 300-Zeilen-Node-Script. Das Leitbild: **Apple-Luxus** (viel Weiß, ruhige große Typografie, ein gedämpfter dunkelgrüner Akzent) plus **moderne 21st.dev-Effekte in premium-dezenter Dosierung**.

Der Kern-Trick: **EIN HTML-Template + EINE Daten-Datei = beliebig viele Branchen-Seiten.** Inhalte stehen in `data/niches.js`, das Template `landing.html` hat nur leere `data-*`-Hooks, `landing.js` füllt sie zur Laufzeit, und `build.js` rendert daraus echte statische Einzel-URLs für SEO/Ads.

## When to Use

Aktiviere diesen Skill, wenn der User möchte:
- **Lead-Gen-Landingpages für Service-Branchen** (Zahnärzte, Anwälte, Kliniken, Makler, Handwerk, Hotels, Steuerberater, Finanzberater …)
- **Ein Nischen-/Vertical-System**: viele Branchenseiten, die strukturell gleich sind, sich aber in Copy/Akzent unterscheiden
- **Google-Ads- / SEO-Landingpages** mit echten, eigenständigen URLs und vorgerendertem Markup
- **Eine ruhige, aber beeindruckende Premium-Startseite** (Agentur-Flagship) mit dezenten modernen Animationen
- Generell „so wie bei Apple — viel Weiß, dunkelgrüne Akzente, sehr modern und Luxus", aber mit etwas mehr Bewegung als eine statische Seite

Signalwörter: „Landingpage", „Branchenseite", „Nische", „Vertical", „Lead-Gen", „Ads-Seite", „mehr Anfragen", „geile Animationen aber edel", „21st.dev", „Apple-Stil".

Verwandte Skills zur Abgrenzung:
- `agency-website-builder` — klassische **Multi-Page**-Agentursite (mehrere echte Unterseiten). Dieser Skill hier ist **Single-Template-viele-Nischen** + Static-Build.
- `construction-website-builder` / `construction-website-de` — WordPress-Classic-PHP-Bau-Sites.
- `scroll-cinema-patterns` — die schwergewichtige Scroll-Story (sticky stage). Hier nur als optionaler Baustein.
- `multi-variant-theme-tokens` — die Token-Flip-Mechanik im Detail (dieser Skill nutzt sie für Nischen-Akzente).

## Core Philosophy

### 1. Premium = Reduktion, NICHT Effekt-Verzicht
Der frühere Glaube „keine Animationen" war falsch dosiert. Die validierte Wahrheit: **moderne Effekte sind erlaubt — aber leise.** Der Unterschied zwischen „Apple-edel" und „billiger SaaS" ist nie *ob*, sondern *wie stark*:
- **Kleine Distanzen** (Reveal-Versatz 12–24px, nie 100vh-Parallax)
- **Niedrige Opazitäten** (Aurora-Blobs .15–.20, Spotlight .10–.13)
- **Lange, weiche Easings** (`cubic-bezier(.22,1,.36,1)` / `(.16,1,.3,1)`, Dauer 5–30s bei Ambient-Loops)
- **Eine Farbfamilie** (gedämpftes Grün auf Weiß — nie Regenbogen, nie Neon)
- **Einmalig statt Endlos** wo möglich; Ambient-Loops nur sehr langsam
- **Alles per `prefers-reduced-motion` abschaltbar** — ohne Ausnahme

> Merksatz: Bewegung dient der Hierarchie, nicht der Show. Wenn ein Effekt die Aufmerksamkeit auf *sich selbst* zieht statt auf den Inhalt → zu laut.

Die vollständige BEHALTEN/VERMEIDEN-Liste und alle Vanilla-Snippets stehen in **`references/animation-library.md`**. Kurz-Heuristik:
- **BEHALTEN:** Scroll-Reveal (fade-up), Count-up, Text-Shimmer (sparsam, 1 Phrase), Mask/Clip-Reveal, Marquee (langsam + Edge-Fade), Cursor-Spotlight (dezent), Border-Beam (dünn, 1 Card), Aurora (nur grün, sehr blass), Bento-Grid, Magnetic-Button (≤6px), Progressive-Blur-Nav, Tracing-Beam/Timeline, Before/After-Slider, Scroll-Progress-Bar.
- **VERMEIDEN:** Typewriter, Sparkles, Rainbow/Glitch/3D-Flip-Text, Meteors/Particles/Vortex, Neon-Border, 3D-Tilt >5°, Globe/Icon-Cloud/Orbiting, Confetti/Gooey, seitenweites Horizontal-Scroll, Parallax >15%.

### 2. Sans-Serif only, kein Italic
- ✅ **Inter** (400–800) + **JetBrains Mono** (400–500, für Eyebrows/Mono-Details)
- ❌ Kein Serif (Fraunces, Source Serif, Times, Georgia), ❌ kein `font-style: italic` (per `em,i,cite,q {font-style:normal}` global geblockt)

### 3. Eine Marke, viele Identitäten (kein Farb-Zirkus)
Alle Nischen teilen **ein** Markengefühl. Differenzierung läuft über **Copy + Hero-Verlauf**, nicht über grelle Akzentfarben. Der Nischen-Akzent ist ein *Token-Flip*: identische CSS-Variablennamen, pro Nische nur tiefere/andere Werte aus **derselben gedämpften Farbfamilie** (siehe `data/niche-theme.js`). Niemals knalliges SaaS-Grün, niemals 16 bunte Themes.

### 4. Echte Daten, anti-Floskel-Copy
- Konkrete Zahlen statt Buzzwords („+120% Terminanfragen", „Top 3 bei Google Maps", „4,9★ aus 62 Bewertungen")
- Benefit-getrieben, branchenspezifische Schmerzpunkte
- Platzhalter (illustrative Stats mit `*`, neutrale Testimonial-Rollen ohne erfundene Namen) **klar markieren** und vor Live ersetzen
- Niemals „innovative Lösungen" / „wir helfen Ihnen wachsen"

## Architecture (das datengetriebene System)

```
data/niches.js        → window.NICHES (Copy je Nische) + NICHES_ORDER + NICHE_DEFAULTS
data/niche-theme.js   → NICHE_ACCENTS (Token-Flip-Farben) + NICHE_SEO_SERVICE + NICHE_BRAND
landing.html          → EIN Template, nur leere data-field / data-list / data-href Hooks
assets/js/landing.js  → Renderer: liest ?niche=<slug>, füllt Hooks, setzt Token-Flip + SEO/Schema
assets/js/main.js     → ruhige Interaktionen: Lenis, Reveal (IO), Count-up, Nav, Mobile-Nav
assets/css/style.css  → Apple-Luxury Design-System + „LANDINGPAGE-SYSTEM"-Block
index.html            → Hub/Übersicht (Karten-Grid aller Nischen)
flagship.html/css/js  → optionale Premium-Startseite mit dezenten 21st.dev-Effekten
build.js              → Static-Build → dist/<slug>/index.html + Hub + sitemap + robots
```

**Render-Hooks im Template** (so funktioniert das Befüllen):
- `data-field="key"` → `textContent` aus dem Daten-Feld
- `data-field="key" data-html` → `innerHTML` (für Hero-Titel mit `<br>`)
- `data-href="key"` → setzt `href` (Telefon/E-Mail)
- `data-list="trust|pains|services|stats|process|faq|expertStats|beforeAfter|bento|marquee"` → rendert eine Liste
- `data-opt="beforeAfter|bento|marquee"` → optionale Sektion, wird entfernt wenn die Nische sie nicht liefert

**Eine neue Nische hinzufügen** = ein Objekt in `window.NICHES` + Slug in `NICHES_ORDER`. Hub, Landing und Static-Build erzeugen sich selbst. Kein Copy-Paste pro Seite.

Details: **`references/niche-data-system.md`**.

## Workflow

### Phase 1 — Discovery
Kläre mit dem User:
- Welche **Branchen/Nischen**? (Liste der Slugs)
- Eine **Marke** über alle (Name, Kontakt, Bewertung) oder pro Nische andere?
- Echte **Stats & Trust-Anker** (Jahre, Projekte, Rating) — was ist belegbar, was bleibt Platzhalter?
- Brauchen einzelne Nischen **optionale Sektionen** (Before/After-Slider, Bento, Trust-Marquee)?
- Ziel: nur **dynamische** Seite (`?niche=`) oder auch **Static-Build** für Ads/SEO?

### Phase 2 — Daten
1. `data/niches.js`: `NICHE_DEFAULTS` (Marke/Kontakt/CTA) + `NICHES_ORDER` + je Nische ein Objekt nach Schema (siehe `references/niche-data-system.md` und `templates/data/niches.skeleton.js`).
2. `data/niche-theme.js`: pro Nische ein `NICHE_ACCENTS`-Eintrag (aus der gedämpften Familie!) + `NICHE_SEO_SERVICE` + markenweite `NICHE_BRAND`.
3. Validiere die Daten dependency-frei: `node -e "global.window={};require('./data/niches.js');require('./data/niche-theme.js');console.log(Object.keys(window.NICHES).length+' Nischen OK')"`.

### Phase 3 — Build (Design + Mechanik)
Reihenfolge:
1. `assets/css/style.css` — Tokens zuerst (`:root`), dann Komponenten (siehe `references/design-tokens.md`).
2. `landing.html` — Template mit allen `data-*`-Hooks (aus `templates/landing.html`).
3. `assets/js/landing.js` + `assets/js/main.js` (aus `templates/`).
4. `index.html` — Hub.
5. Lokal prüfen: `npx serve -l 5070` → `http://localhost:5070/landing.html?niche=<slug>`.

### Phase 4 — Animation-Layer (optional, dosiert)
Erst wenn die Seite inhaltlich steht, den Bewegungs-Layer ergänzen — **immer aus `references/animation-library.md`**, immer mit `prefers-reduced-motion`-Gate. Für die Flagship-Startseite: `flagship.html/css/js` als Vorlage (Aurora + Shimmer + Marquee + Spotlight + Border-Beam, alle leise).

### Phase 5 — Static-Build (für Ads/SEO)
`node build.js` → `dist/<slug>/index.html` (echte URLs, FAQ/Service/Breadcrumb-Schema eingebacken, Stats-Endwerte als Text, `<noscript>`-Reveal-Fallback), Hub, `sitemap.xml`, `robots.txt`. Details: **`references/build-and-seo.md`**.
⚠️ `dist/` lokal mit `python3 -m http.server` testen (nicht `serve` — zeigt Directory-Listing statt index.html für `/slug/`).

### Phase 6 — Verify
- Jede Nische lädt fehlerfrei (`?niche=` und statisch), unique `<title>`/Hero
- Genau die erwarteten JSON-LD-Blöcke (Organization/LocalBusiness + FAQPage + Service + Breadcrumb), keine Duplikate
- Nav transparent→solid, Count-up läuft, 0 Konsolenfehler
- Mobile responsive, `prefers-reduced-motion` schaltet Motion ab
- Lighthouse/Core Web Vitals grün

## Reference Documents

- **`references/niche-data-system.md`** — Das datengetriebene Render-System: vollständiges `niches.js`-Schema, alle `data-*`-Hooks, Token-Flip, optionale Sektionen, Hub vs. Landing, neue Nische anlegen.
- **`references/animation-library.md`** — Die kuratierte Premium-Animations-Bibliothek: jeder Effekt mit BEHALTEN/VERMEIDEN-Urteil, Dosierungs-Werten und copy-paste Vanilla-CSS/JS. Inkl. native CSS-2026-Features (scroll-driven, `@property`, `color-mix`, View Transitions) mit Browser-Support-Stand und `@supports`-Fallbacks.
- **`references/design-tokens.md`** — Apple-Luxury Design-System: Farb-/Typo-/Spacing-Tokens, Button-/Eyebrow-/Section-Patterns, die gedämpfte Nischen-Akzent-Familie, Komponenten (Bento, BA-Slider, FAQ, Hub-Cards).
- **`references/build-and-seo.md`** — Static-Build-Pipeline (`build.js` erklärt), Schema.org-Strategie, sitemap/robots, AEO/2026-SEO, Idempotenz-Mechanik (`__NICHE__`/`__STATIC__`), Port-Fallen.

## Template Files

Bereit zum Kopieren in ein neues Projekt (`templates/`):
- `landing.html` — dynamisches Branchen-Template (alle Hooks)
- `index.html` — Hub-Übersicht
- `flagship.html` — Premium-Startseite mit dezenten Effekten
- `assets/css/style.css` — komplettes Apple-Luxury Design-System
- `assets/css/flagship.css` — die dezenten 21st.dev-Effekte (Aurora/Shimmer/Marquee/Spotlight/Border-Beam)
- `assets/js/landing.js` — Renderer
- `assets/js/main.js` — ruhige Interaktionen
- `assets/js/flagship.js` — Cursor-Spotlight
- `data/niches.skeleton.js` — leeres, kommentiertes Daten-Schema (1 Beispiel-Nische)
- `data/niche-theme.js` — Token-Flip + SEO-Service + Brand
- `build.js` — Static-Build
- `serve.json` — `{cleanUrls:false}` (damit `?niche=` ohne 301 lädt)

## Tech Stack (default)

**Pure HTML/CSS/JS** — kein Framework. JS < 6kb. Sub-second loads, 95+ CWV out-of-the-box, läuft ohne JS (Reveal-Fallback). Optional: **Lenis** (Smooth-Scroll, via JSDelivr CDN), automatisch bei `prefers-reduced-motion` aus.

**Fonts:** Inter (400–800), JetBrains Mono (400–500), Google Fonts CDN mit `preconnect`.

## Local Development

```bash
cd /path/to/Landingpages
npx serve -l 5070            # liest serve.json → cleanUrls:false
# Hub:     http://localhost:5070/
# Landing: http://localhost:5070/landing.html?niche=<slug>
# Static:  node build.js && cd dist && python3 -m http.server 5071
```
⚠️ **Port-Falle:** 5060/5061 sind SIP → Chrome blockt mit `ERR_UNSAFE_PORT` (curl funktioniert trotzdem — irreführend). Daher 5070/5071.

## SEO Checklist (pro Nische)
- [ ] Unique `<title>` (Keyword + USP + Marke) und `<meta description>` (155–160 Zeichen)
- [ ] `<link rel="canonical">` auf die echte `/slug/`-URL
- [ ] Open Graph (og:title/description/url/locale)
- [ ] Schema: Organization+LocalBusiness (Brand), FAQPage, Service, BreadcrumbList — **keine Duplikate** (Idempotenz-Flags beachten)
- [ ] Semantic HTML, genau ein `<h1>`, H2/H3 hierarchisch
- [ ] Vorgerenderter Content im Static-HTML (nicht nur client-side)
- [ ] `sitemap.xml` listet alle `/slug/`, `robots.txt` referenziert sie
- [ ] `preconnect` für Font-CDN, `loading="lazy"` below-fold

## Conversion Checklist (pro Landing)
- [ ] Above-the-Fold: Eyebrow + Headline + Subhead + Primary CTA + Trust-Leiste
- [ ] „Kennen Sie das?"-Pain-Sektion (3 branchenspezifische Schmerzpunkte)
- [ ] Services (3, mit konkretem Nutzen)
- [ ] Stat-Strip mit Count-up (illustrative Werte mit `*` + Disclaimer)
- [ ] Optional: Before/After-Slider, Bento-Überblick, Trust-Marquee
- [ ] „Warum [Marke]"-Proof-Panel (Eckdaten statt Stockfoto)
- [ ] 4-Schritt-Prozess, Testimonial, FAQ (mit Schema)
- [ ] Dunkle CTA-Sektion: große Telefonnummer (click-to-call) + E-Mail
- [ ] Mobile: click-to-call funktioniert, Burger-Menü, alles responsive

## Common Pitfalls
1. **Animationen zu laut** — der häufigste Fehler. Im Zweifel Opazität/Distanz/Tempo halbieren. (siehe Dosierungs-Werte in `animation-library.md`)
2. **Bunte Nischen-Themes** — wirkt billig. Eine gedämpfte Familie, Token-Flip.
3. **Doppeltes JSON-LD** — wenn Static-Build UND `landing.js` dasselbe Schema injizieren. `__NICHE__`-Flag gatet das.
4. **`serve` für `dist/`** — zeigt Directory-Listing statt `/slug/`→index.html. `python3 -m http.server` nutzen.
5. **`prefers-reduced-motion` vergessen** — jeder Effekt MUSS abschaltbar sein, auch Lenis (deaktiviert sich nicht automatisch).
6. **Kursive Hervorhebung / Serif** — global geblockt, nie wieder einführen.
7. **Generische Hero-Headlines** („Ihr Partner für Digitales") = SEO-Tod und Conversion-Tod.
8. **Hero-Titel als `textContent`** statt `data-html` — `<br>` würde escaped. Nur der Hero-Titel ist HTML.

## Quick-Start

User: „bau mir Landingpages für [Branchen] wie das Netzformat-System":
1. `templates/` in ein neues Projekt kopieren.
2. Discovery: Branchen-Slugs, Marke/Kontakt, echte Stats.
3. `data/niches.js` + `data/niche-theme.js` befüllen (Skeleton als Vorlage), `node -e` validieren.
4. Lokal `npx serve -l 5070`, jede Nische durchklicken.
5. Optional Animation-Layer + Flagship-Startseite ergänzen (dosiert!).
6. `node build.js`, `dist/` mit `python3 -m http.server` prüfen.
7. SEO- & Conversion-Checkliste durchgehen, Platzhalter markieren.

---

**Gebaut & validiert auf dem Netzformat-Nischensystem (16 Branchen, Mai 2026):** ein Template, datengetrieben, Apple-Luxury, dezente 21st.dev-Effekte, dependency-freier Static-Build für Ads/SEO. Geschmacks-Leitplanken: viel Weiß, gedämpftes Dunkelgrün, Inter + JetBrains Mono, leise Bewegung.
