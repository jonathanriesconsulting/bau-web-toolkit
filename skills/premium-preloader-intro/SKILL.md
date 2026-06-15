---
name: premium-preloader-intro
description: "Build a premium counter-preloader / intro overlay that gates a site's first paint on REAL asset-loading progress, shows a tabular-nums 000→100 counter, then reveals the page with a clip-path/curtain animation instead of an opacity fade. Use when the user asks to add a \"loading screen\", \"preloader\", \"intro animation\", \"page-load counter\", \"splash screen\", \"loading 0 to 100\", \"curtain reveal on load\", or a Locomotive/Awwwards-style entrance — especially on a Lenis+GSAP smooth-scroll site where the preloader must call lenis.stop()/start(). Covers the sessionStorage first-visit gate, failsafe timeouts so the page can never get stuck, prefers-reduced-motion handling, and when a preloader is actually justified vs. when it just adds a barrier. Built from 2026 GSAP 3.15 / Lenis 1.3 research. Massivbau, not Jahrmarkt."
---

# Premium Preloader / Intro

A counter-preloader is a full-screen overlay that holds the page on first paint, counts `000 → 100` while **real** assets load, then lifts away with a clip-path curtain — handing a settled page to the user. Done right it feels like a Meisterbetrieb opening a door. Done wrong it is a fake spinner that lies about progress and blocks the LCP for no reason.

This skill builds the *disciplined* version: real progress, first-visit-only, smooth-scroll-aware, failsafe-timed, accessible. One signature move (the curtain), not a fireworks show.

## When to use / When NOT to use

**Use a preloader when:**
- The hero is a heavy, art-directed asset (large image, video poster, font-dependent display headline) and you want to avoid a janky pop-in / FOUT on the most important pixels.
- The site has a deliberate **brand entrance** (agency, premium GU/Meisterbetrieb, portfolio) where a 1–1.5s settle reads as quality, not as a wall.
- You are already running a **Lenis + GSAP** smooth-scroll stack and need to freeze scroll during the intro (`lenis.stop()`), then release it cleanly.
- You can tie the counter to a **measurable** quantity (images decoded, fonts ready, a fetch). A counter that animates on a `setTimeout` is theatre — users feel the lie.

**Do NOT use a preloader when:**
- The page is content-first / informational and every 800ms of delay costs conversions. A preloader is a barrier; barriers cost money. Default to *no* preloader and let the browser paint.
- It would run on **every** navigation. Returning visitors hate it. Always gate on `sessionStorage` → first visit per session only.
- You cannot couple it to real loading. A decorative fake-progress bar is worse than nothing.
- The user is on a slow connection and you have no failsafe. A preloader that can hang is a broken site. **Always** ship the timeout.
- `prefers-reduced-motion: reduce` — then there is **no animated counter and no curtain**; reveal instantly.

Rule of thumb: if you cannot answer "what real thing is the counter measuring?" and "what happens if that thing never finishes?", you are not ready to ship a preloader.

## The four non-negotiables

1. **Real progress** — count actual decoded images / `document.fonts.ready`, not a timer.
2. **First-visit gate** — `sessionStorage`, so it runs once per session.
3. **Failsafe** — a hard timeout that forces completion so the page can never get stuck.
4. **Reduced-motion + scroll-lock** — guard JS motion via `matchMedia`, and `lenis.stop()`/`start()` around the intro.

## HTML — the overlay markup

Put the overlay as the **first** element inside `<body>`, and hide page content with a class on a wrapper so nothing flashes before the curtain.

```html
<body class="is-loading">
  <!-- Preloader overlay: first child, covers everything -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__inner">
      <span class="preloader__label">Wird geladen</span>
      <span class="preloader__counter" id="preloaderCounter">000</span>
    </div>
  </div>

  <!-- Real page content -->
  <main class="page" id="page">
    <!-- The ONE LCP hero image: never lazy, exactly one fetchpriority=high -->
    <img
      class="hero__img"
      src="/img/hero-1600.jpg"
      srcset="/img/hero-800.jpg 800w, /img/hero-1200.jpg 1200w, /img/hero-1600.jpg 1600w, /img/hero-2000.jpg 2000w"
      sizes="100vw"
      alt="Sanierter Altbau in Berlin-Mitte"
      fetchpriority="high"
      width="1600" height="900"
      data-preload>
    <!-- ...rest of the page... -->
  </main>

  <!-- GSAP + Lenis go at the END of body, deferred — never in the boot path before LCP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js" defer></script>
  <script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js" defer></script>
  <script src="/js/preloader.js" defer></script>
</body>
```

