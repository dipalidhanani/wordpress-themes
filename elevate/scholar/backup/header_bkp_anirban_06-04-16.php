<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<?php woo_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">

	<div id="inner-wrapper">
    
    <div class="page-wrap">

	<?php woo_header_before(); ?>

	<header id="header" class="col-full">

		<?php woo_header_inside(); ?>
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
	 $active_count = $completed_count = 0;

			$active_courses = array();
			if ( 0 < intval( count( $active_ids ) ) ) {
				$my_courses_section = 'active';
				$active_courses = $woothemes_sensei->post_types->course->course_query( $per_page, 'usercourses', $active_ids );
				$active_count = count( $active_ids );
			} // End If Statement

	/* foreach ( $active_courses as $course_item ) {
		 $course_id = $course_item->ID;
						$qu = "SELECT COUNT(*) FROM wp_term_relationships where object_id='".absint( $course_id )."'";
						$modulecount = $wpdb->get_var($wpdb->prepare($qu));
						
						
						
						
						$getlessons = $wpdb->get_results($wpdb->prepare("SELECT * FROM wp_postmeta 
						INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID  
						where wp_posts.post_status = 'publish' and meta_key = '_lesson_course' and meta_value='".absint( $course_id )."'",ARRAY_A));
						
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
	 }*/
						//echo $lessonlink;
		foreach ( $active_courses as $course_item ) {
			 $lesson_course_id = $course_item->ID;
						//$lesson_course_id = 7748;
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
					//print_r($lesson_array);
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
							$lessontitle = $post_7->post_title;
							$lessonname = $post_7->post_name;							
							
							 $lessonlink1 = get_site_url().'/lesson/'.$lessonname;
							
							
							}
							
							$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
							
							$total_lengthoflesson += $getlessonlength;
							
						
						
						}
				 }		
		
	
		 ?>
 <?php if($total_lengthoflesson != ''){ ?>    
<script>
jQuery( document ).ready(function( $ ) {
$('#main-nav li:eq(0)').after('<li id="menu-item-26"><a href="<?php echo $lessonlink1; ?>">Continue</a></li>');
});
</script>
<?php } ?>
	</header>
	<?php woo_header_after(); ?>