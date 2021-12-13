<?php
if ( ! function_exists( 'wp_next_theme_theme_setup' ) ) :
	function wp_next_theme_theme_setup() {
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
		add_image_size( 'large', 700, '', true ); // Large Thumbnail.
		add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
		add_image_size( 'small', 120, '', true ); // Small Thumbnail.
	}
	add_action( 'after_setup_theme', 'wp_next_theme_theme_setup' );
endif;

function wp_next_theme_theme_scripts() {
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
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/dist/css/styles.css', array(), filemtime( get_stylesheet_directory() . '/dist/css/styles.css' ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'wp_next_theme_theme_scripts' );

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
function wp_next_theme_google_font_enqueued_styles( $tag, $handle, $href, $media ) {
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
add_filter( 'style_loader_tag', 'wp_next_theme_google_font_enqueued_styles', 10, 4 );

function wp_next_theme_editor_scripts() {
	add_editor_style( 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap' );
	add_editor_style( 'dist/css/editor-styles.css' );
}
add_action( 'admin_init', 'wp_next_theme_editor_scripts' );

function wp_next_theme_block_patterns() {
  register_block_pattern_category('wp_next_theme',
  array(
    'label' => __('WP Next Theme')
  ));
  register_block_pattern('wp-next-theme/article', array(
    'title' => __( 'Article '),
    'categories' => array('wp_next_theme'),
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
EOT
  ));
}
add_action( 'init', 'wp_next_theme_block_patterns');
