<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<?php if ( has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'f1ux' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'f1ux' ), __( '1 Comment', 'f1ux' ), __( '% Comments', 'f1ux' )); ?></span>
		</header>
				
		<?php the_content(); ?>
		
		<footer>
			<?php edit_post_link(); ?>
		</footer>
	</article>

<?php endwhile; ?>

<?php else: ?>

	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'f1ux' ); ?></h2>
	</article>

<?php endif; ?>
