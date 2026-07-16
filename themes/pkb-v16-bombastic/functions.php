<?php
/**
 * PKB v15 Final — Pascal Kacemer Bauunternehmung GmbH
 *
 * Merge-Version (Basis V1 Brutalist + Slate + Meister), hell-dominant mit
 * dunklen Kontrast-Inseln. Switzer Display + JetBrains Mono. Großbau-Positionierung.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PKB_THEME_VERSION', '1.7.8-native' );

/**
 * Theme setup.
 */
add_action( 'after_setup_theme', static function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'responsive-embeds' );
	register_nav_menus( [
		'primary' => __( 'Hauptnavigation', 'pkb' ),
		'footer'  => __( 'Footer', 'pkb' ),
	] );
} );

/**
 * Assets: Switzer (Fontshare) + JetBrains Mono (Google), theme stylesheet, main script.
 * Bewusst KEIN Geist/Inter/Roboto.
 */
add_action( 'wp_enqueue_scripts', static function () {
	wp_enqueue_style(
		'pkb-switzer',
		'https://api.fontshare.com/v2/css?f%5B%5D=switzer@400,500,600,700&display=swap',
		[],
		null
	);
	wp_enqueue_style(
		'pkb-mono',
		'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&display=swap',
		[],
		null
	);
	wp_enqueue_style(
		'pkb-theme',
		get_stylesheet_uri(),
		[ 'pkb-switzer', 'pkb-mono' ],
		PKB_THEME_VERSION
	);
	wp_enqueue_script(
		'pkb-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		PKB_THEME_VERSION,
		true
	);

	// Scroll-Reveals/Hero-Zoom auf NATIVEM Scroll: GSAP 3.15 + ScrollTrigger (+ SplitText, seit 3.13 frei).
	// KEIN Lenis/Smooth-Scroll, KEIN Custom-Cursor. bombastic.js degradiert sauber, falls eine Lib fehlt.
	wp_enqueue_script( 'gsap',    'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js', [], null, true );
	wp_enqueue_script( 'gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js', [ 'gsap' ], null, true );
	wp_enqueue_script(
		'pkb-bombastic',
		get_template_directory_uri() . '/assets/js/bombastic.js',
		[ 'gsap', 'gsap-st' ],
		PKB_THEME_VERSION,
		true
	);
} );

/**
 * Preconnect to the GSAP CDN host.
 */
add_action( 'wp_head', static function () {
	echo "<link rel='preconnect' href='https://cdn.jsdelivr.net' crossorigin>\n";
}, 1 );

/**
 * SEO-Kopfzeile: Font-Preconnects, Description, Robots, Canonical, hreflang,
 * Open Graph, Twitter-Card, Geo-Meta, Hero-Preload (LCP). Local SEO Berlin/Brandenburg.
 */
add_action( 'wp_head', static function () {
	$url   = home_url( '/' );
	$theme = get_template_directory_uri();
	$img   = $theme . '/assets/images/hero-mehrfamilienhaus-berlin.jpg';
	$desc  = 'Pascal Kacemer Bauunternehmung GmbH — meistergeführter Generalunternehmer für schlüsselfertigen Hochbau in Berlin und Brandenburg. Mehrfamilienhäuser, Wohnquartiere, Gewerbebau und Sanierung zum verbindlichen Festpreis.';
	$title = 'Generalunternehmer Berlin & Brandenburg — Schlüsselfertiger Hochbau | Pascal Kacemer Bauunternehmung GmbH';

	// Font-Hosts vorverbinden
	echo "<link rel='preconnect' href='https://api.fontshare.com' crossorigin>\n";
	echo "<link rel='preconnect' href='https://fonts.googleapis.com'>\n";
	echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>\n";

	// Hero-Bild für LCP vorladen
	echo '<link rel="preload" as="image" href="' . esc_url( $img ) . '" fetchpriority="high">' . "\n";

	// Description + Canonical + Sprach-Alternativen (robots läuft über den wp_robots-Filter unten → genau EIN Tag)
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	echo '<link rel="alternate" hreflang="de-DE" href="' . esc_url( $url ) . '">' . "\n";
	echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $url ) . '">' . "\n";

	// Open Graph
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="Pascal Kacemer Bauunternehmung GmbH">' . "\n";
	echo '<meta property="og:locale" content="de_DE">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
	echo '<meta property="og:image:width" content="1600">' . "\n";
	echo '<meta property="og:image:height" content="900">' . "\n";
	echo '<meta property="og:image:alt" content="Mehrfamilienhaus im Rohbau mit Baukran — Generalunternehmer Berlin und Brandenburg">' . "\n";

	// Twitter
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url( $img ) . '">' . "\n";

	// Geo (Local SEO — Berlin-Buch)
	echo '<meta name="geo.region" content="DE-BE">' . "\n";
	echo '<meta name="geo.placename" content="Berlin">' . "\n";
	echo '<meta name="geo.position" content="52.6330;13.4955">' . "\n";
	echo '<meta name="ICBM" content="52.6330, 13.4955">' . "\n";
}, 1 );

