<?php
/*
*
* Dynamically Design the theme using Less Compiler for PHP
* Compiler Runs only when Customizer is Loaded, not for users. So no effect on site performance.
*
*/	
require get_template_directory() ."/framework/designer/lessc.inc.php";


function seller_exec_less() {
	$less = new lessc;
	$inputFile = get_template_directory() ."/assets/less/custom.less";
	$outputFile = get_template_directory() ."/assets/css/custom.css";

	$less->setVariables(array(
		"accent" => get_theme_mod('seller_skin_var_accent','#42a1cd'),	
		"background" => get_theme_mod('seller_skin_var_background','#f7f5ee'),
		"header-bg" => get_theme_mod('seller_skin_var_headerbg','#42a1cd'),
		"onaccent" => get_theme_mod('seller_skin_var_onaccent','#FFFFFF'),
		"header-color" => get_theme_mod('seller_skin_var_header','#FFFFFF'),
		"content" => get_theme_mod('seller_skin_var_content','#777777'),
		"footer-bg" => get_theme_mod('seller_skin_var_footerbg','#252525'),
		"footer-color" => get_theme_mod('seller_skin_var_footercolor','#999999'),
	  
	));
	
	
	if ( is_customize_preview() )  {
		try {
			$less->compileFile( $inputFile, $outputFile ); 
		} catch(exception $e) {
			echo "fatal error: " . $e->getMessage();
		}
		
	} 
	else {
		$less->checkedCompile( $inputFile, $outputFile );
	}

}	
add_action('wp_head','seller_exec_less', 1);