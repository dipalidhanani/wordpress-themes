<?php/**
 * Template Name:proudhome
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
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="<?php bloginfo( 'template_url' )?>/js/jquery-1.7.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' )?>/css/flexslider.css" type="text/css">
<script src="<?php bloginfo( 'template_url' )?>/js/jquery.flexslider-min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!-- Hook up the FlexSlider -->
<script type="text/javascript">
	$(window).load(function() {
		$('.flexslider').flexslider({
		animation: "fade",
		slideshowSpeed: 8900,	
		controlsContainer: ".flex-container"
		});
	});
</script>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
<div id="page" class="hfeed">
	<header id="branding" role="banner">
	<hgroup>
		<div class="both_top_outer">
			<h1 id="site-title"></h1>
			<div class="call_img"></div><!--call_img-->
				
			<!--<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>-->
			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'menu'=>'New Menu','theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
		</div><!--both_top_outer-->
	</hgroup>
	</header><!-- #branding -->
	
	<div id="main">
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

	<!-- Page Content -->
	<div class="top_img"></div>
		<div class="middle_img">

	    		<?php the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>

		</div>
	<div class="bottom_img"></div><!--bottom_img--->
	<!-- Page Content End-->


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
				$hbox1 = get_ID_by_slug('home-2/client-testimonials');
				$cnt_box1 = get_page($hbox1);
			?>
			<div class="second_top"></div>
			<div class="second_midd"><a href="/testimonial"><?php echo get_the_post_thumbnail($hbox1, 'thumbnail'); ?></a></div>
			<div class="second_bottom"><p><?php echo $cnt_box1->post_content; ?></p>
				<p style="margin:10px 0 0px 17px;text-align:right;">
					<a class="stlye_none" href="/testimonial">Learn More<span></span></a>
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
					<? insert_cform('contact'); ?>
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

</div><!-- #content -->
</div><!-- #primary -->

<center><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fproudafricansafaris.com%2F&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>

<p><a href="http://proudafricansafaris.com/privacy-policy" target="_blank">Privacy Policy</a><p><SMALL><strong>*All photos were taken by PAS clients and staff while on safari. PAS would like to recognize <br>
Ms. Sivani Babu of Suntrail Images and Mr. David Hays of Artis.com for their photographic contributions on the home page. </strong><br></SMALL>
2013© Proud African Safaris, LLC  © 12 Greystone Road, Marblehead, MA 01945<br>
Website designed and hosted by <a href="http://www.mayowebdesign.com" target="_blank">www.mayowebdesign.com</a></center></p><center><p><!-- Begin Dun & Bradstreet Credibility Corp. Badge --><script type='text/javascript' src='//www.dandb.com/businessdirectory/badge?id=37359095'; charset='utf-8'></script><!-- End Dun & Bradstreet Credibility Corp. Badge --></center></div>
</body>
</html>
