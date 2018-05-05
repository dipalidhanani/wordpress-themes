<?php
/**
 Template Name: Success Add Users
 */
 
get_header(); ?>
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
<div class="outer-wrapper">
        	<div class="col-full succAddUsers">
            <h1>User Certificates</h1>
            <a href="/elevate/add-certificate-users" class="button sensei-certificate-link">Add More Users</a>
<br />
           <?
			$success = get_user_meta(get_current_user_id(),'group_account_users_certificate_data');
			
			if(!empty($success)){
				global $woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section,$wp_query, $post,$woothemes_sensei_certificates;
				$all_users = array();
				
			//	echo '<a href="/add-certificate-users" class="button sensei-certificate-link">Add More Users</a>';
				
				foreach($success as $success_users_all){
					$success_users = unserialize($success_users_all);
					//print_r($success_users);
					foreach($success_users as $succ_individuals){
						array_push($all_users,$succ_individuals);
					}
					
				}
				//print_r($all_users);				
				//$all_users = unserialize($success[0]);
				//print_r($success_users);die();
				echo '<ul class="subscription-type">';
				//print_r($success_users);
				$i=0;
				foreach($all_users as $user_certificates){
					 
					echo '<li>';
					
					//$results_link = '<a class="button view-results" href="' . $woothemes_sensei->course_results->get_permalink( $course_item->ID ) . '">' . apply_filters( 'sensei_view_results_text', __( 'View results', 'woothemes-sensei' ) ) . '</a>';
					/* if( empty( $course_id ) ){
            global $post;
            echo "asdfsaf".$course_id = $post->ID;
        }

        if( empty( $user_id ) ){
            $user_id = get_current_user_id();
        }*/
					$certificate_url = '';

		$args = array(
			'post_type' => 'certificate',
			'author' => $user_id,
			'meta_key' => 'course_id',
			'meta_value' =>  $course_id
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$count = 0;
			while ($query->have_posts()) {
				$query->the_post();
				$certificate_url = get_permalink();

			} // End While Loop

		} // End If Statement

		//echo "Asdfadsf".$certificate_url;

					/*if ( is_singular( 'course' ) ) {

            $certificate_url =  $woothemes_sensei_certificates->get_certificate_url( $post->ID, get_current_user_id() );

        } else {

            $certificate_url = $woothemes_sensei_certificates->get_certificate_url( $course_id, get_current_user_id() );

        }*/ // End If Statement

					$results_link = '<a href="' . $certificate_url .'?adminoption='.$i.'" class="sensei-certificate-link" title="' . esc_attr( __( 'View Certificate', 'sensei-certificates' ) ) . '">'. __( 'View Certificate', 'sensei-certificates' ) . '</a>';

					?>
					<div class="com">
                    	<label><? print_r($user_certificates);?></label>
						<?=$results_link;?>
                    </div>
					<?
					echo '</li>';
					$i++;
					
				}
				
				
				
			}else{  
wp_redirect ('/elevate/add-certificate-users');
  die();
}
		   
		   ?>
           
                
          </div>
          <div class="clear"></div>
        </div>
        
 
<?php
 } else{  
wp_redirect ('/elevate/');
  die();
}
}else{
	wp_redirect ('/elevate/');
  die();
	}
	
get_sidebar();
get_footer(); ?>