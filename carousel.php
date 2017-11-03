<div id="carousel" class="container">
	<div class="section-title title-font">
		<?php echo esc_html( get_theme_mod('seller_carousel_title','Carousel') ); ?>
	</div>
	    <div class="carousel-container">
	        <div class="swiper-wrapper">
	            <?php
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => get_theme_mod('seller_carousel_count',10),
			        	'cat'         => esc_html( get_theme_mod('seller_carousel_cat',0) ),
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        
				        	$loop->the_post(); 
				        	
				        	if ( has_post_thumbnail() ) :
				        		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'pop-thumb' ); 
								$image_url = $image_data[0]; 
							else :
								$image_url = get_template_directory_uri()."/assets/images/placeholder2.jpg";	
							endif;		
				        	
				        ?>
						
							<div class="swiper-slide">
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
									<img src="<?php echo $image_url; ?>">
									<div class="post-details">
										<h3><?php the_title(); ?></h3>
									</div>
								</a>
								</div>
													
						 <?php endwhile; ?>
						 <?php wp_reset_query(); ?>	
						 <?php wp_reset_postdata(); ?>
		            
		        </div>
	        <!-- Add Pagination -->
	        
<!--
	        <div class="swiper-button-next sbncp_c swiper-button-white"></div>
        <div class="swiper-button-prev sbpcp_c swiper-button-white"></div>
-->
	    </div>
	</div> <!--#carousel-->