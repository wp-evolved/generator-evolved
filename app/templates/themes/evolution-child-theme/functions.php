<?php

/**
 * Define Global Exterior Account Variables
 * Uncomment and edit these as you need them
 */
define( 'CHILD_SS_URI', get_stylesheet_directory_uri() );
define( 'CHILD_SS_DIR', get_stylesheet_directory() );
define( 'DEFAULT_PHOTO', CHILD_SS_URI .'/assets/img/min/default-photo.gif' );

//define( 'TYPEKIT', '123456' );
//define( 'HFJ_ACCOUNT', '123456' );
//define( 'HFJ_PROJECT', 123456);
//define( 'GOOGLE_PLUS_AUTHOR', '' );
//define( 'FB_APP_ID', '' );
//define( 'TWITTER_USERNAME', '' );
//define( 'FB_PAGE', '' );
//define( 'GOOGLE_PLUS_PUBLISHER', '' );


/**
 * Add new classes to the $classes array
 * http://codex.wordpress.org/Function_Reference/body_class#Add_Classes_By_Filters
 */
add_filter( 'body_class','my_class_names' );
function my_class_names( $classes ) {
  global $post;

  if ( is_front_page() ) :
    $classes[] = 'home';
  elseif ( is_page() ) :
    $classes[] = $post->post_name;
  elseif( is_archive() ) :
    $classes[] = 'archive';
  elseif( is_404() ) :
    $classes[] = 'error';
  elseif( is_search() ) :
    $classes[] = 'search';
  endif;

  return $classes;
}


/**
 * Remove brakcets from ellipse
 */
function excerpt_ellipse( $text ) {
  return str_replace( '[...]', '&#8230;', $text );
}
add_filter( 'get_the_excerpt', 'excerpt_ellipse' );


/** IMAGES
 *
 * Add Post Thumbnails
 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50, true );

/*
 *  ADD SUPPORT FOR VARIOUS THUMBNAIL SIZES
 *  http://codex.wordpress.org/Function_Reference/add_image_size
 */
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'post-thumb', 250, 140, true ); //(cropped)
}


/**
 * Remove Yoast SEO Canonical URLs + WP SEO Title
 * http://yoast.com/wordpress/seo/api/#highlighter_245949
 */
function wpseo_disable_rel_next_home( $link ) {
  if ( is_front_page() ) {
    return false;
  }
}
add_filter( 'wpseo_next_rel_link', 'wpseo_disable_rel_next_home' );


/**
 * Load Development Styles/Scripts (for local)
 */
function load_dev_styles_scripts() {
  // Theme styles
  wp_enqueue_style( 'themename', CHILD_SS_URI . '/assets/dev/style.css', false, null, 'all' );

  // Header Scripts
  wp_enqueue_script( 'header_scripts', CHILD_SS_URI . '/assets/dev/header.js', array(), null, false );

  // Footer Scripts
  wp_enqueue_script( 'footer_scripts', CHILD_SS_URI . '/assets/dev/footer.js', array( 'jquery' ), null, true );

  // Single Scripts
  if ( is_single() ) {
    wp_enqueue_script( 'single_scripts', CHILD_SS_URI . '/assets/dev/single.js', array( 'jquery' ), null, true );
  }
}
if ( !is_admin() && 'local' == WP_ENV ) add_action( 'wp_enqueue_scripts', 'load_dev_styles_scripts' );


/**
 * Load Distribution Styles/Scripts (for staging and production)
 */
function load_prod_styles_scripts() {
  // Theme styles
  wp_enqueue_style( 'themename', CHILD_SS_URI . '/assets/dist/style.min.css', false, null, 'all' );

  // Header Scripts
  wp_enqueue_script( 'header_scripts', CHILD_SS_URI . '/assets/dist/header.min.js', array(), null, false );

  // Footer Scripts
  wp_enqueue_script( 'footer_scripts', CHILD_SS_URI . '/assets/dist/footer.min.js', array( 'jquery' ), null, true );

  // Single Scripts
  if ( is_single() ) {
    wp_enqueue_script( 'single_scripts', CHILD_SS_URI . '/assets/dist/single.min.js', array( 'jquery' ), null, true );
  }
}
if ( !is_admin() && 'local' != WP_ENV ) add_action( 'wp_enqueue_scripts', 'load_prod_styles_scripts' );


/**
 * Remove Query Strings from Static Resources
 * Source: http://forwpblogger.com/tutorial/remove-query-strings-from-static-resources/
 */
function _remove_script_version( $src ){
  $parts = explode( '?', $src );
  return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


/**
 * Include external function calls
 * Uncomment and edit these as you need them
 */
require_once( CHILD_SS_DIR . '/functions/display-post-thumbnails.php' );
require_once( CHILD_SS_DIR . '/functions/pagination.php' );

//require_once( CHILD_SS_DIR . '/functions/cpt_example.php' );
//require_once( CHILD_SS_DIR . '/functions/gform_placeholder.php' );
//require_once( CHILD_SS_DIR . '/functions/metabox/example-functions.php' );
//require_once( CHILD_SS_DIR . '/functions/Tax-meta-class/example-tax-meta.php' );

?>
