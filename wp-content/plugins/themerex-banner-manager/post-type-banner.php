<?php

// Register Custom Post Type
function post_type_banner() {

	$labels = array(
		'name'                => _x( 'Banners', 'Post Type General Name', 'themerex' ),
		'singular_name'       => _x( 'Banner', 'Post Type Singular Name', 'themerex' ),
		'menu_name'           => __( 'Banners', 'themerex' ),
		'parent_item_colon'   => __( 'Parent Item:', 'themerex' ),
		'all_items'           => __( 'All Banners', 'themerex' ),
		'view_item'           => __( 'View Item', 'themerex' ),
		'add_new_item'        => __( 'Add New Banner', 'themerex' ),
		'add_new'             => __( 'Add New', 'themerex' ),
		'edit_item'           => __( 'Edit Item', 'themerex' ),
		'update_item'         => __( 'Update Item', 'themerex' ),
		'search_items'        => __( 'Search Item', 'themerex' ),
		'not_found'           => __( 'Not found', 'themerex' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'themerex' ),
	);
	$args = array(
		'label'               => __( 'banner', 'themerex' ),
		'description'         => __( 'Banner Description', 'themerex' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'menu_icon'			  => 'dashicons-analytics',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'banner', $args );

}

add_action( 'init', 'banner_author_taxonomy', 0 );
function banner_author_taxonomy() {
	$labels = array(
		'name'              => _x( 'Banner Author', 'taxonomy general name' ),
		'singular_name'     => _x( 'Author', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Authors', 'themerex' ),
		'all_items'         => __( 'All Authors', 'themerex' ),
		'parent_item'       => __( 'Parent Author', 'themerex' ),
		'parent_ite m_colon' => __( 'Parent Author:', 'themerex' ),
		'edit_item'         => __( 'Edit Author', 'themerex' ),
		'update_item'       => __( 'Update Author', 'themerex' ),
		'add_new_item'      => __( 'Add New Author', 'themerex' ),
		'new_item_name'     => __( 'New Author Name', 'themerex' ),
		'menu_name'         => __( 'Banner Author', 'themerex' ),
	);
	
	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'banner_author' ),
	);
	register_taxonomy( 'banner_author', array( 'banner' ), $args );
}

add_action( 'init', 'banner_group_taxonomy', 0 );
function banner_group_taxonomy() {
	$labels = array(
		'name'              => _x( 'Banner Group', 'taxonomy general name' ),
		'singular_name'     => _x( 'Group', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Groups', 'themerex' ),
		'all_items'         => __( 'All Groups', 'themerex' ),
		'parent_item'       => __( 'Parent Group', 'themerex' ),
		'parent_ite m_colon' => __( 'Parent Group:', 'themerex' ),
		'edit_item'         => __( 'Edit Group', 'themerex' ),
		'update_item'       => __( 'Update Group', 'themerex' ),
		'add_new_item'      => __( 'Add New Group', 'themerex' ),
		'new_item_name'     => __( 'New Group Name', 'themerex' ),
		'menu_name'         => __( 'Banner Group', 'themerex' ),
	);
	
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'banner_group' ),
	);
	register_taxonomy( 'banner_group', array( 'banner' ), $args );
}
	

