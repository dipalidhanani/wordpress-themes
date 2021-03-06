<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$test_array = array("1" => "Tutorials","2" => "Posts");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	$animation = array("slide" => "slide","fade" => "fade");
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
		// Pull all the pages into an array
	$options_slider = array();  
	$options_slider_obj = get_posts('post_type=custom_slider');
	$options_slider[''] = 'Select a slider:';
	foreach ($options_slider_obj as $post) {
    	$options_slider[$post->ID] = $post->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
	
	
	$options[] = array( "name" => "Homepage",
						"type" => "heading");	
						
	$options[] = array( "name" => "Logo",
						"desc" => "Upload an image logo for your site.",
						"id" => "w2f_logo",
						"std" => get_bloginfo('stylesheet_directory') . '/images/logo.png',
						"type" => "upload");		

	$options[] = array( "name" => "Number of slides",
						"desc" => "Number of slides on homepage",
						"id" => "w2f_slidecount",
						"std" => "5",
						"type" => "text");	
						
	$options[] = array( "name" => "Slide delay",
						"desc" => "Slide delay in milliseconds ( 1000 ms = 1 Sec)",
						"id" => "w2f_slide_delay",
						"std" => "2000",
						"type" => "text");							
						
	$options[] = array( "name" => "Slide effect",
						"desc" => "Slideshow effect.",
						"id" => "w2f_slide",
						"std" => "fade",
						"type" => "select",
						"options" => $animation);						
						
					
	$options[] = array( "name" => "Banner Settings",
						"type" => "heading");		
						
						
	$options[] = array( "name" => "Banner 1 Image",
						"desc" => "Enter your 125 x 125 banner image url here..",
						"id" => "w2f_banner1",
						"std" => "http://web2feel.com/images/webhostinghub.png",
						"type" => "text");		
						
	$options[] = array( "name" => "Banner 1 Image alt tag",
						"desc" => "Enter your banner alt tag.",
						"id" => "w2f_alt1",
						"std" => "Cheap reliable web hosting from WebHostingHub.com",
						"type" => "text");		
						
	$options[] = array( "name" => "Banner 1 Url",
						"desc" => "Enter your banner-1 url here.",
						"id" => "w2f_url1",
						"std" => "",
						"type" => "text");						
						
	$options[] = array( "name" => "Banner 1 link title",
						"desc" => "Enter your banner-1 title here.",
						"id" => "w2f_lab1",
						"std" => "Web Hosting Hub - Cheap reliable web hosting.",
						"type" => "text");						
						


	$options[] = array( "name" => "Banner 2 Image",
						"desc" => "Enter your 125 x 125 banner image url here..",
						"id" => "w2f_banner2",
						"std" => "http://web2feel.com/images/pcnames.png",
						"type" => "text");		

	$options[] = array( "name" => "Banner 2 Image alt tag",
						"desc" => "Enter your banner alt tag.",
						"id" => "w2f_alt2",
						"std" => "Domain name search and availability check by PCNames.com",
						"type" => "text");		

	$options[] = array( "name" => "Banner 2 Url",
						"desc" => "Enter your banner-2 url here.",
						"id" => "w2f_url2",
						"std" => "http://www.pcnames.com/",
						"type" => "text");						

	$options[] = array( "name" => "Banner 2 link title",
						"desc" => "Enter your banner-2 title here.",
						"id" => "w2f_lab2",
						"std" => "PC Names - Domain name search and availability check.",
						"type" => "text");
										
										
																
	$options[] = array( "name" => "Banner 3 Image",
						"desc" => "Enter your 125 x 125 banner image url here..",
						"id" => "w2f_banner3",
						"std" => "http://web2feel.com/images/designcontest.png",
						"type" => "text");		

	$options[] = array( "name" => "Banner 3 Image alt tag",
						"desc" => "Enter your banner alt tag.",
						"id" => "w2f_alt3",
						"std" => "Website and logo design contests at DesignContest.com.",
						"type" => "text");		

	$options[] = array( "name" => "Banner 3 Url",
						"desc" => "Enter your banner-1 url here.",
						"id" => "w2f_url3",
						"std" => "http://www.designcontest.com/",
						"type" => "text");						

	$options[] = array( "name" => "Banner 3 link title",
						"desc" => "Enter your banner-3 title here.",
						"id" => "w2f_lab3",
						"std" => "Design Contest - Logo and website design contests.",
						"type" => "text");
								
								
														
																				
	$options[] = array( "name" => "Banner 4 Image",
						"desc" => "Enter your 125 x 125 banner image url here..",
						"id" => "w2f_banner4",
						"std" => "http://web2feel.com/images/webhostingrating.png",
						"type" => "text");		

	$options[] = array( "name" => "Banner 4 Image alt tag",
						"desc" => "Enter your banner alt tag.",
						"id" => "w2f_alt4",
						"std" => "Reviews of the best cheap web hosting providers at WebHostingRating.com",
						"type" => "text");		

	$options[] = array( "name" => "Banner 4 Url",
						"desc" => "Enter your banner-4 url here.",
						"id" => "w2f_url4",
						"std" => "http://webhostingrating.com",
						"type" => "text");						

	$options[] = array( "name" => "Banner 4 link title",
						"desc" => "Enter your banner-4 title here.",
						"id" => "w2f_lab4",
						"std" => "Web Hosting Rating - Customer reviews of the best web hosts",
						"type" => "text");						
						
						
	
	return $options;
}