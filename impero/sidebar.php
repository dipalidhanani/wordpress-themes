         <?php /*?>   <?php wp_reset_query() ?>                  
			
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
				<div class="contact-form">
                <h2> Contact-US </h2>
                <?php echo do_shortcode('[contact-form-7 id="2008" title="Contact form 1"]'); ?>  
                </div>
				</div>
            <?php endif ?><?php */?>
			 <div class="menus">
     <div class="heading"></div>    
     
           
	       <?php  
					$nav_args = array(
	                    'theme_location' => 'nav',
	                    'container' => 'none',
	                    'menu_class' => 'level-1',
	                    'depth' => 3,   
	                    //'fallback_fb' => false,
	                    //'walker' => new description_walker()
	                );
	                
	                wp_nav_menu( $nav_args ); 
	            ?>    
	       
	        <!-- END NAV -->  
              <div class="icons">
           <ul>
             <li><a href="#" onClick="window.open('http://www.houzz.com/pro/salmonfallsnurseryandlandscaping');"><img src="<?php echo get_template_directory_uri()?>/images/icon1.png" /></a></li>
             <li><a href="#" onClick="window.open('https://www.facebook.com/salmonfallsnurserylandscaping');"><img src="<?php echo get_template_directory_uri()?>/images/icon2.png" /></a></li>
             <li><a href="#" onClick="window.open('https://plus.google.com/117679288784781061170/posts');"><img src="<?php echo get_template_directory_uri()?>/images/icon3.png" /></a></li>
             <li><a href="#" onClick="window.open('https://twitter.com/SalmonFallsNL');"><img src="<?php echo get_template_directory_uri()?>/images/icon4.png" /></a></li>
             <li><a href="mailto:info@salmonfallsnursery.com"><img src="<?php echo get_template_directory_uri()?>/images/icon5.png" /></a></li>
           </ul>
        
      </div> 
         
  	 <div class="clear"></div>  
     </div>