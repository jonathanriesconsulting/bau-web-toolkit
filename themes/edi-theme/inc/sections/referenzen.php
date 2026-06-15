<?php
/**
 * Referenzen — Projekt-Grid mit Platzhalter-Daten.
 * Bilder folgen vom Kunden — vorerst typografisches Placeholder.
 */
$referenzen = [
	[
		'tag'    => 'Mehrfamilienhaus',
		'title'  => 'Wohnquartier Adlershof',
		'ort'    => 'Berlin · Treptow-Köpenick',
		'gu'     => 'TODO: KUNDE PRÜFEN',
		'bri'    => '18.400 m³',
		'bauzeit'=> 'Q2/2024 – Q1/2025',
		'umfang' => 'Stahlbeton + Mauerwerk',
	],
	[
		'tag'    => 'Gewerbebau',
		'title'  => 'Logistikhalle Großbeeren',
		'ort'    => 'Brandenburg · Teltow-Fläming',
		'gu'     => 'TODO: KUNDE PRÜFEN',
		'bri'    => '42.000 m³',
		'bauzeit'=> 'Q3/2024 – Q2/2025',
		'umfang' => 'Rohbau schlüsselfertig',
	],
	[
		'tag'    => 'Wohnungsbau',
		'title'  => 'Quartier Friedrichshain Süd',
		'ort'    => 'Berlin · Friedrichshain',
		'gu'     => 'TODO: KUNDE PRÜFEN',
		'bri'    => '24.700 m³',
		'bauzeit'=> 'Q4/2023 – Q3/2024',
		'umfang' => 'Stahlbeton + Bewehrung',
	],
	[
		'tag'    => 'Sozialbau',
		'title'  => 'Kita Pankow Nord',
		'ort'    => 'Berlin · Pankow',
		'gu'     => 'TODO: KUNDE PRÜFEN',
		'bri'    => '4.200 m³',
		'bauzeit'=> 'Q1/2025 – Q3/2025',
		'umfang' => 'Mauerwerk + Schalung',
	],
	[
		'tag'    => 'Bürogebäude',
		'title'  => 'Campus Potsdam Babelsberg',
		'ort'    => 'Brandenburg · Potsdam',
		'gu'     => 'TODO: KUNDE PRÜFEN',
		'bri'    => '11.800 m³',
		'bauzeit'=> 'Q2/2025 – laufend',
		'umfang' => 'Sichtbeton SB2',
	],
	[
		'tag'    => 'Pflegeheim',
		'title'  => 'Pflegezentrum Oranienburg',
		'ort'    => 'Brandenburg · Oranienburg',
		'gu'     => 'TODO: KUNDE PRÜFEN',
		'bri'    => '14.600 m³',
		'bauzeit'=> 'Q3/2023 – Q2/2024',
		'umfang' => 'Rohbau schlüsselfertig',
	],
];
?>
<section class="section referenzen" id="referenzen" aria-label="Referenzen — abgeschlossene und laufende Rohbau-Projekte">
	<div class="container">

		<header class="section-marker reveal">
			<span class="mono mono--gold">03 · Referenzen</span>
			<span class="mono">Auswahl aus 38 GU-Projekten</span>
			<span class="section-marker__rule" aria-hidden="true"></span>
		</header>

		<div class="leistungen__head reveal" style="margin-bottom: clamp(2rem, 1.5rem + 2vw, 3.5rem);">
			<h2 class="leistungen__title">
				Projekte, die <strong>stehen</strong>.<br>
				Termine, die gehalten wurden.
			</h2>
			<div class="leistungen__intro">
				<p>
					Eine Auswahl unserer letzten Rohbau-Projekte für GU-Kunden in Berlin und Brandenburg. Vollständige Referenzliste
					mit GU-Ansprechpartnern auf Anfrage unter NDA. <em style="color:var(--c-gold);font-weight:500;">TODO: Echte Projektfotos und Auftraggeber durch Kunden ergänzen.</em>
				</p>
			</div>
		</div>

		<div class="referenzen__grid">
			<?php foreach ( $referenzen as $r ) : ?>
				<article class="referenz reveal">
					<div class="referenz__media">
						<span class="referenz__tag"><?php echo esc_html( $r['tag'] ); ?></span>
						<span class="referenz__media-fallback">Projektfoto folgt</span>
					</div>
					<div class="referenz__body">
						<h3 class="referenz__title"><?php echo esc_html( $r['title'] ); ?></h3>
						<dl class="referenz__meta">
							<dt>Standort</dt>
							<dd><?php echo esc_html( $r['ort'] ); ?></dd>
							<dt>GU</dt>
							<dd><?php echo esc_html( $r['gu'] ); ?></dd>
							<dt>BRI</dt>
							<dd><?php echo esc_html( $r['bri'] ); ?></dd>
							<dt>Bauzeit</dt>
							<dd><?php echo esc_html( $r['bauzeit'] ); ?></dd>
							<dt>Umfang</dt>
							<dd><?php echo esc_html( $r['umfang'] ); ?></dd>
						</dl>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div style="margin-top: clamp(2.5rem, 2rem + 2vw, 4rem); display:flex; flex-wrap:wrap; gap: 1rem;">
			<a href="#kontakt" class="btn btn--outline">
				Referenzliste mit GU-Kontakten anfordern
				<span class="btn__arrow" aria-hidden="true">→</span>
			</a>
		</div>
	</div>
</section>
