<?php
/**
 * Template for displaying Tag Archive pages
 *
 * @package Gesso
 */

$context = Timber::get_context();
$context['pagination'] = Timber::get_pagination();
Timber::render( 'tag.twig', $context );
