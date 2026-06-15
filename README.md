# Bau-Web-Toolkit

**Award-Tier Web-Engineering für deutsche Bauunternehmen — als wiederverwendbares Skill- & Wissens-System.**

Dieses Repository bündelt das gesamte angesammelte Wissen aus 14+ PKB-Iterationen, dem EDI-Hochbau-Build und einer 21-Agenten-Web-Research (2026) in **22 Claude-Code-Skills**, einer konsolidierten **Learning.md**, der **Research-Synthese** und dem lauffähigen **Theme-Code** (PKB v15 / v16, EDI).

Ziel: Jede zukünftige Bau-/Agency-Website startet nicht bei null, sondern auf dem erarbeiteten Niveau — von SEO-Schema über Copy-Frameworks bis zum Lenis+GSAP-Motion-Stack. **Leitlinie durchgehend: „Massivbau statt Jahrmarkt" — ein Signature-Move pro Sektion, seriös statt verspielt.**

---

## Struktur

```
_knowledge-repo/
├── skills/        22 Claude-Code-Skills (SKILL.md je Verzeichnis)
├── knowledge/     Learning.md — 7-Kapitel-Konsolidierung
├── research/      award-web-toolkit-2026.md — Web-Research-Synthese
└── themes/        Lauffähiger Theme-Code (PHP/CSS/JS, ohne Binär-Assets)
    ├── pkb-v15-final/      Hell, Großbau-Positionierung, mobil optimiert
    ├── pkb-v16-bombastic/  + Lenis/GSAP-Award-Stack (Preloader, Cursor, SplitText)
    └── edi-theme/          B2B-Rohbau, Dark+Gold
```

> **Hinweis:** Binär-Assets (Bilder, Frame-Sequenzen, Logos, ZIPs) sind via `.gitignore` ausgeschlossen — das Repo enthält Code & Wissen, keine schweren Medien.

---

## Die 22 Skills

### Award-Tier Web-Stack (neu, aus Research 2026)
| Skill | Zweck |
|---|---|
| **award-web-techniques** | Master-Index: 16-Techniken-Toolkit, Entscheidungsbaum „kompetent → award-würdig" |
| **smooth-scroll-gsap-stack** | Lenis 1.3.23 + GSAP 3.15 in **einer** rAF — ticker-sync, pin/scrub, SplitText |
| **premium-microinteractions** | Custom-Cursor (Dot+Ring), Magnetic-CTA (≤0.15), Hover-States, voll a11y |
| **premium-preloader-intro** | Counter-Preloader 000→100, sessionStorage-Gate, Curtain-Reveal, Failsafe |
| **web-performance-vitals** | Core Web Vitals 2026 — AVIF→WebP→JPG, fetchpriority, Font-CLS, LCP/INP/CLS |
| **web-accessibility-motion** | WCAG 2.2 für Motion — reduced-motion JS-Guards, Focus, ARIA, SplitText-a11y |
| **view-transitions-web** | Native View Transitions API — same-document & MPA, Shared-Element-Morph |
| **webgl-canvas-ambient** | Dezenter monochromer Ambient-Layer (CSS-Blobs → 2D-Mesh → simplex-noise) |
| **modern-css-2026** | OKLCH-Token-System, Bento (`gap:1px`), Subgrid, Container-Queries, Marquee |
| **count-up-and-reveal-utils** | Count-up (de-DE, easeOutExpo), SVG-Line-Draw, Clip-Path-Reveal, Stagger |

### Bau-Domäne (DACH)
| Skill | Zweck |
|---|---|
| **construction-website-builder** | WP-Classic-Onepager für Bau — B2C vs. B2B, Sektion-Architektur, Trust |
| **construction-website-de** | Deutscher Alias-Trigger → `construction-website-builder` |
| **construction-seo-german** | Schema.org GeneralContractor, Local SEO Berlin/Brandenburg, Long-Tails |
| **construction-copywriting-german** | Tonalität pro Zielgruppe, Headline-Frameworks, Anti-Floskel-Liste, CTAs |

### Generische Web-Skills
| Skill | Zweck |
|---|---|
| **agency-website-builder** | High-Converting Agency/B2B-Sites (Linear/Vercel/Resend-Vibe) |
| **landingpage-builder** | Daten-getriebene Nischen-Landingpages, ein Template → N Varianten |
| **frontend-design** | Distinctive, production-grade UI ohne „AI-Slop"-Ästhetik |
| **ui-ux-pro-max** | UI/UX-Intelligenz: Styles, Paletten, Font-Pairings, UX-Guidelines |
| **multi-variant-theme-tokens** | 3+ Farb-Varianten via CSS-Token-Flip, 5 validierte Paletten |
| **wp-classic-onepager** | WP Classic PHP Theme-Workflow mit wp-now (kein FSE/Block) |
| **scroll-cinema-patterns** | Sticky-Stage Cinema (Classic + Mega-Cinema), vanilla HTML/CSS/JS |
| **ai-image-sequence** | Konsistente Frame-Sequenzen mit AI (Nano Banana / Veo / Midjourney cref) |

---

## Verwendung als Claude-Code-Skills

Die Skills liegen parallel in `~/.claude/skills/` und werden von Claude Code automatisch erkannt. Trigger erfolgt über die `description` jeder `SKILL.md` — z. B. „mach das award-würdig", „add smooth scrolling", „SEO für mein Bauunternehmen", „Preloader bauen".

Zum Einspielen auf einer neuen Maschine:
```bash
cp -r skills/* ~/.claude/skills/
```

---

## Tech-Stack-Ground-Truths (2026)

- **Lenis** `1.3.23` — `https://unpkg.com/lenis@1.3.23/dist/lenis.min.js` (+ `lenis.css`)
- **GSAP** `3.15.0` + ScrollTrigger + **SplitText** (lizenzfrei seit 3.13) — `https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/`
- **Eine rAF:** `gsap.ticker.add(t => lenis.raf(t*1000))` + `lenis.on('scroll', ScrollTrigger.update)` + `lagSmoothing(0)`, Lenis `autoRaf:false`, `lerp:0.09` (schwer/kontrolliert)
- Lenis ist transform-frei → `position:sticky/fixed` bleibt intakt (ScrollSmoother NICHT nutzen)
- **Reduced-Motion:** CSS-Kill-Switch deckt nur CSS — Lenis/Canvas/GSAP brauchen **separaten** `matchMedia`-Guard

Vollständige Synthese: [`research/award-web-toolkit-2026.md`](research/award-web-toolkit-2026.md).

---

## Quellen

- **Learning.md** — 7 Kapitel: Projekt-Kontext, SEO, Copywriting, Design-Patterns/Tokens, WP-Workflow, Scroll-Cinema/AI-Frames, Stock-Images/Distribution
- **Research** — 21-Agenten-Web-Sweep (Awwwards/FWA-Niveau, Web-Vitals, View-Transitions-Baseline, GSAP/Lenis)
- **Praxis** — 14 PKB-Iterationen (V1–V16) + EDI-Hochbau-Build, Mai/Juni 2026

---

*Privates Repository — enthält projektbezogenes Wissen zu Kundenprojekten (PKB, EDI).*
