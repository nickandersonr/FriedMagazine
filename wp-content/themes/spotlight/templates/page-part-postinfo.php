<?php
$show_all = !isset($postinfo_buttons) || !is_array($postinfo_buttons);
?>
<ul>
<?php 
//global $wp_query;
//if ( is_single() || (is_page() && !is_home() && !is_front_page() && !$wp_query->is_posts_page)) {

	if ($show_all || in_array('views', $postinfo_buttons)) { ?>
	<li class="squareButton light ico"><a class="icon-eye" title="<?php echo sprintf(__('Views - %s', 'themerex'), $post_data['post_views']); ?>" href="<?php echo $post_data['post_link']; ?>"><?php echo $post_data['post_views']; ?></a></li>
<?php } ?>
<?php if ($show_all || in_array('comments', $postinfo_buttons)) { ?>
	<li class="squareButton light ico"><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo $post_data['post_comments_link']; ?>"><?php echo $post_data['post_comments']; ?></a></li>
<?php } ?>
<?php 
$rating = $post_data['post_reviews_'.(get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
if ($rating > 0 && ($show_all || in_array('rating', $postinfo_buttons))) { 
?>
	<li class="squareButton light ico"><a class="icon-star-1" title="<?php echo sprintf(__('Rating - %s', 'themerex'), $rating); ?>" href="<?php echo $post_data['post_link']; ?>"><?php echo $rating; ?></a></li>
<?php } ?>
<?php if ($show_all || in_array('likes', $postinfo_buttons)) { ?>
	<?php
	$likes = isset($_COOKIE['spotlight_likes']) ? $_COOKIE['spotlight_likes'] : '';
	$allow = themerex_strpos($likes, ','.$post_data['post_id'].',')===false;
	?>
	<li class="squareButton light ico likeButton like<?php echo $allow ? '' : 'Active'; ?>" data-postid="<?php echo $post_data['post_id']; ?>" data-likes="<?php echo $post_data['post_likes']; ?>" data-title-like="<?php _e('Like', 'themerex'); ?>" data-title-dislike="<?php _e('Dislike', 'themerex'); ?>"><a class="icon-heart-1" title="<?php echo sprintf($allow ? __('Like - %s', 'themerex') : __('Dislike', 'themerex'), $post_data['post_likes']); ?>" href="#"><span class="likePost"><?php echo $post_data['post_likes']; ?></span></a></li>
<?php } ?>
</ul>
<?php if (is_single()) { ?>
<meta itemprop="interactionCount" content="User<?php echo $opt['counters']=='comments' ? 'Comments' : 'PageVisits'; ?>:<?php echo $opt['counters']=='comments' ? $post_data['post_comments'] : $post_data['post_views']; ?>" />
<?php } ?>