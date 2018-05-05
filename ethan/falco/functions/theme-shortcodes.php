<?php
/**
 * Shortcodes.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

// column shortcodes --------------------
add_shortcode( 'one', 'sc_one' );
add_shortcode( 'one_second', 'sc_one_second' );
add_shortcode( 'one_third', 'sc_one_third' );
add_shortcode( 'two_third', 'sc_two_third' );
add_shortcode( 'one_fourth', 'sc_one_fourth' );
add_shortcode( 'two_fourth', 'sc_two_fourth' );
add_shortcode( 'three_fourth', 'sc_three_fourth' );

// content shortcodes -------------------
add_shortcode( 'blockquote', 'sc_blockquote' );
add_shortcode( 'button', 'sc_button' );
add_shortcode( 'code', 'sc_code' );
add_shortcode( 'divider', 'sc_divider' );
add_shortcode( 'highlight', 'sc_highlight' );
add_shortcode( 'ico', 'sc_ico' );
add_shortcode( 'icon_list', 'sc_icon_list' );
add_shortcode( 'image', 'sc_image' );
add_shortcode( 'vimeo', 'sc_vimeo' );
add_shortcode( 'youtube', 'sc_youtube' );

// private shortcodes -------------------
add_shortcode( 'bar', 'sc_bar' );


/* ---------------------------------------------------------------------------
 * Shortcode [one] [/one]
 * --------------------------------------------------------------------------- */
