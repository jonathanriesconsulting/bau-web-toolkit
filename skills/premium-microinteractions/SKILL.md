---
name: premium-microinteractions
description: "Premium, disciplined microinteractions for high-end websites: a lerp-followed custom cursor (dot + ring, mix-blend-mode difference), magnetic CTAs (strength ≤0.15), GSAP SplitText line-mask headline reveals, and tasteful hover-states. Vanilla JS/CSS, full a11y (prefers-reduced-motion guards) and touch guards built in. Use when the user asks to add a custom cursor, magnetic button, \"make the headlines animate / split-text reveal\", premium/luxury hover effects, \"make it feel high-end / agency-grade\", or polish microinteractions on a Meisterbetrieb/agency/portfolio site. Massivbau statt Jahrmarkt — one signature move per section, never bouncy."
---

# Premium Microinteractions

Vier disziplinierte Signature-Moves für High-End-Sites: **Custom-Cursor** (Dot + Lerp-Ring, `mix-blend-mode: difference`), **Magnetic Buttons** (strength ≤ 0.15), **GSAP SplitText Line-Mask Headline-Reveals** und seriöse **Hover-States**. Reiner Vanilla-Code, mit Accessibility- und Touch-Guards von Anfang an.

**Leitprinzip: Massivbau statt Jahrmarkt.** Ein Signature-Move pro Sektion. Nichts wackelt, nichts bounct, nichts ist "besessen". Bewegung darf nie der Star sein — sie ist die Politur, die einen Meisterbetrieb von einem Baukasten trennt. Wenn du dich fragst "sieht das edel oder verspielt aus?", ist es schon zu verspielt.

## When to use

- Site soll sich "teuer / agency-grade / high-end" anfühlen, Layout & Inhalt stehen schon.
- Custom-Cursor (Dot folgt 1:1, Ring zieht weich nach), invertiert über dunkle/helle Flächen.
- Magnetic Haupt-CTA (Button zieht den Cursor sanft an).
- Headlines sollen zeilenweise unter einer Maske hochfahren (SplitText line-mask).
- Hover-States für Links/Cards mit Substanz statt Default-`:hover`.
- Desktop-First-Erlebnis mit echtem Touch-Fallback (keine kaputten Mobile-States).

## When NOT to use

- **Touch-only / Mobile-First**: Cursor & Magnetic sind Desktop-Politur. Auf Touch: komplett aus (kein Phantom-Cursor, keine Magnet-Sprünge).
- **Performance-kritisch & Budget-arm**: GSAP+SplitText (~50KB) nur laden, wenn Headline-Reveals wirklich gebraucht werden. Für reine CSS-Hover reicht das CSS unten ohne JS.
- **Schon viel Scroll-Cinema/WebGL aktiv**: nicht stapeln. Ein Signature-Move pro Sektion — siehe `scroll-cinema-patterns`.
- **Behördlich/Form-lastig** (Antrag, Login, Dashboard): hier killt Bewegung Vertrauen. Cursor/Magnetic weglassen.
- `prefers-reduced-motion: reduce` aktiv → der gesamte JS-Layer bleibt aus (siehe Guard unten). Nicht "abgeschwächt", sondern aus.

---

## 1. CDN (aktuelle Versionen)

GSAP **3.15.0** — SplitText ist seit 3.13 **lizenzfrei** (auch für Kunden-Sites). Im Footer, nicht im Boot-Pfad vor LCP.

```html
<!-- ans Ende von <body>, NICHT in <head> vor dem LCP-Bild -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js"></script>
<!-- erst danach das eigene Modul -->
<script src="/assets/js/microinteractions.js" defer></script>
```

---

## 2. Der globale Guard (immer zuerst)

Die CSS-Kill-Switch-Regel fängt **nur CSS-Animationen/Transitions**. JS-getriebene Motion (Cursor-rAF, GSAP, Magnetic) muss **separat** via `matchMedia` geguarded werden — sonst läuft sie trotz `reduce` weiter. WCAG 2.2 SC 2.2.2 / 2.3.3.

