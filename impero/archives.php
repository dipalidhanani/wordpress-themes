<?php       
/**
 * @package WordPress
 * @since 1.0
 */

/*
Template Name: Archives
*/
 
get_header() ?>                        
       
        <div class="layout-<?php echo yiw_layout_page() ?> group">
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        
            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php get_template_part( 'loop', 'page' ) ?> 
                

                <div class="archive-list">
                    <?php 
                        $lastposts = new WP_Query( 'posts_per_page=30' ); 
                        
                        if ( $lastposts->have_posts() ) :
                    ?>
                    <h3 class="no-cufon"><?php printf( __( 'Last %d posts', 'yiw' ), 30 ) ?>:</h3>    
                    <ul class="archive-posts group">
                        <?php while( $lastposts->have_posts() ) : $lastposts->the_post(); ?>
                        
                        <li>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
                                <span class="comments_number"><?php comments_number( '0', '1', '%' ) ?></span>
                                <span class="archdate"><?php echo get_the_date( 'j.n.y' ) ?></span>
                                <?php the_title() ?>
                            </a>
                        </li>
                        
                        <?php endwhile; ?>  
                    </ul>
                    <?php endif; ?>
                    
                    <h3 class="no-cufon"><?php _e( 'Archives by Month', 'yiw' ) ?>:</h3>
                    <ul class="archive-monthly group">
                        <?php wp_get_archives('type=monthly'); ?>
                    </ul>
                    
                    <h3 class="no-cufon"><?php _e( 'Archives by Subject', 'yiw' ) ?>:</h3>
                    <ul class="archive-categories group">
                         <?php wp_list_categories( 'title_li=' ); ?>
                    </ul>
                </div>

            </div>
            <!-- END CONTENT -->
            
            <!-- START SIDEBAR -->
            <?php get_sidebar() ?>
            <!-- END SIDEBAR -->    
        
        </div>   
                              
        <!-- START EXTRA CONTENT -->
        <?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
       
<?php get_footer() ?>
