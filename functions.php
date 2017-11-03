<?php
/**
 * seller functions and definitions
 *
 * @package seller
 */



if ( ! function_exists( 'seller_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function seller_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on seller, use a find and replace
	 * to change 'seller' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'seller', get_template_directory() . '/languages' );

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 global $content_width;
	 if ( ! isset( $content_width ) ) {
		$content_width = 750; /* pixels */
		wp_reset_postdata();
		if( get_theme_mod('seller_disable_sidebar_portfolio') && (get_post_type() == 'portfolio') ) :
			$content_width = 1120;			
		elseif ( get_post_meta( get_the_ID(), 'enable-full-width', true ) )	:
			$content_width = 1120;
		endif;	
		wp_reset_postdata();
	 }
	 
	 
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'seller' ),
		'top' => __( 'Top Menu', 'seller' ),
		'footer' => __( 'Footer Menu', 'seller' ),
		'mobile' => __( 'Mobile Menu', 'seller' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'seller_custom_background_args', array(
		'default-color' => 'f7f5ee',
		'default-image' => '',
	) ) );
	
	add_image_size('seller-sq-thumb', 350,350, true );
	add_image_size('seller-thumb', 540,450, true );
	add_image_size('pop-thumb',542, 340, true );
	add_image_size('pop-thumb-pic',813, 510, true );
	
	//Declare woocommerce support
	add_theme_support('woocommerce');
	
}
endif; // seller_setup
add_action( 'after_setup_theme', 'seller_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function seller_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'seller' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'seller' ),
		'id'            => 'sidebar-shop',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'seller' ), 
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'seller' ), 
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'seller' ), 
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'seller' ), 
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'seller_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seller_scripts() {
	wp_enqueue_style( 'seller-style', get_stylesheet_uri() );
	
	wp_enqueue_style('seller-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('seller_title_font', 'Lato') ).':100,300,400,700' );
	
	wp_enqueue_style('seller-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('seller_body_font', 'Open Sans') ).':100,300,400,700' );
	
	wp_enqueue_style( 'seller-fontawesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'seller-bootstrap-style', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'seller-fleximage-style', get_template_directory_uri() . '/assets/css/jquery.flex-images.css' );
	
	wp_enqueue_style( 'seller-hover-style', get_template_directory_uri() . '/assets/css/hover.min.css' );

	wp_enqueue_style( 'seller-slicknav', get_template_directory_uri() . '/assets/css/slicknav.css' );
	
	wp_enqueue_style( 'seller-swiperslider-style', get_template_directory_uri() . '/assets/css/swiper.min.css' );
	
	wp_enqueue_style( 'seller-main-theme-style', get_template_directory_uri() . '/assets/css/'.get_theme_mod('seller_skin', 'default').'.css', array(), filemtime( get_template_directory() . '/assets/css/'.get_theme_mod('seller_skin', 'default').'.css' ) );

	wp_enqueue_script( 'seller-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'seller-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'seller-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'seller-custom-js', get_template_directory_uri() . '/js/custom.js', array('seller-externaljs'), null );
}
add_action( 'wp_enqueue_scripts', 'seller_scripts' );


/**
 * Enqueue Scripts for Admin
 */
function seller_custom_wp_admin_style() {
	if(is_customize_preview()) {
        wp_enqueue_style( 'seller-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
        wp_enqueue_style( 'seller-fontawesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
        }
}
add_action( 'admin_enqueue_scripts', 'seller_custom_wp_admin_style' );



/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Skin Designer file.
 */
require get_template_directory() . '/framework/designer/designer.php';


/**
 * Load Auto Update file.
 */
require get_template_directory().'/framework/teras-update-checker/init.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://teras.pro/updater/?action=get_metadata&slug=seller-pro',
	__FILE__,
	'seller-pro'
);