/* global jQuery:false */

var THEMEREX_ADMIN_MODE    = false;
var THEMEREX_error_msg_box = null;
var THEMEREX_VIEWMORE_BUSY = false;
var THEMEREX_scroll_dir;


 // Added to cart
jQuery('body').bind('added_to_cart', function() {
	var total = jQuery('.header_cart_holder .widget_shopping_cart .total .amount').text();
	if (total != undefined && total != 0) {
		jQuery('.header_cart_show .cart_ammount').text(total);
	}
});

jQuery(document).ready(function () {
	"use strict";
	jQuery('body').trigger('added_to_cart');
	setHelpers();
	timelineResponsive()
	ready();
	itemPageFull();
	scrollAction();
	fullSlider();
	REX_parallax();
	THEMEREX_scroll_dir = jQuery(window).scrollTop();
});
jQuery(window).resize(function () {
	"use strict";	
	hideMainmenu('#mainmenu');
	itemPageFull();
	timelineResponsive();
	fullSlider();
	scrollAction();
	THEMEREX_scroll_dir = jQuery(window).scrollTop();
});
jQuery(window).scroll(function () {
	"use strict";
	timelineScrollFix();
	scrollAction();
	REX_parallax();
	if(jQuery('#mainmenu').length > 0 && jQuery('.fixed_wrap').length > 0) {
		fixedScrollMenu('#mainmenu');
	}
});

if(jQuery('.sc_slider_swiper .swiper-wrapper').length > 0) {
	var doit;
	window.onresize = function(){
		clearTimeout(doit);
		doit = setTimeout(resizedw, 100);
	};
}
function resizedw(){
	jQuery('.sc_slider_swiper .swiper-wrapper').find('.sc_slider_subtitle').each(function(){
		trex_slider_align_spans(jQuery(this), 'true');
	});
}

