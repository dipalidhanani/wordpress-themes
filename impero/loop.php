       				<?php 
					global $post;
					//echo get_post_meta($post->ID, '_wp_page_template',true).'c=============';
					//echo is_page().'=='.is_front_page().'==='.is_singular();
					$post_ID1 = $post->ID;
					if('blog.php' == get_post_meta($post->ID, '_wp_page_template',true)){?>  
                    
                    <div class="banner"> <img  title="blog" alt="blog" src="<?php bloginfo('stylesheet_directory'); ?>/images/innerimg.jpg" border="0"  /> </div>
                    
                    <?php }?>
                    <div class="clear"></div>
                    <div class="posts">
                    
                   
                  <?php /*?> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/header.jpg" width="300" height="25" alt=""> <?php */?>
                   
                    <?php 
				if(category_description()){
					echo '<div class="bannerlinks1"><div class="head1">'.__('Blog','impero').'</div></div>';
					echo '<p>'.category_description().'</p>';
				}
			?>
                    <?php      
					          
		
		
						global $wp_query, $post, $more, $blog_type;
						
						$tmp_query = $wp_query;
						
						if (have_posts()) : 
                    
                    $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
      
                    
                    <?php /* If this is a category archive */ if (is_category()) { ?>
                 <?php /*?> <h2 class="red-normal"><?php printf(__('Archive for the &#8216;%s&#8217; Category', 'yiw'), single_cat_title('', false)); ?></h2><?php */?>
                    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                 <?php /*?> <h2 class="red-normal"><?php printf(__('Posts Tagged &#8216;%s&#8217;', 'yiw'), single_tag_title('', false) ); ?></h2><?php */?>
                    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                 <?php /*?> <h2 class="red-normal"><?php printf(__('Archive for %s | Daily archive page', 'yiw'), get_the_time(__('F jS, Y', 'yiw'))); ?></h2><?php */?>
                    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <?php /*?>  <h2 class="red-normal"><?php printf(__('Archive for %s | Monthly archive page', 'yiw'), get_the_time(__('F Y', 'yiw'))); ?></h2><?php */?>
                    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <?php /*?>  <h2 class="red-normal"><?php printf(__('Archive for %s | Yearly archive page', 'yiw'), get_the_time(__('Y', 'yiw'))); ?></h2><?php */?>
                    <?php /* If this is a yearly archive */ } elseif (is_search()) { ?>
                <?php /*?>  <h2 class="red-normal"><?php printf( __( 'Search Results for: %s', 'yiw' ), '<span>' . get_search_query() . '</span>' ); ?></h2><?php */?>
                   <?php /* If this is an author archive */ } elseif (is_author()) { ?>               
                 <?php /*?> <h2 class="red-normal"><?php _e('Author Archive', 'yiw'); ?></h2><?php */?>
                    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
             <?php /*?>     <h2 class="red-normal"><?php _e('Blog Archives', 'yiw'); ?></h2>        <?php */?>
                    <?php } else{ ?>
                 <?php /*?> <div class="posts_space"></div>  <?php */?> 
                    <?php }
                        
                        while (have_posts()) : the_post(); 
                        
                        if ( !is_single() ) 
							$more = 0;
                        
                        $title = is_null( the_title( '', '', false ) ) ? __( '(this post has no title)', 'yiw' ) : the_title( '', '', false );
                        
                    ?>        
                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $blog_type); ?>>
                        <?php if( has_post_thumbnail() ): ?>
                            <?php if($blog_type=='big'): ?>
                            
                            <!-- For single psot page conditon by sikandar -->
                            
                            <?php if('blog.php' == get_post_meta($post_ID1, '_wp_page_template',true)){?>  
                            
                             <div class="post_header group">
                                <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                         <div class="blog_articles_post"><div class="head1"><?php echo $title ?></div></div>
                                        <?php else : ?>
                                            <div class="blog_articles_post"><div class="head1"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></div></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    
                                </div>  
                                
                                <?php } ?>  <!-- if end -->
                               
                                <?php 
                                 if('blog.php' != get_post_meta($post_ID1, '_wp_page_template',true)){
								  $cls="blog-class";
								} ?>
                                 
                                <div class="post_content post_data group <?php echo $cls;?>">
                                <?php
								
								the_post_thumbnail('blog_big');
								
								if('blog.php' != get_post_meta($post_ID1, '_wp_page_template',true)){?>  
                                <div class="post_header group">
                                <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                         <div class="blog_articles_post"><div class="head1"><?php echo $title ?></div></div>
                                        <?php else : ?>
                                            <div class="blog_articles_post"><div class="head1"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></div></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    
                                </div>
                                    
                                    <?php 
								}
									 ?>
                                    
                                    
                                    
                                    
                                    
                                    
                                      <div class="p_content">
                                    <?php
                                        if ( is_archive() || is_search() ){
											                                            
                                            the_excerpt();
											?>
                                            <a style="text-align:right;" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a>
                                            <?php
										}else{
                                            the_content(__( yiw_get_option('blog_read_more_text') )); 
										}
                                    ?>
                                    </div>
                                </div>
                                
                             <div class="clear"></div>  
                            <?php else: ?>
                                <div class="post_content group">
                                    <div class="post_header">
                                        <?php the_post_thumbnail('blog_small'); ?>
                                        <div class="post_meta">
                                            <div class="post_date">
                                                <span class="day"><?php the_time('d') ?></span>
                                                <span class="month"><?php the_time('M'); ?></span>
                                                <span class="year"><?php the_time('Y'); ?></span>
                                            </div>
                                         <?php /*?>   <div class="post_comments"><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></div>
                                            <div class="post_twitter"><a href="http://twitter.com?status=<?php echo urlencode(get_the_title() . " " . get_permalink()); ?>"><?php _e( 'Tweet this', 'yiw' ) ?></a></div>
                                            <div class="post_author"><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></div><?php */?>
                                        </div>
                                    </div>
                                    
                                    <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                            <h2><?php echo $title ?></h2>
                                        <?php else : ?>
                                            <h2><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></h2>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                        if ( is_archive() || is_search() ){
                                            the_excerpt();?>
                                            <a style="text-align:right;" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a>
						<?php					
										}else{
                                            the_content(__( yiw_get_option('blog_read_more_text') ));
										}
                                    ?>
                                </div>
                                     
                            <?php endif ?>
                            
                        <?php else: ?>
