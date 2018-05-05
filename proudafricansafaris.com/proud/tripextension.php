<?php
/**
 * Template Name:tripextension
  *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
?>
<?php get_header(); ?>
		<div id="primary">
			<div class="top_img"></div><!--top_img--->
			<div class="middle_img">
			<div class="sliding_image">			
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
				<div class="bottom_img"></div>
			<div id="tripexten_content" role="main">
<div id="left_nav">
<div class="contact_top_curve"></div>
<div class="contact_middle_curve">
<?php
  if($post->post_parent) {
  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
  $titlenamer = get_the_title($post->post_parent);
  }
  else {
  $children = wp_list_pages('child_of='.$post->post_parent.'&title_li=&sort_column=menu_order');
  $titlenamer = get_the_title($post->ID);
  }
  if ($children) { ?>


  <ul class="sub2 sub20">
  <?php echo $children; ?>
  </ul>
<?php } ?>
<br/>
</div>
<div class="contact_bottom_curve"></div>
</div><!--leftside-->
				<div id="right_contnt">
				<a class="sub2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php the_post();?>
				<?php get_template_part( 'content', 'page' ); ?>

				<?php //comments_template( '', true ); ?>
		
				<div><!--right_content-->
			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_footer(); ?>
</body>
</html>
