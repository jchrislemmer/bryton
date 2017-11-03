<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="container">
		<?php $walker = new Seller_Menu_With_Description; ?>
		<?php if (has_nav_menu(  'primary' ) && !get_theme_mod('seller_disable_nav_desc',true) ) :
					wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); 
				else : 
					wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => new Seller_Menu_With_Icon ) );
			  endif; ?>
	</div>
</nav><!-- #site-navigation -->