<!--                       =========================================================================================-->        
                               
                                <div class="post_nothumb post_content group">
                                    <div class="post_meta">
                                        <div class="post_date">
                                            <span class="day"><?php the_time('d') ?></span>
                                            <span class="month"><?php the_time('M'); ?></span>
                                            <span class="year"><?php the_time('Y'); ?></span>
                                        </div>
                                       <?php /*?> <div class="post_comments"><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></div>
                                        <div class="post_twitter"><a href="http://twitter.com?status=<?php echo urlencode(get_the_title() . " " . get_permalink()); ?>"><?php _e( 'Tweet this', 'yiw' ) ?></a></div>
                                        <div class="post_author"><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></div><?php */?>
                                    </div>

                                    <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                           <div class="bannerlinks1"><div class="head1"><?php echo $title ?></div></div>
                                        <?php else : ?>
                                           <div class="bannerlinks1">
                                           <div class="head1"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?>
                                           </a></div></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php
                                        if ( is_archive() || is_search() ){
                                            the_content();?>
											<a style="text-align:right;" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a>
                                     <?php   }else {
                                            the_content(__( yiw_get_option('blog_read_more_text') ));
											
									 }
                                    ?>
                                </div>
                                
 <!--  ==============================================                     =========================================================================================-->
                        <?php endif ?>
                        
                        <div class="post_ group">
                            <?php wp_link_pages(); ?>
   
                            <?php if( is_single() ) edit_post_link( __( 'Edit', 'yiw' ), '<span class="edit-link">', '</span>' ); ?>
    
                            <?php if( is_single() ) the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' ) ?>
                        </div>
                    </div>          
                    
                    <?php 
						endwhile;
						
						else : ?>
						
							<div id="post-0" class="post error404 not-found group">
								<h1 class="entry-title"><?php _e( 'Not Found', 'yiw' ); ?></h1>
								<div class="entry-content">
									<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'yiw' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							</div><!-- #post-0 -->
						
						<?php
						endif;
						 
						$wp_query = $tmp_query;
						wp_reset_postdata();
					?>    
                
                    <?php 
                    if(function_exists('yiw_pagination')) : yiw_pagination(); else : ?> 
            
                        <div class="navigation group">
                            <div class="alignleft"><?php next_posts_link(__('Next &raquo;', 'yiw')) ?></div>
                            <div class="alignright"><?php previous_posts_link(__('&laquo; Back', 'yiw')) ?></div>
                        </div>
                    
                    <?php endif; ?>       
        
                    <?php comments_template(); ?>
                    </div>
                    
                  