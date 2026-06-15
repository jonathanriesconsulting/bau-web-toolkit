---
name: smooth-scroll-gsap-stack
description: "Wire Lenis smooth-scroll and GSAP ScrollTrigger into ONE rAF render loop the correct way — ticker-sync, lerp tuning, pin/scrub/reveal, anchor scrollTo, SplitText line-masks, reduced-motion bypass, and clean teardown. Use when the user asks to \"add smooth scrolling\", \"make scroll feel premium/heavy/buttery\", \"use Lenis with GSAP\", \"ScrollTrigger jitters / fires at wrong position\", \"pin a section\", \"scrub an animation on scroll\", \"smooth anchor links\", \"scroll-reveal text\", or asks why ScrollSmoother breaks sticky/fixed elements. Covers current CDN versions (GSAP 3.15.0, Lenis 1.3.23), the single-ticker pattern, and WCAG-compliant motion guarding. Massivbau statt Jahrmarkt — seriös, kein Bounce."
---

# Smooth-Scroll GSAP Stack (Lenis + ScrollTrigger, one rAF)

The single hardest thing to get right in a "premium feel" build is making smooth-scroll and scroll-driven animation share **one** render loop. Do it wrong and you get two competing rAF loops: ScrollTrigger reads stale scroll positions, pins drift, scrub lags a frame behind, and the page feels like wet sand. This skill gives you the one correct wiring and nothing else.

The discipline: **Lenis owns the scroll position, GSAP's ticker owns the clock, ScrollTrigger just reads.** Lenis is transform-free (it scrolls the real document), so `position: sticky` and `position: fixed` keep working. That is the whole reason we **don't** use GSAP's ScrollSmoother — see Pitfalls.

Target feel: heavy, controlled, expensive. `lerp: 0.09`. Not bouncy, not springy, no overshoot. Massivbau statt Jahrmarkt.

## When to use

- User wants "buttery / premium / heavy / weighty" scrolling on a marketing site, portfolio, or onepager.
- You need scroll-driven reveals, pinned sections, or scrubbed timelines that must stay frame-perfect.
- ScrollTrigger is firing at the wrong position, jittering, or lagging when smooth-scroll is on.
- You need smooth anchor-link navigation (`#kontakt`) that respects the smooth-scroll engine.
- Scroll-reveal headlines (SplitText line-mask).

## When NOT to use

- **Reduced-motion users / accessibility-first contexts** — you still load this, but the entire engine is bypassed (Lenis never starts, ScrollTrigger animations collapse to final state). See the guard below; it's not optional.
- **Content-heavy app UIs, dashboards, docs, anything with native-scroll expectations** (search-in-page, screen readers, scroll-anchoring, `Cmd+F` jump). Smooth-scroll hijacks the wheel; don't put it on a CMS admin or a long article a user needs to skim.
- **You only need a couple of CSS scroll-reveals.** Then use `@scroll-timeline` / IntersectionObserver and skip Lenis entirely. Don't pull in two libraries for one fade.
- **WordPress block/FSE editor screens** — never run Lenis inside `wp-admin`. Frontend only.

## CDN versions (current, verified)

```html
<!-- Lenis 1.3.23 — needs its stylesheet -->
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css">

<!-- Load in the footer, deferred — these must NOT sit in the boot path before LCP -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js" defer></script>
<!-- SplitText is LICENSE-FREE since GSAP 3.13 — safe on client sites -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js" defer></script>
<script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js" defer></script>

<script src="/assets/js/scroll.js" defer></script>
```

`lenis.css` is required: it sets `html.lenis, html.lenis body { height: auto }` and disables the native scroll-anchoring that would otherwise fight Lenis. Don't hand-roll it.

## The one wiring (scroll.js)

Order is load-bearing. GSAP + ScrollTrigger **first**, then Lenis with `autoRaf: false`, then hand Lenis the ticker. Never call `requestAnimationFrame(raf)` yourself — that's the second-loop bug.

