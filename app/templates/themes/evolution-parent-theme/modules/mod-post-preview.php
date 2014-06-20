<li class="post-preview">

  <?php display_post_thumbnail( get_the_ID(), 'post-thumb' ); // name of the thumbnail; default is 'thumbnail' ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
    <div class="post-meta">
      <time class="updated published" datetime="<?php the_date( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
      <span class="author vcard"><span class="fn"><?php the_author(); ?></span></span>
    </div>
    <div class="entry-content">
      <?php the_excerpt(); ?>
    </div>
  </article>

</li>
