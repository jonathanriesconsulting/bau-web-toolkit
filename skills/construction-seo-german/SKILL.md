---
name: construction-seo-german
description: "SEO für deutsche Bauunternehmen (B2C Generalunternehmer & B2B Rohbau-Subunternehmer). DACH-Region, Local SEO Berlin/Brandenburg/Köln/München, Schema.org GeneralContractor + LocalBusiness + FAQPage, Long-Tail-Keywords pro Zielgruppe, Google Business Profile Optimization, Konkurrenz-Audit (Roth-Massivhaus / EWA Hausbau / Baufritz / Modus Projects). Use when optimizing SEO for any Bauunternehmen, Generalunternehmer, Rohbauer, Subunternehmer, Sanierer, Architekt or Handwerksbetrieb — especially Onepager-Sites. Built from PKB V11 SEO-Maximum + EDI B2B-Schema, Mai 2026."
---

# Construction SEO German

Spezialisierter SEO-Skill für deutsche Bau-Websites — egal ob B2C-Generalunternehmer (Endkunden) oder B2B-Subunternehmer (GU-Procurement).

## When to Use

Activate when user wants to:
- SEO-Optimierung einer Bauunternehmen-Website
- Schema.org für GU/Rohbau einbauen
- Google Business Profile aufsetzen für Handwerker/Bauer
- Local-SEO für Berlin, Brandenburg, München, Köln, Hamburg, Stuttgart, Düsseldorf, Frankfurt
- Long-Tail-Keyword-Recherche für Bau
- Konkurrenz-Audit gegen Roth-Massivhaus / EWA Hausbau / Baufritz
- Title-Tags + Meta-Descriptions für Bauer schreiben
- FAQ-Strategie für Featured-Snippet-Eligibility

Auch trigger bei Bauwörtern: "Sanierung", "schlüsselfertig", "Rohbau", "Massivbau", "KfW-Effizienzhaus", "Generalunternehmer", "Bauträger", "Hochbau", "Tiefbau".

## Core Principle

**Bau-SEO hat zwei komplett verschiedene Spielfelder:**

1. **B2C (GU für Endkunden)** — Hohe Investitionssumme, monatelange Recherche, mobil dominant (92 %), Local-SEO + Trust-Signale entscheiden
2. **B2B (Subunternehmer für GUs)** — Wiederkehrend, rational, Procurement-getrieben, sehr spezifische Long-Tail-Queries, Compliance-Signale entscheiden

Die Keyword-Strategie, Schema-Struktur und Content-Tiefe unterscheiden sich grundlegend.

## Zielgruppen-Differenzierung

### B2C Bauherren (Generalunternehmer Endkunden)
- **Sucht:** "Generalunternehmer [Stadt]", "schlüsselfertig bauen [Stadt]", "Haus bauen lassen Kosten"
- **Conversion-Path:** Suche → Website → Kostenloses Erstgespräch (30 min)
- **Trust-Trigger:** Festpreis, Meister, Heritage, KfW-Förderung, persönlich begleitet
- **Best für:** Onepager mit FAQ-Section + Google Business Profile + Reviews-System

### B2B GU-Procurement (Subunternehmer)
- **Sucht:** "Subunternehmer Rohbau [Stadt]", "PQ-VOB präqualifiziert", "Nachunternehmer Stahlbeton"
- **Conversion-Path:** LV einreichen → Festpreis-Angebot (5 Werktage) → VOB/B-Vertrag
- **Trust-Trigger:** PQ-VOB-Nr, VOB/B-konform, eigene Kolonnen, Termintreue-Quote, § 28e SGB IV Entlastung
- **Best für:** Onepager mit 5-Gruppen-FAQ + GeneralContractor-Schema + dokumentierten Compliance-Listen
- **Keyword-Lücke:** "subunternehmer rohbau [stadt]" extrem unterumkämpft — Goldmine

## Keyword-Strategie

### Universal Local Patterns
```
[Service] [Stadt]            → "Bauunternehmen Berlin", "Rohbau Berlin"
[Service] [Region]           → "Hausbau Brandenburg", "Stahlbetonbau Brandenburg"
Schlüsselfertig [Stadt]      → "Schlüsselfertig München"
[Service] lassen [Stadt]     → "Haus bauen lassen Berlin"
[Service] Kosten [Stadt]     → "Sanierung Kosten Berlin"
```

### Long-Tail B2C (höchste Conversion)
- "Was kostet ein Einfamilienhaus bauen lassen 2026"
- "KfW Effizienzhaus 40 Förderung [Stadt]"
- "Sanierung Altbau [Stadt] Kosten pro m²"
- "Generalunternehmer Erfahrungen [Stadt]"
- "Festpreis schlüsselfertig [Stadt]"
- "Anbau bauen lassen Genehmigung"
- "Bauantrag Ablauf [Stadt]"

