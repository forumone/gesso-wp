<?php

/**
 * Registers ACF Custom Blocks for Gutenberg.
 * @link 	https://www.advancedcustomfields.com/resources/acf-init/
 */
function gesso_acf_init() {
	// Bail out if function doesn’t exist.
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	/** 
	 * Register a block.
	 * @link 	https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 */
	// acf_register_block_type( [
	// 	'name'            => 'my-custom-block',
	// 	'title'           => __( 'My Custom Block', 'gesso' ),
	// 	'description'     => __( 'ACF powered custom Gutenberg block.', 'gesso' ),
	// 	'render_callback' => 'gesso_block_render_callback',
	// 	'category'        => 'formatting',
	// 	'icon'            => 'layout',
	// 	'supports'        => [ 'align' => [] ]
	// ] );

}
add_action( 'acf/init', 'gesso_acf_init' );


/**
 * This is the callback that displays the block.
 *
 * @param   array  $block      		The block settings and attributes.
 * @param   string $content    		The block content (emtpy string).
 * @param   bool   $is_preview 		True during AJAX preview.
 * @param   (int|string) $post_id 	The post ID this block is saved to.
 * @return 	(bool|string)
 * @link 	https://timber.github.io/docs/guides/gutenberg/#using-gutenberg-with-timber
 */
function gesso_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {
	$context = Timber::context();

	// Store field values.
	$context['fields'] = get_fields();

	// Store $is_preview value.
	$context['is_preview'] = $is_preview;

	// Get the block slug and add it to $block.
	$slug = str_replace( 'acf/', '', $block['name'] );
	$block['slug'] = $slug;

	// Store block values.
	$context['block'] = $block;

	// Render the block.
	Timber::render( "templates/blocks/content-{$slug}.twig", $context );
}