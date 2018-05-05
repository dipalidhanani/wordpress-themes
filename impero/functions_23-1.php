<?php
/**
 * @package WordPress
 * @subpackage YIW Themes
 * 
 * Here the first hentry of theme, when all theme will be loaded.
 * On new update of theme, you can not replace this file.
 * You will write here all your custom functions, they remain after upgrade.
 */                                                                               

// include all framework
require_once dirname(__FILE__) . '/core/core.php';

/*-----------------------------------------------------------------------------------*/
/* End Theme Load Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/         

function js_in_head(){
 
{?>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/js/slider.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery_002.js"></script>
<script type="text/javascript">
var $ = jQuery.noConflict();

	$(document).ready(function(){
		/* homepage slideshow */
		$('#slider').cycle({
			timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
			fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pager:   '#pager',  // selector for element to use as pager container
			next:   '#next-slider',  // selector for element to use as click trigger for next slide
			prev:  '#prev-slider',  // selector for element to use as click trigger for previous slide
			pause:   0,	  // true to enable "pause on hover"
			cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
			pauseOnPagerHover: 0 // true to pause when hovering over pager link
		});
	
		/* widget slideshow */
		$('.boxslideshow').cycle({
			timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
			fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pause:   0,	  // true to enable "pause on hover"
			next:".next",  // selector for element to use as click trigger for next slide 
			prev:".prev",  // selector for element to use as click trigger for previous slide 
			cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
			pauseOnPagerHover: 0 // true to pause when hovering over pager link
		});
		
		$('.boxslideshow2').cycle({
			timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
			fx:      'scrollVert', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pause:   0,	  // true to enable "pause on hover"
			next:".next",  // selector for element to use as click trigger for next slide 
			prev:".prev",  // selector for element to use as click trigger for previous slide 
			cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
			pauseOnPagerHover: 0 // true to pause when hovering over pager link
	});
	
});

</script>



<?php }} 
add_action('wp_head', 'js_in_head');

function wpt_slider_posttype() {
	register_post_type( 'slider',
		array(
			'labels' => array(
			'name' => __( 'Slider' ),
			'singular_name' => __( 'Slider' ),
			'add_new' => __( 'Add New Slider' ),
			'add_new_item' => __( 'Add New Slider' ),
			'edit_item' => __( 'Edit Slider' ),
			'new_item' => __( 'Add New Slider' ),
			'view_item' => __( 'View Slider' ),
			'search_items' => __( 'Search Slider' ),
			'not_found' => __( 'No slider found' )
			
		),
		'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'capability_type' => 'post',
		'rewrite' => array("slug" => "slider"), // Permalinks format
		'menu_position' => 5,
		'register_meta_box_cb' => 'add_dishes_metaboxes'
		)
	);
	//register_taxonomy( 'dishescategory', 'slider', array( 'hierarchical' => true, 'label' => __('dishes Category') ) );
}
add_action( 'init', 'wpt_slider_posttype' );
function childtheme_content($content) 
{
	if ( is_home () ) {
		$content= 'excerpt';}
	return $content;
}
add_filter('thematic_content', 'childtheme_content');
?>