<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options;

 woo_footer_top();
 	woo_footer_before();
?>
<div class="top-footer">
	<div class="col-full">
    <div class="footer">
    <div class="wrapper">
    	<a href="#"><img class="logo" src="<?php echo ot_get_option( 'footer_logo' ); ?>" /></a>
        <?php $page = get_post("39"); ?>
        <a href="<?php echo get_permalink( $page->ID ); ?>" class="footer-link"><?php echo $page->post_title; ?></a>
        <div class="fix"></div>
    </div>
    </div></div>
</div>
	<div class="site-footer">
	<footer id="footer" class="col-full">
		<div class="login-footer copyright">
    		<div class="wrapper">
				<?php woo_footer_inside(); ?>
        
                <div id="copyright" class="col-left">
                    <?php woo_footer_left(); ?>
                </div>
        
                <div id="credit" class="col-right">
                    <?php woo_footer_right(); ?>
                </div>
			</div>
        </div>
	</footer>

	</div>
	<?php woo_footer_after(); ?>

	</div><!-- /#inner-wrapper -->

</div><!-- /#wrapper -->

<div class="fix"></div><!--/.fix-->

<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>