---
name: modern-css-2026
description: "Build a 2026-modern, brutalist-editorial CSS foundation: OKLCH token system (monochrome L-ramp + one accent), bento grids via gap:1px line-optics, CSS Subgrid, container queries, fluid type with clamp/Utopia, and accessible CSS marquees/tickers (pause-on-hover, reduced-motion). Use when the user asks to \"modernize the CSS\", \"make it look like Linear/Vercel/editorial/brutalist\", set up a design-token system, build a bento grid, add a ticker/marquee, switch to OKLCH colors, set up fluid/responsive typography, or wants a 2026-current premium light-dominant aesthetic with hard edges and hairlines instead of shadows. Pairs with smooth-scroll-gsap-stack, premium-microinteractions, web-accessibility-motion and web-performance-vitals. Static-CSS-only — no JS-motion stack, no GSAP. Built from 21-agent 2026 web research."
---

# Modern CSS 2026 — OKLCH Tokens, Bento, Subgrid, Fluid Type, Marquees

The static-CSS foundation for a 2026-current site that reads **Massivbau, not Jahrmarkt**: a monochrome OKLCH lightness-ramp with a single accent, bento grids built from `gap:1px` line-optics (hairlines, not shadows), CSS Subgrid for aligned cards, container queries for component-local responsiveness, fluid type via `clamp()`/Utopia, and accessible CSS-only marquees/tickers.

This skill is **static CSS only**. It owns colour, type, layout and the one CSS-driven motion idiom (marquee). It deliberately does **not** own the JS-motion stack (Lenis/GSAP smooth scroll, custom cursor, magnetic CTA, preloader, count-up, WebGL ambient) — those live in `smooth-scroll-gsap-stack`, `premium-microinteractions` and `web-performance-vitals`. Build this layer first; layer motion on top.

**Discipline rule that governs everything here:** one signature move per section. Hairlines OR a marquee OR an asymmetric bento — never all three stacked in one viewport. Hard edges, mono-caps labels, index numbers. No bounce, no wobble, no italic.

## When to use

- "Modernise the CSS / make it 2026", "make it look like Linear / Vercel / Resend / an editorial magazine / brutalist".
- Set up a **design-token system** (OKLCH, dark-ready, single accent).
- Build a **bento grid** or asymmetric editorial layout with hairline separators.
- Add a **ticker / marquee / logo wall** that is accessible (pause-on-hover, reduced-motion safe).
- Switch existing colours **to OKLCH** for a perceptually-even neutral ramp.
- Set up **fluid / responsive typography** without a forest of breakpoints.
- Any "light-dominant, hard-edged, premium, hairlines-not-shadows" brief.

## When NOT to use

- The user wants **scroll-driven motion** (smooth scroll, pinned cinema) → `smooth-scroll-gsap-stack` + `scroll-cinema-patterns`.
- The user wants **cursor / magnetic / preloader / count-up micro-interactions** → `premium-microinteractions`.
- The user wants **a full construction-vertical site** (sections, schema, copy) → `construction-website-builder` first, then apply these tokens.
- The brief is **playful / colourful / consumer-toy**. This skill is monochrome-disciplined; forcing it on a candy brand fights the design.

---

## 1. OKLCH token system — monochrome L-ramp + one accent

The whole neutral palette is **one hue, one near-zero chroma, hierarchy only through Lightness**. OKLCH gives perceptually-even steps (unlike HSL/hex), and the accent is the *only* place chroma climbs. Light-dominant: the background is `L 0.985`, never a clinical `#fff`.

