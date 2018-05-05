<?php
/**
 * The template for displaying content in the single-portfolio.php template
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

// prev & next post
$post_prev = get_adjacent_post(false,'',true)  ? get_permalink(get_adjacent_post(false,'',true))  : false;
$post_next = get_adjacent_post(false,'',false) ? get_permalink(get_adjacent_post(false,'',false)) : false;
$portfolio_page_id = mfn_opts_get( 'portfolio-page' );

$translate['details'] = mfn_opts_get('translate') ? mfn_opts_get('translate-details','Project details:') : __('Project details:','falco');
?>

<div class="single-portfolio" id="portfolio-item-<?php the_ID(); ?>" >	

	<div class="section section-portfolio-header">
		<div class="section_wrapper clearfix">
			
			<div class="column one post_navigation">
				<?php if( $post_prev ): ?>
					<a class="prev_post post_control"  href="<?php echo $post_prev; ?>">Previous post</a>
				<?php endif; ?>
				<?php if( $post_next ): ?>
					<a class="next_post post_control"  href="<?php echo $post_next ?>">Next post</a>
				<?php endif; ?>
				<?php if( $portfolio_page_id ): ?>
					<a class="close_post post_control" href="<?php echo get_page_link( $portfolio_page_id ); ?>">Portfolio page</a>
				<?php endif; ?>
			</div>
	
			<div class="column one portfolio_meta">
				<div class="portfolio_photo">
					<?php
						if( $portfolio_slider = get_post_meta( get_the_ID(), 'mfn-post-slider', true ) ){
							putRevSlider( $portfolio_slider );
						} elseif ( $video = get_post_meta($post->ID, 'mfn-post-vimeo', true) ){
							echo '<iframe class="scale-with-grid" src="http://player.vimeo.com/video/'. $video .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'."\n";
						} elseif ( $video = get_post_meta($post->ID, 'mfn-post-youtube', true) ){
							echo '<iframe class="scale-with-grid" src="http://www.youtube.com/embed/'. $video .'" frameborder="0" allowfullscreen></iframe>'."\n";
						} elseif ( has_post_thumbnail() ){	
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
							echo '<a class="prettyphoto" href="'. $large_image_url[0] .'">';
								the_post_thumbnail( 'portfolio-list', array('class'=>'scale-with-grid' ));
							echo '</a>';
						}
					?>
				</div>
				<div class="portfolio_desc">
					<h4 class="desc_title"><?php echo $translate['details']; ?></h4>
					<?php 
					// portfolio item details
					mfn_portfolio_details(get_the_ID()); 
					?>
				</div>
			</div>
			
		</div>
	</div>
	
	<?php
		// Content Builder & WordPress Editor Content
		mfn_builder_print( get_the_ID() );
	?>
	
</div>