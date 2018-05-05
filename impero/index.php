<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
get_header() ?>           
        


        <div class="layout-<?php echo yiw_layout_page() ?>">

            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php $blog_type = yiw_get_option('blog_type'); ?>
                <?php get_template_part('loop', 'index') ?>
            </div>                       
            <!-- END CONTENT -->
            
            <!-- START LATEST NEWS -->
            <?php get_sidebar('blog') ?>
            <!-- END LATEST NEWS -->   
        
        </div>      
        
<?php get_footer() ?>
