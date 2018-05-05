<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Full Width width Slider Template
*/
    
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */                        

get_header() ?>                        
        
		<div class="layout-sidebar-no group">
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
      
            <!-- START CONTENT -->
            <div id="content" class="group">
            
					<?php 
					 if($post->ID == 8)
                    {                    
                    	echo do_shortcode('[smoothcategory catg_slug=residentialslider]');		
                    } 		
                    if($post->ID == 9)
                    {                    
                    	echo do_shortcode('[smoothcategory catg_slug=commercialslider]');		
                    }
                    if($post->ID == 10)
                    {
						 echo do_shortcode('[smoothcategory catg_slug=nurseyslider]');                    
                    }
                    ?>
                <?php if( yiw_layout_page() != 'sidebar-no' && get_post_meta( get_the_ID(), '_show_title_page', true ) == 'no' ): ?>
                    <div class="posts_space"></div>
                <?php endif; ?>
                
                <?php get_template_part( 'loop', 'page' ) ?>
                <?php comments_template() ?>
            </div>
            <!-- END CONTENT -->
       </div>   
                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
       
<?php get_footer() ?>