function ready() {
	"use strict";

	//audio
	if (jQuery('audio').length > 0) {
		jQuery('audio').mediaelementplayer();
	}
	hideMainmenu('#mainmenu');

	if(jQuery('#langlist').length > 0) {
		var langTimer;
		jQuery('#langlist').hover(function(){
			clearTimeout(langTimer);
			jQuery(this).find('#lang_switch').stop().slideDown();
		}, function() {
			var th = jQuery(this);
			langTimer = setTimeout( function() { th.find('#lang_switch').stop().slideUp() }, 1000);
		});
	}
	var cart_holder_timer;
	jQuery('.header_cart_holder').hover(function(){
		var th = jQuery(this);
		th.find('.widget_shopping_cart').slideDown();
		clearTimeout(cart_holder_timer);
	},
		function() {
			var th = jQuery(this);
			cart_holder_timer = setTimeout(function(){
				th.find('.widget_shopping_cart').slideUp();
			}, 1000);
			
		}
	);
	jQuery('.widget_shopping_cart').hover(function(){
		clearTimeout(cart_holder_timer);
	});

	// Share button
	if (jQuery('ul.shareDrop').length > 0) {
		jQuery(document).click(function (e) {
			"use strict";
			jQuery('ul.shareDrop').slideUp().siblings('a.shareDrop').removeClass('selected');
		});
		jQuery('li.share a').click(function (e) {
			"use strict";
			if (jQuery(this).hasClass('selected')) {
				jQuery(this).removeClass('selected').siblings('ul.shareDrop').slideUp();
			} else {
				jQuery(this).addClass('selected').siblings('ul.shareDrop').slideDown();
			}
			e.preventDefault();
			return false;
		});
		jQuery('li.share li a').click(function (e) {
			jQuery(this).parents('ul.shareDrop').slideUp().siblings('a.shareDrop').removeClass('selected');
			e.preventDefault();
			return false;
		});
	}

	/* Right Panel */	
	if(jQuery('.swpRightPos').length > 0) {
		jQuery('.swpRightPos .sc_tabs .tabHeadsWrap a.panel_open').click(function(){
			var th = jQuery(this);
			if(!th.parents('.swpRightPos').hasClass('vis')) {
				setTimeout(function() {th.parents('.swpRightPos').addClass('vis')}, 300);
				jQuery('body').append('<div class="right_panel_overlay"></div>');
			}
			return false;
		});
		jQuery('body').on('click', '.right_panel_overlay',function(){
			jQuery('.swpRightPos').removeClass('vis');
			jQuery(this).remove();
			return false;
		});
	}
	setCookie('prevVisited', 1, 0, '/');
	/****************/

	if(jQuery('#searchform').length > 0) {
		jQuery('.search_form_show').click(function(){
			var th = jQuery(this);
			if(!th.parent().hasClass('vis')) {
				jQuery('.section_2').addClass('vis');
				th.html('<i class="icon-cancel"></i>');
				th.parent().addClass('vis');
			}
			else {
				th.parent().removeClass('vis');
				th.html('<i class="icon-search"></i>');
				jQuery('.section_2').removeClass('vis');
			}
			return false;
		});
	}
	jQuery('.show_mobile_menu').click(function(e){
		if(!jQuery(this).hasClass('menu_vis')) {
			jQuery('.main_content').addClass('fixedMenu');
			jQuery('#mainmenu').addClass('menuShow');
			jQuery(this).addClass('menu_vis');
		}
		else {
			jQuery('.main_content').removeClass('fixedMenu');
			jQuery('#mainmenu').removeClass('menuShow');
			jQuery(this).removeClass('menu_vis');
		}
		return false;
	});

	// Decorate nested lists in widgets and sidemenu
	jQuery('.widgetWrap ul > li,.sidemenu_area ul > li,.panelmenu_area ul > li,.widgetTop ul > li').each(function () {
		if (jQuery(this).find('ul').length > 0) {
			jQuery(this).addClass('dropMenu');
		}
	});

	jQuery('form.search-form button').click(function(){
		jQuery(this).parent().submit();
	});

	jQuery('.widgetWrap ul > li.dropMenu,.sidemenu_area ul > li.dropMenu,.panelmenu_area ul > li.dropMenu,.widgetTop ul > li.dropMenu, #mainmenu.leftFixed li.menu-item-has-children').click(function (e) {
		"use strict";
		jQuery(this).toggleClass('dropOpen');
		if(jQuery(this).hasClass('dropOpen')) {
			jQuery(this).find('ul').first().slideToggle(200, function() {
				if (jQuery(this).parents('.sidemenu_area').length > 0)
					myScroll['custom_options_scroll'].reInit();
				else if (jQuery(this).parents('.panelmenu_area').length > 0)
					myScroll['panelmenu_scroll'].reInit();
				else if (jQuery(this).parents('.bookmarks_scroll').length > 0)
					myScroll['bookmarks_scroll'].reInit();
			});
			e.preventDefault();
			return false;
		}
	});
	// Add bookmarks
	if (jQuery('#tabsFavorite').length > 0) {
		jQuery('.addBookmark').click(function(e) {
			"use strict";
			var title = window.document.title.split('|')[0];
			var url = window.location.href;
			var list = jQuery.cookie('themerex_bookmarks');
			var exists = false;
			if (list) {
				list = JSON.parse(list);
				for (var i=0; i<list.length; i++) {
					if (list[i].url == url) {
						exists = true;
						break;
					}
				}
			} else
				list = new Array();
			if (!exists) {
				list.push({title: title, url: url});
				jQuery('.listBookmarks').append('<li><a href="'+url+'">'+title+'</a><a href="#" class="delBookmark icon-cancel"></a></li>');
				jQuery.cookie('themerex_bookmarks', JSON.stringify(list), {expires: 365, path: '/'});
				if (myScroll['bookmarks_scroll']!==undefined) myScroll['bookmarks_scroll'].reInit();
				themerex_message_success(THEMEREX_MESSAGE_BOOKMARK_ADDED, THEMEREX_MESSAGE_BOOKMARK_ADD);
			} else
				themerex_message_warning(THEMEREX_MESSAGE_BOOKMARK_EXISTS, THEMEREX_MESSAGE_BOOKMARK_ADD);
			e.preventDefault();
			return false;
		});
		// Delete bookmarks
		jQuery('.listBookmarks').on('click', '.delBookmark', function(e) {
			"use strict";
			var idx = jQuery(this).parent().index();
			var list = jQuery.cookie('themerex_bookmarks');
			if (list) {
				list = JSON.parse(list);
				list.splice(idx, 1);
				jQuery.cookie('themerex_bookmarks', JSON.stringify(list), {expires: 365, path: '/'});
			}
			jQuery(this).parent().remove();
			e.preventDefault();
			return false;
		});
	}

	jQuery('.widgetWrap ul:not(.tabs) li > a,.sidemenu_area ul:not(.tabs) li > a,.panelmenu_area ul:not(.tabs) li > a,.widgetTop ul:not(.tabs) li > a').click(function (e) {
		"use strict";
		if (jQuery(this).attr('href')!='#') {
			if (jQuery(this).parent().hasClass('menu-item-has-children') && jQuery(this).parents('.sidemenu_area,.panelmenu_area').length > 0) {
				jQuery(this).parent().trigger('click');
				e.preventDefault();
				return false;
			}
		}
	});

	knob_review_init();

	jQuery('.isotopeFiltr li a').each(function(){
		var cat_count = 0;
		var	item_cat = jQuery(this).data('filter').replace(/[\. ,:-]+/g, "");
		jQuery(this).parents('.isotopeFiltr').next().find('.post').each(function(){
			if(jQuery(this).hasClass(item_cat)) {
				cat_count++;
			}
		});
		if(cat_count == 0 && jQuery(this).parent().index() > 0) {
			jQuery(this).parent().remove();
		}
	});

	// Like button
	jQuery('.postSharing,.masonryMore').on('click', '.likeButton a', function(e) {
		var button = jQuery(this).parent();
		var inc = button.hasClass('like') ? 1 : -1;
		var post_id = button.data('postid');
		var likes = Number(button.data('likes'))+inc;
		var spotlight_likes = jQuery.cookie('spotlight_likes');
		if (spotlight_likes === undefined) spotlight_likes = '';
		jQuery.post(THEMEREX_ajax_url, {
			action: 'post_counter',
			nonce: THEMEREX_ajax_nonce,
			post_id: post_id,
			likes: likes
		}).done(function(response) {
			var rez = JSON.parse(response);
			if (rez.error === '') {
				if (inc == 1) {
					var title = button.data('title-dislike');
					button.removeClass('like').addClass('likeActive');
					spotlight_likes += (spotlight_likes.substr(-1)!=',' ? ',' : '') + post_id + ',';
				} else {
					var title = button.data('title-like');
					button.removeClass('likeActive').addClass('like');
					spotlight_likes = spotlight_likes.replace(','+post_id+',', ',');
				}
				button.data('likes', likes).find('a').attr('title', title).find('.likePost').html(likes);
				jQuery.cookie('spotlight_likes', spotlight_likes, {expires: 365, path: '/'});
			} else {
				themerex_message_warning(THEMEREX_MESSAGE_ERROR_LIKE);
			}
		});
		e.preventDefault();
		return false;
	});

	//isotope
	if (jQuery('.isotopeNOamin, .isotope, .isotopeFull').length > 0) {

		if(!jQuery('.isotope').hasClass('multiWidth')) {
			trex_iso_init();
		}

		//isotopeFull portfolio	
		var elementIsotop = 340;
		jQuery('.isotopeFull').find('.isotopeElement').css('width', Math.floor(jQuery('.isotopeFull').width() / Math.floor(jQuery('.isotopeFull').width() / elementIsotop)));

		set_iso_items_width('.isotope.multiWidth', '');
		var iso_container = jQuery('.isotope.multiWidth').isotope({
			resizable: false,
			layoutMode: 'fitRows',
			itemSelector: '.isotopeElement',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			},
			sortBy: 'index',
			getSortData: {
  				index: function(elem, x, b) {
  					return jQuery(elem).index();
  				}
  			}
		});
		iso_container.attr('data-width', jQuery(iso_container).width()).attr('data-width', jQuery(iso_container).width());
		iso_container.isotope('unbindResize');

		jQuery(window).resize(function () {
			"use strict";
			jQuery('.isotopeFull').find('.isotopeElement').css('width', Math.floor(jQuery('.isotopeFull').width() / Math.floor(jQuery('.isotopeFull').width()	 / elementIsotop)));
			jQuery('.isotopeFull').isotope({
				masonry: {
					columnWidth: Math.floor(jQuery('.isotopeFull').width() / Math.floor(jQuery('.isotopeFull').width() / elementIsotop))
				}
			});
		});

		var iso_timer;
		window.onresize = function(){
			clearTimeout(iso_timer);
			iso_timer = setTimeout(function(){iso_multiwidth_resize(iso_container)}, 300);
		};

		//isotopefiltre
		jQuery('.isotopeFiltr').on('click', 'li a', function (e) {
			"use strict";
			jQuery(this).parents('.isotope_section').find('.appended').slideUp(300, function(){jQuery(this).remove();} );
			jQuery(this).parents('.isotope_section').find('.current').removeClass('current');
			jQuery('.isotopeFiltr li').removeClass('active');
			jQuery(this).parent().addClass('active');
	
			var selector = jQuery(this).attr('data-filter'),
				parentBlock = jQuery(this).parents('.isotopeFiltr').next();
				
			parentBlock.isotope({
				filter: selector
			}, set_iso_items_width(parentBlock, selector));
			e.preventDefault();
			return false;
		});

	}

	// topMenu DROP
	jQuery('#topmenu, #mainmenu:not(".leftFixed")').superfish({
		delay: 1000,
		animation: {
			opacity: 'show',
			height: 'show'
		},
		animationOut: {
			height: 'hide'
		},
		speed: 'slow',
		autoArrows: false,
		dropShadows: false
	});

	//category menu
	jQuery('.widget_categories > ul > li').each(function () {
		if (jQuery(this).find('ul').length > 0) {
			jQuery(this).addClass('dropMenu');
		}
	});
	jQuery('.widgetWrap ul > li.dropMenu > ul').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.widgetWrap ul > li.dropMenu ').click(function (e) {
		"use strict";
		jQuery(this).toggleClass('dropOpen');
		jQuery(this).find('ul').first().slideToggle();
		e.preventDefault();
		return false;
	});

	// search
	jQuery(document).click(function (e) {
		"use strict";
		jQuery('.topGlobal .search .searhForm').hide('slide', {
			direction: 'left'
		}, 200);
		jQuery('.ajaxSearch').slideUp();
		jQuery('header').removeClass('topSearchShow');
		jQuery('.topGlobal .search').removeClass('searchOpen');
	});
	jQuery('.topGlobal .search .searhForm').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.topGlobal .search').click(function (e) {
		"use strict";
		jQuery('header').addClass('topSearchShow')
		jQuery(this).toggleClass('searchOpen');
		jQuery('.ajaxSearch').delay(300).slideToggle();
		jQuery(this).find('.searchForm').toggle('slide',{direction: 'left'}, 300)
		e.preventDefault();
		return false;
	});


	// search 404
	jQuery(document).click(function (e) {
		"use strict";
		setTimeout(function() { jQuery('.inputSubmitAnimation:not(.opened)').removeClass('sFocus rad4').addClass('radCircle', 100) }, 300);
			jQuery('.inputSubmitAnimation').find('form:visible').stop( true, true ).animate({'width' : 'toggle'});
	});
	jQuery('.inputSubmitAnimation').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.inputSubmitAnimation a').click(function (e) {
		"use strict";
		var form = jQuery(this).siblings('form');
		var parent = jQuery(this).parents('.inputSubmitAnimation');
		if (parent.hasClass('sFocus')) {
			if (form.length>0 && form.find('input').val()!='') {
				if (jQuery(this).hasClass('sc_emailer_button')) {
					var group = jQuery(this).data('group');
					var email = form.find('input').val();
					var regexp = new RegExp(THEMEREX_EMAIL_MASK);
					if (!regexp.test(email)) {
						form.find('input').get(0).focus();
						themerex_message_warning(THEMEREX_EMAIL_NOT_VALID);
					} else {
						jQuery.post(THEMEREX_ajax_url, {
							action: 'emailer_submit',
							nonce: THEMEREX_ajax_nonce,
							group: group,
							email: email
						}).done(function(response) {
							var rez = JSON.parse(response);
							if (rez.error === '') {
								themerex_message_success(THEMEREX_MESSAGE_EMAIL_ADDED.replace('%s', email));
								form.find('input').val('');
							} else {
								themerex_message_warning(rez.error);
							}
						});
					}
				} else
					form.get(0).submit();
			} else {
				jQuery(document).trigger('click');				
				//form.animate({'width' : 'toggle'});
			}
		} else {
			parent.addClass('sFocus rad4');
			setTimeout(function() {parent.find('form').animate({'width' : 'toggle'})}, 300);
		}
		e.preventDefault();
		return false;
	});
	jQuery('body').click(function(event){

		var target = event.target;
		if(jQuery(target).attr('id') != 'mainmenu') {
			if(jQuery('#mainmenu.leftFixed').length > 0) {
				jQuery('#mainmenu.leftFixed').removeClass('menuShow');
				jQuery('.main_content.fixedMenu').removeClass('fixedMenu');
				jQuery('.show_mobile_menu.menu_vis').removeClass('menu_vis');
			}
		}
	});

	jQuery('.widget_popular_posts .style_post_format .post_title a').hover(function(){
		jQuery(this).parents('.post_wrapper').prev().addClass('hover');
	},
		function() {
		jQuery(this).parents('.post_wrapper').prev().removeClass('hover');
		}
	);

	jQuery('.isotope.multiWidth').on('click', '.close_button', function(event){
		var iso_block = jQuery(this).parents('.isotope.posts_container');
		jQuery(this).parent().remove();
		iso_block.isotope('layout');
	});

	jQuery('.blog_style_portfolio .isotope.multiWidth').on('click', '.isotopeElement > a', function(e){
		var post_id = jQuery(this).data('post-id');
		if(!jQuery(this).hasClass('current')) {
			jQuery('.isotope.multiWidth').find('.current').removeClass('current');
			jQuery(this).parent().addClass('current');
			var th = jQuery(this);
			jQuery.post(THEMEREX_ajax_url, {
				action: 'blog_portfolio_single',
				nonce: THEMEREX_ajax_nonce,
				post_id: post_id
			}).done(function(response) {
				var rez = JSON.parse(response);
				if (rez.error === '') {

					var obj = th.parent();
					var curRow = obj.data('row-num');
					var rowElems = obj.parent().find('.isotopeElement[data-row-num="'+curRow+'"]');
					var iso_block = obj.parent(),
						iso_height = iso_block.height(),
						topOffset = obj.offset().top - obj.prevAll('.appended').outerHeight();

					iso_block.parent().css('minHeight',iso_height);
					if (jQuery(iso_block).find('.appended').length>0) {
						jQuery(iso_block).find('.appended').remove()
							portfolioPartAppend(rez, rowElems, iso_block);
					} else {
						portfolioPartAppend(rez, rowElems, iso_block);
					}

					jQuery('html, body').animate({'scrollTop' : topOffset});

					jQuery('body').addClass('part_appended');
					jQuery(rez.data).find('img').load(function(){
						initShortcodes(iso_block);
					});
				}
				else {
					themerex_message_warning(rez.error);
				}
			});
		}
		e.preventDefault();
		return false;
	});

	// Sidemenu DROP
	jQuery('.sidemenu_area > ul > li.dropMenu ').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.sidemenu_area > ul > li.dropMenu, .sidemenu_area > ul > li.dropMenu li').click(function (e) {
		"use strict";
		initScroll('sidemenu_scroll');
		jQuery(this).toggleClass('dropOpen');
		jQuery(this).find('ul').first().slideToggle();
		e.preventDefault();
		return false;
	});

	jQuery('#sidemenu_scroll a').click(function (e) {
		"use strict";
		initScroll('sidemenu_scroll');
		jQuery('#sidemenu_scroll').mCustomScrollbar("update");
		e.preventDefault();
		return false;
	});

	jQuery(document).click(function (e) {
		"use strict";
		jQuery('body').removeClass('openMenuFixRight openMenuFix');
		jQuery('.sidemenu_overflow').fadeOut(400);
//		jQuery('body').attr('style', '');

	});
	jQuery('.sidemenu_wrap.swpLeftPos, .swpRightPos, .openRightMenu').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});

	jQuery('.sidemenu_wrap .sidemenu_button').click(function (e) {
		"use strict";
		jQuery('body').addClass('openMenuFix');
		if (jQuery('.sidemenu_overflow').length == 0) {
			jQuery('body').append('<div class="sidemenu_overflow"></div>')
		}
		jQuery('.sidemenu_overflow').fadeIn(400);
		e.preventDefault();
		return false;
	});

	jQuery('.openRightMenu').click(function (e) {
		"use strict";
		jQuery('body').addClass('openMenuFixRight');
		if (jQuery('.sidemenu_overflow').length == 0) {
			jQuery('body').append('<div class="sidemenu_overflow"></div>')
		}
		jQuery('.sidemenu_overflow').fadeIn(400);
		e.preventDefault();
		return false;
	});


	//Hover DIR
	jQuery(' .portfolio > .isotopeElement > .hoverDirShow').each(function () {
		"use strict";
		jQuery(this).hoverdir();
	});


	jQuery('.upToScroll').click(function(e) {
		"use strict";
		jQuery('html,body').animate({
			scrollTop: 0
		}, 'slow');
		e.preventDefault();
		return false;
	});

	jQuery('.formList input[type="text"], .formList input[type="password"]').focus(function () {
			"use strict";
			jQuery(this).attr('data-placeholder', jQuery(this).attr('placeholder')).attr('placeholder', '')
			jQuery(this).parent('li').addClass('iconFocus');
		})
		.blur(function () {
			"use strict";
			jQuery(this).attr('placeholder', jQuery(this).attr('data-placeholder'))
			jQuery(this).parent('li').removeClass('iconFocus');
		});

	//responsive Show menu
	jQuery('.openResposoveMenu').click(function(e){
		"use strict";
		jQuery('.menuTopWrap').slideToggle()
		e.preventDefault();
		return false;
	});


	// IFRAME width and height constrain proportions 
	if (jQuery('iframe').length > 0) {
		jQuery(window).resize(function() {
			"use strict";
			videoDimensions();
		});
		videoDimensions();
	}

	// Hide empty pagination
	if (jQuery('#nav_pages > ul > li').length < 3) {
	} else {
		jQuery('.theme_paginaton a').addClass('theme_button');
	}
