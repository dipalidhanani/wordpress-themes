<?php
/**
 Template Name: Thank You - Individual
 */
 
get_header(); ?>
<?php //acf_form_head(); ?>
<?php

global $wpdb,$woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section, $woothemes_sensei_certificates;	
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
			
	//echo "yffhgfghfhg:".get_the_author_meta( 'user_subscription_type', get_current_user_id());		
if((get_the_author_meta( 'group_individual_account', get_current_user_id() ) == 'Individual Account') || (get_the_author_meta( 'user_subscription_type', get_current_user_id() ) == 'Individual Course') || (get_the_author_meta( 'user_subscription_type', get_current_user_id() ) == 'Corporate Account')){			

if ( 0 <= intval( count( $active_ids ) ) ) {

 $course_id = $course_status->comment_post_ID; 

$certificate_url = '';

		$args = array(
			'post_type' => 'certificate',
			'author' => get_current_user_id(),
			'meta_key' => 'course_id',
			'meta_value' => $course_id
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {

			$count = 0;
			while ($query->have_posts()) {

				$query->the_post();
				$certificate_url = get_permalink();

			} // End While Loop

		} // End If Statement

		wp_reset_postdata();


 ?>
	<div class="wrapper conclusion">
<div class="conclusion-wrapper">
<h2 class="title">ELEVATE Program Conclusion</h2>
<h3>Congratulations, you have now completed the
ELEVATE program!</h3>
<img class="con-logo" src="/elevate/wp-content/uploads/2016/03/congratulations-2.png" alt="congratulations 2" width="384" height="131" />

<p>It is now time for you to print your <strong>Certificate of Completion</strong> by clicking on the button below.</p>

<p class="submit_p"><a class="con-submit" href="<?php echo $certificate_url; ?>">Certificate</a></p>

<?php echo get_the_content(); ?>

<!--<p>We hope you’ve enjoyed the <strong>ELEVATE </strong>program but remember, completing the program doesn’t mean the <strong>ELEVATE </strong>experience is over.</p>

<p>As you know, your organization has purchased a one-year license which enables you to access the program at any time, as often as you like, while your license is still in effect.  Just log in using the information provided to you by your Executive Director. We also encourage you to continue to reference and use the variety of resources, tools, and tips provided in the program throughout your time serving on the Board of Directors.</p>

<p>Your organization has demonstrated its commitment to strong leadership by completing the<strong> ELEVATE</strong> program. Continue to use this knowledge to help lead your organization to achieve and maintain a standard of <strong class="cont-gold-color">governance excellence</strong> in the non-profit sector.</p>

<p><strong>ELEVATE </strong>is an initiative of SARC’s Learning Central website.</p>

<p>For more information on the various professional development and ongoing learning opportunities that SARC provides, please visit <a class="link-txt" href="http://www.SARClearningcentral.ca">www.SARClearningcentral.ca</a>.</p>-->

</div>
</div>

 
<?php } else{ //echo "ccccccc"; die();
wp_redirect ('/elevate/');
  die();
}
}else{//echo "sdgsdgdsg"; die();
	wp_redirect ('/elevate/');
  die();
	}
  
//get_sidebar();
get_footer(); ?>