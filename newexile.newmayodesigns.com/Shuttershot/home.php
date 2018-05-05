<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *

 * @package fabframe
 */
 
get_header(); ?>

<div id="hblock">

<div id="home-slider">


<ul class="slides-container">
<?php

$slidecount = of_get_option('w2f_slidecount','5');
$args = array( 'posts_per_page' => $slidecount, 'post_type'=> 'slides' );

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li>
		    <?php $img_url = get_post_meta($post->ID, "wtf_slider", true);	?>
		    
			<?php $elink = get_post_meta($post->ID, "wtf_extlink", true); ?>
			
			<?php $oldimg =  get_post_meta($post->ID, "wtf_slide", true);?>
			
			<a href="<?php echo $elink; ?>"> 
				<?php if( $oldimg !=""){
					echo '<img src="'.$oldimg.'"/>';
				 } else {
				    echo wp_get_attachment_image( $img_url, 'full' ); 
				 } ?> 
			</a>
		   

	</li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>

</div>
</div>
<?php get_footer(); ?>