---
name: construction-website-builder
description: "Build WordPress Classic-PHP onepager websites for German construction companies (Bauunternehmen, Generalunternehmer, Rohbau-Subunternehmer). Includes the full vertical: target-group differentiation (B2C Familien-Bauherren vs B2B GU-Käufer), section architecture (Hero / Leistungen / Ablauf / Über / FAQ / Kontakt), Schema.org markup (LocalBusiness + GeneralContractor + FAQPage), Local SEO for German cities, bauablauf-storytelling, and trust-signal patterns. Use when building or improving a website for any Bau-/Handwerk-/GU-/Architektur-Kunde, especially in DACH region. Built from 14 PKB iterations + EDI Hochbau implementation (May 2026)."
---

# Construction Website Builder

Specialized skill for German construction industry websites — Bauunternehmen, Generalunternehmer (GU), Rohbau-Subunternehmer, Architekten-Büros, Handwerksbetriebe.

## When to Use

Activate when user wants to build, redesign, or improve:
- Bauunternehmen-Website (private oder gewerblich)
- Generalunternehmer-Onepager
- Rohbau-/Subunternehmer-B2B-Site
- Handwerksbetrieb-Webauftritt
- Sanierung/Modernisierung-Anbieter
- Architektur-/Planungsbüro

Also activate when user mentions: "Pascal Kacemer", "PKB", "EDI Hochbau", "Bauherren-Familien", "GU-Käufer", or any German Bau-Vokabel.

## Core Principle

**Bau-Websites müssen drei Dinge gleichzeitig leisten:**
1. **Vertrauen** vor Verkauf — junge Firmen, hohe Investitionssummen, lange Bauzeit
2. **Tonalität pro Zielgruppe** — Familien wollen anders angesprochen werden als GU-Procurement
3. **Bauablauf-Transparenz** — Bauherren wollen wissen *wie* das ablaufen wird, nicht nur *was* gemacht wird

## The 6-Section Onepager (PKB-validierter Stand)

```
1. HERO           "Was ihr macht + Vertrauen sofort"
2. LEISTUNGEN     "3 klar abgegrenzte Schwerpunkte mit Bildern"
3. ABLAUF         "Vom Auftrag zum Schlüssel" (4 Prozessschritte + ggf. Bauanimation)
4. ÜBER           "Wer der Mensch dahinter ist"
5. FAQ            "Was Bauherren WIRKLICH fragen" (mit Schema.org FAQPage)
6. KONTAKT        "Form + alle Kanäle + Bürozeiten"
```

**Referenzen optional als 5.5 oder eigene Subpage** — bei jungen Firmen oft Placeholder bis echte Projekte da sind.

## WordPress Classic Theme Architecture

**Empfohlene Struktur (PKB V5/V11 validiert):**
```
pkb-theme-vX/
├── functions.php          # Sections-Array, FAQ-Array, Bauphasen-Daten, font enqueue
├── header.php             # Schema.org JSON-LD (LocalBusiness + FAQPage), Nav
├── footer.php             # Kanäle, Rechtliches, Datum
├── front-page.php         # Section-Composition (pkb_section('hero'); etc.)
├── index.php              # Minimal fallback
├── style.css              # Theme-Header + Token-System + alle Styles
├── assets/
│   ├── js/main.js
│   ├── images/
│   └── logo.svg
└── inc/sections/
    ├── hero.php
    ├── leistungen.php
    ├── ablauf.php         # ggf. mit MegaCinema (siehe scroll-cinema-patterns Skill)
    ├── ueber.php
    ├── faq.php
    └── kontakt.php
```

**Sections als modulare Files** ist Gold wert für Iteration — du kannst eine Section komplett rewriten ohne den Rest zu touchen. Front-page.php ist nur eine ~10-Zeilen Composition.

## Detail-Referenzen

Tiefes Wissen liegt in **drei Memory-Files** (im Workspace memory), in Skill-References:

- **`references/sections-blueprint.md`** — Pro Section: was rein muss, welche Trust-Signale, welche Conversion-Trigger
- **`references/schema-org-patterns.md`** — Schema.org JSON-LD für LocalBusiness + GeneralContractor + FAQPage (copy-paste ready)
- **`references/zielgruppen.md`** — B2C Familien vs B2B GU-Käufer Differenzierung (Tonalität, Headlines, FAQ-Themen)
- **`references/bau-vokabular.md`** — Was Bauherren konkret fragen, welche Wörter Vertrauen schaffen, was Floskel ist

## Tools-Stack

**Default für Bau-Onepager:**
- WordPress Classic PHP (NICHT Block-Theme — wp-now-stabiler, ACF-kompatibler, einfacher zu warten)
- wp-now für lokale Entwicklung (ein Theme pro Port)
- Fontshare **Switzer** (Sans) + Google Fonts **JetBrains Mono** (Mono) + optional **PP Editorial New** (Serif für Premium-Look)
- Schema.org JSON-LD im Head
- Keine externen JS-Frameworks — Vanilla JS reicht

## Bauablauf-Storytelling (Killer-Feature)

Das **stärkste Differenzierungsmerkmal** für eine Bau-Website 2026 ist ein scroll-driven Bauablauf — Bauherren sehen das EFH entstehen während sie scrollen.

**Zwei Varianten:**
- **4 Master-Phasen** (Beraten / Entwerfen / Bauen / Schlüsselübergabe) als Full-Bleed Cinema
- **9-12 Bauphasen** (Grundstück → Aushub → Fundament → Rohbau → … → Übergabe) für Detail-Storytelling

