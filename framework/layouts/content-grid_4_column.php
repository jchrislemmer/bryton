<?php
/**
 * @package seller
 */
?>
	<?php do_action('seller_before-article'); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3 col-sm-6 grid grid_2_column grid_3_column grid_4_column'); ?>>
	
			<div class="featured-thumb col-md-12">
				<?php if (has_post_thumbnail()) : ?>	
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('pop-thumb'); ?></a>
				<?php else: ?>
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
				<?php endif; ?>
			</div><!--.featured-thumb-->
				
			<div class="out-thumb col-md-12">
				<header class="entry-header">
					<h1 class="entry-title title-font"><a class="hvr-underline-reveal" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<span class="entry-excerpt"><?php echo substr(get_the_excerpt(),0,200).(get_the_excerpt() ? "..." : "" ); ?></span>
				</header><!-- .entry-header -->
			</div><!--.out-thumb-->
							
	</article><!-- #post-## -->
	<?php do_action('seller_after-article'); ?>
	