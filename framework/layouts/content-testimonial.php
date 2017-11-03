<?php
/**
 * @package seller
 */
?>
<?php do_action('seller_before-article'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 grid testimonial'); ?>>

		<div class="featured-thumb col-md-2">
			<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail(); ?></a>	
		</div><!--.featured-thumb-->
		
			
		<div class="out-thumb col-md-10">
			<header class="entry-header">
				<h1 class="entry-title title-font"><?php the_title(); ?></h1>
				<span class="entry-excerpt"><?php the_content(); ?></span>
				<div class="author"><a href="<?php echo get_post_meta( get_the_ID(), 'website_link', true ); ?>"><?php echo get_post_meta( get_the_ID(), 'username_link', true ); ?></a> <span class="date"><?php echo get_the_date('M j'); ?></span></div>
				
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
	
</article><!-- #post-## -->
<?php do_action('seller_after-article'); ?>