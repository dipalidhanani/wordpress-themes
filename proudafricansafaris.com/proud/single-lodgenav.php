<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
		<div id="primary">
			

			<div id="lodg_content" role="main">
				<div id="left_nav">
<div class="contact_top_curve"></div>
<div class="contact_middle_curve">			
<div id="inner_ca">

<?php $n_categories = get_terms( 'lodgenavcat', 'orderby=slug' ); //print_r($n_categories);?>
<?php foreach($n_categories as $n_categories_ele) { ?>
<div class="sub2"><?php echo $n_categories_ele->name; ?></div>
<?php $categories = strip_tags(str_replace(' ','',get_the_term_list($queryObject->ID, 'lodgenavcat', '', ' ', '' ))); ?>
<!--<div class="catLgHeader"><img src="<?php bloginfo( 'template_url' )?>/catlgimg/<?=$n_categories_ele->name;?>.png" alt=""/></div>-->
				<ul>
						<?php
						//$query = 'posts_per_page=10';
		$queryObject = new WP_Query(array('post_type' => 'lodgenav', 'lodgenavcat'=> $n_categories_ele->slug, 'posts_per_page'=>'100'));
						// The Loop...
						if ($queryObject->have_posts()) {
					
						while( $queryObject->have_posts() ) : $queryObject->the_post();

						//$categories = strip_tags(str_replace(' ','',get_the_term_list($queryObject->ID, 'lodgenavcat', '', ' ', '' )));
						?>
						<li class="pro_cat <?php echo $categories; ?>"> 
				<a class="slider_a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>				
						</li>
						<?php
							endwhile;
						}
						wp_reset_postdata();
						wp_reset_query();
						?>
					</ul>
<?php } ?>
			</div></div>
				<div class="contact_bottom_curve"></div>
</div><!--left_nav-->
				<div id="right_contnt">
				<!--<img style="text-align:center;margin:8px;padding:0px;"src="<?php bloginfo( 'template_url' )?>/images/arumeru-txt." width="446" height="39"/>-->
			<a class="sub4" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<br><br>
				<?php the_post(); ?>
					
				<?php get_template_part( 'content', 'page' ); ?>
				</div><!---right_content--->
				<?php //comments_template( '', true ); ?>

			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_footer(); ?>
</body>
</html>
