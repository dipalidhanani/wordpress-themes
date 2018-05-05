<?php
/**
 * The main template file.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header(); 
$sidebar = mfn_sidebar_classes();
?>

<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group clearfix">
			
			<div class="section clearfix">
				<div class="section_wrapper clearfix">
					<?php 
					
						// blog background for timeline & list
						if( $_GET && key_exists('mfn-b', $_GET) ){
							$blog_layout = $_GET['mfn-b']; // demo
						} else {
							$blog_layout = mfn_opts_get( 'blog-layout', 'one' );
						}

						if( in_array( $blog_layout, array('timeline','one') ) ){
							$blog_class = ' timeline_bg';
						} else {
							$blog_class = false;
						}
					
						echo '<div class="posts_wrapper clearfix'. $blog_class .'">';			
							while ( have_posts() ){
								the_post();
								get_template_part( 'includes/content', get_post_type() );
							}
						echo '</div>';
						
						// pagination
						if(function_exists( 'mfn_pagination' )):
							mfn_pagination();
						else:
							?>
								<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'falco')) ?></div>
								<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'falco')) ?></div>
							<?php
						endif;
					?>
				</div>	
			</div>
			
		</div>	
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar( 'blog' ); ?>

	</div>
</div>

<?php get_footer(); ?>