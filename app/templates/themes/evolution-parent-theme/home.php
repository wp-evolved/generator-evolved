<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <h1 class="page-title"><?php the_title(); ?></h1>

    <ul class="hfeed preview-list preview-list--blog">
    <?php
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $blog_args = array(
        'paged' => $paged
      );
      $query = new WP_Query( $blog_args );

      if( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post();
    ?>

      <?php include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' ); ?>

    <?php endwhile; ?>
    </ul>

    <?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

    <?php wp_reset_postdata(); ?>

    </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
