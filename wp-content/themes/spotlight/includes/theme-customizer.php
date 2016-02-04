<?php
// Redefine colors in styles
$THEMEREX_custom_css = "";

function getThemeCustomStyles() {
	global $THEMEREX_custom_css;
	return $THEMEREX_custom_css;
}

function addThemeCustomStyle($style) {
	global $THEMEREX_custom_css;
	$THEMEREX_custom_css .= "
		{$style}
	";
}

function prepareThemeCustomStyles() {
	// Custom font
	$fonts = getThemeFontsList(false);
	$font = get_custom_option('theme_font');
	$body_bg = get_custom_option('bg_color');
	$theme_color = get_custom_option('theme_color');
	if (isset($fonts[$font])) {
		addThemeCustomStyle("
			body, button, input, select, textarea {
				font-family: '".$font."', ".$fonts[$font]['family'].";
			}
			body {
				background: ".$body_bg."
			}
		");
	}
	
	// Custom menu
	if (get_custom_option('menu_colored')=='yes') {
		$menu_name = 'mainmenu';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
			if (is_object($menu) && $menu) {
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				$menu_styles = '';
				$menu_slider = get_custom_option('menu_slider')=='yes';
				if (count($menu_items) > 0) {
					foreach($menu_items as $k=>$item) {
		//				if ($item->menu_item_parent==0) {
							$cur_accent_color = '';
							if ($item->type=='taxonomy' && $item->object=='category') {
								$cur_accent_color = get_category_inherited_property($item->object_id, 'theme_accent_color');
							}
							if ((empty($cur_accent_color) || is_inherit_option($cur_accent_color)) && isset($item->classes[0]) && !empty($item->classes[0])) {
								$cur_accent_color = (themerex_substr($item->classes[0], 0, 1)!='#' ? '#' : '').$item->classes[0];
							}
							if (!empty($cur_accent_color) && !is_inherit_option($cur_accent_color)) {
								$menu_styles .= ($item->menu_item_parent==0 ? "#header_middle_inner #mainmenu li.menu-item-{$item->ID}.current-menu-item > a," : '')
									. "
									#header_middle_inner #mainmenu li.menu-item-{$item->ID} > a:hover,
									#header_middle_inner #mainmenu li.menu-item-{$item->ID}.sfHover > a {
										background-color: {$cur_accent_color} !important;
									}
									#header_middle_inner #mainmenu li.menu-item-{$item->ID} ul {
										background-color: {$cur_accent_color} !important;
									}
								";
							}
							if ($menu_slider && $item->menu_item_parent==0) {
								$menu_styles .= "
									#header_middle_inner #mainmenu li.menu-item-{$item->ID}.blob_over:not(.current-menu-item) > a:hover,
									#header_middle_inner #mainmenu li.menu-item-{$item->ID}.blob_over.sfHover > a {
										background-color: transparent !important;
									}
									";
							}
		//				}
					}
				}
				if (!empty($menu_styles)) {
					addThemeCustomStyle($menu_styles);
				}
			}
		}
	}
	
	// Main menu height
	$menu_height = (int) get_custom_option('menu_height');
	if ($menu_height > 20) {
		addThemeCustomStyle("
			#mainmenu > li > a {
				height: {$menu_height}px !important;
				line-height: {$menu_height}px !important;
			}
			#mainmenu > li ul {
				top: {$menu_height}px !important;
			}
			#header_middle {
				min-height: {$menu_height}px !important;
			}
		");
	}
	// Submenu width
	$menu_width = (int) get_custom_option('menu_width');
	
	if ($menu_width > 50) {
		addThemeCustomStyle("
			#mainmenu > li ul {
				width: {$menu_width}px;
			}
			#mainmenu > li ul li ul {
				left: ".($menu_width+1)."px;
			}
			#mainmenu > li:nth-child(n+6) ul li ul {
				left: -".($menu_width+1)."px;
			}
		");
	}
	if(!empty($theme_color)) {
		addThemeCustomStyle('
			#sidebar_main .popular_and_commented_tabs .tab_content:not(.style_post_format) .post_item .post_title a:hover, 
			.wp-calendar thead th.prevMonth a:hover,
			.wp-calendar thead th.nextMonth a:hover,
			.wp-calendar tbody td.dayWithPost a:hover,
			.widget_twitter .theme_text a,
			.top_news_section .top_news_term a:hover,
			a:hover,
			.trex_accent_color,
			.post_info .post_title a:hover,
			.link_text_wrap a,
			.sc_quote_icon,
			article.format-link > .icon,
			blockquote.sc_quote,
			article.format-aside > .icon,
			article.format-chat > .icon,
			article.format-status > .icon,
			#nav_pages ul li:hover a,
			#nav_pages ul li:hover span,
			#nav_pages ul li.pager_current span,
			#nav_pages .pager_prev a:hover,
			#nav_pages .pager_next a:hover,
			.isotopeFiltr ul li a:hover,
			section.author .user_links ul li span:hover,
			.comment_content .review .label i,
			.popularFiltr ul li.ui-state-active a span,
			.prev_next_posts .prev_post_icon,
			.prev_next_posts .next_post_icon,
			.prev_next_posts .prev_post_link a:hover,
			.prev_next_posts .next_post_link a:hover,
			.link_pages a:hover,
			.itemscope .post_tags a:hover,
			.article_services section.comments li.comment .comment_header .comment_reply a,
			.swpRightPos .sc_tabs .tabsMenuHead li.ui-tabs-active a,
			.swpRightPos .sc_tabs .tabsMenuHead li a:hover,
			.swpRightPos .addBookmark:hover i,
			.swpRightPos .listBookmarks li:hover a,
			#panelmenu li a:hover,
			.popular_and_commented_tabs ul.tabs li a:hover,
			.popular_and_commented_tabs .tab_content .post_item a:hover,
			.popular_and_commented_tabs .tab_content .post_item i.format-icon.hover:before,
			.footerWidget .popular_and_commented_tabs .tab_content h5.post_title a:hover,
			#sidebar_main .widget ul li a:hover,
			.sc_accordion.sc_accordion_style_1 .sc_accordion_item h4.sc_accordion_title i.icon,
			.sc_dropcaps .sc_dropcap,
			.sc_tooltip_parent,
			.sc_skills.sc_skills_type_counter .sc_skills_item_progress,
			.sc_title_icon,
			.sc_title_bg.sc_title_without_bg,
			.sc_icon,
			.sc_tabs ul.sc_tabs_titles li a .icon,
			.slider_wrap .sc_slider_swiper + .flex-control-nav ul li.current .post_icon,
			.sc_testimonials .flex-direction-nav li a,
			.sc_testimonials.sc_testimonials_style_2 .flex-direction-nav li a:hover,
			.sc_blogger .sc_blogger_item .sc_blogger_title a:hover,
			.sc_blogger.style_list .sc_blogger_item > .icon,
			.sc_blogger.style_carousel .sc_blogger_item .post_links a:hover,
			.sc_blogger.style_carousel .prev_slide:hover,
			.sc_blogger.style_carousel .next_slide:hover,
			.sc_review_panel .sc_review_title,
			.sc_team .sc_team_item .sc_team_item_position,
			.sc_list.sc_list_style_ol li .sc_list_num,
			.sc_list.sc_list_style_ol_filled li .sc_list_num,
			.sc_list.sc_list_style_iconed li:before {
				color: '.($theme_color).';
			}
			#nav_pages .pager_prev a:hover,
			#nav_pages .pager_next a:hover,
			.isotopeFiltr ul li.active a,
			.pagination_viewmore .view_more_button:hover,
			.popular_and_commented_tabs ul.tabs li.ui-tabs-active a,
			.link_pages a:hover,
			.popular_and_commented_tabs ul.tabs li a:hover,
			.wp-calendar thead th.prevMonth a:hover,
			.wp-calendar thead th.nextMonth a:hover,
			.wp-calendar tbody td.dayWithPost,
			.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,
			.sc_dropcaps.sc_dropcaps_style_2 .sc_dropcap,
			.sc_dropcaps .sc_dropcap,
			.sc_tooltip_parent,
			.sc_blogger .sc_blogger_block_link:hover,
			.sc_blogger.style_carousel .prev_slide:hover,
			input[type="submit"]:hover,
			.sc_blogger.style_carousel .next_slide:hover {
				border-color: '.($theme_color).';
			}
			article.format-aside > .article_wrap,
			.isotopeFiltr ul li.active a,
			section.author .user_links span.tooltip,
			.vote_criterias li a:hover:before,
			.vote_criterias li a:active:before,
			.link_pages .pages_popup .popup_inner,
			.popular_and_commented_tabs ul.tabs li.ui-tabs-active a,
			#sidebar_main .widget.widget_recent_entries ul li a:before,
			.widget.widget_flickr .flickr_images a,
			.widget_contact_social .tooltip,
			.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,
			.sc_dropcaps.sc_dropcaps_style_2 .sc_dropcap,
			.sc_skills.sc_skills_type_bar .sc_skills_item .sc_skills_item_progress,
			.sc_skills.sc_skills_type_bar .sc_skills_item .sc_skills_item_progress .progress_inner,
			.sc_slider_swiper .progress,
			.sc_testimonials .flex-direction-nav li a:hover,
			.sc_blogger_item .thumb a,
			.sc_blogger_item .thumb a .hover_plus,
			.sc_blogger.style_accordion .sc_blogger_item .sc_blogger_title a:hover,
			.sc_blogger.style_date .sc_blogger_item .post_date_info .month,
			.sc_blogger.style_carousel .sc_blogger_item .overlay_mask,
			.sc_blogger.style_carousel .swiper_scrollbar .swiper-scrollbar-drag,
			.sc_button,
			.sc_blogger .sc_blogger_block_link:hover,
			.sc_list.sc_list_style_ul li:before,
			input[type="submit"]:hover,
			a:hover .sc_title_icon,
			.sc_list.sc_list_style_ol_filled li .sc_list_num {
				background: '.($theme_color).';
			}
		');
	}

	// Custom css from theme options
	$css = get_custom_option('custom_css');
	$section1_bg = get_custom_option('section_1_bg');
	$section2_bg = get_custom_option('section_2_bg');
	$section1_font = get_custom_option('section_1_font');
	$section2_font = get_custom_option('section_2_font');
	$section2_top_margin = get_custom_option('section2_margin_top');
	$section2_bottom_margin = get_custom_option('section2_margin_bottom');
	
	$css .= !empty($section1_font) ? '.section_2 { color: '.$section2_font.'}' : '';
	$css .= !empty($section1_font) ? '.section_1,#topmenu li a, header .section_1 .login_loguout_link { color: '.$section1_font.'}' : '';
	$css .= !empty($section1_bg) ? 'header .section_1 { background: '.$section1_bg.'}' : '';
	
	$sect2_style = '.section_2 {';
	
	$sect2_style .= !empty($section2_bg) ? ' background: '.$section2_bg.';' : '';
	$sect2_style .= !empty($section2_top_margin) ? ' padding-top: '.$section2_top_margin.'px; ' : '';
	$sect2_style .= !empty($section2_bottom_margin) ? ' padding-bottom: '.$section2_bottom_margin.'px; ' : '';
	
	$sect2_style .= '}';
	$css .= !empty($sect2_style) ? $sect2_style : '';
	
	$constructId = getTemplatePageId('under-construction');
	if( !empty($constructId) && get_the_ID() == $constructId) {
		$construct_thumb = wp_get_attachment_url( get_post_thumbnail_id( $constructId ) );
		$css .= !empty($construct_thumb) ? '#page { background-image: url( '.$construct_thumb.' ) }' : '';
	}
	
	if (!empty($css)) {
		addThemeCustomStyle($css);
	}
	
	return getThemeCustomStyles();
};
?>