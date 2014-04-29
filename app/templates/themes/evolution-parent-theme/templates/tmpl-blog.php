<h1 class="page-title"><?php the_title(); ?></h1>

<ul class="preview-list preview-list--blog">
<?php
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$blog = array(
		'paged' => $paged
	);
	query_posts( $blog );
	if( have_posts() ) while ( have_posts() ) : the_post();
    include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' );
    endwhile;
?>
</ul>

<?php
if ( function_exists( 'pagination' ) ) {
    pagination();
}
?>

<?php wp_reset_query(); ?>
