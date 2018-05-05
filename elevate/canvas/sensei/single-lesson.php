<?php
/**
 * The Template for displaying all single lessons.
 *
 * Override this template by copying it to yourtheme/sensei/single-lesson.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php  get_sensei_header();  ?>

<?php the_post(); ?>
<div class="wrapper inner-body-wrap">
        	<!--left section start-->
            <div class="wrapper single-lesson-main">
            <div class="inner-left">
<article <?php post_class( array( 'lesson', 'post' ) ); ?>>

    <?php

        /**
         * Hook inside the single lesson above the content
         *
         * @since 1.9.0
         *
         * @param integer $lesson_id
         *
         * @hooked deprecated_lesson_image_hook - 10
         * @hooked deprecate_sensei_lesson_single_title - 15
         * @hooked Sensei_Lesson::lesson_image() -  17
         * @hooked deprecate_lesson_single_main_content_hook - 20
         */
        do_action( 'sensei_single_lesson_content_inside_before', get_the_ID() );

    ?>

    <section class="entry fix">

        <?php

        if ( sensei_can_user_view_lesson() ) {


            the_content();
			

            if( apply_filters( 'sensei_video_position', 'top', $post->ID ) == 'top' ) {

                do_action( 'sensei_lesson_video', $post->ID );

            }

        } else {
            ?>

                <p> <?php the_excerpt(); ?> </p>

            <?php
        }

        ?>

    </section>

    <?php

        /**
         * Hook inside the single lesson template after the content
         *
         * @since 1.9.0
         *
         * @param integer $lesson_id
         *
         * @hooked Sensei()->frontend->sensei_breadcrumb   - 30
         */
        remove_action( 'sensei_pagination', array( Sensei()->frontend, 'sensei_breadcrumb' ), 80, 1 );
        
        //remove_action( 'sensei_pagination', array( Sensei()->frontend, 'sensei_breadcrumb' ), 80, 1 );
        //remove_action( 'sensei_single_lesson_content_inside_after', array( 'sensei_breadcrumb', 'the_course_enrolment_actions' ), 30 );
        do_action( 'sensei_single_lesson_content_inside_after', get_the_ID() );

    ?>

</article><!-- .post -->
</div>
       </div>
 <?php dynamic_sidebar( 'widgets-page-template' );?>
 <!--right section end-->

   </div>

<?php get_sensei_footer(); ?>