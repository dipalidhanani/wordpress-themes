<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
get_header() ?>           
        


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
                
                <?php switch( $post_type = get_post_type() ) {
                          case TYPE_SERVICES  : 
                          case TYPE_NEWS      : 
                          case TYPE_PORTFOLIO : get_template_part('loop', 'internal'); break;
                          default             : get_template_part('loop', 'index');
                      }
                ?>

            </div>                       
            <!-- END CONTENT -->
            
            <!-- START LATEST NEWS -->
            <?php 
                if( $post_type == TYPE_PORTFOLIO ) {
                    get_sidebar('portfolio');
                } elseif( $post_type == TYPE_SERVICES ) {
                    get_sidebar('services');
                } elseif( $post_type == TYPE_NEWS ) {
                    get_sidebar('news');
                } else {
                    get_sidebar('blog');
                }
            ?>
            <!-- END LATEST NEWS -->   
        
        </div>      
        
<?php get_footer() ?>
