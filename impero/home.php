<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Home
*/



/*if( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || is_home() && get_option( 'page_for_posts' ) != '0' ) {
    $blog_type = yiw_get_option('blog_type');
    get_template_part( 'blog' ); 
    die;
}*/

get_header() ?>  


    
      <?php get_sidebar(); ?>
    
      
  	

  </div>

    <div class="rightbar">
            <div class="banner">
            
            
           <!-- <img src="<?php //echo get_template_directory_uri()?>/images/banner.jpg" />-->
           <?php /*?><ul style="position: relative; width: 960px; height: 389px;" id="slider">
  
    <?php
         $queryObject = new WP_Query(array('post_type' => 'slider', 'posts_per_page'=>''));
				
			if ($queryObject->have_posts())
			{
				while( $queryObject->have_posts() ) : $queryObject->the_post();
				?>
				<?php 
					//if ( has_post_thumbnail()) {?>
					
						
					<?php
					
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
                    
    <li style="position: absolute; top: 0px; left: 0px; display: none; z-index: 3; opacity: 0; width: 960px; height: 389px;">
      <div class="header-left">
        <div class="slider-image"> <img src="<?php echo $large_image_url[0];?>" alt="" height="389" width="705"> </div>
		<div class="slider-text"> <h2><?php the_title(); ?> </h2> <?php the_content(); ?></div>
      </div>
      <!-- end #header-left -->
      <div class="header-right"> 
    
      </div>
    </li>
    
    <?php
				endwhile;
			}
wp_reset_postdata();
wp_reset_query();?>
  
  </ul><?php */?>
     <?php    echo do_shortcode('[metaslider id=2937]');?>
            </div>
            
            
            <div class="bannerlinks">
            <ul>
            <li class="first"><a href="/services/design/" title="Design">Design</a></li>
            <li><a href="/services/install/" title="Installation">Installation</a></li>           
            <li><a href="/services/gardens/" title="Gardens">Gardens</a></li>
            <li><a href="/services/hardscapes/" title="Hardscapes">Hardscapes</a></li>
            <li><a href="/services/landscape-lighting/" title="Landscape Lighting">Landscape Lighting</a></li>       
            <li class="last"><a href="/services/water-features/" title="Water Featuress">Water Features</a></li>
          
           
            </ul>
            
            <div class="clear"></div>  
            
            </div>
    
    
    </div>



        
<?php get_footer() ?>

