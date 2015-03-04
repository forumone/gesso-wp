<?php

if ( ! isset( $content_width ) ) {
  $content_width = 1200;
}

add_theme_support( 'automatic-feed-links' );
 
if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true); // Large Thumbnail
  add_image_size('medium', 250, '', true); // Medium Thumbnail
  add_image_size('small', 120, '', true); // Small Thumbnail
  add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
}


function gesso_nav($location) {
  wp_nav_menu(
  array(
    'theme_location'  => $location,
    'menu'            => '',
    'container'       => '',
    'container_class' => '',
    'menu_class'      => '',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => false,
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<nav class="%1$s nav--' . $location . '" role="navigation"><ul class="nav">%3$s</ul></nav>',
    'depth'           => 0,
    'walker'          => new gesso_walker_nav_menu()
    )
  );
}


function has_visible_widgets($sidebar_id) {
  if (is_active_sidebar($sidebar_id)) {
    ob_start();
    dynamic_sidebar($sidebar_id);
    $sidebar = ob_get_contents();
    ob_end_clean();
    if ($sidebar == "") return false;
  } else {
    return false;
  }
  return true;
}


class gesso_walker_nav_menu extends Walker_Nav_Menu {
  
  // add classes to ul sub-menus
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
      'sub-menu',
      ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
      'menu-depth-' . $display_depth
      );
    $class_names = implode( ' ', $classes );
  
    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
  }
    
  // add main/sub classes to li's and links
   function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
      ( $depth == 0 ? 'main-menu__item' : 'sub-menu__item' ),
      ( $depth >=2 ? 'sub-sub-menu__item' : '' )
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
      
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
    
    // add active class    
    if ( is_array($class_names)) { // make sure the menu is an array and not empty or only a single item
      $class_names .= in_array("current_page_item",$item->classes) ? ' active' : '';
    }

    // build html
    $output .= $indent . '<li class="nav__item ' . $depth_class_names . $class_names .'">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="nav__link ' . ( $depth > 0 ? 'sub-menu__link' : 'main-menu__link' ) . '"';
  
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
      $args->before,
      $attributes,
      $args->link_before,
      apply_filters( 'the_title', $item->title, $item->ID ),
      $args->link_after,
      $args->after
    );
  
    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

// add first/last classes to menus
function add_first_and_last($output) {
  // See if the menus have the applied nav__item class, if not the output will remain default 
  // TODO: try to apply this class system to custom menus in widgets or in undefined locations
  if (preg_match('/class="nav__item/', $output)) {
    if (count($output) > 1) {    
      $output = preg_replace('/class="nav__item/', 'class="first nav__item', $output, 1);
      $output = substr_replace($output, 'class="last nav__item', strripos($output, 'class="nav__item'), strlen('class="menu-item'));
    }
  }
  return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');


function gesso_header_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    
    wp_deregister_script('jquery'); 
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array() ); // Google CDN jQuery
    wp_enqueue_script('jquery');  

    wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js', array('jquery') ); // Modernizr
    wp_enqueue_script('modernizr');  

    if ( is_singular() ) wp_enqueue_script( "comment-reply" );

    wp_register_script('gessoskiplinks', get_template_directory_uri() . '/js/skiplinks.js', array('jquery','modernizr') ); // Accessible skiplinks
    wp_enqueue_script('gessoskiplinks');  

    wp_register_script('gessomobilemenu', get_template_directory_uri() . '/js/mobile-menu.js', array('jquery','modernizr') ); // Mobile menu
    wp_enqueue_script('gessomobilemenu');  

    wp_register_script('gessoscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery','modernizr') ); // Custom scripts
    wp_enqueue_script('gessoscripts');  
  }
}

// uses echo since wp_register_style() currently has no way to <!--[if gte IE 9]><!--> type conditional comments
function gesso_styles() {
  echo '<!--[if gte IE 9]><!--><link rel="stylesheet" href="' . get_template_directory_uri() . '/css/styles.css" media="all"><!--<![endif]-->';
  echo '<!--[if lt IE 9]><link rel="stylesheet" href="' . get_template_directory_uri() . '/css/no-mq.css" media="all"><![endif]-->';
}


function register_gesso_menu() {
  register_nav_menus(array(  
    'primary' => __('Primary', 'gesso'),  
    'secondary' => __('Secondary', 'gesso')
  ));
}


// Add page slug to body class. Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
        unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }
  return $classes;
}


function gesso_widgets_init() {
  register_sidebar(array(
    'name' => __('Widget Area 1', 'gesso'),
    'description' => __('Widget Area 1', 'gesso'),
    'id' => 'widget-area-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget__title">',
    'after_title' => '</h3>'
  ));
}
add_action( 'widgets_init', 'gesso_widgets_init' );

function gesso_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages
  ));
}


 // Remove thumbnail dimensions  
function remove_thumbnail_dimensions( $html ) {
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Adjusting the <title>
/*add_filter('wp_title', 'gesso_pagetitle');
function gesso_pagetitle($title) {
    if (!empty($title)) {
        return $title;
    }
    else {
      echo get_bloginfo('name');
    }
}*/

add_theme_support( 'title-tag' );

//Allowing styles for post editor to match how it will actually be visually represented 
function gesso_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}


add_action('init', 'gesso_header_scripts');  
add_action('wp_head', 'gesso_styles');
add_action('init', 'gesso_pagination'); 
add_action('init', 'register_gesso_menu');  

add_filter('body_class', 'add_slug_to_body_class');  
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_action( 'admin_init', 'gesso_add_editor_styles' );
