<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Theme Actions
 *
 * This is where theme functions are hooked into the appropriate hooks / filters.
 *
 * @since 	1.0.0
 * @author 	WooThemes
 */

// Enqueue Styles
add_action( 'wp_enqueue_scripts', 'woo_child_enqueue', 30 );
add_action( 'wp_enqueue_scripts', 'woo_google_fonts' );

//add_action('sensei_course_single_lessons',   'display_attached_media_new');
//add_action('sensei_lesson_single_meta',  'display_attached_media_new');

/*function wpse_plugins_loaded_course() {
 remove_action( 'sensei_course_single_lessons', 'sensei_course_single_lessons' ); 
	add_action( 'sensei_course_single_lessons', 'new_display_attached_media' );
}
add_action( 'sensei_course_single_lessons', 'wpse_plugins_loaded_course' );*/
// Move things around
add_action( 'init', 'woo_layout_adjust', 10 );

// Navigation / Header wrapper
add_action( 'woo_header_inside', 'woo_navigation_wrapper_start', 5 );
add_action( 'woo_header_inside', 'woo_navigation_wrapper_end', 15 );
// Hero
add_action( 'woo_header_after', 'woo_display_hero', 7 );

// Homepage
add_action( 'homepage', 'woo_display_featured_courses', 10 );
add_action( 'homepage', 'woo_display_testimonials', 20 );
add_action( 'homepage', 'woo_display_recent_posts', 30 );

// Output Custom Fonts
add_action( 'wp_head', 'woo_custom_fonts_output', 999 );

// Sensei overrides
add_filter( 'course_archive_title', 'woo_sensei_remove_featuredcourses_title' );

// Setting overrides
add_filter( 'option_woo_options', 'woo_custom_theme_overrides' );
add_filter( 'woo_get_dynamic_values', 'woo_child_get_dynamic_values' );

// Remove Custom Testimonials Template
add_action( 'init', 'woo_apply_testimonials_tpl', 10 );

// Sensei Special Body Class
add_filter( 'body_class', 'woo_sensei_body_class' );

// Sensei Archives Full Width
add_filter( 'pre_option_woo_layout', 'woo_sensei_archive_full' );

remove_all_filters( array('Sensei_Media_Attachments', 'new_display_attached_media' ), 10);



function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
add_action('login_head', 'login_css');

function my_scripts_method() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/custom_admin_login.js',
		array( 'jquery' )
	);
}

add_action( 'login_head', 'my_scripts_method' );


/** Change Default Text 
*/

add_filter( 'sensei_view_lesson_quiz_text', 'sensei_custom_view_lesson_quiz_text', 10 );

function sensei_custom_view_lesson_quiz_text () {
	$text = "Module Review";
	return $text;
}


/**
 * Child Theme Enqueues
 *
 * Enqueues Custom Fonts and Stylesheet files.
 *
 * @since  	1.0.0
 * @return 	void
 * @author 	WooThemes
 */
function woo_child_enqueue() {
	// Load Theme Stylesheet
	wp_enqueue_style( 'scholar', get_stylesheet_directory_uri() . '/css/scholar.css' );

	// Load JS
	wp_enqueue_script( 'scholar-general', get_stylesheet_directory_uri() . '/js/general.min.js', array( 'jquery' ) );
}


/**
 * Move things around
 *
 * Moves elements from their default location
 *
 * @since  	1.0.0
 * @return 	void
 * @author 	WooThemes
 */
function woo_layout_adjust() {
	// Remove Sidebar from Homepage template
	if ( ! is_page_template( 'template-homepage.php' ) ) {
		remove_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );
	}

	// Replace Main Navigation with a custom version
	remove_action( 'woo_nav_inside', 'woo_add_nav_cart_link', 20);
	remove_action( 'woo_nav_inside','woo_nav_subscribe', 25 );
	remove_action( 'woo_nav_inside','woo_nav_search', 25 );
	remove_action( 'woo_nav_inside', 'woo_nav_sidenav_start', 15 );
	remove_action( 'woo_nav_inside', 'woo_nav_sidenav_end', 30 );
	remove_action( 'woo_header_after', 'woo_nav', 10 );
	add_action( 'woo_header_inside', 'woo_nav', 10 );

	// Unregister Top Menu
	unregister_nav_menu( 'top-menu' );

	// Sensei overrides
	if ( class_exists( 'Sensei_Course_Participants' ) ) {
		remove_action( 'sensei_course_archive_course_title', array( Sensei_Course_Participants()->instance( __FILE__ ), 'display_course_participant_count' ), 15, 1 );
	}
}

/**
 * Navigation Wrapper Start
 * @return void
 * @since  1.0.0
 */
function woo_navigation_wrapper_start() {
?>
	<div class="col-full">
<?php
}

/**
 * Navigation Wrapper End
 * @return void
 * @since  1.0.0
 */
function woo_navigation_wrapper_end() {
?>
	</div>
<?php
}

/**
 * Add Lato Google Font
 * @return string stylesheet
 * @since  1.0.0
 */
function woo_google_fonts() {
	wp_enqueue_style( 'Open Sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,700,600,800' );
}

/**
 * Filter Options
 *
 * Filters the woo_get_dynamic_values function to match the styling of the Child Theme.
 *
 * @since  	1.0.0
 * @return 	void
 * @author 	WooThemes
 */
function woo_child_get_dynamic_values( $settings ) {
	$custom_options = woo_custom_theme_overrides();
	if ( is_array( $custom_options ) &&  0 < count( $custom_options ) ) {
		foreach ( $custom_options as $k => $v ) {
			$k = str_replace( 'woo_', '', $k ); // Make sure we remove the prefix.
			if ( array_key_exists( $k, $settings ) ) {
				$settings[ $k ] = $v;
			}
		}
	}
	return $settings;
}

/**
 * Theme Overrides
 *
 * Updates Theme Options dynamically to match the styling of the Child Theme.
 *
 * @since  	1.0.0
 * @return 	array
 * @author 	WooThemes
 */

