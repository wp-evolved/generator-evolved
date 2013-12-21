<?php get_header(); ?>

<div role="main" class="main-container">

	<section class="content">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article class="post-article">
			<h1 class="post-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>

		<?php include_once(PARENT_TMPL_DIR . '/modules/mod-comments.php'); ?>

	<?php endwhile; endif; ?>

	</section>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>