<?php
/*
 * The Footer Widget Area
 * @package seller
 */
 ?>
 </div><!--.mega-container-->
 <?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') ) : ?>
	 <div id="footer-sidebar" class="widget-area">
	 	<div class="container">
		 	<?php 
				if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="footer-column col-md-6 col-sm-6"> 
						<?php dynamic_sidebar( 'footer-1'); ?> 
					</div> 
				<?php endif;
					
				if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="footer-column col-md-6 col-sm-6"> 
						<?php dynamic_sidebar( 'footer-2'); ?> 
					</div> 
				<?php endif; ?>
				
	 	</div>
	 </div>	<!--#footer-sidebar-->	
<?php endif; ?>