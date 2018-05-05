<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

// post meta
$posts_meta = array();
$posts_meta['time'] 		= get_post_meta($post->ID, 'mfn-post-time', true);
$posts_meta['comments'] 	= get_post_meta($post->ID, 'mfn-post-comments', true);
$posts_meta['categories'] 	= get_post_meta($post->ID, 'mfn-post-categories', true);
$posts_meta['tags'] 		= get_post_meta($post->ID, 'mfn-post-tags', true);

// post classes
$post_classes = array('section','section-post-content');
if( ! has_post_thumbnail() ) $post_classes[] = 'no-photo';

// prev & next post
$post_prev = get_adjacent_post(false,'',true)  ? get_permalink(get_adjacent_post(false,'',true))  : false;
$post_next = get_adjacent_post(false,'',false) ? get_permalink(get_adjacent_post(false,'',false)) : false;
?>

<div class="section section-post-header">
	<div class="section_wrapper clearfix">
	
		<div class="column one post_navigation">
			<?php if( $post_prev ): ?>
				<a class="prev_post post_control"  href="<?php echo $post_prev; ?>">Previous post</a>
			<?php endif; ?>
			<?php if( $post_next ): ?>
				<a class="next_post post_control"  href="<?php echo $post_next ?>">Next post</a>
			<?php endif; ?>
			<a class="close_post post_control" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Blog page</a>
		</div>

		<div class="column one post_meta">
			<?php
				if( $posts_meta['time'] ){
					echo '<div class="date"><i class="icon-calendar"></i>'. get_the_date() .'</div>';
				}
				if( $posts_meta['categories'] ){
					echo '<div class="category"><i class="icon-reorder"></i> '. get_the_category_list(', ') .'</div>';
				}
				if( $posts_meta['comments'] ){
					echo '<div class="comments"><i class="icon-comment-alt"></i> '. mfn_comments_number() .'</div>';
				}
				if( $posts_meta['tags'] && ( $terms = get_the_terms( false, 'post_tag' ) ) ){
					echo '<div class="tags">';
					echo '<i class="icon-tags"></i> ';
					$terms_count = count( $terms );
					foreach( $terms as $term ){
						$terms_count--;
						$sep = ( $terms_count ) ? ',' : false;
						$link = get_term_link( $term, 'post_tag' );
						echo '<a href="' . esc_url( $link ) . '" rel="tag"><span>' . $term->name . $sep .'</span></a> ';
					}
					echo '</div>';
				}
			?>
		</div>
		
		<div class="column one photo">
			<div class="photo_wrapper">
				<?php mfn_post_thumbnail( get_the_ID(), true ); ?>
			</div>
			<span class="post-icon"><i class="<?php echo mfn_post_type(get_the_ID(),true); ?>"></i></span>
		</div>	
		
	</div>
</div>

<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<?php
		// Content Builder & WordPress Editor Content
		mfn_builder_print( $post->ID );

		// List of pages
		wp_link_pages();
	?>
</div>

<div class="section section-post-footer">
	<div class="section_wrapper clearfix">
		<div class="column one comments">
			<?php comments_template( '', true ); ?>
		</div>
	</div>
</div>