function woo_custom_theme_overrides( $options = array() ) {
	$headings 										= 'Open Sans';
	$body 											= 'Open Sans';

	// Global overrides
	$options['woo_header_full_width'] 				= 'true';
	$options['woo_footer_full_width'] 				= 'true';

	if ( ! isset( $options['woo_child_theme_overrides'] ) ) {
		$options['woo_child_theme_overrides'] 		= 'true';
	}

	if ( 'false' != $options['woo_child_theme_overrides'] ) {

		// Disable all styles (DEBUG ONLY!)
		//$options['woo_style_disable'] = 'true';

		// Misc
		$options['woo_font_text'] 					= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#5D5D64' );
		$options['woo_font_h1'] 					= array( 'size' => '2.2', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#333333' );
		$options['woo_font_h2'] 					= array( 'size' => '1.6', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#333333' );
		$options['woo_font_h3'] 					= array( 'size' => '1.3', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#333333' );
		$options['woo_font_h4'] 					= array( 'size' => '1', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#333333' );
		$options['woo_font_h5'] 					= array( 'size' => '.8', 'unit' => 'em', 'face' => $headings, 'style' => '400', 'color' => '#333333' );
		$options['woo_font_h6'] 					= array( 'size' => '.8', 'unit' => 'em', 'face' => $headings, 'style' => '400', 'color' => '#333333' );

		// Top Navigation
		$options['woo_top_nav_font'] 				= array( 'size' => '1.1', 'unit' => 'em', 'face' => $body, 'style' => '700', 'color' => '#bbbbbb' );

		// Header
		$options['woo_font_logo'] 					= array( 'size' => '1.5', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#333333' );
		$options['woo_font_desc'] 					= array( 'size' => '.9', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#cccccc' );
		$options['woo_header_bg'] 					= '#ffffff';
		$options['woo_header_padding_bottom'] 		= '30';
		$options['woo_header_padding_top'] 			= '30';
		$options['woo_header_margin_bottom']		= '50';
		$options['woo_header_border'] 				= array( 'width' => '2', 'style' => 'solid', 'color' => '#eeeeee' );
		$options['woo_header_cart_link']			= 'false';
		$options['woo_header_cart_total']			= 'false';
		$options['woo_nav_rss']						= 'false';
		$options['woo_subscribe_email']				= 'false';
		$options['woo_nav_search']					= 'false';

		// Primary Navigation
		$options['woo_nav_font'] 					= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#ffffff' );
		$options['woo_nav_bg'] 						= '#ffffff';
		$options['woo_nav_hover_bg'] 				= 'transparent';

		// Posts / Pages
		$options['woo_font_post_title'] 			= array( 'size' => '2', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#222222' );
		$options['woo_font_post_meta'] 				= array( 'size' => '.9', 'unit' => 'em', 'face' => $body, 'style' => 'italic', 'color' => '#999999' );
		$options['woo_font_post_text'] 				= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#555555' );
		$options['woo_font_post_more'] 				= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#999999' );
		$options['woo_pagenav_font'] 				= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#888888' );

		// Post Author
		$options['woo_post_author_border_top'] 		= array( 'width' => '2', 'style' => 'solid', 'color' => '#eeeeee' );
		$options['woo_post_author_border_bottom'] 	= array( 'width' => '2', 'style' => 'solid', 'color' => '#eeeeee' );
		$options['woo_post_author_border_lr'] 		= array( 'width' => '2', 'style' => 'solid', 'color' => '#eeeeee' );
		$options['woo_post_author_border_radius'] 	= '5px';
		$options['woo_post_author_bg'] 				= '#ffffff';

		// Archives
		$options['woo_archive_header_font'] 		= array( 'size' => '1.5', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#222222' );

		// Widgets
		$options['woo_widget_font_title'] 			= array( 'size' => '1', 'unit' => 'em', 'face' => $headings, 'style' => '700', 'color' => '#5D5D64' );
		$options['woo_widget_font_text'] 			= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#5D5D64' );
		$options['woo_widget_title_border'] 		= array( 'width' => '1', 'style' => 'solid', 'color' => 'transparent' );

		// Footer
		$options['woo_footer_font'] 				= array( 'size' => '1', 'unit' => 'em', 'face' => $body, 'style' => 'normal', 'color' => '#7f868a' );
		$options['woo_footer_bg'] 					= '#fafafa';

		// Background
		$options['woo_style_bg_image_attach'] 		= 'scroll';
		$options['woo_style_bg_image_repeat'] 		= 'repeat';

		// Full Width
		$options['woo_foot_full_width_widget_bg'] 	= '#fafafa';
		$options['woo_footer_full_width_bg'] 		= '#fafafa';
		$options['woo_footer_border_top'] 			= array( 'width' => '0', 'style' => 'solid', 'color' => '#000000' );

	}

	return $options;
}

/**
 * Add Custom Options
 *
 * Add custom options for this Child Theme.
 *
 * @since  	1.0.0
 * @return 	array
 * @author 	WooThemes
 */
function woo_options_add( $options ) {

	$shortname = 'woo';

	$options[] = array( 'name' 		=> __( 'Scholar', 'woothemes' ),
						'icon' 		=> 'misc',
					    'type' 		=> 'heading' );

	$options[] = array( "name" 		=> __( 'Use Child Theme Custom Overrides', 'woothemes' ),
						"desc" 		=> __( 'Disable this option if you\'d like to setup your own typography and layout settings.', 'woothemes' ),
						"id" 		=> $shortname."_child_theme_overrides",
						"std" 		=> "true",
						"type" 		=> "checkbox" );

	$options[] = array( "name" 		=> __( 'Homepage - Custom Logo', 'woothemes' ),
						"desc"		=> __( 'Upload a logo for your theme, or specify an image URL directly.', 'woothemes' ),
						"id"		=> $shortname."_logo_alt",
						"std"		=> "",
						"type"		=> "upload");

	$options[] = array( "name" 		=> __( 'Hero - Custom Background', 'woothemes' ),
						"desc" 		=> __( 'Upload a background image for your hero section, or specify an image URL directly.', 'woothemes' ),
						"id" 		=> $shortname."_hero_bg",
						"std" 		=> "",
						"type" 		=> "upload" );

	$options[] = array( "name" 		=> __( 'Hero - Title', 'woothemes' ),
						"desc" 		=> __( 'Enter the Hero title.', 'woothemes' ),
						"id" 		=> $shortname."_hero_title",
						"std" 		=> "",
						"type" 		=> "text");

	$options[] = array( "name" 		=> __( 'Hero - Title Font Style', 'woothemes' ),
						"desc" 		=> __( 'Select typography for the hero title.', 'woothemes' ),
						"id" 		=> $shortname."_hero_title_font",
						"std" 		=> array('size' => '2.5','unit' => 'em', 'face' => 'Open Sans', 'style' => 'bold', 'color' => '#fff'),
						"type" 		=> "typography");

	$options[] = array( "name" 		=> __( 'Hero - Message', 'woothemes' ),
						"desc" 		=> __( 'Enter the Hero message.', 'woothemes' ),
						"id" 		=> $shortname."_hero_message",
						"std" 		=> "",
						"type" 		=> "textarea");

	$options[] = array( "name" 		=> __( 'Hero - Message Font Style', 'woothemes' ),
						"desc" 		=> __( 'Select typography for the hero message.', 'woothemes' ),
						"id" 		=> $shortname."_hero_message_font",
						"std" 		=> array('size' => '1.4','unit' => 'em', 'face' => 'Open Sans','style' => 'normal', 'color' => '#fff'),
						"type" 		=> "typography");

	$options[] = array( "name" 		=> __( 'Hero - Enable Courses Search', 'woothemes' ),
						"desc" 		=> __( 'Enable this option if you\'d like a courses search box in your Hero section.', 'woothemes' ),
						"id" 		=> $shortname."_hero_search",
						"std" 		=> "true",
						"type" 		=> "checkbox" );

	$options[] = array( "name" 		=> __( 'Featured Courses - Title', 'woothemes' ),
						"desc" 		=> __( 'Enter the title for the Featured Courses section.', 'woothemes' ),
						"id" 		=> $shortname."_featured_courses_title",
						"std" 		=> "",
						"type" 		=> "text");

	$options[] = array( "name" 		=> __( 'Featured Courses - Byline', 'woothemes' ),
						"desc" 		=> __( 'Enter the byline for the Featured Courses section.', 'woothemes' ),
						"id" 		=> $shortname."_featured_courses_byline",
						"std" 		=> "",
						"type" 		=> "text");

	$options[] = array( "name" 		=> __( 'Testimonials - Title', 'woothemes' ),
						"desc" 		=> __( 'Enter the title for the Testimonials section.', 'woothemes' ),
						"id" 		=> $shortname."_testimonials_title",
						"std" 		=> "",
						"type" 		=> "text");

	$options[] = array( "name" 		=> __( 'Testimonials - Byline', 'woothemes' ),
						"desc" 		=> __( 'Enter the byline for the Testimonials section.', 'woothemes' ),
						"id" 		=> $shortname."_testimonials_byline",
						"std" 		=> "",
						"type" 		=> "text");

	$options[] = array( "name" 		=> __( 'Blog - Title', 'woothemes' ),
						"desc" 		=> __( 'Enter the title for the Blog section.', 'woothemes' ),
						"id" 		=> $shortname."_blog_title",
						"std" 		=> "",
						"type" 		=> "text");

	$options[] = array( "name" 		=> __( 'Blog - Byline', 'woothemes' ),
						"desc" 		=> __( 'Enter the byline for the Blog section.', 'woothemes' ),
						"id" 		=> $shortname."_blog_byline",
						"std" 		=> "",
						"type" 		=> "text");

	return $options;
}

/**
 * Output Custom Fonts
 *
 * Outputs custom typography options for this Child Theme.
 *
 * @since  	1.0.0
 * @return 	array
 * @author 	WooThemes
 */
function woo_custom_fonts_output() {
	global $woo_options;
	$output = '';

	$output .= 'body { font-size: 1.4em; }' . "\n";


	// Header styling
	$header_css = '';

	if ( isset( $woo_options['woo_header_bg'] ) && '' != $woo_options['woo_header_bg'] ) {
		$header_css .= 'background-color:' . $woo_options['woo_header_bg'] . ';';
	}

	if ( isset( $woo_options['woo_header_bg_image'] ) && '' != $woo_options['woo_header_bg_image'] ) {
		$header_css .= 'background-image:url(' . $woo_options['woo_header_bg_image'] . ');';
	}

	if ( isset( $woo_options['woo_header_bg_image_repeat'] ) && '' != $woo_options['woo_header_bg_image_repeat'] ) {
		$header_css .= 'background-repeat:' . $woo_options['woo_header_bg_image_repeat'] . ';background-position:left top;';
	}

	if ( isset( $woo_options['woo_header_margin_top'] ) || '' != $woo_options['woo_header_margin_top'] ) {
		$header_css .= 'margin-top:' . $woo_options['woo_header_margin_top'] . 'px;';
	}

	if ( isset( $woo_options['woo_header_margin_bottom'] ) || '' != $woo_options['woo_header_margin_bottom'] ) {
		$header_css .= 'margin-bottom:' . $woo_options['woo_header_margin_bottom'] . 'px;';
	}

	if ( isset( $woo_options['woo_header_padding_top'] ) || '' != $woo_options['woo_header_padding_top'] ) {
		$header_css .= 'padding-top:' . $woo_options['woo_header_padding_top'] . 'px;';
	}

	if ( isset( $woo_options['woo_header_padding_bottom'] ) || '' != $woo_options['woo_header_padding_bottom'] ) {
		$header_css .= 'padding-bottom:' . $woo_options['woo_header_padding_bottom'] . 'px;';
	}

	if ( isset( $woo_options['woo_header_border'] ) && 0 <= $woo_options['woo_header_border']['width'] ) {
		$header_css .= 'border:' . $woo_options['woo_header_border']['width'] . 'px ' . $woo_options['woo_header_border']['style'] . ' '. $woo_options['woo_header_border']['color'] . ';';
	}

	if ( isset( $woo_options['woo_child_theme_overrides'] ) && 'false' == $woo_options['woo_child_theme_overrides'] ) {
		if ( $header_css != '' ) {
			$output .= '#header.fixed {' . $header_css . '}' . "\n";
		}
	}

	// Make sure the header only outputs a border at the bottom
	$output .= '#header { border-width: 0 0 ' . $woo_options['woo_header_border']['width'] . 'px ' . '0 !important; }';

	// Hero Background Image
	if ( isset( $woo_options['woo_hero_bg'] ) && '' != $woo_options['woo_hero_bg'] ) {
		$output .= '.page-template-template-homepage-php #header-container { background-image: url(' . esc_url( $woo_options['woo_hero_bg'] ) . '); }' . "\n";
	}

	// Hero Custom Fonts
	if ( isset( $woo_options['woo_hero_title_font'] ) ) {
		$output .= '.page-template-template-homepage-php .hero .section-title { ' . woo_generate_font_css( $woo_options['woo_hero_title_font'], 1.2 ) . ' }' . "\n";
	}

	if ( isset( $woo_options['woo_hero_message_font'] ) ) {
		$output .= '.page-template-template-homepage-php .hero p { ' . woo_generate_font_css( $woo_options['woo_hero_message_font'], 1.45 ) . ' }' . "\n";
	}

	if ( isset( $output ) && '' != $output ) {
		$output = "\n<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n<!-- /Woo Custom Styling -->\n\n";
		echo $output;
	}
}

/**
 * Remove Featured Courses title from shortcode in Homepage
 *
 * @since  	1.0.0
 * @return 	string $html
 */
function woo_sensei_remove_featuredcourses_title( $html ) {
	if ( ! class_exists( 'Woothemes_Sensei' ) ) return;
	global $shortcode_override;
	if ( 'featuredcourses' == $shortcode_override && ( is_home() || is_front_page() ) ) {
		$html = '';
	}
	return $html;
}

/**
 * Adds a custom body class when the courses page is being displayed
 *
 * @since  	1.0.0
 * @return 	array $classes
 */
function woo_sensei_body_class( $classes ) {	
	if ( ! class_exists( 'Woothemes_Sensei' ) ) return $classes;
	global $woothemes_sensei;
	
	/*if ( class_exists( 'Sensei_Media_Attachments' ) ) {
		global $woothemes_sensei;
	$remove_result = remove_action('sensei_lesson_single_meta', array($woothemes_sensei->Sensei_Media_Attachments, 'display_attached_media'),1);

		//$remove_result =  remove_action( 'sensei_lesson_single_meta', array( 'Sensei_Media_Attachments', 'display_attached_media' ),50 ,1);
	    echo "result of remove_result1 = " . $remove_result;
	}*/
	
	$course_page_id = intval( $woothemes_sensei->settings->settings[ 'course_page' ] );
	if ( isset( $course_page_id ) && is_page( $course_page_id ) ) {
		$classes[] = 'sensei-courses-page';
	}
	return $classes;
}

/**
 * Full width layout for Course and Lesson archives
 *
 * @since  	1.0.0
 * @return 	string $layout
 */
function woo_sensei_archive_full( $layout ) {
	if ( ! class_exists( 'Woothemes_Sensei' ) ) return;
	global $woothemes_sensei;
	$course_page_id = intval( get_option( 'woothemes-sensei_courses_page_id' ) );
	$dashboard_page_id = intval( get_option( 'woothemes-sensei_user_dashboard_page_id' ) );
	if ( ( isset( $course_page_id ) && is_page( $course_page_id ) ) || ( isset( $dashboard_page_id ) && is_page( $dashboard_page_id ) ) || is_post_type_archive( 'course' ) || is_post_type_archive( 'lesson' ) ) {
		$layout = 'one-col';
	}
	return $layout;
}

/**
 * Alt logo
 *
 * @since  	1.0.0
 * @return 	void
 */
function woo_logo () {
	$settings = woo_get_dynamic_values( array( 'logo' => '', 'logo_alt' => '' ) );
	// Setup the tag to be used for the header area (`h1` on the front page and `span` on all others).
	$heading_tag = 'span';
	if ( is_home() || is_front_page() ) { $heading_tag = 'h1'; }

	// Get our website's name, description and URL. We use them several times below so lets get them once.
	$site_title = get_bloginfo( 'name' );
	$site_url = home_url( '/' );
	$site_description = get_bloginfo( 'description' );
?>
<div id="logo"<?php if ( ( '' != $settings['logo_alt'] ) ) { echo ' class="with-alt-logo"'; } ?>>
<?php
	// Website heading/logo and description text.
	if ( ( '' != $settings['logo'] ) ) {
		$logo_url = $settings['logo'];
		$logo_alt = $settings['logo_alt'];
		if ( is_ssl() ) {
			$logo_url = str_replace( 'http://', 'https://', $logo_url );
			$logo_alt = str_replace( 'http://', 'https://', $logo_alt );
		}

		echo '<a class="logo" href="' . esc_url( $site_url ) . '" title="' . esc_attr( $site_description ) . '"><img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( $site_title ) . '" /></a>' . "\n";

		if ( '' != $settings['logo_alt'] && is_page_template( 'template-homepage.php' ) ) {
			echo '<a class="logo-alt" href="' . esc_url( $site_url ) . '" title="' . esc_attr( $site_description ) . '"><img src="' . esc_url( $logo_alt ) . '" alt="' . esc_attr( $site_title ) . '" /></a>' . "\n";
		}

	} // End IF Statement

	echo '<' . $heading_tag . ' class="site-title"><a href="' . esc_url( $site_url ) . '">' . $site_title . '</a></' . $heading_tag . '>' . "\n";
	if ( $site_description ) { echo '<span class="site-description">' . $site_description . '</span>' . "\n"; }
?>
</div>
<?php
} // End woo_logo()

/**
 * Display Hero.
 *
 * Displays products which have been set as “featured” using the WooCommerce featured_products shortcode.
 *
 * @since  	1.0.0
 * @return 	void
 * @uses  	do_shortcode()
 * @link 	http://www.woothemes.com/woocommerce/
 * @author 	WooThemes
 */
function woo_display_hero() {
 	$settings = array(
					'hero_title'		=> '',
					'hero_message' 		=> '',
					'hero_search'		=> 'true'
				);

	$settings = woo_get_dynamic_values( $settings );

	// Return if we are not in the homepage template
	if ( ! is_page_template( 'template-homepage.php' ) ) {
		return;
	}

	if ( $settings['hero_title'] != '' || $settings['hero_message'] != '' || $settings['hero_search'] != '' ) {
	?>
		<section class="hero home-section">
			<div class="col-full">
				<div class="hero-container">
					<?php if ( isset( $settings['hero_title'] ) && '' != $settings['hero_title'] ): ?>
						<h1 class="section-title"><span><?php echo esc_attr( stripslashes( $settings['hero_title'] ) ); ?></span></h1>
					<?php endif; ?>

					<?php if ( isset( $settings['hero_message'] ) && '' != $settings['hero_message'] ): ?>
						<?php echo wpautop( esc_attr( stripslashes( $settings['hero_message'] ) ) ); ?>
					<?php endif; ?>

					<?php
						if ( isset( $settings['hero_search'] ) && 'false' != $settings['hero_search'] ) {
?>
							<div class="search_main">
							    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
								    <?php
								    	$search_text = __( 'Search...', 'woothemes' );
								    	if ( class_exists( 'Woothemes_Sensei' ) ) {
								    		$search_text = __( 'Search for courses...', 'woothemes' );
								    		echo '<input type="hidden" name="post_type" value="course" />';
								    	}
								    ?>
							        <input type="text" class="field s" name="s" value="<?php echo esc_attr( $search_text ); ?>" onfocus="if (this.value == '<?php echo esc_attr( $search_text ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_attr( $search_text ); ?>';}" />
							        <button type="submit" class="fa fa-search submit" name="submit" value="<?php _e( 'Search', 'woothemes' ); ?>"></button>
							    </form>
							    <div class="fix"></div>
							</div>
<?php
						}
					?>
				</div>
			</div>
		</section>
	<?php
	}
}

/**
 * Display Sensei Featured Courses.
 *
 * Displays a list of featured courses.
 *
 * @since  	1.0.0
 * @return 	void
 * @uses  	WP_Query()
 * @link 	http://www.woothemes.com/sensei/
 * @author 	WooThemes
 */
function woo_display_featured_courses() {
	if ( class_exists( 'Woothemes_Sensei' ) ) {
		global $woothemes_sensei;

	 	$settings = array(
						'featured_courses_title'		=> '',
						'featured_courses_byline' 		=> '',
					);

		$settings = woo_get_dynamic_values( $settings );

?>
		<section class="home-section sensei">
			<?php
				$args = array(
							'post_type' 		=> 'course',
							'meta_key'			=> '_course_featured',
							'meta_value'		=> 'featured',
							'posts_per_page'	=> apply_filters( 'woo_sensei_featured_courses_number', 3 ),
						);

				$courses = get_posts( $args );
			?>

			<?php if ( isset( $courses ) && 0 < $courses ) : ?>
				<section class="featured-courses col-full">

					<?php if ( $settings['featured_courses_title'] != '' || $settings['featured_courses_byline'] != '' ) : ?>
					<header class="section-title">
						<?php if ( isset( $settings['featured_courses_title'] ) && '' != $settings['featured_courses_title'] ) : ?>
							<h1><?php echo esc_attr( stripslashes( $settings['featured_courses_title'] ) ); ?></h1>
						<?php endif; ?>
						<?php if ( isset( $settings['featured_courses_byline'] ) && '' != $settings['featured_courses_byline'] ) : ?>
							<p><?php echo esc_attr( stripslashes( $settings['featured_courses_byline'] ) ); ?></p>
						<?php endif; ?>
					</header>
					<?php endif; ?>

					<?php $count = 0; foreach ( $courses as $course ) : $count++; ?>
						<?php
							// Featured image size
							$image_size = '200';
							// Get number of lessons
							$course_lessons = $woothemes_sensei->post_types->course->course_lessons( $course->ID );
							$total_lessons = count( $course_lessons );
							// Get course categories
							$course_categories = get_the_terms( $course->ID, 'course-category' );
							// Odd/even class after the first featured course
							$class = '';
							if ( 1 < $count ) {
								$image_size = '100';
								$class = ' first';
								if ( 0 != $count % 2 ) {
									$class = ' last';
								}
							}
						?>
						<article class="course type-course<?php echo esc_attr( $class ); ?>">
							<div class="sensei-course-content">
								<?php if ( has_post_thumbnail( $course->ID ) ) : ?>
									<div class="sensei-course-image">
										<?php echo esc_attr( $woothemes_sensei->frontend->sensei_course_image( $course->ID, $image_size, $image_size ) ); ?>
									</div>
								<?php endif; ?>
								<header>
									<h2><a href="<?php echo esc_url( get_permalink( $course->ID ) ); ?>"><?php echo esc_attr( get_the_title( $course->ID ) ); ?></a></h2>
									<?php $author_info = get_userdata( $course->post_author ); ?>
									<p class="sensei-course-meta"><?php _e( 'by', 'woothemes' ); ?> <a href="<?php echo esc_url( get_author_posts_url( $course->post_author ) ); ?>"><?php echo esc_attr( $author_info->display_name ); ?></a> | <?php echo sprintf( __( '%d modules', 'woothemes' ), $total_lessons ); ?><?php if ( WooThemes_Sensei_Utils::sensei_is_woocommerce_activated() && 0 < get_post_meta( $course->ID, '_course_woocommerce_product', true ) ) { _e( ' | Price: ', 'woothemes' );  sensei_simple_course_price( $course->ID ); } ?></p>
								</header>
								<section class="entry">
									<?php if ( isset( $course->post_excerpt ) && '' != $course->post_excerpt ) : ?>
										<p class="course-excerpt"><?php echo esc_attr( $course->post_excerpt ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $course_categories ) ): ?>
										<ul class="sensei-course-categories">
											<?php foreach ( $course_categories as $category ): ?>
												<li><a href="<?php echo get_term_link( $category->slug, 'course-category' ); ?>"><?php echo esc_attr( $category->name ); ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</section>
							</div>

							<div class="fix"></div>

							<footer>
								<?php
									if ( class_exists( 'Sensei_Course_Participants' ) ) {
										Sensei_Course_Participants()->display_course_participant_count( $course );
									}
								?>
								<p class="sensei-view-course"><a class="button" href="<?php echo esc_url( get_permalink( $course->ID ) ); ?>"><?php _e( 'View Course', 'woothemes' ); ?></a></p>
							</footer>
						</article>
					<?php endforeach; ?>
				</section>
			<?php endif; ?>
		</section>
<?php
		wp_reset_postdata();
	}
}

/**
 * Replace Testimonials Template
 *
 * Replaces Canvas Testimonials Template with a custom one.
 *
 * @since  	1.0.0
 * @return 	void
 * @author 	WooThemes
 */
function woo_apply_testimonials_tpl() {
	remove_filter( 'woothemes_testimonials_item_template', 'woo_customise_testimonials_template', 10 );
	add_filter( 'woothemes_testimonials_item_template', 'woo_custom_testimonials_template', 10 );
}

/**
 * Custom Testimonials Template
 *
 * Customizes Testimonials template with a custom version.
 *
 * @since  	1.0.0
 * @return 	string $tpl
 * @author 	WooThemes
 */
function woo_custom_testimonials_template( $tpl ) {
	$tpl = '<div id="quote-%%ID%%" class="%%CLASS%%" itemprop="review" itemscope itemtype="http://schema.org/Review">%%AVATAR%%<blockquote class="testimonials-text" itemprop="reviewBody">%%TEXT%% %%AUTHOR%%</blockquote></div>';
	return $tpl;
}

/**
 * Display Testimonials.
 *
 * Displays the most recent testimonial.
 *
 * @since  	1.0.0
 * @return 	void
 * @uses  	do_action()
 * @link 	http://www.woothemes.com/woocommerce/
 * @author 	WooThemes
 */
function woo_display_testimonials() {
	if ( class_exists( 'Woothemes_Testimonials' ) ) {

	 	$settings = array(
						'testimonials_title'		=> '',
						'testimonials_byline' 		=> '',
					);

		$settings = woo_get_dynamic_values( $settings );
?>

		<section class="testimonials home-section">

			<div class="col-full">

				<?php if ( $settings['testimonials_title'] != '' || $settings['testimonials_byline'] != '' ) : ?>
				<header class="section-title">
					<?php if ( isset( $settings['testimonials_title'] ) && '' != $settings['testimonials_title'] ) : ?>
						<h1><?php echo esc_attr( stripslashes( $settings['testimonials_title'] ) ); ?></h1>
					<?php endif; ?>
					<?php if ( isset( $settings['testimonials_byline'] ) && '' != $settings['testimonials_byline'] ) : ?>
						<p><?php echo esc_attr( stripslashes( $settings['testimonials_byline'] ) ); ?></p>
					<?php endif; ?>
				</header>
				<?php endif; ?>

				<?php

				$limit 		= apply_filters( 'woo_template_testimonials_limit', $testimonials_limit = 2 );
				$columns 	= apply_filters( 'woo_template_testimonials_columns', $testimonials_columns = 1 );

				do_action( 'woothemes_testimonials', apply_filters( 'woo_template_testimonials_args', array(
					'limit' 	=> $limit,
					'per_row' 	=> $columns
					) )
				);

				?>

			</div>

		</section>

	<?php }
}

/**
 * Display Recent Posts.
 *
 * Displays recent blog posts.
 *
 * @since  	1.0.0
 * @return 	void
 * @uses  	WP_Query()
 * @link 	http://www.woothemes.com/woocommerce/
 * @author 	WooThemes
 */
function woo_display_recent_posts() {

/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */

 	$settings = array(
					'thumb_w'		=> 700,
					'thumb_h' 		=> 700,
					'thumb_align' 	=> 'alignleft',
					'blog_title'	=> '',
					'blog_byline' 	=> ''
					);

	$settings = woo_get_dynamic_values( $settings );

?>

	<section class="home-section recent-posts">

		<div class="col-full">

			<?php if ( $settings['blog_title'] != '' || $settings['blog_byline'] != '' ) : ?>
			<header class="section-title">
				<?php if ( isset( $settings['blog_title'] ) && '' != $settings['blog_title'] ) : ?>
					<h1><?php echo esc_attr( stripslashes( $settings['blog_title'] ) ); ?></h1>
				<?php endif; ?>
				<?php if ( isset( $settings['blog_byline'] ) && '' != $settings['blog_byline'] ) : ?>
					<p><?php echo esc_attr( stripslashes( $settings['blog_byline'] ) ); ?></p>
				<?php endif; ?>
			</header>
			<?php endif; ?>

			<?php
				$args = array(
							'posts_per_page' => 3,
							'ignore_sticky_posts' => 1
						);

				$recent_posts = new WP_Query( $args );
			?>

			<?php if ( $recent_posts->have_posts() ) : ?>
				<?php $count = 0; while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); $count++; ?>
					<?php
						$class = '';
						if ( $count == 1 ) {
							$class = 'first';
						} elseif ( $count == 3 ) {
							$class = 'last';
						}
					?>
					<article <?php post_class( $class ); ?>>

						<header class="post-header">
							<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							<p class="meta">
								<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
							</p>
						</header>

						<p><?php echo woo_text_trim( get_the_excerpt(), 20 ); ?></p>

						<footer class="post-more">
							<span class="read-more"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php _e( 'Read More', 'woothemes' ); ?></a></span>
						</footer>

					</article><!-- /.post -->
					<?php if ( $count == 3 ) { $count = 0; } ?>
				<?php endwhile; ?>
			<?php endif; ?>

		</div>

	</section>

<?php
}


if ( class_exists( 'Sensei_Media_Attachments' ) ) {
	global $sensei_media_attachments;
  remove_action( 'sensei_lesson_single_meta', array( $sensei_media_attachments, 'display_attached_media' ), 1 );
  add_action( 'sensei_lesson_single_meta', 'custom_display_attached_media' , 1 );
}
  function custom_display_attached_media() {

	global $post,$wpdb;

	//$media = get_post_meta( $post->ID, '_attached_media', true );

	$html = '';
	
	/*$args = array(
	   'post_type' => 'attachment',
	   'numberposts' => -1,		  
	   'post_parent' => $post->ID
	  );
	
	  $media = get_posts( $args );*/
	  $media = get_post_meta( $post->ID, '_attached_media', true );
	  
	  
	  
	//print_r($media);


	$post_type = ucfirst( get_post_type( $post ) );

	if( $media && is_array( $media ) && count( $media ) > 0 ) {
		$html .= '<div id="attached-media">';
			$html .= '<h2>' . sprintf( __( 'Module Resources', 'sensei_media_attachments' ), $post_type ) . '</h2>';
			$html .= '<ul>';
			$k=1;
			foreach( $media as $k => $file ) {
						$file_parts = explode( '/', $file );
		    			$file_name = array_pop( $file_parts );
						
						$getposttitle = $wpdb->get_var($wpdb->prepare('SELECT post_title FROM wp_posts where post_type LIKE "attachment" and guid="'.$file.'"',ARRAY_A));
						
						$html .= '<li id="attached_media_' . $k . '"><a href="' . esc_url( $file ) . '" target="_blank">' . $getposttitle . '</a></li>';
					}
				
			$html .= '</ul>';
		$html .= '</div>';
	}

	echo $html;
}


if ( class_exists( 'Sensei_Core_Modules' ) ) {
	global $sensei_modules, $woothemes_sensei;
$removeaction =  remove_action('sensei_single_course_modules_content', array( $woothemes_sensei->modules,'course_module_content' ), 20);
  $addaction = add_action( 'sensei_single_course_modules_content','custom_course_module_content' ,20 );
}
  /**
     * Display the single course modules content
     *
     * @since 1.8.0
     * @return void
     */
    function custom_course_module_content(){

global $sensei_modules, $woothemes_sensei;
        global $post;
        $course_id = $post->ID;
        $modules = $woothemes_sensei->modules->get_course_modules( $course_id  );

        // Display each module
	
        foreach ($modules as $module) {
			$modulestatus = '';
			
			$lessons = $woothemes_sensei->modules->get_lessons( $course_id ,$module->term_id );
			if (count($lessons) > 0) {
				$incid = 0;
				 foreach ($lessons as $lesson) {
                    //$status = '';
                    $lesson_completed = WooThemes_Sensei_Utils::user_completed_lesson($lesson->ID, get_current_user_id() );
					if ($lesson_completed) {
                      //  $status = 'completed';
						$incid += 1;
                    }
				 }
			
			}
			$cntlessons = count($lessons);
			if(($cntlessons != 0) && ($incid == $cntlessons)){$modulestatus = 'completed';}else{$modulestatus = 'notcompleted';}

            echo '<article class="post module">';

            // module title link
            $module_url = esc_url(add_query_arg('course_id', $course_id, get_term_link($module, $woothemes_sensei->modules->taxonomy)));
            echo '<header class="'.$modulestatus.'"><h2><a href="' . esc_url($module_url) . '">' . $module->name . '</a></h2></header>';

            echo '<section class="entry">';

            $module_progress = false;
            if (is_user_logged_in()) {
                global $current_user;
                wp_get_current_user();
                $module_progress = $woothemes_sensei->modules->get_user_module_progress($module->term_id, $course_id, $current_user->ID);
            }

            if ($module_progress && $module_progress > 0) {
                $status = __('Completed', 'woothemes-sensei');
                $class = 'completed';
                if ($module_progress < 100) {
                    $status = __('In progress', 'woothemes-sensei');
                    $class = 'in-progress';
                }
                echo '<p class="status module-status ' . esc_attr($class) . '">' . $status . '</p>';
            }

            if ('' != $module->description) {
                echo '<p class="module-description">' . $module->description . '</p>';
            }

            

            if (count($lessons) > 0) {

                $lessons_list = '';
                foreach ($lessons as $lesson) {
                    $status = '';
                    $lesson_completed = WooThemes_Sensei_Utils::user_completed_lesson($lesson->ID, get_current_user_id() );
                    $title = esc_attr(get_the_title(intval($lesson->ID)));

                    if ($lesson_completed) {
                        $status = 'completed';
                    }

                    $lessons_list .= '<li class="' . $status . '"><a href="' . esc_url(get_permalink(intval($lesson->ID))) . '" title="' . esc_attr(get_the_title(intval($lesson->ID))) . '">' . apply_filters('sensei_module_lesson_list_title', $title, $lesson->ID) . '</a></li>';

                    // Build array of displayed lesson for exclusion later
                    $displayed_lessons[] = $lesson->ID;
                }
                ?>
                <section class="module-lessons">
                    <header>
                        <h3><?php _e('Lessons', 'woothemes-sensei') ?></h3>
                    </header>
                    <ul>
                        <?php echo $lessons_list; ?>
                    </ul>
                </section>

            <?php }//end count lessons  ?>
                </section>
            </article>
        <?php

        } // end each module

    } // end course_module_content

/**
	 * load_user_courses_content generates HTML for user's active & completed courses
	 * @since  1.4.0
	 * @param  object  $user   Queried user object
	 * @param  boolean $manage Whether the user has permission to manage the courses
	 * @return string          HTML displayng course data
	 */
	function custom_load_user_courses_content( $user = false, $manage = false ) {
		global $woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section,$wpdb;

		// Build Output HTML
		$complete_html = $active_html = '';
//echo "ddd";
		if( $user ) {

			$my_courses_page = true;

			// Allow action to be run before My Courses content has loaded
			do_action( 'sensei_before_my_courses', $user->ID );

			// Logic for Active and Completed Courses
			$per_page = 20;
			if ( isset( $woothemes_sensei->settings->settings[ 'my_course_amount' ] ) && ( 0 < absint( $woothemes_sensei->settings->settings[ 'my_course_amount' ] ) ) ) {
				$per_page = absint( $woothemes_sensei->settings->settings[ 'my_course_amount' ] );
			}

			$course_statuses = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'user_id' => $user->ID, 'type' => 'sensei_course_status' ), true );
			// User may only be on 1 Course
			if ( !is_array($course_statuses) ) {
				$course_statuses = array( $course_statuses );
			}
			$completed_ids = $active_ids = array();
			foreach( $course_statuses as $course_status ) {
				if ( WooThemes_Sensei_Utils::user_completed_course( $course_status, $user->ID ) ) {
					$completed_ids[] = $course_status->comment_post_ID;
				} else {
					$active_ids[] = $course_status->comment_post_ID;
				}
			}

			$active_count = $completed_count = 0;

			$active_courses = array();
			if ( 0 < intval( count( $active_ids ) ) ) {
				$my_courses_section = 'active';
				$active_courses = $woothemes_sensei->post_types->course->course_query( $per_page, 'usercourses', $active_ids );
				$active_count = count( $active_ids );
			} // End If Statement

			$completed_courses = array();
			if ( 0 < intval( count( $completed_ids ) ) ) {
				$my_courses_section = 'completed';
				$completed_courses = $woothemes_sensei->post_types->course->course_query( $per_page, 'usercourses', $completed_ids );
				$completed_count = count( $completed_ids );
			} // End If Statement
			$lesson_count = 1;

			$active_page = 1;
			if( isset( $_GET['active_page'] ) && 0 < intval( $_GET['active_page'] ) ) {
				$active_page = $_GET['active_page'];
			}

			$completed_page = 1;
			if( isset( $_GET['completed_page'] ) && 0 < intval( $_GET['completed_page'] ) ) {
				$completed_page = $_GET['completed_page'];
			}
			foreach ( $active_courses as $course_item ) {

				$course_lessons = $woothemes_sensei->post_types->course->course_lessons( $course_item->ID );
				$lessons_completed = 0;
				foreach ( $course_lessons as $lesson ) {
					if ( WooThemes_Sensei_Utils::user_completed_lesson( $lesson->ID, $user->ID ) ) {
						++$lessons_completed;
					}
				}
				
				$currentlesson = $lessons_completed+1;

			    // Get Course Categories
			    $category_output = get_the_term_list( $course_item->ID, 'course-category', '', ', ', '' );

		    	$active_html .= '<article class="' . esc_attr( join( ' ', get_post_class( array( 'course', 'post' ), $course_item->ID ) ) ) . '">';

		    	    // Image
		    		$active_html .= $woothemes_sensei->post_types->course->course_image( absint( $course_item->ID ) );

		    		// Title
		    		$active_html .= '<header>';

		    		    $active_html .= '<h2>' . esc_html( $course_item->post_title ) . '</h2>';

		    		$active_html .= '</header>';

		    		$active_html .= '<section class="entry">';

		    			$active_html .= '<p class="sensei-course-meta">';

		    		    	// Author
		    		    	$user_info = get_userdata( absint( $course_item->post_author ) );
		    		    	if ( isset( $woothemes_sensei->settings->settings[ 'course_author' ] ) && ( $woothemes_sensei->settings->settings[ 'course_author' ] ) ) {
		    		    		$active_html .= '<span class="course-author">' . __( 'by ', 'woothemes-sensei' ) . '<a href="' . esc_url( get_author_posts_url( absint( $course_item->post_author ) ) ) . '" title="' . esc_attr( $user_info->display_name ) . '">' . esc_html( $user_info->display_name ) . '</a></span>';
		    		    	} // End If Statement
		    		    	// Lesson count for this author
		    		    	$lesson_count = $woothemes_sensei->post_types->course->course_lesson_count( absint( $course_item->ID ) );
		    		    	// Handle Division by Zero
							if ( 0 == $lesson_count ) {
								$lesson_count = 1;
							} // End If Statement
							
						global $wpdb;	
						$qu = "SELECT COUNT(*) FROM wp_term_relationships where object_id='".absint( $course_item->ID )."'";
						$modulecount = $wpdb->get_var($wpdb->prepare($qu));
						
						
						
						
						$getlessons = $wpdb->get_results($wpdb->prepare("SELECT * FROM wp_postmeta 
						INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID  
						where wp_posts.post_status = 'publish' and meta_key = '_lesson_course' and meta_value='".absint( $course_item->ID )."' order by wp_posts.menu_order asc",ARRAY_A));
						
					//echo "<pre>"; print_r($getlessons);
					$lastclick = 0;
					$total_lengthoflesson = 0;
					foreach($getlessons as $row_getlessons)
					{
					$lessonid = $row_getlessons->post_id;
						
						
						$getcountlesson = $wpdb->get_var(
						$wpdb->prepare(
						'SELECT COUNT(*) FROM `wp_comments` WHERE `user_id` = "'.$user->ID.'" and `comment_post_ID` = "'.$lessonid.'" and `comment_approved` IN("complete", "graded")'
						)
						);
						
						//echo "<br>getcountlesson:".$getcountlesson;
						
						if($getcountlesson == 0 && $lastclick != 1){
							$lastclick = 1;
							$post_7 = get_post( $lessonid ); 
							$lessontitle = $post_7->post_title;
							$lessonname = $post_7->post_name;							
							
							 $lessonlink = get_site_url().'/lesson/'.$lessonname;
							
							
							}
							
							$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
							
							$total_lengthoflesson += $getlessonlength;
							
						
						
						}
						//echo "TOTAL:".$total_lengthoflesson;
						
							//echo "ggg";
		    		    	$active_html .= '<span class="course-lesson-count">Length: '.$total_lengthoflesson.' minutes</span>';
		    		    	// Course Categories
		    		    	if ( '' != $category_output ) {
		    		    		$active_html .= '<span class="course-category">' . sprintf( __( 'in %s', 'woothemes-sensei' ), $category_output ) . '</span>';
		    		    	} // End If Statement
							//$active_html .= '<span class="course-lesson-progress">' . sprintf( __( '%1$d of %2$d lessons completed', 'woothemes-sensei' ) , $lessons_completed, $lesson_count  ) . '</span>';
							$active_html .= '<span class="course-lesson-progress">  '.($modulecount - 1) .' Modules</span>';

		    		    $active_html .= '</p>';
						$active_html .= '<p style="clear:both;">Currently on '.$lessontitle.'</p>';
            if($lessons_completed==0){
              $active_html .= '<p style="clear:both;"><a href="'.$lessonlink.'" class="continue_link">Begin</a></p>';
            }
            else{
              $active_html .= '<p style="clear:both;"><a href="'.$lessonlink.'" class="continue_link">Continue</a></p>';
            }
						
						//$_SESSION['lessonlink'] = $lessonlink;

		    		    $active_html .= '<p class="course-excerpt">' . apply_filters( 'get_the_excerpt', $course_item->post_excerpt ) . '</p>';

		    		   	$progress_percentage = abs( round( ( doubleval( $lessons_completed ) * 100 ) / ( $lesson_count ), 0 ) );

                        $active_html .= custom_get_progress_meter( $progress_percentage );

		    		$active_html .= '</section>';

		    		if( $manage ) {

			    		$active_html .= '<section class="entry-actions">';

                        $active_html .= '<form method="POST" action="' . esc_url( remove_query_arg( array( 'active_page', 'completed_page' ) ) ) . '">';

			    				$active_html .= '<input type="hidden" name="' . esc_attr( 'woothemes_sensei_complete_course_noonce' ) . '" id="' . esc_attr( 'woothemes_sensei_complete_course_noonce' ) . '" value="' . esc_attr( wp_create_nonce( 'woothemes_sensei_complete_course_noonce' ) ) . '" />';

			    				$active_html .= '<input type="hidden" name="course_complete_id" id="course-complete-id" value="' . esc_attr( absint( $course_item->ID ) ) . '" />';

			    				if ( 0 < absint( count( $course_lessons ) ) && $woothemes_sensei->settings->settings['course_completion'] == 'complete' ) {
			    					$active_html .= '<span><input name="course_complete" type="submit" class="course-complete" value="' . apply_filters( 'sensei_mark_as_complete_text', __( 'Mark as Complete', 'woothemes-sensei' ) ) . '"/></span>';
			    				} // End If Statement

			    				$course_purchased = false;
			    				if ( WooThemes_Sensei_Utils::sensei_is_woocommerce_activated() ) {
			    					// Get the product ID
			    					$wc_post_id = get_post_meta( absint( $course_item->ID ), '_course_woocommerce_product', true );
			    					if ( 0 < $wc_post_id ) {
			    						$course_purchased = WooThemes_Sensei_Utils::sensei_customer_bought_product( $user->user_email, $user->ID, $wc_post_id );
			    					} // End If Statement
			    				} // End If Statement

			    				if ( ! $course_purchased ) {
			    					$active_html .= '<span><input name="course_complete" type="submit" class="course-delete" value="' . apply_filters( 'sensei_delete_course_text', __( 'Delete Course', 'woothemes-sensei' ) ) . '"/></span>';
			    				} // End If Statement

			    			$active_html .= '</form>';

			    		$active_html .= '</section>';
			    	}

		    	$active_html .= '</article>';
			}

			// Active pagination
			if( $active_count > $per_page ) {

				$current_page = 1;
				if( isset( $_GET['active_page'] ) && 0 < intval( $_GET['active_page'] ) ) {
					$current_page = $_GET['active_page'];
				}

				$active_html .= '<nav class="pagination woo-pagination">';
				$total_pages = ceil( $active_count / $per_page );

				$link = '';

				if( $current_page > 1 ) {
					$prev_link = add_query_arg( 'active_page', $current_page - 1 );
					$active_html .= '<a class="prev page-numbers" href="' . esc_url( $prev_link ) . '">' . __( 'Previous' , 'woothemes-sensei' ) . '</a> ';
				}

				for ( $i = 1; $i <= $total_pages; $i++ ) {
					$link = add_query_arg( 'active_page', $i );

					if( $i == $current_page ) {
						$active_html .= '<span class="page-numbers current">' . $i . '</span> ';
					} else {
						$active_html .= '<a class="page-numbers" href="' . esc_url( $link ). '">' . $i . '</a> ';
					}
				}

				if( $current_page < $total_pages ) {
					$next_link = add_query_arg( 'active_page', $current_page + 1 );
					$active_html .= '<a class="next page-numbers" href="' . esc_url( $next_link ) . '">' . __( 'Next' , 'woothemes-sensei' ) . '</a> ';
				}

				$active_html .= '</nav>';
			}

			foreach ( $completed_courses as $course_item ) {
				$course = $course_item;
				
				$getlessons = $wpdb->get_results($wpdb->prepare("SELECT * FROM wp_postmeta 
						INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID  
						where wp_posts.post_status = 'publish' and meta_key = '_lesson_course' and meta_value='".absint( $course_item->ID )."' order by wp_posts.menu_order asc",ARRAY_A));
						
						 $lessonlink = get_site_url().'/lesson/'.$getlessons[0]->post_name;
						

			    // Get Course Categories
			    $category_output = get_the_term_list( $course_item->ID, 'course-category', '', ', ', '' );

		    	$complete_html .= '<article class="' . join( ' ', get_post_class( array( 'course', 'post' ), $course_item->ID ) ) . '">';

		    	    // Image
		    		$complete_html .= $woothemes_sensei->post_types->course->course_image( absint( $course_item->ID ) );

		    		// Title
		    		$complete_html .= '<header>';

		    		    $complete_html .= '<h2><a href="' . $lessonlink . '" title="' . esc_attr( $course_item->post_title ) . '">' . esc_html( $course_item->post_title ) . '</a></h2>';

		    		$complete_html .= '</header>';

		    		$complete_html .= '<section class="entry">';

		    			$complete_html .= '<p class="sensei-course-meta">';

		    		    	// Author
		    		    	$user_info = get_userdata( absint( $course_item->post_author ) );
		    		    	if ( isset( $woothemes_sensei->settings->settings[ 'course_author' ] ) && ( $woothemes_sensei->settings->settings[ 'course_author' ] ) ) {
		    		    		$complete_html .= '<span class="course-author">' . __( 'by ', 'woothemes-sensei' ) . '<a href="' . esc_url( get_author_posts_url( absint( $course_item->post_author ) ) ) . '" title="' . esc_attr( $user_info->display_name ) . '">' . esc_html( $user_info->display_name ) . '</a></span>';
		    		    	} // End If Statement

		    		    	// Lesson count for this author
		    		    	$complete_html .= '<span class="course-lesson-count">' . ( $woothemes_sensei->post_types->course->course_lesson_count( absint( $course_item->ID ) ) - 1 ) . ' Modules</span>';
		    		    	// Course Categories
		    		    	if ( '' != $category_output ) {
		    		    		$complete_html .= '<span class="course-category">' . sprintf( __( 'in %s', 'woothemes-sensei' ), $category_output ) . '</span>';
		    		    	} // End If Statement

						$complete_html .= '</p>';

						$complete_html .= '<p class="course-excerpt">' . apply_filters( 'get_the_excerpt', $course_item->post_excerpt ) . '</p>';

                        $complete_html .= custom_get_progress_meter( 100 );

						if( $manage ) {
							$has_quizzes = $woothemes_sensei->post_types->course->course_quizzes( $course_item->ID, true );
							// Output only if there is content to display
							if ( has_filter( 'sensei_results_links' ) || $has_quizzes ) {
								$complete_html .= '<p class="sensei-results-links">';
								$results_link = '';
								if( $has_quizzes ) {
									$results_link = '<a class="button view-results" href="' . $woothemes_sensei->course_results->get_permalink( $course_item->ID ) . '">' . apply_filters( 'sensei_view_results_text', __( 'View results', 'woothemes-sensei' ) ) . '</a>';
								}
								if(get_the_author_meta( 'group_individual_account', get_current_user_id() ) == 'Group Account'){
									$complete_html .= '<a class="button sensei-certificate-link" href="/elevate/add-certificate-users">' . apply_filters( 'sensei_view_results_text', __( 'Add Certificate Users', 'woothemes-sensei' ) ) . '</a>';
								}else{
								$complete_html .= apply_filters( 'sensei_results_links', $results_link );
								}
								$complete_html .= '</p>';
							}
						}

		    		$complete_html .= '</section>';

		    	$complete_html .= '</article>';
			}

			// Active pagination
			if( $completed_count > $per_page ) {

				$current_page = 1;
				if( isset( $_GET['completed_page'] ) && 0 < intval( $_GET['completed_page'] ) ) {
					$current_page = $_GET['completed_page'];
				}

				$complete_html .= '<nav class="pagination woo-pagination">';
				$total_pages = ceil( $completed_count / $per_page );

				$link = '';

				if( $current_page > 1 ) {
					$prev_link = add_query_arg( 'completed_page', $current_page - 1 );
					$complete_html .= '<a class="prev page-numbers" href="' . esc_url( $prev_link ) . '">' . __( 'Previous' , 'woothemes-sensei' ) . '</a> ';
				}

				for ( $i = 1; $i <= $total_pages; $i++ ) {
					$link = add_query_arg( 'completed_page', $i );

					if( $i == $current_page ) {
						$complete_html .= '<span class="page-numbers current">' . $i . '</span> ';
					} else {
						$complete_html .= '<a class="page-numbers" href="' . esc_url( $link ) . '">' . $i . '</a> ';
					}
				}

				if( $current_page < $total_pages ) {
					$next_link = add_query_arg( 'completed_page', $current_page + 1 );
					$complete_html .= '<a class="next page-numbers" href="' . esc_url( $next_link ) . '">' . __( 'Next' , 'woothemes-sensei' ) . '</a> ';
				}

				$complete_html .= '</nav>';
			}

		} // End If Statement

		if( $manage ) {
			if($no_complete_message == ''){
				$no_active_message = apply_filters( 'sensei_no_active_courses_user_text', __( 'You have already completed ELEVATE, click on the Completed Courses tab to review the program.', 'woothemes-sensei' ) );
			}else{
			$no_active_message = apply_filters( 'sensei_no_active_courses_user_text', __( 'You have not yet been approved for the Elevate course material. Please <a href="/elevate/support">contact</a> support with any questions comments or concerns.', 'woothemes-sensei' ) );
			}
			$no_complete_message = apply_filters( 'sensei_no_complete_courses_user_text', __( 'You have not completed any courses yet.', 'woothemes-sensei' ) );
		} else {
			$no_active_message = apply_filters( 'sensei_no_active_courses_learner_text', __( 'This learner has no active courses.', 'woothemes-sensei' ) );
			$no_complete_message = apply_filters( 'sensei_no_complete_courses_learner_text', __( 'This learner has not completed any courses yet.', 'woothemes-sensei' ) );
		}
//echo "lll".$manage;
		//ob_start();
		//echo "mmm".$active_html;
		?>

		<?php do_action( 'sensei_before_user_courses' ); ?>

		<?php 
		if( $manage && ( ! isset( $woothemes_sensei->settings->settings['messages_disable'] ) || ! $woothemes_sensei->settings->settings['messages_disable'] ) ) {
			?>
			<p class="my-messages-link-container"><a class="my-messages-link" href="<?php echo get_post_type_archive_link( 'sensei_message' ); ?>" title="<?php _e( 'View & reply to private messages sent to your course & lesson teachers.', 'woothemes-sensei' ); ?>"><?php _e( 'My Messages', 'woothemes-sensei' ); ?></a></p>
			<?php
		}
		//echo "aaaaaa";
		global $current_user;
		$userexpirydate = get_the_author_meta( 'account_expiry_date', $current_user->ID );
		$renewaldate = date('Y-m-d', strtotime("-30 days", strtotime($userexpirydate)));
		//echo "test:".$renewaldate;
		//if($current_user->ID == '246'){
			
		//$all_subscribers = new WP_User_Query( array( 'role' => 'corporate_user' ) );
		//foreach ( $all_subscribers as $subscriber )
			//{
				// echo 'ff:'.$subscriber->display_name;
			//}
		//}
		if($_GET['renew_success'] == '1'){
	?>
     <div style="font-weight:bold; color: rgb(31, 123, 31);">Your account renew request sent successfully.. Administrator will review it then renew your account soon. </div>
	<?php }		
		 if(($userexpirydate != '') && (date('Y-m-d') > $userexpirydate)){
			?>
            <div class="myaccount">
            <h2>Your Account has expired...</h2>
            <a href="/elevate/register-2?renew=1" class="continue_link">Renew</a>
            </div>
            <?php 
			}else{
				if(($userexpirydate != '') && ($renewaldate <= date('Y-m-d') )){
			
			?>
            <div class="myaccount">
            <h2>Your Annual Subscription will expire on <?php echo $userexpirydate; ?></h2>
            <a href="/elevate/register-2?renew=1" class="continue_link">Renew</a>
            </div>
            <?php 
		}
		?>
		<div id="my-courses">
<?php global $current_user;
			 if ( is_user_logged_in() ) {
	$user = new WP_User( $current_user->ID );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role )
			$current_user_role = $role;
	}
	
	} 
	 ?>	
            <ul>
		    	<?php /*
		    	 * commented by hardik to show courses for corporate 
		    	 * 
		    	 * if($current_user_role != 'corporate_user'){ ?>
           <li><a href="#active-courses"><?php echo apply_filters( 'sensei_active_courses_text', __( 'Active Courses', 'woothemes-sensei' ) ); ?></a></li>
          <?php } //commented by hardik to show courses for corporate  */?>
          <li><a href="#active-courses"><?php echo apply_filters( 'sensei_active_courses_text', __( 'Active Courses', 'woothemes-sensei' ) ); ?></a></li>
		    	 <?php if($current_user_role == 'administrator' || $current_user_role == 'corporate_user' || $current_user_role == 'individual_user'){ ?>
             <li><a href="#completed-courses"><?php echo apply_filters( 'sensei_completed_courses_text', __( 'Completed Courses', 'woothemes-sensei' ) ); ?></a></li><?php } ?>
                 <?php if(($current_user_role == 'administrator') || ($current_user_role == 'corporate_user')){ ?>
                   <li><a href="#my-learners"><?php echo apply_filters( 'sensei_completed_courses_text', __( 'My Learners', 'woothemes-sensei' ) ); ?></a></li>
                   <?php } ?>
		    </ul>
<?php //if($current_user_role != 'corporate_user'){ ?>
		    <?php do_action( 'sensei_before_active_user_courses' ); ?>

		    <?php $course_page_id = intval( $woothemes_sensei->settings->settings[ 'course_page' ] );
		    	if ( 0 < $course_page_id ) {
		    		$course_page_url = get_permalink( $course_page_id );
		    	} elseif ( 0 == $course_page_id ) {
		    		$course_page_url = get_post_type_archive_link( 'course' );
		    	}?>

		    <div id="active-courses">

		    	<?php 
          if ( '' != $active_html ) {
					
		    		echo $active_html;
		    	} else { ?>
		    		<div class="sensei-message info"><?php echo $no_active_message; ?>
                     <?php /*?><a href="<?php echo $course_page_url; ?>"><?php apply_filters( 'sensei_start_a_course_text', _e( 'Start a Course!', 'woothemes-sensei' ) ); ?></a><?php */?></div>
		    	<?php } // End If Statement ?>

		    </div>

		    <?php do_action( 'sensei_after_active_user_courses' ); ?>
            <?php //} //commented by hardik to show courses for corporate ?>
<?php if($current_user_role == 'administrator' || $current_user_role == 'corporate_user' || $current_user_role == 'individual_user'){ ?>
		    <?php do_action( 'sensei_before_completed_user_courses' ); ?>

		    <div id="completed-courses">

		    	<?php if ( '' != $complete_html ) {
		    		echo $complete_html;
		    	} else { ?>
		    		<div class="sensei-message info"><?php echo $no_complete_message; ?></div>
		    	<?php } // End If Statement ?>

		    </div>

		    <?php do_action( 'sensei_after_completed_user_courses' ); ?>
       <?php } ?>
       <?php if(($current_user_role == 'administrator') || ($current_user_role == 'corporate_user')){ ?>     
            <div id="my-learners">
            <?php if($current_user_role == 'corporate_user'){ ?>
            <p style="clear:both"><a href="/elevate/corporate-sub-users-registration" class="continue_link">Add User</a></p>
            <?php } ?>
            <h1>My Learners:</h1>
            <p>
            <?php 
			$corporate_users = get_users(array(
    'meta_key'     => 'corporate_user_id',
    'meta_value'   => get_current_user_id(),
    'meta_compare' => '=',
));
			
			//echo "<pre>"; print_r($corporate_users);
			echo "<table><tr><td><strong>Username</strong></td><td><strong>Email Address</strong></td></tr>";
			if(empty($corporate_users)){
				 echo '<tr><td style="background-color:#ffffff;" colspan="2">No Learners</td></tr>';
				}
			else{
			 foreach($corporate_users as $row_corporate_users){
				 echo '<tr><td style="background-color:#ffffff;">';
				//echo $fullname = get_the_author_meta( 'first_name', $row_corporate_users->ID )." ".get_the_author_meta( 'last_name', $row_corporate_users->ID );
				echo $row_corporate_users->data->user_login;
				echo '</td><td style="background-color:#ffffff;">';
				 echo $row_corporate_users->data->user_email;
				 echo "</td></tr>";
				 
				 }
			}
			echo "</table>";
			 ?>
            </p>
            </div>
<?php } ?>
		</div>
<?php } ?>
		<?php do_action( 'sensei_after_user_courses' ); ?>

		<?php  //echo "hhhh";
		//return ob_get_clean();
	}
	  /**
     * Generate the course meter component
     *
     * @since 1.8.0
     * @param int $progress_percentage 0 - 100
     * @return string $progress_bar_html
     */
    function custom_get_progress_meter( $progress_percentage ){

        if ( 50 < $progress_percentage ) {
            $class = ' green';
        } elseif ( 25 <= $progress_percentage && 50 >= $progress_percentage ) {
            $class = ' orange';
        } else {
            $class = ' red';
        }
        $progress_bar_html = '<div style="float:right;clear:none;" class="c c' . $progress_percentage . ' big">
                            <span>' . round( $progress_percentage ) . '%<span>Complete</span></span>
                            <div class="slice">
                             <div class="bar"></div><div class="bar1"></div>
                            </div>
							</div>';
		 //$progress_bar_html = '<div style="float:right;clear:none;" class="c100 p' . $progress_percentage . ' big">
//                            <span>' . round( $progress_percentage ) . '%<span>Complete</span></span>
//                            <div class="slice">
//                            <div class="bar"></div>
//                            </div>
//							</div>';

        return $progress_bar_html;

    }// end get_progress_meter
	
if ( class_exists( 'WooThemes_Sensei_Course' ) ) {
	global  $woothemes_sensei;
  remove_action('sensei_course_single_meta', array( $woothemes_sensei->course,'the_progress_meter' ), 16);
  add_action( 'sensei_course_single_meta' , 'custom_the_progress_meter', 16 );
}

function custom_the_progress_meter( $course_id = 0, $user_id = 0 ){
global  $woothemes_sensei;
        if( empty( $course_id ) ){
            global $post;
            $course_id = $post->ID;
        }

        if( empty( $user_id ) ){
            $user_id = get_current_user_id();
        }

        if( 'course' != get_post_type( $course_id ) || ! get_userdata( $user_id )
            || ! WooThemes_Sensei_Utils::user_started_course( $course_id ,$user_id ) ){
            return;
        }
		
     $percentage_completed = $woothemes_sensei->course->get_completion_percentage( $course_id, $user_id );

        echo custom_get_progress_meter( $percentage_completed );

    }
//$screen = get_current_screen();
//echo "posttype:".$post_type = $screen->id;
/**
 * Registering a new user.
 */
add_action('template_redirect', 'register_user');
 
function register_user(){
  if(isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = array();
    /*if(empty($_POST['user'])) 
       $errors[] = 'Please enter a fullname.<br>';*/
    if(empty($_POST['email'])) 
       $errors[] = 'Please enter a email.<br>';
    if(empty($_POST['pass'])) 
       $errors[] = 'Please enter a password.<br>';
    if(empty($_POST['cpass'])) 
       $errors[] = 'Please enter a confirm password.<br>';
    if((!empty($_POST['cpass']) && !empty($_POST['pass'])) && ($_POST['pass'] != $_POST['cpass'])) 
       $errors[] = 'Entered password did not match.';
    //$user_login = esc_attr($_POST['user']);
    $user_email = esc_attr($_POST['email']);
    $user_pass = esc_attr($_POST['pass']);
    $user_confirm_pass = esc_attr($_POST['cpass']);
    
	$user_phone = esc_attr($_POST['user_phone']);
	$user_fname = esc_attr($_POST['user_fname']);
	$user_lname = esc_attr($_POST['user_lname']);
	$user_company_name = esc_attr($_POST['user_company_name']);
	$user_address1 = esc_attr($_POST['user_address1']);
	$user_address2 = esc_attr($_POST['user_address2']);
	$user_city = esc_attr($_POST['user_city']);
	$user_province = esc_attr($_POST['user_province']);
	$user_postal = esc_attr($_POST['user_postal']);
	$user_subscription_type = implode(',',$_POST['user_subscription_type']);
	
	
	
    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);
  
    if(!is_email($user_email)) 
       $errors[] = 'Invalid e-mail.<br>';
    elseif(email_exists($user_email)) 
       $errors[] = 'This email is already registered.<br>';
  
   /* if(empty($sanitized_user_login) || !validate_username($user_login)) 
       $errors[] = 'Invalid user name.<br>';
    elseif(username_exists($sanitized_user_login)) 
       $errors[] = 'User name already exists.<br>';*/
  $user_name = $user_email;
    if(empty($errors)):
      $user_id = wp_create_user( $user_name, $user_pass, $user_email);
  
    if(!$user_id):
      $errors[] = 'Registration failed';
    else:
      update_user_option($user_id, 'default_password_nag', true, true);
    //  wp_new_user_notification($user_id, $user_pass);
    $patterns = array();
 		$patterns[0] = '/{display_name}/';
 		$patterns[1] = '/{username}/';
 		$patterns[2] = '/{password}/';
 		$replacements = array();
 		$replacements[2] = $user_fname;
 		$replacements[1] = $user_name;
 		$replacements[0] = $user_pass;
    
 	$email_sub =  ot_get_option( 'account_welcome_email_subject' );
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'account_welcome_email_message' ));
	
	$attachments = array(WP_CONTENT_DIR . '/uploads/Administering_the_ELEVATE_Program.pdf');
	$headers = 'From: My Name <elevate@sarcan.sk.ca>' . "\r\n";
	wp_mail($user_email, $email_sub, $email_msg, $headers, $attachments); 
    
	  
	   if($user_subscription_type == '8184'){
	  $user_capabilities = 'a:1:{s:15:"individual_user";b:1;}';
		   if (is_user_logged_in()) {
		   $corporate_user_expiry = get_user_meta(get_current_user_id(), 'account_expiry_date', true);
		   }else{
		   $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
		   }
	  
	 }else if($user_subscription_type == '8205'){
	  $user_capabilities = 'a:1:{s:14:"corporate_user";b:1;}';
	   $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
	 }
	  
	  update_user_meta ($user_id, 'wp_capabilities', $user_capabilities);
	  update_user_meta ($user_id, 'corporate_user_id', get_current_user_id());
	  
	 
 
	  update_user_meta ($user_id, 'account_expiry_date', $corporate_user_expiry);
	  
      update_user_meta ($user_id, 'user_phone', $user_phone);
	  update_user_meta ($user_id, 'first_name', $user_fname);
	  update_user_meta ($user_id, 'last_name', $user_lname);
	  update_user_meta ($user_id, 'user_company_name', $user_company_name);
	  update_user_meta ($user_id, 'user_address1', $user_address1);
	  update_user_meta ($user_id, 'user_address2', $user_address2);
	  update_user_meta ($user_id, 'user_city', $user_city);
	  update_user_meta ($user_id, 'user_province', $user_province);
	  update_user_meta ($user_id, 'user_postal', $user_postal);
	  update_user_meta ($user_id, 'user_subscription_type', $user_subscription_type);
	  
    //  wp_cache_delete ($user_id, 'users');
    //  wp_cache_delete ($user_name, 'userlogins');
      do_action ('user_register', $user_id);
      $user_data = get_userdata ($user_id);
      if ($user_data !== false) {
         //wp_clear_auth_cookie();
        // wp_set_auth_cookie ($user_data->ID, true);
        // do_action ('wp_login', $user_data->user_login, $user_data);
         // Redirect user.
         wp_redirect ('?page_id=6');
         exit();
       }
      endif;
    endif;
  
    if(!empty($errors)) 
      define('REGISTRATION_ERROR', serialize($errors));
  endif;
}


global  $woothemes_sensei;
//define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
//include( MY_PLUGIN_PATH . 'sensei-course-progress/includes/class-sensei-course-progress-widget.php');

include_once( ABSPATH.'/wp-content/plugins/sensei-course-progress/includes/class-sensei-course-progress-widget.php' );

class My_Widget extends Sensei_Course_Progress_Widget {
	protected $woo_widget_cssclass;
	protected $woo_widget_description;
	protected $woo_widget_idbase;
	protected $woo_widget_title;

	/**
	 * Constructor function.
	 * @since  1.1.0
	 * @return  void
	 */
	public function __construct() {
		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'widget_sensei_course_progress';
		$this->woo_widget_description = __( 'Displays the current learners progress within the current course/module (only displays on single lesson page).', 'sensei-course-progress' );
		$this->woo_widget_idbase = 'sensei_course_progress';
		$this->woo_widget_title = __( 'Sensei - Course Progress', 'sensei-course-progress' );
		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => $this->woo_widget_idbase );

		/* Create the widget. */
		parent::__construct( $this->woo_widget_idbase, $this->woo_widget_title, $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {

		global $woothemes_sensei, $post, $current_user, $view_lesson, $user_taking_course;

        $allmodules = 'off';
		if ( isset( $instance['allmodules'] ) ) {
			$allmodules = $instance['allmodules'];
		}
		
		// If not viewing a lesson/quiz, don't display the widget
		if( !( ( is_singular('lesson') || is_singular('quiz') ) ) ) return;

		extract( $args );
		if ( is_singular('quiz') ) {
			$current_lesson_id = absint( get_post_meta( $post->ID, '_quiz_lesson', true ) );
		} else $current_lesson_id = $post->ID;

		// get the course for the current lesson/quiz
		$lesson_course_id = get_post_meta( $current_lesson_id, '_lesson_course', true );

		// Check if the user is taking the course
		$is_user_taking_course = WooThemes_Sensei_Utils::user_started_course( $lesson_course_id, $current_user->ID );

		//Check for preview lesson
		$is_preview = false;
		if ( method_exists( 'WooThemes_Sensei_Utils', 'is_preview_lesson' ) ) {
			$is_preview = WooThemes_Sensei_Utils::is_preview_lesson( $post->ID );
		}

		$course_title = get_the_title( $lesson_course_id );
		$course_url = get_the_permalink( $lesson_course_id );

		$in_module = false;
		$lesson_module = '';
		$lesson_array = array();

		if ( 0 < $current_lesson_id ) {
			// get an array of lessons in the module if there is one
			if( isset( Sensei()->modules ) && has_term( '', Sensei()->modules->taxonomy, $current_lesson_id ) ) {
				// Get all modules
    			$course_modules = Sensei()->modules->get_course_modules( $lesson_course_id );
				$lesson_module = Sensei()->modules->get_lesson_module( $current_lesson_id );
				$in_module = true;
				$current_module_title = htmlspecialchars( $lesson_module->name );

				// Display all modules
				if ( 'on' == $allmodules ) {
					foreach ($course_modules as $module) {
						// get all lessons in the module
						$args = array(
							'post_type' => 'lesson',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'meta_query' => array(
								array(
									'key' => '_lesson_course',
									'value' => intval( $lesson_course_id ),
									'compare' => '='
								)
							),
							'tax_query' => array(
								array(
									'taxonomy' => Sensei()->modules->taxonomy,
									'field' => 'id',
									'terms' => intval( $module->term_id )
								)
							),
							'meta_key' => '_order_module_' . intval( $module->term_id ),
							'orderby' => 'meta_value_num date',
							'order' => 'ASC'
						);
						$lesson_array = array_merge( $lesson_array, get_posts( $args) );
					}
				} else {
					// Only display current module
			    	// get all lessons in the current module
					$args = array(
						'post_type' => 'lesson',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key' => '_lesson_course',
								'value' => intval( $lesson_course_id ),
								'compare' => '='
							)
						),
						'tax_query' => array(
							array(
								'taxonomy' => Sensei()->modules->taxonomy,
								'field' => 'id',
								'terms' => $lesson_module
							)
						),
						'meta_key' => '_order_module_' . intval( $lesson_module->term_id ),
						'orderby' => 'meta_value_num date',
						'order' => 'ASC'
					);

					$lesson_array = get_posts( $args );
				}
			} else {
				// if there's no module, get all lessons in the course
				$lesson_array = Sensei()->course->course_lessons( $lesson_course_id );
			}
		}

		echo $before_widget; ?>

		<header>
			<?php /*?><h2 class="course-title"><a><?php echo $course_title; ?></a></h2><?php */?>

			<?php if ( $in_module && 'on' != $allmodules ) { ?>
				<h3 class="module-title"><?php echo $current_module_title ; ?></h3>
			<?php } ?>

		</header>

		<?php
		$nav_id_array = sensei_get_prev_next_lessons( $current_lesson_id );
		$previous_lesson_id = absint( $nav_id_array['prev_lesson'] );
		$next_lesson_id = absint( $nav_id_array['next_lesson'] );

		if ( ( 0 < $previous_lesson_id ) || ( 0 < $next_lesson_id ) ) { ?>

			<ul class="course-progress-navigation">
				<?php if ( 0 < $previous_lesson_id ) { ?><li class="prev"><a href="<?php echo esc_url( get_permalink( $previous_lesson_id ) ); ?>" title="<?php echo get_the_title( $previous_lesson_id ); ?>"><span><?php _e( 'Previous', 'sensei-course-progress' ); ?></span></a></li><?php } ?>
				<?php if ( 0 < $next_lesson_id ) { ?><li class="next"><a href="<?php echo esc_url( get_permalink( $next_lesson_id ) ); ?>" title="<?php echo get_the_title( $next_lesson_id ); ?>"><span><?php _e( 'Next', 'sensei-course-progress' ); ?></span></a></li><?php } ?>
			</ul>

		<?php } ?>

		<ul class="course-progress-lessons">

			<?php global $wpdb,$woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section;	
			 $per_page = 20;
	 $course_statuses = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'user_id' => get_current_user_id(), 'type' => 'sensei_course_status' ), true );
			// User may only be on 1 Course
			if ( !is_array($course_statuses) ) {
				$course_statuses = array( $course_statuses );
			}
	 $completed_ids = $active_ids = array();
			foreach( $course_statuses as $course_status ) {
				if ( WooThemes_Sensei_Utils::user_completed_course( $course_status, get_current_user_id() ) ) {
					$completed_ids[] = $course_status->comment_post_ID;
				} else {
					$active_ids[] = $course_status->comment_post_ID;
				}
			}
	 $active_count = $completed_count = 0;

			$active_courses = array();
			if ( 0 < intval( count( $active_ids ) ) ) {
				$my_courses_section = 'active';
				$active_courses = $woothemes_sensei->post_types->course->course_query( $per_page, 'usercourses', $active_ids );
				$active_count = count( $active_ids );
			} // End If Statement

	
						//echo $lessonlink;
		foreach ( $active_courses as $course_item ) {
			 $lesson_course_id = $course_item->ID;
						//$lesson_course_id = 7748;
						$lesson_array = array();
						$course_modules = Sensei()->modules->get_course_modules( $lesson_course_id );
						foreach ($course_modules as $module) {
						// get all lessons in the module
						$args = array(
							'post_type' => 'lesson',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'meta_query' => array(
								array(
									'key' => '_lesson_course',
									'value' => intval( $lesson_course_id ),
									'compare' => '='
								)
							),
							'tax_query' => array(
								array(
									'taxonomy' => Sensei()->modules->taxonomy,
									'field' => 'id',
									'terms' => intval( $module->term_id )
								)
							),
							'meta_key' => '_order_module_' . intval( $module->term_id ),
							'orderby' => 'meta_value_num date',
							'order' => 'ASC'
						);
						$lesson_array = array_merge( $lesson_array, get_posts( $args) );
					}
					//print_r($lesson_array);
					$getcountlesson = 0;
					$lastclick = 0;
					$total_lengthoflesson = 0;
					foreach($lesson_array as $row_getlessons)
					{
					$lessonid = $row_getlessons->ID;
					
						
						$getcountlesson = $wpdb->get_var(
						$wpdb->prepare(
						'SELECT COUNT(*) FROM `wp_comments` WHERE `user_id` = "'.get_current_user_id().'" and `comment_post_ID` = "'.$lessonid.'" and `comment_approved` IN("complete", "graded","passed")'
						)
						);
						
						//echo "<br>getcountlesson:".$getcountlesson;
						
						if($getcountlesson == 0 && $lastclick != 1){
							$lastclick = 1;
							$post_7 = get_post( $lessonid ); 
							//print_r($post_7);
							$lessontitle = $post_7->post_title;
							$lessonname = $post_7->post_name;							
							
							 $lessonlink1 = get_site_url().'/lesson/'.$lessonname;
							$lid =  $post_7->ID;
							
							}
							
							$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
							
							$total_lengthoflesson += $getlessonlength;
							
						
						
						}
						
				 }	
				 
				 

			$old_module = '';

			foreach( $lesson_array as $lesson ) {
				$lesson_id = $lesson->ID;
				$lesson_title = htmlspecialchars( $lesson->post_title );
				$lesson_url = get_the_permalink( $lesson_id );

				// add 'completed' class to completed lessons
				$classes = "not-completed";
				if( WooThemes_Sensei_Utils::user_completed_lesson( $lesson->ID, $current_user->ID ) ) {
					$classes = "completed";
				}

				// Lesson Quiz Meta
                $lesson_quiz_id = Sensei()->lesson->lesson_quizzes( $lesson_id );

				// add 'current' class on the current lesson/quiz
				if( $lesson_id == $post->ID || $lesson_quiz_id == $post->ID ) {
					$classes .= " current";
				}

				/*if ( isset( Sensei()->modules ) && 'on' == $allmodules ) {
					$new_module = Sensei()->modules->get_lesson_module( $lesson_id );
					if ( $old_module != $new_module ) {
						?>
						<li class="course-progress-module"><h3><?php echo $new_module->name; ?></h3></li>
						<?php
						$old_module = $new_module;
					}
				}*/
				
		$nav_id_array1 = sensei_get_prev_next_lessons( $lesson->ID );
		$previous_lesson_id1 = absint( $nav_id_array1['prev_lesson'] );
		$next_lesson_id1 = absint( $nav_id_array1['next_lesson'] );
				?>

				<li class="course-progress-lesson <?php echo end($lesson_array)->ID; ?> <?php echo $classes; ?>">
               
					<?php if($classes == 'completed' || $lesson->ID == $next_lesson_id1 ){
						echo '<a href="' . $lesson_url . '">' . $lesson_title . '</a>';
					} else if($classes == 'not-completed' && $lesson->ID == $lid ){
						echo '<a href="' . $lesson_url . '">' . $lesson_title . '</a>';
					} else if( $lesson->ID == $post->ID || $lesson_quiz_id == $post->ID || $classes != 'completed')  {
						echo '<span>' . $lesson_title . '</span>';
					}else{echo '<span>' . $lesson_title . '</span>';} ?>
                    
				</li>

			<?php } ?>

		</ul>

		<?php echo $after_widget;
	}

	}
	add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});