### Long-Tail B2B (KEYWORD-LÜCKE — wenig Konkurrenz!)
- "Subunternehmer Rohbau [Stadt]"
- "Nachunternehmer Rohbau [Stadt]"
- "Stahlbetonbau Subunternehmer [Stadt]"
- "PQ-VOB Bauunternehmen"
- "Maurerarbeiten Subunternehmer"
- "VOB/B Vertragsbasis Rohbau"
- "Eigene Kolonnen Rohbau [Stadt]"
- "Filigrandecken Subunternehmer"
- "Sichtbeton SB3 [Stadt]"

### Service-Keywords zwingend abdecken
**B2C:** Sanierung · Komplettsanierung · Teilsanierung · Energetische Sanierung · KfW 40/55 · Einfamilienhaus · Massivbau · Anbau · Aufstockung · Bad · Küche · Denkmalsanierung

**B2B:** Stahlbeton(bau) · Mauerwerk(sbau) · Schalung · Bewehrung · Massivbau · Hochbau · Filigrandecken · Sichtbeton · Bodenplatten · Weiße Wanne · Schwarze Wanne · Decken · Treppen(häuser) · Kerne

## Schema.org JSON-LD (Pflicht-Markup)

### Universal Block — LocalBusiness + GeneralContractor
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["LocalBusiness", "GeneralContractor"],
  "@id": "[URL]#organization",
  "name": "[Firmenname]",
  "alternateName": "[Kurz]",
  "description": "...",
  "url": "[URL]",
  "telephone": "+49...",
  "email": "info@...",
  "image": ["[Hero]", "[Logo]"],
  "logo": "[Logo]",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "...",
    "postalCode": "...",
    "addressLocality": "Berlin",
    "addressRegion": "Berlin",
    "addressCountry": "DE"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 52.52,
    "longitude": 13.405
  },
  "areaServed": [
    { "@type": "City", "name": "Berlin" },
    { "@type": "City", "name": "Potsdam" },
    { "@type": "AdministrativeArea", "name": "Brandenburg" }
  ],
  "serviceArea": {
    "@type": "GeoCircle",
    "geoMidpoint": { "@type": "GeoCoordinates", "latitude": 52.52, "longitude": 13.405 },
    "geoRadius": "120000"
  },
  "openingHoursSpecification": [{
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
    "opens": "08:00",
    "closes": "18:00"
  }],
  "priceRange": "€€-€€€",
  "knowsAbout": ["Sanierung", "KfW", "Generalunternehmer"],
  "makesOffer": [
    {
      "@type": "Offer",
      "itemOffered": {
        "@type": "Service",
        "name": "...",
        "description": "..."
      },
      "priceSpecification": {
        "@type": "UnitPriceSpecification",
        "price": "1800",
        "priceCurrency": "EUR",
        "unitText": "m²"
      }
    }
  ]
}
</script>
```

### Zusatz: FAQPage Schema
Pflicht wenn FAQ-Section auf der Seite. Direkt aus Daten-Funktion generieren:
```php
$entities = array_map(static function ($faq) {
  return [
    '@type' => 'Question',
    'name' => $faq['q'],
    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]
  ];
}, $faqs);
echo '<script type="application/ld+json">' . wp_json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => $entities
]) . '</script>';
```

### B2B Zusatz: numberOfEmployees + PQ-VOB
```json
{
  "@type": "GeneralContractor",
  "slogan": "Rohbau, der auf Termin steht.",
  "knowsAbout": ["Rohbau", "Stahlbetonbau", "Mauerwerksbau", "VOB/B", "PQ-VOB"],
  "numberOfEmployees": { "@type": "QuantitativeValue", "minValue": 60 }
}
```

## On-Page SEO Checkliste

### Pflicht Meta-Tags
```html
<title>Generalunternehmer Berlin & Brandenburg | Sanierung & EFH schlüsselfertig — [Brand]</title>
<meta name="description" content="...max 160 Zeichen, Keyword vorne, USP + CTA...">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
<meta name="theme-color" content="#xxx" media="(prefers-color-scheme: dark)">

<link rel="canonical" href="...">
<link rel="alternate" hreflang="de-DE" href="...">
<link rel="alternate" hreflang="x-default" href="...">

<!-- Open Graph (12 Tags) -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="...">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:url" content="...">
<meta property="og:locale" content="de_DE">
<meta property="og:image" content="...">
<meta property="og:image:width" content="2400">
<meta property="og:image:height" content="1340">
<meta property="og:image:alt" content="...">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">

<!-- Geo -->
<meta name="geo.region" content="DE-BE">
<meta name="geo.placename" content="Berlin">
<meta name="geo.position" content="52.5200;13.4050">

