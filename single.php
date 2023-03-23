<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Gesso
 */

get_header();
?>

<?php block_template_part( 'single-content' ); ?>

<?php
get_sidebar();
get_footer();
