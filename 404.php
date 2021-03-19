<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gesso
 */

$context = Timber::get_context();
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
$post = new Timber\Post();
// phpcs:enable
$context['post'] = $post;
Timber::render( '404.twig', $context );
