<?php
/**
 * Template Name: Portfolio - Full Screen
 * Description: A Full Screen Portfolio Template.
 *
 * @package Falco
 * @author Muffin Group
 */

$translate['go-to-homepage'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-go-to-homepage','Go to homepage') : __('Go to homepage','falco');
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- head -->
<head>

<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<?php if( mfn_opts_get('responsive') ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'; ?>

<title><?php
global $post;
if( mfn_opts_get('mfn-seo') && is_object($post) && get_post_meta( get_the_ID(), 'mfn-meta-seo-title', true ) ){
	echo stripslashes( get_post_meta( get_the_ID(), 'mfn-meta-seo-title', true ) );
} else {
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'falco' ), max( $paged, $page ) );
}
?></title>

<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show('favicon-img',THEME_URI .'/images/favicon.ico'); ?>" type="image/x-icon" />	

<!-- wp_head() -->
<?php wp_head();?>
</head>

<!-- body -->
<body <?php body_class(); ?>>
	<div id="FullScreen" class="fs-portfolio">
	
		<a href="<?php echo home_url(); ?>" class="go-to-homepage"><span class="icon"></span><span class="label"><?php echo $translate['go-to-homepage']; ?></span></a>
		
		<ul class="full-screen-accordion">
		
			<?php 
				$fsp_args = array(
					'post_type' 			=> 'portfolio',
					'posts_per_page' 		=> -1,
					'orderby' 				=> mfn_opts_get( 'portfolio-orderby', 'menu_order' ),
					'order' 				=> mfn_opts_get( 'portfolio-order', 'ASC' ),
					'ignore_sticky_posts' 	=> 1,
				);
				
				$fsp_query = new WP_Query();
				$fsp_query->query( $fsp_args );
				
				if( $fsp_query->have_posts() ){
					while ( $fsp_query->have_posts() )
					{
						$fsp_query->the_post();
						
						$item_bg = get_post_meta(get_the_ID(), 'mfn-post-bg', true);
						if( $item_bg ){
							$item_bg = ' style="background-image:url('. $item_bg .');"';
						}
						?>
							<li <?php echo $item_bg; ?>>
								<h3 class="fsa-title"><?php the_title(); ?></h3>
								<div class="fsa-content">
						
									<div class="photo">
										<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
										<a rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>">
											<?php the_post_thumbnail( 'portfolio-fs', array('class'=>'scale-with-grid' ) ); ?>
										</a>
									</div>
									
									<div class="desc">
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
						
						<?php
					}
				}
				wp_reset_query();
			?>

		</ul>
	</div>
	
	<!-- wp_footer() -->
	<?php wp_footer(); ?>

</body>
</html>