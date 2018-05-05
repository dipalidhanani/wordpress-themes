<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$aitThemeCustomTypes = array('grid-portfoliob' => 33, 'service-box' => 34, 'testimonial' => 35,  'team' => 36, 'faq' => 37);
$aitThemeWidgets = array('post','flickr','submenu','twitter', 'faq', 'person');
$aitEditorShortcodes = array('custom','columns','images','posts','buttons','boxesFrames','lists','notifications','modal','social','video','gMaps','gChart','language','tabs','gridgalleryb','econtent', 'teams');
$aitThemeShortcodes = array('boxesFrames' => 2,'buttons' => 1,'columns'=> 1,'custom'=> 1,'images'=> 1,'lists'=> 1,'modal'=> 1,'notifications'=> 1,'posts'=> 1,'sitemap'=> 1,'social'=> 1,'video'=> 1,'language'=> 1,'gMaps'=> 1,'gChart'=> 1,'tabs'=> 1,'gridgalleryb'=> 1,'econtent' => 1, 'teams' => 1);

require dirname(__FILE__) . '/AIT/ait-bootstrap.php';

$pageOptions = array(
	'sections-order' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_sections_order',
		'title' => __('Sections order for this page', 'ait'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/sections-order.neon'
	)),
	'slider' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_lider',
		'title' => __('Options for slider', 'ait'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/slider.neon'
	)),
	'service-boxes' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_service_boxes',
		'title' => __('Options for service boxes', 'ait'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/service-boxes.neon'
	)),
	'testimonials' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_testimonials',
		'title' => __('Options for testimonials', 'ait'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/testimonials.neon'
	)),
	'content' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_content',
		'title' => __('Options for content', 'ait'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/content.neon'
	)),
);

function aitEnqueueScriptsAndStyles(){
	if (!is_admin()) {
		wp_enqueue_script( 'JS_general_script', THEME_JS_URL . '/script.js',  array('jquery') ); 						// General script
		wp_enqueue_script( 'JS_gridgallery', THEME_JS_URL . '/gridgallery.js',  array('jquery') ); 						// Gridgallery

		wp_enqueue_script( 'JS_plugins', THEME_JS_URL . '/libs/jquery-plugins.js',  array('jquery') ); 	// Easing script
		wp_enqueue_script( 'JS_modernizr', THEME_JS_URL . '/libs/modernizr-2.6.1-custom.js',  array('jquery') ); 			// HoverZoom script
		wp_enqueue_script( 'JS_infield', THEME_JS_URL . '/libs/jquery.infieldlabel.js',  array('jquery') ); 			// HoverZoom script
		//wp_enqueue_script( 'JS_gmap_script', THEME_JS_URL . '/libs/jquery.gmap.min.js',  array('jquery') ); 			// Gmap script
		wp_enqueue_script( 'JS_imgSwitch', THEME_JS_URL . '/libs/jquery.ImageSwitch.yui.js',  array('jquery') ); 	// Easing script
		//wp_enqueue_script( 'JS_infieldlabel_script', THEME_JS_URL . '/libs/jquery.infieldlabel.js',  array('jquery') ); // InfieldLabel script
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );

		wp_enqueue_style( 'CSS_comments_style', THEME_CSS_URL . '/colorbox.css' );										// Colorbox style
		wp_enqueue_style( 'CSS_comments_style', THEME_CSS_URL . '/comments.css' );										// Comments style
		wp_enqueue_style( 'CSS_contact_style', THEME_CSS_URL . '/contact.css' );										// Contact Form style
		wp_enqueue_style( 'CSS_hoverzoom_style', THEME_CSS_URL . '/hoverZoom.css' ); 									// HoverZoom style
		wp_enqueue_style( 'CSS_sociable_style', THEME_CSS_URL . '/prettySociable.css' ); 								// PrettySociable style
		wp_enqueue_style( 'CSSjqui_style', THEME_CSS_URL . '/jquery-ui-1.9.2.custom.css' ); 								// jQuery UI style
		wp_enqueue_style( 'CSS_fancybox_style', THEME_CSS_URL . '/fancybox/jquery.fancybox-1.3.4.css' ); 								// Fancybox style
	}
}
add_action('wp_enqueue_scripts', 'aitEnqueueScriptsAndStyles');

