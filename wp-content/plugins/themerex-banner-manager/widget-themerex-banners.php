<?php
/**
 * Widget_Banners widget class
 *
 * @since 1.0
 */
add_action( 'widgets_init', 'themerex_banners_widget' );

function themerex_banners_widget() {
	register_widget( 'My_Widget_Banners' );
}
 
class My_Widget_Banners extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_banners', 'description' => __( 'Themerex Widget Banner' , 'themerex') );
		parent::__construct('themerex-banners', __('Widget Banners', 'themerex'), $widget_ops);
		$this->alt_option_name = 'widget_banners';
	}
	
	function widget( $args, $instance ) {
	
		global $post;
		$c = new ThemerexBanner();
		
		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

 		extract($args, EXTR_SKIP);
 		
 		$ids = !empty($instance['ids']) ? $instance['ids'] : '';
 		$group = !empty($instance['group']) ? $instance['group'] : '';
 		$author = !empty($instance['author']) ? $instance['author'] : '';
 		$count = !empty($instance['count']) ? $instance['count'] : '';
 		
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '' );
 		$output = '';
		$output .= $before_widget;
		if ($title) $output .= $before_title . $title . $after_title;
 		$output .= $c->trex_banner_request($ids, $group, $author, $count);				 				 				 				 				 				 		
		$output .= $after_widget;
		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['ids'] = strip_tags($new_instance['ids']);
		$instance['group'] = strip_tags($new_instance['group']);
		$instance['author'] = strip_tags($new_instance['author']);
		
		if ( isset($alloptions['themerex_banners_widget']) )
			delete_option('themerex_banners_widget');

		return $instance;
	}

	function form( $instance ) {
		$title 	= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count 	= isset( $instance['count'] ) ? esc_attr( $instance['count'] ) : '';
		$ids 	= isset( $instance['ids'] ) ? esc_attr( $instance['ids'] ) : '';
		$group 	= isset( $instance['group'] ) ? esc_attr( $instance['group'] ) : '';
		$author = isset( $instance['author'] ) ? esc_attr( $instance['author'] ) : '';
		
		$term_args = array(
			'orderby'           => 'name',
			'order'             => 'ASC',
			'hide_empty'        => true,
			'number'            => '',
			'fields'            => 'all',
			'slug'              => '',
			'parent'            => '',
			'hierarchical'      => true,
			'child_of'          => 0,
			'get'               => '',
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false,
			'offset'            => '',
			'search'            => ''
		);
		$groups = get_terms('banner_group', $term_args);
		$authors = get_terms('banner_author', $term_args);
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themerex'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Banners Count:', 'themerex'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'ids' ); ?>"><?php _e( 'Banner Ids:', 'themerex'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ids' ); ?>" name="<?php echo $this->get_field_name( 'ids' ); ?>" type="text" value="<?php echo $ids; ?>" />
			<small><?php echo __( 'Banners ids separated by commas', 'themerex' ); ?></small>
		</p>
		<table>
			<tr><td><label for="<?php echo $this->get_field_id( 'group' ); ?>"><?php _e( 'Banners Group:', 'themerex'); ?></label></td>
			<td>
			<select style="width:200px;" name="<?php echo $this->get_field_name( 'group' ); ?>" id="<?php echo $this->get_field_id( 'group' ); ?>">
				<option value=''<?php echo $group == '' ? ' selected="selected"' : ''; ?>></option>
				<?php foreach ($groups as $group_item) {
					echo '<option value="'.$group_item->term_id.'"'.($group_item->term_id == $group ? ' selected="selected"' : '').'>'.$group_item->name.'</option>';
				} ?>
			</select>
			</td>
			</tr>
		
		
			<tr><td><label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e( 'Banners Author:', 'themerex'); ?></label>
			</td>
			<td>
			<select style="width:200px;" name="<?php echo $this->get_field_name( 'author' ); ?>" id="<?php echo $this->get_field_id( 'author' ); ?>">
				<option value=''<?php echo $author == '' ? ' selected="selected"' : ''; ?>></option>
				<?php foreach ($authors as $author_item) {
					echo '<option value="'.$author_item->term_id.'"'.($author_item->term_id == $author ? ' selected="selected"' : '').'>'.$author_item->name.'</option>';
				} ?>
			</select>
			</td>
			</tr></table>
		
<?php
	}
}