//	unregister_widget('Sensei_Course_Progress_Widget');
//register_widget( 'My_Widget' );
/*add_filter( 'wp_mail_content_type', 'set_html_content_type' );


function set_html_content_type() {
    return 'text/html';
}*/

function add_roles_on_init() {
   /* $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: test <info@test.co.uk>' . "\r\n";
	$message = '<div><p>The email body content</p></div>';
wp_mail( 'dipali@2webdesign.com', 'dddd', $message,$headers);*/  //// Send Mail to User

	
add_role('corporate_user', 'Corporate User', array(
    'read' => true, // True allows that capability
    'edit_posts' => true,
    'delete_posts' => false, // Use false to explicitly deny
));
add_role('individual_user', 'Individual User', array(
    'read' => true, // True allows that capability
    'edit_posts' => true,
    'delete_posts' => false, // Use false to explicitly deny
));
}
add_action('init', 'add_roles_on_init');
add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}


add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}else{ show_admin_bar(true);}
}

/*** Update user after registraion ***/

add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {
     global $woothemes_sensei;
     //   update_user_meta($user_id, 'corporate_user_id', get_current_user_id());
	 

	
		  $course_id = 7748;
		  if(!isset($_POST['group_individual_account'])){
		 $_POST['user_subscription_type'] = 'Corporate Account';
		  }
		
		if($_POST['user_subscription_type'] == 'Corporate Account'){
			$a = array('corporate_user'  => 1);			 
			  update_user_meta ($user_id, 'wp_capabilities', $a);	
        $result = WooThemes_Sensei_Utils::user_start_course( $user_id, $course_id );	
		 }
		elseif($_POST['user_subscription_type'] == 'Individual Course'){
			$b = array('individual_user' => 1);
			update_user_meta ($user_id, 'wp_capabilities', $b);	
		
			$result = WooThemes_Sensei_Utils::user_start_course( $user_id, $course_id );
					
			}else{
				$c = array('individual_user' => 1);
			  update_user_meta ($user_id, 'wp_capabilities', $c);
			   update_user_meta($user_id, 'corporate_user_id', get_current_user_id());
			   // update_user_meta($user_id, 'account_status', 'approved');
			  
			   	   if (is_user_logged_in()) {
				   $corporate_user_expiry = get_user_meta(get_current_user_id(), 'account_expiry_date', true);
				   }else{
				   $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				   }
				   update_user_meta ($user_id, 'account_expiry_date', $corporate_user_expiry);
				   
				   $result = WooThemes_Sensei_Utils::user_start_course( $user_id, $course_id );		
			}
			 
			//die();
			

}


