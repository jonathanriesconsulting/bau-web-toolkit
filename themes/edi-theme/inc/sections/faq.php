<?php
/**
 * FAQ — flache Top-5-Liste, kein Gruppen-Loop mehr.
 * FAQPage-Schema wird in functions.php ausgegeben.
 */
$faqs = edi_faqs();
?>
<section class="section faq faq--compact" id="faq" aria-label="Häufig gestellte Fragen aus der GU-Praxis">
	<div class="container">

		<header class="section-marker reveal">
			<span class="mono mono--gold">06 · FAQ</span>
			<span class="mono"><?php echo (int) count( $faqs ); ?> Antworten auf die häufigsten GU-Fragen</span>
			<span class="section-marker__rule" aria-hidden="true"></span>
		</header>

		<div class="faq__head reveal">
			<h2 class="faq__title">
				Was Ihre <strong>Bauleiter</strong><br>
				uns fragen.
			</h2>
			<div class="faq__intro">
				<p>
					Aufs Wesentliche reduziert. Weitere Fragen?
					<a href="#kontakt" class="tlink">Direkt anfragen<span aria-hidden="true">→</span></a>
				</p>
			</div>
		</div>

		<div class="faq__items reveal">
			<?php foreach ( $faqs as $i => $item ) : ?>
				<details class="faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
					<summary>
						<div class="faq-item__q">
							<span class="faq-item__num"><?php echo str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ); ?></span>
							<span><?php echo esc_html( $item['q'] ); ?></span>
						</div>
						<span class="faq-item__icon" aria-hidden="true"></span>
					</summary>
					<div class="faq-item__a">
						<p><?php echo esc_html( $item['a'] ); ?></p>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
