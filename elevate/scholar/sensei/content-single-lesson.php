<?php
/**
 * The template for displaying product content in the single-lessons.php template
 *
 * Override this template by copying it to yourtheme/sensei/content-single-lesson.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

 global $woothemes_sensei, $post, $current_user, $view_lesson, $user_taking_course,$testval;
 $testval = 0;
 // Content Access Permissions
 $access_permission = false;
 if ( ( isset( $woothemes_sensei->settings->settings['access_permission'] ) && ! $woothemes_sensei->settings->settings['access_permission'] ) || sensei_all_access() ) {
 	if(WooThemes_Sensei_Utils::sensei_is_woocommerce_activated()) {
    $course_id = get_post_meta( $post->ID, '_lesson_course', true );
    $wc_post_id = get_post_meta( $course_id, '_course_woocommerce_product', true );
    $product = $woothemes_sensei->sensei_get_woocommerce_product_object( $wc_post_id );

    $access_permission = ! ( isset ( $product ) && is_object ( $product ) );
  }
 } // End If Statement
 
  
 if (isset($_GET['run'])) $linkchoice=$_GET['run']; 
else $linkchoice=''; 

switch($linkchoice){ 

case 'first' : 
    myFirst(); 
    break; 
default : 
    

} 

?>
        	<article <?php post_class( array( 'lesson', 'post' ) ); ?> style="overflow: auto;">

				<?php do_action( 'sensei_lesson_image', $post->ID ); ?>

                <?php do_action( 'sensei_lesson_single_title' ); ?>

                <?php

                $view_lesson = true;

                wp_get_current_user();

                $lesson_prerequisite = absint( get_post_meta( $post->ID, '_lesson_prerequisite', true ) );


				if ( $lesson_prerequisite > 0 ) {
					// Check for prerequisite lesson completions
					$view_lesson = WooThemes_Sensei_Utils::user_completed_lesson( $lesson_prerequisite, $current_user->ID );
				}

				$lesson_course_id = get_post_meta( $post->ID, '_lesson_course', true );
				$user_taking_course = WooThemes_Sensei_Utils::user_started_course( $lesson_course_id, $current_user->ID );

				if( current_user_can( 'administrator' ) ) {
					$view_lesson = true;
					$user_taking_course = true;
				}

				$is_preview = false;
				if( WooThemes_Sensei_Utils::is_preview_lesson( $post->ID ) ) {
					$is_preview = true;
					$view_lesson = true;
				};

				if( $view_lesson ) { ?>

					<section class="entry fix">
					<?php if ( $is_preview && !$user_taking_course ) { ?>
						<div class="sensei-message alert"><?php echo $woothemes_sensei->permissions_message['message']; ?></div>
					<?php } ?>

	                	<?php
	                	if ( $access_permission || ( is_user_logged_in() && $user_taking_course ) || $is_preview ) {
	                		if( apply_filters( 'sensei_video_position', 'top', $post->ID ) == 'top' ) {
	                			do_action( 'sensei_lesson_video', $post->ID );
	                		}
	                		//the_content();
	                	} else {
	                		echo '<p>' . $post->post_excerpt . '</p>';
	                	}
	            		?>
					</section>
                     <?php $total_metaurl = get_post_meta( $post->ID, 'page_url');
					 $all_metaposts = get_post_meta( $post->ID, '');
					if($total_metaurl[0] != 0){ 
					  ?>
<div class="url_links">
<h2>Module Links</h2>
<ul>
<?php for($i=0;$i<$total_metaurl[0];$i++){						
						 ?>
<li>  <a href="<?php  echo $all_metaposts['page_url_'.$i.'_enter_url'][0]; ?>" target="_blank"><?php echo $all_metaposts['page_url_'.$i.'_enter_text'][0]; ?></a></li>
<?php } ?>
</ul>
</div>
					<?php
					} ?>

					<?php 
					
					if ( $access_permission || ( is_user_logged_in() && $user_taking_course ) || $is_preview ) {
						do_action( 'sensei_lesson_single_meta' );
					} else {
						do_action( 'sensei_lesson_course_signup', $lesson_course_id );
					}
					
					

				} else {
					if ( $lesson_prerequisite > 0 ) {
						echo sprintf( __( 'You must first complete %1$s before viewing this Lesson', 'woothemes-sensei' ), '<a href="' . esc_url( get_permalink( $lesson_prerequisite ) ) . '" title="' . esc_attr(  sprintf( __( 'You must first complete: %1$s', 'woothemes-sensei' ), get_the_title( $lesson_prerequisite ) ) ) . '">' . get_the_title( $lesson_prerequisite ). '</a>' );
					}
				}
function myFirst(){ 
global $woothemes_sensei,$wpdb, $post, $current_user, $view_lesson, $user_taking_course;
// echo "myFirst called:".$post->ID."--".$current_user->ID;
$testval = 1;
$n = 50;
 $offset = 0;

   $lesson_completed = WooThemes_Sensei_Utils::update_lesson_status( $current_user->ID, $post->ID, 'complete');
   if ($lesson_completed) {
	   
	   	$count_object = wp_count_posts( 'lesson' );
		$count_published = $count_object->publish;

		if ( 0 == $count_published ) {
			return true;
		}

		// Calculate if this is the last page
		if ( 0 == $offset ) {
			$current_page = 1;
		} else {
			$current_page = intval( $offset / $n );
		}
		$total_pages = ceil( $count_published / $n );

		$course_lesson_ids = $lesson_user_statuses = array();

		// Get all Lesson => Course relationships
		$meta_list = $wpdb->get_results( "SELECT $wpdb->postmeta.post_id, $wpdb->postmeta.meta_value FROM $wpdb->postmeta INNER JOIN $wpdb->posts ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE $wpdb->posts.post_type = 'lesson' and $wpdb->posts.post_status = 'publish' AND $wpdb->postmeta.meta_key = '_lesson_course' LIMIT $n OFFSET $offset ", ARRAY_A );
	
		if ( !empty($meta_list) ) {
			foreach ( $meta_list as $metarow ) {
				$lesson_id = $metarow['post_id'];
				$course_id = $metarow['meta_value'];
				$course_lesson_ids[ $course_id ][] = $lesson_id;
			}
		}

		// Get all Lesson => Course relationships
		$status_list = $wpdb->get_results( "SELECT user_id, comment_post_ID, comment_approved FROM $wpdb->comments WHERE comment_type = 'sensei_lesson_status' GROUP BY user_id, comment_post_ID ", ARRAY_A );
		if ( !empty($status_list) ) {
			foreach ( $status_list as $status ) {
				$lesson_user_statuses[ $status['comment_post_ID'] ][ $status['user_id'] ] = $status['comment_approved'];
			}
		}
	   $course_completion = $woothemes_sensei->settings->settings[ 'course_completion' ];

		$per_page = 40;
		$comment_id_offset = $count = 0;

		$course_sql = "SELECT * FROM $wpdb->comments WHERE comment_type = 'sensei_course_status' AND comment_ID > %d LIMIT $per_page";
		// $per_page users at a time
		while ( $course_statuses = $wpdb->get_results( $wpdb->prepare($course_sql, $comment_id_offset) ) ) {

			foreach ( $course_statuses AS $course_status ) {
				$user_id = $course_status->user_id;
				$course_id = $course_status->comment_post_ID;
				$total_lessons = count( $course_lesson_ids[ $course_id ] );
				if ( $total_lessons <= 0 ) {
					$total_lessons = 1; // Fix division of zero error, some courses have no lessons
				}
				$lessons_completed = 0;
				$status = 'in-progress';

				// Some Courses have no lessons... (can they ever be complete?)
				if ( !empty($course_lesson_ids[ $course_id ]) ) {
					foreach( $course_lesson_ids[ $course_id ] AS $lesson_id ) {
						$lesson_status = $lesson_user_statuses[ $lesson_id ][ $user_id ];
						// If lessons are complete without needing quizzes to be passed
						if ( 'passed' != $course_completion ) {
							switch ( $lesson_status ) {
								// A user cannot 'complete' a course if a lesson...
								case 'in-progress': // ...is still in progress
								case 'ungraded': // ...hasn't yet been graded
									break;

								default:
									$lessons_completed++;
									break;
							}
						}
						else {
							switch ( $lesson_status ) {
								case 'complete': // Lesson has no quiz/questions
								case 'graded': // Lesson has quiz, but it's not important what the grade was
								case 'passed': // Lesson has quiz and the user passed
									$lessons_completed++;
									break;

								// A user cannot 'complete' a course if on a lesson...
								case 'failed': // ...a user failed the passmark on a quiz
								default:
									break;
							}
						}
					} // Each lesson
				} // Check for lessons
				
				if ( $lessons_completed == $total_lessons ) {
					$status = 'complete';
				}
				// update the overall percentage of the course lessons complete (or graded) compared to 'in-progress' regardless of the above
				$metadata = array(
					'complete' => $lessons_completed,
					'percent' => abs( round( ( doubleval( $lessons_completed ) * 100 ) / ( $total_lessons ), 0 ) ),
				);
				WooThemes_Sensei_Utils::update_course_status( $user_id, $course_id, $status, $metadata );
				//echo "jkjkjk:".$user_id."--".$course_id."--".$status['user_id'];
				//exit;
				if ( 'complete' == $status ) {
				do_action( 'sensei_user_course_end', $current_user->ID, $course_id );
				}
				
				$count++;

			} // per course status
			$comment_id_offset = $course_status->comment_ID;
		} // all course statuses
		
		
		global $wpdb,$woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section;
$lesson_course_id = 7748;
						$lesson_array = array();
						$course_modules = Sensei()->modules->get_course_modules( $lesson_course_id );
						foreach ($course_modules as $module) {
						// get all lessons in the module
						$args = array(
							'post_type' => 'lesson',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'meta_query' => array(
								array(
									'key' => '_lesson_course',
									'value' => intval( $lesson_course_id ),
									'compare' => '='
								)
							),
							'tax_query' => array(
								array(
									'taxonomy' => Sensei()->modules->taxonomy,
									'field' => 'id',
									'terms' => intval( $module->term_id )
								)
							),
							'meta_key' => '_order_module_' . intval( $module->term_id ),
							'orderby' => 'meta_value_num date',
							'order' => 'ASC'
						);
						$lesson_array = array_merge( $lesson_array, get_posts( $args) );
					}
					
					$lid = '';
					$getcountlesson = 0;
					$lastclick = 0;
					$total_lengthoflesson = 0;
					foreach($lesson_array as $row_getlessons)
					{
					$lessonid = $row_getlessons->ID;
					
						
						$getcountlesson = $wpdb->get_var(
						$wpdb->prepare(
						'SELECT COUNT(*) FROM `wp_comments` WHERE `user_id` = "'.get_current_user_id().'" and `comment_post_ID` = "'.$lessonid.'" and `comment_approved` IN("complete", "graded","passed")'
						)
						);
						
						//echo "<br>getcountlesson:".$getcountlesson;
						
						if($getcountlesson == 0 && $lastclick != 1){
							$lastclick = 1;
							$post_7 = get_post( $lessonid ); 
							//print_r($post_7);
							$lessontitle = $post_7->post_title;
							$lessonname = $post_7->post_name;							
							
							 $lessonlink1 = get_site_url().'/lesson/'.$lessonname;
							$lid =  $post_7->ID;
							
							}
							
							$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
							
							$total_lengthoflesson += $getlessonlength;
							
						
						
						}
						
						
					
					$current_lessonid = $post->ID;
					$last_lessonid = end($lesson_array)->ID;
//echo "dd:".$current_lessonid ."~". $last_lessonid;
$grp_ind_account = get_the_author_meta( 'group_individual_account', get_current_user_id() );
 
  
//echo "ddd:".$current_lessonid ."~". $last_lessonid;
//exit;
                     	$nav_id_array = sensei_get_prev_next_lessons( $post->ID );
						$next_lesson_id = absint( $nav_id_array['next_lesson'] );
						$location = esc_url( get_permalink( $next_lesson_id ) );
						if(($current_lessonid == $last_lessonid) && ($lid == '')){ 
						if($grp_ind_account == 'Group Account'){
						  $continuelink = '/elevate/thank-you-group';						  
						}
						else if($grp_ind_account == 'Individual Account'){$continuelink = '/elevate/thank-you-individual';}
						else{$continuelink = '/elevate/thank-you-individual';}
						?>
                        <script type="text/javascript">
						   <!--
							  window.location= <?php echo "'" . $continuelink . "'"; ?>;
						   //-->
						   </script>
                        <?php

 						}else{
						?>
						   <script type="text/javascript">
						   <!--
							  window.location= <?php echo "'" . $location . "'"; ?>;
						   //-->
						   </script>
						<?php
						}
                    }
					
					
}
//echo "ddd:".$post->ID."--".$current_user->ID;
				?>
<div class="moduleContent" style="padding-top: 15px; clear:both;">           
<?php  echo get_the_content(); ?>
</div>

<?php global $wpdb,$woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section;
$lesson_course_id = 7748;
						$lesson_array = array();
						$course_modules = Sensei()->modules->get_course_modules( $lesson_course_id );
						foreach ($course_modules as $module) {
						// get all lessons in the module
						$args = array(
							'post_type' => 'lesson',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'meta_query' => array(
								array(
									'key' => '_lesson_course',
									'value' => intval( $lesson_course_id ),
									'compare' => '='
								)
							),
							'tax_query' => array(
								array(
									'taxonomy' => Sensei()->modules->taxonomy,
									'field' => 'id',
									'terms' => intval( $module->term_id )
								)
							),
							'meta_key' => '_order_module_' . intval( $module->term_id ),
							'orderby' => 'meta_value_num date',
							'order' => 'ASC'
						);
						$lesson_array = array_merge( $lesson_array, get_posts( $args) );
					}
					$lid = '';
					$getcountlesson = 0;
					$lastclick = 0;
					$total_lengthoflesson = 0;
					foreach($lesson_array as $row_getlessons)
					{
					$lessonid = $row_getlessons->ID;
					
						
						$getcountlesson = $wpdb->get_var(
						$wpdb->prepare(
						'SELECT COUNT(*) FROM `wp_comments` WHERE `user_id` = "'.get_current_user_id().'" and `comment_post_ID` = "'.$lessonid.'" and `comment_approved` IN("complete", "graded","passed")'
						)
						);
						
						//echo "<br>getcountlesson:".$getcountlesson;
						
						if($getcountlesson == 0 && $lastclick != 1){
							$lastclick = 1;
							$post_7 = get_post( $lessonid ); 
							//print_r($post_7);
							$lessontitle = $post_7->post_title;
							$lessonname = $post_7->post_name;							
							
							 $lessonlink1 = get_site_url().'/lesson/'.$lessonname;
							$lid =  $post_7->ID;
							
							}
							
							$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
							
							$total_lengthoflesson += $getlessonlength;
							
						
						
						}
						
						
					
					$current_lessonid = $post->ID;
					$last_lessonid = end($lesson_array)->ID;
//echo "dd:".$current_lessonid ."~". $last_lessonid;
$grp_ind_account = get_the_author_meta( 'group_individual_account', get_current_user_id() );
  ?>
 <?php if($current_lessonid == $last_lessonid){ 
 
 if($lid == '') {
if($grp_ind_account == 'Group Account'){
  $continuelink = '/elevate/thank-you-group';
  
}
else if($grp_ind_account == 'Individual Account'){$continuelink = '/elevate/thank-you-individual';}
else{$continuelink = '/elevate/thank-you-individual';}
//echo "dgdhfd".$testval;
$headers = array('Content-Type: text/html; charset=UTF-8');

$patterns = array();
		$patterns[0] = '/{display_name}/';
		$patterns[1] = '/{site_name}/';
		$patterns[2] = '/{admin_email}/';
		$replacements = array();
		$replacements[2] = $current_user->display_name;
		$replacements[1] = get_bloginfo ('name');
		$replacements[0] = get_bloginfo ('admin_email');
		
		$email_sub =  ot_get_option( 'email_subject_for_completion_of_course_to_admin' );		
		$email_msg = preg_replace($patterns, $replacements, ot_get_option( 'email_message_for_completion_of_course_to_admin' ));
		
	 wp_mail( 'dipali@2webdesign.com', $email_sub, $email_msg,$headers);  //// Send Mail to Admin

 ?>
 <script type="text/javascript">
//jQuery(document).ready(function(e) {
//  jQuery("#continuebut").trigger('click');
//   });
 </script>

 <a href="javascript:void(0)" class="continue_link" style="float: right;" id="continuebut" onClick="window.location='<?php echo $continuelink;?>'">Continue</a>
 <?php

 } } 

 
 ?>

            </article><!-- .post -->

            <?php do_action('sensei_pagination'); ?>