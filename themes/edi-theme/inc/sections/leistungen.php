<?php
/**
 * Leistungen — 5 Rohbau-Subgewerke als Bento-Grid.
 */
$leistungen = [
	[
		'num'   => '01',
		'size'  => 'lg',
		'title' => 'Stahlbetonbau',
		'lead'  => 'Ortbeton, Halbfertigteile, Filigrandecken, Sichtbeton. Eigenüberwachung nach DIN 1045-3, dokumentiert je Charge. Betongüten von C20/25 bis C50/60.',
		'list'  => [
			'Bodenplatten · Weiße &amp; schwarze Wannen',
			'Decken in Ortbeton + Filigran',
			'Stützen, Wände, Treppenhauskerne',
			'Sichtbeton-Klasse SB2/SB3 nach DBV-Merkblatt',
		],
	],
	[
		'num'   => '02',
		'size'  => 'md',
		'title' => 'Mauerwerksbau',
		'lead'  => 'Tragend und nicht-tragend. Kalksandstein, Porenbeton, Hochlochziegel. Statisch geprüfte Ausführung nach DIN 1053 / Eurocode 6.',
		'list'  => [
			'Tragende Außenwände',
			'Innenwände + Schallschutzwände',
			'Schornstein- und Mauerwerksankerschäden-Sanierung',
		],
	],
	[
		'num'   => '03',
		'size'  => 'sm',
		'title' => 'Schalungsarbeiten',
		'lead'  => 'Doka Framax Xlife + PERI im eigenen Park. Sondergewerke (Gleitschalung) mit Verfügbarkeitszusage.',
		'list'  => [
			'Decken- und Wandschalung',
			'Sonderschalungen',
		],
	],
	[
		'num'   => '04',
		'size'  => 'sm',
		'title' => 'Bewehrungsarbeiten',
		'lead'  => 'Eigene Eisenflechter-Kolonnen. Werks- und Verlegepläne nach DIN EN ISO 17660 ausgeführt.',
		'list'  => [
			'Mattenbewehrung + Stabstahl',
			'Verlegeprotokolle digital',
		],
	],
	[
		'num'   => '05',
		'size'  => 'sm',
		'title' => 'Schlüsselfertiger Rohbau',
		'lead'  => 'Rohbau-Komplettpaket inkl. Erdarbeiten, Gründung, Stahlbeton, Mauerwerk. Eine Vertragsbasis, eine Verantwortung.',
		'list'  => [
			'Mehrfamilien- und Gewerbebau',
			'Kita, Schule, Pflege',
		],
	],
];
?>
<section class="section leistungen" id="leistungen" aria-label="Leistungen — Rohbau-Subgewerke">
	<div class="container">

		<header class="section-marker reveal">
			<span class="mono mono--gold">02 · Leistungen</span>
			<span class="mono">Fünf Schwerpunkte im Rohbau</span>
			<span class="section-marker__rule" aria-hidden="true"></span>
		</header>

		<div class="leistungen__head reveal">
			<h2 class="leistungen__title">
				Was wir <strong>bauen</strong> —<br>
				und wofür Sie uns ausschreiben.
			</h2>
			<div class="leistungen__intro">
				<p>
					Wir sind Rohbauer aus Überzeugung — kein Bauchladen mit Anschluss-Gewerken. Wenn Sie als Generalunternehmer einen
					präqualifizierten Nachunternehmer für einen klar definierten Rohbau-Auftrag brauchen, bekommen Sie hier eine
					strukturierte Übersicht über das, was wir liefern können.
				</p>
			</div>
		</div>

		<div class="leistungen__grid">
			<?php foreach ( $leistungen as $l ) : ?>
				<article class="leistung leistung--<?php echo esc_attr( $l['size'] ); ?> reveal">
					<span class="leistung__num"><?php echo esc_html( $l['num'] ); ?> / 05</span>
					<h3 class="leistung__title"><?php echo esc_html( $l['title'] ); ?></h3>
					<p class="leistung__lead"><?php echo esc_html( $l['lead'] ); ?></p>
					<ul class="leistung__list">
						<?php foreach ( $l['list'] as $point ) : ?>
							<li><?php echo wp_kses( $point, [ 'em' => [] ] ); ?></li>
						<?php endforeach; ?>
					</ul>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
