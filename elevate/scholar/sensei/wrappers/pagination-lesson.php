<?php
/**
 * Pagination - Lesson
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $woothemes_sensei, $post, $current_user, $view_lesson, $user_taking_course;
$nav_id_array = sensei_get_prev_next_lessons( $post->ID );
$previous_lesson_id = absint( $nav_id_array['prev_lesson'] );
$next_lesson_id = absint( $nav_id_array['next_lesson'] );

$hasquiz = get_posts('post_type=quiz&post_parent='.$post->ID);
$islessonquiz = get_post_meta ($hasquiz[0]->ID,'_pass_required');
// Output HTML
if ( ( 0 < $previous_lesson_id ) || ( 0 < $next_lesson_id ) ) { ?>
	<nav id="post-entries" class="post-entries fix">
        <?php if ( 0 < $previous_lesson_id ) { ?><div class="nav-prev fl"><a href="<?php echo esc_url( get_permalink( $previous_lesson_id ) ); ?>" rel="prev"><span class="meta-nav"></span> <?php echo get_the_title( $previous_lesson_id ); ?></a></div><?php } ?>
        <?php /*?><?php if ( 0 < $next_lesson_id ) { ?><div class="nav-next fr"><a href="<?php echo esc_url( get_permalink( $next_lesson_id ) ); ?>" rel="prev"><span class="meta-nav"></span> <?php echo get_the_title( $next_lesson_id ); ?></a></div><?php } ?><?php */?>
        <?php if( WooThemes_Sensei_Utils::user_completed_lesson( $post->ID, $current_user->ID ) ) { ?>
          <?php if ( 0 < $next_lesson_id ) { ?><div class="nav-next fr"><a href="<?php echo esc_url( get_permalink( $next_lesson_id ) ); ?>" rel="prev"><span class="meta-nav"></span> <?php echo get_the_title( $next_lesson_id ); ?></a></div><?php } ?>
        <?php }else{  ?>
        <div class="nav-next fr"> <a href="?run=first">Mark Module Complete</a></div>
         <?php 
		  } ?>
       
    </nav><!-- #post-entries -->
<?php } ?>