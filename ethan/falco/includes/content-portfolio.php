<?php
/**
 * The template for displaying content in the template-portfolio.php template
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

$layout = mfn_opts_get( 'portfolio-layout', 'one' );

$item_class = '';
$item_cats = get_the_terms($post->ID, 'portfolio-types');
if($item_cats){
	foreach($item_cats as $item_cat) {
		$item_class .= $item_cat->slug . ' ';
	}
}

// demo
if( $_GET && key_exists('mfn-p', $_GET) ){
	$layout = $_GET['mfn-p'];
	if( $layout == 'jq' ) $layout = 'one-fourth';
}

?>

<li class="portfolio_item column <?php echo $layout.' '.$item_class?>">	
	<div class="photo">
		<?php  the_post_thumbnail( 'portfolio-list', array('class'=>'scale-with-grid' )); ?>
		<div class="mask">
			<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
			<a href="<?php echo $large_image_url[0];?>" class="button_image zoom prettyphoto"></a>
			<a href="<?php the_permalink(); ?>" class="button_image more"></a>
		</div>
	</div>
	<div class="desc">
		<a href="<?php the_permalink(); ?>">
			<h5><?php echo the_title(false, false); ?></h5>
		</a>
		
		<div class="list_view">
			<div class="project_info">
				<?php the_excerpt(); ?>
			</div>

			<?php 
				// portfolio item details
				mfn_portfolio_details(get_the_ID()); 
			?>
			
		</div>
		
		
	</div>
</li>


