<?php
/**
 * Third party plugins that hijack the theme will call get_header() to get the header template.
 * We use this to start our output buffer and render into the templates/page-plugin.twig template in footer.php
 *
 * @package Gesso
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'gesso' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
			$gesso_description = get_bloginfo( 'description', 'display' );
			if ( $gesso_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $gesso_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gesso' ); ?></button>
			<?php
			wp_nav_menu(
					array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
					)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

