<h1 class="page-title">Page Not Found</h1>
<p>The Page you are looking for does not exist.</p>

<h2>Search the Site</h2>
<?php include_once(PARENT_TMPL_DIR . '/modules/mod-search-form.php'); ?>

<h2>Latest posts</h2>
<ul class="preview-list preview-list--error">
<?php
	query_posts('posts_per_page=5');
	if( have_posts() ) while ( have_posts() ) : the_post();
?>

	<?php include_once(PARENT_TMPL_DIR . '/modules/mod-post-preview.php'); ?>

<?php endwhile; wp_reset_query(); ?>
</ul>