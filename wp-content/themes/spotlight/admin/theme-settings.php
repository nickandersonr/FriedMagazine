<?php

// Prepare arrays 
if (is_themerex_options_used()) {
	$fonts 			= getThemeFontsList();
	$themes 		= getThemesList();
	$socials 		= getSocialsList();
	$icons 			= getIconsList();
	$categories 	= getCategoriesList();
	$sidebars 		= getSidebarsList();
	$positions 		= getSidebarsPositions();
	$body_styles	= getBodyStylesList();
	$blog_styles	= getBlogStylesList();
	$hovers			= getHoversList();
	$sliders 		= getSlidersList();
	$popups 		= getPopupEngines();
	$gmap_styles 	= getGooglemapStyles();
	$dir 			= getDirectionList();
	$yes_no 		= getYesNoList();
	$on_off 		= getOnOffList();
	$show_hide 		= getShowHideList();
	$sorting 		= getSortingList();
	$ordering 		= getOrderingList();
} else {
	$hovers = $fonts = $themes = $socials = $icons = $categories = $sidebars = $positions = $body_styles = $blog_styles = $sliders = $popups = $gmap_styles = $dir = $yes_no = $on_off = $show_hide = $sorting = $ordering = array();
}
// Theme options arrays
$THEMEREX_options = array();


//###############################
//#### General               #### 
//###############################
$THEMEREX_options[] = array( "title" => __('General', 'themerex'),
			"id" => "partition_general",
			"start" => "partitions",
			"override" => "category,post,page",
			"icon" => "iconadmin-wrench",
			"divider" => false,
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('General parameters', 'themerex'),
			"desc" => __('Select (or upload) logo and favicon, advertisement parameters, etc.', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Contact form email', 'themerex'),
			"desc" => __('E-mail for send contact form and user registration data', 'themerex'),
			"id" => "contact_email",
			"std" => "",
			"before" => array('icon'=>'iconadmin-mail-1'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Notify about new registration', 'themerex'),
			"desc" => __('Send E-mail with new registration data to address above or to site admin e-mail', 'themerex'),
			"id" => "notify_about_new_registration",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable Dummy Data Installer', 'themerex'),
			"desc" => __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'themerex'),
			"id" => "admin_dummy_data",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Enable Emailer in admin panel (menu Tools)', 'themerex'),
			"desc" => __('Allow to use ThemeREX Emailer for mass-volume e-mail distribution and management of mailing lists in "Appearance - Menus - Emailer"', 'themerex'),
			"id" => "admin_emailer",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Favicon', 'themerex'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>', 'themerex'),
			"id" => "favicon",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Logo image', 'themerex'),
			"desc" => __('Logo image for header', 'themerex'),
			"id" => "logo_image",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Show tagline under site logo.', 'themerex'),
			"desc" => __('Show site tagline in header under site logo.', 'themerex'),
			"id" => "show_tagline",
			"override" => "category,post,page",
			"std" => "true",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show header search form.', 'themerex'),
			"desc" => __('Show search form icon in header.', 'themerex'),
			"id" => "show_searchform",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show Shopping Cart.', 'themerex'),
			"desc" => __('Show shopping cart in top section.', 'themerex'),
			"id" => "show_shopping_cart",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show mobile menu button.', 'themerex'),
			"desc" => __('Show mobile menu button in header..', 'themerex'),
			"id" => "show_mobilemenu",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show right panel.', 'themerex'),
			"desc" => __('Show right panel with bookmarks, widgets and menues.', 'themerex'),
			"id" => "show_right_panel",
			"std" => "true",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Footer copyright',  'themerex'),
			"desc" => __("Copyright text to show in footer area (bottom of site)", 'themerex'),
			"id" => "footer_copyright",
			"std" => "ThemeREX &copy; 2013 All Rights Reserved ",
			"type" => "text");
			
$THEMEREX_options[] = array( "title" => __('Image dimensions', 'themerex'),
			"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'themerex'),
			"id" => "retina_ready",
			"std" => "1",
			"size" => "medium",
			"options" => array("1"=>__("Original", 'themerex'), "2"=>__("Retina", 'themerex')),
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Responsive Layouts', 'themerex'),
			"desc" => __('Do you want use responsive layouts on small screen or still use main layout?', 'themerex'),
			"id" => "responsive_layouts",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Additional filters in admin panel', 'themerex'),
			"desc" => __('Show additional filters (on post format and tags) in admin panel page "Posts"', 'themerex'),
			"id" => "admin_add_filters",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Use update notifier in admin panel', 'themerex'),
			"desc" => __('Show update notifier in admin panel (can delay dashboard)', 'themerex'),
			"id" => "admin_update_notifier",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Fullwidth Slider',  'themerex'),
			"desc" => __('Place here slider shortcode that will be displayed above the main menu.',  'themerex'),
			"id" => "fullwidth_slider",
			"override" => "category,post,page",
			"cols" => 30,
			"rows" => 5,
			"std" => "",
			"type" => "editor");