remove_action('um_admin_user_action_hook', 'um_admin_user_action_hook');

add_action('um_admin_user_action_hook', 'custom_um_admin_user_action_hook');
	function custom_um_admin_user_action_hook( $action ){
		global $ultimatemember;
		
	//echo "jhgjg:".$action;
	switch ( $action ) {
			
			default:
				do_action("um_admin_custom_hook_{$action}", $ultimatemember->user->id );
				break;

			case 'um_put_as_pending':
				$ultimatemember->user->pending();
				break;
				
			case 'um_approve_membership':
				$ultimatemember->user->approve();
				/* $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				update_user_meta ($ultimatemember->user->id, 'account_expiry_date', $corporate_user_expiry);	
				
				 $corporate_name = get_the_author_meta( 'first_name', $ultimatemember->user->id )." ".get_the_author_meta( 'last_name', $ultimatemember->user->id );	
				
				$patterns = array();
				$patterns[0] = '/{display_name}/';
				$patterns[1] = '/{site_name}/';
				$patterns[2] = '/{admin_email}/';
				$replacements = array();
				$replacements[2] = $corporate_name;
				$replacements[1] = get_bloginfo ('name');
				$replacements[0] = get_bloginfo ('admin_email');		
		
		
		// Send email to user
  $headers = array('Content-Type: text/html; charset=UTF-8');
  			$email_sub = ot_get_option( 'email_subject_after_renew_approval_to_user' );
			 $email_msg = preg_replace($patterns, $replacements, ot_get_option( 'email_message_after_renew_approval_to_user' ));
	
	 		wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers); //// Send Mail to User */
			
			
				break;
			case 'um_reenable':
				$ultimatemember->user->approve();
				break;
				
			case 'um_reject_membership':
				$ultimatemember->user->reject();
				break;
				
			case 'um_resend_activation':
				$ultimatemember->user->email_pending();
				break;
				
			case 'um_deactivate':
				$ultimatemember->user->deactivate();
				break;
				
			case 'um_delete':
				if ( is_admin() )
					wp_die('This action is not allowed in backend.','ultimatemember');
				$ultimatemember->user->delete();
				break;

		}
	
	 
		
	}
	

