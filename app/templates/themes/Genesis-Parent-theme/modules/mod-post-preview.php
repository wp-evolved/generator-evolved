<li class="post-preview<?php if ( !has_post_thumbnail() ) { echo ' no-image'; } ?>">

	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="preview-img">
		<?php the_post_thumbnail('preview-img'); ?>
	</a>
	<?php endif; ?>

	<article>
		<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>
		<div class="post-meta">
			<span class="post-date"><?php the_time('F j, Y'); ?></span>
			<span class="post-author"><?php the_author(); ?></span>
		</div>
		<?php the_excerpt(); ?>
	</article>
</li>