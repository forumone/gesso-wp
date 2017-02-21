<?php

// Setting main content width - update to match the width of your site's main content area.
if ( ! isset( $content_width ) ) {
  $content_width = 840;
}

if ( function_exists('add_theme_support') ) {
  // Adding theme support for HTML5
  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', ) );

  // Adds site name to title tag
  add_theme_support( 'title-tag' );

  // Add support for automatic links for feeds.
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );

  # Define automatic thumbnail sizes
  add_image_size( 'large', 700, '', true ); // Large Thumbnail
  add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
  add_image_size( 'small', 120, '', true ); // Small Thumbnail
  //add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
}


function gesso_nav( $location ) {
  wp_nav_menu(
    array(
      'theme_location'  => $location,
      'menu'      => '',
      'container'     => '',
      'container_class' => '',
      'menu_class'    => '',
      'menu_id'     => '',
      'echo'      => true,
      'fallback_cb'   => false,
      'before'      => '',
      'after'       => '',
      'link_before'   => '',
      'link_after'    => '',
      'items_wrap'    => '<nav class="%1$s nav--' . $location . '" role="navigation"><ul class="nav">%3$s</ul></nav>',
      'depth'       => 0,
      'walker'      => new gesso_walker_nav_menu(),
    )
  );
}


function has_visible_widgets( $sidebar_id ) {
  if ( is_active_sidebar( $sidebar_id ) ) {
    ob_start();
    dynamic_sidebar( $sidebar_id );
    $sidebar = ob_get_contents();
    ob_end_clean();
    if ( $sidebar == "" ) {
      return false;
    }
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
      'nav__subnav',
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
    if ( is_array($class_names) ) { // make sure the menu is an array and not empty or only a single item
      $class_names .= in_array("current_page_item",$item->classes) ? ' is-active' : '';
    }

    // build html
    $output .= $indent . '<li class="nav__item ' . $depth_class_names . $class_names .'">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )   ? ' target="' . esc_attr( $item->target   ) .'"' : '';
    $attributes .= ! empty( $item->xfn )    ? ' rel="'  . esc_attr( $item->xfn    ) .'"' : '';
    $attributes .= ! empty( $item->url )    ? ' href="'   . esc_attr( $item->url    ) .'"' : '';
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
add_filter( 'wp_nav_menu', 'add_first_and_last' );


function gesso_header_scripts() {
  global $wp_styles;

  wp_deregister_script('jquery');
  wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array() ); // Google CDN jQuery
  wp_enqueue_script('jquery');

  wp_register_script('gessomodernizr', get_template_directory_uri() . '/js/lib/modernizr.min.js', array('jquery') ); // Modernizr
  wp_enqueue_script('gessomodernizr');

  if ( is_singular() && comments_open() ) {
    wp_enqueue_script( "comment-reply" );
  }

  wp_register_script('gessomobilemenu', get_template_directory_uri() . '/js/mobile-menu.js', array('jquery','gessomodernizr') ); // Mobile menu
  wp_enqueue_script('gessomobilemenu');

  wp_register_script('gessoscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery','gessomodernizr') ); // Custom scripts
  wp_enqueue_script('gessoscripts');

  wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/css/styles.css', array(), null, 'all' );

}
add_action( 'wp_enqueue_scripts', 'gesso_header_scripts' );

function register_gesso_menu() {
  register_nav_menus( array(
    'primary' => __('Primary', 'gesso'),
    'secondary' => __('Secondary', 'gesso'),
  ));
}
add_action( 'init', 'register_gesso_menu' );


// Add page slug to body class. Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
  global $post;
  if (is_home()) {
    $key = array_search( 'blog', $classes );
    if ( $key > -1 ) {
      unset( $classes[ $key ] );
    }
  } elseif ( is_page() ) {
    $classes[] = sanitize_html_class( $post->post_name );
  } elseif ( is_singular() ) {
    $classes[] = sanitize_html_class( $post->post_name );
  }

  return $classes;
}
add_filter( 'body_class', 'add_slug_to_body_class' );

// Initial Sidebar and Footer Widget Areas
add_action( 'widgets_init', 'gesso_widgets_init' );
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

  register_sidebar(array(
    'name' => __('Footer Widgets', 'gesso'),
    'description' => __('Footer Widgets', 'gesso'),
    'id' => 'footer-widgets',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget__title">',
    'after_title' => '</h3>'
  ));
}

function gesso_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
  ) );
}
add_action('init', 'gesso_pagination');

//Adds proper markup to pages content
function gesso_link_pages() {
  $gesso_links = array(
    'before'    => '<nav role="navigation" aria-labelledby="pagination-heading"><h2 id="pagination-heading" class="visually-hidden">Pagination</h2><ul class="pager">',
    'after'     => '</ul></nav>',
    'link_before' => '<li class="pager__item>',
    'link_after'  => '</li>',
  );
  wp_link_pages( $gesso_links );
}


 // Remove thumbnail dimensions
function remove_thumbnail_dimensions( $html ) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
  return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height attributes from thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height attributes from post images

// Allowing styles for post editor to match how it will actually be visually represented
function gesso_add_editor_styles() {
  add_editor_style( 'css/custom-editor-styles.css' );
}
add_action( 'admin_init', 'gesso_add_editor_styles' );


//------------------------------------------------------
// Timber Support - Starter Theme Functions
//------------------------------------------------------
if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
  } );
  return;
}

Timber::$dirname = array('templates');

class StarterSite extends TimberSite {

  function __construct() {
    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    parent::__construct();
  }

  function add_to_context( $context ) {
    $context['foo'] = 'bar';
    $context['stuff'] = 'I am a value set in your functions.php file';
    $context['notes'] = 'These values are available everytime you call Timber::get_context();';
    $context['menu'] = new TimberMenu();
    $context['current_year'] = date('Y');
    $context['site'] = $this;
    return $context;
  }

  function add_to_twig( $twig ) {
    // this is where you can add your own fuctions to twig
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
    return $twig;
  }

}

new StarterSite();