function aitThemeSetup(){
	load_theme_textdomain('ait', get_template_directory() . '/languages');
	add_editor_style();
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

	register_nav_menu('primary-menu', __('Primary Menu', 'ait'));
	register_nav_menu('footer-menu', __('Footer Menu', 'ait'));
}
add_action('after_setup_theme', 'aitThemeSetup');


aitAddPlugins(array(
	array(
		'name'     => 'Contact Form 7',
		'slug'     => 'contact-form-7',
		'required' => false, // only recommended
	),
	array(
		'name'     => 'Revolution Slider',
		'slug'     => 'revslider',
		'required' => false,
		'source'   => dirname(__FILE__) . '/plugins/revslider.zip', // pre-packed
	),
));


function aitWidgetsInit(){
	// Footer Widgets
	register_sidebar(array(
		'name' => __('ANNOUNCEMENTS', 'ait'),
		'id' => 'announcement-widgets',
		'description' => __('', 'ait'),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => __('Footer Widgets Area', 'ait'),
		'id' => 'footer-widgets',
		'description' => __('', 'ait'),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	// Homepage Widgets
	register_sidebar(array(
		'name' => __('Homepage Widgets Area', 'ait'),
		'id' => 'homepage-sidebar',
		'description' => __('', 'ait'),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	// Subpages Widgets
	register_sidebar(array(
		'name' => __('Subpages Widgets Area', 'ait'),
		'id' => 'subpages-sidebar',
		'description' => __('', 'ait'),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	// Blog Widgets
	register_sidebar(array(
		'name' => __('Blog Widgets Area', 'ait'),
		'id' => 'blog-sidebar',
		'description' => __('', 'ait'),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	// Post Widgets
	register_sidebar(array(
		'name' => __('Post Widgets Area', 'ait'),
		'id' => 'post-sidebar',
		'description' => __('', 'ait'),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
add_action('widgets_init', 'aitWidgetsInit');

function default_menu() {
	wp_nav_menu(array('menu' => 'Main Menu', 'fallback_cb' => 'default_page_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu clear'));
}
function default_page_menu() {
	echo '<nav class="mainmenu">';
	wp_page_menu(array('menu_class' => 'menu clear'));
	echo '</nav>';
}
function default_footer_menu(){
	wp_nav_menu(array('menu' => 'Main Menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1));
}

remove_action('wp_head', 'wp_generator');
add_filter('widget_title', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');

if ( ! isset( $content_width ) )
	$content_width = 1000;


if(isset($revSliderVersion)){
	// Some custom styles for slides in Revolution Slider admin
	function aitRevSliderAdminStyles(){ wp_enqueue_style('ait-revolution-slider-admin-css', THEME_URL . '/design/admin-plugins/revslider.css'); }
	function aitRevSliderAdminScripts(){ wp_enqueue_script('ait-revolution-slider-admin-js', THEME_URL . '/design/admin-plugins/revslider.js'); }

	add_action('admin_print_styles', 'aitRevSliderAdminStyles');
	add_action('admin_print_scripts', 'aitRevSliderAdminScripts');
}

function custom_fix_blog_tab_on_cpt($classes,$item,$args) {
    if(!is_singular('post') && !is_category() && !is_tag()) {
        $blog_page_id = intval(get_option('page_for_posts'));
        if($blog_page_id != 0) {
            if($item->object_id == $blog_page_id) {
                unset($classes[array_search('current_page_parent',$classes)]);
            }
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class','custom_fix_blog_tab_on_cpt',10,3);