//swiper_sliderf();
	// View More button
	jQuery('#viewmore_link').click(function(e) {
		"use strict";
		var linkObj = jQuery(this);
		if (!THEMEREX_VIEWMORE_BUSY) {
			jQuery(this).addClass('loading');
			THEMEREX_VIEWMORE_BUSY = true;
			jQuery.post(THEMEREX_ajax_url,{
				action: 'view_more_posts',
				nonce: THEMEREX_ajax_nonce,
				page: THEMEREX_VIEWMORE_PAGE+1,
				data: THEMEREX_VIEWMORE_DATA,
				vars: THEMEREX_VIEWMORE_VARS
			}).done(function(response) {
				"use strict";
				var rez = JSON.parse(response);
				jQuery('#viewmore_link').removeClass('loading');
				THEMEREX_VIEWMORE_BUSY = false;
				if (rez.error === '') {
					var wrapper_height = jQuery('#viewmore').parent().find('.posts_container').height();
					jQuery('#viewmore').parent().find('.posts_container').css({'minHeight':wrapper_height}).append(rez.data);
					knob_review_init();
					initShortcodes(jQuery('body').eq(0));
					var iso_id = jQuery('#viewmore').parent().find('.isotope.posts_container').attr('id');
					set_iso_items_width(jQuery('#viewmore').parent().find('.posts_container'), '');
					THEMEREX_isotopeInitCounter = 0;
					isotope_reinit(iso_id);
					initPostFormats();
					THEMEREX_VIEWMORE_PAGE++;
					if (rez.no_more_data==1) {
						THEMEREX_VIEWMORE_BUSY = true;
						jQuery('#viewmore').hide();
					}
					if (jQuery('#nav_pages ul li').length >= THEMEREX_VIEWMORE_PAGE) {
						jQuery('#nav_pages ul li').eq(THEMEREX_VIEWMORE_PAGE).toggleClass('pager_current', true);
					}
					if(rez.cats !== '') {
						for(var p in rez.cats) {
							var found = false;
							jQuery('#viewmore').parent().find('.isotopeFiltr ul li a').each(function(){
								if(found) return;
								if(jQuery(this).parent().index() > 0) {
									var filterName = jQuery(this).data('filter').replace(/\D/g,'');
									if(p == filterName) {
										found = true;
									}
								}
							});
							if(found != true) {
								jQuery('#viewmore').parent().find('.isotopeFiltr ul').append('<li><a href="#" data-filter=".flt_'+p+'">'+rez.cats[p]+'</a></li>');
							}
						}
					}
				}
			});
		}
		e.preventDefault();
		return false;
	});

	// Infinite pagination
	if (jQuery('#viewmore.pagination_infinite').length > 0) {
		jQuery(window).scroll(infiniteScroll);
	}

	initPostFormats();
	jQuery('.link_pages .post_pages_link a').hover(function(){
		jQuery(this).next().stop( true, true ).fadeIn();
	},
	function(){
		jQuery(this).next().stop( true, true ).fadeOut();
	}
	);
}; //end ready




