<?php 
$slide_args = array( 
	'post_type' 		=> 'slide',
	'posts_per_page' 	=> -1,
	'orderby'			=> 'menu_order',
	'order' 			=> 'ASC',
);
$slide_query = new WP_Query();
$slide_query->query( $slide_args );

$slide_post_count = $slide_query->post_count;
// print_r($slide_query);
?>

<!-- #mfn-slider -->
<div id="mfn-slider" class="mfn-slider-vertical">
	<div class="swiper-container">
    	
    	<div class="swiper-wrapper">
    		<?php 
	    		while ($slide_query->have_posts()){
					$slide_query->the_post();
					
					// slide class - dark
					if( get_post_meta(get_the_ID(),'mfn-post-dark',true) ){
						$slide_class = 'dark';
					} else {
						$slide_class = false;
					}
					
					$background_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					echo '<div class="swiper-slide '. $slide_class .'">';
						echo '<div class="swiper-background" style="background-image:url('. $background_image_url[0] .');">';
							echo '<div class="vertical-align-middle container">';
								echo '<h2 class="swiper-title">'. get_post_meta(get_the_ID(),'mfn-post-title',true) .'</h2>';
								echo '<div class="swiper-desc">'. get_post_meta(get_the_ID(),'mfn-post-text',true) .'</div>';
								if( $link = get_post_meta(get_the_ID(),'mfn-post-link',true) ){
									echo '<a class="button button_large swiper-button" href="'. $link .'">'. get_post_meta(get_the_ID(),'mfn-post-link_title',true) .'</a>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
    		?>    		
    	</div>
	    
		<div class="swiper-controls">
			<a class="swiper-control swiper-prev" href="#">prev</a> 
			<div class="swiper-counter"><span class="swiper-current">1</span><span class="swiper-sep">/</span><span class="swiper-count"><?php echo $slide_post_count; ?></span></div>
			<a class="swiper-control swiper-next" href="#">next</a>
		</div>
		
	</div>	
</div>
