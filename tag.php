<?php get_header(); ?>

	<main id="main" class="main" role="main">	
    <?php if (has_visible_widgets('widget-area-1')) { $sidebarclasses = 'sidebar'; } else { $sidebarclasses = 'no-sidebar'; }?>
		<div class="l-main l-constrain <?php echo $sidebarclasses; ?>">
			
			<div class="l-main__content">
				<section>
					<h1 class="page-title"><?php _e( 'Tag Archive: ', 'f1ux' ); echo single_tag_title('', false); ?></h1>
					<?php get_template_part('templates/loop'); ?>
					<?php get_template_part('templates/pagination'); ?>
				</section>
			</div>

			<div class="l-main__sidebar">
				<?php get_sidebar(); ?>
			</div>
		
		</div>
	</main>

<?php get_footer(); ?>
