<?php get_header(); ?>

<div role="main" class="main-container">

	<section class="content">

	<?php if ( is_page('blog') ) :
		include_once('includes/tmpl-blog.php');
	else : ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="page-article">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
		<?php endwhile; endif; ?>

	<?php endif; ?>

	</section>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>