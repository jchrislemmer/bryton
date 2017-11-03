<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package seller
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */ 
function seller_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
	    'type'           => 'click',
	    'footer_widgets' => true,
	    'container'      => 'main',
	    'render'		 => 'seller_jetpack_render_posts',
	    'posts_per_page' => 6,
	    'wrapper' 		 => false,
	) );
}
add_action( 'after_setup_theme', 'seller_jetpack_setup' );

function seller_jetpack_render_posts() {
		while( have_posts() ) {
	    the_post();
	    do_action('seller_blog_layout'); 
	}
}

function filter_jetpack_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = __( 'Load more...', 'seller' );
 
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'filter_jetpack_infinite_scroll_js_settings' );