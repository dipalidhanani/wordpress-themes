<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Home
*/



if( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || is_home() && get_option( 'page_for_posts' ) != '0' ) {
    $blog_type = yiw_get_option('blog_type');
    get_template_part( 'blog' ); 
    die;
}

get_header() ?>  
<div id="header-slider">
  <ul style="position: relative; width: 960px; height: 389px;" id="slider">
  
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
  
  </ul>
 
   <div class="ad_section">
			    <ul class="">
                
                
               <?php /*?> <?php
					$thumbnails = get_posts('numberposts=3&category=27&orderby=rand');
					foreach ($thumbnails as $thumbnail) {
					if ( has_post_thumbnail($thumbnail->ID)) {?>
						<li>
					<? echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
					echo get_the_post_thumbnail($thumbnail->ID, 'thumbnail');
					echo '</a>';?></li>
					<? }
					}
					?><?php */?>
                   
					<?php
					 	 
						 global $post;
						 $myposts = get_posts('numberposts=3&category=60&orderby=rand');
						 foreach($myposts as $post) :
						 setup_postdata($post);
						 
					 ?>
						 
                         
 					<?php 
  										$myExcerpt = get_the_excerpt();
										  $tags = array("<p>", "</p>");
										  $myExcerpt = str_replace($tags, "", $myExcerpt);
																					?>
                         
                         	             <li><a href="<?php  echo $myExcerpt; ?>" target="_blank"><?php echo the_post_thumbnail(); ?></a></li>
											<?php endforeach; ?> 			
							   <?php /*?><li><a href="#"><?php echo the_post_thumbnail(); ?></a></li>
                               <li><a href="#"><?php echo the_post_thumbnail(); ?></a></li><?php */?>
                                
                               </ul>
                            
 
                     </div>
 
  <div id="slider-navigation">
    <div id="pager"></div>
    <a href="#" id="prev-slider"></a> <a href="#" id="next-slider"></a> </div>
</div>



        <div class="layout-<?php echo $layout_page_type = yiw_layout_page() ?>">

            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>

            <div id="slogan">

                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        
            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php 
                    if ( is_home() )
                        get_template_part( 'loop', 'index' ); 
                    else
                        get_template_part( 'loop', 'page' ); 
                ?>
                
                <!-- services -->
                <div class="home_page_items home_page_services group">
    <h3>Services</h3>
    <h4></h4>
    
                            <div class="home_page_item home_page_item_service home_page_item_service_914 home_page_item_first">
            <a href="/services/design/" title="design"><img width="168" height="137" src="/wp-content/uploads/2013/11/design.jpg" class="picture wp-post-image" alt="design" title="design" /></a>
            <h5><a href="/services/design/" title="design">Design</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_1205 ">
            <a href="/services/build/" title="bulid"><img width="168" height="137" src="/wp-content/uploads/2014/01/Build-Thumbnail.jpg" class="picture wp-post-image" alt="bulid" title="bulid" /></a>
            <h5><a href="/services/bulid/" title="Spas">Build</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_902 home_page_item_last">
            <a href="/nursery/" title="ournursery"><img width="168" height="137" src="/wp-content/uploads/2013/11/nursery.jpg" class="picture wp-post-image" alt="ournursery" title="ournursery" /></a>
            <h5><a href="/service/ournursery/" title="ournursery">Our Nursery</a></h5>
                        
                    </div>
                            <div class="clear"></div>    
<div class="home_page_item home_page_item_service home_page_item_service_910 home_page_item_first">
            <a href="/services/gardens/" title="gardens"><img width="168" height="137" src="/wp-content/uploads/2013/11/soft.jpg" class="picture wp-post-image" alt="gardens" title="gardens" /></a>
            <h5><a href="/services/gardens/" title="Irrigation">Gardens</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_1206 ">
            <a href="/services/hardscapes/" title="Remodeling"><img width="168" height="137" src="/wp-content/uploads/2013/11/hard.jpg" class="picture wp-post-image" alt="hardscapes" title="hardscapes" /></a>
            <h5><a href="/services/hardscapes/" title="Remodeling">Hardscapes</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_906 home_page_item_last">
            <a href="/services/maintenance/" title="Decks"><img width="168" height="137" src="/wp-content/uploads/2013/11/maint.jpg" class="picture wp-post-image" alt="maintenance" title="maintenance" /></a>
            <h5><a href="/services/maintenance/" title="Decks">Maintenance</a></h5>
                        
                    </div>
               <div class="clear"></div>                
<div class="home_page_item home_page_item_service home_page_item_service_910 home_page_item_first">
               <a href="/services/irrigation/" title="irrigation"><img width="168" height="137" src="/wp-content/uploads/2014/01/IRRIGATION-THUMB.jpg" class="picture wp-post-image" alt="irrigation" title="irrigation" /></a>
            <h5><a href="/services/irrigation/" title="Irrigation">Irrigation</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_1206 ">
            <a href="/services/water-features/" title="Remodeling"><img width="168" height="137" src="/wp-content/uploads/2014/01/WATERFEATURES-THUMB.jpg" class="picture wp-post-image" alt="water-features" title="water-features" /></a>
            <h5><a href="/services/water-features/" title="water-features">Water Features</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_906 home_page_item_last">
            <a href="/services/landscape-lighting/" title="Decks"><img width="168" height="137" src="/wp-content/uploads/2014/01/LANDSCAPELIGHT-THUMB.jpg" class="picture wp-post-image" alt="landscape-lighting" title="landscape-lighting" /></a>
            <h5><a href="/services/landscape-lighting/" title="landscape-lighting">Landscape Lightning</a></h5>
                        
                    </div>
                                 <div class="home_page_item home_page_item_service home_page_item_service_900 home_page_item_first">
            <a href="/why-choose-sfnl/our-philosophy/" title="ourphilosophy"><img width="168" height="137" src="/wp-content/uploads/2013/11/philo.jpg" class="picture wp-post-image" alt="ourphilosophy" title="ourphilosophy" /></a>
            <h5><a href="/why-choose-sfnl/our-philosophy/" title="ourphilosophy">Our Philosophy
</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_904 ">
            <a href="/going-green/" title="Fireplaces"><img width="168" height="137" src="/wp-content/uploads/2014/01/GOINGGREEN-THUMBNAIL.jpg" class="picture wp-post-image" alt="goinggreen" title="goinggreen" /></a>
            <h5><a href="/going-green/" title="goinggreen">Going Green</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_896 home_page_item_last">
            <a href="/service/cultivatingcommunity/" title="cultivatingcommunity"><img width="168" height="137" src="/wp-content/uploads/2014/01/CULTIVATING-THUMBNAIL.jpg" class="picture wp-post-image" alt="cultivatingcommunity" title="cultivatingcommunity" /></a>
            <h5><a href="/service/cultivatingcommunity/" title="cultivatingcommunity">Cultivating Community
</a></h5>
                        
                    </div>
                  
     
</div>
               

            </div>
            <!-- END CONTENT -->
            
           
         <!-- START LATEST NEWS -->
            <?php get_sidebar() ?>
            <!-- END LATEST NEWS -->   
        </div>      
        
<?php get_footer() ?>

