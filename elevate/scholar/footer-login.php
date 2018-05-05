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
</div>
</div>
</div>
<div class="site-footer">
	<footer id="footer" class="col-full">

		<?php woo_footer_inside(); ?>

		<div id="copyright" class="col-left">
			<?php //woo_footer_left(); ?>
            <?php echo ot_get_option( 'footer_left_text1' )." ".date('Y')." ".ot_get_option( 'footer_left_text2' ); ?>
		</div>

		<div id="credit" class="col-right">
			<?php //woo_footer_right(); ?>
            <?php echo ot_get_option( 'footer_right_text' ); ?>
		</div>

	</footer>

	<?php woo_footer_after(); ?>
</div>
	</div><!-- /#inner-wrapper -->

</div><!-- /#wrapper -->

<div class="fix"></div><!--/.fix-->

<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>