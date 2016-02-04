<?php
global $themerex_options_delimiter, $themerex_options_libraries_uri, $themerex_options_data;
$themerex_options_data = null;
$themerex_options_delimiter = ',';
$themerex_options_libraries_uri = get_template_directory_uri() . '/js';

require_once(get_template_directory().'/admin/theme-custom.php');


//-----------------------------------------------------------------------------------
// Load required styles for Options Page
//-----------------------------------------------------------------------------------
//add_action("admin_print_styles", 'themerex_options_load_styles');
add_action("admin_head", 'themerex_options_load_styles');
function themerex_options_load_styles() {
global $themerex_options_libraries_uri;
	// WP Color Picker
	wp_enqueue_style('wp-color-picker', false, array(), null);
	// PrettyPhoto
	wp_enqueue_style('prettyphoto-style', $themerex_options_libraries_uri.'/prettyphoto/css/prettyPhoto.css', array(), null);
	// ThemeREX options styles
	wp_enqueue_style('themerex-options-style', get_template_directory_uri().'/admin/css/theme-options.css', array(), null);
	wp_enqueue_style('themerex-options-style-datepicker', get_template_directory_uri().'/admin/css/theme-options-datepicker.css', array(), null);
	wp_enqueue_style('themerex-messages-style', get_template_directory_uri() . '/js/messages/_messages.css', array(), null );
}


//-----------------------------------------------------------------------------------
// Load required javascripts for Options Page
//-----------------------------------------------------------------------------------
//add_action("admin_print_scripts", 'themerex_options_load_scripts');
add_action("admin_head", 'themerex_options_load_scripts');
function themerex_options_load_scripts() {
global $themerex_options_libraries_uri;
	// WP core scripts
	wp_enqueue_media();
	wp_enqueue_script('wp-color-picker', false, array(), null, true);
	// jQuery scripts
	wp_enqueue_script('jquery-ui-core', false, array('jquery'), null, true);
	wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
	wp_enqueue_script('jquery-ui-accordion', false, array('jquery', 'jquery-ui-core'), null, true);
	wp_enqueue_script('jquery-ui-sortable', false, array('jquery', 'jquery-ui-core'), null, true);
	wp_enqueue_script('jquery-ui-draggable', false, array('jquery', 'jquery-ui-core'), null, true);
	wp_enqueue_script('jquery-ui-datepicker', false, array('jquery', 'jquery-ui-core'), null, true);
	wp_enqueue_script( 'jquery-input-mask', get_template_directory_uri() . '/admin/js/jquery.maskedinput.1.3.1.min.js', array('jquery'), null, true );	
	// PrettyPhoto
	wp_enqueue_script( 'prettyphoto-script', $themerex_options_libraries_uri.'/prettyphoto/jquery.prettyPhoto.min.js', array('jquery'), 'no-compose', true );
	// ThemeREX options scripts
	wp_enqueue_script( 'themerex-options-script', get_template_directory_uri() . '/admin/js/theme-options.js', array('jquery'), null, true );	
	// ThemeREX messages script
	wp_enqueue_script( 'themerex-messages', get_template_directory_uri() . '/js/messages/_messages.js',  array('jquery'), null, true );
}



//-----------------------------------------------------------------------------------
// Prepare javascripts global variables
//-----------------------------------------------------------------------------------
add_action("admin_head", 'themerex_options_prepare_js');
function themerex_options_prepare_js() { 
	global $themerex_options_delimiter;
?>
	<script type="text/javascript">
		var THEMEREX_OPTIONS_ajax_nonce = "<?php echo wp_create_nonce('ajax_nonce'); ?>";
		var THEMEREX_OPTIONS_ajax_url   = "<?php echo admin_url('admin-ajax.php'); ?>";

		var THEMEREX_OPTIONS_delimiter  = "<?php echo $themerex_options_delimiter; ?>";
		
		var THEMEREX_OPTIONS_STRINGS_del_item_error			= "<?php _e("You can't delete last item! To disable it - just clear value in field.", 'themerex'); ?>";
		var THEMEREX_OPTIONS_STRINGS_del_item				= "<?php _e("Delete item error!", 'themerex'); ?>";

		var THEMEREX_OPTIONS_STRINGS_wait					= "<?php _e("Please wait!", 'themerex'); ?>";
		var THEMEREX_OPTIONS_STRINGS_save_options			= "<?php _e("Options saved!", 'themerex'); ?>";
		var THEMEREX_OPTIONS_STRINGS_reset_options 			= "<?php _e("Options reset!", 'themerex'); ?>";
		var THEMEREX_OPTIONS_STRINGS_reset_options_confirm	= "<?php _e("You really want reset all options to default values?", 'themerex'); ?>";
	</script>
<?php 
}



