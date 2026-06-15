<?php
/**
 * Bauen — MegaCinema (Original-Pattern: Text als Overlay IM Stage, aber 50% kompakter).
 *
 * Scroll-driven Canvas mit 75 Frames. Stage abgerundet im Container,
 * Höhe ~50vh statt full-screen. Master-Text liegt mit Veil-Gradient ÜBER dem Bild.
 */
$theme_uri = get_template_directory_uri();

$bauphasen = [
	[ 'num' => '01', 'titel' => 'Stahlbetonbau',          'sub' => 'Bodenplatten · Decken · Wände · Treppenhauskerne',  'bullets' => [ 'Ortbeton C20/25 – C50/60', 'Filigran &amp; Halbfertigteile', 'Sichtbeton SB2 / SB3' ] ],
	[ 'num' => '02', 'titel' => 'Mauerwerksbau',          'sub' => 'Tragend &amp; nicht-tragend nach DIN 1053',         'bullets' => [ 'Kalksandstein', 'Porenbeton', 'Hochlochziegel' ] ],
	[ 'num' => '03', 'titel' => 'Schalungsarbeiten',      'sub' => 'Doka Framax Xlife &amp; PERI im eigenen Park',      'bullets' => [ 'Decken &amp; Wand', 'Sondergewerke', 'Verfügbarkeit garantiert' ] ],
	[ 'num' => '04', 'titel' => 'Bewehrungsarbeiten',     'sub' => 'Eigene Eisenflechter-Kolonnen',                      'bullets' => [ 'Matte + Stabstahl', 'DIN EN ISO 17660', 'Verlegeprotokoll digital' ] ],
	[ 'num' => '05', 'titel' => 'Schlüsselfertiger Rohbau','sub' => 'Erdarbeiten · Gründung · Stahlbeton · Mauerwerk',   'bullets' => [ 'Eine Vertragsbasis', 'Eine Verantwortung', 'MFH · Gewerbe · Kita' ] ],
];
$total = count( $bauphasen );
?>
<section class="edi-mc" id="bauen" aria-label="Rohbau in Action — fünf Sub-Gewerke" data-edi-megacinema data-total="<?php echo (int) $total; ?>">
	<div class="edi-mc__sticky">
		<div class="container edi-mc__inner">

			<header class="edi-mc__intro">
				<span class="mono mono--gold">04 · Rohbau in Action</span>
				<span class="edi-mc__intro-rule" aria-hidden="true"></span>
				<span class="mono" data-edi-phase-counter>01 / <?php echo str_pad( (string) $total, 2, '0', STR_PAD_LEFT ); ?></span>
			</header>

			<!-- Stage: rounded, contained, ~50vh — Text liegt drauf -->
			<div class="edi-mc__stage">
				<div
					class="edi-mc__images"
					data-edi-bauframes
					data-frame-count="75"
					data-frames-url="<?php echo esc_url( $theme_uri . '/assets/bauphasen' ); ?>"
					aria-hidden="true"
				>
					<img
						class="edi-mc__poster"
						src="<?php echo esc_url( $theme_uri . '/assets/bauphasen/frame_001.jpg' ); ?>"
						alt="Rohbau-Baustelle — Stahlbeton-Skelettbau mit Kran im Sonnenuntergang."
						width="1600"
						height="900"
						loading="lazy"
						decoding="async"
					>
					<canvas class="edi-mc__canvas"></canvas>
				</div>

				<!-- Dunkler Gradient von links + unten für Text-Lesbarkeit -->
				<div class="edi-mc__veil" aria-hidden="true"></div>

				<!-- Master overlay stack (Text liegt im Stage) -->
				<div class="edi-mc__overlay">
					<?php foreach ( $bauphasen as $i => $p ) : ?>
						<article class="edi-master <?php echo $i === 0 ? 'is-active' : ''; ?>" data-phase="<?php echo (int) $i; ?>">
							<div class="edi-master__center">
								<span class="mono mono--gold edi-master__num">Subgewerk <?php echo esc_html( $p['num'] ); ?> / <?php echo str_pad( (string) $total, 2, '0', STR_PAD_LEFT ); ?></span>
								<h3 class="edi-master__title"><?php echo esc_html( $p['titel'] ); ?></h3>
								<p class="edi-master__sub"><?php echo wp_kses_post( $p['sub'] ); ?></p>
								<ul class="edi-master__bullets">
									<?php foreach ( $p['bullets'] as $b ) : ?>
										<li><?php echo wp_kses_post( $b ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</article>
					<?php endforeach; ?>
				</div>

				<!-- Progress steps + Phase label -->
				<footer class="edi-mc__foot">
					<div class="edi-mc__progress" role="presentation">
						<?php foreach ( $bauphasen as $i => $p ) : ?>
							<button
								type="button"
								class="edi-mc__progress-step <?php echo $i === 0 ? 'is-active' : ''; ?>"
								data-phase="<?php echo (int) $i; ?>"
								aria-label="<?php echo esc_attr( $p['num'] . ' ' . $p['titel'] ); ?>"
							></button>
						<?php endforeach; ?>
					</div>
					<span class="mono mono--gold edi-mc__foot-label" data-edi-phase-label>
						<?php echo esc_html( $bauphasen[0]['titel'] ); ?>
					</span>
				</footer>
			</div>

		</div>
	</div>
</section>