$THEMEREX_options[] = array( "title" => __('Show Custom Page Header', 'themerex'),
			"desc" => __('Show custom page header area', 'themerex'),
			"id" => "custom_header_show",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Custom Page Header',  'themerex'),
			"desc" => __('Put here any content',  'themerex'),
			"id" => "custom_header",
			"override" => "category,post,page",
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "editor");

$THEMEREX_options[] = array( "title" => __('Show Custom Page Footer', 'themerex'),
			"desc" => __('Show custom page footer area', 'themerex'),
			"id" => "custom_footer_show",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Custom Page Footer',  'themerex'),
			"desc" => __('Put here any content',  'themerex'),
			"id" => "custom_footer",
			"override" => "category,post,page",
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "editor");

$THEMEREX_options[] = array( "title" => __('Header Banner', 'themerex'),
			"desc" => __('Header banner. Size 782pxx90px', 'themerex'),
			"id" => "header_banner",
			"divider" => false,
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Header Banner Code',  'themerex'),
			"desc" => __('Header banner code (some coding for your advertising campaign).',  'themerex'),
			"id" => "header_banner_code",
			"divider" => false,
			"std" => '',
			"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Header banner URL', 'themerex'),
			"desc" => __('Enter here URL of Header Banner. Example: http://example.org/', 'themerex'),
			"id" => "header_banner_url",
			"divider" => false,
			"std" => "",
			"type" => "text");
			