function sc_one( $attr, $content = null )
{
	$output  = '<div class="column one">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [one_second] [/one_second]
 * --------------------------------------------------------------------------- */
function sc_one_second( $attr, $content = null )
{
	$output  = '<div class="column one-second">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [one_third] [/one_third]
 * --------------------------------------------------------------------------- */
function sc_one_third( $attr, $content = null )
{
	$output  = '<div class="column one-third">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}

/* ---------------------------------------------------------------------------
 * Shortcode [two_third] [/two_third]
 * --------------------------------------------------------------------------- */
function sc_two_third( $attr, $content = null )
{
	$output  = '<div class="column two-third">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [one_fourth] [/one_fourth]
 * --------------------------------------------------------------------------- */
function sc_one_fourth( $attr, $content = null )
{
	$output  = '<div class="column one-fourth">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [two_fourth] [/two_fourth]
 * --------------------------------------------------------------------------- */
function sc_two_fourth( $attr, $content = null )
{
	$output  = '<div class="column two-fourth">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [three_fourth] [/three_fourth]
 * --------------------------------------------------------------------------- */
function sc_three_fourth( $attr, $content = null )
{
	$output  = '<div class="column three-fourth">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Code [code]
 * --------------------------------------------------------------------------- */
function sc_code( $attr, $content = null )
{
	$output  = '<pre>';
		$output .= do_shortcode(htmlspecialchars($content));
	$output .= '</pre>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Article Box [article_box]
* --------------------------------------------------------------------------- */
function sc_article_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'image' => '',
		'subtitle' => '',
		'link' => '',
		'link_title' => 'Read more',
		'target' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
	
	$output = '<div class="article_box_wrapper">';
	
		if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
	
		$output .= '<div class="photo">';
			if( $link )  $output .= '<a href="'. $link .'" '. $target .'>';
				$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
			if( $link )  $output .= '</a>';
		$output .= '</div>';
		
		$output .= '<div class="desc">';
			if( $subtitle ) $output .= '<h5 class="subtitle">'. $subtitle .'</h5>';
			$output .= '<p>'. do_shortcode( $content ) .'</p>';
		$output .= '</div>';
		
		if( $link ) $output .= '<a class="button" href="'. $link .'" '. $target .'>'. $link_title .'&nbsp;&nbsp;<i class="icon-angle-right"></i></a>';
	
	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Feature Box [feature_box]
 * --------------------------------------------------------------------------- */
function sc_feature_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'image' 	=> '',
		'icon' 		=> '',
		'title' 	=> '',
		'link' 		=> '',
		'target' 	=> '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
	
	$output = '<div class="feature_box_wrapper">';
		if( $link )  $output .= '<a href="'. $link .'" '. $target .'>';
		
			$output .= '<div class="photo">';
				$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
			$output .= '</div>';
			
			$output .= '<div class="desc">';
				if( $icon )  $output .= '<span class="icon"><i class="'. $icon .'"></i></span>';
				if( $title ) $output .= '<h3 class="title">'. $title .'</h3>';
				$output .= '<p>'. do_shortcode( $content ) .'</p>';
			$output .= '</div>';
	
		if( $link )  $output .= '</a>';
	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Fancy Heading [fancy_heading]
 * --------------------------------------------------------------------------- */
function sc_fancy_heading( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'icon' 	=> '',
		'image' => '',
		'color' => '',
		'class' => '',
	), $attr));
	
	// background
	$style = '';
	if( $image ) $style .= 'background-image:url('. $image .');';
	if( $color ) $style .= ' background-color:'. $color .';';
	
	// no icon
	if( ! $icon ) $class .= " no_icon";

	$output = '<div class="fancy_heading_wrapper '. $class .'" style="'. $style .'">';
		$output .= '<h2>'. $title .'</h2>';
		$output .= '<div class="inside">';
			$output .= do_shortcode($content);
		$output .= '</div>';
		if( $icon ) $output .= '<i class="'. $icon .'"></i>';		
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Offer [offer]
 * --------------------------------------------------------------------------- */
function sc_offer( $attr = false, $content = null )
{	
	$args = array(
		'post_type'				=> 'offer',
		'posts_per_page'		=> -1,
		'orderby'				=> 'menu_order',
		'order'					=> 'ASC',
		'ignore_sticky_posts'	=> 1,
	);
	
	$offer_query = new WP_Query();
	$offer_query->query( $args );
	
	$output = '';
	if ($offer_query->have_posts())
	{
		$output .= '<div class="offer_wrapper">';		
			$output .= '<ul class="offer-slider">';
		
				while ($offer_query->have_posts())
				{
					$offer_query->the_post();
					$output .= '<li>';
						
						$output .= '<div class="image">';	
							if ( $video = get_post_meta( get_the_ID(), 'mfn-post-vimeo', true) ){
								$output .= '<iframe class="scale-with-grid" src="http://player.vimeo.com/video/'. $video .'" allowFullScreen></iframe>';
							} elseif ( $video = get_post_meta( get_the_ID(), 'mfn-post-youtube', true) ){
								$output .= '<iframe class="scale-with-grid" src="http://www.youtube.com/embed/'. $video .'?wmode=opaque" allowfullscreen></iframe>';
							} else {
								$output .= get_the_post_thumbnail( get_the_ID(), 'offer-slider', array('class'=>'scale-with-grid' ) );
							}
						$output .= '</div>';
						
						$output .= '<div class="desc">';
							$output .= '<h3 class="title">'. get_the_title() .'</h3>';
							$output .= '<div class="inside">'. do_shortcode( get_the_content() ) .'</div>';
						$output .= '</div>';
						
					$output .= '</li>';
				}
				
			$output .= '</ul>';
		$output .= '</div>'."\n";
	}
	wp_reset_query();
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Contact Box [contact_box]
 * --------------------------------------------------------------------------- */
function sc_contact_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title'			=> '',
		'lat' 			=> '',
		'lng' 			=> '',
		'zoom' 			=> 13,
		'uid' 			=> uniqid(),
		'address' 		=> '',
		'telephone'		=> '',
		'email' 		=> '',
		'www' 			=> '',
		'link_title' 	=> 'About us',
		'link' 			=> '',
		'link2_title' 	=> 'Contact page',
		'link2' 		=> '',
	), $attr));
	
	$output = '<div class="contact_box_wrapper">';
	
		if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
	
		if( $lat && $lng ){
			wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?sensor=false', false, THEME_VERSION, true );
			$output .= '<script>';
				//<![CDATA[
					$output .= 'function google_maps_'. $uid .'(){';
						$output .= 'var latlng = new google.maps.LatLng('. $lat .','. $lng .');';
						$output .= 'var myOptions = {';
							$output .= 'zoom				: '. intval($zoom) .',';
							$output .= 'center				: latlng,';
							$output .= 'zoomControl			: true,';
							$output .= 'mapTypeControl		: false,';
							$output .= 'streetViewControl	: false,';
							$output .= 'scrollwheel			: false,';
							$output .= 'mapTypeId			: google.maps.MapTypeId.ROADMAP';
						$output .= '};';
						
						$output .= 'var map = new google.maps.Map(document.getElementById("google-map-area-'. $uid .'"), myOptions);';
						$output .= 'var image = "'. THEME_URI .'/images/pin_small.png";';
						$output .= 'var marker = new google.maps.Marker({';
							$output .= 'position			: latlng,';
							$output .= 'map					: map,';
							$output .= 'icon				: image';
						$output .= '});';
					$output .= '}';
					
					$output .= 'jQuery(document).ready(function($){';
						$output .= 'google_maps_'. $uid .'();';
					$output .= '});';
				//]]>
			$output .= '</script>'."\n";
			
			$output .= '<div class="google-map" id="google-map-area-'. $uid .'" style="width:100%; height:135px;">&nbsp;</div>'."\n";
		}
		
		$output .= '<ul>';
			if( $address ){
				$output .= '<li class="address">';
				$output .= '<p>'. $address .'</p>';
				$output .= '</li>';
			}
			if( $telephone ){
				$output .= '<li class="phone">';
				$output .= '<i class="icon-phone"></i><p><a href="tel:'. $telephone .'">'. $telephone .'</a></p>';
				$output .= '</li>';
			}
			if( $email ){
				$output .= '<li class="mail">';
				$output .= '<i class="icon-envelope"></i><p><a href="mailto:'. $email .'">'. $email .'</a></p>';
				$output .= '</li>';
			}
			if( $www ){
				$output .= '<li class="www">';
				$output .= '<i class="icon-globe"></i><p><a href="http://'. $www .'" target="_blank">'. $www .'</a></p>';
				$output .= '</li>';
			}
		$output .= '</ul>';
		
		$output .= '<div class="buttons_wrapper">';
			if( $link ) $output .= '<a class="button button_about" href="'. $link .'">'. $link_title .'</a>';
			if( $link2 ) $output .= '<a class="button button_form" href="'. $link2 .'">'. $link2_title .'</a>';
		$output .= '</div>';
		
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Divider [divider]
 * --------------------------------------------------------------------------- */
function sc_divider( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'height' => '0',
		'line' => '',
	), $attr));
	
	$line = ( $line ) ? false : ' border:none; width:0; height:0;';		
	$output = '<hr style="margin: 0 0 '. intval($height) .'px;'. $line .'" />'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Portfolio [portfolio]
* --------------------------------------------------------------------------- */
function sc_portfolio( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'count' 		=> '5',
		'category' 		=> '',
		'orderby' 		=> 'menu_order',
		'order' 		=> 'ASC',
		'link'			=> '',
	), $attr));
	
	// translate
	$translate['website'] = mfn_opts_get('translate') ? mfn_opts_get('translate-website','Website:') : __('Website:','falco');
	$translate['visit-online'] = mfn_opts_get('translate') ? mfn_opts_get('translate-visit-online','Visit online &rarr;') : __('Visit online &rarr;','falco');
	
	$args = array(
		'post_type' 			=> 'portfolio',
		'posts_per_page' 		=> intval($count),
		'paged' 				=> -1,
		'orderby' 				=> $orderby,
		'order' 				=> $order,
		'ignore_sticky_posts' 	=> 1,
	);
	if( $category ) $args['portfolio-types'] = $category;
	
	$query = new WP_Query();
	$query->query( $args );
	$post_count = $query->post_count;
	
	$output = '';
	if ($query->have_posts())
	{
		$output .= '<div class="portfolio_wrapper">';
			
			$output .= '<ul class="portfolio-slider">';
				while ($query->have_posts())
				{
					$query->the_post();
						
					$output .= '<li>';
					
						$output .= '<div class="photo">';
							$output .= get_the_post_thumbnail( null, 'portfolio-slider', array('class'=>'scale-with-grid' ) );
							$output .= '<div class="mask">';
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );						
								$output .= '<a class="button_image zoom prettyphoto" href="'. $large_image_url[0] .'"></a>';
								$output .= '<a class="button_image more" href="'. get_permalink() .'"></a>';
							$output .= '</div>';
						$output .= '</div>';
						
						$output .= '<div class="desc">';
							$output .= '<h4 class="title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
							$output .= '<div class="inside">';
								$output .= get_the_excerpt();
								if( $projectURL = get_post_meta( get_the_ID(), 'mfn-post-link', true ) ){
									$output .= '<p class="project_url">';
										$output .= $translate['website'] .' <i class="icon-external-link"></i> ';
										$output .= '<a href="'. $projectURL .'" target="_blank">'. $translate['visit-online'] .'</a>';
									$output .= '</p>';
								}
							$output .= '</div>';
						$output .= '</div>';
						
					$output .= '</li>';
				}
			$output .= '</ul>';
			
			if( $link ) $output .= '<div class="more"><a class="button" href="'. $link .'"><i class="icon-th"></i></a></div>';
		$output .= '</div>'."\n";
	}
	wp_reset_query();

	return $output;	
}

