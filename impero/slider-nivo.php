<?php 
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0


    <!-- START SLIDER -->
    <div class="slider-wrapper theme-default">
        <div class="ribbon"></div>
        <div id="slider" class="nivoSlider">
        <?php 
            $slides = yiw_get_slides( 'slider_nivo_slides' );
            
            if( is_array( $slides ) AND !empty( $slides ) ) 
            {
                $first = TRUE;
                
                foreach( $slides as $id => $slide ) :
                    $the_ = yiw_split_title( $slide['slide_title'] );
                    yiw_links_sliders( $link, $link_url, $slide );
            
                    if( $more_text = yiw_get_option( 'slider_cycle_slides_more_text' ) AND $more_text != '' AND $link )
                        $more_text = " <a href=\"$link_url\">" . $more_text . "</a>";
                    else
                        $more_text = '';
         
                    if( !$first )
                        $class_first = ' style="display:none"';
                    else
                        $class_first = '';
        
                    $a_before = ( $link ) ? '<a href="'.$link_url.'">' : '';
                    $a_after  = ( $link ) ? '</a>' : '';
        ?>

        <?php yiw_featured_content( $slide, array(
                'before' => $a_before,
                'after' => $a_after,
                'container' => false,
                'video_width' => 425,
                'video_height' => 356
            ) ) 
        ?>
        <?php $first = FALSE; endforeach; } ?>
        </div>
    </div>
 */
 ?>
 
    <!-- START SLIDER -->
    <div class="slider-wrapper theme-default">
        <div class="ribbon"></div>
        <div id="slider" class="nivoSlider">
            <?php while( yiw_have_slide() ) : ?>
                        <?php yiw_slide_the( 'featured-content', array(
                                 'container' => false,
                                 'video_width' => 439,
                                 'video_height' => 245
                              ) ) 
                        ?> 
            <?php endwhile; ?>
        </div>
    </div>