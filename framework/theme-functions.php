<?php
/*
 * @package seller, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */
 
 
class Seller_Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="menu-desc">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

class Seller_Menu_With_Icon extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

/*
 * Pagination Function. Implements core paginate_links function.
 */
function seller_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

//Quick Fixes for Custom Post Types.
function seller_pagination_queried( $query ) {
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . __(' of ', 'seller') . $query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/*
** Favicon and Apple Touch Icon
*/
function seller_header_icons() {
	if ( get_theme_mod('seller_favicon') ) 
		echo "<link rel='shortcut icon' href='".get_theme_mod('seller_favicon')."' />";
	
	if ( get_theme_mod('seller_apple_icon') ) 	
		echo "<link rel='apple-touch-icon' href='".get_theme_mod('seller_apple_icon')."'>";
}
add_action('wp_head', 'seller_header_icons');

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'seller' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
} 

if ( class_exists('WP_Customize_Control') && class_exists('woocommerce') ) {
	class WP_Customize_Product_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'seller' ),
                    'option_none_value' => '0',
                    'taxonomy'          => 'product_cat',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}    
if (class_exists('WP_Customize_Control')) {
	class WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
             printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $this->description
            );
        }
    }
}

/*
** Function to check if Sidebar is enabled on Current Page 
*/

