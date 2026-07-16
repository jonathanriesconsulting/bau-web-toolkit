<?php
/**
 * Leistungen — Ablauf-Slideshow (mit Bauphasen-Cinema) + 4 Großbau-Schwerpunkte.
 * Großbau-Positionierung. KEINE Gratis-Versprechen.
 */
$theme_uri = get_template_directory_uri();

$process_steps = [
	[
		'num'   => '01',
		'label' => 'Anfrage & Machbarkeit',
		'image' => $theme_uri . '/assets/images/step-01-beratung.jpg',
		'alt'   => 'Bauleiter prüft Pläne und Leistungsverzeichnis am Projektstandort.',
		'desc'  => 'Sie übermitteln Objektart, Standort und Eckdaten. Wir prüfen die Machbarkeit und übermitteln eine erste Einschätzung.',
	],
	[
		'num'   => '02',
		'label' => 'Planung & Festpreis',
		'image' => $theme_uri . '/assets/images/step-02-planung.jpg',
		'alt'   => 'Ausführungsplanung mit Bauplänen und Leistungsverzeichnis.',
		'desc'  => 'Ausführungsplanung, Gewerke-Koordination und verbindlicher Festpreis nach Leistungsverzeichnis — vollständig kalkuliert vor Baubeginn.',
	],
	[
		'num'        => '03',
		'label'      => 'Ausführung',
		'image'      => $theme_uri . '/assets/images/step-03-umsetzung.jpg',
		'alt'        => 'Mehrgeschossiger Rohbau mit Kran auf der Großbaustelle.',
		'desc'       => 'Eigene Bauleitung, Gewerke-Koordination und Qualitätskontrolle über alle Bauphasen — ein Ansprechpartner mit Direktdurchwahl.',
		'type'       => 'bauphasen',
		'frameCount' => 70,
		'framesUrl'  => $theme_uri . '/assets/bauphasen',
		'framePoster'=> $theme_uri . '/assets/bauphasen/frame_001.jpg',
	],
	[
		'num'   => '04',
		'label' => 'Abnahme & Übergabe',
		'image' => $theme_uri . '/assets/images/schluesseluebergabe-haus.jpg',
		'alt'   => 'Schlüssel in der Haustür bei der Übergabe.',
		'desc'  => 'Gemeinsame Abnahme, vollständige Dokumentation und schlüsselfertige Übergabe — termingerecht und bezugsfertig.',
	],
];
$total_steps = count( $process_steps );