```css
:root {
  /* --- neutral axis: fixed hue, near-zero chroma (grey but not dead) --- */
  --neutral-h: 265;        /* one hue for the entire greyscale */
  --neutral-c: 0.006;      /* tiny chroma so greys aren't lifeless */

  /* Lightness ramp — the ONLY thing that changes across the neutral scale */
  --l-bg:        0.985;    /* page canvas — NOT pure white */
  --l-surface:   0.965;    /* lifted panels / cards */
  --l-line:      0.905;    /* hairlines */
  --l-line-2:    0.840;    /* stronger borders */
  --l-text-4:    0.640;    /* faint / placeholder */
  --l-text-3:    0.480;    /* tertiary */
  --l-text-2:    0.320;    /* secondary */
  --l-text:      0.180;    /* primary text — near-black, not #000 */

  --bg:        oklch(var(--l-bg)      var(--neutral-c) var(--neutral-h));
  --surface:   oklch(var(--l-surface) var(--neutral-c) var(--neutral-h));
  --line:      oklch(var(--l-line)    var(--neutral-c) var(--neutral-h));
  --line-2:    oklch(var(--l-line-2)  var(--neutral-c) var(--neutral-h));
  --text-4:    oklch(var(--l-text-4)  var(--neutral-c) var(--neutral-h));
  --text-3:    oklch(var(--l-text-3)  var(--neutral-c) var(--neutral-h));
  --text-2:    oklch(var(--l-text-2)  var(--neutral-c) var(--neutral-h));
  --text:      oklch(var(--l-text)    var(--neutral-c) var(--neutral-h));

  /* --- the ONE accent: the only place chroma climbs --- */
  --accent-h: 145;                                    /* swap hue per brand */
  --accent:        oklch(0.62 0.13 var(--accent-h));
  --accent-strong: oklch(0.52 0.15 var(--accent-h));  /* hover/active */
  --accent-tint:   oklch(0.62 0.13 var(--accent-h) / 0.10); /* low-alpha wash */
  --accent-on:     oklch(0.985 0.01 var(--accent-h)); /* text on accent fill */

  color-scheme: light dark;
}

/* Dark mode is a single L-flip — invert the ramp, keep hue + chroma + accent. */
@media (prefers-color-scheme: dark) {
  :root {
    --l-bg:      0.165;  --l-surface: 0.205;
    --l-line:    0.285;  --l-line-2:  0.360;
    --l-text-4:  0.480;  --l-text-3:  0.620;
    --l-text-2:  0.760;  --l-text:    0.920;
    --accent:        oklch(0.72 0.13 var(--accent-h));
    --accent-strong: oklch(0.80 0.14 var(--accent-h));
  }
}

body { background: var(--bg); color: var(--text); }
```

Why OKLCH: bump `--accent-h` and every accent state stays equally saturated and equally bright — no per-hue hand-tuning. The neutral ramp steps are visually even because L is linearised. To go fully monochrome (a PKB-style brief), set `--neutral-c: 0` and drop the accent entirely.

---

## 2. Fluid type — clamp() / Utopia, no breakpoint forest

One `clamp()` per step. Lock the type scale to the viewport between two anchor widths so headings never need media queries. Use a single fluid root and a modular scale on top.

```css
:root {
  /* Utopia-style fluid root: 16px @ 360px  →  19px @ 1440px viewport */
  --step-0: clamp(1rem, 0.93rem + 0.31vw, 1.1875rem);

  /* Modular scale (~1.25 major-third) built off the fluid root */
  --step--1: clamp(0.8rem,  0.76rem + 0.18vw, 0.95rem);
  --step-1:  clamp(1.25rem, 1.13rem + 0.53vw, 1.6rem);
  --step-2:  clamp(1.56rem, 1.34rem + 0.96vw, 2.25rem);
  --step-3:  clamp(1.95rem, 1.55rem + 1.74vw, 3.15rem);
  --step-4:  clamp(2.44rem, 1.74rem + 3.05vw, 4.4rem);
  --step-5:  clamp(3.05rem, 1.84rem + 5.30vw, 6.18rem);  /* hero display */

  --measure: 66ch;   /* max line length for body copy */
}

body  { font-size: var(--step-0); line-height: 1.55; }
h1    { font-size: var(--step-5); line-height: 0.96; letter-spacing: -0.02em; }
h2    { font-size: var(--step-3); line-height: 1.04; letter-spacing: -0.015em; }
h3    { font-size: var(--step-1); line-height: 1.15; }
p     { max-width: var(--measure); text-wrap: pretty; }
h1, h2, h3 { text-wrap: balance; }

/* Brutalist-editorial label: mono, caps, wide tracking — the recurring tag */
.eyebrow {
  font-family: var(--font-mono);
  font-size: var(--step--1);
  text-transform: uppercase;
  letter-spacing: 0.14em;
  color: var(--text-3);
}
/* Tabular index numbers: 01 / 02 / 03 next to section titles */
.index { font-variant-numeric: tabular-nums; color: var(--accent); }
```

