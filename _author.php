<?php get_header(); ?>

	<main id="main" class="main" role="main" tabindex="-1">
    <?php if (has_visible_widgets('widget-area-1')) { $sidebarclasses = 'sidebar'; } else { $sidebarclasses = 'no-sidebar'; }?>
		<div class="layout-main layout-constrain <?php echo $sidebarclasses; ?>">

			<div class="layout-main__content">
        <h1>Author.php template</h1>
				<section>

					<?php if (have_posts()): the_post(); ?>
						<h1 class="page-title"><?php _e( 'Author Archives for ', 'gesso' ); echo get_the_author(); ?></h1>

						<?php if ( get_the_author_meta('description')) : ?>
							<?php echo get_avatar(get_the_author_meta('user_email')); ?>
							<h2><?php _e( 'About ', 'gesso' ); echo get_the_author() ; ?></h2>
							<?php echo wpautop( get_the_author_meta('description') ); ?>
						<?php endif; ?>

						<?php rewind_posts(); while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header>
									<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
										</a>
									<?php endif; ?>
									<h2>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</h2>
									<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
									<span class="author"><?php _e( 'Published by', 'gesso' ); ?> <?php the_author_posts_link(); ?></span>
									<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'gesso' ), __( '1 Comment', 'gesso' ), __( '% Comments', 'gesso' )); ?></span>
								</header>
								<?php the_content(); ?>
								<footer>
									<?php edit_post_link(); ?>
								</footer>
							</article>
						<?php endwhile; ?>

					<?php else: ?>

						<article>
							<h2><?php _e( 'Sorry, nothing to display.', 'gesso' ); ?></h2>
						</article>

					<?php endif; ?>

					<?php get_template_part('templates/pagination'); ?>

				</section>
			</div>

			<div class="layout-sidebar__sidebar">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</main>

<?php get_footer(); ?>
