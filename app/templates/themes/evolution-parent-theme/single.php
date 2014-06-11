<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php edit_post_link('Edit', '', '' ); ?>

    <article class="post-article">
      <h1 class="post-title"><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </article>

    <?php if ( comments_open() || '0' != get_comments_number() ) : ?>

      <?php comments_template(); ?>

    <?php endif; ?>

  <?php endwhile; ?>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
