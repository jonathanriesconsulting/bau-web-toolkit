<?php
/**
 * Site header & opening HTML.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#ffffff">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/logo.svg' ); ?>" type="image/svg+xml">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">Zum Inhalt springen</a>

<header class="site-header" data-pkb-header>
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="Pascal Kacemer Bauunternehmung GmbH — Startseite">
			<img class="brand__logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/logo.svg' ); ?>" alt="Pascal Kacemer Bauunternehmung GmbH" width="56" height="44">
		</a>
		<nav class="nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'pkb' ); ?>">
			<?php foreach ( pkb_sections() as $section ) : ?>
				<a href="#<?php echo esc_attr( $section['slug'] ); ?>"><?php echo esc_html( $section['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>
		<a href="#kontakt" class="header-cta">Bauanfrage</a>
		<button class="nav-toggle" id="nav-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="Menü öffnen">
			<span class="nav-toggle__bar"></span>
			<span class="nav-toggle__bar"></span>
			<span class="nav-toggle__bar"></span>
		</button>
	</div>
</header>

<main id="main">
