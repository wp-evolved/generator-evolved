<?php get_header(); ?>

<div role="main" class="main-container">

	<section class="content">

		<h1 class="page-title"><?php the_title(); ?></h1>

		<ul class="preview-list preview-list--blog">
		<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$blog_args = array(
				'paged' => $paged
			);

			query_posts( $blog_args );
			if( have_posts() ) while ( have_posts() ) : the_post();
		?>

			<?php include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' ); ?>

		<?php endwhile; ?>
		</ul>

		<?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

		<?php wp_reset_query(); ?>

		</section>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
