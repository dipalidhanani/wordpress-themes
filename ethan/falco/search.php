<?php
/**
 * The search template file.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
?>

<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group" style="width:100% !important;">
		
			<div class="section">
				<div class="section_wrapper clearfix">
				
					<div class="posts_wrapper clearfix">	
						<?php
							while ( have_posts() )
							{
								the_post();
								?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(array('column','no-photo','one')); ?>>
									<div class="post_wrapper">
										<div class="desc">
											<a class="desc_a" href="<?php the_permalink(); ?>">
												<span class="post-icon"><i class="<?php echo mfn_post_type(get_the_ID(),true); ?>"></i></span>
												<h4><?php the_title(); ?></h4>
												<?php echo mfn_excerpt( get_the_ID(), 100, '<p><b><strong>' ); ?>
											</a>
										</div>
									</div>
								</div>
								<?php
							}
						?>
					</div>
					
					<?php	
						// pagination
						if(function_exists( 'mfn_pagination' )):
							mfn_pagination();
						else:
							?>
							<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'falco')) ?></div>
							<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'falco')) ?></div>
							<?php
						endif;
					?>

				</div>
			</div>
			
		</div>

	</div>
</div>

<?php get_footer(); ?>