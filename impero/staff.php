<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
/*
Template Name: Staff Template
*/

get_header() ;


?>           
        

  	<?php 
	  get_sidebar(); 
	  global $post;
	  $val=get_post_meta($post->ID,'page_banner', true);
	  ?>  

  </div>
   <div class="rightbar">

     <div class="banner"><img src="<?php echo $val ?>" /></div>
	  
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
			<?php $title = is_null( the_title( '', '', false ) ) ? __( '(this post has no title)', 'yiw' ) : the_title( '', '', false ); ?>
			
			 <?php if ( is_single() ) : ?>
                                           <div class="bannerlinks1"><div class="head1"><?php echo $title ?></div></div>
                                        <?php else : ?>
                                           <div class="bannerlinks1">
                                           <div class="head1">
										  
										   <?php echo $title ?>
                                           </div></div>
                                        <?php endif; ?>
        
            <?php 
                global $paged, $blog_type; 
                
               // if( !$blog_type) $blog_type = yiw_get_option('blog_type');
				
				

            ?>
         
		  <?php  query_posts( array( 'post_type' => 'bl_staff', 'paged' => $paged ) ); ?>
		<?php   /*query_posts( array( 'post_type' => array('post', 'staff') ) ); */?>
	
            
                <?php //get_template_part('loop', 'index') ?>
				<div id="post-2239" class="para">
				<div class="cont para">
				<?php while (have_posts()) : the_post(); ?>
				<?php
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
					$url = $thumb['0'];
					?>
					 
					
					<div class="staff"><img class="alignleft size-full wp-image-2355" alt="mark" src="<?php echo $url; ?>" width="200" height="200" /></div>
					<div class="staff_name"><strong><?php the_title(); ?></strong><br>
					<a href="mailto:<?php echo get_post_meta( $post->ID, 'email', true ); ?>"><?php echo get_post_meta( $post->ID, 'email', true ); ?></a></div>
					<div class="staff_name"></div>
					<div class="staff_name"><?php the_content(); ?></div>
					<div class="clear"></div>
					<hr>
					<p>&nbsp;</p>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
            </div>
            
            <!-- START LATEST NEWS -->
            <?php //get_sidebar('blog') ?>
            <!-- END LATEST NEWS -->   
        
    
         </div>   
        
<?php get_footer() ?>
