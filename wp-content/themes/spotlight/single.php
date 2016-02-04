<?php
/**
 * The Template for displaying all single posts.
 *
 * @package spotlight
 */

get_header(); 

global $wp_query;

while ( have_posts() ) { the_post();

	// Move setPostViews to the javascript - counter will work under cache system
	if (get_theme_option('use_ajax_views_counter')=='no') {
		setPostViews(get_the_ID());
	}

	clear_dedicated_content();
	
	showPostLayout(
		array(
			'layout' => 'single-standard',
			'thumb_size' => 'single-standard',
			'thumb_crop' => false,
			'sidebar' => !in_array(get_custom_option('show_sidebar_main'), array('none', 'fullwidth'))
		)
	);

}

get_footer();