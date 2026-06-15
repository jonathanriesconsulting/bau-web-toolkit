---
name: award-web-techniques
description: "Master-Index für Award-Tier Web-Techniken (Awwwards / FWA / CSSDA-Niveau) auf seriösen Business-Sites — das 16-Techniken-Toolkit, wann welche Technik, Disziplin-Regeln und wie man eine \"kompetente\" Site auf \"award-würdig\" hebt. Use when the user asks to \"make this look award-winning / Awwwards-tier / premium / high-end / agency-level\", references Linear/Vercel/Stripe/Apple polish, wants smooth scroll + custom cursor + magnetic buttons + preloader + scroll-reveal as a coherent system, or asks \"wie hebe ich diese Site auf das nächste Level / was fehlt für award-worthy\". Routes to the detail-skills (smooth-scroll-gsap-stack, premium-microinteractions, web-accessibility-motion, web-performance-vitals, scroll-cinema-patterns). Built from 21-agent web research 2026 (GSAP 3.15, Lenis 1.3, View Transitions Baseline, INP/LCP/CLS targets). Discipline-first: ein Signature-Move pro Sektion, Massivbau statt Jahrmarkt."
---

# Award Web Techniques — Master Index

Das kuratierte Toolkit, mit dem eine **kompetente** Site zu einer **award-würdigen** Site wird (Awwwards / FWA / CSSDA-Niveau) — ohne in Jahrmarkt-Effekte zu kippen. Dieser Skill ist der **Master-Index**: er sagt dir, *welche* der 16 Techniken du wann einsetzt, in welcher Reihenfolge sie sich stapeln dürfen, und welche Disziplin-Regeln die Site seriös halten. Für die Implementierungs-Tiefe verweist er auf die Detail-Skills (siehe „Related skills").

**Leitsatz: Massivbau statt Jahrmarkt.** Award-Tier ≠ maximale Effektdichte. Award-Tier = *Zurückhaltung mit Präzision*. Eine Site gewinnt, weil **ein** Signature-Move pro Sektion perfekt sitzt — nicht weil zehn Effekte gleichzeitig feuern.

## When to use

- „Mach das award-würdig / Awwwards-tier / high-end / premium / agency-level."
- „Wie hebe ich diese Site auf das nächste Level — was fehlt für award-worthy?"
- User referenziert Linear / Vercel / Stripe / Apple / Igloo / Active-Theory-Polish.
- User will einen *kohärenten* Motion-Layer: Smooth-Scroll + Custom-Cursor + Magnetic-CTA + Preloader + Scroll-Reveal als **System**, nicht als Einzelteile.
- Du hast eine fertige, inhaltlich solide Site (z. B. aus `construction-website-builder` / `agency-website-builder`) und sollst den „Finish-Pass" fahren.

## When NOT to use

- **Inhalt/Struktur fehlt noch.** Erst Copy, IA und Sektion-Architektur (→ `construction-website-builder`, `construction-copywriting-german`). Motion auf eine schwache Seite zu kleben gewinnt nichts.
- **Conversion-kritische Funnels / Formulare / Checkout.** Dort zählt Geschwindigkeit und Klarheit, nicht Cinema. Maximal dezenter Scroll-Reveal.
- **Performance-Budget ist eng / Low-End-Geräte sind Hauptpublikum.** Lenis + Canvas-Ambient + GSAP kosten. Dann nur die CSS-only-Techniken (Reveal, Marquee, Count-up, Bento-Lines).
- **User will „alles gleichzeitig".** Das ist das Anti-Pattern. Dieser Skill ist explizit ein *Kürzungs*-Werkzeug.

---

## Das 16-Techniken-Toolkit

Vier Tiers nach Aufwand/Risiko. **Faustregel: pro Site ~6–9 Techniken, davon max. 2 aus Tier 3.**

| # | Technik | Tier | Detail-Skill |
|---|---|---|---|
| 1 | Smooth-Scroll (Lenis + GSAP, eine rAF) | 2 | smooth-scroll-gsap-stack |
| 2 | SplitText Line-Mask Headline-Reveal | 2 | smooth-scroll-gsap-stack |
| 3 | Scroll-Reveal (IntersectionObserver, CSS-only) | 1 | premium-microinteractions |
| 4 | Custom-Cursor (Dot 1:1 + Ring-lerp) | 2 | premium-microinteractions |
| 5 | Magnetic-CTA (nur Haupt-CTA, strength ≤0.15) | 2 | premium-microinteractions |
| 6 | Preloader / Intro-Counter (Erstbesuch) | 2 | premium-microinteractions |
| 7 | Count-up Zahlen (data-getrieben) | 1 | premium-microinteractions |
| 8 | CSS-Marquee / Logo-Ticker | 1 | premium-microinteractions |
| 9 | Bento / Editorial-Grid (1px-Linien-Optik) | 1 | frontend-design |
| 10 | Scroll-Cinema Sticky-Stage | 3 | scroll-cinema-patterns |
| 11 | WebGL/Canvas-Ambient (monochromer Mesh) | 3 | — (siehe unten) |
| 12 | View Transitions (same-document) | 2 | — (siehe unten) |
| 13 | OKLCH-Token-System (L-Hierarchie) | 1 | multi-variant-theme-tokens |
| 14 | prefers-reduced-motion Kill-Switch + JS-Guard | 1 | web-accessibility-motion |
| 15 | Core-Web-Vitals Hardening (LCP/INP/CLS) | 1 | web-performance-vitals |
| 16 | Schema.org @graph (sichtbar-only, GEO-fähig) | 1 | construction-seo-german |

**Tier 1** (CSS/leichtes JS, kein Dependency-Risiko) ist die Pflicht-Basis — die holt 70 % des „Premium"-Gefühls. **Tier 2** ist der Motion-Layer, der award-tier signalisiert. **Tier 3** ist der „Star-Move" — *einer* pro Site, nie zwei.

---

## Entscheidungsbaum: was hebt diese Site auf Award-Tier?

```
Ist die Basis (Tier 1) komplett?  →  NEIN: zuerst das. Reveal + Vitals + Tokens.
   │ JA
   ▼
Gibt es EINEN Hero-Moment, der im Gedächtnis bleibt?
   │ NEIN → wähle GENAU EINEN Star-Move (Tier 3):
   │         • Produkt/Prozess erzählen?      → Scroll-Cinema (#10)
   │         • Marke/Atmosphäre?              → Canvas-Ambient (#11)
   │         • Multi-Page-Galerie?            → View Transitions (#12)
   │ JA
   ▼
Fühlt sich das Scrollen „billig" an (ruckelt, springt)?
   │ JA → Lenis-Stack (#1) + SplitText-Headlines (#2)
   ▼
Fehlt taktiles Feedback (Hover/Cursor wirkt tot)?
   │ JA → Custom-Cursor (#4) + EIN Magnetic-CTA (#5)
   ▼
Erster Eindruck unspektakulär?
   │ JA (und Site rechtfertigt es) → Preloader-Counter (#6), nur Erstbesuch
   ▼
IMMER zum Schluss: #14 reduced-motion-Guard + #15 Vitals-Check.
```

**Die „Kompetent → Award"-Hebel in Reihenfolge der Wirkung/Aufwand-Ratio:**
1. **Typo-Hierarchie über OKLCH-L** statt vieler Farben (#13) — sofort teurer.
2. **Line-Mask-Headlines** (#2) — der einzelne Move mit dem höchsten „Wow/Zeile".
3. **Lenis-Scroll** (#1) — verändert das *Gefühl* der ganzen Site mit ~15 Zeilen.
4. **1px-Linien-Bento** (#9) statt Schatten-Cards — entfernt den „Bootstrap-Look".
5. **Custom-Cursor + 1 Magnetic-CTA** (#4/#5) — taktil, ohne aufdringlich.

---

## Tier 1 — Die Pflicht-Basis (immer, CSS-first)

### #13 OKLCH-Token-System: Hierarchie nur über Lightness

Grau, aber nicht tot. Ein fixer Hue, mikroskopisches Chroma, die gesamte Hierarchie über `L`.

```css
:root {
  --neutral-h: 250;          /* fix für die ganze Site */
  --neutral-c: 0.006;        /* Grau, aber lebendig (nicht 0 = klinisch) */

  /* Light-dominant: KEIN reines Weiß */
  --l-bg:    oklch(0.985 var(--neutral-c) var(--neutral-h));
  --l-panel: oklch(0.965 var(--neutral-c) var(--neutral-h));
  --l-line:  oklch(0.90  var(--neutral-c) var(--neutral-h));
  --c-text:  oklch(0.22  var(--neutral-c) var(--neutral-h));
  --c-text-2:oklch(0.45  var(--neutral-c) var(--neutral-h));
  --accent:  oklch(0.55  0.13 250);   /* einziger Chroma-Punkt */
}
html { background: var(--l-bg); color: var(--c-text); }
```

Disziplin: **eine** Akzentfarbe (ein Chroma-Wert > 0.01). Alles andere ist L-gestaffeltes Neutral.

### #3 Scroll-Reveal (CSS-only, IntersectionObserver)

Kein GSAP nötig. Robust, billig, reduced-motion-fest.

```css
[data-reveal] {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity .8s cubic-bezier(.22,1,.36,1),
              transform .8s cubic-bezier(.22,1,.36,1);
  will-change: opacity, transform;
}
[data-reveal].is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  [data-reveal] { opacity: 1; transform: none; transition: none; }
}
```

```js
const io = new IntersectionObserver((entries) => {
  for (const e of entries) {
    if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
  }
}, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
document.querySelectorAll('[data-reveal]').forEach(el => io.observe(el));
```

### #7 Count-up (data-attribut-getrieben)

```html
<span class="stat" data-count-to="1240" data-decimals="0"
      data-locale="de-DE" data-suffix="+">0</span>
```

```js
const easeOutExpo = t => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));
function countUp(el) {
  const to = parseFloat(el.dataset.countTo);
  const dec = parseInt(el.dataset.decimals || '0', 10);
  const loc = el.dataset.locale || 'de-DE';
  const suf = el.dataset.suffix || '';
  const fmt = new Intl.NumberFormat(loc, { minimumFractionDigits: dec, maximumFractionDigits: dec });
  const dur = 1600; let start;
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce) { el.textContent = fmt.format(to) + suf; return; }
  function step(ts) {
    start ??= ts;
    const p = Math.min((ts - start) / dur, 1);
    el.textContent = fmt.format(to * easeOutExpo(p)) + suf;
    if (p < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}
const co = new IntersectionObserver((es) => {
  for (const e of es) if (e.isIntersecting) { countUp(e.target); co.unobserve(e.target); }
}, { threshold: 0.4 });
document.querySelectorAll('[data-count-to]').forEach(el => co.observe(el));
```

CSS: `.stat { font-variant-numeric: tabular-nums; }` — sonst springt die Breite.

### #8 CSS-Marquee / Logo-Ticker (pause-on-hover + focus)

```css
.marquee { overflow: hidden; -webkit-mask: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); mask: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); }
.marquee__track { display: flex; gap: 4rem; width: max-content; animation: marquee 32s linear infinite; }
.marquee:hover .marquee__track,
.marquee:focus-within .marquee__track { animation-play-state: paused; }
@keyframes marquee { to { transform: translate3d(-50%, 0, 0); } }
@media (prefers-reduced-motion: reduce) { .marquee__track { animation: none; } }
```

Den Track-Inhalt per JS **exakt einmal duplizieren** (deshalb `-50%`):
```js
document.querySelectorAll('.marquee__track').forEach(t => t.append(...[...t.children].map(c => c.cloneNode(true))));
```

### #9 Bento / Editorial-Grid (1px-Linien statt Schatten)

```css
.bento {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 1px;                      /* der Trick: gap = Linienstärke */
  background: var(--l-line);     /* die „Linien" sind der Grid-Hintergrund */
  border: 1px solid var(--l-line);
}
.bento > * { background: var(--l-bg); padding: clamp(1.25rem, 3vw, 2.5rem); }
.bento .feat { grid-column: span 7; }   /* asymmetrisch, nicht 6/6 */
.bento .side { grid-column: span 5; }
.bento .index { font: 600 .75rem/1 ui-monospace, monospace; letter-spacing: .08em; text-transform: uppercase; color: var(--c-text-2); } /* 01 / 02 / 03 */
```

Harte Kanten, Mono-Caps-Labels, Index-Nummern, **keine** `box-shadow`. Das ist der Look, der „Editorial / Agentur" signalisiert.

---

## Tier 2 — Der Motion-Layer (signalisiert Award-Tier)

### #1 Smooth-Scroll: Lenis + GSAP in EINER rAF

Die wichtigste Einzel-Technik. **Reihenfolge ist kritisch.** Scripte im Footer / `defer`, nie im Boot-Pfad vor LCP.

```html
<!-- vor </body>, NICHT im <head>; defer hält sie aus dem LCP-Pfad -->
<script defer src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js"></script>
<script defer src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css">
```

```js
gsap.registerPlugin(ScrollTrigger, SplitText);

const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
let lenis;
if (!reduce) {
  lenis = new Lenis({ lerp: 0.12, autoRaf: false }); // 0.12 = sauber/kontrolliert (validiert); 0.09 fühlt sich schwammig an
  lenis.on('scroll', ScrollTrigger.update);          // eine Quelle der Wahrheit
  gsap.ticker.add((t) => lenis.raf(t * 1000));       // EINE rAF — Lenis fährt auf GSAPs Ticker
  gsap.ticker.lagSmoothing(0);
}
```

- **`lerp: 0.12`** = seriös/kontrolliert (validierter Default). `0.09` fühlt sich *schwammig* an (zu langer Catch-up-Schwanz); über `0.15` zeigt das Mausrad Notch-Stufen.
- Lenis ist **transform-frei** → `position: sticky`/`fixed` bleibt intakt. Deshalb **kein ScrollSmoother** (dessen `translate` bricht sticky-Sektionen und damit Scroll-Cinema #10).
- Pro Site **eine** rAF-Schleife. Nie `lenis.raf()` *und* `gsap.ticker` getrennt laufen lassen.

### #2 SplitText Line-Mask Headline-Reveal

Der höchste „Wow pro Zeile". Lizenz: SplitText ist seit GSAP 3.13 **kostenlos** auch für Kunden-Sites.

```html
<h2 class="reveal-lines" aria-label="Wir bauen Häuser, die Generationen überdauern.">
  Wir bauen Häuser,<br>die Generationen überdauern.
</h2>
```

```js
if (!reduce) {
  SplitText.create('.reveal-lines', {
    type: 'lines',
    mask: 'lines',        // die Maske, die das „unter der Linie hervor"-Gefühl macht
    autoSplit: true,      // re-split bei Font-Load / Resize
    onSplit(self) {
      return gsap.from(self.lines, {
        yPercent: 110, duration: 1.05, stagger: 0.1, ease: 'expo.out',
        scrollTrigger: { trigger: self.elements[0], start: 'top 88%', once: true },
      });
    },
  });
}
```

**Pflicht:** `aria-label` mit dem Originaltext am Container — SplitText zerlegt in `<div>`s, ohne das verliert der Screenreader den Satz.

### #4 Custom-Cursor (Dot 1:1, Ring per lerp im rAF)

```css
.cursor-dot, .cursor-ring { position: fixed; top: 0; left: 0; pointer-events: none; z-index: 9999; border-radius: 50%; }
.cursor-dot  { width: 6px;  height: 6px;  background: #fff; mix-blend-mode: difference; } /* invertiert automatisch auf jedem BG */
.cursor-ring { width: 38px; height: 38px; border: 1px solid #fff; mix-blend-mode: difference; transition: width .25s, height .25s; }
.cursor-ring.is-hover { width: 64px; height: 64px; }
@media (hover: hover) and (pointer: fine) { body { cursor: none; } }
```

```js
// PFLICHT-Gate: Touch komplett raus, sonst klebt ein toter Punkt
if (matchMedia('(hover: hover) and (pointer: fine)').matches) {
  const dot = document.querySelector('.cursor-dot');
  const ring = document.querySelector('.cursor-ring');
  let mx = innerWidth/2, my = innerHeight/2, rx = mx, ry = my;
  addEventListener('pointermove', (e) => { mx = e.clientX; my = e.clientY; }); // NUR speichern
  function loop() {
    dot.style.transform  = `translate3d(${mx}px, ${my}px, 0)`;      // 1:1
    rx += (mx - rx) * 0.18; ry += (my - ry) * 0.18;                 // lerp NUR hier
    ring.style.transform = `translate3d(${rx}px, ${ry}px, 0)`;
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
  document.querySelectorAll('a, button, [data-cursor]').forEach(el => {
    el.addEventListener('pointerenter', () => ring.classList.add('is-hover'));
    el.addEventListener('pointerleave', () => ring.classList.remove('is-hover'));
  });
}
```

`mix-blend-mode: difference` + weiß = invertiert automatisch über Bild *und* Text. lerp gehört **in den rAF**, nie in `pointermove`.

### #5 Magnetic-CTA (NUR der Haupt-CTA)

```js
if (matchMedia('(hover: hover) and (pointer: fine)').matches && !reduce) {
  const btn = document.querySelector('[data-magnetic]'); // GENAU EINER pro Seite
  if (btn) {
    const STRENGTH = 0.15;            // Maximum. >0.3 wirkt „besessen"/Jahrmarkt.
    let tx = 0, ty = 0, cx = 0, cy = 0, raf;
    function animate() {
      cx += (tx - cx) * 0.2; cy += (ty - cy) * 0.2;
      btn.style.transform = `translate3d(${cx}px, ${cy}px, 0)`;
      if (Math.abs(tx-cx) > 0.1 || Math.abs(ty-cy) > 0.1) raf = requestAnimationFrame(animate);
    }
    btn.addEventListener('pointermove', (e) => {
      const r = btn.getBoundingClientRect();
      tx = (e.clientX - (r.left + r.width/2)) * STRENGTH;
      ty = (e.clientY - (r.top + r.height/2)) * STRENGTH;
      cancelAnimationFrame(raf); raf = requestAnimationFrame(animate);
    });
    btn.addEventListener('pointerleave', () => { tx = ty = 0; cancelAnimationFrame(raf); raf = requestAnimationFrame(animate); });
  }
}
```

CSS für den Rückweg: `[data-magnetic] { transition: transform .4s cubic-bezier(.22,1,.36,1); }` (greift, wenn JS `transform` loslässt).

### #6 Preloader / Intro-Counter (nur Erstbesuch)

```js
const seen = sessionStorage.getItem('introSeen');
const pre = document.querySelector('.preloader');
const counter = pre?.querySelector('.preloader__count');

if (seen || reduce) {
  pre?.remove();
} else {
  if (lenis) lenis.stop();                 // Scroll während Intro sperren
  const imgs = [...document.querySelectorAll('img[data-preload]')];
  let loaded = 0; const total = Math.max(imgs.length, 1);
  const render = () => { counter.textContent = String(Math.round(loaded/total*100)).padStart(3, '0'); };
  render();
  const done = () => {
    sessionStorage.setItem('introSeen', '1');
    // clip-path / yPercent-Reveal, NICHT opacity-Fade
    gsap.to(pre, { yPercent: -100, duration: 0.9, ease: 'expo.inOut',
      onComplete: () => { pre.remove(); if (lenis) lenis.start(); } });
  };
  if (!imgs.length) { loaded = 1; render(); done(); }
  imgs.forEach(img => {
    const tick = () => { loaded++; render(); if (loaded >= total) done(); };
    if (img.complete) tick(); else { img.addEventListener('load', tick); img.addEventListener('error', tick); }
  });
}
```

CSS: `.preloader__count { font-variant-numeric: tabular-nums; }` — der Counter darf nicht zappeln. Counter an **echtes** Asset-Preloading koppeln, nicht an einen Fake-Timer.

### #12 View Transitions API (same-document, Baseline seit Okt 2025)

```js
function navigate(updateDOM) {
  if (!document.startViewTransition) { updateDOM(); return; } // Feature-Detect → sonst sofort
  document.startViewTransition(updateDOM);
}
```

```css
::view-transition-old(root), ::view-transition-new(root) { animation-duration: .35s; }
@media (prefers-reduced-motion: reduce) {
  ::view-transition-group(*), ::view-transition-old(*), ::view-transition-new(*) { animation: none !important; }
}
```

Kritisch: `view-transition-name` muss **pro Snapshot eindeutig** sein. Bei Galerien nur der *aktiven* Card einen Namen geben, sonst „duplicate name"-Fehler:
```js
cards.forEach(c => c.style.viewTransitionName = '');
activeCard.style.viewTransitionName = 'active-card';
```

---

## Tier 3 — Der eine Star-Move (genau einer pro Site)

### #10 Scroll-Cinema Sticky-Stage
Voll in `scroll-cinema-patterns`. Funktioniert mit Lenis (transform-frei), bricht mit ScrollSmoother. Für Produkt-/Prozess-/Bauphasen-Storytelling.

### #11 WebGL/Canvas-Ambient (subtiler monochromer Mesh)

**Niemals der Star.** Kein Plasma/Neon/Particles. Ziel: kaum wahrnehmbarer, atmender Hintergrund. Variante A (kein WebGL): reine `radial-gradient`-Blobs, `opacity .35–.55`, `mix-blend-mode: multiply`, glaziale Bewegung. Variante B: 2D-Canvas-Gradient-Mesh + `simplex-noise` (~3 KB).

```html
<script type="module">
import { createNoise3D } from 'https://cdn.jsdelivr.net/npm/simplex-noise@4.0.3/+esm';
const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
const cv = document.querySelector('#ambient'); const ctx = cv.getContext('2d');
const noise = createNoise3D();
function resize(){ cv.width = innerWidth; cv.height = innerHeight; }
resize(); addEventListener('resize', resize);
ctx.globalCompositeOperation = 'multiply';
function frame(t){
  ctx.clearRect(0,0,cv.width,cv.height);
  const time = t * 0.00002;                      // glacial
  for (let i=0;i<3;i++){
    const x = (noise(i, 0, time)*0.5+0.5)*cv.width;
    const y = (noise(0, i, time)*0.5+0.5)*cv.height;
    const g = ctx.createRadialGradient(x,y,0,x,y,cv.width*0.5);
    g.addColorStop(0,'oklch(0.55 0.04 250 / 0.5)'); g.addColorStop(1,'transparent');
    ctx.fillStyle = g; ctx.fillRect(0,0,cv.width,cv.height);
  }
  requestAnimationFrame(frame);
}
if (reduce) { /* einmal statisch zeichnen */ frame(0); } else { requestAnimationFrame(frame); }
</script>
```

`<canvas id="ambient" aria-hidden="true">` hinter dem Content, `pointer-events:none`, `opacity:.35–.55`.

---

## Tier 1 — Die Schutzschicht (immer zuletzt, nicht optional)

### #14 prefers-reduced-motion: CSS-Kill-Switch + JS-Guard

Der CSS-Switch fängt **nur CSS-Animationen/Transitions**. JS-Motion (Lenis, Canvas-rAF, GSAP-Tweens, `scrollIntoView({behavior:'smooth'})`) ist davon **nicht** betroffen und muss separat per `matchMedia` geguarded werden — wie oben in jedem JS-Block (`const reduce = …`). WCAG 2.2 SC 2.2.2 / 2.3.3.

```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: .01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: .01ms !important;
    scroll-behavior: auto !important;
  }
}
```

### #15 Core-Web-Vitals Hardening

- **Genau EIN** `fetchpriority="high"`-Bild pro Seite (das LCP-Element). Mehrere heben sich gegenseitig auf.
- Hero-Bild **nie** `loading="lazy"` — direkter LCP-Killer. `loading="lazy"` nur unterhalb des Folds.
- `<picture>` AVIF → WebP → JPG, `srcset` 800/1200/1600/2000w.
- Font: `<link rel="preload" as="font" crossorigin>` + `@font-face` mit `size-adjust`/`ascent-override` für den Fallback gegen CLS.
- GSAP/Lenis `defer` im Footer (siehe #1), nicht im Boot-Pfad vor LCP.
- Ziele 2026: **LCP < 2.5 s, INP < 200 ms** (INP hat FID ersetzt), **CLS < 0.1**.

```html
<link rel="preload" as="image" type="image/avif"
      href="/img/hero-1600.avif" fetchpriority="high">
<picture>
  <source type="image/avif" srcset="/img/hero-800.avif 800w, /img/hero-1200.avif 1200w, /img/hero-1600.avif 1600w, /img/hero-2000.avif 2000w" sizes="100vw">
  <source type="image/webp" srcset="/img/hero-800.webp 800w, /img/hero-1200.webp 1200w, /img/hero-1600.webp 1600w" sizes="100vw">
  <img src="/img/hero-1200.jpg" alt="…" width="1600" height="900" fetchpriority="high" decoding="async">
</picture>
```

```css
@font-face {
  font-family: 'Fallback'; src: local('Arial');
  size-adjust: 102%; ascent-override: 95%; descent-override: 24%; line-gap-override: 0%;
}
```

### #16 Schema.org @graph (sichtbar-only)
→ `construction-seo-german`. `@graph` mit `GeneralContractor` + `GeoCircle areaServed`, `@id`-Verlinkung. **Nur markieren, was sichtbar auf der Seite steht** (Spam-Filter). FAQ-Rich-Results sind seit 7. Mai 2026 abgeschaltet → FAQ kurz halten und GEO/LLM-zitierfähig schreiben (Antwort zuerst).

---

## Disziplin-Regeln (das, was Award von Kitsch trennt)

1. **Ein Signature-Move pro Sektion.** Hero: Line-Mask-Headline. Stats: Count-up. Leistungen: Bento-Lines. Nicht alle drei in einer Sektion stapeln.
2. **Genau ein Star-Move (Tier 3) pro Site.** Cinema *oder* Canvas *oder* View-Transitions — nie zwei.
3. **Genau ein Magnetic-CTA.** Strength ≤ 0.15.
4. **lerp 0.09**, nicht 0.12+. Seriös = schwer & kontrolliert, nicht bouncy.
5. **Kein Bounce/Overshoot/Wackeln** auf einer Meisterbetrieb-Site. `expo.out` / `cubic-bezier(.22,1,.36,1)`, kein `back.out`/`elastic`.
6. **Touch = kein Cursor, kein Magnetic.** Hinter `@media (hover:hover) and (pointer:fine)` + `matchMedia`-Gate.
7. **Erst Inhalt, dann Motion.** Motion auf eine inhaltlich schwache Seite gewinnt nichts.
8. **Eine rAF-Schleife** für Lenis + GSAP. Mehrere konkurrierende rAFs = Ruckler.
9. **Performance schlägt Effekt.** Ein Effekt, der INP über 200 ms drückt, fliegt — egal wie schön.

---

## Pitfalls

- **ScrollSmoother statt Lenis.** ScrollSmoother nutzt `translate` auf dem Content-Wrapper → bricht `position: sticky`/`fixed` und damit jede Scroll-Cinema-Sektion (#10). Lenis ist transform-frei. Nimm Lenis.
- **Zwei rAF-Schleifen.** `lenis.raf()` *und* `gsap.ticker` getrennt laufen lassen → Jank. Lenis auf GSAPs Ticker fahren (`autoRaf:false` + `gsap.ticker.add`).
- **lerp zu hoch.** `0.12+` fühlt sich verspielt/bouncy an. Für seriöse Marken `0.08–0.09`.
- **CSS-`prefers-reduced-motion` als „erledigt" betrachten.** Der `*`-Switch fängt **kein** JS-Motion. Lenis, Canvas-rAF, GSAP-Tweens und `scrollIntoView` müssen separat per `matchMedia('(prefers-reduced-motion: reduce)')` deaktiviert werden. Sonst WCAG-2.2-Verstoß (SC 2.2.2/2.3.3).
- **SplitText ohne `aria-label`.** Zerlegte Zeilen sind `<div>`s → Screenreader verliert den Satz. Originaltext per `aria-label` am Container.
- **Magnetic strength > 0.15.** Wirkt „besessen", Jahrmarkt. Außerdem nur auf den *einen* Haupt-CTA.
- **Custom-Cursor auf Touch.** Ohne `(hover:hover) and (pointer:fine)`-Gate klebt ein toter Punkt am Bildschirm. lerp gehört in den rAF, nicht in `pointermove` (sonst nur bei Bewegung).
- **Mehrere `fetchpriority="high"`-Bilder.** Heben sich gegenseitig auf — der Browser kann nicht alles priorisieren. Genau eins (das LCP-Element).
- **Hero-Bild `loading="lazy"`.** Direkter LCP-Killer. Lazy nur unter dem Fold.
- **GSAP/Lenis im `<head>` / Boot-Pfad.** Blockiert den LCP. `defer` im Footer.
- **Preloader an Fake-Timer.** Counter muss an echtes Asset-`load`-Event koppeln. Und nur Erstbesuch (`sessionStorage`) — sonst nervt er Wiederkehrer. Reveal per `clip-path`/`yPercent`, nicht `opacity`-Fade (wirkt billig).
- **`lenis.stop()` ohne `lenis.start()`.** Wenn der Preloader scrollt sperrt, aber `onComplete` das `start()` vergisst, ist die Seite tot gescrollt.
- **`view-transition-name` mehrfach gleich.** Pro Snapshot muss der Name eindeutig sein → nur die aktive Card benennen, Rest leeren.
- **Canvas-Ambient als Star.** Sobald man es bewusst wahrnimmt, ist es zu stark. `opacity .35–.55`, glaziale Speed, monochrom. reduced-motion → statisch.
- **FAQPage-Schema für Rich-Results bauen.** Abgeschaltet seit 7. Mai 2026. FAQ trotzdem behalten, aber kurz & GEO-zitierfähig (Antwort zuerst), nicht für Sterne-Snippets.
- **OKLCH-Chroma auf 0.** Reines Neutral wirkt tot. `--neutral-c ~0.006` hält das Grau lebendig; reines `#fff` als BG wirkt klinisch (`--l-bg ~0.985`).
- **Alle 16 Techniken stapeln.** Das *ist* das Anti-Award-Pattern. ~6–9 Techniken, max. 2 aus Tier 3 → in der Regel genau eine.

## Related skills

- **smooth-scroll-gsap-stack** — Implementierungs-Tiefe für #1/#2: Lenis+GSAP-Setup, ScrollTrigger-Pinning, SplitText-Varianten, autoSplit-Resize-Handling.
- **premium-microinteractions** — Detail für #3–#8: Custom-Cursor-Zustände, Magnetic-Tuning, Preloader-Choreografie, Hover-Mikrointeraktionen.
- **web-accessibility-motion** — Detail für #14: WCAG-2.2-Motion-Gates, `matchMedia`-Guard-Pattern, Fokus-/Reduced-Motion-Audit.
- **web-performance-vitals** — Detail für #15: LCP/INP/CLS-Hardening, `fetchpriority`, `<picture>`/`srcset`, Font-CLS, Script-Loading-Strategie.
- **scroll-cinema-patterns** — der Star-Move #10 (Sticky-Stage Classic + Mega-Cinema), validiert auf PKB V5/V11.
- **multi-variant-theme-tokens** — Token-Architektur für #13 (OKLCH-L-Hierarchie) + Multi-Varianten-Vergleich.
- **frontend-design** — Editorial/Bento-Layout-Sensibilität für #9.
- **wp-classic-onepager** — wenn die Award-Site als WordPress-Classic-Theme ausgeliefert wird (Script-Enqueue im Footer, Asset-Pipeline).
- **construction-website-builder** / **construction-copywriting-german** / **construction-seo-german** — die inhaltliche Basis, die *vor* diesem Skill steht; #16 lebt in construction-seo-german.
