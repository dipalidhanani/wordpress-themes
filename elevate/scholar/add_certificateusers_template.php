<?php
/**
 Template Name: Add certificate Users
 */
 ?>
 <?php
 acf_form_head(); 
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

$arr_certi_data = get_user_meta( get_current_user_id(),'group_account_users_certificate_data' );


 ?>
	<div class="outer-wrapper">
        	<div class="col-full addCertUsers">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>
				
				<?
        $options = array(
            'post_id' => $post->ID, // post id to get field groups from and save data to
            'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
            'form' => true, // set this to false to prevent the <form> tag from being created
            'form_attributes' => array( // attributes will be added to the form element
                'id' => 'post',
                'class' => '',
                'action' => '',
                'method' => 'post',
            ),
            'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
            'html_before_fields' => '', // html inside form before fields
            'html_after_fields' => '', // html inside form after fields
            'submit_value' => 'Submit', // value for submit field
            'updated_message' => 'Post updated.', // default updated message. Can be false to show no message
        );
        //acf_form( $options );
          
				?>
				<?php acf_form($options); ?>

			<?php endwhile; ?>
            <?php if(!empty($arr_certi_data)){ ?>
			<a title="View Exisiting Certificate" class="button sensei-certificate-link" href="/elevate/add-certificate-users-success">View Existing Certificates</a>
            <?php } ?>
		</div><!-- #content -->
		 <div class="clear"></div>
	</div><!-- #primary -->

 
<?php 
  
get_sidebar();
get_footer(); ?>