<div id="flex-grid" class="container">
<div class="flex-images">
		<div class="section-title">
			<?php echo esc_html( get_theme_mod('seller_grid_title', 'Featured Articles') ); ?>
		</div>
	
	<?php if ( have_posts() ) : ?>
	
				<?php /* Start the Loop */  ?>
				<?php
	    		$args = array( 'posts_per_page' => get_theme_mod('seller_grid_rows'), 'category' => get_theme_mod('seller_grid_cat') );
				$lastposts = get_posts( $args );
				foreach ( $lastposts as $post ) :
				  setup_postdata( $post ); ?>
				  <?php if ( has_post_thumbnail() ): ?>
					<?php $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" ); ?>
					<?php $image_width = $image_data[1]; ?>
					<?php $image_height = $image_data[2]; ?>
				<?php else :
						  $image_height	= 170;
						  $image_width = 270;
				endif; ?> 	
						
				<article data-w="<?php echo $image_width ?>" data-h="<?php echo $image_height; ?>" id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
				
							<?php if (has_post_thumbnail()) : ?>	
								<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('full'); ?></a>
							<?php else : ?>
								<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
	
							<?php endif; ?>
							
							<div class="flex-caption"><?php echo the_title(); ?></div>
							
						
				</article><!-- #post-## -->
					
				<?php endforeach; ?>
	
			<?php endif; 
				wp_reset_postdata();
				wp_reset_query();
			?>

</div>
</div>
