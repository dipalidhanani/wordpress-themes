<?php
/**
 * The template for displaying product content in the single-quiz.php template
 *
 * Override this template by copying it to yourtheme/sensei/content-single-quiz.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
        	<article <?php post_class(); ?>>

                <?php do_action( 'sensei_quiz_single_title' ); ?>

                <section class="entry">
                	<?php the_content(); ?>
                	<?php do_action( 'sensei_quiz_questions' ); ?>
				</section>
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
						
						
					
					$current_lessonid = get_post_meta($post->ID, '_quiz_lesson', true );
					$last_lessonid = end($lesson_array)->ID;
//echo "dd:".$current_lessonid ."~". $last_lessonid;
$grp_ind_account = get_the_author_meta( 'group_individual_account', get_current_user_id() );
  ?>
 <?php if($current_lessonid == $last_lessonid){ 
 if($lid == ''){

if($grp_ind_account == 'Group Account'){$continuelink = '/elevate/thank-you-group';}
else if($grp_ind_account == 'Individual Account'){$continuelink = '/elevate/thank-you-individual';}
else{$continuelink = '/elevate/thank-you-individual';}
 ?>
 <a href="<?php echo $continuelink; ?>" class="continue_link" style="float: right;">Continue</a>
 <?php } } ?>
            </article><!-- .post -->

            <?php do_action('sensei_pagination'); ?>