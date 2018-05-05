<?php/**
 * Template Name:destination
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
?>
<?php get_header(); ?>
	<div id="primary">
		<div class="top_img"></div>
		<div class="middle_img">
			<div class="sliding_image">	
			<?php
				if ( has_post_thumbnail() )
				{
					the_post_thumbnail( 'single-post-thumbnail' );
				}
			?>
			</div>
		</div>
		<div class="bottom_img"></div>		

		<div id="dest_content" role="main">
			<img style="text-align:center;margin:8px;padding:0px;"src="<?php bloginfo( 'template_url' )?>/images/tanzanian.gif" width="297" height="37"/>
			<div class="top_img"></div><!--top_img--->
			<div class="middle_img">
				<div class="sliding_image">	
					<?php the_post(); ?>
					
					<?php get_template_part( 'content', 'page' ); ?>

					<?php //comments_template( '', true ); ?>
				</div>
			</div>
			<div class="bottom_img"></div>
		</div><!-- #dest_content -->

					
		<?php $queryObject = new WP_Query( array ('post_type' => 'dest','order' => ASC ) );
			if ($queryObject->have_posts()) {
			while( $queryObject->have_posts() ) : $queryObject->the_post();?>
				<div class="top_img"></div><!--top_img--->
					<div class="middle_img">
					<div class="sliding_image">
						<?php	if ( has_post_thumbnail() )
						{
							the_post_thumbnail( 'single-post-thumbnail' );
						}
						?>	
					    	<div class="dest_content_right">
							<div><a class="sub5" href="<?php the_permalink(); ?>"><?php the_title();?></a>
						</div><!--blog-title-->
						<?php the_excerpt('Read More'); ?>
					</div><!---.dest_content_right---></li>
					</div>
				</div>
				<div class="bottom_img"></div>	
			<?php endwhile;
			}
			wp_reset_query();
		?>
</div>
</div><!-- #primary -->

<?php get_footer(); ?>
