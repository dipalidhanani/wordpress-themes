                <div id="portfolio-bigimage">         

                    <?php
                        global $paged;
                        $args = array(
                            'post_type' => 'bl_portfolio',
                            'posts_per_page' => yiw_get_option('portfolio_items'),
                            'paged' => $paged
                        );

                        $portfolio = new WP_Query( $args );
                        $i = 1;
                        while( $portfolio->have_posts() ) : $portfolio->the_post();  
                            global $more;
                            $more = 0;
                    ?>     

                    <div <?php post_class( 'work group' ) ?>>
                        <?php   
                            if( $thumb = get_post_meta(get_the_ID(), '_portfolio_video', true) )
                            {
                                $class = 'video';
                            }
                            else
                            {
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                                $thumb = $thumb[0];
                                $class = 'img';
                            }
                            
                            $date_format  = yiw_get_option('portfolio_date_format','F j, Y');
                            $skills_label = get_post_meta(get_the_ID(), '_portfolio_skills_label', true) ? get_post_meta(get_the_ID(), '_portfolio_skills_label', true) : __('Skills');
                            $skills       = get_post_meta(get_the_ID(), '_portfolio_skills', true);
                            $date_label   = get_post_meta(get_the_ID(), '_portfolio_date_label', true) ? get_post_meta(get_the_ID(), '_portfolio_date_label', true) : __('Date');
                        ?>

                        <?php if( has_post_thumbnail() ) : ?>
                        <div class="work-thumbnail">
                            <?php the_post_thumbnail('thumb_portfolio_big') ?>                            
                            <?php /*
                            <div class="work-skillsdate">
                                <?php if( $skills ): ?><p class="skills"><span class="label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                                <p class="workdate"><span class="label"><?php echo $date_label ?>: </span><?php echo the_date($date_format) ?></p>
                            </div>
							<?php */ ?>
                        </div>

                        <?php endif ?>  

                        <div class="work-description">
                            <h3><?php the_title() ?></h3>
                            <?php echo yiw_content(25, yiw_get_option('portfolio_more_text')) ?>
                        </div>
                        <div class="clear"></div>
                    </div>                         
                    <?php endwhile ?>        

                </div>                          

                <?php if(function_exists('yiw_pagination')) : yiw_pagination( $portfolio->max_num_pages ); else : ?> 
                    <div class="navigation">
                        <div class="alignleft"><?php next_posts_link(__('Next &raquo;', 'yiw')) ?></div>
                        <div class="alignright"><?php previous_posts_link(__('&laquo; Back', 'yiw')) ?></div>
                    </div>
                <?php endif; ?>  

                <div class="clear"></div>