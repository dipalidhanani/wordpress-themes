<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<!---main BLOG from navigation--->

<section id="primary">
			
			

<img style="margin:8px;padding:0px;"src="<?php bloginfo( 'template_url' )?>/images/blog-txt.png" width="50" height="36"/>			

<div id="archive_content" role="main">
	
		<?php if ( have_posts() ) : ?>
			<?php
			       $args = array( 'post_type' => 'blog');
			       $loop = new WP_Query( $args );
			       while ( $loop->have_posts() ) : $loop->the_post();?>	                                                   
		<div class="top_img"></div><!--top_img--->
			<div class="middle_img">
			<div class="sliding_image">				

				<div class="blog_cont">
					<div class="blog-img">
				               <a href="<?php the_permalink() ?>" class="thumb"><?php the_post_thumbnail('medium', array(
				                         'alt'        => trim(strip_tags( $post->post_title )),
				                         'title'        => trim(strip_tags( $post->post_title )),
				                )); ?></a>
				        </div><!---blog-img--->
                                       
					<div class="content_right">
						<div class="blog-title"><a class="sub1" href="<?php the_permalink(); ?>"><?php the_title();?></a>
						</div><!--blog-title-->
						<div class="date_color"><?php echo get_the_date(); ?></div><!---date_color--->
						<div class="blog-middle"><?php the_excerpt('Read More'); ?></div><!--blog-middle-->
					</div><!---content_right--->
				</div><!---blog_cont---></div></div>
				<div class="bottom_img"></div>	
			<?php endwhile; ?>
		<?php else : ?>
		
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		<?php endif; ?>
	</div><!-- #content -->
</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
