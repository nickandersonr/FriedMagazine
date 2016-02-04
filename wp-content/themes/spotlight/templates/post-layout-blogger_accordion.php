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

$type_hover = $style != 'default' ? ($post_data['post_format'] == 'video' ? '<span class="sc_video_play_button small"></span>' : '<span class="hover_plus"></span>') : '';
/* /Reviews */

$title = '<' . $post_title_tag . ' class="sc_blogger_title sc_title">'
		. '<a href="#">'
			. $post_data['post_title']
		. '<i class="icon-left-open"></i></a>'
	. '</' . $post_title_tag . '>';

$info = '<header class="post_info infoPost sc_accordion_title">';
			$info .= $title;
		$info .='</header>';
?>
<article class="sc_blogger_item<?php
	echo  (in_array($opt['style'], array('accordion')) ? ' sc_accordion_item' : '')
		. ($opt['number'] == $opt['posts_on_page'] ? ' sc_blogger_item_last' : '')
		. (sc_param_is_on($opt['scroll']) && ($opt['dir'] == 'vertical' || $opt['style'] == 'date') ? ' sc_scroll_slide swiper-slide' : '')
		. ($border == "true" ? ' border' : '');
		?>"<?php echo $opt['dir'] == 'horizontal' && $opt['style'] == 'date' ? ' style="width:'.(100/$opt['posts_on_page']).'%"' : ''; ?>>

	<?php
	echo $info;
	if(!empty($post_data['post_excerpt'])) {
	?>
		<div class="sc_accordion_content">
		<?php
		echo '<h5><a href="'.$post_data['post_link'].'">'.$post_data['post_title'].'</a></h5>';
		if (!empty($post_data['post_excerpt']) && $opt['descr'] > 0) {
			$post_data['post_excerpt'] = trim(chop($post_data['post_excerpt']));
			if (!in_array($post_data['post_format'], array('quote', 'link')) && themerex_strlen($post_data['post_excerpt']) > $opt['descr']) {
				$post_data['post_excerpt'] = getShortString(strip_tags($post_data['post_excerpt']), $opt['descr'], $opt['readmore'] ? '' : '...');
			}
			if(substr($post_data['post_excerpt'], -1) == '.') {
				$post_data['post_excerpt'] = trim($post_data['post_excerpt'], '.');
			}
			echo strip_tags($post_data['post_excerpt']);
		}
		?>
		</div>
		<?php
	}
	?>
</article>