// Customization panel
var default_color = '#4f99bc';
var color_selctors = '#sidebar_main .popular_and_commented_tabs .tab_content:not(.style_post_format) .post_item .post_title a:hover, .wp-calendar thead th.prevMonth a:hover, .wp-calendar thead th.nextMonth a:hover, .wp-calendar tbody td.dayWithPost a:hover, .widget_twitter .theme_text a,.top_news_section .top_news_term a:hover,a:hover,.trex_accent_color,.post_info .post_title a:hover,	.link_text_wrap a,.sc_quote_icon,article.format-link > .icon,blockquote.sc_quote,article.format-aside > .icon,article.format-chat > .icon,article.format-status > .icon,#nav_pages ul li:hover a,#nav_pages ul li:hover span,#nav_pages ul li.pager_current span,#nav_pages .pager_prev a:hover,#nav_pages .pager_next a:hover,	.isotopeFiltr ul li a:hover,.pagination_viewmore .view_more_button:hover,section.author .user_links ul li span:hover,.comment_content .review .label i,.popularFiltr ul li.ui-state-active a span,.prev_next_posts .prev_post_icon,.prev_next_posts .next_post_icon,.prev_next_posts .prev_post_link a:hover,.prev_next_posts .next_post_link a:hover,.link_pages a:hover,.itemscope .post_tags a:hover,.article_services section.comments li.comment .comment_header .comment_reply a,.swpRightPos .sc_tabs .tabsMenuHead li.ui-tabs-active a,.swpRightPos .sc_tabs .tabsMenuHead li a:hover,.swpRightPos .addBookmark:hover i,.swpRightPos .listBookmarks li:hover a,#panelmenu li a:hover,.popular_and_commented_tabs ul.tabs li a:hover,.popular_and_commented_tabs .tab_content .post_item a:hover,.popular_and_commented_tabs .tab_content .post_item i.format-icon.hover:before,.footerWidget .popular_and_commented_tabs .tab_content h5.post_title a:hover,#sidebar_main .widget ul li a:hover';

var border_selectors = '#nav_pages .pager_prev a:hover,#nav_pages .pager_next a:hover,.isotopeFiltr ul li.active a,.pagination_viewmore .view_more_button:hover,.popular_and_commented_tabs ul.tabs li.ui-tabs-active a,.link_pages a:hover,.popular_and_commented_tabs ul.tabs li a:hover,.wp-calendar thead th.prevMonth a:hover,.wp-calendar thead th.nextMonth a:hover,.wp-calendar tbody td.dayWithPost';

var bg_selectors = 'article.format-aside > .article_wrap,.isotopeFiltr ul li.active a,section.author .user_links span.tooltip,.vote_criterias li a:hover:before,.vote_criterias li a:active:before,.link_pages .pages_popup .popup_inner,.popular_and_commented_tabs ul.tabs li.ui-tabs-active a,#sidebar_main .widget.widget_recent_entries ul li a:before,.widget.widget_flickr .flickr_images a,.widget_contact_social .tooltip';

