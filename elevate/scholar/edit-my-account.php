<?php
/**
 * Template Name: Edit My Account
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();
?>

<div class="col-full" id="content">
    <div class="edit_account_detail" id="edit-account">
        <h2>Edit Account Details</h2>
         <?php echo do_shortcode( '[wppb-edit-profile]' ); ?>
       <!-- <form id="edit-account" action="#" method="post">
            <div class="com">
                <div class="lt_account"><label>First Name<span class="required">*</span></label><input type="text" /></div>
                <div class="rt_account"><label>Last Name<span class="required">*</span></label><input type="text" /></div>
                <div class="fix"></div>
            </div>
            <div class="com">
            	<label>Email address<span class="required">*</span></label><input type="email" />
             </div>
            <h4>Password Change</h4>
                <div class="com"><label>Current Password (leave blank to leave unchanged)</label><input type="password" /></div>
                <div class="com"><label>New Password (leave blank to leave unchanged)</label><input type="password" /></div>
                <div class="com"><label>Confirm New Password</label><input type="password" /></div>
                <div class="com"><input type="submit" value="Save changes" />
            </div>
    </form>-->
    </div>
</div>
       
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    

            <!-- #main Starts -->
          
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar( 'alt' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>