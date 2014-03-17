<?php

/**
 * Define Global Site Variables
 */
define( 'WWW_URL', site_url() );
define( 'PARENT_TMPL_URI', get_template_directory_uri() );
define( 'PARENT_TMPL_DIR', get_template_directory() );
define( 'SITE_NAME', get_option('blogname') );
define( 'SITE_TAGLINE', get_option('blogdescription') );
define( 'AUTHOR', SITE_NAME . ' - '. WWW_URL );


/**
 * Add category nicenames in body and post class
 */
function category_id_class($classes) {
	global $post;
	foreach (get_the_category($post->ID) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');


/**
 * Sidbars
 */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Pages',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}


/**
 * Custom Menus
 */
add_theme_support('menus');


/** IMAGES
 *
 * Add Parent Class to menu items
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu#How_to_add_a_parent_class_for_menu_item
 */
add_filter('wp_nav_menu_objects', function($items) {
    $hasSub = function($menu_item_id, $items) {
        foreach ($items as $item) {
            if ($item->menu_item_parent && $item->menu_item_parent==$menu_item_id) {
                return true;
            }
        }
        return false;
    };

    foreach ($items as &$item) {
        if ($hasSub($item->ID, $items)) {
            $item->classes[] = 'parent-item'; // all elements of field "classes" of a menu item get join together and render to class attribute of <li> element in HTML
        }
    }

    return $items;
});

/*
 *  Automatically Set the Featured Image in WordPress
    Source: http://wpforce.com/automatically-set-the-featured-image-in-wordpress/#comment-13391
    ---------------------------------------------------------------------------------------------------- */
    function autoset_featured_image() {
      global $post;
      $already_has_thumb = has_post_thumbnail($post->ID);
      if (!$already_has_thumb)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        if ($attached_image) {
          foreach ($attached_image as $attachment_id => $attachment) {
            set_post_thumbnail($post->ID, $attachment_id);
          }
        } else {
            if ( defined('DEFAULT_IMG_ID') ) {
                set_post_thumbnail($post->ID, DEFAULT_IMG_ID); // post id of default photo
            } else {}
        }
      }
    }
    // Used for new posts
    add_action('save_post', 'autoset_featured_image');
    add_action('draft_to_publish', 'autoset_featured_image');
    add_action('new_to_publish', 'autoset_featured_image');
    add_action('pending_to_publish', 'autoset_featured_image');
    add_action('future_to_publish', 'autoset_featured_image');

/*
 *  Post Thumbnail Linking to the Post Permalink
    Source: http://codex.wordpress.org/Function_Reference/the_post_thumbnail#Post_Thumbnail_Linking_to_the_Post_Permalink
    ---------------------------------------------------------------------------------------------------- */
    add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
    function my_post_image_html( $html, $post_id, $post_image_id ) {
      $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '" class="post-thumb">' . $html . '</a>';
      return $html;
    }

/*
 *  Remove Default Image Links
    Source: http://www.wpbeginner.com/wp-tutorials/automatically-remove-default-image-links-wordpress/
    ---------------------------------------------------------------------------------------------------- */
    function wpb_imagelink_setup() {
      $image_set = get_option( 'image_default_link_type' );

      if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
      }
    }
    add_action('admin_init', 'wpb_imagelink_setup', 10);


/**
 * Add excerpt to pages
 */
function add_excerpts_to_pages() {
     add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpts_to_pages');


/**
 * Add class to excerpt
 */
function add_class_to_excerpt($excerpt) {
   return str_replace('<p', '<p class="post-excerpt"', $excerpt);
}
add_filter('the_excerpt', 'add_class_to_excerpt');


/**
 * Add next and prev classes to previous/next post links
 */
function add_class_prev_link($class) {
	return str_replace('<a', '<a class="prev-post"', $class);
}
add_filter('previous_post_link', 'add_class_prev_link');

function add_class_next_link($class) {
	return str_replace('<a', '<a class="next-post"', $class);
}
add_filter('next_post_link', 'add_class_next_link');


/** Getting Pages by Slugs
 *  SOURCE: https://gist.github.com/germanny/9399616
 *          https://gist.github.com/ericrasch/4723316
 *
 *
 * Get a Page's ID by slug
 * http://erikt.tumblr.com/post/278953342/get-a-wordpress-page-id-with-the-slug
 */
function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
      return $page->ID;
  } else {
      return null;
  }
}

/**
 * Check If Page Is Child
 * Source: http://bavotasan.com/2011/is_child-conditional-function-for-wordpress/
 */
function is_child( $page_id_or_slug ) { // $page_id_or_slug = The ID of the page we're looking for pages underneath
  global $post; // load details about this page

  if ( !is_numeric( $page_id_or_slug ) ) { // Used this code to change a slug to an ID, but had to change is_int to is_numeric for it to work.
    $page = get_page_by_path( $page_id_or_slug );

    if (isset($page)) {
      $page_id_or_slug = $page->ID;
      if ( is_page() && ( $post->post_parent == $page_id_or_slug ) )
        return true; // we're at the page or at a sub page
      else
        return false; // we're elsewhere
    } else {
      return false;
    }
  }
}

/**
 * Check If Page Is Parent/Child/Ancestor
 * Source: http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/#comment-172337
 */
function is_tree( $page_id_or_slug ) { // $page_id_or_slug = The ID of the page we're looking for pages underneath
  global $post; // load details about this page

  if ( !is_numeric( $page_id_or_slug ) ) { // Used this code to change a slug to an ID, but had to change is_int to is_numeric for it to work: http://bavotasan.com/2011/is_child-conditional-function-for-wordpress/
    $page = get_page_by_path( $page_id_or_slug );
    $page_id_or_slug = $page->ID;
  }

  if ( is_page() && ( $post->post_parent == $page_id_or_slug || (is_page( $page_id_or_slug ) || in_array($page_id_or_slug, $post->ancestors) ) ) )
    return true; // we're at the page or at a sub page
  else
    return false; // we're elsewhere
}

?>
