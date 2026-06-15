---
name: web-performance-vitals
description: "Core Web Vitals 2026 (LCP/INP/CLS) für premium-animierte Sites, die trotz GSAP + Lenis schnell bleiben müssen. Deckt AVIF→WebP→JPG picture-Kaskade, die Ein-Hero-Bild-fetchpriority-Regel, Font-preload + size-adjust gegen CLS, JS defer/Footer-Loading, kritisches CSS, und WordPress-enqueue-Hinweise. Use when the user asks to \"improve Core Web Vitals\", \"fix LCP / INP / CLS\", \"make the site faster\", \"lighthouse / pagespeed score verbessern\", \"site loads slow but has lots of animations\", \"responsive images / AVIF / srcset\", \"font flash / layout shift\", or \"GSAP/Lenis slowing down the page\". Built from 21-agent web research 2026."
---

# web-performance-vitals

Core Web Vitals 2026 für Sites, die gleichzeitig premium-animiert (GSAP, Lenis, Custom-Cursor, WebGL-Ambient) **und** schnell sein müssen. Die Botschaft: Animation ist kein Performance-Freibrief. Ein Meisterbetrieb baut eine Seite, die in unter 2,5 s steht — nicht eine, die nach 5 s endlich aufhört zu wackeln. Massivbau statt Jahrmarkt: Du legst zuerst ein schnelles, stabiles Fundament (LCP/CLS), und erst danach kommt die Bewegung obendrauf — defer, nach LCP, gegated.

**Die drei Metriken 2026 (Schwellen für "good"):**
- **LCP < 2,5 s** — Largest Contentful Paint. Fast immer das Hero-Bild oder die Hero-Headline.
- **INP < 200 ms** — Interaction to Next Paint. **Hat FID seit März 2024 ersetzt.** Misst die Antwortlatenz über die *gesamte* Session, nicht nur den ersten Klick. Long-Tasks von GSAP/Lenis im Hauptthread sind hier der Killer.
- **CLS < 0,1** — Cumulative Layout Shift. Bilder ohne Dimensionen, spät ladende Webfonts, injizierte Banner.

## When to use / When NOT to use

**Use when:**
- Eine premium-animierte Site lädt langsam oder hat schlechte Lighthouse/PageSpeed-Werte.
- LCP, INP oder CLS sind im Roten/Gelben (CrUX, Lighthouse, web-vitals.js).
- Du Hero-Bilder, responsive `<picture>`/`srcset`, AVIF/WebP einrichtest.
- Font-Flash (FOUT/FOIT) oder Layout-Shift beim Laden auftritt.
- GSAP/Lenis/Cursor/WebGL den Boot-Pfad blockieren.
- Du eine WordPress-Classic-Theme `functions.php` für korrektes Enqueue/Preload optimierst.

**Do NOT use when:**
- Es um Backend-/Server-Latenz (TTFB, DB-Queries, Caching-Layer) geht — das ist Hosting/Backend, nicht dieser Skill.
- Du die *Animationen selbst* bauen willst → `smooth-scroll-gsap-stack`, `premium-microinteractions`, `scroll-cinema-patterns`.
- Es rein um Reduced-Motion-/A11y-Gating geht → `web-accessibility-motion`.

Die eiserne Reihenfolge: **erst messen, dann das LCP-Bild fixen, dann CLS, dann JS aus dem Boot-Pfad ziehen.** INP zuletzt, weil es am schwersten zu sehen ist.

---

## 1. LCP: Das Hero-Bild zuerst über die Ziellinie

### Die Ein-Hero-Bild-Regel (die wichtigste Zeile dieses Skills)

**GENAU EIN Bild pro Seite bekommt `fetchpriority="high"`.** Mehrere `fetchpriority="high"` heben sich gegenseitig auf — der Browser kann nicht "alles zuerst" laden, und du hast die Priorisierung verschenkt. Das eine Bild ist der LCP-Kandidat: in 95 % der Fälle das Hero-Bild above the fold.

