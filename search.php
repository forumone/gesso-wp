<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Gesso
 */

$context = Timber::get_context();
$context['pagination'] = Timber::get_pagination();
Timber::render( 'search.twig', $context );
