# Design Systems Reference

## Stilrichtungen für Agency Websites

### 1. Light Editorial (winno.ch-Style)
**Wann:** Premium B2B, Beratung, Schweizer/Deutsch professionelles Image

**Palette:**
```css
--bg: #ffffff;
--surface: #f3f3f3;
--text: #0e1010;
--text-soft: #414949;
--text-muted: #647674;
--accent: #005456;  /* Deep teal */
```

**Typografie:**
- Display: Inter (kein Outfit, kein Serif — User-Präferenz)
- Body: Inter 14.5px
- Mono: JetBrains Mono für Eyebrows

**Killer:** Sticky-Stacking Service Cards

---

### 2. Tech-Forward SaaS (Linear/Vercel/Resend)
**Wann:** Tech-Zielgruppe, KI/Automation-Fokus, Developer-Tools

**Palette (Dark):**
```css
--bg: #08090b;
--surface: #131418;
--text: #f4f5f7;
--accent: #7866ff;  /* Electric purple */
--accent-2: #00d4ff;
--accent-3: #ff5b9c;
```

**Killer:** Mesh-Gradient Hero, Bento-Grid, Code-Snippets, Status-Pill

---

### 3. Hybrid Light + Tech (V10 — getestet & approved)
**Wann:** Bestes von beiden Welten — schlicht, aber polished

**Palette:**
```css
--bg: #ffffff;
--surface: #f4f6f4;
--text: #0a0e0b;
--accent: #2a8f5b;  /* Forest green */
```

**Mix:**
- Light Theme + Sticky Cards (von winno)
- Dotted-BG + Bento + Code-Snippets (von Linear)
- Video-Hero subtil + Brand-Grün (vom Original)

---

### 4. Warm Editorial (world.org-Style)
**Wann:** Marken mit Story, Magazin-Vibe gewollt

**Palette:**
```css
--bg: #f9f9f8;          /* warm off-white */
--text: #2d2c2c;
--text-muted: #75726f;
--accent: #fc4c02;      /* orange */
```

**Killer:** Riesige thin-weight Headlines (Inter 300), asymmetrisches Hero

---

### 5. Stripe-Conversion (HubSpot-vibe)
**Wann:** Maximum Lead-Gen, Pricing-fokussiert

**Palette:**
```css
--bg: #ffffff;
--bg-2: #f7f8fa;
--text: #0a0e27;
--accent: #635bff;      /* Stripe purple */
--green: #00d97e;
```

**Killer:** Hero-Mockup-Card, Floating Stats, Sticky CTA Bar, 3-Tier Pricing

---

## Typography-Stack

### Default (Sans-Serif only — User-Anforderung)
```css
--font-display: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
--font-body: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
--font-mono: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, monospace;
```

### Google Fonts CDN
```html
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />
```

## Font-Size Scale (Compact, V5/V10-Stil)

```css
--text-h1: clamp(36px, 5vw, 64px);     /* Hero */
--text-h2: clamp(28px, 3.6vw, 48px);   /* Section */
--text-h3: clamp(22px, 2.6vw, 32px);   /* Card-Title */
--text-h4: 20px;
--text-body: 14.5px;
--text-small: 13px;
--text-xs: 11px;
```

## Spacing Scale

```css
--space-2: 8px;
--space-4: 16px;
--space-6: 24px;
--space-8: 32px;
--space-12: 48px;
--space-16: 64px;
--space-20: 80px;
--space-24: 96px;
```

## Border-Radius

```css
--radius: 8px;          /* Buttons, Inputs */
--radius-lg: 16px;      /* Cards */
--radius-xl: 24px;      /* Hero Cards, Bento */
--radius-2xl: 32px;     /* CTA-Blocks */
--radius-full: 9999px;  /* Pills */
```

## Shadow Scale

```css
--shadow-sm: 0 1px 2px rgba(10, 14, 11, 0.04);
--shadow-md: 0 6px 24px rgba(10, 14, 11, 0.06);
--shadow-lg: 0 20px 60px rgba(10, 14, 11, 0.10);
--shadow-glow: 0 8px 32px rgba(42, 143, 91, 0.25);
```

## Decision Matrix

| User says | Pick this style |
|-----------|----------------|
| "Schlicht, modern" | Light Editorial (winno) |
| "Tech-vibe, Developer" | Tech-Forward SaaS |
| "Beides — schlicht aber polished" | Hybrid V10 |
| "Magazin / Editorial / Story" | Warm Editorial (world) |
| "Maximum Conversion, Pricing-fokus" | Stripe-Style |
| "Premium, Serif" | NICHT (User mag das nicht) |
| "Conventional Agency" | Hybrid V10 (default) |
