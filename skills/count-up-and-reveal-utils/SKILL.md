---
name: count-up-and-reveal-utils
description: "Reusable, framework-light scroll-reveal and animated-counter utilities for premium German Massivbau/agency sites — vanilla JS/CSS plus one tiny GSAP+ScrollTrigger layer. Provides: data-attribute-driven count-up (IntersectionObserver, easeOutExpo, tabular-nums, de-DE locale, suffix/decimals), hairline SVG line-draw on scroll (stroke-dashoffset + ScrollTrigger), clip-path \"curtain\" reveals, and stagger-reveal groups. Use when the user asks to \"animate numbers\", \"count up Kennzahlen/stats/Zahlen\", \"let lines draw themselves on scroll\", \"reveal headlines/cards on scroll\", \"Zahlen hochzählen\", \"stagger fade-in\", \"clip-path reveal\", or wants tasteful scroll-triggered reveals that stay serious (no bounce, no jitter). Includes prefers-reduced-motion guards (WCAG 2.2 SC 2.2.2/2.3.3) and Lenis-compatible wiring. Built from the 2026 motion-research baseline (GSAP 3.15, Lenis 1.3.23)."
---

# Count-Up & Reveal Utils

Vier wiederverwendbare, in sich geschlossene Motion-Bausteine für seriöse Bau-/Agency-Sites:

1. **Count-up** — Kennzahlen zählen hoch (IntersectionObserver, `easeOutExpo`, `tabular-nums`, `de-DE`). **Null Dependency.**
2. **Hairline SVG-Draw** — dünne Linien/Pfade zeichnen sich beim Scrollen selbst (`stroke-dashoffset` + ScrollTrigger).
3. **Clip-Path Curtain-Reveal** — Bild/Block wird wie ein Vorhang aufgezogen (`clip-path inset` + ScrollTrigger).
4. **Stagger-Reveal-Gruppen** — Listen/Cards/Headline-Zeilen kommen versetzt herein (ScrollTrigger `batch`).

Leitlinie: **Massivbau statt Jahrmarkt.** Ein Signature-Move pro Sektion — nicht alle vier stapeln. Kein Bounce, kein Wackeln, `expo.out`/`power3.out`, `once: true`. Die Zahl darf nicht zappeln, die Linie nicht überschwingen.

Baustein 1 (Count-up) ist **bewusst vanilla** und braucht GSAP nicht — er läuft auf der schlanksten Landingpage. Bausteine 2–4 nutzen GSAP + ScrollTrigger (das Stück, das ohnehin auf der Seite liegt, wenn `smooth-scroll-gsap-stack` aktiv ist).

---

## When to use / When NOT to use

**Use when** der User sagt:
- „Zahlen hochzählen", „animate the numbers", „Kennzahlen / Stats / Counter", „150+ Projekte zählt hoch"
- „Linien sollen sich beim Scrollen zeichnen", „SVG draw on scroll", „Trennlinie animieren"
- „Bild wie ein Vorhang aufziehen", „clip-path reveal", „curtain"
- „Cards / Listen / Headline-Zeilen sollen gestaffelt reinkommen", „stagger fade-in", „scroll reveal"

**Do NOT use when:**
- Es um die **eigentliche Scroll-Mechanik** geht (smooth scroll, Lenis-rAF-Verdrahtung, ScrollTrigger-Setup) → `smooth-scroll-gsap-stack`. Dieser Skill **konsumiert** den Stack, baut ihn nicht.
- Es um **Cursor / Magnetic / Hover-Microinteractions** geht → `premium-microinteractions`.
- Es um **scroll-getriebene Sticky-Bühnen / Bauphasen-Kino** geht (Image-Sequence, sticky stage) → `scroll-cinema-patterns`. Hier geht es um *kleine* Reveals, nicht um ganze Sektions-Choreografie.
- Der User explizit **kein JS** will → dann nur das CSS-`@keyframes`-Fallback (siehe unten), aber sag dazu: ohne IntersectionObserver feuert es beim Load, nicht beim Sichtbarwerden.

**Disziplin:** Pro Sektion **einen** dieser vier Moves. Count-up gehört in die Kennzahlen-Sektion; Curtain ins Hero/Über-Bild; Stagger in die Leistungen-Liste; Hairline-Draw als *eine* Trennlinie. Nicht alles auf einmal.

---

## 0. CDN & rAF-Verdrahtung (Voraussetzung für Baustein 2–4)

Lädt GSAP **im Footer / `defer`** — nie im Boot-Pfad vor LCP. Aktuelle Versionen (2026):

