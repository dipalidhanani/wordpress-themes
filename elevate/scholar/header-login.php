<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/css/media.css" type="text/css" media="screen" charset="utf-8">
<?php wp_head(); ?>
<?php woo_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php woo_top(); ?>
<div id="wrapper">

	<div id="inner-wrapper" class="logoin_area">
    <div class="page-wrap">
    <?php woo_header_before(); ?>

	
	
