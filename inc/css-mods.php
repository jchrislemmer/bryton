<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function seller_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	
	//If Menu Description is Disabled.
	if ( !has_nav_menu('primary') || get_theme_mod('seller_disable_nav_desc', true) ) :
		echo "#site-navigation ul li a { padding: 16px 12px; }";
	endif;
	
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('seller_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;	
	
	if ( get_theme_mod('seller_title_font') ) :
		echo ".title-font, h1, h2, .section-title, .woocommerce ul.products li.product h3 { font-family: ".esc_html( get_theme_mod('seller_title_font','Lato') )."; }";
	endif;
	
	if ( get_theme_mod('seller_body_font') ) :
		echo "body { font-family: ".esc_html( get_theme_mod('seller_body_font','Open Sans') )."; }";
	endif;
	
	if ( get_theme_mod('seller_site_titlecolor') ) :
		echo "#masthead h1.site-title a { color: ".esc_html( get_theme_mod('seller_site_titlecolor', '#FFFFFF') )."; }";
	endif;
	
	if ( get_theme_mod('seller_title_fontsize') != 47 ) :
		echo "#masthead h1.site-title { font-size: ".get_theme_mod('seller_title_fontsize')."px; }";
	endif;
	
	
	if ( get_theme_mod('seller_header_desccolor','#777') ) :
		echo ".site-description { color: ".esc_html( get_theme_mod('seller_header_desccolor','#FFFFFF') )."; }";
	endif;
	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		echo '.pagination { display: none; }';
		
	if ( get_theme_mod('seller_sidebar_loc') == 'left' ) :
		echo "#secondary { float: left; }#primary,#primary-mono { float: right; }";
	endif;	
	
	if ( get_theme_mod('seller_site_layout') == 'boxed' ) :
		echo "#page { max-width: 1170px; margin: 20px auto; } .masthead-container, #top-bar .container { padding: 0 20px; }";
	endif;	
	
	wp_reset_postdata();	
	if ( get_post_meta( get_the_ID(), 'hide-title', true ) ):
		echo "#primary-mono h1.entry-title, .template-entry-title { display: none; }";
	endif;
	wp_reset_postdata();

	if ( get_theme_mod('seller_custom_css') ) :
		echo  esc_html( get_theme_mod('seller_custom_css') );
	endif;
	
	
	if ( get_theme_mod('seller_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( get_theme_mod('seller_woo_layout',3) ) :
		$c = get_theme_mod('seller_woo_layout',3);
		if ($c == 3)
			echo ".woocommerce ul.products li.product { width: 30.75%; }";
			
		if ($c == 4)	
			echo ".woocommerce ul.products li.product { width: 22.05%; }";
		
		if ($c == 2)	
			echo ".woocommerce ul.products li.product { width: 48%; }";
			
			
	endif;
	
	if ( get_theme_mod('seller_logo_resize') ) :
		$val = esc_html( get_theme_mod('seller_logo_resize') )/100;
		echo "#masthead #site-logo img { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;

	echo "</style>";
}

add_action('wp_head', 'seller_custom_css_mods');