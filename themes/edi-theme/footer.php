<?php
/**
 * Footer — Brand block + nav cols + trust strip + bottom.
 */
$year = date( 'Y' );
?>
</main><!-- /#main -->

<footer class="site-footer" role="contentinfo">
	<div class="container">
		<div class="site-footer__top">
			<div class="site-footer__brand-block">
				<div class="site-footer__brand">
					<img
						src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.jpg' ); ?>"
						alt=""
						width="44"
						height="44"
						decoding="async"
					>
					<span class="site-footer__brand-name">
						EDI Hochbau GmbH
						<span>Rohbau · Berlin · Brandenburg</span>
					</span>
				</div>
				<p class="site-footer__tag">
					Rohbau-Subunternehmer für Generalunternehmer in Berlin und Brandenburg. PQ-VOB präqualifiziert. Eigene Kolonnen. Eigene Geräte.
				</p>
			</div>

			<div class="site-footer__cols">
				<div class="site-footer__col">
					<h5>Sektionen</h5>
					<ul>
						<?php foreach ( edi_sections() as $sec ) : ?>
							<li><a href="#<?php echo esc_attr( $sec['slug'] ); ?>"><?php echo esc_html( $sec['label'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="site-footer__col">
					<h5>Leistungen</h5>
					<ul>
						<li><a href="#leistungen">Stahlbetonbau</a></li>
						<li><a href="#leistungen">Mauerwerksbau</a></li>
						<li><a href="#leistungen">Schalungsarbeiten</a></li>
						<li><a href="#leistungen">Bewehrungsarbeiten</a></li>
						<li><a href="#leistungen">Schlüsselfertiger Rohbau</a></li>
					</ul>
				</div>
				<div class="site-footer__col">
					<h5>Einsatzgebiet</h5>
					<ul>
						<li>Berlin</li>
						<li>Potsdam</li>
						<li>Cottbus</li>
						<li>Frankfurt (Oder)</li>
						<li>Oranienburg · Bernau</li>
					</ul>
				</div>
				<div class="site-footer__col">
					<h5>Direkt</h5>
					<ul>
						<li><a href="tel:+493012345678">030 / 123 456 78</a></li>
						<li><a href="mailto:info@edi-hochbau.de">info@edi-hochbau.de</a></li>
						<li><a href="https://wa.me/4915112345678" target="_blank" rel="noopener">WhatsApp Bauleiter</a></li>
					</ul>
				</div>
			</div>
		</div>

		<!-- Trust microcopy strip -->
		<div class="site-footer__trust">
			<div class="site-footer__trust-item">
				<strong>PQ-VOB präqualifiziert</strong>
				Nr. 12345 · abrufbar auf pq-verein.de
			</div>
			<div class="site-footer__trust-item">
				<strong>Mitglied BG BAU</strong>
				Beitragsklasse aktuell · Bescheinigung monatlich erneuert
			</div>
			<div class="site-footer__trust-item">
				<strong>Berufshaftpflicht</strong>
				10 Mio EUR Personen- &amp; Sachschaden je Schadensfall
			</div>
			<div class="site-footer__trust-item">
				<strong>§ 48b EStG</strong>
				Freistellungsbescheinigung Finanzamt Berlin · gültig bis 12/2027
			</div>
			<div class="site-footer__trust-item">
				<strong>SOKA-BAU</strong>
				Bescheinigung aktuell · Mindestlohn Bau-Hauptgewerbe nachgewiesen
			</div>
			<div class="site-footer__trust-item">
				<strong>Vertragsbasis</strong>
				ZDB-Nachunternehmervertrag Bau · Fassung Juli 2021
			</div>
		</div>

		<div class="site-footer__bottom">
			<span>© <?php echo esc_html( $year ); ?> EDI Hochbau GmbH · Sitz: Berlin · HRB 123456 B</span>
			<span>
				<a href="/impressum">Impressum</a> ·
				<a href="/datenschutz">Datenschutz</a> ·
				<a href="/agb">AGB</a>
			</span>
		</div>
	</div>
</footer>

<!-- Mobile sticky call bar -->
<nav class="callbar" aria-label="Direktkontakt mobil">
	<a class="callbar__primary" href="tel:+493012345678" aria-label="Anrufen">
		<span aria-hidden="true">📞</span> Anrufen
	</a>
	<a class="callbar__secondary" href="https://wa.me/4915112345678" target="_blank" rel="noopener" aria-label="WhatsApp">
		<span aria-hidden="true">↗</span> WhatsApp
	</a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