/* ---------------------------------------------------------------------------
 * Clients [clients]
 * --------------------------------------------------------------------------- */
function sc_clients( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'in_row' => 6,
	), $attr));
	
	if( ! intval( $in_row ) ) $in_row = 6;
	
	$args = array(
		'post_type' => 'client',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);

	$clients_query = new WP_Query();
	$clients_query->query( $args );

	$output  = '<div class="clients_wrapper">';
		if ($clients_query->have_posts())
		{
			$i = 1;
			$count = $clients_query->post_count;			
			$width = round( (100 / $in_row), 3 );
			$full_rows = floor( ($count-1) / $in_row );
			$in_full_rows = $full_rows * $in_row;

			$output .= '<ul>';
			while ($clients_query->have_posts())
			{
				$class = '';
				if( ( $i % $in_row == 0 ) || $i == $count ) $class .= 'last_in_row';			// desktop - last in row 
				if( $i > $in_full_rows ) $class .= ' last_row';									// desktop - last row
				if( $i == $count ) $class .= ' last_row_mobile';								// mobile - last item
				if( ( ($i+1) == $count ) && ( $count % 2 == 0 ) ) $class .= ' last_row_mobile';	// mobile - even number of rows
				
				$clients_query->the_post();
				$output .= '<li class="'. $class .'" style="width:'. $width .'%">';
					$output .= '<div class="client_wrapper">';
						$link = get_post_meta(get_the_ID(), 'mfn-post-link', true);
						if( $link ) $output .= '<a target="_blank" href="'. $link .'" title="'. the_title(false, false, false) .'">';
							$output .= get_the_post_thumbnail( null, 'clients-slider', array('class'=>'scale-with-grid') );
						if( $link ) $output .= '</a>';
					$output .= '</div>';
				$output .= '</li>';
				
				$i++;
			}
			$output .= '</ul>'."\n";
		}
		wp_reset_query();
	$output .= '</div>'."\n";

	return $output;
}