function themerex_get_meta_box() {
	$meta_box_banner = array(
		'id' => 'banner-meta-box',
		'title' => 'Banner Options',
		'page' => 'banner',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(		
			array(
				'name' => __('Banner Shortcode', 'themerex'),
				'desc' => __('Copy shortcode of this banner and place it anywhere (post, page, text widget, etc).', 'themerex'),
				'id' => 'banner_shortcode',
				'std' => '',
				'type' => 'info',
			),
			array(
				'name' => __('Banner Link URL:&nbsp;', 'themerex'),
				'desc' => __('Enter here url for banner link:', 'themerex'),
				'id' => 'banner_url',
				'type' => 'text',
				'std' => ''
			),
			array(
				'name' => __('Banner &lt;head&gt; Code:', 'themerex'),
				'desc' => __('Put here any code that need to be placed in &lt;head&gt;:', 'themerex'),
				'id' => 'banner_head',
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'name' => __('Banner Show Period From:&nbsp;', 'themerex'),
				'desc' => __('Banner Period to display from:', 'themerex'),
				'id' => 'display_from',
				'type' => 'date',
				'std' => ''
			),
			array(
				'name' => __('Banner Show Period Till:&nbsp;', 'themerex'),
				'desc' => __('Banner Period to display till:', 'themerex'),
				'id' => 'display_till',
				'type' => 'date',
				'std' => ''
			),
			array(
				'name' => __('Banner Width', 'themerex'),
				'desc' => __('Banner block width:', 'themerex'),
				'id' => 'banner_width',
				'type' => 'slider',
				'min' => '50',
				'max' => '1000',
				'std' => 'auto'
			),
			array(
				'name' => __('Banner Height', 'themerex'),
				'desc' => __('Banner block height:', 'themerex'),
				'id' => 'banner_height',
				'type' => 'slider',
				'min' => '50',
				'max' => '1000',
				'std' => 'auto'
			),
			array(
				'name' => __('Impressions', 'themerex'),
				'desc' => __('Banner show number', 'themerex'),
				'id' => 'banner_show',
				'type' => 'text',
				'std' => '100'
			),
			array(
				'name' => __('Banner Hover Image', 'themerex'),
				'desc' => __( 'Upload banner image that will shows on hover.', 'themerex' ),
				'id' => 'banner_hover_image',
				'type' => 'mediamanager',
                'media_field_id' => 'banner_hover_image',
				'multiple' => false,
				'std' => ''
			)
		)
	);
	return $meta_box_banner;
}

add_action('admin_menu', 'add_meta_box_banner');
// Add meta box
function add_meta_box_banner() {

	$meta_box_banner = themerex_get_meta_box();
	add_meta_box($meta_box_banner['id'], $meta_box_banner['title'], 'show_meta_box_banner', $meta_box_banner['page'], $meta_box_banner['context'], $meta_box_banner['priority']);
}

