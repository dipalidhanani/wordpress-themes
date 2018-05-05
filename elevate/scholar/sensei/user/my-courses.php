<?php
/**
 * Template Name: My Courses
 * Here we setup all logic and HTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();

if ( ! defined( 'ABSPATH' ) ) exit;
global $woothemes_sensei, $post, $current_user, $wp_query;

// Get User Meta
get_currentuserinfo();
// Check if the user is logged in
if ( is_user_logged_in() ) {
	// Handle completion of a course
	do_action( 'sensei_complete_course' );
?>

    <div id="content" class="col-full">

    	<?php woo_main_before(); ?>

<section id="main-course" class="course-container">
	<h2 class="title">Hello, <?php global $current_user;
      get_currentuserinfo();
	  echo '' . $current_user->user_firstname . "\n";
	  ?>
	  </h2>
		<?php
		do_action( 'sensei_frontend_messages' );
		do_action( 'sensei_before_user_course_content', $current_user );
		custom_load_user_courses_content( $current_user, true );
		do_action( 'sensei_after_user_course_content', $current_user );
		?>
	</section>
</div>
		<?php woo_main_after(); ?>

    </div><!-- /.content -->
    </div>

<?php get_footer(); ?>

<?php } else {
	do_action( 'sensei_login_form' );
} // End If Statement ?>