/* ---------------------------------------------------------------------------
 * Pricing Item [pricing_item]
 * --------------------------------------------------------------------------- */
function sc_pricing_item( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' 		=> '',
		'subtitle' 		=> '',
		'price' 		=> '',
		'currency' 		=> '',
		'period' 		=> '',
		'link_title'	=> '',
		'link' 			=> '',
		'featured' 		=> '',
	), $attr));
	
	$classes = '';
	
	// featured
	if( $featured ){
		$classes .= ' pricing-box-featured';
	}

	$output = '<div class="pricing-box'. $classes .'">';
		$output .= '<div class="plan-header">';
			$output .= '<h3>'. $title .'</h3>';
			if( $subtitle )$output .= '<p class="subtitle">'. $subtitle .'</p>';
		$output .= '</div>';
		$output .= '<div class="plan-inside">';
			$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="plan-footer">';
			if( $price ) $output .= '<div class="price"><sup class="currency">'. $currency .'</sup>'. $price .'<sup class="period">'. $period .'</sup></div>';
			if( $link ) $output .= '<div class="button"><a class="button" href="'. $link .'">'. $link_title .'</a></div>';
		$output .= '</div>';
	$output .= '</div>'."\n";
		
    return $output;
}


/* ---------------------------------------------------------------------------
 * Icon Box [icon_box]
 * --------------------------------------------------------------------------- */
