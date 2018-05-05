<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * List the Course Modules and Lesson in these modules
 *
 * Template is hooked into Single Course sensei_single_main_content. It will
 * only be shown if the course contains modules.
 *
 * All lessons shown here will not be included in the list of other lessons.
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php

    /**
     * Hook runs inside single-course/course-modules.php
     *
     * It runs before the modules are shown. This hook fires on the single course page. It will show
     * irrespective of irrespective the course has any modules or not.
     *
     * @since 1.8.0
     *
     */
    
    //remove_action('sensei_single_course_modules_before',array( Sensei()->modules,'course_modules_title' ), 20);
    //add_action('sensei_single_course_modules_before',array( 'Sensei_Core_Modules','custom_course_modules_title' ), 20);
    
    do_action('sensei_single_course_modules_before');

?>

<?php if( sensei_have_modules() ): 
  echo '<ul class="right-module-listing">';  
   $count = 0;
  ?>

    <?php while ( sensei_have_modules() ): sensei_setup_module(); 
       $count++
      
      ?>
        <?php if( sensei_module_has_lessons() ): ?>
         
                <?php

                /**
                 * Hook runs inside single-course/course-modules.php
                 *
                 * It runs inside the if statement after the article tag opens just before the modules are shown. This hook will NOT fire if there
                 * are no modules to show.
                 *
                 * @since 1.9.0
                 * @since 1.9.7 Added the module ID to the parameters.
                 *
                 * @hooked Sensei()->modules->course_modules_title - 20
                 *
                 * @param int sensei_get_the_module_id() Module ID.
                 */
                do_action( 'sensei_single_course_modules_inside_before', sensei_get_the_module_id() );

                ?>
              <?php 
             
              while( sensei_module_has_lessons() ): the_post(); 
             
              ?>

                  <li>
                        <?
                        $lesson_id = get_the_ID();
              					$classes = "not-completed";
              					if( WooThemes_Sensei_Utils::user_completed_lesson( get_the_ID(), get_current_user_id() ) ) {
              						$classes = "completed";
              					}

              					
				
              			$nav_id_array1 = sensei_get_prev_next_lessons( $lesson_id );
              			$previous_lesson_id1 = absint( $nav_id_array1['prev_lesson'] );
              			$next_lesson_id1 = absint( $nav_id_array1['next_lesson'] );
                    
                    $nextclasses = "not-completed";
          					if( WooThemes_Sensei_Utils::user_completed_lesson( $next_lesson_id1, get_current_user_id() ) ) {
          						$nextclasses = "completed";
          					}
                    
                    $prevclasses = "not-completed";
          					if( WooThemes_Sensei_Utils::user_completed_lesson( $previous_lesson_id1, get_current_user_id() ) ) {
          						$prevclasses = "completed";
          					}
                    
                    
                        
                    if($classes=='completed'){
                      ?>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>" class="active">
                      <? 
                    }
                    else if($classes == 'not-completed' && $nextclasses == 'not-completed' && $prevclasses == 'completed'){
                      ?>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>" >
                      <? 
                    }
                    else if($classes == 'not-completed' && $nextclasses == 'not-completed' && $prevclasses == 'not-completed' && $count==1){
                      ?>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>" >
                      <? 
                    }
                    else if($prevclasses == 'completed' && $nextclasses == 'completed'){
                      ?>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>" >
                      <? 
                    }
                    else{
                      ?>
                      <a href="#" title="<?php the_title_attribute() ?>" class="<? echo $classes."=".$nextclasses."=".$prevclasses ?>">
                      <? }                    ?>
                      
                        
                          <?php the_title(); ?>
                          <?php //sensei_the_module_status(); ?>

                        <?php
                        $course_id = Sensei()->lesson->get_course_id( get_the_ID() );
                        if ( Sensei_Utils::is_preview_lesson( get_the_ID() ) && ! Sensei_Utils::user_started_course( $course_id, get_current_user_id() )  ) { ?>

                            <span class="preview-label"><?php _e( 'Free Preview', 'woothemes-sensei' ); ?></span>

                          <?php } ?>

                      </a>
                    
                  </li>

              <?php 
              
              endwhile; ?>

                

                <?php

                /**
                 * Hook runs inside single-course/course-modules.php
                 *
                 * It runs inside the if statement before the closing article tag directly after the modules were shown.
                 * This hook will not trigger if there are no modules to show.
                 *
                 * @since 1.9.0
                 * @since 1.9.7 Added the module ID to the parameters.
                 *
                 * @param int sensei_get_the_module_id() Module ID.
                 */
                do_action( 'sensei_single_course_modules_inside_after', sensei_get_the_module_id() );

                ?>
        <?php endif; //sensei_module_has_lessons  ?>

    <?php endwhile; // sensei_have_modules ?>

<?php 
echo '</ul>';
endif; // sensei_have_modules ?>

<?php

/**
 * Hook runs inside single-course/course-modules.php
 *
 * It runs after the modules are shown. This hook fires on the single course page,but only if the course has modules.
 *
 * @since 1.8.0
 */
do_action('sensei_single_course_modules_after');
