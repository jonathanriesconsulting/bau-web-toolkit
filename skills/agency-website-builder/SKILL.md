---
name: agency-website-builder
description: Build high-converting, SEO-optimized agency/B2B service websites in pure HTML/CSS/JS. Use this skill when the user asks to build, design, or improve a service-business website (digital agency, SaaS, consulting, freelance, studio) — especially when they want light/minimal aesthetics combined with tech-forward polish (Linear/Vercel/Resend/winno.ch vibes). Covers complete sites with hero sections, sticky service cards, bento grids, code-snippet showcases, status pills, FAQ accordion with Schema.org markup, transparent pricing, testimonials, and full SEO setup (LocalBusiness + FAQPage + Organization schemas, sitemap, robots.txt). Built from learnings of designing 10 website versions for Netzformat (May 2026).
---

# Agency Website Builder

Du baust hochwertige, conversion-optimierte Service-Business-Websites mit dem Fokus auf:
- **Schlichtheit + Tech-Polish** (Light/White Theme + Linear/Vercel-Akzente)
- **Maximale SEO** (Schema.org, FAQ-Markup, semantic HTML, Performance)
- **Direkter Kontakt + Trust** (Founder-Photo, Phone-Number, Status-Pill)
- **Sans-Serif only** (Inter + JetBrains Mono — kein Italic, kein Serif)

## When to Use

Aktiviere diesen Skill wenn der User möchte:
- Eine neue Agency- oder Service-Website bauen
- Eine bestehende Website neu denken / refresh
- B2B-Landing-Pages mit Conversion-Fokus
- Studio-/Consulting-/Freelance-Websites
- Tech-Forward-aber-schlichte Designs (Linear-Style hell)

## Core Philosophy

1. **User-Präferenzen respektieren** (insbesondere bei Netzformat):
   - ❌ **KEINE Kursivschrift** (`font-style: italic` verboten)
   - ❌ **KEINE Serif-Fonts** (Fraunces, Source Serif 4, Times, Georgia)
   - ✅ Inter + JetBrains Mono ausschließlich
   - ✅ Viel Weiß + Hellgrau
   - ✅ Grüne Akzente bei Netzformat (`#2a8f5b`)

2. **Schlichtheit schlägt Show**
   - Kompakte Typografie (Hero max 64px, Sections max 48px)
   - Reduzierte Animationen (subtle reveal, kein Parallax-Wahnsinn)
   - Großzügiger Whitespace
   - 14.5px Body-Font

3. **Echte Daten und konkrete Zahlen**
   - "25+ Jahre", "+312% Traffic", "99.9% Uptime"
   - Niemals "innovative Lösungen" / "wir helfen Ihnen wachsen"
   - Konkrete Cases, echte Kundenlogos, echte Bewertungen

## Workflow

### Phase 1: Discovery
Verstehe vom User:
- Was ist das Geschäft? (Branche, Größe, Zielgruppe)
- Was sind die echten Stats? (Jahre, Projekte, Kunden, Bewertungen)
- Wer sind die echten Personen? (Founder, Team — Photos!)
- Was sind die echten Cases? (Mit Metriken)
- Welche Brand-Farbe?
- Welches Stil-Spektrum? (siehe `references/design-systems.md`)

### Phase 2: Structure
Plane die Sitemap. Standard für Agency:
- `index.html` — Startseite (Hero, Stats, Expert, Services, Bento, Customers, Team, CTA, Footer)
- `leistungen.html` — Services im Detail
- `projekte.html` — Cases mit Metriken
- `profil.html` — Team + Founder + Werte
- `kontakt.html` — Form + direkte Kanäle
- `robots.txt`, `sitemap.xml`

### Phase 3: Build
Folge der Reihenfolge:
1. CSS-System (Farben + Typo + Spacing variables)
2. `index.html` (vollständig, mit allen Sections)
3. `assets/js/main.js` (siehe `templates/main.js`)
4. Subseiten (kompakter, aber mit konsistentem Header/Footer)
5. SEO-Files (robots.txt, sitemap.xml)
6. Schema.org-Markup in alle Pages

### Phase 4: Verify
- Alle Pages http 200 testen
- Mobile Responsive prüfen
- Schema.org Markup validieren (Google Rich Results Test)
- Core Web Vitals testen
- Alle Links funktionieren

## Reference Documents

Lese diese Detail-Docs für spezifische Themen:

