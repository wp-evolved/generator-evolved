<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php edit_post_link('Edit', '', '' ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="post-meta">
        <time class="updated published" datetime="<?php the_date( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
        <span class="author vcard"><span class="fn"><?php the_author(); ?></span></span>
      </div>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </article>

    <?php endwhile; ?>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
