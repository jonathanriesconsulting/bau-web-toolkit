# V10 — The Favorite Hybrid Template

Das ist der erprobte und vom User approved Stack — der Best-of-Mix aus V5 (Light Editorial) + V9 (Tech SaaS) + Original (Netzformat Brand).

## When to Use

Default-Template für Agency-Websites mit folgenden Wünschen:
- "Schlicht, modern, hochwertig"
- "Viel Weiß und Hellgrau"
- "Grüne Akzente"
- "Direkter Kontakt fokus"
- "Tech-Polish aber nicht overwhelming"

## Stack-Komponenten

### Aus V5 (Light Editorial)
- ✅ Weißer Hintergrund + sanfte Grau-Stufen
- ✅ **Sticky-Stacking Service Cards** (Killer-Feature)
- ✅ Marquee mit kleinen Pillen
- ✅ Customer-Logo-Ticker mit Mask-Fade
- ✅ Schmale Container, kompakte Typografie

### Aus V9 (Tech SaaS)
- ✅ **Dotted-Grid Background** (subtil)
- ✅ **Status-Pill mit Pulse-Dot**
- ✅ **Bento-Grid 6-Cards** mit Cursor-Spotlight
- ✅ **Live Code-Snippet Card** (JetBrains Mono, line-by-line Reveal)
- ✅ **18 Integration-Tiles**
- ✅ **Hero Dashboard-Mockup** mit Browser Chrome + animiertem SVG-Chart

### Aus Original (Netzformat Brand)
- ✅ **Video-Hintergrund** im Hero (entsättigt, sehr dezent)
- ✅ **Grünes Farbthema** `#2a8f5b` (modernisiert)
- ✅ **"Wir stärken Ihre Marke ONLINE."** als Headline
- ✅ Stats: **25+ / 160+ / 80+** mit grünem Akzent
- ✅ **3-Köpfe-Team** als Cards
- ✅ Jonathan im Mittelpunkt (Expert-Card direkt unter Hero)

## Typografie (User-Anforderung)

```css
--font-display: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
--font-body: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
--font-mono: "JetBrains Mono", ui-monospace, monospace;
```

❌ **KEIN Italic, KEIN Serif!**

Akzent-Wörter via `<span class="accent">` (grün eingefärbt, gerade gesetzt).

## Farb-System

```css
--bg: #ffffff;
--bg-2: #fafbfa;
--surface: #f4f6f4;
--surface-2: #ecefec;
--line: rgba(10, 14, 11, 0.08);

--text: #0a0e0b;
--text-soft: #2f3833;
--text-muted: #5e6862;

--accent: #2a8f5b;        /* Forest green */
--accent-2: #1f7a4b;
--accent-3: #4dbe83;
--accent-soft: rgba(42, 143, 91, 0.08);
--accent-glow: rgba(42, 143, 91, 0.25);
--accent-light: #d4f0e0;
```

## Section-Reihenfolge (Optimal)

1. **Top-Bar** (optional, für Scarcity)
2. **Header** mit Status-Pill + Erstgespräch-CTA
3. **Hero** mit Video-BG + Mesh-Gradient + Dashboard-Mockup
4. **Marquee** mit Tags
5. **Stats** (3 Cards, animiert)
6. **Expert-Card** mit Jonathan
7. **Sticky-Stacking Service Cards** (6 Bereiche)
8. **Bento Features** (6 Cards mit Code-Snippet)
9. **Integrations Grid** (18 Tiles)
10. **Customer Ticker**
11. **Team Grid** (3 Cards)
12. **CTA-Block** (dunkler Kontrast)
13. **Footer** mit Footer-CTA + Multi-Column-Links

## Ready-to-Use Templates

Die Templates liegen in `templates/`:
- `style-light-hybrid.css` (~35kb) — komplettes CSS-System
- `main.js` (~4kb) — alle Interaktionen
- `index-template.html` (~28kb) — vollständige Startseite

## Customization Path

1. **Brand-Farbe ändern:**
   ```css
   --accent: #YOUR_COLOR;
   --accent-2: darker variant;
   --accent-3: lighter variant;
   --accent-soft: rgba(R, G, B, 0.08);
   --accent-glow: rgba(R, G, B, 0.25);
   ```

2. **Content tauschen:**
   - Im index-template.html: Brand-Name, Headline, Stats, Team, Cases
   - Logos in `assets/logos/` ersetzen
   - Jonathan-Portrait durch eigenes Founder-Foto

3. **Sektionen weglassen:**
   - Wenn keine Code-Snippet-Card relevant: Bento-1 anpassen
   - Wenn keine Integrations: Integration-Section entfernen
   - Wenn kein Founder-Fokus: Expert-Card entfernen

## Performance-Profil

- HTML: ~30kb
- CSS: ~35kb
- JS: ~4kb
- Google Fonts: ~50kb (Inter + JetBrains Mono)
- **Total Page-Weight (ohne Video):** ~120kb
- **Mit Video:** je nach Video-Größe

Core Web Vitals out-of-the-box:
- LCP: < 1.5s
- INP: < 100ms
- CLS: 0

## Browser-Support

- Modern Browsers (Chrome 90+, Safari 14+, Firefox 88+)
- iOS Safari 14+
- IntersectionObserver: 95%+ Browser-Support
- CSS Grid: 98%+ Browser-Support
- backdrop-filter: hat Fallback via vollere Background-Opacity

## Hosting-Tipps

```bash
# Dev
python3 -m http.server 8000

# Production (rekommandiert)
# Vercel: drag & drop
# Cloudflare Pages: git connect
# Netlify: drag & drop
```

## Anpassungs-Beispiele

### Netzformat-Spezifisch (Original)
- Accent: `#2a8f5b` (Forest green)
- Video-BG aktiv
- Jonathan als Expert
- "Wir stärken Ihre Marke ONLINE"

### Andere B2B-Agency
- Accent: nach Brand-Logo
- Video-BG ggf. weglassen
- Founder ersetzen
- Stats anpassen

### SaaS-Produkt
- Sticky-Cards weglassen (zu Agency-typisch)
- Bento-Grid stärker betonen
- Pricing-Sektion ergänzen (siehe V7-Template)
- FAQ ergänzen
- Trial-CTA statt "Erstgespräch"

## Verbote des Users

❌ Niemals `font-style: italic` verwenden
❌ Niemals Serif-Fonts (Fraunces, Source Serif, Times, Georgia)
❌ Niemals Headlines >80px
❌ Niemals "Magazine"-Style mit Drop-Caps und römischen Zahlen
❌ Niemals Acid-Lime/Neon-Farben in B2B
