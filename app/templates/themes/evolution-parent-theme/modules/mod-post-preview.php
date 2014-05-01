<li class="post-preview">

  <?php display_post_thumbnail( get_the_ID(), 'post-thumb' ); // name of the thumbnail; default is 'thumbnail' ?>

  <article>
    <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
      <h3><?php the_title(); ?></h3>
    </a>
    <div class="post-meta">
      <span class="post-date"><?php the_time( 'F j, Y' ); ?></span>
      <span class="post-author"><?php the_author(); ?></span>
    </div>
    <?php the_excerpt(); ?>
  </article>

</li>
