<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				//get_sidebar( 'footer' );
			?>

			<div id="site-generator">
<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fproudafricansafaris.com%2F&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>


				<div><SMALL><strong>*All photos were taken by PAS clients and staff while on safari. PAS would like to recognize <br>
Ms. Sivani Babu of Suntrail Images and Mr. David Hays of Artis.com for their photographic contributions on the home page. </strong><br></SMALL>
2013© Proud African Safaris, LLC  © 12 Greystone Road, Marblehead, MA 01945 | Phone: 888-629-6755<br>
Website designed and hosted by <a href="http://www.mayowebdesign.com" target="_blank">www.mayowebdesign.com</a></center></p>
<br><br><p><a href="http://proudafricansafaris.com/privacy-policy" target="_blank">Privacy Policy</a><p>
</div>
				<?php do_action( 'twentyeleven_credits' ); ?>
				<!--<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a>-->
			</div>
	</footer><!-- #colophon -->
</div><!-- #wrapper -->
</div><!-- #page -->

<?php wp_footer(); ?>


<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1000912623;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1000912623/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>