function sc_icon_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title'			=> '',
		'icon'			=> '',
		'image'			=> '',
		'link_title'	=> 'Read more',
		'link'			=> '',
		'target'		=> '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}

	$output = '<div class="icon_box_wrapper">';
	
		$output .= '<div class="icon_image">';
			if( $image ){
				$output .= '<img src="'. $image .'" alt="'. $title .'" />';
			} elseif( $icon ){
				$output .= '<i class="'. $icon .'"></i>';
			}
		$output .= '</div>';
		
		if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
		if( $content ) $output .= '<p>'. do_shortcode($content) .'</p>';
		
		if( $link ) $output .= '<a class="button readmore" href="'. $link .'" '. $target .'>'. $link_title .'&nbsp;&nbsp;<i class="icon-angle-right"></i></a>';
		
	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Ico [ico]
 * --------------------------------------------------------------------------- */
function sc_ico( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'type' => '',
	), $attr));
	
	$output = '<i class="'. $type .'"></i>';

	return $output;
}


/* ---------------------------------------------------------------------------
 * Icon List [icon_list]
 * --------------------------------------------------------------------------- */
function sc_icon_list( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' 	=> '',
		'image'		=> '',
		'icon' 		=> 'icon-info',
	), $attr));
	
	$output  = '<div class="icon_list">';
		$output .= '<div class="icon">';
			if( $image ){
				$output .= '<img src="'. $image .'" alt="'. $title .'" />';
			} elseif( $icon ) {
				$output .= '<i class="'. $icon .'"></i>';
			}
		$output .= '</div>';
		$output .= '<div class="il-desc">';
			$output .= '<h5>'. $title .'</h5>';
			$output .= '<p>'. $content .'</p>';
		$output .= '</div>';
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Image [image]
 * --------------------------------------------------------------------------- */
function sc_image( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'src'			=> '',
		'alt'			=> '',
		'caption'		=> '',
		'align'			=> '',
		'link'			=> '',
		'link_image'	=> '',
		'link_type'		=> '',
		'target'		=> '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
	
	// align
	if( $align ) $align = ' align'. $align;
	
	// hoover icon
	if( $link_type == 'zoom' || $link_image )	{
		$class= 'zoom prettyphoto';
		$target = false;
	} else {
		$class = 'more';
	}
	
	// link
	if( $link_image ) $link = $link_image;
	
	if( $link )
	{
		$output  = '<div class="scale-with-grid aligncenter wp-caption has-hover'. $align .'">';
			$output .= '<div class="photo">';			
				$output .= '<img class="scale-with-grid" src="'. $src .'" alt="'. $alt .'" />';
				$output .= '<div class="mask">';
					$output .= '<a href="'. $link .'" class="button_image '. $class .'" '. $target .'></a>';
				$output .= '</div>';
			$output .= '</div>';
			if( $caption ) $output .= '<p class="wp-caption-text">'. $caption .'</p>';
		$output .= '</div>'."\n";
	}
	else 
	{
		$output  = '<div class="scale-with-grid aligncenter wp-caption no-hover'. $align .'">';
			$output .= '<div class="photo">';
				$output .= '<img class="scale-with-grid" src="'. $src .'" alt="'. $alt .'" />';
			$output .= '</div>';
			if( $caption ) $output .= '<p class="wp-caption-text">'. $caption .'</p>';
		$output .= '</div>'."\n";
	}

    return $output;
}


/* ---------------------------------------------------------------------------
 * Button [button]
 * --------------------------------------------------------------------------- */
function sc_button( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'size' => '',
		'color' => '',
		'title' => 'Read more',
		'link' => '',
		'target' => '',
		'class' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
						
	$output = '<a class="button button_'. $size .' button_'. $color .' '. $class .'" href="'. $link .'" '. $target .'>'. $title .'</a>'."\n";

    return $output;
}


/* ---------------------------------------------------------------------------
 * Highlight [highlight] [/highlight]
 * --------------------------------------------------------------------------- */
function sc_highlight( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'background' 	=> '',
		'color' 		=> '',
	), $attr));
	
	// style
	$style = '';
	if( $background ) $style .= 'background-color:'. $background .';';
	if( $color ) $style .= ' color:'. $color .';';
	if( $style ) $style = 'style="'. $style .'"';
						
	$output  = '<span class="highlight" '. $style .'>';
		$output .= $content;
	$output .= '</span>'."\n";

    return $output;
}


/* ---------------------------------------------------------------------------
 * Blockquote [blockquote] [/blockquote]
 * --------------------------------------------------------------------------- */
