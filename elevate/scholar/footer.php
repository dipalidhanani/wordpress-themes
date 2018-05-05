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
<div class="top-footer">
	<div class="col-full">
    	<img class="footer-logo" src="<?php echo ot_get_option( 'footer_logo' ); ?>" />
        <?php $page = get_post("30"); ?>
        <a href="<?php echo get_permalink( $page->ID ); ?>" class="support-link"><?php echo $page->post_title; ?></a>
        <div class="fix"></div>
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
<?php 


if ( is_page('register-2') && ($_GET['renew'] == '1')){ global $current_user;

 $userid = $current_user->ID;
 $user_username = $current_user->user_login;
 $user_email = $current_user->user_email;
  $capabilities = array_keys(get_the_author_meta( 'wp_capabilities', $userid ));
 if($capabilities[0] == 'corporate_user'){$user_subscription = 'Corporate User';}else if($capabilities[0] == 'individual_user'){$user_subscription = 'Individual Course';}
 $first_name = get_the_author_meta( 'first_name', $userid );
 $last_name = get_the_author_meta( 'last_name', $userid );
 $user_phone = get_the_author_meta( 'user_phone', $userid );
 $user_company_name = get_the_author_meta( 'user_company_name', $userid );
 $user_address1 = get_the_author_meta( 'address1', $userid );
 $user_address2 = get_the_author_meta( 'address2', $userid );
 $user_city = get_the_author_meta( 'user_city', $userid );
 $user_province = get_the_author_meta( 'user_province', $userid );
 $user_postal = get_the_author_meta( 'user_postal', $userid );
 $billing_address1 = get_the_author_meta( 'billing_address1', $userid );
 $billing_address2 = get_the_author_meta( 'billing_address2', $userid );
 $billing_city = get_the_author_meta( 'billing_city', $userid );
 $billing_province = get_the_author_meta( 'billing_province', $userid );
 $billing_postalcode = get_the_author_meta( 'billing_postalcode', $userid );

?>
<script>
jQuery(document).ready(function(e) { 

jQuery( ".um-field-user_subscription_type" ).after( '<div class="um-field-user_subscription_type1"><div class="um-field-label"><label for="user_login-8285">Subscription Type : </label><?php echo $user_subscription; ?></div></div>' );



jQuery(".um-field-user_password").hide();


	jQuery("#user_login-8285").val('<?php echo $user_username; ?>');
	 jQuery('#user_login-8285').attr('disabled', 'true');
	jQuery("#user_email-8285").val('<?php echo $user_email; ?>');
	 jQuery('#user_email-8285').attr('disabled', 'true');
	 
	  jQuery('#user_password-8285').attr('disabled', 'true');
	   jQuery('#confirm_user_password-8285').attr('disabled', 'true');
	   
	
	//  jQuery('input:radio[name="user_subscription_type"]').attr('checked', 'checked');
	   jQuery("input[name='user_subscription_type']").each(function(i) {		   
		jQuery(this).attr('disabled', 'true');
        });
		
		jQuery(".um-field-user_subscription_type").hide();

	   
	jQuery("#first_name-8285").val('<?php echo $first_name; ?>');
	jQuery("#last_name-8285").val('<?php echo $last_name; ?>');
	jQuery("#phone-number-8285").val('<?php echo $user_phone; ?>');
	jQuery("#user_company_name-8285").val('<?php echo $user_company_name; ?>');
	jQuery("#address1-8285").val('<?php echo $user_address1; ?>');
	jQuery("#address2-8285").val('<?php echo $user_address2; ?>');
	jQuery("#user_city-8285").val('<?php echo $user_city; ?>');
	jQuery("#user_province-8285").val('<?php echo $user_province; ?>');
	jQuery("#user_postal_code-8285").val('<?php echo $user_postal; ?>');
	jQuery("#billing_address1-8285").val('<?php echo $billing_address1; ?>');
	jQuery("#billing_address2-8285").val('<?php echo $billing_address2; ?>');
	jQuery("#billing_city-8285").val('<?php echo $billing_city; ?>');
	jQuery("#billing_province-8285").val('<?php echo $billing_province; ?>');
	jQuery("#billing_postalcode-8285").val('<?php echo $billing_postalcode; ?>');
	 });
</script>

<?php } ?>
<?php wp_footer(); ?>
<?php woo_foot(); ?>
<script>
	jQuery(document).ready(function(e) {
		
		
		
		
		jQuery("input[name='same_billing[]']:checkbox").click(function(){
			var chkds = jQuery("input[name='same_billing[]']:checkbox");
			if (chkds.is(":checked"))  {
			jQuery("#billing_address1-8311").val(jQuery("#address1-8311").val());
			jQuery("#billing_address2-8311").val(jQuery("#address2-8311").val());
			jQuery("#billing_city-8311").val(jQuery("#user_city-8311").val());
			jQuery("#billing_province-8311").val(jQuery("#user_province-8311").val());	
			jQuery("#billing_postalcode-8311").val(jQuery("#user_postal_code-8311").val());	
			
			jQuery("#billing_address1-8285").val(jQuery("#address1-8285").val());
			jQuery("#billing_address2-8285").val(jQuery("#address2-8285").val());
			jQuery("#billing_city-8285").val(jQuery("#user_city-8285").val());
			jQuery("#billing_province-8285").val(jQuery("#user_province-8285").val());	
			jQuery("#billing_postalcode-8285").val(jQuery("#user_postal_code-8285").val());	
			
			} else {
				jQuery("#billing_address1-8311").val("");
				jQuery("#billing_address2-8311").val("");
				jQuery("#billing_city-8311").val("");
				jQuery("#billing_province-8311").val("");	
				jQuery("#billing_postalcode-8311").val("");	
				
				jQuery("#billing_address1-8285").val("");
				jQuery("#billing_address2-8285").val("");
				jQuery("#billing_city-8285").val("");
				jQuery("#billing_province-8285").val("");	
				jQuery("#billing_postalcode-8285").val("");	
			}
			
		 });


   
		//var loginOutUrl = 
       jQuery('#menu-item-7787 a').attr('href','<?php echo wp_logout_url(); ?>');
	   
	  
	   jQuery('.area-radio .label_radio').click(function(){
		    
				var indexVal = jQuery(this).children('input').val();
				//alert(indexVal)
				if(indexVal === '1'){
					jQuery('.creditCardSection').slideDown();
				}else{
					jQuery('.creditCardSection').slideUp();
				}
			
		});
	   
    });
</script>



</body>
</html>