<?php        
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Home back up
*/



if( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || is_home() && get_option( 'page_for_posts' ) != '0' ) {
    $blog_type = yiw_get_option('blog_type');
    get_template_part( 'blog' ); 
    die;
}

get_header() ?>  

        <div class="layout-<?php echo $layout_page_type = yiw_layout_page() ?>">

            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>

            <div id="slogan">

                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        
            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php 
                    if ( is_home() )
                        get_template_part( 'loop', 'index' ); 
                    else
                        get_template_part( 'loop', 'page' ); 
                ?>
                
                <!-- services -->
                <div class="home_page_items home_page_services group">
    <h3>Services</h3>
    <h4></h4>
    
                            <div class="home_page_item home_page_item_service home_page_item_service_914 home_page_item_first">
            <a href="/service/pools/" title="Pools"><img width="168" height="137" src="/wp-content/uploads/2012/09/pools.png" class="picture wp-post-image" alt="pools" title="pools" /></a>
            <h5><a href="/service/pools/" title="Pools">Pools</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_1205 ">
            <a href="/service/spas/" title="Spas"><img width="168" height="137" src="/wp-content/uploads/2012/09/spa.png" class="picture wp-post-image" alt="spa" title="spa" /></a>
            <h5><a href="/service/spas/" title="Spas">Spas</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_902 home_page_item_last">
            <a href="/service/hardscapes/" title="Hardscapes"><img width="168" height="137" src="/wp-content/uploads/2012/09/hardscape.png" class="picture wp-post-image" alt="hardscape" title="hardscape" /></a>
            <h5><a href="/service/hardscapes/" title="Hardscapes">Hardscapes</a></h5>
                        
                    </div>
        <div class="clear"></div>                            <div class="home_page_item home_page_item_service home_page_item_service_910 home_page_item_first">
            <a href="/service/bbqs-out-door-kitchens/" title="BBQ’s / Out door Kitchens"><img width="168" height="137" src="/wp-content/uploads/2012/09/BBQout-door-Kitchens.jpg" class="picture wp-post-image" alt="BBQout-door-Kitchens" title="BBQout-door-Kitchens" /></a>
            <h5><a href="/service/bbqs-out-door-kitchens/" title="BBQ’s / Out door Kitchens">BBQ’s / Out door Kitchens</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_1206 ">
            <a href="/service/remodeling/" title="Remodeling"><img width="168" height="137" src="/wp-content/uploads/2012/09/remodel.png" class="picture wp-post-image" alt="remodel" title="remodel" /></a>
            <h5><a href="/service/remodeling/" title="Remodeling">Remodeling</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_906 home_page_item_last">
            <a href="/service/decks-2/" title="Decks"><img width="168" height="137" src="/wp-content/uploads/2012/09/decks.png" class="picture wp-post-image" alt="decks" title="decks" /></a>
            <h5><a href="/service/decks-2/" title="Decks">Decks</a></h5>
                        
                    </div>
        <div class="clear"></div>                            <div class="home_page_item home_page_item_service home_page_item_service_900 home_page_item_first">
            <a href="/service/patio-covers-and-arbors/" title="Patio / Arbors / Loggias"><img width="168" height="137" src="/wp-content/uploads/2012/09/Patio-Covers-and-Arbors.jpg" class="picture wp-post-image" alt="Patio-Covers-and-Arbors" title="Patio-Covers-and-Arbors" /></a>
            <h5><a href="/service/patio-covers-and-arbors/" title="Patio / Arbors / Loggias">Patio / Arbors / Loggias</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_904 ">
            <a href="/service/fireplaces/" title="Fireplaces"><img width="168" height="137" src="/wp-content/uploads/2012/09/Fireplaces.jpg" class="picture wp-post-image" alt="Fireplaces" title="Fireplaces" /></a>
            <h5><a href="/service/fireplaces/" title="Fireplaces">Fireplaces</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_896 home_page_item_last">
            <a href="/service/entries/" title="Entries"><img width="168" height="137" src="/wp-content/uploads/2012/09/entries.png" class="picture wp-post-image" alt="entries" title="entries" /></a>
            <h5><a href="/service/entries/" title="Entries">Entries</a></h5>
                        
                    </div>
        <div class="clear"></div>                            <div class="home_page_item home_page_item_service home_page_item_service_894 home_page_item_first">
            <a href="/service/firepits-and-firebowls/" title="Fire Features"><img width="168" height="137" src="/wp-content/uploads/2012/09/firefeatire.png" class="picture wp-post-image" alt="firefeatire" title="firefeatire" /></a>
            <h5><a href="/service/firepits-and-firebowls/" title="Fire Features">Fire Features</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_908 ">
            <a href="/service/decorative-concrete/" title="Decorative Concrete / Pavers"><img width="168" height="137" src="/wp-content/uploads/2012/09/decorative.png" class="picture wp-post-image" alt="decorative" title="decorative" /></a>
            <h5><a href="/service/decorative-concrete/" title="Decorative Concrete / Pavers">Decorative Concrete / Pavers</a></h5>
                        
                    </div>
                                    <div class="home_page_item home_page_item_service home_page_item_service_912 home_page_item_last">
            <a href="/service/landscape/" title="Landscape"><img width="168" height="137" src="/wp-content/uploads/2012/09/landscape.png" class="picture wp-post-image" alt="landscape" title="landscape" /></a>
            <h5><a href="/service/landscape/" title="Landscape">Landscape</a></h5>
                        
                    </div>
        <div class="clear"></div>    
</div>
                <!-- /services -->

                <!-- portfolio -->
                <?php if( yiw_get_option('portfolio_show_home_page') ): ?>
                <?php get_template_part( 'home', 'portfolio' ); ?>
                <?php endif ?>
                <!-- /portfolio -->

                <!-- gallery -->
                <?php if( yiw_get_option('gallery_show_home_page') ): ?>
                <?php get_template_part( 'home', 'gallery' ); ?>
                <?php endif ?>
                <!-- /services -->

                <!-- blog -->
                <?php if( yiw_get_option('blog_show_home_page') ): ?>
                <?php get_template_part( 'home', 'blog' ); ?>
                <?php endif ?>
                <!-- /blog -->

            </div>
            <!-- END CONTENT -->
            
            <!-- START LATEST NEWS -->
            <?php get_sidebar() ?>
            <!-- END LATEST NEWS -->   
        
        </div>      
        
<?php get_footer() ?>

