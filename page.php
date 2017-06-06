<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
// Define generic templates.
$templates = array( 
	'page-' . $post->post_name . '.twig', 
	'page-' . $post->ID . '.twig', 
	'page.twig' 
	);
// Set the Homepage template.
if ( is_front_page() ) array_unshift( $templates, 'front-page.twig' );
// Render twig template.
Timber::render( $templates, $context );