**CLS guard — `size-adjust` fallback @font-face.** Match the fallback's metrics to the web font so the swap doesn't reflow. Combine with `<link rel="preload">` for the real font.

```css
@font-face {
  font-family: "Suisse Fallback";
  src: local("Arial");
  size-adjust: 105%;        /* tune until the swap is visually invisible */
  ascent-override: 92%;
  descent-override: 24%;
  line-gap-override: 0%;
}
:root {
  --font-sans: "Suisse Intl", "Suisse Fallback", system-ui, sans-serif;
  --font-mono: "Suisse Mono", ui-monospace, "SFMono-Regular", monospace;
}
```

```html
<!-- in <head>: preload the real font so it wins the swap before LCP -->
<link rel="preload" href="/fonts/suisse-intl.woff2" as="font" type="font/woff2" crossorigin>
```

---

## 3. Bento grid — `gap:1px` line-optics, asymmetric, hairlines not shadows

The signature 2026 idiom: a grid whose **gap is the background-line colour**, so cells appear separated by 1px hairlines with zero box-shadows. Asymmetric 12-column spans, hard corners.

```css
.bento {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 1px;                       /* the gap IS the line */
  background: var(--line);        /* shows through the gaps */
  border: 1px solid var(--line);  /* close the outer frame */
}
.bento > * {
  background: var(--bg);          /* each cell repaints over the line bg */
  padding: clamp(1.25rem, 3vw, 2.5rem);
  /* hard edges — no border-radius, no box-shadow */
}
/* Asymmetric spans — break the symmetric grid on purpose */
.b-wide  { grid-column: span 7; }
.b-tall  { grid-column: span 5; grid-row: span 2; }
.b-third { grid-column: span 4; }
.b-half  { grid-column: span 6; }

@media (max-width: 760px) {
  .bento { grid-template-columns: 1fr; }
  .bento > * { grid-column: 1 / -1 !important; grid-row: auto !important; }
}
```

The `background:var(--line)` + `gap:1px` + opaque cells trick gives crisp hairlines that survive sub-pixel scaling far better than `border` on every child (no double-border seams). Hover state stays disciplined: shift the **cell background by one L-step**, not a shadow.

```css
.bento > a:hover { background: var(--surface); transition: background 0.18s ease; }
```

---

## 4. CSS Subgrid — align card internals across the grid

Without subgrid, each bento card's eyebrow / title / body / footer land at different heights. Subgrid lets children inherit the parent's row tracks so every card's baseline aligns.

```css
.bento { grid-auto-rows: min-content; }

.card {
  display: grid;
  grid-template-rows: subgrid;     /* inherit parent rows */
  grid-row: span 4;                /* eyebrow / title / body / footer */
  gap: 0.75rem;
}
.card .eyebrow { grid-row: 1; }
.card h3       { grid-row: 2; }
.card p        { grid-row: 3; }
.card .meta    { grid-row: 4; align-self: end; }
```

Now the footer `.meta` of every card sits on the same line regardless of body length — the editorial-grid feel. Subgrid is Baseline-wide in 2026; for ancient engines the cards simply fall back to their own intrinsic rows (graceful, no breakage).

