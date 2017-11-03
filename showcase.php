<div id="showcase">
<div class="container">
	<?php
	  		for ( $i = 1; $i <= 6; $i++ ) :
	  				
	  				$url = esc_url ( get_theme_mod('seller_showcase_url'.$i) );
		  			$img = esc_url ( get_theme_mod('seller_showcase_img'.$i) );
		  			$title = get_theme_mod('seller_showcase_title'.$i);
		  			$desc = get_theme_mod('seller_showcase_desc'.$i);
		  			
		  			if ($img) {
		  			
					echo "<div class='col-md-4 col-sm-4 showcase'><figure><div><a href='".$url."'><img src='".$img."'>";
					if ( $desc || $title ) :
						echo "<div class='showcase-caption'><div class='showcase-caption-title'>".$title."</div><div class='showcase-caption-desc'>".$desc."</div></div>";
					endif;
					echo "</a></div></figure></div>";  
					
					} //endif
			endfor;
       ?>
 </div>   
</div><!--.showcase-->