// Callback function to show fields in meta box
function show_meta_box_banner() {

	$meta_box_banner = themerex_get_meta_box();
	global $post;
	$c = new ThemerexBanner;
	
	echo '<input type="hidden" name="meta_box_post_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table>';
	foreach ($meta_box_banner['fields'] as $key => $field) {
		
		$post_field_val = get_post_meta($post->ID, $field['id'], true);
		$meta = !empty($post_field_val) || $post_field_val == 0 ? $post_field_val : $field['std'];
		switch ($field['type']) {
			case 'text':
				if($field['id'] == 'banner_show') {
					$meta = $meta == 100000 ? '' : $meta;
				}
				echo '<tr><td><label for="'.$field['id'].'">'.$field['name'].'</label></td><td><input type="text" name="', $field['id'], '" id="', $field['id'], '" value="'. $meta. '" size="30" />
					<br><small>'.$field['desc'].'</small>
				</td></tr>';
			break;
			
			case 'textarea':
				echo '<tr><td><label for="'.$field['id'].'">'.$field['name'].'</label></td><td><textarea type="text" name="', $field['id'], '" id="', $field['id'], '" size="30">'.$meta.'</textarea>
					<br><small>'.$field['desc'].'</small>
				</td></tr>';
			break;
			
			case 'date':
				$meta = !empty($meta) ? $c->SQLToDate($meta) : '';
				if($meta == '01.01.1900' || $meta == '01.01.2900') $meta = '';
				wp_enqueue_script( 'jquery-ui-datepicker' );
				wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
 				wp_enqueue_style( 'jquery-ui' ); 
				echo '<tr><td><label for="'.$field['id'].'">'.$field['name'].'</label></td><td><input type="text" name="', $field['id'], '" id="', $field['id'], '" value="'. $meta. '" size="30" class="datepicker" /></td></tr>';
			break;
			
			case 'slider':
				wp_enqueue_script( 'jquery-ui-slider' );
 				wp_enqueue_style( 'jquery-ui' ); 
				echo '<tr><td><label for="'.$field['id'].'">'.$field['name'].'</label></td><td><input type="hidden" name="', $field['id'], '" id="', $field['id'], '" value="'. $meta. '" size="30" /><br />
				
					<div class="slider_wrap"><div class="ui-slider" id="'.$field['id'].'_slider" data-val="'.$meta.'" data-min="'.$field['min'].'" data-max="'.$field['max'].'"></div></div>
					<small class="slider_temp_val">'.$field['desc'].'&nbsp;<strong class="slider_val_display" id="'.$field['id'].'_display">'.$meta.'</strong></small>
					<a href="#" class="button set_auto" data-auto="'.$field['std'].'">'.__('Auto', 'themerex').'</a><br>
				</td></tr>';
			break;
			
			case 'info':
				if(!empty($post)) {
					$post_id = $post->ID;
					echo '<tr>
							<td>
								<label for="'.$field['id'].'">'.$field['name'].'</label></td>
							<td>
								<input type="text" readonly="true" id="'.$field['id'].'" value="'.esc_attr('[trex_banner ids="'.$post_id.'"]').'"><br />
								<small>'.$field['desc'].'</small>
							</td>
						</tr>';
				}
			break;
			case 'mediamanager':
            	echo '<tr>';
            	echo '<td>'.$field['name'].'</td>';
            	echo '<td>';
                wp_enqueue_media();
                echo '<a id="'.$field['id'].'_button" class="button mediamanager"
                data-choose="'.(isset($field['multiple']) && $field['multiple'] ? __( 'Choose Images', 'rex') : __( 'Choose Image', 'themerex')).'"
                data-update="'.(isset($field['multiple']) && $field['multiple'] ? __( 'Add to Gallery', 'themerex') : __( 'Choose Image', 'themerex')).'"
                data-multiple="'.(isset($field['multiple']) && $field['multiple'] ? 'true' : 'false').'"
                data-linked-field="'.$field['media_field_id'].'"
                onclick="showMediaManager(this);"
                >' . (isset($field['multiple']) && $field['multiple'] ? __( 'Choose Images', 'themerex') : __( 'Choose Image', 'themerex')) . '</a>               
	   			<input type="hidden" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'">
	   			<div class="img_holder" id="'.$field['id'].'_holder"><div class="holder_inner">'.(!empty($meta) ? '<img src="'.$meta.'" alt="">' : '').'</div>
	   			<a href="#" class="holder_remove_image'.(!empty($meta) ? ' button_show' : '').'">X</a>
	   			</div>';
	   			echo '</td></tr>';
           break;
			
		}	
	}
	
	echo '</table>';
}

// Hook into the 'init' action
add_action( 'init', 'post_type_banner', 0 );

add_action('save_post', 'save_meta_box_banner');
// Save data from meta box
function save_meta_box_banner($post_id) {
	$c = new ThemerexBanner;
	$meta_box_banner = themerex_get_meta_box();
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
	foreach ($meta_box_banner['fields'] as $key => $field) {
		$new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';
		
		if(	$field['type'] == 'date' ) {
			if($field['id'] == 'display_from') {
				if(empty($new))
					$new = '01/01/1900';
			}
			else if ($field['id'] == 'display_till') {				
				if(empty($new))
					$new = '01/01/2900';	
			}			
			$new = $c->DateToSQL($new);
		} else if($field['type'] == 'text') {
			if($field['id'] == 'banner_show') {
				$new = empty($new) ? 100000 : $new;
			}
		}
		update_post_meta($post_id, $field['id'], $new);
	}
}
?>