<?php
/**
 * Hero — full-bleed image background with text + CTA overlay.
 * Dunkle Kontrast-Insel #1. Bild: Rohbau + Kran in der Dämmerung (Pexels 17907062, echt, 2400×1600).
 */
$theme_uri = get_template_directory_uri();
?>
<section class="hero" id="top" data-theme="dark">
	<div class="hero__bg" aria-hidden="true">
		<img
			src="<?php echo esc_url( $theme_uri . '/assets/images/rohbau-kran-daemmerung.jpg' ); ?>"
			alt=""
			loading="eager"
			fetchpriority="high"
			decoding="async"
			width="2400"
			height="1600"
		>
	</div>

	<div class="container hero__inner">
		<div class="hero__top">
			<span class="mono mono--on-dark">Meistergeführtes Bauunternehmen</span>
			<span class="mono mono--on-dark">Berlin &amp; Brandenburg</span>
		</div>

		<div class="hero__bottom">
			<h1 class="hero__title">
				Schlüsselfertiger Hochbau aus einer Hand.
			</h1>

			<div class="hero__meta">
				<p class="hero__lead">
					Als Generalunternehmer realisieren wir Mehrfamilienhäuser, Wohnquartiere und Gewerbebauten in Berlin und Brandenburg — von der Ausführungsplanung bis zur schlüsselfertigen Übergabe. Geführt von einem eingetragenen Meister im Bauhandwerk mit 16&nbsp;Jahren Berufserfahrung. Ein Vertragspartner, ein verbindlicher Festpreis, eine durchgängige Bauleitung.
				</p>
				<div class="hero__actions">
					<a class="btn btn--invert" href="#kontakt">Bauanfrage stellen</a>
					<a class="btn btn--ghost-light" href="#leistungen">Leistungen</a>
				</div>
			</div>
		</div>
	</div>
</section>
