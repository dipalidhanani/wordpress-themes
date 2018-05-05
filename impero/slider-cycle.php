<?php 
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0

 
        <!-- START SLIDER -->
        <div id="slider" class="group inner">
                
                <div class="images">
                    <?php 
                        $slides = yiw_get_slides( 'slider_cycle_slides' );
                        
                        if( is_array( $slides ) AND !empty( $slides ) ) 
                        {
                            $first = TRUE;
                            
                            foreach( $slides as $id => $slide ) :
                                $the_ = yiw_split_title( $slide['slide_title'] );
                                yiw_links_sliders( $link, $link_url, $slide );
                        
                                if( $more_text = yiw_get_option( 'slider_cycle_show_more_text' ) AND $more_text != '' AND $link )
                                    $more_text = " <a href=\"$link_url\" class='read-more'>" . yiw_get_option( 'slider_cycle_more_text' ) . "</a>";
                                else
                                    $more_text = '';
     
                                $content_slide = stripslashes( $slide['tooltip_content'] );
                                $content_slide = do_shortcode($content_slide);
                                $content_slide = apply_filters('the_content', $content_slide);
                                $content_slide = str_replace(']]>', ']]&gt;', $content_slide);
                                
                                if( !$first )
                                    $class_first = ' style="display:none"';
                                else
                                    $class_first = '';
    
                                $a_before = ( $link ) ? '<a href="'.$link_url.'">' : '';
                                $a_after  = ( $link ) ? '</a>' : '';
                    ?>
                    <!-- START PANEL -->
                    <div class="panel<?php if( $first ) echo ' first' ?>">
                        <?php yiw_featured_content( $slide, array(
                                 'before' => $a_before,
                                 'after' => $a_after,
                                 'container' => false,
                                 'video_width' => 439,
                                 'video_height' => 245
                              ) ) 
                        ?>                        
                        <div class="hentry">
                            <?php yiw_string_( '<h2>' . $a_before, $the_['title'], $a_after . '</h2>' ) ?>
                                                                                       
                            <?php echo $content_slide . $more_text ?>
                        </div>
                    </div>
                    <!-- END PANEL -->
                    <?php $first = FALSE; endforeach; } ?>
                </div>
                
                <!-- START PAGINATION -->
                <div class="controls">
                    <a href="#" title="Pause" id="slider-pause"><img src="<?php echo get_template_directory_uri() . '/images/icons/slider-pause.png' ?>" alt="Pause" /></a>
                    <a href="#" title="Play" id="slider-play"><img src="<?php echo get_template_directory_uri() . '/images/icons/slider-play.png' ?>" alt="Play" /></a> 
                </div>
                <div class="pagination"></div>
                <!-- END PAGINATION -->  
                


        </div> 
        <!-- END SLIDER --> 
 */
 ?>
 

        <div id="slider" class="cycle group inner">
                
                <div class="images">
                    <?php while( yiw_have_slide() ) : ?>
                    <!-- START PANEL -->
                    <div<?php yiw_slide_class( 'panel' ) ?>>
                        <?php yiw_slide_the( 'featured-content', array(
                                 'container' => false,
                                 'video_width' => 439,
                                 'video_height' => 245
                              ) ) ?>                        
                        <div class="hentry">
                            <h2><?php yiw_slide_the( 'title' ) ?></h2>
                                                                                       
                            <?php yiw_slide_the( 'content' ) ?>
                        </div>
                    </div>
                    <!-- END PANEL -->
                    <?php endwhile; ?>
                </div> 

                <!-- START PAGINATION -->
                <div class="controls">
                    <a href="#" title="Pause" id="slider-pause"><img src="<?php echo get_template_directory_uri() . '/images/icons/slider-pause.png' ?>" alt="Pause" /></a>
                    <a href="#" title="Play" id="slider-play"><img src="<?php echo get_template_directory_uri() . '/images/icons/slider-play.png' ?>" alt="Play" /></a> 
                </div>
                <div class="pagination"></div>
                <!-- END PAGINATION -->  
        </div> 