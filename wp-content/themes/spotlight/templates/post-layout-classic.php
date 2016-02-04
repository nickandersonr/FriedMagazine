<?php
/*
 * The template for displaying one article of blog streampage with style "Excerpt"
 * 
 * @package spotlight
*/
$show_title = get_custom_option('show_post_title', null, $post_data['post_id'])=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));

?>
<article class="isotopeElement post divider <?php 
		echo 'format-'.$post_data['post_format'] 
			. ' post'.$opt['post_class']
			. ($opt['number']%2==0 ? ' even' : ' odd') 
			. ($opt['number']==0 ? ' first' : '') 
			. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
			. ($opt['add_view_more'] ? ' viewmore' : '') 
			. (get_custom_option('show_filters')=='yes' 
				? ' flt_'.join(' flt_', get_custom_option('filter_taxonomy')=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
				: '');
		?>">	
	<?php
	if (!$post_data['post_protected']) {
		if (!empty($opt['dedicated'])) {
			echo $opt['dedicated'];
		} else if ($post_data['post_video']) {
			echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], false);
		} else if ($post_data['post_thumb']) {
			?>
			<div class="sc_section columns post_thumb thumb">
				<?php
				if ($post_data['post_format']=='link' && $post_data['post_url']!='')
					echo '<a href="'.$post_data['post_url'].'"'.($post_data['post_url_target'] ? ' target="'.$post_data['post_url_target'].'"' : '').'>'.$post_data['post_thumb'].'</a>';
				else if ($post_data['post_link']!='')
					echo '<a href="'.$post_data['post_link'].'">'.$post_data['post_thumb'].'</a>';
				else
					echo $post_data['post_thumb']; 
				?>
			</div>
		<?php 
		} else if ($post_data['post_gallery']) {
			echo $post_data['post_gallery'];
		}
		if ( $post_data['post_audio'] ) {
			echo $post_data['post_audio'];
		}
	}
	?>	
	
	<div class="article_wrap">
	<?php if(!in_array($post_data['post_format'], array('chat', 'link', 'status', 'quote'))) : ?>
	<header class="post_info infoPost">
		<?php
		$excerpt_length = !empty($opt['excerpt_length']) ? $opt['excerpt_length'] : get_custom_option('post_excerpt_maxlength');
		
		if ($show_title) { ?>
		<h2 class="post_title"><a href="<?php echo $post_data['post_link']; ?>"><?php echo $post_data['post_title']; ?></a></h2>		
		<?php } if($post_data['post_format'] != 'video') { ?>
		<?php if ($post_data['post_categories_links_colored']!='') { ?>
			<span class="post_cats filled"> <?php echo $post_data['post_categories_links']; ?></span>
		<?php } ?>
		<?php _e('By', 'themerex'); ?> <a href="<?php echo $post_data['post_author_url']; ?>" class="post_author"><?php echo $post_data['post_author']; ?></a><span class="separator">|</span><!-- 
	 --><span class="icon-clock-1"></span><?php echo $post_data['post_date']; ?>
	 	<?php if($post_data['post_format'] != 'aside') : ?>
		<span class="separator">|</span><!-- 
	 --><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo $post_data['post_comments_link']; ?>"><?php echo $post_data['post_comments']; ?></a>
	 	<?php endif; ?>
	 	<?php } ?>
	</header>
	<?php endif; ?>
	<?php if($post_data['post_format'] != 'video') { ?>
	<div class="entry_content">		

		<?php
		if ($post_data['post_protected']) {
			echo $post_data['post_excerpt']; 
		} else {
			if ($post_data['post_excerpt']) {
				if(in_array($post_data['post_format'], array('standard', 'gallery', 'video', 'audio', 'image')))
					$post_excerpt = strip_tags(themerex_substr($post_data['post_excerpt'], 0, $excerpt_length ));
				else {
					$post_excerpt = $post_data['post_excerpt'];
				}
				?>
				<div class="<?php echo $post_data['post_format']; ?>_text_wrap">
					<?php
						if(!in_array($post_data['post_format'], array('quote', 'image', 'chat', 'status', 'aside', 'link'))) {
							echo $post_excerpt.'&nbsp;<a href="'.$post_data['post_link'].'">[...]</a>';
						}
						else {
							echo $post_excerpt;
						}
					?>
				</div>
				<?php
			}
		} 
		?>
	</div>
	<?php } ?>
	<?php if($post_data['post_format'] != 'status') : ?>
	</div>
	<?php endif; ?>
	<?php if(in_array($post_data['post_format'], array('link', 'quote', 'status'))) : ?>
		<div class="post_info bottom">
		<?php echo $post_data['post_format'] == 'status' ? __('Status&nbsp;', 'themerex') : ''; _e('By', 'themerex'); ?> <a href="<?php echo $post_data['post_author_url']; ?>" class="post_author"><?php echo $post_data['post_author']; ?></a><span class="separator">|</span><!-- 
	 --><span class="icon-clock-1"></span><?php echo $post_data['post_date']; ?>
	 	<?php if($post_data['post_format'] != 'status') : ?>
	 	<span class="separator">|</span><!-- 
	 --><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo $post_data['post_comments_link']; ?>"><?php echo $post_data['post_comments']; ?></a>
	 	<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if($post_data['post_format'] == 'status') echo '</div>'; ?>
</article>