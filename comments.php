<?php if (post_password_required()) : ?>
	<div class="comments">
		<p><?php _e( 'Post is password protected. Enter password to view comments.', 'gesso' ); ?></p>
	</div>
<?php return; endif; ?>

<div class="comments">
	<?php if (have_comments()) : ?>
		<h2><?php comments_number(); ?></h2>
		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
				) );
			?>
		</ul> 
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php _e( 'Comments are closed.', 'gesso' ); ?></p>
	<?php endif; ?>
	<?php comment_form(); ?>
</div>