function seller_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('seller_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('seller_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('seller_disable_sidebar_front') && is_front_page() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('seller_disable_sidebar_archive') && is_archive() && !is_shop() && !is_product_category() && !is_product_tag() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('seller_disable_sidebar_shop') && (is_shop() || is_product_category() || is_product_tag() ) ) :
		$load_sidebar = false;
	elseif( get_theme_mod('seller_disable_sidebar_product') && is_product() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('seller_disable_sidebar_portfolio') && (get_post_type() == 'portfolio') ) :
		$load_sidebar = false;			
	elseif ( get_post_meta( get_the_ID(), 'enable-full-width', true ) )	:
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/*
**	Determining Sidebar and Primary Width
*/
function seller_primary_class() {
	$sw = get_theme_mod('seller_sidebar_width',4);
	$class = "col-md-".(12-$sw);
	
	if ( !seller_load_sidebar() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_action('seller_primary-width', 'seller_primary_class');

function seller_secondary_class() {
	$sw = get_theme_mod('seller_sidebar_width',4);
	$class = "col-md-".$sw;
	
	echo $class;
}
add_action('seller_secondary-width', 'seller_secondary_class');


/*
**	Load Footer Sidebar
*/
function seller_load_footer_sidebar() {
	$cols = get_theme_mod('seller_footer_sidebar_columns','4');
	get_template_part('footer/footer', $cols );
}





/*
**	Helper Function to Convert Colors
*/
function seller_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function seller_fade($color, $val) {
	return "rgba(".seller_hex2rgb($color).",". $val.")";
}


/*
** Function to Get Theme Layout 
*/
function seller_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('seller_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('seller_blog_layout') );
	else :
		get_template_part( $ldir ,'grid');	
	endif;	
}
add_action('seller_blog_layout', 'seller_get_blog_layout');

/*
** Function to Get Portfolio Archive Layout 
*/
function seller_get_portfolio_layout(){
	static $seller_post_count = 0;
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('seller_portfolio_layout') ) :
		get_template_part( $ldir , get_theme_mod('seller_portfolio_layout') );
	else :
		get_template_part( $ldir ,'seller');	
	endif;	
}
add_action('seller_portfolio_layout', 'seller_get_portfolio_layout');



/*
** Function to Set Main Class 
*/
function seller_get_main_class(){
	
	$layout = get_theme_mod('seller_blog_layout');
	if (strpos($layout,'seller') !== false) {
	    	echo 'seller-main';
	}		
}
add_action('seller_main-class', 'seller_get_main_class');


/*
** Function to Deal with Elements of Inequal Heights, Enclose them in a bootstrap row.
*/
function seller_open_div_row() {
	echo "<div class='row grid-row col-md-12'>";
}
function seller_close_div_row() {
	echo "</div><!--.grid-row-->";
}


function seller_before_article() {

	global $seller_post_count;
	$array_2_3_4 = array('grid_2_column',
							'grid_3_column',
							'grid_4_column',
							'photos_3_column',
							'photos_2_column',
							'seller',	//2 col		
							'seller_3_column',	
							'templates/template-blog-seller.php',	
							'templates/template-blog-seller3c.php',			
							'templates/template-blog-grid3c.php',
							'templates/template-blog-grid2c.php', 
							'templates/template-blog-grid4c.php',
							'templates/template-blog-photos3c.php',
							'templates/template-blog-photos2c.php'
						);
	//wp_reset_postdata();	- Don't Reset any Data, because we are not using get_post_meta	
	//See what the get_queried_object_id() function does. Though, the Query is reset in template files.			
	//For 2,3,4 Column Posts
	$page_template = get_post_meta( get_queried_object_id(), '_wp_page_template', true );
	$seller_layout = get_theme_mod('seller_blog_layout'); //BUG FIXER
	if (is_page_template() ) : //Disable input from seller Layout if we are in a page template.
		$seller_layout = 'none';
	endif;
	
	if ( in_array( $seller_layout, $array_2_3_4 ) || in_array( $page_template, $array_2_3_4 ) ) : 
			 if ( $seller_post_count  == 0 ) {
			  	seller_open_div_row();
			  }
	endif;	  	
}
add_action('seller_before-article', 'seller_before_article');

/* Pre and Post Article Hooking */
function seller_after_article() {
	global $seller_post_count;
	//echo $seller_post_count;
	wp_reset_postdata();
	$template = get_post_meta( get_the_id(), '_wp_page_template', true );
	$seller_layout = get_theme_mod('seller_blog_layout'); //BUG FIXER
	
	if (is_page_template() ) : //Disable input from seller Layout if we are in a page template.
		$seller_layout = 'none';
	endif;
	
		
	//For 3 Column Posts
	if (   ( $seller_layout == 'grid_3_column' ) 
		|| ( $seller_layout == 'photos_3_column' )
		|| ( $seller_layout == 'seller_3_column' )
 		|| ( $template == 'templates/template-blog-grid3c.php' )
 		|| ( $template == 'templates/template-blog-seller3c.php' )
 		|| ( $template == 'templates/template-blog-photos3c.php' ) ):
		
		

		global $wp_query;
		if (($wp_query->current_post +1) == ($wp_query->post_count)) :
			 	seller_close_div_row();
		else :
			if ( ( $seller_post_count ) == 2 ) {
			 	seller_close_div_row();
				$seller_post_count = 0;
				}
			else {
				$seller_post_count++;
			}
		endif;		
		
	//For 2 Column Posts
	elseif ( ( $seller_layout == 'grid_2_column' )
		|| ( $seller_layout == 'photos_2_column' )
		|| ( $seller_layout == 'seller' )
		|| ( $template == 'templates/template-blog-grid2c.php' )
		|| ( $template == 'templates/template-blog-seller.php' )
		|| ( $template == 'templates/template-blog-photos2c.php' ) ):
		
		
		
		global $wp_query;
		if (($wp_query->current_post +1) == ($wp_query->post_count)) :
			 	seller_close_div_row();
			 	$seller_post_count = 0;
		else :
			if ( ( $seller_post_count ) == 1 ) {
			 	seller_close_div_row();
				$seller_post_count = 0;
				}
			else {
				$seller_post_count++;
			}
		endif;		
	
	elseif ( ( $seller_layout == 'grid_4_column' )
		|| ( $template == 'templates/template-blog-grid4c.php' ) ):
		
		
		
		global $wp_query;
		if (($wp_query->current_post +1) == ($wp_query->post_count)) :
			 	seller_close_div_row();
		else :
			if ( ( $seller_post_count ) == 3 ) {
			 	seller_close_div_row();
				$seller_post_count = 0;
				}
			else {
				$seller_post_count++;
			}
		endif;		
	endif;
	
}
add_action('seller_after-article', 'seller_after_article');



/*
** Function to check if Component is Enabled.
*/
function seller_is_enabled( $component ) {
	
	wp_reset_postdata();
	$return_val = false;
	
	switch ($component) {
		
		case 'slider' :
		
			if ( ( get_theme_mod('seller_main_slider_enable' ) && is_home() )
				|| ( get_theme_mod('seller_main_slider_enable_front' ) && is_front_page() )
				|| ( get_theme_mod('seller_main_slider_enable_posts' ) && is_single() )
				|| ( get_theme_mod('seller_main_slider_enable_pages' ) && is_page() )
				||( get_post_meta( get_the_ID(), 'enable-slider', true ) ) ) :
					$return_val = true;
			endif;
			break;
			
		case 'showcase' :
		
			if ( ( get_theme_mod('seller_main_showcase_enable' ) && is_front_page() )
				|| ( get_theme_mod('seller_main_showcase_enable_home' ) && is_home() )
				||( get_post_meta( get_the_ID(), 'enable-showcase', true ) ) ) :
					$return_val = true;
			endif;
			break;	
		
		case 'featured-products' :
		
			if ( ( get_theme_mod('seller_box_enable') && ( is_home() ) )
				|| ( get_theme_mod('seller_box_enable_front') && ( is_front_page() ) )
				|| ( get_post_meta( get_the_ID(), 'enable-sqbx', true ) ) ) :
					$return_val = true;
				endif;
				break;
		
		case 'coverflow-products' :
		
			 if ( ( get_theme_mod('seller_coverflow_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('seller_coverflow_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-coverflow', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
		case 'featured-posts' :
		
			 if ( ( get_theme_mod('seller_a_box_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('seller_a_box_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-sqbx-posts', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
		case 'coverflow-posts' :
		
			 if ( ( get_theme_mod('seller_a_coverflow_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('seller_a_coverflow_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-coverflow-posts', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;
			 	
		case 'carousel' :
		
			 if ( ( get_theme_mod('seller_carousel_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('seller_carousel_enable_posts') && ( is_single() ) )
			 	|| ( get_theme_mod('seller_carousel_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-carousel', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;
			 	
		case 'grid' :
		
			 if ( ( get_theme_mod('seller_grid_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('seller_grid_enable_posts') && ( is_single() ) )
			 	|| ( get_theme_mod('seller_grid_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-grid', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	 			 		 	 		 		
									
	}//endswitch
	
	return $return_val;
	
}

/*
**	Hook Just before content. To Display Featured Content and Slider.
*/
function seller_display_fc() {
	
		//Nested Function
		function show($s) {
			switch ($s) {
				case 'main_slider' :
					if  ( seller_is_enabled( 'slider' ) )
						get_template_part('slider', 'swiper' );
					break;
				case 'showcase' :
					if  ( seller_is_enabled( 'showcase' ) )
						get_template_part('showcase' );
					break;	
				case 'carousel':
					if  ( seller_is_enabled( 'carousel' ) )
						get_template_part('carousel' );
					break;
				case 'a_coverflow':
					if  ( seller_is_enabled( 'coverflow-posts' ) )
						get_template_part('coverflow', 'posts');
					break;
				case 'grid':
					if  ( seller_is_enabled( 'grid' ) )
						get_template_part('featured', 'grid');
					break;
				case 'a_box':
					if  ( seller_is_enabled( 'featured-posts' ) )
						get_template_part('featured','posts');	
					break;
				case 'box' :
					if  ( seller_is_enabled( 'featured-products' ) )
						get_template_part('featured', 'products');
					break;
				case 'coverflow';
					if  ( seller_is_enabled( 'coverflow-products' ) )
						get_template_part('coverflow', 'product'); 
					break;
				case 'topad':
					if ( get_theme_mod('seller_topad') )
						get_template_part('topad');
					break;	
			}	
					
		}	
		
		//get order of components
		$list = array('main_slider','showcase','coverflow','box','a_coverflow','a_box','grid','carousel','topad'); //Write Them in their Default Order of Appearance.
		$order = array();
		
		$x = 0;
		foreach ($list as $i) {	
			if( get_theme_mod('seller_'.$i.'_priority') == 10 ) : //Customizer Defaults Loaded
				$order[] = 10 + $x;
			else :		
				$order[] = get_theme_mod('seller_'.$i.'_priority' , 10 + $x);
			endif;	
			$x += 0.01; //Use Decimel Because users can set priority as 11 too.
		}
		
		$sorted = array_combine($order, $list);
		ksort($sorted); //Sort on the Value of Keys 
		$sorted = array_values($sorted); //Fetch only the values, get rid of keys.
		
		if ($sorted[0] != 'main_slider') {
			//slider is not the topmost content;
			echo "<style>.slider-container { margin-top: 40px; }</style>";
		}		
				
		//Display the Components
		if (!is_paged()) { //Do not show on pages 2,3,4
			foreach($sorted as $s) {
					show($s);
			}	
		}
		
}
add_action('seller-before_content', 'seller_display_fc');


/*
** Seller Render Slider
*/
function seller_render_slider() {
	$seller_slider = array(
		'speed' => get_theme_mod('seller_slider_speed', 500 ),
		'autoplay' => get_theme_mod('seller_slider_pause', 5000 ), //Autoplay = 0 to disable, else time between slides
		'effect' => get_theme_mod('seller_slider_effect', 'fade' )
	);
	wp_localize_script( 'seller-custom-js', 'slider_object', $seller_slider );
}
add_action('wp_enqueue_scripts', 'seller_render_slider', 20);


/*
** Load WooCommerce Compatibility FIle
*/
if ( class_exists('woocommerce') ) :
	require get_template_directory() . '/framework/woocommerce.php';
endif;


/*
** Load Custom Widgets
*/
require get_template_directory() . '/framework/widgets/recent-posts.php';
require get_template_directory() . '/framework/widgets/video.php';
require get_template_directory() . '/framework/widgets/featured-posts.php';


/**
 * Include Meta Boxes.
 */
require get_template_directory() . '/framework/metaboxes/page-attributes.php';
require get_template_directory() . '/framework/metaboxes/display-options.php';
