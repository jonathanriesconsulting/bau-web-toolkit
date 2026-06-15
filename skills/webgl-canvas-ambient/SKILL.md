---
name: webgl-canvas-ambient
description: "Build a subtle, monochrome ambient background layer (2D-canvas gradient-mesh, radial-gradient blobs, or optional simplex-noise field) as an atmospheric depth layer behind premium/editorial sites — never the visual star, always glacial and restrained. Use when the user asks to add an \"ambient background\", \"subtle animated gradient\", \"moving background blobs\", \"atmospheric depth\", \"canvas glow\", \"noise/mesh background\", \"premium hero backdrop\", or wants the site to \"feel alive\" / \"have depth\" without bounce or neon. Covers when JA / when NEIN, reduced-motion-static fallback, performance budget (don't compete with LCP), and three escalating implementations (CSS-only blobs → 2D-canvas mesh → simplex-noise). Disciplined \"Massivbau statt Jahrmarkt\" aesthetic for serious brands (Bauunternehmen, agency, editorial). Use when the user asks to add ambient motion to a background — and to know when NOT to."
---

# WebGL / Canvas Ambient Background

A subtle atmospheric depth layer that sits **behind** content and makes a flat page feel like it has air in it — without ever drawing attention to itself. The whole craft here is restraint: a barely-perceptible monochrome gradient that drifts at glacial speed. If a visitor *notices* the background animating, you have failed.

Three escalating implementations, smallest first:

1. **CSS-only radial blobs** — zero JS, two-three `radial-gradient` layers with a 40-60s keyframe drift. Default choice. Reach for this first.
2. **2D-canvas gradient-mesh** — a handful of soft radial sprites composited with `multiply`, animated in one rAF. For when CSS blobs look too geometric and you want organic flow.
3. **simplex-noise field** (~3 KB) — a low-res noise-driven luminance grid scaled up by CSS blur. The "expensive" option; only when the mesh isn't organic enough.

**No WebGL/Three.js, no shaders, no particles, no plasma, no neon.** The name says "WebGL" because that's what people search for — but a real WebGL context for a background blob is a 600 KB liability and a battery drain. 2D canvas + CSS does everything a serious brand needs.

Leitbild: **Massivbau statt Jahrmarkt.** A Meisterbetrieb site has the quiet depth of good architectural lighting, not a screensaver.

## When to use / When NOT to use

**Use it when:**
- The page is **light-dominant and minimal** (large white/bone areas) and feels flat or clinical. Ambient depth warms it without adding a single visible element.
- You have a **monochrome or near-monochrome palette** (OKLCH `--neutral-c ≈ 0.006`) where the blobs read as faint tonal shifts, not color.
- It sits behind a **hero or a long quiet section** (about / manifesto) where there's nothing else moving — one signature move per section.
- The brand can carry "calm and expensive" (editorial, architecture, agency, premium service).

**Do NOT use it when:**
- There is **already motion in the viewport** — a scroll-cinema stage, a marquee, a video, count-ups. Two ambient motions = noise. One signature move per section, always.
- The section is **dense with content** (data tables, pricing grids, forms). Background motion behind text hurts readability and INP focus.
- The palette is **saturated or dark-neon** — ambient blobs there instantly become "screensaver / crypto landing page."
- It would land **behind body copy** at high contrast. Keep it under hero whitespace, oversized headlines, or empty editorial bands — never under a paragraph someone has to read.
- **Performance is tight and the section is above the fold.** The ambient layer must never compete with LCP (see Pitfalls). If in doubt, ship the CSS-only version or nothing.

If you can't name the specific empty area it's adding depth to, the answer is NEIN.

---

## Implementation 1 — CSS-only radial blobs (default)

Zero JS, GPU-composited, reduced-motion handled in pure CSS. This is the right answer ~70% of the time.

```html
<!-- First child of the section/hero. aria-hidden: it's pure decoration. -->
<div class="ambient" aria-hidden="true"></div>
```

