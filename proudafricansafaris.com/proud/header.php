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
<script src="<?php bloginfo( 'template_url' )?>/font/cufon-yui.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' )?>/font/P22_Corinthia_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
			Cufon.replace('.sub1'); // Requires a selector engine for IE 6-7, see above
			Cufon.replace('.sub2'); 
			Cufon.replace('.sub3'); 
			Cufon.replace('.sub4');
			Cufon.replace('.sub5');  	
			Cufon.replace('.sub6'); 
			Cufon.replace('.sub7'); 
			Cufon.replace('.widget-title'); 		
</script>
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
			slideshow: true,
			slideshowSpeed: 7000,
			animationDuration: 600,   
			controlsContainer: ".flex-container"
		  });
	});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9063337-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
<div id="page" class="hfeed">

	<header id="branding" role="banner">
			<hgroup><div class="both_top_outer">
				<a href="/"><h1 id="site-title"></h1></a>
				<div id="toPopup" style="display:none">
                    <div class="close"></div>
                    <!--<div class="heade-img"><img src="http://proudafricansafaris.com/wp-content/uploads/lastminnutesafari.png" ></div>-->
                    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
                    <div id="popup_content"> <!--your content start-->
                    	<?php $options = twentyeleven_get_theme_options(); echo $options['popup_content'];?>
                    </div> <!--your content end-->
            
                </div> <!--toPopup end-->
                <div class="loader"></div>
   				<div id="backgroundPopup"></div>
    
                <div class="call_img open_div">
     			<div class="top-txt"><h2>EBOLA: Our Safaris are in East Africa</h2><h3>Join us with a piece of mind.  Learn more</h3></div>
                </div><!--call_img-->
				
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

