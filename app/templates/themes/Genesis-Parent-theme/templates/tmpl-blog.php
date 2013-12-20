<h1 class="page-title"><?php the_title(); ?></h1>

<ul class="preview-list preview-list--blog">
<?php

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$blog = array(
		'paged' => $paged
	);
	query_posts( $blog );

	if( have_posts() ) while ( have_posts() ) : the_post();
?>

	<?php include_once('../modules/mod-post-preview.php'); ?>

<?php endwhile; ?>
</ul>

<? if ( function_exists("pagination") ) : pagination(); endif; ?>

<?php wp_reset_query(); ?>