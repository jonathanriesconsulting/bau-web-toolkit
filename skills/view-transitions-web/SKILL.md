---
name: view-transitions-web
description: "Implement the native View Transitions API (2026) for seamless state-swaps and page-to-page morphs in vanilla web projects — same-document (SPA-style DOM swaps wrapped in document.startViewTransition) and cross-document MPA (@view-transition CSS rule for real multi-page navigations). Covers feature-detection / progressive enhancement, unique view-transition-name assignment (only the active card), the ::view-transition-* pseudo-element tree, morphing a thumbnail into a hero, list filter/reorder crossfades, prefers-reduced-motion guarding, and a WordPress Classic PHP MPA wiring. Use when the user asks to \"animate between pages\", add \"seamless transitions\", \"morph a card into detail view\", \"crossfade a filtered grid/gallery\", do \"shared-element transitions\", smooth tab/state swaps, or wants Astro/SPA-style page transitions on a plain HTML or WordPress site without React/a router framework. Massivbau, not Jahrmarkt — one transition per interaction, seriös."
---

# View Transitions Web (2026)

The browser-native way to animate between two DOM states — a filtered grid, a card morphing into a detail view, or a full page-to-page navigation — without React, a router, or a JS animation library. You change the DOM (or navigate); the browser snapshots before + after and tweens between them.

Two modes, one mental model:

- **Same-document** (SPA-style): wrap your DOM mutation in `document.startViewTransition(() => updateDOM())`. Baseline since Oct 2025 (~88% of users). This is the workhorse.
- **Cross-document** (MPA): add the `@view-transition { navigation: auto; }` CSS rule on *both* pages. Real `<a href>` navigations between same-origin pages now morph. No JS at all. Newer, narrower support — pure progressive enhancement.

The signature move: give the same logical element the **same** `view-transition-name` on the old and new state, and the browser morphs position/size/shape between them. Everything else crossfades by default.

Discipline: **one transition per interaction.** A card-to-hero morph OR a grid crossfade — not both stacked. This is a Meisterbetrieb finish, not a slideshow of effects. Default durations are ~250ms for a reason; resist the urge to make it "more".

## When to use

- "Animate between pages" / "Astro-style page transitions" on a plain HTML or WordPress site (no SPA framework).
- "Morph this thumbnail into the project hero" — shared-element transition (Leistungs-Card → Referenz-Detail).
- "Crossfade the gallery when I filter/sort" — list reorder/filter without layout-jump.
- Tab panels, accordion swaps, before/after state changes where a hard cut feels cheap.
- You want the effect to **degrade to an instant swap** on unsupported browsers with zero broken state.

## When NOT to use

- You need scroll-linked, timeline-scrubbed, or physics motion → that is GSAP/ScrollTrigger + Lenis. See `smooth-scroll-gsap-stack` / `scroll-cinema-patterns`. View Transitions are discrete A→B snapshots, not a scrubber.
- You're already in React/Vue with a router that owns transitions — use the framework's integration; don't fight it with raw `startViewTransition` unless you know why.
- Continuous/looping ambient motion (cursor, marquee, count-up) → `premium-microinteractions`.
- The animated content is a giant DOM subtree that changes every frame — snapshotting is expensive; prefer a targeted swap.

## 1. Same-document: filtered/sorted grid crossfade

The minimal, highest-ROI use. Feature-detect, fall back to an instant update.

```js
// Progressive-enhancement wrapper — call this instead of mutating directly.
function swap(updateDOM) {
  // Feature-detect: if unsupported OR user wants reduced motion, just update.
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!document.startViewTransition || reduce) {
    updateDOM();
    return;
  }
  document.startViewTransition(updateDOM);
}

// Usage: filter a project gallery without a hard cut.
const grid = document.querySelector('[data-grid]');
document.querySelectorAll('[data-filter]').forEach((btn) => {
  btn.addEventListener('click', () => {
    const cat = btn.dataset.filter;
    swap(() => {
      grid.querySelectorAll('[data-card]').forEach((card) => {
        card.hidden = cat === 'all' ? false : card.dataset.cat !== cat;
      });
    });
  });
});
```

```css
/* The default cross-document/animation: a 250ms crossfade. Tune the root group. */
::view-transition-old(root),
::view-transition-new(root) {
  animation-duration: 0.28s;
  animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
```

