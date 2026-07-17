<?php
/**
 * Header template.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Rohbau-Subunternehmer für GUs. PQ-VOB, 94 % Termintreue, VOB/B, eigene Kolonnen.">
<meta name="theme-color" content="#0a0a0e">
<link rel="canonical" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<link rel="alternate" hreflang="de-DE" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="EDI Hochbau GmbH">
<meta property="og:locale" content="de_DE">
<meta property="og:title" content="Rohbau-Subunternehmer für Generalunternehmer Berlin &amp; Brandenburg | EDI Hochbau GmbH">
<meta property="og:description" content="Rohbau-Subunternehmer für GUs. PQ-VOB, 94 % Termintreue, VOB/B, eigene Kolonnen.">
<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-rohbau-daemmerung.jpg">
<meta property="og:image:width" content="2400">
<meta property="og:image:height" content="1600">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Rohbau-Subunternehmer für Generalunternehmer Berlin &amp; Brandenburg | EDI Hochbau GmbH">
<meta name="twitter:description" content="Rohbau-Subunternehmer für GUs. PQ-VOB, 94 % Termintreue, VOB/B, eigene Kolonnen.">
<meta name="twitter:image" content="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-rohbau-daemmerung.jpg">
<meta name="geo.region" content="DE-BE">
<meta name="geo.placename" content="Berlin">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-rohbau-daemmerung.jpg" fetchpriority="high">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Manrope:wght@200;300;400;500;600&family=JetBrains+Mono:wght@300;400&display=swap">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["GeneralContractor","LocalBusiness"],
  "name": "EDI Hochbau GmbH",
  "alternateName": "EDI",
  "slogan": "Rohbau, der auf Termin steht.",
  "description": "Rohbau- und Massivbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert, VOB/B-konform, eigene Kolonnen.",
  "email": "kontakt@edi-hochbau.de",
  "url": "https://edi-hochbau.de/",
  "image": "<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-rohbau-daemmerung.jpg",
  "address": {"@type":"PostalAddress","addressLocality":"Berlin","addressRegion":"Berlin","addressCountry":"DE"},
  "geo": {"@type":"GeoCoordinates","latitude":52.52,"longitude":13.405},
  "areaServed":[{"@type":"City","name":"Berlin"},{"@type":"City","name":"Potsdam"},{"@type":"City","name":"Brandenburg an der Havel"},{"@type":"AdministrativeArea","name":"Brandenburg"}],
  "serviceArea":{"@type":"GeoCircle","geoMidpoint":{"@type":"GeoCoordinates","latitude":52.52,"longitude":13.405},"geoRadius":"120000"},
  "knowsAbout":["Rohbau","Stahlbetonbau","Mauerwerksbau","Schalungsarbeiten","Bewehrungsarbeiten","Massivbau","VOB/B","PQ-VOB","Filigrandecken","Sichtbeton"],
  "numberOfEmployees":{"@type":"QuantitativeValue","value":64},
  "priceRange":"€€-€€€"
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Wie schnell bekommen wir ein Angebot?","acceptedAnswer":{"@type":"Answer","text":"5 Werktage bei vollständigem LV. Bei dringenden Projekten indikatives Festpreis-Band binnen 48 Stunden mit ausdrücklichem Vorbehalt."}},
{"@type":"Question","name":"Pauschal- oder Einheitspreis?","acceptedAnswer":{"@type":"Answer","text":"Standard ist VOB/B-Einheitspreis. Pauschal nur bei vollständig geplantem Leistungsumfang. Mengenmehrungen über 10 % nach § 2 Abs. 3 VOB/B werden neu kalkuliert."}},
{"@type":"Question","name":"Sub-Sub-Vergabe?","acceptedAnswer":{"@type":"Answer","text":"Nein. Stahlbeton, Mauerwerk, Schalung und Bewehrung führen wir mit eigenen Kolonnen aus — 64 Mitarbeiter in 6 Kolonnen. Nur Spezial-Leistungen an gelistete Nachunternehmer, mit schriftlicher Freigabe."}},
{"@type":"Question","name":"Akzeptieren Sie Vertragsstrafen?","acceptedAnswer":{"@type":"Answer","text":"Ja, im BGH-konformen Rahmen: maximal 5 % der Auftragssumme, gestaffelt, mit Karenz von 5 Werktagen."}},
{"@type":"Question","name":"Wie ist die dokumentierte Termintreue?","acceptedAnswer":{"@type":"Answer","text":"94 % der Projekte der letzten 24 Monate im vertraglich vereinbarten Termin, dokumentiert im Soll-Ist-Vergleich."}},
{"@type":"Question","name":"PQ-VOB-Status?","acceptedAnswer":{"@type":"Answer","text":"Präqualifiziert nach VOB mit jährlicher Verlängerung. § 28e SGB IV sauber gelöst, Freistellungsbescheinigung nach § 48b EStG aktiv."}}
]}
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" id="site-header">
  <div class="site-header__inner">
    <a href="#top" class="brand">
      <span class="brand__mark">E</span>
      <span class="brand__text"><span class="brand__name">EDI Hochbau</span><span class="brand__tagline">GmbH · Est. 2018</span></span>
    </a>
    <nav class="nav">
      <ul class="nav__list">
        <li><a class="nav__link" href="#leistungen">Leistungen</a></li>
        <li><a class="nav__link" href="#referenzen">Referenzen</a></li>
        <li><a class="nav__link" href="#kontakt">Kontakt</a></li>
      </ul>
      <a href="#kontakt" class="nav__cta">LV einreichen <span class="btn__arrow">→</span></a>
    </nav>
  </div>
</header>
