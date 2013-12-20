<?php

/**
 * Define Global Exterior Account Variables
 * Uncomment and edit these as you need them
 */
define( 'CHILD_THEME_DIR', get_stylesheet_directory_uri() );
define( 'CHILD_TEMP_DIR', get_stylesheet_directory() );

//define('TYPEKIT', '123456');
//define('HFJ_ACCOUNT', '123456');
//define('HFJ_PROJECT', 123456);
//define('TWITTER_USERNAME', 'username');
//define('FB_APP_ID', '12345678910');
//define('FB_PAGE', 'https://www.facebook.com/fb-page');
//define('PINTEREST_USERNAME', 'username' );


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


/**
 * Add Post Thumbnails
 */
add_theme_support('post-thumbnails');
set_post_thumbnail_size(50, 50, true);
add_image_size('preview-img', 250, 140, true);


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
	wp_enqueue_style('themename', CHILD_THEME_DIR . '/assets/dev/style.css', false, null, 'all');

	// Header Scripts
	wp_enqueue_script('header_scripts', CHILD_THEME_DIR . '/assets/dev/header.js', array(), null, false);

	// Footer Scripts
	wp_enqueue_script('footer_scripts', CHILD_THEME_DIR . '/assets/dev/footer.js', array('jquery'), null, true);

	// Single Scripts
	if ( is_single() ) {
		wp_enqueue_script('single_scripts', CHILD_THEME_DIR . '/assets/dev/single.js', array('jquery'), null, true);
	}
}
if (!is_admin() && WP_ENV == 'local') add_action('wp_enqueue_scripts', 'load_dev_styles_scripts');


/**
 * Load Distribution Styles/Scripts (for staging and production)
 */
function load_prod_styles_scripts() {
	// Theme styles
	wp_enqueue_style('themename', CHILD_THEME_DIR . '/assets/dist/style.min.css', false, null, 'all');

	// Header Scripts
	wp_enqueue_script('header_scripts', CHILD_THEME_DIR . '/assets/dist/header.min.js', array(), null, false);

	// Footer Scripts
	wp_enqueue_script('footer_scripts', CHILD_THEME_DIR . '/assets/dist/footer.min.js', array('jquery'), null, true);

	// Single Scripts
	if ( is_single() ) {
		wp_enqueue_script('single_scripts', CHILD_THEME_DIR . '/assets/dist/single.min.js', array('jquery'), null, true);
	}
}
if (!is_admin() && WP_ENV != 'local') add_action('wp_enqueue_scripts', 'load_prod_styles_scripts');


/**
 * Include external function calls
 * Uncomment and edit these as you need them
 */
//require_once (TEMP_DIR . '/functions/cpt_example.php');
//require_once (TEMP_DIR . '/functions/gform_placeholder.php');
//require_once (TEMP_DIR . '/functions/pagination.php');
//require_once (TEMP_DIR . '/functions/Tax-meta-class/example-tax-meta.php');
//require_once (TEMP_DIR . '/functions/metabox/example-functions.php');

?>
