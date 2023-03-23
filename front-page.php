<?php
/**
 * The template for displaying the front page of the site
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gesso
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php block_template_part( 'front-page' ); ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
