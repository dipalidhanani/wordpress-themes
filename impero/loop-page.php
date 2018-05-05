<?php 
	global $wp_query, $post;
	
	$tmp_query = $wp_query;
	
	if ( have_posts() ) : 

	    while ( have_posts() ) : the_post();
	    	
			add_filter( 'the_title', 'yiw_get_convertTags' ); 
			
			$wpautop = get_post_meta( get_the_ID(), '_page_remove_wpautop', true );
			
			if( $wpautop )
				remove_filter( 'the_content', 'wpautop' );
			
			$_active_title = get_post_meta( $post->ID, '_show_title_page', true );
			
			if( $_active_title == 'yes' || !$_active_title ) {
				
				   if($post->ID == 8 || $post->ID == 9 || $post->ID == 10 || $post->ID == 2645 || $post->ID == 2599 || $post->ID == 2597 ||  $post->ID == 2602 ||  $post->ID == 2608 ||  $post->ID == 2612 ||  $post->ID == 2616 || $post->ID == 2610 || $post->ID == 2614 )
                    {                    
                    	the_title( '<div class="bannerlinks"><div class="head">', '</div></div>' );		
                    }
					else
					{
				
						the_title( '<div class="bannerlinks1"><div class="head1">', '</div></div>' );  
					}
            
                if( get_post_meta( $post->ID, '_show_breadcrumbs_page', true ) == 'yes' )
                  {
					  //  the_breadcrumb();
				  }
            }
			?>	
			
			<div id="post-<?php the_ID(); ?>" class="para">
			<div class="cont">
			<?php the_content();?>
            </div>
			</div><?php
		
			if( $wpautop )
				add_filter( 'the_content', 'wpautop' ); 
		
		endwhile; 
	
	endif; 
	
	$wp_query = $tmp_query;      
	
	wp_reset_postdata();
?>                    