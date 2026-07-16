<?php
/**
 * Site footer — großes Logo-Lockup auf Dunkel + Meta.
 */
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="site-footer__lockup">
			<img class="site-footer__logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/logo.svg' ); ?>" alt="Pascal Kacemer Bauunternehmung GmbH" width="220" height="172">
			<p class="site-footer__claim">Schlüsselfertiger Hochbau aus einer Hand.<br>Berlin &amp; Brandenburg.</p>
		</div>

		<div class="site-footer__grid">
			<div class="site-footer__col">
				<span class="mono mono--on-dark">Firma</span>
				<span>Pascal Kacemer Bauunternehmung GmbH</span>
				<span>HRB 286721 B · HWK 150096</span>
			</div>
			<div class="site-footer__col">
				<span class="mono mono--on-dark">Sitz</span>
				<span>Alt-Buch 57</span>
				<span>13125 Berlin</span>
			</div>
			<div class="site-footer__col">
				<span class="mono mono--on-dark">Register</span>
				<span>HRB 286721 B</span>
				<span>HWK-Betriebsnr. 150096</span>
			</div>
			<div class="site-footer__col">
				<span class="mono mono--on-dark">Rechtliches</span>
				<a href="<?php echo esc_url( home_url( '/impressum' ) ); ?>">Impressum</a>
				<a href="<?php echo esc_url( home_url( '/datenschutz' ) ); ?>">Datenschutz</a>
			</div>
		</div>

		<div class="site-footer__base">
			<span>© <?php echo esc_html( date( 'Y' ) ); ?> Pascal Kacemer Bauunternehmung GmbH</span>
			<span>Meisterbetrieb · Berlin</span>
		</div>
	</div>
</footer>

<!-- Sticky Mobile-CTA-Bar -->
<nav class="mobilebar" aria-label="Schnellkontakt">
	<a class="mobilebar__call" href="#kontakt">Kontakt</a>
	<a class="mobilebar__cta" href="#kontakt">Bauanfrage stellen</a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
