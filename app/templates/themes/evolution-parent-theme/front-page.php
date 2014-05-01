<?php get_header(); ?>

<div role="main" class="main-container">

  <section class="content">

    <h2>Latest posts</h2>
    <ul class="preview-list preview-list--home">
    <?php
      query_posts( 'posts_per_page=10' );
      if( have_posts() ) while ( have_posts() ) : the_post();
    ?>

      <?php include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' ); ?>

    <?php
      endwhile;
      wp_reset_query();
    ?>
    </ul>

  </section>

  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
