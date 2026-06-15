<?php
/**
 * Header — Dark sticky navigation with logo, anchor links, phone CTA.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main">Direkt zum Inhalt springen</a>

<header class="site-header" id="site-header" role="banner">
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__brand" aria-label="EDI Hochbau GmbH — Startseite">
			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.jpg' ); ?>"
				alt=""
				class="site-header__logo"
				width="38"
				height="38"
				decoding="async"
			>
			<span class="site-header__wordmark">
				EDI Hochbau GmbH
				<span>Rohbau · Berlin · Brandenburg</span>
			</span>
		</a>

		<nav class="nav" id="primary-nav" aria-label="Onepager-Navigation">
			<?php foreach ( edi_sections() as $sec ) : ?>
				<a href="#<?php echo esc_attr( $sec['slug'] ); ?>"><?php echo esc_html( $sec['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>

		<a href="tel:+493012345678" class="site-header__cta" aria-label="Bauleiter direkt anrufen">
			<span aria-hidden="true">↗</span>
			<span>030 / 123 456 78</span>
		</a>

		<button class="nav-toggle" id="nav-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="Menü öffnen">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
				<line x1="3" y1="7" x2="21" y2="7"></line>
				<line x1="3" y1="17" x2="21" y2="17"></line>
			</svg>
		</button>
	</div>
</header>

<main id="main" role="main">
