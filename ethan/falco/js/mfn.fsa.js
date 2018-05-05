/**
 * @Name:		Muffin FSA - Full Screen Accordion
 * @Author:		Muffin Group
 * @WWW:		www.muffingroup.com
 * @Version:	1.0.0
 */

;(function($){

	var defaults = {
		itemsVisible	: 5
	};
	
	$.fn.fullScreenAccordion = function(options){
		
		if(this.length == 0) return this;

		// Support mutltiple elements
		if(this.length > 1){
			this.each(function(){$(this).fullScreenAccordion(options)});
			return this;
		}

		// Create a namespace to be used throughout the plugin
		var fsa = {};
		var el = this;
		
		// Private functions ---------------------------------
		var init = function(){
			fsa.settings = $.extend({}, defaults, options);
			
			// Initializes namespace settings
			el.wrap('<div class="fsa-slider"></div>');
			fsa.slider			= el.parent('.fsa-slider');
			fsa.sliderWrapper	= fsa.slider.children('ul');
			fsa.item 			= fsa.sliderWrapper.children('li');
			
			// Performs all DOM and CSS modifications 
			fsa.slider.prepend('<a class="fsa-control fsa-prev" href="#"></a><a class="fsa-control fsa-next" href="#"></a>');
			fsa.sliderWrapper.addClass('fsa-slider-wrapper');

			// Calculated variables
			fsa.firstVisible	= 0;
			fsa.itemsCount 		= fsa.item.length;
			
			bind();
			setup();
		}
		
		// Bind Click events
		var bind = function(){
			
			// Item Click
			fsa.item.children('.fsa-title').click(function(){		// TODO: replace .fsa-title with sth more common
				itemClick($(this).closest('li'));
			});
			
			// Navigation Click
			fsa.slider.find('.fsa-prev').click(function(e){
				e.preventDefault();
				navPrev();
			});
			
			fsa.slider.find('.fsa-next').click(function(e){
				e.preventDefault();
				navNext();
			});
			
			// Resize Call
			$(window).bind('resize',setup);		
			
			// jQuery.mousewheel Plugin
			fsa.slider.bind('mousewheel', function(e, delta) {
				if(delta > 0) navPrev(); else navNext();
				return false;
			});
			
			// jQuery.touchwipe Plugin
			if( $().touchwipe ){
				fsa.slider.touchwipe({
				     wipeUp: function(){ navPrev(); },
				     wipeDown: function(){ navNext(); },
				     preventDefaultEvents: true
				});
			}
		}
		
		// Calculations and DOM modifications
		var setup = function(){
			
			fsa.windowH			= $(window).height();
			fsa.windowW			= $(window).width();
			fsa.itemH			= fsa.windowH / fsa.settings.itemsVisible;
			
			if( fsa.windowW < 768){
				fsa.itemsActiveH 	= fsa.windowH;
				fsa.itemDisabledH	= 0;
			} else {
				fsa.itemsActiveH 	= ( fsa.settings.itemsVisible - 1 ) * fsa.itemH;
				fsa.itemDisabledH	= ( fsa.windowH - fsa.itemsActiveH ) / ( fsa.settings.itemsVisible - 1 );
			}

			itemClick(fsa.sliderWrapper.children('.active'));
			
			fsa.slider.height( fsa.windowH );
			fsa.item
				.height( fsa.itemH )
				.find('.fsa-title').css('line-height', fsa.itemH + 'px');
			fsa.sliderWrapper.css('top', - fsa.firstVisible * fsa.itemH);
			
		}
		
		// Item Click
		var itemClick = function(item){
			
			if(item.hasClass('active')){
				// clicked on Opened item (Active)
				item.removeClass('active').height(fsa.itemH);
				item.siblings().height(fsa.itemH);
				item.closest('ul').removeClass('focus');
				fsa.sliderWrapper.css('top', - fsa.firstVisible * fsa.itemH);				
			} else {
				// clicked on Closed item
				item.addClass('active').height(fsa.itemsActiveH);
				item.siblings().height(fsa.itemDisabledH).removeClass('active');
				item.closest('ul').addClass('focus');
				fsa.sliderWrapper.css('top', - fsa.firstVisible * fsa.itemDisabledH);			
			}
			
		}
		
		// Navigate Previous
		var navPrev = function(){
			
			if( fsa.firstVisible > 0 ){	
				fsa.firstVisible--;
				fsa.sliderWrapper.css('top', - fsa.firstVisible * fsa.itemH);
			}
			
			if( fsa.sliderWrapper.hasClass('focus') ){
				var itemPrev = fsa.sliderWrapper.children('.active').prev();
				itemClick(itemPrev);
			}
			
		}
		
		// Navigate Next
		var navNext = function(){
			
			if( fsa.firstVisible + fsa.settings.itemsVisible < fsa.itemsCount ){	
				fsa.firstVisible++;
				fsa.sliderWrapper.css('top', - fsa.firstVisible * fsa.itemH);
			}
			
			if( fsa.sliderWrapper.hasClass('focus') ){
				var itemNext = fsa.sliderWrapper.children('.active').next();
				itemClick(itemNext);
			}
			
		}
		
		
		// Public functions ---------------------------------
//		el.functionName = function(){};
		
		init();

		// returns the current jQuery object
		return this;
	}


})( jQuery );