//-----------------------------------------------------------------------------------
// Build the Options Page
//-----------------------------------------------------------------------------------
function themerex_options_page() {
	global $themerex_options_data;

	themerex_options_page_start();

	foreach ($themerex_options_data as $field)
		themerex_options_show_field($field);

	themerex_options_page_stop();
}



//-----------------------------------------------------------------------------------
// Start render the options page (initialize flags)
//-----------------------------------------------------------------------------------
function themerex_options_page_start($args = array()) {
	global $THEMEREX_flags, $THEMEREX_options, $themerex_options_data;
	$THEMEREX_flags = array_merge(array(
		'data'				=> null,
		'nesting'			=> array(),	// Nesting stack for partitions, tabs and groups
		'radio_as_select'	=> false,	// Display options[type="radio"] as options[type="select"]
		'add_inherit'		=> false,	// Add value "Inherit" in all options with lists
		'show_page_layout'	=> true,	// Display page layout or only render fields
		'override'			=> ''		// Override mode - page|post|category
		), is_array($args) ? $args : array( 'add_inherit' => $args ));
	$themerex_options_data = empty($args['data']) ? $THEMEREX_options : $args['data'];
	?>
	<div class="themerex_options">
    <?php
	if ($THEMEREX_flags['show_page_layout']) {
	?>
		<form class="themerex_options_form">
			<div class="themerex_options_header">
				<div class="themerex_options_logo">
					<span class="iconadmin-cog"></span>
					<h2><?php _e('Theme Options', 'themerex'); ?></h2>
				</div>
				<div class="themerex_options_button_reset"><span class="iconadmin-spin3"></span><?php _e('Reset', 'themerex'); ?></div>
				<div class="themerex_options_button_save"><span class="iconadmin-check"></span><?php _e('Save', 'themerex'); ?></div>
			</div>
	<?php
	}
	?>
			<div class="themerex_options_body">
    <?php
}


//-----------------------------------------------------------------------------------
// Finish render the options page (close groups, tabs and partitions)
//-----------------------------------------------------------------------------------
function themerex_options_page_stop() {
	global $THEMEREX_flags;
	echo themerex_options_close_nested_groups('', true);
	?>
			</div> <!-- .themerex_options_body -->
    <?php
	if ($THEMEREX_flags['show_page_layout']) {
	?>
		</form>
	<?php
	}
	?>
	</div>	<!-- .themerex_options -->
    <?php
}



//-----------------------------------------------------------------------------------
// Return true if current type is groups type
//-----------------------------------------------------------------------------------
function themerex_options_is_group($type) {
	return in_array($type, array('group', 'toggle', 'accordion', 'tab', 'partition'));
}

//-----------------------------------------------------------------------------------
// Close nested groups until type
//-----------------------------------------------------------------------------------
function themerex_options_close_nested_groups($type='', $end=false) {
	global $THEMEREX_flags;
	$output = '';
	if ($THEMEREX_flags['nesting']) {
		for ($i=count($THEMEREX_flags['nesting'])-1; $i>=0; $i--) {
			$container = array_pop($THEMEREX_flags['nesting']);
			switch ($container) {
				case 'group':
					$output = '</fieldset>' . $output;
					break;
				case 'toggle':
					$output = '</div></div>' . $output;
					break;
				case 'tab':
				case 'partition':
					$output = '</div>' . ($container!=$type || $end ? '</div>' : '') . $output;
					break;
				case 'accordion':
					$output = '</div></div>' . ($container!=$type || $end ? '</div>' : '') . $output;
					break;
			}
			if ($type == $container)
				break;
		}
	}
	return $output;
}



