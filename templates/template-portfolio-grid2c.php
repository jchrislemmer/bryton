<?php
/**
 * The template for displaying all page with a Blog Style.
 * Template Name: PortFolio (Grid 2 Columns)
 *
 * @package seller
 */

get_header(); ?>

	<div id="primary" class="content-areas <?php do_action('seller_primary-width') ?>">
		<main id="main" class="site-main" role="main">
		<header class="entry-header">
			<?php the_title( '<h1 class="template-entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php wp_reset_query(); 
			  wp_reset_postdata();
			  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
			  $cat = get_post_meta( get_the_ID(), 'choose-pcategory', true );
			if ($cat == 'all_c') 
			  	$op = 'NOT IN';
			  else 
			  	$op = 'IN' 	;
			$qa = array (
				'post_type'              => 'portfolio',
				'ignore_sticky_posts'    => false,
				'paged' 				 => $paged,
				'tax_query' => array(
								         array(
								            'taxonomy'      => 'portfolio-type',
								            'terms'         => $cat,
								            'operator'      => $op // Possible values are 'IN', 'NOT IN', 'AND'.
									         )
						    )
	
			);
		
		// The Query
		$recent_articles = new WP_Query( $qa );
		if ( $recent_articles->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( $recent_articles->have_posts() ) : $recent_articles->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					get_template_part('framework/layouts/content', 'photos_2_column');  
					
				?>

			<?php endwhile; ?>
			<?php seller_pagination_queried( $recent_articles ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
