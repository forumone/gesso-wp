<?php
/**
 * The template for displaying side bars
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#category
 *
 * @package Gesso
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		the_content();
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