/*** Update user after registraion ***/

function remove_anonymous_action( $name, $class, $method ){
        $actions = $GLOBALS['wp_filter'][ $name];
      /*  echo "<pre>";
        print_r($actions);
        echo "</pre>";*/
        if ( empty ( $actions ) ){
            return;
        }
        foreach ( $actions as $prity => $action ){
            foreach ( $action as $identifier => $function ){
                if ( is_array( $function) && is_a( $function['function'][0], $class ) && $method === $function['function'][1]){
                  print_r($function['function'][0]);
                  print_r($method);
                    remove_action($tag, array ( $function['function'][0], $method ), $prity);
                }
            }
        }
}

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">
    <?php if(get_the_author_meta( 'group_individual_account', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Group/Individual Account:</label></th>

			<td>
            <select name="group_individual_account" id="group_individual_account">
            <option value="Group Account" <?php if(get_the_author_meta( 'group_individual_account', $user->ID ) == 'Group Account'){ echo "selected"; }?>>Group Account</option>
            <option value="Individual Account" <?php if(get_the_author_meta( 'group_individual_account', $user->ID ) == 'Individual Account'){ echo "selected"; }?>>Individual Account</option>
            </select>				
				
			</td>
		</tr>
        <?php } ?>
<?php if(get_the_author_meta( 'user_subscription_type', $user->ID ) != ''){ ?>
		<tr>
			<th><label for="phone-number">Subscription Type:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_subscription_type', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_company_name', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Company Name:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_company_name', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'phone-number', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Phone Number:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'phone-number', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'address1', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Address1:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'address1', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'address2', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Address2:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'address2', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_city', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">City:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_city', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_province', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Province:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_province', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_postal_code', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Postal Code:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_postal_code', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
        
        <tr>
			<th><label for="phone-number">Billing Address1:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_address1', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing Address2:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_address2', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing City:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_city', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing Province:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_province', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing Postal Code:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_postalcode', $user->ID ) ); ?><br />
				
			</td>
		</tr>
         <?php if(get_the_author_meta( 'billing_payment_method', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Payment Method:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_payment_method', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'registration_fees', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Registration Fees:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'registration_fees', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
        <?php if(get_the_author_meta( 'credit_card_number', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Credit Card Number:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'credit_card_number', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'billing_cvv', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">CVV:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_cvv', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'expiry_month', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Expiry Month:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'expiry_month', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'expiry_year', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Expiry Year:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'expiry_year', $user->ID ) ); ?><br />
				
			</td>
		</tr>
		<?php } ?>
        
	</table>
<?php } 
add_action( 'personal_options_update', 'update_extra_profile_fields' );

// Hook is used to save custom fields that have been added to the WordPress profile page (if not current user) 
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );

function update_extra_profile_fields( $user_id ) {
    if ( current_user_can( 'edit_user', $user_id ) )
	{
        update_user_meta( $user_id, 'group_individual_account', $_POST['group_individual_account']);
	}
}



remove_action('um_post_registration_listener', 'um_post_registration_listener', 10, 2);
add_action('um_post_registration_listener', 'custom_um_post_registration_listener', 10, 2);
	function custom_um_post_registration_listener($user_id, $args){
		global $ultimatemember;
		//um_user('status') = 'approved';
		if ( um_user('status') == 'pending' ) {
			$ultimatemember->mail->send( um_admin_email(), 'notification_new_user', array('admin' => true ) );
		} else {
			$ultimatemember->mail->send( um_admin_email(), 'notification_review', array('admin' => true ) );
		}

	}

/***
	***	@post-registration procedure
	***/
	remove_action('um_post_registration', 'um_post_registration', 10, 2);
	add_action('um_post_registration', 'custom_um_post_registration', 10, 2);
	function custom_um_post_registration($user_id, $args){
		global $ultimatemember;
		extract($args);
	
		//echo $status = um_user('status'); 
			$group_individual_account = $_POST['group_individual_account'];
		
	update_user_meta ($user_id, 'group_individual_account', $group_individual_account[0]);
		$corporate_or_individual_usr = get_the_author_meta( 'group_individual_account', $user_id );
	
		if($corporate_or_individual_usr != ''){
			$status = 'approved';	
		 $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				update_user_meta ($ultimatemember->user->id, 'account_expiry_date', $corporate_user_expiry);
			
			}	
		else{
				$status = '';
			update_user_meta ($ultimatemember->user->id, 'account_status', 'approved');
			$corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				update_user_meta ($ultimatemember->user->id, 'account_expiry_date', $corporate_user_expiry);
	
		$ultimatemember->mail->send( um_user('user_email'), 'pending_email' );
			
			}
		
			
		
		do_action("um_post_registration_global_hook", $user_id, $args);

		do_action("um_post_registration_{$status}_hook", $user_id, $args);

		if ( !is_admin() ) {

			do_action("track_{$status}_user_registration");

			// Priority redirect
			if ( isset( $args['redirect_to'] ) ) {
				exit( wp_redirect(  urldecode( $args['redirect_to'] ) ) );
			}

			if ( $status == 'approved' ) {

			//	$ultimatemember->user->auto_login($user_id);
				if ( um_user('auto_approve_act') == 'redirect_url' && um_user('auto_approve_url') !== '' ) exit( wp_redirect( home_url() ) );
				if ( um_user('auto_approve_act') == 'redirect_profile' ) exit( wp_redirect( home_url() ) );

			}

			if ( ($status != 'approved') && ( $status != '') ) {

				if ( um_user( $status . '_action' ) == 'redirect_url' && um_user( $status . '_url' ) != '' ) {
					exit( wp_redirect( um_user( $status . '_url' ) ) );
				}

				if ( um_user( $status . '_action' ) == 'show_message' && um_user( $status . '_message' ) != '' ) {
					$url = $ultimatemember->permalinks->get_current_url();
					$url =  add_query_arg( 'message', esc_attr( $status ), $url );
					$url =  add_query_arg( 'uid', esc_attr( um_user('ID') ), $url );

					exit( wp_redirect( $url ) );
				}

			}else{
					update_user_meta ($ultimatemember->user->id, 'account_status', 'approved');
				exit( wp_redirect( home_url() ) );}

		}

	}
	
function wpse_19692_registration_redirect() {
    return '<a href="'.esc_url("/programs/ELEVATE").'">Learn More</a> | <a href="'.esc_url( home_url( "/register-2" ) ).'">Register</a>';
}

add_filter( 'register', 'wpse_19692_registration_redirect' );

function my_pre_save_post( $post_id ) {
  if($post_id == '8348'){
  $group_account_user_array = array();
  foreach($_POST['fields'] as $fieldvalue){
    foreach($fieldvalue as $field){
      if(!empty($field['field_56e0838974def'])){
        $group_user_addon_name = $field['field_56e0838974def']." ".$field['field_56e0839274df0'];
        array_push($group_account_user_array,$group_user_addon_name);
      }
    }

  }
   add_user_meta (get_current_user_id(), 'group_account_users_certificate_data', serialize($group_account_user_array));
  
/*  echo "<pre>";
  print_r(get_user_meta('32','group_account_users_certificate_data'));
die();  */
  wp_redirect ('/elevate/add-certificate-users-success');
  die();
  
}
  //echo "Asdfasdfasd11f"; die();
    

}

add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );


if ( class_exists( 'WooThemes_Sensei_Certificates' ) ) {
 	global $woothemes_sensei_certificates;

   if(has_action( 'sensei_certificates_before_pdf_output' )){
     remove_action( 'sensei_certificates_before_pdf_output', array( $woothemes_sensei_certificates, 'certificate_text' ), 10, 2);
	 // Text to display on certificate
		add_action( 'sensei_certificates_before_pdf_output', 'custom_certificate_text' , 10, 2 );
    // $addaction = add_action( 'template_redirect','custom_download_certificate');  
   }
}



	function custom_certificate_text( $pdf_certificate, $fpdf ) {
		global $woothemes_sensei_certificates;
		//echo "adfadsfasdfasfasdfsd"; die();
		$show_border = apply_filters( 'woothemes_sensei_certificates_show_border', 0 );
		$start_position = 200;

		// Find certificate based on hash
		$args = array(
			'post_type' => 'certificate',
			'meta_key' => 'certificate_hash',
			'meta_value' => $pdf_certificate->hash
		);

		$query = new WP_Query( $args );
		$certificate_id = 0;

		if ( $query->have_posts() ) {

			$query->the_post();
			$certificate_id = $query->posts[0]->ID;

		} // End If Statement

		wp_reset_query();

		if ( 0 < intval( $certificate_id ) ) {

			// Get Student Data
			$user_id = get_post_meta( $certificate_id, 'learner_id', true );
			$student = get_userdata( $user_id );
			$student_name = $student->display_name;
			$fname = $student->first_name;
			$lname = $student->last_name;
			$company_name = $student->user_company_name;
			$corporate_user_id = $student->corporate_user_id;
			
			if($corporate_user_id != ''){
				
				$corporate = get_userdata( $corporate_user_id );
				
			$company_name = $corporate->user_company_name;
				}

			if ( '' != $fname && '' != $lname ) {
				$student_name = $fname . ' ' . $lname;
			}
			

			$success = get_user_meta(get_current_user_id(),'group_account_users_certificate_data');
			//$success_users = unserialize($success[0]);
			
			$all_users = array();
			
			foreach($success as $success_users_all){
					$success_users = unserialize($success_users_all);
					//print_r($success_users);
					foreach($success_users as $succ_individuals){
						array_push($all_users,$succ_individuals);
					}
					
				}

			foreach($all_users as $key => $value){
				if($_GET['adminoption'] == $key){
					$student_name =  $value;
				}
			}
			

			// Get Course Data
			$course_id = get_post_meta( $certificate_id, 'course_id', true );
			$course = Sensei()->course->course_query( -1, 'usercourses', $course_id );
			$course = $course[0];
			$course_end = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'post_id' => intval( $course_id ), 'user_id' => intval( $user_id ), 'type' => 'sensei_course_status' ), true );
			$course_end_date = $course_end->comment_date;

			// Get the certificate template
			$certificate_template_id = get_post_meta( $course_id, '_course_certificate_template', true );

			$certificate_template_custom_fields = get_post_custom( $certificate_template_id );

			// Define the data we're going to load: Key => Default value
			$load_data = array(
				'certificate_font_style'	=> array(),
				'certificate_font_color'	=> array(),
				'certificate_font_size'	=> array(),
				'certificate_font_family'	=> array(),
				'image_ids'            => array(),
				'certificate_template_fields'       => array(),
			);

			// Load the data from the custom fields
			foreach ( $load_data as $key => $default ) {

				// set value from db (unserialized if needed) or use default
				$woothemes_sensei_certificates->$key = ( isset( $certificate_template_custom_fields[ '_' . $key ][0] ) && '' !== $certificate_template_custom_fields[ '_' . $key ][0] ) ? ( is_array( $default ) ? maybe_unserialize( $certificate_template_custom_fields[ '_' . $key ][0] ) : $certificate_template_custom_fields[ '_' . $key ][0] ) : $default;

			} // End For Loop

			// Set default fonts
			if ( isset( $woothemes_sensei_certificates->certificate_font_color ) && '' != $woothemes_sensei_certificates->certificate_font_color ) { $pdf_certificate->certificate_pdf_data['font_color'] = $woothemes_sensei_certificates->certificate_font_color; }
			if ( isset( $woothemes_sensei_certificates->certificate_font_size ) && '' != $woothemes_sensei_certificates->certificate_font_size ) { $pdf_certificate->certificate_pdf_data['font_size'] = $woothemes_sensei_certificates->certificate_font_size; }
			if ( isset( $woothemes_sensei_certificates->certificate_font_family ) && '' != $woothemes_sensei_certificates->certificate_font_family ) { $pdf_certificate->certificate_pdf_data['font_family'] = $woothemes_sensei_certificates->certificate_font_family; }
			if ( isset( $woothemes_sensei_certificates->certificate_font_style ) && '' != $woothemes_sensei_certificates->certificate_font_style ) { $pdf_certificate->certificate_pdf_data['font_style'] = $woothemes_sensei_certificates->certificate_font_style; }

			// Set default fonts
			setlocale(LC_TIME, get_locale() );

			if( false !== strpos( get_locale(), 'en' ) ) {
				$date_format = apply_filters( 'sensei_certificate_date_format', 'jS F Y' );
				$date = date( $date_format, strtotime( $course_end_date ) );
			} else {
				$date_format = apply_filters( 'sensei_certificate_date_format', '%Y %B %e' );
				$date = strftime ( $date_format, strtotime( $course_end_date ) );
			}
			
			

			$certificate_heading = __( 'Certificate of Completion', 'sensei-certificates' ); // Certificate of Completion
			if ( isset( $woothemes_sensei_certificates->certificate_template_fields['certificate_heading']['text'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields['certificate_heading']['text'] ) {

				$certificate_heading = $woothemes_sensei_certificates->certificate_template_fields['certificate_heading']['text'];
				//$certificate_heading = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, get_bloginfo( 'name' ) ) , $certificate_heading );
				$certificate_heading = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, $company_name ) , $certificate_heading );
			} // End If Statement

			$certificate_message = __( 'This is to certify that', 'sensei-certificates' ) . " \r\n\r\n" . $student_name . " \r\n\r\n" . __( 'has completed the course', 'sensei-certificates' ); // This is to certify that {{learner}} has completed the course
			if ( isset( $woothemes_sensei_certificates->certificate_template_fields['certificate_message']['text'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields['certificate_message']['text'] ) {

				$certificate_message = $woothemes_sensei_certificates->certificate_template_fields['certificate_message']['text'];
				//$certificate_message = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, get_bloginfo( 'name' ) ) , $certificate_message );
				$certificate_message = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, $company_name ) , $certificate_message );

			} // End If Statement

			$certificate_course = $course->post_title; // {{course_title}}
			if ( isset( $woothemes_sensei_certificates->certificate_template_fields['certificate_course']['text'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields['certificate_course']['text'] ) {

				$certificate_course = $woothemes_sensei_certificates->certificate_template_fields['certificate_course']['text'];
				//$certificate_course = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, get_bloginfo( 'name' ) ) , $certificate_course );
				$certificate_course = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, $company_name ) , $certificate_course );

			} // End If Statement

			$certificate_completion = $date; // {{completion_date}}
			if ( isset( $woothemes_sensei_certificates->certificate_template_fields['certificate_completion']['text'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields['certificate_completion']['text'] ) {

				$certificate_completion = $woothemes_sensei_certificates->certificate_template_fields['certificate_completion']['text'];
				//$certificate_completion = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, get_bloginfo( 'name' ) ) , $certificate_completion );
				$certificate_completion = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, $company_name ) , $certificate_completion );

			} // End If Statement

			$certificate_place = sprintf( __( 'At %s', 'sensei-certificates' ), get_bloginfo( 'name' ) ); // At {{course_place}}
			if ( isset( $woothemes_sensei_certificates->certificate_template_fields['certificate_place']['text'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields['certificate_place']['text'] ) {

				$certificate_place = $woothemes_sensei_certificates->certificate_template_fields['certificate_place']['text'];
				//$certificate_place = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, get_bloginfo( 'name' ) ) , $certificate_place );
				$certificate_place = str_replace( array( '{{learner}}', '{{course_title}}', '{{completion_date}}', '{{course_place}}'  ), array( $student_name, $course->post_title, $date, $company_name ) , $certificate_place );

			} // End If Statement
			
			

			$output_fields = array(	'certificate_heading' 		=> 'text_field',
									'certificate_message' 		=> 'textarea_field',
									'certificate_course'		=> 'text_field',
									'certificate_completion' 	=> 'text_field',
									'certificate_place' 		=> 'text_field',
									'organization' 		=> 'text_field'
								 );

			foreach ( $output_fields as $meta_key => $function_name ) {

				// Check if the field has a set position
				if ( isset( $woothemes_sensei_certificates->certificate_template_fields[$meta_key]['position']['x1'] ) ) {

					$font_settings = get_certificate_font_settings( $meta_key );

					call_user_func_array(array($pdf_certificate, $function_name), array( $fpdf, $$meta_key, $show_border, array( $woothemes_sensei_certificates->certificate_template_fields[$meta_key]['position']['x1'], $woothemes_sensei_certificates->certificate_template_fields[$meta_key]['position']['y1'], $woothemes_sensei_certificates->certificate_template_fields[$meta_key]['position']['width'], $woothemes_sensei_certificates->certificate_template_fields[$meta_key]['position']['height'] ), $font_settings ));

				} // End If Statement

			} // End For Loop

		} else {

			wp_die( __( 'The certificate you are searching for does not exist.', 'sensei-certificates' ), __( 'Certificate Error', 'sensei-certificates' ) );

		} // End If Statement

	} // End certificate_text()
 function get_certificate_font_settings( $field_key = '' ) {
		global $woothemes_sensei_certificates;
		$return_array = array();

		if ( isset( $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['color'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['color'] ) {
			$return_array['font_color'] = $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['color'];
		} // End If Statement

		if ( isset( $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['family'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['family'] ) {
			$return_array['font_family'] = $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['family'];
		} // End If Statement

		if ( isset( $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['style'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['style'] ) {
			$return_array['font_style'] = $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['style'];
		} // End If Statement

		if ( isset( $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['size'] ) && '' != $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['size'] ) {
			$return_array['font_size'] = $woothemes_sensei_certificates->certificate_template_fields[$field_key]['font']['size'];
		} // End If Statement

		return $return_array;

	} // End get_certificate_font_settings()


/* Start - Learner Custom Column*/	

  add_filter('sensei_learners_main_column_data', 'sensei_learners_main_column_data_customadmin',10,4);

  function sensei_learners_main_column_data_customadmin( $variable,$variable1,$variable2,$variable3 ) {
    
    if(empty($_GET['lesson_id'])){
    
    global $wp_version, $woothemes_sensei;
	$user_activity = $variable1;
	$course_lessons = $woothemes_sensei->post_types->course->course_lessons( $user_activity->comment_post_ID );
	$lessons_completed = 0;
	foreach ( $course_lessons as $lesson ) {
		if ( WooThemes_Sensei_Utils::user_completed_lesson( $lesson->ID, $user_activity->user_id ) ) {
			++$lessons_completed;
		}
	}
	
	
	if( 'complete' == $user_activity->comment_approved || 'graded' == $user_activity->comment_approved || 'passed' == $user_activity->comment_approved ) {

            $status_html = '<span class="graded 1">' . $lessons_completed . ' Modules Completed</span>';

} else {

            $status_html = '<span class="in-progress 2">' . $lessons_completed . ' Modules Completed</span>';

}
    $variable['user_status'] = $status_html;
    
    return $variable;
  }
  else
    return $variable;
    
  }
  
 /* End - Learner Custom Column*/	 
  
function func_sensei_learners_default_columns( $column ) {
    $column['abc'] = 'Current Status (of Module)';
    return $column;
}
//add_filter( 'sensei_learners_default_columns', 'func_sensei_learners_default_columns' );


function new_modify_sensei_learners_table_row($columns ) {
	//print_r($columns);
	//global $woothemes_sensei;
	//$columns['abc']='test';
	//$user_id = get_current_user_id();
	//$i=0;
	//echo "-".$user_id;
	
	/*$course_lessons = $woothemes_sensei->post_types->course->course_lessons( '7748' );
					$lessons_completed = 0;
					foreach ( $course_lessons as $lesson ) {
						if ( WooThemes_Sensei_Utils::user_completed_lesson( $lesson->ID, $user_id ) ) {
							++$lessons_completed;
						}
					}*/
	
	
	//$columns['abc']=$lessons_completed." Modules Completed.";
	
	//print_r($columns);
	//return $column_data = $columns;
	
	
	/*$user = get_userdata( $user_id );
    switch ($column_name) {
        case 'abc' :
		echo $column_data[$column_name];
		break;        
    }
    return $return;*/
}

//add_filter( 'sensei_learners_main_column_data', 'new_modify_sensei_learners_table_row', 10, 1 );


/* End - Learner Custom Column*/

function new_modify_user_table( $column ) {
    $column['group_individual_account'] = 'Group/Individual Account';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    $user = get_userdata( $user_id );
    switch ($column_name) {
        case 'group_individual_account' :
		
		$corporate_user_id = get_the_author_meta( 'corporate_user_id', $user_id );
		$corporate_nm = get_the_author_meta( 'first_name', $corporate_user_id )." ".get_the_author_meta( 'last_name', $corporate_user_id );
            $is_account_group = get_the_author_meta( 'group_individual_account', $user_id );
			if($corporate_user_id != ''){$is_account_group .= "<br>Linked to: ".$corporate_nm; }
			return $is_account_group;
            break;        
        default:
    }
    return $return;
}

add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );
//////// CRON ////////

add_filter( 'cron_schedules', 'example_add_cron_interval' );
 
function example_add_cron_interval( $schedules ) {
    $schedules['5min'] = array(
        'interval' => 5*60,
        'display'  => esc_html__( 'Once every 5 minutes' ),
    );
 
    return $schedules;
}

if ( ! wp_next_scheduled( 'my_task_hook1' ) ) {
 // wp_schedule_event( time(), 'daily', 'my_task_hook' );
 wp_schedule_event(time(), '5min', 'my_task_hook1');
// wp_schedule_event(strtotime(date('Y-m-d 00:01:00')), 'hourly', 'my_task_hook');
}

add_action( 'my_task_hook1', 'my_task_function1' );

function my_task_function1() {
	
	$headers = array('Content-Type: text/html; charset=UTF-8','CC: deepalidesai31188@gmail.com');
	// wp_mail( 'dipali@2webdesign.com', 'Test email daily', '<p>Test Message email daily new.</p>',$headers);
	
	 $email_sub = '';
	$email_msg = '';
		$userid = '246';
	 $account_status = get_the_author_meta( 'account_status', $userid );
	  $corporate_name = get_the_author_meta( 'user_company_name', $userid );
	if($account_status == 'approved'){
	$account_expiry_date = get_the_author_meta( 'account_expiry_date', $userid );
	
	$dStart = new DateTime($account_expiry_date);
   $dEnd  = new DateTime(date('Y-m-d'));
   $dDiff = $dStart->diff($dEnd);
  
   $datediff = $dDiff->days;
   $patterns = array();
		$patterns[0] = '/{display_name}/';
		$patterns[1] = '/{site_name}/';
		$patterns[2] = '/{admin_email}/';
		$replacements = array();
		$replacements[2] = $corporate_name;
		$replacements[1] = get_bloginfo ('name');
		$replacements[0] = get_bloginfo ('admin_email');
   if($datediff == 30){
	$email_sub =  ot_get_option( 'renew_warning_email_subject' );
	
		
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'renew_warning_email_message' ));
	 wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers);  //// Send Mail to User
	 
	 /// Send email to admin
	 
	/* $email_sub_admin =  ot_get_option( 'expiration_warning_email_subject_for_admin' );
	
		
	$email_msg_admin = preg_replace($patterns, $replacements, ot_get_option( 'expiration_warning_email_message_for_admin' ));
	 wp_mail( 'dipali@2webdesign.com', $email_sub_admin, $email_msg_admin,$headers);  //// Send Mail to Admin */
	 
	 
	}
	if($account_expiry_date <= date('Y-m-d')){		
		update_user_meta ($userid, 'account_status', 'Inactive');
		$email_sub = ot_get_option( 'expiration_account_email_subject' );
$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'expiration_account_email_message' ));

	 wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers);  //// Send Mail to User
	 
	  /// Send email to admin
	 
	/* $email_sub_admin =  ot_get_option( 'expiration_account_email_subject_for_admin' );
	
		
	$email_msg_admin = preg_replace($patterns, $replacements, ot_get_option( 'expiration_account_email_message_for_admin' ));
	 wp_mail( 'dipali@2webdesign.com', $email_sub_admin, $email_msg_admin,$headers);  //// Send Mail to Admin */
	 
		}
	
	
 
  
  
  
  //// Send Mail To Subuser
  
$patterns1 = array();
		$patterns1[0] = '/{display_name}/';
		$patterns1[1] = '/{site_name}/';
		$patterns1[2] = '/{admin_email}/';
		$replacements1 = array();
		$replacements1[2] = $corporate_name;
		$replacements1[1] = get_bloginfo ('name');
		$replacements1[0] = get_bloginfo ('admin_email');
  
  $args = array(
    'meta_query' => array(
	  'relation' => 'AND',
        array(
            'key' => 'corporate_user_id',
            'value' => $userid,
            'compare' => '='
        ),
		array(
            'key' => 'account_status',
            'value' => 'approved',
            'compare' => '='
        )
    )
);

$sub_users = get_users( $args );
  
  foreach ( $sub_users as $subuser ) {
	
	$email_sub = '';
	$email_msg = '';
	$userid = $subuser->ID;
	 $subuser_name = get_the_author_meta( 'first_name', $userid )." ".get_the_author_meta( 'last_name', $userid );
		 
	$account_expiry_date = get_the_author_meta( 'account_expiry_date', $userid );
	
	$dStart = new DateTime($account_expiry_date);
   $dEnd  = new DateTime(date('Y-m-d'));
   $dDiff = $dStart->diff($dEnd);
  
   $datediff = $dDiff->days;
   if($datediff == 30){
	$email_sub = ot_get_option( 'renew_warning_email_subject' );
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'renew_warning_email_message' ));
	
	 wp_mail( 'dipali@2webdesign.com	', $email_sub, $email_msg,$headers); //// Send Mail to sub User
	
	}
	if($account_expiry_date <= date('Y-m-d')){		
		update_user_meta ($userid, 'account_status', 'Inactive');
		$email_sub = ot_get_option( 'expiration_account_email_subject' );
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'expiration_account_email_message' ));
	
	 wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers);  //// Send Mail to sub User
		}
	
	  //// Send Mail To Admin
 
  
   } // / End For Loop for sub users
  
} //// End If condition
//} //// End for loop for corporate users
   
 }

