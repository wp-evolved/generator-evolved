<?php

/**
 * Define Global Site Variables
 */
define( 'WWW_URL', site_url() );
define( 'PARENT_TMPL_URI', get_template_directory_uri() );
define( 'PARENT_TMPL_DIR', get_template_directory() );
define( 'SITE_NAME', get_option( 'blogname' ) );
define( 'SITE_TAGLINE', get_option( 'blogdescription' ) );
define( 'AUTHOR', SITE_NAME . ' - '. WWW_URL );


/**
 * Add category nicenames in body and post class
 */
function category_id_class( $classes ) {
	global $post;
	foreach ( get_the_category( $post->ID) as $category ) {
		$classes[] = $category->category_nicename;
    }
	return $classes;
}
add_filter( 'post_class', 'category_id_class' );
add_filter( 'body_class', 'category_id_class' );


/**
 * Sidbars
 */
if ( function_exists( 'register_sidebar' )  ) {
	register_sidebar( array(
		'name'            => 'Pages',
		'before_widget'   => '<li id="%1$s" class="widget %2$s">',
		'after_widget'    => '</li>',
		'before_title'    => '<h2>',
		'after_title'     => '</h2>',
	) );
}


/**
 * Custom Menus
 */
add_theme_support( 'menus' );


/**
 * Add Parent Class to menu items
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu#How_to_add_a_parent_class_for_menu_item
 */
add_filter( 'wp_nav_menu_objects', function( $items ) {
    $hasSub = function( $menu_item_id, $items ) {
        foreach ( $items as $item ) {
            if ( $item->menu_item_parent && $item->menu_item_parent==$menu_item_id ) {
                return true;
            }
        }
        return false;
    };
    foreach ( $items as &$item ) {
        if ( $hasSub( $item->ID, $items ) ) {
            $item->classes[] = 'parent-item'; // all elements of field "classes" of a menu item get join together and render to class attribute of <li> element in HTML
        }
    }
    return $items;
});


/**
 * Add excerpt to pages
 */
function add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_excerpts_to_pages' );


/**
 * Add class to excerpt
 */
function add_class_to_excerpt( $excerpt ) {
   return str_replace( '<p', '<p class="post-excerpt"', $excerpt );
}
add_filter( 'the_excerpt', 'add_class_to_excerpt' );


/**
 * Add next and prev classes to previous/next post links
 */
function add_class_prev_link( $class ) {
	return str_replace( '<a', '<a class="prev-post"', $class );
}
add_filter( 'previous_post_link', 'add_class_prev_link' );

function add_class_next_link( $class ) {
	return str_replace( '<a', '<a class="next-post"', $class );
}
add_filter( 'next_post_link', 'add_class_next_link' );

?>
