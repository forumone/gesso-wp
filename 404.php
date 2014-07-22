<?php get_header(); ?>

	<main id="main" class="main" role="main">	
    <?php if (has_visible_widgets('widget-area-1')) { $sidebarclasses = 'sidebar'; } else { $sidebarclasses = 'no-sidebar'; }?>
		<div class="l-main l-constrain <?php echo $sidebarclasses; ?>">
			
			<div class="l-main__content">
				<section>
					<article id="post-404">
						<h1 class="page-title"><?php _e( 'Uh oh. Page not found.', 'f1ux' ); ?></h1>
						<h2>
							<a href="<?php echo home_url(); ?>"><?php _e( 'Return to homepage?', 'f1ux' ); ?></a>
						</h2>
					</article>
				</section>
			</div>

			<div class="l-main__sidebar">
				<?php get_sidebar(); ?>
			</div>
		
		</div>
	</main>

<?php get_footer(); ?>
