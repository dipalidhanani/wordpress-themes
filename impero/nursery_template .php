<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Nursery Template
*/
    
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */                        

get_header() ?> 
 <?php 
	  get_sidebar(); 
	  global $post;
	  $val1=get_post_meta($post->ID,'page_banner', true);
	  ?>                          
       <?php get_sidebar(); ?>    
  	 

  </div>

  
  <div class="rightbar">
  <div class="nursery">
					
					
	                <?php 
	                    $sidebar = get_post_meta( get_the_ID(), '_sidebar_choose_page', true );	                    
	                   
	                       
	                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) )
	                        get_sidebar( 'default' ) 
	                ?>
			
				
        </div>
        
  <div class="rightbar_2">
  
    <div class="banner2">
	<?php            	echo do_shortcode('[metaslider id=3104]');					?>
	</div>
        
    </div>
    
     <div class="clear"></div>
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
