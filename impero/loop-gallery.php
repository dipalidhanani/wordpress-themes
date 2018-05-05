
<script type="text/javascript" charset="utf-8">              

	function yiw_lightbox()
	{   
	    jQuery('#portfolio-gallery a.thumb').hover(
	                            
	        function()
	        {
	            jQuery('<a class="zoom">zoom</a>').appendTo(this).css({
					dispay:'block', 
					opacity:0, 
					height:jQuery(this).children('img').height(), 
					width:jQuery(this).children('img').width(),
					'top':jQuery(this).css('padding-top'),
					'left':jQuery(this).css('padding-left'),
					//margin:'26px 16px',
					padding:0}).animate({opacity:0.4}, 500);
	        },
	        
	        function()
	        {           
	            jQuery('.zoom').fadeOut(500, function(){jQuery(this).remove()});
	        }
	    );
	    
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	        slideshow:5000, 
	        autoplay_slideshow:false,
	        show_title:false
	    });
	}

    (function($) {                                     
        
        $.fn.sorted = function(customOptions) {
            var options = {
                reversed: false,
                by: function(a) {
                    return a.text();
                }
            };
    
            $.extend(options, customOptions);
    
            $data = jQuery(this);
            arr = $data.get();
            arr.sort(function(a, b) {
    
                var valA = options.by($(a));
                var valB = options.by($(b));
        
                if (options.reversed) {
                    return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;              
                } else {        
                    return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;  
                }
        
            });
    
            return $(arr);
    
        };
    
    })(jQuery);
    
    jQuery(function($) {
        
        //yiw_lightbox();
    
    
        var read_button = function(class_names) {
            
            var r = {
                selected: false,
                type: 0
            };
            
            for (var i=0; i < class_names.length; i++) {
                
                if (class_names[i].indexOf('selected-') == 0) {
                    r.selected = true;
                }
            
                if (class_names[i].indexOf('segment-') == 0) {
                    r.segment = class_names[i].split('-')[1];
                }
            };
            
            return r;
            
        };
    
        var determine_sort = function($buttons) {
            var $selected = $buttons.parent().filter('[class*="selected-"]');
            return $selected.find('a').attr('data-value');
        };
    
        var determine_kind = function($buttons) {
            var $selected = $buttons.parent().filter('[class*="selected-"]');
            return $selected.find('a').attr('data-value');
        };
    
        var $preferences = {
            duration: 500,
            adjustHeight: 'auto'
        }
    
        var $list = jQuery('.gallery-wrap');
        var $data = $list.clone();
    
        var $controls = jQuery('.portfolio-categories, .gallery-categories');
    
        $controls.each(function(i) {
    
            var $control = jQuery(this);
            var $buttons = $control.find('a');
            var height_list = $list.height();
            
            $('li:first-child', $control).addClass('selected');
    
            $buttons.bind('click', function(e) {
    
                var $button = jQuery(this);
                var $button_container = $button.parent();
                var button_properties = read_button($button_container.attr('class').split(' '));      
                var selected = button_properties.selected;
                var button_segment = button_properties.segment;
    
                if (!selected) {
    
                    $buttons.parent().removeClass();
                    $button_container.addClass('selected selected-' + button_segment).parent().children('li:first-child').addClass('first');
    
                    var sorting_type = determine_sort($controls.eq(1).find('a'));
                    var sorting_kind = determine_kind($controls.eq(0).find('a'));
    
                    if (sorting_kind == 'all') {
                        var $filtered_data = $data.find('li');
                    } else {
                        var $filtered_data = $data.find('li.' + sorting_kind);
                    }
    
                    var $sorted_data = $filtered_data.sorted({
                        by: function(v) {
                            return $(v).find('strong').text().toLowerCase();
                        }
                    });
    
                    $list.quicksand($sorted_data, $preferences, function () {
                            yiw_lightbox();
                            //Cufon.replace('#portfolio-gallery h6');   
                            
                            var current_height = $list.height();       
                            $('.hentry-post').animate( { 'min-height':$list.height() }, 300 );
	
	                       yiw_lightbox();
                            
                            var postsPerRow = ( $('.layout-sidebar-right').length > 0 || $('.layout-sidebar-left').length > 0 ) ? 3 : 4;
                            
                            $('.gallery-wrap li')
                                .removeClass('group')
                                .each(function(i){
                                    $(this).find('div')
                                        //.removeClass('internal_page_item_first') 
                                        .removeClass('internal_page_item_last');
                                    
                                    if( (i % postsPerRow) == 0 ) {
                                        //$(this).addClass('group');
                                        //$(this).find('div').addClass('internal_page_item_first'); 
                                    } else if((i % postsPerRow) == 2) {
                                        $(this).find('div').addClass('internal_page_item_last');
                                    }
                                });
                                
                            $('.gallery-wrap:first').css('height',0);
                            
                    });
        
                }
        
                e.preventDefault();
                
            });
        
        }); 
        
    });


</script>



<div id="portfolio-gallery" class="internal_page_items internal_page_gallery">
    <ul class="gallery-wrap image-grid group">
    <?php    
    global $yiw_mobile;
    
    $args = array(
        'post_type'      => 'bl_gallery',
        'posts_per_page' => -1
    );                                 
                    
    if ( is_tax() )   
       $args = wp_parse_args( $args, $wp_query->query );
       
    $gallery = new WP_Query( $args );

    $postsPerRow = (yiw_layout_page() != 'sidebar-no') ? 3 : 4;
    $i = 0;

    while( $gallery->have_posts() ) : $gallery->the_post(); ?>

        <?php
            $classes = "";
            $terms = get_the_terms( get_the_ID(), 'category-photo' );
            foreach( $terms as $index=>$term) {
                $classes .= " segment-".$index;
            }
        ?>

        <?php $isFirstInRow = ( ++$i==1 | ($i % $postsPerRow) == 1 ) ? 1 : 0; ?>
        <?php $isLastInRow = ( ($i % $postsPerRow) == 0 ) ? 1 : 0; ?>

        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
        <li data-id="id-<?php echo $i; ?>" class="<?php if( ($i % $postsPerRow)==1 ): ?>group<?php endif ?> <?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->slug)) . ' '; } ?>">

            <div class="internal_page_item internal_page_item_gallery <?php echo $classes ?>">
                <a href="<?php echo $image[0] ?>"<?php if ( ! $yiw_mobile->isMobile() ) : ?> rel="prettyPhoto[gallery]"<?php endif; ?> title="<?php the_title() ?>" class="thumb"><?php the_post_thumbnail( 'thumb_home_page', array( 'class' => 'picture' ) ) ?></a>
                <h5><?php the_title() ?></h5>
                <?php the_content() ?>
            </div>


        </li>
    <?php
        endwhile;
        wp_reset_query();
    ?>
    </ul>
    <div class="clear"></div>
</div>