function sc_blockquote( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'photo' => '',
		'author' => '',
		'company' => '',
		'link' => '',
		'target' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
	
	$output = '<blockquote>';
	
		$output .= '<div class="inside">'. do_shortcode( $content ) .'</div>';
	
		$output .= '<div class="author">';
			$output .= '<div class="author_wrapper">';
				
				$output .= '<div class="photo">';
					if( $photo ){
						$output .= '<img class="scale-with-grid" src="'. $photo .'" alt="'.$author .'" />';
					} else {
						$output .= '<img class="scale-with-grid" src="'. THEME_URI .'/images/testimonials-placeholder.png" alt="'. $author .'" />';
					}
				$output .= '</div>';
				
				$output .= '<div class="desc">';
					$output .= '<h6>'. $author .'</h6>';
					if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
						$output .= '<span>'. $company .'</span>';
					if( $link ) $output .= '</a>';
				$output .= '</div>';
				
			$output .= '</div>';
		$output .= '</div>';
		
	$output .= '</blockquote>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Our Team [our_team]
 * --------------------------------------------------------------------------- */
function sc_our_team( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'image' => '',	
		'title' => '',
		'subtitle' => '',
		'email' => '',
		'phone' => '',
		'facebook' => '',
		'twitter' => '',
		'linkedin' => '',
	), $attr));
	
	$output = '<div class="team">';
		$output .= '<div class="photo">';
			$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
		$output .= '</div>';
		$output .= '<div class="desc">';
			if( $title ) $output .= '<h4>'. $title .'</h4>';
			if( $subtitle ) $output .= '<p>'. $subtitle .'</p>';
			if( $phone ) 	$output .= '<p class="phone"><i class="icon-phone"></i> <a target="_blank" href="tel:'. $phone .'">'. $phone .'</a></p>';
		$output .= '</div>';
		if( $email || $phone || $facebook || $twitter || $linkedin ){
			$output .= '<div class="links">';
				if( $email ) 	$output .= '<a target="_blank" class="link" href="mailto:'. $email .'"><i class="icon-envelope"></i></a>';
				if( $facebook ) $output .= '<a target="_blank" class="link" href="'. $facebook .'"><i class="icon-facebook"></i></a>';
				if( $twitter ) 	$output .= '<a target="_blank" class="link" href="'. $twitter .'"><i class="icon-twitter"></i></a>';
				if( $linkedin ) $output .= '<a target="_blank" class="link" href="'. $linkedin .'"><i class="icon-linkedin"></i></a>';
			$output .= '</div>';
		}
	$output .= '</div>'."\n";	

	return $output;
}


/* ---------------------------------------------------------------------------
 * Map [map]
 * --------------------------------------------------------------------------- */
function sc_map( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'lat' 		=> '',
		'lng' 		=> '',
		'height' 	=> 200,
		'zoom' 		=> 13,
		'uid' 		=> uniqid(),
	), $attr));
	
	wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?sensor=false', false, THEME_VERSION, true );

	$output = '<script>';
		//<![CDATA[
		$output .= 'function google_maps_'. $uid .'(){';
			$output .= 'var latlng = new google.maps.LatLng('. $lat .','. $lng .');';
			$output .= 'var myOptions = {';
				$output .= 'zoom				: '. intval($zoom) .',';
				$output .= 'center				: latlng,';
				$output .= 'zoomControl			: true,';
				$output .= 'mapTypeControl		: false,';
				$output .= 'streetViewControl	: false,';
				$output .= 'scrollwheel			: false,';       
				$output .= 'mapTypeId			: google.maps.MapTypeId.ROADMAP';
			$output .= '};';
	
			$output .= 'var map = new google.maps.Map(document.getElementById("google-map-area-'. $uid .'"), myOptions);';
			$output .= 'var image = "'. THEME_URI .'/images/pin_large.png";';
			$output .= 'var marker = new google.maps.Marker({';
				$output .= 'position			: latlng,';
				$output .= 'map					: map,';
				$output .= 'icon				: image';
			$output .= '});';
		
		$output .= '}';
	
		$output .= 'jQuery(document).ready(function($){';
			$output .= 'google_maps_'. $uid .'();';
		$output .= '});';	
		//]]>
	$output .= '</script>'."\n";

	$output .= '<div class="google-map" id="google-map-area-'. $uid .'" style="width:100%; height:'. intval($height) .'px;">&nbsp;</div>'."\n";	

	return $output;
}


