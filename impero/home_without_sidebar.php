<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Full Width Template
*/
    
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */                        

get_header() ?>                        
        
		<div class="layout-sidebar-no group">
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        
            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php if( yiw_layout_page() != 'sidebar-no' && get_post_meta( get_the_ID(), '_show_title_page', true ) == 'no' ): ?>
                    <div class="posts_space"></div>
                <?php endif; ?>
                
                <?php get_template_part( 'loop', 'page' ) ?> 
               <?php /*?>  <?php
	
	$url=network_site_url( '/' ).$_SERVER['REQUEST_URI'];
	
		?>
		<a class="houzz-share-button"
   data-url="<?php echo $url?>"
   data-hzid="demo_hou"
   data-title="<?php $title ?>"
   data-img="http://yoursite/path/to/product/image.jpg "
   data-desc="Product description text "
   data-category="Category keywords "
   data-showcount="1 "
   href="http://www.houzz.com">Houzz</a>
<script>(function(d,s,id){if(!d.getElementById(id)){var js=d.createElement(s);js.id=id;js.async=true;js.src="//platform.houzz.com/js/widgets.js?"+(new Date().getTime());var ss=d.getElementsByTagName(s)[0];ss.parentNode.insertBefore(js,ss);}})(document,"script","houzzwidget-js");</script><?php */?>
		
	
	
	
                <?php comments_template() ?>
            </div>
            <!-- END CONTENT -->
            
            <!-- START SIDEBAR -->
            <?php //get_sidebar() ?>
            <!-- END SIDEBAR -->    
        
        </div>   
                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
       
<?php get_footer() ?>
