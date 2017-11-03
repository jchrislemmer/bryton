<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'seller' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo get_theme_mod('seller_header_search_placeholder','Search...'); ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'seller' ) ?>" />
	</label>
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>