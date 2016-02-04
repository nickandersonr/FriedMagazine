<?php
require_once( 'shortcodes_vc_classes.php' );

// Remove standard VC shortcodes
vc_remove_element("vc_button");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_gmaps");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_facebook");
vc_remove_element("vc_tweetmeme");
vc_remove_element("vc_googleplus");
vc_remove_element("vc_facebook");
vc_remove_element("vc_pinterest");
vc_remove_element("vc_message");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_flickr");
vc_remove_element("vc_tour");
vc_remove_element("vc_separator");
vc_remove_element("vc_single_image");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_accordion");
vc_remove_element("vc_accordion_tab");
vc_remove_element("vc_toggle");
vc_remove_element("vc_tabs");
vc_remove_element("vc_tab");
vc_remove_element("vc_images_carousel");

// Remove standard WP widgets
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_text");

// Common arrays and strings
$THEMEREX_VC_category = __("ThemeREX shortcodes", "themerex");

// Current element id
$THEMEREX_VC_id = array(
	"param_name" => "id",
	"heading" => __("Element ID", "themerex"),
	"description" => __("ID for current element", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"value" => "",
	"type" => "textfield"
);

// Current element class
$THEMEREX_VC_class = array(
	"param_name" => "class",
	"heading" => __("Element CSS class", "themerex"),
	"description" => __("CSS class for current element", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"value" => "",
	"type" => "textfield"
);

// Current element style
$THEMEREX_VC_style = array(
	"param_name" => "style",
	"heading" => __("CSS styles", "themerex"),
	"description" => __("Any additional CSS rules (if need)", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"class" => "",
	"value" => "",
	"type" => "textfield"
);


// Width and height params
function THEMEREX_VC_width($w="") {
	return array(
		"param_name" => "width",
		"heading" => __("Width", "themerex"),
		"description" => __("Width (in pixels or percent) of the current element", "themerex"),
		"group" => __('Size &amp; Margins', 'themerex'),
		"value" => $w,
		"type" => "textfield"
	);
}
function THEMEREX_VC_height($h='') {
	return array(
		"param_name" => "height",
		"heading" => __("Height", "themerex"),
		"description" => __("Height (only in pixels) of the current element", "themerex"),
		"group" => __('Size &amp; Margins', 'themerex'),
		"value" => $h,
		"type" => "textfield"
	);
}

// Margins params
$THEMEREX_VC_margin_top = array(
	"param_name" => "top",
	"heading" => __("Top margin", "themerex"),
	"description" => __("Top margin (in pixels).", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"value" => "",
	"type" => "textfield"
);
$THEMEREX_VC_margin_bottom = array(
	"param_name" => "bottom",
	"heading" => __("Bottom margin", "themerex"),
	"description" => __("Bottom margin (in pixels).", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"value" => "",
	"type" => "textfield"
);
$THEMEREX_VC_margin_left = array(
	"param_name" => "left",
	"heading" => __("Left margin", "themerex"),
	"description" => __("Left margin (in pixels).", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"value" => "",
	"type" => "textfield"
);
$THEMEREX_VC_margin_right = array(
	"param_name" => "right",
	"heading" => __("Right margin", "themerex"),
	"description" => __("Right margin (in pixels).", "themerex"),
	"group" => __('Size &amp; Margins', 'themerex'),
	"value" => "",
	"type" => "textfield"
);







// Accordion
//-------------------------------------------------------------------------------------
vc_map( array(
	"base" => "accordion",
	"name" => __("Accordion", "themerex"),
	"description" => __("Accordion items", "themerex"),
	"category" => __('Content', 'js_composer'),
	'icon' => 'icon_trx_accordion',
	"class" => "trx_sc_collection trx_sc_accordion",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'accordion_item'),	// Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	"params" => array(
		array(
			"param_name" => "initial",
			"heading" => __("Initially opened item", "themerex"),
			"description" => __("Number of initially opened item", "themerex"),
			"class" => "",
			"value" => 1,
			"type" => "textfield"
		),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
	),
	'default_content' => '
		[accordion_item title="' . __( 'Item 1 title', 'themerex' ) . '"][/accordion_item]
		[accordion_item title="' . __( 'Item 2 title', 'themerex' ) . '"][/accordion_item]
	',
	"custom_markup" => '
		<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
			%content%
		</div>
		<div class="tab_controls">
			<button class="add_tab" title="'.__("Add item", "themerex").'">'.__("Add item", "themerex").'</button>
		</div>
	',
	'js_view' => 'VcTrxAccordionView'
) );


vc_map( array(
	"base" => "accordion_item",
	"name" => __("Accordion item", "themerex"),
	"description" => __("Inner accordion item", "themerex"),
	"show_settings_on_create" => true,
	"content_element" => true,
	"is_container" => true,
	"as_child" => array('only' => 'accordion'), 	// Use only|except attributes to limit parent (separate multiple values with comma)
	"as_parent" => array('except' => 'accordion'),
	"params" => array(
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
			"description" => __("Title for current accordion item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "icon",
			"heading" => __("Item's icon", "themerex"),
            "description" => __("Select icon for the current item from Fontello icons set", "themerex"),
			"class" => "",
			"value" => "",
			"value" => $THEMEREX_shortcodes_icons,
			"type" => "dropdown"
        ),
		$THEMEREX_VC_id
	),
  'js_view' => 'VcTrxAccordionTabView'
) );
class WPBakeryShortCode_Accordion extends THEMEREX_VC_ShortCodeAccordion {}
class WPBakeryShortCode_Accordion_Item extends THEMEREX_VC_ShortCodeAccordionItem {}






// Audio
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "audio",
	"name" => __("Audio", "themerex"),
	"description" => __("Insert audio player", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_audio',
	"class" => "trx_sc_single trx_sc_audio",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "src",
			"heading" => __("URL for audio file", "themerex"),
            "description" => __("Put here URL for audio file", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
            "description" => __("Title for audio file", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "author",
			"heading" => __("Author", "themerex"),
            "description" => __("Author name", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "controls",
			"heading" => __("Controls", "themerex"),
            "description" => __("Show/hide controls", "themerex"),
			"class" => "",
			"value" => array("Hide controls" => "hide" ),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "autoplay",
			"heading" => __("Autoplay", "themerex"),
            "description" => __("Autoplay audio on page load", "themerex"),
			"class" => "",
			"value" => array("Autoplay" => "on" ),
			"type" => "checkbox"
        ),
		THEMEREX_VC_width("100%"),
		THEMEREX_VC_height(65),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Audio extends THEMEREX_VC_ShortCodeSingle {}






// Trex_Banner
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trex_banner",
	"name" => __("Banner Rotator", "themerex"),
	"description" => __("Insert banner rotator", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_banner',
	"class" => "trx_sc_single trx_sc_banner",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "ids",
			"heading" => __("Banners IDs list", "themerex"),
            "description" => __("Comma separated list of banners ID", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "count",
			"heading" => __("Total banners to show", "themerex"),
            "description" => __("How many banners will be displayed? If used IDs - this parameter ignored.", "themerex"),
	        'dependency' => array(
				'element' => 'ids',
				'is_empty' => true
			),
			"admin_label" => true,
			"class" => "",
			"value" => 1,
			"type" => "textfield"
        ),
		array(
			"param_name" => "group",
			"heading" => __("Group", "themerex"),
            "description" => __("The group, which will be displayed banners", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "author",
			"heading" => __("Author", "themerex"),
            "description" => __("Banner's author", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        )
    )
) );

class WPBakeryShortCode_Trex_Banner extends THEMEREX_VC_ShortCodeSingle {}







// Banner
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "banner",
	"name" => __("Banner", "themerex"),
	"description" => __("Insert banner", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_banner',
	"class" => "trx_sc_container trx_sc_banner",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "src",
			"heading" => __("URL for image file", "themerex"),
            "description" => __("Put here URL for image file", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Banner alignment", "themerex"),
            "description" => __("Align banner to left, center or right", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
            "description" => __("Banner's title", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Text", "themerex"),
            "description" => __("Banner's inner text", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/	// Uncomment this row, if you want display content after admin labels
			"type" => "textarea_html"
        ),
		array(
			"param_name" => "link",
			"heading" => __("Link URL", "themerex"),
            "description" => __("URL for the link on banner click", "themerex"),
			"class" => "",
			"group" => __('Link', 'themerex'),
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "target",
			"heading" => __("Link target", "themerex"),
            "description" => __("Target for the link on banner click", "themerex"),
			"class" => "",
			"group" => __('Link', 'themerex'),
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "rel",
			"heading" => __("Rel attribute", "themerex"),
            "description" => __("Rel attribute for the banner's link (if need", "themerex"),
			"class" => "",
			"group" => __('Link', 'themerex'),
			"value" => "",
			"type" => "textfield"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'

) );

class WPBakeryShortCode_Banner extends THEMEREX_VC_ShortCodeContainer {}







// Block
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "block",
	"name" => __("Block container", "themerex"),
	"description" => __("Container for any block ([section] analog - to enable nesting)", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_block',
	"class" => "trx_sc_collection trx_sc_block",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "background_color",
			"heading" => __("Background color", "themerex"),
            "description" => __("Any background color for this section", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "background_image",
			"heading" => __("Background image", "themerex"),
            "description" => __("Select background image from library for this section", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "background_repeat",
			"heading" => __("Background repeat", "themerex"),
            "description" => __("Background repeat or single", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => array(
				__('No Repeat', 'themerex') => 'no-repeat',
				__('Repeat', 'themerex') => 'repeat',
				__('Repeat X axis', 'themerex') => 'repeat-x',
				__('Repeat Y axis', 'themerex') => 'repeat-y'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background_pos_x",
			"heading" => __("Background X position", "themerex"),
            "description" => __("Background horizontal position", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => array(
				__('Left', 'themerex') => 'left',
				__('Center', 'themerex') => 'center',
				__('Right', 'themerex') => 'right'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background_pos_y",
			"heading" => __("Background Y position", "themerex"),
            "description" => __("Background vertical position", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => array(
				__('Top', 'themerex') => 'top',
				__('Center', 'themerex') => 'center',
				__('Bottom', 'themerex') => 'bottom'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background_size",
			"heading" => __("Background size", "themerex"),
            "description" => __("Background size", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "dedicated",
			"heading" => __("Dedicated", "themerex"),
            "description" => __("Use this block as dedicated content - show it before post title on single page", "themerex"),
			"class" => "",
			"value" => array(__('Use as dedicated content', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "content_wrap",
			"heading" => __("Wrap content", "themerex"),
            "description" => __("Check if you want to wrap content inside section", "themerex"),
			"class" => "",
			"value" => array(__('Wrap content', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "parallax",
			"heading" => __("Parallax scrolling", "themerex"),
            "description" => __("Enable parallax scrolling for this section", "themerex"),
			"class" => "",
			"value" => array(__('Parallax', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Block alignment", "themerex"),
            "description" => __("Select block alignment", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "text_align",
			"heading" => __("Text alignment", "themerex"),
            "description" => __("Select text alignment inside block", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "columns",
			"heading" => __("Columns emulation", "themerex"),
            "description" => __("Select width for columns emulation", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_columns),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Container content", "themerex"),
            "description" => __("Content for section container", "themerex"),
			"class" => "",
			"value" => "",
			"holder" => "div",
			"type" => "textarea_html"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id,
		$THEMEREX_VC_class,
		$THEMEREX_VC_style
    )
) );

class WPBakeryShortCode_Block extends THEMEREX_VC_ShortCodeCollection {}






// Blogger
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "blogger",
	"name" => __("Blogger", "themerex"),
	"description" => __("Insert posts (pages) in many styles from desired categories or directly from ids", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_blogger',
	"class" => "trx_sc_single trx_sc_blogger",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
            "description" => __("Section title", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Output style", "themerex"),
            "description" => __("Select desired style for posts output", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip(array(
					'default' => __('Regular', 'themerex'),
					'date' => __('Date', 'themerex'),
					'image_large' => __('Large featured image', 'themerex'),
					'image_medium' => __('Medium featured image', 'themerex'),
					'image_small' => __('Small featured image', 'themerex'),
					'accordion' => __('Accordion style 1', 'themerex'),
					'list' => __('List', 'themerex')
			)),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "rating",
			"heading" => __("Show rating stars", "themerex"),
            "description" => __("Show rating stars under post's header", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => array(__('Show rating', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "border",
			"heading" => __("Show border", "themerex"),
            "description" => __("Show border under post items", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => array(__('Show border', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "descr",
			"heading" => __("Description length", "themerex"),
            "description" => __("How many characters are displayed from post excerpt? If 0 - don't show description", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => 0,
			"type" => "textfield"
        ),
		array(
			"param_name" => "link_title",
			"heading" => __("Read more link text", "themerex"),
            "description" => __("Read more link text. If empty - show 'More', else - used as link text", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "link_url",
			"heading" => __("Read more link URL", "themerex"),
            "description" => __("Read more link URL. If empty - will not be displayed", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "cat",
			"heading" => __("Categories list", "themerex"),
            "description" => __("Put here comma separated category slugs or ids. If empty - show posts from any category or from IDs list", "themerex"),
	        'dependency' => array(
				'element' => 'ids',
				'is_empty' => true
			),
			"group" => __('Query', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "ids",
			"heading" => __("Post IDs list", "themerex"),
            "description" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
			"group" => __('Query', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "count",
			"heading" => __("Total posts to show", "themerex"),
            "description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
	        'dependency' => array(
				'element' => 'ids',
				'is_empty' => true
			),
			"admin_label" => true,
			"group" => __('Query', 'themerex'),
			"class" => "",
			"value" => 3,
			"type" => "textfield"
        ),
		array(
			"param_name" => "visible",
			"heading" => __("Number of visible posts", "themerex"),
            "description" => __("How many posts will be visible at once? If empty or 0 - all posts are visible", "themerex"),
	        'dependency' => array(
				'element' => 'ids',
				'is_empty' => true
			),
			"group" => __('Query', 'themerex'),
			"class" => "",
			"value" => 3,
			"type" => "textfield"
        ),
		array(
			"param_name" => "offset",
			"heading" => __("Offset before select posts", "themerex"),
            "description" => __("Skip posts before select next part.", "themerex"),
	        'dependency' => array(
				'element' => 'ids',
				'is_empty' => true
			),
			"group" => __('Query', 'themerex'),
			"class" => "",
			"value" => 0,
			"type" => "textfield"
        ),
		array(
			"param_name" => "orderby",
			"heading" => __("Post order by", "themerex"),
            "description" => __("Select desired posts sorting method", "themerex"),
			"class" => "",
			"group" => __('Query', 'themerex'),
			"value" => array_flip($THEMEREX_shortcodes_sorting),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "order",
			"heading" => __("Post order", "themerex"),
            "description" => __("Select desired posts order", "themerex"),
			"class" => "",
			"group" => __('Query', 'themerex'),
			"value" => array_flip($THEMEREX_shortcodes_ordering),
			"type" => "dropdown"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
) );

class WPBakeryShortCode_Blogger extends THEMEREX_VC_ShortCodeSingle {}






// Br
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "br",
	"name" => __("Line break", "themerex"),
	"description" => __("Line break or Clear Floating", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_br',
	"class" => "trx_sc_single trx_sc_br",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "clear",
			"heading" => __("Clear floating", "themerex"),
            "description" => __("Select clear side (if need)", "themerex"),
			"class" => "",
			"value" => "",
			"value" => array(
				__('None', 'themerex') => 'none',
				__('Left', 'themerex') => 'left',
				__('Right', 'themerex') => 'right',
				__('Both', 'themerex') => 'both'
			),
			"type" => "dropdown"
        )
    )
) );

class WPBakeryShortCode_Br extends THEMEREX_VC_ShortCodeSingle {}







// Button
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "button",
	"name" => __("Button", "themerex"),
	"description" => __("Button with link", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_button',
	"class" => "trx_sc_single trx_sc_button",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "content",
			"heading" => __("Caption", "themerex"),
            "description" => __("Button caption", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textfield"
        ),
		array(
			"param_name" => "type",
			"heading" => __("Button's shape", "themerex"),
            "description" => __("Select button's shape", "themerex"),
			"class" => "",
			"value" => array(
				__('Square', 'themerex') => 'square',
				__('Rounded', 'themerex') => 'rounded'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Button's style", "themerex"),
            "description" => __("Select button's style", "themerex"),
			"class" => "",
			"value" => array(
				__('Default', 'themerex') => 'default',
				__('Border', 'themerex') => 'border'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "size",
			"heading" => __("Button's size", "themerex"),
            "description" => __("Select button's size", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Small', 'themerex') => 'mini',
				__('Medium', 'themerex') => 'medium',
				__('Large', 'themerex') => 'big',
				__('Huge', 'themerex') => 'huge'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "fullsize",
			"heading" => __("Fullsize mode", "themerex"),
            "description" => __("Set button's width to 100%", "themerex"),
			"class" => "",
			"value" => array(__('Fullsize mode', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Button's color", "themerex"),
            "description" => __("Any color for button background", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Button's alignment", "themerex"),
            "description" => __("Align button to left or right", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_float),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "link",
			"heading" => __("Link URL", "themerex"),
            "description" => __("URL for the link on button click", "themerex"),
			"class" => "",
			"group" => __('Link', 'themerex'),
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "target",
			"heading" => __("Link target", "themerex"),
            "description" => __("Target for the link on button click", "themerex"),
			"class" => "",
			"group" => __('Link', 'themerex'),
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "rel",
			"heading" => __("Rel attribute", "themerex"),
            "description" => __("Rel attribute for the button's link (if need", "themerex"),
			"class" => "",
			"group" => __('Link', 'themerex'),
			"value" => "",
			"type" => "textfield"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )

) );

class WPBakeryShortCode_Button extends THEMEREX_VC_ShortCodeSingle {}







// Chat
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "chat",
	"name" => __("Chat", "themerex"),
	"description" => __("Chat message", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_chat',
	"class" => "trx_sc_container trx_sc_chat",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
            "param_name" => "title",
            "heading" => __("Item title", "themerex"),
            "description" => __("Title for current chat item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "link",
			"heading" => __("Link URL", "themerex"),
            "description" => __("URL for the link on chat title click", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "image",
			"heading" => __("URL for image file", "themerex"),
            "description" => __("Select image for the chat item", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Chat item content", "themerex"),
            "description" => __("Current chat item content", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'

) );

class WPBakeryShortCode_Chat extends THEMEREX_VC_ShortCodeContainer {}






// Columns
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "columns",
	"name" => __("Columns", "themerex"),
	"description" => __("Insert columns with margins", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_columns',
	"class" => "trx_sc_columns",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_column_item'),
	"params" => array(
		array(
            "param_name" => "count",
            "heading" => __("Columns count", "themerex"),
            "description" => __("Number of the columns in the container.", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "2",
			"type" => "textfield"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id,
		$THEMEREX_VC_class
    ),
    'default_content' => '
	    [column_item][/column_item]
	    [column_item][/column_item]
    ',
	'js_view' => 'VcTrxColumnsView'
) );


vc_map( array(
	"base" => "column_item",
	"name" => __("Column", "themerex"),
	"description" => __("Column item", "themerex"),
	"show_settings_on_create" => true,
	"class" => "trx_sc_collection trx_sc_column_item",
	"content_element" => true,
	"is_container" => true,
	"as_child" => array('only' => 'columns'),
	"as_parent" => array('except' => 'columns'),
	"params" => array(
		array(
            "param_name" => "span",
            "heading" => __("Merge columns", "themerex"),
            "description" => __("Count merged columns from current", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Column's content", "themerex"),
            "description" => __("Content of the current column", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxColumnItemView'
) );

class WPBakeryShortCode_Columns extends THEMEREX_VC_ShortCodeColumns {}
class WPBakeryShortCode_Column_Item extends THEMEREX_VC_ShortCodeCollection {}







// Contact form
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "contact_form",
	"name" => __("Contact form", "themerex"),
	"description" => __("Insert contact form", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_contact_form',
	"class" => "trx_sc_single trx_sc_contact_form",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
            "param_name" => "title",
            "heading" => __("Title", "themerex"),
            "description" => __("Title above contact form", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "description",
			"heading" => __("Description (under the title)", "themerex"),
            "description" => __("Contact form description", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );
class WPBakeryShortCode_Contact_Form extends THEMEREX_VC_ShortCodeSingle {}







// Countdown
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "countdown",
	"name" => __("Countdown", "themerex"),
	"description" => __("Insert countdown object", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_countdown',
	"class" => "trx_sc_single trx_sc_countdown",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
            "param_name" => "date",
            "heading" => __("Date", "themerex"),
            "description" => __("Upcoming date (format: yyyy-mm-dd)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "time",
            "heading" => __("Time", "themerex"),
            "description" => __("Upcoming time (format: HH:mm:ss)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Style", "themerex"),
            "description" => __("Style of the countdown block", "themerex"),
			"class" => "",
			"value" => array_flip(array(
				'1' => __('Style 1', 'themerex'),
				'2' => __('Style 2', 'themerex')
			)),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Alignment", "themerex"),
            "description" => __("Align counter to left, center or right", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Countdown extends THEMEREX_VC_ShortCodeSingle {}







// Divider
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "divider",
	"name" => __("Divider", "themerex"),
	"description" => __("Create gradient horizontal divider", "themerex"),
	"category" => __('Content', 'js_composer'),
	"class" => "trx_sc_single trx_sc_divider",
    'icon' => 'icon_trx_divider',
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "type",
			"heading" => __("Style", "themerex"),
            "description" => __("Line style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
					__('Standard', 'themerex') => 'std',
					__('Solid', 'themerex') => 'solid',
					__('Dashed', 'themerex') => 'dashed',
					__('Dotted', 'themerex') => 'dotted'
				),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Divider color", "themerex"),
            "description" => __("Divider color", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Divider extends THEMEREX_VC_ShortCodeSingle {}







// Dropcaps
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "dropcaps",
	"name" => __("Dropcaps", "themerex"),
	"description" => __("Make first letter of the text as dropcaps", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_dropcaps',
	"class" => "trx_sc_container trx_sc_dropcaps",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Style", "themerex"),
            "description" => __("Dropcaps style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Style 1', 'themerex') => 1,
				__('Style 2', 'themerex') => 2,
				__('Style 3', 'themerex') => 3,
				__('Style 4', 'themerex') => 4,
				__('Style 5', 'themerex') => 5,
				__('Style 6', 'themerex') => 6
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Paragraph text", "themerex"),
            "description" => __("Paragraph with dropcaps content", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'

) );

class WPBakeryShortCode_Dropcaps extends THEMEREX_VC_ShortCodeContainer {}







// Emailer
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "emailer",
	"name" => __("E-mail collector", "themerex"),
	"description" => __("Collect e-mails into specified group", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_emailer',
	"class" => "trx_sc_single trx_sc_emailer",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
            "param_name" => "group",
            "heading" => __("Group", "themerex"),
            "description" => __("The name of group to collect e-mail address", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "open",
			"heading" => __("Opened", "themerex"),
            "description" => __("Initially open the input field on show object", "themerex"),
			"class" => "",
			"value" => array(__('Initially opened', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Alignment", "themerex"),
            "description" => __("Align field to left, center or right", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Emailer extends THEMEREX_VC_ShortCodeSingle {}







// Gap
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trx_gap",
	"name" => __("Gap", "themerex"),
	"description" => __("Insert gap (fullwidth area) in the post content", "themerex"),
	"category" => __('Structure', 'js_composer'),
    'icon' => 'icon_trx_gap',
	"class" => "trx_sc_collection trx_sc_gap",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => false,
	"params" => array(
		array(
			"param_name" => "content",
			"heading" => __("Gap content", "themerex"),
            "description" => __("Gap inner content", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        )
    )
) );

class WPBakeryShortCode_Trx_Gap extends THEMEREX_VC_ShortCodeCollection {}







// Googlemap
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "googlemap",
	"name" => __("Google map", "themerex"),
	"description" => __("Insert Google map with desired address or coordinates", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_googlemap',
	"class" => "trx_sc_single trx_sc_googlemap",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
            "param_name" => "address",
            "heading" => __("Address", "themerex"),
            "description" => __("Address to show in map center", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "latlng",
            "heading" => __("Latitude and Longtitude", "themerex"),
            "description" => __("Comma separated map center coorditanes (instead Address)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "zoom",
            "heading" => __("Zoom", "themerex"),
            "description" => __("Map zoom factor", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "16",
			"type" => "textfield"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Style", "themerex"),
            "description" => __("Map custom style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
			 	__('Default', 'themerex') => 'default',
			 	__('Simple', 'themerex') => 'simple',
			 	__('Muted Blue', 'themerex') => 'muted_blue',
			 	__('Greyscale', 'themerex') => 'greyscale',
			 	__('Greyscale 2', 'themerex') => 'greyscale2',
			 	__('Style 1', 'themerex') => 'style1',
			 	__('Style 2', 'themerex') => 'style2',
			 	__('Style 3', 'themerex') => 'style3'
			),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width('100%'),
		THEMEREX_VC_height(240),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Googlemap extends THEMEREX_VC_ShortCodeSingle {}







// Highlight
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "highlight",
	"name" => __("Highlight text", "themerex"),
	"description" => __("Highlight text with selected color, background color and other styles", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_highlight',
	"class" => "trx_sc_container trx_sc_highlight",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "type",
			"heading" => __("Type", "themerex"),
            "description" => __("Highlight type", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
					__('Custom', 'themerex') => 0,
					__('Type 1', 'themerex') => 1,
					__('Type 2', 'themerex') => 2
				),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Text color", "themerex"),
            "description" => __("Color for the highlighted text", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "backcolor",
			"heading" => __("Background color", "themerex"),
            "description" => __("Background color for the highlighted text", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
            "param_name" => "style",
            "heading" => __("CSS-styles", "themerex"),
            "description" => __("Any additional CSS rules", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Highlight text", "themerex"),
            "description" => __("Content for highlight", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'
) );

class WPBakeryShortCode_Highlight extends THEMEREX_VC_ShortCodeContainer {}






// Icon
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "icon",
	"name" => __("Icon", "themerex"),
	"description" => __("Insert the icon", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_icon',
	"class" => "trx_sc_single trx_sc_icon",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "icon",
			"heading" => __("Icon", "themerex"),
            "description" => __("Select icon class from Fontello icons set", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"value" => $THEMEREX_shortcodes_icons,
			"type" => "dropdown"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Text color", "themerex"),
            "description" => __("Icon's color", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "bg_color",
			"heading" => __("Background color", "themerex"),
            "description" => __("Background color for the icon", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "background",
			"heading" => __("Background style", "themerex"),
            "description" => __("Style of the icon background", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('None', 'themerex') => 'none',
				__('Round', 'themerex') => 'round',
				__('Square', 'themerex') => 'square'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "size",
			"heading" => __("Font size", "themerex"),
            "description" => __("Icon's font size", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "weight",
			"heading" => __("Font weight", "themerex"),
            "description" => __("Icon's font weight", "themerex"),
			"class" => "",
			"value" => array(
				__('Thin (100)', 'themerex') => '100',
				__('Light (300)', 'themerex') => '300',
				__('Normal (400)', 'themerex') => '400',
				__('Bold (700)', 'themerex') => '700'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Icon's alignment", "themerex"),
            "description" => __("Align icon to left, center or right", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
) );

class WPBakeryShortCode_Icon extends THEMEREX_VC_ShortCodeSingle {}







// Image
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "image",
	"name" => __("Image", "themerex"),
	"description" => __("Insert image", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_image',
	"class" => "trx_sc_single trx_sc_image",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "url",
			"heading" => __("Select image", "themerex"),
            "description" => __("Select image from library", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Image alignment", "themerex"),
            "description" => __("Align image to left or right side", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_float),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
            "description" => __("Image's title", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Image extends THEMEREX_VC_ShortCodeSingle {}







// Infobox
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "infobox",
	"name" => __("Infobox", "themerex"),
	"description" => __("Box with info or error message", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_infobox',
	"class" => "trx_sc_container trx_sc_infobox",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Style", "themerex"),
            "description" => __("Infobox style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
					__('Regular', 'themerex') => 'regular',
					__('Info', 'themerex') => 'info',
					__('Success', 'themerex') => 'success',
					__('Error', 'themerex') => 'error'
				),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "closeable",
			"heading" => __("Closeable", "themerex"),
            "description" => __("Create closeable box (with close button)", "themerex"),
			"class" => "",
			"value" => array(__('Close button', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Message text", "themerex"),
            "description" => __("Message for the infobox", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'
) );

class WPBakeryShortCode_Infobox extends THEMEREX_VC_ShortCodeContainer {}







// Line
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "line",
	"name" => __("Line", "themerex"),
	"description" => __("Insert line (delimiter)", "themerex"),
	"category" => __('Content', 'js_composer'),
	"class" => "trx_sc_single trx_sc_line",
    'icon' => 'icon_trx_line',
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Style", "themerex"),
            "description" => __("Line style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
					__('Solid', 'themerex') => 'solid',
					__('Dashed', 'themerex') => 'dashed',
					__('Dotted', 'themerex') => 'dotted',
					__('Double', 'themerex') => 'double',
					__('Shadow', 'themerex') => 'shadow'
				),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Line color", "themerex"),
            "description" => __("Line color", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Line extends THEMEREX_VC_ShortCodeSingle {}







// List
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "list",
	"name" => __("List", "themerex"),
	"description" => __("List items with specific bullets", "themerex"),
	"category" => __('Content', 'js_composer'),
	"class" => "trx_sc_collection trx_sc_list",
    'icon' => 'icon_trx_list',
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_list_item'),
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Bullet's style", "themerex"),
            "description" => __("Bullet's style for each list item", "themerex"),
			"class" => "",
			"admin_label" => true,
			"value" => array_flip($THEMEREX_shortcodes_list_styles),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "icon",
			"heading" => __("List icon", "themerex"),
            "description" => __("Select list icon from Fontello icons set (only for style=Iconed)", "themerex"),
			"admin_label" => true,
			"class" => "",
	        'dependency' => array(
				'element' => 'style',
				'value' => array('iconed')
			),
			"value" => $THEMEREX_shortcodes_icons,
			"type" => "dropdown"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
    'default_content' => '
	    [list_item title="' . __( 'Item 1', 'themerex' ) . '"][/list_item]
    	[list_item title="' . __( 'Item 2', 'themerex' ) . '"][/list_item]
    '
) );


vc_map( array(
	"base" => "list_item",
	"name" => __("List item", "themerex"),
	"description" => __("List item with specific bullet", "themerex"),
	"class" => "trx_sc_single trx_sc_list_item",
	"show_settings_on_create" => true,
	"content_element" => true,
	"is_container" => true,
	"as_child" => array('only' => 'list'), // Use only|except attributes to limit parent (separate multiple values with comma)
	"as_parent" => array('except' => 'list'),
	"params" => array(
		array(
            "param_name" => "title",
            "heading" => __("List item title", "themerex"),
            "description" => __("Title for the current list item (show it as tooltip)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "icon",
			"heading" => __("List item icon", "themerex"),
            "description" => __("Select list item icon from Fontello icons set (only for style=Iconed)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => $THEMEREX_shortcodes_icons,
			"type" => "dropdown"
        ),
		array(
            "param_name" => "link",
            "heading" => __("List item link", "themerex"),
            "description" => __("Link for the current list item", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "target",
            "heading" => __("List item link target", "themerex"),
            "description" => __("Link's target for the current list item", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "content",
			"heading" => __("List item text", "themerex"),
            "description" => __("Current list item content", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextView'

) );

class WPBakeryShortCode_List extends THEMEREX_VC_ShortCodeCollection {}
class WPBakeryShortCode_List_Item extends THEMEREX_VC_ShortCodeSingle {}






// Popup
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trx_popup",
	"name" => __("Popup window", "themerex"),
	"description" => __("Container for any html-block with desired class and style for popup window", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_popup',
	"class" => "trx_sc_collection trx_sc_popup",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "content",
			"heading" => __("Container content", "themerex"),
            "description" => __("Content for popup container", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id,
		$THEMEREX_VC_class,
		$THEMEREX_VC_style
    )
) );

class WPBakeryShortCode_Popup extends THEMEREX_VC_ShortCodeCollection {}







// Price
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trx_price",
	"name" => __("Price", "themerex"),
	"description" => __("Insert price with decoration", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_price',
	"class" => "trx_sc_single trx_sc_price",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "money",
			"heading" => __("Money", "themerex"),
            "description" => __("Money value (dot or comma separated)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "currency",
			"heading" => __("Currency symbol", "themerex"),
            "description" => __("Currency character", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "$",
			"type" => "textfield"
        ),
		array(
			"param_name" => "period",
			"heading" => __("Period", "themerex"),
            "description" => __("Period text (if need). For example: monthly, daily, etc.", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Trx_Price extends THEMEREX_VC_ShortCodeSingle {}







// Price table
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trx_price_table",
	"name" => __("Price table", "themerex"),
	"description" => __("Price table container.", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_price_table',
	"class" => "trx_sc_columns trx_sc_list_item",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_price_item'),
	"params" => array(
		array(
			"param_name" => "align",
			"heading" => __("Table text alignment", "themerex"),
            "description" => __("Alignment text in the table", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "count",
			"heading" => __("Columns count", "themerex"),
            "description" => __("Columns count (required)", "themerex"),
			"class" => "",
			"admin_label" => true,
			"value" => "2",
			"type" => "textfield"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxColumnsView'
) );


vc_map( array(
	"base" => "trx_price_item",
	"name" => __("Price item", "themerex"),
	"description" => __("Price item column", "themerex"),
    'icon' => 'icon_trx_price_item',
	"show_settings_on_create" => false,
	"class" => "trx_sc_collection trx_sc_column_item trx_sc_price_item",
	"content_element" => true,
	"is_container" => true,
	"as_parent" => array('only' => 'trx_price_data'),
	"as_child" => array('only' => 'trx_price_table'),
	"params" => array(
		array(
			"param_name" => "animation",
			"heading" => __("Animation", "themerex"),
            "description" => __("Animate column on mouse hover", "themerex"),
			"class" => "",
			"value" => array(__('Animate column', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		$THEMEREX_VC_id
    )
) );


vc_map( array(
	"base" => "trx_price_data",
	"name" => __("Price item data", "themerex"),
	"description" => __("Price item data - title, price, footer, etc.", "themerex"),
    'icon' => 'icon_trx_price_data',
	"show_settings_on_create" => true,
	"class" => "trx_sc_container trx_sc_price_data",
	"content_element" => true,
	"is_container" => true,
	"as_parent" => array('except' => 'trx_price_table'),
	"as_child" => array('only' => 'trx_price_item'),
	"params" => array(
		array(
			"param_name" => "type",
			"heading" => __("Cell type", "themerex"),
            "description" => __("Select type of the price table cell", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Regular', 'themerex') => 'none',
				__('Title', 'themerex') => 'title',
				__('Image', 'themerex') => 'image',
				__('Price', 'themerex') => 'price',
				__('Footer', 'themerex') => 'footer',
				__('United', 'themerex') => 'united'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Content", "themerex"),
            "description" => __("Current cell content", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		array(
			"param_name" => "money",
			"heading" => __("Money", "themerex"),
            "description" => __("Money value (dot or comma separated)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "currency",
			"heading" => __("Currency symbol", "themerex"),
            "description" => __("Currency character", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "$",
			"type" => "textfield"
        ),
		array(
			"param_name" => "period",
			"heading" => __("Period", "themerex"),
            "description" => __("Period text (if need). For example: monthly, daily, etc.", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "image",
			"heading" => __("URL for image file", "themerex"),
            "description" => __("Select image to fill cell", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		$THEMEREX_VC_id,
		$THEMEREX_VC_class
    ),
	'js_view' => 'VcTrxTextContainerView'
) );

class WPBakeryShortCode_Trx_Price_Table extends THEMEREX_VC_ShortCodeColumns {}
class WPBakeryShortCode_Trx_Price_Item extends THEMEREX_VC_ShortCodeCollection {}
class WPBakeryShortCode_Trx_Price_Data extends THEMEREX_VC_ShortCodeContainer {}







// Quote
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "quote",
	"name" => __("Quote", "themerex"),
	"description" => __("Quote text", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_quote',
	"class" => "trx_sc_container trx_sc_quote",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "cite",
			"heading" => __("Quote cite", "themerex"),
            "description" => __("URL for the quote cite link", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "title",
			"heading" => __("Title (author)", "themerex"),
            "description" => __("Quote title (author name)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Quote content", "themerex"),
            "description" => __("Quote content", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'
) );

class WPBakeryShortCode_Quote extends THEMEREX_VC_ShortCodeContainer {}






// Review panel
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "review_panel",
	"name" => __("Review panel", "themerex"),
	"description" => __("Insert block with reviews", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_review_panel',
	"class" => "trx_sc_collection trx_sc_review_panel",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'review_item'),
	"params" => array(
		array(
			"param_name" => "max",
			"heading" => __("Max value", "themerex"),
            "description" => __("Max review points value", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "100",
			"type" => "textfield"
        ),
		array(
			"param_name" => "post_id",
			"heading" => __("Post ID", "themerex"),
            "description" => __("Enter review post ID", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
            "description" => __("Title of the reviews block", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "desc",
			"heading" => __("Description", "themerex"),
            "description" => __("Description of the reviews block", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Alignment", "themerex"),
            "description" => __("Align counter to left, center or right", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );


vc_map( array(
	"base" => "reviews_item",
	"name" => __("Reviews item", "themerex"),
	"description" => __("Reviews item", "themerex"),
	"show_settings_on_create" => true,
	"class" => "trx_sc_single trx_sc_reviews_item",
	"content_element" => true,
	"is_container" => false,
	"as_child" => array('only' => 'reviews_panel'),
	"as_parent" => array('except' => 'reviews_panel'),
	"params" => array(
		array(
            "param_name" => "label",
            "heading" => __("Label", "themerex"),
            "description" => __("Criteria label of current review item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "points",
            "heading" => __("Points", "themerex"),
            "description" => __("Criteria points of current review item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Reviews_Panel extends THEMEREX_VC_ShortCodeCollection {}
class WPBakeryShortCode_Reviews_Item extends THEMEREX_VC_ShortCodeSingle {}







// Section
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "section",
	"name" => __("Section container", "themerex"),
	"description" => __("Container for any section ([block] analog - to enable nesting)", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_block',
	"class" => "trx_sc_collection trx_sc_section",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "background_color",
			"heading" => __("Background color", "themerex"),
            "description" => __("Any background color for this section", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "background_image",
			"heading" => __("Background image", "themerex"),
            "description" => __("Select background image from library for this section", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "background_repeat",
			"heading" => __("Background repeat", "themerex"),
            "description" => __("Background repeat or single", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => array(
				__('No Repeat', 'themerex') => 'no-repeat',
				__('Repeat', 'themerex') => 'repeat',
				__('Repeat X axis', 'themerex') => 'repeat-x',
				__('Repeat Y axis', 'themerex') => 'repeat-y'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background_pos_x",
			"heading" => __("Background X position", "themerex"),
            "description" => __("Background horizontal position", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => array(
				__('Left', 'themerex') => 'left',
				__('Center', 'themerex') => 'center',
				__('Right', 'themerex') => 'right'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background_pos_y",
			"heading" => __("Background Y position", "themerex"),
            "description" => __("Background vertical position", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => array(
				__('Top', 'themerex') => 'top',
				__('Center', 'themerex') => 'center',
				__('Bottom', 'themerex') => 'bottom'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background_size",
			"heading" => __("Background size", "themerex"),
            "description" => __("Background size", "themerex"),
			"group" => __('Background', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "dedicated",
			"heading" => __("Dedicated", "themerex"),
            "description" => __("Use this block as dedicated content - show it before post title on single page", "themerex"),
			"class" => "",
			"value" => array(__('Use as dedicated content', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "content_wrap",
			"heading" => __("Wrap content", "themerex"),
            "description" => __("Check if you want to wrap content inside section", "themerex"),
			"class" => "",
			"value" => array(__('Wrap content', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "parallax",
			"heading" => __("Parallax scrolling", "themerex"),
            "description" => __("Enable parallax scrolling for this section", "themerex"),
			"class" => "",
			"value" => array(__('Parallax', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Block alignment", "themerex"),
            "description" => __("Select block alignment", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "text_align",
			"heading" => __("Text alignment", "themerex"),
            "description" => __("Select text alignment inside block", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "columns",
			"heading" => __("Columns emulation", "themerex"),
            "description" => __("Select width for columns emulation", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_columns),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Container content", "themerex"),
            "description" => __("Content for section container", "themerex"),
			"class" => "",
			"value" => "",
			"holder" => "div",
			"type" => "textarea_html"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id,
		$THEMEREX_VC_class,
		$THEMEREX_VC_style
    )
) );

class WPBakeryShortCode_Section extends THEMEREX_VC_ShortCodeCollection {}







// Sidebar
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "themerex_sidebar",
	"name" => __("Sidebar", "themerex"),
	"description" => __("Insert Sidebar into the page/post content", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_sidebar',
	"class" => "trx_sc_single trx_sc_sidebar",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "name",
			"heading" => __("Sidebar", "themerex"),
            "description" => __("Select sidebar for output", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_sidebars),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "layout",
			"heading" => __("Layout", "themerex"),
            "description" => __("Select widgets layout: rows or columns", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip(array(
				'columns' => __('Columns', 'themerex'),
				'rows' => __('Rows', 'themerex')
			)),
			"type" => "dropdown"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right
    )
) );

class WPBakeryShortCode_Themerex_Sidebar extends THEMEREX_VC_ShortCodeSingle {}







// Skills
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "skills",
	"name" => __("Skills", "themerex"),
	"description" => __("Insert skills diagramm", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_skills',
	"class" => "trx_sc_collection trx_sc_skills",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_skills_item'),
	"params" => array(
		array(
			"param_name" => "maximum",
			"heading" => __("Max value", "themerex"),
            "description" => __("Max value for skills items", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "100",
			"type" => "textfield"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Alignment", "themerex"),
            "description" => __("Align skills block to left or right side", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_float),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Skills items color", "themerex"),
            "description" => __("Color for all skills items", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "type",
			"heading" => __("Skills type", "themerex"),
            "description" => __("Select type of skills block", "themerex"),
			"admin_label" => true,
			"group" => __('Style', 'themerex'),
			"class" => "",
			"value" => array(
				__('Bar', 'themerex') => 'bar',
				__('Counter', 'themerex') => 'counter',
				__('Circles', 'themerex') => 'circles'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Skills style", "themerex"),
            "description" => __("Select style of skills items (only for type=counter)", "themerex"),
			"admin_label" => true,
			"group" => __('Style', 'themerex'),
			"class" => "",
			"value" => array(
				__('Style 1', 'themerex') => '1',
				__('Style 2', 'themerex') => '2',
				__('Style 3', 'themerex') => '3',
				__('Style 4', 'themerex') => '4'
			),
	        'dependency' => array(
				'element' => 'type',
				'value' => array('counter')
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "dir",
			"heading" => __("Direction", "themerex"),
            "description" => __("Select direction of skills block", "themerex"),
			"admin_label" => true,
			"group" => __('Style', 'themerex'),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_dir),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "layout",
			"heading" => __("Skills layout", "themerex"),
            "description" => __("Select layout of skills block", "themerex"),
			"admin_label" => true,
			"group" => __('Style', 'themerex'),
	        'dependency' => array(
				'element' => 'type',
				'value' => array('counter','bar','pie')
			),
			"class" => "",
			"value" => array(
				__('Rows', 'themerex') => 'rows',
				__('Columns', 'themerex') => 'columns'
			),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );


vc_map( array(
	"base" => "skills_item",
	"name" => __("Skills item", "themerex"),
	"description" => __("Skills item", "themerex"),
	"show_settings_on_create" => true,
	"class" => "trx_sc_single trx_sc_skills_item",
	"content_element" => true,
	"is_container" => false,
	"as_child" => array('only' => 'trx_skills'),
	"as_parent" => array('except' => 'trx_skills'),
	"params" => array(
		array(
            "param_name" => "title",
            "heading" => __("Title", "themerex"),
            "description" => __("Title for the current skills item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "level",
            "heading" => __("Level", "themerex"),
            "description" => __("Level value for the current skills item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "50",
			"type" => "textfield"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Color", "themerex"),
            "description" => __("Color for current skills item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Item style", "themerex"),
            "description" => __("Select style for the current skills item (only for type=counter)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Style 1', 'themerex') => '1',
				__('Style 2', 'themerex') => '2',
				__('Style 3', 'themerex') => '3',
				__('Style 4', 'themerex') => '4'
			),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width(),
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Skills extends THEMEREX_VC_ShortCodeCollection {}
class WPBakeryShortCode_Skills_Item extends THEMEREX_VC_ShortCodeSingle {}







// Slider
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "slider",
	"name" => __("Slider", "themerex"),
	"description" => __("Insert slider", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_slider',
	"class" => "trx_sc_collection trx_sc_slider",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_slider_item'),
	"params" => array_merge(array(
		array(
			"param_name" => "engine",
			"heading" => __("Engine", "themerex"),
            "description" => __("Select engine for slider. Attention! Swiper is built-in engine, all other engines appears only if corresponding plugings are installed", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_sliders),
			"type" => "dropdown"
        )),
		revslider_exists() || royalslider_exists() ? array(
		array(
			"param_name" => "alias",
			"heading" => __("Revolution slider alias or Royal Slider ID", "themerex"),
            "description" => __("Alias for Revolution slider or Royal slider ID", "themerex"),
			"admin_label" => true,
			"class" => "",
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('revo','royal')
			),
			"value" => "",
			"type" => "textfield"
        )) : array(), array(
		array(
			"param_name" => "cat",
			"heading" => __("Swiper: Category list", "themerex"),
            "description" => __("Comma separated list of category slugs. If empty - select posts from any category or from IDs list", "themerex"),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "count",
			"heading" => __("Swiper: Number of posts", "themerex"),
            "description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => "3",
			"type" => "textfield"
        ),
		array(
			"param_name" => "offset",
			"heading" => __("Swiper: Offset before select posts", "themerex"),
            "description" => __("Skip posts before select next part.", "themerex"),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => "0",
			"type" => "textfield"
        ),
		array(
			"param_name" => "date_before",
			"heading" => __("Swiper: Posts published before", "themerex"),
            "description" => __("Date to retrieve posts before. Please, use format: YYYY-mm-dd (for example, 2014-12-31)", "themerex"),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "date_after",
			"heading" => __("Swiper: Posts published after", "themerex"),
            "description" => __("Date to retrieve posts after. Please, use format: YYYY-mm-dd (for example, 2014-12-31)", "themerex"),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "orderby",
			"heading" => __("Swiper: Post sorting", "themerex"),
            "description" => __("Select desired posts sorting method", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_sorting),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "order",
			"heading" => __("Swiper: Post order", "themerex"),
            "description" => __("Select desired posts order", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_ordering),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "ids",
			"heading" => __("Swiper: Post IDs list", "themerex"),
            "description" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "controls",
			"heading" => __("Swiper: Show slider controls", "themerex"),
            "description" => __("Show arrows inside slider", "themerex"),
			"group" => __('Details', 'themerex'),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => array(__('Show controls', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "pagination",
			"heading" => __("Swiper: Show slider pagination", "themerex"),
            "description" => __("Show bullets or titles to switch slides", "themerex"),
			"group" => __('Details', 'themerex'),
	        'dependency' => array(
				'element' => 'engine',
				'value' => array('flex','swiper')
			),
			"class" => "",
			"value" => array(
					__('None', 'themerex') => 'false',
					__('Default', 'themerex') => 'default',
					__('Thumbnails', 'themerex') => 'thumbs',
					__('Post-format icons', 'themerex') => 'icons'
				),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Float slider", "themerex"),
            "description" => __("Float slider to left or right side", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_float),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "progressbar",
			"heading" => __("Progress bar", "themerex"),
            "description" => __("Show slider progress bar", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => array(__('Show progess bar', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "caption",
			"heading" => __("Slide caption", "themerex"),
            "description" => __("Show slide title and info", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => array(__('Show slide caption', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "info",
			"heading" => __("Slide info", "themerex"),
            "description" => __("Show slide info", "themerex"),
			"group" => __('Details', 'themerex'),
			"class" => "",
			"value" => array(__('Show slide info', 'themerex') => 'yes'),
			"type" => "checkbox"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ))
) );


vc_map( array(
	"base" => "slider_item",
	"name" => __("Slide", "themerex"),
	"description" => __("Slider item - single slide", "themerex"),
	"show_settings_on_create" => true,
	"content_element" => true,
	"is_container" => false,
	"as_child" => array('only' => 'slider'),
	"as_parent" => array('except' => 'slider'),
	"params" => array(
		array(
			"param_name" => "src",
			"heading" => __("URL (source) for image file", "themerex"),
            "description" => __("Select or upload image or write URL from other site for the current slide", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Slider extends THEMEREX_VC_ShortCodeCollection {}
class WPBakeryShortCode_Slider_Item extends THEMEREX_VC_ShortCodeSingle {}







// Table
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "table",
	"name" => __("Table", "themerex"),
	"description" => __("Insert a table", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_table',
	"class" => "trx_sc_container trx_sc_table",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Table style", "themerex"),
            "description" => __("Select table style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Style 1', 'themerex') => '1',
				__('Style 2', 'themerex') => '2',
				__('Style 3', 'themerex') => '3',
				__('Style 4', 'themerex') => '4'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Table content", "themerex"),
            "description" => __("Content, created with any table-generator", "themerex"),
			"class" => "",
			"value" => "Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'
) );

class WPBakeryShortCode_Table extends THEMEREX_VC_ShortCodeContainer {}







// Tabs
//-------------------------------------------------------------------------------------

$tab_id_1 = 'sc_tab_'.time() . '_1_' . rand( 0, 100 );
$tab_id_2 = 'sc_tab_'.time() . '_2_' . rand( 0, 100 );
vc_map( array(
	"base" => "tabs",
	"name" => __("Tabs", "themerex"),
	"description" => __("Tabs", "themerex"),
	"category" => __('Content', 'js_composer'),
	'icon' => 'icon_trx_tabs',
	"class" => "trx_sc_collection trx_sc_tabs",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'tab'),
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Tabs style", "themerex"),
			"description" => __("Select style of tabs items", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Horizontal', 'themerex') => 'horizontal',
				__('Vertical', 'themerex') => 'vertical'
			),
			"type" => "dropdown"
		),
		array(
			"param_name" => "initial",
			"heading" => __("Initially opened tab", "themerex"),
			"description" => __("Number of initially opened tab", "themerex"),
			"class" => "",
			"value" => 1,
			"type" => "textfield"
		),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
	),
	'default_content' => '
		[tab title="' . __( 'Tab 1', 'themerex' ) . '" tab_id="'.$tab_id_1.'"][/tab]
		[tab title="' . __( 'Tab 2', 'themerex' ) . '" tab_id="'.$tab_id_2.'"][/tab]
	',
	"custom_markup" => '
		<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
			<ul class="tabs_controls">
			</ul>
			%content%
		</div>
	',
	'js_view' => 'VcTrxTabsView'
) );


vc_map( array(
	"base" => "tab",
	"name" => __("Tab item", "themerex"),
	"description" => __("Single tab item", "themerex"),
	"show_settings_on_create" => true,
	"class" => "trx_sc_collection trx_sc_tab",
	"content_element" => true,
	"is_container" => true,
	"as_child" => array('only' => 'trx_tabs'),
	"as_parent" => array('except' => 'trx_tabs'),
	"params" => array(
		array(
			"param_name" => "title",
			"heading" => __("Tab title", "themerex"),
			"description" => __("Title for current tab", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "tab_id",
			"heading" => __("Tab ID", "themerex"),
			"description" => __("ID for current tab (required). Please, start it from letter.", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "icon",
			"heading" => __("Tab icon", "themerex"),
            "description" => __("Select icon for the current tab from Fontello icons set", "themerex"),
			"class" => "",
			"value" => "",
			"value" => $THEMEREX_shortcodes_icons,
			"type" => "dropdown"
        )
	),
  'js_view' => 'VcTrxTabView'
) );
class WPBakeryShortCode_Tabs extends THEMEREX_VC_ShortCodeTabs {}
class WPBakeryShortCode_Tab extends THEMEREX_VC_ShortCodeTab {}






// Team
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trx_team",
	"name" => __("Team", "themerex"),
	"description" => __("Insert team members", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_team',
	"class" => "trx_sc_columns trx_sc_team",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_team_item'),
	"params" => array(
		array(
            "param_name" => "count",
            "heading" => __("Team members number", "themerex"),
            "description" => __("Number of the team members in this list.", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "2",
			"type" => "textfield"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id,
		$THEMEREX_VC_class
    ),
    'default_content' => '
	    [trx_team_item user="' . __( 'Member 1', 'themerex' ) . '"][/trx_team_item]
    	[trx_team_item user="' . __( 'Member 2', 'themerex' ) . '"][/trx_team_item]
    ',
	'js_view' => 'VcTrxColumnsView'
) );


vc_map( array(
	"base" => "trx_team_item",
	"name" => __("Team member", "themerex"),
	"description" => __("Team member - all data pull out from it account on your site", "themerex"),
	"show_settings_on_create" => true,
	"class" => "trx_sc_item trx_sc_column_item trx_sc_team_item",
	"content_element" => true,
	"is_container" => false,
	"as_child" => array('only' => 'trx_team'),
	"as_parent" => array('except' => 'trx_team'),
	"params" => array(
		array(
            "param_name" => "user",
            "heading" => __("Team member", "themerex"),
            "description" => __("Select one of registered users", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_users),
			"type" => "dropdown"
        ),
		array(
            "param_name" => "name",
            "heading" => __("Member's name", "themerex"),
            "description" => __("Team member's name", "themerex"),
			"admin_label" => true,
	        'dependency' => array(
				'element' => 'user',
				'value' => array('none')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "position",
            "heading" => __("Position", "themerex"),
            "description" => __("Team member's position", "themerex"),
			"admin_label" => true,
	        'dependency' => array(
				'element' => 'user',
				'value' => array('none')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "email",
            "heading" => __("E-mail", "themerex"),
            "description" => __("Team member's e-mail", "themerex"),
	        'dependency' => array(
				'element' => 'user',
				'value' => array('none')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "photo",
			"heading" => __("Member's Photo", "themerex"),
            "description" => __("Team member's photo (avatar", "themerex"),
	        'dependency' => array(
				'element' => 'user',
				'value' => array('none')
			),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
            "param_name" => "socials",
            "heading" => __("Socials", "themerex"),
            "description" => __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", "themerex"),
	        'dependency' => array(
				'element' => 'user',
				'value' => array('none')
			),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		$THEMEREX_VC_id,
		$THEMEREX_VC_class
    )
) );

class WPBakeryShortCode_Trx_Team extends THEMEREX_VC_ShortCodeColumns {}
class WPBakeryShortCode_Trx_Team_Item extends THEMEREX_VC_ShortCodeItem {}







// Testimonials
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "testimonials",
	"name" => __("Testimonials", "themerex"),
	"description" => __("Insert testimonials slider", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_testimonials',
	"class" => "trx_sc_collection trx_sc_testimonials",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'trx_testimonials_item'),
	"params" => array(
		array(
            "param_name" => "title",
            "heading" => __("Title", "themerex"),
            "description" => __("Title of testimonmials block", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "style",
			"heading" => __("Style", "themerex"),
            "description" => __("Select testimonials style", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Style 1', 'themerex') => '1',
				__('Style 2', 'themerex') => '2'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Alignment", "themerex"),
            "description" => __("Align testimonials to left, center or right", "themerex"),
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );


vc_map( array(
	"base" => "testimonials_item",
	"name" => __("Testimonials item", "themerex"),
	"description" => __("Single testimonials item", "themerex"),
	"show_settings_on_create" => true,
	"class" => "trx_sc_container trx_sc_testimonials_item",
	"content_element" => true,
	"is_container" => true,
	"as_child" => array('only' => 'testimonials'),
	"as_parent" => array('except' => 'testimonials'),
	"params" => array(
		array(
            "param_name" => "name",
            "heading" => __("Name", "themerex"),
            "description" => __("Name of the testimonmials author", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "position",
            "heading" => __("Position", "themerex"),
            "description" => __("Position of the testimonmials author", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
            "param_name" => "email",
            "heading" => __("E-mail", "themerex"),
            "description" => __("E-mail of the testimonmials author", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "photo",
			"heading" => __("Photo", "themerex"),
            "description" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "content",
			"heading" => __("Testimonials text", "themerex"),
            "description" => __("Current testimonials text", "themerex"),
			"class" => "",
			"value" => "",
			/*"holder" => "div",*/
			"type" => "textarea_html"
        ),
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextContainerView'
) );

class WPBakeryShortCode_Testimonials extends THEMEREX_VC_ShortCodeColumns {}
class WPBakeryShortCode_Testimonials_Item extends THEMEREX_VC_ShortCodeContainer {}







// Title
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "title",
	"name" => __("Title", "themerex"),
	"description" => __("Create header tag (1-6 level) with many styles", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_title',
	"class" => "trx_sc_single trx_sc_title",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "content",
			"heading" => __("Title content", "themerex"),
            "description" => __("Title content", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textarea_html"
        ),
		array(
			"param_name" => "type",
			"heading" => __("Title type", "themerex"),
            "description" => __("Title type (header level)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Header 1', 'themerex') => '1',
				__('Header 2', 'themerex') => '2',
				__('Header 3', 'themerex') => '3',
				__('Header 4', 'themerex') => '4',
				__('Header 5', 'themerex') => '5',
				__('Header 6', 'themerex') => '6'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "link",
			"heading" => __("Link from title", "themerex"),
			"description" => __("Output title as link", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "style",
			"heading" => __("Title style", "themerex"),
            "description" => __("Title style: only text (regular) or with icon/image (iconed)", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array(
				__('Regular', 'themerex') => 'regular',
				__('With icon (image)', 'themerex') => 'iconed'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "align",
			"heading" => __("Alignment", "themerex"),
            "description" => __("Title text alignment", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => array_flip($THEMEREX_shortcodes_align),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "color",
			"heading" => __("Title color", "themerex"),
            "description" => __("Select color for the title", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		array(
			"param_name" => "font_size",
			"heading" => __("Font size", "themerex"),
			"description" => __("Title font size (in px)", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "weight",
			"heading" => __("Font weight", "themerex"),
            "description" => __("Title font weight", "themerex"),
			"class" => "",
			"value" => array(
				__('Default', 'themerex') => 'inherit',
				__('Thin (100)', 'themerex') => '100',
				__('Light (300)', 'themerex') => '300',
				__('Normal (400)', 'themerex') => '400',
				__('Bold (700)', 'themerex') => '700'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "letter_spacing",
			"heading" => __("Letter spacing", "themerex"),
			"description" => __("Title letter spacing (in px)", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "transform",
			"heading" => __("Title transform", "themerex"),
            "description" => __("Title text transform", "themerex"),
			"class" => "",
			"value" => array(
				__('None', 'themerex') => 'normal',
				__('Uppercase', 'themerex') => 'uppercase',
				__('Lowercase', 'themerex') => 'lowercase'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "icon",
			"heading" => __("Title font icon", "themerex"),
            "description" => __("Select font icon for the title from Fontello icons set (if style=iconed)", "themerex"),
			"class" => "",
			"group" => __('Icon &amp; Image', 'themerex'),
	        'dependency' => array(
				'element' => 'style',
				'value' => array('iconed')
			),
			"value" => "",
			"value" => $THEMEREX_shortcodes_icons,
			"type" => "dropdown"
        ),
		array(
			"param_name" => "image",
			"heading" => __("or image icon", "themerex"),
            "description" => __("Select image icon for the title instead icon above (if style=iconed)", "themerex"),
			"class" => "",
			"group" => __('Icon &amp; Image', 'themerex'),
	        'dependency' => array(
				'element' => 'style',
				'value' => array('iconed')
			),
			"value" => $THEMEREX_shortcodes_images,
			"type" => "dropdown"
        ),
		array(
			"param_name" => "picture",
			"heading" => __("or select uploaded image", "themerex"),
            "description" => __("Select or upload image or write URL from other site (if style=iconed)", "themerex"),
			"group" => __('Icon &amp; Image', 'themerex'),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		array(
			"param_name" => "size",
			"heading" => __("Icon (image) size", "themerex"),
            "description" => __("Select icon (image) size (if style=iconed)", "themerex"),
			"group" => __('Icon &amp; Image', 'themerex'),
			"class" => "",
			"value" => array(
				__('Small', 'themerex') => 'small',
				__('Medium', 'themerex') => 'medium',
				__('Large', 'themerex') => 'large',
				__('Huge', 'themerex') => 'huge'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "position",
			"heading" => __("Icon (image) position", "themerex"),
            "description" => __("Select icon (image) position (if style=iconed)", "themerex"),
			"group" => __('Icon &amp; Image', 'themerex'),
			"class" => "",
			"value" => array(
				__('Top', 'themerex') => 'top',
				__('Left', 'themerex') => 'left',
				__('Right', 'themerex') => 'right'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "background",
			"heading" => __("Show background under icon", "themerex"),
            "description" => __("Select background under icon (if style=iconed)", "themerex"),
			"group" => __('Icon &amp; Image', 'themerex'),
			"class" => "",
	        'dependency' => array(
				'element' => 'style',
				'value' => array('iconed')
			),
			"value" => array(
				__('None', 'themerex') => 'none',
				__('Square', 'themerex') => 'square',
				__('Circle', 'themerex') => 'circle'
			),
			"type" => "dropdown"
        ),
		array(
			"param_name" => "bg_color",
			"heading" => __("Background color", "themerex"),
            "description" => __("Icon's background color (if style=iconed)", "themerex"),
			"group" => __('Icon &amp; Image', 'themerex'),
	        'dependency' => array(
				'element' => 'style',
				'value' => array('iconed')
			),
			"class" => "",
			"value" => "",
			"type" => "colorpicker"
        ),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    ),
	'js_view' => 'VcTrxTextView'
) );

class WPBakeryShortCode_Title extends THEMEREX_VC_ShortCodeSingle {}







// Toggles
//-------------------------------------------------------------------------------------
	
vc_map( array(
	"base" => "toggles",
	"name" => __("Toggles", "themerex"),
	"description" => __("Toggles items", "themerex"),
	"category" => __('Content', 'js_composer'),
	'icon' => 'icon_trx_toggles',
	"class" => "trx_sc_collection trx_sc_toggles",
	"content_element" => true,
	"is_container" => true,
	"show_settings_on_create" => true,
	"as_parent" => array('only' => 'toggles_item'),
	"params" => array(
		array(
			"param_name" => "style",
			"heading" => __("Toggles style", "themerex"),
			"description" => __("Select style for display toggles", "themerex"),
			"class" => "",
			"admin_label" => true,
			"value" => array(
				__('Style 1', 'themerex') => 1,
				__('Style 2', 'themerex') => 2,
				__('Style 3', 'themerex') => 3
			),
			"type" => "dropdown"
		),
		array(
			"param_name" => "counter",
			"heading" => __("Counter", "themerex"),
			"description" => __("Display counter before each toggles title", "themerex"),
			"class" => "",
			"value" => array("Add item numbers before each element" => "on" ),
			"type" => "checkbox"
		),
		array(
			"param_name" => "large",
			"heading" => __("Large titles", "themerex"),
			"description" => __("Show large titles", "themerex"),
			"class" => "",
			"value" => array("Show large titles" => "on"),
			"type" => "checkbox"
		),
		array(
			"param_name" => "shadow",
			"heading" => __("Shadow", "themerex"),
			"description" => __("Display shadow under toggles block", "themerex"),
			"class" => "",
			"value" => array("Display shadow" => "on" ),
			"type" => "checkbox"
		),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
	),
	'default_content' => '
		[toggles_item title="' . __( 'Item 1 title', 'themerex' ) . '"][/toggles_item]
		[toggles_item title="' . __( 'Item 2 title', 'themerex' ) . '"][/toggles_item]
	',
	"custom_markup" => '
		<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
			%content%
		</div>
		<div class="tab_controls">
			<button class="add_tab" title="'.__("Add item", "themerex").'">'.__("Add item", "themerex").'</button>
		</div>
	',
	'js_view' => 'VcTrxTogglesView'
) );


vc_map( array(
	"base" => "toggles_item",
	"name" => __("Toggles item", "themerex"),
	"description" => __("Single toggles item", "themerex"),
	"show_settings_on_create" => true,
	"content_element" => true,
	"is_container" => true,
	"as_child" => array('only' => 'toggles'),
	"as_parent" => array('except' => 'toggles'),
	"params" => array(
		array(
			"param_name" => "title",
			"heading" => __("Title", "themerex"),
			"description" => __("Title for current toggles item", "themerex"),
			"admin_label" => true,
			"class" => "",
			"value" => "",
			"type" => "textfield"
		),
		array(
			"param_name" => "open",
			"heading" => __("Open on show", "themerex"),
			"description" => __("Open current toggle item on show", "themerex"),
			"class" => "",
			"value" => array("Opened" => "yes" ),
			"type" => "checkbox"
		),
		$THEMEREX_VC_id
	),
    'js_view' => 'VcTrxTogglesTabView'
) );
class WPBakeryShortCode_Toggles extends THEMEREX_VC_ShortCodeToggles {}
class WPBakeryShortCode_Toggles_Item extends THEMEREX_VC_ShortCodeTogglesItem {}







// Video
//-------------------------------------------------------------------------------------

vc_map( array(
	"base" => "trex_video",
	"name" => __("Video", "themerex"),
	"description" => __("Insert video player", "themerex"),
	"category" => __('Content', 'js_composer'),
    'icon' => 'icon_trx_video',
	"class" => "trx_sc_single trx_sc_video",
	"content_element" => true,
	"is_container" => false,
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"param_name" => "url",
			"heading" => __("URL for video file", "themerex"),
            "description" => __("Paste URL for video file", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "textfield"
        ),
		array(
			"param_name" => "autoplay",
			"heading" => __("Autoplay video", "themerex"),
            "description" => __("Autoplay video on page load", "themerex"),
			"class" => "",
			"value" => array("Autoplay" => "on" ),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "title",
			"heading" => __("Show title bar", "themerex"),
            "description" => __("Show title bar above video frame", "themerex"),
			"class" => "",
			"value" => array("Show title bar" => "on" ),
			"type" => "checkbox"
        ),
		array(
			"param_name" => "image",
			"heading" => __("Cover image", "themerex"),
            "description" => __("Select or upload image or write URL from other site for video preview", "themerex"),
			"class" => "",
			"value" => "",
			"type" => "attach_image"
        ),
		THEMEREX_VC_width(),
		THEMEREX_VC_height(),
		$THEMEREX_VC_margin_top,
		$THEMEREX_VC_margin_bottom,
		$THEMEREX_VC_margin_left,
		$THEMEREX_VC_margin_right,
		$THEMEREX_VC_id
    )
) );

class WPBakeryShortCode_Trex_Video extends THEMEREX_VC_ShortCodeSingle {}




if (function_exists('is_woocommerce')) {

	// WooCommerce - Cart
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "woocommerce_cart",
		"name" => __("Cart", "themerex"),
		"description" => __("WooCommerce shortcode: show cart page", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_wooc_cart',
		"class" => "trx_sc_alone trx_sc_woocommerce_cart",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => false,
		"params" => array()
	) );
	
	class WPBakeryShortCode_Trx_Woocommerce_Cart extends THEMEREX_VC_ShortCodeAlone {}


	// WooCommerce - Checkout
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "woocommerce_checkout",
		"name" => __("Checkout", "themerex"),
		"description" => __("WooCommerce shortcode: show checkout page", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_wooc_checkout',
		"class" => "trx_sc_alone trx_sc_woocommerce_checkout",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => false,
		"params" => array()
	) );
	
	class WPBakeryShortCode_Trx_Woocommerce_Checkout extends THEMEREX_VC_ShortCodeAlone {}


	// WooCommerce - My Account
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "woocommerce_my_account",
		"name" => __("My Account", "themerex"),
		"description" => __("WooCommerce shortcode: show my account page", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_wooc_my_account',
		"class" => "trx_sc_alone trx_sc_woocommerce_my_account",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => false,
		"params" => array()
	) );
	
	class WPBakeryShortCode_Trx_Woocommerce_My_Account extends THEMEREX_VC_ShortCodeAlone {}


	// WooCommerce - Order Tracking
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "woocommerce_order_tracking",
		"name" => __("Order Tracking", "themerex"),
		"description" => __("WooCommerce shortcode: show order tracking page", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_wooc_order_tracking',
		"class" => "trx_sc_alone trx_sc_woocommerce_order_tracking",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => false,
		"params" => array()
	) );
	
	class WPBakeryShortCode_Trx_Woocommerce_Order_Tracking extends THEMEREX_VC_ShortCodeAlone {}


	// WooCommerce - Shop Messages
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "shop_messages",
		"name" => __("Shop Messages", "themerex"),
		"description" => __("WooCommerce shortcode: show shop messages", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_wooc_shop_messages',
		"class" => "trx_sc_alone trx_sc_shop_messages",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => false,
		"params" => array()
	) );
	
	class WPBakeryShortCode_Trx_Shop_Messages extends THEMEREX_VC_ShortCodeAlone {}


	// WooCommerce - Product Page
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "product_page",
		"name" => __("Product Page", "themerex"),
		"description" => __("WooCommerce shortcode: display single product page", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_product_page',
		"class" => "trx_sc_single trx_sc_product_page",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "sku",
				"heading" => __("SKU", "themerex"),
				"description" => __("SKU code of displayed product", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "id",
				"heading" => __("ID", "themerex"),
				"description" => __("ID of displayed product", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "posts_per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "1",
				"type" => "textfield"
			),
			array(
				"param_name" => "post_type",
				"heading" => __("Post type", "themerex"),
				"description" => __("Post type to output (leave 'product')", "themerex"),
				"class" => "",
				"value" => "product",
				"type" => "textfield"
			),
			array(
				"param_name" => "post_status",
				"heading" => __("Post status", "themerex"),
				"description" => __("Display posts only with this status", "themerex"),
				"class" => "",
				"value" => array(
					__('Published', 'themerex') => 'published',
					__('Protected', 'themerex') => 'protected',
					__('Private', 'themerex') => 'private',
					__('Pending', 'themerex') => 'pending',
					__('Draft', 'themerex') => 'draft'
				),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Product_Page extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Product
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "product",
		"name" => __("Product", "themerex"),
		"description" => __("WooCommerce shortcode: display one product", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_product',
		"class" => "trx_sc_single trx_sc_product",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "sku",
				"heading" => __("SKU", "themerex"),
				"description" => __("Product's SKU code", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "id",
				"heading" => __("ID", "themerex"),
				"description" => __("Product's ID", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Product extends THEMEREX_VC_ShortCodeSingle {}


	// WooCommerce - Best Selling Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "best_selling_products",
		"name" => __("Best Selling Products", "themerex"),
		"description" => __("WooCommerce shortcode: show best selling products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_best_selling_products',
		"class" => "trx_sc_single trx_sc_best_selling_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Best_Selling_Products extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Recent Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "recent_products",
		"name" => __("Recent Products", "themerex"),
		"description" => __("WooCommerce shortcode: show recent products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_recent_products',
		"class" => "trx_sc_single trx_sc_recent_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Recent_Products extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Related Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "related_products",
		"name" => __("Related Products", "themerex"),
		"description" => __("WooCommerce shortcode: show related products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_related_products',
		"class" => "trx_sc_single trx_sc_related_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "posts_per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "rand",
				"type" => "textfield"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Related_Products extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Featured Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "featured_products",
		"name" => __("Featured Products", "themerex"),
		"description" => __("WooCommerce shortcode: show featured products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_featured_products',
		"class" => "trx_sc_single trx_sc_featured_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Featured_Products extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Top Rated Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "top_rated_products",
		"name" => __("Top Rated Products", "themerex"),
		"description" => __("WooCommerce shortcode: show top rated products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_top_rated_products',
		"class" => "trx_sc_single trx_sc_top_rated_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Top_Rated_Products extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Sale Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "sale_products",
		"name" => __("Sale Products", "themerex"),
		"description" => __("WooCommerce shortcode: list products on sale", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_sale_products',
		"class" => "trx_sc_single trx_sc_sale_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Sale_Products extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Product Category
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "product_category",
		"name" => __("Products from category", "themerex"),
		"description" => __("WooCommerce shortcode: list products in specified category(-ies)", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_product_category',
		"class" => "trx_sc_single trx_sc_product_category",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			),
			array(
				"param_name" => "category",
				"heading" => __("Category slugs", "themerex"),
				"description" => __("Comma separated category slugs", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "operator",
				"heading" => __("Operator", "themerex"),
				"description" => __("Slugs operator", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array(
					__('IN', 'themerex') => 'IN',
					__('NOT IN', 'themerex') => 'NOT IN',
					__('AND', 'themerex') => 'AND'
				),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Product_Category extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Products
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "products",
		"name" => __("Products", "themerex"),
		"description" => __("WooCommerce shortcode: list all products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_products',
		"class" => "trx_sc_single trx_sc_products",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "skus",
				"heading" => __("SKUs", "themerex"),
				"description" => __("Comma separated SKU codes of products", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "ids",
				"heading" => __("IDs", "themerex"),
				"description" => __("Comma separated ID of products", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Products extends THEMEREX_VC_ShortCodeSingle {}




	// WooCommerce - Product Attribute
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "product_attribute",
		"name" => __("Products by Attribute", "themerex"),
		"description" => __("WooCommerce shortcode: show products with specified attribute", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_product_attribute',
		"class" => "trx_sc_single trx_sc_product_attribute",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "per_page",
				"heading" => __("Number", "themerex"),
				"description" => __("How many products showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			),
			array(
				"param_name" => "attribute",
				"heading" => __("Attribute", "themerex"),
				"description" => __("Attribute name", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			),
			array(
				"param_name" => "filter",
				"heading" => __("Filter", "themerex"),
				"description" => __("Attribute value", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Product_Attribute extends THEMEREX_VC_ShortCodeSingle {}



	// WooCommerce - Products Categories
	//-------------------------------------------------------------------------------------
	
	vc_map( array(
		"base" => "product_categories",
		"name" => __("Product Categories", "themerex"),
		"description" => __("WooCommerce shortcode: show categories with products", "themerex"),
		"category" => __('WooCommerce', 'js_composer'),
		'icon' => 'icon_trx_product_categories',
		"class" => "trx_sc_single trx_sc_product_categories",
		"content_element" => true,
		"is_container" => false,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"param_name" => "number",
				"heading" => __("Number", "themerex"),
				"description" => __("How many categories showed", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "columns",
				"heading" => __("Columns", "themerex"),
				"description" => __("How many columns per row use for categories output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "4",
				"type" => "textfield"
			),
			array(
				"param_name" => "orderby",
				"heading" => __("Order by", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "order",
				"heading" => __("Order", "themerex"),
				"description" => __("Sorting order for products output", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => array_flip($THEMEREX_shortcodes_ordering),
				"type" => "dropdown"
			),
			array(
				"param_name" => "hide_empty",
				"heading" => __("Hide empty", "themerex"),
				"description" => __("Hide empty categories", "themerex"),
				"class" => "",
				"value" => array("Hide empty" => "1" ),
				"type" => "checkbox"
			),
			array(
				"param_name" => "parent",
				"heading" => __("Parent", "themerex"),
				"description" => __("Parent category slug", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "date",
				"type" => "textfield"
			),
			array(
				"param_name" => "ids",
				"heading" => __("IDs", "themerex"),
				"description" => __("Comma separated ID of products", "themerex"),
				"admin_label" => true,
				"class" => "",
				"value" => "",
				"type" => "textfield"
			)
		)
	) );
	
	class WPBakeryShortCode_Trx_Products_Categories extends THEMEREX_VC_ShortCodeSingle {}

}



// Load scripts and styles for VC support
add_action( 'admin_enqueue_scripts', 'shortcodes_vc_scripts' );
if ( !function_exists( 'shortcodes_vc_scripts' ) ) {
	function shortcodes_vc_scripts() {
		// Include CSS 
		wp_enqueue_style ( 'shortcodes_vc-style', get_template_directory_uri() . '/includes/shortcodes/shortcodes_vc.css', array(), null );
		// Include JS
		wp_enqueue_script( 'shortcodes_vc', get_template_directory_uri() . '/includes/shortcodes/shortcodes_vc.js', array(), null, true );
	}
}
?>