$services = [
	[
		'num'    => '01',
		'title'  => 'Mehrfamilien- & Wohnungsbau',
		'image'  => $theme_uri . '/assets/images/adobe-comp-136449603-mfh-ensemble.jpg', /* TODO GO-LIVE: Adobe 136449603 lizenzieren */
		'alt'    => 'Modernes Mehrfamilienhaus-Ensemble in Berlin — Wohnquartier-Neubau.',
		'lead'   => 'Schlüsselfertige Mehrfamilienhäuser und Wohnanlagen in Berlin und Brandenburg als Generalunternehmer — von Gründung und Bodenplatte bis zur bezugsfertigen Wohneinheit.',
		'points' => [
			'Roh- und Ausbau mehrgeschossiger Wohngebäude in Stahlbeton- und Mauerwerksbauweise mit Filigran- bzw. Elementdecken und Treppenhauskernen in Ortbeton',
			'Gründung als Bodenplatte oder Streifenfundament, erdberührte Untergeschosse und Tiefgaragen als Weiße Wanne in WU-Beton statt nachträglicher Abdichtung',
			'Schall- und Brandschutz der Wohnungstrennwände und Geschossdecken nach DIN 4109 und Landesbauordnung ausgeführt',
			'Ausführung nach KfW-Effizienzhaus 40 oder 55, wenn in der Planung vorgegeben — für Bauträger, Investoren und private Bauherren',
		],
		'tag'    => null,
	],
	[
		'num'    => '02',
		'title'  => 'Gewerbe- & Hochbau',
		'image'  => $theme_uri . '/assets/images/gewerbehalle-verladetore.jpg',
		'alt'    => 'Fertiggestellte Gewerbehalle mit Verladetoren und Büroteil im Gewerbegebiet.',
		'lead'   => 'Gewerbe- und Funktionsbauten als Generalunternehmer — von der Gründung bis zur Schlüsselübergabe, mit verbindlichem Termin- und Kostenrahmen nach Leistungsverzeichnis.',
		'points' => [
			'Büro-, Hallen- und Mischnutzungsbauten in Stahlbeton-, Mauerwerks- oder Stahlbeton-Stahl-Hybridkonstruktion, je nach Stützraster und Spannweite',
			'Gründung nach Baugrundgutachten mit Bodenplatte, Streifen- oder Einzelfundamenten, bei drückendem Wasser als WU-Beton-Konstruktion',
			'Brandschutzanforderungen der Nutzung baulich umgesetzt mit Brandabschnitten, Flucht- und Rettungswegen und klassifizierten Bauteilen nach Brandschutzkonzept',
			'Koordination aller Roh-, Ausbau- und TGA-Gewerke (Heizung, Lüftung, Sanitär, Elektro) über definierte Schnittstellen aus einer Hand',
		],
		'tag'    => null,
	],
	[
		'num'    => '03',
		'title'  => 'Schlüsselfertigbau als GU',
		'image'  => $theme_uri . '/assets/images/adobe-comp-94711125-haus-illustration.jpg', /* TODO GO-LIVE: Adobe 94711125 lizenzieren (Illustration) */
		'alt'    => 'Schlüsselfertiges weißes Einfamilienhaus mit Garage — Visualisierung.',
		'lead'   => 'Ein Vertrag für das gesamte Bauvorhaben — von Ausschreibung und Vergabe über die Bauleitung bis zur Abnahme der Nachunternehmer aus einer Hand.',
		'points' => [
			'Verbindlicher Festpreis nach Leistungsverzeichnis, Leistungsabgrenzung und Schnittstellen je Gewerk vertraglich definiert',
			'Eigene Bauleitung mit Direktdurchwahl steuert Vergabe, Bauablauf und Qualitätskontrolle auf der Baustelle',
			'Ausführungs- und Detailplanung in Abstimmung mit Tragwerksplanung, Architekt und Genehmigungsstand',
			'Terminplan mit gewerkeweisem Bauablauf von Gründung über Rohbau und Ausbau bis TGA, dokumentiert bis zur förmlichen Abnahme nach VOB/B',
		],
		'tag'    => null,
	],
	[
		'num'    => '04',
		'title'  => 'Sanierung & Bestand',
		'image'  => $theme_uri . '/assets/images/adobe-comp-219425449-sanierung.jpg', /* TODO GO-LIVE: Adobe 219425449 lizenzieren, Comp ersetzen */
		'alt'    => 'Altbau-Raum während der Sanierung — Vorher-Nachher-Vergleich mit Stuck und Kastenfenster.',
		'lead'   => 'Modernisierung, energetische Ertüchtigung und Umbau im Bestand — als Generalunternehmer auch parallel zu laufenden Neubauprojekten.',
		'points' => [
			'Kern- und Teilsanierung von Wohn- und Gewerbegebäuden bis zum Eingriff in Tragwerk und Geschossdecken nach statischem Nachweis',
			'Energetische Ertüchtigung der Gebäudehülle aus Fassadendämmung, Fenstertausch und Dachdämmung zur Umsetzung des KfW-Standards, Förderantrag auf Wunsch mit vorbereitet',
			'Anbau, Aufstockung und Umnutzung im bewohnten bzw. genutzten Bestand mit abschnittsweisem Bauablauf bei laufendem Betrieb',
			'Abbruch- und Entkernungsarbeiten als koordiniertes Vorgewerk zum anschließenden Roh- und Ausbau',
		],
		'tag'    => null,
	],
];
$total_services = count( $services );
?>
<section class="section" id="leistungen" data-theme="light">
	<div class="container">
		<header class="section-marker reveal">
			<span class="mono mono--ink">01 · Ablauf</span>
			<span class="mono">In vier Schritten zum Projekt</span>
			<span class="section-marker__rule"></span>
		</header>
	</div>

	<!-- SLIDESHOW: scroll-driven 4-step process -->
	<div
		class="slides slides--scroll"
		id="vorgehen"
		data-pkb-slides
		data-mode="scroll"
		data-total="<?php echo (int) $total_steps; ?>"
	>
		<div class="slides__viewport">
			<div class="container">
				<div class="slides__grid">
					<div class="slides__stage">
						<?php foreach ( $process_steps as $i => $step ) : ?>
							<?php if ( ! empty( $step['type'] ) && $step['type'] === 'bauphasen' ) : ?>
								<figure
									class="slides__slide slides__slide--bauphasen<?php echo $i === 0 ? ' is-active' : ''; ?>"
									data-step="<?php echo (int) $i; ?>"
									data-pkb-bauphasen
									data-frame-count="<?php echo (int) $step['frameCount']; ?>"
									data-frames-url="<?php echo esc_url( $step['framesUrl'] ); ?>"
								>
									<img
										class="slides__bauphasen-poster"
										src="<?php echo esc_url( $step['framePoster'] ); ?>"
										alt="<?php echo esc_attr( $step['alt'] ); ?>"
										loading="lazy"
										decoding="async"
										width="1400"
										height="787"
									>
									<canvas class="slides__bauphasen-canvas" aria-hidden="true"></canvas>
								</figure>
							<?php else : ?>
								<figure class="slides__slide<?php echo $i === 0 ? ' is-active' : ''; ?>" data-step="<?php echo (int) $i; ?>">
									<img
										src="<?php echo esc_url( $step['image'] ); ?>"
										alt="<?php echo esc_attr( $step['alt'] ); ?>"
										loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
										decoding="async"
										width="1800"
										height="1010"
									>
								</figure>
							<?php endif; ?>
						<?php endforeach; ?>

						<div class="slides__hud">
							<span class="mono mono--on-dark" data-pkb-slides-index>01 / <?php echo str_pad( (string) $total_steps, 2, '0', STR_PAD_LEFT ); ?></span>
						</div>
					</div>

					<div class="slides__captions">
						<?php foreach ( $process_steps as $i => $step ) : ?>
							<article class="slides__caption<?php echo $i === 0 ? ' is-active' : ''; ?>" data-step="<?php echo (int) $i; ?>">
								<span class="mono"><?php echo esc_html( $step['num'] ); ?> · Schritt</span>
								<h3><?php echo esc_html( $step['label'] ); ?></h3>
								<p><?php echo esc_html( $step['desc'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>

				<ol class="slides__nav" role="tablist" aria-label="Schritt auswählen">
					<?php foreach ( $process_steps as $i => $step ) : ?>
						<li>
							<button
								type="button"
								class="slides__nav-btn<?php echo $i === 0 ? ' is-active' : ''; ?>"
								data-step="<?php echo (int) $i; ?>"
								role="tab"
								aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
							>
								<span class="slides__nav-num"><?php echo esc_html( $step['num'] ); ?></span>
								<span class="slides__nav-label"><?php echo esc_html( $step['label'] ); ?></span>
							</button>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>

		<div class="slides__triggers" aria-hidden="true">
			<?php foreach ( $process_steps as $i => $step ) : ?>
				<?php $is_bauphasen = ! empty( $step['type'] ) && $step['type'] === 'bauphasen'; ?>
				<div
					class="slides__trigger<?php echo $is_bauphasen ? ' slides__trigger--bauphasen' : ''; ?>"
					data-step="<?php echo (int) $i; ?>"
					<?php if ( $is_bauphasen ) : ?>data-bauphasen-trigger<?php endif; ?>
				></div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- CTA-BRIDGE: dunkle Spannungsbrücke zwischen Ablauf und Schwerpunkten -->
	<aside class="cta-bridge" data-theme="dark" aria-label="Direkter Kontakt">
		<div class="container cta-bridge__inner">
			<span class="mono cta-bridge__eyebrow">Anfrage &amp; Kontakt</span>
			<p class="cta-bridge__claim" data-pkb-parallax="-30">
				Ein Meisterbetrieb<br>als Generalunternehmer.
			</p>
			<div class="cta-bridge__actions" data-pkb-parallax="20">
				<a class="btn btn--invert" href="#kontakt">Bauanfrage stellen</a>
			</div>
		</div>
	</aside>

	<div class="container">
		<!-- SCHWERPUNKTE: 4 Großbau-Leistungen — voneinander getrennt -->
		<header class="section-marker section-marker--secondary reveal">
			<span class="mono mono--ink">02 · Leistungen</span>
			<span class="mono"><?php echo (int) $total_services; ?> Schwerpunkte im Hochbau</span>
			<span class="section-marker__rule"></span>
		</header>

		<div class="services">
			<?php foreach ( $services as $i => $s ) : ?>
				<article class="service reveal">
					<div class="service__media">
						<div class="service__badge">
							<span class="mono mono--on-dark"><?php echo esc_html( $s['num'] ); ?></span>
							<?php if ( $s['tag'] ) : ?>
								<span class="service__tag-overlay"><?php echo esc_html( $s['tag'] ); ?></span>
							<?php endif; ?>
						</div>
						<img
							src="<?php echo esc_url( $s['image'] ); ?>"
							alt="<?php echo esc_attr( $s['alt'] ); ?>"
							loading="lazy"
							decoding="async"
							width="1600"
							height="1067"
						>
					</div>
					<div class="service__content">
						<div class="service__head">
							<span class="mono service__num">Schwerpunkt <?php echo esc_html( $s['num'] ); ?> / <?php echo str_pad( (string) $total_services, 2, '0', STR_PAD_LEFT ); ?></span>
							<span class="service__rule"></span>
						</div>
						<h3><?php echo esc_html( $s['title'] ); ?></h3>
						<p class="service__lead"><?php echo esc_html( $s['lead'] ); ?></p>
						<ul class="service__points">
							<?php foreach ( $s['points'] as $point ) : ?>
								<li><?php echo esc_html( $point ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
