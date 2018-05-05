<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
	<div class="top_img"></div><!--top_img--->
	<div class="middle_img">
	<div class="sliding_image"><?php 
				$args = array(
				   'post_type' => 'attachment',
				   'numberposts' => -1,
				   'post_status' => null,
				   'post_parent' => $post->ID,
				   'exclude'     => get_post_thumbnail_id()
				);

				$attachments = get_posts( $args );
				if ( $attachments ) { ?>
					<div class="flex-container">
					<div class="flexslider">
		 				<ul class="slides">			
						   <?php  
							foreach ( $attachments as $attachment ) {							
								$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'large');
								echo '<li><a href="'.$image_attributes[0].'">';
								//echo wp_get_attachment_image( $attachment->ID, 'large' );
								echo '<img src="'.$image_attributes[0].'" alt="">';
								echo '</a></li>';
							  }
						    ?>
						</ul>
					 </div>
					 </div>	
				<?php } ?></div></div>
			<div class="bottom_img"></div>
	
			<div id="single_dest_content" role="main">
<div id="left_nav">
<div class="contact_top_curve"></div>
<div class="contact_middle_curve">
<ul class="sub2 sub20">
				<?php
					$queryObject = new WP_Query(array('post_type' => 'dest','order' => ASC));
						// The Loop...
						if ($queryObject->have_posts()) {
					
						while( $queryObject->have_posts() ) : $queryObject->the_post();

													?>
						<li class="pro_cat <?php echo $categories; ?>"> 
						<div><a class="sub5" href="<?php the_permalink(); ?>"><?php the_title();?></a>
						
						</div><!--blog-title-->			
						</li>
						<?php
							endwhile;
						}
						wp_reset_postdata();
						wp_reset_query();
						?>
					</ul>
					<br/>
</div>
<div class="contact_bottom_curve"></div>
	</div><!--leftside-->
	<div id="right_contnt">
				<?php while ( have_posts() ) : the_post(); ?>

					<nav id="nav-single">
					
<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						
					</nav><!-- #nav-single -->
	
					<?php get_template_part( 'content', 'single' ); ?>

					<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
		</div><!--right_contnt-->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>

