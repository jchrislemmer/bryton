<form role="search" method="get" class="woocommerce-product-search search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<label>
	<span class="screen-reader-text" for="s"><?php _e( 'Search for Products:', 'woocommerce' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo get_theme_mod('seller_header_search_placeholder','Search Products...'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
	</label>
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>
