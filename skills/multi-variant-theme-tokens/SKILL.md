---
name: multi-variant-theme-tokens
description: Build 3+ color variants of the same site/component via CSS token-flip without code duplication. Use when the user asks "give me 3 designs" or "show me a light version" or "make it cream/warm/cool" — and wants to compare variants side-by-side without rewriting markup. Covers the token architecture (--c-bg / --c-text-N / --c-line-N / --c-gold), the override-block-at-end-of-css pattern for areas that don't auto-flip (hero stays dark over photo, footer stays dark for drama), 5 validated palettes (Dark+Gold, Light+Gold, Cream+Brass, Slate+Steel, Bone+Olive), and how to run wp-now on multiple ports for parallel comparison.
---

# Multi-Variant Theme via CSS Token-Flip

## Core idea

One markup + one main CSS. Variants emerge by **flipping ~20 token values at the top of `style.css`** plus **a small override-block at the bottom** for hardcoded sections that don't auto-flip.

## Token architecture (the minimum useful set)

```css
:root {
    /* Canvas family — 4 surfaces */
    --c-bg:      /* primary canvas */;
    --c-bg-lift: /* sections that lift from canvas */;
    --c-bg-card: /* card / hover surfaces */;
    --c-bg-deep: /* footer + drama-contrast sections */;

    /* Accent — keep one variable name even when changing hue */
    --c-gold:        /* primary accent */;
    --c-gold-bright: /* hover/focus */;
    --c-gold-deep:   /* deep tone, hairlines */;
    --c-gold-glow:   /* low-alpha bg tint */;

    /* Text — 4 opacities */
    --c-text:   /* primary text */;
    --c-text-2: /* secondary */;
    --c-text-3: /* tertiary */;
    --c-text-4: /* faint / placeholder */;

    /* Lines — 3 opacities */
    --c-line:      /* hairlines */;
    --c-line-2:    /* stronger borders */;
    --c-line-gold: /* accent hairlines */;
}
```

Why keep `--c-gold` as the variable name even when switching to steel-blue? **One CSS body, N variants.** Renaming variables for each variant = code duplication = drift.

## 5 validated palettes

### Dark + Gold (Premium Bau)
```css
--c-bg: #0a0a0c; --c-bg-lift: #131318; --c-bg-card: #1a1a22; --c-bg-deep: #050507;
--c-gold: #c9a961; --c-gold-bright: #e8c97e; --c-gold-deep: #8d6e2a;
--c-text: rgba(255,255,255,0.94); --c-text-2: rgba(255,255,255,0.62);
--c-line: rgba(255,255,255,0.08); --c-line-gold: rgba(201,169,97,0.30);
```

### Light + Gold (Atelier — Editorial)
```css
--c-bg: #ffffff; --c-bg-lift: #f6f5f1; --c-bg-card: #efece5; --c-bg-deep: #0f0f10;
--c-gold: #b08d3a; --c-gold-bright: #d4b466; --c-gold-deep: #7a5f1f;
--c-text: rgba(15,15,16,0.92); --c-text-2: rgba(15,15,16,0.62);
--c-line: rgba(15,15,16,0.10); --c-line-gold: rgba(176,141,58,0.32);
```

### Cream + Brass (Werkraum — Warm)
```css
--c-bg: #f7f3ec; --c-bg-lift: #efe8db; --c-bg-card: #e6dccc; --c-bg-deep: #211e18;
--c-gold: #a07232; --c-gold-bright: #c89a55; --c-gold-deep: #6b4818;
--c-text: rgba(33,30,24,0.94); --c-text-2: rgba(33,30,24,0.66);
--c-line: rgba(33,30,24,0.12); --c-line-gold: rgba(160,114,50,0.34);
```

### Slate + Steel (Beton — Engineering)
```css
--c-bg: #11161e; --c-bg-lift: #1a212c; --c-bg-card: #232b39; --c-bg-deep: #0a0e15;
--c-gold: #6fa3c8; --c-gold-bright: #94c0de; --c-gold-deep: #3d6985;
--c-text: rgba(232,238,247,0.94); --c-text-2: rgba(232,238,247,0.62);
--c-line: rgba(232,238,247,0.09); --c-line-gold: rgba(111,163,200,0.32);
```

### Bone + Olive (Earthy, alternative warm)
```css
--c-bg: #f3eee2; --c-bg-lift: #e8e1d0; --c-bg-card: #dcd3bc; --c-bg-deep: #1d1f17;
--c-gold: #5e6a3a; --c-gold-bright: #87966e; --c-gold-deep: #3c4523;
--c-text: rgba(29,31,23,0.94); --c-text-2: rgba(29,31,23,0.62);
--c-line: rgba(29,31,23,0.12); --c-line-gold: rgba(94,106,58,0.32);
```

## Light-Theme override block (critical)

Token-flip alone breaks the Hero: the body becomes white but the Hero photo stays dark, and `var(--c-text)` becomes dark text on dark photo → unreadable.

**Solution:** append a Light-Theme override-block at the end of `style.css`. Hero texts stay white; footer/kontakt stay dark for drama-contrast.