// Fit video frame to document width
function videoDimensions() {
	jQuery('iframe').each(function() {
		"use strict";
		var iframe = jQuery(this).eq(0);
		var w_attr = iframe.attr('width');
		var h_attr = iframe.attr('height');
		if (!w_attr || !h_attr) {
			return;
		}
		var w_real = iframe.width();
		if (w_real!=w_attr) {
			var h_real = Math.round(w_real/w_attr*h_attr);
			iframe.height(h_real);
		}
	});
}

function initPostFormats() {
	"use strict";

	// MediaElement init
	jQuery('audio').each(function () {
		if (jQuery(this).hasClass('inited')) return;
		jQuery(this).addClass('inited').mediaelementplayer({
			videoWidth: -1,		// if set, overrides <video width>
			videoHeight: -1,	// if set, overrides <video height>
			audioWidth: '100%',	// width of audio player
			audioHeight: 30	// height of audio player
		});
	});

	// Popup init
	if (THEMEREX_popupEngine == 'pretty') {
		jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").attr('rel', 'prettyPhoto[slideshow]');	//.toggleClass('prettyPhoto', true);
		jQuery("a[rel*='prettyPhoto']:not(.inited)")
			.addClass('inited')
			.prettyPhoto({
				social_tools: '',
				theme: 'facebook',
				deeplinking: false
			})
			.click(function(e) {
				"use strict";
				if (jQuery(window).width()<480)	{
					e.stopImmediatePropagation();
					window.location = jQuery(this).attr('href');
				}
				e.preventDefault();
				return false;
			});
	} else {
		jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").attr('rel', 'magnific');	//.toggleClass('magnific', true);
		jQuery("a[rel*='magnific']:not(.inited)")
			.addClass('inited')
			.magnificPopup({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: true,
				fixedContentPos: false,
				mainClass: 'mfp-img-mobile',
				tLoading: THEMEREX_MAGNIFIC_LOADING,
				image: {
					tError: THEMEREX_MAGNIFIC_ERROR,
					verticalFit: true
				}
			});
	}

	// Popup windows with any html content
	jQuery('.user-popup-link:not(.inited)')
		.addClass('inited')
		.magnificPopup({
			type: 'inline',
			removalDelay: 500,
			callbacks: {
				beforeOpen: function () {
					this.st.mainClass = 'mfp-zoom-in';
				},
				open: function () {
					jQuery('html').css({
						overflow: 'visible',
						margin: 0
					});
				},
				close: function () {
				}
			},
			midClick: true
		});

	// Add video on thumb click
	jQuery('.sc_video_frame').each(function () {
		"use strict";
		if (jQuery(this).hasClass('inited')) return;
		jQuery(this).addClass('inited').click(function (e) {
			"use strict";
			var video = jQuery(this).data('video');
			if (video!=='') {
				jQuery(this).empty().html(video);
				videoDimensions();
			}
			e.preventDefault();
			return false;
		});
	});

	var trex_hover_dir;
	jQuery('.author.vcard .user_links ul li a, .widget_contact_social ul li a').hover(function(){
		var th = jQuery(this);
		var title = th.data('tooltip');
		var parent_offset = th.parents('.user_links').offset().left;
		var pos_left = th.offset().left - parent_offset + th.width()/2;

		trex_hover_dir = setTimeout(function(){
			th.parents('.user_links').find('span.tooltip').each(function(){
				jQuery(this).text(title).stop( true, true ).animate({'opacity':1,'left': pos_left-jQuery(this).outerWidth()/2});
			});
		}, 300);
	},
		function() {
			clearTimeout(trex_hover_dir);
			jQuery(this).parents('.user_links').find('span.tooltip').animate({'opacity':0});
		}
	);
	jQuery('.points_slider .vote_criterias li').each(function(){
		jQuery(this).find('.slider_rail').slider({
			slide: function( event, ui ) {
				var curr_val = ui.value;
				var	max_point = jQuery(this).data('max');
				var points = curr_val;
				if(max_point == 10) {
					points = curr_val/10;					
				}
				else if(max_point == 5) {
					points = (curr_val/20).toFixed(1);
				}
				jQuery(this).data("points", curr_val).next('.slider_progress').width(curr_val+'%');
				jQuery(this).parent().find('.current_points').text(points);
			},
			stop: function() {
				var votes_total = {};
				jQuery(this).parents('ul').find('li').each(function(){
					var row_val = jQuery(this).find('.slider_rail').data('points');
					if(!row_val) row_val = 0;
					var row_name = jQuery(this).find('.criteria').text();
					votes_total[row_name] = row_val;
				});
				jQuery(this).parents('.points_slider').prev('#vote_points').val(JSON.stringify(votes_total));
			}
		});
	});
	jQuery('.votes_list .votes_row').each(function(){
		var th = jQuery(this);
		var curr_val = th.find('.points_progress').data('value');
		th.find('.points_progress').css({'width' : curr_val+'%'}, 800);
	});

	//if(jQuery('.sc_slider_swiper .swiper-wrapper .sc_slider_subtitle').length > 0) {
	//	trex_slider_align_spans(jQuery('.sc_slider_swiper .swiper-wrapper .sc_slider_subtitle'));
	//}

}

