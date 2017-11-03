<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package seller
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search grid'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php seller_posted_on(); ?>
				</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php if (has_post_thumbnail()) 
				the_post_thumbnail('thumbnail'); ?>
		<?php the_excerpt(); ?>
		
		<a class="viewmore" href="<?php the_permalink(); ?>"><?php _e('View More','seller'); ?></a>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
