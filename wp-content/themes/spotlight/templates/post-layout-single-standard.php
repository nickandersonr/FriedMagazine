<?php

/* Template for default single blog post */

global $THEMEREX_underconstruct;

$post_data['post_views']++;

if (!$post_data['post_protected'] && $opt['reviews'] && get_custom_option('show_reviews')=='yes') {
	$avg_author = $post_data['post_reviews_author'];
	$avg_users  = $post_data['post_reviews_users'];
}
$show_title = get_custom_option('show_post_title')=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));
	$criterias_list = get_custom_option('reviews_criterias');
$show_info = get_custom_option('show_post_info') == 'yes';
?>

<?php startWrapper('<div class="itemscope" itemscope itemtype="http://schema.org/'.($avg_author > 0 || $avg_users > 0 ? 'Review' : 'Article').'">'); ?>
	<?php startWrapper('<article class="'.join(' ', get_post_class('post single post_format_'.$post_data['post_format'].' post'.$opt['post_class'].(get_custom_option("show_post_author") == 'yes' || get_custom_option("show_post_related") == 'yes' || get_custom_option("show_post_comments") == 'yes' ? ' divider' : ' no_margin'))).'">'); ?>
		<?php if($show_info) { ?>			
		<header class="post_info infoPost">
			<?php if ($show_title) { ?>
			<h2 class="post_title"><?php echo $post_data['post_title']; ?></h2>
			<?php } ?>
			<?php if ($post_data['post_categories_links']!='') { ?>
				<span class="post_cats filled"> <?php echo $post_data['post_categories_links']; ?></span>
			<?php } ?>
			<span class="icon-user-1"></span> <a href="<?php echo $post_data['post_author_url']; ?>" class="post_author"><?php echo $post_data['post_author']; ?></a><span class="separator">|</span><!--
		 --><span class="icon-clock-1"></span><?php echo $post_data['post_date']; ?>
			<?php if($post_data['post_comments'] != 0) : ?>
			<span class="separator">|</span><!--
		 --><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo $post_data['post_comments_link']; ?>"><?php echo $post_data['post_comments']; ?></a>
		 	<?php endif; ?>
		</header>
		<?php } ?>
		<?php
		if (!$post_data['post_protected']) {
			if (!empty($opt['dedicated'])) {
				echo $opt['dedicated'];
			} else if ($post_data['post_thumb'] && $THEMEREX_underconstruct != true) {
				?>
				<div class="sc_section columns post_thumb thumb">
					<?php
						if(get_custom_option('show_featured') == 'yes')
							echo $post_data['post_thumb'];
					?>
				</div>
				<?php 
			}
		}
		?>
	
		<?php
		if (count($criterias_list) > 1 && !is_page() && get_custom_option('show_reviews') == 'yes')
			require(get_template_directory() . '/templates/page-part-reviews-block.php');
		?>
			
		<?php startWrapper('<div class="entry-content" itemprop="'.($avg_author > 0 || $avg_users > 0 ? 'reviewBody' : 'articleBody').'">'); ?>
		
		<?php
			if ( !$post_data['post_protected'] && $post_data['post_edit_enable']) {
				require(themerex_get_file_dir('/templates/page-part-editor-area.php'));
			}
		?>
		<?php
		// Post content
		if ($post_data['post_protected']) {
			echo $post_data['post_excerpt']; 
			echo get_the_password_form(); 
		} else {
			echo sc_gap_wrapper($post_data['post_content']); 
		}
		?>
		
		<?php stopWrapper(); ?> <!-- .entry-content -->
		
		<?php
	
		/**** Link Pages ****/
		
		$pages_args = array(
			'before'           => '<p class="link_pages">',
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'next',
			'separator'        => '',
			'nextpagelink'     => '<i class="icon-right-open-big"></i>',
			'previouspagelink' => '<i class="icon-left-open-big"></i>',
			'pagelink'         => '%aaa',
			'echo'             => 0
		);
		$post_id = $post_data['post_id'];
		$link_pages = trex_link_pages($pages_args);
		$post_tags_array = wp_get_post_tags($post_id);
		if(count($post_tags_array) > 0 || count($criterias_list) == 1 || !empty($link_pages)) {
		?>
		<div class="post_footer">
		<?php
		if(count($criterias_list) == 1) {
			echo '<div class="sc_divider" style="margin-top:0"></div>';
			require(get_template_directory() . '/templates/page-part-reviews-block.php');
		}
		
		if(get_custom_option('show_post_tags') == 'yes') {
			$post_tags_list = wp_get_post_tags($post_id);
			$post_tags = '';
			$i = 0;
			if(count($post_tags_list) > 0) {
				$post_tags .='<div class="post_tags">';
				$post_tags .='<span>'.__('Tags:','themerex').'</span>';
				foreach ($post_tags_list as $tag) {
					$i++;
					$tag_id = (int)$tag->term_id;
					$tag_url = get_term_link($tag_id, 'post_tag');
					$tag_name = $tag->name;
					$post_tags .='<a href="'.$tag_url.'">'.$tag_name.'</a>'.($i < count($post_tags_list) ? ',&nbsp;' : '');
				}
				$post_tags .='</div>';
				echo $post_tags;
			}
			else {
				the_tags();
			}
		}
		echo $link_pages;
		
		echo '</div>';
	}
		/********************/
		if($post_data['post_type'] != 'page') {
		
			$prev_post_link = get_previous_post_link();
			$next_post_link = get_next_post_link();
			if(!empty($prev_post_link) || !empty($next_post_link)) {
				echo '<div class="prev_next_posts">';
				previous_post_link('<div class="prev_post_link">%link</div>', '<span class="prev_post_icon icon-left-open-big"></span><span class="link_label">'.__('Previous Post', 'themerex').'</span><span 		class="link_post_name">%title</span>');
				next_post_link('<div class="next_post_link">%link</div>', '<span class="next_post_icon  icon-right-open-big"></span><span class="link_label">'.__('Next Post', 'themerex').'</span><span 		class="link_post_name">%title</span>');
				echo '</div>';
			}
		}
	?>

	<?php stopWrapper(); ?> <!-- article -->

	<?php	
	if (!$post_data['post_protected']) {
		if($post_data['post_type'] != 'page') {
			require(get_template_directory() . '/templates/page-part-author-info.php');		
			echo '<div class="article_services">';
			require(get_template_directory() . '/templates/page-part-related-posts.php');
		}
		else {
			echo '<div class="article_services">';
		}
		require(get_template_directory() . '/templates/page-part-comments.php');
		echo '</div>';
	}	
	?>

<?php stopWrapper(); ?> <!-- .itemscope -->

<?php require(get_template_directory() . '/templates/page-part-views-counter.php'); ?>