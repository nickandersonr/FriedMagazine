<?php
add_post_type_support( 'post', array('excerpt', 'post-formats') );

$THEMEREX_meta_box_post = array(
	'id' => 'post-meta-box',
	'title' => __('Post Options', 'themerex'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "title" => __('Post options', 'themerex'),
			"override" => "post",
			"divider" => false,
			"id" => "partition_post_options",
			"icon" => "icon-cog",
			"type" => "partition"),
		array( "title" => __('Reviews criterias for this post', 'themerex'),
			"override" => "post",
			"desc" => __('In this section you can put your reviews marks', 'themerex'),
			"class" => "reviews_meta",
			"type" => "info"),
		array( "title" => __('Show reviews block',  'themerex'),
			"desc" => __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'themerex'),
			"override" => "post",
			"id" => "show_reviews",
			"class" => "reviews_meta",
			"std" => "inherit",
			"type" => "radio",
			"style" => "horizontal",
			"options" => getYesNoList()),
		array( "title" => __('Reviews Style',  'themerex'),
			"desc" => __("Show rating marks as text or as stars/progress bars.", 'themerex'),
			"override" => "post",
			"id" => "reviews_style",
			"class" => "reviews_meta",
			"std" => "inherit",
			"type" => "select",
			"options" => array(
				'text' => __('As text (for example: 7.5 / 10)', 'themerex'),
				'star' => __('As one star', 'themerex'),
				'5stars' => __('As 5 stars', 'themerex'),
				'10stars' => __('As 10 stars', 'themerex'),
				'circular' => __('As circular diagram', 'themerex')
				)			
			),
		array( "title" => __('Review points color',  'themerex'),
			"desc" => __("Color of review points", 'themerex'),
			"override" => "post",
			"id" => "review_color",
			"class" => "reviews_meta",
			"std" => "inherit",
			"type" => "color"
			),
		array( "title" => __('Reviews marks',  'themerex'),
			"override" => "post",
			"desc" => __("Marks for this review.", 'themerex'),
			"id" => "reviews_marks",
			"class" => "reviews_meta reviews_tab reviews_users",
			"std" => "",
			"type" => "reviews",
			"options" => get_theme_option('reviews_criterias'))
	)
);

// Add meta box
add_action('admin_menu', 'add_meta_box_post');
function add_meta_box_post() {
    global $THEMEREX_meta_box_post;
    add_meta_box($THEMEREX_meta_box_post['id'], $THEMEREX_meta_box_post['title'], 'show_meta_box_post', $THEMEREX_meta_box_post['page'], $THEMEREX_meta_box_post['context'], $THEMEREX_meta_box_post['priority']);
}

// Callback function to show fields in meta box
function show_meta_box_post() {
    global $THEMEREX_meta_box_post, $post, $THEMEREX_options;
	
    // Use nonce for verification
    echo '<input type="hidden" name="meta_box_post_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	// Nonce for ajax queries
	$THEMEREX_ajax_nonce = wp_create_nonce('ajax_nonce');
	$THEMEREX_ajax_url = admin_url('admin-ajax.php');
	
	$maxLevel = max(5, (int) get_theme_option('reviews_max_level'));

	$custom_options = get_post_meta($post->ID, 'post_custom_options', true);
	
	if (isset($custom_options['reviews_marks'])) 
		$custom_options['reviews_marks'] = marksToDisplay($custom_options['reviews_marks']);

	$post_options = array_merge($THEMEREX_options, $THEMEREX_meta_box_post['fields']);

	themerex_options_load_scripts();
	themerex_options_prepare_js();

	wp_enqueue_script( '_admin', get_template_directory_uri() . '/js/_admin.js', array('jquery'), null, true );	
	?>
    
    <script type="text/javascript">
		// AJAX fields
		var THEMEREX_ajax_url = "<?php echo $THEMEREX_ajax_url; ?>";
		var THEMEREX_ajax_nonce = "<?php echo $THEMEREX_ajax_nonce; ?>";
		//var reviews_criterias = "";
		var reviews_max_level = <?php echo $maxLevel; ?>;
		var allowUserReviews = true;
		jQuery(document).ready(function() {
			// Init post specific meta fields
			//initPostReviews();
		});
	</script>
    
	<div class="reviews_<?php echo $maxLevel; ?>">

    <?php

	themerex_options_page_start(array(
		'data' => $post_options,
		'add_inherit' => true,
		'show_page_layout' => false,
		'override' => 'post'
		));

	foreach ($post_options as $option) { 
		if (!isset($option['override']) || !in_array('post', explode(',', $option['override']))) continue;

		$id = isset($option['id']) ? $option['id'] : '';
        $meta = isset($custom_options[$id]) ? $custom_options[$id] : '';
		
		if ($id == 'reviews_marks') {
			$cat_list = getCategoriesByPostId($post->ID);
			if (count($cat_list) > 0) {
				foreach ($cat_list as $cat) {
					$id = (int) $cat['term_id'];
					$prop = get_category_inherited_property($id, 'reviews_criterias');
					if (!empty($prop) && !is_inherit_option($prop)) {
						$option['options'] = $prop;
						break;
					}
				}
			}
		}

		themerex_options_show_field($option, $meta);
	}

	themerex_options_page_stop();
	
	?>
	</div>
	<?php
}



// Save data from meta box
add_action('save_post', 'save_meta_box_post');
function save_meta_box_post($post_id) {
    global $THEMEREX_meta_box_post, $THEMEREX_options;
    
    // verify nonce
    if (!isset($_POST['meta_box_post_nonce']) || !wp_verify_nonce($_POST['meta_box_post_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } else if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
	$custom_options = array();

	$post_options = array_merge($THEMEREX_options, $THEMEREX_meta_box_post['fields']);

	$need_save = false;

	foreach ($post_options as $field) { 
		if (!isset($field['override']) || !in_array('post', explode(',', $field['override']))) continue;
		if (!isset($field['std'])) continue;
		$id = $field['id'];
		if (!isset($_POST[$id.'_inherit'])) continue;
		$need_save = true;
		if (is_inherit_option($_POST[$id.'_inherit']))
			$new = '';
		else if (isset($_POST[$id])) {
			if ($field['type']=='socials') {
				if (!empty($field['cloneable'])) {
					foreach($_POST[$id] as $k=>$v)
						$_POST[$id][$k] = array('url'=>stripslashes($v), 'icon'=>stripslashes($_POST[$id.'_icon'][$k]));
				} else {
					$_POST[$id] = array('url'=>stripslashes($_POST[$id]), 'icon'=>stripslashes($_POST[$id.'_icon']));
				}
			} else if (is_array($_POST[$id])) {
				foreach($_POST[$id] as $k=>$v)
					$_POST[$id][$k] = stripslashes($v);
			} else
				$_POST[$id] = stripslashes($_POST[$id]);
			// Add cloneable index
			if (!empty($field['cloneable'])) {
				$rez = array();
				foreach($_POST[$id] as $k=>$v)
					$rez[$_POST[$id.'_numbers'][$k]] = $v;
				$_POST[$id] = $rez;
			}
			$new = $_POST[$id];
			if ($id == 'reviews_marks') {
				$new = join(',', $new);
				if (($avg = getReviewsRatingAverage($new)) > 0) {
					$new = marksToSave($new);
					update_post_meta($post_id, 'reviews_avg', marksToSave($avg));
				}
			}
		} else
			$new = $field['type'] == 'checkbox' ? 'false' : '';
		$custom_options[$id] = $new ? $new : 'inherit';
	}
	
	if ($need_save) update_post_meta($post_id, 'post_custom_options', $custom_options);
}
?>