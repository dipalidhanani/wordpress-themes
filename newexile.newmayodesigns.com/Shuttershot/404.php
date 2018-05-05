<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package web2feel
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="not-page-content">
					<h2>404-Not Found</h2>
					<p><?php _e( 'The page you are looking is not here.. please try a different search.', 'web2feel' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>