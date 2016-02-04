<?php
/*
 * The template for displaying one article of blog streampage with style "Excerpt"
 * 
 * @package spotlight
*/

$post_thumb = getResizedImageUrl($post_data['post_attachment'], '', 400, true);
$thumb_size = getimagesize($post_thumb);
$post_width = round($thumb_size[0]/2);
$post_id = $post_data['post_id'];
$post_title = $post_data['post_title'];
$post_cats = $post_data['post_categories_list'];
$post_format = $post_data['post_format'];

?>
<article class="post isotopeElement divider <?php 
	echo 'format-'.$post_data['post_format'] 
		. ' post'.$opt['post_class']
		. ($opt['number']%2==0 ? ' even' : ' odd') 
		. ($opt['number']==0 ? ' first' : '') 
		. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
		. ($opt['add_view_more'] ? ' viewmore' : '') 
		. (get_custom_option('show_filters')=='yes' 
			? ' flt_'.join(' flt_', get_custom_option('filter_taxonomy')=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
			: '');
	?>" style="width:<?php echo $post_width; ?>px" data-startwidth="<?php echo $post_width; ?>">
	<a href="#" style="background:url(<?php echo $post_thumb ?>) center 0 no-repeat; display:block;" data-post-id="<?php echo $post_id; ?>">
		<?php 
			echo $post_data['post_format'] == 'video' ? '<span class="sc_video_play_button small"></span>' : '<span class="portfolio_hover_icon">+</span>'; 
		?>
		<div class="portfolio_hover">
			<?php echo !empty($post_title) ? '<h4>'.$post_title.'</h4>' : ''; ?>
			<?php
				foreach ($post_cats as $key => $cat) {
					$cat_name = $cat['name'];
					echo '<span class="post_catname">'.$cat_name.'</span>'.($key+1 < count($post_cats) ? '/' : '');
				}
			?>
		</div>
	</a>
</article>