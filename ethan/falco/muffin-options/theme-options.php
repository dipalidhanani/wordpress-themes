<?php
/**
 * Theme Options - fields and args
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

require_once( dirname( __FILE__ ) . '/fonts.php' );
require_once( dirname( __FILE__ ) . '/options.php' );


/**
 * Options Page fields and args
 */
function mfn_opts_setup(){
	
	// Navigation elements
	$menu = array(	
	
		// General --------------------------------------------
		'general' => array(
			'title' => __('Getting started', 'mfn-opts'),
			'sections' => array( 'general', 'sidebars', 'blog', 'portfolio', 'slider'),
		),
		
		// Layout --------------------------------------------
		'elements' => array(
			'title' => __('Layout', 'mfn-opts'),
			'sections' => array( 'layout-general', 'layout-header', 'social', 'custom-css' ),
		),
		
		// Colors --------------------------------------------
		'colors' => array(
			'title' => __('Colors', 'mfn-opts'),
			'sections' => array( 'colors-general', 'menu', 'colors-header', 'content', 'colors-footer', 'headings', 'colors-portfolio', 'colors-shortcodes'),
		),
		
		// Fonts --------------------------------------------
		'font' => array(
			'title' => __('Fonts', 'mfn-opts'),
			'sections' => array( 'font-family', 'font-size' ),
		),
		
		// Translate --------------------------------------------
		'translate' => array(
			'title' => __('Translate', 'mfn-opts'),
			'sections' => array( 'translate-general', 'translate-blog', 'translate-404' ),
		),
		
	);

	$sections = array();

	// General ----------------------------------------------------------------------------------------
	
	// General -------------------------------------------
	$sections['general'] = array(
		'title' => __('General', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'responsive',
				'type' => 'switch',
				'title' => __('Responsive', 'mfn-opts'), 
				'desc' => __('<b>Notice:</b> Responsive menu is working only with WordPress custom menu, please add one in Appearance > Menus and select it for Theme Locations section. <a href="http://en.support.wordpress.com/menus/" target="_blank">http://en.support.wordpress.com/menus/</a>', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'mfn-seo',
				'type' => 'switch',
				'title' => __('Use built-in SEO fields', 'mfn-opts'), 
				'desc' => __('Turn it off if you want to use external SEO plugin.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'meta-description',
				'type' => 'text',
				'title' => __('Meta Description', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts & pages.', 'mfn-opts'),
				'std' => get_bloginfo( 'description' ),
			),
			
			array(
				'id' => 'meta-keywords',
				'type' => 'text',
				'title' => __('Meta Keywords', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts & pages.', 'mfn-opts'),
			),
			
			array(
				'id' => 'google-analytics',
				'type' => 'textarea',
				'title' => __('Google Analytics', 'mfn-opts'), 
				'sub_desc' => __('Paste your Google Analytics code here.', 'mfn-opts'),
			),
			
		),
	);
	
	// Sidebars --------------------------------------------
	$sections['sidebars'] = array(
		'title' => __('Sidebars', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'sidebar-layout',
				'type' => 'radio_img',
				'title' => __('Default Layout', 'mfn-opts'), 
				'sub_desc' => __('Default post or page sidebar', 'mfn-opts'),
				'options' => array(
					'no-sidebar' => array('title' => 'Full width without sidebar', 'img' => MFN_OPTIONS_URI.'img/1col.png'),
					'left-sidebar' => array('title' => 'Left Sidebar', 'img' => MFN_OPTIONS_URI.'img/2cl.png'),
					'right-sidebar' => array('title' => 'Right Sidebar', 'img' => MFN_OPTIONS_URI.'img/2cr.png')
				),
				'std' => 'no-sidebar'																		
			),
	
			array(
				'id' => 'sidebars',
				'type' => 'multi_text',
				'title' => __('Sidebars', 'mfn-opts'),
				'sub_desc' => __('Manage custom sidebars', 'mfn-opts'),
				'desc' => __('Sidebars can be used on pages, blog and portfolio', 'mfn-opts')
			),
				
		),
	);
	
	// Blog --------------------------------------------
	$sections['blog'] = array(
		'title' => __('Blog', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'blog-posts',
				'type' => 'text',
				'title' => __('Posts per page', 'mfn-opts'),
				'sub_desc' => __('Number of posts per page.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '4',
			),
				
			array(
				'id' => 'blog-layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mfn-opts'),
				'sub_desc' => __('Layout for Blog Page', 'mfn-opts'),
				'options' => array(
					'one'			=> array('title' => 'List', 'img' => MFN_OPTIONS_URI.'img/list.png'),
					'one-second'	=> array('title' => 'Grid Two columns', 'img' => MFN_OPTIONS_URI.'img/one-second.png'),
					'one-third'		=> array('title' => 'Grid Three columns', 'img' => MFN_OPTIONS_URI.'img/one-third.png'),
					'one-fourth'	=> array('title' => 'Grid Four columns', 'img' => MFN_OPTIONS_URI.'img/one-fourth.png'),
					'timeline'		=> array('title' => 'Timeline', 'img' => MFN_OPTIONS_URI.'img/timeline.png'),
				),
				'std' => 'one'
			),
			
			array(
				'id' => 'blog-categories',
				'type' => 'switch',
				'title' => __('Show Categories', 'mfn-opts'), 
				'sub_desc' => __('Show categories on posts list and single post.', 'mfn-opts'), 
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-comments',
				'type' => 'switch',
				'title' => __('Show Comments', 'mfn-opts'), 
				'sub_desc' => __('Show comments number on posts list and single post.', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-time',
				'type' => 'switch',
				'title' => __('Show Date', 'mfn-opts'), 
				'sub_desc' => __('Show date on posts list and single post.', 'mfn-opts'), 
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-tags',
				'type' => 'switch',
				'title' => __('Show Tags', 'mfn-opts'), 
				'sub_desc' => __('Show tags list on posts list and single post.', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'pagination-show-all',
				'type' => 'switch',
				'title' => __('All pages in pagination', 'mfn-opts'),
				'desc' => __('Show all of the pages instead of a short list of the pages near the current page.', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
				
		),
	);
	
	// Portfolio --------------------------------------------
	$sections['portfolio'] = array(
		'title' => __('Portfolio', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'portfolio-posts',
				'type' => 'text',
				'title' => __('Posts per page', 'mfn-opts'),
				'sub_desc' => __('Number of portfolio posts per page.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '8',
			),
			
			array(
				'id' => 'portfolio-layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mfn-opts'), 
				'sub_desc' => __('Layout for portfolio items list.', 'mfn-opts'),
				'options' => array(
					'one'			=> array('title' => 'List', 'img' => MFN_OPTIONS_URI.'img/list.png'),
					'one-second'	=> array('title' => 'Two columns', 'img' => MFN_OPTIONS_URI.'img/one-second.png'),
					'one-third'		=> array('title' => 'Three columns', 'img' => MFN_OPTIONS_URI.'img/one-third.png'),
					'one-fourth'	=> array('title' => 'Four columns', 'img' => MFN_OPTIONS_URI.'img/one-fourth.png'),
				),
				'std' => 'one-fourth'																		
			),
			
			array(
				'id' => 'portfolio-page',
				'type' => 'pages_select',
				'title' => __('Portfolio Page', 'mfn-opts'), 
				'sub_desc' => __('Assign page for portfolio.', 'mfn-opts'),
				'args' => array()
			),
			
			array(
				'id' => 'portfolio-slug',
				'type' => 'text',
				'title' => __('Single item slug', 'mfn-opts'),
				'sub_desc' => __('Link to single item.', 'mfn-opts'),
				'desc' => __('<b>Important:</b> Do not use characters not allowed in links. <br /><br />Must be different from the Portfolio site title chosen above, eg. "portfolio-item". After change please go to "Settings > Permalinks" and click "Save changes" button.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => 'portfolio-item',
			),
			
			array(
				'id' => 'portfolio-orderby',
				'type' => 'select',
				'title' => __('Order by', 'mfn-opts'), 
				'sub_desc' => __('Portfolio items order by column.', 'mfn-opts'),
				'options' => array('date'=>'Date', 'menu_order' => 'Menu order', 'title'=>'Title'),
				'std' => 'menu_order'
			),
			
			array(
				'id' => 'portfolio-order',
				'type' => 'select',
				'title' => __('Order', 'mfn-opts'), 
				'sub_desc' => __('Portfolio items order.', 'mfn-opts'),
				'options' => array('ASC' => 'Ascending', 'DESC' => 'Descending'),
				'std' => 'ASC'
			),
			
			array(
				'id' => 'portfolio-isotope',
				'type' => 'switch',
				'title' => __('jQuery filtering', 'mfn-opts'),
				'desc' => __('When this option is enabled, portfolio looks great with all projects on single site, so please set "Posts per page" option to bigger number', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
				
		),
	);
	
	// Slider --------------------------------------------
	$sections['slider'] = array(
		'title' => __('Sliders', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(

			array(
				'id' => 'slider-vertical-auto',
				'type' => 'text',
				'title' => __('Vertical Slider - Timeout', 'mfn-opts'),
				'sub_desc' => __('Milliseconds between slide transitions.', 'mfn-opts'),
				'desc' => __('<strong>0 to disable auto</strong> advance.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '0',
			),
				
			array(
				'id' => 'slider-offer-auto',
				'type' => 'text',
				'title' => __('Offer - Timeout', 'mfn-opts'),
				'sub_desc' => __('Milliseconds between slide transitions.', 'mfn-opts'),
				'desc' => __('<strong>0 to disable auto</strong> advance.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '0',
			),
			
			array(
				'id' => 'slider-portfolio-auto',
				'type' => 'text',
				'title' => __('Portfolio - Timeout', 'mfn-opts'),
				'sub_desc' => __('Milliseconds between slide transitions.', 'mfn-opts'),
				'desc' => __('<strong>0 to disable auto</strong> advance.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '0',
			),
					
		),
	);
	
	// Layout ----------------------------------------------------------------------------------------
	
	// General --------------------------------------------
	$sections['layout-general'] = array(
		'title' => __('General', 'mfn-opts'),
		'fields' => array(
				
			array(
				'id' => 'favicon-img',
				'type' => 'upload',
				'title' => __('Custom Favicon', 'mfn-opts'),
				'sub_desc' => __('Site favicon', 'mfn-opts'),
				'desc' => __('Please use ICO format only.', 'mfn-opts')
			),
		
			array(
				'id' => 'layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mfn-opts'),
				'sub_desc' => __('Layout type', 'mfn-opts'),
				'options' => array(
					'boxed' => array('title' => 'Boxed', 'img' => MFN_OPTIONS_URI.'img/boxed.png'),
					'full-width' => array('title' => 'Full width', 'img' => MFN_OPTIONS_URI.'img/1col.png'),
				),
				'std' => 'full-width'
			),
				
			array(
				'id' => 'img-page-bg',
				'type' => 'upload',
				'title' => __('Background Image', 'mfn-opts'),
				'desc' => __('This option can be used <strong>only</strong> with Layout: Boxed.', 'mfn-opts'),	
			),
					
			array(
				'id' => 'position-page-bg',
				'type' => 'select',
				'title' => __('Background Image position', 'mfn-opts'),
				'desc' => __('This option can be used only with your custom image selected above.', 'mfn-opts'),
				'options' => array(
					'no-repeat;center top;;' => 'Center Top No-Repeat',
					'repeat;center top;;' => 'Center Top Repeat',
					'no-repeat;center;;' => 'Center No-Repeat',
					'repeat;center;;' => 'Center Repeat',
					'no-repeat;left top;;' => 'Left Top No-Repeat',
					'repeat;left top;;' => 'Left Top Repeat',
					'no-repeat;center top;fixed;' => 'Center No-Repeat Fixed',
					'no-repeat;center;fixed;cover' => 'Center No-Repeat Fixed Cover',
				)
			),
			
			array(
				'id' => 'popup-contact-form',
				'type' => 'text',
				'title' => __('Popup Contact Form Shortcode', 'mfn-opts'),
				'desc' => __('eg. [contact-form-7 id="000" title="Popup Contact Form"]', 'mfn-opts'),
			),
			
			array(
				'id' => 'footer-copy',
				'type' => 'text',
				'title' => __('Footer Copyright Text', 'mfn-opts'),
				'desc' => __('Leave this field blank to show a default copyright.', 'mfn-opts'),
			),

		),
	);
	
	// Header --------------------------------------------
	$sections['layout-header'] = array(
		'title' => __('Header', 'mfn-opts'),
		'fields' => array(
				
			array(
				'id' => 'header-white-mod',
				'type' => 'switch',
				'title' => __('White Header', 'mfn-opts'),
				'desc' => __('Turn it ON if you want to use white background header.', 'mfn-opts'),
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '0'
			),
				
			array(
				'id' => 'header-layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mfn-opts'),
				'options' => array(
					'mt'	=> array('title' => 'Menu on the Top', 'img' => MFN_OPTIONS_URI.'img/mt.png'),
					'mb'	=> array('title' => 'Menu at the Bottom', 'img' => MFN_OPTIONS_URI.'img/mb.png'),
					'mr'	=> array('title' => 'Menu on the Right', 'img' => MFN_OPTIONS_URI.'img/mr.png'),
					'mo'	=> array('title' => 'Only Menu', 'img' => MFN_OPTIONS_URI.'img/mo.png'),
				),
				'std' => 'mt'
			),
				
			array(
				'id' => 'sticky-header',
				'type' => 'switch',
				'title' => __('Sticky Header', 'mfn-opts'),
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
				
			array(
				'id' => 'logo-img',
				'type' => 'upload',
				'title' => __('Custom Logo', 'mfn-opts'),
				'sub_desc' => __('Custom logo image', 'mfn-opts'),
			),
	
			array(
				'id' => 'retina-logo-img',
				'type' => 'upload',
				'title' => __('Retina Logo', 'mfn-opts'),
				'sub_desc' => __('2x larger logo image', 'mfn-opts'),
				'desc' => __('Retina Logo should be 2x larger than Custom Logo (field is optional).', 'mfn-opts'),
			),

			array(
				'id' => 'retina-logo-width',
				'type' => 'text',
				'title' => __('Custom Logo Width', 'mfn-opts'),
				'sub_desc' => __('for Retina Logo', 'mfn-opts'),
				'desc' => __('px. Please type width of Custom Logo image (<strong>not</strong> Retina Logo).', 'mfn-opts'),
				'class' => 'small-text',
			),

			array(
				'id' => 'retina-logo-height',
				'type' => 'text',
				'title' => __('Custom Logo Height', 'mfn-opts'),
				'sub_desc' => __('for Retina Logo', 'mfn-opts'),
				'desc' => __('px. Please type height of Custom Logo image (<strong>not</strong> Retina Logo).', 'mfn-opts'),
				'class' => 'small-text',
			),

			array(
				'id' => 'header-phone',
				'type' => 'text',
				'title' => __('Header Phone number', 'mfn-opts'),
				'class' => 'small-text',
			),
			
			array(
				'id' => 'header-email',
				'type' => 'text',
				'title' => __('Header E-mail', 'mfn-opts'),
				'class' => 'small-text',
			),
	
		),
	);
	
	// Social Icons --------------------------------------------
	$sections['social'] = array(
		'title' => __('Social Icons', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'social-facebook',
				'type' => 'text',
				'title' => __('Facebook', 'mfn-opts'),
				'sub_desc' => __('Type your Facebook link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-googleplus',
				'type' => 'text',
				'title' => __('Google +', 'mfn-opts'),
				'sub_desc' => __('Type your Google + link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-twitter',
				'type' => 'text',
				'title' => __('Twitter', 'mfn-opts'),
				'sub_desc' => __('Type your Twitter link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-vimeo',
				'type' => 'text',
				'title' => __('Vimeo', 'mfn-opts'),
				'sub_desc' => __('Type your Vimeo link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-youtube',
				'type' => 'text',
				'title' => __('YouTube', 'mfn-opts'),
				'sub_desc' => __('Type your YouTube link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-flickr',
				'type' => 'text',
				'title' => __('Flickr', 'mfn-opts'),
				'sub_desc' => __('Type your Flickr link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-linkedin',
				'type' => 'text',
				'title' => __('LinkedIn', 'mfn-opts'),
				'sub_desc' => __('Type your LinkedIn link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-pinterest',
				'type' => 'text',
				'title' => __('Pinterest', 'mfn-opts'),
				'sub_desc' => __('Type your Pinterest link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-dribbble',
				'type' => 'text',
				'title' => __('Dribbble', 'mfn-opts'),
				'sub_desc' => __('Type your Dribbble link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
				
		),
	);
	
	// Custom CSS --------------------------------------------
	$sections['custom-css'] = array(
		'title' => __('Custom CSS', 'mfn-opts'),
		'fields' => array(

			array(
				'id' => 'custom-css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'mfn-opts'), 
				'sub_desc' => __('Paste your custom CSS code here.', 'mfn-opts'),
			),
				
		),
	);

	// Colors ----------------------------------------------------------------------------------------
	
	// General --------------------------------------------
	$sections['colors-general'] = array(
		'title' => __('General', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
							
			array(
				'id' => 'skin',
				'type' => 'select',
				'title' => __('Theme Skin', 'mfn-opts'), 
				'sub_desc' => __('Choose one of the predefined styles or set your own colors.', 'mfn-opts'), 
				'desc' => __('<b>Important:</b> Color options can be used only with the Custom Skin.', 'mfn-opts'), 
				'options' => array(
			
					'custom' => 'Custom',
					'green' => 'Green',
					'blue' => 'Blue',
					'orange' => 'Orange',
					'red' => 'Red',
				),
				'std' => 'custom',
			),
			
			array(
				'id' => 'background-body',
				'type' => 'color',
				'title' => __('Body background', 'mfn-opts'), 
				'std' => '#f7f8f8',
			),
			
		),
	);
	
	// Main menu --------------------------------------------
	$sections['menu'] = array(
		'title' => __('Menus', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
			
			array(
				'id' => 'color-menu-a',
				'type' => 'color',
				'title' => __('Menu Link color', 'mfn-opts'), 
				'std' => '#b0b6c8'
			),
			
			array(
				'id' => 'color-menu-a-hover',
				'type' => 'color',
				'title' => __('Menu Hover Link color', 'mfn-opts'),
				'std' => '#88be4c'
			),
				
			array(
				'id' => 'color-menu-a-active',
				'type' => 'color',
				'title' => __('Menu Active Link color', 'mfn-opts'),
				'std' => '#ebebeb'
			),
				
			array(
				'id' => 'border-menu-a-active',
				'type' => 'color',
				'title' => __('Menu Active Link border', 'mfn-opts'),
				'std' => '#88be4c'
			),
				
			array(
				'id' => 'color-submenu-a',
				'type' => 'color',
				'title' => __('Submenu Link color', 'mfn-opts'),
				'std' => '#ffffff'
			),
				
			array(
				'id' => 'color-submenu-a-hover',
				'type' => 'color',
				'title' => __('Submenu Hover Link color', 'mfn-opts'),
				'std' => '#dbf5be'
			),

			array(
				'id' => 'background-submenu-2nd',
				'type' => 'color',
				'title' => __('Submenu 2nd level background', 'mfn-opts'),
				'std' => '#88be4c'
			),
			
			array(
				'id' => 'background-submenu-3rd',
				'type' => 'color',
				'title' => __('Submenu 3rd level background', 'mfn-opts'),
				'std' => '#74a241'
			),
	
		),
	);
	
	// Header --------------------------------------------
	$sections['colors-header'] = array(
		'title' => __('Header', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
					
			array(
				'id' => 'background-header',
				'type' => 'color',
				'title' => __('Header background', 'mfn-opts'),
				'std' => '#262932',
			),
				
			array(
				'id' => 'color-social',
				'type' => 'color',
				'title' => __('Social Icon color', 'mfn-opts'),
				'std' => '#545760',
			),

			array(
				'id' => 'color-social-hover',
				'type' => 'color',
				'title' => __('Hover Social Icon color', 'mfn-opts'),
				'std' => '#88be4c',
			),
				
			array(
				'id' => 'color-addons',
				'type' => 'color',
				'title' => __('Addons Icon color', 'mfn-opts'),
				'desc' => __('This is also Languages Menu text color.', 'mfn-opts'),
				'std' => '#aaaaaa',
			),
				
			array(
				'id' => 'color-languages-hover',
				'type' => 'color',
				'title' => __('Languages Hover Link color', 'mfn-opts'),
				'std' => '#ffffff',
			),
			
			array(
				'id' => 'color-subheader-title',
				'type' => 'color',
				'title' => __('Page Title color', 'mfn-opts'),
				'std' => '#39464e',
			),
			
			array(
				'id' => 'color-subheader-breadcrumbs',
				'type' => 'color',
				'title' => __('Breadcrumbs color', 'mfn-opts'),
				'std' => '#c0c1c7',
			),

		),
	);
	
	// Content --------------------------------------------
	$sections['content'] = array(
		'title' => __('Content', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'color-text',
				'type' => 'color',
				'title' => __('Text color', 'mfn-opts'), 
				'sub_desc' => __('Content text color.', 'mfn-opts'),
				'std' => '#787e87'
			),
			
			array(
				'id' => 'color-a',
				'type' => 'color',
				'title' => __('Link color', 'mfn-opts'), 
				'std' => '#88be4c'
			),
			
			array(
				'id' => 'color-a-hover',
				'type' => 'color',
				'title' => __('Hover Link color', 'mfn-opts'), 
				'std' => '#6e9b3b'
			),
			
			array(
				'id' => 'border-borders',
				'type' => 'color',
				'title' => __('Featured Border color', 'mfn-opts'), 
				'std' => '#88be4c'
			),
			
			array(
				'id' => 'background-highlight',
				'type' => 'color',
				'title' => __('Highlight text background', 'mfn-opts'),
				'std' => '#88be4c'
			),
	
			array(
				'id' => 'color-highlight',
				'type' => 'color',
				'title' => __('Highlight text color', 'mfn-opts'),
				'std' => '#ffffff'
			),
			
			array(
				'id' => 'color-button',
				'type' => 'color',
				'title' => __('Button text color', 'mfn-opts'), 
				'std' => '#353f4c',
			),

			array(
				'id' => 'color-button-hover',
				'type' => 'color',
				'title' => __('Hover Button text color', 'mfn-opts'), 
				'std' => '#88be4c',
			),
			
			array(
				'id' => 'background-slider-active-pager',
				'type' => 'color',
				'title' => __('Slider Active Pager background', 'mfn-opts'), 
				'std' => '#88be4c',
			),
	
		),
	);
	
	// Footer --------------------------------------------
	$sections['colors-footer'] = array(
		'title' => __('Footer', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'background-footer',
				'type' => 'color',
				'title' => __('Footer background', 'mfn-opts'),
				'std' => '#252932',
			),
	
			array(
				'id' => 'color-footer',
				'type' => 'color',
				'title' => __('Footer text color', 'mfn-opts'),
				'std' => '#b7bcc8',
			),
	
			array(
				'id' => 'color-footer-a',
				'type' => 'color',
				'title' => __('Footer Link color', 'mfn-opts'),
				'std' => '#88be4c',
			),
	
			array(
				'id' => 'color-footer-a-hover',
				'type' => 'color',
				'title' => __('Footer Hover Link color', 'mfn-opts'),
				'std' => '#6e9b3b',
			),
	
			array(
				'id' => 'color-footer-heading',
				'type' => 'color',
				'title' => __('Footer Heading color', 'mfn-opts'),
				'std' => '#E6E9EF',
			),
	
			array(
				'id' => 'color-footer-widget-title',
				'type' => 'color',
				'title' => __('Footer Widget Title color', 'mfn-opts'),
				'std' => '#88be4c',
			),
			
			array(
				'id' => 'color-footer-note',
				'type' => 'color',
				'title' => __('Footer Note color', 'mfn-opts'),
				'std' => '#8fa5b8',
			),
	
			array(
				'id' => 'color-footer-copyright',
				'type' => 'color',
				'title' => __('Footer Copyright text color', 'mfn-opts'),
				'std' => '#565a62',
			),
		),
	);
	
	// Headings --------------------------------------------
	$sections['headings'] = array(
		'title' => __('Headings', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'color-h1',
				'type' => 'color',
				'title' => __('Heading H1 color', 'mfn-opts'), 
				'std' => '#39464e'
			),
			
			array(
				'id' => 'color-h2',
				'type' => 'color',
				'title' => __('Heading H2 color', 'mfn-opts'), 
				'std' => '#39464e'
			),
			
			array(
				'id' => 'color-h3',
				'type' => 'color',
				'title' => __('Heading H3 color', 'mfn-opts'), 
				'std' => '#39464e'
			),
			
			array(
				'id' => 'color-h4',
				'type' => 'color',
				'title' => __('Heading H4 color', 'mfn-opts'), 
				'std' => '#37414e'
			),
			
			array(
				'id' => 'color-h5',
				'type' => 'color',
				'title' => __('Heading H5 color', 'mfn-opts'), 
				'std' => '#37414e'
			),
			
			array(
				'id' => 'color-h6',
				'type' => 'color',
				'title' => __('Heading H6 color', 'mfn-opts'), 
				'std' => '#37414e'
			),
				
		),
	);
	
	// Portfolio --------------------------------------------
	$sections['colors-portfolio'] = array(
		'title' => __('Portfolio & Blog', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'background-portfolio-category-active',
				'type' => 'color',
				'title' => __('Active Category background', 'mfn-opts'),
				'std' => '#88BE4C',
			),
	
			array(
				'id' => 'background-portfolio-slide',
				'type' => 'color',
				'title' => __('Slide background', 'mfn-opts'),
				'std' => '#91c25b',
			),
				
			array(
				'id' => 'color-portfolio-slide',
				'type' => 'color',
				'title' => __('Slide text color', 'mfn-opts'),
				'std' => '#ffffff',
			),
				
			array(
				'id' => 'color-portfolio-slide-note',
				'type' => 'color',
				'title' => __('Slide Note color', 'mfn-opts'),
				'std' => '#d4ffa4',
			),
				
			array(
				'id' => 'color-portfolio-slide-a',
				'type' => 'color',
				'title' => __('Slide Link color', 'mfn-opts'),
				'std' => '#384b23',
			),
				
			array(
				'id' => 'background-full-screen',
				'type' => 'color',
				'title' => __('Full Screen background', 'mfn-opts'),
				'std' => '#262932',
			),
				
			array(
				'id' => 'color-full-screen-text',
				'type' => 'color',
				'title' => __('Full Screen text color', 'mfn-opts'),
				'std' => '#ffffff',
			),
				
			array(
				'id' => 'border-full-screen-odd',
				'type' => 'color',
				'title' => __('Full Screen Odd Item border', 'mfn-opts'),
				'std' => '#88BE4C',
			),
				
			array(
				'id' => 'border-full-screen-even',
				'type' => 'color',
				'title' => __('Full Screen Even Item border', 'mfn-opts'),
				'std' => '#B3EF6C',
			),
				
			array(
				'id' => 'background-blog-icon',
				'type' => 'color',
				'title' => __('Blog Icon Background', 'mfn-opts'),
				'std' => '#88be4c',
			),
				
			array(
				'id' => 'color-blog-icon',
				'type' => 'color',
				'title' => __('Blog Icon color', 'mfn-opts'),
				'std' => '#ffffff',
			),
				
		),
	);
	
	// Shortcodes --------------------------------------------
	$sections['colors-shortcodes'] = array(
		'title' => __('Shortcodes', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'background-contact-box-btn-left',
				'type' => 'color',
				'title' => __('Contact Box Left Button background', 'mfn-opts'),
				'desc' => __('This is also ? icon background.', 'mfn-opts'),
				'std' => '#353f4c',
			),

			array(
				'id' => 'background-contact-box-btn-right',
				'type' => 'color',
				'title' => __('Contact Box Right Button background', 'mfn-opts'),
				'std' => '#516175',
			),
				
			array(
				'id' => 'color-contact-box-btn',
				'type' => 'color',
				'title' => __('Contact Box Button color', 'mfn-opts'),
				'desc' => __('This is also ? icon color.', 'mfn-opts'),
				'std' => '#ffffff',
			),
			
			array(
				'id' => 'background-feature-box',
				'type' => 'color',
				'title' => __('Feature Box Content background', 'mfn-opts'),
				'std' => '#88be4c',
			),
			
			array(
				'id' => 'background-feature-box-icon',
				'type' => 'color',
				'title' => __('Feature Box Icon background', 'mfn-opts'),
				'std' => '#719e3e',
			),
			
			array(
				'id' => 'color-feature-box',
				'type' => 'color',
				'title' => __('Feature Box text color', 'mfn-opts'),
				'desc' => __('This is also Icon color.', 'mfn-opts'),
				'std' => '#ffffff',
			),
			
			array(
				'id' => 'background-icon-box',
				'type' => 'color',
				'title' => __('Icon Box Icon background', 'mfn-opts'),
				'std' => '#88be4c',
			),
			
			array(
				'id' => 'color-icon-box',
				'type' => 'color',
				'title' => __('Icon Box Icon color', 'mfn-opts'),
				'std' => '#ffffff',
			),
			
			array(
				'id' => 'color-icon-list',
				'type' => 'color',
				'title' => __('Icon List Icon color', 'mfn-opts'),
				'std' => '#39464e',
			),

			array(
				'id' => 'background-pricing-header',
				'type' => 'color',
				'title' => __('Pricing Box Header background', 'mfn-opts'),
				'std' => '#88be4c',
			),
			
			array(
				'id' => 'color-pricing-header',
				'type' => 'color',
				'title' => __('Pricing Box Header color', 'mfn-opts'),
				'std' => '#364c1e',
			),
			
			array(
				'id' => 'color-pricing-subheader',
				'type' => 'color',
				'title' => __('Pricing Box Subheader color', 'mfn-opts'),
				'std' => '#ffffff',
			),

			array(
				'id' => 'background-tab-active',
				'type' => 'color',
				'title' => __('Tab Active background', 'mfn-opts'),
				'std' => '#88be4c',
			),
			
			array(
				'id' => 'color-tab-active',
				'type' => 'color',
				'title' => __('Tab Active color', 'mfn-opts'),
				'std' => '#ffffff',
			),
				
		),
	);

	// Font Family --------------------------------------------
	$sections['font-family'] = array(
		'title' => __('Font Family', 'mfn-opts'),
		'fields' => array(
			
			array(
				'id' => 'font-content',
				'type' => 'font_select',
				'title' => __('Content Font', 'mfn-opts'), 
				'sub_desc' => __('This font will be used for all theme texts except headings and menu.', 'mfn-opts'), 
				'std' => 'Exo'
			),
			
			array(
				'id' => 'font-menu',
				'type' => 'font_select',
				'title' => __('Main Menu Font', 'mfn-opts'), 
				'sub_desc' => __('This font will be used for header menu.', 'mfn-opts'), 
				'std' => 'Exo'
			),
			
			array(
				'id' => 'font-headings',
				'type' => 'font_select',
				'title' => __('Headings Font', 'mfn-opts'), 
				'sub_desc' => __('This font will be used for all headings.', 'mfn-opts'), 
				'std' => 'Exo'
			),
			
			array(
				'id' => 'font-subset',
				'type' => 'text',
				'title' => __('Google Font Subset', 'mfn-opts'),				
				'sub_desc' => __('Specify which subsets should be downloaded. Multiple subsets should be separated with coma (,)', 'mfn-opts'),
				'desc' => __('Some of the fonts in the Google Font Directory support multiple scripts (like Latin and Cyrillic for example). In order to specify which subsets should be downloaded the subset parameter should be appended to the URL. For a complete list of available fonts and font subsets please see <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a>.', 'mfn-opts'),
				'class' => 'small-text'
			),
				
		),
	);
	
	// Content Font Size --------------------------------------------
	$sections['font-size'] = array(
		'title' => __('Font Size', 'mfn-opts'),
		'fields' => array(

			array(
				'id' => 'font-size-content',
				'type' => 'sliderbar',
				'title' => __('Content', 'mfn-opts'),
				'sub_desc' => __('This font size will be used for all theme texts.', 'mfn-opts'),
				'std' => '13',
			),
				
			array(
				'id' => 'font-size-menu',
				'type' => 'sliderbar',
				'title' => __('Main menu', 'mfn-opts'),
				'sub_desc' => __('This font size will be used for top level only.', 'mfn-opts'),
				'std' => '14',
			),
			
			array(
				'id' => 'font-size-h1',
				'type' => 'sliderbar',
				'title' => __('Heading H1', 'mfn-opts'),
				'sub_desc' => __('Subpages header title.', 'mfn-opts'),
				'std' => '45',
			),
			
			array(
				'id' => 'font-size-h2',
				'type' => 'sliderbar',
				'title' => __('Heading H2', 'mfn-opts'),
				'std' => '40',
			),
			
			array(
				'id' => 'font-size-h3',
				'type' => 'sliderbar',
				'title' => __('Heading H3', 'mfn-opts'),
				'std' => '35',
			),
			
			array(
				'id' => 'font-size-h4',
				'type' => 'sliderbar',
				'title' => __('Heading H4', 'mfn-opts'),
				'std' => '26',
			),
			
			array(
				'id' => 'font-size-h5',
				'type' => 'sliderbar',
				'title' => __('Heading H5', 'mfn-opts'),
				'std' => '19',
			),
			
			array(
				'id' => 'font-size-h6',
				'type' => 'sliderbar',
				'title' => __('Heading H6', 'mfn-opts'),
				'std' => '17',
			),
	
		),
	);
	
	// Translate / General --------------------------------------------
	$sections['translate-general'] = array(
		'title' => __('General', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'translate',
				'type' => 'switch',
				'title' => __('Enable Translate', 'mfn-opts'), 
				'desc' => __('Turn it off if you want to use .mo .po files for more complex translation.', 'mfn-opts'),
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'translate-search-placeholder',
				'type' => 'text',
				'title' => __('Search Placeholder', 'mfn-opts'),
				'desc' => __('Widget Search', 'mfn-opts'),
				'std' => 'Enter your search',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-home',
				'type' => 'text',
				'title' => __('Home', 'mfn-opts'),
				'desc' => __('Breadcrumbs', 'mfn-opts'),
				'std' => 'Home',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-contact-form-title',
				'type' => 'text',
				'title' => __('Send us a message', 'mfn-opts'),
				'desc' => __('Popup Contact Form', 'mfn-opts'),
				'std' => 'Send us a message',
				'class' => 'small-text',
			),

		),
	);
	
	// Translate / Blog & Portfolio --------------------------------------------
	$sections['translate-blog'] = array(
		'title' => __('Blog & Portfolio', 'mfn-opts'),
		'fields' => array(
				
			array(
				'id' => 'translate-comment',
				'type' => 'text',
				'title' => __('Comment', 'mfn-opts'),
				'sub_desc' => __('Text to display when there is one comment', 'mfn-opts'),
				'desc' => __('Blog', 'mfn-opts'),
				'std' => 'Comment',
				'class' => 'small-text',
			),
				
			array(
				'id' => 'translate-comments',
				'type' => 'text',
				'title' => __('Comments', 'mfn-opts'),
				'sub_desc' => __('Text to display when there are more than one comments', 'mfn-opts'),
				'desc' => __('Blog', 'mfn-opts'),
				'std' => 'Comments',
				'class' => 'small-text',
			),
				
			array(
				'id' => 'translate-comments-off',
				'type' => 'text',
				'title' => __('Comments off', 'mfn-opts'),
				'sub_desc' => __('Text to display when comments are disabled', 'mfn-opts'),
				'desc' => __('Blog', 'mfn-opts'),
				'std' => 'Comments off',
				'class' => 'small-text',
			),
	
			array(
				'id' => 'translate-select-category',
				'type' => 'text',
				'title' => __('Select category', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Select category',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-all',
				'type' => 'text',
				'title' => __('All', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'All',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-details',
				'type' => 'text',
				'title' => __('Project details', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Project details',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-category',
				'type' => 'text',
				'title' => __('Category', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Category',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-client',
				'type' => 'text',
				'title' => __('Client', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Client',
				'class' => 'small-text',
			),

			array(
				'id' => 'translate-date',
				'type' => 'text',
				'title' => __('Date', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Date',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-task',
				'type' => 'text',
				'title' => __('Task', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Task',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-website',
				'type' => 'text',
				'title' => __('Website', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Website',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-visit-online',
				'type' => 'text',
				'title' => __('Visit online', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Visit online',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-go-to-homepage',
				'type' => 'text',
				'title' => __('Go to homepage', 'mfn-opts'),
				'desc' => __('Full Screen Portfolio', 'mfn-opts'),
				'std' => 'Go to homepage',
				'class' => 'small-text',
			),
			
		),
	);
	
	// Translate Error 404 --------------------------------------------
	$sections['translate-404'] = array(
		'title' => __('Error 404', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'translate-404-title',
				'type' => 'text',
				'title' => __('Title', 'mfn-opts'),
				'desc' => __('Ooops... Error 404', 'mfn-opts'),
				'std' => 'Ooops... Error 404',
			),
			
			array(
				'id' => 'translate-404-subtitle',
				'type' => 'text',
				'title' => __('Subtitle', 'mfn-opts'),
				'desc' => __('We are sorry, but the page you are looking for does not exist.', 'mfn-opts'),
				'std' => 'We are sorry, but the page you are looking for does not exist.',
			),
			
			array(
				'id' => 'translate-404-text',
				'type' => 'text',
				'title' => __('Text', 'mfn-opts'),
				'desc' => __('Please check entered address and try again or', 'mfn-opts'),
				'std' => 'Please check entered address and try again or ',
			),
			
			array(
				'id' => 'translate-404-btn',
				'type' => 'text',
				'title' => __('Button', 'mfn-opts'),
				'sub_desc' => __('Go To Homepage button', 'mfn-opts'),
				'std' => 'go to homepage',
				'class' => 'small-text',
			),
	
		),
	);
								
	global $MFN_Options;
	$MFN_Options = new MFN_Options( $menu, $sections );
}
//add_action('init', 'mfn_opts_setup', 0);
mfn_opts_setup();


/**
 * This is used to return and option value from the options array
 */
function mfn_opts_get($opt_name, $default = null){
	global $MFN_Options;
	return $MFN_Options->get( $opt_name, $default );
}


/**
 * This is used to echo and option value from the options array
 */
function mfn_opts_show($opt_name, $default = null){
	global $MFN_Options;
	$option = $MFN_Options->get( $opt_name, $default );
	if( ! is_array( $option ) ){
		echo $option;
	}	
}

?>