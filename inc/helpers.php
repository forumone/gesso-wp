<?php
/**
 * Useful functions to speed up development.
 *
 * @link https://en.wikipedia.org/wiki/Don't_repeat_yourself
 *
 * @package Gesso
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Adds a post_type_label filter for twig
 *
 * @param Twig_Environment $twig The Twig environment object.
 *
 * @return Twig_Environment
 */
function f1__add_post_type_label_filter( Twig_Environment $twig ) {
	$twig->addFilter( new Twig_SimpleFilter( 'post_type_label', 'f1__get_post_type_label' ) );
	return $twig;
}
add_filter( 'timber/twig', 'f1__add_post_type_label_filter' );


/**
 * Returns a Timber\Post object of posts.
 *
 * @param array $collection The array of posts.
 *
 * @return array|null
 */
function f1__get_posts( $collection = null ) {
	if ( ! is_array( $collection ) ) {
		return null;
	}

	$result = Timber::get_posts(
		array(
			'post_type'   => 'any',
			'post__in' => $collection,
			'orderby' => 'post__in',
		)
	);
	return $result;
}


/**
 * Returns a Timber\Post object of posts related by single taxonomy.
 *
 * @param string $post_type The type of post.
 * @param string $taxonomy  The taxonomy.
 * @param array  $terms     The array of terms.
 * @param int    $qty       The number of posts to return.
 * @param int    $exclude   The post ID to exclude from results.
 *
 * @return null|array
 */
function f1__get_posts_by_tax( $post_type = 'post', $taxonomy = null, $terms = null, $qty = null, $exclude = null ) {
	if ( ! is_array( $terms ) ) {
		return null;
	}
	$result = Timber::get_posts(
		array(
			'post_type'   => $post_type,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $terms,
				),
			),
			'posts_per_page' => $qty,
			'post__not_in' => array( $exclude ),
		)
	);
	return $result;
}


/**
 * Returns a Timber\Post object of posts including pagination.
 *
 * @param string $post_type The type of post.
 *
 * @return array
 */
function f1__get_posts_with_pagination( $post_type = 'post' ) {
	global $paged;
	if ( ! isset( $paged ) || ! $paged ) {
		// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
		$paged = 1;
		// phpcs:enable
	}
	$args = array(
		'post_type' => $post_type,
		'paged' => $paged,
	);
	return new Timber\PostQuery( $args );
}


/**
 * Returns a Timber\Image object for a given media ID.
 *
 * @param int $id The image ID.
 *
 * @return array/null
 */
function f1__get_image( $id ) {
	if ( strlen( $id ) ) {
		return new TimberImage( $id );
	} else {
		return null;
	}
}


/**
 * Returns a given ammount of Timber\Post objects.
 *
 * @param mixed $post_type The type of posts to query for.
 * @param int   $qty       The number of posts to return per page.
 *
 * @return array
 */
function f1__get_posts_block( $post_type, $qty ) {
	return Timber::get_posts(
		array(
			'post_type' => $post_type,
			'posts_per_page' => $qty,
		)
	);
}


/**
 * Returns a Timber\TimberFunctionWrapper widget sidebar.
 *
 * @param int $id The ID of the sidebar widget.
 *
 * @return array
 */
function f1__get_sidebar( $id ) {
	return Timber::get_widgets( $id );
}


/**
 * Check the post type and return a label for it.
 *
 * @param string $post_type The post type name.
 *
 * @return string
 */
function f1__get_post_type_label( $post_type ) {
	$obj = get_post_type_object( $post_type );
	return apply_filters( 'f1/get_post_type_label', $obj->labels->singular_name, $obj );
}


/**
 * Adds a post_type_label property to each post object inside an array of posts objects.
 *
 * @param object $posts A collection of posts.
 *
 * @return object
 */
function f1__add_post_type_labels( $posts ) {
	// Add a post type label to each post.
	for ( $i = 0, $size = count( $posts ); $i < $size; ++$i ) {
		$posts[ $i ]->post_type_label = f1__get_post_type_label( $posts[ $i ]->post_type );
	}
	return $posts;
}


/**
 * Returns a WordPress menu.
 *
 * @param int|string|WP_Term $menu The menu indicator.
 *
 * @return object
 */
function f1__get_menu( $menu ) {
	return TimberHelper::function_wrapper( 'wp_nav_menu', array( 'menu' => $menu ) );
}