**Das Hero-Bild bekommt NIEMALS `loading="lazy"`.** Lazy-Loading verzögert den Fetch bis nach dem Layout — das ist der direkteste LCP-Killer überhaupt. `lazy` ist für alles *unterhalb* des Folds.

```html
<!-- HERO: das eine priorisierte Bild. AVIF → WebP → JPG Kaskade. -->
<picture>
  <source
    type="image/avif"
    srcset="/img/hero-800.avif   800w,
            /img/hero-1200.avif 1200w,
            /img/hero-1600.avif 1600w,
            /img/hero-2000.avif 2000w"
    sizes="100vw">
  <source
    type="image/webp"
    srcset="/img/hero-800.webp   800w,
            /img/hero-1200.webp 1200w,
            /img/hero-1600.webp 1600w,
            /img/hero-2000.webp 2000w"
    sizes="100vw">
  <img
    src="/img/hero-1200.jpg"
    srcset="/img/hero-800.jpg   800w,
            /img/hero-1200.jpg 1200w,
            /img/hero-1600.jpg 1600w,
            /img/hero-2000.jpg 2000w"
    sizes="100vw"
    width="1600" height="900"
    alt="Sanierter Altbau in Berlin-Prenzlauer Berg, Fassade nach Komplettsanierung"
    fetchpriority="high"
    decoding="async">
  <!-- KEIN loading="lazy" hier. width+height PFLICHT gegen CLS. -->
</picture>
```

Vier Punkte, die zusammengehören:
1. **AVIF → WebP → JPG**: Der Browser nimmt das erste `<source>`, das er versteht. AVIF ist ~30–50 % kleiner als JPG bei gleicher Qualität, WebP der breite Fallback, JPG die Versicherung. Reihenfolge im Markup = Präferenz.
2. **`srcset` mit 800/1200/1600/2000w**: Ein Phone lädt nicht 2000px. Ohne `srcset` schickst du Retina-Desktop-Bytes an alle.
3. **`width` + `height` als Attribute**: Reserviert den Platz → kein CLS, wenn das Bild ankommt. CSS macht es danach responsive (`img{max-width:100%;height:auto}`).
4. **`fetchpriority="high"` + kein `lazy`**: Nur auf diesem einen Bild.

### Preload als Ergänzung (optional, mit Kalkül)

Ein `<link rel="preload">` im `<head>` startet den Fetch noch vor dem Parser-Treffer auf das `<img>`. Bei großen Hero-Bildern kann das 100–300 ms LCP bringen. **Vorsicht bei responsivem Preload** — sonst lädst du das falsche `srcset`-Bild doppelt:

```html
<head>
  <link rel="preload" as="image"
    href="/img/hero-1200.avif"
    type="image/avif"
    imagesrcset="/img/hero-800.avif 800w, /img/hero-1200.avif 1200w, /img/hero-1600.avif 1600w, /img/hero-2000.avif 2000w"
    imagesizes="100vw"
    fetchpriority="high">
</head>
```

Faustregel: Preload nur, wenn das Hero-Bild via CSS-`background-image` oder erst spät im DOM kommt. Steht ein normales `<img fetchpriority="high">` ganz oben im Markup, reicht das meistens — dann ist Preload Doppelarbeit.

---

## 2. CLS: Layout-Shift killen, bevor er entsteht

### Fonts: preload + `size-adjust` Fallback (der CLS-Klassiker)

Webfont kommt spät → Text springt vom Fallback auf den Webfont → CLS. Zwei Maßnahmen:

```html
<!-- 1. Webfont preloaden (nur die Schnitte, die above the fold sichtbar sind) -->
<link rel="preload" as="font" type="font/woff2"
      href="/fonts/Geist-Regular.woff2" crossorigin>
<link rel="preload" as="font" type="font/woff2"
      href="/fonts/Geist-Medium.woff2" crossorigin>
```

