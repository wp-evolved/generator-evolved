<?php

/**
 * Retrieve the post thumbnail SRC
 */
function display_post_thumbnail_src( $id = 0, $size = 'thumbnail' ) {
  $post     = get_post( $id );
  $post_id  = isset( $post->ID ) ? $post->ID : 0;

  $attsrc         = '';
  $atturl         = '';
  $featured_src   = '';
  $featured_url   = '';
  $images         = '';

  $images = get_children( array(
    'numberposts'    => 1,
    'post_mime_type' => 'image',
    'post_parent'    => $post_id,
    'post_status'    => null,
    'post_type'      => 'attachment',
  ));

  if ( has_post_thumbnail( $post_id ) ) {  // author set a specific Featured Image
    $featured_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    $featured_url = wp_get_attachment_url( get_post_thumbnail_id( $post_id ), $size );

    if ( isset( $featured_src ) ) {
      return $featured_src[0];
    }
  } elseif ( $images ) { // author has uploaded various image attachments, and may or may not have put them in the content
    foreach( $images as $image ) {
      $attsrc = wp_get_attachment_image_src( $image->ID, $size ); // Get attachment image src
      $atturl = wp_get_attachment_url( $image->ID );

      if ( isset( $attsrc ) ) {
        return $attsrc[0];
      }
    }
  } else { // no images uploaded to this post, so a default image is what we need
    return DEFAULT_PHOTO;
  }
}

/**
 * Display the post thumbnail
*/
function display_post_thumbnail( $id = 0, $size = 'thumbnail' ) {
  $post     = get_post( $id );
  $post_id  = isset( $post->ID ) ? $post->ID : 0;

  if ( display_post_thumbnail_src( $post_id, $size ) ) {

    $link       = get_permalink( $post_id );

    if ( $src == DEFAULT_PHOTO ) {
      $class    = ' default-photo';
      $img_src  = DEFAULT_PHOTO;
    } else {
      $class    = '';
      $img_src  = display_post_thumbnail_src();
    }

    echo '<a href="' . $link . '" title="Permanent Link to ' . esc_attr( get_the_title( $post_id ) ) . '" class="post-thumb' . $class . '" itemprop="image"><img src="' . $img_src . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="attachment-post-thumbnail wp-post-image"></a>';
  }
}
?>
