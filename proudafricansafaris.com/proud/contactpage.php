<?php/**
 * Template Name:contactpage
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
				if ( has_post_thumbnail() )
				{
				?>
				
				<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
				
				<?php
				}
				?></div><!--sliding_image-->
				</div>
				<div class="bottom_img"></div>	
			<div id="contact_content" role="main">
	
				<?php the_post(); ?>
					<img style="margin:23px 0px 30px 0px;padding:0px;"src="<?php bloginfo( 'template_url' )?>/images/contact-us-txt.png" width="112" height="23"/>
				<div class="div_top"></div><!--top_img--->
			<div class="div_middle">
			<div class="sliding_image">	
				<!-- <div class="safety-contact-us"> --->
					<?php get_template_part( 'content', 'page' ); ?>
				<!-- </div> -->

						<div id="safety">
								<div class="safety_top_curve"></div>
								<div class="safety_middle_curve">

								<img style="float: left; margin: 4px 0px 0px; padding: 0px 0px 0px 20px;" src="http://safari.newmayodesigns.com/wp-content/themes/proud/images/safe-cred-txt.gif" alt="" width="198" height="37" />
								<div class="safety_div">Proud Africans Safaris is licensed and incorporated in Tanzania,with insurance through the Tanzania government.
								-Member of the Africa Travel Association (ATA)
								-Member of the Tanzanian Association of Tour Operators (TATO)</div>
								<img style="float: left; margin: 0px 0px 5px 0pt; padding: 0px 0px 0px 20px;" src="http://safari.newmayodesigns.com/wp-content/themes/proud/images/logos.gif" alt="" width="226" height="73" />

								&nbsp;

								</div>
								<div class="safety_bottom_curve"></div>
						</div>


				<div id="find" class="contact-fb">
				<?php
					$hbox1 = get_ID_by_slug('home-2/find');
					$cnt_box1 = get_page($hbox1);
				?>
				<div class="contact_top_curve"></div>
				<div class="contact_middle_curve">
					<img src="<?php bloginfo( 'template_url' )?>/images/find-us.gif" width="226" height="25"/>
					
		<a href="http://www.facebook.com/pages/Proud-African-Safaris/130508140341706" target="blank"><img style="float:left;margin: 8px 9px 0 0;" src="<?php bloginfo( 'template_url' )?>/images/facebook.gif" width="49" height="51"/></a>
	<p><?php echo $cnt_box1->post_content; ?><p style="float:right;"><a class="stlye_none" href="http://www.facebook.com/pages/Proud-African-Safaris/130508140341706" target="blank">Friend Us<span></span></a></p></p></div>
				<div class="contact_bottom_curve"></div>			
			</div><!--find-->

			</div>
				<div class="div_bottom"></div>	
</div>
				<?php //comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_footer(); ?>
</body>
</html>