```css
/* 2. Echter Webfont mit font-display:swap */
@font-face{
  font-family:"Geist";
  src:url("/fonts/Geist-Regular.woff2") format("woff2");
  font-weight:400; font-style:normal;
  font-display:swap;
}

/* 3. size-adjust-Fallback: macht den System-Fallback metrisch deckungsgleich
   mit dem Webfont → beim Swap springt NICHTS. Werte per Tool ermitteln
   (Capsize / Fontaine), nicht raten. */
@font-face{
  font-family:"Geist-fallback";
  src:local("Arial");
  size-adjust:97.4%;
  ascent-override:92%;
  descent-override:24%;
  line-gap-override:0%;
}

:root{ --font-sans:"Geist","Geist-fallback",system-ui,sans-serif; }
body{ font-family:var(--font-sans); }
```

`crossorigin` beim Font-Preload ist **Pflicht** — ohne lädt der Browser die Datei ein zweites Mal (Fonts werden anonym/CORS gefetcht). Vergisst man es, sieht man im Network-Tab denselben Font doppelt.

### Weitere CLS-Quellen

- **Jedes** `<img>` und `<video>` braucht `width`/`height` (oder `aspect-ratio` in CSS). Nicht nur das Hero-Bild.
- Embeds (Maps, iFrames) in einen Container mit fixer `aspect-ratio` packen.
- Banner/Cookie-Hinweise: Platz via `min-height` reservieren oder als Overlay (`position:fixed`) — nie in den Flow injizieren und Inhalt nach unten schieben.
- Animations-Reveals (SplitText, fade-in) ausschließlich mit `transform`/`opacity` — **nie** mit `height`/`top`/`margin`, das verschiebt Nachbar-Elemente. `transform` triggert keinen Reflow.

---

## 3. JS aus dem Boot-Pfad: GSAP & Lenis schnell halten

### CDN-URLs (aktuelle Versionen)

```html
<!-- GSAP 3.15.0 — SplitText ist seit 3.13 LIZENZFREI, auch für Kunden-Sites -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js" defer></script>

<!-- Lenis 1.3.23 — CSS nicht vergessen -->
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css">
<script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js" defer></script>
```

**Alle Animations-Skripte mit `defer` und ganz unten / im Footer enqueuen.** Niemals GSAP/Lenis render-blocking in den `<head>` ohne `defer` — sie gehören nicht in den kritischen Pfad vor LCP. Der Browser soll zuerst HTML parsen, Hero-Bild + Font holen, LCP malen — *dann* die Bibliothek ausführen.

`defer` garantiert dabei: (a) Skripte blockieren den Parser nicht, (b) sie laufen erst nach `DOMContentLoaded`, (c) in Reihenfolge — GSAP also vor ScrollTrigger vor deinem Init-Skript.

### Die EINE rAF-Schleife (Lenis + GSAP korrekt verheiraten)

Zwei requestAnimationFrame-Loops (eine von Lenis, eine von GSAP) konkurrieren um den Hauptthread → ruckelnde Frames, schlechter INP. Lösung: **eine einzige Schleife**, von GSAP's Ticker getrieben.

```js
gsap.registerPlugin(ScrollTrigger, SplitText);

// 1. Lenis OHNE eigene rAF (autoRaf:false). lerp 0.09 = schwer/kontrolliert.
//    NICHT 0.12 — das wirkt bouncy/billig. Lenis ist transform-FREI →
//    sticky/fixed bleiben intakt. ScrollSmoother NICHT nutzen (translate bricht sticky).
const lenis = new Lenis({ lerp: 0.09, autoRaf: false });

// 2. Lenis-Scroll an ScrollTrigger koppeln
lenis.on('scroll', ScrollTrigger.update);

// 3. EINE rAF: GSAP-Ticker treibt Lenis (Sekunden → Millisekunden)
gsap.ticker.add((time) => lenis.raf(time * 1000));

// 4. lagSmoothing aus, sonst springt Lenis nach Tab-Wechsel/Jank
gsap.ticker.lagSmoothing(0);
```

