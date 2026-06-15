# Sections-Blueprint für Bau-Onepager

Validierter Aufbau aus PKB V5/V11 + EDI-Implementation. Pro Section: was rein muss, welche Trust-Signale, welche Conversion-Trigger.

---

## 1. HERO

**Pflicht:**
- H1 max 64–80px, klare Aussage (was + für wen + region)
- Lead 1–2 Sätze, max 50–60 Zeichen pro Zeile
- 2 CTAs — Primary („Erstgespräch") + Secondary („Bauablauf ansehen")
- Status-Pill mit Pulse (z.B. „Aufträge ab Q3 2026 buchbar")
- Region-Chip (z.B. „Düsseldorf · DE" oder „Berlin · Brandenburg")
- Meta-Strip unten mit 3–4 Trust-Facts (Jahre / Qualifikation / Region / Erstgespräch)

**Bild-Option A (Split):** Bild rechts in Karte (5:4 oder 4:5), Text links
**Bild-Option B (Full-Bleed):** Bild fullbleed, Text als Overlay mit Vignette — **stärker** für Bau, weil das Resultat sofort sichtbar

**Trust-Signale ABOVE-THE-FOLD:**
- Konkrete Jahreszahl Erfahrung (nicht „langjährig")
- Meisterbrief / Zertifizierung wenn vorhanden
- Telefonnummer im Header als `tel:` Link

---

## 2. LEISTUNGEN

**Pflicht:**
- 3 klar abgegrenzte Schwerpunkte (z.B. Sanierung / EFH / MFH)
- Pro Karte: Bild + Lead + 4–6 Bullets + Preis-Indikation + Bauzeit

**Layout-Empfehlung:** Alternierend Bild-links/-rechts (V1-Style). Card-Höhe min 360px. Bilder echt (keine Stockphotos!).

**Preis-Transparenz:** Lieber „ab 1.800 €/m²" als „individuell" — schafft Vertrauen, filtert nicht-passende Anfragen.

**Bauzeit-Range:** Konkret („6–12 Monate") nicht „je nach Projekt".

**Tag-Overlay** wenn etwas nicht sofort verfügbar: „Ab Q3 2026 buchbar" auf MFH bei jungen GUs.

---

## 3. ABLAUF (Killer-Section)

**Zwei Varianten — beide validiert:**

### Variante A: Hybrid (V5 final)
- Intro mit Eyebrow + Title + Lead
- Pre-Bau Cards: Beraten + Entwerfen als 2 kompakte Cards side-by-side
- Mega-Cinema fullbleed: 9 Bauphasen scroll-driven (Bauen)
- Finale Card: Schlüsselübergabe als feature-card mit fertigem Haus

### Variante B: 4 Master-Phasen fullbleed (V12 Editorial)
- Alle 4 Schritte (Beraten / Entwerfen / Bauen / Übergabe) als Full-Bleed Sticky Cinema
- Pro Stage: großer Phase-Title, Subtitle, Description, 4 floating Callouts

**Pflicht-Daten pro Phase:**
- Phase-Nummer (01/04)
- Title (1 Wort idealerweise)
- Subtitle (Detail)
- Description (1–2 Sätze)
- Callouts (3–4 konkrete Tags z.B. „Bauantrag" / „Statik" / „48h Antwort")

→ Implementierung in scroll-cinema-patterns Skill.

---

## 4. ÜBER (Person-of-the-Founder)

**Pflicht bei 1-Mann-Meisterbetrieb:**
- Großes Founder-Portrait
- Name + Rolle (z.B. „Pascal Kacemer · Meister im Bauhandwerk")
- 3–4 Absätze persönlich (kein Marketing-Sprech)
- Direkte Quote/Glaubenssatz
- Facts-Sticky-Card: Erfahrung / Qualifikation / Region / Gegründet

**Tonalität:** persönlich, direkt, „handwerklich". Vermeiden: „leidenschaftlich", „passioniert", „innovativ".

**Pattern Quote-Block:**
```
"Bauen ist Vertrauenssache. Und Vertrauen verdient man
sich auf der Baustelle — nicht in der Werbung."
                                — Pascal Kacemer
```

---

## 5. FAQ (Schema.org Goldmine)

**Pflicht:**
- 6–8 Fragen (nicht mehr — wird sonst unübersichtlich)
- Antworten 2–4 Sätze (lang genug für Schema-Substanz, kurz genug für Lesbarkeit)
- Schema.org FAQPage JSON-LD im Head — Google zeigt Rich Snippets

**Top-FAQ-Themen für Bauherren-Familien:**
1. „Was bedeutet Generalunternehmer (GU) konkret für mein Projekt?"
2. „In welcher Region arbeiten Sie?"
3. „Was kostet ein Bauprojekt — gibt es eine Preisliste?"
4. „Wie schnell bekomme ich nach einer Anfrage Rückmeldung?"
5. „Wie lange dauert ein typisches Bauprojekt?"
6. „Welche Zertifikate und Qualifikationen bringen Sie mit?"
7. „Übernehmen Sie auch reine Sanierungen oder nur Neubauten?"
8. „Was passiert, wenn während des Baus etwas schiefläuft?"

**Top-FAQ-Themen für B2B-GUs (Rohbau-Subunternehmer):**
1. „Welche Rohbau-Leistungen können wir an Sie vergeben?"
2. „Wie ist Ihre Versicherungs-/Bonitäts-Situation?"
3. „Welche Kapazitäten haben Sie freie?"
4. „Wie sind Ihre Angebotsformate und Reaktionszeiten?"
5. „Welche Referenzen im GU-Vergabesegment?"

---

## 6. KONTAKT

**Pflicht-Kanäle (in dieser Reihenfolge):**
1. Telefon (klickbar)
2. E-Mail (klickbar)
3. WhatsApp (klickbar für Bauherren!)
4. Anschrift
5. Bürozeiten

**Form-Felder (Minimum):**
- Name + Telefon (Row)
- E-Mail
- Art des Projekts (Dropdown: Sanierung / EFH / MFH / Anderes)
- Vorhaben (Textarea, Placeholder zeigt was reingehört: „Standort, ungefähre Größe, Zeitrahmen…")

**Versprechen:** „48h Antwort" — sichtbar im Eyebrow oder Submit-Button-Nähe.

**Form-Note:** „Form-Versand wird beim Live-Setup mit Plugin (Contact Form 7 / Forminator) verbunden."

---

## Anti-Patterns (was NICHT in eine Bau-Site gehört)

1. **„Über uns" als 1. Section** — wer sich für die Firma interessiert, scrollt eh. Erst Vertrauen via Hero+Leistungen aufbauen.
2. **Newsletter-Anmeldung** — Bauherren wollen anfragen, nicht abonnieren
3. **Blog/News** bei jungen Firmen — leer wirkt schlimmer als gar nicht
4. **Cookies-Modal aggressiv** — für offline-Vorschau OK, live nur das nötige
5. **„Unsere Werte" Section mit Icons** — Floskel-Land, lieber im Über-Text einbauen
6. **Awards/Logos die nicht real sind** — Bauherren prüfen, killt Vertrauen
