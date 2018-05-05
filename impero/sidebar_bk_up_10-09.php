            <?php wp_reset_query() ?>                  
			
            <?php if( yiw_layout_page() != 'sidebar-no' ) : ?>  
		
				<div id="sidebar" class="group 444">
					<?php do_action( 'yiw_before_sidebar' ) ?> 
					<?php do_action( 'yiw_before_sidebar_' . yiw_get_current_pagename() ) ?> 
					
	                <?php 
	                    $sidebar = get_post_meta( get_the_ID(), '_sidebar_choose_page', true );
	                    
	                    if ( is_tax('category-project') )
	                       $sidebar = 'Portfolio Sidebar';
	                    else if ( is_tax('category-photo') )  
	                       $sidebar = 'Gallery Sidebar';
	                       
	                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) )
	                        get_sidebar( 'default' ) 
	                ?>
			
					<?php do_action( 'yiw_after_sidebar' ) ?>       
					<?php do_action( 'yiw_after_sidebar_' . yiw_get_current_pagename() ) ?> 
				
				</div>
            <?php endif ?>