<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div class="top_img"></div><!--top_img--->
			<div class="middle_img">
			<div class="sliding_img">			
			<?php 
				$args = array(
				   'post_type' => 'attachment',
				   'numberposts' => -1,
				   'post_status' => null,
				   'post_parent' => $post->ID
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
				<?php } ?>	
					
			</div><!--sliding_image-->
				</div>
	
			</div></div>
				<div class="bottom_img"></div>			
			<div id="conten" role="main">
	<div class="sub2" style="width:100%"><?php the_title(); ?></div>
				<?php the_post(); ?>
					<!--<img style="margin:8px;padding:0px;"src="<?php bloginfo( 'template_url' )?>/images/cntact-us-txt.png" width="112" height="23"/>-->
				<?php get_template_part( 'content', 'page' ); ?>

				<?php //comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_footer(); ?>
