<?php
$show_title = true;	//get_custom_option('show_post_title', null, $post_data['post_id'])=='yes';
$mult = min(2, max(1, get_theme_option("retina_ready")));
?>
<div class="columns1_2 related_post">
	<div class="thumb_wrap">		
		<?php
		$mult = min(2, max(1, get_theme_option("retina_ready")));
		$post_thumb = getResizedImageTag($post_data['post_id'], 86*$mult, 86*$mult, true);
		echo !empty($post_thumb) ? '<div class="post_thumb">'.$post_thumb.'</div>' : '<div class="post_thumb"><i class="icon-picture-1"></i></div>';
		?>
	</div>
	<div class="extra_wrap">
		<?php if ($show_title) { ?>
		<h3><a href="<?php echo $post_data['post_link']; ?>"><?php echo $post_data['post_title']; ?></a></h3>
		<?php } ?>		
		<header class="post_info infoPost">
			<?php
			if ($post_data['post_categories_links']!='') { ?>
				<span class="post_cats filled"> <?php echo $post_data['post_categories_links']; ?></span>
			<?php } ?>
			<a href="<?php echo $post_data['post_author_url']; ?>" class="post_author"><?php echo $post_data['post_author']; ?></a><span class="separator">|</span><!-- 
		 --><span class="icon-clock-1"></span><?php echo $post_data['post_date']; ?>
		 	<?php if($post_data['post_format'] != 'aside') : ?>
		 	<?php if($post_data['post_comments'] != 0) { ?>
			<span class="separator">|</span><!-- 
		--><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo $post_data['post_comments_link']; ?>"><?php echo $post_data['post_comments'].'</a>'; } ?>
		 	<?php endif; ?>
		</header>
	</div>

</div>