---

## 5. Container queries — component-local responsiveness

Components respond to **their own container width**, not the viewport — so the same card behaves correctly in a wide hero and a narrow sidebar.

```css
.bento > * { container-type: inline-size; }

/* When THIS cell is wide enough, switch to a side-by-side layout */
@container (min-width: 30rem) {
  .feature { display: grid; grid-template-columns: 1fr auto; align-items: center; }
  .feature h3 { font-size: var(--step-2); }
}
@container (max-width: 20rem) {
  .feature .eyebrow { display: none; }   /* drop chrome when cramped */
}
```

Pair with **container query units** (`cqi`) for type that scales to the container, not the page:

```css
.stat-value { font-size: clamp(2rem, 14cqi, 5rem); font-variant-numeric: tabular-nums; }
```

---

## 6. CSS marquee / ticker — accessible, pause-on-hover, reduced-motion safe

Pure-CSS infinite ticker for a logo wall or running headline. The trick: **duplicate the track in markup** so the loop is seamless, translate `-50%` (one copy width), and gate on `prefers-reduced-motion`.

```html
<div class="marquee" aria-label="Trusted by 40+ Bauträger in Berlin und Brandenburg">
  <div class="marquee__track" aria-hidden="true">
    <!-- group A -->
    <span class="marquee__item">Roth Massivhaus</span>
    <span class="marquee__item">EWA Hausbau</span>
    <span class="marquee__item">Modus Projects</span>
    <!-- group A duplicated verbatim for the seamless wrap -->
    <span class="marquee__item">Roth Massivhaus</span>
    <span class="marquee__item">EWA Hausbau</span>
    <span class="marquee__item">Modus Projects</span>
  </div>
</div>
```

```css
.marquee {
  overflow: hidden;
  border-block: 1px solid var(--line);
  /* edge fade so items dissolve at the rim instead of clipping hard */
  -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
          mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
}
.marquee__track {
  display: flex;
  gap: 4rem;
  width: max-content;
  will-change: transform;
  animation: marquee 32s linear infinite;   /* glacial, not frantic */
}
.marquee__item {
  font-family: var(--font-mono);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-3);
  white-space: nowrap;
}
@keyframes marquee {
  from { transform: translate3d(0, 0, 0); }
  to   { transform: translate3d(-50%, 0, 0); }  /* exactly one duplicated copy */
}

/* Pause on hover AND keyboard focus (a11y — keyboard users must be able to stop) */
.marquee:hover  .marquee__track,
.marquee:focus-within .marquee__track { animation-play-state: paused; }

/* WCAG 2.2.2: motion must be stoppable — kill it entirely for reduced-motion */
@media (prefers-reduced-motion: reduce) {
  .marquee__track { animation: none; transform: none; }
  .marquee { overflow-x: auto; }   /* let users scroll the list manually instead */
}
```

The `aria-label` on the wrapper carries the real meaning; the visible (duplicated) items are `aria-hidden` so screen readers don't read the list twice.

---

## 7. The reduced-motion baseline (CSS half)

A global CSS kill-switch for **declarative** animation. Ship it on every project.