```js
// /assets/js/scroll.js
(() => {
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // No GSAP? Bail without breaking the page.
  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);
  if (window.SplitText) gsap.registerPlugin(SplitText);

  // ---- Reduced-motion bypass --------------------------------------------
  // CSS kills CSS transitions/animations; JS motion (Lenis, scrub, canvas,
  // scrollIntoView) is a SEPARATE world and must be guarded here.
  // WCAG 2.2 SC 2.2.2 (pause/stop) + 2.3.3 (animation from interaction).
  if (reduce) {
    // Snap every ScrollTrigger animation to its END state, no scrubbing.
    ScrollTrigger.config({ ignoreMobileResize: true });
    initRevealsReducedMotion();   // see below
    initAnchorsNative();          // instant jump, no smooth interpolation
    return;                       // Lenis NEVER starts
  }

  // ---- Lenis + GSAP: ONE rAF --------------------------------------------
  const lenis = new Lenis({
    lerp: 0.09,            // heavy/controlled. 0.12+ starts to feel bouncy — don't.
    wheelMultiplier: 1,
    smoothWheel: true,
    autoRaf: false,        // CRITICAL: we drive raf from GSAP's ticker, not Lenis.
  });

  // Lenis tells ScrollTrigger the scroll moved -> ScrollTrigger re-reads.
  lenis.on('scroll', ScrollTrigger.update);

  // GSAP's ticker is the single clock. t is in seconds -> Lenis wants ms.
  gsap.ticker.add((t) => lenis.raf(t * 1000));

  // Stop GSAP from inserting fake "catch-up" frames after a tab-switch/jank,
  // which would teleport the scroll. With Lenis driving raf this MUST be off.
  gsap.ticker.lagSmoothing(0);

  // expose for anchors / preloader
  window.__lenis = lenis;

  initReveals();
  initPins();
  initScrub();
  initAnchors(lenis);

  // ---- Reveal: SplitText line-mask --------------------------------------
  function initReveals() {
    if (!window.SplitText) return;
    gsap.utils.toArray('[data-reveal-lines]').forEach((el) => {
      SplitText.create(el, {
        type: 'lines',
        mask: 'lines',          // each line gets an overflow:hidden wrapper
        autoSplit: true,        // re-split on font load / resize -> no CLS jank
        onSplit(self) {
          return gsap.from(self.lines, {
            yPercent: 110,
            duration: 1.05,
            stagger: 0.1,
            ease: 'expo.out',   // decelerate-in. No back/elastic — no bounce.
            scrollTrigger: { trigger: el, start: 'top 88%', once: true },
          });
        },
      });
    });
  }

  // ---- Reveal: simple fade-up (non-text blocks) -------------------------
  function genericRevealTween(el) {
    return gsap.from(el, {
      autoAlpha: 0, y: 32, duration: 0.9, ease: 'expo.out',
      scrollTrigger: { trigger: el, start: 'top 85%', once: true },
    });
  }

  // ---- Pin: one sticky stage --------------------------------------------
  function initPins() {
    gsap.utils.toArray('[data-pin]').forEach((stage) => {
      ScrollTrigger.create({
        trigger: stage,
        start: 'top top',
        end: () => '+=' + stage.offsetHeight,  // function -> recalcs on resize
        pin: true,
        pinSpacing: true,
        anticipatePin: 1,     // pre-pins one frame early -> no flash at high lerp
      });
    });
  }

  // ---- Scrub: timeline tied to scroll -----------------------------------
  function initScrub() {
    gsap.utils.toArray('[data-scrub]').forEach((sec) => {
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: sec,
          start: 'top bottom',
          end: 'bottom top',
          scrub: 1,           // 1s catch-up = smooth. `true` is too twitchy with Lenis.
        },
      });
      tl.to(sec.querySelector('[data-scrub-target]'), { yPercent: -15, ease: 'none' });
    });
  }

  // ---- Anchors: route clicks THROUGH Lenis ------------------------------
  function initAnchors(lenis) {
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((a) => {
      a.addEventListener('click', (e) => {
        const target = document.querySelector(a.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        lenis.scrollTo(target, { offset: -80, duration: 1.1 }); // -80 = sticky header
        history.pushState(null, '', a.getAttribute('href'));
      });
    });
  }

  // ---- Reduced-motion variants ------------------------------------------
  function initRevealsReducedMotion() {
    // No yPercent, no stagger, no scrub — content is simply THERE.
    gsap.utils.toArray('[data-reveal-lines], [data-reveal]').forEach((el) => {
      gsap.set(el, { autoAlpha: 1, clearProps: 'transform' });
    });
  }
  function initAnchorsNative() {
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((a) => {
      a.addEventListener('click', (e) => {
        const target = document.querySelector(a.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'auto' }); // instant — 'smooth' is motion too
      });
    });
  }
})();
```

`aria-label` discipline for SplitText: the split shreds the DOM text into per-line/per-char spans, which can confuse assistive tech. Put the original sentence on the container.

```html
<h2 data-reveal-lines aria-label="Wir bauen Häuser, die Generationen überdauern.">
  Wir bauen Häuser, die Generationen überdauern.
</h2>
```

## Preloader handoff (only if you have an intro)

If a first-visit preloader runs, **stop Lenis during the intro and start it on complete** — otherwise the user can wheel-scroll behind the overlay.

```js
// inside the non-reduced branch, before initReveals():
const isFirstVisit = !sessionStorage.getItem('seen');
if (isFirstVisit && document.querySelector('[data-preloader]')) {
  lenis.stop();
  runPreloader(() => {           // your reveal (clip-path / yPercent, not opacity fade)
    sessionStorage.setItem('seen', '1');
    lenis.start();
    ScrollTrigger.refresh();      // positions were measured while body was locked
  });
}
```

## Teardown (SPA route change / component unmount)

Smooth-scroll engines leak listeners and tickers across client-side navigations. Tear down in the exact reverse of setup.

```js
function destroyScroll() {
  ScrollTrigger.getAll().forEach((st) => st.kill());   // pins restore layout
  gsap.ticker.remove(window.__rafFn);                  // remove the ticker fn (keep a ref!)
  window.__lenis?.destroy();
  window.__lenis = null;
}
```

Keep a reference to the ticker callback so you can remove the *exact* function:

```js
const rafFn = (t) => lenis.raf(t * 1000);
gsap.ticker.add(rafFn);
window.__rafFn = rafFn;
```

## WordPress Classic enqueue (if this lands in a wp-classic-onepager)

```php
// functions.php — footer + defer, never before LCP, frontend only.
add_action('wp_enqueue_scripts', function () {
  if (is_admin()) return;
  wp_enqueue_style('lenis', 'https://unpkg.com/lenis@1.3.23/dist/lenis.css', [], '1.3.23');

  $args = ['strategy' => 'defer', 'in_footer' => true];
  wp_enqueue_script('gsap',          'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js', [], '3.15.0', $args);
  wp_enqueue_script('gsap-st',       'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js', ['gsap'], '3.15.0', $args);
  wp_enqueue_script('gsap-split',    'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js', ['gsap'], '3.15.0', $args);
  wp_enqueue_script('lenis',         'https://unpkg.com/lenis@1.3.23/dist/lenis.min.js', [], '1.3.23', $args);
  wp_enqueue_script('site-scroll',   get_template_directory_uri() . '/assets/js/scroll.js', ['gsap-st', 'lenis'], null, $args);
}, 20);
```

## Pitfalls

- **Two rAF loops (the #1 bug).** If you leave `autoRaf` at its default (true) *and* add the ticker callback, Lenis runs its own loop AND GSAP's — ScrollTrigger reads positions out of sync, scrub lags one frame, pins shimmer. Fix: `autoRaf: false` + `gsap.ticker.add(t => lenis.raf(t*1000))`. Exactly one loop.
- **Forgetting `lenis.on('scroll', ScrollTrigger.update)`.** Without it ScrollTrigger only updates on resize/refresh and reveal triggers fire at the wrong scroll position (often "everything at once" or "never").
- **Leaving `lagSmoothing` on.** After a tab-switch GSAP inserts catch-up frames; with Lenis driving raf that teleports the scroll. `gsap.ticker.lagSmoothing(0)`.
- **ScrollSmoother instead of Lenis.** ScrollSmoother wraps content in a `transform: translate` container. Any `position: sticky`/`fixed` child is now positioned relative to that transformed ancestor → sticky breaks, fixed headers detach, `100vh` math drifts. Lenis scrolls the real document (transform-free), so sticky/fixed stay intact. Use Lenis.
- **`scrub: true`.** Too twitchy under smooth-scroll — it tries to be exactly synchronous with a position that is itself being interpolated. Use `scrub: 1` (one second of catch-up) for a calm, expensive feel.
- **`lerp: 0.12`+.** Reads as bouncy/floaty, the opposite of a Meisterbetrieb. Stay at `0.08–0.10`; `0.09` is the house value.
- **Fixed numeric `end` on pins.** `end: '+=1200'` breaks on resize/font-load. Always use a function: `end: () => '+=' + el.offsetHeight`. Same for any start/end that depends on measured size.
- **Reduced-motion handled in CSS only.** The CSS kill-switch (`*{animation-duration:.01ms!important;...}`) cannot touch Lenis, canvas rAF, GSAP scrub, or `scrollIntoView({behavior:'smooth'})`. You MUST `matchMedia('(prefers-reduced-motion: reduce)')` and never start Lenis for those users. WCAG 2.2 SC 2.2.2 / 2.3.3.
- **Anchor links bypassing Lenis.** A raw `<a href="#x">` does a native jump that Lenis doesn't know about; you get a hard cut, then a fight as Lenis re-syncs. Route every in-page anchor through `lenis.scrollTo()`.
- **Loading GSAP/Lenis in the boot path before LCP.** They're render-blocking weight you don't need for first paint. Footer + `defer`. One `fetchpriority="high"` on the hero image, hero never `loading="lazy"`.
- **`ScrollTrigger.refresh()` not called after a layout-locking intro.** If the body was height-locked during a preloader, all trigger positions were measured wrong. Refresh on `lenis.start()`.
- **Running Lenis on touch by default.** Lenis smooths touch too; on mobile that often feels worse than native momentum. Consider `smoothTouch: false` (default) and test on a real device before shipping smooth touch.

## Related skills

- **premium-microinteractions** — custom cursor (dot 1:1 + ring lerp 0.18 in the rAF), magnetic CTA (strength ≤0.15), count-up. These hang off the *same* ticker; don't spin up a third rAF.
- **web-accessibility-motion** — the full reduced-motion contract, WCAG 2.2 SC 2.2.2/2.3.3, focus-visible, `aria-label` on split text.
- **web-performance-vitals** — LCP<2.5s / INP<200ms / CLS<0.1, `fetchpriority`, `<picture>` AVIF→WebP→JPG, font `size-adjust` fallbacks, where Lenis/GSAP sit in the load order.
- **scroll-cinema-patterns** — sticky-stage cinema (classic + mega-cinema). Pairs directly with the `data-pin` / `data-scrub` wiring here.
- **wp-classic-onepager** — where the PHP enqueue above belongs; Classic-PHP theme skeleton and section pattern.
- **construction-website-builder** — the house tonality (seriös, Meisterbetrieb, kein Jahrmarkt) these motion values are tuned to.
