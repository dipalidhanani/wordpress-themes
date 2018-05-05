<?php
 
/**
 * @package WordPress
 * @subpackage Impero
 * @since Impero 1.0
 */
 
/*
Template Name: Gallery
*/             

$cat_params = Array(
    'hide_empty'    =>  FALSE,
    'title_li'      =>  ''
);

$cats = get_terms( 'category-photo', $cat_params );

get_header() ?>  
        
        <div class="layout-<?php echo yiw_layout_page() ?>">
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>                                            
                                          
            <?php if ( yiw_get_option('gallery_show_filters') ) : ?>
            <!-- FILTERS -->              
            <div class="gallery-filters inner">
                <ul class="filters portfolio-categories">
                    <li class="segment-1 first"><a data-value="all" href="#"><?php _e('All', 'yiw') ?></a></li><?php  
                    foreach( $cats as $cat )
                    {
                        if( $cat->count > 0 ) :
                            ?><li class="segment-<?php echo $cat->term_id ?>"><a href="#" data-value="<?php echo strtolower(preg_replace('/\s+/', '-', $cat->slug)) ?>"><?php echo $cat->name ?></a></li><?php
                        else :
                            ?><li><?php echo $cat->name ?></li><?php
                        endif;
                    }
                ?></ul>
            </div>
            <!-- END FILTERS -->  
            <?php endif ?>
        
            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php get_template_part( 'loop', 'page' ); ?>

                <?php get_template_part( 'loop', 'gallery' ); ?>

                <?php comments_template(); ?>  
            </div>
            <!-- END CONTENT -->
            
            <!-- START LATEST NEWS -->
            <?php get_sidebar() ?>
            <!-- END LATEST NEWS -->   
        
        </div>

        <!-- START EXTRA CONTENT -->
        <?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
        
<?php get_footer() ?>
