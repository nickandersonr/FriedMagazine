<?php 
	$useragent = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
?>

<div class="swpRightPos<?php echo empty($_COOKIE['prevVisited']) && strpos($useragent, 'iPhone') === false ? ' vis' : ''; ?>">
	<?php
	global $THEMEREX_panelmenu, $logo_image;
	
	$tab = (int) get_custom_option('right_panel_tab');
	$site_desc = get_bloginfo('description');
	$shift = 0;
	if (get_theme_option('show_theme_customizer') != 'yes' && $tab > 0) $shift++;
	if (!$THEMEREX_panelmenu && $tab > 2) $shift++;
	$tab = max(0, $tab - $shift);
	
	?>
	<div class="sc_tabs" data-active="<?php echo $tab; ?>">
		<div class="tabHeadsWrap">
			<ul class="tabsMenuHead">
				<?php if (get_theme_option('show_theme_customizer') == 'yes') { ?>
				<li class="right_tab_custom"><a class="tabsCustom" href="#tabsCustom" title="<?php _e('Custom panel', 'themerex'); ?>"><i class="icon-levels"></i></a></li>
				<?php } ?>
				<?php
				if ($THEMEREX_panelmenu) { 
				?>
				<li class="right_tab_menu"><a class="tabsMenu" href="#tabsMenu" title="<?php _e('Custom menu', 'themerex'); ?>"><i class="icon-list26"></i></a></li>
				<?php } ?>
				<li class="right_tab_favorites"><a class="tabsFavorite" href="#tabsFavorite" title="<?php _e('Bookmarks', 'themerex'); ?>"><i class="icon-star48"></i></a></li>
			</ul>			
			<a href="#" class="panel_open"><i class="icon-machine4"></i></a>
		</div>

		<?php
		if (get_theme_option('show_theme_customizer') == 'yes') {
			$theme_color = get_custom_option('theme_color');
			$menu_style = get_custom_option('menu_style');
			$body_style = get_custom_option('body_style');
			$bg_color = get_custom_option('bg_color');
			$bg_pattern = get_custom_option('bg_pattern');
			$bg_image = get_custom_option('bg_image');
			?>
			<div id="tabsCustom" class="tabsMenuBody">
				<div id="custom_options">
					<div id="custom_options_scroll" class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container">
						<div class="sc_scroll_wrapper swiper-wrapper">
							<div class="sc_scroll_slide swiper-slide">
								<div class="co_header">
									<h4 class="co_title"><?php _e('Choose Your Style', 'themerex'); ?></h4>									
								</div>
								<div class="co_options">
									<form name="co_form">
										<input type="hidden" id="co_site_url" name="co_site_url" value="<?php echo esc_attr('http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" />
										<div class="co_form_row">
											<input type="hidden" name="co_body_style" value="<?php echo esc_attr($body_style); ?>" />
											<span class="co_label"><?php _e('Layout style', 'themerex'); ?></span>
											<div class="co_switch_box">
												<a href="#" class="co_switch_label boxed<?php echo $body_style == 'boxed' ? ' active' : ''; ?>"><?php _e('Boxed', 'themerex'); ?></a><!-- 
											 --><a href="#" class="co_switch_label wide<?php echo $body_style == 'wide' ? ' active' : ''; ?>"><?php _e('Wide', 'themerex'); ?></a>
											</div>
										</div>
										<div class="co_form_row">
											<div class="co_form_subrow">
												<input type="hidden" name="co_theme_color" value="<?php echo esc_attr($theme_color); ?>" />
												<div class="co_picker_wrap"><div id="co_theme_preset" class="iColorPicker"></div></div>
												<span class="co_label co_inline"><?php _e('Custom color', 'themerex'); ?></span>
											</div>
										</div>
										<div class="co_form_row">
											<div class="co_form_subrow">
												<input type="hidden" name="co_bg_color" value="<?php echo esc_attr($bg_color); ?>" />
												<div class="co_picker_wrap"><div id="co_bg_color" class="iColorPicker"></div></div>
												<span class="co_label co_inline"><?php _e('Body background color', 'themerex'); ?></span>
											</div>
										</div>
										<div class="co_form_row patterns">
											<input type="hidden" name="co_bg_pattern" value="<?php echo esc_attr($bg_pattern); ?>" />
											<span class="co_label"><?php _e('Patterns', 'themerex'); ?></span>
											<div id="co_bg_pattern_list">
												<?php for ($i=0; $i<=9; $i++) { ?><!-- 
												 --><a href="#" id="pattern_<?php echo $i; ?>" class="co_pattern_wrapper<?php echo $bg_pattern==$i ? ' current' : '' ; ?>" style="background: url(<?php echo get_template_directory_uri(); ?>/images/bg/pattern_<?php echo $i; ?>_thumb.png) 0 0 repeat; width:22px; height:22px; display:inline-block;"></a><?php } ?>
											</div>
										</div>
										<div class="co_form_row images">
											<input type="hidden" name="co_bg_image" value="<?php echo esc_attr($bg_image); ?>" />
											<span class="co_label"><?php _e('Background image', 'themerex'); ?></span>
											<div id="co_bg_images_list">
												<?php for ($i=1; $i<=6; $i++) { ?>
												<a href="#" id="image_<?php echo $i; ?>" class="co_image_wrapper<?php echo $bg_image==$i ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/image_<?php echo $i; ?>_thumb2.jpg" width="48" height="28" alt="" /></a>
												<?php } ?>
											</div>
										</div>
										<div class="co_form_row reset">
											<a href="#" id="co_theme_reset" class="co_reset_to_default icon-arrows-cw" title="<?php _e('Reset to default', 'themerex'); ?>"><i class="icon-retweet"></i><?php _e('Reset', 'themerex'); ?></a>
										</div>
									</form>
									<script type="text/javascript" language="javascript">
										jQuery(document).ready(function(){
											// Theme & Background color
											jQuery('#co_theme_color').css('backgroundColor', '<?php echo $theme_color; ?>');
											jQuery('#co_theme_preset').css('backgroundColor', '<?php echo $theme_color; ?>');
											jQuery('#co_bg_color').css('backgroundColor', '<?php echo $bg_color; ?>');    
										});
									</script>
								</div>
							</div>
						</div>
						<div id="custom_options_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical custom_options_scroll_bar"></div>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<?php if ($THEMEREX_panelmenu) { ?>
		<div id="tabsMenu" class="tabsMenuBody">
			<?php if(!empty($logo_image)) { ?>
			<div class="right_panel_logo"><img src="<?php echo $logo_image; ?>" alt=""></div>
			<?php } ?>
			<div class="site_tagline_panel"><?php echo $site_desc; ?></div>
			<div class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container" id="panelmenu_scroll">
				<div class="sc_scroll_wrapper swiper-wrapper">
					<div class="sc_scroll_slide swiper-slide">
						<nav role="navigation" class="panelmenu_area widget_area">
							<?php echo $THEMEREX_panelmenu; ?>
						</nav>
					</div>
				</div>
				<?php if (get_custom_option('show_search')=='yes') { ?>
				<div class="searchBlock">
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" class="searchField" placeholder="<?php _e('Search &hellip;', 'themerex'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php _e('Search 	for:', 'themerex'); ?>" />
						<button class="form_submit"><i class="icon-search"></i></button>
					</form>
				</div>
				<?php } ?>
				<div id="panelmenu_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical panelmenu_scroll_bar"></div>
			</div>		
		</div>
		<?php } ?>
		
		<div id="tabsFavorite" class="tabsMenuBody">
			<div class="addBookmarkArea"><a href="#" class="addBookmark"><i class="icon-star-empty-1"></i><?php _e('Add bookmark', 'themerex'); ?></a></div>
			<div class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container scroll-no-swiping" id="bookmarks_scroll">
				<div class="sc_scroll_wrapper swiper-wrapper">
					<div class="sc_scroll_slide swiper-slide swiper-no-swiping">
						<?php
						$list = getValueGPC('themerex_bookmarks', '');
						if (!empty($list)) $list = json_decode($list, true);
						?>
						<ol class="listBookmarks">
							<?php 
							if (!empty($list)) {
								foreach ($list as $key => $bm) {
									echo '<li><span class="bm_num">'.((int)$key + 1).'</span><a href="'.$bm['url'].'" class="bm_page_name">'.$bm['title'].'</a><a href="#" class="delBookmark icon-cancel"></a></li>';
								}
							}
							?>
						</ol>
					</div>
				</div>
				<div id="bookmarks_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical bookmarks_scroll_bar"></div>
			</div>
		</div>
		
	</div>

</div>
