<?php
// Current elemnt id
$THEMEREX_shortcodes_id = array(
	"id" => "id",
	"title" => __("Element ID", "themerex"),
	"desc" => __("ID for current element", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "text"
);

// Width and height params
function THEMEREX_shortcodes_width($w="") {
	return array(
		"id" => "width",
		"title" => __("Width", "themerex"),
		"divider" => false,
		"value" => $w,
		"type" => "text"
	);
}
function THEMEREX_shortcodes_height($h='') {
	return array(
		"id" => "height",
		"title" => __("Height", "themerex"),
		"desc" => __("Width (in pixels or percent) and height (only in pixels) of element", "themerex"),
		"value" => $h,
		"type" => "text"
	);
}

// Margins params
$THEMEREX_shortcodes_margin_top = array(
	"id" => "top",
	"title" => __("Top margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);
$THEMEREX_shortcodes_margin_bottom = array(
	"id" => "bottom",
	"title" => __("Bottom margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);
$THEMEREX_shortcodes_margin_left = array(
	"id" => "left",
	"title" => __("Left margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);
$THEMEREX_shortcodes_margin_right = array(
	"id" => "right",
	"title" => __("Right margin", "themerex"),
	"desc" => __("Margins around list (in pixels).", "themerex"),
	"value" => "",
	"type" => "spinner"
);

// List's styles
$THEMEREX_shortcodes_list_styles = array(
	'ul' => __("Unordered", 'themerex'),
	'ol' => __("Ordered", 'themerex'),
	'ol_filled' => __("Ordered Bullets", 'themerex'),
	'iconed' => __('Iconed', 'themerex')
);

// Switcher choises
$THEMEREX_shortcodes_yes_no 	= getYesNoList();
$THEMEREX_shortcodes_on_off 	= getOnOffList();
$THEMEREX_shortcodes_dir 		= getDirectionList();
$THEMEREX_shortcodes_align 		= getAlignmentList();
$THEMEREX_shortcodes_float 		= getFloatList();
$THEMEREX_shortcodes_show_hide 	= getShowHideList();
$THEMEREX_shortcodes_sorting 	= getSortingList();
$THEMEREX_shortcodes_ordering 	= getOrderingList();
$THEMEREX_shortcodes_sliders	= getSlidersList();
$THEMEREX_shortcodes_users		= getUsersList();
$THEMEREX_shortcodes_categories	= getCategoriesList();
$THEMEREX_shortcodes_columns	= getColumnsList();
$THEMEREX_shortcodes_images		= themerex_array_merge(array('none'=>"none"), getListFiles("/images/icons", "png"));
$THEMEREX_shortcodes_icons 		= array_merge(array("none"), getIconsList());
$THEMEREX_shortcodes_sidebars 	= getSidebarsList();



// Shortcodes list
//------------------------------------------------------------------
$THEMEREX_shortcodes = array(

	// Accordion
	array(
		"title" => __("Accordion", "themerex"),
		"desc" => __("Accordion items", "themerex"),
		"id" => "accordion",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "initial",
				"title" => __("Initially opened item", "themerex"),
				"desc" => __("Number of initially opened item", "themerex"),
				"value" => 1,
				"min" => 0,
				"type" => "spinner"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("Accordion item", "themerex"),
			"id" => "accordion_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "title",
					"title" => __("Accordion item title", "themerex"),
					"desc" => __("Title for current accordion item", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "icon",
					"title" => __('Title font icon',  'themerex'),
					"desc" => __("Select font icon for the title from Fontello icons set.",  'themerex'),
					"divider" => false,
					"value" => "",
					"type" => "icons",
					"options" => $THEMEREX_shortcodes_icons
				),
				array(
					"id" => "_content_",
					"title" => __("Accordion item content", "themerex"),
					"desc" => __("Current accordion item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),


	// Audio
	array(
		"title" => __("Audio", "themerex"),
		"desc" => __("Insert audio player", "themerex"),
		"id" => "audio",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "url",
				"title" => __("URL for audio file", "themerex"),
				"desc" => __("URL for audio file", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media",
				"before" => array(
					'title' => __('Choose audio', 'themerex'),
					'action' => 'media_upload',
					'type' => 'audio',
					'multiple' => false,
					'linked_field' => '',
					'captions' => array( 	
						'choose' => __('Choose audio file', 'themerex'),
						'update' => __('Select audio file', 'themerex')
					)
				),
				"after" => array(
					'icon' => 'icon-cancel',
					'action' => 'media_reset'
				)
			),
			array(
				"id" => "title",
				"title" => __("Audio title", "themerex"),
				"desc" => __("Title for current audio file", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "author",
				"title" => __("Audio author", "themerex"),
				"desc" => __("Author of current audio file", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "controls",
				"title" => __("Show controls", "themerex"),
				"desc" => __("Show controls in audio player", "themerex"),
				"divider" => false,
				"size" => "medium",
				"value" => "show",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_show_hide
			),
			array(
				"id" => "autoplay",
				"title" => __("Autoplay audio", "themerex"),
				"desc" => __("Autoplay audio on page load", "themerex"),
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			THEMEREX_shortcodes_width("100%"),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),




	// Banner
	array(
		"title" => __("Banner", "themerex"),
		"desc" => __("Banner image with link", "themerex"),
		"id" => "banner",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "src",
				"title" => __("URL (source) for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "align",
				"title" => __("Banner alignment", "themerex"),
				"desc" => __("Align banner to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			array(
				"id" => "link",
				"title" => __("Link URL", "themerex"),
				"desc" => __("URL for link on banner click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "rel",
				"title" => __("Rel attribute", "themerex"),
				"desc" => __("Rel attribute for banner's link (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "target",
				"title" => __("Link target", "themerex"),
				"desc" => __("Target for link on banner click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Banner title", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Text", "themerex"),
				"desc" => __("Banner text", "themerex"),
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),




	// Block
	array(
		"title" => __("Block container", "themerex"),
		"desc" => __("Container for any block with desired class and style ([section] analog - to nesting enable)", "themerex"),
		"id" => "block",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "class",
				"title" => __("CSS class", "themerex"),
				"desc" => __("Attribute class for container (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("CSS style", "themerex"),
				"desc" => __("Any additional CSS rules (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "align",
				"title" => __("Align", "themerex"),
				"desc" => __("Select block alignment", "themerex"),
				"divider" => false,
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					"none" => __("None", 'themerex'),
					"left" => __("Left", 'themerex'),
					"right" => __("Right", 'themerex'),
					"center" => __("Center", 'themerex')
				)
			),
			array(
				"id" => "text_align",
				"title" => __("Text align inside section", "themerex"),
				"desc" => __("Select text alignment in current section", "themerex"),
				"divider" => false,
				"value" => "left",
				"type" => "checklist",
				"options" => array(
					'left' => __('Left', 'themerex'),
					'center' => __('Center', 'themerex'),
					'right' => __('Right', 'themerex')
				)
			),
			array(
				"id" => "_content_",
				"title" => __("Container content", "themerex"),
				"desc" => __("Content for section container", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),




	// Blogger
	array(
		"title" => __("Blogger", "themerex"),
		"desc" => __("Insert posts (pages) in many styles from desired categories or directly from ids", "themerex"),
		"id" => "blogger",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "cat",
				"title" => __("Category list", "themerex"),
				"desc" => __("Select the desired categories. If not selected - show posts from any category or from IDs list", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"style" => "list",
				"multiple" => true,
				"options" => $THEMEREX_shortcodes_categories
			),
			array(
				"id" => "title",
				"title" => __("Blogger section title", "themerex"),
				"desc" => __("Enter here title for the current blogger section.", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "count",
				"title" => __("Total posts to show", "themerex"),
				"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
				"divider" => false,
				"value" => 3,
				"min" => 1,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "visible",
				"title" => __("Number of visible posts", "themerex"),
				"desc" => __("How many posts will be visible at once? If empty or 0 - all posts are visible", "themerex"),
				"divider" => false,
				"value" => 3,
				"min" => 1,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "offset",
				"title" => __("Offset before select posts", "themerex"),
				"desc" => __("Skip posts before select next part.", "themerex"),
				"divider" => false,
				"value" => 0,
				"min" => 0,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "orderby",
				"title" => __("Post order by", "themerex"),
				"desc" => __("Select desired posts sorting method", "themerex"),
				"divider" => false,
				"value" => "date",
				"type" => "select",
				"options" => $THEMEREX_shortcodes_sorting
			),
			array(
				"id" => "order",
				"title" => __("Post order", "themerex"),
				"desc" => __("Select desired posts order", "themerex"),
				"divider" => false,
				"value" => "desc",
				"type" => "switch",
				"size" => "big",
				"options" => $THEMEREX_shortcodes_ordering
			),
			array(
				"id" => "ids",
				"title" => __("Post IDs list", "themerex"),
				"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("Posts output style", "themerex"),
				"desc" => __("Select desired style for posts output", "themerex"),
				"divider" => false,
				"value" => "regular",
				"type" => "select",
				"options" => array(
					'default' => __('Regular', 'themerex'),
					'date' => __('Date', 'themerex'),
					'image_large' => __('Large featured image', 'themerex'),
					'image_medium' => __('Medium featured image', 'themerex'),
					'image_small' => __('Small featured image', 'themerex'),
					'accordion' => __('Accordion style 1', 'themerex'),
					'list' => __('List', 'themerex')
				)
			),
			array(
				"id" => "rating",
				"title" => __("Show rating", "themerex"),
				"desc" => __("Show rating stars under post's header", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "border",
				"title" => __("Show border", "themerex"),
				"desc" => __("Show border under the blogger items.", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "descr",
				"title" => __("Description length", "themerex"),
				"desc" => __("How many characters are displayed from post excerpt? If 0 - don't show description", "themerex"),
				"divider" => false,
				"value" => 0,
				"min" => 0,
				"max" => 1000,
				"increment" => 10,
				"type" => "spinner"
			),
			array(
				"id" => "link_title",
				"title" => __("More link text", "themerex"),
				"desc" => __("Read more link text. If empty - show 'More', else - used as link text", "themerex"),
				"value" => "",
				"divider" => false,
				"type" => "text"
			),
			array(
				"id" => "link_url",
				"title" => __("More link URL", "themerex"),
				"desc" => __("Read more link URL. If empty - will not be displayed.", "themerex"),
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),





	// Button
	array(
		"title" => __("Button", "themerex"),
		"desc" => __("Button with link", "themerex"),
		"id" => "button",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Caption", "themerex"),
				"desc" => __("Button caption", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "type",
				"title" => __("Button's shape", "themerex"),
				"desc" => __("Select button's shape", "themerex"),
				"divider" => false,
				"value" => "square",
				"type" => "switch",
				"size" => "medium",
				"options" => array(
					'square' => __('Square', 'themerex'),
					'rounded' => __('Rounded', 'themerex')
				)
			), 
			array(
				"id" => "style",
				"title" => __("Button's style", "themerex"),
				"desc" => __("Select button's style", "themerex"),
				"divider" => false,
				"value" => "default",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'default' => __('Default', 'themerex'),
					'border' => __('Border', 'themerex')
				)
			), 
			array(
				"id" => "size",
				"title" => __("Button's size", "themerex"),
				"desc" => __("Select button's size", "themerex"),
				"divider" => false,
				"value" => "medium",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'mini' => __('Small', 'themerex'),
					'medium' => __('Medium', 'themerex'),
					'big' => __('Large', 'themerex'),
					'huge' => __('Huge', 'themerex')
				)
			), 
			array(
				"id" => "fullsize",
				"title" => __("Fullsize mode", "themerex"),
				"desc" => __("Set button's width to 100%", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "color",
				"title" => __("Button's color", "themerex"),
				"desc" => __("Any color for button background", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "align",
				"title" => __("Button alignment", "themerex"),
				"desc" => __("Align button to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			array(
				"id" => "link",
				"title" => __("Link URL", "themerex"),
				"desc" => __("URL for link on button click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "target",
				"title" => __("Link target", "themerex"),
				"desc" => __("Target for link on button click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "rel",
				"title" => __("Rel attribute", "themerex"),
				"desc" => __("Rel attribute for button's link (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),



	// Chat
	array(
		"title" => __("Chat", "themerex"),
		"desc" => __("Chat items", "themerex"),
		"id" => "chat",
		"decorate" => true,
		"container" => false,
		"params" => array(
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),


	// Columns
	array(
		"title" => __("Columns", "themerex"),
		"desc" => __("Insert up to 5 columns in your page (post)", "themerex"),
		"id" => "columns",
		"decorate" => true,
		"container" => false,
		"params" => array(
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Column", "themerex"),
			"desc" => __("Column item", "themerex"),
			"id" => "column_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "span",
					"title" => __("Merge columns", "themerex"),
					"desc" => __("Count merged columns from current", "themerex"),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "_content_",
					"title" => __("Column item content", "themerex"),
					"desc" => __("Current column item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




	// Contact form
	array(
		"title" => __("Contact form", "themerex"),
		"desc" => __("Insert contact form", "themerex"),
		"id" => "contact_form",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Contact form title", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "description",
				"title" => __("Description", "themerex"),
				"desc" => __("Short description for contact form", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),





	// Countdown
	array(
		"title" => __("Countdown", "themerex"),
		"desc" => __("Insert countdown object", "themerex"),
		"id" => "countdown",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "date",
				"title" => __("Date", "themerex"),
				"desc" => __("Upcoming date (format: yyyy-mm-dd)", "themerex"),
				"value" => "",
				"format" => "yy-mm-dd",
				"type" => "date"
			),
			array(
				"id" => "time",
				"title" => __("Time", "themerex"),
				"desc" => __("Upcoming time (format: HH:mm:ss)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Style of countdown block", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"options" => array(
					'1' => __('Style 1', 'themerex'),
					'2' => __('Style 2', 'themerex'),
				)
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align counter to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),

	
	
	// Divider
	array(
		"title" => __("Divider", "themerex"),
		"desc" => __("Create gradient horizontal divider", "themerex"),
		"id" => "divider",
		"decorate" => false,
		"container" => false,
		"params" => array(					
			array(
				"id" => "top",
				"title" => __("Top indent", "themerex"),
				"divider" => false,
				"value" => 10,
				"min" => 0,
				"max" => 100,
				"type" => "spinner"
			),	
			array(
				"id" => "bottom",
				"title" => __("Bottom indent", "themerex"),
				"divider" => false,
				"value" => 10,
				"min" => 0,
				"max" => 100,
				"type" => "spinner"
			),	
			array(
				"id" => "type",
				"title" => __("Divider style", "themerex"),
				"desc" => __("Select style of separator", "themerex"),
				"divider" => false,
				"value" => "std",
				"type" => "select",
				"options" => array(
					'std' => __('Standard', 'themerex'),
					'solid' => __('Solid', 'themerex'),
					'dashed' => __('Dashed', 'themerex'),
					'dotted' => __('Dotted', 'themerex')
				)
			),
			array(
				"id" => "color",
				"title" => __("Divider color", "themerex"),
				"desc" => __("Select color of divider", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			$THEMEREX_shortcodes_id
		)
	),




	// Dropcaps
	array(
		"title" => __("Dropcaps", "themerex"),
		"desc" => __("Make first letter as dropcaps", "themerex"),
		"id" => "dropcaps",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Dropcaps style", "themerex"),
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					1 => __('Style 1', 'themerex'),
					2 => __('Style 2', 'themerex'),
					3 => __('Style 3', 'themerex'),
					4 => __('Style 4', 'themerex'),
					5 => __('Style 5', 'themerex'),
					6 => __('Style 6', 'themerex')
				)
			),
			array(
				"id" => "_content_",
				"title" => __("Paragraph content", "themerex"),
				"desc" => __("Paragraph with dropcaps content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_id
		)
	),


	// Emailer
	array(
		"title" => __("E-mail collector", "themerex"),
		"desc" => __("Collect the e-mail address into specified group", "themerex"),
		"id" => "emailer",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "group",
				"title" => __("Group", "themerex"),
				"desc" => __("The name of group to collect e-mail address", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "open",
				"title" => __("Open", "themerex"),
				"desc" => __("Initially open the input field on show object", "themerex"),
				"divider" => true,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align object to left, center or right", "themerex"),
				"divider" => true,
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),





	// Gap
	array(
		"title" => __("Gap", "themerex"),
		"desc" => __("Insert gap (fullwidth area) in the post content. Attention! Use the gap only in the posts (pages) without left or right sidebar", "themerex"),
		"id" => "trx_gap",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Gap content", "themerex"),
				"desc" => __("Gap inner content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			)
		)
	),


	// Google map
	array(
		"title" => __("Google map", "themerex"),
		"desc" => __("Insert Google map with desired address or coordinates", "themerex"),
		"id" => "googlemap",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "address",
				"title" => __("Address", "themerex"),
				"desc" => __("Address to show in map center", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "latlng",
				"title" => __("Latitude and Longtitude", "themerex"),
				"desc" => __("Comma separated map center coorditanes (instead Address)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "zoom",
				"title" => __("Zoom", "themerex"),
				"desc" => __("Map zoom factor", "themerex"),
				"divider" => false,
				"value" => 16,
				"min" => 1,
				"max" => 20,
				"type" => "spinner"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Map style", "themerex"),
				"value" => "default",
				"type" => "checklist",
				"options" => array(
					'default' => __('Default', 'themerex'),
					'simple' => __('Simple', 'themerex'),
					'muted_blue' => __('Muted Blue', 'themerex'),
					'greyscale' => __('Greyscale', 'themerex'),
					'greyscale2' => __('Greyscale 2', 'themerex'),
					'style1' => __('Style 1', 'themerex'),
					'style2' => __('Style 2', 'themerex'),
					'style3' => __('Style 3', 'themerex')
				)
			),
			THEMEREX_shortcodes_width('100%'),
			THEMEREX_shortcodes_height(240),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),



	// Hide any block
	array(
		"title" => __("Hide any block", "themerex"),
		"desc" => __("Hide any block with desired CSS-selector", "themerex"),
		"id" => "hide",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "selector",
				"title" => __("Selector", "themerex"),
				"desc" => __("Any block's CSS-selector", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			)
		)
	),



	// Highlght text
	array(
		"title" => __("Highlight text", "themerex"),
		"desc" => __("Highlight text with selected color, background color and other styles", "themerex"),
		"id" => "highlight",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "type",
				"title" => __("Type", "themerex"),
				"desc" => __("Highlight type", "themerex"),
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					0 => __('Custom', 'themerex'),
					1 => __('Type 1', 'themerex'),
					2 => __('Type 2', 'themerex')
				)
			),
			array(
				"id" => "color",
				"title" => __("Color", "themerex"),
				"desc" => __("Color for highlighted text", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "backcolor",
				"title" => __("Background color", "themerex"),
				"desc" => __("Background color for highlighted text", "themerex"),
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "style",
				"title" => __("CSS-styles", "themerex"),
				"desc" => __("Any additional CSS rules", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Highlighting content", "themerex"),
				"desc" => __("Content for highlight", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_id
		)
	),




	// Icon
	array(
		"title" => __("Icon", "themerex"),
		"desc" => __("Insert icon", "themerex"),
		"id" => "icon",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "icon",
				"title" => __('Icon',  'themerex'),
				"desc" => __("Select font icon from the Fontello icons set",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "color",
				"title" => __("Icon's color", "themerex"),
				"desc" => __("Icon's color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "background",
				"title" => __("Background style", "themerex"),
				"desc" => __("Style of the icon background ", "themerex"),
				"divider" => false,
				"value" => "none",
				"type" => "radio",
				"options" => array(
					'none' => __('None', 'themerex'),
					'round' => __('Round', 'themerex'),
					'square' => __('Square', 'themerex')
				)
			),
			array(
				"id" => "bg_color",
				"title" => __("Icon's background color", "themerex"),
				"desc" => __("Icon's background color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "size",
				"title" => __("Font size", "themerex"),
				"desc" => __("Icon font size", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "spinner",
				"min" => 8,
				"max" => 240
			),
			array(
				"id" => "weight",
				"title" => __("Font weight", "themerex"),
				"desc" => __("Icon font weight", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"size" => "medium",
				"options" => array(
					'100' => __('Thin (100)', 'themerex'),
					'300' => __('Light (300)', 'themerex'),
					'400' => __('Normal (400)', 'themerex'),
					'700' => __('Bold (700)', 'themerex')
				)
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Icon text alignment", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),




	// Image
	array(
		"title" => __("Image", "themerex"),
		"desc" => __("Insert image into your post (page)", "themerex"),
		"id" => "image",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "url",
				"title" => __("URL for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Image title (if need)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "align",
				"title" => __("Float image", "themerex"),
				"desc" => __("Float image to left or right side", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_float
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),



	// Infobox
	array(
		"title" => __("Infobox", "themerex"),
		"desc" => __("Insert infobox into your post (page)", "themerex"),
		"id" => "infobox",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Infobox style", "themerex"),
				"divider" => false,
				"value" => "regular",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'regular' => __('Regular', 'themerex'),
					'info' => __('Info', 'themerex'),
					'success' => __('Success', 'themerex'),
					'error' => __('Error', 'themerex')
				)
			),
			array(
				"id" => "closeable",
				"title" => __("Closeable box", "themerex"),
				"desc" => __("Create closeable box (with close button)", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "_content_",
				"title" => __("Infobox content", "themerex"),
				"desc" => __("Content for infobox", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),



	// List
	array(
		"title" => __("List", "themerex"),
		"desc" => __("List items with specific bullets", "themerex"),
		"id" => "list",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Bullet's style", "themerex"),
				"desc" => __("Bullet's style for each list item", "themerex"),
				"value" => "ul",
				"type" => "checklist",
				"options" => $THEMEREX_shortcodes_list_styles
			), 
			array(
				"id" => "icon",
				"title" => __('List icon',  'themerex'),
				"desc" => __("Select list icon from Fontello icons set (only for style='Iconed'",  'themerex'),
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("List item with specific bullet", "themerex"),
			"id" => "list_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "_content_",
					"title" => __("List item content", "themerex"),
					"desc" => __("Current list item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				array(
					"id" => "icon",
					"title" => __('List icon',  'themerex'),
					"desc" => __("Select list icon from Fontello icons set (only for style='Iconed'",  'themerex'),
					"value" => "",
					"type" => "icons",
					"options" => $THEMEREX_shortcodes_icons
				),
				array(
					"id" => "title",
					"title" => __("List item title", "themerex"),
					"desc" => __("Current list item title (show it as tooltip)", "themerex"),
					"value" => "",
					"type" => "text"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),



	// Price
	array(
		"title" => __("Price", "themerex"),
		"desc" => __("Insert price with decoration", "themerex"),
		"id" => "trx_price",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "money",
				"title" => __("Money", "themerex"),
				"desc" => __("Money value (dot or comma separated)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "currency",
				"title" => __("Currency", "themerex"),
				"desc" => __("Currency character", "themerex"),
				"divider" => false,
				"value" => "$",
				"type" => "text"
			),
			array(
				"id" => "period",
				"title" => __("Period", "themerex"),
				"desc" => __("Period text (if need). For example: monthly, daily, etc.", "themerex"),
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),




	// Price_table
	array(
		"title" => __("Price table container", "themerex"),
		"desc" => __("Price table container. After insert it, move cursor inside and select shortcode Price Item", "themerex"),
		"id" => "trx_price_table",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Alignment text in the table", "themerex"),
				"value" => "center",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("Price item column", "themerex"),
			"id" => "trx_price_item",
			"decorate" => true,
			"container" => true,
			"params" => array(
				array(
					"id" => "animation",
					"title" => __("Animation", "themerex"),
					"desc" => __("Animate column on mouse hover", "themerex"),
					"value" => "yes",
					"type" => "switch",
					"options" => $THEMEREX_shortcodes_yes_no
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




	// Price_item
	array(
		"title" => __("Price table item", "themerex"),
		"desc" => __("Price table column", "themerex"),
		"id" => "trx_price_item",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "animation",
				"title" => __("Animation", "themerex"),
				"desc" => __("Animate column on mouse hover", "themerex"),
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Data", "themerex"),
			"desc" => __("Price item data - title, price, footer, etc.", "themerex"),
			"id" => "trx_price_data",
			"decorate" => false,
			"container" => true,
			"params" => array(
				array(
					"id" => "_content_",
					"title" => __("Content", "themerex"),
					"desc" => __("Current cell content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				array(
					"id" => "type",
					"title" => __("Cell type", "themerex"),
					"desc" => __("Select type of the price table cell", "themerex"),
					"value" => "regular",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => array(
						'none' => __('Regular', 'themerex'),
						'title' => __('Title', 'themerex'),
						'image' => __('Image', 'themerex'),
						'price' => __('Price', 'themerex'),
						'titled' => __('Titled Price', 'themerex'),
						'united' => __('United', 'themerex'),
						'footer' => __('Footer', 'themerex')
					)
				), 
				array(
					"id" => "money",
					"title" => __("Money", "themerex"),
					"desc" => __("Money value (dot or comma separated) - only for type=price", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "currency",
					"title" => __("Currency", "themerex"),
					"desc" => __("Currency character - only for type=price", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "period",
					"title" => __("Period", "themerex"),
					"desc" => __("Period text (if need). For example: monthly, daily, etc. - only for type=price", "themerex"),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "link",
					"title" => __("Link url", "themerex"),
					"desc" => __("The field is available for cells of the 'picture' type. When clicking the picture, you will be redirected by the link specified.", "themerex"),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "image",
					"title" => __("URL (source) for image file", "themerex"),
					"desc" => __("Select or upload image or write URL from other site", "themerex"),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),



	// Price_data
	array(
		"title" => __("Price table data", "themerex"),
		"desc" => __("Price item data - title, price, footer, etc.", "themerex"),
		"id" => "trx_price_data",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Content", "themerex"),
				"desc" => __("Current cell content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array(
				"id" => "type",
				"title" => __("Cell type", "themerex"),
				"desc" => __("Select type of the price table cell", "themerex"),
				"value" => "regular",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'none' => __('Regular', 'themerex'),
					'title' => __('Title', 'themerex'),
					'image' => __('Image', 'themerex'),
					'price' => __('Price', 'themerex'),
					'titled' => __('Titled Price', 'themerex'),
					'united' => __('United', 'themerex'),
					'footer' => __('Footer', 'themerex')
				)
			), 
			array(
				"id" => "money",
				"title" => __("Money", "themerex"),
				"desc" => __("Money value (dot or comma separated) - only for type=price", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "currency",
				"title" => __("Currency", "themerex"),
				"desc" => __("Currency character - only for type=price", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "link",
				"title" => __("Link url", "themerex"),
				"desc" => __("The field is available for cells of the 'picture' type. When clicking the picture, you will be redirected by the link specified.", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "period",
				"title" => __("Period", "themerex"),
				"desc" => __("Period text (if need). For example: monthly, daily, etc. - only for type=price", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "image",
				"title" => __("URL (source) for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			$THEMEREX_shortcodes_id
		)
	),



	// Quote
	array(
		"title" => __("Quote", "themerex"),
		"desc" => __("Quote text", "themerex"),
		"id" => "quote",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "cite",
				"title" => __("Quote cite", "themerex"),
				"desc" => __("URL for quote cite", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "title",
				"title" => __("Title (author)", "themerex"),
				"desc" => __("Quote title (author name)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Quote content", "themerex"),
				"desc" => __("Quote content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_id
		)
	),
	
	// Review Panel
	array(
		"title" => __("Review Panel", "themerex"),
		"desc" => __("Append review panel", "themerex"),
		"id" => "review_panel",
		"decorate" => true,
		"container" => false,
		"params" => array(
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id,
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align counter to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			),
			array(
				"id" => "post_id",
				"title" => __("Post id", "themerex"),
				"desc" => __("Enter review post id", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "max",
				"title" => __("Max Points", "themerex"),
				"desc" => __("Max review points value", "themerex"),
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					5 => '5',
					10 => '10',
					100 => '100'
				)
			)
		),		
		"children" => array(
			"title" => __("Review Item", "themerex"),
			"desc" => __("Item of review panel", "themerex"),
			"id" => "review_item",
			"container" => false,
			"params" => array(
				array(
					"id" => "label",
					"title" => __("Label", "themerex"),
					"desc" => __("Review Item Label", "themerex"),
					"points" => "",
					"type" => "text"
				),
				array(
					"id" => "points",
					"title" => __("Review Criteria Points", "themerex"),
					"desc" => __("Criteria points of current review item", "themerex"),
					"value" => "",
					"type" => "text"
				)
			)
		)
	),




	// Section
	array(
		"title" => __("Section container", "themerex"),
		"desc" => __("Container for any block with desired class and style", "themerex"),
		"id" => "section",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "class",
				"title" => __("CSS class", "themerex"),
				"desc" => __("Attribute class for container (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "content_wrap",
				"title" => __("Wrap content inside section", "themerex"),
				"desc" => __("Select yes if you want to wrap content inside section", "themerex"),
				"divider" => false,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "style",
				"title" => __("CSS style", "themerex"),
				"desc" => __("Any additional CSS rules (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "align",
				"title" => __("Align", "themerex"),
				"desc" => __("Select block alignment", "themerex"),
				"divider" => false,
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					"none" => __("None", 'themerex'),
					"left" => __("Left", 'themerex'),
					"right" => __("Right", 'themerex'),
					"center" => __("Center", 'themerex')
				)
			),
			array(
				"id" => "text_align",
				"title" => __("Text align inside section", "themerex"),
				"desc" => __("Select text alignment in current section", "themerex"),
				"divider" => false,
				"value" => "left",
				"type" => "checklist",
				"options" => array(
					'left' => __('Left', 'themerex'),
					'center' => __('Center', 'themerex'),
					'right' => __('Right', 'themerex')
				)
			),
			array(
				"id" => "_content_",
				"title" => __("Container content", "themerex"),
				"desc" => __("Content for section container", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array(
				"id" => "background_color",
				"title" => __("Background Color", "themerex"),
				"desc" => __("Select background color for section", "themerex"),
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "background_image",
				"title" => __('Background Image', "themerex"),
				"desc" => __("Select or upload background image.", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "background_repeat",
				"title" => __('Background Image', "themerex"),
				"desc" => __("Repeat or not repeat background image.", "themerex"),
				"value" => "repeat",
				"type" => "checklist",
				"options" => array(
					'repeat' => __("Repeat", 'themerex'),
					'no-repeat' => __("No repeat", 'themerex')
				)
			),
			array(
				"id" => "background_pos_x",
				"title" => __('Background Position X', "themerex"),
				"desc" => __("Select horizontal background position.", "themerex"),
				"value" => "left",
				"type" => "checklist",
				"options" => array(
					'left' => __("Left", 'themerex'),
					'center' => __("Center", 'themerex'),
					'right' => __("Right", "themerex")
				)
			),
			array(
				"id" => "background_pos_y",
				"title" => __('Background Position Y', "themerex"),
				"desc" => __("Select vertical background position.", "themerex"),
				"value" => "top",
				"type" => "checklist",
				"options" => array(
					'top' => __("Top", 'themerex'),
					'center' => __("Center", 'themerex'),
					'bottom' => __("Bottom", "themerex")
				)
			),
			array(
				"id" => "parallax",
				"title" => __("Parallax scrolling", "themerex"),
				"desc" => __("Enable parallax scrolling for this section.", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),



	// Sidebar
	array(
		"title" => __("Sidebar", "themerex"),
		"desc" => __("Insert Sidebar into the page/post content. ", "themerex"),
		"id" => "themerex_sidebar",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "name",
				"title" => __("Select sidebar", "themerex"),
				"options" => $THEMEREX_shortcodes_sidebars,
				"type" => "select",
				"divider" => true,
				"value" => ""
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),




	// Skills
	array(
		"title" => __("Skills", "themerex"),
		"desc" => __("Insert skills diagramm in your page (post)", "themerex"),
		"id" => "skills",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "maximum",
				"title" => __("Max value", "themerex"),
				"desc" => __("Max value for skills items", "themerex"),
				"divider" => false,
				"value" => 100,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "type",
				"title" => __("Skills type", "themerex"),
				"desc" => __("Select type of skills block", "themerex"),
				"divider" => false,
				"value" => "bar",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'bar' => __('Bar', 'themerex'),
					'counter' => __('Counter', 'themerex'),
					'circles' => __('Circles', 'themerex')
				)
			), 
			array(
				"id" => "dir",
				"title" => __("Direction", "themerex"),
				"desc" => __("Select direction of skills block", "themerex"),
				"divider" => false,
				"value" => "horizontal",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_dir
			), 
			array(
				"id" => "layout",
				"title" => __("Skills layout", "themerex"),
				"desc" => __("Select layout of skills block", "themerex"),
				"divider" => false,
				"value" => "rows",
				"type" => "checklist",
				"dir" => "columns",
				"options" => array(
					'rows' => __('Rows', 'themerex'),
					'columns' => __('Columns', 'themerex')
				)
			),
			array(
				"id" => "align",
				"title" => __("Align skills block", "themerex"),
				"desc" => __("Align skills block to left or right side", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_float
			), 
			array(
				"id" => "color",
				"title" => __("Skills items color", "themerex"),
				"desc" => __("Color for all skills items", "themerex"),
				"value" => "",
				"type" => "color"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Skill", "themerex"),
			"desc" => __("Skills item", "themerex"),
			"id" => "skills_item",
			"container" => false,
			"params" => array(
				array(
					"id" => "title",
					"title" => __("Skills item title", "themerex"),
					"desc" => __("Current skills item title", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "style",
					"title" => __("Skills item style", "themerex"),
					"desc" => __("Select skills item style", "themerex"),
					"divider" => false,
					"value" => "style_1",
					"type" => "checklist",
					"options" => array(
						'1' => __('Style 1', 'themerex'),
						'2' => __('Style 2', 'themerex')
					)
				),
				array(
					"id" => "level",
					"title" => __("Sklls item level", "themerex"),
					"desc" => __("Current skills level", "themerex"),
					"divider" => false,
					"value" => 50,
					"min" => 0,
					"increment" => 1,
					"type" => "spinner"
				),
				array(
					"id" => "color",
					"title" => __("Skills item color", "themerex"),
					"desc" => __("Current skills item color", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "color"
				),
				THEMEREX_shortcodes_width(),
				THEMEREX_shortcodes_height(),
				$THEMEREX_shortcodes_id
			)
		)
	),




	// Slider
	array(
		"title" => __("Slider", "themerex"),
		"desc" => __("Insert slider into your post (page)", "themerex"),
		"id" => "slider",
		"decorate" => true,
		"container" => false,
		"params" => array_merge(array(
			array(
				"id" => "engine",
				"title" => __("Slider engine", "themerex"),
				"desc" => __("Select engine for slider. Attention! 'Swiper' are built-in engine, all other engines appears only if corresponding plugings are installed", "themerex"),
				"value" => "swiper",
				"type" => "checklist",
				"options" => $THEMEREX_shortcodes_sliders
			)),
			revslider_exists() || royalslider_exists() ? array(
			array(
				"id" => "alias",
				"title" => __("Revolution slider alias or Royal Slider ID", "themerex"),
				"desc" => __("Alias for Revolution slider or Royal slider ID", "themerex"),
				"value" => "",
				"type" => "text"
			)) : array(), array(
			array(
				"id" => "cat",
				"title" => __("Category list", "themerex"),
				"desc" => __("Comma separated list of category slugs. If empty - select posts from any category or from IDs list", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"style" => "list",
				"multiple" => true,
				"options" => $THEMEREX_shortcodes_categories
			),
			array(
				"id" => "count",
				"title" => __("Number of posts", "themerex"),
				"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
				"divider" => false,
				"value" => 3,
				"min" => 1,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "offset",
				"title" => __("Offset before select posts", "themerex"),
				"desc" => __("Skip posts before select next part.", "themerex"),
				"divider" => false,
				"value" => 0,
				"min" => 0,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "date_before",
				"title" => __("Post published before", "themerex"),
				"desc" => __("Date to retrieve posts before.)", "themerex"),
				"value" => "",
				"format" => "yy-mm-dd",
				"type" => "date"
			),
			array(
				"id" => "date_after",
				"title" => __("Post published after", "themerex"),
				"desc" => __("Date to retrieve posts after.)", "themerex"),
				"value" => "",
				"format" => "yy-mm-dd",
				"type" => "date"
			),
			array(
				"id" => "orderby",
				"title" => __("Post order by", "themerex"),
				"desc" => __("Select desired posts sorting method", "themerex"),
				"divider" => false,
				"value" => "date",
				"type" => "select",
				"options" => $THEMEREX_shortcodes_sorting
			),
			array(
				"id" => "order",
				"title" => __("Post order", "themerex"),
				"desc" => __("Select desired posts order", "themerex"),
				"divider" => false,
				"value" => "desc",
				"type" => "switch",
				"size" => "big",
				"options" => $THEMEREX_shortcodes_ordering
			),
			array(
				"id" => "ids",
				"title" => __("Post IDs list", "themerex"),
				"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "controls",
				"title" => __("Show slider controls", "themerex"),
				"desc" => __("Show arrows inside slider", "themerex"),
				"divider" => false,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "pagination",
				"title" => __("Show slider pagination", "themerex"),
				"desc" => __("Show bullets for slide switch", "themerex"),
				"divider" => false,
				"value" => "hide",
				"type" => "select",
				"options" => array(
					'false' => __('Hide', 'themerex'),
					'default' => __('Default', 'themerex'),
					'thumbs' => __('Thumbnails', 'themerex'),
					'icons' => __('Post-format icons', 'themerex')
				)
			),
			array(
				"id" => "progressbar",
				"title" => __("Show slider progressbar", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => array('yes'=>__('Yes', 'themerex'), 'no'=>__('No', 'themerex'))
			),
			array(
				"id" => "info",
				"title" => __("Show slide info", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => array('yes'=>__('Yes', 'themerex'), 'no'=>__('No', 'themerex'))
			),
			array(
				"id" => "caption",
				"title" => __("Show slide caption", "themerex"),
				"desc" => __("Show slide title and info section.", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "align",
				"title" => __("Float slider", "themerex"),
				"desc" => __("Float slider to left or right side", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_float
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)),
		"children" => array(
			"title" => __("Slide", "themerex"),
			"desc" => __("Slider item", "themerex"),
			"id" => "slider_item",
			"container" => false,
			"params" => array(
				array(
					"id" => "src",
					"title" => __("URL (source) for image file", "themerex"),
					"desc" => __("Select or upload image or write URL from other site for the current slide", "themerex"),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




	// Table
	array(
		"title" => __("Table", "themerex"),
		"desc" => __("Insert table into post (page). ", "themerex"),
		"id" => "table",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Table content", "themerex"),
				"desc" => __("Content, created with any table-generator", "themerex"),
				"rows" => 8,
				"value" => "Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),





	// Tabs
	array(
		"title" => __("Tabs", "themerex"),
		"desc" => __("Insert tabs in your page (post)", "themerex"),
		"id" => "tabs",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "initial",
				"title" => __("Initially opened tab", "themerex"),
				"desc" => __("Number of initially opened tab", "themerex"),
				"value" => 1,
				"min" => 0,
				"type" => "spinner"
			),
			array(
				"id" => "style",
				"title" => __("Tab style", "themerex"),
				"desc" => __("Select tab style: vertical or horizontal.", "themerex"),
				"value" => "horizontal",
				"type" => "select",
				"options" => array('vertical' => __('Vertical', 'themerex'), 'horizontal' => __('Horizontal', 'themerex'))
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Tab", "themerex"),
			"desc" => __("Tab item", "themerex"),
			"id" => "tab",
			"container" => true,
			"params" => array(
				array(
					"id" => "_title_",
					"title" => __("Tab title", "themerex"),
					"desc" => __("Current tab title", "themerex"),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "_content_",
					"title" => __("Tab content", "themerex"),
					"desc" => __("Current tab content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				array(
					"id" => "icon",
					"title" => __('Tab title icon',  'themerex'),
					"desc" => __("Select font icon for the title from Fontello icons set.",  'themerex'),
					"divider" => false,
					"value" => "",
					"type" => "icons",
					"options" => $THEMEREX_shortcodes_icons
				),
				$THEMEREX_shortcodes_id
			)
		)
	),





	// Team
	array(
		"title" => __("Team", "themerex"),
		"desc" => __("Insert team in your page (post)", "themerex"),
		"id" => "trx_team",
		"decorate" => true,
		"container" => false,
		"params" => array(
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Member", "themerex"),
			"desc" => __("Team member", "themerex"),
			"id" => "trx_team_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "user",
					"title" => __("Team member", "themerex"),
					"desc" => __("Select one of registered users (if present) or put name, position etc. in fields below", "themerex"),
					"value" => "",
					"type" => "select",
					"options" => $THEMEREX_shortcodes_users
				),
				array(
					"id" => "name",
					"title" => __("Name", "themerex"),
					"desc" => __("Team member's name", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "position",
					"title" => __("Position", "themerex"),
					"desc" => __("Team member's position", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "email",
					"title" => __("E-mail", "themerex"),
					"desc" => __("Team member's e-mail", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "photo",
					"title" => __("Photo", "themerex"),
					"desc" => __("Team member's photo (avatar)", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"readonly" => false,
					"type" => "media"
				),
				array(
					"id" => "_content_",
					"title" => __("Description", "themerex"),
					"desc" => __("Team member's short description", "themerex"),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




	// Testimonials
	array(
		"title" => __("Testimonials", "themerex"),
		"desc" => __("Insert testimonials into post (page)", "themerex"),
		"id" => "testimonials",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Title of testimonmials block", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Testimonials style", "themerex"),
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					"1" => __('Style 1', 'themerex'),
					"2" => __('Style 2', 'themerex'),
				)
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("Testimonials item", "themerex"),
			"id" => "testimonials_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "name",
					"title" => __("Name", "themerex"),
					"desc" => __("Name of testimonmials author", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "position",
					"title" => __("Position", "themerex"),
					"desc" => __("Position of testimonmials author", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "email",
					"title" => __("E-mail", "themerex"),
					"desc" => __("E-mail of testimonmials author", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "photo",
					"title" => __("Photo", "themerex"),
					"desc" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "themerex"),
					"value" => "",
					"readonly" => false,
					"type" => "media"
				),
				array(
					"id" => "_content_",
					"title" => __("Testimonials text", "themerex"),
					"desc" => __("Current testimonials text", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




	// Title
	array(
		"title" => __("Title", "themerex"),
		"desc" => __("Create header tag (1-6 level) with many styles", "themerex"),
		"id" => "title",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Title content", "themerex"),
				"desc" => __("Title content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array(
				"id" => "type",
				"title" => __("Title type", "themerex"),
				"desc" => __("Title type (header level)", "themerex"),
				"divider" => false,
				"value" => "1",
				"type" => "select",
				"options" => array(
					'1' => __('Header 1', 'themerex'),
					'2' => __('Header 2', 'themerex'),
					'3' => __('Header 3', 'themerex'),
					'4' => __('Header 4', 'themerex'),
					'5' => __('Header 5', 'themerex'),
					'6' => __('Header 6', 'themerex'),
				)
			),
			array(
				"id" => "font_size",
				"title" => __("Font size", "themerex"),
				"divider" => false,
				"value" => '',
				"min" => 10,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "letter_spacing",
				"title" => __("Letter spacing", "themerex"),
				"divider" => false,
				"value" => '',
				"min" => -100,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "weight",
				"title" => __("Font weight", "themerex"),
				"desc" => __("Title font weight", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"size" => "medium",
				"options" => array(
					'100' => __('Thin (100)', 'themerex'),
					'300' => __('Light (300)', 'themerex'),
					'400' => __('Normal (400)', 'themerex'),
					'700' => __('Bold (700)', 'themerex')
				)
			),
			array(
				"id" => "color",
				"title" => __("Color", "themerex"),
				"desc" => __("Select font color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Title text alignment", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			),
			array(
				"id" => "transform",
				"title" => __("Text Transform", "themerex"),
				"desc" => __("Title text transform", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'lowercase' => __('Lowercase', 'themerex'),
					'uppercase' => __('Uppercase', 'themerex')
				)
			), 
			array(
				"id" => "link",
				"title" => __("Link Title", "themerex"),
				"desc" => __("Output title as link", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("Title style", "themerex"),
				"desc" => __("Title style", "themerex"),
				"divider" => false,
				"value" => "regular",
				"type" => "select",
				"options" => array(
					'regular' => __('Regular', 'themerex'),
					'iconed' => __('With icon (image)', 'themerex')
				)
			),
			array(
				"id" => "icon",
				"title" => __('Title font icon',  'themerex'),
				"desc" => __("Select font icon for the title from Fontello icons set (if style='iconed')",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "image",
				"title" => __('or image icon',  'themerex'),
				"desc" => __("Select image icon for the title instead icon above (if style='iconed')",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "images",
				"size" => "small",
				"options" => $THEMEREX_shortcodes_images
			),
			array(
				"id" => "picture",
				"title" => __('or URL for image file', "themerex"),
				"desc" => __("Select or upload image or write URL from other site (if style='iconed')", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "size",
				"title" => __('Icon (image) size', "themerex"),
				"desc" => __("Select icon (image) size (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "medium",
				"type" => "checklist",
				"options" => array(
					'small' => __('Small', 'themerex'),
					'medium' => __('Medium', 'themerex'),
					'large' => __('Large', 'themerex'),
					'huge' => __('Huge', 'themerex')
				)
			),
			array(
				"id" => "position",
				"title" => __('Icon (image) position', "themerex"),
				"desc" => __("Select icon (image) position (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "left",
				"type" => "checklist",
				"options" => array(
					'top' => __('Top', 'themerex'),
					'left' => __('Left', 'themerex'),
					'right' => __('Right', 'themerex')
				)
			),
			array(
				"id" => "background",
				"title" => __('Show background under icon', "themerex"),
				"desc" => __("Select background under icon (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "none",
				"type" => "checklist",
				"options" => array(
					'none' => __('None', 'themerex'),
					'square' => __('Square', 'themerex'),
					'circle' => __('Circle', 'themerex')
				)
			),
			array(
				"id" => "bg_color",
				"title" => __("Icon's background color", "themerex"),
				"desc" => __("Icon's background color (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "bd_color",
				"title" => __("Icon's border color", "themerex"),
				"desc" => __("Icon's border color (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),






	// Tooltip
	array(
		"title" => __("Tooltip", "themerex"),
		"desc" => __("Create tooltip for selected text", "themerex"),
		"id" => "tooltip",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Tooltip title (required)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Tipped content", "themerex"),
				"desc" => __("Highlighted content with tooltip", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_id
		)
	),


	// Video
	array(
		"title" => __("Video", "themerex"),
		"desc" => __("Insert video player", "themerex"),
		"id" => "trex_video",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "url",
				"title" => __("URL for video file", "themerex"),
				"desc" => __("Select video from media library or paste URL for video file from other site", "themerex"),
				"divider" => false,
				"readonly" => false,
				"value" => "",
				"type" => "media",
				"before" => array(
					'title' => __('Choose video', 'themerex'),
					'action' => 'media_upload',
					'type' => 'video',
					'multiple' => false,
					'linked_field' => '',
					'captions' => array( 	
						'choose' => __('Choose video file', 'themerex'),
						'update' => __('Select video file', 'themerex')
					)
				),
				"after" => array(
					'icon' => 'icon-cancel',
					'action' => 'media_reset'
				)
			),
			array(
				"id" => "autoplay",
				"title" => __("Autoplay video", "themerex"),
				"desc" => __("Autoplay video on page load", "themerex"),
				"divider" => false,
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			array(
				"id" => "title",
				"title" => __("Show title bar", "themerex"),
				"desc" => __("Show title bar above video frame", "themerex"),
				"divider" => false,
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			array(
				"id" => "image",
				"title" => __("Image preview", "themerex"),
				"desc" => __("Select or upload image or write URL from other site for video preview", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	)

	
);



// Filters for shortcodes handling
//----------------------------------------------------------------------

// Enable shortcodes in widgets
//add_filter('widget_text', 'do_shortcode');

// Enable shortcodes in excerpt
add_filter('the_excerpt', 'do_shortcode');

// Clear \n around shortcodes
add_filter('widget_text', 'sc_empty_paragraph_fix2', 1);
add_filter('the_excerpt', 'sc_empty_paragraph_fix2', 1);
add_filter('the_content', 'sc_empty_paragraph_fix2', 1);
function sc_empty_paragraph_fix2($content) {   
	$content = str_replace("\r\n", "\n", $content);
	$content = str_replace(
		array("]\n[", "]\n\n[", "]\n\n\n["),
		array('][',   '][',     ']['),
		$content
	);
	return $content;
}

// Clear paragraph tags around shortcodes
add_filter('widget_text', 'sc_empty_paragraph_fix');
add_filter('the_excerpt', 'sc_empty_paragraph_fix');
add_filter('the_content', 'sc_empty_paragraph_fix');
function sc_empty_paragraph_fix($content) {   
	$content = str_replace(
		array('<p>[', '<br />[', '<br/>[', '<br>[', ']</p>', ']<br />', ']<br/>', ']<br>', "]\n</p>", "]\n<br />", "]\n<br/>", "]\n<br>", "<p><div", "<p><h1", "<p><h2", "<p><h3", "<p><h4", "<p><h5", "<p><h6", "</div></p>", "</h1></p>", "</h2></p>", "</h3></p>", "</h4></p>", "</h5></p>", "</h6></p>"),
		array('[',    '[',       '[',      '[',     ']',     ']',       ']',      ']',     ']',       ']',         ']',        ']',       "<div",    "<h1",    "<h2",    "<h3",    "<h4",    "<h5",    "<h6",    "</div>",    "</h1>",    "</h2>",    "</h3>",    "</h4>",    "</h5>",    "</h6>"),
		$content
	);
	return $content;
}

// Shortcodes list select handler
add_action('admin_head', 'sc_selector_js');
function sc_selector_js() {
	if (is_themerex_options_used()) {
		themerex_options_load_styles();
		themerex_options_load_scripts();
		themerex_options_prepare_js();
		themerex_shortcodes_load_scripts();
	}
}

// ThemeREX shortcodes prepare scripts
function themerex_shortcodes_prepare_js() {
	global $THEMEREX_shortcodes;
	?>
	<script type="text/javascript">
		var THEMEREX_shortcodes = JSON.parse('<?php echo str_replace("'", "\\'", json_encode($THEMEREX_shortcodes)); ?>');
		var THEMEREX_shortcodes_cp = '<?php echo is_admin() ? 'wp' : 'internal'; ?>';
	</script>
	<?php
}

// ThemeREX shortcodes load scripts
function themerex_shortcodes_load_scripts() {
	global $THEMEREX_shortcodes;
	?>
	<script type="text/javascript">
		var THEMEREX_shortcodes = JSON.parse('<?php echo str_replace("'", "\\'", json_encode($THEMEREX_shortcodes)); ?>');
	</script>
	<?php
	wp_enqueue_script( 'themerex-shortcodes-script', get_template_directory_uri() . '/includes/shortcodes/shortcodes_admin.js', array('jquery'), null, true );
	wp_enqueue_script( 'themerex-selection-script', get_template_directory_uri() . '/js/jquery.selection.js', array('jquery'), null, true );
}

// Show shortcodes list in admin editor
add_action('media_buttons','sc_selector_add_in_toolbar', 11);
function sc_selector_add_in_toolbar(){
	global $THEMEREX_shortcodes;
	
	$shortcodes_list = '<select class="sc_selector"><option value="">&nbsp;'.__('- Select Shortcode -', 'themerex').'&nbsp;</option>';

	foreach ($THEMEREX_shortcodes as $idx => $sc) {
		$shortcodes_list .= '<option value="' . $idx . '" title="' . esc_attr($sc['desc']) . '">' . esc_attr($sc['title']) . '</option>';
	}

	$shortcodes_list .= '</select>';

	echo $shortcodes_list;
}


function sc_param_is_on($prm) {
	return $prm>0 || in_array(themerex_strtolower($prm), array('true', 'on', 'yes', 'show'));
}
function sc_param_is_off($prm) {
	return empty($prm) || $prm===0 || in_array(themerex_strtolower($prm), array('false', 'off', 'no', 'none', 'hide'));
}
function sc_clear_accent_color($color) {
	global $trex_accent_color;
	
	if(!empty($color)) {
		return $color == $trex_accent_color ? false : $color;
	}
	else
		return false;
}
function sc_is_accent_color($color) {
	global $trex_accent_color;	
	if(!empty($color)) {
		return $color == $trex_accent_color ? true : false;
	}
	else
		return false;
}
?>
