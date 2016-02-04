// Shortcodes init
jQuery(document).ready(function() {
	"use strict";
	initShortcodes(jQuery('body').eq(0));

	if(jQuery('.sc_skills.sc_skills_type_bar').length > 0) {
		jQuery(window).resize(function(){
			jQuery('.sc_skills.sc_skills_type_bar .sc_skills_item').each(function(){
				var th = jQuery(this);
				trex_skills_bar_level(th);
			});
		});
	}

});


var myScroll = {};
var mySwiper = {};

function initShortcodes(container) {
	// Tabs
	if (container.find('.sc_tabs:not(.inited)').length > 0) {
		container.find('.sc_tabs:not(.inited),.tabs_area:not(.inited)').each(function () {
		var init = jQuery(this).data('active');
			if (isNaN(init)) init = 0;
			else init = Math.max(0, init);
		container.find('.sc_tabs:not(.inited)')
			.addClass('inited')
			.tabs({
				active: init,
				show: {
					effect: 'fade',
					duration: 250
				},
				hide: {
					effect: 'fade',
					duration: 200
				},
				activate: function (event, ui) {
					initShortcodes(ui.newPanel);
				}
			});
		});
	}

	// Accordion
	if (container.find('.sc_accordion:not(.inited)').length > 0) {
		
		container.find(".sc_accordion:not(.inited)").each(function () {		
			var init = jQuery(this).data('active');
			if (isNaN(init)) init = 0;
			else init = Math.max(0, init);
			jQuery(this)
			.addClass('inited')
			.accordion({
				active: init,
				header: "> .sc_accordion_item > .sc_accordion_title",
				heightStyle: "content",
				create: function (event, ui) {
					ui.header.each(function () {
						jQuery(this).parent().addClass('sc_active');
					});
				},
				activate: function (event, ui) {
					ui.newHeader.each(function () {
						jQuery(this).parent().addClass('sc_active');
					});
					ui.oldHeader.each(function () {
						jQuery(this).parent().removeClass('sc_active');
					});
				}
			});
		});
	}

	// Toggles
	if (container.find('.sc_toggles:not(.inited)').length > 0) {
		container.find('.sc_toggles .sc_toggles_title:not(.inited)')
			.addClass('inited')
			.click(function () {
				jQuery(this).parent().toggleClass('sc_active');
				jQuery(this).parent().find('.sc_toggles_content ').slideToggle();
			});
	}

	// Tooltip
	if (container.find('.sc_tooltip_parent:not(.inited)').length > 0) {
		container.find('.sc_tooltip_parent:not(.inited)')
			.addClass('inited')
			.hover(function () {
				"use strict";
				var obj = jQuery(this);
				obj.find('.sc_tooltip').stop().animate({
					'marginTop': '5'
				}, 100).show();
			},
			function () {
				"use strict";
				var obj = jQuery(this);
				obj.find('.sc_tooltip').stop().animate({
					'marginTop': '0'
				}, 100).hide();
			});
	}
	// Infoboxes
	if (container.find('.sc_infobox.sc_infobox_closeable:not(.inited)').length > 0) {
		container.find('.sc_infobox.sc_infobox_closeable:not(.inited)')
			.addClass('inited')
			.click(function () {
				jQuery(this).slideUp();
			});
	}

	// Contact form
	if (container.find('.sc_contact_form .sc_contact_form_submit:not(.inited)').length > 0) {
		container.find(".sc_contact_form .sc_contact_form_submit:not(.inited)")
			.addClass('inited')
			.click(function(e){
				userSubmitForm(jQuery(this).parents("form"), THEMEREX_ajax_url, THEMEREX_ajax_nonce);
				e.preventDefault();
				return false;
			});
	}

	// Flex Slider
	if (container.find('.sc_slider_flex:not(.inited)').length > 0) {
		container.find('.sc_slider_flex:not(.inited)')
			.addClass('inited')
			.each(function () {
				"use strict";
				jQuery(this).flexslider({
					nextText: '<span class="icon-right-open-big"></span>',
					prevText: '<span class="icon-left-open-big"></span>',
					directionNav: jQuery(this).hasClass('sc_slider_controls'),
					controlNav: jQuery(this).hasClass('sc_slider_pagination'),
					animation: 'slide',
					animationLoop: true,
					slideshow: true,
					slideshowSpeed: 7000,
					animationSpeed: 600,
					pauseOnAction: true,
					pauseOnHover: true,
					useCSS: false,
					manualControls: ''
					/*
					start: function(slider){},
					before: function(slider){},
					after: function(slider){},
					end: function(slider){},              
					added: function(){},            
					removed: function(){} 
					*/
				});
			});
	}

	// Bordered images
	if (container.find('.sc_border:not(.inited)').length > 0) {
		container.find('.sc_border:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var w = Math.round(jQuery(this).width());
				var h = Math.round(w/4*3);
				jQuery(this).find('.slides').css({height: h+'px'});
				jQuery(this).find('.slides li').css({width: w+'px', height: h+'px'});
			});
	}

	// Swiper Slider
	if (container.find('.sc_slider_swiper:not(.inited)').length > 0) {
		var swiperPages = {};
		container.find('.sc_slider_swiper:not(.inited)')
			.each(function () {
				"use strict";
				var temp_html;
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var id = jQuery(this).attr('id');
				if (id == undefined) {
					id = 'swiper_'+Math.random();
					id = id.replace('.', '');
					jQuery(this).attr('id', id);
				}
				jQuery(this).addClass(id);
				mySwiper[id] = new Swiper('.'+id, {
					loop: false,
					calculateHeight: true,
					grabCursor: true,
					mode:'horizontal',
					pagination: jQuery(this).hasClass('sc_slider_pagination') ? '#'+id+' .flex-control-nav' : false,
				    paginationClickable: true,
					autoplay: 7000,
					speed: 600,
					resizeReInit: false,
					autoplayDisableOnInteraction: false,
					onFirstInit:function(swiper){
						jQuery(swiper.wrapper).find('.swiper-slide').fadeIn();
						jQuery(swiper.wrapper).find('.sc_slider_subtitle').each(function(){
							trex_slider_align_spans(jQuery(this))
						});
						if(jQuery(swiper.container).hasClass('sc_slider_progress')) {
							var slideTime = swiper.params.autoplay;
							var sliderWidth = swiper.width;
							jQuery(swiper.wrapper).parent().append('<span class="progress"></span>');
							jQuery(swiper.wrapper).parent().find('>.progress').animate({'width' : sliderWidth}, slideTime, 'linear');
						}
					},
					onSlideChangeStart:function(swiper) {
						jQuery(swiper.wrapper).parent().find('>.progress').stop( true, true ).css({'width' : 0});
					},
					onSlideChangeEnd:function(swiper) {
						var slideTime = swiper.params.autoplay;
						var sliderWidth = swiper.width;
						jQuery(swiper.wrapper).parent().find('>.progress').animate({'width' : sliderWidth}, slideTime, 'linear');
							if(swiperPages[id]) {
								var currentId = swiper.activeIndex;
									var toId = swiper.activeIndex > swiper.previousIndex ? currentId+1  : currentId-1;
									if(!jQuery(swiperPages[id].slides[toId]).hasClass('swiper-slide-visible')) {
  										swiperPages[id].swipeTo(currentId);
  									}
  								jQuery('.'+id+' + .flex-control-nav').find('li').removeClass('current').eq(currentId).addClass('current');
  							}

					},
					onSlideClick: function(swiper) {
						var clikedInd = swiper.clickedSlideIndex;
						var container = jQuery(swiper.container);
						var slide_obj = container.find('.swiper-slide').eq(clikedInd);
						temp_html = slide_obj.html();
						if(slide_obj.hasClass('format-video') && slide_obj.data('video')) {
							var videoCode = slide_obj.data('video');
							slide_obj.html(videoCode);
							slide_obj.addClass('playing');
							swiper.stopAutoplay();
							container.addClass('autostop');
						}
					}
				});
				jQuery(this).data('settings', {mode: 'horizontal'});		// VC hook

				if(jQuery(this).hasClass('pagination_style_thumbs') || jQuery(this).hasClass('pagination_style_icons')) {
						swiperPages[id] = new Swiper('.'+id+' + .flex-control-nav', {
						loop: false,
  						mode:'vertical',
  						slidesPerView:'auto',
  						slidesPerViewFit: 'false',
  						onSlideClick: function(slide) {
  							var clickedSlide = slide.clickedSlideIndex;
  							mySwiper[id].swipeTo(clickedSlide);
  							var main_cont = mySwiper[id].container;
  							var video_slide = jQuery(main_cont).find('.playing').removeClass('playing').html(temp_html);
  							if(jQuery(main_cont).hasClass('autostop')) {
  								jQuery(main_cont).removeClass('autostop');
  								mySwiper[id].startAutoplay();
  							}
  						},
						scrollContainer: true,
						scrollbar: {
							container: '.'+id+' + .flex-control-nav .swipe_scroll_vertical',
							draggable: true,
							hide: false
						}
					});
				}
				var navi = jQuery(this).find('.flex-direction-nav');
				if (navi.length == 0) navi = jQuery(this).siblings('.flex-direction-nav');
				navi.find('.flex-prev').click(function(e){
					var swiper = jQuery(this).parents('.sc_slider_swiper');
					if (swiper.length == 0) swiper = jQuery(this).parents('.flex-direction-nav').siblings('.sc_slider_swiper');
					var id = swiper.attr('id');
					e.preventDefault();
					mySwiper[id].swipePrev();
				});
				navi.find('.flex-next').click(function(e){
					var swiper = jQuery(this).parents('.sc_slider_swiper');
					if (swiper.length == 0) swiper = jQuery(this).parents('.flex-direction-nav').siblings('.sc_slider_swiper');
					var id = swiper.attr('id');
					e.preventDefault();
					mySwiper[id].swipeNext();
				});
			});
	}
	if (container.find('.sc_blogger.style_carousel:not(.inited)').length > 0) {
		var mySwiperCarousel = {};		
		container.find('.sc_blogger.style_carousel:not(.inited)').each(function () {
			"use strict";
			if (jQuery(this).parents('div:hidden').length > 0) return;
			jQuery(this).addClass('inited');
			var id = jQuery(this).attr('id');
			if (id == undefined) {
				id = 'swiper_'+Math.random();
				id = id.replace('.', '');
				jQuery(this).attr('id', id);
			}
			jQuery(this).addClass(id);
			mySwiperCarousel[id] = new Swiper('.'+id, {
				loop: false,
				calculateHeight: true,
				slidesPerView: 'auto',
				grabCursor: true,
			    paginationClickable: true,
				autoplay: 7000,
				speed: 600,
				preventLinks : false,
				initialSlide: -1,
				preventLinksPropagation: false,
				scrollContainer: true,
				scrollbar: {
					container: '.swiper_scrollbar',
					draggable: true
				}
			});
			jQuery('.'+id+' .prev_slide').on('click', function(e){
				e.preventDefault();
				mySwiperCarousel[id].swipePrev();
			});
			jQuery('.'+id+' .next_slide').on('click', function(e){
				e.preventDefault();
				mySwiperCarousel[id].swipeNext();
			});

		});	
	}
	jQuery('.swiper-slide .colorbox_link').magnificPopup({
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
	//Scroll
	if (container.find('.sc_scroll:not(.inited)').length > 0) {
		container.find('.sc_scroll:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var id = jQuery(this).attr('id');
				if (id == undefined) {
					id = 'scroll_'+Math.random();
					id = id.replace('.', '');
					jQuery(this).attr('id', id);
				}
				jQuery(this).addClass(id);
				myScroll[id] = new Swiper('.'+id, {
					freeMode: true,
					freeModeFluid: true,
					grabCursor: true,
					mode: jQuery(this).hasClass('sc_scroll_vertical') ? 'vertical' : 'horizontal',
					slidesPerView: jQuery(this).hasClass('sc_scroll') ? 'auto' : 1,
					mousewheelControl: true,
					mousewheelAccelerator: 4,	// Accelerate mouse wheel in Firefox 4+
					scrollContainer: jQuery(this).hasClass('sc_scroll_vertical'),
					scrollbar: {
						container: '.'+id+'_bar',
						hide: true,
						draggable: true  
					}
				});
				jQuery(this).data('settings', {mode: 'horizontal'});		// VC hook
			});
	}

	//Countdown
	if (container.find('.sc_countdown:not(.inited)').length > 0) {
		var myCountdown = {};
		container.find('.sc_countdown:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var id = jQuery(this).attr('id');
				if (id == undefined) {
					id = 'countdown_'+Math.random();
					id = id.replace('.', '');
					jQuery(this).attr('id', id);
				}
				var curDate = new Date();
				var endDate = jQuery(this).data('date');
				if (endDate == undefined || endDate == '')
					endDate = curDate.getFullYear() + '-' + (curDate.getMonth()+1) + '-' + curDate.getDay();
				endDate = endDate.split('-');
				var endTime = jQuery(this).data('time');
				if (endTime == undefined || endTime == '')
					endTime = '00:00:00';
				endTime = endTime.split(':');
				if (endTime.length==2) endTime[2] = 0;
				var destDate = new Date(endDate[0], endDate[1]-1, endDate[2], endTime[0], endTime[1], endTime[2]);
				var diff = Math.round(destDate.getTime() / 1000 - curDate.getTime() / 1000);
				myCountdown[id] = jQuery('#'+id).FlipClock(diff, {
					countdown: true,
					clockFace: 'DailyCounter'
				});
			});
	}

	//Zoom
	if (container.find('.sc_zoom:not(.inited)').length > 0) {
		container.find('.sc_zoom:not(.inited)')
			.each(function () {
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				jQuery(this).find('img').elevateZoom({
					zoomType: "lens",
					lensShape: "round",
					lensSize: 200
				});
			});
	}

	//skills init
	if (container.find('.sc_skills_item:not(.inited)').length > 0) {
		skills_init(container);
		jQuery(window).scroll(function () { skills_init(container); });
	}

}

