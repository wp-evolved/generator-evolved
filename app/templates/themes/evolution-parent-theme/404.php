<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <h1 class="page-title">Page Not Found</h1>
    <p>The Page you are looking for does not exist.</p>

    <h2>Search the Site</h2>
    <?php include_once( PARENT_TMPL_DIR . '/modules/mod-search-form.php' ); ?>

    <h2>Latest posts</h2>
    <ul class="hfeed preview-list preview-list--error">
    <?php
      $query = new WP_Query( 'posts_per_page=5' );

      if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post();
    ?>

      <?php include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' ); ?>

    <?php
      endwhile;
      wp_reset_postdata();
    ?>
    </ul>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
