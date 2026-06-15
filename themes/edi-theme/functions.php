<?php
/**
 * EDI Hochbau GmbH — Custom WordPress Classic Theme.
 *
 * Onepager für Rohbau-Subunternehmer / GU-Akquise Berlin-Brandenburg.
 * Schema.org GeneralContractor + FAQPage + Service + AreaServed.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EDI_THEME_VERSION', '0.1.0' );

/**
 * Theme setup.
 */
add_action( 'after_setup_theme', static function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'responsive-embeds' );
	register_nav_menus( [
		'primary' => __( 'Hauptnavigation', 'edi' ),
		'footer'  => __( 'Footer', 'edi' ),
	] );
} );

/**
 * Enqueue fonts + stylesheet + main JS.
 *
 * Space Grotesk Display + Manrope Body + JetBrains Mono labels.
 * Bewusst KEIN Inter/Roboto/Arial.
 */
add_action( 'wp_enqueue_scripts', static function () {
	wp_enqueue_style(
		'edi-fonts',
		'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		'edi-theme',
		get_stylesheet_uri(),
		[ 'edi-fonts' ],
		EDI_THEME_VERSION
	);

	wp_enqueue_script(
		'edi-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		EDI_THEME_VERSION,
		true
	);
} );

/**
 * Preconnect to Google Fonts hosts for faster font loading.
 */
add_action( 'wp_head', static function () {
	echo "<link rel='preconnect' href='https://fonts.googleapis.com'>\n";
	echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>\n";
	echo '<meta name="theme-color" content="#0a0a0c">' . "\n";
	echo '<meta name="description" content="EDI Hochbau GmbH — Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert, eigene Kolonnen, eigene Geräte. Stahlbeton, Mauerwerk, Schalung, Bewehrung.">' . "\n";
}, 1 );

/**
 * Onepager nav links — single source of truth.
 *
 * @return array<int, array{slug:string,label:string}>
 */
function edi_sections(): array {
	return [
		[ 'slug' => 'leistungen',     'label' => 'Leistungen' ],
		[ 'slug' => 'referenzen',     'label' => 'Referenzen' ],
		[ 'slug' => 'zusammenarbeit', 'label' => 'Zusammenarbeit' ],
		[ 'slug' => 'faq',            'label' => 'FAQ' ],
		[ 'slug' => 'team',           'label' => 'Team' ],
		[ 'slug' => 'kontakt',        'label' => 'Kontakt' ],
	];
}

/**
 * Render a section partial from /inc/sections.
 */
function edi_section( string $name ): void {
	$path = get_template_directory() . "/inc/sections/{$name}.php";
	if ( file_exists( $path ) ) {
		include $path;
	}
}

/**
 * FAQ data — flache Top-5-Liste für GU-Buyer.
 *
 * Verwendet von der FAQ-Sektion UND vom FAQPage JSON-LD im <head>.
 * Bewusst aufs Wesentliche reduziert: PQ, Speed, Eigene Ressourcen, Vertrag, Abrechnung.
 *
 * @return array<int, array{q:string, a:string}>
 */
function edi_faqs(): array {
	return [
		[
			'q' => 'Sind Sie PQ-VOB präqualifiziert?',
			'a' => 'Ja — PQ-VOB Nr. 12345. Entlastet Sie nach § 28e Abs. 3b SGB IV von der Nachunternehmerhaftung. Alle weiteren Nachweise (BG BAU, SOKA, § 48b, A1, Haftpflicht 10 Mio) im Dropbox-Ordner, monatlich aktualisiert.',
		],
		[
			'q' => 'Wie schnell bekommen wir ein Angebot?',
			'a' => 'LV per E-Mail oder Upload — Festpreis in 5 Werktagen. Indikatives Festpreis-Band binnen 48 Stunden bei dringenden Vergaben.',
		],
		[
			'q' => 'Eigene Kolonnen, eigene Geräte — oder Sub-Sub-Vergabe?',
			'a' => '64 eigene gewerbliche MA in 3 Kolonnen, 4 Poliere mit Meisterbrief. Krane, Pumpen, Doka- und PERI-Schalung im eigenen Park. Keine Sub-Sub-Vergabe.',
		],
		[
			'q' => 'Auf welcher Vertragsbasis arbeiten Sie?',
			'a' => 'ZDB-Nachunternehmervertrag Bau (Juli 2021), VOB/B. 5 % Vertragserfüllungs- + 5 % Gewährleistungsbürgschaft über deutsche Bank. Vertragsstrafe gedeckelt auf 5 % der Auftragssumme.',
		],
		[
			'q' => 'Wie laufen Aufmaß und Schlussrechnung?',
			'a' => 'Gemeinsames Aufmaß je Bauabschnitt, VOB/C-konform (DIN 18331/18330), digital protokolliert. Schlussrechnung innerhalb 12 Werktagen nach Abnahme. Kein Verschleppen.',
		],
	];
}

