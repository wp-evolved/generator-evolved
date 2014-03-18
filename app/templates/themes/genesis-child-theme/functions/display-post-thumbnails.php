<?php

/*
 * Display post thumbnails
 */

function display_post_thumbnail_src( $id = 0 ) { //get the src of image
  $post = get_post( $id );
  $post_id = isset( $post->ID ) ? $post->ID : 0;

  $atturl         = '';
  $featured_image = '';
  $images         = '';
  $size           = 'thumbnail';

  $images = get_children( array(
    'numberposts'    => 1,
    'post_mime_type' => 'image',
    'post_parent'    => $post_id,
    'post_status'    => null,
    'post_type'      => 'attachment',
  ));

  if ( has_post_thumbnail( $post_id ) ) {  // author set a specific Featured Image
    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if ( isset( $featured_image ) ) {
      return $featured_image[0];
    }
  } elseif ( $images ) { // author has uploaded various image attachments, and may or may not have put them in the content
    foreach( $images as $image ) {
      $atturl = wp_get_attachment_image_src( $image->ID, $size ); // Get attachment image URL

      if ( isset( $atturl ) ) {
        return $atturl[0];
      }
    }
  } else { // no images uploaded to this post, so a default image is what we need
    return DEFAULT_PHOTO;
  }
}

function display_post_thumbnail( $id = 0 ) { //creates an img tag for use in post lists
  $post = get_post( $id );
  $post_id = isset( $post->ID ) ? $post->ID : 0;

  if ( $src = display_post_thumbnail_src( $post_id ) ) {
    if( $src == DEFAULT_PHOTO ) {
      $class = ' default-photo';
    } else {
      $class = '';
    }
    echo '<a href="' . get_permalink( $post_id ) . '" title="Permanent Link to ' . esc_attr( get_the_title( $post_id ) ) . '" class="post-thumb' . $class . '" itemprop="image"><img src="' . $src . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="attachment-post-thumbnail wp-post-image"></a>';
  }
}
?>
