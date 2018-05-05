<?php
/**
 * Menu functions.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */


/* ---------------------------------------------------------------------------
 * Registers a menu location to use with navigation menus.
 * --------------------------------------------------------------------------- */
register_nav_menu( 'main-menu',		__( 'Main Menu', 'mfn-opts' ) );
register_nav_menu( 'lang-menu',		__( 'Languages Menu', 'mfn-opts' ) );

// demo
if( $_GET && key_exists('mfn-mm', $_GET) ) register_nav_menu( 'demo', 'Demo Uber Menu' );

/* ---------------------------------------------------------------------------
 * Main Menu
 * --------------------------------------------------------------------------- */
function mfn_wp_nav_menu( $location = 'main-menu' ) 
{
	// demo
	if( $_GET && key_exists('mfn-mm', $_GET) ) $location = 'demo';
	
	$args = array( 
		'container' 		=> 'nav',
		'container_id'		=> 'menu', 
		'menu_class'		=> 'menu', 
		'fallback_cb'		=> 'mfn_wp_page_menu', 
		'theme_location'	=> $location,
		'depth' 			=> 3,
	);
	wp_nav_menu( $args ); 
}

function mfn_wp_page_menu() 
{
	$args = array(
		'title_li' => '0',
		'sort_column' => 'menu_order',
		'depth' => 3
	);

	echo '<nav id="menu">'."\n";
		echo '<ul class="menu">'."\n";
			wp_list_pages($args); 
		echo '</ul>'."\n";
	echo '</nav>'."\n";
}


/* ---------------------------------------------------------------------------
 * Languages menu
* --------------------------------------------------------------------------- */
function mfn_wp_lang_menu()
{
	$args = array(
		'container' 		=> false,
		'fallback_cb'		=> false,
		'menu_class'		=> '',
		'theme_location' 	=> 'lang-menu',
		'depth'				=> 1,
	);
	wp_nav_menu( $args );
}

?>