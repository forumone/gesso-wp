<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Gesso
 */

$context = Timber::get_context();
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
$post = Timber::query_post();
// phpcs:enable
$context['post'] = $post;
// Define generic templates.
$templates = array(
	'single-' . $post->post_type . '-' . $post->slug . '.twig',
	'single-' . $post->ID . '.twig',
	'single-' . $post->post_type . '.twig',
	'single.twig',
);
if ( post_password_required( $post->ID ) ) {
	Timber::render( 'components/password-form.twig', $context );
} else {
	Timber::render( $templates, $context );
}
