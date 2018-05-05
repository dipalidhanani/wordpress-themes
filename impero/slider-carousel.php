<!-- START SLIDER -->
    <div id="slider">
        <div class="wrapSlider">
             <ul class="scrolling">                                     <li>                         <img src="/wp-content/uploads/2012/09/a1.png"  alt="Stunning Travertine" />                                                                            <div class="caption">                                  <h2>Stunning Travertine</h2>                                                         </div>                                             </li>                                     <li>                         <img src="/wp-content/uploads/2012/09/b.png"  alt="Luxury Living" />                                                                            <div class="caption">                                  <h2>Luxury Living</h2>                                                         </div>                                             </li>                                     <li>                         <img src="/wp-content/uploads/2012/09/c.png"  alt="Magnificent Sunset" />                                                                            <div class="caption">                                  <h2>Magnificent Sunset</h2>                                                         </div>                                             </li>                                     <li>                         <img src="/wp-content/uploads/2012/09/d.png"  alt="Modern Sophistication" />                                                                            <div class="caption">                                  <h2>Modern Sophistication</h2>                                                         </div>                                             </li>                                     <li>                         <img src="/wp-content/uploads/2012/09/e.png"  alt="Simply Elegant" />                                                                            <div class="caption">                                  <h2>Simply Elegant</h2>                                                         </div>                                             </li>                                     <li>                         <img src="/wp-content/uploads/2012/09/f.png"  alt="The Sky Is The Limit" />                                                                            <div class="caption">                                  <h2>The Sky Is The Limit</h2>                                                         </div>                                             </li>                                     <li>                         <img src="/wp-content/uploads/2012/09/g.png"  alt="Breathtaking Infinity Edge" />                                                                            <div class="caption">                                  <h2>Breathtaking Infinity Edge</h2>                                                         </div>                                             </li>                             </ul>              
            
			<div id="pause-button" class="paused-controls" style="display:none;left: 50%;position: absolute;top: 80%;z-index:2">
                    <a href="javascript:void(0);"  id="paused">
						<img src="<?php echo get_template_directory_uri() . '/images/icons/slider-pause-new.png' ?>" alt="Pause" />
						
					</a>
            </div>
            <div class="opacity left"><span></span></div>
            <div class="opacity right"><span></span></div>
        </div>

    </div>
	
   
<script type="text/javascript">
var $size = jQuery('#slider ul.scrolling li').size();
var carouselObj;
var clickCount = 0;
var isStopped = false;
function mycarousel_initCallback(carousel)
{	
	carouselObj = carousel;
	carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
		jQuery('#pause-button').show();
    }, function() {
		if(!isStopped)
			jQuery('#pause-button').hide();
    });

};

jQuery('#paused').hover(function() {
		jQuery('#pause-button').show();
    }, function() {
		jQuery('#pause-button').hide();
    });

jQuery('#paused').click(function(){
	if(clickCount % 2 == 0) {
		carouselObj.stopAuto();
		isStopped = true;
	} else {
		carouselObj.startAuto();
		isStopped = false;
	}	
		
	clickCount++;
});
</script>
    <!-- END SLIDER -->
