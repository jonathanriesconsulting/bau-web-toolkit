<?php
/**
 * EDI v5 — Dark + Gold Premium
 * Auto-generated WP-Theme aus Showcase-HTML.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    register_nav_menus( [ 'primary' => 'Hauptnavigation', 'footer' => 'Footer' ] );
} );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'edi-theme-v5-dark-gold-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get( 'Version' )
    );
} );

// Demo-Hook: stört Live-Form-Submission via JS-alert. Bei echtem Submit Contact Form 7 / Forminator nutzen.

/**
 * SEO: erzwungener Seitentitel + vollständiges robots-Meta (Fable-5-Pass).
 */
add_filter( 'pre_get_document_title', function () {
	return 'Rohbau-Subunternehmer für Generalunternehmer Berlin & Brandenburg | EDI Hochbau GmbH';
} );
add_filter( 'wp_robots', function ( array $robots ): array {
	$robots['index'] = true; $robots['follow'] = true;
	$robots['max-snippet'] = '-1'; $robots['max-image-preview'] = 'large'; $robots['max-video-preview'] = '-1';
	return $robots;
} );
