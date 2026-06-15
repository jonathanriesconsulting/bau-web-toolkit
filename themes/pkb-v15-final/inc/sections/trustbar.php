<?php
/**
 * Trust-Bar — helle Kontrast-Insel direkt unter dem Hero (harter Bruch dunkel→hell).
 * KEINE Gratis-Versprechen (Inhaber-Veto).
 */
$items = [
	[ 'value' => '16 Jahre',          'label' => 'Berufserfahrung des Inhabers' ],
	[ 'value' => 'Meisterbetrieb',    'label' => 'Eingetragener Meister im Bauhandwerk' ],
	[ 'value' => 'Festpreis',         'label' => 'Verbindlich nach Leistungsverzeichnis' ],
	[ 'value' => '1 Ansprechpartner', 'label' => 'Bauleitung mit Direktdurchwahl' ],
	[ 'value' => 'Berlin & Brandenburg', 'label' => 'Einsatzgebiet' ],
];
?>
<section class="trust-bar" aria-label="Auf einen Blick">
	<div class="container trust-bar__inner">
		<?php foreach ( $items as $it ) : ?>
			<div class="trust-bar__item">
				<span class="trust-bar__value"><?php echo esc_html( $it['value'] ); ?></span>
				<span class="trust-bar__label"><?php echo esc_html( $it['label'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</section>
