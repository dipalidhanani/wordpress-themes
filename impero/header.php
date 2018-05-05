<?php global $color_theme, $current_user, $actual_font, $shortname  ?>
<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
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
<!--<meta name="viewport" content="width=device-width">-->
<meta name="viewport" content="width=1170">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );
	
	// Add description, if is home
	if ( is_home() || is_front_page() )
		echo ' | ' . get_bloginfo( 'description' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'yiw' ), max( $paged, $page ) );

	?></title>
	
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style_main.css" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        
        <?php if ( yiw_get_option( 'responsive', 1 ) ) : ?>
            <link rel="stylesheet" type="text/css" media="screen and (max-width: 960px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen960.css" />
            <link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen600.css" />
            <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen480.css" />
	<?php endif; ?>
    
    <?php
		// styles 
        wp_enqueue_style( 'prettyPhoto',        get_template_directory_uri()."/css/prettyPhoto.css" );  
	wp_enqueue_style( 'Droid-google-font',  'http://fonts.googleapis.com/css?family=Droid+Sans' );  
        wp_enqueue_style( 'Yanone-google-font',  'http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,400' );      
                                             
		// scripts 
        wp_enqueue_script( 'jquery-easing',      get_template_directory_uri()."/js/jquery.easing.1.3.js", array('jquery'), "1.3");
        wp_enqueue_script( 'jquery-prettyPhoto', get_template_directory_uri()."/js/jquery.prettyPhoto.js", array('jquery'), "3.0");
        wp_enqueue_script( 'jquery-tipsy',       get_template_directory_uri()."/js/jquery.tipsy.js", array('jquery'));  
        wp_enqueue_script( 'jquery-tweetable',   get_template_directory_uri()."/js/jquery.tweetable.js", array('jquery'));           
        wp_enqueue_script( 'jquery-cycle',  get_template_directory_uri()."/js/jquery.cycle.min.js", array('jquery'));      
        
        // slider libraries
		//if ( ( is_home() || is_front_page() ) ) :



            if( !in_array( ($slider_type = yiw_get_option( 'slider_type' )), array('none','fixed-image')) ) {

                wp_enqueue_style( 'slider-' . $slider_type,        get_template_directory_uri()."/css/slider-". $slider_type .".css" );  
                
                // elegant
                //if ( $slider_type == 'elegant' ) :  
                //    wp_enqueue_script( 'jquery-cycle',  get_template_directory_uri()."/js/jquery.cycle.min.js", array('jquery'));       
                //endif;
            
                // cycle
                if ( $slider_type == 'cycle' ) : 
                //    wp_enqueue_script( 'jquery-cycle',  get_template_directory_uri()."/js/jquery.cycle.min.js", array('jquery'));       
                    wp_enqueue_script('swfobject');   
                endif;
            
                // cycle
                if ( $slider_type == 'nivo' ) :
                    wp_enqueue_script( 'jquery-nivo',        get_template_directory_uri()."/js/jquery.nivo.slider.pack.js", array('jquery') ); 
                endif;
                
                // carousel
                //if ( $slider_type == 'carousel' ) :  
                //    wp_enqueue_script( 'jquery-carousel',        get_template_directory_uri()."/js/jquery.jcarousel.min.js", array('jquery') ); 
                //endif;
                
                // elastic
		if ( $slider_type == 'elastic' ) {                                                                                       
                    wp_enqueue_style( 'Playfair', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' ); 
                    wp_enqueue_script( 'jquery-elastic', get_template_directory_uri()."/js/jquery.eislideshow.js", array('jquery'), '1.0' );   
                }
                
			}
		//endif;
		
       
        //css / scripts for singular templates
        if( is_page_template('gallery.php') || ( is_page_template('portfolio.php') && yiw_get_option('portfolio_type') == 'filterable' ) ) {
            wp_enqueue_script( 'jquery-quicksand',  get_template_directory_uri()."/js/jquery.quicksand.js", array('jquery'));
        }
		 
        // custom
        wp_enqueue_script( 'jquery-carousel',    get_template_directory_uri()."/js/jquery.jcarousel.min.js", array('jquery') ); 
        wp_enqueue_script( 'jquery-custom',      get_template_directory_uri()."/js/jquery.custom.js", array('jquery', 'jquery-ui-tabs'), '1.0', true); 
                                                                                
	    //if( yiw_get_option( 'font_type' ) == 'cufon' )
        //{                      
	        //wp_enqueue_script('cufon', get_template_directory_uri()."/js/cufon-yui.js");                   
            //wp_enqueue_script('cufon-halo', get_template_directory_uri()."/js/halo.cufon.js");   
	        //wp_enqueue_script('cufon-' . $actual_font, get_template_directory_uri()."/fonts/{$actual_font}.font.js");   
		//}    
		                   
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
                
                $body_class = '';
                if ( ( yiw_get_option( 'responsive', 1 ) && ! $GLOBALS['is_IE'] ) || ( yiw_get_option( 'responsive', 1 ) && yiw_ieversion() >= 9 ) )   
                    $body_class = ' responsive';     

    ?>         

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php yiw_favicon(); ?>" />
    <link rel="icon" type="image/x-icon" href="<?php yiw_favicon(); ?>" />
    <!-- [favicon] end --> 
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/socialnetworkingicons-regul.css" />
     
    <!--[if IE]>
    <link rel='stylesheet' href='<?php echo get_template_directory_uri()."/css/style_ie.css" ?>' type='text/css' media='all' />
    <![endif]-->    
    <?php wp_head() ?>

<meta name="geo.region" content="US-CA" />
<meta name="geo.placename" content="Thousand Oaks" />
<meta name="geo.position" content="34.175487;-118.90073" />
<meta name="ICBM" content="34.175487, -118.90073" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40578145-1', 'genesispoolinc.com');
  ga('send', 'pageview');

</script>

   <meta name="google-site-verification" content="7yP_Cqjnxu7fjNpdlgTm2OBsm-0Uq3YYF_xHVjXww7g" /></head>

<body <?php body_class( "no_js" . $body_class) ?>>  

<div class="container">

 <div class="leftbar">
    <div class="logo">
	
	            <br>  <?php if( yiw_get_option( 'use_logo' ) ): ?>
    	            <a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>"> 
    	                <?php $logo = yiw_get_option( 'logo' ) ? yiw_get_option( 'logo' ) : get_template_directory_uri() . '/images/logo.png'; ?>
    	                <img src="<?php echo $logo  ?>" alt="Logo <?php bloginfo('name') ?>" <?php if(yiw_get_option('logo_width')): ?>width="<?php echo yiw_get_option('logo_width') ?>"<?php endif ?> <?php if(yiw_get_option('logo_height')): ?>height="<?php echo yiw_get_option('logo_height') ?>"<?php endif ?> />
    	            </a>
	            <?php else: ?>
    	            <h1><a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>"><?php bloginfo() ?></a></h1>
    	            <h2><?php bloginfo('description') ?></h2>
	            <?php endif ?>
	       
	</div>
   

 <?php /*?> <div id="nav" class="group">
	       <?php  
					$nav_args = array(
	                    'theme_location' => 'nav',
	                    'container' => 'none',
	                    'menu_class' => 'level-1',
	                    'depth' => 3,   
	                    //'fallback_fb' => false,
	                    //'walker' => new description_walker()
	                );
	                
	                wp_nav_menu( $nav_args ); 
	            ?>    
	        </div><?php */?>


<!--<li><a href="#" onClick="window.open('http://www.houzz.com/pro/salmonfallsnurseryandlandscaping');"><img src="<?php bloginfo('template_directory'); ?>/images/ha-icon1.png"></a></li>
<li><a onClick="window.open('https://www.facebook.com/salmonfallsnurserylandscaping');" href="#"><img src="<?php bloginfo('template_directory'); ?>/images/fb-icon.png"></a></li>
<li><a onClick="window.open('https://plus.google.com/117679288784781061170/posts');" href="#"><img src="<?php bloginfo('template_directory'); ?>/images/gp-icon.png"></a></li>
<li><a onClick="window.open('https://twitter.com/SalmonFallsNL');" href="#"><img src="<?php bloginfo('template_directory'); ?>/images/tw-icon.png"></a></li>
<li><a href="mailto:info@salmonfallsnursery.com"><img src="<?php bloginfo('template_directory'); ?>/images/email-icon.png"></a></li>-->


	    
        <!-- SLIDER -->
        <?php  //get_template_part( 'slider' ); ?>
        <?php //get_template_part( 'slider','CYCLE' ); ?>
        <!-- /SLIDER -->


