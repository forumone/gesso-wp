<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gesso
 */

if ( ! class_exists( 'Timber' ) ) {
	wp_die( 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>', 'Missing Required Plugin' );
}

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();
$templates = array( 'index.twig' );
if ( is_front_page() ) {
	array_unshift( $templates, 'front-page.twig' );
}
Timber::render( $templates, $context );
