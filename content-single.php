<?php
/**
 * @package seller
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		
		<div class="entry-meta">
			<?php seller_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( !get_theme_mod('seller_disable_featimg') ) : ?>
		<div id="featured-image">
			<?php the_post_thumbnail('full'); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'seller' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php seller_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
	<?php if (!get_theme_mod('seller_disable_nextprev',false) ): 
				seller_post_nav();
		  endif; ?>
		  
</article><!-- #post-## -->
