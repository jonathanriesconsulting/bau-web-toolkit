---
name: web-accessibility-motion
description: "Make motion-heavy / premium-animated websites accessible and WCAG-2.2-compliant without killing the design. Use when the user asks to \"add prefers-reduced-motion\", \"make animations accessible\", \"guard Lenis/GSAP/canvas for reduced motion\", \"make this accessible / barrierefrei\", \"fix focus visibility\", \"keyboard navigation\", \"ARIA for accordion/nav/slider\", \"screen-reader-safe SplitText\", \"WCAG for animations\", \"honor reduced motion\", or build any site that combines smooth scroll, custom cursors, scroll-cinema, count-ups, marquees, magnetic buttons or canvas ambients and must still pass an a11y audit (SC 2.2.2 Pause/Stop/Hide, SC 2.3.3 Animation from Interactions, focus-visible, tabbable). Built from the 2026 premium-motion research stack (GSAP 3.15 / Lenis 1.3 / View Transitions). Pairs with smooth-scroll-gsap-stack, premium-microinteractions, web-performance-vitals."
---

# Web Accessibility for Motion-Heavy Sites

Premium motion (smooth scroll, custom cursors, scroll-cinema, SplitText, count-ups, marquees, magnetic CTAs, canvas ambients) is where accessibility silently breaks. The CSS `prefers-reduced-motion` kill-switch that everyone copy-pastes only catches **CSS** animations — it does **nothing** to Lenis, GSAP timelines, `requestAnimationFrame` canvas loops, `scrollIntoView`, or count-up observers. Those keep running and can trigger vestibular disorders, migraines and seizures (WCAG 2.2 SC 2.2.2 / 2.3.3).

This skill treats **reduced-motion as architecture, not an afterthought**: one CSS kill-switch *plus* a single shared JS `matchMedia` guard that every motion module reads before it starts. Then the keyboard/focus/ARIA layer that motion sites routinely forget.

Leitbild: **Massivbau statt Jahrmarkt.** Accessibility is the building code, not the decoration. A site that disrespects `prefers-reduced-motion` is not "bold", it is non-compliant.

## When to use

- Any site built with **smooth-scroll-gsap-stack** (Lenis + GSAP), **premium-microinteractions** (cursor, magnetic, count-up, marquee), or **scroll-cinema-patterns** — these all need explicit JS guards.
- User says: "make the animations accessible", "add prefers-reduced-motion", "barrierefrei machen", "WCAG audit", "fix the focus rings", "keyboard nav doesn't work", "screen reader reads gibberish on the split headline".
- Before shipping any client site with motion — Meisterbetrieb sites get audited, run this as a final gate.
- Accordion / mobile nav / slider that was built div-soup and needs real ARIA + keyboard.

## When NOT to use

- A static, motionless content page with native HTML controls and visible focus — it's likely already compliant; don't bolt on JS guards for animations that don't exist.
- You only need the *performance* side (LCP/INP/CLS) → that's **web-performance-vitals**.
- You need the motion *implementation* itself → that's **smooth-scroll-gsap-stack** / **premium-microinteractions**; this skill makes those accessible, it doesn't replace them.

---

## 1. The two-layer kill-switch (the core pattern)

`prefers-reduced-motion` has **two layers**. Shipping only Layer A is the single most common a11y bug on premium sites.

### Layer A — CSS (catches CSS transitions/animations + native smooth scroll only)

```css
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

`0.01ms` (not `0`) keeps `animationend`/`transitionend` events firing so JS state machines that wait on them don't deadlock. This catches marquee CSS keyframes, hover transitions, `scroll-behavior:smooth`. It does **NOT** catch Lenis, GSAP, canvas rAF, count-up, `scrollIntoView`. That is Layer B.

### Layer B — one shared JS guard, read by every motion module

Define it **once**, import/read it everywhere. Listen for live changes (users toggle the OS setting without reloading).

```js
// motion-guard.js — single source of truth
export const reduceMotionMQ = window.matchMedia('(prefers-reduced-motion: reduce)');
export let prefersReducedMotion = reduceMotionMQ.matches;

const subscribers = new Set();
export function onMotionPreferenceChange(fn) { subscribers.add(fn); return () => subscribers.delete(fn); }

