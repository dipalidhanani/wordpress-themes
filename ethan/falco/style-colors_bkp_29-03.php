<?php
/**
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

header( 'Content-type: text/css;' );
	
$url = dirname( __FILE__ );
$strpos = strpos( $url, 'wp-content' );
$base = substr( $url, 0, $strpos );

require_once( $base .'wp-load.php' );
?>

/********************** Backgrounds **********************/
	
	#Header,
	#Header .menu > li.current-menu-item > a,
	#Header .menu > li.current_page_item > a,
	#Header .menu > li.current-menu-ancestor > a,
	#Header .menu > li.current_page_ancestor > a,
	#Header .menu > li > a:hover,
	#Header .menu > li.hover > a,
	#Header .language:hover {
		background: <?php mfn_opts_show( 'background-header', '#262932' ) ?>;
	}
	
	#Footer {
		background-color: <?php mfn_opts_show( 'background-footer', '#252932' ) ?>;
	}
	

/************************ Colors ************************/

/* Content font */
	body, .post .desc a.desc_a p {
		color: <?php mfn_opts_show( 'color-text', '#787e87' ) ?>;
	}
	
/* Links color */
	a, .post .date .day {
		color: <?php mfn_opts_show( 'color-a', '#88be4c' ) ?>;
	}
	a:hover {
		color: <?php mfn_opts_show( 'color-a-hover', '#6e9b3b' ) ?>;
	}
	
/* Selections */
	*::-moz-selection {
		background-color: <?php mfn_opts_show( 'color-a', '#88be4c' ) ?>;
	}
	*::selection {
		background-color: <?php mfn_opts_show( 'color-a', '#88be4c' ) ?>;		
	}
	
/* Borders green */
	.article_box .photo, .contact_box .google-map, .testimonials ul.photos:hover li.active a:hover, 
	.testimonials ul.photos li.active a, .testimonials ul.photos li a:hover, .blockquote .author .photo {
		border-color: <?php mfn_opts_show( 'border-borders', '#88be4c' ) ?>;
	}
	
/* Text hightlight */
	.highlight {
		background: <?php mfn_opts_show( 'background-highlight', '#88be4c' ) ?>;
		color: <?php mfn_opts_show( 'color-highlight', '#fff' ) ?>;
	}

/* Buttons */
	a.button, input[type="submit"], input[type="reset"], input[type="button"] {
		color: <?php mfn_opts_show( 'color-button', '#353f4c' ) ?>;
	}
	a:hover.button, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover {
		color: <?php mfn_opts_show( 'color-button-hover', '#88be4c' ) ?>;
	}
		
/* Headings font */
	h1, h1 a, h1 a:hover { color: <?php mfn_opts_show( 'color-h1', '#39464e' ) ?>; }
	h2, h2 a, h2 a:hover { color: <?php mfn_opts_show( 'color-h2', '#39464e' ) ?>; }
	h3, h3 a, h3 a:hover { color: <?php mfn_opts_show( 'color-h3', '#39464e' ) ?>; }
	h4, h4 a, h4 a:hover { color: <?php mfn_opts_show( 'color-h4', '#37414e' ) ?>; }
	h5, h5 a, h5 a:hover { color: <?php mfn_opts_show( 'color-h5', '#37414e' ) ?>; }
	h6, h6 a, h6 a:hover { color: <?php mfn_opts_show( 'color-h6', '#37414e' ) ?>; }	
	
/* Social & Search */
	.social li a {
		color: <?php mfn_opts_show( 'color-social', '#545760' ) ?> !important;
	}
	.social li a:hover {
		color: <?php mfn_opts_show( 'color-social-hover', '#88be4c' ) ?> !important;
	}
	
/* Addons */
	#Header .expand i, #Header .language > a i, #Header #searchform a.icon,
	#Header .language a { 
		color: <?php mfn_opts_show( 'color-addons', '#aaa' ) ?>;
	}
	#Header .language .language_select ul li a:hover { 
		color: <?php mfn_opts_show( 'color-languages-hover', '#fff' ) ?>; 
	}
	
