<?php

/*------------------------------------------------------------------*
 * Useful functions to speed up development. 
 * DRY principle: https://en.wikipedia.org/wiki/Don't_repeat_yourself
/*------------------------------------------------------------------*/


/**
 * Returns an array of Timber\Post objects, or null.
 * @param array $collection
 * @return array/null
 */
function gesso_get_posts_by_id( $collection = null ) {
	if ( !is_array( $collection ) )
		return null;
	
	$result = Timber::get_posts(
		array(
			'post_type'   => 'any',
			'post__in' => $collection,
			'orderby' => 'post__in'
		)
	);
	return $result;
}


/**
 * Returns a Timber\Post object of posts related by single taxonomy.
 * @param string|array $post_type
 * @param string $taxonomy
 * @param array $terms
 * @param int $qty
 * @param int $excl
 * @return array
 */
function gesso_get_posts_by_tax( $post_type, $taxonomy, $terms, $qty = null, $excl = null ) {
	if ( !is_array( $terms ) )
		return null;
	$result = Timber::get_posts(
		array(
			'post_type'   => $post_type,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $terms
				)
			),
			'posts_per_page' => $qty,
			'post__not_in' => array( $excl )
		)
	);
	return $result;
}


/**
 * Returns a Timber\Post object of posts including pagination.
 * @param string $post_type
 * @return array
 */
function gesso_get_paged_posts( $post_type ) {
	global $paged;
	if ( !isset( $paged ) || !$paged ) {
		$paged = 1;
	}
	$args = array(
		'post_type' => $post_type,
		'paged' => $paged
	);
	return new Timber\PostQuery( $args );
}


/**
 * Returns a Timber\Image object for a given media ID.
 * @param int $id
 * @return array/null
 */
function gesso_get_image( $id ) {
	if ( strlen( $id ) ) {
		return new Timber\Image( $id );
	} else {
		return null;
	}
}


/**
 * Returns a Timber\TimberFunctionWrapper widget sidebar.
 * @param int $id
 * @return array
 */
function gesso_get_sidebar( $id ) {
	return Timber::get_widgets( $id );
}


/**
 * Check the post type and return a label for it.
 * @param string $post_type
 * @return string
 */
function gesso_get_post_type_label( $post_type ) {
	$obj = get_post_type_object( $post_type );
	return apply_filters( 'gesso/get_post_type_label' , $obj->labels->singular_name, $obj );
}


/**
 * Adds a post_type_label property to each post object inside an array of posts objects.
 * @param object $posts
 * @return object
 */
function gesso_add_post_type_labels( $posts ) {
	// Add a post type label to each post.
	for( $i = 0, $size = count( $posts ); $i < $size; ++$i ) {
		$posts[$i]->post_type_label = gesso_get_post_type_label( $posts[$i]->post_type );
	}
	return $posts;
}


/**
 * Returns a WordPress menu.
 * @param int|string|WP_Term $menu
 * @return object
 */
function gesso_get_menu( $menu ) {
	return TimberHelper::function_wrapper( 'wp_nav_menu', array( 'menu' => $menu ) );
}


/*------------------------------------------------------------------*
 * Twig filters.
/*------------------------------------------------------------------*/


/**
 * Adds a post_type_label filter for twig
 * @param Twig_Environment $twig
 * @return Twig_Environment
 */
function gesso_add_post_type_label_filter( \Twig_Environment $twig ) {
	$twig->addFilter( new \Twig_SimpleFilter( 'post_type_label', 'gesso_get_post_type_label' ) );
	return $twig;
}
add_filter( 'timber/twig', 'gesso_add_post_type_label_filter' );

