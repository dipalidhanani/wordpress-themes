<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The Template for outputting Lists of any Sensei content type.
 *
 * This template expects the global wp_query to setup and ready for the loop
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php
/**
 * This runs before the the course loop items in the loop.php template. It runs
 * only only for the course post type. This loop will not run if the current wp_query
 * has no posts.
 *
 * @since 1.9.0
 */

do_action( 'sensei_loop_course_before' );
?>
<ul class="course-container course-listing columns-<?php sensei_courses_per_row(); ?>">
	    <?php
    /**
     * This runs before the post type items in the loop.php template. It
     * runs within the courses loop <ul> tag.
     *
     * @since 1.9.0
     */
          remove_action( 'sensei_loop_course_inside_before', array( 'sensei_user_courses', 'active_no_course_message_output' ) );
    do_action( 'sensei_loop_course_inside_before' );
    ?>

    <?php
    /*
     * Loop through all courses
     */
    echo '<div class="progress-section">';
    while ( have_posts() ) { 
      the_post();
      ?>
    	<li>
        <?
        global $post;
          $user_course_status = Sensei_Utils::user_course_status( intval($post->ID), get_current_user_id() );
          $completed_course = Sensei_Utils::user_completed_course( $user_course_status );
          // Success message
          if ( $completed_course ) { ?>
             <h3 class="gray"><?php  _e( 'Completed', 'woothemes-sensei' ); ?></h3>
          <?php } else { ?>
              <h3 class="gray erew"><?php echo __( 'In Progress', 'woothemes-sensei' ); ?></h3>
          <?php } ?>
    
        </li>
      <?
      
      
        sensei_load_template_part('content','course');

    }
    echo '<div class="clear"></div></div>';
	global $wpdb;	
	$qu = "SELECT COUNT(*) FROM wp_term_relationships where object_id='".absint( $post->ID )."'";
	$modulecount = $wpdb->get_var($wpdb->prepare($qu));
	
	
	
	
	$getlessons = $wpdb->get_results($wpdb->prepare("SELECT * FROM wp_postmeta 
	INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID  
	where wp_posts.post_status = 'publish' and meta_key = '_lesson_course' and meta_value='".absint( $post->ID )."' order by wp_posts.menu_order asc",ARRAY_A));
	
//echo "<pre>"; print_r($getlessons);
$lastclick = 0;
$total_lengthoflesson = 0;
foreach($getlessons as $row_getlessons)
{
$lessonid = $row_getlessons->post_id;
	
	
	$getcountlesson = $wpdb->get_var(
	$wpdb->prepare(
	'SELECT COUNT(*) FROM `wp_comments` WHERE `user_id` = "'.get_current_user_id().'" and `comment_post_ID` = "'.$lessonid.'" and `comment_approved` IN("complete", "graded")'
	)
	);
	
	//echo "<br>getcountlesson:".$getcountlesson;
	
	if($getcountlesson == 0 && $lastclick != 1){
		$lastclick = 1;
		$post_7 = get_post( $lessonid ); 
		$lessontitle = $post_7->post_title;
		$lessonname = $post_7->post_name;							
		
		 $lessonlink = get_site_url().'/lesson/'.$lessonname;
		
		
		}
		
		$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
		
		$total_lengthoflesson += $getlessonlength;
		
	
	
	}
	
	
    global $post;
    $html ='';
    $user_course_status = Sensei_Utils::user_course_status( intval($post->ID), get_current_user_id() );
		if(!Sensei_Utils::user_completed_course( $user_course_status ) ) {
        $html .= '<a class="btn" href="' . $lessonlink . '" >';
		
        $html .= 'Continue' ;
    
		    $html .= '</a>';
		}
    
    echo $html;
    
    ?>

    <?php
    /**
     * This runs after the post type items in the loop.php template. It runs
     * only for the specified post type
     *
     * @since 1.9.0
     */
    do_action( 'sensei_loop_course_inside_after' );
    ?>

</ul>

<?php
/**
 * This runs after the post type items in the loop.php template. It runs
 * only for the specified post type
 *
 * @since 1.9.0
 */
do_action( 'sensei_loop_course_after' );
?>