/* Menu */
	#Header .menu > li > a {
		color: <?php mfn_opts_show( 'color-menu-a', '#b0b6c8' ) ?>;
	}
	
	#Header .menu > li > a:hover,
	#Header .menu > li.hover > a {
		color: <?php mfn_opts_show( 'color-menu-a-hover', '#88be4c' ) ?>;
	}
	
	#Header .menu > li.current-menu-item > a,
	#Header .menu > li.current_page_item > a,
	#Header .menu > li.current-menu-ancestor > a,
	#Header .menu > li.current_page_ancestor > a {
		color: <?php mfn_opts_show( 'color-menu-a-active', '#ebebeb' ) ?> !important;
		border-color: <?php mfn_opts_show( 'border-menu-a-active', '#88be4c' ) ?>;
	}
	
	#Header .menu > li ul li a {
		color: <?php mfn_opts_show( 'color-submenu-a', '#fff' ) ?>;
	}

	#Header .menu > li ul li a:hover, #Header .menu > li ul li.hover > a {
		color: <?php mfn_opts_show( 'color-submenu-a-hover', '#dbf5be' ) ?>;
	}	
			
	#Header .menu > li ul {
		background: <?php mfn_opts_show( 'background-submenu-2nd', '#88be4c' ) ?>;
	}
	
	#Header .menu li ul li.hover .menu-arr-top {
		border-left-color: <?php mfn_opts_show( 'background-submenu-2nd', '#88be4c' ) ?>;
	}

	#Header .menu li ul li ul {
		background: <?php mfn_opts_show( 'background-submenu-3rd', '#74a241' ) ?>;
	}	
	
/* Subheader */
	#Subheader .title {
		color: <?php mfn_opts_show( 'color-subheader-title', '#39464e' ) ?>;
	}
	#Subheader ul.breadcrumbs li, #Subheader ul.breadcrumbs li a { 
		color: <?php mfn_opts_show( 'color-subheader-breadcrumbs', '#c0c1c7' ) ?>;
	}
	
/* OWL pagination */
	.owl-pagination .owl-page.active span, #Footer .owl-pagination .owl-page.active span {
		background: <?php mfn_opts_show( 'background-slider-active-pager', '#88be4c' ) ?> !important;
	}
	
/* Contact box */
	.contact_box a.button_about,
	.contact_box .buttons_wrapper .button_about:before {
		background: <?php mfn_opts_show( 'background-contact-box-btn-left', '#353f4c' ) ?>;
	}
	.contact_box a.button_form {
		background: <?php mfn_opts_show( 'background-contact-box-btn-right', '#516175' ) ?>;
	}
	.contact_box a.button_about, .contact_box a.button_form,
	.contact_box .buttons_wrapper .button_about:before {
		color: <?php mfn_opts_show( 'color-contact-box-btn', '#fff' ) ?>;
	}
	
/* Feature box */
	.feature_box_wrapper .desc { 
		background: <?php mfn_opts_show( 'background-feature-box', '#88be4c' ) ?>;
	}
	.feature_box_wrapper .desc .icon { 
		background: <?php mfn_opts_show( 'background-feature-box-icon', '#719e3e' ) ?>;
	}
	.feature_box_wrapper .desc,
	.feature_box_wrapper .desc .title,
	.feature_box_wrapper .desc .icon { 
		color: <?php mfn_opts_show( 'color-feature-box', '#fff' ) ?>; 
	}
	
/* Icon box */
	.icon_box .icon_image i {
		background: <?php mfn_opts_show( 'background-icon-box', '#88be4c' ) ?>;
		color: <?php mfn_opts_show( 'color-icon-box', '#fff' ) ?>;
	}
	
/* Icon list */
	.icon_list .icon{
		color: <?php mfn_opts_show( 'color-icon-list', '#39464e' ) ?>;
	}
	
/* Tabs */
	.ui-tabs .ui-tabs-nav li.ui-state-active a {
		background: <?php mfn_opts_show( 'background-tab-active', '#88be4c' ) ?>;
		color: <?php mfn_opts_show( 'color-tab-active', '#fff' ) ?>;
	}

/* Pricing table */
	.pricing-box .plan-header { 
		background: <?php mfn_opts_show( 'background-pricing-header', '#88be4c' ) ?>;
	}
	.pricing-box .plan-header h3 {
		color: <?php mfn_opts_show( 'color-pricing-header', '#364c1e' ) ?>;
	}
	.pricing-box .plan-header .subtitle {
		color: <?php mfn_opts_show( 'color-pricing-subheader', '#fff' ) ?>;
	}