/* Infinite Scroll */
function infiniteScroll() {
	"use strict";
	var v = jQuery('#viewmore.pagination_infinite').offset();
	if (jQuery(this).scrollTop() + jQuery(this).height() + 100 >= v.top && !THEMEREX_VIEWMORE_BUSY) {
		jQuery('#viewmore_link').eq(0).trigger('click');
	}
}



//itemPageFull
function itemPageFull() {
	"use strict";
	var bodyHeight = jQuery(window).height();
	var st = jQuery(window).scrollTop();
	if (st > jQuery('.noFixMenu .topWrap').height()+jQuery('.topTabsWrap').height()) st = 0;
	var thumbHeight = Math.min(jQuery('.itemPageFull').width()/16*9, bodyHeight - jQuery('#wpadminbar').height() - jQuery('.noFixMenu .topWrap').height() - jQuery('.topTabsWrap').height() + st);
	jQuery('.itemPageFull').height(thumbHeight);
	var padd1 = parseInt(jQuery('.sidemenu_wrap').css('paddingTop'));
	if (isNaN(padd1)) padd1 = parseInt(jQuery('.swpRightPos').css('paddingTop'));
	if (isNaN(padd1)) padd1 = 0;
	var padd2 = parseInt(jQuery('.swpRightPos .sc_tabs .tabsMenuBody').css('paddingTop'))*2;
	if (isNaN(padd2)) padd2 = 0;
	var tabs_h = jQuery('.swpRightPos .sc_tabs .tabsMenuHead').height();
	if (isNaN(tabs_h)) tabs_h = 0;
	var butt_h = jQuery('.swpRightPos .sc_tabs .tabsMenuBody .addBookmarkArea').height();
	if (isNaN(butt_h)) butt_h = 0;
	jQuery('#sidemenu_scroll').height(bodyHeight - padd1);
	jQuery('.swpRightPos .sc_tabs .tabsMenuBody').height(bodyHeight - padd1 - padd2);
	jQuery('#custom_options_scroll').height(bodyHeight - padd1 - padd2);
	jQuery('#sidebar_panel_scroll').height(bodyHeight - padd1 - padd2 - tabs_h);
	jQuery('#panelmenu_scroll').height(bodyHeight - padd1 - padd2 - tabs_h);
	jQuery('#bookmarks_scroll').height(bodyHeight - padd1 - padd2 - tabs_h - butt_h);
}
//init scroll
function initScroll(idScroll) {
	"use strict";

	if (!jQuery('#' + idScroll).hasClass("scrollInit")) {
		jQuery('#' + idScroll).addClass('scrollInit').mCustomScrollbar({
			scrollButtons: {
				enable: false
			},
		});

		jQuery('.scrollPositionAction > .roundButton').click(function (e) {
			"use strict";
			var scrollAction = jQuery(this).data('scroll');
			jQuery('#' + idScroll).mCustomScrollbar("scrollTo", scrollAction);
			e.preventDefault();
			return false;
		});

	}
}

