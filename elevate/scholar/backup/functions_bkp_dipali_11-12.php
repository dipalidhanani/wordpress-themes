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
									<p class="sensei-course-meta"><?php _e( 'by', 'woothemes' ); ?> <a href="<?php echo esc_url( get_author_posts_url( $course->post_author ) ); ?>"><?php echo esc_attr( $author_info->display_name ); ?></a> | <?php echo sprintf( __( '%d lessons', 'woothemes' ), $total_lessons ); ?><?php if ( WooThemes_Sensei_Utils::sensei_is_woocommerce_activated() && 0 < get_post_meta( $course->ID, '_course_woocommerce_product', true ) ) { _e( ' | Price: ', 'woothemes' );  sensei_simple_course_price( $course->ID ); } ?></p>
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