/**
 * SEO-Titel erzwingen — unabhängig vom WP-Site-Titel (wp-now-Default wäre sonst generisch).
 */
add_filter( 'pre_get_document_title', static function (): string {
	return 'Generalunternehmer Berlin & Brandenburg — Schlüsselfertiger Hochbau | Pascal Kacemer Bauunternehmung GmbH';
} );

/**
 * Robots: genau EIN vollständiges Meta-Tag (erweitert das WordPress-Core-Tag, statt ein zweites zu emittieren).
 */
add_filter( 'wp_robots', static function ( array $robots ): array {
	$robots['index']             = true;
	$robots['follow']            = true;
	$robots['max-snippet']       = '-1';
	$robots['max-image-preview'] = 'large';
	$robots['max-video-preview'] = '-1';
	return $robots;
} );

/**
 * Anchor sections of the onepager. Single source of truth.
 *
 * @return array<int, array{slug:string,label:string}>
 */
function pkb_sections(): array {
	return [
		[ 'slug' => 'leistungen', 'label' => 'Leistungen' ],
		[ 'slug' => 'vorgehen',   'label' => 'Ablauf'     ],
		[ 'slug' => 'ueber',      'label' => 'Über'       ],
		[ 'slug' => 'faq',        'label' => 'FAQ'        ],
		[ 'slug' => 'kontakt',    'label' => 'Kontakt'    ],
	];
}

/**
 * Render a partial section template from /inc/sections.
 */
function pkb_section( string $name ): void {
	$path = get_template_directory() . "/inc/sections/{$name}.php";
	if ( file_exists( $path ) ) {
		include $path;
	}
}

/**
 * FAQ — Großbau-Positionierung. KEINE Gratis-Versprechen.
 * Feeds FAQ-Sektion UND FAQPage-Schema.
 *
 * @return array<int, array{q:string,a:string}>
 */
function pkb_faqs(): array {
	return [
		[
			'q' => 'Welche Projektgrößen übernehmen Sie?',
			'a' => 'Wir realisieren großvolumigen Hochbau als Generalunternehmer — Mehrfamilienhäuser, Wohnquartiere mit mehreren Baukörpern und Gewerbeobjekte in Berlin und Brandenburg. Einzelobjekte im Bestand betreuen wir parallel zu Neubauprojekten.',
		],
		[
			'q' => 'Arbeiten Sie mit verbindlichem Festpreis?',
			'a' => 'Ja. Wir kalkulieren einen verbindlichen Festpreis nach Leistungsverzeichnis — keine offenen Nachträge. Grundlage ist eine vollständige Planung; bei unklarem Leistungsumfang klären wir die Positionen vor Vertragsschluss.',
		],
		[
			'q' => 'Wer ist während des Baus mein Ansprechpartner?',
			'a' => 'Ihnen ist eine feste Bauleitung mit Direktdurchwahl zugeordnet. Pascal Kacemer ist eingetragener Meister im Bauhandwerk und führt die Bauleitung selbst oder benennt sie namentlich vor Baubeginn.',
		],
		[
			'q' => 'Übernehmen Sie auch Sanierung und Bestand?',
			'a' => 'Ja. Kern- und Teilsanierung, energetische Ertüchtigung nach KfW-Standard sowie Anbau, Aufstockung und Umnutzung im genutzten Bestand — auch parallel zu laufenden Neubauprojekten, mit fester Kostenbasis nach Bestandsaufnahme.',
		],
		[
			'q' => 'In welchem Gebiet bauen Sie?',
			'a' => 'Schwerpunkt ist Berlin und das angrenzende Brandenburg. Sitz des Betriebs ist Berlin-Buch. Bauvorhaben außerhalb dieses Radius prüfen wir projektbezogen.',
		],
		[
			'q' => 'Wie läuft eine Anfrage ab?',
			'a' => 'Beschreiben Sie Ihr Bauvorhaben — Objektart, Standort, geplante Wohn- oder Nutzfläche und Zeitrahmen. Liegt ein Leistungsverzeichnis oder eine Planung vor, senden Sie diese mit. Sie erhalten innerhalb von 48 Stunden eine Rückmeldung mit einer ersten Einschätzung zur Machbarkeit und zum weiteren Vorgehen.',
		],
	];
}

