<?php
/**
 * The Template for displaying all single posts
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
// Define generic templates.
$templates = array( 
	'single-' . $post->post_type . '-' . $post->slug . '.twig', 
	'single-' . $post->ID . '.twig', 
	'single-' . $post->post_type . '.twig',
	'single.twig'
);
if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( $templates, $context );
}