```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

**Critical scope warning:** this CSS block only neutralises **CSS** animations/transitions. It does **NOT** stop JS-driven motion — Lenis smooth scroll, canvas `requestAnimationFrame` loops, GSAP timelines, `scrollIntoView({behavior:'smooth'})`. Each of those must be guarded **separately** in JS with `matchMedia('(prefers-reduced-motion: reduce)')`. That JS guard is owned by `web-accessibility-motion` / `smooth-scroll-gsap-stack` — this skill only ships the CSS half. WCAG 2.2 SC 2.2.2 (pause/stop/hide) and 2.3.3 (animation from interactions) require both halves.

---

## Pitfalls

- **Pure `#fff` / `#000` reads cheap.** Light-dominant 2026 = `--l-bg: 0.985` and `--l-text: 0.18`. Pure white is clinical; pure black crushes. Always step in from the extremes.
- **`--neutral-c: 0` makes dead greys.** A tiny chroma (`~0.006`) on one fixed hue keeps the greyscale alive without reading as "tinted". Only drop to `0` for an intentionally cold monochrome brief (e.g. PKB).
- **`border` on every bento child causes double-border seams + sub-pixel shimmer.** Use the `gap:1px` + `background:var(--line)` + opaque-cell trick instead. One outer frame border, gaps do the rest.
- **Box-shadows betray the brutalist-editorial language.** Express elevation and hover by stepping the cell's L value, never with a shadow. Hard corners — no `border-radius` on bento cells.
- **Marquee without a duplicated track jumps at the loop seam.** You must duplicate group A verbatim and translate exactly `-50%`. Translating `-100%` (full track) leaves a visible gap.
- **Marquee that can't be paused fails WCAG 2.2.2.** Always add `:hover` *and* `:focus-within` pause plus the reduced-motion `animation:none` fallback — and make the list manually scrollable when motion is off.
- **Reduced-motion CSS block is not a JS kill-switch.** It silences CSS only. Guard every JS-motion source separately via `matchMedia`. This is the single most common a11y miss.
- **Subgrid `grid-row: span N` must match the parent's declared row count**, or children collapse onto fewer tracks. Count your rows (eyebrow/title/body/meta = 4) and keep them in sync.
- **Container queries need `container-type: inline-size` on the parent**, and that creates a new containment context — a child with `position: fixed` will resolve against the container, not the viewport. Don't put fixed overlays inside a query container.
- **Fluid `clamp()` with too-aggressive `vw` slope can shrink text below readability on small screens or balloon it on ultrawide.** Keep the min and max anchors sane (e.g. hero `3.05rem → 6.18rem`), test at 320px and 1920px.
- **Font swap without `size-adjust` fallback = CLS hit.** Tune the fallback `@font-face` metrics until the swap is invisible, and preload the real woff2. (LCP/CLS budgets are owned by `web-performance-vitals`, but this is where the CSS half lives.)
- **Don't stack signature moves.** One per section: a marquee band, then a hairline bento, then a quiet editorial text block — never marquee + asymmetric bento + heavy hover all in one viewport. Massivbau, not Jahrmarkt.

---

## Related skills

- **smooth-scroll-gsap-stack** — Lenis 1.3.23 + GSAP 3.15.0 single-rAF smooth scroll, SplitText line-masks, the JS-motion `matchMedia` guards. Layer on top of these tokens; do not duplicate the colour/type system there.
- **premium-microinteractions** — custom cursor (dot 1:1 + lerp ring), magnetic CTA (strength ≤0.15), preloader, count-up. Consumes these OKLCH tokens for its styling.
- **web-accessibility-motion** — owns the JS half of the reduced-motion contract (matchMedia guards for Lenis/canvas/GSAP), WCAG 2.2 SC 2.2.2 / 2.3.3, focus management.
- **web-performance-vitals** — single `fetchpriority="high"` hero, AVIF→WebP→JPG `<picture>` + srcset, font preload, GSAP/Lenis deferred below LCP, INP<200ms / LCP<2.5s / CLS<0.1 budgets.
- **wp-classic-onepager** — when this token system needs to live in a WordPress Classic PHP theme (enqueue order, no-Inter font enqueue, schema emission).
- **construction-website-builder** — the construction vertical (sections, trust signals, B2B/B2C split). Apply these tokens as its visual skin; use the `multi-variant-theme-tokens` override-block pattern when the client wants several palettes side by side.
- **multi-variant-theme-tokens** — extends this when you need 3+ comparable palettes from one markup; this skill defines the OKLCH base, that one defines the flip/override architecture.
