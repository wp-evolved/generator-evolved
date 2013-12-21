<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if ( is_category() ) : ?>
<h1 class="page-title">Latest Posts in <?php single_cat_title(); ?></h1>
<?php /* If this is a tag archive */ elseif ( is_tag() ) : ?>
<h1 class="page-title">Latest Posts Tagged <span><?php single_tag_title(); ?></span></h1>
<?php /* If this is a daily archive */ elseif ( is_day() ) : ?>
<h1 class="page-title">Latest Posts on <?php the_time('F jS, Y'); ?></h1>
<?php /* If this is a monthly archive */ elseif ( is_month() ) : ?>
<h1 class="page-title">Latest Posts from <?php the_time('F, Y'); ?></h1>
<?php /* If this is a yearly archive */ elseif ( is_year() ) : ?>
<h1 class="page-title">Latest Posts from <?php the_time('Y'); ?></h1>
<?php /* If this is an author archive */ elseif ( is_author() ) :
	$userID = get_query_var( 'author' );
	$userInfo = get_userdata( $userID );
	$userName = $userInfo->display_name;
?>
<h1 class="page-title">Latest Posts by <?php echo $userName; ?></h1>
<?php /* If this is a paged archive */ elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) : ?>
<h1 class="page-title">Latest Posts</h1>
<?php endif; ?>

<ul class="preview-list preview-list--archive">
<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php include_once(PARENT_TMPL_DIR . '/modules/mod-post-preview.php'); ?>

<?php endwhile; ?>
</ul>

<? if ( function_exists("pagination") ) : pagination(); endif; ?>