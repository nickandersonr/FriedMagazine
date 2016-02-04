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
$review_color = get_custom_option('review_color', '', $post_data['post_id']);

$type_hover = $style != 'default' ? ($post_data['post_format'] == 'video' ? '<span class="sc_video_play_button small"></span>' : '<span class="hover_plus"></span>') : '';
$title = '<' . $post_title_tag
	. ' class="sc_blogger_title sc_title'
	. (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? ' sc_accordion_title' : '')
	. '">'
		. '<a href="' . (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? '#' : $post_data['post_link']) . '">'
			. (themerex_substr($opt['style'], 0, 6)=='bubble' 
				? '<span class="sc_title_bubble_icon ' . ($post_data['post_icon']!='' ? ' '.$post_data['post_icon'] : '') .'"' 
					. ($post_data['bubble_color']!='' ? ' style="background-color:' . $post_data['bubble_color'] . '"' : '') . '></span>' 
				: '')
			. (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? '<span class="sc_accordion_icon"></span>' : '') 
			. $post_data['post_title'] 
			. (!in_array($opt['style'], array('accordion_1', 'accordion_2', 'list')) ? '' : $reviewsBlock)
		. '</a>'
	. '</' . $post_title_tag . '>';

$thumb = $post_data['post_thumb'] ? ('<div class="thumb">' . ($post_data['post_link']!='' ? '<a href="'.$post_data['post_link'].'">'.$post_data['post_thumb'].$type_hover.'</a>' : $post_data['post_thumb']) . '</div>')
			: '';

$info = '<header class="post_info infoPost">';
			if($opt['reviews']) {
				if(!empty($review_avg) && !strpos($review_style, 'stars') !== false && $style != 'regular' && $style != 'default')
					$info .= get_review_rating($review_style, $review_avg, $review_max, $review_color);
			}
			$info .= $title;
			
			if($style != 'regular') {
				$info .= '<div class="subheader">';
					
				if ($post_data['post_categories_links']!='') {
					$info .= '<span class="post_cats filled">'.$post_data['post_categories_links'].'</span>';
				}
				if($style == 'image_large')
					$info .= __('By', 'themerex').'&nbsp;<a href="'.$post_data['post_author_url'].'">'.$post_data['post_author'].'</a><span class="separator">|</span>';
				$info .= '<span class="icon-clock-1"></span>'.$post_data['post_date'];
				if(!in_array($style, array('image_medium', 'image_small'))) :
					$info .= '<span class="separator">|</span>
		 			<a class="icon-comment-1" title="'.sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']).'" href="'.$post_data['post_comments_link'].'">'.$post_data['post_comments'].'</a>';
		 		endif;
		 		$info .= '</div>';
		 	}
		$info .='</header>';

if ($opt['dir'] == 'horizontal' && $opt['style'] != 'date') {
	?>
	<div class="columns1_<?php echo $opt['posts_visible']; ?> column_item_<?php echo $opt['number']; ?><?php 
		echo  ($opt['number'] % 2 == 1 ? ' odd' : ' even')
			. ($opt['number'] == 1 ? ' first' : '')
			. ($opt['number'] == $opt['posts_on_page'] ? ' columns_last' : '')
			. (sc_param_is_on($opt['scroll']) ? ' sc_scroll_slide swiper-slide' : '');
			?>">

	<?php
}
?>
<article class="sc_blogger_item<?php
	echo  (in_array($opt['style'], array('accordion_1', 'accordion_2')) ? ' sc_accordion_item' : '')
		. ($opt['number'] == $opt['posts_on_page'] ? ' sc_blogger_item_last' : '')
		. (sc_param_is_on($opt['scroll']) && ($opt['dir'] == 'vertical' || $opt['style'] == 'date') ? ' sc_scroll_slide swiper-slide' : '')
		. (sc_param_is_on($border) ? ' border' : '');
		?>"<?php echo $opt['dir'] == 'horizontal' && $opt['style'] == 'date' ? ' style="width:'.(100/$opt['posts_on_page']).'%"' : ''; ?>>

	<?php
	if(!empty($thumb)) {
		echo $thumb;
	}
	echo $info;
	if(!empty($post_data['post_excerpt'])) {
	?>
		<div class="sc_blogger_content">
		<?php
	
		if (!empty($post_data['post_excerpt']) && $opt['descr'] > 0) {
			$post_data['post_excerpt'] = trim(chop($post_data['post_excerpt']));
			if (!in_array($post_data['post_format'], array('quote', 'link')) && themerex_strlen($post_data['post_excerpt']) > $opt['descr']) {
				$post_data['post_excerpt'] = getShortString(strip_tags($post_data['post_excerpt']), $opt['descr'], $opt['readmore'] ? '' : '...');
			}
			if(substr($post_data['post_excerpt'], -1) == '.') {
				$post_data['post_excerpt'] = trim($post_data['post_excerpt'], '.');
			}
			echo strip_tags($post_data['post_excerpt']).'&nbsp;<a href="'.$post_data['post_link'].'">[...]</a>';
		}
		?>
		</div>
		<?php
	}
	?>
</article>
<?php
	if ($opt['dir'] == 'horizontal' && $opt['style'] != 'date') {
		echo '</div>';
	}