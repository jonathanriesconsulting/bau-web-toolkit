<?php
/**
 * Zusammenarbeit — 6-Schritt-Prozess als vertikale Steps.
 */
$steps = [
	[
		'num'   => '01',
		'title' => 'Anfrage &amp; LV-Eingang',
		'subtitle' => 'Mo – Fr · Bestätigung &lt; 4 h',
		'body'  => 'Sie senden uns das LV per E-Mail oder Upload. Wir bestätigen Eingang binnen vier Stunden, prüfen Vollständigkeit der Unterlagen (Pläne, Massen, Bodengutachten) und melden uns mit Rückfragen, bevor wir kalkulieren.',
		'chips' => [ 'E-Mail / Upload', 'Bestätigung < 4 h', 'Rückfrage-Liste binnen 24 h' ],
	],
	[
		'num'   => '02',
		'title' => 'Festpreis-Angebot in 5 Werktagen',
		'subtitle' => 'Einheitspreise nach VOB/B oder Pauschal',
		'body'  => 'Detailliertes Angebot mit Einheits- oder Pauschalpreisen, Bauablaufplan, Personalmeldung und Bestätigung der Kapazität. Indikatives Festpreis-Band binnen 48 Stunden bei dringenden Vergaben möglich.',
		'chips' => [ 'VOB/B-konform', 'Mengen-Risiko-Korridor', 'Indikativ in 48 h' ],
	],
	[
		'num'   => '03',
		'title' => 'Vertragsschluss',
		'subtitle' => 'ZDB-Nachunternehmervertrag · Sicherheitsleistung',
		'body'  => 'Standardbasis: ZDB-Nachunternehmervertrag Bau (Fassung Juli 2021). Anpassung an Ihren Hausvertrag möglich. 5 % Vertragserfüllungs- + 5 % Gewährleistungsbürgschaft über deutsche Bank. Vertragsstrafe gedeckelt auf 5 % der Auftragssumme.',
		'chips' => [ 'ZDB-NU-Vertrag', '5 + 5 % Bürgschaft', 'Pönale 5 % cap' ],
	],
	[
		'num'   => '04',
		'title' => 'Kick-off &amp; Bauleiter-Übergabe',
		'subtitle' => 'Namentlich benannt · Mo – Fr 6 – 19 Uhr',
		'body'  => 'Vor Baustart ein Kick-off-Termin auf der Baustelle: Übergabe der Bauleiter-Kontaktdaten, Klärung der Schnittstellen (Material, Strom, Wasser, Kran), Personalplan, Wochenrhythmus. Sie wissen, wer wann erreichbar ist.',
		'chips' => [ 'Bauleiter mit Foto + Mobile', 'Vertretungsregel dokumentiert', 'Schnittstellen-Protokoll' ],
	],
	[
		'num'   => '05',
		'title' => 'Ausführung &amp; Bauleitungs-Schnittstelle',
		'subtitle' => 'Tagesbericht · Jour Fixe · Plan-Versionierung',
		'body'  => 'Tagesbericht per E-Mail bis 17 Uhr — Personal, Geräte, Wetter, Leistungsstand, Behinderungen. Wöchentlicher Jour Fixe vor Ort mit Protokoll. Plan-Versionsführung in Ihrer Bauleiter-Software (BIM 360, Capmo, PlanRadar). Behinderungsanzeigen nach § 6 VOB/B sofort schriftlich, kein Ping-Pong.',
		'chips' => [ 'Tagesbericht 17:00', 'Wöchentlicher Jour Fixe', 'BIM 360 / Capmo / PlanRadar', '§ 6 VOB/B sofort' ],
	],
	[
		'num'   => '06',
		'title' => 'Abnahme &amp; Schlussrechnung',
		'subtitle' => 'Gemeinsames Aufmaß · 12 Werktage zur SR',
		'body'  => 'Gemeinsames Aufmaß je Bauabschnitt nach VOB/C ATV DIN 18331/18330, digital protokolliert mit Skizzen und Fotos. Schlussrechnung innerhalb 12 Werktagen nach Abnahme. Mängelrüge und Nachbesserung nach § 13 VOB/B — bei uns kein Versteckspiel.',
		'chips' => [ 'VOB/C-Aufmaß', '12 Werktage zur SR', '4 Jahre Gewährleistung', 'Mängel-Protokoll' ],
	],
];
?>
<section class="section zusammenarbeit" id="zusammenarbeit" aria-label="Zusammenarbeit — wie wir mit GU-Kunden arbeiten">
	<div class="container">

		<header class="section-marker reveal">
			<span class="mono mono--gold">04 · Zusammenarbeit</span>
			<span class="mono">Vom LV-Eingang bis zur Schlussrechnung</span>
			<span class="section-marker__rule" aria-hidden="true"></span>
		</header>

		<div class="zusammenarbeit__head reveal">
			<h2 class="zusammenarbeit__title">
				So <strong>arbeiten</strong> wir<br>
				mit Ihrem Bauleiter.
			</h2>
			<p class="zusammenarbeit__lead">
				Klar definierte Schnittstellen, dokumentierte Kommunikation, keine Überraschungen.
				Sechs Schritte vom ersten LV-Eingang bis zur abgeschlossenen Schlussrechnung —
				und an jedem Schritt wissen Sie, was als nächstes passiert.
			</p>
		</div>

		<ol class="steps reveal" aria-label="Sechs Prozessschritte der Zusammenarbeit">
			<?php foreach ( $steps as $s ) : ?>
				<li class="step">
					<div class="step__num">→ <?php echo esc_html( $s['num'] ); ?></div>
					<div>
						<h3 class="step__title">
							<?php echo wp_kses_post( $s['title'] ); ?>
							<small><?php echo wp_kses_post( $s['subtitle'] ); ?></small>
						</h3>
					</div>
					<div>
						<div class="step__body">
							<p><?php echo wp_kses_post( $s['body'] ); ?></p>
						</div>
						<div class="step__chips">
							<?php foreach ( $s['chips'] as $chip ) : ?>
								<span class="step__chip"><?php echo wp_kses_post( $chip ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