//scroll Action
function scrollAction() {
	"use strict";

	var buttonScrollTop = jQuery('.upToScroll');
	var scrollPositions = jQuery(window).scrollTop();
	var headHeight = jQuery(window).height();
	var topMemuHeight = jQuery('header').height();

	if (scrollPositions > headHeight) {
		buttonScrollTop.addClass('buttonShow');
	} else {
		buttonScrollTop.removeClass('buttonShow');
	}

	if ( jQuery(window).width() > 990){
		jQuery('header .menuTopWrap').show();
	} else {
		jQuery('header .menuTopWrap').hide();
	}


	//if (scrollPositions <= topMemuHeight / 3 && jQuery(window).width() > 990) {
	//	jQuery('header').removeClass('fixedTopMenu').addClass('noFixMenu');
	//} else if (scrollPositions >= topMemuHeight * 1.5 && jQuery(window).width() > 990) {
	//	jQuery('header').css('height', topMemuHeight).addClass('fixedTopMenu').removeClass('noFixMenu');
	//}

}

function fullSlider() {
	"use strict";
	if (jQuery('.fullScreenSlider').length > 0) {
		jQuery('.sliderHomeBullets, .sliderHomeBullets .rsContent').css('height', jQuery(window).height())
	}
}


//Time Line
function timelineResponsive() {
	"use strict";
	var bodyHeight = jQuery(window).height();
	var headHeight = jQuery(window).height() - jQuery('.contentTimeLine h2').height() - 150;
	var leftPosition = (jQuery('.main_content').width() - jQuery('.main').width()) / 2 + jQuery('.sidemenu_wrap').width();
	jQuery('.TimeLineScroll .tlContentScroll').css('height', headHeight);

}


