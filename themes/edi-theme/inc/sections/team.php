<?php
/**
 * Team — Ansprechpartner mit Rolle, Direktdurchwahl und E-Mail.
 * Portraits folgen vom Kunden, vorerst typografisches Placeholder.
 */
$members = [
	[
		'role'  => 'Geschäftsführung',
		'name'  => 'Edi Dautović', /* TODO: KUNDE PRÜFEN */
		'tel'   => '030 / 123 456 70',
		'mob'   => '0151 / 1234 5670',
		'mail'  => 'edi.dautovic@edi-hochbau.de',
		'initials' => 'ED',
	],
	[
		'role'  => 'Bauleitung · Berlin',
		'name'  => 'Stefan Schulz', /* TODO: KUNDE PRÜFEN */
		'tel'   => '030 / 123 456 71',
		'mob'   => '0151 / 1234 5671',
		'mail'  => 's.schulz@edi-hochbau.de',
		'initials' => 'SS',
	],
	[
		'role'  => 'Bauleitung · Brandenburg',
		'name'  => 'Martin Krüger', /* TODO: KUNDE PRÜFEN */
		'tel'   => '030 / 123 456 72',
		'mob'   => '0151 / 1234 5672',
		'mail'  => 'm.krueger@edi-hochbau.de',
		'initials' => 'MK',
	],
	[
		'role'  => 'Kalkulation &amp; Einkauf',
		'name'  => 'Anna Petersen', /* TODO: KUNDE PRÜFEN */
		'tel'   => '030 / 123 456 73',
		'mob'   => '0151 / 1234 5673',
		'mail'  => 'kalkulation@edi-hochbau.de',
		'initials' => 'AP',
	],
];
?>
<section class="section team" id="team" aria-label="Team — Ihre direkten Ansprechpartner">
	<div class="container">

		<header class="section-marker reveal">
			<span class="mono mono--gold">06 · Team</span>
			<span class="mono">Vier direkte Ansprechpartner — keine Hotline</span>
			<span class="section-marker__rule" aria-hidden="true"></span>
		</header>

		<div class="team__head reveal">
			<h2 class="team__title">
				Wer <strong>abnimmt</strong>,<br>
				wenn Sie anrufen.
			</h2>
			<p class="team__lead">
				Bei EDI rufen Sie keinen Vertriebs-Slot an, sondern die Person, die Ihr Projekt verantwortet.
				Mo – Fr 6 – 19 Uhr unter den Direktdurchwahlen, außerhalb über die Bereitschafts-Mobile.
			</p>
		</div>

		<div class="team__grid">
			<?php foreach ( $members as $m ) : ?>
				<article class="member reveal">
					<div class="member__portrait">
						<span class="member__portrait-fallback">Portrait folgt<br><?php echo esc_html( $m['initials'] ); ?></span>
					</div>
					<div class="member__body">
						<div class="member__role"><?php echo wp_kses_post( $m['role'] ); ?></div>
						<h3 class="member__name"><?php echo esc_html( $m['name'] ); ?></h3>
						<div class="member__contacts">
							<a class="member__contact" href="tel:+49<?php echo esc_attr( str_replace( [ ' ', '/', '-' ], '', $m['tel'] ) ); ?>">
								<small>Tel</small><?php echo esc_html( $m['tel'] ); ?>
							</a>
							<a class="member__contact" href="tel:+49<?php echo esc_attr( str_replace( [ ' ', '/', '-' ], '', $m['mob'] ) ); ?>">
								<small>Mob</small><?php echo esc_html( $m['mob'] ); ?>
							</a>
							<a class="member__contact" href="mailto:<?php echo esc_attr( $m['mail'] ); ?>">
								<small>Mail</small><?php echo esc_html( $m['mail'] ); ?>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