//-----------------------------------------------------------------------------------
// Collect tabs titles for current tabs or partitions
//-----------------------------------------------------------------------------------
function themerex_options_collect_tabs($type, $id) {
	global $THEMEREX_flags,$themerex_options_data;
	$start = false;
	$nesting = array();
	$tabs = '';
	foreach ($themerex_options_data as $field) {
		if (!empty($THEMEREX_flags['override']) && (empty($field['override']) || !in_array($THEMEREX_flags['override'], explode(',', $field['override'])))) continue;
		if ($field['type']==$type && !empty($field['start']) && $field['start']==$id)
			$start = true;
		if (!$start) continue;
		if (themerex_options_is_group($field['type'])) {					// Close nested containers
			if (empty($field['start']) && (!in_array($field['type'], array('group', 'toggle')) || !empty($field['end']))) {
				if ($nesting) {
					for ($i = count($nesting)-1; $i>=0; $i--) {
						$container = array_pop($nesting);
						if ($field['type'] == $container) {
							break;
						}
					}
				}
			}
			if (empty($field['end'])) {
				if (!$nesting) {
					if ($field['type']==$type) {
						$tabs .= '<li id="'.$field['id'].'">'
							. '<a id="'.$field['id'].'_title"'
								. ' href="#'.$field['id'].'_content"'
								. (!empty($field['action']) ? ' onclick="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
								. '>'
								. (!empty($field['icon']) ? '<span class="'.$field['icon'].'"></span>' : '')
								. $field['title']
								. '</a>';
					} else
						break;
				}
				array_push($nesting, $field['type']);
			}
		}
	}
	return $tabs;
}



//-----------------------------------------------------------------------------------
// Return menu items list (menu, images or icons)
//-----------------------------------------------------------------------------------
function themerex_options_menu_list($field, $clone_val) {
	global $themerex_options_delimiter;
	if ($field['type'] == 'socials') $clone_val = $clone_val['icon'];
	$list = '<div class="themerex_options_input_menu '.(empty($field['style']) ? '' : ' themerex_options_input_menu_'.$field['style']).'">';
	$caption = '';
	foreach ($field['options'] as $key => $item) {
		if (in_array($field['type'], array('list', 'icons', 'socials'))) $key = $item;
		$selected = '';
		if (themerex_strpos($themerex_options_delimiter.$clone_val.$themerex_options_delimiter, $themerex_options_delimiter.$key.$themerex_options_delimiter)!==false) {
			$caption = htmlspecialchars($item);
			$selected = ' themerex_options_state_checked';
		}
		$list .= '<span class="themerex_options_menuitem' 
			. $selected 
			. '" data-value="' . $key . '"'
			//. (!empty($field['action']) ? ' onclick="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
			. '>';
		if (in_array($field['type'], array('list', 'select', 'fonts')))
			$list .= $item;
		else if ($field['type'] == 'icons' || ($field['type'] == 'socials' && $field['style'] == 'icons'))
			$list .= '<span class="'.$item.'"></span>';
		else if ($field['type'] == 'images' || ($field['type'] == 'socials' && $field['style'] == 'images'))
			//$list .= '<img src="'.$item.'" data-icon="'. $key .'" alt="" class="themerex_options_input_image" />';
			$list .= '<span style="background-image:url('.$item.')" data-src="'.$item.'" data-icon="'. $key .'" class="themerex_options_input_image"></span>';
		$list .= '</span>';
	}
	$list .= '</div>';
	return array($list, $caption);
}



//-----------------------------------------------------------------------------------
// Return action buttom
//-----------------------------------------------------------------------------------
function themerex_options_action_button($data, $type) {
	global $THEMEREX_flags;
	$class = ' themerex_options_button_'.$type.(!empty($data['icon']) ? ' themerex_options_button_'.$type.'_small' : '');
	$output = '<span class="' 
				. ($type == 'button' ? 'themerex_options_input_button'  : 'themerex_options_field_'.$type)
				. (!empty($data['action']) ? ' themerex_options_with_action' : '')
				. (!empty($data['icon']) ? ' '.$data['icon'] : '')
				. '"'
				. (!empty($data['icon']) && !empty($data['title']) ? ' title="'.$data['title'].'"' : '')
				. (!empty($data['action']) ? ' onclick="themerex_options_action_'.$data['action'].'(this);return false;"' : '')
				. (!empty($data['type']) ? ' data-type="'.$data['type'].'"' : '')
				. (!empty($data['multiple']) ? ' data-multiple="'.$data['multiple'].'"' : '')
				. (!empty($data['linked_field']) ? ' data-linked-field="'.$data['linked_field'].'"' : '')
				. (!empty($data['captions']['choose']) ? ' data-caption-choose="'.$data['captions']['choose'].'"' : '')
				. (!empty($data['captions']['update']) ? ' data-caption-update="'.$data['captions']['update'].'"' : '')
				. '>'
				. ($type == 'button' || (empty($data['icon']) && !empty($data['title'])) ? $data['title'] : '')
				. '</span>';
	return array($output, $class);
}


//-----------------------------------------------------------------------------------
// Theme options page show option field
//-----------------------------------------------------------------------------------
function themerex_options_show_field($field, $value=null) {
	global $THEMEREX_flags, $themerex_options_delimiter, $themerex_options_data;

	// Set start field value
	if ($value !== null) $field['val'] = $value;
	if (!isset($field['val']) || $field['val']=='') $field['val'] = 'inherit';
	if (!empty($field['subset'])) {
		$sbs = get_theme_option($field['subset'], '', $themerex_options_data);
		$field['val'] = isset($field['val'][$sbs]) ? $field['val'][$sbs] : '';
	}
	
	if (empty($field['id']))
		$field['id'] = 'themerex_options_id_'.str_replace('.', '', mt_rand());
	if (!isset($field['title']))
		$field['title'] = '';
	
	// Divider after field
	$divider = !isset($field['divider']) || $field['divider'] ? ' themerex_options_divider' : '';

	// Setup default parameters
	if ($field['type']=='media') {
		if (!isset($field['before'])) {
			$field['before'] = array(
				'title' => __('Choose image', 'themerex'),
				'action' => 'media_upload',
				'type' => 'image',
				'multiple' => false,
				'linked_field' => '',
				'captions' => array('choose' => __( 'Choose image', 'themerex'),
									'update' => __( 'Select image', 'themerex')
									)
			);
		}
		if (!isset($field['after'])) {
			$field['after'] = array(
				'icon'=>'iconadmin-cancel',
				'action'=>'media_reset'
			);
		}
	}

	// Buttons before and after field
	$before = $after = $buttons_classes = '';
	if (!empty($field['before'])) {
		list($before, $class) = themerex_options_action_button($field['before'], 'before');
		$buttons_classes .= $class;
	}
	if (!empty($field['after'])) {
		list($after, $class) = themerex_options_action_button($field['after'], 'after');
		$buttons_classes .= $class;
	}
	if (in_array($field['type'], array('list', 'select', 'fonts')) || ($field['type']=='socials' && (empty($field['style']) || $field['style']=='icons'))) {
		$buttons_classes .= ' themerex_options_button_after_small';
	}

	// Is it inherit field?
	$inherit = is_inherit_option($field['val']) ? 'inherit' : '';

	// Is it cloneable field?
	$cloneable = isset($field['cloneable']) && $field['cloneable'];

	// Prepare field
	if (!$cloneable)
		$field['val'] = array($field['val']);
	else {
		if (!is_array($field['val']))
			$field['val'] = array($field['val']);
		else if ($field['type'] == 'socials' && (!isset($field['val'][0]) || !is_array($field['val'][0])))
			$field['val'] = array($field['val']);
	}

	// Field container
	if (themerex_options_is_group($field['type'])) {					// Close nested containers
		if (empty($field['start']) && (!in_array($field['type'], array('group', 'toggle')) || !empty($field['end']))) {
			echo themerex_options_close_nested_groups($field['type'], !empty($field['end']));
			if (!empty($field['end'])) {
				return;
			}
		}
	} else {														// Start field layout
		if ($field['type'] != 'hidden') {
			echo '<div class="themerex_options_field'
				. ' themerex_options_field_' . (in_array($field['type'], array('list','fonts')) ? 'select' : $field['type'])
				. (in_array($field['type'], array('media', 'fonts', 'list', 'select', 'socials', 'date', 'time')) ? ' themerex_options_field_text'  : '')
				. ($field['type']=='socials' && !empty($field['style']) && $field['style']=='images' ? ' themerex_options_field_images'  : '')
				. ($field['type']=='socials' && (empty($field['style']) || $field['style']=='icons') ? ' themerex_options_field_icons'  : '')
				. (isset($field['dir']) && $field['dir']=='vertical' ? ' themerex_options_vertical' : '')
				. (!empty($field['multiple']) ? ' themerex_options_multiple' : '')
				. (isset($field['size']) ? ' themerex_options_size_'.$field['size'] : '')
				. (isset($field['class']) ? ' ' . $field['class'] : '')
				. $divider 
				. '">'."\n";
			echo '<label class="themerex_options_field_label'.(!empty($THEMEREX_flags['add_inherit']) && isset($field['std']) ? ' themerex_options_field_label_inherit' : '').'" for="' . $field['id'] . '">' . $field['title'] 
				. (!empty($THEMEREX_flags['add_inherit']) && isset($field['std']) ? '<span id="' . $field['id'] . '_inherit" class="themerex_options_button_inherit'.($inherit ? '' : ' themerex_options_inherit_off').'" title="' . __('Unlock this field', 'themerex') . '"></span>' : '')
				. '</label>'
				. "\n";
			echo '<div class="themerex_options_field_content'
				. $buttons_classes
				. ($cloneable ? ' themerex_options_cloneable_area' : '')
				. '">' . "\n";
		}
	}

	// Parse field type
	foreach ($field['val'] as $clone_num => $clone_val) {
		
		if ($cloneable) {
			echo '<div class="themerex_options_cloneable_item">'
				. '<span class="themerex_options_input_button themerex_options_clone_button themerex_options_clone_button_del">-</span>';
		}

		switch ( $field['type'] ) {
	
		case 'group':
			echo '<fieldset id="' . $field['id'] . '" class="themerex_options_container themerex_options_group themerex_options_content'.$divider.'">';
			if (!empty($field['title'])) echo '<legend>'.(!empty($field['icon']) ? '<span class="'.$field['icon'].'"></span>' : '').$field['title'] .'</legend>'."\n";
			array_push($THEMEREX_flags['nesting'], 'group');
		break;
	
		case 'toggle':
			array_push($THEMEREX_flags['nesting'], 'toggle');
			echo '<div id="' . $field['id'] . '" class="themerex_options_container themerex_options_toggle'.$divider.'">';
			echo '<h3 id="' . $field['id'] . '_title"'
				. ' class="themerex_options_toggle_header'.(empty($field['closed']) ? ' ui-state-active' : '') .'"'
				. (!empty($field['action']) ? ' onclick="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. '>'
				. (!empty($field['icon']) ? '<span class="themerex_options_toggle_header_icon '.$field['icon'].'"></span>' : '') 
				. $field['title'] 
				. '<span class="themerex_options_toggle_header_marker iconadmin-left-open"></span>'
				. '</h3>'
				. '<div class="themerex_options_content themerex_options_toggle_content"'.(!empty($field['closed']) ? ' style="display:none;"' : '').'>';
		break;
	
		case 'accordion':
			array_push($THEMEREX_flags['nesting'], 'accordion');
			if (!empty($field['start']))
				echo '<div id="' . $field['start'] . '" class="themerex_options_container themerex_options_accordion'.$divider.'">';
			echo '<div id="' . $field['id'] . '" class="themerex_options_accordion_item">'
				. '<h3 id="' . $field['id'] . '_title"'
				. ' class="themerex_options_accordion_header"'
				. (!empty($field['action']) ? ' onclick="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. '>' 
				. (!empty($field['icon']) ? '<span class="themerex_options_accordion_header_icon '.$field['icon'].'"></span>' : '') 
				. $field['title'] 
				. '<span class="themerex_options_accordion_header_marker iconadmin-left-open"></span>'
				. '</h3>'
				. '<div id="' . $field['id'] . '_content" class="themerex_options_content themerex_options_accordion_content">';
		break;
	
		case 'tab':
			array_push($THEMEREX_flags['nesting'], 'tab');
			if (!empty($field['start']))
				echo '<div id="' . $field['start'] . '" class="themerex_options_container themerex_options_tab'.$divider.'">'
					. '<ul>' . themerex_options_collect_tabs($field['type'], $field['start']) . '</ul>';
			echo '<div id="' . $field['id'] . '_content"  class="themerex_options_content themerex_options_tab_content">';
		break;
	
		case 'partition':
			array_push($THEMEREX_flags['nesting'], 'partition');
			if (!empty($field['start']))
				echo '<div id="' . $field['start'] . '" class="themerex_options_container themerex_options_partition'.$divider.'">'
					. '<ul>' . themerex_options_collect_tabs($field['type'], $field['start']) . '</ul>';
			echo '<div id="' . $field['id'] . '_content" class="themerex_options_content themerex_options_partition_content">';
		break;
	
		case 'hidden':
			echo '<input class="themerex_options_input themerex_options_input_hidden" name="'. $field['id'] .'" id="'. $field['id'] .'" type="hidden" value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '" />';
		break;

		case 'date':
			if (isset($field['style']) && $field['style']=='inline') {
				echo '<div class="themerex_options_input_date" id="'. $field['id'] .'_calendar"'
					. ' data-format="' . (!empty($field['format']) ? $field['format'] : 'yy-mm-dd') . '"'
					. ' data-months="' . (!empty($field['months']) ? max(1, min(3, $field['months'])) : 1) . '"'
					. ' data-linked-field="' . (!empty($data['linked_field']) ? $data['linked_field'] : $field['id']) . '"'
					. '></div>'
				. '<input id="'. $field['id'] .'"'
					. ' name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
					. ' type="hidden"'
					. ' value="' . htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
					. ' />';
			} else {
				echo '<input class="themerex_options_input themerex_options_input_date' . (!empty($field['mask']) ? ' themerex_options_input_masked' : '') . '"'
					. ' name="'. $field['id'] . ($cloneable ? '[]' : '') . '"'
					. ' id="'. $field['id'] . '"'
					. ' type="text"'
					. ' value="' . htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. ' data-format="' . (!empty($field['format']) ? $field['format'] : 'yy-mm-dd') . '"'
					. ' data-months="' . (!empty($field['months']) ? max(1, min(3, $field['months'])) : 1) . '"'
					. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
					. ' />'
				. $before 
				. $after;
			}
		break;

		case 'text':
			echo '<input class="themerex_options_input themerex_options_input_text' . (!empty($field['mask']) ? ' themerex_options_input_masked' : '') . '"'
				. ' name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' id="'. $field['id'] .'"'
				. ' type="text"'
				. ' value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['mask']) ? ' data-mask="'.$field['mask'].'"' : '')
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />'
			. $before 
			. $after;
		break;
		
		case 'textarea':
			$cols = isset($field['cols']) && $field['cols'] > 10 ? $field['cols'] : '40';
			$rows = isset($field['rows']) && $field['rows'] > 1 ? $field['rows'] : '8';
			echo '<textarea class="themerex_options_input themerex_options_input_textarea"'
				. ' name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' id="'. $field['id'] .'"'
				. ' cols="'. $cols .'"'
				. ' rows="' . $rows . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. '>'
				. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) 
				. '</textarea>';
		break;
		
		case 'editor':
			$cols = isset($field['cols']) && $field['cols'] > 10 ? $field['cols'] : '40';
			$rows = isset($field['rows']) && $field['rows'] > 1 ? $field['rows'] : '10';
			wp_editor( is_inherit_option($clone_val) ? '' : $clone_val, $field['id'] . ($cloneable ? '[]' : ''), array(
				'wpautop' => false,
				'textarea_rows' => $rows
			));
		break;

		case 'spinner':
			echo '<input class="themerex_options_input themerex_options_input_spinner' . (!empty($field['mask']) ? ' themerex_options_input_masked' : '') 
				. '" name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' id="'. $field['id'] .'"'
				. ' type="text"'
				. ' value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['mask']) ? ' data-mask="'.$field['mask'].'"' : '') 
				. (isset($field['min']) ? ' data-min="'.$field['min'].'"' : '') 
				. (isset($field['max']) ? ' data-max="'.$field['max'].'"' : '') 
				. (!empty($field['increment']) ? ' data-increment="'.$field['increment'].'"' : '') 
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />' 
				. '<span class="themerex_options_arrows"><span class="themerex_options_arrow_up iconadmin-up-dir"></span><span class="themerex_options_arrow_down iconadmin-down-dir"></span></span>';
		break;

		case 'tags':
			if (!is_inherit_option($clone_val)) {
				$tags = explode($themerex_options_delimiter, $clone_val);
				if (count($tags) > 0) {
					foreach($tags as $tag) {
						if (empty($tag)) continue;
						echo '<span class="themerex_options_tag iconadmin-cancel">'.$tag.'</span>';
					}
				}
			}
			echo '<input class="themerex_options_input_tags"'
				. ' type="text"'
				. ' value=""'
				. ' />'
				. '<input name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
					. ' type="hidden"'
					. ' value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
					. ' />';
		break;
		
		case "checkbox": 
			echo '<input type="checkbox" class="themerex_options_input themerex_options_input_checkbox"'
				. ' name="'.  $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' id="'. $field['id'] .'"'
				. ' value="true"'
				. ($clone_val == 'true' ? ' checked="checked"' : '') 
				. (!empty($field['disabled']) ? ' readonly="readonly"' : '') 
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />'
				. '<label for="' . $field['id'] . '" class="' . (!empty($field['disabled']) ? 'themerex_options_state_disabled' : '') . ($clone_val=='true' ? ' themerex_options_state_checked' : '').'"><span class="themerex_options_input_checkbox_image iconadmin-check"></span>' . (!empty($field['label']) ? $field['label'] : $field['title']) . '</label>';
		break;
		
		case "radio":
			foreach ($field['options'] as $key => $title) { 
				echo '<span class="themerex_options_radioitem">'
					.'<input class="themerex_options_input themerex_options_input_radio" type="radio"'
						. ' name="'. $field['id'] . ($cloneable ? '[]' : '') . '"'
						. ' value="'. $key .'"'
						. ($clone_val == $key ? ' checked="checked"' : '') 
						. ' id="' . $field['id'] . '_' . $key . '"'
						. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
						. ' />'
						. '<label for="' . $field['id'] . '_' . $key . '"'. ($clone_val == $key ? ' class="themerex_options_state_checked"' : '') .'><span class="themerex_options_input_radio_image iconadmin-circle-empty'.($clone_val == $key ? ' iconadmin-dot-circled' : '') . '"></span>' . $title . '</label></span>';
			}
		break;
		
		case "switch":
			$opt = array();
			foreach ($field['options'] as $key => $title) { 
				$opt[] = array('key'=>$key, 'title'=>$title);
				if (count($opt)==2) break;
			}
			echo '<input name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' type="hidden"'
				. ' value="'. htmlspecialchars(is_inherit_option($clone_val) || empty($clone_val) ? $opt[0]['key'] : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />'
				. '<span class="themerex_options_switch'.($clone_val==$opt[1]['key'] ? ' themerex_options_state_off' : '').'"><span class="themerex_options_switch_inner iconadmin-circle"><span class="themerex_options_switch_val1" data-value="'.$opt[0]['key'].'">'.$opt[0]['title'].'</span><span class="themerex_options_switch_val2" data-value="'.$opt[1]['key'].'">'.$opt[1]['title'].'</span></span></span>';
		break;

		case 'media':
			echo '<input class="themerex_options_input themerex_options_input_text themerex_options_input_media"'
				. ' name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' id="'. $field['id'] .'"'
				. ' type="text"'
				. ' value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"' 
				. (!isset($field['readonly']) || $field['readonly'] ? ' readonly="readonly"' : '') 
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />'
			. $before 
			. $after;
			if (!empty($clone_val) && !is_inherit_option($clone_val)) {
				$info = pathinfo($clone_val);
				echo '<a class="themerex_options_image_preview" rel="prettyPhoto" target="_blank" href="'.$clone_val.'">'.(themerex_strpos('jpg,png,gif', $info['extension'])!==false ? '<img src="'.$clone_val.'" alt="" />' : '<span>'.$info['basename'].'</span>').'</a>';
			}
		break;
		
		case 'button':
			list($button, $class) = themerex_options_action_button($field, 'button');
			echo $button;
		break;

		case 'range':
			echo '<div class="themerex_options_input_range" data-step="'.(!empty($field['step']) ? $field['step'] : 1).'">';
			echo '<span class="themerex_options_range_scale"><span class="themerex_options_range_scale_filled"></span></span>';
			if (themerex_strpos($clone_val, $themerex_options_delimiter)===false)
				$clone_val = max($field['min'], intval($clone_val));
			if (themerex_strpos($field['std'], $themerex_options_delimiter)!==false && themerex_strpos($clone_val, $themerex_options_delimiter)===false)
				$clone_val = $field['min'].','.$clone_val;
			$sliders = explode($themerex_options_delimiter, $clone_val);
			foreach($sliders as $s) {
				echo '<span class="themerex_options_range_slider"><span class="themerex_options_range_slider_value">'.intval($s).'</span><span class="themerex_options_range_slider_button"></span></span>';
			}
			echo '<span class="themerex_options_range_min">'.$field['min'].'</span><span class="themerex_options_range_max">'.$field['max'].'</span>';
			echo '<input name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' type="hidden"'
				. ' value="' . htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />';
			echo '</div>';			
		break;
		
		case "checklist":
			foreach ($field['options'] as $key => $title) { 
				echo '<span class="themerex_options_listitem'
					. (themerex_strpos($themerex_options_delimiter.$clone_val.$themerex_options_delimiter, $themerex_options_delimiter.$key.$themerex_options_delimiter)!==false ? ' themerex_options_state_checked' : '') . '"'
					. ' data-value="' . $key . '"'
					. '>'
					. htmlspecialchars($title)
					. '</span>';
			}
			echo '<input name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' type="hidden"'
				. ' value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />';
		break;
		
		case 'fonts':
			foreach ($field['options'] as $key => $title) {
				$field['options'][$key] = $key;
			}
		case 'list':
		case 'select':
			if (!isset($field['options']) && !empty($field['from']) && !empty($field['to'])) {
				$field['options'] = array();
				for ($i = $field['from']; $i <= $field['to']; $i+=(!empty($field['step']) ? $field['step'] : 1)) {
					$field['options'][$i] = $i;
				}
			}
			list($list, $caption) = themerex_options_menu_list($field, $clone_val);
			if (empty($field['style']) || $field['style']=='select') {
				echo '<input class="themerex_options_input themerex_options_input_select" type="text" value="'. $caption . '"'
					. ' readonly="readonly"'
					//. (!empty($field['mask']) ? ' data-mask="'.$field['mask'].'"' : '') 
					. ' />'
					. $before 
					. '<span class="themerex_options_field_after themerex_options_with_action iconadmin-down-open" onclick="themerex_options_action_show_menu(this);return false;"></span>';
			}
			echo $list;
			echo '<input name="'. $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' type="hidden"'
				. ' value="'. htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />';
		break;

		case 'images':
			list($list, $caption) = themerex_options_menu_list($field, $clone_val);
			if (empty($field['style']) || $field['style']=='select') {
				echo '<div class="themerex_options_caption_image iconadmin-down-open">'
					//.'<img src="'.$caption.'" alt="" />'
					.'<span style="background-image: url('.$caption.')"></span>'
					.'</div>';
			}
			echo $list;
			echo '<input name="'. $field['id'] . ($cloneable ? '[]' : '') . '"'
				. ' type="hidden"'
				. ' value="' . htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />';
		break;
		
		case 'icons':
			if (isset($field['css']) && $field['css']!='' && file_exists($field['css'])) {
				$field['options'] = parseIconsClasses($field['css']);
			}
			list($list, $caption) = themerex_options_menu_list($field, $clone_val);
			if (empty($field['style']) || $field['style']=='select') {
				echo '<div class="themerex_options_caption_icon iconadmin-down-open"><span class="'.$caption.'"></span></div>';
			}
			echo $list;
			echo '<input name="'. $field['id'] . ($cloneable ? '[]' : '') . '"'
				. ' type="hidden"'
				. ' value="' . htmlspecialchars(is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />';
		break;

		case 'socials':
			if (!is_array($clone_val)) $clone_val = array('url'=>'', 'icon'=>'');
			list($list, $caption) = themerex_options_menu_list($field, $clone_val);
			if (empty($field['style']) || $field['style']=='icons') {
				list($after, $class) = themerex_options_action_button(array(
					'action' => empty($field['style']) || $field['style']=='icons' ? 'select_icon' : '',
					'icon' => (empty($field['style']) || $field['style']=='icons') && !empty($clone_val['icon']) ? $clone_val['icon'] : 'iconadmin-users-1'
					), 'after');
			} else
				$after = '';
			echo '<input class="themerex_options_input themerex_options_input_text themerex_options_input_socials' 
				. (!empty($field['mask']) ? ' themerex_options_input_masked' : '') . '"'
				. ' name="' . $field['id'] . ($cloneable ? '[]' : '') .'"'
				. ' id="'. $field['id'] .'"'
				. ' type="text" value="'. htmlspecialchars(is_inherit_option($clone_val['url']) ? '' : $clone_val['url']) . '"' 
				. (!empty($field['mask']) ? ' data-mask="'.$field['mask'].'"' : '') 
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />'
				. $after;
			if (!empty($field['style']) && $field['style']=='images') {
				echo '<div class="themerex_options_caption_image iconadmin-down-open">'
					//.'<img src="'.$caption.'" alt="" />'
					.'<span style="background-image: url('.$caption.')"></span>'
					.'</div>';
			}
			echo $list;
			echo '<input name="'. $field['id'] . '_icon' . ($cloneable ? '[]' : '') .'" type="hidden" value="'. htmlspecialchars(is_inherit_option($clone_val['icon']) ? '' : $clone_val['icon']) . '" />';
		break;

		case "color":
			echo '<input class="themerex_options_input themerex_options_input_color"'
				. ' name="'. $field['id'] . ($cloneable ? '[]' : '') . '"'
				. ' id="'. $field['id'] . '"'
				. ' type="text"'
				. ' value="'. (is_inherit_option($clone_val) ? '' : $clone_val) . '"'
				. (!empty($field['action']) ? ' onchange="themerex_options_action_'.$field['action'].'(this);return false;"' : '')
				. ' />';
		break;   

		default:
			if (function_exists('show_custom_field')) {
				echo show_custom_field($field, $clone_val);
			}
		} 

		if ($cloneable) {
			echo '<input type="hidden" name="'. $field['id'] . '_numbers[]" value="' . $clone_num . '" />'
				. '</div>';
		}
	}

	if (!themerex_options_is_group($field['type']) && $field['type'] != 'hidden') {
		if ($cloneable) {
			echo '<div class="themerex_options_input_button themerex_options_clone_button themerex_options_clone_button_add">'. __('+ Add item', 'themerex') .'</div>';
		}
		if (!empty($THEMEREX_flags['add_inherit']) && isset($field['std']))
			echo  '<div class="themerex_options_content_inherit"'.($inherit ? '' : ' style="display:none;"').'><div>'.__('Inherit', 'themerex').'</div><input type="hidden" name="' . $field['id'] . '_inherit" value="'.$inherit.'" /></div>';
		echo '</div>';
		if (!empty($field['desc']))
			echo '<div class="themerex_options_desc">' . $field['desc'] .'</div>' . "\n";
		echo '</div>' . "\n";
	}
}



//-----------------------------------------------------------------------------------
// Ajax Save Action handler
//-----------------------------------------------------------------------------------
add_action('wp_ajax_themerex_options_save', 'themerex_options_save');
add_action('wp_ajax_nopriv_themerex_options_save', 'themerex_options_save');
function themerex_options_save() {
	global $wpdb, $THEMEREX_options;

	if ( !wp_verify_nonce( $_POST['nonce'], 'ajax_nonce' ) )
		die();

	$mode = $_POST['mode'];

	if ($mode == 'save')
		parse_str($_POST['data'], $output);
	else
		$output = array();

	$options = array();

	foreach ($THEMEREX_options as $field){
		if (!isset($field['std'])) continue;	// Non data option
		$id = $field['id'];
		if ($mode == 'save') {
			// Prepare specific (combined) fields
			if (!empty($field['subset'])) {
				$sbs = $output[$field['subset']];
				$field['val'][$sbs] = $output[$id];
				$output[$id] = $field['val'];
			}
			if ($field['type']=='socials') {
				if (!empty($field['cloneable'])) {
					foreach($output[$id] as $k=>$v)
						$output[$id][$k] = array('url'=>stripslashes($v), 'icon'=>stripslashes($output[$id.'_icon'][$k]));
				} else {
					$output[$id] = array('url'=>stripslashes($output[$id]), 'icon'=>stripslashes($output[$id.'_icon']));
				}
			} else if (isset($output[$id])) {
				if (is_array($output[$id])) {
					foreach($output[$id] as $k=>$v)
						$output[$id][$k] = stripslashes($v);
				} else
					$output[$id] = stripslashes($output[$id]);
			} else
				$output[$id] = $type == 'checkbox' ? 'false' : '';
			// Add cloneable index
			if (!empty($field['cloneable'])) {
				$rez = array();
				foreach($output[$id] as $k=>$v)
					$rez[$output[$id.'_numbers'][$k]] = $v;
				$output[$id] = $rez;
			}
			$new_value = $output[$id];
		} else {
			$new_value = $field['std'];
		}
		$options[$id] = $new_value;
	}
	update_option('themerex_options', $options);
	
	die();
}
?>