$THEMEREX_options[] = array( "title" => __('Show Header Banner', 'themerex'),
			"desc" => __('Select yes if you want to show banner in header.', 'themerex'),
			"id" => "show_banner",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");


//###############################
//#### Customization         #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Customization', 'themerex'),
			"id" => "partition_customization",
			"icon" => "iconadmin-cog-alt",
			"divider" => false,
			"override" => "category,post,page",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Theme customization parameters', 'themerex'),
			"desc" => __('Select main theme font, menu parameters, site background, etc.', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('General parameters', 'themerex'),
			"id" => 'customization_general',
			"divider" => false,
			"override" => "category,post,page",
			"icon" => 'iconadmin-cog',
			"type" => "toggle");

$THEMEREX_options[] = array( "title" => __('Show Theme customizer', 'themerex'),
			"desc" => __('Show theme customizer', 'themerex'),
			"id" => "show_theme_customizer",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Theme font', 'themerex'),
			"desc" => __('Select theme main font', 'themerex'),
			"id" => "theme_font",
			"std" => "Roboto",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => __('Theme color',  'themerex'),
			"desc" => __('Theme accent color',  'themerex'),
			"id" => "theme_color",
			"override" => "category,post,page",
			"std" => "#4f99bc",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Show section 1.', 'themerex'),
			"desc" => __('Enable the display of section that contains Top Menu.', 'themerex'),
			"id" => "section_1",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Header Section 1 background color.',  'themerex'),
			"desc" => __('Header section 1 (top menu section) background color.',  'themerex'),
			"id" => "section_1_bg",
			"override" => "category,post,page",
			"std" => "#1c1f23",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Header Section 1 font color.',  'themerex'),
			"desc" => __('Header section 1 (top menu section) font color.',  'themerex'),
			"id" => "section_1_font",
			"override" => "category,post,page",
			"std" => "#9cabbd",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Header Section 2 background color.',  'themerex'),
			"desc" => __('Header section 1 (main menu section) background color.',  'themerex'),
			"id" => "section_2_bg",
			"override" => "category,post,page",
			"std" => "#fff",
			"type" => "color");
			
$THEMEREX_options[] = array( "title" => __('Section 2 top margin', 'themerex'),
			"desc" => __('Set top indent inside section 2.', 'themerex'),
			"id" => "section2_margin_top",
			"override" => "category,post,page",
			"increment" => 1,
			"std" => "",
			"min" => 0,
			"max" => 100,
			"mask" => "?999",
			"type" => "spinner");
			
$THEMEREX_options[] = array( "title" => __('Section 2 bottom margin', 'themerex'),
			"desc" => __('Set bottom indent inside section 2.', 'themerex'),
			"id" => "section2_margin_bottom",
			"override" => "category,post,page",
			"increment" => 1,
			"std" => "",
			"min" => 0,
			"max" => 100,
			"mask" => "?999",
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Header Section 2 font color.',  'themerex'),
			"desc" => __('Header section 2 (main menu section) font color.',  'themerex'),
			"id" => "section_2_font",
			"override" => "category,post,page",
			"std" => "#2f3a47",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Header Section 2 alignment.',  'themerex'),
			"desc" => __('Alignment of elements in section 2.',  'themerex'),
			"id" => "section_align",
			"override" => "category,post,page",
			"std" => "left",
			"options" => array( "left" => __( 'Left', 'themerex' ), "center" => __( 'Center', 'themerex' ) ),
			"type" => "select");

$THEMEREX_options[] = array( 
			"end" => true,
			"type" => "toggle");



$THEMEREX_options[] = array( "title" => __('User menu', 'themerex'),
			"id" => 'customization_user_menu',
			"divider" => false,
			"icon" => 'iconadmin-user',
			"type" => "toggle");

$THEMEREX_options[] = array( "title" => __('Show user menu', 'themerex'),
			"desc" => __('Show user menu on top of page', 'themerex'),
			"id" => "show_user_menu",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show Login/Logout buttons', 'themerex'),
			"desc" => __('Show Login and Logout buttons', 'themerex'),
			"id" => "show_login",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( 
			"end" => true,
			"type" => "toggle");



$THEMEREX_options[] = array( "title" => __('Main menu parameters', 'themerex'),
			"id" => 'customization_mainmenu',
			"divider" => false,
			"icon" => 'iconadmin-menu',
			"type" => "toggle");

$THEMEREX_options[] = array( "title" => __('Fixed menu', 'themerex'),
			"desc" => __('Attach menu to top of window then page scroll down', 'themerex'),
			"id" => "fix_menu",
			"std" => "none",
			"options" => array("fixed"=>__("Fix menu position", 'themerex'), "none"=>__("Don't fix menu position", 'themerex')),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Submenu width', 'themerex'),
			"desc" => __('Width for dropdown menus in main menu', 'themerex'),
			"id" => "menu_width",
			"increment" => 5,
			"std" => "",
			"min" => 180,
			"max" => 300,
			"mask" => "?999",
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Main menu style', 'themerex'),
			"desc" => __('Select style of main menu', 'themerex'),
			"id" => "mainmenu_style",
			"std" => "style1",
			"override" => "category,post,page",
			"options" => array('style1' => __('Style 1', 'themerex'), 'style2' => __('Style 2', 'themerex'), 'style3' => __('Style 3', 'themerex')),
			"type" => "select");

$THEMEREX_options[] = array(
			"end" => true,
			"type" => "toggle");



$THEMEREX_options[] = array( "title" => __('Media settings', 'themerex'),
			"id" => 'customization_media',
			"divider" => false,
			"icon" => 'iconadmin-picture',
			"type" => "toggle");

$THEMEREX_theme_options[] = array( "name" => __('Media settings', 'themerex'),
			"std" => __('Media elements settings', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Substitute standard Wordpress gallery', 'themerex'),
			"desc" => __('Substitute standard Wordpress gallery with our theme-styled gallery', 'themerex'),
			"id" => "substitute_gallery",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Gallery popup engine', 'themerex'),
			"desc" => __('Select engine to show popup windows with galleries', 'themerex'),
			"id" => "popup_engine",
			"std" => "magnific",
			"options" => $popups,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Substitute audio tags', 'themerex'),
			"desc" => __('Substitute audio tag with source from soundclound to embed player', 'themerex'),
			"id" => "substitute_audio",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Substitute video tags', 'themerex'),
			"desc" => __('Substitute video tags to embed players', 'themerex'),
			"id" => "substitute_video",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array(
			"end" => true,
			"type" => "toggle");


$THEMEREX_options[] = array( "title" => __('Background parameters', 'themerex'),
			"id" => 'customization_background',
			"override" => "category,post,page",
			"divider" => false,
			"icon" => 'iconadmin-picture-1',
			"type" => "toggle");

$THEMEREX_options[] = array( "title" => __('Background parameters', 'themerex'),
			"desc" => __('This parameters only for fixed body style. Use only background image (if selected), else use background pattern', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");
			
$THEMEREX_options[] = array( "title" => __('Body style', 'themerex'),
			"desc" => __('Use boxed or wide body style', 'themerex'),
			"id" => "body_style",
			"override" => "category,post,page",
			"std" => "wide",
			"options" => $body_styles,
			"dir" => "horizontal",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Background color',  'themerex'),
			"desc" => __('Body background color',  'themerex'),
			"id" => "bg_color",
			"override" => "category,post,page",
			"std" => "#bfbfbf",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Background predefined pattern',  'themerex'),
			"desc" => __('Select theme background pattern (first case - without pattern)',  'themerex'),
			"id" => "bg_pattern",
			"override" => "category,post,page",
			"std" => "",
			"options" => array(
				0 => get_template_directory_uri().'/images/spacer.png',
				1 => get_template_directory_uri().'/images/bg/pattern_1.png',
				2 => get_template_directory_uri().'/images/bg/pattern_2.png',
				3 => get_template_directory_uri().'/images/bg/pattern_3.png',
				4 => get_template_directory_uri().'/images/bg/pattern_4.png',
				5 => get_template_directory_uri().'/images/bg/pattern_5.png',
			),
			"style" => "list",
			"type" => "images");

$THEMEREX_options[] = array( "title" => __('Background custom pattern',  'themerex'),
			"desc" => __('Select or upload background custom pattern',  'themerex'),
			"id" => "bg_custom_pattern",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Background predefined image',  'themerex'),
			"desc" => __('Select theme background image (first case - without image)',  'themerex'),
			"id" => "bg_image",
			"override" => "category,post,page",
			"std" => "",
			"options" => array(
				0 => get_template_directory_uri().'/images/spacer.png',
				1 => get_template_directory_uri().'/images/bg/image_1_thumb.jpg',
				2 => get_template_directory_uri().'/images/bg/image_2_thumb.jpg',
				3 => get_template_directory_uri().'/images/bg/image_3_thumb.jpg',
			),
			"style" => "list",
			"type" => "images");

$THEMEREX_options[] = array( "title" => __('Background custom image',  'themerex'),
			"desc" => __('Select or upload background custom image',  'themerex'),
			"id" => "bg_custom_image",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Background custom image position',  'themerex'),
			"desc" => __('Select custom image position',  'themerex'),
			"id" => "bg_custom_image_position",
			"override" => "category,post,page",
			"std" => "left_top",
			"options" => array(
				'left_top' => "Left Top",
				'center_top' => "Center Top",
				'right_top' => "Right Top",
				'left_center' => "Left Center",
				'center_center' => "Center Center",
				'right_center' => "Right Center",
				'left_bottom' => "Left Bottom",
				'center_bottom' => "Center Bottom",
				'right_bottom' => "Right Bottom",
			),
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Your CSS code',  'themerex'),
			"desc" => __('Put here your css code to correct main theme styles',  'themerex'),
			"id" => "custom_css",
			"override" => "category,post,page",
			"divider" => false,
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "textarea");



//###############################
//####Sidebars               #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Sidebars', 'themerex'),
			"id" => "partition_sidebars",
			"icon" => "iconadmin-menu",
			"divider" => false,
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Custom sidebars', 'themerex'),
			"desc" => __('In this section you can create unlimited sidebars', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Custom sidebars',  'themerex'),
			"desc" => __('Manage custom sidebars. You can use it with each category (page, post) independently',  'themerex'),
			"id" => "custom_sidebars",
			"divider" => false,
			"std" => "",
			"cloneable" => true,
			"type" => "text");



//###############################
//#### Blog                  #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Blog', 'themerex'),
			"id" => "partition_blog",
			"icon" => "iconadmin-docs",
			"override" => "category,post,page",
			"divider" => false,
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Stream page', 'themerex'),
			"id" => 'blog_tab_stream',
			"start" => 'blog_tabs',
			"icon" => "iconadmin-docs",
			"divider" => false,
			"override" => "category,post,page",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Blog streampage parameters', 'themerex'),
			"desc" => __('Select desired blog streampage parameters (you can override it in each category)', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Blog style', 'themerex'),
			"desc" => __('Select desired blog style', 'themerex'),
			"id" => "blog_style",
			"override" => "category,page",
			"std" => "excerpt",
			"options" => $blog_styles,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show "Top News"',  'themerex'),
			"desc" => __('Show "Top News" sidebar-section', 'themerex'),
			"id" => "show_top_news",
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Top News Title',  'themerex'),
			"desc" => __('Title of "Top News" section.',  'themerex'),
			"id" => "top_news_title",
			"override" => "category,page",
			"std" => "",
			"divider" => false,
			"type" => "text");
			
$THEMEREX_options[] = array( "title" => __('"Top News" Categories', 'themerex'),
			"desc" => __('Select categories that will be displayed in "Top News" section.', 'themerex'),
			"id" => "top_news_cats",
			"std" => "",
			"options" => $categories,
			"override" => "category,post,page",
			"multiple" => true,
			"style" => "list",
			"type" => "select");
			
$THEMEREX_options[] = array( "title" => __('"Top News" posts number',  'themerex'),
			"desc" => __('Please, choose a number of posts for each category in the Top News section.', 'themerex'),
			"id" => "top_news_count",
			"override" => "category,post,page",
			"std" => "4",
			"increment" => 1,
			"min" => 1,
			"max" => 8,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Default Category Color',  'themerex'),
			"desc" => __('Color used as default for categories.',  'themerex'),
			"id" => "category_color",
			"override" => "category,post,page",
			"std" => "#ffcc00",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Show filters', 'themerex'),
			"desc" => __('Show filter buttons (only for Blog style = Portfolio, Masonry, Classic)', 'themerex'),
			"id" => "show_filters",
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Use as filter keywords', 'themerex'),
			"desc" => __('Select taxonomy that will be used as a filter for portfolio elements', 'themerex'),
			"id" => "filter_taxonomy",
			"std" => "tags",
			"override" => "category,page",
			"options" => array(
				'tags' => __('Tags', 'themerex'),
				'categories' => __('Categories', 'themerex')
			),
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Blog posts sorted by', 'themerex'),
			"desc" => __('Select the desired sorting method for posts', 'themerex'),
			"id" => "blog_sort",
			"override" => "category,page",
			"std" => "date",
			"options" => $sorting,
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Blog posts order', 'themerex'),
			"desc" => __('Select the desired ordering method for posts', 'themerex'),
			"id" => "blog_order",
			"override" => "category,page",
			"std" => "desc",
			"options" => $ordering,
			"size" => "big",
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Blog posts per page',  'themerex'),
			"desc" => __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'themerex'),
			"id" => "posts_per_page",
			"override" => "category,page",
			"std" => "12",
			"mask" => "?99",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Post excerpt maxlength',  'themerex'),
			"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'themerex'),
			"id" => "post_excerpt_maxlength",
			"override" => "category,page",
			"std" => "250",
			"mask" => "?9999",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Show main sidebar',  'themerex'),
			"desc" => __('Select main sidebar position on blog page',  'themerex'),
			"id" => 'show_sidebar_main',
			"override" => "category,post,page",
			"std" => "right",
			"options" => $positions,
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Select main sidebar',  'themerex'),
			"desc" => __('Select main sidebar for blog page',  'themerex'),
			"id" => "sidebar_main",
			"override" => "category,post,page",
			"std" => "sidebar-main",
			"options" => $sidebars,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show footer sidebar', 'themerex'),
			"desc" => __('Show footer sidebar', 'themerex'),
			"id" => "show_sidebar_footer",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Select footer sidebar',  'themerex'),
			"desc" => __('Select footer sidebar for blog page',  'themerex'),
			"id" => "sidebar_footer",
			"override" => "category,post,page",
			"std" => "sidebar-footer",
			"options" => $sidebars,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show search in right panel', 'themerex'),
			"desc" => __('Show search in right panel under panel menu.', 'themerex'),
			"id" => "show_search",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");




$THEMEREX_options[] = array( "title" => __('Single page', 'themerex'),
			"id" => 'blog_tab_single',
			"icon" => "iconadmin-doc",
			"divider" => false,
			"override" => "category,post,page",
			"type" => "tab");


$THEMEREX_options[] = array( "title" => __('Single (detail) pages parameters', 'themerex'),
			"desc" => __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show post title', 'themerex'),
			"desc" => __('Show area with post title on single pages', 'themerex'),
			"id" => "show_post_title",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Show Featured Image', 'themerex'),
			"desc" => __("Show featured image on single post", 'themerex'),
			"id" => "show_featured",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch"); 
			
$THEMEREX_options[] = array( "title" => __('Frontend editor', 'themerex'),
			"desc" => __("Allow authors to edit their posts in frontend area)", 'themerex'),
			"id" => "allow_editor",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch"); 

$THEMEREX_options[] = array( "title" => __('Show post title on links, chat, quote, status', 'themerex'),
			"desc" => __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'themerex'),
			"id" => "show_post_title_on_quotes",
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post info', 'themerex'),
			"desc" => __('Show area with post info on single pages', 'themerex'),
			"id" => "show_post_info",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show text before "Read more" tag', 'themerex'),
			"desc" => __('Show text before "Read more" tag on single pages', 'themerex'),
			"id" => "show_text_before_readmore",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Show post author details',  'themerex'),
			"desc" => __("Show post author information block on single post page", 'themerex'),
			"id" => "show_post_author",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post tags',  'themerex'),
			"desc" => __("Show tags block on single post page", 'themerex'),
			"id" => "show_post_tags",
			"override" => "category,post",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show related posts',  'themerex'),
			"desc" => __("Show related posts block on single post page", 'themerex'),
			"id" => "show_post_related",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Related posts number',  'themerex'),
			"desc" => __("How many related posts showed on single post page", 'themerex'),
			"id" => "post_related_count",
			"override" => "category,post,page",
			"std" => "4",
			"increment" => 1,
			"min" => 2,
			"max" => 8,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Related posts sorted by', 'themerex'),
			"desc" => __('Select the desired sorting method for related posts', 'themerex'),
			"id" => "post_related_sort",
//			"override" => "category,page",
			"std" => "date",
			"options" => $sorting,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Related posts order', 'themerex'),
			"desc" => __('Select the desired ordering method for related posts', 'themerex'),
			"id" => "post_related_order",
//			"override" => "category,page",
			"std" => "desc",
			"options" => $ordering,
			"size" => "big",
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show comments',  'themerex'),
			"desc" => __("Show comments block on single post page", 'themerex'),
			"id" => "show_post_comments",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Other parameters', 'themerex'),
			"id" => 'blog_tab_general',
			"icon" => "iconadmin-newspaper",
			"divider" => false,
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('General Blog parameters', 'themerex'),
			"desc" => __('Select excluded categories, substitute parameters, etc.', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Exclude categories', 'themerex'),
			"desc" => __('Select categories, which posts are exclude from blog page', 'themerex'),
			"id" => "exclude_cats",
			"override" => "category,post,page",
			"std" => "",
			"options" => $categories,
			"multiple" => true,
			"style" => "list",
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show Breadcrumbs', 'themerex'),
			"desc" => __('Show path to current category (post, page)', 'themerex'),
			"id" => "show_breadcrumbs",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Blog pagination style', 'themerex'),
			"desc" => __('Select pagination style on blog streampages', 'themerex'),
			"id" => "blog_pagination",
			"override" => "category,post,page",
			"std" => "pages",
			"options" => array(
				'hide'     => __('Hide pagination', 'themerex'),
				'pages'    => __('Standard page numbers', 'themerex'),
				'viewmore' => __('"View more" button', 'themerex'),
				'infinite' => __('Infinite scroll', 'themerex')
			),
			"dir" => "vertical",
			"type" => "select");

$THEMEREX_options[] = array( "title" => __("Post's category announce", 'themerex'),
			"desc" => __('What category display in announce block (over posts thumb) - original or nearest parental', 'themerex'),
			"id" => "close_category",
			"std" => "parental",
			"options" => array(
				'parental' => __('Nearest parental category', 'themerex'),
				'original' => __("Original post's category", 'themerex')
			),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Show post date after', 'themerex'),
			"desc" => __('Show post date after N days (before - show post age)', 'themerex'),
			"id" => "show_date_after",
			"std" => "30",
			"mask" => "?99",
			"type" => "text");



//###############################
//#### Reviews               #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Reviews', 'themerex'),
			"id" => "partition_reviews",
			"icon" => "iconadmin-newspaper",
			"divider" => false,
			"override" => "category",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Reviews criterias', 'themerex'),
			"desc" => __('Set up list of reviews criterias. You can override it in any category.', 'themerex'),
			"override" => "category",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show reviews block',  'themerex'),
			"desc" => __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'themerex'),
			"id" => "show_reviews",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Max reviews level',  'themerex'),
			"desc" => __("Maximum level for reviews marks", 'themerex'),
			"id" => "reviews_max_level",
			"std" => "5",
			"options" => array(
				'5'=>__('5 stars', 'themerex'), 
				'10'=>__('10 stars', 'themerex'), 
				'100'=>__('100%', 'themerex')
			),
			"type" => "radio",
			);

$THEMEREX_options[] = array( "title" => __('Show rating as',  'themerex'),
			"desc" => __("Show rating marks as text or as stars/progress bars.", 'themerex'),
			"id" => "reviews_style",
			"std" => "stars",
			"options" => array(
				'text' => __('As text (for example: 7.5 / 10)', 'themerex'),
				'star' => __('As one star', 'themerex'),
				'5stars' => __('As 5 stars', 'themerex'),
				'10stars' => __('As 10 stars', 'themerex'),
				'circular' => __('As circular diagram', 'themerex')				
			),
			"override" => "category,post,page",
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Review points color',  'themerex'),
			"desc" => __('Color of review points',  'themerex'),
			"id" => "review_color",
			"override" => "category,post,page",
			"std" => "#1172d3",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Show first reviews',  'themerex'),
			"desc" => __("What reviews will be displayed first: by author or by visitors. Also this type of reviews will display under post's title.", 'themerex'),
			"id" => "reviews_first",
			"std" => "author",
			"options" => array(
				'author' => __('By author', 'themerex'),
				'users' => __('By visitors', 'themerex')
				),
			"dir" => "horizontal",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Hide second reviews',  'themerex'),
			"desc" => __("Do you want hide second reviews tab on single review page.", 'themerex'),
			"id" => "reviews_second",
			"std" => "show",
			"options" => $show_hide,
			"size" => "medium",
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('What visitors can vote',  'themerex'),
			"desc" => __("What visitors can vote: all or only registered", 'themerex'),
			"id" => "reviews_can_vote",
			"std" => "all",
			"options" => array(
				'all'=>__('All visitors', 'themerex'), 
				'registered'=>__('Only registered', 'themerex')
			),
			"dir" => "horizontal",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Reviews criterias',  'themerex'),
			"desc" => __('Add default reviews criterias.',  'themerex'),
			"id" => "reviews_criterias",
			"override" => "category",
			"std" => "",
			"cloneable" => true,
			"type" => "text");


//require_once('theme-settings-examples.php');




// Load current values for all theme options
load_theme_options();




//----------------------------------------------------------------------------------
// Load all theme options
//----------------------------------------------------------------------------------
function load_theme_options() {
	global $THEMEREX_options;
	$options = get_option('themerex_options', array());
	foreach ($THEMEREX_options as $k => $item) {
		if (isset($item['std'])) {
			if (isset($options[$item['id']]))
				$THEMEREX_options[$k]['val'] = $options[$item['id']];
			else
				$THEMEREX_options[$k]['val'] = $item['std'];
		}
	}
}


//----------------------------------------------------------------------------------
// Get custom options arrays (from current category, post, page, shop)
//----------------------------------------------------------------------------------
function load_custom_options() {
	// Theme custom settings from current post and category
	global $THEMEREX_cat_options, $THEMEREX_post_options, $THEMEREX_custom_options, $THEMEREX_shop_options, $wp_query;
	// Current post & category custom options
	$THEMEREX_post_options = $THEMEREX_cat_options = $THEMEREX_custom_options = $THEMEREX_shop_options = array();
	if (is_woocommerce_page() && ($page_id=get_option('woocommerce_shop_page_id'))>0)
		$THEMEREX_shop_options = get_post_meta($page_id, 'post_custom_options', true);
	if (is_category()) {
		$cat = (int) get_query_var( 'cat' );
		if (empty($cat)) $cat = get_query_var( 'category_name' );
		$THEMEREX_cat_options = get_category_inherited_properties($cat);
	} else if ((is_day() || is_month() || is_year()) && ($page_id=getTemplatePageId('archive'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_search() && ($page_id=getTemplatePageId('search'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_404() && ($page_id=getTemplatePageId('404'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (function_exists('is_bbpress') && is_bbpress() && ($page_id=getTemplatePageId('bbpress'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (function_exists('is_buddypress') && is_buddypress() && ($page_id=getTemplatePageId('buddypress'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_attachment() && ($page_id=getTemplatePageId('attachment'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_single() || is_page() || is_singular() || $wp_query->is_posts_page==1) {
		// Current post custom options
		$page_id = is_single() || is_page() ? get_the_ID() : (isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : getTemplatePageId('blog'));
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
		$THEMEREX_cat_options = get_categories_inherited_properties(getCategoriesByPostId($page_id));
	}
}


//==========================================================================================
// Check option for inherit value
//==========================================================================================
function is_inherit_option($value) {
	while (is_array($value)) {
		foreach ($value as $val) {
			$value = $val;
			break;
		}
	}
	return themerex_strtolower($value)=='inherit';	//in_array(themerex_strtolower($value), array('default', 'inherit'));
}


//==========================================================================================
// Get theme option. If not exists - try get site option. If not exist - return default
//==========================================================================================
function get_theme_option($option_name, $default = false, $options = null) {
	global $THEMEREX_options;
	$val = false;
	if (is_array($options)) {
		foreach($options as $option) {
			if (isset($option['id']) && $option['id'] == $option_name) {
				$val = $option['val'];
				break;
			}
		}
	} else if (isset($THEMEREX_options)) {
		foreach($THEMEREX_options as $option) {
			if (isset($option['id']) && $option['id'] == $option_name) {
				$val = $option['val'];
				break;
			}
		}
	} else {
		$options = get_option('themerex_options', array());
		if (isset($options[$option_name])) {
			$val = $options[$option_name];
		}
	}
	if ($val === false) {
		if (($val = get_option($option_name, false)) !== false) {
			return $val;
		} else {
			return $default;
		}
	} else {
		return $val;
	}
}


//================================================================================================
// Return property value from request parameters < post options < category options < theme options
//================================================================================================
function get_custom_option($name, $defa=null, $post_id=0, $cat_id=0) {
	if (isset($_GET[$name]))
		$rez = $_GET[$name];
	else {
		if ($cat_id > 0) {
			$rez = get_category_inherited_property($cat_id, $name);
			if ($rez=='') $rez = get_theme_option($name, $defa);
		} else if ($post_id > 0) {
			$rez = get_theme_option($name, $defa);
			$custom_options = get_post_meta($post_id, 'post_custom_options', true);
			if (isset($custom_options[$name]) && !is_inherit_option($custom_options[$name]))
				$rez = $custom_options[$name];
			else {
				if (is_category()) {
					$categories = array();
					$categories[] = get_queried_object();
				} else
					$categories =  getCategoriesByPostId($post_id);
				$tmp = '';
				for ($cc = 0; $cc < count($categories) && (empty($tmp) || is_inherit_option($tmp)); $cc++) {
					$tmp = get_category_inherited_property(is_object($categories[$cc]) ? $categories[$cc]->term_id : $categories[$cc]['term_id'], $name);
				}
				if ($tmp!='') $rez = $tmp;
			}
		} else {
			global $THEMEREX_post_options, $THEMEREX_cat_options, $THEMEREX_custom_options, $THEMEREX_shop_options;
			if (isset($THEMEREX_custom_options[$name])) {
				$rez = $THEMEREX_custom_options[$name];
			} else {
				$rez = get_theme_option($name, $defa);
				if (is_woocommerce_page() && isset($THEMEREX_shop_options[$name]) && !is_inherit_option($THEMEREX_shop_options[$name])) {
					$rez = is_array($THEMEREX_shop_options[$name]) ? $THEMEREX_shop_options[$name][0] : $THEMEREX_shop_options[$name];
				}
				if (!is_single() && isset($THEMEREX_post_options[$name]) && !is_inherit_option($THEMEREX_post_options[$name])) {
					$rez = is_array($THEMEREX_post_options[$name]) ? $THEMEREX_post_options[$name][0] : $THEMEREX_post_options[$name];
				}
				if (isset($THEMEREX_cat_options[$name]) && !is_inherit_option($THEMEREX_cat_options[$name])) {
					$rez = $THEMEREX_cat_options[$name];
				}
				if (is_single() && isset($THEMEREX_post_options[$name]) && !is_inherit_option($THEMEREX_post_options[$name])) {
					$rez = is_array($THEMEREX_post_options[$name]) ? $THEMEREX_post_options[$name][0] : $THEMEREX_post_options[$name];
				}
				if (get_theme_option('show_theme_customizer') == 'yes') {
					$tmp = getValueGPC($name, $rez);
					if (!is_inherit_option($tmp))
						$rez = $tmp;
				}
				$THEMEREX_custom_options[$name] = $rez;
			}
		}
	}
	return $rez;
}



//==========================================================================================
// Check if theme options are now used
//==========================================================================================
function is_themerex_options_used() {
	return is_admin() && (
		(isset($_REQUEST['action']) && $_REQUEST['action']=='themerex_options_save') ||
		(themerex_strpos($_SERVER['REQUEST_URI'], 'themerex_options')!==false) ||
		(themerex_strpos($_SERVER['REQUEST_URI'], 'post-new.php')!==false) ||
		(themerex_strpos($_SERVER['REQUEST_URI'], 'post.php')!==false) ||
		(themerex_strpos($_SERVER['REQUEST_URI'], 'edit-tags.php')!==false && themerex_strpos($_SERVER['REQUEST_URI'], 'taxonomy=category')!==false)
	);
}


//-----------------------------------------------------------------------------------
// Add 'Theme options' in Admin Interface
//-----------------------------------------------------------------------------------
add_action('admin_menu', 'themerex_options_admin_menu_item');
function themerex_options_admin_menu_item() {
	// In this case menu item "Theme Options" add in root admin menu level
	//$tt_page = add_menu_page(__('Theme Options', 'themerex'), __('Theme Options', 'themerex'), 'manage_options', 'themerex_options', 'themerex_options_page');

	// In this case menu item "Theme Options" add in admin menu 'Appearance'
	//$tt_page = add_theme_page(__('Theme Options', 'themerex'), __('Theme Options', 'themerex'), 'edit_theme_options', 'themerex_options', 'themerex_options_page');

	// In this case menu item "Theme Options" add in admin menu 'Settings'
	$tt_page = add_theme_page(__('ThemeREX Options', 'themerex'), __('ThemeREX Options', 'themerex'), 'manage_options', 'themerex_options', 'themerex_options_page');
}
?>