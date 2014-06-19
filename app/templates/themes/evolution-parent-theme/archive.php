<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <?php
      $post = $posts[0]; // Hack. Set $post so that the_date() works.

      if ( is_category() ) { /* If this is a category archive */ ?>
        <h1 class="page-title">Latest Posts in <?php single_cat_title(); ?></h1>
      <?php } elseif ( is_tag() ) { /* If this is a tag archive */ ?>
        <h1 class="page-title">Latest Posts Tagged <span><?php single_tag_title(); ?></span></h1>
      <?php } elseif ( is_day() ) { /* If this is a daily archive */
        echo '<h1 class="page-title">Latest Posts on ' . get_the_time( 'F jS, Y' ) . '</h1>';
      } elseif ( is_month() ) { /* If this is a monthly archive */
        echo '<h1 class="page-title">Latest Posts from ' . get_the_time( 'F, Y' ) . '</h1>';
      } elseif ( is_year() ) { /* If this is a yearly archive */
        echo '<h1 class="page-title">Latest Posts from ' . get_the_time( 'Y' ) . '</h1>';
      } elseif ( is_author() ) { /* If this is an author archive */
        $userID = get_query_var( 'author' );
        $userInfo = get_userdata( $userID );
        $userName = $userInfo->display_name;

        echo '<h1 class="page-title">Latest Posts by ' . $userName . '</h1>';
      } elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { /* If this is a paged archive */
        echo '<h1 class="page-title">Latest Posts</h1>';
      }
    ?>

    <ul class="hfeed preview-list preview-list--archive">
    <?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' ); ?>

    <?php endwhile; ?>
    </ul>

    <?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