Diese vier Zeilen sind der gesamte Trick. Eine Schleife, ein Frame-Budget, vorhersagbarer Hauptthread → gut für INP.

### INP schützen: Hauptthread nicht zumüllen

- ScrollTrigger-Animationen ausschließlich auf `transform`/`opacity` (GPU-compositable, kein Layout/Paint im Hauptthread).
- Teure Berechnungen (Bounding-Boxes, SplitText-Recompute) niemals in `pointermove`/`scroll`-Handler — diese feuern dutzendfach pro Sekunde. Werte im **rAF** lerpen (Custom-Cursor-Ring, Magnetic-CTA), nicht im Event.
- `ScrollTrigger.config({ ignoreMobileResize: true })` gegen Reflow-Storms beim Adressleisten-Hide/Show auf Mobile.
- Bei vielen Triggern: am Ende `ScrollTrigger.refresh()` *einmal* nach Font-/Bild-Load, nicht pro Element.

---

## 4. WebGL/Canvas-Ambient ohne Performance-Bankrott

Ambient-Hintergründe (Gradient-Mesh, Blobs) sind ein Dauer-rAF — das kostet permanent Frame-Budget. Disziplin:

```js
// simplex-noise 4.0.3 (ESM), ~3KB. Subtiler monochromer Mesh, NIE der Star.
import { createNoise3D } from 'https://cdn.jsdelivr.net/npm/simplex-noise@4.0.3/dist/esm/simplex-noise.js';

const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
const noise3D = createNoise3D();
let raf;

function loop(t){
  // ... glacial speed, opacity .35-.55, globalCompositeOperation = 'multiply'
  raf = requestAnimationFrame(loop);
}

// reduced-motion → EIN statischer Frame, keine Schleife
if (reduce) { drawStaticFrame(); }
else { loop(0); }

// Tab unsichtbar → Schleife anhalten (spart Akku + Hauptthread)
document.addEventListener('visibilitychange', () => {
  if (document.hidden) cancelAnimationFrame(raf);
  else if (!reduce) loop(0);
});
```

Performance-Regeln für Ambient-WebGL/Canvas: Canvas auf Containergröße begrenzen (nicht 4K-DPR rendern — `devicePixelRatio` auf max 1.5 cappen), `globalCompositeOperation='multiply'` statt teurer Blur-Filter, bei `prefers-reduced-motion` ein statischer Frame. Und: das Ambient-Canvas zählt **nicht** als LCP-Kandidat — es darf den Hero nie überlagern und den LCP-Paint verzögern.

---

## 5. Kritisches CSS inline

Render-blocking ist genau das CSS, das above the fold gebraucht wird. Inline das Minimum im `<head>`, lade den Rest async:

```html
<head>
  <!-- Kritisches CSS inline: Hero-Layout, Typo, Tokens, Hero-Bild-Sizing -->
  <style>
    :root{--l-bg:0.985;--neutral-h:250;--neutral-c:0.006;
           --c-bg:oklch(var(--l-bg) var(--neutral-c) var(--neutral-h));}
    *{margin:0;box-sizing:border-box}
    body{background:var(--c-bg);font-family:var(--font-sans);}
    .hero{min-height:100svh;display:grid;place-items:center}
    .hero img{width:100%;height:100%;object-fit:cover}
    /* nur was den ersten Viewport rendert */
  </style>

  <!-- Rest des CSS async, nicht render-blocking -->
  <link rel="preload" href="/css/main.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="/css/main.css"></noscript>
</head>
```

Das `preload`+`onload`-Pattern lädt `main.css` parallel ohne zu blockieren und hängt es ein, sobald da. `<noscript>`-Fallback für JS-off. Inline-CSS klein halten (Ziel < 14 KB, ein TCP-Roundtrip) — sonst frisst es den Vorteil wieder auf.

---

## 6. WordPress: Enqueue & Preload korrekt

