<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
/*
Template Name: Blog
*/

get_header() ;


?>           
        
 <?php get_sidebar(); ?>    
  	 

  </div>
   <div class="rightbar">

     
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        
            <?php 
                global $paged, $blog_type; 
                
                if( !$blog_type) $blog_type = yiw_get_option('blog_type');
				
				

            ?>
            <?php query_posts('cat=27&posts_per_page=' . get_option('posts_per_page') . '&paged=' . $paged) ?>
            
                <?php get_template_part('loop', 'index') ?>
            
            
            <!-- START LATEST NEWS -->
            <?php //get_sidebar('blog') ?>
            <!-- END LATEST NEWS -->   
        
    
         </div>   
        
<?php get_footer() ?>
