<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package seller
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'seller' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<div id="top-bar">
		<div class="container">
			<div id="email_phone">
				<?php if (get_theme_mod('seller_header_email')) : ?>
				<span class="email"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo get_theme_mod('seller_header_email'); ?>"><?php echo get_theme_mod('seller_header_email'); ?></a></span>
				<?php endif; ?>
				<?php if (get_theme_mod('seller_header_phone')) : ?>
				<span class="phone"><i class="fa fa-phone"></i> <?php echo get_theme_mod('seller_header_phone'); ?></span>
				<?php endif; ?>
			</div>	
			
			<div class="social-icons">
				<?php get_template_part('social', 'fa'); ?>	 
			</div>
			
			<?php if (get_theme_mod('seller_header_search_enable') ) : 
						if ( get_theme_mod('seller_header_search', 'top') != 'disabled' ) : ?>
							<div id="top-bar-search">
								<?php get_template_part('searchform', get_theme_mod('seller_header_search','top') ); ?>
							</div>
						<?php endif;
				  else : ?>
					<div id="top-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
					</div>
			<?php endif; ?>
		</div>
	</div>
	
	<?php get_template_part('header/masthead',get_theme_mod("seller_header_layout","seller")); ?>	
	<nav id="mobile-navigation" class="mobile-navigation" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->
	
	
	<div class="mega-container">
		<?php do_action('seller-before_content'); ?>
	
		<div id="content" class="site-content container">