```css
/* CSS-Layer: fängt Transitions/Keyframes, NICHT JS */
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

```js
// microinteractions.js — gemeinsamer Einstieg
const REDUCED = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const FINE_POINTER = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
const CAN_ANIMATE = !REDUCED;            // JS-Motion nur ohne reduce
const IS_DESKTOP_INPUT = FINE_POINTER;   // Cursor/Magnetic nur mit echtem Zeiger

if (window.gsap && window.ScrollTrigger) {
  gsap.registerPlugin(ScrollTrigger);
  if (window.SplitText) gsap.registerPlugin(SplitText);
}
```

---

## 3. Custom Cursor (Dot 1:1 + Ring per Lerp, mix-blend difference)

**Regeln aus der Research:**
- Dot folgt **1:1** (direkt in `pointermove`).
- Ring folgt **per `lerp` 0.18 NUR im rAF** — niemals die Lerp-Mathematik in `pointermove` (das ist event-rate-abhängig und ruckelt).
- `transform: translate3d()` (GPU), nie `top/left`.
- `mix-blend-mode: difference` + weiße Elemente → invertiert automatisch über jedem Untergrund.
- **PFLICHT** `@media (hover:hover) and (pointer:fine)` — auf Touch komplett aus.

```css
.cursor-dot,
.cursor-ring {
  position: fixed;
  top: 0;
  left: 0;
  pointer-events: none;
  z-index: 9999;
  border-radius: 50%;
  /* weiß + difference = automatische Invertierung über hell/dunkel */
  mix-blend-mode: difference;
  background: #fff;
  opacity: 0;
  transition: opacity 0.3s ease;
  will-change: transform;
}
.cursor-dot {
  width: 7px;
  height: 7px;
  margin: -3.5px 0 0 -3.5px;
}
.cursor-ring {
  width: 38px;
  height: 38px;
  margin: -19px 0 0 -19px;
  background: transparent;
  border: 1.5px solid #fff;
  /* sanftes Aufskalieren über interaktiven Elementen */
  transition: opacity 0.3s ease, width 0.25s ease, height 0.25s ease,
    margin 0.25s ease, background-color 0.25s ease;
}
.cursor-dot.is-visible,
.cursor-ring.is-visible { opacity: 1; }

/* Ring-State über Links/Buttons: größer + leicht gefüllt */
.cursor-ring.is-hovering {
  width: 60px;
  height: 60px;
  margin: -30px 0 0 -30px;
  background: rgba(255, 255, 255, 0.12);
}

/* Touch / kein feiner Zeiger: Custom-Cursor existiert nicht, Systemcursor bleibt */
@media (hover: none), (pointer: coarse) {
  .cursor-dot, .cursor-ring { display: none !important; }
}