/**
 * Output Schema.org JSON-LD in <head>.
 *
 *  - GeneralContractor for the company itself
 *  - FAQPage built from edi_faqs()
 */
add_action( 'wp_head', static function () {
	$base_url = home_url( '/' );

	// 1) GeneralContractor schema
	$contractor = [
		'@context'         => 'https://schema.org',
		'@type'            => 'GeneralContractor',
		'@id'              => $base_url . '#organization',
		'name'             => 'EDI Hochbau GmbH',
		'legalName'        => 'EDI Hochbau GmbH',
		'description'      => 'Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert. Stahlbeton, Mauerwerk, Schalung, Bewehrung, Massivbau.',
		'url'              => $base_url,
		'logo'             => get_template_directory_uri() . '/assets/images/logo.jpg',
		'image'            => get_template_directory_uri() . '/assets/images/logo.jpg',
		'telephone'        => '+49 30 123 456 78', /* TODO: KUNDE PRÜFEN */
		'email'            => 'info@edi-hochbau.de', /* TODO: KUNDE PRÜFEN */
		'priceRange'       => '€€€',
		'address'          => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Musterstraße 12', /* TODO: KUNDE PRÜFEN */
			'postalCode'      => '10115',
			'addressLocality' => 'Berlin',
			'addressRegion'   => 'Berlin',
			'addressCountry'  => 'DE',
		],
		'areaServed'       => [
			[ '@type' => 'City', 'name' => 'Berlin' ],
			[ '@type' => 'City', 'name' => 'Potsdam' ],
			[ '@type' => 'City', 'name' => 'Cottbus' ],
			[ '@type' => 'City', 'name' => 'Frankfurt (Oder)' ],
			[ '@type' => 'City', 'name' => 'Oranienburg' ],
			[ '@type' => 'City', 'name' => 'Bernau bei Berlin' ],
			[ '@type' => 'City', 'name' => 'Eberswalde' ],
			[ '@type' => 'City', 'name' => 'Brandenburg an der Havel' ],
			[ '@type' => 'State', 'name' => 'Brandenburg' ],
		],
		'serviceArea'      => [
			'@type' => 'GeoCircle',
			'geoMidpoint' => [ '@type' => 'GeoCoordinates', 'latitude' => 52.5200, 'longitude' => 13.4050 ],
			'geoRadius' => '120000',
		],
		'foundingDate'     => '2014', /* TODO: KUNDE PRÜFEN */
		'numberOfEmployees'=> [
			'@type'    => 'QuantitativeValue',
			'minValue' => 60, /* TODO: KUNDE PRÜFEN */
		],
		'slogan'           => 'Rohbau, der auf Termin steht.',
		'sameAs'           => [
			/* TODO: KUNDE PRÜFEN — Social profiles, wlw.de, gelbeseiten, etc. */
		],
		'knowsAbout'       => [ 'Rohbau', 'Stahlbetonbau', 'Mauerwerksbau', 'Schalungsarbeiten', 'Bewehrungsarbeiten', 'Massivbau', 'Hochbau', 'VOB/B', 'PQ-VOB' ],
	];

	echo "\n<script type='application/ld+json'>\n" . wp_json_encode( $contractor, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . "\n</script>\n";

	// 2) FAQPage schema — built from flat edi_faqs() list
	$entities = [];
	foreach ( edi_faqs() as $item ) {
		$entities[] = [
			'@type'          => 'Question',
			'name'           => $item['q'],
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => $item['a'],
			],
		];
	}
	$faq_schema = [
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $entities,
	];

	echo "\n<script type='application/ld+json'>\n" . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . "\n</script>\n";
}, 99 );
