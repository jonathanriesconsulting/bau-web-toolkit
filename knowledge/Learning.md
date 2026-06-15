# LEARNING.md — Konsolidiertes Wissen aus PKB + EDI

**Stand:** Mai 2026
**Projekte:** PKB (Pascal Kacemer Bauunternehmung) + EDI (Hochbau GmbH, Dautović)
**Autor:** Jonathan Ries (mit Claude Code)

Dieses Dokument bündelt das gesamte erarbeitete Wissen aus 14 PKB-Iterationen und 7 EDI-Iterationen. Es ist ein **lebendiges Dokument** — verschiedene Agents/Tasks dürfen einzelne Sections bearbeiten und ergänzen. Beim Editieren bitte die Section-Marker beibehalten (`<!-- SECTION:NAME:BEGIN -->` / `<!-- SECTION:NAME:END -->`).

---

## 📑 Inhaltsverzeichnis

1. [Projekt-Übersicht PKB + EDI](#1-projekt-übersicht)
2. [SEO für Bauunternehmen](#2-seo-für-bauunternehmen)
3. [Copywriting für Bauwebsites](#3-copywriting-für-bauwebsites)
4. [Design-Patterns + Themes](#4-design-patterns--themes)
5. [Tech-Stack + Workflow](#5-tech-stack--workflow)
6. [User-Präferenzen + Veto-Liste](#6-user-präferenzen--veto-liste)
7. [Quellen + Inspirationen](#7-quellen--inspirationen)

---

<!-- SECTION:PROJEKTE:BEGIN -->
## 1. Projekt-Übersicht

### PKB — Pascal Kacemer Bauunternehmung
- **Typ:** B2C Generalunternehmer (GU)
- **Zielgruppe:** Bauherren-Familien
- **Services:** Sanierung + Einfamilienhaus-Neubau (kein MFH mehr nach Update)
- **Region:** Berlin & Brandenburg (zuvor Düsseldorf)
- **Inhaber:** Pascal Kacemer — eingetragener Meister im Bauhandwerk, 16 Jahre Erfahrung
- **Repo:** `/Users/jonathanries/Documents/Websites/pkb/`
- **Themes:** V5 (Slate Original) → V11 (Meister, final empfohlen) → V12-V14 (neuere Iterationen)
- **Ports:** 8885–8892 parallel auf wp-now (mehrere haben Crash-Historie wegen RAM)
- **Status:** Live-Ready (V11), benötigt noch echte Telefonnummer/Adresse/Pascal-Foto/Form-Backend

### EDI — EDI Hochbau GmbH (Dautović)
- **Typ:** B2B Rohbau-Subunternehmer
- **Zielgruppe:** Generalunternehmer (GU) als Auftraggeber — NICHT Endkunden
- **Inhaber:** Amir Dautović (Geschäftsführer, 22 Jahre Stahlbetonbau, EDI gegründet 2018)
- **Services:** 5 Subgewerke (Stahlbeton, Mauerwerk, Schalung, Bewehrung, Schlüsselfertiger Rohbau)
- **Region:** Berlin & Brandenburg
- **Repo:** `/Users/jonathanries/Documents/Websites/edi/`
- **Theme:** edi-theme (Dark Canvas + Gold-Akzent `#c9a961`)
- **Ports:** 8884 (V1) + 8895/8896/8897 (V2 Atelier / V3 Werkraum / V4 Beton)
- **Sections (9):** hero · intro · leistungen · **bauen** (MegaCinema mit 75 Frames) · referenzen · zusammenarbeit · faq · team · kontakt
- **Status:** Live-Ready, benötigt echte Daten + Bauleiter-Portraits

### 2 Personas pro Projekt

**PKB-Persona (B2C):**
- Familien-Bauherren in Berlin/BB, mittleres Einkommen, energetisch interessiert
- Suchen monatelang, vergleichen 5+ Anbieter
- Trust > Preis: zahlen für persönliche Begleitung + Festpreis
- Sub-Persona Investor Klaus, 52 — Multi-Projekt, KfW-Effizienzhaus 40/55, Termintreue = Darlehens-Bindung

**EDI-Personas (B2B):**
1. **Bauleiter Markus, 47** — Termintreue-getrieben, will Pönale-Limits, Verzug-Verhalten, Bauleiter-Direktdurchwahl
2. **Einkäuferin Sandra, 41** — Compliance-getrieben, will PQ-VOB-Nachweis, § 28e SGB IV-Entlastung, dokumentierte Termintreue

### Differenzierte Trust-Anker (validiert)

**PKB (B2C — Bauherren-Familien) — emotional vertrauensbildend:**
- Meister mit 16 Jahren Erfahrung
- 100 % Festpreis-Garantie
- KfW 40/55 Kompetenz
- 1 Ansprechpartner (Pascal persönlich)
- 48 h Antwort-Versprechen
- Kostenloses Erstgespräch

**EDI (B2B — GU-Einkäufer/Bauleiter) — Compliance & Prozess-vertrauensbildend:**
- 94 % dokumentierte Termintreue über 38 GU-Projekte
- PQ-VOB Nr. 12345 (jährlich verlängert)
- 64 eigene Mitarbeiter in 6 Kolonnen — keine Sub-Sub-Vergabe
- 5 Werktage Festpreis-Angebot, 48 h indikativ
- 10 Mio € Betriebshaftpflicht
- VOB/B · ZDB-Nachunternehmervertrag Juli 2021 · BG BAU · SOKA-BAU · § 48b EStG
<!-- SECTION:PROJEKTE:END -->

---

<!-- SECTION:SEO:BEGIN -->
## 2. SEO für Bauunternehmen

### Erste Weichenstellung — B2B vs B2C

Das Suchverhalten von **Endkunden** (B2C) und **GU-Einkäufern** (B2B) unterscheidet sich grundlegend. B2C-Keywords folgen emotional-lokalem Muster: *"Generalunternehmer Berlin"*, *"schlüsselfertig bauen"*, *"Haus sanieren Kosten"*. Der Nutzer researcht monatelang, sucht auf dem Smartphone (92 % Mobile), und will Vertrauen aufbauen.

B2B-Keywords sind spezifisch und rational: *"Subunternehmer Rohbau Berlin"*, *"PQ-VOB präqualifiziert"*, *"Nachunternehmer Stahlbetonbau"*. Diese Keyword-Räume sollten **nicht vermischt** werden — ein B2B-Unternehmen, das mit B2C-Floskeln um Endkunden wirbt, wirkt dilettantisch auf Bauleiter, und umgekehrt.

### Top-5-Hebel (nach ROI sortiert)

1. **PQ-VOB-Landing-Page + Google Business Profile** — Gut gepflegtes GBP mit 20+ Fotos, wöchentlichen Posts und min. 50 Reviews (Ø 4,5+) macht ~17 % des Local Rankings aus.
2. **Schema.org GeneralContractor + FAQPage + AreaServed** — Struktur-Markup für gezieltes Targeting; FAQPage indexiert häufige Anfragen direkt.
3. **Standort-Seiten-Cluster Berlin/Potsdam/Cottbus/Frankfurt-Oder/Oranienburg** — Selbst auf Onepager: lokale Keywords (3× pro Ort) inhaltlich verteilen.
4. **Long-Tail-Keyword-Fokus in FAQ** — *"Was kostet ein Einfamilienhaus bauen lassen 2026?"*, *"KfW Effizienzhaus 40 Förderung Berlin"* ranken in 2–3 Monaten statt 6–12.
5. **Review-Sammel-System von Tag 1** — Parallel zum Launch E-Mail-Follow-up; erste 10–15 Reviews geben SEO-Boost + reduzieren Conversion-Friction um 40 %.

### Keyword-Cluster Berlin/Brandenburg

**B2C primär** (hohe Kaufintention):
- Generalunternehmer Berlin / Brandenburg · Schlüsselfertig bauen Berlin · Sanierung Berlin/Potsdam/Cottbus · KfW Effizienzhaus 40 Berlin · Anbau bauen lassen Berlin

**B2C Long-Tail** (Featured-Snippet-Eligibilität):
- "Was kostet ein Einfamilienhaus bauen lassen in [Stadt]?"
- "Sanierung Altbau Berlin Kosten pro m² 2026"
- "Wie lange dauert ein Hausbau schlüsselfertig?"
- "KfW Förderung Antrag Schritte [Region]"
- "Bauantrag Genehmigung Berlin Dauer"

**B2B primär** (Goldmine — wenig Konkurrenz):
- **Subunternehmer Rohbau Berlin** (KEYWORD-LÜCKE)
- **Nachunternehmer Rohbau Brandenburg**
- Stahlbetonbau Subunternehmer Berlin · PQ-VOB Bauunternehmen · Maurerarbeiten Subunternehmer

**B2B Long-Tail** (Procurement-driven):
- "VOB/B Vertrag Nachunternehmer Rohbau"
- "Termintreue Rohbau Subunternehmer Berlin"
- "Sichtbeton SB3 Berlin Subunternehmer"
- "Filigrandecken Berlin eigene Kolonnen"
- "Welche Sicherheitsleistung Rohbau rechtssicher?"

### Schema.org-Strategie (konkret)

**Typ:** `GeneralContractor` primär, `LocalBusiness` ergänzend. **Nicht** `HomeAndConstructionBusiness` (zu spezifisch).

**Minimal-Block:**

```json
{
  "@context": "https://schema.org",
  "@type": ["LocalBusiness", "GeneralContractor"],
  "name": "Firmenname",
  "url": "https://...",
  "telephone": "+49...",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "...",
    "postalCode": "12345",
    "addressLocality": "Berlin",
    "addressRegion": "Berlin",
    "addressCountry": "DE"
  },
  "geo": { "@type": "GeoCoordinates", "latitude": 52.52, "longitude": 13.405 },
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
  "knowsAbout": ["Rohbau", "Sanierung", "KfW-Förderung", "Stahlbetonbau"],
  "numberOfEmployees": { "@type": "QuantitativeValue", "minValue": 50 }
}
```

**B2B-Zusatz für PQ-VOB:**

```json
{
  "slogan": "Rohbau, der auf Termin steht.",
  "knowsAbout": ["VOB/B", "PQ-VOB", "Termintreue", "Compliance"],
  "hasCredential": {
    "@type": "EducationalOccupationalCredential",
    "credentialCategory": "PQ-VOB",
    "recognizedBy": { "@type": "Organization", "name": "PQ-Verein" }
  }
}
```

**FAQPage aus single source of truth** (`edi_faqs()` PHP-Funktion feeds beide — Sektion UND Schema):

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    { "@type": "Question", "name": "Was kostet …?",
      "acceptedAnswer": { "@type": "Answer", "text": "300–450 EUR/m² …" }
    }
  ]
}
</script>
```

### Local Citations (Tier-Liste)

**Tier 1 — Pflicht:** GBP · Bing Places · Apple Business · gelbeseiten · dasoertliche · 11880 · meinestadt
**Tier 2 — Bau-spezifisch:** wlw.de · bauindex-online · bauunternehmen.org · auftragsbank.de · archimaera
**Tier 3 — Verbände:** IHK Berlin/BB · fg-bau.de · bauindustrie.de · zdb.de · bgbau.de
**Tier 4 — Regional/Nischen:** HWK Potsdam/Cottbus · Berlin.de-Partner · dexigner · houzz

**NAP konsistent halten** (Name, Address, Phone) — keine Variationen.

### Konkurrenz-Audit — was Wettbewerber falsch machen

- **Roth-Massivhaus** (26 J, 3.200 Häuser): Schema nur LocalBusiness statt GeneralContractor, GBP nur 30+ statt 100+ Reviews, "Tradition trifft Innovation" als Floskel-Hero
- **EWA Hausbau:** Title-Tag generisch, Meta-Description < 120 Zeichen, "MEHR ERFAHREN" als schwacher CTA
- **EDI-Konkurrenten:** positionieren sich als "All-in-One" (verwirrt GU + Google), keine PQ-VOB-Sichtbarkeit, VOB/B nicht dokumentiert, keine Crew/Maschinenpark-Transparenz

### Trust-Signals (SEO + Conversion in einem)

1. **BG-Bau-Mitgliedschaft sichtbar** (Footer-Logo, GUs wollen Haftungs-Entlastung)
2. **Berufshaftpflicht-Höhe konkret** ("Versichert bis 5 Mio € Sachschaden, 2 Mio € Personenschaden")
3. **Crew-Größe transparent** ("60 MA, davon 35 auf Baustellen tätig") + Schema `numberOfEmployees`
4. **Maschinenpark mit Herstellernamen** (Liebherr LTM 1200-5.1, BOMAG, Atlas) statt "moderne Ausrüstung"
5. **Verband-Zertifikate als SVG** (ZDB, BGBau, IHK-Meister)
6. **Customer-Review-Kampagne systematisch** ab Tag 1 — Zielquote 1 Review pro 3 Projekte

**Timing-Realität:** Setup 1 Woche · Long-Tail Position 30–50 nach 2–3 Monaten · Local Top 3 mit aktivem GBP + 50+ Reviews: 6–12 Monate.
<!-- SECTION:SEO:END -->

---

<!-- SECTION:COPY:BEGIN -->
## 3. Copywriting für Bauwebsites

### Tonalitäts-Prinzipien (Voice-Architektur)

**PKB (B2C — Bauherren-Familien):**
- **Tonalität:** sachlich-warm, persönlich, Heritage-stark, kein Marketing-Sprech
- **Stimme:** Pascal als greifbare Person — "16 Jahre auf der Baustelle, vom Lehrling bis zum Meister"
- **Sätze:** kurz, Hauptsätze, Zahlen vor Adjektiven ("16 Jahre" statt "langjährig")
- **Beispiel ✅:** „Wir bauen und sanieren Einfamilienhäuser in Berlin & Brandenburg — schlüsselfertig, persönlich begleitet von einem Meister mit 16 Jahren Baustellen-Erfahrung. Ein Festpreis. Eine Hand. Ein Versprechen."
- **Beispiel ❌:** „Wir sind Ihr starker Partner für innovative Baukonzepte. Tradition trifft Innovation. Individuelle Lösungen für Ihren Traum."

**EDI (B2B — GU-Bauleiter & Einkäufer):**
- **Tonalität:** sachlich-technisch, faktenbasiert, kühl-präzise, Firma als Institution
- **Stimme:** keine Person, Compliance + Termintreue im Fokus
- **Sätze:** Nominalisierung okay, direkte Funktionsaussage, Normen-Referenzen
- **Beispiel ✅:** „LV per E-Mail oder Upload — Festpreis-Angebot in 5 Werktagen. Bei Dringlichkeit indikatives Band im 48-h-Rhythmus."
- **Beispiel ❌:** „Wir freuen uns, Ihnen innovative Lösungen aus einer Hand anzubieten. Unsere erfahrenen Teams…"

### Anti-Floskel-Liste (STRENG VERBOTEN)

| Floskel | Alternative | Warum |
|---|---|---|
| "Ihr starker Partner" | "PQ-VOB präqualifiziert, 94 % Termintreue dokumentiert" | Konkret statt gefühlig |
| "Tradition trifft Innovation" | "Seit 2010 auf der Baustelle — Handwerk nach DIN 1045-3" | Substanz |
| "Individuelle Lösungen" | "Kern- oder Teilsanierung nach KfW 40 / 55 Standard" | Leistung konkret |
| "Premium Qualität" | "KfW-Effizienzhaus, Massivbauweise, Meisterbrief" | Messbarer Standard |
| "Zuverlässigkeit ist unser Versprechen" | "5 Werktage Angebot, 48-h-Bauführer-Bereitschaft" | Zahl |
| "Wir freuen uns auf Ihre Anfrage" | "Rufen Sie an oder beschreiben Sie Ihr Vorhaben — Antwort in 48 h" | Handlung |
| "Kompetenz, die überzeugt" | "Meister im Bauhandwerk, 16 J Baustelle, HWK-Eintrag" | Titel + Erfahrung |
| "Mit uns sind Sie auf der sicheren Seite" | "Festpreisgarantie nach Bemusterung, 5 J Gewährleistung BGB" | Rechtsicherheit |
| "Aus einer Hand" | "Ein Festpreis, ein Vertrag, ein Ansprechpartner — keine Sub-Sub-Vergabe" | Mechanik |
| "Unsere Erfahrung — Ihr Erfolg" | "38 GU-Projekte, 100 % Schlüsselübergabe pünktlich" | Zahlen, nicht Gefühle |
| "Mehr erfahren" (CTA) | "Erstgespräch buchen" / "PQ-Nachweis ansehen" | Action statt Floskel |
| "Hier klicken" (CTA) | "Kostenloses Erstgespräch" / "LV einreichen" | Value in Button |

### Headline-Frameworks

**B2C-Headlines (7 Varianten):**
1. **Possessiv-Hero:** "Ihr Haus. Unsere Handschrift."
2. **Versprechen-Hero:** "Bauen, dem Sie vertrauen."
3. **Identität-Hero:** "Ein Meister. Ein Ansprechpartner. Ihr Haus."
4. **Region+Service:** "Generalunternehmer für Ihr Zuhause in Berlin & Brandenburg."
5. **Premium:** "Häuser, die bleiben."
6. **Direkt:** "Handwerk trifft Verantwortung."
7. **Negativ-Differenzierung:** "Nicht bei uns: Call-Center, tausend Subunternehmer, überraschende Nebenkosten."

**B2B-Headlines (7 Varianten):**
1. **Direkt-Funktional:** "Rohbau, der auf Termin steht."
2. **Procurement:** "Was wir bauen — und wofür Sie uns ausschreiben."
3. **Compliance:** "VOB/B. PQ-VOB. Festpreis. Pünktlich."
4. **Subgewerk:** "Rohbau & Haustechnik für großvolumige Projekte."
5. **Termintreue:** "94 % Termintreue dokumentiert. 5 Werktage Angebot."
6. **Unterscheidung:** "Eigene Kolonnen. Keine Sub-Sub-Vergabe. Direktdurchwahl Bauleiter."
7. **Sicherheit:** "10 Mio EUR Haftpflicht. PQ-VOB Nr. 12345. BG BAU unbedenklich."

**Regel:** Max 6–8 Wörter pro Zeile. Color-Akzent auf Zweit-Wort. KEIN Italic.

### CTA-Bibliothek

**B2C:**
| Use Case | ✅ CTA | ❌ Niemals |
|---|---|---|
| Primär-Hero | "Kostenloses Erstgespräch" | "Mehr erfahren" |
| Hero-Alt | "Erstgespräch buchen" | "Kontaktieren Sie uns" |
| Leistungen | "So bauen wir Ihr Haus" | "Über uns" |
| About | "Jetzt mit Pascal sprechen" | "Anrufen" |
| Service | "Festpreisangebot anfragen" | "Angebot anfordern" |
| Form | "Anfrage senden" | "Absenden" |
| Sticky-Bar | "Rückruf in 48 h arrangieren" | "Jetzt kontaktieren" |

**B2B:**
| Use Case | CTA |
|---|---|
| Primär | "Festpreis anfordern" / "LV einreichen" |
| Trust-Trigger | "Referenzliste anfordern" / "PQ-VOB-Nachweis ansehen" |
| Direkt | "Bauleiter anrufen" / "Direktdurchwahl Bauleitung" |
| Compliance | "VOB/B-Vertragsstandard anfordern" |
| Speed-Signal | "48-h-Indikativ-Angebot erhalten" |
| Screening | "Anforderungen übermitteln" |
| Vereinbarung | "Kostenfreies Vorgespräch mit GF" |

**Button-Animation:** Pfeil-Animation auf Hover (5 px rechts schieben, 220 ms cubic-bezier).
HTML: `<a class="btn">Text <span class="btn__arrow">→</span></a>`

### FAQ-Templates

**B2C-FAQ (8 Top-Fragen):**

1. **"Was bedeutet ‚schlüsselfertig' konkret?"** — Rohbau, Installationen, Ausbau, Schlosswechsel, Reinigung. Sie beziehen ein fertiges EFH ohne weitere Handgriffe.
2. **"Wer ist der Ansprechpartner während des Baus?"** — Pascal persönlich — nicht ein Projektmanager, nicht ein Call-Center.
3. **"Wie funktioniert der Festpreis?"** — Nach Bemusterung verbindlich. Nur Änderungen *nach* Bemusterung führen zu Nachträgen.
4. **"Wie lange dauert ein EFH?"** — 14–18 Monate.
5. **"Beratet ihr auch KfW-Förderung?"** — Ja. KfW-Programme, BAFA, Landesprogramme (IBB Berlin, ILB Brandenburg).
6. **"Wie lange bis zum Angebot?"** — 2–4 Wochen nach Absprache.
7. **"Was bei Problemen auf der Baustelle?"** — Transparente Kommunikation, schriftliche Nachträge VOR der Ausführung.
8. **"Welche Garantie?"** — BGB: 5 Jahre Rohbau, 2 Jahre Innenausbau.

**B2B-FAQ (5–6 Top-Fragen optimal, max 10):**

*Anfrage & Angebot:*
1. **"Wie schnell bekommen wir ein Angebot?"** — 5 Werktage normal, 48 h indikatives Band bei Dringlichkeit.
2. **"Pauschal oder Einheitspreise?"** — Festpreis VOB/B (Einheit pro Leistung).

*Vertrag:*
3. **"Welche Sicherheitsleistung?"** — 5 % Vertragserfüllung + 5 % Gewährleistung.
4. **"Vertragsstrafen?"** — Ja, VOB/B § 6 (max. 5 % Gesamtauftragssumme, 0,2 %/Tag).

*Ausführung:*
5. **"Kolonnen-Größe?"** — Ø 6–10 Mann, max. 3 parallele Projekte.
6. **"Eigene Geräte?"** — Liebherr-Krane, Doka-Schalungen, PERI-Traggerüste.
7. **"Sub-Sub-Vergabe?"** — Nein. Stamm-Subunternehmer mit PQ-VOB.

*Compliance:*
8. **"Termintreue (94 %)?"** — Dokumentiert über 38 abgeschlossene Projekte.
9. **"PQ-VOB?"** — Ja, Nr. 12345. § 28e Entlastung, BG BAU, ZDB-Vertrag Juli 2021.

### Trust-Microcopy für Footer

**B2B-Set:**
- PQ-VOB präqualifiziert — Nr. 12345
- VOB/B-Standardvertrag seit 2021
- BG BAU Unbedenklichkeit (aktuell)
- SOKA-BAU Bescheinigung (aktuell)
- § 28e SGB IV Freistellungsbescheinigung
- 10 Mio EUR Betriebshaftpflicht
- ZDB-Nachunternehmervertrag Juli 2021
- DIN 1045-3 Rohbau-Dokumentation (auf Anfrage)

**B2C-Set:**
- Eingetragener Meister im Bauhandwerk — HWK [Nr.]
- 16 Jahre Baustellen-Erfahrung (seit 2010)
- 100 % Festpreisgarantie nach Bemusterung
- 5 Jahre Gewährleistung (BGB § 634)
- KfW-Effizienzhaus 40 / 55 zertifiziert
- BAFA-Sanierungsexpert:in
- Kostenloses Erstgespräch — 30 min, unverbindlich

### Validierte Live-Texte (1:1 übernehmbar)

**EDI Hero:** „Rohbau, der auf Termin steht." (Gold auf "auf Termin steht")
**EDI Hero-Lead:** „LV per E-Mail oder Upload — Festpreis-Angebot in 5 Werktagen. Bei Dringlichkeit: indikatives Preisband im 48-h-Rhythmus, finales Angebot nach Bestandsaufnahme. Bauleiter mit Direktdurchwahl vor Vertragsschluss zugeordnet."
**EDI Quote (Amir):** „Wir sagen lieber rechtzeitig nein als spät verspätet ja."
**EDI Team-Lead:** „Inhabergeführter Rohbau-Spezialist seit 2018 — mit 64 eigenen Mitarbeitern in 6 Kolonnen und durchschnittlich 8 Jahren Betriebszugehörigkeit pro Person."
**EDI CTA Schritt 0:** „Starten wir bei Schritt 0 — Lassen Sie uns unverbindlich über Ihr Projekt sprechen."

**PKB Hero-Lead:** „Wir bauen und sanieren Einfamilienhäuser in Berlin & Brandenburg — schlüsselfertig, persönlich begleitet von einem Meister mit 16 Jahren Baustellen-Erfahrung. Ein Festpreis. Eine Hand. Ein Versprechen."
**PKB About-Heading:** „Eine junge Firma. Mit 16 Jahren Baustelle dahinter."
**PKB Pascal-Quote:** „Bauen ist Vertrauenssache. Und Vertrauen verdient man sich auf der Baustelle — nicht in der Werbung."
**PKB Kontakt-Lead:** „Rufen Sie an oder beschreiben Sie Ihr Vorhaben in zwei Sätzen — Sie hören innerhalb von 48 Stunden zurück, meistens am selben Werktag. Das Erstgespräch kostet nichts, dauert rund 30 Minuten und ist garantiert ohne Verkaufsdruck."
<!-- SECTION:COPY:END -->

---

<!-- SECTION:DESIGN:BEGIN -->
## 4. Design-Patterns + Themes

### Decision-Tree für Design-Direction

| Direction | Vibe | Best für | Palette | Typo |
|---|---|---|---|---|
| **Premium Bau** (EDI v1) | Brutalist + Industrial | GU-Akquise, anspruchsvolle Clients | Dark + Gold (`#0a0a0c` + `#c9a961`) | Space Grotesk + Manrope |
| **Editorial Architectural** | Premium Heritage, Aesop-Vibe | Wertarbeit, Atelier-Narrative | Light + Gold oder Cream + Brass | Switzer oder Fraunces |
| **Slate + Steel (Beton)** | Modern Engineering | Tech-forward Bauunternehmen | Slate + Steel-Blue | Space Grotesk + Mono |
| **Cream + Brass (Werkraum)** | Warm, einladend, Handwerk | Residential, Wohnbau | Cream + Brass | Manrope + JetBrains Mono |
| **Bone + Olive (Earthy)** | Nachhaltig, natürlich | Holzbau, Bio-Bau | Bone + Olive | IBM Plex Sans |

**Regel:** Alle 5 Paletten verwenden **identische Markup + CSS-Struktur** — nur Token-Flip + ein Override-Block unterscheidet sie.

### 5 validierte Color-Paletten (mit vollständigen Token-Blöcken)

**Palette 1: Dark + Gold (Premium Bau — EDI v1):**

```css
:root {
  --c-bg: #0a0a0c; --c-bg-lift: #131318; --c-bg-card: #1a1a22; --c-bg-deep: #050507;
  --c-gold: #c9a961; --c-gold-bright: #e8c97e; --c-gold-deep: #8d6e2a; --c-gold-glow: rgba(201,169,97,0.18);
  --c-text: rgba(255,255,255,0.94); --c-text-2: rgba(255,255,255,0.62);
  --c-text-3: rgba(255,255,255,0.40); --c-text-4: rgba(255,255,255,0.22);
  --c-line: rgba(255,255,255,0.08); --c-line-2: rgba(255,255,255,0.14); --c-line-gold: rgba(201,169,97,0.30);
}
```

**Palette 2: Light + Gold (Atelier — Editorial):**

```css
:root {
  --c-bg: #ffffff; --c-bg-lift: #f6f5f1; --c-bg-card: #efece5; --c-bg-deep: #0f0f10;
  --c-gold: #b08d3a; --c-gold-bright: #d4b466; --c-gold-deep: #7a5f1f; --c-gold-glow: rgba(176,141,58,0.24);
  --c-text: rgba(15,15,16,0.92); --c-text-2: rgba(15,15,16,0.62);
  --c-text-3: rgba(15,15,16,0.40); --c-text-4: rgba(15,15,16,0.20);
  --c-line: rgba(15,15,16,0.10); --c-line-2: rgba(15,15,16,0.18); --c-line-gold: rgba(176,141,58,0.32);
}
```

**Palette 3: Cream + Brass (Werkraum — Warm):**

```css
:root {
  --c-bg: #f7f3ec; --c-bg-lift: #efe8db; --c-bg-card: #e6dccc; --c-bg-deep: #211e18;
  --c-gold: #a07232; --c-gold-bright: #c89a55; --c-gold-deep: #6b4818; --c-gold-glow: rgba(160,114,50,0.22);
  --c-text: rgba(33,30,24,0.94); --c-text-2: rgba(33,30,24,0.66);
  --c-text-3: rgba(33,30,24,0.44); --c-text-4: rgba(33,30,24,0.24);
  --c-line: rgba(33,30,24,0.12); --c-line-2: rgba(33,30,24,0.20); --c-line-gold: rgba(160,114,50,0.34);
}
```

**Palette 4: Slate + Steel (Beton — Engineering):**

```css
:root {
  --c-bg: #11161e; --c-bg-lift: #1a212c; --c-bg-card: #232b39; --c-bg-deep: #0a0e15;
  --c-gold: #6fa3c8; --c-gold-bright: #94c0de; --c-gold-deep: #3d6985; --c-gold-glow: rgba(111,163,200,0.20);
  --c-text: rgba(232,238,247,0.94); --c-text-2: rgba(232,238,247,0.62);
  --c-text-3: rgba(232,238,247,0.40); --c-text-4: rgba(232,238,247,0.20);
  --c-line: rgba(232,238,247,0.09); --c-line-2: rgba(232,238,247,0.15); --c-line-gold: rgba(111,163,200,0.32);
}
```

**Palette 5: Bone + Olive (Earthy — Nachhaltig):**

```css
:root {
  --c-bg: #f3eee2; --c-bg-lift: #e8e1d0; --c-bg-card: #dcd3bc; --c-bg-deep: #1d1f17;
  --c-gold: #5e6a3a; --c-gold-bright: #87966e; --c-gold-deep: #3c4523; --c-gold-glow: rgba(94,106,58,0.20);
  --c-text: rgba(29,31,23,0.94); --c-text-2: rgba(29,31,23,0.62);
  --c-text-3: rgba(29,31,23,0.40); --c-text-4: rgba(29,31,23,0.20);
  --c-line: rgba(29,31,23,0.12); --c-line-2: rgba(29,31,23,0.18); --c-line-gold: rgba(94,106,58,0.32);
}
```

**Kritische Regel:** `--c-gold` heißt `--c-gold` auch im Steel-Theme (nicht `--c-steel`). Eine Code-Base, N Varianten — Konsistenz ohne Drift.

### Light-Mode Override-Block (kritisch)

Token-Flip allein reicht nicht. Hero bleibt über Bild-dunkel + dunklem Overlay. Hardcoded Override am Ende von `style.css`:

```css
/* Hero bleibt dunkel — Texte müssen weiß sein */
.hero .mono { color: rgba(255,255,255,0.62); }
.hero__h1 { color: rgba(255,255,255,0.96); }
.hero__h1 strong { color: var(--c-gold-bright); }
.hero__lead { color: rgba(255,255,255,0.88); }
.hero__meta-item small { color: rgba(255,255,255,0.62); }
.hero__meta-item strong { color: rgba(255,255,255,0.96); }

/* Hero gradient fadet zu Canvas (light) */
.hero__bg::after {
  background:
    linear-gradient(180deg, rgba(10,10,12,0.55) 0%, rgba(10,10,12,0.25) 28%, rgba(10,10,12,0.78) 78%, var(--c-bg) 100%);
}

/* Header glass-blur hell */
.site-header { background: rgba(255,255,255,0.78); border-bottom-color: transparent; }
.site-header.is-scrolled { background: rgba(255,255,255,0.94); border-bottom-color: var(--c-line); }

/* Kontakt + Footer bleiben DUNKEL als Drama-Kontrast */
.kontakt, .site-footer { color: rgba(255,255,255,0.62); }
.kontakt__title strong { color: var(--c-gold-bright); }
.kontakt__phone { color: var(--c-gold-bright); }
```

**Für Cream-Theme:** Ersetze `rgba(255,255,255,…)` durch `rgba(247,243,236,…)` + Photo-Overlay zu `rgba(20,16,10,…)`.

### Typo-Stack-Validierung

| Display | Body | Mono | Projekt | Mood |
|---|---|---|---|---|
| Space Grotesk | Manrope | JetBrains Mono | EDI (aktiv) | Geometrisch, Technisch |
| Switzer | Switzer | JetBrains Mono | PKB V5-V11 | Modern Swiss |
| Geist | Geist | JetBrains Mono | PKB V7 Proof | Vercel Vibe |
| Fraunces | Hanken Grotesk | JetBrains Mono | PKB V11 Editorial | Magazine, Premium |
| IBM Plex Sans | IBM Plex Sans | IBM Plex Mono | Alt | Engineering Alt |

**STRENG VERBOTEN:** Inter (AI-Slop) · Roboto · Arial · Helvetica · Fraunces-Italic (V4 "Geschnörkel"-Veto).

### Komponenten-Bibliothek (validiert)

- **Hero:** Full-bleed Foto mit `object-fit: contain` + dunkler Veil + H1 mit Farb-Akzent Zweit-Wort + 2 CTAs + Meta-Bar (4 Trust-Stats)
- **Trust-Bar:** Direkt unterm Hero — 5 prägnante Stats horizontal
- **Section-Marker:** Mono-Eyebrow + dünne Hairline-Line (`border-bottom: 1px solid var(--c-line)`)
- **Service-Cards:** Hover-Lift `transform: translateY(-4px)` + Shadow
- **Button-Pill:** `border-radius: 999px` + Hover-Lift + Arrow-Animation
- **Glass-Header:** `backdrop-filter: blur(16px) saturate(180%)` auto-toggle dark/light
- **Favicon + Logo als SVG:** Single-Color (kein PNG-Transparenz auf Cream)

### Parallel-Vergleich via wp-now Multi-Port

```bash
# 1. Kopiere Theme 4×
cp -r wp-content/themes/edi-theme wp-content/themes/edi-v1-dark-gold
cp -r wp-content/themes/edi-theme wp-content/themes/edi-v2-light-gold
cp -r wp-content/themes/edi-theme wp-content/themes/edi-v3-cream-brass
cp -r wp-content/themes/edi-theme wp-content/themes/edi-v4-slate-steel

# 2. Token-Block in jedem :root flippen + Light-Override-Block addieren bei Light-Variants

# 3. Parallel auf eigenen Ports starten
npx @wp-now/wp-now start --path=./wp-content/themes/edi-v1-dark-gold --port=8884 > /tmp/v1.log 2>&1 &
npx @wp-now/wp-now start --path=./wp-content/themes/edi-v2-light-gold --port=8895 > /tmp/v2.log 2>&1 &
npx @wp-now/wp-now start --path=./wp-content/themes/edi-v3-cream-brass --port=8896 > /tmp/v3.log 2>&1 &
npx @wp-now/wp-now start --path=./wp-content/themes/edi-v4-slate-steel --port=8897 > /tmp/v4.log 2>&1 &

# 4. Browser: localhost:8884, :8895, :8896, :8897 in Tabs vergleichen
```

Jede Instanz hat eigene SQLite-DB unter `~/.wp-now/sites/`. Markup + Daten identisch → nur Token/Override unterscheidet die Sites.
<!-- SECTION:DESIGN:END -->

---

<!-- SECTION:TECH:BEGIN -->
## 5. Tech-Stack + Workflow

### WordPress Classic PHP Theme (NICHT FSE/Block)

**Wann Classic:**
- Maximale Design-Freiheit (eigene CSS-Architektur, JS, keine Block-Editor-Kompromisse)
- Onepager oder flache Multi-Page (≤ 5 Seiten)
- Performance wichtig (kein FSE-Overhead)
- Klient editiert Content, aber komponiert keine Layouts

**Wann FSE/Block:**
- Klient soll Layouts via Block Editor komponieren
- Tiefe Multi-Page-Sites mit Editorial-Character
- Designer ohne PHP

### Datei-Struktur (bewährt)

```
edi-theme/
├── style.css                    ← Theme-Header + alle Styles (~1500-2000 Zeilen)
├── functions.php                ← Theme-Setup, Font-Enqueue, edi_section(), Schema.org JSON-LD
├── header.php                   ← <head>, sticky nav, logo, sections-Loop, tel-CTA
├── footer.php                   ← Brand-Block, Cols, Trust-Strip, Sticky Callbar mobile
├── front-page.php               ← Onepager-Komposition
├── index.php                    ← Fallback identisch
├── inc/sections/
│   ├── hero.php
│   ├── intro.php
│   ├── leistungen.php
│   ├── bauen.php                ← Bauphasen-Scroll (optional)
│   ├── referenzen.php
│   ├── zusammenarbeit.php
│   ├── faq.php                  ← Reads edi_faqs() — SINGLE SOURCE OF TRUTH
│   ├── team.php
│   └── kontakt.php
└── assets/
    ├── images/
    ├── js/main.js               ← Vanilla, IntersectionObserver
    └── bauphasen/               ← Frame-Sequence für scroll-cinema
```

### wp-now Lokales Dev-Setup

```bash
cd /Users/jonathanries/Documents/Websites/edi
npx @wp-now/wp-now start --path=./wp-content/themes/edi-theme --port=8881
```

- Frontend: `http://localhost:8881/`
- WP-Admin: `http://localhost:8881/wp-admin` (admin/password default)
- DB-State: `~/.wp-now/sites/` (keyed nach Theme-Pfad)

**Port-Konvention:**
- PKB-V1 = 8881 · PKB-V5-V11 = 8885-8892
- EDI-V1 = 8884 · EDI-V2/V3/V4 = 8895/8896/8897

**Restart erforderlich wenn:** Block→Classic-Migration · `theme.json` entfernt · Block-Pattern-Registrierungen fatal

### functions.php Boilerplate (komplett)

```php
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
define( 'EDI_THEME_VERSION', '0.1.0' );

add_action( 'after_setup_theme', static function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery' ] );
    register_nav_menus( [ 'primary' => __( 'Hauptnav', 'edi' ) ] );
} );

// Fonts: KEIN Inter/Roboto/Arial
add_action( 'wp_enqueue_scripts', static function () {
    wp_enqueue_style( 'edi-fonts',
        'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap',
        [], null );
    wp_enqueue_style( 'edi-theme', get_stylesheet_uri(), [ 'edi-fonts' ], EDI_THEME_VERSION );
    wp_enqueue_script( 'edi-main', get_template_directory_uri() . '/assets/js/main.js', [], EDI_THEME_VERSION, true );
} );

add_action( 'wp_head', static function () {
    echo "<link rel='preconnect' href='https://fonts.googleapis.com'>\n";
    echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>\n";
    echo '<meta name="theme-color" content="#0a0a0c">' . "\n";
}, 1 );

// Single source of truth — Navigation
function edi_sections(): array {
    return [
        [ 'slug' => 'leistungen', 'label' => 'Leistungen' ],
        [ 'slug' => 'referenzen', 'label' => 'Referenzen' ],
        [ 'slug' => 'zusammenarbeit', 'label' => 'Zusammenarbeit' ],
        [ 'slug' => 'faq', 'label' => 'FAQ' ],
        [ 'slug' => 'team', 'label' => 'Team' ],
        [ 'slug' => 'kontakt', 'label' => 'Kontakt' ],
    ];
}

function edi_section( string $name ): void {
    $path = get_template_directory() . "/inc/sections/{$name}.php";
    if ( file_exists( $path ) ) include $path;
}

// FAQ data — feeds BOTH Section AND Schema.org
function edi_faqs(): array {
    return [
        [ 'q' => 'Sind Sie PQ-VOB präqualifiziert?',
          'a' => 'Ja — PQ-VOB Nr. 12345. § 28e Abs. 3b SGB IV Entlastung. Alle Nachweise im Dropbox, monatlich aktualisiert.' ],
        [ 'q' => 'Wie schnell bekommen wir ein Angebot?',
          'a' => 'LV per E-Mail → Festpreis in 5 Werktagen. Indikatives Band bei Dringlichkeit: 48 Stunden.' ],
        [ 'q' => 'Eigene Kolonnen, eigene Geräte — oder Sub-Sub?',
          'a' => '64 gewerbliche MA, 4 Meister-Poliere. Krane, Pumpen, Doka-/PERI-Schalung im eigenen Park. Keine Sub-Sub-Vergabe.' ],
        [ 'q' => 'Auf welcher Vertragsbasis arbeiten Sie?',
          'a' => 'ZDB-Nachunternehmervertrag Bau (Juli 2021), VOB/B. 5 % Vertragserfüllungs- + 5 % Gewährleistungsbürgschaft.' ],
        [ 'q' => 'Wie laufen Aufmaß und Schlussrechnung?',
          'a' => 'Gemeinsames Aufmaß je Bauabschnitt, VOB/C-konform (DIN 18331/18330), digital. Schlussrechnung 12 Werktage nach Abnahme.' ],
    ];
}

// Schema.org JSON-LD — GeneralContractor + FAQPage
add_action( 'wp_head', static function () {
    $base = home_url( '/' );

    $contractor = [
        '@context' => 'https://schema.org',
        '@type' => 'GeneralContractor',
        '@id' => $base . '#organization',
        'name' => 'EDI Hochbau GmbH',
        'url' => $base,
        'logo' => get_template_directory_uri() . '/assets/images/logo.jpg',
        'telephone' => '+49 30 123 456 78',
        'email' => 'info@edi-hochbau.de',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Musterstraße 12',
            'postalCode' => '10115',
            'addressLocality' => 'Berlin',
            'addressCountry' => 'DE',
        ],
        'areaServed' => [
            [ '@type' => 'City', 'name' => 'Berlin' ],
            [ '@type' => 'City', 'name' => 'Potsdam' ],
            [ '@type' => 'City', 'name' => 'Cottbus' ],
            [ '@type' => 'State', 'name' => 'Brandenburg' ],
        ],
        'serviceArea' => [
            '@type' => 'GeoCircle',
            'geoMidpoint' => [ '@type' => 'GeoCoordinates', 'latitude' => 52.52, 'longitude' => 13.405 ],
            'geoRadius' => '120000',
        ],
        'numberOfEmployees' => [ '@type' => 'QuantitativeValue', 'minValue' => 60 ],
        'slogan' => 'Rohbau, der auf Termin steht.',
        'knowsAbout' => [ 'Rohbau', 'Stahlbeton', 'Mauerwerksbau', 'VOB/B', 'PQ-VOB' ],
    ];
    echo "\n<script type='application/ld+json'>" . wp_json_encode( $contractor, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";

    $entities = array_map( static fn( $f ) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $f['a'] ],
    ], edi_faqs() );
    $faq_schema = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ];
    echo "\n<script type='application/ld+json'>" . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 99 );
```

### Scroll-Cinema-Pattern (Sticky-Stage)

Zwei Modi:
- **Mode A — Full-Bleed** (100vh sticky, 4-10× viewport scroll, Text als Overlay mit Veil, Callouts in Ecken). Für immersive Storytelling.
- **Mode B — Contained + Captions** (`clamp(360px, 52vh, 540px)` mit border-radius, Text als Overlay oder Captions-Block drunter). Für kompakte Sektionen.

**HTML-Skelett (Mode A):**

```html
<div class="cinema" data-cinema data-total="5">
  <div class="cinema__stage">
    <div class="cinema__images">
      <img src="phase-01.jpg" class="is-active" data-phase="0">
      <img src="phase-02.jpg" data-phase="1">
      <!-- … -->
    </div>
    <div class="cinema__veil"></div>
    <div class="cinema__head">
      <span class="cinema__chip" data-phase-counter>01 / 05</span>
    </div>
    <div class="cinema__overlay">
      <article class="master is-active" data-phase="0">
        <div class="master__center">
          <span class="master__num">01 / 05</span>
          <h3 class="master__title">Stahlbetonbau</h3>
          <p class="master__subtitle">Bodenplatten · Decken · Wände</p>
          <ul class="master__bullets">
            <li>Ortbeton C20/25 – C50/60</li>
          </ul>
        </div>
      </article>
    </div>
    <footer class="cinema__foot">
      <div class="cinema__progress">
        <button class="step is-active" data-phase="0"></button>
      </div>
      <span data-phase-label>Stahlbetonbau</span>
    </footer>
  </div>
</div>
```

**JS-Pattern (Phase-Mapper):**

```js
(function() {
  'use strict';
  document.querySelectorAll('[data-cinema]').forEach(initCinema);

  function initCinema(cinema) {
    const total = parseInt(cinema.dataset.total, 10) || 1;
    const masters = cinema.querySelectorAll('.master');
    const steps = cinema.querySelectorAll('.step');
    const counter = cinema.querySelector('[data-phase-counter]');
    const label = cinema.querySelector('[data-phase-label]');
    let currentPhase = -1;

    const setPhase = (i, sp = 0) => {
      i = Math.max(0, Math.min(total - 1, i));
      if (i !== currentPhase) {
        currentPhase = i;
        masters.forEach((el, idx) => el.classList.toggle('is-active', idx === i));
        steps.forEach((el, idx) => {
          el.classList.toggle('is-active', idx === i);
          el.classList.toggle('is-passed', idx < i);
        });
        if (counter) counter.textContent = `${String(i+1).padStart(2,'0')} / ${String(total).padStart(2,'0')}`;
      }
      steps.forEach((el, idx) => {
        if (idx === i) el.style.setProperty('--p', String(sp));
        else el.style.removeProperty('--p');
      });
    };

    const onScroll = () => {
      const rect = cinema.getBoundingClientRect();
      const scrollable = cinema.offsetHeight - innerHeight;
      if (scrollable <= 0) return;
      const p = Math.max(0, Math.min(1, (-rect.top) / scrollable));
      const phaseFloat = p * total;
      const phaseIndex = Math.min(total - 1, Math.floor(phaseFloat));
      setPhase(phaseIndex, phaseFloat - phaseIndex);
    };

    let ticking = false;
    addEventListener('scroll', () => {
      if (!ticking) { ticking = true; requestAnimationFrame(() => { onScroll(); ticking = false; }); }
    }, { passive: true });
    onScroll();
  }
})();
```

### AI-Image-Sequences (Frame-Erzeugung)

**Drei Regeln gegen Drift:**

1. **Master-First, Backward Always:** Finale Phase zuerst erzeugen, dann rückwärts. KI ist besser darin, Elemente zu *entfernen* als hinzuzufügen.
2. **Architecture-Anchor:** Jeder Prompt = `[MASTER-ANCHOR 80%] + [CAMERA-ANCHOR] + [PHASE-DELTA 20%]`
3. **Multi-Image Reference:** Master + letzte erfolgreiche Frame anhängen (Nano Banana / Gemini Flow Image)

**Tool-Vergleich:**

| Tool | Vorteile | Kosten |
|---|---|---|
| Nano Banana / Gemini Flow | Multi-Reference, Konstruktion-stark | ~kostenlos mit Sub |
| Midjourney `--cref` | Konsistent | €0,04/Frame |
| Flux (fal.ai) | Scharf, drift-anfälliger | €0,05/Frame |
| Veo 3/2 | 8s coherent sequences | per Sequence |
| Real Video + ffmpeg | Höchste Qualität | Zeitinvestment |

**ffmpeg von 8s-MP4 zu 75 Frames:**

```bash
ffmpeg -i veo-output.mp4 \
  -vf "fps=9.375,scale=1600:-1" \
  -q:v 4 \
  ./bauphasen/frame_%03d.jpg
```

**sips Batch-Kompression:**

```bash
for f in frame_*.jpg; do
  sips -Z 1600 "$f" --setProperty formatOptions 72 > /dev/null 2>&1
done
```

**Quality-Bandwidth Tradeoffs:**

| Use | Frames | Auflösung | Quality | Total |
|---|---|---|---|---|
| Premium Hero | 80 | 1920×1080 | sips 78 | ~10 MB |
| Standard | 70 | 1600×900 | sips 72 | ~6-7 MB |
| Compact | 50 | 1280×720 | sips 68 | ~3-4 MB |
| Mobile | 40 | 1024×576 | sips 65 | ~2 MB |

**Sweet-Spot Bau-Sites:** 70 Frames @ 1600×900, Quality 72 (~6-7 MB).

### Mobile-First Patterns (Bau-Handschuh-tauglich)

- **Sticky Callbar bottom** mit Tel + WhatsApp, 48-56 px tap-targets
- `body { padding-bottom: 64px; }` auf Mobile (verhindert Overlap)
- **Off-Canvas Nav** auf `max-width: 768px`, JS toggled `site-header.nav-open`
- **XXL-Telefonnummer** in Kontakt: `font-size: clamp(2rem, 10vw, 4rem)`, `href="tel:…"`

### JS-Pattern (Vanilla, kein Framework)

```js
(function() {
  'use strict';
  // 1. Header scroll state
  // 2. Mobile nav toggle
  // 3. Reveal on scroll (IntersectionObserver)
  // 4. FAQ one-open-per-group (details/toggle event)
  // 5. File input filename display
})();
```

No jQuery. Native `scroll-behavior: smooth`, `<details>` für Accordion, `IntersectionObserver` für Reveals.

### Static-HTML-Showcase-Workflow

**Use-Case:** Client-Demo offline, Distribution an non-tech User, Vergleichsmaterial für Designer-Entscheid.

**Render-Pipeline (WP-Theme → Static HTML):**

```python
# render-themes.py — vereinfacht
import re, subprocess, time, requests
from urllib.parse import urlparse

ASSET_EXT = (".jpg", ".jpeg", ".png", ".webp", ".gif", ".svg", ".css", ".js", ".woff", ".woff2")
SKIP_PATHS = ("/wp-admin", "/wp-login", "/xmlrpc", "/wp-cron")

def keep(url):
    path = urlparse(url).path.lower()
    if any(skip in path for skip in SKIP_PATHS): return False
    return path.endswith(ASSET_EXT) or "/bauphasen/" in path

# 1. Start wp-now on free port
# 2. Wait for HTTP 200 + '<html' in body
# 3. Curl page, filter assets via keep()
# 4. Download assets, rewrite paths
# 5. Kill wp-now (lsof -ti :PORT | xargs kill -9)
```

**Python-Bulk-Edit für mehrere Varianten:**

```python
import re

FILES = ["edi-v1-dark-gold.html", "edi-v4-hybrid-bright.html", "edi-v5-pure-light.html"]
TEAM_RE = re.compile(r'<section class="section section--surface" id="team">.*?</section>', re.DOTALL)
NEW_TEAM_HTML = """<section ...>...</section>"""

for fp in FILES:
    s = open(fp).read()
    new_s = TEAM_RE.sub(NEW_TEAM_HTML, s, count=1)
    open(fp, "w").write(new_s)
```

**Distribution-Paket (ZIP für Vater-Demo):**

```
PKB-EDI-Final/
├── ANLEITUNG.txt           ← ASCII-Art, kein Markdown (Windows-Kompatibilität)
├── pkb-1-editorial/        ← index.html + pkb-assets/
├── pkb-2-slate/
├── pkb-3-meister/
├── edi-1-dark-gold/
├── edi-2-hybrid-bright/
└── edi-3-pure-light/
```

**Size-Erwartung:** Variante ohne Bauphasen ~2 MB · mit (75 Frames) ~17-20 MB · 6 Varianten total ~70-80 MB.

### Pitfalls (real production lessons)

1. **Block→Classic Fatal:** wp-now restart nach theme.json-Removal
2. **object-fit: cover** in zu kleinen Strips → "komisch abgeschnitten" abgelehnt
3. **Italic-Akzente** → global override `em, i, cite { font-style: normal; }`
4. **Form-Backend** nicht verdrahtet → CF7/Forminator nach Content-Finalisierung
5. **Hardcoded Tel/Adresse** → ACF-Migration in zweiter Iteration
6. **Logo als JPG** → SVG-Variante für Retina
7. **Hero text-shadow fehlt** → unleserlich auf hellen Foto-Bereichen
8. **FAQ aus Custom Post Types** statt flatter `edi_faqs()` → Schema driftet, Single Source of Truth halten
9. **Asset-Download Pitfall:** beim Static-Render keine `/wp-admin`-Pfade speichern (Filter via `keep()`)
10. **Hero text in Light-Theme** → ohne Override-Block dunkler Text auf dunklem Foto = unlesbar
<!-- SECTION:TECH:END -->

---

<!-- SECTION:VETO:BEGIN -->
## 6. User-Präferenzen + Veto-Liste

**Jonathan hat folgende Präferenzen mehrfach korrigiert — sie gelten als verbindliche Veto-Regeln.**

### PKB-Set (Strikt Monochrom)

1. **Kein Italic — global.** Auch nicht `<em>`, `<cite>`, Blockquotes. Global: `em, i, cite, dfn { font-style: normal !important; }`. Akzente über Farbe/Weight/Spacing, nie Slant.
2. **Strikt monochrom:** Weiß + Dunkelgrau aus Logo-Familie. **KEINE warmen Off-White/Beige/Sand-Töne.** Logo: `#121212` + Grau (`#A9A9A9` → `#7D7D7D`) + Weiß.
3. **Bilder vollständig zeigen:** `object-fit: contain` oder full natural aspect-ratio. Kein cover-Crop bei Marketing-Bildern.
4. **Hero-Bild OBEN im Layout**, direkt unter Nav. Nicht unten "angeklebt". Magazine-Reihenfolge.
5. **Statement-Klammer prominent:** "Wir sind Generalunternehmer" als übergeordnete Aussage muss vor Leistungs-Showcase visuell führen.
6. **Design-Direction:** Editorial Architectural Monochrome (Fraunces Display + Hanken Grotesk, KEINE Inter/Roboto).

### EDI-Set (Dark+Gold + Varianten)

1. **MegaCinema Bauphasen-Scroll — Split-Layout Pflicht:**
   - Bild LINKS (50 %, `object-fit: contain`, gleicher Maßstab)
   - Gewerke-Karten RECHTS im Frame (`max-width: 520px`, border + padding + shadow)
   - **5 Gewerke statt 9 Phasen**
   - Mobile (≤ 880 px): Spalten zu Zeilen
   - **600vh Scroll** (kürzer als PKB's 900vh)

2. **Frames:** Abgerundete Ecken (14–18 px) NUR in Light-Versionen (v5). Dark-Versionen (v1, v4) bleiben sharp corners (0 px).

3. **FAQ auf 6 Top-Fragen reduzieren** statt 18. Flache Liste — wichtigste: Angebotsfrist, Eigenkolonnen, Termintreue, Sicherheitsleistung, PQ-VOB, Auftrags-Ablehnung.

4. **Leistungen kurz:** Max 2–3 Bullets + 1-Satz-Lead pro Karte.

5. **Bauleitung-Sektion:** EIN großes Baustellen-Bild (21/9) + 4 Team-Meta-Items im Grid + Quote-Box. **NICHT** einzelne Member-Cards.

6. **CTA-Blocks zwischen Sektionen:** Mindestens nach Leistungen + vor FAQ. Theme-passend (Dark: Gold-Button, sharp; Light: Dark-Button, pill 999 px).

7. **v5 Pure-Light Spezial:** Hero-Sektion bleibt dunkel als Statement-Insel — komplett heller Hero wirkt zu mau.

8. **CSS-Variable-Overrides:** Explicit Overrides pro Element in Light-Mode nötig — Body-Bg ändert nicht automatisch `--c-text` Variablen.

9. **Anti-Floskel-Regel:** "Ihr starker Partner" / "Tradition trifft Innovation" / "individuelle Lösungen" sind verboten.

10. **Distribution als separate HTML-Folder pro Variante**, nicht ein Master-Index.

### Globale Regeln (für alle künftigen Projekte)

- **KEIN Inter, Roboto, Arial, Helvetica** — als generisch markiert
- **KEIN Italic** als Akzent — User-Veto
- **Bilder vollständig zeigen** (außer Hero-Crop für Drama akzeptabel)
- **Zahlen vor Adjektiven** in jeder Copy
- **Anti-Floskel-Liste** durchgängig anwenden (siehe Section 3)
- **wp-now für lokales Dev** — NICHT Docker, NICHT Homebrew-MAMP
- **Classic PHP Theme** für Onepager — NICHT FSE/Block-Editor
- **Schema.org Single Source of Truth** — FAQPage aus PHP-Function generieren
<!-- SECTION:VETO:END -->

---

<!-- SECTION:QUELLEN:BEGIN -->
## 7. Quellen + Inspirationen

### Stock-Image-Datenbanken (8 validierte Quellen)

| Datenbank | Preis | Stärke | Best For |
|---|---|---|---|
| **Adobe Stock** | 9,99 € (Standard) / 79,99 € für 10er-Pack | Größte DE Bau-Library, beste Filter | PKB + EDI komplett mit 10er-Pack |
| **iStock / Getty** | 12–500 € | Premium Editorial, DE-Locations | Team-Porträts, Subgewerke |
| **Shutterstock** | 9–29 € (Pakete) | B2B-typisch, Volumen | Kurzfristig, Volumen-Abdeckung |
| **Depositphotos** | 0,99–10 € | Günstigste Premium | Rohbau, Kräne, Baustellen-Details |
| **Pexels** | KOSTENLOS (komm.) | Beste freie Berater-/Planungs-Motive | Service-Steps, Backgrounds |
| **Unsplash** | KOSTENLOS (komm.) | Editorial-Look | Hero-Hintergründe, Architektur |
| **Pixabay** | KOSTENLOS | Quantität > Qualität | Fallback einfache Motive |
| **Wikimedia Commons** | KOSTENLOS (CC) | Echte Berlin-Locations | Authentische Kran-/Baustellen-Szenen |

**Budget-Faustregel:** Adobe Stock 10er-Pack (79,99 €) deckt beide Projekte zusammen. **Gesamtbudget: 80–100 €**.

### Top-5-Direkt-Links (PKB — B2C, monochrom)

1. **Hero modernes EFH** — https://stock.adobe.com/de/images/modernes-einfamilienhaus-mit-terrasse/219527977
2. **Sanierung Altbau Berlin** — https://stock.adobe.com/de/search?k=altbau+berlin+sanierung
3. **EFH Familie + Bauarbeiter** — https://www.istockphoto.com/de/fotos/kind-bauarbeiter
4. **MFH modern Berlin** — https://www.istockphoto.com/de/foto/moderne-stadthaus-in-berlin-gm814876482-131890785
5. **Schlüsselübergabe** — https://www.pexels.com/de-de/foto/tur-schlussel-neues-haus-eingang-30332492/

**Stil PKB:** Lightroom desaturieren (Sättigung = 0). Adobe Stock-Filter: `color=000000` für Monochrom-Konsistenz.

### Top-5-Direkt-Links (EDI — B2B, Dark + Gold)

1. **Berlin Baustelle** — https://stock.adobe.com/de/images/berlin-baustelle/187067777
2. **Turmdrehkran + Rohbau MFH** — https://de.depositphotos.com/225029066/stock-photo-tower-crane-unfinished-building-apartment.html
3. **Beton + Kran (gratis)** — https://www.pexels.com/photo/unfinished-concrete-building-with-tower-crane-1402923/
4. **Schalung/Bewehrung** — https://www.istockphoto.com/de/fotos/beton-schalung
5. **Bauleiter Portrait** — https://stock.adobe.com/de/search?k=bauleiter

**Stil EDI:** Kühle/blaue Stunde ODER stahlgrauer Himmel — NICHT warmer Sonnenuntergang (kollidiert mit Gold-Akzent).

### Adobe-Stock-URL-Filter-Pattern

```
&filters[content_type:photo]=1       → nur Fotos
&filters[orientation]=horizontal     → Querformat
&color=000000                        → dominante Farbe schwarz (PKB)
&color=2a2a2a                        → dunkelgrau (EDI dark-Theme)
&order=relevance
```

**Beispiel EDI Hero:**
`https://stock.adobe.com/de/search?k=rohbau+kran&filters[content_type:photo]=1&filters[orientation]=horizontal&color=2a2a2a`

### Authentizitäts-Marker (gegen KI-Slop)

**VERMEIDEN** (sofortiger KI-Verdacht):
- Übertrieben perfekte Beleuchtung, zu sauber, zu symmetrisch
- Bauarbeiter mit nagelneuem Helm + perfekt sauberer Kleidung
- "Glückliche Familie vor unrealistisch perfektem Haus"

**SUCHEN** (echte Authentizitäts-Marker):
- Schmutz/Staub auf Baustelle, realistische Werkzeug-Spuren
- Echte Werkzeuge (Wasserwaage, Akkuschrauber, Verlängerungskabel)
- Deutsche Bauschilder, gelbe EU-Warnschilder
- Berliner Altbau-Stuck, Ost-Plattenbau-Modernisierung

**Berlin-Fundgruben:**
- [Wikimedia Commons: Tower Cranes in Berlin](https://commons.wikimedia.org/wiki/Category:Tower_cranes_in_Berlin)
- [Getty: Berlin Crane (4.072 Premium-Treffer)](https://www.gettyimages.com/photos/berlin-crane)
- [Getty: Berlin Construction Site (11.830)](https://www.gettyimages.com/photos/berlin-construction-site)

### Lightroom-Preset (EDI-Konsistenz)

```
Kontrast:      +20
Sättigung:     -40
Schatten:      -15
Klarheit:      +10
Tint:          neutral bis leicht cool
```

Als `.xmp`-Sidecar speichern, auf alle Referenz-Card-Bilder anwenden.

### Design-Inspirationen (Site-Audits)

**Bau B2B (Negativ-Beispiele):** BAAG · Mastiok · NEUWEST · Günther Bau Potsdam · BMB · NILA · Xpress · Roth-Massivhaus · EWA Hausbau · Baufritz · Modus Projects

**International (Best-in-Class):** BIG (big.dk) · OMA (oma.com) · Hochtief · Züblin · BAM · Max Bögl · Kvadrat · Skanska

**Adjacent Studios:** Linear · Vercel · Resend · Stripe · winno.ch · adhouse.com

### Verknüpfung mit Skills (`~/.claude/skills/`)

| Thema | Skill | Auto-Trigger |
|---|---|---|
| Domain (Bau-Sites bauen) | `construction-website-builder` | DACH-Bauunternehmen, GU, Rohbauer |
| Domain (Alias DE) | `construction-website-de` | "Webseite für Bauunternehmen" |
| SEO | `construction-seo-german` | SEO für Bauunternehmen |
| Copy | `construction-copywriting-german` | Bau-Copy schreiben/umschreiben |
| WP Tech | `wp-classic-onepager` | Custom WordPress + wp-now |
| Multi-Variant Design | `multi-variant-theme-tokens` | "Gib mir 3 Designs" / Token-Flip |
| Scroll-Cinema | `scroll-cinema-patterns` | Bauphasen-Scroll / Mega-Cinema |
| AI-Bilder | `ai-image-sequence` | Konsistente Frame-Sequenzen |

### Verknüpfung mit Memory (`~/.claude/projects/-Users-jonathanries-Documents-Websites/memory/`)

| Memory-File | Inhalt |
|---|---|
| `project_pkb.md` | PKB-spezifisch: V5–V14 Status, aktive Ports |
| `project_edi.md` | EDI-spezifisch: V1–V7 Status, Inhaber-Name, validierte Texte |
| `feedback_design.md` | PKB User-Präferenzen (strict-rules) |
| `feedback_design_edi.md` | EDI User-Präferenzen |
| `knowledge_seo_construction.md` | SEO-Tiefe |
| `knowledge_copywriting_construction.md` | Copy-Tiefe |
| `knowledge_design_patterns.md` | Design-Tiefe |
| `knowledge_stock_images_construction.md` | Stock-Image-Tiefe |
| `knowledge_static_showcase_workflow.md` | Distribution-Tiefe |
<!-- SECTION:QUELLEN:END -->

---

## Editieren mit Tasks/Agents

Diese Datei ist mit `<!-- SECTION:NAME:BEGIN -->` / `<!-- SECTION:NAME:END -->`-Markern strukturiert. Künftige Tasks können einzelne Sections targeten, ohne den Rest anzufassen:

- `SECTION:PROJEKTE` — Projekt-Status + Personas
- `SECTION:SEO` — Keyword-Cluster, Schema, Citations, Konkurrenz
- `SECTION:COPY` — Tonalität, Floskel-Liste, Headlines, CTAs, FAQ, Trust-Microcopy
- `SECTION:DESIGN` — Paletten, Tokens, Light-Overrides, Typo, Komponenten
- `SECTION:TECH` — WP Classic, wp-now, functions.php, Cinema-Pattern, AI-Frames, Mobile, Showcase
- `SECTION:VETO` — User-Präferenzen + globale Regeln
- `SECTION:QUELLEN` — Stock-DBs, Direkt-Links, Inspirationen, Skill/Memory-Verknüpfung

Konventionen:
1. Beim Edit nur Inhalt zwischen den Markern ändern, Marker selbst beibehalten
2. Bei Section-Erweiterung im TOC oben mitziehen
3. Bei größeren Refaktorings: ein neuer Agent pro Section, Output gegen Markers ersetzen

---

*Generiert: 2026-05-26 · 7 parallele Agents (Explore-Modus, read-only) lasen Memory + Skills + Theme-Code. Konsolidiert durch Claude. Bei Updates: einzelne Sections über entsprechenden Agent neu schreiben.*
