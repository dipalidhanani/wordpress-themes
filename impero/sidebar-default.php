            <div class="group test">			
                <div class="widget">            
                    <h2><?php _e( 'Search', 'yiw' ) ?></h2>
                    <?php get_search_form() ?>
                </div>
                
                <div class="widget">
                    <h2><?php _e( 'Archives', 'yiw' ) ?></h2>
                    <ul>
                        <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
                    </ul>
                </div>
                
                <div class="widget">
                    <h2><?php _e( 'Categories', 'yiw' ) ?></h2>
                    <ul>
                        <?php 
                			$cat_params = Array(
                					'hide_empty'	=>	FALSE,
                					'title_li'		=>	''
                				);
                			if( strlen( trim( yiw_get_option( 'blog_cats_exclude_2' ) ) ) > 0 ){
                				$cat_params['exclude'] = trim( yiw_get_option( 'blog_cats_exclude_2' ) );
                			}
                			wp_list_categories( $cat_params ); 
                        ?>
                    </ul>
                </div>
                
                <div class="widget">
                    <h2><?php _e( 'Blogroll', 'yiw' ) ?></h2>
                    <ul>
                        <?php wp_list_bookmarks( 'title_li=&categorize=0' ) ?>
                    </ul>
                </div>
           </div>