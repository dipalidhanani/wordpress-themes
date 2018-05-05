<?php
/**
 * Template Name:gallery-template
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			
			<div id="conten" role="main">
				<div class="sub2" style="width:100%"><?php the_title(); ?></div>
				<?php the_post(); ?>
					<!--<img style="margin:8px;padding:0px;"src="<?php bloginfo( 'template_url' )?>/images/cntact-us-txt.png" width="112" height="23"/>-->
				<?php get_template_part( 'content', 'page' ); ?>

				<?php //comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_footer(); ?>