/*add_filter( 'cron_schedules', 'example_add_cron_interval' );
 
function example_add_cron_interval( $schedules ) {
    $schedules['5min'] = array(
        'interval' => 5*60,
        'display'  => esc_html__( 'Once every 5 minutes' ),
    );
 
    return $schedules;
}



if ( ! wp_next_scheduled( 'my_task_hook1' ) ) {
 // wp_schedule_event( time(), 'daily', 'my_task_hook' );
 wp_schedule_event(time(), 'daily', 'my_task_hook1');
// wp_schedule_event(strtotime(date('Y-m-d 00:01:00')), 'hourly', 'my_task_hook');
}
*/
/*add_action( 'my_task_hook1', 'my_task_function1' );

function my_task_function1() {
	echo "done";
	 wp_mail( 'hardik@2webdesign.com', 'Test email daily', 'Test Message email daily.');
   
 }*/


/*add_action( 'my_task_hook', 'symbiocards_activation' );
add_action( 'symbiocards_hourly_event', 'update_symbiocards' );

function symbiocards_activation() {
  echo "asdfsdafasdf";
    if ( !wp_next_scheduled( 'symbiocards_hourly_event' ) ) {
      echo "23432432";
        wp_schedule_event( time(), 'hourly', 'symbiocards_hourly_event' );
    }
}

function update_symbiocards() {
  //  wp_mail( get_bloginfo( 'admin_email' ), '[symbiostock_network_update] Network Symbiocards Updated - ' . current_time( 'mysql' ), 'Network Symbiocards Updated - ' . current_time( 'mysql' ) );
  
   wp_mail( 'dipali@2webdesign.com', 'Test email', 'Test Message email new funtion.');
}

*/

