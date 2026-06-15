---
name: scroll-cinema-patterns
description: "Implement scroll-driven sticky-stage cinematic sections — Apple-AirPods-Pro style scrollytelling without 3D or heavy frameworks. Pure HTML/CSS/JS. Two patterns: 'classic cinema' (split-view sticky stage with caption card next to image stack) and 'mega-cinema' (full-viewport sticky stage with overlay text + floating callouts). Use when user wants scroll-driven product reveals, construction-phase animations, process-storytelling, or any sticky-scroll-with-changing-content pattern. Validated on PKB V5 (9 Bauphasen) and PKB V11 (4 Master-Phasen Mega-Cinema)."
---

# Scroll Cinema Patterns

Cinematic scroll-driven sections that *feel* like Apple/Stripe/Linear product pages — but built with vanilla HTML/CSS/JS, no GSAP/Three.js/Lottie. ~150 lines of JS total.

## When to Use

Activate when user wants:
- „Beim Scrollen passiert etwas geiles" (Apple-Style)
- Product/Process reveal step-by-step
- Construction-phase storytelling (EFH wird gebaut)
- Multi-step explainer (how it works)
- Image-sequence playback driven by scroll
- Sticky hero with content that changes

Also good signals: „scroll story", „scrollytelling", „cinematic", „immersive", „beim runterscrollen".

## Core Principle

```
┌──────────────────────────────┐  ← Viewport (the user sees this)
│                              │
│   ┌────────────────────┐     │
│   │  STAGE (sticky)    │     │  ← Stays fixed in view
│   │  Image + Text      │     │     while scroll happens
│   │                    │     │     around it
│   └────────────────────┘     │
│                              │
└──────────────────────────────┘
        ↕  Scroll-Container (10× viewport-height)
        ↕  ← This is where „long scrolling" lives
        ↕  ← JS calculates 0–100% progress
        ↕  → Maps to phase index
```

A long container (e.g. `1000vh` for 10 phases) holds a sticky-positioned stage. The stage stays in viewport while the user scrolls. JS measures how far through the long container the user is (0–100%), maps that to a phase index, and shows the correct image + caption.

## Two Validated Patterns

### Pattern A — Classic Cinema (Split View)

**When:** Multi-phase storytelling with detailed captions. Examples: 9 construction phases each with a different description.

**Layout:**
```
┌────────────────────────────────────────┐
│ Top chip      Phase counter            │
│ ┌───────────────────┬─────────────────┐│
│ │                   │ Caption 04/09   ││
│ │  Image stack      │                 ││
│ │  (one active,     │ Aushub          ││
│ │   others hidden)  │ ─────────       ││
│ │                   │ Bagger im Boden ││
│ └───────────────────┴─────────────────┘│
│ ■━━━━━━ ▆━━━━━━ ━━━━━━ ━━━━━━          │
└────────────────────────────────────────┘
```

Image left (~60%), caption card right (~40%). Bottom progress bar with N segments + current phase label.

**Used in PKB V5 Bauablauf.** Files: `templates/megacinema.css` (search `.bauablauf__cinema`), `templates/megacinema.js` (search `initCinema`).

### Pattern B — Mega-Cinema (Full Viewport)

**When:** Few but impactful phases. Examples: 4 master-phases (Beraten / Entwerfen / Bauen / Übergabe). Visually dominant.

**Layout:**
```
┌──────────────────────────────────────────────┐
│ 03 / 04                       Detail label   │ ← Top chips
│                                              │
│   [Callout: Bauantrag]                       │ ← Floating callouts
│                                              │     (4 corners)
│                                              │
│                01 / 04                       │
│             B E R A T E N                    │ ← Huge title (90pt+)
│       Erstgespräch & Vor-Ort                 │
│   Wir besprechen Ihr Vorhaben — kost...     │
│                                              │
│   [Persönlich]              [30 Min]         │
│                                              │
│ ━━●━━ ━━━━━━ ━━━━━━ ━━━━━━     Beraten      │ ← Progress
└──────────────────────────────────────────────┘
   Background: full-bleed image with vignette
```

Image fullbleed, text as overlay, vignette gradient for legibility, floating callouts staggered in.

**Used in PKB V11 Ablauf.** Files: `templates/megacinema.css` (search `.megacinema--bauen`), `templates/megacinema.js` (same `initMegaCinema`).

## The Build Recipe

### 1. HTML structure
```html
<div class="cinema" data-cinema data-total="9">
  <div class="cinema__stage">
    
    <!-- Image stack: all N images stacked, opacity 0 except active -->
    <div class="cinema__images">
      <img src="phase-01.jpg" class="is-active" data-phase="0">
      <img src="phase-02.jpg" data-phase="1">
      <!-- ... -->
    </div>
    
    <!-- Vignette gradient for text legibility -->
    <div class="cinema__veil" aria-hidden="true"></div>
    
    <!-- Caption stack OR overlay text -->
    <div class="cinema__overlay">
      <article class="master is-active" data-phase="0">
        <h3>Beraten</h3>
        <p>Erstgespräch...</p>
        <span class="callout callout--tl" style="--delay: 200ms">Kostenlos</span>
        <span class="callout callout--tr" style="--delay: 310ms">30 Min</span>
      </article>
      <!-- ... more masters -->
    </div>
    
    <!-- Progress bar -->
    <footer>
      <div class="cinema__progress">
        <button class="step is-active" data-phase="0"></button>
        <!-- ... -->
      </div>
    </footer>
  </div>
</div>
```

