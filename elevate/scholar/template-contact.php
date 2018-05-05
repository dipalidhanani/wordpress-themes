<?php
/**
 * Template Name: Contact Form
 *
 * Here we setup all logic and HTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header(); ?>
<div class="outer-wrapper">
        	<div class="wrapper" id="support">
            	<h1 class="main-title">Contact</h1>
                
                <p class="support-txt"><?php echo get_the_content(); ?>
                </p>
                <div class="clear"></div>
            	
               <?php echo do_shortcode( '[ninja_forms id=1]' ); ?>
                
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>

   

<?php get_footer(); ?>