//if ( ! wp_next_scheduled( 'my_task_hook' ) ) {
 // echo "Asdfasdfasdfsadf";
 // wp_schedule_event( time(), 'daily', 'my_task_hook' );
// wp_schedule_event(strtotime(date('Y-m-d 00:01:00')), 'hourly', 'my_task_hook');
//}

//add_action( 'my_task_hook', 'my_task_function' );

function my_task_function() {
	
	// wp_mail( 'hardik@2webdesign.com', 'Test email', 'Test Message email11111.');
	//$blogusers = get_users( 'orderby=id&role=corporate_user' );
// Array of WP_User objects.
//foreach ( $blogusers as $user ) {
	
	//$userid = $user->ID;
	/*$email_sub = '';
	$email_msg = '';
		$userid = '123';
	 $account_status = get_the_author_meta( 'account_status', $userid );
	  $corporate_name = get_the_author_meta( 'first_name', $userid )." ".get_the_author_meta( 'last_name', $userid );
	if($account_status == 'approved'){
	$account_expiry_date = get_the_author_meta( 'account_expiry_date', $userid );
	
	$dStart = new DateTime($account_expiry_date);
   $dEnd  = new DateTime(date('Y-m-d'));
   $dDiff = $dStart->diff($dEnd);
  
   $datediff = $dDiff->days;
   $patterns = array();
		$patterns[0] = '/{display_name}/';
		$patterns[1] = '/{site_name}/';
		$patterns[2] = '/{admin_email}/';
		$replacements = array();
		$replacements[2] = $corporate_name;
		$replacements[1] = get_bloginfo ('name');
		$replacements[0] = get_bloginfo ('admin_email');
   if($datediff == 30){
	$email_sub =  ot_get_option( 'renew_warning_email_subject' );
	
		
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'renew_warning_email_message' ));
	 wp_mail( $user->user_email, $email_sub, $email_msg);  //// Send Mail to User
	}
	if($account_expiry_date <= date('Y-m-d')){		
		update_user_meta ($userid, 'account_status', 'Inactive');
		$email_sub = ot_get_option( 'expiration_account_email_subject' );
$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'expiration_account_email_message' ));

	 wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg);  //// Send Mail to User
		}
	
	
 
  
  
  
  //// Send Mail To Admin
  
$patterns1 = array();
		$patterns1[0] = '/{display_name}/';
		$patterns1[1] = '/{site_name}/';
		$patterns1[2] = '/{admin_email}/';
		$replacements1 = array();
		$replacements1[2] = $corporate_name;
		$replacements1[1] = get_bloginfo ('name');
		$replacements1[0] = get_bloginfo ('admin_email');
  
  $args = array(
    'meta_query' => array(
	  'relation' => 'AND',
        array(
            'key' => 'corporate_user_id',
            'value' => $userid,
            'compare' => '='
        ),
		array(
            'key' => 'account_status',
            'value' => 'approved',
            'compare' => '='
        )
    )
);

$sub_users = get_users( $args );
  
  foreach ( $sub_users as $subuser ) {
	
	$email_sub = '';
	$email_msg = '';
	$userid = $subuser->ID;
	 $subuser_name = get_the_author_meta( 'first_name', $userid )." ".get_the_author_meta( 'last_name', $userid );
		 
	$account_expiry_date = get_the_author_meta( 'account_expiry_date', $userid );
	
	$dStart = new DateTime($account_expiry_date);
   $dEnd  = new DateTime(date('Y-m-d'));
   $dDiff = $dStart->diff($dEnd);
  
   $datediff = $dDiff->days;
   if($datediff == 30){
	$email_sub = ot_get_option( 'renew_warning_email_subject' );
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'renew_warning_email_message' ));
	
	 wp_mail( $subuser->user_email, $email_sub, $email_msg); //// Send Mail to sub User
	
	}
	if($account_expiry_date <= date('Y-m-d')){		
		update_user_meta ($userid, 'account_status', 'Inactive');
		$email_sub = ot_get_option( 'expiration_account_email_subject' );
	$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'expiration_account_email_message' ));
	
	 wp_mail( $subuser->user_email, $email_sub, $email_msg);  //// Send Mail to sub User
		}
	
	  //// Send Mail To Admin
 
  
   } // / End For Loop for sub users
  
} //// End If condition
//} //// End for loop for corporate users*/
  
} /// End Function


