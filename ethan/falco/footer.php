<?php
/**
 * The template for displaying the footer.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */
?>

	<!-- #Footer -->		
	<footer id="Footer" class="clearfix">
	
		<div class="widgets_wrapper">
			<div class="container">
				<?php
					$sidebars_count = 0;	
					for( $i = 1; $i <= 4; $i++ ){
						if ( is_active_sidebar( 'footer-area-'. $i ) ) $sidebars_count++;
					}
				
					$sidebar_class = '';
					if( $sidebars_count > 0 ){
						switch( $sidebars_count ){
							case 2: $sidebar_class = 'one-second'; break; 
							case 3: $sidebar_class = 'one-third'; break; 
							case 4: $sidebar_class = 'one-fourth'; break;
							default: $sidebar_class = 'one';
						}
					}
				?>
				
				<?php 
					for( $i = 1; $i <= 4; $i++ ){
						if ( is_active_sidebar( 'footer-area-'. $i ) ){
							echo '<div class="'. $sidebar_class .' column">';
								dynamic_sidebar( 'footer-area-'. $i );
							echo '</div>';
						}
					}
				?>
		
			</div>
		</div>

		<div class="copyrights">
			<div class="container">
				<div class="column one">

					<p>
						<?php 
							if( mfn_opts_get('footer-copy') ){
								mfn_opts_show('footer-copy');
							} else {
								echo '&copy; '. date( 'Y' ) .' <strong>'. get_bloginfo( 'name' ) .'</strong>. '. __( 'All Rights Reserved', 'falco' ) .'. '. __( 'Powered by', 'falco' ) .' <a target="_blank" rel="nofollow" href="http://wordpress.org">WordPress</a>. '. __( 'Created by', 'falco' ) .' <a target="_blank" rel="nofollow" href="http://muffingroup.com">Muffin group</a>.';
							}
						?>
					</p>							

				</div>
			</div>
		</div>
		
	</footer>

</div>

<?php if( mfn_opts_get('popup-contact-form') ): ?>
	<?php $translate['contact-form-title'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-form-title','Send us a message') : __('Send us a message','falco'); ?>
	<div id="popup_contact">
		<a class="ico" href="#"><i class="icon-envelope"></i></a>
		<div class="popup_contact_wrapper">
			<h4><?php echo $translate['contact-form-title']; ?></h4>
			<?php echo do_shortcode( mfn_opts_get('popup-contact-form') ); ?>
			<span class="arrow"></span>
		</div>
	</div>
<?php endif; ?>
	
<!-- wp_footer() -->
<?php wp_footer(); ?>

</body>
</html>