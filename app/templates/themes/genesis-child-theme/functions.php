<?php

/**
 * Define Global Exterior Account Variables
 * Uncomment and edit these as you need them
 */
define( 'CHILD_SS_URI', get_stylesheet_directory_uri() );
define( 'CHILD_SS_DIR', get_stylesheet_directory() );

//define( 'DEFAULT_IMG_ID', '1234'); // post id of default photo
//define('TYPEKIT', '123456');
//define('HFJ_ACCOUNT', '123456');
//define('HFJ_PROJECT', 123456);
//define('FB_APP_ID', '12345678910');


/**
 * Use Yoast SEO Plugin to create these constants
 * http://wordpress.org/plugins/wordpress-seo/
 * https://gist.github.com/germanny/6222479
*/
if ( function_exists( 'get_wpseo_options' ) ) {
    $get_options_wpseo_social = get_option('wpseo_social');
    define('TWITTER_USERNAME', $get_options_wpseo_social['twitter_site']);
    define('FB_PAGE', $get_options_wpseo_social['facebook_site']);

    $plus_author_link = get_user_meta($get_options_wpseo_social['plus-author'], 'googleplus', TRUE);
    $plus_author_link = ( substr($plus_author_link, -1) == '/' ) ? $plus_author_link . '?rel=author' : $plus_author_link . '/?rel=author';
    define('GOOGLE_PLUS_AUTHOR', $plus_author_link);

    $plus_publisher_link = $get_options_wpseo_social['plus-publisher'];
    $plus_publisher_link = ( substr($plus_publisher_link, -1) == '/' ) ? $plus_publisher_link . '?rel=publisher' : $plus_publisher_link . '/?rel=publisher';
    define('GOOGLE_PLUS_PUBLISHER', $plus_publisher_link);
} else {
    define('TWITTER_USERNAME', '');
    define('FB_PAGE', '');
    define('GOOGLE_PLUS_AUTHOR', '');
    define('GOOGLE_PLUS_PUBLISHER', '');
}


/**
 * Add new classes to the $classes array
 * http://codex.wordpress.org/Function_Reference/body_class#Add_Classes_By_Filters
 */
add_filter('body_class','my_class_names');
function my_class_names($classes) {
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

	// return the $classes array
	return $classes;
}


/**
  * Post Formats Support
  */
function add_post_formats() {
	add_theme_support( 'post-formats', array('video') );
}
add_action('init', 'add_post_formats');


/**
 * Remove brakcets from ellipse
 */
function excerpt_ellipse($text) {
	return str_replace('[...]', '&#8230;', $text);
}
add_filter('get_the_excerpt', 'excerpt_ellipse');


/** IMAGES
 *
 * Add Post Thumbnails
 */
add_theme_support('post-thumbnails');
set_post_thumbnail_size(50, 50, true);

/*
 *  ADD SUPPORT FOR VARIOUS THUMBNAIL SIZES
 *  http://codex.wordpress.org/Function_Reference/add_image_size
    ---------------------------------------------------------------------------------------------------- */
    if ( function_exists( 'add_image_size' ) ) {
      add_image_size('post-thumb', 250, 140, true); //(cropped)
    }

/*
 *  Manually Set the Featured Image in WordPress
    Source: http://wpforce.com/automatically-set-the-featured-image-in-wordpress/#comment-13391
    Use it temporary to generate all featured images (in other words, run this line once, then comment it out)
    ---------------------------------------------------------------------------------------------------- */
    // add_action('the_post', 'autoset_featured_image');


/**
 * Remove Yoast SEO Canonical URLs
 * http://wordpress.org/support/topic/plugin-wordpress-seo-by-yoast-disbale-on-specific-pages#post-4008241
 */
function wpseo_canonical_replace($canonical) {
	global $post;
	if ( !is_front_page() && has_post_format('video', $post->ID) ) {
		$section	= get_the_category($post->ID);
		$section_id	= $section[0]->term_id;
		$canonical	= get_category_link($section_id);
	}
	return $canonical;
}
add_filter('wpseo_canonical', 'wpseo_canonical_replace');


/**
 * Remove Yoast SEO Canonical URLs + WP SEO Title
 * http://yoast.com/wordpress/seo/api/#highlighter_245949
 */
function wpseo_disable_rel_next_home( $link ) {
  if ( is_front_page() ) {
    return false;
  }
}
add_filter('wpseo_next_rel_link', 'wpseo_disable_rel_next_home');


/**
 * Load Development Styles/Scripts (for local)
 */
function load_dev_styles_scripts() {
	// Theme styles
	wp_enqueue_style('themename', CHILD_SS_URI . '/assets/dev/style.css', false, null, 'all');

	// Header Scripts
	wp_enqueue_script('header_scripts', CHILD_SS_URI . '/assets/dev/header.js', array(), null, false);

	// Footer Scripts
	wp_enqueue_script('footer_scripts', CHILD_SS_URI . '/assets/dev/footer.js', array('jquery'), null, true);

	// Single Scripts
	if ( is_single() ) {
		wp_enqueue_script('single_scripts', CHILD_SS_URI . '/assets/dev/single.js', array('jquery'), null, true);
	}
}
if (!is_admin() && WP_ENV == 'local') add_action('wp_enqueue_scripts', 'load_dev_styles_scripts');


/**
 * Load Distribution Styles/Scripts (for staging and production)
 */
function load_prod_styles_scripts() {
	// Theme styles
	wp_enqueue_style('themename', CHILD_SS_URI . '/assets/dist/style.min.css', false, null, 'all');

	// Header Scripts
	wp_enqueue_script('header_scripts', CHILD_SS_URI . '/assets/dist/header.min.js', array(), null, false);

	// Footer Scripts
	wp_enqueue_script('footer_scripts', CHILD_SS_URI . '/assets/dist/footer.min.js', array('jquery'), null, true);

	// Single Scripts
	if ( is_single() ) {
		wp_enqueue_script('single_scripts', CHILD_SS_URI . '/assets/dist/single.min.js', array('jquery'), null, true);
	}
}
if (!is_admin() && WP_ENV != 'local') add_action('wp_enqueue_scripts', 'load_prod_styles_scripts');


/**
 * Include external function calls
 * Uncomment and edit these as you need them
 */
//require_once (TEMP_DIR . '/functions/cpt_example.php');
//require_once (TEMP_DIR . '/functions/display-post-thumbnails.php')
//require_once (TEMP_DIR . '/functions/gform_placeholder.php');
//require_once (TEMP_DIR . '/functions/metabox/example-functions.php');
//require_once (TEMP_DIR . '/functions/pagination.php');
//require_once (TEMP_DIR . '/functions/Tax-meta-class/example-tax-meta.php');

?>