//time line Scroll
function timelineScrollFix() {
	"use strict";
	if (jQuery('.TimeLineScroll').length > 0) {
		var scrollWind = jQuery(window).scrollTop();
		var headerHeight = jQuery('header').height() + jQuery('.topTabsWrap').height();
		var footerHeight = jQuery('.footerContentWrap').height();

		if ((jQuery(document).height() - footerHeight) <= (scrollWind + jQuery(window).height())) {
			var footerVisible = true;
		} else {
			var footerVisible = false;
		};

		if (jQuery(window).scrollTop() <= headerHeight) {
			jQuery('.TimeLineScroll').addClass('timeLineFixTop');
		} else {

			if (headerHeight <= scrollWind - 10 & footerVisible != true) {
				jQuery('.TimeLineScroll').removeClass('timeLineFixTop').addClass('timeLineFix');
				jQuery('.TimeLineScroll').animate({
					marginTop: (scrollWind - headerHeight) + "px"
				}, {
					queue: false,
					duration: 350
				});

			} else {
				jQuery('.TimeLineScroll').removeClass('timeLineFix');
			};

		}
	}
}
var THEMEREX_isotopeInitCounter = 0 ;
function isotope_reinit(block_id) {

	if (!isotopeImagesComplete(jQuery('#'+block_id)) && THEMEREX_isotopeInitCounter++ < 30) {
    	setTimeout(function(){isotope_reinit(block_id)}, 200);
    	return;
	}
	var elementIsotopWidth = jQuery('#'+block_id).width() / jQuery('#'+block_id).data('columns');
	jQuery('#'+block_id).isotope('destroy');
	jQuery('#'+block_id).find('.isotopeElement').fadeIn();
	if(!jQuery('#'+block_id).hasClass('multiWidth')) {
		jQuery('#'+block_id).isotope({
			resizable: false,
			masonry: {
				columnWidth: Math.floor(jQuery('#'+block_id).width() / Math.floor(jQuery('#'+block_id).width() / elementIsotopWidth))
			},
			itemSelector: '.isotopeElement',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	}
	else {
		jQuery('#'+block_id).isotope({
			resizable: false,
			layoutMode: 'fitRows',
			itemSelector: '.isotopeElement',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	}
}

	//Knob Reviews
function knob_review_init() {
	jQuery('input.knob_review').each(function(){
		if(!jQuery(this).hasClass('inited')) {
			jQuery(this).knob({
				draw : function () {
    			    // "tron" case
    			    this.cursorExt = 0.3;
			
    			    var a = this.arc(this.cv)  // Arc
    			        , pa                   // Previous arc
    			        , r = 1;
			
    			    this.g.lineWidth = this.lineWidth;
			
    			    if (this.o.displayPrevious) {
    			        pa = this.arc(this.v);
    			        this.g.beginPath();
    			        this.g.strokeStyle = this.pColor;
    			        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
    			        this.g.stroke();
    			    }
			
    			    this.g.beginPath();
    			    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
    			    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
    			    this.g.stroke();
			
    			    this.g.lineWidth = .5;
    			    this.g.beginPath();
    			    this.g.strokeStyle = this.o.fgColor;
    			    this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + -1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
    			    this.g.stroke();
			
    			    return false;
    			}
			});
			jQuery(this).addClass('inited');
		}
	})
}

function iso_multiwidth_resize(block) {
	if(typeof block == 'object') {
		block = block[0];
	}
	var $block = jQuery(block);
	var dataWidth = $block.data('width');
	if(dataWidth != $block.width() || dataWidth != $block.data('last-width')) {
		var delta =  $block.width() / dataWidth;
		$block.find('.isotopeElement').each(function(){
			var elemWidth = jQuery(this).data('width');
			jQuery(this).width(Math.floor(elemWidth * delta));
		});
		$block.isotope('layout');
		$block.data('last-width', Math.round($block.width()));
	}
}

function set_iso_items_width(block) {
	var filter = arguments[1] ? arguments[1] : '';
	if(typeof block == 'object') {
		block = block[0];
	}
	if(jQuery(block).hasClass('multiWidth')) {
		var iso_elem = jQuery(block).find('.isotopeElement'+(filter != '' || filter == '*' ? filter : ''));
		var i = 0;
		var row_num = 1;
		var wrapper_width = jQuery(block).width();
		var items_sum = 0;
		var row_arr = [];
	
		while(i < iso_elem.length) {
			iso_elem.eq(i).width( iso_elem.eq(i).data('startwidth') );
			if(items_sum + iso_elem.eq(i).data('startwidth') >= wrapper_width) {
				row_num++;
				items_sum = 0;
			}
			items_sum = items_sum + iso_elem.eq(i).width();
			iso_elem.eq(i).attr('data-row-num', row_num);
			i++;
			row_arr[row_num] = items_sum;
		}
		for(i in row_arr) {
			if(i != row_arr.length-1) {
				var row_elem = jQuery(block).find((filter != '' || filter == '*' ? filter : '')+'.isotopeElement[data-row-num="'+i+'"]');
				var row_elem_length = row_elem.length;
				var elem_delta = wrapper_width/row_arr[i];
				var r = 0;
				var temp_width = 0;
				while(r < row_elem_length) {
						if(r != row_elem_length-1) {
							var elem_width = row_elem.eq(r).width();
							var new_elem_width = Math.floor(elem_width*elem_delta);
							row_elem.eq(r).width( new_elem_width);
							temp_width = temp_width + new_elem_width;
						}
						else {
							row_elem.eq(r).width(Math.floor(wrapper_width - temp_width));
						}
						//row_elem.eq(r).data('width', row_elem.eq(r).width());
					r++;
				}
			}
		}
	}
	return;
}

// Calendar handlers - change months
jQuery('.widget_calendar').on('click', '.prevMonth a, .nextMonth a', function(e) {
	"use strict";
	var calendar = jQuery(this).parents('.wp-calendar');
	var m = jQuery(this).data('month');
	var y = jQuery(this).data('year');
	jQuery.post(THEMEREX_ajax_url, {
		action: 'calendar_change_month',
		nonce: THEMEREX_ajax_nonce,
		month: m,
		year: y
	}).done(function(response) {
		var rez = JSON.parse(response);
		if (rez.error === '') {
			calendar.parent().fadeOut(200, function() {
				jQuery(this).empty().append(rez.data).fadeIn(200);
			});
		}
	});
	e.preventDefault();
	return false;
});

var init_attempts = 0;

function trex_iso_init() {
	themerex_count = 0;
	jQuery('.isotope .isotopeElement img').each(function(){
		if(jQuery(this).get(0).complete) {
			themerex_count++;
		}
	});
	
	//isotope
	if(jQuery('.isotope .isotopeElement img').length === themerex_count || init_attempts >= 30) {
		jQuery('.isotope:not(.multiWidth) .isotopeElement, .isotopeNOamin:not(.multiWidth) .isotopeElement').fadeIn(2000, function() { jQuery(this).addClass('inited') });
		jQuery('.isotope:not(.multiWidth), .isotopeNOamin').isotope({
			resizable: false,
			itemSelector: '.isotopeElement',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	} else {
		init_attempts ++;
		setTimeout(function() {trex_iso_init()}, 300);
	}
}
// Parallax scroll
function REX_parallax(){
	jQuery('.sc_section_parallax').each(function(){
		var windowHeight = jQuery(window).height();
		var scrollTops = jQuery(window).scrollTop();
		var offsetPrx = jQuery(this).offset().top; 
		if ( offsetPrx <= scrollTops + windowHeight ) {
			var speed  = .3;
			var xpos   = 0;  
			var ypos   = Math.round((offsetPrx - scrollTops - windowHeight) * speed + (speed < 0 ? windowHeight*speed : 0));
			jQuery(this).css('backgroundPosition', xpos+' '+ypos+'px');
		} 
	});
}
function isotopeImagesComplete(cont) {
	var complete = true;
	cont.find('img').each(function() {
		if (!complete) return;

		if (!jQuery(this).get(0).complete) complete = false;
	});
	return complete;
}
var themerex_count = 0;

function hideMainmenu(menu) {
	if(jQuery(window).width() <= 768) {
		jQuery(menu).addClass('leftFixed');
	}
	else {
		jQuery(menu).removeClass('leftFixed');
	}
}

function detectScrollDir(start) {

	THEMEREX_scroll_dir = jQuery(window).scrollTop();
	return Math.abs(start - jQuery(window).scrollTop()) > 6 ? (start > jQuery(window).scrollTop() ? 'top' : 'bottom') : 'none';
}

function fixedScrollMenu(menu) {
	var $th = jQuery(menu),
		$sect = jQuery(menu).parents('.section_2'),
		winTop = jQuery(window).scrollTop(),
		$header = jQuery(menu).parents('.fixed_menu');

	if(!$header.hasClass('fixed')) {
		var menuTop = $sect.offset().top,
			menuHeight = $sect.outerHeight();

		if(menuTop + menuHeight <= winTop) {
			$sect.removeClass('vis');
			$sect.height(menuHeight).find('.fixed_wrap').hide();
			$sect.find('.header_banner_wrap').attr('class', 'banner_hidden');
			$header.addClass('fixed');
		}
	}
	else {
		if(winTop < $sect.height() + $sect.offset().top) {
			$header.removeClass('fixed');
			$sect.find('.fixed_wrap').show();
			$sect.find('.banner_hidden').attr('class', 'header_banner_wrap');
			$sect.removeAttr('style');
		} else {
			showScrollMenu(menu);
		}
	}
}

function showScrollMenu(menu) {
	var dir = detectScrollDir(THEMEREX_scroll_dir);
	if (dir == 'top') 
		jQuery(menu).parents('.fixed_wrap').show();
	else if (dir == 'bottom')
		jQuery(menu).parents('.fixed_wrap').stop().hide();
}

/* Responsive Menu */

var siteBody = document.getElementsByTagName('body')[0];
var touchStartX = 0;
var touchEndX = 0;
siteBody.addEventListener('touchstart', function(event) {
	var touchobj = event.changedTouches;
	touchStartX = touchobj[0].pageX;
});
siteBody.addEventListener('touchend', function(event) {
	if(jQuery('#mainmenu').hasClass('leftFixed')) {
		var touchobj = event.changedTouches;
		var swiped = touchobj[0].target;
		var isSlider = jQuery(swiped).parents('*[class*="slider"]').length;
		var swipeDiff = touchStartX - touchEndX
	
		touchEndX = touchobj[0].pageX;
		if(isSlider == 0) {
			if((touchEndX - touchStartX) >= 150) {
				jQuery('.main_content').addClass('fixedMenu');
				jQuery('#mainmenu').addClass('menuShow');
			}
			else if((touchStartX - touchEndX) >= 150) {
				jQuery('.main_content').removeClass('fixedMenu');
				jQuery('#mainmenu').removeClass('menuShow');
			}
		}
	}
});

function setHelpers() {
	jQuery('.sc_themerex_helper').each(function(){
		var th 			 = jQuery(this),
			sect_id 	 = th.data('id'),
			point_pos 	 = th.data('point'),
			tooltip_pos  = th.data('tooltip'),
			content 	 = th.html(),
			style  = th.data('style');
		jQuery('#'+sect_id).css({'position':'relative'}).append('<span class="sc_helper_point pos_'+point_pos+' hepler_style_'+style+'" id="helper_'+sect_id+'"></span>');

		var tip_coords = jQuery('#'+sect_id).find('.sc_helper_point').offset(),
			tip_x = tip_coords.left,
			tip_y = tip_coords.top;
		jQuery(this).css({'top':tip_y, 'left':tip_x});
	});
}
jQuery('body').on('click', '.sc_helper_point', function(){
	var target_popup = jQuery(this).attr('id').replace('helper_', '');
	jQuery('#sc_helper_popup_'+target_popup).slideDown();
});

function portfolioPartAppend(rez, rowElems, iso_block) {
	var fn = function() {
		rowElems.eq(rowElems.length - 1).after(rez.data);
		iso_block.isotope('destroy');
		iso_block.find('.appended').slideDown(300, function(){
			iso_block.isotope({
				resizable: false,
				layoutMode: 'fitRows',
				itemSelector: '.isotopeElement',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			iso_block.isotope('unbindResize');
		});
	}
	if(jQuery(rez.data).find('img').length > 0) {
		jQuery(rez.data).find('img').load(function(){
			fn();
		});
	} else {
		fn();
	}
}