# Schema.org für Bau-Websites — Copy-paste-ready

Im `<head>` der jeweiligen Page als `<script type="application/ld+json">`. Beide Schemas können parallel auf einer Onepager-Seite stehen.

---

## 1. LocalBusiness + GeneralContractor (Pflicht für GU)

```json
{
  "@context": "https://schema.org",
  "@type": ["LocalBusiness", "GeneralContractor"],
  "name": "Pascal Kacemer Bauunternehmung",
  "alternateName": "PKB",
  "description": "Generalunternehmer für Sanierungen, Einfamilien- und Mehrfamilienhäuser in Berlin und Brandenburg. Ein Ansprechpartner für Bauherren-Familien.",
  "url": "https://pkb-bau.de/",
  "telephone": "+49-30-000-0000",
  "email": "info@pkb-bau.de",
  "image": "https://pkb-bau.de/assets/logo.svg",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Musterstrasse 12",
    "postalCode": "10115",
    "addressLocality": "Berlin",
    "addressCountry": "DE"
  },
  "areaServed": [
    "Berlin", "Potsdam", "Oranienburg", "Bernau",
    "Brandenburg an der Havel", "Cottbus", "Frankfurt (Oder)"
  ],
  "founder": {
    "@type": "Person",
    "name": "Pascal Kacemer",
    "jobTitle": "Bauunternehmer · Meister im Bauhandwerk"
  },
  "foundingDate": "2026",
  "openingHours": "Mo-Fr 08:00-18:00",
  "priceRange": "€€-€€€",
  "knowsAbout": [
    "Sanierung",
    "Einfamilienhaus Neubau",
    "Energetische Modernisierung",
    "KfW-Effizienzhaus",
    "Generalunternehmer"
  ]
}
```

**Wichtige Felder-Hinweise:**
- `"@type": ["LocalBusiness", "GeneralContractor"]` — Mehrfach-Typ-Array nutzen, beide gelten
- `areaServed` — alle relevanten Städte explizit auflisten (Local-SEO-Booster)
- `foundingDate` ist OK bei jungen Firmen (Google interpretiert nicht als „unerfahren")
- `priceRange` „€€-€€€" für Mittelstand-/Premium-Bau, „€€-€€€€" für sehr Premium
- `knowsAbout` — die echten Keywords, die Bauherren googeln

---

## 2. FAQPage (für FAQ-Section)

Wenn die Seite eine FAQ hat — IMMER mit Schema. Google zeigt Rich Snippets in den SERPs (mehr SERP-Real-Estate).

```php
<?php // Wenn FAQ-Daten in functions.php als pkb_faqs() Array vorliegen ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php
    $faqs = pkb_faqs();
    $json = array_map(function($f) {
      return sprintf(
        '{ "@type": "Question", "name": %s, "acceptedAnswer": { "@type": "Answer", "text": %s } }',
        wp_json_encode($f['q']),
        wp_json_encode($f['a'])
      );
    }, $faqs);
    echo implode(",\n", $json);
    ?>
  ]
}
</script>
```

**Wichtig:**
- Frage + Antwort müssen identisch zur sichtbaren FAQ sein (Google bestraft Schema-Spam)
- Antworten 2–4 Sätze ideal (zu kurz = wertlos für Snippet, zu lang = abgeschnitten)
- Min 4 FAQs, max 10 (mehr macht keinen SERP-Sinn)

---

## 3. Service-Schema (optional, für Detail-Pages)

Wenn du eine eigene Seite pro Leistung baust (Sanierung / EFH / MFH):

```json
{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "Einfamilienhaus-Neubau",
  "provider": {
    "@type": "GeneralContractor",
    "name": "Pascal Kacemer Bauunternehmung"
  },
  "areaServed": ["Berlin", "Brandenburg"],
  "offers": {
    "@type": "Offer",
    "priceCurrency": "EUR",
    "priceSpecification": {
      "@type": "UnitPriceSpecification",
      "price": "2400",
      "priceCurrency": "EUR",
      "unitText": "EUR per m²"
    }
  }
}
```

---

## 4. BreadcrumbList (für Multi-Page-Sites)

Nur sinnvoll wenn nicht Onepager:

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Startseite", "item": "https://pkb-bau.de/" },
    { "@type": "ListItem", "position": 2, "name": "Leistungen", "item": "https://pkb-bau.de/leistungen/" },
    { "@type": "ListItem", "position": 3, "name": "Einfamilienhaus", "item": "https://pkb-bau.de/leistungen/einfamilienhaus/" }
  ]
}
```

---

## Validation

**Vor Live-Going IMMER validieren:**
- Google Rich Results Test: https://search.google.com/test/rich-results
- Schema.org Validator: https://validator.schema.org/

**Bei FAQPage Schema:** prüfen ob Google es als „eligible for FAQ rich results" anzeigt — wenn nicht, sind die Daten meist zu kurz oder Q+A nicht identisch zum sichtbaren Text.

---

## SEO-Boost-Pattern

**Kombination LocalBusiness + FAQPage auf einer Onepager-Seite** ist der stärkste SEO-Setup für Bauunternehmen:
- Google zeigt Knowledge Panel (LocalBusiness) bei Brand-Suchen
- Google zeigt Rich Snippets (FAQPage) bei Long-Tail-Suchen
- Doppelter SERP-Real-Estate für die gleiche Page

Plus: Google Business Profile separat einrichten + verifizieren — Schema.org und GBP arbeiten zusammen.
