<?php

/* Template for default single portfolio post */

$post_data['post_views']++;

if (!$post_data['post_protected'] && $opt['reviews'] && get_custom_option('show_reviews')=='yes') {
	$avg_author = $post_data['post_reviews_author'];
	$avg_users  = $post_data['post_reviews_users'];
}

$show_title = get_custom_option('show_post_title')=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));
?>

<?php startWrapper('<div class="itemscope" itemscope itemtype="http://schema.org/'.($avg_author > 0 || $avg_users > 0 ? 'Review' : 'Article').'">'); ?>
	<?php startWrapper('<article class="'.join(' ', get_post_class('itemPage post post_format_'.$post_data['post_format'].' post'.$opt['post_class'].(get_custom_option("show_post_author") == 'yes' || get_custom_option("show_post_related") == 'yes' || get_custom_option("show_post_comments") == 'yes' ? ' divider' : ' no_margin'))).'">'); ?>
		<header>
			<h1 class="post_title"><?php echo $post_data['post_title']; ?></h1>
			<?php
				if ( get_custom_option('show_post_info')=='yes') {
					?>
					<div class="itemInfo">
						<div class="post_info infoPost">
							<?php _e('Posted ', 'themerex'); ?><a href="<?php echo $post_data['post_link']; ?>" class="post_date"><?php echo $post_data['post_date']; ?></a>
							<?php if ($post_data['post_categories_links']!='') { ?>
								<span class="separator">|</span>
								<span class="post_cats"><?php echo $post_data['post_categories_links']; ?></span>
							<?php } ?>
						</div>
					</div>
					<?php
				}
			?>
		</header>
		
		<?php require(get_template_directory() . '/templates/page-part-prev-next-posts.php'); ?>

		<?php require(get_template_directory() . '/templates/page-part-reviews-block.php'); ?>

		<?php startWrapper('<div class="entry-content" itemprop="'.($avg_author > 0 || $avg_users > 0 ? 'reviewBody' : 'articleBody').'">'); ?>
			<?php
			// Post content
			if ($post_data['post_protected']) { 
				echo $post_data['post_excerpt']; 
			} else {
				echo sc_gap_wrapper($post_data['post_content']); 
				wp_link_pages( array( 
					'before' => '<div class="nav_pages_parts"><span class="pages">' . __( 'Pages:', 'themerex' ) . '</span>', 
					'after' => '</div>',
					'link_before' => '<span class="page_num">',
					'link_after' => '</span>'
				) );
			} 
			?>
		<?php stopWrapper(); ?> <!-- .entry-content -->
		<footer>
			<?php if ( get_custom_option('show_post_counters')=='yes') { ?>
				<div class="postSharing">
					<?php
					$postinfo_buttons = array('comments', 'views', 'likes', 'share', 'rating');
					require(get_template_directory() . '/templates/page-part-postinfo.php');
					?>
				</div>
			<?php } ?>
		</footer>
	<?php stopWrapper(); ?> <!-- article -->

	<?php	
	if (!$post_data['post_protected']) {
		require(get_template_directory() . '/templates/page-part-author-info.php');
		require(get_template_directory() . '/templates/page-part-related-posts.php');
		require(get_template_directory() . '/templates/page-part-comments.php');
	}
	?>

<?php stopWrapper(); ?> <!-- .itemscope -->

<?php require(get_template_directory() . '/templates/page-part-views-counter.php'); ?>
