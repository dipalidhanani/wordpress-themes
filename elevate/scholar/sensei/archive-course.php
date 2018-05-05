<?php
/**
 * Template Name: Course Archive
 *
 * Here we setup all logic and HTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header(); ?>

    <div id="content" class="col-full">

    	<?php woo_main_before(); ?>
<div class="outer-wrapper">
        	<div class="wrapper single-lesson-main">
				<?php do_action( 'sensei_course_archive_main_content' ); ?>
                <?php do_action('sensei_pagination'); ?>
			</div>
            <?php dynamic_sidebar( 'widgets-page-template' );?>


</div> <p>test</p>
		<?php woo_main_after(); ?>

    </div><!-- /.content -->

<?php get_footer(); ?>