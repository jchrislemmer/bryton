<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.

	$count_x = $count = get_theme_mod('seller_main_slider_count');

		
		?>
		</div>
		<div id="slider-bg" data-stellar-background-ratio="0.5">
				<div class="slider-container theme-default">
			            <div class="swiper-wrapper">
			            <?php
			            for ( $i = 1; $i <= $count; $i++ ) :
	
							$url = esc_url ( get_theme_mod('seller_slide_url'.$i) );
							$img = esc_url ( get_theme_mod('seller_slide_img'.$i) );
							$title = esc_html( get_theme_mod('seller_slide_title'.$i) );
							$desc = esc_html( get_theme_mod('seller_slide_desc'.$i) );
							 
							
							?>
							<div class="swiper-slide">
				            	<a href="<?php echo $url; ?>">
				            		<img src="<?php echo $img ?>" data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
				            	</a>
				            	<div class="slidecaption container">
					                
					                <?php if ($title) : ?>
						                <div class="slide-title"><?php echo $title ?></div>
						                <div class="slide-desc"><span><?php echo $desc ?></span></div>
						            <?php endif; ?> 
								</div>
				            </div>
			             <?php endfor; ?>
			               
			            </div>
			            <?php if ( get_theme_mod('seller_slider_pager', true ) ) : ?>
			            <div class="swiper-pagination swiper-pagination-white"></div>
			            <?php endif; ?>
						
						 <?php if ( get_theme_mod('seller_slider_arrow', true ) ) : ?>
						<div class="swiper-button-next slidernext swiper-button-white"></div>
						<div class="swiper-button-prev sliderprev swiper-button-white"></div>
						<?php endif; ?>
			        </div>
		</div>
		<div class="mega-container">
  