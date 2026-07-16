<?php
/**
 * Front Page — Onepager Composition.
 */
get_header();
?>

<main id="top">

  <!-- HERO -->
  <section class="hero">
    <div class="hero__bg"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero.jpg" alt="Rohbau in Berlin"></div>
    <div class="hero__grid-overlay"></div>
    <div class="container hero__inner">
      <div class="hero__chips reveal">
        <span class="chip chip--gold"><span class="chip-dot"></span>PQ-VOB präqualifiziert · Nr. 12345</span>
        <span class="chip">Berlin · Brandenburg · 120 km</span>
      </div>
      <h1 class="hero__title reveal">
        <span>Rohbau,</span>
        <span class="hero__title-2">der auf Termin steht.</span>
      </h1>
      <p class="hero__sub reveal">Stahlbeton, Mauerwerk, Schalung, Bewehrung — als Subunternehmer für Generalunternehmer in Berlin und Brandenburg. <b>PQ-VOB präqualifiziert, eigene Kolonnen, 94 % dokumentierte Termintreue.</b> Festpreis-Angebot in 5 Werktagen.</p>
      <div class="hero__ctas reveal">
        <a href="#kontakt" class="btn btn--primary">Festpreis anfordern <span class="btn__arrow">→</span></a>
        <a href="#referenzen" class="btn btn--ghost">Referenzliste <span class="btn__arrow">→</span></a>
      </div>
      <div class="hero__meta-bar reveal">
        <div class="hero__meta-item"><span class="mono">Termintreue</span><strong style="color:var(--c-gold)">94 %</strong></div>
        <div class="hero__meta-item"><span class="mono">GU-Projekte</span><strong>38 abgeschlossen</strong></div>
        <div class="hero__meta-item"><span class="mono">Mitarbeiter</span><strong>64 eigene</strong></div>
        <div class="hero__meta-item"><span class="mono">Angebot</span><strong>5 Werktage</strong></div>
        <div class="hero__meta-item"><span class="mono">Haftpflicht</span><strong>10 Mio €</strong></div>
      </div>
    </div>
  </section>

  <!-- TRUST-STRIP -->
  <div class="trust-strip">
    <div class="container">
      <div class="trust-strip__inner">
        <span><b>PQ-VOB</b> Nr. 12345</span>
        <span><b>VOB/B</b> Vertragsbasis</span>
        <span><b>BG BAU</b> Unbedenklichkeit</span>
        <span><b>SOKA-BAU</b> aktiv</span>
        <span><b>§ 48b EStG</b> Freistellung</span>
        <span><b>HRB Berlin</b> 12345</span>
      </div>
    </div>
  </div>

  <!-- INTRO -->
  <section class="section">
    <div class="container">
      <div class="intro__grid reveal">
        <div>
          <div class="eyebrow"><span class="mono">01 · Positionierung</span><span class="eyebrow__rule"></span></div>
          <h2 class="intro__statement">Was wir bauen — <em>und wofür Sie uns ausschreiben.</em></h2>
        </div>
        <div class="intro__body">
          <p>EDI Hochbau ist Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. Wir arbeiten ausschließlich für GUs — nicht für Endkunden, nicht für Bauträger. Sie schreiben aus, wir liefern Stahlbeton-, Mauerwerks- und Massivbau-Gewerke nach LV, auf Termin, VOB/B-konform.</p>
          <p>Bei uns bekommen Sie, was Sie woanders nicht garantiert bekommen: <b>eigene Kolonnen statt Sub-Sub-Vergabe</b>, eigene Geräte (Liebherr, Doka, PERI), <b>namentlich benannter Bauleiter mit Direktdurchwahl vor Vertragsschluss</b>, dokumentierte Termintreue mit Soll-Ist-Vergleich, und eine PQ-VOB-Präqualifizierung, die § 28e SGB IV Haftung für Ihre Einkaufsabteilung sauber löst.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- LEISTUNGEN -->
  <section class="section" id="leistungen" style="padding-block:0">
    <div class="container" style="padding-bottom:0">
      <header class="section__head reveal" style="padding-block:clamp(6rem,10vw,9rem) 0;margin-bottom:clamp(3rem,5vw,5rem)">
        <div>
          <div class="eyebrow"><span class="mono">02 · Leistungsspektrum</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">Fünf Gewerke.<br>Eine Verantwortung.</h2>
        </div>
        <p class="section__lead">Wir decken den klassischen Rohbau im Hochbau ab — von der Bodenplatte bis zum Dachanschluss. Schnittstellen halten wir bewusst klein, damit Ihre Bauleitung weniger Telefonate hat.</p>
      </header>
    </div>
    <div class="container" style="padding-inline:0">
      <div class="leistungen__list">

        <article class="leistung leistung--lg reveal">
          <span class="leistung__num">01 / 05 — Stahlbetonbau</span>
          <h3 class="leistung__title">Stahlbeton & Sichtbeton</h3>
          <p class="leistung__lead">Ortbeton, Halbfertigteile, Filigrandecken, Sichtbeton bis SB3. Eigenüberwachung nach DIN 1045-3, dokumentiert je Charge. Betongüten C20/25 bis C50/60.</p>
          <ul class="leistung__bullets">
            <li>Bodenplatten · Weiße & schwarze Wannen</li>
            <li>Decken in Ortbeton + Filigran</li>
            <li>Stützen, Wände, Treppenhauskerne</li>
            <li>Sichtbeton SB2 / SB3 nach DBV-Merkblatt</li>
          </ul>
        </article>

        <article class="leistung leistung--md reveal">
          <span class="leistung__num">02 / 05 — Mauerwerksbau</span>
          <h3 class="leistung__title">Mauerwerksbau</h3>
          <p class="leistung__lead">Tragend und nicht-tragend. Kalksandstein, Porenbeton, Hochlochziegel. Statisch geprüfte Ausführung nach DIN 1053 / Eurocode 6.</p>
          <ul class="leistung__bullets">
            <li>Tragende Außenwände</li>
            <li>Innenwände + Schallschutzwände</li>
            <li>Mauerwerksankerschäden-Sanierung</li>
          </ul>
        </article>

        <article class="leistung leistung--sm reveal">
          <span class="leistung__num">03 / 05 — Schalung</span>
          <h3 class="leistung__title">Schalungs­arbeiten</h3>
          <p class="leistung__lead">Doka Framax Xlife + PERI im eigenen Park. Sondergewerke mit Verfügbarkeitszusage.</p>
          <ul class="leistung__bullets">
            <li>Decken- und Wandschalung</li>
            <li>Sonderschalungen</li>
          </ul>
        </article>

        <article class="leistung leistung--sm reveal">
          <span class="leistung__num">04 / 05 — Bewehrung</span>
          <h3 class="leistung__title">Bewehrungs­arbeiten</h3>
          <p class="leistung__lead">Eigene Eisenflechter-Kolonnen. Werks- und Verlegepläne nach DIN EN ISO 17660.</p>
          <ul class="leistung__bullets">
            <li>Mattenbewehrung + Stabstahl</li>
            <li>Verlegeprotokolle digital</li>
          </ul>
        </article>

        <article class="leistung leistung--sm reveal">
          <span class="leistung__num">05 / 05 — Massivbau</span>
          <h3 class="leistung__title">Schlüsselfertiger Rohbau</h3>
          <p class="leistung__lead">Rohbau-Komplettpaket inkl. Erdarbeiten, Gründung, Stahlbeton, Mauerwerk.</p>
          <ul class="leistung__bullets">
            <li>Mehrfamilien- und Gewerbebau</li>
            <li>Kita, Schule, Pflege</li>
          </ul>
        </article>

      </div>
    </div>
  </section>

  <!-- REFERENZEN -->
  <section class="section" id="referenzen" style="padding-block:0">
    <div class="container" style="padding-bottom:0">
      <header class="section__head reveal" style="padding-block:clamp(6rem,10vw,9rem) 0;margin-bottom:clamp(3rem,5vw,5rem)">
        <div>
          <div class="eyebrow"><span class="mono">03 · Ausgewählte Projekte</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">38 GU-Projekte.<br>Sechs im Detail.</h2>
        </div>
        <p class="section__lead">Auswahl der letzten 18 Monate. Vollständige Referenzliste mit GU-Namen und Ansprechpartnern nach NDA.</p>
      </header>
    </div>
    <div class="container" style="padding-inline:0;border-bottom:1px solid var(--c-line)">
      <div class="referenzen__grid">
        <article class="referenz reveal">
          <span class="referenz__num">01</span>
          <span class="referenz__type">Wohnungsbau · MFH</span>
          <h3 class="referenz__title">Rohbau MFH Adlershof — 38 WE Stahlbeton</h3>
          <div class="referenz__meta">
            <div><span>Volumen</span><strong>2,4 Mio €</strong></div>
            <div><span>Bauzeit</span><strong>9 Monate</strong></div>
            <div><span>Standort</span><strong>Berlin-Adlershof</strong></div>
            <div><span>Termin</span><strong>+ 0 Tage</strong></div>
          </div>
        </article>
        <article class="referenz reveal">
          <span class="referenz__num">02</span>
          <span class="referenz__type">Gewerbe · Logistik</span>
          <h3 class="referenz__title">Logistikhalle Schönefeld — 12.000 m² BP</h3>
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
          <h3 class="referenz__title">Quartier Köpenick — 4 Gebäude · 86 WE</h3>
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

  <!-- KONTAKT -->
  <section class="section" id="kontakt">
    <div class="container">
      <header class="section__head reveal">
        <div>
          <div class="eyebrow"><span class="mono">04 · Anfrage</span><span class="eyebrow__rule"></span></div>
          <h2 class="section__title">LV einreichen.<br><span style="color:var(--c-gold)">Antwort am selben Werktag.</span></h2>
        </div>
        <p class="section__lead">Schicken Sie uns Ihr Leistungsverzeichnis oder schildern Sie das Vorhaben in zwei Sätzen. Festpreis-Angebot in 5 Werktagen, indikatives Band binnen 48 Stunden.</p>
      </header>

      <div class="kontakt__grid">
        <div class="reveal">
          <p class="mono">Direkter Draht</p>
          <a href="tel:+493000000000" class="kontakt__phone">+49 30 0000 0000</a>
          <p style="color:var(--c-text-2);max-width:36ch">Bauleitung direkt erreichbar Mo–Fr 7–18 Uhr. Außerhalb der Geschäftszeiten Notruf-Weiterleitung.</p>

          <div class="kontakt__channels">
            <div class="kontakt__channel"><span class="mono">E-Mail Kalkulation</span><strong>kalkulation@edi-hochbau.de</strong></div>
            <div class="kontakt__channel"><span class="mono">LV-Upload</span><strong>edi-hochbau.de/upload</strong></div>
            <div class="kontakt__channel"><span class="mono">Adresse</span><strong>Berlin · Brandenburg</strong></div>
            <div class="kontakt__channel"><span class="mono">HRB Berlin</span><strong>HRB 12345 B</strong></div>
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
          <div class="kontakt__field"><label>Kurzbeschreibung</label><textarea></textarea></div>
          <button class="kontakt__submit">Festpreis anfordern <span class="btn__arrow">→</span></button>
        </form>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
