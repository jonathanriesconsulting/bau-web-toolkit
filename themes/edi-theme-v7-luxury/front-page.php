<?php
/**
 * Front Page — Onepager Composition.
 */
get_header();
?>

<main id="top">

  <!-- HERO -->
  <section class="hero">
    <div class="hero__bg"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-rohbau-daemmerung.jpg" alt="Rohbau Berlin"></div>
    <div class="container hero__inner">
      <span class="hero__chip"><span class="hero__chip-dot"></span>PQ-VOB präqualifiziert</span>
      <div class="hero__grid">
        <div class="reveal">
          <h1 class="hero__title">
            <span>Rohbau,</span>
            <span class="hero__title-2">der auf Termin steht.</span>
          </h1>
          <p class="hero__sub">Stahlbeton, Mauerwerk, Schalung, Bewehrung — als Subunternehmer für Generalunternehmer in Berlin und Brandenburg. Eigene Kolonnen, dokumentierte Termintreue, Festpreis-Angebot in 5 Werktagen.</p>
          <div class="hero__ctas">
            <a href="#kontakt" class="btn btn--primary">Festpreis anfordern <span class="btn__arrow">→</span></a>
            <a href="#referenzen" class="btn btn--ghost">Referenzliste <span class="btn__arrow">→</span></a>
          </div>
        </div>
        <aside class="hero__side reveal">
          <div class="hero__meta-block hero__meta-block--gold">
            <span class="mono">Termintreue</span>
            <strong>94 %</strong>
          </div>
          <div class="hero__meta-block">
            <span class="mono">GU-Projekte abgeschlossen</span>
            <strong>38</strong>
          </div>
          <div class="hero__meta-block">
            <span class="mono">Mitarbeiter eigene Kolonnen</span>
            <strong>64</strong>
          </div>
          <div class="hero__meta-block">
            <span class="mono">Angebot binnen</span>
            <strong>5 Werktage</strong>
          </div>
          <div class="hero__meta-block">
            <span class="mono">Betriebshaftpflicht</span>
            <strong>10 Mio €</strong>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <!-- INTRO -->
  <section class="section section--surface">
    <div class="container">
      <div class="intro__grid reveal">
        <div>
          <div class="eyebrow"><span class="mono">01 — Positionierung</span><span class="eyebrow__rule"></span></div>
          <h2 class="intro__statement">Was wir bauen, <em>und wofür Sie uns ausschreiben.</em></h2>
        </div>
        <div class="intro__body">
          <p>EDI Hochbau ist Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. Wir arbeiten ausschließlich für GUs — nicht für Endkunden, nicht für Bauträger. Sie schreiben aus, wir liefern Stahlbeton-, Mauerwerks- und Massivbau-Gewerke nach LV, auf Termin, VOB/B-konform.</p>
          <p>Bei uns bekommen Sie, was Sie woanders nicht garantiert bekommen: <b>eigene Kolonnen statt Sub-Sub-Vergabe</b>, eigene Geräte von Liebherr, Doka und PERI, <b>namentlich benannter Bauleiter mit Direktdurchwahl vor Vertragsschluss</b>, dokumentierte Termintreue mit Soll-Ist-Vergleich, und eine PQ-VOB-Präqualifizierung, die § 28e SGB IV Haftung für Ihre Einkaufsabteilung sauber löst.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- LEISTUNGEN -->
  <section class="section" id="leistungen">
    <div class="container">
      <header class="section__head reveal">
        <div>
          <div class="eyebrow"><span class="mono">02 — Leistungsspektrum</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">Fünf Gewerke.<br><b>Eine Verantwortung.</b></h2>
        </div>
        <p class="section__lead">Wir decken den klassischen Rohbau im Hochbau ab — von der Bodenplatte bis zum Dachanschluss. Schnittstellen halten wir bewusst klein, damit Ihre Bauleitung weniger Telefonate hat.</p>
      </header>

      <div class="leistungen__list">

        <article class="leistung leistung--lg reveal">
          <span class="leistung__num">01 / 05 — Stahlbetonbau</span>
          <h3 class="leistung__title">Stahlbeton & Sichtbeton</h3>
          <p class="leistung__lead">Ortbeton, Filigrandecken und Sichtbeton bis SB3 — Eigenüberwachung nach DIN 1045-3, Betongüten C20/25 bis C50/60.</p>
          <ul class="leistung__bullets">
            <li>Bodenplatten · Weiße & schwarze Wannen</li>
            <li>Decken in Ortbeton + Filigran</li>
            <li>Stützen, Wände, Treppenhauskerne</li>
          </ul>
        </article>

        <article class="leistung leistung--md reveal">
          <span class="leistung__num">02 / 05 — Mauerwerksbau</span>
          <h3 class="leistung__title">Mauerwerksbau</h3>
          <p class="leistung__lead">Tragendes und nicht-tragendes Mauerwerk aus Kalksandstein, Porenbeton und Hochlochziegel — statisch geprüft nach DIN 1053 / Eurocode 6.</p>
          <ul class="leistung__bullets">
            <li>Tragende Außenwände</li>
            <li>Innenwände + Schallschutzwände</li>
            <li>Mauerwerksankerschäden-Sanierung</li>
          </ul>
        </article>

        <article class="leistung leistung--sm reveal">
          <span class="leistung__num">03 / 05 — Schalung</span>
          <h3 class="leistung__title">Schalungs­arbeiten</h3>
          <p class="leistung__lead">Decken-, Wand- und Sonderschalungen mit Doka- und PERI-Systemen aus dem eigenen Gerätepark.</p>
          <ul class="leistung__bullets">
            <li>Decken- und Wandschalung</li>
            <li>Sonderschalungen</li>
          </ul>
        </article>

        <article class="leistung leistung--sm reveal">
          <span class="leistung__num">04 / 05 — Bewehrung</span>
          <h3 class="leistung__title">Bewehrungs­arbeiten</h3>
          <p class="leistung__lead">Eigene Eisenflechter-Kolonnen — Verlegung nach Werks- und Verlegeplänen gemäß DIN EN ISO 17660.</p>
          <ul class="leistung__bullets">
            <li>Mattenbewehrung + Stabstahl</li>
            <li>Verlegeprotokolle digital</li>
          </ul>
        </article>

        <article class="leistung leistung--sm reveal">
          <span class="leistung__num">05 / 05 — Massivbau</span>
          <h3 class="leistung__title">Schlüsselfertiger Rohbau</h3>
          <p class="leistung__lead">Rohbau-Komplettpaket inklusive Erdarbeiten, Gründung, Stahlbeton, Mauerwerk.</p>
          <ul class="leistung__bullets">
            <li>Mehrfamilien- und Gewerbebau</li>
            <li>Kita, Schule, Pflege</li>
          </ul>
        </article>

      </div>
    </div>
  </section>

  <!-- CTA nach Leistungen -->
  <section class="cta-strip" aria-label="Festpreis anfordern">
    <div class="container cta-strip__inner reveal">
      <p class="cta-strip__text">LV vorhanden? <b>Festpreis-Angebot in 5 Werktagen.</b></p>
      <a href="#kontakt" class="btn btn--primary">Festpreis anfordern <span class="btn__arrow">→</span></a>
    </div>
  </section>

  <!-- QUOTE -->
  <section class="quote-section">
    <div class="quote-section__inner reveal">
      <span class="mono">Aus 38 abgeschlossenen GU-Projekten</span>
      <p class="quote-section__text">„Wir sagen lieber rechtzeitig nein als <em>spät verspätet ja.</em>"</p>
      <p class="quote-section__cite">— Amir Dautović · Geschäftsführer</p>
    </div>
  </section>

  <!-- REFERENZEN -->
  <section class="section section--surface" id="referenzen">
    <div class="container">
      <header class="section__head reveal">
        <div>
          <div class="eyebrow"><span class="mono">03 — Ausgewählte Projekte</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">38 abgeschlossene Projekte.<br><b>Sechs im Detail.</b></h2>
        </div>
        <p class="section__lead">Auswahl der letzten 18 Monate. Vollständige Referenzliste mit GU-Namen und Ansprechpartnern stellen wir nach NDA bereit.</p>
      </header>

      <div class="referenzen__grid">
        <article class="referenz reveal">
          <span class="referenz__num">01</span>
          <span class="referenz__type">Wohnungsbau · MFH</span>
          <h3 class="referenz__title">Rohbau MFH Adlershof — 38 WE Stahlbeton</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>2,4 Mio €</strong></div>
            <div><span>Bauzeit</span><strong>9 Monate</strong></div>
            <div><span>Standort</span><strong>Adlershof</strong></div>
            <div><span>Termin</span><strong>+ 0 Tage</strong></div>
          </div>
        </article>
        <article class="referenz reveal">
          <span class="referenz__num">02</span>
          <span class="referenz__type">Gewerbe · Logistik</span>
          <h3 class="referenz__title">Logistikhalle Schönefeld — 12.000 m²</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>1,8 Mio €</strong></div>
            <div><span>Bauzeit</span><strong>5 Monate</strong></div>
            <div><span>Standort</span><strong>Schönefeld</strong></div>
            <div><span>Termin</span><strong>− 5 Tage</strong></div>
          </div>
        </article>
        <article class="referenz reveal">
          <span class="referenz__num">03</span>
          <span class="referenz__type">Wohnungsbau · Quartier</span>
          <h3 class="referenz__title">Quartier Köpenick — 4 Gebäude, 86 WE</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>5,1 Mio €</strong></div>
            <div><span>Bauzeit</span><strong>14 Monate</strong></div>
            <div><span>Standort</span><strong>Köpenick</strong></div>
            <div><span>Termin</span><strong>+ 3 Tage</strong></div>
          </div>
        </article>
        <article class="referenz reveal">
          <span class="referenz__num">04</span>
          <span class="referenz__type">Bildung · Sichtbeton</span>
          <h3 class="referenz__title">Kita Pankow — SB3 Sichtbeton-Tragwerk</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>980 k€</strong></div>
            <div><span>Bauzeit</span><strong>6 Monate</strong></div>
            <div><span>Standort</span><strong>Pankow</strong></div>
            <div><span>Termin</span><strong>+ 0 Tage</strong></div>
          </div>
        </article>
        <article class="referenz reveal">
          <span class="referenz__num">05</span>
          <span class="referenz__type">Gewerbe · Bürohaus</span>
          <h3 class="referenz__title">Bürogebäude Mitte — 6 Geschosse</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>3,2 Mio €</strong></div>
            <div><span>Bauzeit</span><strong>11 Monate</strong></div>
            <div><span>Standort</span><strong>Mitte</strong></div>
            <div><span>Termin</span><strong>+ 0 Tage</strong></div>
          </div>
        </article>
        <article class="referenz reveal">
          <span class="referenz__num">06</span>
          <span class="referenz__type">Industrie · Tiefgarage</span>
          <h3 class="referenz__title">Tiefgarage Potsdam — 280 Stellplätze WU</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>2,1 Mio €</strong></div>
            <div><span>Bauzeit</span><strong>7 Monate</strong></div>
            <div><span>Standort</span><strong>Potsdam</strong></div>
            <div><span>Termin</span><strong>+ 2 Tage</strong></div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- FAQ — 6 Top-Fragen der GU-Einkaufsabteilung -->
  <section class="section" id="faq">
    <div class="container">
      <header class="section__head reveal">
        <div>
          <div class="eyebrow"><span class="mono">04 — Häufige Fragen</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">Was Einkaufsabteilungen<br><b>uns fragen.</b></h2>
        </div>
        <p class="section__lead">Die sechs Fragen, die in fast jeder GU-Anfrage auftauchen — direkt beantwortet. Alles Weitere klären wir am Telefon oder im LV-Gespräch.</p>
      </header>
      <div class="faq__list reveal">
        <details class="faq__item"><summary class="faq__summary"><span>Wie schnell bekommen wir ein Angebot?</span><span class="faq__icon">+</span></summary><div class="faq__body">5 Werktage bei vollständigem LV. Bei dringenden Projekten indikatives Festpreis-Band binnen 48 Stunden mit ausdrücklichem Vorbehalt — finales Angebot folgt nach LV-Prüfung.</div></details>
        <details class="faq__item"><summary class="faq__summary"><span>Pauschal- oder Einheitspreis?</span><span class="faq__icon">+</span></summary><div class="faq__body">Standard ist VOB/B-Einheitspreis. Pauschal nur bei vollständig geplantem Leistungsumfang und sauber abgegrenztem Risiko. Mengenmehrungen über 10&nbsp;% nach § 2 Abs. 3 VOB/B werden neu kalkuliert.</div></details>
        <details class="faq__item"><summary class="faq__summary"><span>Sub-Sub-Vergabe?</span><span class="faq__icon">+</span></summary><div class="faq__body">Nein. Stahlbeton, Mauerwerk, Schalung und Bewehrung führen wir mit eigenen Kolonnen aus — 64 Mitarbeiter in 6 Kolonnen. Nur Spezial-Leistungen werden an gelistete Nachunternehmer vergeben, mit Ihrer schriftlichen Freigabe.</div></details>
        <details class="faq__item"><summary class="faq__summary"><span>Akzeptieren Sie Vertragsstrafen?</span><span class="faq__icon">+</span></summary><div class="faq__body">Ja, im BGH-konformen Rahmen: maximal 5&nbsp;% der Auftragssumme als Obergrenze, gestaffelt nach Verzugswochen, mit Karenz von 5 Werktagen. Sittenwidrige Klauseln ohne Cap lehnen wir ab.</div></details>
        <details class="faq__item"><summary class="faq__summary"><span>Wie ist die dokumentierte Termintreue?</span><span class="faq__icon">+</span></summary><div class="faq__body">94&nbsp;% der Projekte der letzten 24 Monate im vertraglich vereinbarten Termin. Beim Rest lag der Verzug im Schnitt bei 3 Werktagen — ausschließlich aus nicht von uns zu vertretenden Gründen, dokumentiert im Soll-Ist-Vergleich.</div></details>
        <details class="faq__item"><summary class="faq__summary"><span>PQ-VOB-Status?</span><span class="faq__icon">+</span></summary><div class="faq__body">Präqualifiziert nach VOB mit jährlicher Verlängerung. § 28e SGB IV Haftung Ihrer Einkaufsabteilung ist damit sauber gelöst; Freistellungsbescheinigung nach § 48b EStG aktiv.</div></details>
      </div>
    </div>
  </section>

  <!-- KONTAKT -->
  <section class="section" id="kontakt">
    <div class="container">
      <header class="section__head reveal">
        <div>
          <div class="eyebrow"><span class="mono">05 — Anfrage einreichen</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">LV einreichen.<br><b>Antwort am selben Werktag.</b></h2>
        </div>
        <p class="section__lead">Schicken Sie uns Ihr Leistungsverzeichnis oder schildern Sie das Vorhaben in zwei Sätzen. Festpreis-Angebot in 5 Werktagen, indikatives Band bei dringenden Projekten binnen 48 Stunden.</p>
      </header>

      <div class="kontakt__grid">
        <div class="reveal">
          <p class="mono">Direkter Draht zur Bauleitung</p>
          <span class="kontakt__phone">EDI Hochbau GmbH</span>
          <p style="color:var(--c-text-2);max-width:36ch;font-weight:300;line-height:1.75">Bauleitung direkt erreichbar Mo–Fr 7–18 Uhr. Außerhalb der Geschäftszeiten Notruf-Weiterleitung an den wachhabenden Bauleiter.</p>

          <div class="kontakt__channels">
            <div class="kontakt__channel"><span class="mono">E-Mail Kalkulation</span><strong>kalkulation@edi-hochbau.de</strong></div>
            <div class="kontakt__channel"><span class="mono">LV-Upload</span><strong>edi-hochbau.de/upload</strong></div>
            <div class="kontakt__channel"><span class="mono">Adresse</span><strong>Berlin · Brandenburg</strong></div>
            <div class="kontakt__channel"><span class="mono">PQ-VOB</span><strong>präqualifiziert · jährlich verlängert</strong></div>
          </div>
        </div>

        <form class="kontakt__form reveal">
          <div class="kontakt__row">
            <div class="kontakt__field"><label>Generalunternehmen</label><input type="text"></div>
            <div class="kontakt__field"><label>Ansprechpartner</label><input type="text"></div>
          </div>
          <div class="kontakt__row">
            <div class="kontakt__field"><label>Telefon</label><input type="tel"></div>
            <div class="kontakt__field"><label>E-Mail</label><input type="email"></div>
          </div>
          <div class="kontakt__field"><label>Projekttyp</label>
            <select><option>Wohnungsbau MFH</option><option>Gewerbebau Büro</option><option>Industrie Logistik</option><option>Bildung Kita / Schule</option><option>Tiefgarage WU-Beton</option></select>
          </div>
          <div class="kontakt__field"><label>Kurzbeschreibung Vorhaben</label><textarea></textarea></div>
          <button class="kontakt__submit">Festpreis anfordern <span class="btn__arrow">→</span></button>
        </form>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