In Classic-Themes alles über `wp_enqueue_*` — nie `<script>` hart ins Template. So bekommst du `defer`, Footer-Position und Preload sauber:

```php
<?php
// functions.php

add_action('wp_enqueue_scripts', function () {
    // GSAP/Lenis im FOOTER (true) → nicht im Boot-Pfad vor LCP
    wp_enqueue_script('gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js',
        [], null, true);
    wp_enqueue_script('gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js',
        ['gsap'], null, true);
    wp_enqueue_script('lenis',
        'https://unpkg.com/lenis@1.3.23/dist/lenis.min.js',
        [], null, true);

    // Eigenes Init-Skript NACH den Libs
    wp_enqueue_script('theme-motion',
        get_theme_file_uri('/assets/js/motion.js'),
        ['gsap', 'gsap-scrolltrigger', 'lenis'], null, true);

    wp_enqueue_style('lenis-css',
        'https://unpkg.com/lenis@1.3.23/dist/lenis.css', [], null);
    wp_enqueue_style('theme-main',
        get_theme_file_uri('/assets/css/main.css'), [], null);
});

// defer auf die Animations-Skripte (WP <6.3: per Filter; ab 6.3: 'strategy')
add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['gsap','gsap-scrolltrigger','lenis','theme-motion'], true)) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}, 10, 2);

// Hero-Bild-Preload + Font-Preload in den <head>
add_action('wp_head', function () {
    echo '<link rel="preload" as="image" href="' . esc_url(get_theme_file_uri('/assets/img/hero-1200.avif')) . '" type="image/avif" imagesrcset="' . esc_attr(get_theme_file_uri('/assets/img/hero-800.avif')) . ' 800w, ' . esc_attr(get_theme_file_uri('/assets/img/hero-1600.avif')) . ' 1600w" imagesizes="100vw" fetchpriority="high">' . "\n";
    echo '<link rel="preload" as="font" type="font/woff2" href="' . esc_url(get_theme_file_uri('/assets/fonts/Geist-Regular.woff2')) . '" crossorigin>' . "\n";
}, 1); // Priorität 1 = so früh wie möglich im head
```

Ab WordPress 6.3 geht `defer` nativer über das `strategy`-Argument von `wp_enqueue_script` (`['strategy' => 'defer', 'in_footer' => true]`). Der Filter oben ist der robuste Weg, der auch auf älteren Cores greift.

WordPress-Hinweise:
- Standard-WP setzt `loading="lazy"` automatisch auf *alle* Bilder ab dem zweiten — das Hero-Bild musst du davon ausnehmen (`loading="eager"` + `fetchpriority="high"` im Template oder via `wp_get_attachment_image`-Attributen).
- Emoji-Script und oEmbed raushängen, wenn ungenutzt (`remove_action('wp_head','print_emoji_detection_script',7)`).
- Keine zwei jQuery-Versionen — GSAP braucht kein jQuery.

---

## Pitfalls

