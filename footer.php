<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package seller
 */
?>

	</div><!-- #content -->

	<?php seller_load_footer_sidebar(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<div class="credits">
			<?php if ( !get_theme_mod('seller_link_remove') ) : ?>
			<?php printf( __( 'Theme by %1$s.', 'seller' ), '<a href="'.esc_url("http://rohitink.com/").'" rel="designer">Rohit</a>' ); ?>
			<span class="sep"></span>
			<?php endif; ?>
			<?php echo ( get_theme_mod('seller_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','seller') ) : esc_html( get_theme_mod('seller_footer_text') ); ?>
			</div>
			<div id="footer-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<script><?php echo get_theme_mod('seller_analytics'); ?></script>

<?php wp_footer(); ?>

</body>
</html>