That's the whole crossfade. No keyframes needed for a fade — the browser supplies a default fade on `root`.

## 2. Shared-element morph: thumbnail → hero (the showpiece)

Give the *active* card and the *destination* hero the **same** `view-transition-name`. The browser morphs the rectangle from one to the other.

```css
/* The image that morphs. ONLY ONE element may carry a given name at a time. */
.referenz-card.is-active .referenz-card__img {
  view-transition-name: hero-media;
}
.referenz-detail__hero {
  view-transition-name: hero-media;
}

/* Optional: give the morphing group an ease that reads as "weight", not bounce. */
::view-transition-group(hero-media) {
  animation-duration: 0.5s;
  animation-timing-function: cubic-bezier(0.22, 1, 0.36, 1); /* expo-ish out, NO overshoot */
}
```

```js
// Same-document version: clicking a card swaps in a detail panel.
// CRITICAL: the name must be unique per snapshot, so tag the clicked card
// only for the duration of the transition.
cards.forEach((card) => {
  card.addEventListener('click', () => {
    if (!document.startViewTransition || prefersReduced()) {
      openDetail(card.dataset.id);
      return;
    }
    card.classList.add('is-active');         // assign hero-media to THIS card
    const t = document.startViewTransition(() => openDetail(card.dataset.id));
    t.finished.finally(() => card.classList.remove('is-active'));
  });
});

function prefersReduced() {
  return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}
```

## 3. Cross-document MPA — zero JS, both pages opt in

For real multi-page sites (the WordPress / static-HTML case). Add the rule to the global stylesheet served on **both** the list page and the detail page. Same-origin only.

```css
/* Opt the whole site into cross-document transitions. */
@view-transition {
  navigation: auto;
}

/* Persist a logical element across the navigation by naming it identically
   on both pages. Here: the site logo holds still while the page crossfades. */
.site-logo {
  view-transition-name: site-logo;
}
```

To morph a specific card into the next page's hero across a real navigation, the **outgoing** card must carry the name only as the user leaves. Set it in the click handler (the page is about to unload, so a transient class is fine), and have the destination page assign the same name to its hero in its own CSS.

```js
// On the LIST page: tag the clicked card right before navigation.
document.querySelectorAll('a[data-card]').forEach((a) => {
  a.addEventListener('click', () => {
    document.querySelectorAll('[data-card]').forEach((el) =>
      (el.style.viewTransitionName = ''));
    a.style.viewTransitionName = 'hero-media'; // matches detail page's hero
  });
});
```

Fine-grained control over a cross-document transition (without a framework) uses the navigation events:

```js
// Runs on the page being navigated AWAY from / TO.
window.addEventListener('pageswap', (e) => {
  if (!e.viewTransition) return;            // browser without support
  // e.activation.from / .entry give old/new URLs — conditionally name elements.
});
window.addEventListener('pagereveal', (e) => {
  if (!e.viewTransition) return;            // fires on the incoming page
});
```

## 4. WordPress Classic PHP wiring (MPA)

In a Classic theme this is two lines plus the opt-in rule — no plugin, no build. See `wp-classic-onepager` for the theme skeleton.

```php
// functions.php — ship the View-Transitions stylesheet on every page.
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'vt',
    get_stylesheet_directory_uri() . '/assets/view-transitions.css',
    [],
    filemtime(get_stylesheet_directory() . '/assets/view-transitions.css')
  );
});
```

```css
/* assets/view-transitions.css — loaded site-wide, so both list + single-project
   templates opt in automatically. */
@view-transition { navigation: auto; }

@media (prefers-reduced-motion: reduce) {
  @view-transition { navigation: none; }   /* hard opt-out, honors WCAG */
  ::view-transition-group(*),
  ::view-transition-old(*),
  ::view-transition-new(*) { animation: none !important; }
}
```

Onepagers with anchor-scroll don't navigate, so for a single-template onepager you want the **same-document** mode (section 1/2) on filter/tab interactions, not `@view-transition`.

## 5. Reduced-motion — the non-negotiable guard

The View Transitions API is **JS- and CSS-driven motion**, so the global CSS reduced-motion kill-switch does **not** automatically stop it. Guard on both sides (WCAG 2.2 SC 2.2.2 / 2.3.3):