/**
 * Schema.org JSON-LD: GeneralContractor + FAQPage.
 */
add_action( 'wp_head', static function () {
	$base = home_url( '/' );

	$theme = get_template_directory_uri();
	$org = [
		'@context'    => 'https://schema.org',
		'@type'       => [ 'GeneralContractor', 'LocalBusiness' ],
		'@id'         => $base . '#organization',
		'name'        => 'Pascal Kacemer Bauunternehmung GmbH',
		'alternateName' => 'PKB Bauunternehmung',
		'description' => 'Meistergeführter Generalunternehmer für schlüsselfertigen Hochbau in Berlin und Brandenburg — Mehrfamilienhäuser, Wohnquartiere, Gewerbebau und Sanierung zum verbindlichen Festpreis.',
		'slogan'      => 'Schlüsselfertiger Hochbau aus einer Hand.',
		'url'         => $base,
		'logo'        => $theme . '/assets/logo.svg',
		'image'       => $theme . '/assets/images/hero-mehrfamilienhaus-berlin.jpg',
		'telephone'   => '+49 30 000 000 00', /* TODO: KUNDE PRÜFEN — echte Nummer */
		'email'       => 'info@kacemer-bau.de', /* TODO: KUNDE PRÜFEN */
		'priceRange'  => '€€€',
		'address'     => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Alt-Buch 57',
			'postalCode'      => '13125',
			'addressLocality' => 'Berlin',
			'addressRegion'   => 'Berlin',
			'addressCountry'  => 'DE',
		],
		'geo'         => [
			'@type'     => 'GeoCoordinates',
			'latitude'  => 52.6330,
			'longitude' => 13.4955,
		],
		'areaServed'  => [
			[ '@type' => 'City', 'name' => 'Berlin' ],
			[ '@type' => 'City', 'name' => 'Potsdam' ],
			[ '@type' => 'City', 'name' => 'Bernau bei Berlin' ],
			[ '@type' => 'AdministrativeArea', 'name' => 'Brandenburg' ],
		],
		'serviceArea' => [
			'@type'        => 'GeoCircle',
			'geoMidpoint'  => [ '@type' => 'GeoCoordinates', 'latitude' => 52.5200, 'longitude' => 13.4050 ],
			'geoRadius'    => '120000',
		],
		'openingHoursSpecification' => [
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ],
			'opens'     => '08:00',
			'closes'    => '18:00',
		],
		'founder'     => [
			'@type'    => 'Person',
			'name'     => 'Pascal Kacemer',
			'jobTitle' => 'Eingetragener Meister im Bauhandwerk',
		],
		'knowsAbout'  => [ 'Hochbau', 'Generalunternehmer', 'Schlüsselfertigbau', 'Mehrfamilienhaus', 'Wohnungsbau', 'Wohnquartier', 'Gewerbebau', 'Massivbau', 'Sanierung', 'KfW-Effizienzhaus', 'Bauleitung' ],
		'identifier'  => 'HRB 286721 B',
	];
	echo "\n<script type='application/ld+json'>" . wp_json_encode( $org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";

	$entities = array_map( static fn( $f ) => [
		'@type'          => 'Question',
		'name'           => $f['q'],
		'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $f['a'] ],
	], pkb_faqs() );
	$faq = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ];
	echo "\n<script type='application/ld+json'>" . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 99 );
