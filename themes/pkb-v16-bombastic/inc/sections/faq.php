<?php
/**
 * FAQ — grau-helle Insel (sanfter Mikro-Kontrast). Akkordeon aus pkb_faqs().
 * FAQPage-Schema in functions.php.
 */
$faqs = pkb_faqs();
?>
<section class="section faq-section" id="faq" aria-label="Häufige Fragen">
	<div class="container">
		<header class="section-marker reveal">
			<span class="mono mono--ink">04 · FAQ</span>
			<span class="mono"><?php echo (int) count( $faqs ); ?> Antworten</span>
			<span class="section-marker__rule"></span>
		</header>

		<div class="faq-head reveal">
			<h2 class="faq-head__title">Was Auftraggeber<br>uns fragen.</h2>
			<p class="faq-head__lead">Antworten auf häufige Fragen. Weiteres Anliegen? <a href="#kontakt" class="faq-head__link">Direkt anfragen →</a></p>
		</div>

		<div class="faq" data-pkb-faq>
			<?php foreach ( $faqs as $i => $f ) : ?>
				<details class="faq-item reveal"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary class="faq-item__q">
						<span class="faq-item__num"><?php echo str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ); ?></span>
						<span class="faq-item__text"><?php echo esc_html( $f['q'] ); ?></span>
						<span class="faq-item__icon" aria-hidden="true"></span>
					</summary>
					<div class="faq-item__a">
						<p><?php echo esc_html( $f['a'] ); ?></p>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
