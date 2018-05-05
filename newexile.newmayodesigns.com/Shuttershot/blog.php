<?php
/**
 * The template for displaying all pages.
 
 Template name: Blog
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package web2feel
 */

get_header(); ?>
<div class="container_12 site-cover">
	<div id="primary" class="content-area grid_8">
		<main id="main" class="site-main" role="main">

			<?php
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			$wp_query->query('paged='.$paged);
			?>
			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	

				<?php get_template_part( 'content'); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
			<?php bootstrap_pagination();?>
			
			<?php $wp_query = null; $wp_query = $temp;?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
