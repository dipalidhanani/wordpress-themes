<?php
/**
 * The Header for our theme.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- head -->
<head>

<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( mfn_opts_get('responsive') ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'; ?>

<!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show('favicon-img',THEME_URI .'/images/favicon.ico'); ?>" type="image/x-icon" />	

<!-- wp_head() -->
<?php wp_head();?>
</head>

<!-- body -->
<body <?php body_class(); ?>>
	
	<!-- #Wrapper -->
	<div id="Wrapper">
		
		<!-- .header_placeholder 4sticky  -->
		<div class="header_placeholder"></div>

		<!-- #Header -->
		<header id="Header">
			<?php 
				if( mfn_opts_get('header-email') ||  mfn_opts_get('header-phone') ){
					echo '<div id="top_bar">';
						if( $header_email = mfn_opts_get('header-email') ){
							echo '<p class="mob_phone"><i class="icon-envelope-alt"></i><a href="mailto:'. $header_email .'">'. $header_email .'</a></p>';
						}
						if( $header_phone = mfn_opts_get('header-phone') ){
							echo '<p class="mob_mail"><i class="icon-phone"></i><a href="tel:'. $header_phone .'">'. $header_phone .'</a></p>';
						}
					echo '</div>';
				}
			?>

			<div class="container">
				<div class="column one">
				
					<!-- .logo -->
					<div class="logo">
						<?php if( is_front_page() ) echo '<h1>'; ?>
						<a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
							<img class="scale-with-grid" src="<?php mfn_opts_show('logo-img',THEME_URI .'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
						<?php if( is_front_page() ) echo '</h1>'; ?>
					</div>
					
					<!-- .social -->
					<div class="social">
						<ul>
							<?php if( mfn_opts_get('social-facebook') ): ?><li class="facebook"><a target="_blank" href="<?php mfn_opts_show('social-facebook'); ?>" title="Facebook">F</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-googleplus') ): ?><li class="googleplus"><a target="_blank" href="<?php mfn_opts_show('social-googleplus'); ?>" title="Google+">G</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-twitter') ): ?><li class="twitter"><a target="_blank" href="<?php mfn_opts_show('social-twitter'); ?>" title="Twitter">L</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-vimeo') ): ?><li class="vimeo"><a target="_blank" href="<?php mfn_opts_show('social-vimeo'); ?>" title="Vimeo">V</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-youtube') ): ?><li class="youtube"><a target="_blank" href="<?php mfn_opts_show('social-youtube'); ?>" title="YouTube">X</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-flickr') ): ?><li class="flickr"><a target="_blank" href="<?php mfn_opts_show('social-flickr'); ?>" title="Flickr">N</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-linkedin') ): ?><li class="linked_in"><a target="_blank" href="<?php mfn_opts_show('social-linkedin'); ?>" title="LinkedIn">I</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-pinterest') ): ?><li class="pinterest"><a target="_blank" href="<?php mfn_opts_show('social-pinterest'); ?>" title="Pinterest">:</a></li><?php endif; ?>
							<?php if( mfn_opts_get('social-dribbble') ): ?><li class="dribbble"><a target="_blank" href="<?php mfn_opts_show('social-dribbble'); ?>" title="Dribbble">D</a></li><?php endif; ?>
						</ul>
					</div>
					
					<div class="addons">
						
						<?php $translate['search-placeholder'] = mfn_opts_get('translate') ? mfn_opts_get('translate-search-placeholder','Enter your search') : __('Enter your search','falco'); ?>
						<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<a class="icon" href="#"><i class="icon-search"></i></a>
							<input type="text" class="field" name="s" id="s" placeholder="<?php echo $translate['search-placeholder']; ?>" />
							<input type="submit" class="submit" value="" style="display:none;" />
						</form>
						
						<?php if( has_nav_menu( 'lang-menu' ) ): ?>
							<div class="language">
								<a href="#"><i class="icon-globe"></i><?php echo mfn_get_menu_name( 'lang-menu' ); ?></a>
								<div class="language_select">
									<?php mfn_wp_lang_menu(); ?>
								</div>
							</div>
						<?php endif; ?>
						
						<?php 
							if( $header_email = mfn_opts_get('header-email') ){
								echo '<div class="mail expand"><i class="icon-envelope-alt"></i> <p class="label"><a href="mailto:'. $header_email .'">'. $header_email .'</a></p></div>';
							}
							if( $header_phone = mfn_opts_get('header-phone') ){
								echo '<div class="phone expand"><i class="icon-phone"></i> <p class="label"><a href="tel:'. $header_phone .'">'. $header_phone .'</a></p></div>';
							}
						?>

					</div>
					
					<!-- #menu -->
					<?php mfn_wp_nav_menu(); ?>	
					<a class="responsive-menu-toggle" href="#"><i class='icon-reorder'></i></a>

				</div>		
			</div>
		</header>
		
		<?php 
			if( ! is_404() ){
				
				$slider = false;
				if( get_post_type()=='page' ) $slider = get_post_meta( get_the_ID(), 'mfn-post-slider', true );
				
				if( $slider ){
					
					if( $slider == 'mfn-slider' ){

						// Muffin Slider
						get_template_part( 'includes/header', 'mfn-slider' );
						
					} elseif( function_exists( 'putRevSlider' ) ){

						// Revolution Slider
						echo '<div id="mfn-rev-slider">';
							putRevSlider( $slider );
						echo '</div>';
						
					}
					
				} elseif( trim( wp_title( '', false ) ) ){

					
					
				}
				
			} else {

				// Error 404
				echo '<div id="Subheader">';
					echo '<div class="container">';
						echo '<div class="column one">';
							echo '<h1 class="title">'. __( 'Error 404', 'falco' ) .'</h1>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			}
		?>