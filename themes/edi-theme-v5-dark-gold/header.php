<?php
/**
 * Header template.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert, 94 % dokumentierte Termintreue, VOB/B-konform. Festpreis-Angebot in 5 Werktagen.">
<meta name="theme-color" content="#0a0a0c">
<link rel="canonical" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<link rel="alternate" hreflang="de-DE" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="EDI Hochbau GmbH">
<meta property="og:locale" content="de_DE">
<meta property="og:title" content="Rohbau-Subunternehmer für Generalunternehmer Berlin &amp; Brandenburg | EDI Hochbau GmbH">
<meta property="og:description" content="Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert, 94 % dokumentierte Termintreue, VOB/B-konform. Festpreis-Angebot in 5 Werktagen.">
<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero.jpg">
<meta property="og:image:width" content="2200">
<meta property="og:image:height" content="1228">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Rohbau-Subunternehmer für Generalunternehmer Berlin &amp; Brandenburg | EDI Hochbau GmbH">
<meta name="twitter:description" content="Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert, 94 % dokumentierte Termintreue, VOB/B-konform. Festpreis-Angebot in 5 Werktagen.">
<meta name="twitter:image" content="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero.jpg">
<meta name="geo.region" content="DE-BE">
<meta name="geo.placename" content="Berlin">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero.jpg" fetchpriority="high">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500&display=swap">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["GeneralContractor","LocalBusiness"],
  "name": "EDI Hochbau GmbH",
  "alternateName": "EDI",
  "slogan": "Rohbau, der auf Termin steht.",
  "description": "Rohbau- und Massivbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert, VOB/B-konform, eigene Kolonnen.",
  "telephone": "+49-30-XXXXXXX",
  "email": "kontakt@edi-hochbau.de",
  "url": "https://edi-hochbau.de/",
  "image": "<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero.jpg",
  "address": {"@type":"PostalAddress","addressLocality":"Berlin","addressRegion":"Berlin","addressCountry":"DE"},
  "geo": {"@type":"GeoCoordinates","latitude":52.52,"longitude":13.405},
  "areaServed":[{"@type":"City","name":"Berlin"},{"@type":"City","name":"Potsdam"},{"@type":"City","name":"Brandenburg an der Havel"},{"@type":"AdministrativeArea","name":"Brandenburg"}],
  "serviceArea":{"@type":"GeoCircle","geoMidpoint":{"@type":"GeoCoordinates","latitude":52.52,"longitude":13.405},"geoRadius":"120000"},
  "knowsAbout":["Rohbau","Stahlbetonbau","Mauerwerksbau","Schalungsarbeiten","Bewehrungsarbeiten","Massivbau","VOB/B","PQ-VOB","Filigrandecken","Sichtbeton"],
  "numberOfEmployees":{"@type":"QuantitativeValue","value":64},
  "priceRange":"€€-€€€"
}
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" id="site-header">
  <div class="site-header__inner">
    <a href="#top" class="brand" aria-label="EDI Hochbau GmbH — Startseite">
      <span class="brand__mark"><span>E</span></span>
      <span class="brand__text">
        <span class="brand__name">EDI Hochbau</span>
        <span class="brand__tagline">GmbH · Berlin</span>
      </span>
    </a>
    <nav class="nav" aria-label="Hauptnavigation">
      <ul class="nav__list">
        <li><a class="nav__link" href="#leistungen">Leistungen</a></li>
        <li><a class="nav__link" href="#referenzen">Referenzen</a></li>
        <li><a class="nav__link" href="#zusammenarbeit">Zusammenarbeit</a></li>
        <li><a class="nav__link" href="#team">Bauleitung</a></li>
        <li><a class="nav__link" href="#faq">Fragen</a></li>
      </ul>
      <a href="#kontakt" class="nav__cta">LV einreichen <span class="btn__arrow">→</span></a>
    </nav>
  </div>
</header>