/* Nur wenn Custom-Cursor wirklich aktiv ist (per JS-Klasse), Systemcursor ausblenden */
html.has-custom-cursor,
html.has-custom-cursor a,
html.has-custom-cursor button { cursor: none; }
```

```js
function initCursor() {
  if (!IS_DESKTOP_INPUT || REDUCED) return; // Touch ODER reduce -> Systemcursor behalten

  const dot = document.createElement('div');
  const ring = document.createElement('div');
  dot.className = 'cursor-dot';
  ring.className = 'cursor-ring';
  document.body.append(dot, ring);
  document.documentElement.classList.add('has-custom-cursor');

  let mouseX = window.innerWidth / 2, mouseY = window.innerHeight / 2;
  let ringX = mouseX, ringY = mouseY;
  let visible = false;
  const LERP = 0.18;

  window.addEventListener('pointermove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    // Dot 1:1 — direkt, kein Lerp
    dot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
    if (!visible) {
      visible = true;
      dot.classList.add('is-visible');
      ring.classList.add('is-visible');
    }
  }, { passive: true });

  document.addEventListener('mouseleave', () => {
    dot.classList.remove('is-visible');
    ring.classList.remove('is-visible');
    visible = false;
  });

  // Ring-Lerp NUR im rAF
  function raf() {
    ringX += (mouseX - ringX) * LERP;
    ringY += (mouseY - ringY) * LERP;
    ring.style.transform = `translate3d(${ringX}px, ${ringY}px, 0)`;
    requestAnimationFrame(raf);
  }
  requestAnimationFrame(raf);

  // Ring-State über interaktiven Elementen (Event-Delegation, kein Per-Element-Listener)
  document.addEventListener('pointerover', (e) => {
    if (e.target.closest('a, button, [data-cursor-hover]')) ring.classList.add('is-hovering');
  });
  document.addEventListener('pointerout', (e) => {
    if (e.target.closest('a, button, [data-cursor-hover]')) ring.classList.remove('is-hovering');
  });
}
```

---

## 4. Magnetic Button (NUR Haupt-CTA, strength ≤ 0.15)

**Regeln aus der Research:**
- **Nur der Haupt-CTA.** Magnetic an jedem Link wirkt wie Jahrmarkt.
- `strength` **MAX 0.15**. Alles über 0.3 wirkt "besessen".
- Lerp-Dämpfung im rAF (nicht hart im `mousemove`).
- `mouseleave` → über CSS-Transition sauber zurück auf 0/0.

```css
.magnetic {
  display: inline-block;
  /* Rückweg läuft über diese Transition; während des Magnetisierens überschreibt JS den transform live */
  transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  will-change: transform;
}
.magnetic > span { display: inline-block; } /* optionaler innerer Layer für Gegenbewegung */
```

```js
function initMagnetic() {
  if (!IS_DESKTOP_INPUT || REDUCED) return;

  document.querySelectorAll('[data-magnetic]').forEach((el) => {
    const STRENGTH = Math.min(parseFloat(el.dataset.magnetic) || 0.15, 0.15); // hard cap 0.15
    let rafId = null;
    let tx = 0, ty = 0, cx = 0, cy = 0;

    function loop() {
      // Lerp-Dämpfung -> kein hartes Snappen
      cx += (tx - cx) * 0.2;
      cy += (ty - cy) * 0.2;
      el.style.transform = `translate3d(${cx}px, ${cy}px, 0)`;
      if (Math.abs(tx - cx) > 0.1 || Math.abs(ty - cy) > 0.1) {
        rafId = requestAnimationFrame(loop);
      } else { rafId = null; }
    }

    el.addEventListener('pointermove', (e) => {
      const r = el.getBoundingClientRect();
      tx = (e.clientX - (r.left + r.width / 2)) * STRENGTH;
      ty = (e.clientY - (r.top + r.height / 2)) * STRENGTH;
      el.style.transition = 'none'; // live folgen, Transition aus
      if (!rafId) rafId = requestAnimationFrame(loop);
    });

    el.addEventListener('pointerleave', () => {
      tx = 0; ty = 0;
      el.style.transition = ''; // CSS-Transition übernimmt den Rückweg
      el.style.transform = '';  // -> translate3d(0,0,0) sauber per CSS
      if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
    });
  });
}
```

```html
<a class="magnetic" data-magnetic="0.15" href="#kontakt">Projekt anfragen</a>
```

---

## 5. SplitText Line-Mask Headline-Reveal

**Regeln aus der Research:**
- `type:'lines'` + `mask:'lines'` + `autoSplit:true` → Zeilen fahren unter einer Maske hoch (`yPercent:110`).
- `ease:'expo.out'` (schwer, kontrolliert — kein `back`/`elastic`, das bounct).
- `scrollTrigger` mit `once:true` (Reveal passiert genau einmal).
- **a11y-Pflicht:** Container bekommt `aria-label` mit dem Originaltext — SplitText zerlegt in `<span>`, das wäre für Screenreader sonst Buchstabensalat.

```css
/* Mask braucht overflow:hidden auf den Zeilen-Wrappern — mask:'lines' setzt das selbst,
   aber FOUC verhindern, bis SplitText übernimmt: */