- **Mehrere `fetchpriority="high"` Bilder.** Sie neutralisieren sich — der Browser priorisiert dann effektiv nichts. **Genau eines** pro Seite, das ist der LCP-Kandidat.
- **`loading="lazy"` auf dem Hero-Bild.** Direkter LCP-Killer: der Fetch wartet bis nach dem Layout. Hero ist immer `eager`. Lazy nur unterhalb des Folds.
- **Webfont ohne `size-adjust`-Fallback.** Reines `font-display:swap` tauscht — und beim Tausch springt der Text (CLS). Erst der metrisch angepasste Fallback macht den Swap unsichtbar.
- **Font-Preload ohne `crossorigin`.** Datei wird doppelt geladen. Immer `crossorigin` bei `as="font"`.
- **GSAP/Lenis ohne `defer` im `<head>`.** Blockiert den Parser, verzögert LCP. Defer + Footer, immer. Sie gehören nicht in den Pfad vor dem ersten Paint.
- **Zwei rAF-Schleifen.** Lenis mit eigenem `autoRaf:true` *neben* dem GSAP-Ticker → Frame-Konkurrenz, INP-Schaden. Genau eine Schleife: `autoRaf:false` + `gsap.ticker.add(t=>lenis.raf(t*1000))`.
- **`lerp:0.12` statt `0.09`.** Wirkt bouncy/billig — Jahrmarkt. 0.09 ist schwer/kontrolliert, passt zum Meisterbetrieb.
- **ScrollSmoother für Smooth-Scroll.** Nutzt `translate` auf dem Wrapper → bricht *jedes* `position:sticky`/`fixed`. Lenis ist transform-frei und lässt sticky intakt. ScrollSmoother nicht verwenden.
- **`prefers-reduced-motion` nur via CSS.** Der CSS-Kill-Switch (`*{animation-duration:.01ms!important;…}`) fängt **nur CSS**. Lenis, canvas-rAF, GSAP-Timelines und `scrollIntoView({behavior:'smooth'})` laufen weiter — die musst du separat per `matchMedia('(prefers-reduced-motion: reduce)')` guarden. WCAG 2.2 SC 2.2.2 / 2.3.3.
- **`width`/`height` nur auf dem Hero vergessen.** *Jedes* Bild/Video unter dem Fold ohne Dimensionen produziert CLS, sobald es nachlädt.
- **Ambient-Canvas auf voller DPR.** 4K-Retina-Render eines "subtilen" Hintergrunds frisst Frame-Budget für nichts. DPR auf ~1.5 cappen, bei `reduced-motion` ein statischer Frame, bei `visibilitychange` pausieren.
- **Kritisches CSS zu groß.** Mehr als ~14 KB inline frisst den Vorteil des ersparten Roundtrips wieder auf. Nur den ersten Viewport inlinen.
- **FAQ-Schema als LCP-Hebel missverstehen.** SEO ist nicht Performance — aber Merke fürs Gesamtbild: FAQ-Rich-Results sind seit 7. Mai 2026 abgeschaltet; FAQ kurz halten, das spart auch DOM-Gewicht. (Schema-Details → `construction-seo-german`.)

---

## Messen (immer zuerst und zuletzt)

```js
// web-vitals lädt asynchron, misst FELDDATEN (echte User), nicht Labor
import {onLCP, onINP, onCLS} from 'https://unpkg.com/web-vitals@4?module';
onLCP(console.log);  // Ziel < 2500 ms
onINP(console.log);  // Ziel < 200 ms
onCLS(console.log);  // Ziel < 0.1
```

Lighthouse (Labor) zum Iterieren, **CrUX/web-vitals.js (Feld)** für die Wahrheit. INP siehst du im Labor kaum — nur echtes Klick-/Scroll-Verhalten deckt es auf. Reihenfolge beim Optimieren: messen → LCP-Bild → CLS (Fonts/Dimensionen) → JS defer → INP-Long-Tasks → erneut messen.

---

## Related skills

- **smooth-scroll-gsap-stack** — der vollständige Lenis+GSAP+ScrollTrigger-Setup (SplitText-line-masks, ScrollTrigger-Patterns). Dieser Skill sorgt dafür, dass dieser Stack *schnell bleibt*.
- **premium-microinteractions** — Custom-Cursor, Magnetic-CTA, Count-up, Marquee. Performance-Disziplin (rAF-lerp statt Event-Handler) ist hier verlinkt.
- **web-accessibility-motion** — `prefers-reduced-motion`-Gating für JS-Motion, WCAG 2.2 SC 2.2.2/2.3.3. Direkte Ergänzung zum Reduced-Motion-Pitfall oben.
- **wp-classic-onepager** — der WordPress-Classic-Theme-Workflow, in den die `functions.php`-Enqueue/Preload-Patterns dieses Skills einfließen.
- **construction-website-builder** — Domänen-Kontext (B2C/B2B-Bau-Sites), für die dieser Performance-Stack typischerweise gebaut wird.
