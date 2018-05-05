<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Template with a gallery
*/
    
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */                        

get_header() ?>                        
       <?php get_sidebar(); ?>    
  	 

  </div>
   <div class="rightbar">
<div class="banner">
	<?php 
					 if($post->ID == 8)
                    {                    
                    	echo do_shortcode('[metaslider id=2945]');		
                    } 		
                    if($post->ID == 9)
                    {                    
                    	echo do_shortcode('[metaslider id=2923]');		
                    }
					 if($post->ID == 2645)
                    {                    
                    	echo do_shortcode('[metaslider id=2946]');		
                    }
					 if($post->ID == 2599)
                    {                    
                    	echo do_shortcode('[metaslider id=2948]');		
                    }
					 if($post->ID == 2597)
                    {                    
                    	echo do_shortcode('[metaslider id=2949]');		
                    }
					 if($post->ID == 2602)
                    {                    
                    	echo do_shortcode('[metaslider id=2950]');		
                    }
					 if($post->ID == 2608)
                    {                    
                    	echo do_shortcode('[metaslider id=2951]');		
                    }
					 if($post->ID == 2612)
                    {                    
                    	echo do_shortcode('[metaslider id=2954]');		
                    }
					 if($post->ID == 2616)
                    {                    
                    	echo do_shortcode('[metaslider id=2955]');		
                    }
					 if($post->ID == 2614)
                    {                    
                    	echo do_shortcode('[metaslider id=2984]');		
                    }
					 if($post->ID == 2610)
                    {                    
                    	echo do_shortcode('[metaslider id=2983]');		
                    }
					
					
                
                    ?>

</div>
  
	
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
      
            <!-- START CONTENT -->
          
            
				
                <?php if( yiw_layout_page() != 'sidebar-no' && get_post_meta( get_the_ID(), '_show_title_page', true ) == 'no' ): ?>
                    <div class="posts_space"></div>
                <?php endif; ?>
                
                <?php get_template_part( 'loop', 'page' ) ?>
                <?php comments_template() ?>
          
            <!-- END CONTENT -->
        
                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
         </div>
<?php get_footer() ?>