<!-- Performance -->
<link rel="preload" as="image" href="hero.jpg" fetchpriority="high">
```

### Heading-Hierarchie
- H1 **nur einmal**, mit Haupt-Keyword + Region
- H2 pro Section eine
- H3 in Services/FAQ
- `aria-labelledby` auf jeder Section

### Image-SEO
- **Alt-Text Pflicht** — keyword-reich (NICHT "Bild 1")
- Lazy loading (außer Hero: `loading="eager"` + `fetchpriority="high"`)
- Width/Height als Attribute (verhindert CLS)
- WebP/AVIF mit JPG-Fallback
- Dateinamen: keyword-slug (`sanierung-berlin-altbau.jpg`)

## Google Business Profile — Pflicht

| Element | Spezifikation |
|---|---|
| Services | Einzeln auflisten ("Schlüsselfertigbau", "Rohbau", "Sanierung") |
| Fotos | Min. 20 — Baustelle + fertige Projekte + Team + Geräte |
| Posts | Wöchentlich (Baufortschritt, Tipps, Förderung-News) |
| Beschreibung | 750 Zeichen, Keyword-vorne, Service-Area |
| **Reviews** | **Ziel 50+ mit Ø 4.5+ Sterne = ca. 17% des Local Rankings** |
| Q&A | Eigene Fragen einstellen + beantworten (FAQ-Synergie) |
| Attribute | "Inhabergeführt", "Meisterbetrieb" |

## Content-Strategie Onepager

Onepager verliert Multi-Page-SEO. Kompensation:
1. **Long-Tail FAQ** mit min. 10 Fragen → FAQPage Schema
2. Schema.org maxed out (s.o.)
3. Standort-Keywords inhaltlich verteilen (mind. 3× pro Ort)
4. Section-IDs als Anker-Links + ARIA
5. Pseudo-Subpages über URL-Anker (`/#leistungen`, `/#ablauf`)

## Timeline & Erwartungen

| Phase | Zeit | Sichtbar |
|---|---|---|
| Setup (Schema, Meta, GBP) | Woche 1 | Indexierung beginnt |
| Erste Verbesserungen | **2–3 Monate** | Long-Tail Rankings (Position 30–50) |
| Stabile Sichtbarkeit | **4–6 Monate** | Top-Positionen Long-Tail |
| Local Top 3 | **6–12 Monate** | mit aktivem GBP + Reviews |

## Anti-Floskel-Liste (SEO + Trust-Killer)

Niemals verwenden — SEO-leer + entwerten Marke:
- "Ihr starker Partner"
- "Tradition trifft Innovation"
- "Individuelle Lösungen"
- "Maßgeschneidert für Sie"
- "Premium Qualität"
- "Zuverlässigkeit ist unser Versprechen"
- "Wir freuen uns auf Ihre Anfrage"
- "Kompetenz, die überzeugt"
- "Mit uns sind Sie auf der sicheren Seite"
- "Mehr erfahren" (als CTA)

## Konkurrenz-Audit Berlin/Brandenburg (validiert Mai 2026)

- **Roth-Massivhaus** (https://www.roth-massivhaus.de/) — etabliert, 26 Jahre, 3.200 Häuser, schwaches modernes UX, Multi-Channel-Conversion stark
- **EWA Hausbau** (https://www.ewa-hausbau.de/) — technisch-sachlich, generische CTAs ("MEHR ERFAHREN")
- **KLINKER HAUS** — seit 1990er, schlüsselfertig, EFH/DHH
- **CONCRETE Bauunternehmung** — Hoch-/Tief-/Stahlbetonbau Berlin
- **MBN Berlin** — GU schlüsselfertig

Differenzierungspunkte für junge GU:
- Persönlich vs. Konzern (Inhaber als Person prominent)
- Festpreisgarantie konkret ausgeschrieben
- KfW-Förderung mit IBB/ILB lokal angebunden
- Heritage-Story trotz junger Firma ("16 Jahre auf der Baustelle")

Differenzierung für Rohbau-Subunternehmer:
- Klare B2B-Positionierung (nicht Endkunden-Sprache)
- PQ-VOB als Hauptfilter
- Eigene Kolonnen + Geräte (kein Sub-Sub)
- Termintreue-Quote dokumentiert

## Related Skills + Memory

- **`construction-website-builder`** — Build der Website auf der das SEO sitzt
- **`construction-copywriting-german`** — Texte die SEO-Keywords + Trust-Phrasen kombinieren
- Workspace Memory `knowledge_seo_construction.md` — vollständige Recherche-Daten
- Workspace Memory `project_pkb.md` + `project_edi.md` — konkrete Beispiele

## Quellen (Recherche-Stand 2026-05-26)

- [Ostend Digital SEO Bauunternehmen](https://ostend.digital/seo-bauunternehmen/)
- [SEO-Crashkurs Bauwesen](https://www.seo-crashkurs.de/seo-fuer-unternehmen-in-der-baubranche-mehr-sichtbarkeit-und-neue-kunden-gewinnen/)
- [Auftragsbank Berlin Rohbau-Marktdaten](https://www.auftragsbank.de/suche-rohbau/berlin/11369)
- [PQ-Verein.de — Präqualifikation VOB](https://www.pq-verein.de/)