```css
.ambient{
  position:absolute; inset:0;
  z-index:0;                 /* content sits at z-index:1+ */
  overflow:hidden;
  pointer-events:none;       /* never eat clicks */
  /* two faint monochrome glows on the light-dominant background */
  background:
    radial-gradient(38vmax 38vmax at 22% 18%,
      oklch(0.94 0.006 255 / .55), transparent 60%),
    radial-gradient(46vmax 46vmax at 82% 72%,
      oklch(0.97 0.006 255 / .45), transparent 62%);
  /* multiply keeps blobs as tonal depth, not added light */
  mix-blend-mode:multiply;
  /* big blur = no visible gradient banding, fully organic edges */
  filter:blur(40px);
  animation:ambient-drift 48s ease-in-out infinite alternate;
  will-change:transform;
}
@keyframes ambient-drift{
  from{ transform:translate3d(-2%, -1%, 0) scale(1.05); }
  to  { transform:translate3d( 3%,  2%, 0) scale(1.12); }
}

/* The non-negotiable kill switch. CSS handles its own motion here. */
@media (prefers-reduced-motion: reduce){
  .ambient{ animation:none; }
}
```

Notes that matter:
- `vmax` units keep the blobs proportional on any aspect ratio.
- Opacity stays `.45-.55`. Above ~`.6` it reads as a deliberate gradient (visible), below ~`.3` it disappears entirely — `.5` is the depth sweet spot.
- `blur(40px)` is doing the organic work — without it you get a hard, obviously-geometric circle.
- The 48s duration is intentional: glacial. If it completes a loop in under ~30s it becomes perceptible.

---

## Implementation 2 — 2D-canvas gradient-mesh

When CSS blobs look too circular and you want flowing, overlapping soft light. A handful of radial sprites drift on independent slow paths and composite with `multiply`. One rAF, retina-correct, reduced-motion = one static frame.

```html
<canvas class="ambient-canvas" aria-hidden="true"></canvas>
```

```css
.ambient-canvas{
  position:absolute; inset:0; z-index:0;
  width:100%; height:100%;
  pointer-events:none;
  opacity:.5;                 /* the depth dial lives here */
}
```

```js
// ambient-mesh.js — vanilla, no deps. Load deferred / after LCP.
(() => {
  const canvas = document.querySelector('.ambient-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  const reduce = matchMedia('(prefers-reduced-motion: reduce)');

  // Monochrome luminance values only — depth, not color.
  const BLOBS = [
    { x:.22, y:.20, r:.55, l:235, vx: .000018, vy: .000012, sp:0 },
    { x:.80, y:.30, r:.48, l:248, vx:-.000014, vy: .000020, sp:1.7 },
    { x:.55, y:.82, r:.62, l:240, vx: .000022, vy:-.000010, sp:3.4 },
  ];

  let w, h, dpr, raf = 0;

  function resize(){
    dpr = Math.min(devicePixelRatio || 1, 2); // cap retina cost
    w = canvas.clientWidth;  h = canvas.clientHeight;
    canvas.width  = Math.round(w * dpr);
    canvas.height = Math.round(h * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function paint(t){
    ctx.clearRect(0, 0, w, h);
    ctx.globalCompositeOperation = 'multiply';
    const minside = Math.min(w, h);
    for (const b of BLOBS){
      // glacial sine drift around the anchor; t in ms
      const cx = (b.x + Math.sin(t * b.vx + b.sp) * .06) * w;
      const cy = (b.y + Math.cos(t * b.vy + b.sp) * .06) * h;
      const rad = b.r * minside;
      const g = ctx.createRadialGradient(cx, cy, 0, cx, cy, rad);
      g.addColorStop(0,   `rgb(${b.l} ${b.l} ${b.l} / .50)`);
      g.addColorStop(0.6, `rgb(${b.l} ${b.l} ${b.l} / .18)`);
      g.addColorStop(1,   `rgb(${b.l} ${b.l} ${b.l} / 0)`);
      ctx.fillStyle = g;
      ctx.fillRect(0, 0, w, h);
    }
  }

  function loop(t){ paint(t); raf = requestAnimationFrame(loop); }

  function start(){
    resize();
    if (reduce.matches){ paint(0); return; }   // one static frame, no rAF
    cancelAnimationFrame(raf);
    raf = requestAnimationFrame(loop);
  }

  // Pause off-screen: don't burn frames on a background nobody sees.
  const io = new IntersectionObserver(([e]) => {
    if (e.isIntersecting && !reduce.matches){
      if (!raf) raf = requestAnimationFrame(loop);
    } else { cancelAnimationFrame(raf); raf = 0; }
  }, { threshold: 0 });
  io.observe(canvas);

  addEventListener('resize', start, { passive:true });
  reduce.addEventListener('change', start);
  start();
})();
```

