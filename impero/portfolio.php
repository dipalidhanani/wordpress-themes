<?php
/**
 * @package WordPress
 * @subpackage Impero
 * @since Impero 1.0
 */

/*
Template Name: Portfolio
*/

get_header();
get_sidebar(); ?>    
  	 

  </div>
   <div class="rightbar">

     <?php
$portfolio_type = yiw_get_option('portfolio_type');
$portfolio_types = array( 
                       'no_sidebar' => array('3cols', 'slider', 'big_image'),
                       'sidebar'    => array('full_desc', 'filterable')
                   );

if( $portfolio_type == 'full_desc' ) {
    get_template_part( 'single', 'bl_portfolio' );
    die;
}                       

$cat_params = Array(
    'hide_empty'    =>  FALSE,
    'title_li'      =>  ''
);

$cats = get_terms( 'category-project', $cat_params );

$layout_type = ( in_array($portfolio_type, $portfolio_types['no_sidebar']) ) ? 'sidebar-no' : yiw_layout_page();

	    global $post;
        if('portfolio.php' == get_post_meta($post->ID, '_wp_page_template',true)){?>  
        
        <div class="banner"> <img  title="blog" alt="blog" src="<?php bloginfo('stylesheet_directory'); ?>/images/innerimg.jpg" border="0"  /> </div>
        
        <?php }?>
        <div class="clear"></div>
        <div class="layout-<?php echo $layout_type ?>">

            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>   
                               
            <?php if ( $portfolio_type == 'filterable' && yiw_get_option('portfolio_show_filters') ) : ?>
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
                <?php if ( ! is_tax() ) get_template_part( 'loop', 'page' ); ?>
                <?php get_template_part( 'portfolio', $portfolio_type ); ?>
            </div>
            <!-- END CONTENT -->

            <?php if($layout_type != 'sidebar-no') get_sidebar() ?>
        </div>

        <!-- START EXTRA CONTENT -->
        <?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    

<?php get_footer() ?>
<div class="clear"></div>