						<?php stopWrapper(); ?> <!-- /.content -->
					<?php stopWrapper(); ?> <!-- /.main -->
				<?php stopWrapper(); ?> <!-- /.container -->
<?php
$post_data['post_views']++;

if (!$post_data['post_protected'] && $opt['reviews'] && get_custom_option('show_reviews')=='yes') {
	$avg_author = $post_data['post_reviews_author'];
	$avg_users  = $post_data['post_reviews_users'];
}

$show_title = get_custom_option('show_post_title')=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));
?>

<?php startWrapper('<div class="itemscope" itemscope itemtype="http://schema.org/'.($avg_author > 0 || $avg_users > 0 ? 'Review' : 'Article').'">'); ?>

	<?php startWrapper('<article class="itemPageFull post_format_'.$post_data['post_format'].'">');

		<?php require(get_template_directory() . '/templates/page-part-prev-next-posts.php'); ?>
		
		<?php startWrapper('<div class="itemDescriptionWrap">'); ?>

			<?php startWrapper('<div class="container">'); ?>
				<a href="#" class="toggleButton"></a>
				<a href="#" class="backClose"></a>
				<h1 class="post_title"><?php echo $post_data['post_title']; ?></h1>
				<?php startWrapper('<div class="entry_content toggleDescription" itemprop="'.($avg_author > 0 || $avg_users > 0 ? 'reviewBody' : 'articleBody').'">'); ?>
					<?php
					// Post content
					if ($post_data['post_protected']) { 
						echo $post_data['post_excerpt']; 
					} else {
						echo sc_gap_wrapper($post_data['post_content']); 
					}
					?>
				<?php stopWrapper(); ?> <!-- .entry_content -->
				<footer>
					<?php
						if ( get_custom_option('show_post_info')=='yes') { ?>
							<div class="itemInfo">
								<?php if ( get_custom_option('show_post_counters')=='yes') { ?>
									<div class="postSharing">
										<?php
										$postinfo_buttons = array('comments', 'views', 'likes', 'share', 'rating');
										require(get_template_directory() . '/templates/page-part-postinfo.php');
										?>
									</div>
								<?php } ?>
								<div class="post_info infoPost">
									<?php _e('Posted ', 'themerex'); ?><a href="<?php echo $post_data['post_link']; ?>" class="post_date"><?php echo $post_data['post_date']; ?></a>
									<?php if ($post_data['post_categories_links']!='') { ?>
										<span class="separator">|</span>
										<span class="post_cats"><?php echo $post_data['post_categories_links']; ?></span>
									<?php } ?>
								</div>
							</div>
					<?php } ?>
				</footer>
			<?php stopWrapper(); ?> <!-- .container -->
		<?php stopWrapper(); ?> <!-- .itemDescriptionWrap -->
	<?php stopWrapper(); ?> <!-- article -->

	<?php if (!$post_data['post_protected']) { ?>
		<div class="container">
		<?php if (get_custom_option("show_post_author") == 'yes' || get_custom_option("show_post_related") == 'yes' || get_custom_option("show_post_comments") == 'yes') { ?>
			<div class="withMargin"></div>
		<?php } ?>
		<?php
		require(get_template_directory() . '/templates/page-part-author-info.php');
		require(get_template_directory() . '/templates/page-part-related-posts.php');
		require(get_template_directory() . '/templates/page-part-comments.php');
		?>
		</div>
		<?php
	}
	?>
	
<?php stopWrapper(); ?> <!-- .itemscope -->

startWrapper('<div class="container'.(is_singular() ? ' single' : '').'">');
startWrapper('<div class="main">');
startWrapper('<div class="content">');

<?php require(get_template_directory() . '/templates/page-part-views-counter.php'); ?>
