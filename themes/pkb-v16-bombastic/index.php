<?php
/**
 * Fallback template — same as front page for the onepager site.
 */
get_header();

pkb_section( 'hero' );
pkb_section( 'intro' );
pkb_section( 'leistungen' );
pkb_section( 'ueber' );
pkb_section( 'kontakt' );

get_footer();
