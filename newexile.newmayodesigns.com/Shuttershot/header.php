<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package web2feel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<div id="page" class="hfeed site">


	<header id="masthead" class="site-header" role="banner">
		<div class="menu-btn">&#9776;</div>
		<div class="site-branding">
			<?php if( of_get_option('w2f_logo')!=''){ ?>
					<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <img src="<?php echo of_get_option('w2f_logo'); ?>" alt="" /> </a></div>
					<?php } else { ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php } ?>


		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->

<nav id="site-navigation" class="pushy pushy-left" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</nav><!-- #site-navigation -->

<div class="site-overlay"></div>
<div id="container">	

	<div id="content" class="site-content">
