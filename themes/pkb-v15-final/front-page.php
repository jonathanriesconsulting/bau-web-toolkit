<?php
/**
 * Front page — onepager composition.
 * Kontrast-Takt: DUNKEL Hero → HELL Trust-Bar → DUNKEL Intro → HELL Leistungen
 * → DUNKEL Cinema/CTA → HELL Über → GRAU-HELL FAQ → DUNKEL Kontakt → DUNKEL Footer.
 */
get_header();

pkb_section( 'hero' );
pkb_section( 'trustbar' );
pkb_section( 'intro' );
pkb_section( 'leistungen' );
pkb_section( 'ueber' );
pkb_section( 'faq' );
pkb_section( 'kontakt' );

get_footer();
