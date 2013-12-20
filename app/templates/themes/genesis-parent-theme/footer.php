	<footer class="site-footer">
		<nav class="nav footer-nav">
			<?php wp_nav_menu( array( 'menu' => 'Main-Nav','container' => false) ); ?>
		</nav>
		<p class="legal"><?php echo SITE_NAME; ?> &copy; <?php echo date('Y'); ?> All Rights Reserved</p>
	</footer>

	<?php wp_footer(); ?>

	<?php if (WP_ENV == 'local') : ?>
	<!-- Live Reload -->
	<script src="//localhost:35729/livereload.js"></script>
	<?php endif; ?>

</body>

</html>
