<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
// var_dump($wp_query->query_vars);
 if ( get_query_var('paged') ) {
     $paged = get_query_var('paged');
 } elseif ( get_query_var('page') ) {
     $paged = get_query_var('page');
 } else {
     $paged = 1;
 }

$args = array(
  'post_type' => 'post',
	'post_status' => 'publish',
  'posts_per_page' => -1,
  'paged' => $paged
);
$context = Timber::get_context();
$context['posts'] = Timber::get_posts( $args );
$context['pagination'] = Timber::get_pagination( $args );
// $context['author_posts'] = new Timber\PostQuery( $args );
$context['date'] = get_the_date( 'l, F j Y' );
if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new TimberUser( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title'] = 'Author Archives: ' . $author->name();
}
Timber::render( array( 'author.twig', 'archive.twig', 'search.twig' ), $context );