// skills init
function skills_init(container) {
	if (arguments.length==0) var container = jQuery('body');
	var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();

	container.find('.sc_skills_item:not(.inited)').each(function () {
		var skillsItem = jQuery(this);
		var scrollSkills = skillsItem.offset().top;
		if (scrollPosition > scrollSkills) {
			skillsItem.addClass('inited');
			var skills = skillsItem.parents('.sc_skills').eq(0);
			var type = skills.data('type');
			var total = skillsItem.find('.sc_skills_item_progress').eq(0);
			var item_counter = skillsItem.find('.sc_skills_item_counter').eq(0);
			var start = parseInt(total.data('start'));
			var stop = parseInt(total.data('val'));
			var maximum = parseInt(total.data('max'));
			var startPercent = Math.round(start/maximum*100);
			var stopPercent = Math.round(stop/maximum*100);
			var ed = total.data('ed');
			var duration = parseInt(total.data('duration'));
			var speed = parseInt(total.data('speed'));
			var step = parseInt(total.data('step'));
			if (type == 'bar') {
				var dir = skills.data('dir');
				var count = skillsItem.find('.sc_skills_item_progress').eq(0);
				if (dir=='horizontal') {
					count.animate({ width: stop + '%' }, 1000);
					var item_level = jQuery(this).find('.sc_skills_item_level').text();
					var offset_level = jQuery(this).find('.sc_skills_item_level').position().left;
					offset_level = Math.round(offset_level);

					var prog_holder = jQuery(this).find('.sc_skills_item_progress');
					prog_holder.append('<span class="sc_skills_item_progress_val">'+item_level+'</span>');
					prog_holder.find('.sc_skills_item_progress_val').css({'left' : offset_level});
				}
				else if (dir=='vertical')
					count.find('.progress_inner').animate({ height: stop + 'px' }, 1000);
			} else if (type == 'counter') {
				skills_counter(0, stop, 30, step, ed, total);
			}
			else if (type == 'circles') {
				var elem = jQuery(this).find('.sc_skills_item_level');
				var stop = elem.data('val');
				var step = elem.data('step');
				var ed = elem.data('ed');
				skills_counter(0, stop, 30, step, ed, elem);
			}
		}
	});
}

