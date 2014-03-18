<h2>Latest posts</h2>
<ul class="preview-list preview-list--home">
<?php
	query_posts( 'posts_per_page=10' );
	if( have_posts() ) while ( have_posts() ) : the_post();
    include_once( PARENT_TMPL_DIR . '/modules/mod-post-preview.php' );
    endwhile;
    wp_reset_query();
?>
</ul>