- **`references/design-systems.md`** — Farbpaletten, Typografie, erprobte Stilrichtungen (winno.ch, world.org, Linear, Vercel, Stripe, etc.)
- **`references/conversion-patterns.md`** — Hero-Patterns, Trust-Signals, Pricing, CTA-Hierarchie, FAQ, Forms
- **`references/seo-2026.md`** — Schema.org Markups, On-Page-SEO, Local SEO, Answer Engine Optimization (AEO)
- **`references/components.md`** — Sticky-Cards, Bento-Grid, Status-Pills, Code-Snippets, Dotted-BG, Marquee, Counter
- **`references/favorite-template-v10.md`** — Der erprobte Hybrid-Stack (V5 + V9 + Original) als Komplett-Template

## Template Files

Bereit zur Verwendung:

- **`templates/style-light-hybrid.css`** — Komplettes CSS-System (Hybrid Light + Tech)
- **`templates/main.js`** — Alle Interaktionen (Reveal, Counter, Bento-Spotlight, FAQ, etc.)
- **`templates/index-template.html`** — Vollständige Startseiten-Vorlage

## Tech Stack (default)

**Pure HTML/CSS/JS** — Kein Framework. Reasons:
- Minimaler Bundle (< 5kb JS)
- Sub-second loads
- 95+ Core Web Vitals out-of-the-box
- Funktioniert auch ohne JS
- Hostbar überall

**Fonts (Google Fonts CDN):**
- Inter (300, 400, 500, 600, 700)
- JetBrains Mono (400, 500, 600)

**Optional Libs:**
- Lenis (Smooth Scroll) — von studio-freight via JSDelivr

## Local Development

```bash
cd /path/to/website
python3 -m http.server 8000
# Open http://localhost:8000
```

## SEO Checklist (jede Page)

- [ ] `<title>` mit Haupt-Keyword + USP + Brand
- [ ] `<meta description>` 155-160 Zeichen
- [ ] `<link rel="canonical">`
- [ ] Open Graph Tags (og:title, og:description, og:image, og:url, og:locale)
- [ ] Twitter Card
- [ ] Schema.org Markup (Organization minimum)
- [ ] Semantic HTML (header, nav, main, article, section, footer)
- [ ] H1 nur einmal pro Page
- [ ] Image alt-Tags mit Keywords
- [ ] `loading="lazy"` für Below-Fold-Images
- [ ] `preconnect` für Font-CDN
- [ ] robots.txt referenziert sitemap.xml

## Conversion Checklist (Startseite)

- [ ] Above-the-Fold: Headline + Subhead + Primary CTA + Secondary CTA + Trust-Signals
- [ ] Logo-Wall für Social Proof
- [ ] Stat-Strip mit animated Counter (3 Stats)
- [ ] Expert-Card mit Founder-Photo + Phone + Email
- [ ] Service-Sektion (entweder Bento oder Sticky-Cards)
- [ ] Case Studies mit konkreten Metriken
- [ ] Testimonials (3 Stück, mit Stars)
- [ ] FAQ mit Schema-Markup
- [ ] CTA-Block vor Footer
- [ ] Footer mit allen Kontakt-Optionen
- [ ] Mobile click-to-call funktioniert

## Important Notes

- **Niemals einen Hero über 80px Font-Größe machen** (außer User will explizit)
- **Niemals stockphotos** — echte Team-Photos, echte Logos
- **Immer Schema.org** — auch wenn die Page klein ist
- **Direct contact above the fold** — Telefon-Button im Header sichtbar
- **Pricing transparent** wenn möglich — auch "ab X€" hilft

## Common Pitfalls

1. **Zu viele Animationen** — User scrollt nicht durch Glitter
2. **Zu wenig Whitespace** — Sektion-Padding mindestens 70px
3. **Acid-Lime / Neon-Farben** in B2B-Kontext = unprofessionell
4. **Kursive Wörter zur Hervorhebung** — User mag das oft nicht (immer fragen!)
5. **Stock-Optionen-Pricing** ohne echte Pakete — wirkt unsicher
6. **Generische Hero-Headlines** ("Ihr Partner für Digitales") = SEO-Tod

## Quick-Start Command

Wenn User sagt "bau mir eine Agency-Website wie Netzformat":
1. Frage nach Brand (Name, Farbe, Branche)
2. Frage nach echten Daten (Stats, Founder-Photo, Cases)
3. Lade `templates/style-light-hybrid.css` und passe Farben an
4. Lade `templates/index-template.html` und passe Content an
5. Generiere Subpages mit konsistentem Header/Footer
6. Setze SEO-Files auf
7. Starte lokalen Server auf Port 8000-8010

---

**Gebaut aus Erfahrung mit 10 Versionen für Netzformat (Mai 2026).**
User-Favoriten waren V5 (Light Editorial / winno-Style) + V9 (Tech-SaaS / Linear-Style).
Der Hybrid V10 kombiniert beide mit dem Original-Markenkontext.