/* ---------------------------------------------------------------------------
 * Tabs [tabs]
 * --------------------------------------------------------------------------- */
global $tabs_array, $tabs_count;
function sc_tabs( $attr, $content = null )
{
	global $tabs_array, $tabs_count;
	
	extract(shortcode_atts(array(
		'uid' => uniqid(),
		'tabs' => '',
	), $attr));	
	do_shortcode( $content );
	
	// content builder
	if( $tabs ){
		$tabs_array = $tabs;
	}
	
	if( is_array( $tabs_array ) )
	{
		$output  = '<div class="jq-tabs">';
		$output .= '<ul>';
		
		$i = 1;
		$output_tabs = '';
		foreach( $tabs_array as $tab )
		{
			$output .= '<li><a href="#tab-'. $uid .'-'. $i .'">'. $tab['title'] .'</a></li>';
			$output_tabs .= '<div id="tab-'. $uid .'-'. $i .'">'. do_shortcode( $tab['content'] ) .'</div>';
			$i++;
		}
		
		$output .= '</ul>';
		$output .= $output_tabs;
		$output .= '</div>';
		
		$tabs_array = '';
		$tabs_count = 0;

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * _Tab [tab] _private
 * --------------------------------------------------------------------------- */
$tabs_count = 0;
function sc_tab( $attr, $content = null )
{
	global $tabs_array, $tabs_count;
	
	extract(shortcode_atts(array(
		'title' => 'Tab title',
	), $attr));
	
	$tabs_array[] = array(
		'title' => $title,
		'content' => do_shortcode( $content )
	);	
	$tabs_count++;

	return true;
}


/* ---------------------------------------------------------------------------
 * Accordion [accordion]
 * --------------------------------------------------------------------------- */
function sc_accordion( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' 	=> '',
		'tabs' 		=> '',
		'open1st' 	=> '',
	), $attr));
	
	// open 1st
	if( $open1st ){
		$class = 'open1st';
	} else {
		$class = false;
	}
	
	$output  = '';
	
	if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
	$output .= '<div class="mfn-acc accordion '. $class .'">';
				
		if( is_array( $tabs ) ){
			// content builder
			foreach( $tabs as $tab ){
				$output .= '<div class="question">';
					$output .= '<h5>'. $tab['title'] .'</h5>';
					$output .= '<div class="answer">';
						$output .= do_shortcode($tab['content']);	
					$output .= '</div>';
				$output .= '</div>'."\n";
			}
		} else {
			// shortcode
			$output .= do_shortcode($content);	
		}
		
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * FAQ [faq]
 * --------------------------------------------------------------------------- */
function sc_faq( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' 	=> '',
		'tabs' 		=> '',
		'open1st' 	=> '',
	), $attr));
	
	// open 1st
	if( $open1st ){
		$class = 'open1st';
	} else {
		$class = false;
	}
	
	$output  = '';
	
	if( $title ) $output .= '<h3>'. $title .'</h3>';
	$output .= '<div class="mfn-acc faq '. $class .'">';
	
	if( is_array( $tabs ) ){
		// content builder
		foreach( $tabs as $tab ){
			$output .= '<div class="question">';
				$output .= '<h5>'. $tab['title'] .'</h5>';
				$output .= '<div class="answer">';
					$output .= do_shortcode($tab['content']);	
				$output .= '</div>';
			$output .= '</div>'."\n";
		}
	} else {
		// shortcode
		$output .= do_shortcode($content);	
	}
	
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Progress Bars [progress_bars]
* --------------------------------------------------------------------------- */
function sc_progress_bars( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
	), $attr));


	$output = '<div class="progress_bars_wrapper">';
		if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
		$output .= '<ul class="bars_list">';
			$output .= do_shortcode( $content );
		$output .= '</ul>';
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * _Bar [bar]
* --------------------------------------------------------------------------- */
function sc_bar( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'value' => 0,
	), $attr));

	$value = intval( $value );

	$output  = '<li>';
		$output .= '<h6>'. $title .'<span class="label">'. $value .'%</span></h6>';
		$output .= '<div class="bar"><span class="progress" style="width:'. $value .'%"></span></div>';
	$output .= '</li>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Timeline [timeline]
 * --------------------------------------------------------------------------- */