```html
<!-- ans Ende von <body>, NACH dem Content -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js" defer></script>
<!-- Lenis nur wenn smooth scroll gewünscht -->
<script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js" defer></script>
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css">
```

**Eine einzige rAF** — Lenis fährt auf GSADs ticker, sonst rucken die Reveals gegen den Scroll:

```js
gsap.registerPlugin(ScrollTrigger);

// Reduced-Motion-Gate global ziehen (siehe Pitfalls)
const REDUCE = matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!REDUCE && window.Lenis) {
  const lenis = new Lenis({ lerp: 0.09, autoRaf: false }); // 0.09 = schwer/kontrolliert, NICHT bouncy 0.12
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add((t) => lenis.raf(t * 1000));
  gsap.ticker.lagSmoothing(0);
}
```

Lenis ist transform-frei → `position: sticky`/`fixed` bleiben intakt. **ScrollSmoother nicht nutzen** (dessen `translate` bricht sticky). Wenn `REDUCE` true ist: kein Lenis, native Scroll, keine Reveals (alles steht sofort sichtbar da — siehe `--reveal-off` unten).

---

## 1. Count-up — data-attribut-getrieben, vanilla, keine Dependency

Markup: alles am Element, kein JS-Editieren nötig. Der **sichtbare Startwert ist der Endwert** (für No-JS-Nutzer und Crawler korrekt formatiert), JS setzt ihn beim Mount auf den Startwert herab.

```html
<dl class="kpi">
  <div class="kpi__item">
    <dd class="kpi__num"
        data-count-to="150"
        data-suffix="+">150+</dd>
    <dt class="kpi__label">Projekte realisiert</dt>
  </div>

  <div class="kpi__item">
    <dd class="kpi__num"
        data-count-to="98.5"
        data-decimals="1"
        data-suffix=" %">98,5 %</dd>
    <dt class="kpi__label">termintreu übergeben</dt>
  </div>

  <div class="kpi__item">
    <dd class="kpi__num"
        data-count-to="27"
        data-prefix="seit "
        data-from="1998">seit 1998</dd>
    <dt class="kpi__label">am Markt</dt>
  </div>
</dl>
```

```css
.kpi__num {
  font-variant-numeric: tabular-nums;   /* PFLICHT: sonst springt die Breite pro Ziffer */
  font-feature-settings: "tnum" 1;       /* Fallback für ältere Stacks */
}
```

```js
/* count-up.js — vanilla, dependency-free.
   Liest data-count-to / data-from / data-decimals / data-suffix /
   data-prefix / data-locale / data-duration vom Element selbst. */
(function () {
  const REDUCE = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const nums = document.querySelectorAll('[data-count-to]');
  if (!nums.length) return;

  const easeOutExpo = (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));

  function format(value, decimals, locale) {
    return value.toLocaleString(locale, {
      minimumFractionDigits: decimals,
      maximumFractionDigits: decimals,
    });
  }

  function render(el, value) {
    const d = el.dataset;
    const decimals = parseInt(d.decimals || '0', 10);
    const locale = d.locale || 'de-DE';
    el.textContent = (d.prefix || '') + format(value, decimals, locale) + (d.suffix || '');
  }

  function run(el) {
    const d = el.dataset;
    const to = parseFloat(d.countTo);
    const from = parseFloat(d.from || '0');
    const decimals = parseInt(d.decimals || '0', 10);
    const duration = parseFloat(d.duration || '1600'); // ms

    // Reduced Motion / kein rAF: Endwert sofort, sauber formatiert.
    if (REDUCE || !('requestAnimationFrame' in window)) {
      render(el, to);
      return;
    }

    el.setAttribute('aria-live', 'off'); // Screenreader liest den Endwert, nicht jede Zwischenstufe
    let start = null;
    function step(ts) {
      if (start === null) start = ts;
      const p = Math.min((ts - start) / duration, 1);
      const eased = easeOutExpo(p);
      render(el, from + (to - from) * eased);
      if (p < 1) requestAnimationFrame(step);
      else render(el, to); // exakt auf Endwert einrasten — kein 149,98er Rest
    }
    requestAnimationFrame(step);
  }

  const io = new IntersectionObserver((entries, obs) => {
    for (const e of entries) {
      if (e.isIntersecting) {
        run(e.target);
        obs.unobserve(e.target); // once: nie zurücksetzen / re-triggern
      }
    }
  }, { threshold: 0.4 }); // 0.4 = Block muss spürbar im Viewport sein, nicht nur 1px

  nums.forEach((el) => io.observe(el));
})();
```

