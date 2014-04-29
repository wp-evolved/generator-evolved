<form method="get" id="searchform" class="site-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" onsubmit="validateSearch()">
	<div class="search-field">
		<label for="s" class="assistive-text <?php if( is_search() ) { echo 'focused'; } ?>"><?php _e( 'Search Site' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" />
	</div>
	<input type="submit" class="submit-button btn" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search' ); ?>" />
</form>