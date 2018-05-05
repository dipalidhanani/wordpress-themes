<?php
/**
 * Template Name: My Account
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();
global $current_user;
?>

<div class="col-full" id="content">
<div class="myaccount">
<h2>My Account</h2>
 <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div class="col-full">
    
    	<div id="main-sidebar-container">    

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <section id="main">    
              <p>Hello <?php echo $current_user->user_login; ?> (not <?php echo $current_user->user_login; ?>? <a href="/elevate/wp-login.php?action=logout&amp;amp;_wpnonce=a90077df48">Sign out</a>). From your account dashboard you can <a href="/elevate/edit-account-details">edit your password</a> and <a href="/elevate/edit-account-details">account details</a>.</p>                
<?php
	woo_loop_before();
	
	if (have_posts()) { $count = 0;
		while (have_posts()) { the_post(); $count++;
			woo_get_template_part( 'content', 'page' ); // Get the page content template file, contextually.
		}
	}
	
	woo_loop_after();
?>     
            </section><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar( 'alt' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?></div>
</div>
       
   

<?php get_footer(); ?>