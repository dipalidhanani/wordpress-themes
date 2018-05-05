<?php
/**
 * The Page Sidebar containing the widget area.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

$sidebars = mfn_opts_get( 'sidebars' );
$sidebar = get_post_meta($post->ID, 'mfn-post-sidebar', true);
$sidebar = $sidebars[$sidebar];
?>

<?php if( mfn_sidebar_classes() ): ?>
<div class="four columns">
	<div class="widget-area clearfix">
		<?php 
			if ( ! dynamic_sidebar( $sidebar ) ){ 
				mfn_nosidebar(); 
			}
		?>
	</div>
</div>
<?php endif; ?>