Why these choices:
- `globalCompositeOperation = 'multiply'` makes overlapping blobs deepen tone instead of blowing out to white — same logic as the CSS `mix-blend-mode`.
- `dpr` capped at 2: a 3x retina canvas at full viewport is a measurable paint cost for an invisible effect.
- `IntersectionObserver` stops the rAF the moment the hero scrolls away. A background that animates while off-screen is pure waste.
- Reduced-motion paints exactly one frame and never starts the loop — the gradient is still there, just frozen.

---

## Implementation 3 — simplex-noise field (only if you must)

Use this only when the mesh still looks too "two circles sliding." A low-res noise grid (e.g. 64×64) sampled into luminance, drawn small, then scaled up by CSS — the upscale blur turns it into genuinely organic, cloud-like depth. ~3 KB.

```js
// simplex-noise 4.0.3, ESM from jsdelivr
import { createNoise3D } from 'https://cdn.jsdelivr.net/npm/simplex-noise@4.0.3/dist/esm/simplex-noise.js';

(() => {
  const canvas = document.querySelector('.ambient-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  const reduce = matchMedia('(prefers-reduced-motion: reduce)');
  const noise3D = createNoise3D();

  // Tiny internal buffer; CSS scales it up + blurs into organic mist.
  const N = 64;
  canvas.width = N; canvas.height = N;
  const img = ctx.createImageData(N, N);

  function paint(t){
    const z = t * 0.00004;               // glacial evolution
    for (let y = 0; y < N; y++){
      for (let x = 0; x < N; x++){
        const n = noise3D(x / 22, y / 22, z);     // -1..1
        // map into a NARROW light band: subtle tonal shift only
        const lum = 236 + n * 12;                  // ~224..248
        const i = (y * N + x) * 4;
        img.data[i] = img.data[i+1] = img.data[i+2] = lum;
        img.data[i+3] = 255;
      }
    }
    ctx.putImageData(img, 0, 0);
  }

  let raf = 0;
  function loop(t){ paint(t); raf = requestAnimationFrame(loop); }

  if (reduce.matches){ paint(0); }
  else { raf = requestAnimationFrame(loop); }
})();
```

```css
/* The whole illusion: render 64px, blow it up, blur the pixels away. */
.ambient-canvas{
  position:absolute; inset:0; z-index:0;
  width:100%; height:100%;
  object-fit:cover;
  image-rendering:auto;       /* let the browser smooth the upscale */
  filter:blur(28px) contrast(1.04);
  mix-blend-mode:multiply;
  opacity:.4;
  pointer-events:none;
}
```

The trick is the **narrow luminance band** (`236 + n*12`). A full `0..255` noise map is the screensaver look. Clamping it to a ~24-value spread keeps it as faint atmospheric depth. Same IntersectionObserver-pause pattern from Implementation 2 applies here too — omitted only for brevity.

---

## WordPress Classic integration

Enqueue the ambient script **deferred and after LCP** — never in the boot path before the hero paints (see `wp-classic-onepager`).

```php
// functions.php — defer + footer so it never blocks the hero render.
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'ambient-mesh',
    get_stylesheet_directory_uri() . '/js/ambient-mesh.js',
    [], '1.0', true                          // true = load in footer
  );
  wp_script_add_data('ambient-mesh', 'strategy', 'defer'); // WP 6.3+ defer
});
```

