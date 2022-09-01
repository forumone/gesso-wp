<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gesso
 * @since 1.0.0
 */

if ( ! function_exists( 'gesso_theme_setup' ) ) :
	/**
	 * Initialize basic theme customizations for Gesso theme.
	 */
	function gesso_theme_setup() {
		// Support featured images.
		add_theme_support( 'post-thumbnails' );
		// Support wide alignment.
		add_theme_support( 'align-wide' );
		// Support editor styles.
		add_theme_support( 'editor-styles' );
		// Disable WordPress's block patterns.
		// Comment out if you want to use them.
		remove_theme_support( 'core-block-patterns' );

		// Define featured image sizes.
		add_image_size( 'large_cropped', 800, 600, true );
		add_image_size( 'large', 700, '', true ); // Large Thumbnail.
		add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
		add_image_size( 'small', 120, '', true ); // Small Thumbnail.
	}
	add_action( 'after_setup_theme', 'gesso_theme_setup' );
endif;

/**
 * Enqueue and register required scripts and stylesheets for the Gesso theme.
 */
function gesso_theme_scripts() {
	// Enqueue Google Fonts.
	/**
	 * Google font preconnect setup doesn't work when version is specified.
	 *
	 * phpcs:disable WordPress.WP.EnqueuedResourceParameters.MissingVersion
	 */
	wp_enqueue_style( 'google-fonts-preconnect-api', 'https://fonts.googleapis.com', array(), null );
	wp_enqueue_style( 'google-fonts-preconnect', 'https://fonts.gstatic.com', array( 'google-fonts-preconnect-api' ), null );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap', array( 'google-fonts-preconnect' ), null );
	// phpcs:enable
	$style_asset_file = include 'build/css/styles.asset.php';
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/build/css/styles.css', $style_asset_file['dependencies'], $style_asset_file['version'], 'all' );

	// WP doesn't support enqueuing scripts by block at the theme level yet.
	// Maybe in 6.0.
	$search_script_asset_file = include 'build/js/search.asset.php';
	wp_enqueue_script( 'gesso-search', get_stylesheet_directory_uri() . '/build/js/search.js', $search_script_asset_file['dependencies'], $search_script_asset_file['version'] );
}
add_action( 'wp_enqueue_scripts', 'gesso_theme_scripts' );

/**
 * Register block styles custom to Gesso theme.
 */
