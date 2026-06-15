# Component Library Reference

Alle wiederverwendbaren Komponenten aus der V1-V10-Bauserie.
Vollständige Code-Snippets liegen in `templates/`.

## 1. Sticky-Stacking Service Cards (V5-Killer)

**Use case:** Statt einfacher Service-Liste — Karten stacken sich beim Scrollen mit Offset
**Effekt:** Visuell sehr eindrucksvoll, ohne JS

```css
.service-card-sticky {
  position: sticky;
  top: 96px;
  margin-bottom: 32px;
}
.service-card-sticky:nth-child(2) { transform: translateY(20px); }
.service-card-sticky:nth-child(3) { transform: translateY(40px); }
/* ...usw. */
```

Komplettes CSS in `templates/style-light-hybrid.css` (.services-sticky)

## 2. Bento Grid 6-Cards (V9-Stil)

**Use case:** Feature-/Service-Showcase asymmetrisch
**Layout:**
```
[============== HERO 4×2 ==============]  [2×1]
[===============================  ====]  [2×1]
                                          [============= DETAIL 2×2]
[2×1]  [2×1]                              [=========================]
```

CSS-Grid:
```css
.bento { display: grid; grid-template-columns: repeat(6, 1fr); gap: 14px; }
.bento-1 { grid-column: span 4; grid-row: span 2; }
.bento-4 { grid-column: span 2; grid-row: span 2; }
/* Andere: grid-column: span 2; */
```

Mit Cursor-Spotlight via CSS-Variablen + JS (siehe templates/main.js).

## 3. Status-Pill mit Pulse

**Use case:** "Verfügbar", "All systems operational", Live-Indikator

```html
<span class="status">
  <span class="dot"></span>
  Aktuell verfügbar
</span>
```

Pulse-Animation via box-shadow + keyframes.

## 4. Dotted Grid Background

**Use case:** Subtle texture (Linear/Vercel-Vibe)

```html
<div class="dot-bg"></div>
```

CSS:
```css
.dot-bg {
  position: fixed;
  inset: 0;
  background-image: radial-gradient(circle, rgba(10,14,11,0.04) 1px, transparent 1px);
  background-size: 28px 28px;
  mask-image: radial-gradient(ellipse 80% 60% at 50% 30%, black, transparent 80%);
}
```

## 5. Hero Dashboard-Mockup Card

**Use case:** Show, don't tell — Hero-Visual mit Browser-Chrome + Live-Chart + Stats

Inkl. Browser-Dots (rot/gelb/grün) und animierter SVG-Chart-Linie.
Siehe templates/index-template.html (hero-card).

## 6. Live Code-Snippet Card

**Use case:** Tech-Credibility durch sichtbaren Code (in Bento oder als Standalone)

```html
<div class="code-card">
  <div class="line"><span class="c-com">// agent.ts</span></div>
  <div class="line"><span class="c-key">import</span> { agent } <span class="c-key">from</span> <span class="c-str">'@core'</span></div>
</div>
```

Mit syntax-highlighting via CSS-Klassen (`c-key`, `c-str`, `c-num`, `c-com`, `c-fn`)
und line-by-line Reveal-Animation.

## 7. Animated Counter

**Use case:** Stats die sich beim Scroll-in animieren

```html
<div class="stat-num"><span data-count="312">0</span>%</div>
```

```js
const animateCount = (el) => {
  const target = parseInt(el.dataset.count, 10);
  const duration = 1800;
  const start = performance.now();
  const step = (now) => {
    const p = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - p, 4);
    el.textContent = Math.floor(target * eased);
    if (p < 1) requestAnimationFrame(step);
  };
  requestAnimationFrame(step);
};
```

## 8. Marquee (Logo- oder Word-Ticker)

**Use case:** Logo-Wall mit Animation, oder Wort-Ticker für Brand-Tonalität

```html
<div class="marquee">
  <div class="marquee-track">
    <span>... Tags ...</span>
    <span>... Tags (Duplikat für seamless loop) ...</span>
  </div>
</div>
```

Mit mask-image für Fade-Ränder.

## 9. Expert Contact Card (Founder)

**Use case:** Above-the-fold direkte Kontaktmöglichkeit zum Founder

```html
<div class="expert">
  <div class="expert-img"><img src="founder.jpg" /></div>
  <div class="expert-content">
    <div class="expert-tag">Ihr Ansprechpartner</div>
    <h3>Founder Name</h3>
    <p>Buchen Sie ein unverbindliches Erstgespräch...</p>
  </div>
  <div class="expert-cta">
    <a href="tel:...">Telefon</a>
    <a href="mailto:...">E-Mail</a>
    <a class="btn-accent">Termin buchen</a>
  </div>
</div>
```

## 10. Reveal-on-Scroll

**Use case:** Sections sanft einblenden beim Scrollen

```html
<div class="reveal">Content</div>
```

```js
const obs = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('is-visible');
      obs.unobserve(e.target);
    }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
```

## 11. Lenis Smooth Scroll (Optional)

Buttery-smooth scroll feel (wie Linear/Vercel).

```html
<script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.42/bundled/lenis.min.js"></script>
```

```js
const lenis = new Lenis({ duration: 1.3, lerp: 0.08 });
function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
requestAnimationFrame(raf);
```

## 12. Sticky CTA Bar

**Use case:** Auch nach Hero-Scroll noch CTA sichtbar

```html
<div class="sticky-cta">
  <div>Kostenlose Potentialanalyse · 30 Min</div>
  <a href="kontakt.html" class="btn">Termin sichern →</a>
</div>
```

Zeigt sich nach Hero-Exit via IntersectionObserver.

## 13. FAQ Accordion mit Schema

**Use case:** SEO-Goldgrube (FAQPage Schema)

```html
<div class="faq-item">
  <button class="faq-q">Frage? <span class="icon">+</span></button>
  <div class="faq-a"><div class="faq-a-inner">Antwort.</div></div>
</div>
```

Plus FAQPage Schema.org (siehe `references/seo-2026.md`).

## 14. Comparison Table

**Use case:** Differenzierung gegenüber Wettbewerb

```html
<table class="compare">
  <thead>
    <tr><th>Feature</th><th class="us">Wir</th><th>Wettbewerber</th></tr>
  </thead>
  <tbody>
    <tr><td>Feature</td><td class="us">✓</td><td>—</td></tr>
  </tbody>
</table>
```

## 15. Burger Menu (Mobile)

```html
<button class="burger"><span></span><span></span><span></span></button>
```

Animierte Transformation zu X bei Open.
