<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'widget_popular_posts_load' );

/**
 * Register our widget.
 */
function widget_popular_posts_load() {
	register_widget('themerex_popular_posts_widget');
}

/**
 * Most popular and commented Widget class.
 */
class themerex_popular_posts_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function themerex_popular_posts_widget() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_popular_posts', 'description' => __('The most popular and most commented blog posts (extended)', 'themerex'));

		/* Widget control settings. */
		$control_ops = array('width' => 200, 'height' => 250, 'id_base' => 'themerex-popular-posts-widget');

		/* Create the widget. */
		$this->WP_Widget('themerex-popular-posts-widget', __('ThemeREX - Most Popular & Commented Posts', 'themerex'), $widget_ops, $control_ops);
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		extract($args);

		global $wp_query, $post;

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		$title_tabs = array(
			apply_filters('widget_title', isset($instance['title_latest']) ? $instance['title_latest'] : ''),
			apply_filters('widget_title', isset($instance['title_popular']) ? $instance['title_popular'] : ''),
			apply_filters('widget_title', isset($instance['title_commented']) ? $instance['title_commented'] : '')
		);
		$title_tabs = array_filter($title_tabs);
		$title_length = isset($instance['title_length']) ? (int) $instance['title_length'] : 0;
		$number = isset($instance['number']) ? (int) $instance['number'] : '';
		$show_info = isset($instance['show_info']) ? $instance['show_info'] : 0;
		$show_rating = isset($instance['show_rating']) ? (int) $instance['show_rating'] : 0;
		$show_cats = isset($instance['show_cats']) ? (int) $instance['show_cats'] : 0;
		$category = isset($instance['category']) ? (int) $instance['category'] : 0;
		$post_thumb = isset($instance['post_thumb']) ? $instance['post_thumb'] : 'hide';

		$output = $tabs = '';
		$titles_str = implode('', $title_tabs);

		for ($i=0; $i<3; $i++) {
			if(!empty($title_tabs[$i]) || ($i == 0 && strlen($titles_str) == 0)) {
				$args = array(
					'post_type' => 'post',
					'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
					'post_password' => '',
					'posts_per_page' => $number,
					'ignore_sticky_posts' => 1,
					'order' => 'DESC',
				);
				if ($i==0) {		// Latest
					$args['orderby'] = 'date';
					$args['order'] = 'DESC';
				} else if($i == 1) {		// Most popular
					$args['meta_key'] = 'post_views_count';
					$args['orderby'] = 'meta_value_num';
				}
				else {		// Most commented
					$args['orderby'] = 'comment_count';
				}
				if ($category > 0) {
					$args['cat'] = $category;
				}
				$ex = get_theme_option('exclude_cats');
				if (!empty($ex)) {
					$args['category__not_in'] = explode(',', $ex);
				}
				query_posts($args);
				
				/* Loop posts */
				if (have_posts()) {
					$abc_range = range('a', 'z');
					$abc_shuffle = str_shuffle(implode('', $abc_range));
					
					$unikey = substr($abc_shuffle, 10);
					if(count($title_tabs) > 1)
						$tabs .= '<li><a href="#widget_popular_' . $i.'_'.$unikey .  '" class="theme_button"><span>'.$title_tabs[$i].'</span></a></li>';
					$output .= '
						<div class="tab_content style_'.$post_thumb.'" id="widget_popular_' . $i.'_'.$unikey . '">
					';
					$post_number = 0;
					while (have_posts()) {
						the_post();
		
						$post_number++;
				
						$post_id = get_the_ID();
						$post_date = getDateOrDifference(get_the_date('Y-m-d H:i:s'));
						$post_title = $post->post_title;						
						$post_title = !empty($title_length) ? getShortString($post_title, $title_length, '...') : $post_title;
						$post_link = get_permalink();
						$post_custom   = get_post_custom($post_id);
						$post_comments = wp_count_comments($post_id);
						$post_comments_link = '<a href="'.$post_link.'#comments"><i class="icon-comment-1"></i>'.$post_comments->approved.'</a>';
						$post_votes    = !empty($post_custom['post_votes_data']) ? $post_custom['post_votes_data'] : '';
						$votes_data    = !empty($post_votes[0]) ? unserialize($post_votes[0]) : '';
						$crit_points   = !empty($votes_data['criterias_points']) ? $votes_data['criterias_points'] : '';
						$total_votes   = !empty($votes_data['total_votes']) ? $votes_data['total_votes'] : '';
						$votes_sum 	   = !empty($crit_points) ? array_sum($crit_points) : '';
						$votes_avg 	   = (!empty($votes_sum) && !empty($total_votes)) ? $votes_sum / $total_votes : '';
						$votes_avg 	   = !empty($votes_avg) ? number_format($votes_avg, 0) : '';
						$cust_opt 	   = !empty($post_custom['post_custom_options'][0]) ? unserialize($post_custom['post_custom_options'][0]) : '';
						$author_review = !empty($cust_opt['reviews_marks']) ? explode(',', $cust_opt['reviews_marks']) : '';
						$author_avg    = count($author_review) > 0 ? number_format(array_sum($author_review) / count($author_review), 0) : 0;
						$post_format = get_post_format($post_id);
						$post_format = $post_format == false ? 'standard' : $post_format;
						$format_icon = getPostFormatIcon($post_format);
						
						$avg_arr = array();
						$avg_arr[] = !empty($author_avg) ? $author_avg : '';
						$avg_arr[] = !empty($votes_avg) ? $votes_avg : '';
						$avg_arr = array_filter($avg_arr);
						$total_avg = count($avg_arr) > 0 ? array_sum($avg_arr) / count($avg_arr) : '';
						$post_categories_links = '';
						if($show_cats) {
							$post_categories_list = getCategoriesByPostId($post_id);
							$ex_cats = explode(',', get_theme_option('exclude_cats'));
							$cat_count = count($post_categories_list);
							
							for ($c = 0; $c < $cat_count; $c++) {
								if (in_array($post_categories_list[$c]['term_id'], $ex_cats)) continue;
								$post_categories_ids[] = $post_categories_list[$c]['term_id'];
								
								$category_color = get_category_inherited_property($post_categories_list[$c]['term_id'], 'category_color');
								if(empty($category_color)) {
									$category_color = get_theme_option('category_color');
								}
								
								$post_categories_links .= '<a class="cat_link" href="' . $post_categories_list[$c]['link'] . '"'.(!empty($category_color) ? ' style="background:'.$category_color.'"' : '').'	>'
									. $post_categories_list[$c]['name']
									. '</a>';
								$post_categories_links .= count($post_categories_list) > 1 && $c+1 == $cat_count ? '<br>' : '';
							}
						}
						$review = '';
						if(!empty($total_avg) && $show_rating) {
							$review = get_review_rating('5stars', min($total_avg, 100), 100, '#f2c574');
						}
						$post_info = '';
						$post_info .= !empty($show_info) ? '<div class="widget_popular_post_info">'.$post_categories_links
														.(!empty($review) ? $review : '')
														.'<span class="post_date"><i class="icon-clock-1"></i>'.$post_date.'</span>'
														.'<span class="divider">|</span>'.$post_comments_link
														.'</div>' : '';
						
						$output .= '
							<div class="post_item' . ($post_number==1 ? ' first' : '') . (!empty($post_thumb) ? ' thumb_style_'.$post_thumb : ''). '">
						';
						$thumb_size = $post_thumb == 'large_thumb' ? 100 : 64;
						if (in_array($post_thumb, array('large_thumb', 'default_thumb'))) {
							$post_thumbnail = getResizedImageTag($post_id, $thumb_size, $thumb_size);
							if ($post_thumbnail) {
								$output .= '
										<div class="post_thumb image_wrapper">' . $post_thumbnail . '</div>
								';
							}
						}
						else if($post_thumb == 'post_format') {
							$output .= '<i class="'.$format_icon.' format-icon"></i>';
						}
						$output .= '
										<div class="post_wrapper">
											<h5 class="post_title theme_title"><a href="' . $post_link . '">' . $post_title . '</a></h5>
						';
						
						$output .= $post_info.'
								</div>
							</div>
						';
						if ($post_number >= $number) break;
					}
					$output .= '
						</div>';
				}
			}
		}


		/* Restore main wp_query and current post data in the global var $post */
		wp_reset_query();
		wp_reset_postdata();

		
		if (!empty($output)) {
	
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
	
			/* Before widget (defined by themes). */			
			echo $before_widget;		
			
			/* Display the widget title if one was input (before and after defined by themes). */
			if ($title) echo $before_title . $title . $after_title;		
	
			echo '
				<div class="popular_and_commented_tabs'.($show_info || $show_rating ? '' : ' flat_list').'">
					'.((strlen($titles_str) != 0 && count($title_tabs) > 1) ? '<ul class="tabs">' . $tabs . '</ul>' : '').'
					' . $output . '
					<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(\'.popular_and_commented_tabs\').tabs();
						});
					</script>
				</div>
			';
			
			/* After widget (defined by themes). */
			echo $after_widget;
		}
	}

	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags for title and comments count to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_length'] = strip_tags($new_instance['title_length']);
		$instance['title_popular'] = strip_tags($new_instance['title_popular']);
		$instance['title_commented'] = strip_tags($new_instance['title_commented']);
		$instance['title_latest'] = strip_tags($new_instance['title_latest']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_info'] = $new_instance['show_info'];
		$instance['show_image'] = (int) $new_instance['show_image'];
		$instance['show_rating'] = (int) $new_instance['show_rating'];
		$instance['show_cats'] = (int) $new_instance['show_cats'];
		$instance['category'] = (int) $new_instance['category'];
		$instance['post_thumb'] = $new_instance['post_thumb'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
 		/* Set up some default widget settings. */
		$defaults = array('title' => '', 'title_popular' => '', 'title_commented' => '', 'title_latest' => '', 'number' => '4', 'show_info' => '1', 'show_image' => '1', 'show_rating' => '1', 'category'=>'0', 'description' => __('The most popular & commented posts', 'themerex'));
		$instance = wp_parse_args((array) $instance, $defaults); 
		$title = isset($instance['title']) ? $instance['title'] : '';
		$title_length = isset($instance['title_length']) ? $instance['title_length'] : '';
		$title_popular = isset($instance['title_popular']) ? $instance['title_popular'] : '';
		$title_commented = isset($instance['title_commented']) ? $instance['title_commented'] : '';
		$title_latest = isset($instance['title_latest']) ? $instance['title_latest'] : '';
		$number = isset($instance['number']) ? $instance['number'] : '';
		$post_thumb = isset($instance['post_thumb']) ? $instance['post_thumb'] : 'hide';
		$show_info = isset($instance['show_info']) ? $instance['show_info'] : '1';
		$show_image = isset($instance['show_image']) ? $instance['show_image'] : '1';
		$show_rating = isset($instance['show_rating']) ? $instance['show_rating'] : '1';
		$show_cats = isset($instance['show_cats']) ? $instance['show_cats'] : '0';
		$category = isset($instance['category']) ? $instance['category'] : '0';
		$categories = getCategoriesList(false);
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget title:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" style="width:100%;" />
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id('title_length'); ?>"><?php _e('Title Maximum Length:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" value="<?php echo $title_length; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title_popular'); ?>"><?php _e('Most popular tab title:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id('title_popular'); ?>" name="<?php echo $this->get_field_name('title_popular'); ?>" value="<?php echo $title_popular; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title_commented'); ?>"><?php _e('Most commented tab title:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id('title_commented'); ?>" name="<?php echo $this->get_field_name('title_commented'); ?>" value="<?php echo $title_commented; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title_latest'); ?>"><?php _e('Latest tab title:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id('title_latest'); ?>" name="<?php echo $this->get_field_name('title_latest'); ?>" value="<?php echo $title_latest; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'themerex'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:100%;">
				<option value="0"><?php _e('-- Any category --', 'themerex'); ?></option> 
			<?php
				foreach ($categories as $cat_id => $cat_name) {
					echo '<option value="'.$cat_id.'"'.($category==$cat_id ? ' selected="selected"' : '').'>'.$cat_name.'</option>';
				}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('post_thumb'); ?>"><?php _e('Show Post Thumbnail:', 'themerex'); ?></label>
			<select id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>" style="width:100%;">
				<option <?php echo $post_thumb == 'default_thumb' ? ' selected="selected"' : '' ?> value="default_thumb"><?php echo __('Show Default Thumbnail (32x32px)', 'themerex'); ?></option>
				<option <?php echo $post_thumb == 'large_thumb' ? ' selected="selected"' : '' ?> value="large_thumb"><?php echo __('Show Large Thumbnail (50x50px)', 'themerex'); ?></option>
				<option <?php echo $post_thumb == 'post_format' ? ' selected="selected"' : '' ?> value="post_format"><?php echo __('Show post-format icon instead thumbnail', 'themerex'); ?></option>
				<option <?php echo $post_thumb == 'hide' ? ' selected="selected"' : '' ?> value="hide"><?php echo __('Hide thumbnail', 'themerex'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number posts to show:', 'themerex'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('show_info'); ?>_1"><?php _e('Show post info:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo $this->get_field_id('show_info'); ?>_1" name="<?php echo $this->get_field_name('show_info'); ?>" value="1" <?php echo $show_info==1 ? ' checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id('show_info'); ?>_1"><?php _e('Show', 'themerex'); ?></label>
			<input type="radio" id="<?php echo $this->get_field_id('show_info'); ?>_0" name="<?php echo $this->get_field_name('show_info'); ?>" value="0" <?php echo $show_info==0 ? ' checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id('show_info'); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('show_rating'); ?>_1"><?php _e('Show post review rating:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo $this->get_field_id('show_rating'); ?>_1" name="<?php echo $this->get_field_name('show_rating'); ?>" value="1" <?php echo $show_rating==1 ? ' checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id('show_rating'); ?>_1"><?php _e('Show', 'themerex'); ?></label>
			<input type="radio" id="<?php echo $this->get_field_id('show_rating'); ?>_0" name="<?php echo $this->get_field_name('show_rating'); ?>" value="0" <?php echo $show_rating==0 ? ' checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id('show_rating'); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('show_cats'); ?>_1"><?php _e('Show post categories:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo $this->get_field_id('show_cats'); ?>_1" name="<?php echo $this->get_field_name('show_cats'); ?>" value="1" <?php echo $show_cats==1 ? ' checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id('show_cats'); ?>_1"><?php _e('Show', 'themerex'); ?></label>
			<input type="radio" id="<?php echo $this->get_field_id('show_cats'); ?>_0" name="<?php echo $this->get_field_name('show_cats'); ?>" value="0" <?php echo $show_cats==0 ? ' checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id('show_cats'); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

	<?php
	}
}

?>