/* Portfolio page */
	.Projects_header .categories ul li.current-cat a, .Projects_header .categories ul li a:hover {
		background: <?php mfn_opts_show( 'background-portfolio-category-active', '#88BE4C' ) ?>;
	}

/* Portfolio carousel */
	.portfolio .desc { 
		background: <?php mfn_opts_show( 'background-portfolio-slide', '#91c25b' ) ?>;
		color: <?php mfn_opts_show( 'color-portfolio-slide', '#fff' ) ?>;
	}
	.portfolio .desc h4 a {
		color: <?php mfn_opts_show( 'color-portfolio-slide', '#fff' ) ?>;
	}
	.portfolio ul.portfolio-slider li .desc .inside p.project_url {
		color: <?php mfn_opts_show( 'color-portfolio-slide-note', '#d4ffa4' ) ?>;
	}
	.portfolio ul.portfolio-slider li .desc .inside p.project_url i, .portfolio ul.portfolio-slider li .desc .inside p.project_url a {
		color: <?php mfn_opts_show( 'color-portfolio-slide-a', '#384b23' ) ?>;
	}
	
/* Full Screen Portfolio */
	.fsa-slider {
		background: <?php mfn_opts_show( 'background-full-screen', '#262932' ) ?>;
	}
	.fsa-slider-wrapper li .fsa-title {
		color:<?php mfn_opts_show( 'color-full-screen-text', '#fff' ) ?>;
	}
	.fsa-slider-wrapper li .fsa-content .desc {
		color: <?php hex2rgba( mfn_opts_get( 'color-full-screen-text', '#fff' ), 0.75, true ) ?>;
	}
	.fsa-slider-wrapper li {
		border-color: <?php mfn_opts_show( 'border-full-screen-odd', '#88BE4C' ) ?>;
	}
	.fsa-slider-wrapper li:nth-child(even) {
		border-color: <?php mfn_opts_show( 'border-full-screen-even', '#B3EF6C' ) ?>;
	}
	
/* Blog */
	.post-icon, .Recent_posts ul li .desc .ico i {
		background: <?php mfn_opts_show( 'background-blog-icon', '#88be4c' ) ?>;
		color: <?php mfn_opts_show( 'color-blog-icon', '#fff' ) ?>;
	}
	
/* Footer  ***********************************************/
	.widgets_wrapper, .widgets_wrapper .company_box a, .widgets_wrapper .widget_categories ul li a, .widgets_wrapper .widget_archive ul li a, 
	.widgets_wrapper .widget_mfn_menu ul li a, .widgets_wrapper .widget_nav_menu ul li a, .widgets_wrapper .widget_meta ul li a {
		color: <?php mfn_opts_show( 'color-footer', '#b7bcc8' ) ?>;
	}
	.widgets_wrapper a, .copyrights a {
		color: <?php mfn_opts_show( 'color-footer-a', '#88be4c' ) ?>;
	}
	.widgets_wrapper a:hover, .copyrights a:hover {
		color: <?php mfn_opts_show( 'color-footer-a-hover', '#6e9b3b' ) ?>;
	}
	.widgets_wrapper h1, .widgets_wrapper h1 a, .widgets_wrapper h1 a:hover,
	.widgets_wrapper h2, .widgets_wrapper h2 a, .widgets_wrapper h2 a:hover,
	.widgets_wrapper h3, .widgets_wrapper h3 a, .widgets_wrapper h3 a:hover,
	.widgets_wrapper h4, .widgets_wrapper h4 a, .widgets_wrapper h4 a:hover,
	.widgets_wrapper h5, .widgets_wrapper h5 a, .widgets_wrapper h5 a:hover,
	.widgets_wrapper h6, .widgets_wrapper h6 a, .widgets_wrapper h6 a:hover {
		color: <?php mfn_opts_show( 'color-footer-heading', '#E6E9EF' ) ?>;
	}
	.widgets_wrapper aside > h4 {
		color: <?php mfn_opts_show( 'color-footer-widget-title', '#88be4c' ) ?>;
	}
	
	/* Grey notes */
	.widgets_wrapper .Recent_posts ul li .date, .Recent_comments ul li .author {
		color: <?php mfn_opts_show( 'color-footer-note', '#8fa5b8' ) ?>;
	}		
	
	.copyrights {
		color: <?php mfn_opts_show( 'color-footer-copyright', '#565a62' ) ?>;
	}
