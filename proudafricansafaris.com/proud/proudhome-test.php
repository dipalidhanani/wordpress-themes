<?php 
/**
 * Template Name:proudhome - Test
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
 get_header();
?>
<a href="tel:+8886296755"><img class="aligncenter size-full wp-image-7303" title="lastminnutesafari" src="http://proudafricansafaris.com/wp-content/uploads/lastminnutesafari.png" alt="" width="946" height="78" /></a>
<div class="slider-box">
	<div class="top_img"></div><!--top_img--->
<div class="middle_img">
		<div class="sliding_images">
			<div class="flex-container">
			<div class="flexslider">
				<ul class="slides">
    				<?php $queryObject = new WP_Query( array ('post_type' => 'homeslider', 'orderby'=> 'menu_order' ) );
					if ($queryObject->have_posts()) {
					while( $queryObject->have_posts() ) : $queryObject->the_post();?>
					<li>
						<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
				    	</li>
					<?php endwhile;
					}
					wp_reset_query(); ?>
		  		  </ul>
			 </div>
			 </div><!---flex-container--->
		</div><!---sliding_images--->
	</div><!--middle_img--->
	<div class="bottom_img"></div><!--bottom_img--->
</div>
	<div class="slider-content">
	<!-- Page Content -->
	<div class="top_img"></div>
		<div class="middle_img">

	    		<?php the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>

		</div>
	<div class="bottom_img"></div><!--bottom_img--->
    </div>
	<!-- Page Content End-->
	
    <?php
	global $post;
	if( $post->ID == 7379 ){
		$home_testimonial_args = array( 'post_type' => 'testimonial', 'posts_per_page' => 1, 'orderby' => 'rand', 'order'=>'DESC');
		$home_testimonial_loop = new WP_Query( $home_testimonial_args );
		while ( $home_testimonial_loop->have_posts() ) : $home_testimonial_loop->the_post();?>	                                                   
			<div class="top_img"></div><!--top_img--->
			<div class="middle_img">
				<div class="sliding_image">						
					<div class="blog_cont">
						<div class="blog-img">
							<a href="<?php the_permalink() ?>" class="thumb"><?php the_post_thumbnail('large', array(
							'alt'        => trim(strip_tags( get_the_title() )),
							'title'        => trim(strip_tags( get_the_title() )),
							)); ?></a>
						</div><!---blog-img--->
						
						<div class="content_right">
							<div class="blog-title"><a class="sub6" href="<?php the_permalink(); ?>"><?php the_title();?></a></div><!--blog-title-->
							<div class="date_color"><?php echo get_the_date(); ?></div><!---date_color--->
							<div class="text_post"><?php the_excerpt('Read More'); ?></div><!--blog-middle-->
						</div><!---content_right--->
					</div><!---blog_cont--->
				</div>
			</div>
			<div class="bottom_img"></div>
	
	<?php 
		endwhile; 
		wp_reset_query();
		wp_reset_postdata();
	}
	?>

	<div class="top_img"></div><!--top_img--->
	<div class="middle_img">
		<div id="main_cat">
			<div id="inner_cat_div">
			<?php
				$hbox1 = get_ID_by_slug('home-2/photography ');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="top"></div>
			<div class="middl"><a href="/gallery"><?php echo get_the_post_thumbnail($hbox1, 'thumbnail'); ?></a></div>
			<div class="second_bottom"><p><?php echo $cnt_box1->post_content; ?>
				<p style="margin:10px 0 0px 17px;text-align:right;">
					<a class="stlye_none" href="/gallery">View Gallery<span></span></a>
				</p>
			</div>
			</div><!--inner_cat_div-->

			<div id="inner_cat_div">
			<?php
				$hbox1 = get_ID_by_slug('home-2/destinations');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="third_top"></div>
			<div class="third_midd"><a href="/tanzania-safaris"><?php echo get_the_post_thumbnail($hbox1, 'thumbnail'); ?></a></div>
			<div class="third_bottom"><p><?php echo $cnt_box1->post_content; ?></p>
				<p style="margin:10px 0 0px 17px;text-align:right;">
					<a class="stlye_none" href="/tanzania-safaris">Learn More<span></span></a>
				</p>
			</div>
			</div><!--inner_cat_div-->
			
			<div id="inner_cat_div">
			<?php
				$hbox1 = get_ID_by_slug('home-2/lodges-camps-2 ');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="forth_top"></div>
			<div class="forth_midd"><a href="/lodgenav/african-safari-lodges-camps"><?php echo get_the_post_thumbnail($hbox1, 'thumbnail'); ?></a></div>
			<div class="forth_bottom"><p><?php echo $cnt_box1->post_content; ?></p>
				<p style="margin:10px 0 0px 17px;text-align:right;"><a class="stlye_none" href="/lodgenav/african-safari-lodges-camps">  View Accommodations<span></span></a></p>
			</div>
			</div><!--inner_cat_div End-->
            
            <div id="inner_cat_div">
				<div class="request_top_img"></div><!--top_img--->
                <div class="request_middle_img">
                    <div class="img_styling">
                        <img src="<?php bloginfo( 'template_url' )?>/images/request-quote.gif" width="170" height="37"/>
                    </div>
                    <div id="request">
                        <?php insert_cform('contact'); ?>
                    </div><!--request-->
                </div>
                <div class="request_bottom_img"></div>
			</div><!--inner_cat_div End-->
		</div><!-- main_cat End -->
	</div><!-- middle_img End-->
	<div class="bottom_img"></div>


	<div id="various_bottom_div">
		<div class="main_requst">
			<div class="request_top_img"></div><!--top_img--->
			<div class="request_middle_img">
				<div class="img_styling">
					<img src="<?php bloginfo( 'template_url' )?>/images/request-quote.gif" width="170" height="37"/>
				</div>
				<div id="request">
					<?php insert_cform('contact'); ?>
				</div><!--request-->
			</div>
			<div class="request_bottom_img"></div>
		</div><!--main_requst-->

		<div id="contact">
			<?php
				$hbox1 = get_ID_by_slug('home-2/contact');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="contact_top_curve"></div>
			<div class="contact_middle_curve">
				<img src="<?php bloginfo( 'template_url' )?>/images/contact-us-txt.gif" width="113" height="23"/>
				<?php echo get_the_post_thumbnail($hbox1, 'thumbnail'); ?>
				<?php echo $cnt_box1->post_content; ?>
			</div>
			<div class="contact_bottom_curve"></div>
		</div><!--contact-->

		<div id="find">
			<?php
				$hbox1 = get_ID_by_slug('home-2/find');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="contact_top_curve"></div>
			<div class="contact_middle_curve">
				<img src="<?php bloginfo( 'template_url' )?>/images/find-us.gif" width="226" height="25"/>
				<a href="http://www.facebook.com/pages/Proud-African-Safaris/130508140341706" target="blank"><img style="float:left;margin: 8px 9px 0 0;" src="<?php bloginfo( 'template_url' )?>/images/facebook.gif" width="49" height="51"/></a>
	<p><?php echo $cnt_box1->post_content; ?><p style="float:right;"><a class="stlye_none" href="http://www.facebook.com/pages/Proud-African-Safaris/130508140341706" target="blank">Friend Us<span></span></a>
				</p></p>
			</div>
			<div class="contact_bottom_curve"></div>			
		</div><!--find-->

		<div id="safety">
			<?php
				$hbox1 = get_ID_by_slug('home-2/safety');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="safety_top_curve"></div>
			
			<div class="safety_bottom_curve"></div>					
		</div><!--safety-->
	</div><!---various_bottom_div--->
<p style="padding-left: 30px;"></p>
<h1 style="padding-left: 30px;">Welcome to Proud African Safaris</h1>
<p style="padding-left: 30px;"></p>
<p style="padding-left: 30px;">Have you always wanted to view the beautiful flora and fauna of Tanzania? Safaris are one of the easiest ways to see the natural beauty of the African savannah. Take an adventure of a lifetime with Proud African Safari’s Tanzania safaris.</p>
<p style="padding-left: 30px;">All of our Tanzania safaris are run by extremely qualified safari guides that are knowledgeable and ready to help you create an unforgettable adventure.</p>
<p style="padding-left: 30px;">Call our Tanzanian Safaris Specialist to learn more and request a free quote. 800-629-6755</p>


				
<?php get_footer(); ?>