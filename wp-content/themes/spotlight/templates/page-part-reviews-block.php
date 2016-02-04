<?php
// Reviews block
global $THEMEREX_REVIEWS_RATING;
$THEMEREX_REVIEWS_RATING = '';
if ($avg_author > 0 || $avg_users > 0) {
	$reviews_first_author = get_theme_option('reviews_first')=='author';
	$reviews_second_hide = get_theme_option('reviews_second')=='hide';
	$criterias_list = get_custom_option('reviews_criterias');
	if(count($criterias_list) <= 1)
		$use_tabs = false;
	else
		$use_tabs = !$reviews_second_hide; // && $avg_author > 0 && $avg_users > 0;
	if ($use_tabs) wp_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
	$maxLevel = max(5, (int) get_custom_option('reviews_max_level'));
	$allowUserReviews = (!$reviews_first_author || !$reviews_second_hide) && (!isset($_COOKIE['reviews_vote']) || themerex_strpos($_COOKIE['reviews_vote'], ','.$post_data['post_id'].',')===false) && (get_theme_option('reviews_can_vote')=='all' || is_user_logged_in());
	$THEMEREX_REVIEWS_RATING = '<div class="reviewBlock'.($use_tabs ? ' sc_tabs' : '').(count($criterias_list) <= 1 ? ' singleCriteria' : '').'">';
	
	/* Fetching data */
		/* Author votes data */
	$vote_max = get_custom_option('reviews_max_level');
	$post_custom_options = get_post_meta($post_data['post_id'], 'post_custom_options', true);
	$votes_list = explode(',', $post_custom_options['reviews_marks']);
	$author_avg = array_sum($votes_list) / count($votes_list);
	$author_avg_to_view = marksToDisplay($author_avg, $vote_max);
		/**/
		
		/* Users votes data  */
	$post_votes_data = get_post_meta($post_data['post_id'], 'post_votes_data', true);
	
	if(empty($post_votes_data)) {
		foreach ($criterias_list as $criteria) {
			$post_votes_data['criterias_points'][$criteria] = 0;
		}
		$post_votes_data['total_votes'] = 1;
	}
	
	$user_total_votes = $post_votes_data['total_votes'];
	$user_criteria_points = $post_votes_data['criterias_points'];
	$user_votes_avg = array();
	foreach ($user_criteria_points as $criteria => $points) {
		$user_votes_avg[$criteria] = $points/$user_total_votes;
	}		
	$width = 137;
	$user_reviews_output = trex_vote_results($user_votes_avg, $vote_max, $width);
	$user_reviews_avg = array_sum($user_votes_avg) / count($user_criteria_points);
	$user_reviews_avg_to_view = marksToDisplay($user_reviews_avg, $vote_max);
	$user_reviews_output .= trex_avg_total_score($user_reviews_avg_to_view, $user_reviews_avg);
		/**/
	$criteria_points = array();
	foreach ($criterias_list as $key => $criteria) {
		$criteria_points[$criteria] = $votes_list[$key];
	}
	if($use_tabs)
		$users_total_block = trex_avg_total_score($author_avg_to_view, $author_avg);
	$author_short_decs = '<div class="short_descr">'.getShortString(strip_tags($post_data['post_excerpt']), 100).'</div>';
	$author_full_decs = '<div class="full_descr">'.$post_data['post_excerpt'].'</div>';
	$user_short_desc = '<div class="short_descr">This section displays an average rating from all users according to specified criteria. Total number of ratings '.$user_total_votes.'</div>';
	$user_reviews_output .= $user_short_desc;
	/**/
	
	$output = $marks = $users = '';
	if ($use_tabs) {
		$author_tab = '<li class="squareButton"><a href="#author-tabs"><span>'.$author_avg_to_view.'</span>'.__('Editor rating', 'themerex').'</a></li>';
		$users_tab = '<li class="squareButton"><a href="#users-tabs"><span>'.$user_reviews_avg_to_view.'</span>'.__('Users rating', 'themerex').'</a></li>';
		$output .= '<div class="popularFiltr"><ul>' . ($reviews_first_author ? $author_tab . $users_tab : $users_tab . $author_tab) . '</ul></div>';
	}
	// Criterias list
	$author_reviews_output = trex_vote_results($criteria_points, $vote_max, $width);
	$author_reviews_output .= !empty($users_total_block) ? $users_total_block : '';
	
	$output .= '<div class="ratingStars" id="author-tabs"><div class="tab_block_inner">' . $author_reviews_output . (count($criterias_list) <= 1 ? $author_full_decs : $author_short_decs) .'</div></div>';
	// Users marks
	if ((!$reviews_first_author || !$reviews_second_hide) && $use_tabs) {		
		$output .= '<div class="ratingStars" id="users-tabs"'.(!$output ? ' style="display: block;"' : '') . '>' . $user_reviews_output . '</div>';
	}
	$THEMEREX_REVIEWS_RATING .= $output
		. '</div>';
	//if (get_custom_option('show_sidebar_main') == 'fullwidth') {
		echo $THEMEREX_REVIEWS_RATING;
		echo count($criterias_list) == 1 ? '<div class="sc_divider"></div>' : '';
		$THEMEREX_REVIEWS_RATING = '';
//	}
}
?>