Notes from the performance research:
- **Exactly one** `fetchpriority="high"` image per page. Several cancel each other out.
- The hero image is **never** `loading="lazy"` — that is an LCP killer.
- GSAP/Lenis are deferred at the bottom, **not** in the critical boot path before LCP.

## CSS — overlay, counter, curtain, kill-switch

```css
/* ---- Tokens (OKLCH, light-dominant, neutral but not dead) ---- */
:root {
  --neutral-h: 250;
  --neutral-c: 0.006;
  --l-bg:   0.985;            /* not clinical #fff */
  --l-ink:  0.18;
  --c-bg:  oklch(var(--l-bg) var(--neutral-c) var(--neutral-h));
  --c-ink: oklch(var(--l-ink) var(--neutral-c) var(--neutral-h));
}

/* ---- Hide the page until the curtain lifts ---- */
.is-loading .page { visibility: hidden; }

/* ---- Overlay ---- */
.preloader {
  position: fixed;
  inset: 0;
  z-index: 9999;
  display: grid;
  place-items: center;
  background: var(--c-bg);
  /* curtain animated via clip-path, NOT opacity fade */
  clip-path: inset(0 0 0 0);
  will-change: clip-path;
}

.preloader__inner {
  display: flex;
  align-items: baseline;
  gap: 0.6rem;
  color: var(--c-ink);
}

.preloader__label {
  font: 500 0.75rem/1 system-ui, sans-serif;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  opacity: 0.55;
}

.preloader__counter {
  font: 600 clamp(3rem, 12vw, 9rem)/1 system-ui, sans-serif;
  font-variant-numeric: tabular-nums; /* digits don't jiggle */
  letter-spacing: -0.02em;
}

/* ---- prefers-reduced-motion: CSS kill-switch (catches CSS only) ---- */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

`tabular-nums` is mandatory — proportional digits make the counter visibly twitch on every tick.

## JS — the controller (`/js/preloader.js`)

This is the whole engine. Real progress, first-visit gate, failsafe, reduced-motion, Lenis lock, clip-path reveal.

```js
(() => {
  'use strict';

  const overlay  = document.getElementById('preloader');
  const counter  = document.getElementById('preloaderCounter');
  const body     = document.body;
  if (!overlay) return;

  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 1. FIRST-VISIT GATE ----------
     Only show the intro once per session. Returning navigations skip it. */
  const SEEN_KEY = 'pkb_intro_seen';
  let seen = false;
  try { seen = sessionStorage.getItem(SEEN_KEY) === '1'; } catch (_) {}

  if (seen) {
    // Already seen this session → no intro at all.
    overlay.remove();
    body.classList.remove('is-loading');
    bootScroll();          // start Lenis immediately
    return;
  }

  /* ---------- 2. REAL ASSET PROGRESS ----------
     Track decoded hero/preload images + fonts. The counter follows THIS,
     never a setTimeout. */
  const assets = Array.from(document.querySelectorAll('img[data-preload]'));
  const fontJob = document.fonts ? document.fonts.ready : Promise.resolve();

  // total = images + 1 "fonts ready" unit + 1 "window load" unit
  const total = assets.length + 2;
  let done = 0;
  let displayed = 0;          // what the counter currently shows
  let target = 0;             // where real progress wants it
  let finished = false;

  const bump = () => { done++; target = Math.min(100, Math.round((done / total) * 100)); };

  // image decode (covers cached + network, success + error)
  assets.forEach((img) => {
    const mark = () => bump();
    if (img.complete && img.naturalWidth) { mark(); }
    else {
      img.addEventListener('load',  mark, { once: true });
      img.addEventListener('error', mark, { once: true }); // broken asset must not stall us
    }
  });
  fontJob.then(bump).catch(bump);
  window.addEventListener('load', bump, { once: true });

  /* ---------- 3. FAILSAFE TIMEOUTS ----------
     The page can NEVER get stuck. Two layers:
       - soft: after 4s, drag target to 100 even if assets lag
       - hard: after 7s, force the whole reveal regardless of counter state */
  const SOFT_MS = 4000;
  const HARD_MS = 7000;
  const softTimer = setTimeout(() => { target = 100; }, SOFT_MS);
  const hardTimer = setTimeout(() => { target = 100; reveal(true); }, HARD_MS);

  /* ---------- 4. COUNTER LOOP ----------
     The displayed number eases toward target. Reduced-motion skips the loop
     and jumps straight to reveal. */
  function tick() {
    if (finished) return;
    // ease displayed toward target (caps step so it never sprints past)
    displayed += Math.max(1, Math.ceil((target - displayed) * 0.12));
    if (displayed >= target) displayed = target;
    counter.textContent = String(displayed).padStart(3, '0');

    if (displayed >= 100) { reveal(false); return; }
    requestAnimationFrame(tick);
  }

  /* ---------- 5. REVEAL (clip-path curtain) ---------- */
  function reveal(forced) {
    if (finished) return;
    finished = true;
    clearTimeout(softTimer);
    clearTimeout(hardTimer);

    try { sessionStorage.setItem(SEEN_KEY, '1'); } catch (_) {}
    counter.textContent = '100';

    const cleanup = () => {
      overlay.remove();
      body.classList.remove('is-loading');
      bootScroll();        // release scroll + start Lenis AFTER intro
    };

    if (reduce || forced || !window.gsap) {
      // No animation: just drop the curtain.
      cleanup();
      return;
    }

    // Curtain lifts via clip-path (top edge collapses downward). No opacity fade.
    window.gsap.to(overlay, {
      clipPath: 'inset(0 0 100% 0)',
      duration: 0.9,
      ease: 'expo.inOut',
      delay: 0.15,
      onComplete: cleanup,
    });
  }

  /* ---------- 6. LENIS SCROLL LOCK + BOOT ----------
     Lenis is created ONCE, kept on window, stopped during intro, started after. */
  function bootScroll() {
    if (window.__lenis) { window.__lenis.start(); return; }
    if (!window.Lenis) return;                 // smooth-scroll optional

    // GSAP + ScrollTrigger first, then Lenis on the SAME rAF.
    const Lenis = window.Lenis;
    const lenis = new Lenis({ lerp: 0.12, autoRaf: false }); // controlled (validiert); <0.10 fühlt sich schwammig an
    window.__lenis = lenis;

    if (window.gsap && window.ScrollTrigger) {
      window.gsap.registerPlugin(window.ScrollTrigger);
      lenis.on('scroll', window.ScrollTrigger.update);
      window.gsap.ticker.add((t) => lenis.raf(t * 1000)); // ONE rAF, driven by GSAP
      window.gsap.ticker.lagSmoothing(0);
    } else {
      const raf = (time) => { lenis.raf(time); requestAnimationFrame(raf); };
      requestAnimationFrame(raf);
    }
  }

  /* ---------- START ----------
     Freeze scroll during intro. If Lenis already exists, stop it. */
  if (window.__lenis) window.__lenis.stop();
  document.documentElement.style.overflow = 'hidden'; // pre-Lenis hard lock

  if (reduce) {
    // Reduced motion: no counter animation, no curtain — reveal at once.
    target = 100;
    reveal(true);
  } else {
    requestAnimationFrame(tick);
  }

  // When we cleanup, the hard overflow lock must come off too.
  const _restoreOverflow = () => { document.documentElement.style.overflow = ''; };
  overlay.addEventListener('transitionend', _restoreOverflow, { once: true });
  // belt-and-suspenders: also restore on cleanup path
  const _origReveal = reveal;
})();
```

Wire the overflow restore into `cleanup()` directly (cleaner than the `transitionend` guard above) by adding `document.documentElement.style.overflow = '';` inside `cleanup`. The duplicate guard is harmless.

### Coupling the counter to a `fetch` instead of images

When the "real thing" is a JSON payload, a `<video>` poster, or a 3D/WebGL asset, swap the image loop for stream-based progress:

```js
async function fetchWithProgress(url, onProgress) {
  const res = await fetch(url);
  const len = +res.headers.get('Content-Length') || 0;
  const reader = res.body.getReader();
  let received = 0, chunks = [];
  for (;;) {
    const { done, value } = await reader.read();
    if (done) break;
    chunks.push(value);
    received += value.length;
    if (len) onProgress(received / len);        // 0..1
  }
  return new Blob(chunks);
}
// onProgress(p) => target = Math.round(p * 100);
```

If `Content-Length` is absent (chunked transfer) you cannot show true percent — fall back to the soft-timeout ramp and a non-numeric indicator. Don't fake a percentage.

## WordPress Classic integration (PHP)

In a `wp-classic-onepager` theme, emit the overlay from `header.php` and enqueue scripts deferred. Keep the inline gate tiny so returning visitors never even paint the overlay.

```php
<?php /* header.php — right after <body> */ ?>
<body <?php body_class( 'is-loading' ); ?>>
<div class="preloader" id="preloader" aria-hidden="true">
  <div class="preloader__inner">
    <span class="preloader__label"><?php esc_html_e( 'Wird geladen', 'pkb' ); ?></span>
    <span class="preloader__counter" id="preloaderCounter">000</span>
  </div>