function gesso_block_assets() {
	wp_enqueue_block_style(
		'core/button',
		array(
			'handle' => 'gesso-button',
			'src' => get_theme_file_uri( 'build/css/button.css' ),
			'path' => get_theme_file_path( 'build/css/button.css' ),
		)
	);
	if ( function_exists( 'f1_block_library_register_blocks' ) ) {
		wp_enqueue_block_style(
			'f1-block-library/accordion',
			array(
				'handle' => 'gesso-accordion',
				'src' => get_theme_file_uri( 'build/css/accordion.css' ),
				'path' => get_theme_file_path( 'build/css/accordion.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/back-to-top',
			array(
				'handle' => 'gesso-back-to-top',
				'src' => get_theme_file_uri( 'build/css/back-to-top.css' ),
				'path' => get_theme_file_path( 'build/css/back-to-top.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/featured-cards',
			array(
				'handle' => 'gesso-cards',
				'src' => get_theme_file_uri( 'build/css/cards.css' ),
				'path' => get_theme_file_path( 'build/css/cards.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/query-cards',
			array(
				'handle' => 'gesso-cards',
				'src' => get_theme_file_uri( 'build/css/cards.css' ),
				'path' => get_theme_file_path( 'build/css/cards.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/manual-cards',
			array(
				'handle' => 'gesso-cards',
				'src' => get_theme_file_uri( 'build/css/cards.css' ),
				'path' => get_theme_file_path( 'build/css/cards.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/skiplinks',
			array(
				'handle' => 'gesso-skiplinks',
				'src' => get_theme_file_uri( 'build/css/skiplinks.css' ),
				'path' => get_theme_file_path( 'build/css/skiplinks.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/standalone-link',
			array(
				'handle' => 'gesso-standalone-link',
				'src' => get_theme_file_uri( 'build/css/standalone-link.css' ),
				'path' => get_theme_file_path( 'build/css/standalone-link.css' ),
			)
		);
		wp_enqueue_block_style(
			'f1-block-library/slider',
			array(
				'handle' => 'gesso-slider',
				'src' => get_theme_file_uri( 'build/css/slider.css' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'gesso_block_assets' );

/**
 * Filter enqueue styles.
 *
 * @param string $tag    The link tag for the enqueued style.
 * @param string $handle The style's registered handle.
 * @param string $href   The stylesheet's source URL.
 * @param string $media  The stylesheet's media attribute.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter) $media does not need to be checked or used in this case.
 *
 * @return string
 */
function gesso_google_font_enqueued_styles( $tag, $handle, $href, $media ) {
	$handles = array( 'google-fonts-preconnect', 'google-fonts-preconnect-api' );
	// Google font preconnect rewrite.
	if ( in_array( $handle, $handles ) ) {
		$tag = '<link rel="preconnect" href="' . $href . '" />';
		if ( boolval( strpos( $href, 'gstatic' ) ) ) {
			$tag = '<link rel="preconnect" href="' . $href . '" crossorigin />';
		}
	}
	return $tag;
}
add_filter( 'style_loader_tag', 'gesso_google_font_enqueued_styles', 10, 4 );

/**
 * Enqueue Wordpress editor specific scripts.
 */
function gesso_editor_scripts() {
	$script_asset_file = include 'build/js/editor-scripts.asset.php';
	wp_enqueue_script( 'editor-script', get_stylesheet_directory_uri() . '/build/js/editor-scripts.js', array_merge( $script_asset_file['dependencies'], array( 'wp-edit-post' ) ), $script_asset_file['version'] );

}
add_action( 'enqueue_block_editor_assets', 'gesso_editor_scripts' );

/**
 * Enqueue Wordpress editor specific styles.
 */
function gesso_editor_styles() {
	add_editor_style( 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap' );
	add_editor_style( get_stylesheet_directory_uri() . '/build/css/editor-styles.css' );
}
add_action( 'admin_init', 'gesso_editor_styles' );

/**
 * Customizes meta data for Wordpress blocks.
 *
 * @param array $metadata Array of Wordpress block data.
 * @return mixed
 */
function gesso_block_metadata_registration( $metadata ) {
	if ( 'core/button' === $metadata['name'] ) {
		// Disables the color and radius selector for buttons,
		// so buttons will be limited to the available styles.
		$metadata['supports']['color'] = false;
		$metadata['supports']['__experimentalBorder'] = false;
	}
	return $metadata;
}
add_filter( 'block_type_metadata', 'gesso_block_metadata_registration' );

/**
 * Register block patterns custom to the Gesso theme.
 */
function gesso_block_patterns() {
	register_block_pattern_category(
		'gesso',
		array(
			'label' => __( 'Gesso' ),
		)
	);
	register_block_pattern(
		'gesso/article',
		array(
			'title' => __( 'Article ' ),
			'categories' => array( 'gesso' ),
			'viewportWidth' => 700,
			'content' => <<<EOT
<!-- wp:group {"tagName":"article","className":"article","layout":{"inherit":true}} -->
<article class="wp-block-group article"><!-- wp:post-title {"level":1,"className":"article__title"} /-->

<!-- wp:group {"tagName":"footer","className":"article__footer","layout":{"type":"flex","allowOrientation":false,"flexWrap":"nowrap"}} -->
<footer class="wp-block-group article__footer"><!-- wp:post-date /-->

<!-- wp:post-author {"showAvatar":false,"showBio":false} /--></footer>
<!-- /wp:group -->

<!-- wp:post-content {"className":"article__content"} /--></article>
<!-- /wp:group -->
EOT,
		)
	);
}
add_action( 'init', 'gesso_block_patterns' );

/**
 * Render collapsible search block if contains the required class name.
 *
 * @param string $block_content String contents of the block.
 * @param array  $block          Array containing search block-specific details.
 * @return string
 */
function gesso_collapsed_search( $block_content, $block ) {
	if ( ! empty( $block['attrs']['className'] ) &&
	strpos( $block['attrs']['className'], 'is-style-collapsed' ) !== false ) {
		return '<div class="collapsed-search"><button type="button" class="collapsed-search__toggle"><svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			fill="currentColor"
			width="24px"
			height="24px"
		>
			<path d="M0 0h24v24H0z" fill="none" />
			<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
		</svg></button><div class="collapsed-search__content">' . $block_content . '</div></div>';
	}
	return $block_content;
}
add_filter( 'render_block_core/search', 'gesso_collapsed_search', 10, 2 );
