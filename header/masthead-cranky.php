<header id="masthead" class="site-header cranky" role="banner">
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
			
			<?php get_template_part('header/primary', 'menu'); ?>
			
			
		</div>	
		
		
		
	</header><!-- #masthead -->