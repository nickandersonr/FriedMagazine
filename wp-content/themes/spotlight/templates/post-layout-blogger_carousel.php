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
		. '<a href="'.$post_data['post_link'].'">'
			. $post_data['post_title']
			.'</a>'
	. '</' . $post_title_tag . '>';
$info = '<header class="post_info infoPost sc_accordion_title">';
			$info .= $title;
		$info .='</header>';
$post_thumb = '<div class="post_thumb'.(empty($post_data['post_thumb']) ? ' placeholder' : '').'">'.(!empty($post_data['post_thumb']) ? $post_data['post_thumb'] : '<i class="icon-picture-1"></i>').'</div>';
$colorbox_link = !empty($post_data['post_attachment']) ? '<a href="'.$post_data['post_attachment'].'" class="colorbox_link"><i class="icon-search"></i></a>' : '';
$post_link = !empty($post_data['post_link']) ? '<a href="'.$post_data['post_link'].'"><i class="icon-link"></i></a>' : '';
		
?>
<article class="sc_blogger_item<?php
	echo  ($opt['number'] == $opt['posts_on_page'] ? ' sc_blogger_item_last' : '')?> swiper-slide"<?php echo $opt['dir'] == 'horizontal' && $opt['style'] == 'date' ? ' style="width:'.(100/$opt['posts_on_page']).'%"' : ''; ?>>
	<?php echo $post_thumb; ?>
	<div class="post_hover_overlay">
		<div class="overlay_mask"></div>
		<div class="table_inner">
			<?php echo $title; ?>
			<div class="post_links">
				<?php echo !empty($post_link) ? $post_link : ''; ?>
				<?php echo !empty($colorbox_link) ? $colorbox_link : ''; ?>
			</div>
		</div>
	</div>
</article>