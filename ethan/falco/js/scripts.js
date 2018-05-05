(function($){

    "use strict";	
	
    /* ---------------------------------------------------------------------------
	 * Sticky header
	 * --------------------------------------------------------------------------- */
    var mfn_header_height = $('#Header').innerHeight();
	function mfn_sticky(){
		if( $('body').hasClass('sticky-header') ){	
			var start_y = mfn_header_height - 50;
			var window_y = $(window).scrollTop();
	
			if( window_y > start_y ){
				if( ! ($('#Header').hasClass('is-sticky'))) {
					$('.header_placeholder').css('margin-top', mfn_header_height);
					$('#Header')
						.addClass('is-sticky')
						.css('top', $('#wpadminbar').innerHeight());
				}
			}
			else {
				if($('#Header').hasClass('is-sticky')) {
					$('.header_placeholder').css('margin-top',0);
					$('#Header').removeClass('is-sticky');
				}
			}
		}
	}

	
	/* ---------------------------------------------------------------------------
	 * $(document).ready
	 * --------------------------------------------------------------------------- */
	$(document).ready(function(){
		
		/* ---------------------------------------------------------------------------
		 * Content sliders
		 * --------------------------------------------------------------------------- */
		new MfnSlider();
		new MfnOfferSlider();
		new MfnPortfolioSlider();
		
		
		/* ---------------------------------------------------------------------------
		 * Widget - Recent Posts
		 * --------------------------------------------------------------------------- */
		$("ul.posts-slider").owlCarousel({
			autoPlay			: 5000,
			goToFirst			: true,
			stopOnHover			: true,
			items				: 1,
			itemsDesktop		: false,
			itemsDesktopSmall	: false,
			itemsTablet			: false,
			itemsMobile			: false,
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Testimonials
		 * --------------------------------------------------------------------------- */
		$('.testimonials ul li:nth-child(2)').addClass('active');		
		$('.testimonials ul.tm-content li').hide();		
		$('.testimonials ul.tm-content li:nth-child(2)').stop(true,true).fadeIn(500);		
		$('.testimonials ul.photos li a').click(function(e){
			e.preventDefault();
			var item = $(this).parent();

			if( item.hasClass('active') ){
				return false;
			}
			
			var id = item.attr('class');
			var parent = item.closest('ul');
			var tmcontent = parent.next('.tm-content');

			parent.find('li.active').removeClass('active');
			item.addClass('active');
			
			tmcontent.find('li.active').removeClass('active').hide();
			tmcontent.find('li.'+id).addClass('active').stop(true,true).fadeIn(500);
		});
		
		
		/* ---------------------------------------------------------------------------
		 * WP Gallery
		 * --------------------------------------------------------------------------- */
		$('.gallery-icon a')
			.attr('rel', 'prettyPhoto[gallery]')
			.append('<div class="mask"><span class="button_image zoom"></span></div>')
			.children('img' )
				.css('height', 'auto')
				.css('width', '100%');
		
		
		/* ---------------------------------------------------------------------------
		 * PrettyPhoto
		 * --------------------------------------------------------------------------- */
		if( $(window).width() >= 768 ){
			$('a[rel^="prettyPhoto"], .prettyphoto').prettyPhoto({
				show_title		: false,
				deeplinking		: false,
				social_tools	: false
			});
		}
				
	
		/* ---------------------------------------------------------------------------
		 * Add classes first/last
		 * --------------------------------------------------------------------------- */
		$(".Recent_comments li:last-child, .Recent_posts li:last-child, .Twitter li:last-child, #Footer .container .column:last-child, .pricing-box .plan-inside ul li:last-child").addClass("last");
		$(".commentlist li li .comment-body:last-child").addClass("last");
		$(".commentlist li .comment-body:last-child").addClass("lastBorder");
		$(".widget ul.menu li:last-child, .widget_links ul li:last-child, .widget_meta ul li:last-child").addClass("last");
	
		// portfolio / blog  -------------------------------------
		$('.portfolio_item.one-second:nth-child(2n+3), .post.one-second:nth-child(2n+3)').css("clear", "both");	
		$('.portfolio_item.one-third:nth-child(3n+4),  .post.one-third:nth-child(3n+4)' ).css("clear", "both");	
		$('.portfolio_item.one-fourth:nth-child(4n+5), .post.one-fourth:nth-child(4n+5)').css("clear", "both");
		
		
		/* ---------------------------------------------------------------------------
		 * Responsive menu
		 * --------------------------------------------------------------------------- */
		$('.responsive-menu-toggle').click(function(e){
			e.preventDefault();
			$(this).toggleClass('active');
			$('#Header #menu').stop(true,true).slideToggle(200);
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Main menu
		 * --------------------------------------------------------------------------- */
		
		// Muffin Menu --------------------------------
		$("#Header #menu > ul").muffingroup_menu({
			addLast		: false,
			animation	: 'toggle'
		});
		
		// Submenu centering --------------------------
		function submenuCenter(){
			$("#Header #menu > ul > li.submenu").each(function(){
				var li_width = $(this).width();
				var ul_width = $(this).children('ul').width();
				var margin = ( li_width - ul_width ) / 2;
				$(this).children('ul').css('margin-left',margin);
			});
		}

		submenuCenter();
		mfn_sticky();

		
		/* ---------------------------------------------------------------------------
		 * Header search
		 * --------------------------------------------------------------------------- */
		$("#Header #searchform .icon").click(function(e){
			e.preventDefault();
			if( $(this).parent().hasClass('focus') ){
				$('#searchform').submit();
			} else {
				$(this).parent().addClass('focus');
			}
		});

		
		/* ---------------------------------------------------------------------------
		 * Header icons expand
		 * --------------------------------------------------------------------------- */
		$("#Header .addons .expand i").click(function(){
			$(this).closest('.expand').toggleClass('focus');
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Popup Contact
		 * --------------------------------------------------------------------------- */
		$("#popup_contact a.ico").click(function(e){
			e.preventDefault();
			$('#popup_contact').toggleClass('focus');
		});
		
		
		/* ---------------------------------------------------------------------------
		 * IE placeholder fix
		 * --------------------------------------------------------------------------- */
		$("[placeholder]").each(function(){
			if( $(this).val() === "" && $(this).attr("placeholder") !== "" ){
				$(this).val($(this).attr("placeholder"));
				$(this).focus(function(){
					if($(this).val() === $(this).attr("placeholder")) { $(this).val(""); }
				});
				$(this).blur(function(){
					if( $(this).val() === "" ) { $(this).val($(this).attr("placeholder")); }
				});
			}
		});
	
		
		/* ---------------------------------------------------------------------------
		 * Tabs
		 * --------------------------------------------------------------------------- */
		$(".jq-tabs").tabs();
		
		
		/* ---------------------------------------------------------------------------
		 * Muffin Accordion & FAQ
		 * --------------------------------------------------------------------------- */
		$(".mfn-acc.open1st .question:first")
			.addClass("active")
			.children(".answer")
				.show();
		
		$(".mfn-acc .question > h5").append('<span class="icon"></span>');
		$(".mfn-acc .question > h5").click(function(){
			if($(this).parent().hasClass("active")) {
				$(this).parent().removeClass("active").children(".answer").slideToggle(200);
			}
			else
			{
				$(this).parents(".mfn-acc").children().each(function() {
					if($(this).hasClass("active")) {
						$(this).removeClass("active").children(".answer").slideToggle(200);
					}
				});
				$(this).parent().addClass("active");
				$(this).next(".answer").slideToggle(200);
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Skills
		 * --------------------------------------------------------------------------- */
		$('.bars_list').waypoint({
			offset		: '100%',
			triggerOnce	: true,
			handler		: function(){
				$(this).addClass('hover');
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Iframe height
		 * --------------------------------------------------------------------------- */		
		function iframeHeight( item, ratio ){
			var itemW = item.width();
			var itemH = itemW * ratio;
			if( itemH < 147 ) itemH = 147;
			item.height(itemH);
		}
		iframeHeight($(".post_wrapper .photo iframe, .section-post-header .photo iframe"),0.43);	// blog - list, single
		iframeHeight($(".single-portfolio .portfolio_photo iframe"),0.66);							// portfolio - single
		iframeHeight($(".offer_wrapper .image iframe"),0.56);										// offer - item
		
		
		/* ---------------------------------------------------------------------------
		 * Portfolio - Full Screen
		 * --------------------------------------------------------------------------- */
		$('.full-screen-accordion').fullScreenAccordion();

		
		/* ---------------------------------------------------------------------------
		 * Portfolio - Hoverdir
		 * --------------------------------------------------------------------------- */
		$('.da-thumbs > li:not(.header_li) > a').each(function(){$(this).hoverdir({
			hoverDelay : 75
		}); });
		
		
		/* ---------------------------------------------------------------------------
		 * Portfolio - Isotope
		 * --------------------------------------------------------------------------- */
		function mfnIsotope(domEl,isoWrapper){
			var filter = domEl.attr('data-rel');
			isoWrapper.isotope({ filter: filter });
			
			domEl.parents('ul').find('li.current-cat').removeClass('current-cat');
			domEl.parent().addClass('current-cat');
		}
		
		$('.portfolio-isotope .categories a').click(function(e){
			e.preventDefault();
			mfnIsotope($(this),$('.portfolio-isotope .Projects_inside_wrapper'));
		});
		
		$('#Projects .categories a').click(function(e){
			e.preventDefault();
			mfnIsotope($(this),$('#Projects .Projects_inside_wrapper'));
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Debouncedresize
		 * --------------------------------------------------------------------------- */
		$(window).bind("debouncedresize", function() {
			iframeHeight($(".post_wrapper .photo iframe, .section-post-header .photo iframe"),0.43);
			iframeHeight($(".single-portfolio .portfolio_photo iframe"),0.66);
			iframeHeight($(".offer_wrapper .image iframe"),0.56);
			
			submenuCenter();
		});
		
	});

	/* ---------------------------------------------------------------------------
	 * $(window).load
	 * --------------------------------------------------------------------------- */
	$(window).load(function(){
		
		/* ---------------------------------------------------------------------------
		 * isotope
		 * --------------------------------------------------------------------------- */
		$('.portfolio-isotope .Projects_inside_wrapper').isotope({
			itemSelector: '.column',
			layoutMode: 'fitRows'
		});
		$('#Projects .Projects_inside_wrapper').isotope({
			itemSelector: '.column',
			layoutMode: 'fitRows'
		});
		
	});
	
	
	/* ---------------------------------------------------------------------------
	 * $(window).scroll
	 * --------------------------------------------------------------------------- */
	$(window).scroll(function(){
		mfn_sticky();
    });
	
	
	/* ---------------------------------------------------------------------------
	 * $(document).mouseup
	 * --------------------------------------------------------------------------- */
	$(document).mouseup(function(e){
		if ($("#Header .addons .expand").has(e.target).length === 0){
			$("#Header .addons .expand").removeClass('focus');
		}
		if ($("#searchform").has(e.target).length === 0){
			$("#searchform").removeClass('focus');
		}
		if ($("#popup_contact").has(e.target).length === 0){
			$("#popup_contact").removeClass('focus');
		}	
	});
	
	
	/* ---------------------------------------------------------------------------
	 * Sliders configuration
	 * --------------------------------------------------------------------------- */
	
	// --- MfnSlider ---------------------------------------------------------
	function mfnSliderChange(slider){
//		$('.swiper-current').text(slider.activeIndex + 1); // if loop: false
		$('.swiper-current').text(slider.activeLoopIndex + 1);
	}
	
	function MfnSlider(){
		var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints || $(document).width() <= 767;	
		var mfn_slider = window.mfn_slider_vertical;
		
		mfn_slider.speed				= 700;
		mfn_slider.loop					= true;
		mfn_slider.mode					= supportsTouch ? 'horizontal' : 'vertical';
		mfn_slider.onSlideChangeEnd		= mfnSliderChange;
			
		var mfnSlider = new Swiper('.swiper-container',mfn_slider);
		
		$('.swiper-prev').click(function(e){
			e.preventDefault();
			mfnSlider.swipePrev();
		});
		$('.swiper-next').click(function(e){
			e.preventDefault();
			mfnSlider.swipeNext();
		});
	}
	
	// --- MfnOfferSlider ---------------------------------------------------------
	function MfnOfferSlider(){
		var mfn_slider_offer = window.mfn_slider_offer;
		
		mfn_slider_offer.autoPlay			= mfn_slider_offer.autoPlay ? mfn_slider_offer.autoPlay : false;
		mfn_slider_offer.goToFirst			= true;
		mfn_slider_offer.stopOnHover		= true;
		mfn_slider_offer.items				= 1;
		mfn_slider_offer.itemsDesktop		= false;
		mfn_slider_offer.itemsDesktopSmall	= false;
		mfn_slider_offer.itemsTablet		= false;
		mfn_slider_offer.itemsMobile		= false;
		
		$("ul.offer-slider").owlCarousel( mfn_slider_offer );
	}
	
	// --- MfnPortfolioSlider ---------------------------------------------------------
	function MfnPortfolioSlider(){
		var mfn_slider_portfolio = window.mfn_slider_portfolio;
		
		mfn_slider_portfolio.autoPlay			= mfn_slider_portfolio.autoPlay ? mfn_slider_portfolio.autoPlay : false;
		mfn_slider_portfolio.goToFirst			= true;
		mfn_slider_portfolio.stopOnHover		= true;
		mfn_slider_portfolio.items				= 2;
		mfn_slider_portfolio.itemsDesktop		= false;
		mfn_slider_portfolio.itemsDesktopSmall	= false;
		mfn_slider_portfolio.itemsTablet		= false;
		mfn_slider_portfolio.itemsMobile		= [767,1];

		$("ul.portfolio-slider").owlCarousel( mfn_slider_portfolio );
	}

})(jQuery);