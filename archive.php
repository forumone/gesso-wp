<?php
/**
 * The template for displaying the site archive pages
 *
 * This theme, out of the box, references the correspondingly named html file
 * in the parts folder. This strategy leverages the quasi-block editor
 * approach that Forum One is taking. If, for the purposes of your current
 * build, it necessitates managing your template in PHP rather than the
 * editor, you can use the following reference as a starter guide.
 *
 * Creating a php based archive page.
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/#archive-php
 *
 * Futher information about block template parts in traditional theme.
 * @link https://make.wordpress.org/core/2022/10/04/block-based-template-parts-in-traditional-themes/
 *
 * Further information about the Wordpress template hierarchy.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#category
 *
 * @package Gesso
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
