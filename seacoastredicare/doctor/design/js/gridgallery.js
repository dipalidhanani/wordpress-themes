/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


(function($){

	var GridGallery;

	// We must allways specify radix (see http://goo.gl/GgubB),
	// but its annoying to write it allways, so we creates shortcut
	var toInt = function(string){ return parseInt(string, 10); };

	var $gridgallery;



	GridGallery = {


		/**
		 * Init (a.k.a. constructor)
		 */
		init: function(){

			$gridgallery = $('.gridgallery');

			GridGallery.shortcode();

			if($('.portfolio').hasClass('item-direct'))
				GridGallery.directLink();

			else if($('.portfolio').hasClass('item-fancybox'))
				GridGallery.itemFancybox();

			else
				GridGallery.showTile();


			GridGallery.quicksand();

			GridGallery.categorySlider();

			GridGallery.portCatShow();

			GridGallery.tileHover();

		},



		/**
		 * Shortcode
		 */
		shortcode: function(){
			var contWidth = $('.gridgallery').parent().width();
			var tileMargin = 15;
			var tileBorder = 4;
			var tileRowNum = 5;
			var tileCount = 0;
			var origPict = "";
			var origSize;
			var rowsCount;
			var descHeight = 0;
			var descMarginBottom = 0;
			var superDescHeight = 0;

			if($('.gridgallery').hasClass('five')) tileRowNum = 5;
			else if($('.gridgallery').hasClass('four')) tileRowNum = 4;
			else if($('.gridgallery').hasClass('three')) tileRowNum = 3;

			var tileHeight = $("#gridgallery-setting-height").html();
			var tileWidth = toInt((contWidth - (tileRowNum * (tileMargin + 2 + (tileBorder * 2)))) / tileRowNum) + toInt(tileMargin / tileRowNum);

			$('.gridgallery .ulHolder').css({
				'background': 'none'
			});

			var tileCounter = 1;
			var rowCounter = 1;
			var tileCounterSmall = 1;
			var rowCounterSmall = 1;
			var tileCountGlobal = 0;

			$('.gridgallery .ulHolder .ourHolder .item').each(function () {
				tileCountGlobal++;
			});

			rowCount = Math.ceil(tileCountGlobal / tileRowNum);

			$('.gridgallery .ulHolder .ourHolder .item').each(function () {
				var editImage;
				var currTile = $(this).children('.tile').children('.tileWrap');
				var currImage = currTile.html();

				if(currImage == null) currImage = '';

				if(tileHeight == 'auto') {
					editImage = currImage.replace('w=1', "w=" + tileWidth).replace('h=1', "h=" + tileWidth);
					currTile.html('<img src="' + editImage + '" width="' + tileWidth + '" height="' + tileWidth + '" alt="tile" />');
				} else {
					editImage = currImage.replace('w=1', "w=" + tileWidth).replace('h=1', "h=" + toInt(tileHeight));
					currTile.html('<img src="' + editImage + '" width="' + tileWidth + '" height="' + tileHeight + '" alt="tile" />');
				}

				$(this).children('.tile').width(tileWidth);
				$(this).children('.tile').css({
					'display': 'block'
				});
				$(this).children('.tile-desc-wrap').children('.tile-desc').width(tileWidth);
				$(this).children('.tile-desc-wrap').children('.tile-desc').css({
					'margin-left': tileMargin + tileBorder + 'px'
				});
				$(this).children('.tile-desc-wrap').children('.tile-desc').css({
					'margin-bottom': descMarginBottom + 'px'
				});

				if($(this).children().size() > 1) {
					descHeight = toInt($(this).children('.tile-desc-wrap').children('.tile-desc').css('height'));
					descMarginBottom = 10;
					if(superDescHeight === 0) {
						superDescHeight = descHeight;
					}
					$(this).children('.tile-desc-wrap').height(superDescHeight);
					$(this).children('.tile-desc-wrap').children('.tile-desc').height(superDescHeight);
				}

				if(tileHeight == 'auto') {
					$(this).children('.tile').height(tileWidth);
					$(this).children('.tile').parent().height(toInt(tileWidth) + superDescHeight + descMarginBottom + tileBorder * 2 + tileMargin);
				} else {
					$(this).children('.tile').height(toInt(tileHeight));
					$(this).children('.tile').parent().height(toInt(tileHeight) + superDescHeight + descMarginBottom + tileBorder * 2 + tileMargin);
				}

				// children
				currChildTile = $(this).children('.tile').children('.gridgallery-icon').children();

				if($('.portfolio').hasClass('item-fancybox')) {} else {
					if(tileHeight == 'auto') {
						parsedWidth = toInt((tileWidth * 2) + tileMargin + (tileBorder * 2) + 4);
						editImage = currImage.replace('w=1', "w=" + parsedWidth).replace('h=1', "h=" + toInt(parsedWidth + (descHeight * 2) + (descMarginBottom * 2)));
						editImage = editImage.replace(/&amp;/g, "&");
						currChildTile.css({
							'background': 'url(\'' + editImage + '\') no-repeat center center'
						});
					} else {
						editImage = currImage.replace('w=1', "w=" + ((tileWidth * 2) + tileMargin + (tileBorder * 2) + 4)).replace('h=1', "h=" + ((toInt(tileHeight) * 2) + tileMargin + (tileBorder * 4) + (descHeight * 2) + (descMarginBottom * 2)));
						editImage = editImage.replace(/&amp;/g, "&");
						currChildTile.css({
							'background': 'url(\'' + editImage + '\') no-repeat center center'
						});
					}
				}
				currChildTileWidth = toInt(((tileWidth * 2) + tileMargin + (tileBorder * 2) + 4));
				currChildTile.width(currChildTileWidth);

				if(tileHeight == 'auto') {
					currChildTile.height(((tileWidth * 2) + tileMargin + (tileBorder * 2) + tileBorder + tileMargin));
				} else {
					currChildTile.height(((toInt(tileHeight) * 2) + tileMargin + (tileBorder * 2) + (descHeight * 2) + (descMarginBottom * 2) + tileBorder + tileMargin));
				}

				if(rowCounter == 1) {
					// first row
					if(tileCounter == 1) {
						// first row | first tile
						if(tileHeight == 'auto') {
							currChildTile.css({
								'top': '-' + tileBorder + 'px',
								'left': '-' + tileBorder + 'px',
								'bottom': '0px',
								'right': '0px',
								'margin-left': '0px'
							});
						} else {
							currChildTile.css({
								'top': '-' + tileBorder + 'px',
								'left': '-' + tileBorder + 'px',
								'bottom': '0px',
								'right': '0px',
								'margin-left': '0px'
							});
						}
					} else if(tileCounter == tileRowNum) {
						// first row | last tile
						if(tileHeight == 'auto') {
							currChildTile.css({
								'left': '-' + (2 + tileWidth + tileMargin + tileBorder * 3) + 'px',
								'right': '0px',
								'top': '-' + tileBorder + 'px',
								'margin-left': '0px'
							});
						} else {
							currChildTile.css({
								'left': '-' + (2 + tileWidth + tileMargin + tileBorder * 3) + 'px',
								'right': '0px',
								'top': '-' + tileBorder + 'px',
								'margin-left': '0px'
							});
						}
						tileCounter = 0;
						rowCounter++;
					} else {
						// first row | tiles between first and last
						currChildTile.css({
							'top': '-' + tileBorder + 'px',
							'left': '-' + tileBorder + 'px',
							'bottom': '0px',
							'margin-left': '0px'
						});
					}
				} else if(rowCounter == (rowCount)) {
					// last row
					if(tileCounter == 1) {
						// last row | first tile
						if(tileHeight == 'auto') {
							currChildTile.css({
								'top': '-' + (tileWidth + tileMargin + tileBorder * 2 + 4 + descHeight + descMarginBottom) + 'px',
								'left': '-' + tileBorder + 'px',
								'bottom': '0px',
								'right': '0px',
								'margin-left': '0px'
							});
						} else {
							currChildTile.css({
								'top': '-' + (toInt(tileHeight) + tileMargin + tileBorder * 2 + 4 + descHeight + descMarginBottom) + 'px',
								'left': '-' + tileBorder + 'px',
								'bottom': '0px',
								'right': '0px',
								'margin-left': '0px'
							});
						}
					} else if(tileCounter == tileRowNum) {
						// last row | last tile
						if(tileHeight == 'auto') {
							currChildTile.css({
								'top': '-' + (tileWidth + tileMargin + tileBorder * 2 + 4 + descHeight + descMarginBottom) + 'px',
								'bottom': '0px',
								'left': '-' + (2 + tileWidth + tileMargin + tileBorder * 3) + 'px',
								'right': '0px',
								'margin-left': '0px'
							});
						} else {
							currChildTile.css({
								'top': '-' + (toInt(tileHeight) + tileMargin + tileBorder * 2 + 4 + descHeight + descMarginBottom) + 'px',
								'bottom': '0px',
								'left': '-' + (2 + tileWidth + tileMargin + tileBorder * 3) + 'px',
								'right': '0px',
								'margin-left': '0px'
							});
						}
						tileCounter = 0;
						rowCounter++;
					} else {
						// last row | tiles between first and last
						if(tileHeight == 'auto') {
							currChildTile.css({
								'top': '-' + (tileWidth + tileMargin + tileBorder * 2 + 4 + descHeight + descMarginBottom) + 'px',
								'left': '-' + tileBorder + 'px',
								'bottom': '0px',
								'margin-left': '0px'
							});
						} else {
							currChildTile.css({
								'top': '-' + (toInt(tileHeight) + tileMargin + tileBorder * 2 + 4 + descHeight + descMarginBottom) + 'px',
								'left': '-' + tileBorder + 'px',
								'bottom': '0px',
								'margin-left': '0px'
							});
						}
					}
				} else {
					// rows between first and last
					if(tileCounter == 1) {
						// rows between first and last | first tile
						currChildTile.css({
							'top': '-' + tileBorder + 'px',
							'left': '-' + tileBorder + 'px',
							'bottom': '0px',
							'right': '0px',
							'margin-left': '0px'
						});
					} else if(tileCounter == tileRowNum) {
						// rows between first and last | last tile
						if(tileHeight == 'auto') {
							currChildTile.css({
								'left': '-' + (tileWidth + tileMargin + tileBorder * 3) + 'px',
								'right': '0px',
								'top': '-' + tileBorder + 'px',
								'margin-left': '0px'
							});
						} else {
							currChildTile.css({
								'left': '-' + (tileWidth + tileMargin + tileBorder * 3) + 'px',
								'right': '0px',
								'top': '-' + tileBorder + 'px',
								'margin-left': '0px'
							});
						}
						tileCounter = 0;
						rowCounter++;
					} else {
						// rows between first and last | tiles between first and last
						currChildTile.css({
							'top': '-' + tileBorder + 'px',
							'left': '-' + tileBorder + 'px',
							'bottom': '0px',
							'margin-left': '0px'
						});
					}
				}
				tileCount++;
				tileCounter++;
			});
			$('.gridgallery').width(contWidth + 1); // width fix

			if(tileHeight == 'auto') {
				$('.gridgallery .ulHolder .ourHolder').height(((tileWidth + tileMargin + descHeight + descMarginBottom) * rowCount + (tileBorder * 2)) + (tileMargin * 2) + (tileBorder * 2));
				$('.gridgallery .ulHolder').height(((tileWidth + tileMargin + (tileBorder * 2) + descHeight + descMarginBottom) * rowCount) + (tileMargin * 2) + (tileBorder * 2));
				$('.gridgallery .portfolioHolder').css({
					'margin-left': '-' + tileMargin + 'px'
				});
			} else {
				$('.gridgallery .ulHolder .ourHolder').height(((toInt(tileHeight) + tileMargin + descHeight + descMarginBottom) * rowCount + (tileBorder * 2)) + (tileMargin * 2) + (tileBorder * 2));
				$('.gridgallery .ulHolder').height(((toInt(tileHeight) + tileMargin + (tileBorder * 2) + descHeight + descMarginBottom) * rowCount) + (tileMargin * 2) + (tileBorder * 2));
				$('.gridgallery .portfolioHolder').css({
					'margin-left': '-' + tileMargin + 'px'
				});
			}
			$('.gridgallery #portfolio-loader').fadeOut('fast');
			$('.gridgallery #filterOptions').css({
				'visibility': 'visible'
			});
			$('.gridgallery .port-cat').css({
				'visibility': 'visible'
			});
			$('.gridgallery .ulHolder').css({
				'visibility': 'visible'
			});
		},



		quicksand: function(){
			// get the action filter option item on page load
			var $filterType = $('#filterOptions li.active a').attr('class');
			var $filteredData;

			// get and assign the ourHolder element to the
			// $holder varible for use later
			var $holder = $('ul.ourHolder');

			// clone all items within the pre-assigned $holder element
			var $data = $holder.clone();

			// attempt to call Quicksand when a filter option
			// item is clicked
			$('#filterOptions li a').click(function (e) {
				// reset the active class on all the buttons
				$('#filterOptions li').removeClass('active');

				// assign the class of the clicked filter option
				// element to our $filterType variable
				$filterType = $(this).attr('class');
				$(this).parent().addClass('active');

				if($filterType == 'all') {
					// assign all li items to the $filteredData var when
					// the 'All' filter option is clicked
					$filteredData = $data.find('li');
				} else {
					// find all li elements that have our required $filterType
					// values for the data-type element
					$filteredData = $data.find('li[class~=' + $filterType + ']');

				}

				// call quicksand and assign transition parameters
				$holder.quicksand($filteredData, {
					duration: 800,
					easing: 'jswing'
				}, function () {
					GridGallery.refresh();
					GridGallery.initTile();
					GridGallery.tileHover();

					if($('.portfolio').hasClass('item-direct')) {
						GridGallery.directLink();
					} else if($('.portfolio').hasClass('item-fancybox')) {
						GridGallery.itemFancybox();
					} else {
						GridGallery.showTile();
					}
				});

				return false;
			});
		},


		/**
		 * Init tile
		 */
		initTile: function(){
			if($('#header-container').css('display') == 'none'){
				$('#header-container').remove();
			}

			$('.tile').each(function(){
				$(this).removeClass('endLine corner goRight');
			});

			var counter = 0;

			if($('.portfolio').hasClass('five')) counter = 5;
			if($('.portfolio').hasClass('four')) counter = 4;
			if($('.portfolio').hasClass('three')) counter = 3;

			var sizeOfRows = Math.ceil(($('.tile').size())/(counter));

			var c = 0;

			$('.tile').each( function() {
				c++;
				if((c) == counter){
					$(this).addClass('goRight');
					c = 0;
				}
			});

			var fullRow = sizeOfRows - 1;

			var n;

			for(n = 0; n <= $('.tile').length; n++){
				if(n >= (counter * fullRow)){
					if(fullRow !== 0) {
						$('.tile').eq(n).addClass('endLine');
					}
				}

				if(n == ($('.tile').length - 1) && n != counter * fullRow ) {
					$('.tile').eq(n).addClass('corner').removeClass('goRight');
				}

				if(n == ($('.tile').length - 1) && fullRow === 0) {
					$('.tile').eq(n).addClass('goRight').removeClass('corner');
				}
			}

			if($('.tile').length == 1){
				$('.tile').removeClass('corner').removeClass('goRight').removeClass('endLine');
			}
		},



		/**
		 * Show tile
		 * @return {[type]} [description]
		 */
		showTile: function (){
			var tileMargin = 15;
			var tileBorder = 4;
			var descHeight = 0;
			var descMarginBottom = 0;

			if($('.item').children('.tile-desc')) {
				descHeight = toInt($('.item').children('.tile-desc').css('height'));
				descMarginBottom = 10;
			}

			$('span').click(function () {
				$('.tile').unbind('mouseleave');
				var cat = $(this).attr('class');
				$('.portfolio .tile').each(function () {
					$(this).children().children('.bbox').css('opacity', '0');
					if(!$(this).hasClass(cat)) {
						$(this).children().children('.bbox').animate({
							opacity: '+=0.6'
						});
						//$(this).children('.bbox').show();
					}
				});
			});

			tileWidth = (($('.tile').width() * 2) + tileMargin + (tileBorder * 4));
			if($("#gridgallery-setting-height").html() == 'auto'){
				tileHeight = tileWidth;
			} else {
				tileHeight = (($('.tile').height() * 2) + tileMargin + (2 * tileBorder) + (descHeight * 2) + descMarginBottom);
			}
			tileMarginLeft = toInt($('.goRight').children().children('.tileImage').css('marginLeft'));

			$('.tile').children().children('.tileImage').css('width', tileWidth).css('height', tileHeight);

			$('.tile').click(function () {
				try {
					window.getSelection().removeAllRanges();
				} catch(e) {}
				$('.tile').css('opacity', '1');
				$(this).removeClass('noOut');
				if($(this).hasClass('noOut')) {
					$('.tile').children().children('.tileImage').children('.about').fadeOut('fast');
					$('.tile').children().children('.tileImage').fadeOut('fast');
					$('.tile').css('opacity', '1');
				} else {
					//$(this).children('.tileImage').children('.about').css('display','block');
					if($(this).hasClass('goRight')) {
						$(this).addClass('noOut');
						$(this).addClass('notOpacity');
						$('.tile').each(function () {
							if($(this).hasClass('notOpacity')) {
								$(this).removeClass('notOpacity');
							} else {
								$(this).css('opacity', '0.5');
							}
						});
						$(this).children().children('.tileImage').fadeIn('normal').css('zIndex', '110');

					} else {
						if($(this).hasClass('endLine')) {
							$(this).addClass('noOut');
							$(this).addClass('notOpacity');
							$('.tile').each(function () {
								if($(this).hasClass('notOpacity')) {
									$(this).removeClass('notOpacity');
								} else {
									$(this).css('opacity', '0.5');
								}
							});
							$(this).children().children('.tileImage').fadeIn('normal').css('zIndex', '110');
						} else {
							if(!$(this).hasClass('noOut')) {
								$(this).addClass('noOut');
								$(this).addClass('notOpacity');
								$('.tile').each(function () {
									if($(this).hasClass('notOpacity')) {
										$(this).removeClass('notOpacity');
									} else {
										$(this).css('opacity', '0.5');
									}
								});
								$(this).children().children('.tileImage').fadeIn('normal').css('zIndex', '110');
							}
						}
					}
				}
				$('.tile').bind('mouseleave', function () {
					$('.tile').css('opacity', '1');
					if($(this).hasClass('goRight')) {
						$(this).children().children('.tileImage').css('zIndex', '100').fadeOut('fast');
						$(this).removeClass('noOut');
					} else {
						if($(this).hasClass('endLine')) {
							$(this).children().children('.tileImage').css('zIndex', '100').fadeOut('fast');
							$(this).removeClass('noOut');
						} else {
							if($(this).hasClass('noOut')) {
								$(this).children().children('.tileImage').css('zIndex', '100').fadeOut('fast');
								$(this).removeClass('noOut');
							}
						}
					}
					$('.tile').css('opacity', '1');
				});
			});
		},



		/**
		 * Tile hover
		 */
		tileHover: function(){
			$('.gridgallery .ourHolder .item').each(function (){
				var tileIcon = $(this).children('.tile').children('.gridgallery-icon');

				$(this).hover(function () {
					tileIcon.css({
						'background-color': 'rgba(51, 51, 51, 0.8)'
					});
					tileIcon.stop(true, true).fadeIn('slow');
				}, function () {
					tileIcon.stop(true, true).fadeOut('slow');
					tileIcon.css({
						'background-color': 'none'
					});
				});
			});
		},



		/**
		 * Category slider
		 */
		categorySlider: function(){
			var strong = toInt($('.strong').css('width'));

			$('.strong').css('width', strong + 'px');

			$('.category-list a').click(function (e) {
				e.preventDefault();
				$('.gallery-portfolio').hide();
				var link = $(this).attr('id');
				$('.' + link).show();
			});

			var f = 1;
			ulWidth = 0;
			$('.galery-holder').each(function () {
				liW = $(this).children('.galery-wrap').children('.galery-slider').children('li').width() + toInt($('.galery-slider li').css('marginRight'));
				ulWidth = $(this).children('.galery-wrap').children('.galery-slider').children('li').size() * liW;
				maxL = 0;
				if($(this).children('.galery-wrap').children('.galery-slider').children('li').size() <= 5) {
					maxL = $(this).children('.galery-wrap').children('.galery-slider').children('li').size();
					max = $(this).children('.galery-wrap').children('.galery-slider').children('li').size();
					$(this).attr('data-enable', maxL);
					$(this).attr('data-max', max);
				} else {
					maxL = $(this).children('.galery-wrap').children('.galery-slider').children('li').size() - 5;
					max = $(this).children('.galery-wrap').children('.galery-slider').children('li').size() - 5;
					$(this).attr('data-enable', maxL);
					$(this).attr('data-max', max);
				}

				mL = maxL;

				$(this).attr('data-ulWidth', ulWidth);
				$(this).children('ul').css('width', ulWidth);
			});

			//$('.galery-slider').css('width',ulWidth);
			$('.gall-r').click(function () {
				//console.log();
				if($(this).parent('.name').siblings('.galery-holder').attr('data-enable') != toInt($(this).parent('.name').siblings('.galery-holder').attr('data-max') - ($(this).parent('.name').siblings('.galery-holder').attr('data-max') - 3))) {
					$(this).parent('.name').siblings('.galery-holder').children('.galery-wrap').children('.galery-slider').stop('true', 'true');
					$(this).parent('.name').siblings('.galery-holder').children('.galery-wrap').children('.galery-slider').animate({
						"left": "-=" + liW + "px"
					});
					mL = $(this).parent('.name').siblings('.galery-holder').attr('data-enable') - 1;
					$(this).parent('.name').siblings('.galery-holder').attr('data-enable', mL);
				}
				return false;
			});
			//$('.galery-slider').css('width',ulWidth);
			$('.gall-l').click(function () {
				//console.log();
				if($(this).parent('.name').siblings('.galery-holder').attr('data-enable') != $(this).parent('.name').siblings('.galery-holder').attr('data-max')) {
					$(this).parent('.name').siblings('.galery-holder').children('.galery-wrap').children('.galery-slider').stop('true', 'true');
					$(this).parent('.name').siblings('.galery-holder').children('.galery-wrap').children('.galery-slider').animate({
						"left": "+=" + liW + "px"
					});
					mL = $(this).parent('.name').siblings('.galery-holder').attr('data-enable');
					mL++;
					$(this).parent('.name').siblings('.galery-holder').attr('data-enable', mL);
				}
				return false;
			});
		},



		/**
		 * portCatShow
		 */
		portCatShow: function(){
			$(".portfolio .port-cat.icon").click((function (){
				$('.portfolio .port-cat.categories').fadeToggle('slow');
			}));
		},



		/**
		 * Refresh
		 */
		refresh: function(){
			var contWidth = $('.gridgallery').parent().width();
			var tileRowNum = 5;
			var tileMargin = 15;  // margin: 0 0 3px 3px
			var tileBorder = 4;  // border: 10px
			var tileCount = 0;
			var tileCounter = 1;
			var rowCounter = 1;
			var tileCountGlobal = 0;
			var descHeight = 0;
			var descMarginBottom = 0;

			if($('.gridgallery').hasClass('five'))
				tileRowNum = 5;
			else if($('.gridgallery').hasClass('four'))
				tileRowNum = 4;
			else if($('.gridgallery').hasClass('three'))
				tileRowNum = 3;

			var tileHeight = $("#gridgallery-setting-height").html();
			//var tileWidth = toInt((contWidth - (tileRowNum * tileMargin)) / tileRowNum);
			var tileWidth = toInt((contWidth - (tileRowNum * (tileMargin + 2 + (tileBorder * 2)))) / tileRowNum) + toInt(tileMargin / tileRowNum);

			$('.gridgallery .ulHolder .ourHolder .item').each(function(){
				tileCountGlobal++;
			});

			var rowCount = Math.ceil(tileCountGlobal / tileRowNum);

			$('.gridgallery .ulHolder .ourHolder .item').each(function(){
				var $this = $(this);

				if($this.children().length > 1){
					descHeight = toInt($this.children('.tile-desc').css('height'));
					descMarginBottom = 10;
				}

				var tile_small = $this.children('.tile');
				var tile_big = tile_small.children().children('a');

				if(rowCounter == 1){
					// first row
					if(tileCounter == 1){
						// first row | first tile
						tile_big.css({'top':'-'+tileBorder+'px','left':'-'+tileBorder+'px','bottom':'0px','right':'0px','margin-left':'0px'});
					} else if (tileCounter == tileRowNum){
						// first row | last tile
						if(tileHeight == 'auto'){
							tile_big.css({'left':'-'+(6 + tileWidth+tileMargin+tileBorder*2)+'px','right':'0px','top':'-'+tileBorder+'px' ,'margin-left':'0px'});
						}else{
							tile_big.css({'left':'-'+(6 + tileWidth+tileMargin+tileBorder)+'px','right':'0px','top':'-'+tileBorder+'px' ,'margin-left':'0px'});
						}

						tileCounter = 0;
						rowCounter++;
					}else{
						// first row | tiles between first and last
						if(tileHeight == 'auto'){
							tile_big.css({'top':'-'+tileBorder+'px','left':'-'+tileBorder+'px','bottom':'0px','margin-left':'0px'});
						}else{
							tile_big.css({'top':'-'+tileBorder+'px','left':'-'+tileBorder+'px','bottom':'0px','margin-left':'0px'});
						}
					}
				}else if(rowCounter == (rowCount)){
					// last row
					if(tileCounter == 1){
						// last row | first tile
						if(tileHeight == 'auto'){
							tile_big.css({'top':'-'+(8+tileWidth+tileMargin+tileBorder+descHeight+descMarginBottom)+'px','left':'-'+tileBorder+'px','bottom':'0px','right':'0px','margin-left':'0px'});
						}else{
							tile_big.css({'top':'-'+(8+toInt(tileHeight)+tileMargin+tileBorder*2+descHeight+descMarginBottom)+'px','left':'-'+tileBorder+'px','bottom':'0px','right':'0px','margin-left':'0px'});
						}
					}else if(tileCounter == tileRowNum){
						// last row | last tile
						if(tileHeight == 'auto'){
							tile_big.css({'top':'-'+(8 + tileWidth+tileMargin+tileBorder+descHeight+descMarginBottom)+'px','bottom':'0px','left':'-'+(10 + tileWidth+tileMargin+tileBorder)+'px', 'right':'0px','margin-left':'0px'});
						}else{
							tile_big.css({'top':'-'+(8 + toInt(tileHeight)+tileMargin+tileBorder*2+descHeight+descMarginBottom)+'px','bottom':'0px','left':'-'+(10 + tileWidth+tileMargin+tileBorder)+'px', 'right':'0px','margin-left':'0px'});
						}
						tileCounter = 0;
						rowCounter++;
					}else{
						// last row | tiles between first and last
						if(tileHeight == 'auto'){
							tile_big.css({'top':'-'+(8 + tileWidth+tileMargin+(tileBorder)+descHeight+descMarginBottom)+'px','left':'-'+tileBorder+'px','bottom':'0px','margin-left':'0px'});
						}else{
							tile_big.css({'top':'-'+(8 + toInt(tileHeight)+tileMargin+(tileBorder*2)+descHeight+descMarginBottom)+'px','left':'-'+tileBorder+'px','bottom':'0px','margin-left':'0px'});
						}
					}
				}else{
					// rows between first and last
					if(tileCounter == 1){
						// rows between first and last | first tile
						tile_big.css({'top':'-'+tileBorder+'px','left':'-'+tileBorder+'px','bottom':'0px','right':'0px','margin-left':'0px'});
					} else if (tileCounter == tileRowNum){
						// rows between first and last | last tile
						if(tileHeight == 'auto'){
						tile_big.css({'left':'-'+(tileWidth+tileMargin+tileBorder)+'px','right':'0px','top':'-'+tileBorder+'px','margin-left':'0px'});
						}else{
						tile_big.css({'left':'-'+(tileWidth+tileMargin+tileBorder)+'px','right':'0px','top':'-'+tileBorder+'px','margin-left':'0px'});
						}
						tileCounter = 0;
						rowCounter++;
					}else{
						// rows between first and last | tiles between first and last
						tile_big.css({'top':'-'+tileBorder+'px','left':'-'+tileBorder+'px','bottom':'0px','margin-left':'0px'});
					}
				}
				tileCount++;
				tileCounter++;
			});
		},



		/**
		 * Direct link
		 */
		directLink: function(){
			$('.tile').parent().click(function(){
				window.location = $(this).children().children().children('a').attr('href');
			});
		},



		/**
		 * Fancy box
		 */
		itemFancybox: function(){
			$(".portfolio .ourHolder li").each(function(){
				var type = 'image';
				var href = '';

				if($(this).hasClass('itemType-image')){
					type = 'image';
					//href = $(this).children('.tile').children().children('a').attr('href');
					href = $(this).children('.tile').attr('data-bigimg');
					$(this).children('.tile').fancybox({
						'type' : type,
						'href' : href,
						'transitionIn'  : 'elastic',
						'transitionOut' : 'elastic',
						'speedIn'   : 600,
						'speedOut'    : 200,
						'overlayShow' : true,
						'autoDimensions' : false,
						'width' : $('.gridgallery').parent().width(),
						'height' : toInt($('.gridgallery').parent().width()/1.5)
					});
				} else if ($(this).hasClass('itemType-video')){
					type = 'swf';
					href = $(this).children('.tile').children().children('a').attr('href');

					if(href.indexOf("youtube") != -1){
						href = href.replace(new RegExp("watch\\?v=", "i"), 'v/');
					}else{
						type = 'iframe';
						var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
						var match = href.match(regExp);
						href = "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff";
					}

					$(this).children('.tile').fancybox({
						'type' : type,
						'href' : href,
						'transitionIn'  : 'elastic',
						'transitionOut' : 'elastic',
						'speedIn'   : 600,
						'speedOut'    : 200,
						'overlayShow' : true,
						'autoDimensions' : false,
						'width' : $('.gridgallery').parent().width(),
						'height' : toInt($('.gridgallery').parent().width()/1.5)
					});
				}else{
					type = 'iframe';
					href = $(this).children('.tile').children().children('a').attr('href');

					$(this).children('.tile').click(function(){
						window.open(href);
					});
				}
			});
		}

	};



	/**
	 * Document ready
	 */
	$(function(){
		GridGallery.init();
	});

})(jQuery);