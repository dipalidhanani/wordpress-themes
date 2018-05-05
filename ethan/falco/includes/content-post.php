<?php
/**
 * The template for displaying content in the index.php template
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

// post meta
$posts_meta = array();
$posts_meta['time'] 		= mfn_opts_get( 'blog-time' );
$posts_meta['categories'] 	= mfn_opts_get( 'blog-categories' );
$posts_meta['comments'] 	= mfn_opts_get( 'blog-comments' );
$posts_meta['tags'] 		= mfn_opts_get( 'blog-tags' );

// post classes
$post_classes = array('column');
if( ! has_post_thumbnail() ) $post_classes[] = 'no-photo';

// layout
if( $_GET && key_exists('mfn-b', $_GET) ){
	$post_classes[] = $_GET['mfn-b']; // demo
} else {
	$post_classes[] = mfn_opts_get( 'blog-layout', 'one' );
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

	<div class="date_wrapper">
		<div class="date">
			<?php if( $posts_meta['time'] ): ?>
				<span class="day"><?php echo get_the_date('j'); ?></span>
				<span class="month"><?php echo get_the_date('M'); ?></span>
				<div class="year"><?php echo get_the_date('Y'); ?></div>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="post_wrapper">
	
		<div class="photo">
			<?php mfn_post_thumbnail( get_the_ID() ); ?>
		</div>	

		<div class="desc">
			<a class="desc_a" href="<?php the_permalink(); ?>">
				<span class="post-icon"><i class="<?php echo mfn_post_type(get_the_ID(),true); ?>"></i></span>
				<?php if( $posts_meta['time'] ): ?>
					<div class="date_grid"><i class="icon-calendar"></i><?php echo get_the_date(); ?></div>
				<?php endif; ?>
				<h4><?php the_title(); ?></h4>
				<div class="inside"><?php the_excerpt(); ?></div>
			</a>
		</div>
		
	</div>
	
	<div class="meta">
		<?php 
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
	
</div>