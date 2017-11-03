<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package seller
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( seller_load_sidebar() ) : ?>
<div id="secondary" class="widget-area <?php do_action('seller_secondary-width') ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