jQuery(document).ready(function() {
	"use strict";
	// Open/close panel

	if (jQuery("#custom_options").length===1) {
		jQuery('#co_toggle').click(function(e) {
			"use strict";
			var co = jQuery('#custom_options').eq(0);
			if (co.hasClass('opened')) {
				co.removeClass('opened').animate({marginRight:-237}, 300);
			} else {
				co.addClass('opened').animate({marginRight:-15}, 300);
			}
			e.preventDefault();
			return false;
		});

		// Themes selector
		jQuery('#custom_options #co_theme_apply').click(function (e) {
			"use strict";
			jQuery('#custom_options .co_theme_selector').each(function () {
				"use strict";
				var subj = jQuery(this).attr('id').substr(3);
				var theme = jQuery(this).val();
				jQuery(this).siblings('input').attr('value', theme);
				jQuery.cookie(subj, theme, {expires: 1, path: '/'});
			});
			window.location = jQuery("#custom_options #co_site_url").val();
			e.preventDefault();
			return false;
		});
		jQuery('#custom_options #co_theme_reset').click(function (e) {
			"use strict";
			jQuery.cookie('main_color', null, {expires: 1, path: '/'});
			jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
			jQuery.cookie('body_style', null, {expires: -1, path: '/'});
			window.location = jQuery("#custom_options #co_site_url").val();
			e.preventDefault();
			return false;
		});

		// Reviews interval
		jQuery('#custom_options #co_reviews_max_level').change(function (e) {
			"use strict";
			var val = jQuery(this).val();
			jQuery(this).siblings('input').attr('value', val);
			jQuery.cookie('reviews_max_level', val, {expires: 1, path: '/'});
			window.location = jQuery("#custom_options #co_site_url").val();
			e.preventDefault();
			return false;
		});

		if(jQuery.cookie('theme_color') != '') {
			var color = jQuery.cookie('theme_color');
			demo_theme_bg(color);
			demo_theme_color(color);
			demo_theme_border(color);
		}

		// Body style
		jQuery('#custom_options .co_switch_box a').click(function(){
			jQuery(this).parent().find('a').removeClass('active');
			jQuery(this).addClass('active');
			var val = jQuery(this).text().toLowerCase();
			if(!jQuery('body').hasClass(val)) {
				if(val == 'wide')
					jQuery('body').removeClass('boxed').addClass(val);
				else if(val == 'boxed')
					jQuery('body').removeClass('wide').addClass(val);
			}		
			jQuery.cookie('body_style', val, {expires: 1, path: '/'});
			jQuery('.sc_slider.sc_slider_swiper').each(function(){
				var sliderId = jQuery(this).attr('id');
				mySwiper[sliderId].resizeFix();
			});
			return false;
		});

		// Main theme color and Background color
		iColorPicker();
		jQuery('#custom_options .iColorPicker').click(function (e) {
			"use strict";
			default_color = '#'+getHexRGBColor(jQuery(this).css('backgroundColor'));
			iColorShow(null, jQuery(this), function(fld, clr) {
				"use strict";
				fld.css('backgroundColor', clr);
				fld.siblings('input').attr('value', clr);
				if (fld.attr('id')==='co_theme_preset') {
					//set_theme_color(clr);
					demo_theme_bg(clr);
					demo_theme_color(clr);
					demo_theme_border(clr);
					jQuery.cookie('theme_color', clr, {expires: 1, path: '/'});
					//window.location = jQuery("#custom_options #co_site_url").val();
				} else {
					jQuery("#custom_options .co_switch_box .boxed").trigger('click');
					jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
					jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
					jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
					jQuery.cookie('bg_color', clr, {expires: 1, path: '/'});
					jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_pattern_6 bg_pattern_7 bg_pattern_8 bg_pattern_9 bg_pattern_0 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').css('backgroundColor', clr);
				}
			});
		});
		
		// Background patterns
		jQuery('#custom_options #co_bg_pattern_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', val, {expires: 1, path: '/'});
			jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_pattern_6 bg_pattern_7 bg_pattern_8 bg_pattern_9 bg_pattern_0 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').addClass('bg_pattern_' + val);
			e.preventDefault();
			return false;
		});
		
		jQuery('#custom_options #co_bg_pattern_list a').hover(function(e) {
			var $th = jQuery(this);
			var th_bg = $th.css('backgroundImage');
			$th.parents('.co_form_row.patterns').css({'backgroundImage' : th_bg});
		},function() {
			jQuery(this).parents('.co_form_row.patterns').removeAttr('style');
		});

		jQuery('#custom_options #co_bg_images_list a').hover(function(e) {
			var $th = jQuery(this);
			var th_bg = 'url('+$th.find('img').attr('src')+')';
			th_bg = th_bg.replace('thumb2','thumb');
			$th.parents('.co_form_row.images').css({'backgroundImage' : th_bg});
		},function() {
			jQuery(this).parents('.co_form_row.images').removeAttr('style');
		});

		// Background images
		jQuery('#custom_options #co_bg_images_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_images_list .co_image_wrapper,#custom_options #co_bg_pattern_list .co_pattern_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_image', val, {expires: 1, path: '/'});
			jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').addClass('bg_image_' + val);
			e.preventDefault();
			return false;
		});

	}
});

function set_theme_color(color) {
	jQuery(color_selctors).css({'color':color});
}
function demo_theme_bg(color) {
	jQuery('*').each(function(){
		var itemBg = jQuery(this).css('backgroundColor');
		if(itemBg != '') {
			itemBg = '#'+getHexRGBColor(jQuery(this).css('backgroundColor'));
		}
		if(itemBg == default_color) {
			jQuery(this).css({'backgroundColor':color});
		}
	});
}
function demo_theme_color(color) {
	jQuery('*').each(function(){
		var itemCl = jQuery(this).css('color');
		if(itemCl != '') {
			itemCl = '#'+getHexRGBColor(jQuery(this).css('color'));
		}
		if(itemCl == default_color) {
			jQuery(this).css({'color':color});
		}
	});
}
function demo_theme_border(color) {
	jQuery('*').each(function(){
		var itemBdt = jQuery(this).css('borderTopColor');
		var itemBdb = jQuery(this).css('borderBottomColor');
		var itemBdl = jQuery(this).css('borderLeftColor');
		var itemBdr = jQuery(this).css('borderRightColor');

		if(itemBdt != '') {
			itemBdt = '#'+getHexRGBColor(jQuery(this).css('borderTopColor'));
		}
		if(itemBdt == default_color) {
			jQuery(this).css({'borderTopColor':color});
		}

		if(itemBdb != '') {
			itemBdb = '#'+getHexRGBColor(jQuery(this).css('borderBottomColor'));
		}
		if(itemBdb == default_color) {
			jQuery(this).css({'borderBottomColor':color});
		}

		if(itemBdl != '') {
			itemBdl = '#'+getHexRGBColor(jQuery(this).css('borderLeftColor'));
		}
		if(itemBdl == default_color) {
			jQuery(this).css({'borderLeftColor':color});
		}

		if(itemBdr != '') {
			itemBdr = '#'+getHexRGBColor(jQuery(this).css('borderRightColor'));
		}
		if(itemBdr == default_color) {
			jQuery(this).css({'borderRightColor':color});
		}
	});
}
function getHexRGBColor(color) {
	color = color.replace(/\s/g,"");
	var aRGB = color.match(/^rgb\((\d{1,3}[%]?),(\d{1,3}[%]?),(\d{1,3}[%]?)\)$/i);

	if(aRGB)
	{
		color = '';
		for (var i=1;  i<=3; i++) color += Math.round((aRGB[i][aRGB[i].length-1]=="%"?2.55:1)*parseInt(aRGB[i])).toString(16).replace(/^(.)$/,'0$1');
	}
	else color = color.replace(/^#?([\da-f])([\da-f])([\da-f])$/i, '$1$1$2$2$3$3');
	
	return color;
}