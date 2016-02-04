<?php

$count = 		 get_custom_option('top_news_count');
$cats  = 		 get_custom_option('top_news_cats') != '' ? explode(',', get_custom_option('top_news_cats')) : '';
$mult  = 		 get_custom_option('retina_ready');
$top_news_title = get_custom_option('top_news_title');
$term_output = '';

if(!empty($cats)) {
	$term_output .= '<div class="top_news_section">';
	$term_output .= '<h3 class="top_news_title">'.$top_news_title.'</h3>';
	foreach ($cats as $cat) {

		$category_color = get_category_inherited_property($cat, 'category_color');
		$category_color = empty($category_color) ? get_theme_option('category_color') : $category_color;
		$cat_term = get_term($cat, 'category');
		$term_name = $cat_term->name;
		$term_output .= '<div class="top_news_term">';
		$term_output .= '<span class="term_name"'.(!empty($category_color) ? ' style="color:'.$category_color.'"' : '').'>'.$term_name.'</span>';

		$args = array(
			'post_type' => 'post',
			'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
			'post_password' => '',
			'posts_per_page' => $count,
			'ignore_sticky_posts' => 1,
			'order' => 'DESC',
			'cat' => $cat
		);
		query_posts($args);
				
		/* Loop posts */
		while (have_posts()) {
			the_post();
			$post_id = get_the_ID();
			$post_link = get_permalink($post_id);
			$post_thumb = getResizedImageTag($post_id, 152*$mult, 152*$mult);
			$post_title = get_the_title($post_id);
			
			$term_output .= '<div class="post_'.$post_id.' top_news_post"><a href="'.$post_link.'">'.$post_thumb.'<span class="top_news_post_title">'.$post_title.'</span></a></div>';
		}		
		$term_output .= '</div>';
	}
	/* Restore main wp_query and current post data in the global var $post */
	wp_reset_query();
	wp_reset_postdata();
	$term_output .= '</div>';
	echo $term_output;
}

?>