Warum so: `threshold: 0.4` + `unobserve` = feuert genau einmal, wenn die Kennzahl wirklich gelesen wird. `easeOutExpo` startet schnell und bremst sanft aus (seriös, kein lineares „Tacho-Hochdrehen"). `toLocaleString('de-DE')` macht aus `98.5` → `98,5` und `12000` → `12.000`. `aria-live="off"` verhindert, dass Screenreader 60× pro Sekunde Zahlen vorlesen.

---

## 2. Hairline SVG-Draw — Linie zeichnet sich beim Scrollen

Eine dünne Linie (Trenner, Unterstreichung, Verbindungspfad) zeichnet sich von links nach rechts. **Eine** pro Sektion, sonst wird es zappelig.

```html
<svg class="hairline" viewBox="0 0 1200 2" preserveAspectRatio="none" aria-hidden="true">
  <line class="hairline__path" x1="0" y1="1" x2="1200" y2="1" />
</svg>
```

```css
.hairline { width: 100%; height: 2px; display: block; }
.hairline__path {
  stroke: var(--c-line, currentColor);
  stroke-width: 1;
  vector-effect: non-scaling-stroke; /* bleibt 1px egal wie breit skaliert */
}
/* Reduced-Motion: Linie steht fertig da (kein dashoffset) */
@media (prefers-reduced-motion: reduce) {
  .hairline__path { stroke-dasharray: none !important; stroke-dashoffset: 0 !important; }
}
```

```js
/* Pro Pfad die echte Länge messen → dash setzen → per ScrollTrigger auf 0 ziehen. */
if (!REDUCE) {
  document.querySelectorAll('.hairline__path').forEach((path) => {
    const len = path.getTotalLength();
    gsap.set(path, { strokeDasharray: len, strokeDashoffset: len });
    gsap.to(path, {
      strokeDashoffset: 0,
      ease: 'none',          // an Scroll gekoppelt → linear, sonst „eilt" die Linie
      scrollTrigger: {
        trigger: path.closest('svg'),
        start: 'top 85%',
        end: 'top 45%',
        scrub: 0.6,          // 0.6 = leichte Trägheit, klebt aber am Scroll
      },
    });
  });
}
```

Falls die Linie **nicht** scroll-gekoppelt sein soll, sondern einmal beim Sichtbarwerden durchläuft: `scrub` entfernen, dafür `start: 'top 85%', once: true` und `duration: 1.1, ease: 'power3.out'`.

`getTotalLength()` funktioniert auf `<line>`, `<path>`, `<polyline>` — also auch für gezeichnete Verbindungslinien zwischen Bauphasen.

---

## 3. Clip-Path Curtain-Reveal — Bild/Block wird aufgezogen

Statt Opacity-Fade (billig, flackert): das Bild ist voll da, ein `inset()`-Vorhang gibt es frei. Liest edel, kein CLS, weil das Bild nie seine Box ändert.

```html
<figure class="curtain">
  <img src="..." alt="Rohbau Einfamilienhaus Brandenburg"
       width="1600" height="1000"
       fetchpriority="high"> <!-- wenn es das LCP-Bild ist; sonst weglassen, NIE lazy beim Hero -->
</figure>
```

```css
.curtain { overflow: clip; }
.curtain img { display: block; width: 100%; height: auto; }
/* Startzustand nur setzen, wenn JS/Motion aktiv — sonst bleibt das Bild sichtbar */
.js-motion .curtain img { clip-path: inset(0 100% 0 0); }
@media (prefers-reduced-motion: reduce) {
  .curtain img { clip-path: none !important; }
}
```

```js
/* class js-motion am <html> setzen, sobald wir wissen: animieren erlaubt */
if (!REDUCE) {
  document.documentElement.classList.add('js-motion');

  gsap.utils.toArray('.curtain img').forEach((img) => {
    gsap.to(img, {
      clipPath: 'inset(0 0% 0 0)',   // Vorhang nach rechts auf
      duration: 1.1,
      ease: 'expo.out',              // schnell rein, weich aus — kein Overshoot
      scrollTrigger: { trigger: img, start: 'top 82%', once: true },
    });
  });
}
```

Richtung variieren über den Start-`inset`: von unten `inset(100% 0 0 0)` → `inset(0% 0 0 0)`; von der Mitte `inset(0 50% 0 50%)` → `inset(0 0% 0 0%)`. **`overflow: clip`** (nicht `hidden`) am Container, damit kein ungewollter Scroll-Container entsteht.

---

## 4. Stagger-Reveal-Gruppen — Listen / Cards / Headline-Zeilen

`ScrollTrigger.batch` ist das richtige Werkzeug: es sammelt die Elemente, die *gemeinsam* in den Viewport kommen, und staffelt nur die. Eine Card, die später allein gescrollt wird, kommt für sich.

```html
<ul class="reveal-group">
  <li class="reveal">Planung &amp; Statik</li>
  <li class="reveal">Rohbau schlüsselfertig</li>
  <li class="reveal">Innenausbau</li>
  <li class="reveal">Übergabe mit Abnahmeprotokoll</li>
</ul>
```

```css
.js-motion .reveal { opacity: 0; will-change: transform, opacity; }
@media (prefers-reduced-motion: reduce) {
  .reveal { opacity: 1 !important; transform: none !important; }
}
```

```js
if (!REDUCE) {
  ScrollTrigger.batch('.reveal', {
    start: 'top 88%',
    once: true,
    onEnter: (batch) =>
      gsap.to(batch, {
        opacity: 1,
        y: 0,
        duration: 0.9,
        ease: 'power3.out',  // seriös, kein back/elastic
        stagger: 0.08,       // 80ms — spürbar gestaffelt, nicht zäh
        overwrite: true,
      }),
  });
  // Startversatz erst NACH dem batch-Setup, damit FOUC-frei
  gsap.set('.reveal', { y: 24 });
}
```

### 4b. Headline-Zeilen-Reveal via SplitText (lizenzfrei seit GSAP 3.13)

Für die *eine* Hero-Headline pro Seite — Zeilen kommen hinter einer Maske hoch. Container braucht ein `aria-label` mit dem Originaltext (SplitText zerlegt das DOM, Screenreader sollen den ganzen Satz lesen):

```html
<h1 class="hero__h" aria-label="Wir bauen Häuser, die Generationen tragen.">
  Wir bauen Häuser, die Generationen tragen.
</h1>
```

```js
// SplitText.min.js zusätzlich laden (gsap@3.15.0/dist/SplitText.min.js), dann:
gsap.registerPlugin(SplitText);
if (!REDUCE) {
  SplitText.create('.hero__h', {
    type: 'lines',
    mask: 'lines',     // erzeugt die Überlauf-Maske automatisch
    autoSplit: true,   // re-split bei Font-Load / Resize → kein kaputtes Umbruch-Layout
    onSplit(self) {
      return gsap.from(self.lines, {
        yPercent: 110,
        duration: 1.05,
        stagger: 0.1,
        ease: 'expo.out',
        scrollTrigger: { trigger: '.hero__h', start: 'top 88%', once: true },
      });
    },
  });
}
```

---

## CSS-only Fallback (wenn der User explizit kein GSAP/JS will)

Reveal ohne IntersectionObserver feuert beim Load, nicht beim Sichtbarwerden — für Above-the-fold okay, für tiefere Sektionen schwach. Trotzdem als Notnagel:

```css
@keyframes rise { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: none; } }
.reveal-css { animation: rise .9s cubic-bezier(.16,1,.3,1) both; }
@media (prefers-reduced-motion: reduce) {
  .reveal-css { animation: none; }
}
```

---

## WordPress Classic — Enqueue im Footer (für `wp-classic-onepager`)

```php
// functions.php — Motion-Utils nur im Footer, defer, nach GSAP.
function theme_motion_utils() {
  // GSAP + ScrollTrigger als deps (separat registriert), siehe smooth-scroll-gsap-stack
  wp_enqueue_script(
    'motion-utils',
    get_stylesheet_directory_uri() . '/assets/js/motion-utils.js',
    array('gsap', 'scrolltrigger'),
    '1.0',
    true // $in_footer = true → nie im Boot-Pfad vor LCP
  );
}
add_action('wp_enqueue_scripts', 'theme_motion_utils');
```

Count-up (Baustein 1) hat **keine** deps — separat ohne GSAP enqueuen, damit es auch ohne Smooth-Scroll-Stack läuft.

---

## Pitfalls

- **Reduced-Motion fängt JS NICHT automatisch.** Der CSS-Kill-Switch `*{animation-duration:.01ms!important; transition-duration:.01ms!important; scroll-behavior:auto!important}` killt nur CSS-Animationen. Lenis, der count-up-`requestAnimationFrame`, GSAP-Tweens und `scrollIntoView` laufen weiter. Jedes JS-Motion **muss** separat über `matchMedia('(prefers-reduced-motion: reduce)')` geguarded werden (oben: `REDUCE`). WCAG 2.2 SC 2.2.2 / 2.3.3.
- **Count-up ohne `tabular-nums` zappelt:** Proportional-Ziffern haben unterschiedliche Breite → die Zahl „atmet" und schubst Nachbar-Layout. `font-variant-numeric: tabular-nums` ist Pflicht, nicht Deko.
- **Count-up rastet nicht exakt ein:** Beim letzten Frame explizit `render(el, to)` setzen, sonst bleibt `149,9997` stehen (Float-Reste aus dem Easing).
- **Sichtbarer Startwert = Endwert, nicht 0.** Im HTML steht der fertige Wert (`150+`), JS zählt herunter und hoch. So sehen No-JS-Nutzer und Crawler die echte Zahl, und es gibt kein CLS, wenn JS spät lädt.
- **Reveal-FOUC:** `opacity:0` darf nur unter `.js-motion` greifen. Wenn du `opacity:0` global ins CSS schreibst und JS schlägt fehl / lädt nicht, ist der Content für immer unsichtbar. Erst `js-motion` an `<html>` setzen, dann verstecken.
- **`getTotalLength()` braucht ein gerendertes SVG.** In `display:none`/noch nicht layouteten SVGs gibt es 0 zurück. Erst messen, wenn das Element im Flow ist (Script im Footer reicht).
- **Curtain mit Opacity statt clip-path = billig.** Opacity-Fade flackert auf Retina und wirkt nach Template. `clip-path inset()` zieht edel auf und verursacht kein CLS, weil die Box-Größe konstant bleibt. `overflow: clip` (nicht `hidden`) — `hidden` kann einen unbeabsichtigten Scroll-Container erzeugen.
- **SplitText ohne `aria-label`** macht die Headline für Screenreader zu Buchstaben-/Zeilen-Fragmenten. Originaltext immer als `aria-label` an den Container. `autoSplit:true` setzen, sonst zerbricht das Zeilen-Layout, wenn der Webfont nachlädt und neu umbricht.
- **Zwei rAF-Loops (Lenis eigene + GSAP-ticker) = Ruckeln.** Genau **eine** rAF: `autoRaf:false` + `gsap.ticker.add(t=>lenis.raf(t*1000))` + `lagSmoothing(0)`. Sonst laufen Reveals gegen den Scroll.
- **`ease: 'back'/'elastic'` für Massivbau-Kunden = Jahrmarkt.** Nur `expo.out` / `power3.out` / `power2.out`. Kein Overshoot, kein Bounce. Die Zahl, die Linie, die Card kommen *an* und bleiben — sie federn nicht nach.
- **`scrub` ≠ `once`.** `scrub` koppelt fest an den Scroll (vor/zurück möglich, gut für die Hairline-Linie). Für Reveals willst du `once: true` — einmal rein, nie zurücksetzen, sonst „atmet" die Seite beim Hoch-/Runterscrollen.
- **GSAP/Lenis im Boot-Pfad vor LCP** verschiebt den Largest Contentful Paint. Immer `defer` / Footer-Enqueue. Count-up (vanilla) darf früh laufen, GSAP-Bausteine nicht.
- **Alle vier Moves in einer Sektion** = visuelles Chaos. Disziplin: ein Signature-Move pro Sektion.

---

## Related skills

- **smooth-scroll-gsap-stack** — die Basis-Verdrahtung (GSAP 3.15 + ScrollTrigger + Lenis 1.3.23, eine rAF). Dieser Skill *konsumiert* sie. Bei „smooth scroll", „Lenis", „träges Scrollen" dort starten.
- **premium-microinteractions** — Custom-Cursor, Magnetic-CTA, Hover-States. Reveals hier, Pointer-Interaktion dort.
- **scroll-cinema-patterns** — ganze sticky-stage Sektions-Choreografie / Bauphasen-Kino. Dieser Skill macht *kleine* Reveals, nicht die große Bühne.
- **web-accessibility-motion** — das vollständige `prefers-reduced-motion`-Regelwerk, WCAG-2.2-Kriterien, `aria-live`/`aria-label`-Patterns für animierten Content.
- **web-performance-vitals** — `fetchpriority`, `<picture>` AVIF→WebP→JPG, Font-`size-adjust`, LCP/CLS/INP-Budgets. Wichtig wegen Curtain-Hero-Bild und Footer-Defer.
- **wp-classic-onepager** — Footer-Enqueue, `edi_section()`-Pattern, wo die Kennzahlen-/Über-Sektionen entstehen, in denen diese Utils landen.
- **construction-website-builder** — der Domain-Kontext (B2C-Familien vs. B2B-GU, Sektion-Architektur, Trust-Signale). Bestimmt, *welche* Zahl hochzählt und *welche* Sektion einen Reveal verdient.