Implementierung: siehe `scroll-cinema-patterns` Skill. Bilder generieren: siehe `ai-image-sequence` Skill.

## Conversion-Patterns für Bau

**Above-the-fold MUSS haben:**
- Klare Aussage „was wir bauen" (Sanierung? EFH? MFH?)
- Region („Düsseldorf + 60 km" oder „Berlin & Brandenburg")
- Ein direktes Trust-Signal („16 Jahre" / „Meisterbrief" / „KfW-Effizienzhausstandard")
- Telefonnummer **klickbar** als `tel:`-Link (Mobile-Conversion-Killer #1 wenn nicht)
- CTA „Erstgespräch vereinbaren" — kostenlos + 30 min → niedrige Hürde

**Vermeiden:**
- „Innovative Lösungen für Ihr Bauprojekt" (Floskel-Tod)
- Vage Preise — lieber „ab 1.800 €/m²" als „individuell"
- Stock-Photos (Bauherren erkennen das, killt Vertrauen)
- „Wir helfen Ihnen wachsen" (B2B-Sprech bei B2C-Zielgruppe)

## SEO-Quick-Wins (Detail in knowledge_seo_construction.md)

**Schema.org (immer rein):**
```json
{
  "@type": ["LocalBusiness", "GeneralContractor"],
  "name": "...",
  "areaServed": ["Stadt1", "Stadt2", ...],
  "founder": { "@type": "Person", ... },
  "knowsAbout": ["Sanierung", "KfW-Effizienzhaus", ...]
}
```

**Local SEO:**
- Google Business Profile pro Standort
- Stadt-Keywords im H1 + Meta-Description
- `areaServed` mit allen relevanten Städten im Schema
- NAP (Name/Address/Phone) konsistent über alle Touchpoints

**Long-Tail-Keywords (Bauherren-Suchen):**
- „Generalunternehmer [Stadt] Einfamilienhaus"
- „Sanierung [Stadt] Kosten pro m²"
- „KfW-Effizienzhaus [Stadt] Bauunternehmen"
- „Bauherren-Beratung [Stadt] kostenlos"

## Common Pitfalls

1. **„Zu KI-mäßig"** — User-Feedback bei PKB. Lösung: weniger Glas/Effekte, mehr Hairlines, konkrete Fotos statt Stock, schlichtere Typo (Switzer statt Bricolage mit 3 Axes).

2. **Zu viel Auswahl beim Vater-Test** — wenn man 5+ Versionen baut, kann der Entscheider nicht mehr wählen. Max 3 Versionen mit **klar unterschiedlichen Polen** (z. B. hell / Sans / Serif).

3. **Italic-Verwendung** — User-Veto bei vielen Bauherren. Italic-Hervorhebung in Headlines wirkt schnell „werblich" statt „handwerklich". Lieber unterschiedlicher Color/Weight.

4. **Theme-Aktivierungs-Problem mit wp-now** — manchmal lädt WordPress Default-Theme statt Custom. Fix: SQLite-Cache löschen (`~/.wp-now/wp-content/THEME-HASH/database/`) und wp-now neu starten.

5. **Frosted-Glass überdosieren** — sieht auf Demo cool aus, aber bei realen Bauherren-Inhalten (viel Text, ältere Zielgruppe) anstrengend. Solid-Cards mit Hairlines sind sicherer.

## Workflow Best Practice

**Empfohlener Build-Loop für Bau-Themes:**

1. **Discovery** — Zielgruppe? B2C oder B2B? Echte Stats? Echte Fotos?
2. **Sections-Skelett** — modular anlegen (`/inc/sections/`)
3. **Token-System** — Color + Typo + Spacing variables, **bevor** Komponenten gebaut werden
4. **Hero** zuerst — das ist 60% der Wirkung
5. **Bauablauf-Cinema** zweites Highlight (siehe scroll-cinema-patterns Skill)
6. **Echter Content** rein, nicht Lorem
7. **Schema.org** früh integrieren (nicht am Ende)
8. **3 Versionen parallel** wenn Kundenentscheidung nötig — auf eigene Ports, jeder Stand isoliert

## Static-Export für Kundenvorschau

Wenn Kunde Vorschau braucht **offline weitergebbar**:

```bash
PAPA=/Users/jonathanries/Documents/Websites/PROJEKT/papa-preview
mkdir -p "$PAPA"/01-name
curl -s http://localhost:8885/ > "$PAPA/01-name/index.html"
cp -R THEME/assets "$PAPA/01-name/"
cp THEME/style.css "$PAPA/01-name/"
sed -i '' "s|http://localhost:8885/wp-content/themes/THEME/|./|g" "$PAPA/01-name/index.html"
sed -i '' "s|http://localhost:8885/|./|g" "$PAPA/01-name/index.html"
```

Plus eine **Auswahl-Seite `index.html`** im Root mit Cards die zu den Versionen verlinken.

## Related Skills + Memory

- **`scroll-cinema-patterns`** Skill — für die Bauablauf-Animation
- **`ai-image-sequence`** Skill — für konsistente Bauphasen-Bilder (Nano Banana / Gemini Flow)
- **`agency-website-builder`** Skill — verwandte aber breitere Domain (Agentur statt Bau)
- Workspace Memory `knowledge_seo_construction.md` — Local SEO Berlin/Brandenburg, Long-Tail
- Workspace Memory `knowledge_copywriting_construction.md` — Tonalität pro Zielgruppe, Headline-Frameworks
- Workspace Memory `knowledge_design_patterns.md` — V5-V14 Theme-DNA, Komponenten-Bibliothek
