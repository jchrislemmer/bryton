<?php
/*
** Template to Render Social Icons on Top Bar
*/

for ($i = 1; $i < 11; $i++) : 
	$social = get_theme_mod('seller_social_'.$i);
	if ( ($social != 'none') && ($social != '') ) : ?>
	<a href="<?php echo esc_url( get_theme_mod('seller_social_url'.$i) ); ?>"><i class="fa fa-<?php echo $social; ?>"></i></a>
	<?php endif;

endfor; ?>