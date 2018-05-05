<?php
/**
 * Template Name: Portfolio
 * Description: A Page Template that display portfolio items.
 *
 * @package Falco
 * @author Muffin Group
 */

get_header(); 
$sidebar = mfn_sidebar_classes();

// isotope
if( $_GET && key_exists('mfn-p', $_GET) && $_GET['mfn-p']=='jq' ){
	$portfolio_isotope = ' portfolio-isotope'; // demo
} else {
	$portfolio_isotope = mfn_opts_get('portfolio-isotope') ? ' portfolio-isotope' : '';
}
			
$translate['select-category'] = mfn_opts_get('translate') ? mfn_opts_get('translate-select-category','Select category:') : __('Select category:','falco');
$translate['all'] = mfn_opts_get('translate') ? mfn_opts_get('translate-all','All') : __('All','falco');
?>

<div id="Content">
	<div class="content_wrapper clearfix<?php echo $portfolio_isotope;?>">

		<!-- .sections_group -->
		<div class="sections_group">
		
			<div class="section">
				<div class="section_wrapper clearfix">
				
					<!-- .Projects_header -->
					<div class="Projects_header column one">       
						<div class="categories">
							<ul>
								<li class="label"><h6><?php echo $translate['select-category']; ?></h6></li>
								<?php 
									$portfolio_page_id = mfn_opts_get( 'portfolio-page' );
									echo '<li class="current-cat"><a data-rel="*" href="'.get_page_link( $portfolio_page_id ).'">'. $translate['all'] .'</a></li>';
									if( $portfolio_categories= get_terms('portfolio-types') ){
										
										foreach( $portfolio_categories as $category ){
											echo '<li><a data-rel=".'. $category->slug .'" href="'. get_term_link($category) .'">'. $category->name .' <span>('. $category->count .')</span></a></li>';
										}
									}
								?>
							</ul>
						</div>
					</div>
	
					<!-- .Projects_inside -->
					<div class="Projects_inside">
						<?php 
							$portfolio_args = array( 
								'post_type' 			=> 'portfolio',
								'posts_per_page' 		=> mfn_opts_get( 'portfolio-posts', 6 ),
								'paged' 				=> ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
								'order' 				=> mfn_opts_get( 'portfolio-order', 'ASC' ),
							    'orderby' 				=> mfn_opts_get( 'portfolio-orderby', 'menu_order' ),
								'ignore_sticky_posts' 	=> 1,
							);
			
							// demo
							if( $_GET && key_exists('mfn-p', $_GET) && ( $_GET['mfn-p'] == 'one-third' ) ) $portfolio_args['posts_per_page'] = 6;
							
							$temp = $wp_query;
							$wp_query = null;
							$wp_query = new WP_Query();
							$wp_query->query( $portfolio_args );
			
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
						 		 	
						 	$wp_query = $temp;
						 	wp_reset_query(); 
						 	the_post();
						?>	
					</div>
					
				</div>
			</div>

		</div>
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar(); ?>
			
	</div>
</div>

<?php get_footer(); ?>