```php
<!-- In the hero section template, as the FIRST child, before content -->
<section class="hero">
  <div class="ambient" aria-hidden="true"></div>
  <div class="hero__content"><!-- z-index:1 --></div>
</section>
```

---

## Pitfalls

- **It becomes the star.** Opacity over ~`.6`, saturated color, or fast drift turns subtle depth into a screensaver. Stay monochrome, `opacity .35-.55`, loop ≥ 30s (ideally 45-60s). If a visitor notices it move, dial it down or remove it.
- **Stacking it on top of other motion.** Ambient behind a scroll-cinema stage, a marquee, or count-ups = two competing motions = cheap. One signature move per section. The ambient layer is the move only when the section is otherwise still.
- **reduced-motion only handled in CSS.** The global CSS kill-switch (`*{animation-duration:.01ms!important;…}`) freezes CSS animations **but not your canvas rAF**. JS motion (the `requestAnimationFrame` loop) MUST be guarded separately via `matchMedia('(prefers-reduced-motion: reduce)')` — paint one static frame and never start the loop. WCAG 2.2 SC 2.2.2/2.3.3. The CSS-only Implementation 1 is the exception (its motion *is* CSS).
- **Competing with LCP.** This is the cardinal sin. The ambient layer is decoration — it must never delay the hero image or headline. Load the script `defer` in the footer, never in `<head>` before LCP. Do not give the canvas `fetchpriority` of anything. If the section is above the fold and your budget is tight (LCP < 2.5s, INP < 200ms, CLS < 0.1), ship Implementation 1 (zero JS) or nothing.
- **Animating off-screen.** A full-viewport rAF that keeps painting after the hero scrolls away burns battery for an invisible effect. Always pause via `IntersectionObserver` and stop on `reduce`.
- **Uncapped devicePixelRatio.** A 3x retina canvas at full viewport is a real paint cost for something nobody should see. Cap `dpr` at 2.
- **Hard geometric edges.** A `radial-gradient` or canvas blob without enough blur reads as an obvious circle. Generous `blur()` (28-40px) is what makes it organic — it's a feature, not a smell.
- **Banding on flat gradients.** Wide, smooth gradients on 8-bit displays band visibly. The blur from the previous point also kills banding; the simplex-noise field avoids it entirely by being inherently dithered.
- **Eating clicks / breaking a11y.** Always `pointer-events:none` and `aria-hidden="true"`. It is decoration; assistive tech and the cursor must pass straight through.
- **Real WebGL for a blob.** Spinning up a WebGL context (or Three.js) for an ambient background is a 100-600 KB dependency, a shader-compile hitch, and a battery cost — to draw something 2D canvas does in 40 lines. Don't. The skill name is SEO, not a mandate.

---

## Related skills

- **smooth-scroll-gsap-stack** — if the page already runs Lenis + GSAP, share the existing `gsap.ticker` rather than spinning a second rAF; and remember Lenis is the page's one motion budget — don't pile ambient on top of a busy scroll.
- **premium-microinteractions** — custom cursor, magnetic CTA, count-ups. The "one signature move per section" discipline is shared; coordinate so ambient and a microinteraction never fire in the same viewport.
- **web-accessibility-motion** — the full `prefers-reduced-motion` story (CSS kill-switch vs. JS `matchMedia` guard, WCAG 2.2 SC 2.2.2 / 2.3.3). The canvas rAF guard above is the canonical example of "CSS isn't enough."
- **web-performance-vitals** — LCP / INP / CLS budgets, `defer`/footer loading, `fetchpriority` discipline. The ambient layer is the textbook "decoration that must yield to LCP."
- **wp-classic-onepager** — enqueue patterns, footer/defer script strategy, section template structure for dropping the `.ambient` div in as a section's first child.
- **construction-website-builder** — the house style this skill serves: monochrome, light-dominant, Meisterbetrieb seriousness. "Massivbau statt Jahrmarkt" comes from here.
- **multi-variant-theme-tokens** — the OKLCH token system (`--neutral-h`, `--neutral-c ≈ 0.006`, hierarchy via L only) the blob colors should be derived from, so the ambient layer flips with the theme.
