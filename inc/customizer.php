<?php
/**
 * seller Theme Customizer
 *
 * @package seller
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seller_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'seller' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'seller_logo' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'seller_logo',
	        array(
	            'label' => 'Upload Logo',
	            'section' => 'title_tagline',
	            'settings' => 'seller_logo',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'seller_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'seller_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'seller_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','seller'),
	            'section' => 'title_tagline',
	            'settings' => 'seller_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'seller_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function seller_logo_enabled($control) {
		$option = $control->manager->get_setting('seller_logo');
		return $option->value() == true;
	}
	
	
	//Site Title Font Size
	$wp_customize->add_setting( 'seller_title_fontsize' , array(
	    'default'     => 47,
	    'sanitize_callback' => 'seller_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'seller_title_fontsize',
	        array(
	            'label' => __('Site Title Font Size','seller'),
	            'description' => __('Default: 47; Min: 24, Max: 72; Step: 1','seller'),
	            'section' => 'title_tagline',
	            'settings' => 'seller_title_fontsize',
	            'priority' => 10,
	            'type' => 'range',
	            'input_attrs' => array(
			        'min'   => 24,
			        'max'   => 72,
			        'step'  => 1,
			    ),
	        )
	);
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override seller_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_control('site_icon');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->remove_setting('background_color');
	$wp_customize->remove_section('colors');
	$wp_customize->add_setting('seller_site_titlecolor', array(
	    'default'     => '#42a1cd',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_site_titlecolor', array(
			'label' => __('Site Title Color','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('seller_header_desccolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_header_desccolor', array(
			'label' => __('Site Tagline Color','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Basic Theme Settings
	$wp_customize->add_section( 'seller_basic_settings' , array(
	    'title'      => __( 'Basic Settings', 'seller' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'seller_favicon' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'seller_favicon',
	        array(
	            'label' => 'Upload Favicon',
	            'section' => 'seller_basic_settings',
	            'settings' => 'seller_favicon',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'seller_apple_icon' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'seller_apple_icon',
	        array(
	            'label' => 'Upload Apple Touch Icon',
	            'section' => 'seller_basic_settings',
	            'settings' => 'seller_apple_icon',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'seller_disable_featimg' , array(
	    'default'     => false,
	    'sanitize_callback' => 'seller_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(	   
        'seller_disable_featimg',
        array(
            'label' => 'Disable Featured Images on Posts.',
            'description' => 'This will Remove the Featured Images from Showing up on Individual Posts, however, it will not remove it from homepage and other elements.',
            'section' => 'seller_basic_settings',
            'settings' => 'seller_disable_featimg',
            'priority' => 5,
            'type' => 'checkbox',
        )
	);
	
	$wp_customize->add_setting( 'seller_disable_nextprev' , array(
	    'default'     => true,
	    'sanitize_callback' => 'seller_sanitize_checkbox',
	) );
	
	
	
	$wp_customize->add_control(	   
        'seller_disable_nextprev',
        array(
            'label' => 'Disable Next/Prev Posts on Single Posts.',
            'description' => 'This will Remove the the link to next and previous posts on all posts.',
            'section' => 'seller_basic_settings',
            'settings' => 'seller_disable_nextprev',
            'priority' => 5,
            'type' => 'checkbox',
        )
	);
	
	//Header Settings
	$wp_customize->add_section(
	    'seller_header',
	    array(
	        'title'     => __('Header Settings','seller'),
	        'priority'  => 10,
	    )
	);
	
	$wp_customize->add_setting( 'seller_header_layout' , array(
	    'default'     => 'seller',
	) );
	
	$wp_customize->add_control(
		'seller_header_layout',
			array(
				'label' => __('Select Layout','seller'),
				'settings' => 'seller_header_layout',
				'section'  => 'seller_header',
				'type' => 'select',
				'choices' => array(
						'cranky' => __('Cranky Layout','seller'),
						'seller' => __('Seller Default Layout','seller'),
						'store' => __('Store Layout','seller'),
					)
			)
	);
	
	$wp_customize->add_setting( 'seller_header_search_enable' , array(
	    'default'     => false,
	) );
	
	$wp_customize->add_control(
		'seller_header_search_enable',
			array(
				'label' => __('Show Search In Top Bar','seller'),
				'description' => __('This will replace the Top Menu with a Search Bar. Do not use with Store Layout.','seller'),
				'settings' => 'seller_header_search_enable',
				'section'  => 'seller_header',
				'type' => 'checkbox',
			)
	);
	
	$wp_customize->add_setting( 'seller_header_search' , array(
	    'default'     => 'top',
	) );
	
	$wp_customize->add_control(
		'seller_header_search',
			array(
				'label' => __('Search Bar Options','seller'),
				'settings' => 'seller_header_search',
				'section'  => 'seller_header',
				'type' => 'select',
				'choices' => array(
						'top' => __('Entire Site','seller'),
						'product' => __('Products Only.','seller'),
						'disabled' => __('Remove Search Bar','seller'),
					)
			)
	);
	
	$wp_customize->add_setting( 'seller_header_search_placeholder' , array(
	    'default'     => 'Search...',
	) );
	
	$wp_customize->add_control(
		'seller_header_search_placeholder',
			array(
				'label' => __('Search Bar Placeholder','seller'),
				'settings' => 'seller_header_search_placeholder',
				'section'  => 'seller_header',
				'type' => 'text',
			)
	);
	
	$wp_customize->add_setting( 'home_title' , array(
	    'default'     => 'From the Blog',
	) );
	
	$wp_customize->add_control(
		'home_title',
			array(
				'label' => __('Title for Blog Area on Hompage.','seller'),
				'settings' => 'home_title',
				'section'  => 'seller_header',
				'type' => 'text',
			)
	);
	
	
	
	
	$wp_customize->add_setting( 'seller_header_email' , array(
	    'default'     => 'yourname@email.com',
	) );
	
	$wp_customize->add_control(
		'seller_header_email',
			array(
				'label' => __('Email Address','seller'),
				'settings' => 'seller_header_email',
				'section'  => 'seller_header',
				'type' => 'text',
			)
	);
	
	$wp_customize->add_setting( 'seller_header_email' , array(
	    'default'     => 'yourname@email.com',
	) );
	
	$wp_customize->add_control(
		'seller_header_email',
			array(
				'label' => __('Phone','seller'),
				'settings' => 'seller_header_email',
				'section'  => 'seller_header',
				'type' => 'text',
			)
	);
	
	$wp_customize->add_setting( 'seller_header_phone' , array(
	    'default'     => '+12 45463722',
	) );
	
	$wp_customize->add_control(
		'seller_header_phone',
			array(
				'label' => __('Email Address','seller'),
				'settings' => 'seller_header_phone',
				'section'  => 'seller_header',
				'type' => 'text',
			)
	);
	
	
	//Settings for Nav Area
	$wp_customize->add_section(
	    'seller_menu_basic',
	    array(
	        'title'     => __('Menu Settings','seller'),
	        'priority'  => 0,
	        'panel'     => 'nav_menus'
	    )
	);
	
	
	$wp_customize->add_setting( 'seller_disable_nav_desc' , array(
	    'default'     => true,
	    'sanitize_callback' => 'seller_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'seller_disable_nav_desc', array(
		'label' => __('Disable Description of Menu Items','seller'),
		'section' => 'seller_menu_basic',
		'settings' => 'seller_disable_nav_desc',
		'type' => 'checkbox'
	) );
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'seller_hide_title_tagline',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_hide_title_tagline', array(
		    'settings' => 'seller_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'seller' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
		
	function seller_title_visible( $control ) {
		$option = $control->manager->get_setting('seller_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	//Showcases
	$wp_customize->add_panel( 'seller_showcase_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Showcases','seller'),
	) );
	
	$wp_customize->add_section(
	    'seller_sec_showcase_options',
	    array(
	        'title'     => __('Enable/Disable','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_showcase_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_main_showcase_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_showcase_enable', array(
		    'settings' => 'seller_main_showcase_enable',
		    'label'    => __( 'Enable Showcase on Front Page.', 'seller' ),
		    'section'  => 'seller_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_main_showcase_enable_home',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_showcase_enable_home', array(
		    'settings' => 'seller_main_showcase_enable_home',
		    'label'    => __( 'Enable Showcase on Home/Blog', 'seller' ),
		    'section'  => 'seller_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_showcase_priority',
			array(
				'default' => 10,
				'sanitize_callback' => 'seller_sanitize_positive_number',
			)
	);
	
	$wp_customize->add_control(
			'seller_showcase_priority', array(
		    'settings' => 'seller_showcase_priority',
		    'label'    => __( 'Priority' ,'seller'),
		    'section'  => 'seller_sec_showcase_options',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		    
		)
	);
		
	
	$showcases = 6;
	
	for ( $i = 1 ; $i <= $showcases ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		
		$wp_customize->add_setting(
			'seller_showcase_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'seller_showcase_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'seller_showcase_sec'.$i,
		            'settings' => 'seller_showcase_img'.$i,			       
		        )
			)
		);
		
		
		$wp_customize->add_section(
		    'seller_showcase_sec'.$i,
		    array(
		        'title'     => 'Showcase '.$i,
		        'priority'  => $i,
		        'panel'     => 'seller_showcase_panel'
		    )
		);
		
		$wp_customize->add_setting(
			'seller_showcase_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'seller_showcase_title'.$i, array(
			    'settings' => 'seller_showcase_title'.$i,
			    'label'    => __( 'Showcase Title','seller' ),
			    'section'  => 'seller_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'seller_showcase_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'seller_showcase_desc'.$i, array(
			    'settings' => 'seller_showcase_desc'.$i,
			    'label'    => __( 'Showcase Description','seller' ),
			    'section'  => 'seller_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'seller_showcase_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'seller_showcase_url'.$i, array(
			    'settings' => 'seller_showcase_url'.$i,
			    'label'    => __( 'Target URL','seller' ),
			    'section'  => 'seller_showcase_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;
	
	// SLIDER PANEL
	$wp_customize->add_panel( 'seller_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'seller_sec_slider_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'seller_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_main_slider_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_slider_enable', array(
		    'settings' => 'seller_main_slider_enable',
		    'label'    => __( 'Enable Slider on Home/Blog.', 'seller' ),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seller_main_slider_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_slider_enable_front', array(
		    'settings' => 'seller_main_slider_enable_front',
		    'label'    => __( 'Enable Slider on front page.', 'seller' ),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_main_slider_enable_posts',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_slider_enable_posts', array(
		    'settings' => 'seller_main_slider_enable_posts',
		    'label'    => __( 'Enable Slider on All Posts.', 'seller' ),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_main_slider_enable_pages',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_slider_enable_pages', array(
		    'settings' => 'seller_main_slider_enable_pages',
		    'label'    => __( 'Enable Slider on All Pages.', 'seller' ),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_main_slider_count',
			array(
				'default' => 0,
				'sanitize_callback' => 'seller_sanitize_positive_number',
			)
	);
	
	$wp_customize->add_control(
			'seller_main_slider_count', array(
		    'settings' => 'seller_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 30)' ,'seller'),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','seller'),
		    
		)
	);
	
	$wp_customize->add_setting(
		'seller_main_slider_priority',
			array(
				'default' => 10,
				'sanitize_callback' => 'seller_sanitize_positive_number',
			)
	);
	
	$wp_customize->add_control(
			'seller_main_slider_priority', array(
		    'settings' => 'seller_main_slider_priority',
		    'label'    => __( 'Priority' ,'seller'),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		    
		)
	);
	
	
	
	//Slider Config
	$wp_customize->add_section(
	    'seller_slider_config',
	    array(
	        'title'     => __('Configure Slider','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_slider_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_slider_pause',
			array(
				'default' => 5000,
				'sanitize_callback' => 'seller_sanitize_positive_number'
			)
	);
	
	$wp_customize->add_control(
			'seller_slider_pause', array(
		    'settings' => 'seller_slider_pause',
		    'label'    => __( 'Time Between Each Slide.' ,'seller'),
		    'section'  => 'seller_slider_config',
		    'type'     => 'number',
		    'description' => __('Value in Milliseconds. Set to 0, to disable Autoplay. Default: 5000.','seller'),
		    
		)
	);
	
	$wp_customize->add_setting(
		'seller_slider_speed',
			array(
				'default' => 500,
				'sanitize_callback' => 'seller_sanitize_positive_number'
			)
	);
	
	$wp_customize->add_control(
			'seller_slider_speed', array(
		    'settings' => 'seller_slider_speed',
		    'label'    => __( 'Animation Speed.' ,'seller'),
		    'section'  => 'seller_slider_config',
		    'type'     => 'number',
		    'description' => __('Value in Milliseconds. Default: 500.','seller'),
		    
		)
	);
	
	
	$wp_customize->add_setting(
		'seller_slider_pager',
			array(
				'default' => true,
				'sanitize_callback' => 'seller_sanitize_checkbox'
			)
	);
	
	$wp_customize->add_control(
			'seller_slider_pager', array(
		    'settings' => 'seller_slider_pager',
		    'label'    => __( 'Enable Pager.' ,'seller'),
		    'section'  => 'seller_slider_config',
		    'type'     => 'checkbox',
		    'description' => __('Pager is the Circles at the bottom, which represent current slide.','seller'),		    
		)
	);
	
	$wp_customize->add_setting(
		'seller_slider_arrow',
			array(
				'default' => true,
				'sanitize_callback' => 'seller_sanitize_checkbox'
			)
	);
	
	$wp_customize->add_control(
			'seller_slider_arrow', array(
		    'settings' => 'seller_slider_arrow',
		    'label'    => __( 'Enable Right/Left Navigation Arrows.' ,'seller'),
		    'section'  => 'seller_slider_config',
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'seller_slider_effect',
			array(
				'default' => 'fade',
				'sanitize_callback' => 'seller_sanitize_text'
			)
	);
	
	$earray=array('fade','slide');
		$earray = array_combine($earray, $earray);
	
	$wp_customize->add_control(
			'seller_slider_effect', array(
		    'settings' => 'seller_slider_effect',
		    'label'    => __( 'Slider Animation Effect.' ,'seller'),
		    'section'  => 'seller_slider_config',
		    'type'     => 'select',
		    'choices' => $earray,
	) );
	
	// Select How Many Slides the User wants, and Reload the Page.
	
	for ( $i = 1 ; $i <= 30 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		static $x = 0;
		$wp_customize->add_section(
		    'seller_slide_sec'.$i,
		    array(
		        'title'     => 'Slide '.$i,
		        'priority'  => $i,
		        'panel'     => 'seller_slider_panel',
		        'active_callback' => 'seller_show_slide_sec'
		        
		    )
		);	
		
		$wp_customize->add_setting(
			'seller_slide_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'seller_slide_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'seller_slide_sec'.$i,
		            'settings' => 'seller_slide_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'seller_slide_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'seller_slide_title'.$i, array(
			    'settings' => 'seller_slide_title'.$i,
			    'label'    => __( 'Slide Title','seller' ),
			    'section'  => 'seller_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'seller_slide_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'seller_slide_desc'.$i, array(
			    'settings' => 'seller_slide_desc'.$i,
			    'label'    => __( 'Slide Description','seller' ),
			    'section'  => 'seller_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		
		$wp_customize->add_setting(
			'seller_slide_CTA_button'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'seller_slide_CTA_button'.$i, array(
			    'settings' => 'seller_slide_CTA_button'.$i,
			    'label'    => __( 'Custom Call to Action Button Text(Optional)','seller' ),
			    'section'  => 'seller_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'seller_slide_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'seller_slide_url'.$i, array(
			    'settings' => 'seller_slide_url'.$i,
			    'label'    => __( 'Target URL','seller' ),
			    'section'  => 'seller_slide_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;
	
	//active callback to see if the slide section is to be displayed or not
	function seller_show_slide_sec( $control ) {
	        $option = $control->manager->get_setting('seller_main_slider_count');
	        global $x;
	        if ( $x < $option->value() ){
	        	$x++;
	        	return true;
	        }
		}
	
	if ( class_exists('woocommerce') ) :
	// CREATE THE fcp PANEL
	$wp_customize->add_panel( 'seller_fcp_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Product Showcase',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'seller_fc_boxes',
	    array(
	        'title'     => __('Square Boxes','seller'),
	        'description'     => __('Square Boxes & posts Slider, will always be enabled together as they are shown side by side.','seller'),
	        'priority'  => 10,
	        'panel'     => 'seller_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_box_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_box_enable', array(
		    'settings' => 'seller_box_enable',
		    'label'    => __( 'Enable Square Boxes & Posts Slider(on home/blog)', 'seller' ),
		    'section'  => 'seller_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_box_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_box_enable_front', array(
		    'settings' => 'seller_box_enable_front',
		    'label'    => __( 'Enable on Static Front Page.', 'seller' ),
		    'section'  => 'seller_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'seller_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_box_title', array(
		    'settings' => 'seller_box_title',
		    'label'    => __( 'Title for the Boxes','seller' ),
		    'section'  => 'seller_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'seller_box_cat',
	    array( 'sanitize_callback' => 'seller_sanitize_product_category' )
	);
	
	$wp_customize->add_control(
	    new WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'seller_box_cat',
	        array(
	            'label'    => __('Product Category.','seller'),
	            'settings' => 'seller_box_cat',
	            'section'  => 'seller_fc_boxes'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_box_priority',
		array( 'default'=>10,'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_box_priority', array(
		    'settings' => 'seller_box_priority',
		    'label'    => __( 'Priority','seller' ),
		    'section'  => 'seller_fc_boxes',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		)
	);
	
		
	//SLIDER
	$wp_customize->add_section(
	    'seller_fc_slider',
	    array(
	        'title'     => __('3D Cube Products Slider','seller'),
	        'priority'  => 10,
	        'panel'     => 'seller_fcp_panel',
	        'description' => 'This is the Posts Slider, displayed left to the square boxes.',
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_slider_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_slider_title', array(
		    'settings' => 'seller_slider_title',
		    'label'    => __( 'Title for the Slider', 'seller' ),
		    'section'  => 'seller_fc_slider',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'seller_slider_count',
		array( 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_slider_count', array(
		    'settings' => 'seller_slider_count',
		    'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'seller' ),
		    'section'  => 'seller_fc_slider',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 10,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'seller_slider_cat',
		    array( 'sanitize_callback' => 'seller_sanitize_product_category' )
		);
		
	$wp_customize->add_control(
	    new WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'seller_slider_cat',
	        array(
	            'label'    => __('Category For Slider.','seller'),
	            'settings' => 'seller_slider_cat',
	            'section'  => 'seller_fc_slider'
	        )
	    )
	);
	
	
	
	//COVERFLOW
	
	$wp_customize->add_section(
	    'seller_fc_coverflow',
	    array(
	        'title'     => __('Top CoverFlow Slider','seller'),
	        'priority'  => 5,
	        'panel'     => 'seller_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_coverflow_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_coverflow_enable', array(
		    'settings' => 'seller_coverflow_enable',
		    'label'    => __( 'Enable on Homepage/Blog', 'seller' ),
		    'section'  => 'seller_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'seller_coverflow_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_coverflow_enable_front', array(
		    'settings' => 'seller_coverflow_enable_front',
		    'label'    => __( 'Enable on Static Front Page.', 'seller' ),
		    'section'  => 'seller_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		    'seller_coverflow_cat',
		    array( 'sanitize_callback' => 'seller_sanitize_product_category' )
		);
	
		
	$wp_customize->add_control(
	    new WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'seller_coverflow_cat',
	        array(
	            'label'    => __('Category For Image Grid','seller'),
	            'settings' => 'seller_coverflow_cat',
	            'section'  => 'seller_fc_coverflow'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_coverflow_pc',
		array( 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_coverflow_pc', array(
		    'settings' => 'seller_coverflow_pc',
		    'label'    => __( 'Max No. of Posts in the Grid. Min: 5.', 'seller' ),
		    'section'  => 'seller_fc_coverflow',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	$wp_customize->add_setting(
		'seller_coverflow_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_coverflow_priority', array(
		    'settings' => 'seller_coverflow_priority',
		    'label'    => __( 'Priority', 'seller' ),
		    'section'  => 'seller_fc_coverflow',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		    
		)
	);
	
	endif; //end class exists woocommerce
	
	
	
	
	//Extra Panels for Users, who dont have WooCommerce
	
	// CREATE THE fcp PANEL
	$wp_customize->add_panel( 'seller_a_fcp_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Posts Showcase',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'seller_a_fc_boxes',
	    array(
	        'title'     => 'Square Boxes',
	        'priority'  => 10,
	        'panel'     => 'seller_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_a_box_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_a_box_enable', array(
		    'settings' => 'seller_a_box_enable',
		    'label'    => __( 'Enable Square Boxes & Posts Slider(on home/blog)', 'seller' ),
		    'section'  => 'seller_a_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_a_box_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_a_box_enable_front', array(
		    'settings' => 'seller_a_box_enable_front',
		    'label'    => __( 'Enable on Static Front Page.', 'seller' ),
		    'section'  => 'seller_a_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
 
	$wp_customize->add_setting(
		'seller_a_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_a_box_title', array(
		    'settings' => 'seller_a_box_title',
		    'label'    => __( 'Title for the Boxes','seller' ),
		    'section'  => 'seller_a_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'seller_a_box_cat',
	    array( 'sanitize_callback' => 'seller_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'seller_a_box_cat',
	        array(
	            'label'    => __('Posts Category.','seller'),
	            'settings' => 'seller_a_box_cat',
	            'section'  => 'seller_a_fc_boxes'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_a_box_priority',
			array( 'default' => 10,
				'sanitize_callback' => 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(
			'seller_a_box_priority', array(
		    'settings' => 'seller_a_box_priority',
		    'label'    => __( 'Priority','seller' ),
		    'section'  => 'seller_a_fc_boxes',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		)
	);
	
	
		
	//SLIDER
	$wp_customize->add_section(
	    'seller_a_fc_slider',
	    array(
	        'title'     => __('3D Cube Products Slider','seller'),
	        'priority'  => 10,
	        'panel'     => 'seller_a_fcp_panel',
	        'description' => 'This is the Posts Slider, displayed left to the square boxes.',
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_a_slider_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_a_slider_title', array(
		    'settings' => 'seller_a_slider_title',
		    'label'    => __( 'Title for the Slider', 'seller' ),
		    'section'  => 'seller_a_fc_slider',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'seller_a_slider_count',
		array( 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_a_slider_count', array(
		    'settings' => 'seller_a_slider_count',
		    'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'seller' ),
		    'section'  => 'seller_a_fc_slider',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 10,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'seller_a_slider_cat',
		    array( 'sanitize_callback' => 'seller_sanitize_category' )
		);
		
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'seller_a_slider_cat',
	        array(
	            'label'    => __('Category For Slider.','seller'),
	            'settings' => 'seller_a_slider_cat',
	            'section'  => 'seller_a_fc_slider'
	        )
	    )
	);
	
	
	
	//COVERFLOW
	
	$wp_customize->add_section(
	    'seller_a_fc_coverflow',
	    array(
	        'title'     => __('Top CoverFlow Slider','seller'),
	        'priority'  => 5,
	        'panel'     => 'seller_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_a_coverflow_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_a_coverflow_title', array(
		    'settings' => 'seller_a_coverflow_title',
		    'label'    => __( 'Title for the Coverflow', 'seller' ),
		    'section'  => 'seller_a_fc_coverflow',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'seller_a_coverflow_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_a_coverflow_enable', array(
		    'settings' => 'seller_a_coverflow_enable',
		    'label'    => __( 'Enable on Home/Blog.', 'seller' ),
		    'section'  => 'seller_a_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_a_coverflow_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_a_coverflow_enable_front', array(
		    'settings' => 'seller_a_coverflow_enable_front',
		    'label'    => __( 'Enable on Static Front Page.', 'seller' ),
		    'section'  => 'seller_a_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		    'seller_a_coverflow_cat',
		    array( 'sanitize_callback' => 'seller_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'seller_a_coverflow_cat',
	        array(
	            'label'    => __('Category For Image Grid','seller'),
	            'settings' => 'seller_a_coverflow_cat',
	            'section'  => 'seller_a_fc_coverflow'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_a_coverflow_pc',
		array( 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_a_coverflow_pc', array(
		    'settings' => 'seller_a_coverflow_pc',
		    'label'    => __( 'Max No. of Posts in the Grid. Min: 5.', 'seller' ),
		    'section'  => 'seller_a_fc_coverflow',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	$wp_customize->add_setting(
		'seller_a_coverflow_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_a_coverflow_priority', array(
		    'settings' => 'seller_a_coverflow_priority',
		    'label'    => __( 'Priority', 'seller' ),
		    'section'  => 'seller_a_fc_coverflow',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		)
	);
	
	
	//Carousel
	
	$wp_customize->add_section(
	    'seller_carousel',
	    array(
	        'title'     => __('Posts Carousel','seller'),
	        'priority'  => 10,
	        'panel'     => 'seller_a_fcp_panel',
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_carousel_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_carousel_enable', array(
		    'settings' => 'seller_carousel_enable',
		    'label'    => __( 'Enable Carousel on Home Page.', 'seller' ),
		    'section'  => 'seller_carousel',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_carousel_enable_posts',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_carousel_enable_posts', array(
		    'settings' => 'seller_carousel_enable_posts',
		    'label'    => __( 'Enable Carousel on All Posts.', 'seller' ),
		    'section'  => 'seller_carousel',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_carousel_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_carousel_enable_front', array(
		    'settings' => 'seller_carousel_enable_front',
		    'label'    => __( 'Enable Carousel on Static Front Page.', 'seller' ),
		    'section'  => 'seller_carousel',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_carousel_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_carousel_title', array(
		    'settings' => 'seller_carousel_title',
		    'label'    => __( 'Title', 'seller' ),
		    'section'  => 'seller_carousel',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'seller_carousel_count',
		array( 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_carousel_count', array(
		    'settings' => 'seller_carousel_count',
		    'label'    => __( 'No. of Posts(Min:4, Max: 16)', 'seller' ),
		    'section'  => 'seller_carousel',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 4,
		        'max'   => 16,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'seller_carousel_cat',
		    array( 'sanitize_callback' => 'seller_sanitize_category' )
		);
		
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'seller_carousel_cat',
	        array(
	            'label'    => __('Category','seller'),
	            'settings' => 'seller_carousel_cat',
	            'section'  => 'seller_carousel'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_carousel_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_carousel_priority', array(
		    'settings' => 'seller_carousel_priority',
		    'label'    => __( 'Priority', 'seller' ),
		    'section'  => 'seller_carousel',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		)
	);	
	
	
	//Image Flex Grid----------
	
	$wp_customize->add_section(
	    'seller_grid',
	    array(
	        'title'     => __('Featured Posts Grid','seller'),
	        'priority'  => 36,
	        'panel'     => 'seller_a_fcp_panel',
	    )
	);
	
	$wp_customize->add_setting(
		'seller_grid_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_grid_enable', array(
		    'settings' => 'seller_grid_enable',
		    'label'    => __( 'Enable on Home', 'seller' ),
		    'section'  => 'seller_grid',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_grid_enable_posts',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_grid_enable_posts', array(
		    'settings' => 'seller_grid_enable_posts',
		    'label'    => __( 'Enable on Posts Page', 'seller' ),
		    'section'  => 'seller_grid',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_grid_enable_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_grid_enable_front', array(
		    'settings' => 'seller_grid_enable_front',
		    'label'    => __( 'Enable on Static Front Page', 'seller' ),
		    'section'  => 'seller_grid',
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'seller_grid_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_grid_title', array(
		    'settings' => 'seller_grid_title',
		    'label'    => __( 'Title for the Grid', 'seller' ),
		    'section'  => 'seller_grid',
		    'type'     => 'text',
		)
	);
	
	
	
	$wp_customize->add_setting(
		    'seller_grid_cat',
		    array( 'sanitize_callback' => 'seller_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'seller_grid_cat',
	        array(
	            'label'    => __('Category For Image Grid','seller'),
	            'settings' => 'seller_grid_cat',
	            'section'  => 'seller_grid'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_grid_rows',
		array( 'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_grid_rows', array(
		    'settings' => 'seller_grid_rows',
		    'label'    => __( 'Max No. of Posts in the Grid. Enter 0 to Disable the Grid.', 'seller' ),
		    'section'  => 'seller_grid',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	$wp_customize->add_setting(
		'seller_grid_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'seller_grid_priority', array(
		    'settings' => 'seller_grid_priority',
		    'label'    => __( 'Priority', 'seller' ),
		    'section'  => 'seller_grid',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		)
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'seller_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','seller'),
	) );
	
	
	$wp_customize->add_section(
	    'seller_site_layout_sec',
	    array(
	        'title'     => __('Site Layout','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_site_layout',
		array( 'sanitize_callback' => 'seller_sanitize_site_layout' )
	);
	
	function seller_sanitize_site_layout( $input ) {
		if ( in_array($input, array('full','boxed') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'seller_site_layout',array(
				'label' => __('Select Layout','seller'),
				'settings' => 'seller_site_layout',
				'section'  => 'seller_site_layout_sec',
				'type' => 'select',
				'choices' => array(
						'full' => __('Full Width Layout','seller'),
						'boxed' => __('Boxed','seller'),
						
					)
			)
	);
	
	$wp_customize->add_section(
	    'seller_portfolio_options',
	    array(
	        'title'     => __('Portfolio Layout','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_portfolio_layout',
		array( 'sanitize_callback' => 'seller_sanitize_blog_layout' )
	);
	

	
	$wp_customize->add_control(
		'seller_portfolio_layout',array(
				'label' => __('Select Layout','seller'),
				'description' => __('Use this to Set the Layout for Portfolio Archive Pages.','seller'),
				'settings' => 'seller_portfolio_layout',
				'section'  => 'seller_portfolio_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Basic Blog Layout','seller'),
						'grid_2_column' => __('Grid - 2 Column','seller'),
						'grid_3_column' => __('Grid - 3 Column','seller'),
						'grid_4_column' => __('Grid - 4 Column','seller'),
						'photos_1_column' => __('Photography - 1 Column','seller'),
						'photos_2_column' => __('Photography - 2 Column','seller'),
						'photos_3_column' => __('Photography - 3 Column','seller'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'seller_woo_options',
	    array(
	        'title'     => __('WooCommerce Layout','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_woo_layout', array( 'default' => '3' )
	);
	
	
	$wp_customize->add_control(
		'seller_woo_layout',array(
				'label' => __('Select Layout','seller'),
				'settings' => 'seller_woo_layout',
				'section'  => 'seller_woo_options',
				'type' => 'select',
				'default' => '3',
				'choices' => array(
						'2' => __('2 Columns','seller'),
						'3' => __('3 Columns','seller'),
						'4' => __('4 Columns','seller'),
					),
			)
	);
	
	$wp_customize->add_setting(
		'seller_woo_qty', array( 'default' => '12' )
	);
	
	
	$wp_customize->add_control(
		'seller_woo_qty',array(
				'description' => __('This Value may reflect after you save and re-load the page.','seller'),
				'label' => __('No of Products per Page','seller'),
				'settings' => 'seller_woo_qty',
				'section'  => 'seller_woo_options',
				'type' => 'number',
				'default' => '12'
				
			)
	);
	
	
	
	$wp_customize->add_section(
	    'seller_design_options',
	    array(
	        'title'     => __('Blog Layout','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_blog_layout',
		array( 'sanitize_callback' => 'seller_sanitize_blog_layout' )
	);
	
	function seller_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','grid_3_column','grid_4_column','photos_1_column','photos_2_column','photos_3_column','seller','seller_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'seller_blog_layout',array(
				'label' => __('Select Layout','seller'),
				'settings' => 'seller_blog_layout',
				'section'  => 'seller_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','seller'),
						'grid_2_column' => __('Grid - 2 Column','seller'),
						'grid_3_column' => __('Grid - 3 Column','seller'),
						'grid_4_column' => __('Grid - 4 Column','seller'),
						'photos_1_column' => __('Photography - 1 Column','seller'),
						'photos_2_column' => __('Photography - 2 Column','seller'),
						'photos_3_column' => __('Photography - 3 Column','seller'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'seller_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar', array(
		    'settings' => 'seller_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar_home',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar_home', array(
		    'settings' => 'seller_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'seller_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar_archive',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar_archive', array(
		    'settings' => 'seller_disable_sidebar_archive',
		    'label'    => __( 'Disable Sidebar on Archive/Category/Tag Pages.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'seller_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar_portfolio',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar_portfolio', array(
		    'settings' => 'seller_disable_sidebar_portfolio',
		    'label'    => __( 'Disable Sidebar on Single Portfolio Items.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'seller_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar_front',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar_front', array(
		    'settings' => 'seller_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'seller_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar_shop',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar_shop', array(
		    'settings' => 'seller_disable_sidebar_shop',
		    'label'    => __( 'Disable Sidebar on Shop Page.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'seller_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'seller_disable_sidebar_product',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_disable_sidebar_product', array(
		    'settings' => 'seller_disable_sidebar_product',
		    'label'    => __( 'Disable Sidebar on Product Pages.','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'seller_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'seller_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'seller_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'seller_sidebar_width', array(
		    'settings' => 'seller_sidebar_width',
		    'label'    => __( 'Sidebar Width','seller' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','seller'),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'seller_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	$wp_customize->add_setting(
		'seller_sidebar_loc',
		array(
			'default' => 'right',
		    'sanitize_callback' => 'seller_sanitize_sidebar_loc' )
	);
	
	$wp_customize->add_control(
			'seller_sidebar_loc', array(
		    'settings' => 'seller_sidebar_loc',
		    'label'    => __( 'Sidebar Location','seller' ),
		    'section'  => 'seller_sidebar_options',
		    'type'     => 'select',
		    'active_callback' => 'seller_show_sidebar_options',
		    'choices' => array(
		        'left'   => "Left",
		        'right'   => "Right",
		    ),
		)
	);
	
	/* sanitization */
	function seller_sanitize_sidebar_loc( $input ) {
		if (in_array($input, array('left','right') ) ) :
			return $input;
		else :
			return '';
		endif;		
	}
	
	/* Active Callback Function */
	function seller_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('seller_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Seller_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'seller_custom_codes',
    array(
    	'title'			=> __('Custom CSS','seller'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','seller'),
    	'priority'		=> 11,
    	'panel'			=> 'seller_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'seller_custom_css',
	array(
		'default'		=> '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
	    new Seller_Custom_CSS_Control(
	        $wp_customize,
	        'seller_custom_css',
	        array(
	            'section' => 'seller_custom_codes',
	            'settings' => 'seller_custom_css'
	        )
	    )
	);
	
	function seller_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
		
	
	
	//Select the Default Theme Skin
	$wp_customize->add_section(
	    'seller_skin_options',
	    array(
	        'title'     => __('Skin Designer','seller'),
	        'priority'  => 39,
	    )
	);
	
	$wp_customize->add_setting(
		'seller_skin',
		array(
			'default'=> 'default',
			
			'sanitize_callback' => 'seller_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(blue)','seller'),
					'orange' =>  __('Orange','seller'),
					'brown' =>  __('Brown','seller'),
					'green' => __('Green','seller'),
					'grayscale' => __('GrayScale','seller'),
					'custom' => __('BUILD CUSTOM SKIN','seller') );
	
	$wp_customize->add_control(
		'seller_skin',array(
				'settings' => 'seller_skin',
				'label' => __('Chose a Skin, or Build your Own.','seller'),
				'section'  => 'seller_skin_options',
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function seller_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','brown','green','grayscale','custom') ) )
			return $input;
		else
			return '';
	}
	
	//CUSTOM SKIN BUILDER
	
	
	
	$wp_customize->add_setting('seller_skin_var_background', array(
	    'default'     => '#f7f5ee',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_background', array(
			'label' => __('Primary Background','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_background',
			'active_callback' => 'seller_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('seller_skin_var_accent', array(
	    'default'     => '#42a1cd',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_accent', array(
			'label' => __('Primary Accent','seller'),
			'description' => __('For Most Users, Changing this only color is sufficient.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_accent',
			'type' => 'color',
			'active_callback' => 'seller_skin_custom',
		) ) 
	);
	
	$wp_customize->add_setting('seller_skin_var_onaccent', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_onaccent', array(
			'label' => __('Contrast','seller'),
			'description' => __('If Accent is Light, this should be dark & vice-versa. This is the Text Color, for places where background color is primary accent.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_onaccent',
			'type' => 'color',
			'active_callback' => 'seller_skin_custom',
		) ) 
	);
	
	
	$wp_customize->add_setting('seller_skin_var_headerbg', array(
	    'default'     => '#42a1cd',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_headerbg', array(
			'label' => __('Header Background','seller'),
			'description' => __('This is Similar to Primary Accent By Default.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_headerbg',
			'type' => 'color',
			'active_callback' => 'seller_skin_custom',
		) ) 
	);
	
	$wp_customize->add_setting('seller_skin_var_header', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_header', array(
			'label' => __('Header Text Color','seller'),
			'description' => __('If Header Background is Light, this should be dark & vice-versa. This is Similar to Contrast by Default.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_header',
			'type' => 'color',
			'active_callback' => 'seller_skin_custom',
		) ) 
	);
	
	
	
	$wp_customize->add_setting('seller_skin_var_content', array(
	    'default'     => '#777777',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_content', array(
			'label' => __('Content Color','seller'),
			'description' => __('Must be Dark, like Black or Dark grey. Any darker color is acceptable.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_content',
			'active_callback' => 'seller_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('seller_skin_var_footerbg', array(
	    'default'     => '#252525',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_footerbg', array(
			'label' => __('Footer Background Color','seller'),
			'description' => __('Background Color of the Footer Widget Area.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_footerbg',
			'active_callback' => 'seller_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('seller_skin_var_footercolor', array(
	    'default'     => '#999999',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_skin_var_footercolor', array(
			'label' => __('Footer Text Color','seller'),
			'description' => __('Footer Widgets Text color.','seller'),
			'section' => 'seller_skin_options',
			'settings' => 'seller_skin_var_footercolor',
			'active_callback' => 'seller_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	function seller_skin_custom( $control ) {
		$option = $control->manager->get_setting('seller_skin');
	    return $option->value() == 'custom' ;
	}
	
	
	// Advertisement
	
	class seller_Custom_Ads_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	                <textarea rows="10" style="width:100%;" <?php $this->link(); ?>><?php echo $this->value(); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize->add_section('seller_ads', array(
			'title' => __('Advertisement','seller'),
			'priority' => 44 ,
	));
	
	$wp_customize->add_setting(
	'seller_topad',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'seller_sanitize_ads'
		)
	);
	
	$wp_customize->add_control(
	    new seller_Custom_Ads_Control(
	        $wp_customize,
	        'seller_topad',
	        array(
	            'section' => 'seller_ads',
	            'settings' => 'seller_topad',
	            'label'   => __('Top Ad','seller'),
	            'description' => __('Enter your Responsive Adsense Code. For Other Ads use 468x60px Banner.','seller')
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'seller_topad_priority',
			array(
				'default' => 10,
				'sanitize_callback' => 'seller_sanitize_positive_number'
			)
	);
	
	$wp_customize->add_control(
			'seller_topad_priority', array(
		    'settings' => 'seller_topad_priority',
		    'label'    => __( 'Priority' ,'seller'),
		    'section'  => 'seller_ads',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','seller'),
		    
		)
	);
	
	function seller_sanitize_ads( $input ) {
		  global $allowedposttags;
	      $custom_allowedtags["script"] = array();
	      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	      $output = wp_kses( $input, $custom_allowedtags);
	      return $output;
	}
	
	//Analytics
	
	class seller_Custom_JS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;background: #222; color: #eee;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	
	$wp_customize-> add_section(
    'seller_analytics_js',
    array(
    	'title'			=> __('Google Analytics','seller'),
    	'description'	=> __('Enter your Analytics Code. It will be Included in Footer of the Site. Do NOT Include &lt;script&gt; and &lt;/script&gt; tags.','seller'),
    	'priority'		=> 45,
    	)
    );
    
	$wp_customize->add_setting(
	'seller_analytics',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'seller_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
	    new seller_Custom_JS_Control(
	        $wp_customize,
	        'seller_analytics',
	        array(
	            'section' => 'seller_analytics_js',
	            'settings' => 'seller_analytics'
	        )
	    )
	);
	
	//FOOTER SETTINGS
	$wp_customize->add_panel( 'seller_footer_panel', array(
	    'priority'       => 41,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Footer Settings','seller'),
	) );
	
	$wp_customize-> add_section(
    'seller_footer_columns',
    array(
    	'title'			=> __('Footer Columns','seller'),
    	'description'	=> __('Choose How Many Widget Area Columns Do you Want in the Footer. Default: 4.','seller'),
    	'priority'		=> 10,
    	'panel'			=> 'seller_footer_panel'
    	)
    );
    
    $wp_customize->add_setting(
	'seller_footer_sidebar_columns',
	array(
		'default'		=> '4',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(
	'seller_footer_sidebar_columns', array(
		'label' => __('No. of Columns','seller'),
		'section' => 'seller_footer_columns',
		'settings' => 'seller_footer_sidebar_columns',
		'type' => 'select',
		'choices' => array(
				'1' => __('1','seller'),
				'2' => __('2','seller'),
				'3' => __('3','seller'),
				'4' => __('4','seller'),
			)
	) );
	
	$wp_customize-> add_section(
    'seller_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','seller'),
    	'description'	=> __('Enter your Own Copyright Text.','seller'),
    	'priority'		=> 11,
    	'panel'			=> 'seller_footer_panel'
    	)
    );
        
	$wp_customize->add_setting(
	'seller_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'seller_footer_text',
	        array(
	            'section' => 'seller_custom_footer',
	            'settings' => 'seller_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize-> add_section(
    'seller_credit_link',
    array(
    	'title'			=> __('Credit Links','seller'),
    	'priority'		=> 11,
    	'panel'			=> 'seller_footer_panel'
    	)
    );
	
	$wp_customize->add_setting(
	'seller_link_remove',
	array(
		'default'		=> false,
		'sanitize_callback'	=> 'seller_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(	 
	       'seller_link_remove',
	        array(
	            'section' => 'seller_credit_link',
	            'label' => __('Remove Footer Theme Credit Link.','seller'),
	            'settings' => 'seller_link_remove',
	            'type' => 'checkbox'
	        )
	);
	
	
	//Fonts
	
	$wp_customize->add_section(
	    'seller_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','seller'),
	        'priority'  => 41,
	        'description' => __('Defaults: Open Sans.','seller')
	    )
	);
	
	/**
	 * A class to create a dropdown for all google fonts
	 */
	 class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
	 {
	    private $fonts = false;
	
	    public function __construct($manager, $id, $args = array(), $options = array())
	    {
	        $this->fonts = $this->get_fonts();
	        parent::__construct( $manager, $id, $args );
	    }

	    /**
	     * Render the content of the category dropdown
	     *
	     * @return HTML
	     */
	    public function render_content()
	    {
	        if(!empty($this->fonts))
	        {
	            ?>
	                <label>
	                    <span class="customize-category-select-control" style="font-weight: bold; display: block; padding: 5px 0px;"><?php echo esc_html( $this->label ); ?><br /></span>
	                    
	                    <select <?php $this->link(); ?>>
	                        <?php
	                            foreach ( $this->fonts as $k => $v )
	                            {
	                               printf('<option value="%s" %s>%s</option>', $v->family, selected($this->value(), $k, false), $v->family);
	                            }
	                        ?>
	                    </select>
	                </label>
	            <?php
	        }
	    }
	
	    /**
	     * Get the google fonts from the API or in the cache
	     *
	     * @param  integer $amount
	     *
	     * @return String
	     */
	    public function get_fonts( $amount = 'all' )
	    {
	        $fontFile = get_template_directory().'/inc/cache/google-web-fonts.txt';
	
	        //Total time the file will be cached in seconds, set to a week
	        $cachetime = 86400 * 30;
	
	        if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
	        {
	            $content = json_decode(file_get_contents($fontFile));
	           
	        } else {
	
	            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyCnUNuE7iJyG-tuhk24EmaLZSC6yn3IjhQ';
	
	            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );
	
	            $fp = fopen($fontFile, 'w');
	            fwrite($fp, $fontContent['body']);
	            fclose($fp);
	
	            $content = json_decode($fontContent['body']);
	            
	        }
	
	        if($amount == 'all')
	        {
	            return $content->items;
	        } else {
	            return array_slice($content->items, 0, $amount);
	        }
	        
	    }
	 }
	
	$wp_customize->add_setting(
		'seller_title_font',
		array(
			'default'=> 'Open Sans',
			)
	);
	
	$wp_customize->add_control( new Google_Font_Dropdown_Custom_Control(
		$wp_customize,
		'seller_title_font',array(
				'label' => __('Primary Font','seller'),
				'settings' => 'seller_title_font',
				'section'  => 'seller_typo_options',
			)
		)
	);
	
	$wp_customize->add_setting(
		'seller_body_font',
			array(	'default'=> 'Open Sans',
	) );
	
	$wp_customize->add_control(
		new Google_Font_Dropdown_Custom_Control(
		$wp_customize,
		'seller_body_font',array(
				'label' => __('Secondary Font','seller'),
				'settings' => 'seller_body_font',
				'section'  => 'seller_typo_options'
			)
		)	
	);
	
	
	// Social Icons
	$wp_customize->add_section('seller_social_section', array(
			'title' => __('Social Icons','seller'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','protpress'),
					'facebook' => __('Facebook','protopress'),
					'twitter' => __('Twitter','protopress'),
					'google-plus' => __('Google Plus','protopress'),
					'instagram' => __('Instagram','protopress'),
					'rss' => __('RSS Feeds','protopress'),
					'vine' => __('Vine','protopress'),
					'vimeo-square' => __('Vimeo','protopress'),
					'youtube' => __('Youtube','protopress'),
					'flickr' => __('Flickr','protopress'),
					'android' => __('Android','protopress'),
					'apple' => __('Apple','protopress'),
					'dribbble' => __('Dribbble','protopress'),
					'foursquare' => __('FourSquare','protopress'),
					'git' => __('Git','protopress'),
					'linkedin' => __('Linked In','protopress'),
					'paypal' => __('PayPal','protopress'),
					'pinterest-p' => __('Pinterest','protopress'),
					'reddit' => __('Reddit','protopress'),
					'skype' => __('Skype','protopress'),
					'soundcloud' => __('SoundCloud','protopress'),
					'tumblr' => __('Tumblr','protopress'),
					'windows' => __('Windows','protopress'),
					'wordpress' => __('WordPress','protopress'),
					'yelp' => __('Yelp','protopress'),
					'vk' => __('VK.com','protopress'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= 10 ; $x++) :
			
		$wp_customize->add_setting(
			'seller_social_'.$x, array(
				'sanitize_callback' => 'seller_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'seller_social_'.$x, array(
					'settings' => 'seller_social_'.$x,
					'label' => __('Icon ','seller').$x,
					'section' => 'seller_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'seller_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'seller_social_url'.$x, array(
					'settings' => 'seller_social_url'.$x,
					'description' => __('Icon ','seller').$x.__(' Url','seller'),
					'section' => 'seller_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function seller_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr',
					'android',
					'apple',
					'dribbble',
					'foursquare',
					'git',
					'linkedin',
					'paypal',
					'pinterest-p',
					'reddit',
					'skype',
					'soundcloud',
					'tumblr',
					'windows',
					'wordpress',
					'yelp',
					'vk'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function seller_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function seller_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function seller_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	function seller_sanitize_product_category( $input ) {
		if ( get_term( $input, 'product_cat' ) )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'seller_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seller_customize_preview_js() {
	wp_enqueue_script( 'seller_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'seller_customize_preview_js' );
