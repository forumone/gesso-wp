<?php
/**
 * Template for displaying Category Archive pages
 *
 * @package Gesso
 */

$data = Timber::get_context();
$data['pagination'] = Timber::get_pagination();
$data['archive_title'] = get_cat_name( get_query_var( 'cat' ) );
$data['archive_description'] = term_description();
$data['page'] = 'category';
$template = 'category.twig';

Timber::render( $template, $data );