### 2. CSS essentials
```css
.cinema { 
  position: relative; 
  height: calc(9 * 100vh);  /* N phases × full viewport */
}
.cinema__stage { 
  position: sticky; 
  top: 0; 
  height: 100vh; 
  overflow: hidden; 
}
.cinema__images img {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  opacity: 0;
  transition: opacity 700ms cubic-bezier(0.16,1,0.3,1);
  transform: scale(1.04);
  transition: opacity 700ms, transform 6000ms linear;
}
.cinema__images img.is-active { 
  opacity: 1; 
  transform: scale(1);  /* slow Ken-Burns over 6s */
}

/* Floating callouts with staggered entry */
.callout {
  position: absolute;
  opacity: 0;
  transform: translateY(12px);
  transition: opacity 500ms var(--delay, 0ms),
              transform 500ms var(--delay, 0ms);
}
.master.is-active .callout {
  opacity: 1;
  transform: translateY(0);
}
.callout--tl { top: 18vh; left: 6vw; }
.callout--tr { top: 16vh; right: 8vw; }
/* ... bl, br similar */
```

### 3. JS core (the magic)
```js
function initCinema() {
  const cinema = document.querySelector('[data-cinema]');
  if (!cinema) return;
  const total = parseInt(cinema.dataset.total, 10) || 1;
  const images = cinema.querySelectorAll('img');
  const masters = cinema.querySelectorAll('.master');
  const steps = cinema.querySelectorAll('.step');

  const setPhase = (i, segmentProgress = 0) => {
    images.forEach((el, idx) => el.classList.toggle('is-active', idx === i));
    masters.forEach((el, idx) => el.classList.toggle('is-active', idx === i));
    steps.forEach((el, idx) => {
      el.classList.toggle('is-active', idx === i);
      el.classList.toggle('is-passed', idx < i);
    });
    steps.forEach((el, idx) => {
      if (idx === i) el.style.setProperty('--p', String(segmentProgress));
      else el.style.removeProperty('--p');
    });
  };

  const onScroll = () => {
    const rect = cinema.getBoundingClientRect();
    const scrollable = cinema.offsetHeight - window.innerHeight;
    if (scrollable <= 0) return;
    const p = Math.max(0, Math.min(1, (-rect.top) / scrollable));
    const phaseFloat = p * total;
    const phaseIndex = Math.min(total - 1, Math.floor(phaseFloat));
    const segmentProgress = Math.max(0, Math.min(1, phaseFloat - phaseIndex));
    setPhase(phaseIndex, segmentProgress);
  };

  // rAF throttle
  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(() => { onScroll(); ticking = false; });
    }
  }, { passive: true });
  onScroll();
}
```

## Detail References

- **`references/sticky-stage-deep-dive.md`** — Edge cases (mobile, reduced-motion, content above/below the cinema), debugging checklist
- **`references/floating-callouts.md`** — Positioning patterns, stagger timing, mobile collapse strategies
- **`templates/megacinema.css`** — Full validated CSS (from PKB V5/V11) ready to copy
- **`templates/megacinema.js`** — Full validated JS handler with click-to-jump, exclusive states

## Performance Tips

1. **rAF-throttle the scroll listener** — never set state on every scroll event, always wrap in `requestAnimationFrame`
2. **`transform: scale()` over `width/height`** — GPU-accelerated, no layout thrash
3. **`will-change: opacity, transform`** on the images if N > 10 — helps Safari
4. **Image preload** — when phase N becomes active, set `loading="eager"` on N+1 to avoid jank
5. **`object-fit: cover`** — never let images stretch, this prevents weird scaling
6. **Sticky `top: 0`** vs **`top: var(--nav-h)`** — sticky must respect fixed header height, otherwise the stage hides behind the nav

## Mobile Strategy

```css
@media (max-width: 720px) {
  /* Reduce viewport hunger */
  .cinema { height: calc(9 * 80vh); }
  
  /* Hide nice-to-have callouts on tight screens */
  .callout--bl, .callout--br { display: none; }
  
  /* Make caption card stack below image, not next to */
  .cinema__overlay { grid-template-columns: 1fr; }
}
```

## Common Pitfalls

1. **`overflow: hidden` on parent kills sticky** — sticky needs the parent to be scrollable, no overflow hidden
2. **Sticky inside flexbox sometimes breaks** — wrap in block element
3. **Header z-index war** — sticky cinema needs `z-index: 1`, sticky nav `z-index: 50`+
4. **Images jumping size** — set `aspect-ratio` or fixed dimensions, don't rely on natural size
5. **Callouts overlap title on mobile** — use `vw`-based positions OR hide some on mobile
6. **Progress segment animation glitches** — use `transform: scaleX()` with `transform-origin: left`, never `width:`
7. **Reduced-motion ignored** — always wrap Ken-Burns + callout animations in `@media (prefers-reduced-motion: reduce) { transform: none !important }`

## Beyond Construction

The pattern works for **any sequential reveal**:
- Product step-by-step assembly (Apple AirPods)
- Process diagram (Stripe Atlas)
- Recipe steps (food/wellness)
- Onboarding flow (SaaS)
- Timeline / history (museum, brand)
- Algorithm visualization (ML/DS)

Just swap images + captions, the engine stays identical.

## Related

- **`construction-website-builder`** Skill — uses this pattern as core feature for Bau-Sites
- **`ai-image-sequence`** Skill — for generating the N consistent images that feed this pattern
- **`agency-website-builder`** Skill — has sticky-stacking-cards (similar but different mechanism)
