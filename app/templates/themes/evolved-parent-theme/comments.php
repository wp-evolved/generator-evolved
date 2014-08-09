<?php
  /**
   * If the current post is protected by a password and
   * the visitor has not yet entered the password we will
   * return early without loading the comments.
   */

  if ( post_password_required() ) { return; }
?>

<section class="comments">

  <?php
   /**
    * If we have comments display them
    */
    if ( have_comments() ) :
  ?>

    <h2 class="comments__title">Comments</h2>

    <?php
      /**
       * If we have comments and they are set to page
       */
      if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>

    <nav class="comment-nav comment-nav--above" role="navigation">
      <div class="comment-nav__prev"><?php previous_comments_link( '&larr; Older Comments' ); ?></div>
      <div class="comment-nav__next"><?php next_comments_link( 'Newer Comments &rarr;' ); ?></div>
    </nav>

    <?php endif; ?>

    <ol class="comments__list">
      <?php
        $comment_args = array(
          'style'      => 'ol',
          'short_ping' => true,
        );
        wp_list_comments( $comment_args );
      ?>
    </ol>

    <?php
      /**
       * If we have comments and they are set to page
       */
      if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>

    <nav class="comment-nav comment-nav--below" role="navigation">
      <div class="comment-nav__prev"><?php previous_comments_link( '&larr; Older Comments' ); ?></div>
      <div class="comment-nav__next"><?php next_comments_link( 'Newer Comments &rarr;' ); ?></div>
    </nav>

    <?php endif; ?>

  <?php endif; ?>

  <?php
    /**
     * If comments are closed but there are existing comments, leave visitors a message
     */
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>

    <p class="no-comments">Comments are closed.</p>

  <?php endif; ?>

  <?php comment_form(); ?>

</section>