//////// CRON ////////



	remove_action('um_submit_form_register', 'um_submit_form_register', 10);
	add_action('um_submit_form_register', 'custom_um_submit_form_register', 10);
	function custom_um_submit_form_register($args){
		
		global $ultimatemember;
		if($_GET['renew'] == '1'){
			if ( !isset($ultimatemember->form->errors) ){
			global $current_user;

			 $userid = $current_user->ID;
				$user_phone = esc_attr($_POST['phone-number-8285']);
				$user_fname = esc_attr($_POST['first_name-8285']);
				$user_lname = esc_attr($_POST['last_name-8285']);
				$user_company_name = esc_attr($_POST['user_company_name-8285']);
				$user_address1 = esc_attr($_POST['address1-8285']);
				$user_address2 = esc_attr($_POST['address2-8285']);
				$user_city = esc_attr($_POST['user_city-8285']);
				$user_province = esc_attr($_POST['user_province-8285']);
				$user_postal = esc_attr($_POST['user_postal_code-8285']);
				
				$billing_address1 = esc_attr($_POST['billing_address1-8285']);
				$billing_address2 = esc_attr($_POST['billing_address2-8285']);
				$billing_city = esc_attr($_POST['billing_city-8285']);
				$billing_province = esc_attr($_POST['billing_province-8285']);
				$billing_postalcode = esc_attr($_POST['billing_postalcode-8285']);
				
				$billing_payment_method = $_POST['billing_payment_method'];
				$credit_card_number = esc_attr($_POST['credit_card_number-8285']);
				$billing_cvv = esc_attr($_POST['billing_cvv-8285']);
				$expiry_month = esc_attr($_POST['expiry_month-8285']);
				$expiry_year = esc_attr($_POST['expiry_year-8285']);
				
				
				
	
				$account_expiry_date = get_the_author_meta( 'account_expiry_date', $userid );
			
				$corporate_user_expiry = date('Y-m-d', strtotime(date("Y-m-d", strtotime($account_expiry_date)) . " +1 year"));
				
				update_user_meta ($userid, 'account_expiry_date', $corporate_user_expiry);	
				update_user_meta ($userid, 'account_status', 'approved');	  
				update_user_meta ($userid, 'phone-number', $user_phone);
				update_user_meta ($userid, 'first_name', $user_fname);
				update_user_meta ($userid, 'last_name', $user_lname);
				update_user_meta ($userid, 'user_company_name', $user_company_name);
				update_user_meta ($userid, 'address1', $user_address1);
				update_user_meta ($userid, 'address2', $user_address2);
				update_user_meta ($userid, 'user_city', $user_city);
				update_user_meta ($userid, 'user_province', $user_province);
				update_user_meta ($userid, 'user_postal', $user_postal);
				
				update_user_meta ($userid, 'billing_address1', $billing_address1);
				update_user_meta ($userid, 'billing_address2', $billing_address2);
				update_user_meta ($userid, 'billing_city', $billing_city);
				update_user_meta ($userid, 'billing_province', $billing_province);
				update_user_meta ($userid, 'billing_postalcode', $billing_postalcode);
				
				update_user_meta ($userid, 'billing_payment_method', $billing_payment_method[0]);
				update_user_meta ($userid, 'credit_card_number', $credit_card_number);
				update_user_meta ($userid, 'billing_cvv', $billing_cvv);
				update_user_meta ($userid, 'expiry_month', $expiry_month);
				update_user_meta ($userid, 'expiry_year', $expiry_year);
				
				
				
				
			 $corporate_name = get_the_author_meta( 'first_name', $userid )." ".get_the_author_meta( 'last_name', $userid );	
				
				$patterns = array();
		$patterns[0] = '/{display_name}/';
		$patterns[1] = '/{site_name}/';
		$patterns[2] = '/{admin_email}/';
		$replacements = array();
		$replacements[2] = $corporate_name;
		$replacements[1] = get_bloginfo ('name');
		$replacements[0] = get_bloginfo ('admin_email');
		
		$headers = array('Content-Type: text/html; charset=UTF-8','CC: deepalidesai31188@gmail.com');

		
		// Send email to user
  
  			$email_sub = ot_get_option( 'renew_email_subject_for_user' );
			$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'renew_email_message_for_user' ));
	
	 		wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers); //// Send Mail to User
			
			// Send email to admin
			
			/* $email_sub = ot_get_option( 'renew_email_subject_for_admin' );
			$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'renew_email_message_for_admin' ));
	
	 		wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers); //// Send Mail to Admin */
  
				wp_redirect('/elevate/?renew_success=1');
				die();
			}
		
		}else{
			if ( !isset($ultimatemember->form->errors) ) do_action('um_user_registration', $args);

		do_action('um_user_registration_extra_hook', $args );
		}
		
		
	}
	
	// admin css add

