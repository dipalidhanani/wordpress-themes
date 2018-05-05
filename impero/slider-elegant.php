<?php 
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0

 
        <!-- START SLIDER -->
        <div id="slider" class="group inner">
            <ul class="group">
                 <?php
                    $slides = yiw_get_slides( 'slider_elegant_slides' );
                     
                    if( is_array( $slides ) AND !empty( $slides ) ) 
                    {
                        $first = TRUE;
                        
                        foreach( $slides as $id => $slide ) :
                            $the_ = yiw_split_title( $slide['slide_title'] );
                            yiw_links_sliders( $link, $link_url, $slide );
                    
                            if( $more_text = yiw_get_option( 'slider_elegant_more_text' ) AND $more_text != '' AND $link ) 
                                $more_text = " <a href=\"$link_url\">" . $more_text . "</a>";
                            else 
                                $more_text = '';
                                
                            $content_slide = stripslashes( $slide['tooltip_content'] . ' ' . $more_text );  
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
                    
                <li class="group">    
                    <div class="slider-featured group">
                    <?php yiw_featured_content( $slide, array(
                             'before' => $a_before,
                             'after' => $a_after,
                             'container' => false,
                             'video_width' => 425,
                             'video_height' => 356
                          ) ) 
                    ?>
                    </div>   
                    <?php if ( $content_slide != '' ) : ?>
                    <div class="slider-caption caption-<?php echo yiw_get_option( 'slider_elegant_caption_position' ) ?>">
                        <!-- TITLE -->
                        <?php yiw_string_( '<h2>' . $a_before, $the_['title'], $a_after . '</h2>' ) ?>
                        <?php yiw_string_( '<h4>', $the_['subtitle'], '</h4>' ) ?>
                        
                        <!-- TEXT -->
                        <?php echo $content_slide ?>
                    </div>
                    <?php endif; ?>
                </li>
                <?php $first = FALSE; endforeach; } ?>
            </ul>
        </div> 
        <!-- END SLIDER --> 
 */
 ?>
 
        <!-- START SLIDER -->
        <div id="slider" class="group inner">
            <ul class="group">
                <?php while( yiw_have_slide() ) : ?>
                    <li class="group">
                        <div class="slider-featured group">
                        <?php yiw_slide_the( 'featured-content', array(
                                 'container' => false,
                                 'video_width' => 439,
                                 'video_height' => 245
                              ) ) 
                        ?> 
                        </div>
                        
                        <?php if( yiw_slide_get( 'content' ) ): ?>
                        <div class="slider-caption caption-<?php echo yiw_get_option( 'slider_elegant_caption_position' ) ?>">
                                <h2><?php yiw_slide_the( 'title' ) ?></h2>
                                <h4><?php yiw_slide_the( 'subtitle' ) ?></h4>
                                <?php yiw_slide_the( 'content' ) ?>
                        </div>
                        <?php endif ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div> 
        <!-- END SLIDER --> 