            <?php wp_reset_query() ?>                  

            

            <?php if( yiw_layout_page() != 'sidebar-no' ) : ?>  

        

                <?php /*?><div id="sidebar" class="group">

                    <?php do_action( 'yiw_before_sidebar' ) ?> 

                    <?php do_action( 'yiw_before_sidebar_' . yiw_get_current_pagename() ) ?> 

                    

                    <?php 

                        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'News Sidebar' ) )

                            get_sidebar( 'default' ) 

                    ?>

            

                    <?php do_action( 'yiw_after_sidebar' ) ?>       

                    <?php do_action( 'yiw_after_sidebar_' . yiw_get_current_pagename() ) ?> 

                </div><?php */?>

                

            <?php endif ?>