```css
/* CSS side: neutralize the pseudo-element animations. */
@media (prefers-reduced-motion: reduce) {
  ::view-transition-group(*),
  ::view-transition-old(*),
  ::view-transition-new(*),
  ::view-transition-old(root),
  ::view-transition-new(root) {
    animation: none !important;
  }
}
```

```js
// JS side: skip the snapshot entirely (cheaper than animating to 0).
const REDUCE = window.matchMedia('(prefers-reduced-motion: reduce)');
function swap(update) {
  if (!document.startViewTransition || REDUCE.matches) return void update();
  return document.startViewTransition(update);
}
```

See `web-accessibility-motion` for the full motion-guard discipline across Lenis/canvas/GSAP.

## Pitfalls

- **Duplicate `view-transition-name` = silently dropped transition.** A name must be unique among rendered elements *at snapshot time*. If two cards both carry `hero-media`, the browser skips the morph (and logs a console warning). Assign the name to only the **active** element via a transient class; remove it in `transition.finished`.
- **Forgetting feature-detection.** `document.startViewTransition` is undefined in unsupported browsers → calling it throws and your DOM never updates. Always branch: no API → run `updateDOM()` directly. The state change must happen *regardless* of whether the animation does.
- **Reduced-motion not guarded in JS/CSS.** The global `*{animation-duration:.01ms}` reset does NOT catch `::view-transition-*` animations. Guard explicitly on both sides, or you ship motion to users who opted out.
- **Cross-document needs the rule on BOTH pages, same-origin.** `@view-transition { navigation: auto; }` only fires if *both* the departing and arriving documents have it and share an origin. One side missing → instant nav, no error.
- **Animating a huge/ever-changing subtree.** Snapshotting paints both states; naming a massive container that re-renders fully is expensive and can jank. Name the *specific* element that should morph, let the rest crossfade as `root`.
- **Overshoot/bounce easing.** `back.out` / spring curves on a hero morph read as "Jahrmarkt". Use `cubic-bezier(0.22,1,0.36,1)` (expo-out, no overshoot) and keep durations ≤ 0.5s. Seriös.
- **`view-transition-name` on a transformed ancestor.** A named element inside an element with `transform`/`filter`/`will-change` can position incorrectly — the snapshot is taken relative to the viewport. This is a reason to avoid `ScrollSmoother`'s wrapper translate (see `smooth-scroll-gsap-stack`); Lenis is transform-free and safe here.
- **Loading GSAP/Lenis in the LCP/boot path to power transitions.** You don't need them for View Transitions at all — it's native. Don't add a render-blocking lib for an effect the browser already does. Keep the boot path lean (`web-performance-vitals`).
- **Stacking it with a scroll cinema or a magnetic CTA in the same view.** One signature move per section. A page morph plus a sticky scroll-stage firing together is noise.

## Browser support snapshot (2026)

- **Same-document** (`document.startViewTransition`): Baseline since Oct 2025, ~88% of users. Safe as a progressive enhancement everywhere with the feature-detect fallback.
- **Cross-document** (`@view-transition` MPA): supported in Chromium-based browsers; narrower elsewhere. Treat as pure enhancement — unsupported browsers just navigate instantly, which is the correct fallback anyway.
- Always pair with the no-API branch so the underlying state change is **never** gated behind the animation.

## Related skills

- **smooth-scroll-gsap-stack** — for scroll-scrubbed / physics motion (Lenis lerp 0.09, GSAP single-rAF). View Transitions are discrete swaps, not scrubbers; use the right tool.
- **premium-microinteractions** — custom cursor, magnetic CTA, count-up, marquee. The continuous-motion layer that complements discrete page morphs.
- **web-accessibility-motion** — the full `prefers-reduced-motion` matchMedia discipline; View Transitions MUST be guarded here.
- **web-performance-vitals** — keep transitions out of the LCP/boot path; native VT needs no library, so don't add one.
- **wp-classic-onepager** — theme skeleton + `wp_enqueue_style` for shipping the cross-document `@view-transition` rule site-wide.
- **construction-website-builder** — where this lands in practice: Referenz-Card → Projekt-Detail morph, filtered Leistungs-Grid crossfade on a Meisterbetrieb site.
