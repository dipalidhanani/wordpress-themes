<?php       
/**
 * @package WordPress
 * @since 1.0
 */

get_header();
 get_sidebar();
?>
</div>
   <div class="rightbar">         
        <div class="layout-<?php echo yiw_layout_page() ?>">
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>


            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php $blog_type = yiw_get_option('blog_type'); ?>

                <?php 
                    global $wp_query, $post;
                    $tmp_query = $wp_query;

                    if ( !is_singular( 'bl_portfolio' ) )
                        query_posts( 'post_type=bl_portfolio&posts_per_page=1' );

                    get_template_part( 'loop', 'portfolio' );

                    $wp_query = $tmp_query;       
                    wp_reset_postdata();
                ?>  
            </div>                       
            <!-- END CONTENT -->

            <!-- START LATEST NEWS -->
            <?php //get_sidebar('portfolio'); ?>
            <!-- END LATEST NEWS -->   
        </div>      
	</div>
<?php get_footer() ?>
