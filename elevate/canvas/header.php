<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />
<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php wp_head(); ?>
<?php woo_head(); ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400Italic,600,700|Quicksand:400,700" rel="stylesheet">
</head>
<body <?php body_class(); ?>>
<?php woo_top(); ?>
<div id="wrapper">

	<div id="inner-wrapper">

	<?php woo_header_before(); ?>

    <div class="header">
    	<div class="wrapper">
		<?php woo_header_inside(); ?>
</div></div>
	<?php woo_header_after(); ?>