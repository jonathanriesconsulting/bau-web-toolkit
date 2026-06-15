# Conversion Patterns Reference

## Hero-Section Patterns

### Pattern A: Asymmetric mit Visual (SaaS/Tech)
```
[Text + CTA links]  [Dashboard-Mockup rechts]
```
**Wann verwenden:** SaaS, Tech, Data-driven Services
**Beispiel:** V9, V10, V7

### Pattern B: Center-Aligned (Brand)
```
        [Headline groß zentriert]
        [Subhead zentriert]
        [Primary] [Secondary CTA]
        [Hero Image/Video unten]
```
**Wann verwenden:** Brand-fokus, Editorial

### Pattern C: Personal Brand
```
[Text + CTA links]  [Founder-Portrait rechts mit Caption]
```
**Wann verwenden:** Solo-Consultants, Coaches, persönliche Beratung

## Above-the-Fold Essentials

Alle 6 müssen sichtbar sein ohne Scrollen:
1. **Headline** (max 1 Zeile, klarer Value-Prop)
2. **Subheadline** (max 2 Zeilen, konkreter Nutzen)
3. **Primary CTA** (kostenlos, niedrigschwellig)
4. **Secondary CTA** (für Informierte)
5. **Trust-Strip** (3-4 Vorteile: kostenlos, < 24h, ohne Druck)
6. **Social Proof Anchor** (Logo-Wall oder Stat oder Bewertungsschnitt)

## Trust-Signal Patterns

### Stat-Strip mit Animated Counter
```html
<div class="stats">
  <div class="stat">
    <div class="stat-num"><span data-count="25">0</span>+</div>
    <div class="stat-label">Jahre Erfahrung</div>
  </div>
</div>
```
Best Practice: 3-4 Stats, animiert mit IntersectionObserver

### Logo-Bar (Above-the-Fold)
- 6 Logos in einer Reihe
- Grayscale-Default, Color-on-Hover
- Label drüber: "Trusted by 80+ companies"

### Reviews-Aggregate
- "4.9 ★ aus 62 Bewertungen"
- Mit AggregateRating Schema

### Status/Availability-Pill (V9-Stil)
```html
<span class="status">
  <span class="pulse"></span>
  Aktuell verfügbar: 2 Slots in Q3
</span>
```
Erzeugt Scarcity-Effekt

### Direct Contact Anchor
- Telefon + Email als Buttons im Header
- Founder-Photo prominent in Expert-Card
- Click-to-Call auf Mobile

## CTA-Hierarchy

### 3 CTA-Ebenen
1. **Primary** (1 pro Section) — z.B. "Erstgespräch buchen"
2. **Secondary** (Ghost-Style) — z.B. "Cases ansehen"
3. **Tertiary** (Link mit Pfeil) — z.B. "Mehr erfahren →"

### CTA-Placement-Regel
- **Above-the-fold:** 2 CTAs (primary + secondary)
- **Nach Major-Section:** 1 mid-page CTA
- **Vor Footer:** Großer CTA-Block
- **Footer:** CTA-Banner mit Telefon
- **Sticky Bar:** Optional ab Scroll > Hero

## Service-Presentation Patterns

### Sticky-Stacking Cards (V5 — User-Favorit!)
Karten stapeln sich beim Scrollen mit Offset. Wow-Effekt.
Siehe `templates/style-light-hybrid.css`

### Bento-Grid (V9-Stil)
6 Cards asymmetrisch:
- 1 große (4×2) für Hero-Feature mit Code-Snippet
- 1 mittlere (2×2) für Stats/Detail
- 4 kleine (2×1) für weitere Features

### Service-Card Anatomy
```
[Icon]
[Title mit Akzent-Wort grün]
[Description]
[Feature-List]
[Optional: ROI-Box "+87% Conversion"]
[Link: "Mehr erfahren →"]
```

## Pricing Patterns

### 3-Tier Layout
```
[Basic] [Featured/Empfohlen mit Glow] [Custom]
```

### Featured-Tier Hervorhebung
- Badge "Empfohlen" oben
- Leichter Glow-Shadow
- `transform: scale(1.02)`
- Andere Accent-Border

### Trust unter Pricing
- "Alle Pakete inkl. kostenlosem Erstgespräch"
- "Keine versteckten Kosten"
- "Festpreis nach Discovery"

## Testimonial Patterns

### Anatomy
1. ⭐⭐⭐⭐⭐ (5 Sterne)
2. Quote (max 3 Zeilen, konkret)
3. Author-Avatar (echtes Foto > Initials > Gradient)
4. Name + Role + Company

### Layouts
- 3 nebeneinander (Standard für Trust)
- Pull-Quote (Single Featured) für Premium
- Karussell für 5+

## FAQ Pattern (SEO-Kritisch!)

### Best Practice
- 6-10 echte Fragen
- Akkordeon mit smooth Animation
- **FAQPage Schema.org Markup** (20-30% Snippet-Boost!)
- Antworten konkret, mit Zahlen/Preisen

### Implementierung
HTML + JS siehe `templates/main.js` (FAQ-Accordion)
Schema siehe `references/seo-2026.md` (FAQPage section)

## Form-Optimierung

### Less Fields = More Conversions
- Maximal 5-6 Felder
- Optional klar markieren
- Budget-Select statt offener Textfeld
- Topic-Dropdown statt freier Textfeld

### Trust unter Form
- 🔒 "Verschlüsselt · DSGVO-konform · EU-Hosting"
- "Antwort innerhalb von 24h · garantiert"

## Conversion-Killer (vermeiden!)

- ❌ Multi-step Lead-Forms ohne Need
- ❌ Newsletter-Popup beim Landing
- ❌ Chat-Widget das blinkt
- ❌ Cookie-Banner ohne "Alle akzeptieren"
- ❌ Lange Ladezeit (>2s) ohne Skeleton
- ❌ Telefon-Nummer ohne tel:-Link
- ❌ Schwacher Above-the-Fold-CTA
- ❌ Generische Stockfotos
- ❌ "Innovative Lösungen" / "Wir helfen wachsen" (Bullshit-Bingo)
