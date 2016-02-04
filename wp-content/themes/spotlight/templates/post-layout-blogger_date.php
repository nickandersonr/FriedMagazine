<?php
$post_title_tag = $opt['style']=='list' ? 'li' : 'h4';
$style = $opt['style'];
$border = $opt['border'];

/* Reviews */
$review_type  =	get_custom_option('reviews_first');
$review_avg   = $post_data['post_reviews_'.$review_type];
$review_first = get_custom_option('reviews_first');
$review_max   = get_custom_option('reviews_max_level');
$review_style = get_custom_option('reviews_style');
$review_color = get_custom_option('review_color');

/* /Reviews */

$date_info = '<div class="post_date_info"><span class="day">'.date('d', strtotime($post_data['post_date'])).'</span><span class="month">'.date('M', strtotime($post_data['post_date'])).'</span></div>';
$title = '<' . $post_title_tag 
	. ' class="sc_blogger_title sc_title'
	. (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? ' sc_accordion_title' : '')
	. '">'
		. '<a href="' . (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? '#' : $post_data['post_link']) . '">'
			. (themerex_substr($opt['style'], 0, 6)=='bubble' 
				? '<span class="sc_title_bubble_icon ' . ($post_data['post_icon']!='' ? ' '.$post_data['post_icon'] : '') .'"' 
					. ($post_data['bubble_color']!='' ? ' style="background-color:' . $post_data['bubble_color'] . '"' : '') . '></span>' 
				: '')
			. $post_data['post_title']
		. '</a>'
	. '</' . $post_title_tag . '>';

$info = '<header class="post_info infoPost">';
				$info .= $title;
				$info .= __('By', 'themerex').'&nbsp;<a href="'.$post_data['post_author_url'].'">'.$post_data['post_author'].'</a><span class="separator">|</span>';
				$info .= '<span class="icon-clock-1"></span>'.$post_data['post_date'];
				if(!in_array($style, array('image_medium', 'image_small'))) :
					if($post_data['post_comments'] != 0) :
					$info .= '<span class="separator">|</span>
		 			<a class="icon-comment-1" title="'.sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']).'" href="'.$post_data['post_comments_link'].'">'.$post_data['post_comments'].'</a>';
		 			endif;
		 		endif;
		$info .='</header>';
?>
<article class="sc_blogger_item<?php
	echo  (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? ' sc_accordion_item' : '')
		. ($opt['number'] == $opt['posts_on_page'] ? ' sc_blogger_item_last' : '')
		. (sc_param_is_on($opt['scroll']) && ($opt['dir'] == 'vertical' || $opt['style'] == 'date') ? ' sc_scroll_slide swiper-slide' : '')
		. ($border == "true" ? ' border' : '')
		. ($opt['number'] == $opt['found'] ? ' last' : '');
		?>">

	<?php
	echo $date_info;
	echo $info;
	?>
</article>
<?php
	if ($opt['dir'] == 'horizontal' && $opt['style'] != 'date') {
		echo '</div>';
	}
?>