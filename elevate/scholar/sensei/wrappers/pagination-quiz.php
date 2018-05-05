<?php
/**
 * Pagination - Lesson
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $woothemes_sensei, $post, $current_user, $view_lesson, $user_taking_course,$wpdb;
$quiz_lesson = absint( get_post_meta( $post->ID, '_quiz_lesson', true ) );
$nav_id_array = sensei_get_prev_next_lessons( $quiz_lesson );
$previous_lesson_id = absint( $nav_id_array['prev_lesson'] );
$next_lesson_id = absint( $nav_id_array['next_lesson'] );
$a = get_post_meta($post->ID,'_quiz_lesson');

$comments=$wpdb->get_results("SELECT * FROM `wp_comments` WHERE `comment_post_ID` = '".$a[0]."' AND `user_id`= '".$current_user->ID."' AND `comment_approved` in ('complete','graded','passed')");
// Output HTML
if ( ( 0 < $previous_lesson_id ) || ( 0 < $next_lesson_id ) ) { ?>
	<nav id="post-entries" class="post-entries 222 fix">
        <?php if ( 0 < $previous_lesson_id ) { ?><div class="nav-prev fl"><a href="<?php echo esc_url( get_permalink( $previous_lesson_id ) ); ?>" rel="prev"><span class="meta-nav"></span> <?php echo get_the_title( $previous_lesson_id ); ?></a></div><?php } ?>
        <?php if( !empty($comments) ) { ?>
        <?php if ( 0 < $next_lesson_id ) { ?><div class="nav-next fr"><a href="<?php echo esc_url( get_permalink( $next_lesson_id ) ); ?>" rel="prev"><span class="meta-nav"></span> <?php echo get_the_title( $next_lesson_id ); ?></a></div><?php } ?> <?php } //else{ ?>
      <!--  <div class="nav-next fr"> <a href="?run=first">Mark Lesson Complete</a></div>-->
         <?php //} ?>
    </nav><!-- #post-entries -->
<?php } ?>