//skills counter animation
function skills_counter(start, stop, speed, step, ed, total) {
	start = Math.min(stop, start + step);
	total.text(start+ed);
	if (start < stop) {
		setTimeout(function () {
			skills_counter(start, stop, speed, step, ed, total);
		}, speed);
	}
}

function trex_slider_align_spans(block, reset) {
	var count = block.find('span').length;
	block.find('span').each(function(){
		var th = jQuery(this);
		if(reset) {
			th.removeAttr('class');
		}
		var pos_left = th.position().left;

		if(pos_left == 0) {
			th.addClass('first');
		}		
		if(th.next().length == 0) {
			th.addClass('last');
		}
		else{
			if(th.next().position().left == 0) {
				th.addClass('last');
			}
		}
		if(th.hasClass('last') && th.position().left == 0 && th.next().length > 0) {
			th.attr('class', 'first').prev().addClass('last');
		}
	});
}
function trex_countdown_init(block_id, date) {
	"use strict";
	var date_till = new Date();
	date_till.setTime(Date.parse(date));
	jQuery('#'+block_id).countdown({
		until: date_till,
		format: 'DHMS',
		layout: '{d<}<div><div class="num_wrap"><span class="number">{dn}</span> <span class="label">{dl}</span></div></div>{d>}'+
				'{h<}<div><div class="num_wrap"><span class="number">{hn}</span> <span class="label">{hl}</span></div></div>{h>}'+ 
				'{m<}<div><div class="num_wrap"><span class="number">{mn}</span> <span class="label">{ml}</span></div></div>{m>}'+
				'{s<}<div><div class="num_wrap"><span class="number">{sn}</span> <span class="label">{sl}</span></div></div>{s>}'
	});
}
function trex_skills_bar_level(th) {
	var value_span = th.find('.sc_skills_item_progress_val');
	var new_left = th.find('.sc_skills_item_level').position().left;
	if(value_span.length > 0) {
		value_span.css({'left': new_left});
	}
}