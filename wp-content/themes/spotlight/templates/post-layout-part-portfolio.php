<?php

/* Template for default single portfolio post */

$mult = get_custom_option('retina_ready');
$post_data['post_views']++;
$post_thumb = '<img src="'.getResizedImageUrl($post_data['post_attachment'], 521*$mult, 289*$mult, true).'" alt="">';
$post_title = '<h2>'.$post_data['post_title'].'</h2>';
$post_info = '<header class="post_info infoPost">';
			$post_info .= $post_title;
			
				$post_info .= '<div class="subheader">';
					
				if ($post_data['post_categories_links']!='') {
					$post_info .= '<span class="post_cats filled">'.$post_data['post_categories_links'].'</span>';
				}
				$post_info .= __('By', 'themerex').'&nbsp;'.$post_data['post_author'];
				$post_info .= '<span class="separator">|</span>';
				$post_info .= '<span class="icon-clock-1"></span>'.$post_data['post_date'];
				if($post_data['post_comments'] != 0) :
					$post_info .= '<span class="separator">|</span>
	 				<a class="icon-comment-1" title="'.sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']).'" href="'.$post_data['post_comments_link'].'">'.$post_data['post_comments'].'</a>';
	 			endif;
		 		$post_info .= '</div>';
		$post_info .='</header>';
$post_excerpt = '<div class="post_content">'.$post_data['post_excerpt'].'</div>';
$post_id = $post_data['post_id'];
$post_link = '<a class="trex_more_link" href="'.get_permalink($post_id).'">'.__('View post', 'themerex').'</a>';

?>

<div class="isotopeElement appended itemscope" itemscope itemtype="http://schema.org/">
	<span class="close_button"></span>
	<?php
		if($post_data['post_format'] != 'video')
			echo !empty($post_data['post_gallery']) ? '<div class="post_thumb post_gallery">'.$post_data['post_gallery'].'</div>' : '<div class="post_thumb">'.$post_thumb.'</div>';
		else {
			echo !empty($post_data['post_video']) ? '<div class="post_thumb">'.$post_data['post_video'].'</div>' : '';
		}
	?>
	<div class="extra_wrap">
		<?php echo $post_info;
			  echo $post_excerpt;
			  echo $post_link;
		?>
	</div>
</div><!-- .itemscope -->