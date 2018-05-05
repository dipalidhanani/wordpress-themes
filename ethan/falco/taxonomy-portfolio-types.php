<?php
/**
 * Taxanomy Portfolio Types
 *
 * @package Falco
 * @author Muffin Group
 */

get_header(); 

$portfolio_page_id = mfn_opts_get( 'portfolio-page' );
$sidebar = mfn_sidebar_classes();

$translate['select-category'] = mfn_opts_get('translate') ? mfn_opts_get('translate-select-category','Select category:') : __('Select category:','falco');
$translate['all'] = mfn_opts_get('translate') ? mfn_opts_get('translate-all','All') : __('All','falco');
?>

<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
		
			<div class="section">
				<div class="section_wrapper clearfix">
		
					<?php
						$menu_args = array(
							'taxonomy' => 'portfolio-types',
							'orderby' => 'name',
							'order' => 'ASC',
							'show_count' => 1,
							'hierarchical' => 1,
							'hide_empty' => 0,
							'title_li' => '',
							'depth' => 1,
							'walker' => new New_Walker_Category()
						);
					?>
			
					<!-- .Projects_header -->
					<div class="Projects_header column one">       
						<div class="categories">
							<ul>
								<li class="label"><h6><?php echo $translate['select-category']; ?></h6></li>
								<?php
									$portfolio_page_id = mfn_opts_get( 'portfolio-page' );
								
									if( get_the_ID() == $portfolio_page_id ) {
										$current_class = ' class="current-cat"';
									} else {
										$current_class = "";
									}
								
									if( $portfolio_page_id ) {
										echo '<li'.$current_class.'><a href="'.get_page_link( $portfolio_page_id ).'">'. $translate['all'] .'</a></li>';
									}
								
									wp_list_categories( $menu_args ); 
								?>
							</ul>
						</div>
					</div>
					
					<!-- .Projects_inside -->
					<div class="Projects_inside">	
						<?php 	
							$args = array( 
								'post_type' => 'portfolio',
								'posts_per_page' => mfn_opts_get( 'portfolio-posts', 6 ),
								'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
								'order' => mfn_opts_get( 'portfolio-order', 'ASC' ),
								'orderby' => mfn_opts_get( 'portfolio-orderby', 'menu_order' ),
								'taxonomy' => 'portfolio-types',
								'ignore_sticky_posts' => 1,
							);
							
							global $query_string;
							parse_str( $query_string, $qstring_array );
							$query_args = array_merge( $args,$qstring_array );
							
							$temp = $wp_query;
							$wp_query = null;
							$wp_query = new WP_Query();
							$wp_query->query( $query_args );
							
							if( $wp_query->have_posts() )
						 	{
						 		echo '<ul class="Projects_inside_wrapper da-thumbs">';
									while ( have_posts() )
									{
										the_post();
										get_template_part( 'includes/content', 'portfolio' );
									}
								echo '</ul>';
								
								mfn_pagination();
						 	}
						 	
						 	wp_reset_query(); 
						 	$wp_query = $temp;
						 	the_post();
						?>
					</div>
					
				</div>
			</div>

		</div>
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar( 'taxonomy' ); ?>
			
	</div>
</div>

<?php get_footer(); ?>