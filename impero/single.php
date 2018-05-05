<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
get_header();
global $post;?>  
  <?php get_sidebar(); ?>    
  	 

  </div>
   <div class="rightbar">         
     <div class="nursery1">   
  <!-- START LATEST NEWS -->
            <?php 
                if( $post_type == TYPE_PORTFOLIO ) {
                    get_sidebar('portfolio');
                } elseif( $post_type == TYPE_SERVICES ) {
                    get_sidebar('services');
                } elseif( $post_type == TYPE_NEWS ) {
                    get_sidebar('news');
                } else {
                    get_sidebar('blog');
                }
            ?>
            <!-- END LATEST NEWS -->   
</div>
         <div class="rightbar_3">
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        

            <!-- START CONTENT -->
            
                <?php $blog_type = yiw_get_option('blog_type'); ?>
                
                <?php switch( $post_type = get_post_type() ) {
                          case TYPE_SERVICES  : 
                          case TYPE_NEWS      : 
                          case TYPE_PORTFOLIO : get_template_part('loop', 'internal'); break;
                          default             : get_template_part('loop', 'index');
                      }
                ?>
 
                                  
            <!-- END CONTENT -->
            
          
			
         </div>  
		
     
        </div>     
        
<?php get_footer() ?>