function sc_timeline( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'count' => '',
		'tabs' => '',
	), $attr));
	
	$output  = '<ul class="timeline_items">';
	
	if( is_array( $tabs ) ){
		// content builder
		foreach( $tabs as $tab ){
			$output .= '<li>';
				$output .= '<h5>'. $tab['title'] .'</h5>';
				if( $tab['content'] ){
					$output .= '<div class="desc">';
						$output .= do_shortcode($tab['content']);
					$output .= '</div>';
				}
			$output .= '</li>';
		}
	} else {
		// shortcode
		$output .= do_shortcode($content);
	}
	
	$output .= '</ul>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Testimonials [testimonials]
 * --------------------------------------------------------------------------- */
function sc_testimonials( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'category' => '',
		'orderby' => 'menu_order',
		'order' => 'ASC',
	), $attr));
	
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1,
		'orderby' => $orderby,
		'order' => $order,
		'ignore_sticky_posts' =>1,
	);
	if( $category ) $args['testimonial-types'] = $category;
	
	$query_tm_photos = new WP_Query();
	$query_tm_photos->query( $args );
	
	$output = '';
	if ($query_tm_photos->have_posts())
	{
		$output .= '<div class="testimonials_wrapper">';
		
			// photos ----------------------
			$output .= '<ul class="photos">';
				while ($query_tm_photos->have_posts())
				{
					$query_tm_photos->the_post();

					$output .= '<li class="tm-'. get_the_ID() .'">';
						$output .= '<a href="#" class="photo">';
							if( has_post_thumbnail() ){
								$output .= get_the_post_thumbnail( null, 'testimonials', array('class'=>'scale-with-grid' ) );
							} else {
								$output .= '<img class="scale-with-grid" src="'. THEME_URI .'/images/testimonials-placeholder.png" alt="'. get_post_meta(get_the_ID(), 'mfn-post-author', true) .'" />';
							}
						$output .= '</a>';
					$output .= '</li>';
				}
			$output .= '</ul>';
			wp_reset_query();
			
			// content ----------------------
			$query_tm_content = new WP_Query();
			$query_tm_content->query( $args );
			
			$output .= '<ul class="tm-content clearfix">';			
				while ($query_tm_content->have_posts())
				{
					$query_tm_content->the_post();
					
					$output .= '<li class="tm-'. get_the_ID() .'">';
					
						$output .= '<div class="right">';
							$output .= '<div class="desc">';
								$output .= do_shortcode( get_the_content() );
							$output .= '</div>';
						$output .= '</div>';
					
						$output .= '<div class="left">';
							$output .= '<div class="author">';
								$output .= '<h6>'. get_post_meta(get_the_ID(), 'mfn-post-author', true) .'</h6>';
								if( $link = get_post_meta(get_the_ID(), 'mfn-post-link', true) ) $output .= '<a target="_blank" href="'. $link .'">';
									$output .= '<span>'. get_post_meta(get_the_ID(), 'mfn-post-company', true) .'</span>';
								if( $link ) $output .= '</a>';
							$output .= '</div>';
						$output .= '</div>';
	
					$output .= '</li>';
				}
			$output .= '</ul>';
			wp_reset_query();
			
		$output .= '</div>'."\n";
	}
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Vimeo [vimeo]
 * --------------------------------------------------------------------------- */
function sc_vimeo( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'width' => '710',
		'height' => '426',
		'video' => '',
	), $attr));
	
	$output  = '<div class="article_video">';
	$output .= '<iframe class="scale-with-grid" width="'. $width .'" height="'. $height .'" src="http://player.vimeo.com/video/'. $video .'" allowFullScreen></iframe>'."\n";
	$output .= '</div>';
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * YouTube [youtube]
 * --------------------------------------------------------------------------- */
function sc_youtube( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'width' => '710',
		'height' => '426',
		'video' => '',
	), $attr));
	
	$output  = '<div class="article_video">';
	$output .= '<iframe class="scale-with-grid" width="'. $width .'" height="'. $height .'" src="http://www.youtube.com/embed/'. $video .'?wmode=opaque" allowfullscreen></iframe>'."\n";
	$output .= '</div>';
	
	return $output;
}

?>