.reveal-lines { visibility: hidden; }
.reveal-lines.is-ready { visibility: visible; }
```

```html
<h2 class="reveal-lines" aria-label="Wir bauen Bestand mit Substanz – Sanierung und Neubau für Berlin und Brandenburg.">
  Wir bauen Bestand mit Substanz – Sanierung und Neubau für Berlin und Brandenburg.
</h2>
```

```js
function initHeadlineReveals() {
  const targets = document.querySelectorAll('.reveal-lines');

  // reduced-motion ODER kein GSAP/SplitText: Text sofort sichtbar, KEINE Animation
  if (REDUCED || !window.gsap || !window.SplitText) {
    targets.forEach((el) => el.classList.add('is-ready'));
    return;
  }

  targets.forEach((el) => {
    el.classList.add('is-ready');
    SplitText.create(el, {
      type: 'lines',
      mask: 'lines',
      autoSplit: true, // re-split bei Resize/Font-Load (verhindert kaputte Zeilen)
      onSplit(self) {
        return gsap.from(self.lines, {
          yPercent: 110,
          duration: 1.05,
          stagger: 0.1,
          ease: 'expo.out',
          scrollTrigger: { trigger: el, start: 'top 88%', once: true },
        });
      },
    });
  });
}
```

---

## 6. Hover-States (CSS-only, kein JS nötig)

Seriöse Hover-Politur ohne Bewegung-um-der-Bewegung-willen. Underline, die sich aufbaut; Card, die nur minimal anhebt.

```css
/* Link-Underline: wächst von links, kein abrupter Default-Underline */
.link-underline {
  position: relative;
  text-decoration: none;
  color: inherit;
}
.link-underline::after {
  content: "";
  position: absolute;
  left: 0; bottom: -2px;
  width: 100%; height: 1px;
  background: currentColor;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.link-underline:hover::after,
.link-underline:focus-visible::after { transform: scaleX(1); }

/* Card: minimale Anhebung, harte Kante statt Bounce */
.card-hover {
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
    border-color 0.4s ease;
}
.card-hover:hover { transform: translateY(-4px); }

/* Tastatur-Fokus immer sichtbar — nie wegoptimieren */
:focus-visible { outline: 2px solid currentColor; outline-offset: 3px; }
```

---

## 7. Boot

```js
document.addEventListener('DOMContentLoaded', () => {
  initCursor();
  initMagnetic();
  initHeadlineReveals();
});
```

---

## WordPress-Einbindung (Classic-Theme)

Im Classic-PHP-Theme über `functions.php` enqueuen — GSAP im Footer (`true`), eigenes Modul abhängig davon. Siehe `wp-classic-onepager` für den Theme-Rahmen.

```php
add_action('wp_enqueue_scripts', function () {
    $gsap = 'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist';
    wp_enqueue_script('gsap',          "$gsap/gsap.min.js",          [], '3.15.0', true);
    wp_enqueue_script('gsap-st',       "$gsap/ScrollTrigger.min.js", ['gsap'], '3.15.0', true);
    wp_enqueue_script('gsap-split',    "$gsap/SplitText.min.js",     ['gsap'], '3.15.0', true);
    wp_enqueue_script(
        'microinteractions',
        get_template_directory_uri() . '/assets/js/microinteractions.js',
        ['gsap', 'gsap-st', 'gsap-split'],
        wp_get_theme()->get('Version'),
        true
    );
});
```

---

## Pitfalls

- **Ring-Lerp im `pointermove` statt im rAF** → ruckelt, weil event-rate-abhängig. Dot 1:1 im `pointermove`, Ring-Lerp **ausschließlich im rAF**.
- **Cursor/Magnetic ohne `(hover:hover) and (pointer:fine)`-Guard** → auf Touch entsteht ein toter Phantom-Cursor in der Ecke und Magnet-Sprünge beim Tap. Touch komplett aus.
- **`cursor: none` global setzen, bevor der Custom-Cursor existiert** → wenn JS fehlschlägt, hat der User gar keinen Cursor. Deshalb `cursor:none` nur unter `html.has-custom-cursor` (die Klasse setzt erst das JS).
- **Magnetic-`strength` > 0.15** → wirkt "besessen" / Jahrmarkt. Hard Cap im Code (`Math.min(..., 0.15)`). Und nur am **Haupt-CTA**, nicht an jedem Link.
- **`mix-blend-mode: difference` + farbiger Cursor** → Invertierung funktioniert nur mit **weißem** Element. Farbe killt den Effekt.
- **SplitText-Container ohne `aria-label`** → Screenreader liest die `<span>`-Zerlegung als Zeichensalat. Originaltext immer als `aria-label` an den Container.
- **CSS-`prefers-reduced-motion`-Block als einzige Absicherung** → der fängt **nur CSS**. Lenis, Cursor-rAF, GSAP, Magnetic laufen trotzdem. Jeder JS-Move braucht den separaten `matchMedia('(prefers-reduced-motion: reduce)')`-Guard und muss bei `reduce` **aus** sein (nicht abgeschwächt).
- **GSAP/SplitText in `<head>` vor dem LCP** → blockiert den Boot-Pfad und killt LCP. Ans Ende von `<body>` bzw. im Footer enqueuen. Siehe `web-performance-vitals`.
- **`ease:'back'` / `'elastic'` bei Headline-Reveals** → bouncet, wirkt billig. `expo.out` ist schwer und kontrolliert — passt zum Meisterbetrieb.
- **`autoSplit:false` lassen** → bei Font-Load/Resize brechen die Zeilen-Masken (Zeilen falsch umbrochen). `autoSplit:true` re-splittet sauber.
- **Per-Element-Hover-Listener für den Cursor-Ring** → bei vielen Links teuer & Leak-anfällig. Event-Delegation über `closest('a, button, ...')`.
- **`once:true` vergessen** → Reveal feuert bei jedem Hoch-/Runterscrollen erneut, wirkt nervös. Genau einmal.
- **Alle Techniken in einer Sektion stapeln** (Cursor + Magnetic + SplitText + Hover-Glow gleichzeitig) → Disziplin verloren. **Ein Signature-Move pro Sektion.**

## Related skills

- **smooth-scroll-gsap-stack** — Lenis 1.3.23 + GSAP/ScrollTrigger in **einer** rAF (`autoRaf:false`, `gsap.ticker.add`). Pflicht-Grundlage, bevor SplitText-ScrollTrigger sauber feuert.
- **web-accessibility-motion** — `prefers-reduced-motion`-Strategie, WCAG 2.2 SC 2.2.2/2.3.3, Fokus-Management, der Unterschied zwischen CSS- und JS-Kill-Switch.
- **web-performance-vitals** — LCP < 2.5s / INP < 200ms / CLS < 0.1; GSAP/Lenis aus dem Boot-Pfad, `fetchpriority`, Font-`size-adjust`.
- **scroll-cinema-patterns** — Sticky-Stage Cinema-Sektionen; nicht mit Microinteractions in derselben Sektion stapeln.
- **wp-classic-onepager** — Classic-PHP-Theme-Rahmen, `functions.php`-Enqueue, Sektion-Pattern für die Einbindung.
- **construction-website-builder** — Domain-Kontext (Meisterbetrieb-Tonalität): hier entscheidet sich, ob Microinteractions "edel" oder "zu verspielt" sind.
- **multi-variant-theme-tokens** — OKLCH-Token-Architektur; der Cursor invertiert via `difference` automatisch über Light/Dark-Varianten.
