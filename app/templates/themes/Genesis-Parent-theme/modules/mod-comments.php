<?php
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>

<?php if ( comments_open() ) : ?>
    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<section class="comments">
		<h3>Leave a comment</h3>
		<div class="fb-comments" data-href="<?php echo get_permalink(); ?>" data-num-posts="4" data-width="570px"></div>
	</section>
<?php endif; ?>