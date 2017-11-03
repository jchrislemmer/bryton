<header id="masthead" class="site-header store" role="banner">
		<div class="container masthead-container">
			<div class="site-branding">
				<?php if ( get_theme_mod('seller_logo') != "" ) : ?>
				<div id="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod('seller_logo') ); ?>"></a>
				</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>	
			
			<?php if (class_exists('woocommerce') && get_theme_mod('seller_header_cart',true) ) : ?>
			<div id="top-cart">
				<div class="top-cart-icon">

	 
					<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'seller'); ?>">
						<div class="count"><?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count, 'seller'), WC()->cart->cart_contents_count);?></div>
						<div class="total"> <?php echo WC()->cart->get_cart_total(); ?>
						</div>
					</a>
					
					<i class="fa fa-shopping-cart"></i>
					</div>
			</div>	
			<?php endif; ?>
			
			<?php  if ( get_theme_mod('seller_header_search') != 'disbaled' )  : ?>
				<div id="top-search">				
						<?php get_template_part('searchform', get_theme_mod('seller_header_search','top')); ?>
				</div>
			<?php endif; ?>
			
		</div>	
		
		<?php get_template_part('header/primary', 'menu'); ?>
		
	</header><!-- #masthead -->