<?php get_header(); ?>

	<main id="main" class="main" role="main" tabindex="-1">	
    <?php if (has_visible_widgets('widget-area-1')) { $sidebarclasses = 'sidebar'; } else { $sidebarclasses = 'no-sidebar'; }?>
		<div class="layout-main layout-constrain <?php echo $sidebarclasses; ?>">
			
			<div class="layout-main__content">
				<section>
					<?php get_template_part('templates/loop'); ?>
					<?php get_template_part('templates/pagination'); ?>
				</section>
			</div>
			
			<div class="layout-main__sidebar">
				<?php get_sidebar(); ?>
			</div>
		
		</div>
	</main>

<?php get_footer(); ?>