reduceMotionMQ.addEventListener('change', (e) => {
  prefersReducedMotion = e.matches;
  subscribers.forEach((fn) => fn(prefersReducedMotion));
});
```

Non-module fallback (WP Classic / no bundler): hang it on `window`.

```js
window.A11Y = { mq: matchMedia('(prefers-reduced-motion: reduce)') };
window.A11Y.reduce = window.A11Y.mq.matches;
window.A11Y.mq.addEventListener('change', e => { window.A11Y.reduce = e.matches; });
```

---

## 2. Guarding each motion module

### Lenis (smooth scroll) — must NOT init under reduced motion

Reduced motion means: native, instant, browser-controlled scrolling. Do not start the rAF/lerp loop at all.

```js
// Order from smooth-scroll-gsap-stack: GSAP+ScrollTrigger first, THEN Lenis.
import Lenis from 'https://unpkg.com/lenis@1.3.23/dist/lenis.mjs';
import { prefersReducedMotion } from './motion-guard.js';

let lenis = null;
if (!prefersReducedMotion) {
  lenis = new Lenis({ lerp: 0.09, autoRaf: false }); // 0.09 = heavy/controlled, not bouncy 0.12
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add((t) => lenis.raf(t * 1000));
  gsap.ticker.lagSmoothing(0);
}
// If reduced: do nothing. Native scroll + Layer-A `scroll-behavior:auto` already handle it.
```

Lenis is transform-free, so sticky/fixed survive — but under reduced motion you still skip it entirely. Never use ScrollSmoother (its `translate` breaks sticky **and** there is no clean reduced-motion bypass).

### GSAP / ScrollTrigger — `gsap.matchMedia()` is the idiomatic guard

`matchMedia` auto-reverts and cleans up listeners when the query flips. Use the `reduceMotion` branch for the final, static end-state.

```js
const mm = gsap.matchMedia();

mm.add({
  motion: '(prefers-reduced-motion: no-preference)',
  reduce: '(prefers-reduced-motion: reduce)',
}, (ctx) => {
  const { motion } = ctx.conditions;

  if (motion) {
    gsap.from('.hero-stat', {
      yPercent: 30, opacity: 0, duration: 1, stagger: 0.08, ease: 'expo.out',
      scrollTrigger: { trigger: '.hero', start: 'top 80%', once: true },
    });
  } else {
    gsap.set('.hero-stat', { yPercent: 0, opacity: 1 }); // jump straight to end-state, no tween
  }
});
```

### SplitText line-mask — animate for motion, plain + labelled for reduced

SplitText is free for client sites since GSAP 3.13. Two non-negotiables: (1) the container carries an `aria-label` with the original text so the split `<div>`s don't get read as fragments; (2) under reduced motion you do **not** run the reveal — but you still split-then-reset, or just leave the text untouched.

```html
<h2 class="split" aria-label="Wir bauen Häuser, die Generationen überdauern.">
  Wir bauen Häuser, die Generationen überdauern.
</h2>
```

```js
import { prefersReducedMotion } from './motion-guard.js';

if (!prefersReducedMotion) {
  SplitText.create('.split', {
    type: 'lines', mask: 'lines', autoSplit: true,
    onSplit(self) {
      return gsap.from(self.lines, {
        yPercent: 110, duration: 1.05, stagger: 0.1, ease: 'expo.out',
        scrollTrigger: { trigger: self.elements[0], start: 'top 88%', once: true },
      });
    },
  });
}
// Reduced motion: leave the heading as static text. aria-label is harmless either way.
```

Mark split children `aria-hidden="true"` only if the screen reader still doubles up — usually the container `aria-label` is enough.

### Canvas / WebGL ambient — stop the rAF loop, paint one static frame

The ambient is **never the star** (no plasma/neon/particles — subtle monochrome gradient-mesh, opacity .35–.55). Under reduced motion: render exactly one frame, never schedule another.

```js
import { prefersReducedMotion, onMotionPreferenceChange } from './motion-guard.js';

let rafId = null;
function frame(t) {
  drawNoiseMesh(t);            // simplex-noise gradient mesh, glacial speed
  rafId = requestAnimationFrame(frame);
}
function startAmbient() { if (rafId == null && !prefersReducedMotion) rafId = requestAnimationFrame(frame); }
function stopAmbient()  { if (rafId != null) { cancelAnimationFrame(rafId); rafId = null; } drawNoiseMesh(0); }