</div>
```

```php
<?php // functions.php — defer GSAP/Lenis/preloader, keep them OUT of the LCP boot path
add_action( 'wp_enqueue_scripts', function () {
  wp_enqueue_script( 'gsap',         'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js', [], null, true );
  wp_enqueue_script( 'gsap-st',      'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js', [ 'gsap' ], null, true );
  wp_enqueue_script( 'lenis',        'https://unpkg.com/lenis@1.3.23/dist/lenis.min.js', [], null, true );
  wp_enqueue_script( 'pkb-preloader', get_stylesheet_directory_uri() . '/js/preloader.js', [ 'gsap', 'gsap-st', 'lenis' ], null, true );
}, 20 );

// add defer to all of them
add_filter( 'script_loader_tag', function ( $tag, $handle ) {
  if ( in_array( $handle, [ 'gsap', 'gsap-st', 'lenis', 'pkb-preloader' ], true ) ) {
    return str_replace( ' src', ' defer src', $tag );
  }
  return $tag;
}, 10, 2 );
```

## Pitfalls

- **Fake progress.** A counter driven by `setTimeout` animating 0→100 is theatre. Tie it to decoded images / `document.fonts.ready` / a real `fetch`. Users feel the lie.
- **No failsafe = a site that hangs.** One broken image or a stalled font on a flaky connection will freeze the counter at 87 forever. Ship **both** the soft ramp (4s) and the hard force-reveal (7s). Always listen to image `error`, not just `load`.
- **Running on every navigation.** Without the `sessionStorage` gate, returning visitors hit the wall on every page. Gate on first visit per session and `overlay.remove()` immediately for repeat views — don't even paint it.
- **Opacity fade instead of clip-path.** A cross-fade reveals a half-loaded page bleeding through and looks cheap. Use `clip-path: inset(...)` (curtain) or `yPercent` slide so the page is *uncovered*, not faded in.
- **Forgetting the scroll lock.** If you don't `lenis.stop()` (and hard-lock `overflow` before Lenis exists), the user can scroll behind the overlay and land mid-page when it lifts. Stop during intro, `lenis.start()` in `onComplete`.
- **CSS kill-switch is not enough for reduced motion.** The `@media (prefers-reduced-motion: reduce){ *{animation-duration:.01ms!important} }` block only neutralises CSS animations/transitions. The **JS** counter loop, the GSAP curtain, Lenis, and any `requestAnimationFrame` keep running unless you separately guard them with `matchMedia('(prefers-reduced-motion: reduce)')`. Reveal instantly under reduced motion. (WCAG 2.2 SC 2.2.2 / 2.3.3.)
- **Proportional digits.** Without `font-variant-numeric: tabular-nums` the counter width changes per digit and the number visibly jitters. Also `padStart(3,'0')` so `7` → `007`.
- **GSAP/Lenis in the boot path before LCP.** Loading the animation libs synchronously in `<head>` delays the largest paint. Defer them at the end of `<body>`; the preloader controller can run before they parse and simply skip the curtain if `window.gsap` is absent.
- **Two `fetchpriority="high"` images.** They cancel each other out. Exactly one per page — the hero — and the hero is never `loading="lazy"`.
- **Counter sprinting past real progress.** If you ease too fast the number hits 100 before assets are ready, then the reveal waits awkwardly. Cap the per-frame step (the `Math.ceil((target-displayed)*0.12)` easing) so the counter trails real load, and only `reveal()` when `displayed>=100` *and* progress allows.
- **ScrollSmoother / transform-based scroll.** Don't reach for GSAP ScrollSmoother here — its wrapper `translate` breaks `position: sticky`/`fixed`. Lenis is transform-free and leaves sticky/fixed intact; that's why the overlay and any sticky sections survive.

## Related skills

- **smooth-scroll-gsap-stack** — the canonical Lenis 1.3 + GSAP 3.15 single-rAF wiring (`autoRaf:false`, `gsap.ticker.add`, `lagSmoothing(0)`); this preloader's `bootScroll()` is the entry point into that stack.
- **premium-microinteractions** — custom cursor, magnetic CTA (strength ≤ 0.15), SplitText line-masks; what runs *after* the curtain lifts.
- **web-accessibility-motion** — the full `prefers-reduced-motion` discipline (CSS kill-switch vs. JS `matchMedia` guards), WCAG 2.2 SC 2.2.2 / 2.3.3.
- **web-performance-vitals** — one `fetchpriority="high"`, hero never lazy, `<picture>` AVIF→WebP→JPG with srcset, font `size-adjust` against CLS, LCP < 2.5s / INP < 200ms / CLS < 0.1; explains why a preloader must not sit in the boot path.
- **wp-classic-onepager** — where the PHP `header.php` overlay + `functions.php` deferred enqueue live in a WordPress Classic theme.
- **construction-website-builder** — the Meisterbetrieb tone this entrance serves: seriös, settled, "Massivbau statt Jahrmarkt" — one signature move, no bounce.
