<?php
/**
 Template Name: My Account
 */
 
get_header();
global $current_user;
 ?>
<div class="col-full" id="content">
<div class="myaccount">
<h2>My Account</h2>
 <!-- #content Starts -->
	    <div class="col-full">
    
    	<div id="main-sidebar-container">    

            <!-- #main Starts -->
                        <section id="main">                     
<article class="post-62 page type-page status-publish hentry">
	<header>
		<h1 class="title entry-title">My Account</h1>	</header>

	<section class="entry">
    <p>Hello sarc@elevate (not sarc@elevate? Sign out). From your account dashboard you can edit your password and account details.</p>
	    <p><?php echo "kjhkh:".$current_user->ID.get_the_content(); ?></p>
	</section><!-- /.entry -->
	<div class="fix"></div>
</article><!-- /.post -->
     
            </section><!-- /#main -->
                
            
		</div><!-- /#main-sidebar-container -->         

		
    </div><!-- /#content -->
	</div>
</div>


<?php get_footer(); ?>