prefersReducedMotion ? drawNoiseMesh(0) : startAmbient();
onMotionPreferenceChange((reduce) => (reduce ? stopAmbient() : startAmbient()));
```

### Count-up — show the final number instantly, skip the easing

```js
import { prefersReducedMotion } from './motion-guard.js';

function countUp(el) {
  const target = +el.dataset.countTo;
  const decimals = +(el.dataset.decimals || 0);
  const fmt = new Intl.NumberFormat(el.dataset.locale || 'de-DE', {
    minimumFractionDigits: decimals, maximumFractionDigits: decimals,
  });
  const suffix = el.dataset.suffix || '';

  if (prefersReducedMotion) { el.textContent = fmt.format(target) + suffix; return; }

  const easeOutExpo = (t) => (t === 1 ? 1 : 1 - 2 ** (-10 * t));
  const dur = 1400; let start;
  function step(now) {
    start ??= now;
    const p = Math.min((now - start) / dur, 1);
    el.textContent = fmt.format(target * easeOutExpo(p)) + suffix;
    if (p < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

const io = new IntersectionObserver((entries) => {
  entries.forEach((e) => { if (e.isIntersecting) { countUp(e.target); io.unobserve(e.target); } });
}, { threshold: 0.4 });
document.querySelectorAll('[data-count-to]').forEach((el) => io.observe(el));
```

Add `font-variant-numeric: tabular-nums;` so digits don't jitter the layout (also a CLS win).

### Marquee — CSS-driven, dies under reduced motion, pauses on hover AND focus

SC 2.2.2 (Pause, Stop, Hide) applies to *any* auto-moving content that starts automatically and runs > 5 s. `focus-within` is the keyboard-equivalent of hover and is mandatory.

```css
.marquee__track { display: flex; gap: 4rem; width: max-content; animation: marquee 38s linear infinite; }
@keyframes marquee { to { transform: translate3d(-50%, 0, 0); } } /* JS-duplicated content, -50% loops seamlessly */

.marquee:hover .marquee__track,
.marquee:focus-within .marquee__track { animation-play-state: paused; }

@media (prefers-reduced-motion: reduce) {
  .marquee__track { animation: none; transform: none; } /* static, fully readable */
}
```

### Custom cursor — pointer-gated, never a focus substitute

The fancy cursor must be **off** on touch/keyboard and must never replace the real focus ring. Dot follows 1:1; ring lerps `0.18` inside the rAF (not in `pointermove`). Hard-gate with `@media (hover:hover) and (pointer:fine)` so it never even mounts on touch.

```js
const fineHover = matchMedia('(hover: hover) and (pointer: fine)');
if (fineHover.matches && !prefersReducedMotion) initCursor(); // else native cursor stays
```

Keep `cursor` set to a real value (don't `cursor:none` globally) unless the custom cursor is active and the OS pointer is fine — keyboard and reduced-motion users keep the OS cursor and visible focus.

### Magnetic CTA — decorative, must survive keyboard + reduced motion

Only the primary CTA, `strength` max `0.15`. The button must work and be focusable with **zero** magnetic translate applied — magnetism is pointer-only sugar on top of a real `<a>`/`<button>`.

```js
if (fineHover.matches && !prefersReducedMotion) initMagnetic(cta); // keyboard users get a plain, focusable button
```

### View Transitions — feature-detect, and they auto-respect reduced motion via CSS

Same-document VTs are Baseline since Oct 2025 (~88%). Feature-detect (else update instantly), give each active snapshot a **unique** `view-transition-name`, and disable the cross-fade animation under reduced motion.

```js
function swap(updateDOM) {
  if (!document.startViewTransition) { updateDOM(); return; }
  document.startViewTransition(updateDOM);
}
```

```css
@media (prefers-reduced-motion: reduce) {
  ::view-transition-group(*),
  ::view-transition-old(*),
  ::view-transition-new(*) { animation: none !important; }
}
```

---

## 3. Focus visibility (motion sites delete it — don't)

Custom-cursor sites love `outline:none`. That fails **SC 2.4.7 Focus Visible** and **SC 2.4.13 Focus Appearance** (WCAG 2.2). Use `:focus-visible` so mouse clicks stay clean but keyboard gets a strong, high-contrast ring.

```css
:focus-visible {
  outline: 2px solid var(--c-focus, #111);
  outline-offset: 3px;
  border-radius: 2px;
}
:focus:not(:focus-visible) { outline: none; }   /* mouse users: no ring */

/* On dark hero/footer the ring needs a light token + halo to stay 3:1 against both states */
.is-dark :focus-visible { outline-color: #fff; box-shadow: 0 0 0 4px rgba(0,0,0,.6); }
```

Never rely on `mix-blend-mode:difference` cursor inversion as the focus indicator — it does not move with `Tab`.

Skip-link (first focusable element, visible on focus):

```html
<a class="skip-link" href="#main">Zum Inhalt springen</a>
```
```css
.skip-link { position:absolute; left:1rem; top:-3rem; background:#111; color:#fff;
  padding:.6rem 1rem; border-radius:6px; z-index:1000; transition:top .15s; }
.skip-link:focus { top:1rem; }
@media (prefers-reduced-motion: reduce) { .skip-link { transition:none; } }
```

---

## 4. ARIA + keyboard for the components motion sites build

### Accordion / FAQ (keep it short — FAQ rich-results were retired May 7 2026, so it's UX/a11y only)

Native `<button>` toggling `aria-expanded`. The panel uses `hidden` (or `inert`) so collapsed content is out of the tab order and the screen-reader flow.

```html
<div class="faq">
  <h3>
    <button class="faq__q" aria-expanded="false" aria-controls="faq-p1" id="faq-b1">
      Wie lange dauert eine Kernsanierung?
    </button>
  </h3>
  <div class="faq__p" id="faq-p1" role="region" aria-labelledby="faq-b1" hidden>
    <p>In der Regel 4–6 Monate, abhängig vom Umfang.</p>
  </div>
</div>
```
```js
document.querySelectorAll('.faq__q').forEach((btn) => {
  btn.addEventListener('click', () => {
    const open = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', String(!open));
    document.getElementById(btn.getAttribute('aria-controls')).hidden = open;
  });
});
```
A real `<button>` gives Enter/Space + focus for free — don't reimplement them on a `<div>`. Animate the open/close height only when `!prefersReducedMotion`; collapsed state must always be `hidden`, never just `height:0` (that leaves it tabbable).

### Mobile nav / disclosure menu

```html
<button id="navToggle" aria-expanded="false" aria-controls="navPanel" aria-label="Menü öffnen">☰</button>
<nav id="navPanel" hidden> ... </nav>
```
```js
const t = document.getElementById('navToggle');
const panel = document.getElementById('navPanel');
function setNav(open) {
  t.setAttribute('aria-expanded', String(open));
  t.setAttribute('aria-label', open ? 'Menü schließen' : 'Menü öffnen');
  panel.hidden = !open;
  if (open) lenis?.stop(); else lenis?.start();           // scroll-lock that also pauses smooth scroll
  if (open) panel.querySelector('a,button')?.focus();      // move focus in
}
t.addEventListener('click', () => setNav(t.getAttribute('aria-expanded') !== 'true'));
document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && t.getAttribute('aria-expanded') === 'true') { setNav(false); t.focus(); } });
```
Trap focus inside the panel while open and return focus to the toggle on close (shown via `t.focus()`).

### Slider / carousel

- Wrap in `<section aria-roledescription="carousel" aria-label="Referenzen">`, each slide `role="group" aria-roledescription="Slide" aria-label="2 von 5"`.
- Real `<button>` prev/next with `aria-label`. Arrow-key support.
- Any autoplay needs a visible Pause control (SC 2.2.2) and must `paused` on `:hover`/`:focus-within`; under reduced motion autoplay is **off by default**.
- Off-screen slides: `inert` so they're not tabbable.

---

## 5. WP Classic / PHP integration (wp-classic-onepager)

Enqueue the guard first, in the footer, and pass server data via `wp_add_inline_script`. Keep GSAP/Lenis `defer`'d and out of the pre-LCP boot path.

```php
function theme_motion_scripts() {
  wp_enqueue_script('motion-guard', get_template_directory_uri().'/js/motion-guard.js', [], null, true);
  wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js', [], null, true);
  wp_enqueue_script('lenis', 'https://unpkg.com/lenis@1.3.23/dist/lenis.min.js', [], null, true);
  wp_enqueue_script('theme-motion', get_template_directory_uri().'/js/motion.js', ['gsap','lenis','motion-guard'], null, true);
}
add_action('wp_enqueue_scripts', 'theme_motion_scripts');
```
Add the CSS kill-switch (Layer A) to the main stylesheet, not inline, so it's cached.

---

## CDN versions (current, 2026)

```html
<!-- defer, footer, after LCP -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js"></script>
<script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css" />
<!-- ESM: import { createNoise2D } from 'https://cdn.jsdelivr.net/npm/simplex-noise@4.0.3/dist/esm/simplex-noise.js' -->
```

---

## Pitfalls

- **CSS kill-switch ≠ done.** The `*{animation-duration:.01ms}` block catches **zero** JS motion. Lenis, GSAP, canvas rAF, count-up, `scrollIntoView` keep running and will trigger vestibular reactions. Every JS module needs the `matchMedia` guard. This is *the* mistake.
- **Initing Lenis then "disabling" it.** Don't `new Lenis()` and hope. Under reduced motion, **never construct it** — native scroll + `scroll-behavior:auto` is the correct behavior.
- **`gsap.set()` to end-state forgotten.** If you only skip the tween, elements built with `from()` stay at `opacity:0` / off-screen → content invisible for reduced-motion users. Always jump to the visible end-state in the `reduce` branch.
- **SplitText with no `aria-label`.** Screen readers read each line `<div>` as a disconnected fragment ("Wir bauen", "Häuser die", …). Container `aria-label` = full original sentence, always.
- **`outline:none` for the custom cursor.** Deletes the keyboard focus indicator → fails SC 2.4.7/2.4.13. Use `:focus-visible` (mouse clean, keyboard ringed). The blend-mode cursor is not a focus indicator.
- **Marquee/autoplay without `focus-within`.** `:hover` pause alone excludes keyboard users; SC 2.2.2 needs pause reachable without a mouse. Add `:focus-within` and a real control.
- **Magnetic strength > 0.15 / cursor on touch.** Over-strength magnetism reads "besessen/Jahrmarkt"; an active custom cursor on touch is a dead, laggy artifact. Gate both with `(hover:hover) and (pointer:fine)` AND the reduced-motion guard.
- **Accordion panel `height:0` instead of `hidden`.** Collapsed content stays in the tab order and SR reading flow. Use `hidden`/`inert`; animate height only when motion is allowed.
- **One `view-transition-name` on many elements.** VT throws and silently no-ops. Name must be unique per active snapshot — set it only on the currently-animating card, clear it after.
- **Not listening for live preference changes.** Users flip the OS setting without reloading. The shared guard must `addEventListener('change', …)` and re-route every module.
- **Preloader/intro that never releases scroll.** If `lenis.stop()` runs without an `onComplete` `lenis.start()`, reduced-motion or JS-error users are scroll-locked forever. Always pair them, and skip the intro entirely under reduced motion + on repeat visits (sessionStorage).

## Quick audit checklist (ship gate)

1. OS reduced-motion ON → reload: no smooth scroll, no parallax, no count-up easing, canvas frozen, marquee static, intro skipped, all content visible. ✅
2. `Tab` through the whole page: visible focus ring everywhere, logical order, skip-link first, nothing focusable inside collapsed/off-screen regions. ✅
3. Mobile nav / accordion / slider: operable with Enter/Space/Arrows/Esc, `aria-expanded` flips, focus moves in and returns. ✅
4. Split headlines read as full sentences in a screen reader. ✅
5. Auto-moving content pauses on hover **and** focus and has a control. ✅
6. Toggle OS setting live (no reload): motion stops without errors. ✅

## Related skills

- **smooth-scroll-gsap-stack** — the Lenis 1.3 + GSAP 3.15 single-rAF wiring this skill guards (`autoRaf:false`, `lerp 0.09`, ticker bridge). Build it there, make it accessible here.
- **premium-microinteractions** — cursor, magnetic CTA, count-up, marquee implementations; this skill adds their reduced-motion + keyboard guards.
- **scroll-cinema-patterns** — sticky-stage cinema sections; wrap each scroll-driven reveal in the `gsap.matchMedia()` `reduce` branch.
- **web-performance-vitals** — the LCP/INP/CLS / fetchpriority / font-preload side; `tabular-nums` and `hidden` accordions help CLS, deferred GSAP keeps INP low.
- **wp-classic-onepager** — enqueue order, footer/defer, `wp_add_inline_script` data passing for the PHP integration above.
- **construction-website-builder** — the Meisterbetrieb context where "seriös, kein Wackeln, audited before ship" is the standard this skill enforces.