```css
/* ============================================================
   LIGHT THEME OVERRIDES (when --c-bg is light)
   ============================================================ */

/* Hero stays dark photo — texts must remain white */
.hero .mono { color: rgba(255,255,255,0.62); }
.hero .mono--gold { color: var(--c-gold-bright); }
.hero__h1 { color: rgba(255,255,255,0.96); }
.hero__h1 strong { color: var(--c-gold-bright); }
.hero__lead { color: rgba(255,255,255,0.88); }
.hero__meta { border-top-color: rgba(255,255,255,0.18); }
.hero__meta-item small { color: rgba(255,255,255,0.62); }
.hero__meta-item strong { color: rgba(255,255,255,0.96); }
.hero__meta-item strong em { color: var(--c-gold-bright); }
/* Hero gradient still fades to dark, but final stop goes to canvas (light) */
.hero__bg::after {
    background:
        linear-gradient(180deg, rgba(10,10,12,0.55) 0%, rgba(10,10,12,0.25) 28%, rgba(10,10,12,0.78) 78%, var(--c-bg) 100%),
        linear-gradient(90deg, rgba(10,10,12,0.45) 0%, rgba(10,10,12,0.0) 55%);
}
/* Hero btn-outline is light-on-photo */
.hero .btn--outline { color: rgba(255,255,255,0.94); border-color: rgba(255,255,255,0.30); }

/* Header glass switches from dark-blur to light-blur */
.site-header { background: rgba(255,255,255,0.78); border-bottom-color: transparent; }
.site-header.is-scrolled { background: rgba(255,255,255,0.94); border-bottom-color: var(--c-line); }

/* Kontakt + Footer keep dark drama (since --c-bg-deep stays dark by design) */
.kontakt, .site-footer { color: rgba(255,255,255,0.62); }
.kontakt__title { color: rgba(255,255,255,0.94); }
.kontakt__title strong { color: var(--c-gold-bright); }
.kontakt__lead { color: rgba(255,255,255,0.78); }
.kontakt__phone { color: var(--c-gold-bright); }
.kontakt__form-card { background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.10); }
/* … etc for kontakt fields, labels, input bg, btn ghost */
```

For Cream-Theme: replace `rgba(255,255,255,…)` overrides with `rgba(247,243,236,…)` and dark-photo overlays with `rgba(20,16,10,…)`.

## Parallel comparison via wp-now

Run 4 variants simultaneously on ports 8884, 8895, 8896, 8897 — user can flip browser tabs to compare.

```bash
cd /path/to/site
# v1 — main theme (existing)
npx @wp-now/wp-now start --path=./wp-content/themes/my-theme --port=8884 > /tmp/wp-now-v1.log 2>&1 &
# v2-v4 — variant themes
npx @wp-now/wp-now start --path=./wp-content/themes/my-theme-v2 --port=8895 > /tmp/wp-now-v2.log 2>&1 &
npx @wp-now/wp-now start --path=./wp-content/themes/my-theme-v3 --port=8896 > /tmp/wp-now-v3.log 2>&1 &
npx @wp-now/wp-now start --path=./wp-content/themes/my-theme-v4 --port=8897 > /tmp/wp-now-v4.log 2>&1 &
```

Each theme-path has its own SQLite-DB in `~/.wp-now/sites/` — no conflicts. Sites are content-identical because they share `inc/sections/*.php` and the same data sources (functions.php `faqs()` etc.).

## Workflow recipe

1. Start with one finished theme (v1).
2. `cp -r my-theme my-theme-v2 && cp -r my-theme my-theme-v3 && cp -r my-theme my-theme-v4`
3. In each variant's `style.css`:
   - Update theme header `Theme Name:` and `Version:`
   - Replace `:root { … }` token block with the variant palette
   - For Light/Cream variants: append override-block at end
4. Optional: rename `--c-gold` semantically (e.g. `--c-accent`) for v4 Steel — but more code work; usually not worth it.
5. Start each via wp-now on its own port.
6. Screenshot each at 1440×900 + 375×812 for desktop/mobile compare.
7. User picks winner; the others stay as fallback alternatives in the repo.

## Pitfalls

1. **Hero text unreadable in Light variants** — always add the Light-Theme override block (see above). Don't skip thinking the Hero auto-adapts; it can't, because the photo is dark.

2. **Header glass-blur stays dark** — needs override per variant (Light-glass / Cream-glass / Slate-stays-default).

3. **Forms break in Light themes** — input borders and backgrounds inherit dark-canvas tokens. Always override `.field input/textarea/select` and `.field--file label.file-drop` for Light/Cream variants.

4. **Logo on cream canvas looks dirty** if logo is dark-on-light-bg with transparent png. Either get a single-color SVG variant per theme or accept the look.

5. **Forgetting to update theme name + version** in `style.css` header — WP Admin shows duplicate "EDI Hochbau" entries. Each variant's header MUST be unique.

6. **wp-now SQLite conflict** if two wp-now instances point at the same theme-path. Each variant needs its own path.

## When NOT to do this

- Pure design exercise without commitment to ship → mockups in Figma faster.
- More than 5 variants → overhead exceeds value; pick 3 best directions and stop.
- Variants differ in layout (not just color) → token-flip can't help; need separate templates.

## Related skills

- **wp-classic-onepager** — Tech-Setup including wp-now multi-port pattern
- **construction-website-builder** — Domain-Knowledge about which palette fits which audience
- **frontend-design** — For initial direction picking before committing to N variants
