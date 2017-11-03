<?php
/**
 * @package seller
 */
?>
	<?php do_action('seller_before-article'); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 grid photos_2_column'); ?>>
	
			<div class="featured-thumb col-md-12">
				<?php if (has_post_thumbnail()) : ?>	
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('pop-thumb-pic'); ?></a>
				<?php else: ?>
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
				<?php endif; ?>
				
				<div class="out-thumb col-md-12">
					<header class="entry-header">
						<h1 class="entry-title title-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<span class="readmore"><a class="hvr-bounce-to-bottom" href="<?php the_permalink() ?>"><?php _e('View','seller'); ?></a></span>
					</header><!-- .entry-header -->
				</div><!--.out-thumb-->
					
			</div><!--.featured-thumb-->
				
			
							
	</article><!-- #post-## -->
	<?php do_action('seller_after-article'); ?>
	