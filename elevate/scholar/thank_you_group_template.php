<?php
/**
 Template Name: Thank You - Group
  *
 * Here we setup all logic and HTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
get_header(); ?>
<?php //acf_form_head(); ?>
<?php

global $wpdb,$woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section;	
	// $course_id = 7748;
	 $per_page = 20;
	 $course_statuses = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'user_id' => get_current_user_id(), 'type' => 'sensei_course_status' ), true );
			// User may only be on 1 Course
			if ( !is_array($course_statuses) ) {
				$course_statuses = array( $course_statuses );
			}
	 $completed_ids = $active_ids = array();
			foreach( $course_statuses as $course_status ) {
				if ( WooThemes_Sensei_Utils::user_completed_course( $course_status, get_current_user_id() ) ) {
					$completed_ids[] = $course_status->comment_post_ID;
				} else {
					$active_ids[] = $course_status->comment_post_ID;
				}
			}
if(get_the_author_meta( 'group_individual_account', get_current_user_id() ) == 'Group Account'){			

if ( 0 <= intval( count( $active_ids ) ) ) {
?>
<div class="wrapper conclusion">
<div class="">
<?php
echo get_the_content();

 ?>
 </div></div>
	<!--<div class="wrapper conclusion">
<div class="">
<h2 class="title">ELEVATE Program Conclusion</h2>
<h3>Congratulations, you have now completed the
ELEVATE program!</h3>
<img class="con-logo" src="/elevate/wp-content/uploads/2016/03/congratulations-2.png" alt="congratulations 2" width="384" height="131" />

<p>Click on "Submit" below to add each Director’s name to generate individual certificates.</p>

<p class="submit_p"><a class="con-submit" href="/elevate/add-certificate-users">Submit</a></p>

<p>We hope you’ve enjoyed the <strong>ELEVATE</strong> program but remember, completing the program doesn’t mean the <strong>ELEVATE </strong>experience is over.</p>

<p>As you know, your organization has purchased a one-year license which enables you to access the program at any time, as often as you like, while your license is still in effect.  Just log in using the information provided to you by your Executive Director. We also encourage you to continue to reference and use the variety of resources, tools, and tips provided in the program throughout your time serving on the Board of Directors.</p>

<p>Your organization has demonstrated its commitment to strong leadership by completing the<strong> ELEVATE</strong> program. Continue to use this knowledge to help lead your organization to achieve and maintain a standard of <strong class="cont-gold-color">governance excellence</strong> in the non-profit sector.</p>

<p><strong>ELEVATE </strong>is an initiative of SARC’s Learning Central website.</p>

<p>For more information on the various professional development and ongoing learning opportunities that SARC provides, please visit <a class="link-txt" href="http://www.SARClearningcentral.ca">www.SARClearningcentral.ca</a>.</p>

</div>
</div>-->

 
<?php } else{  
wp_redirect ('/elevate/');
  die();
}
}else{
	wp_redirect ('/elevate/');
  die();
	}
  
//get_sidebar();
get_footer(); ?>