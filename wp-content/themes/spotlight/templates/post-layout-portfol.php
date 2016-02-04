<?php
$show_title = get_custom_option('show_post_title', null, $post_data['post_id'])=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));
$columns = max(1, min(4, (int) themerex_substr($opt['style'], -1)));
if ($columns == 1) {
?>
	<article class="isotopeElement divider <?php 
		echo 'post_format_'.$post_data['post_format'] 
			. ' post'.$opt['post_class']
			. ($opt['number']%2==0 ? ' even' : ' odd') 
			. ($opt['number']==0 ? ' first' : '') 
			. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
			. ($opt['add_view_more'] ? ' viewmore' : '') 
			. (get_custom_option('show_filters')=='yes' 
				? ' flt_'.join(' flt_', get_custom_option('filter_taxonomy')=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
				: '');
		?>">
		<?php if ($post_data['post_thumb']) { ?>
		<div class="thumb hoverIncrease" data-image="<?php echo $post_data['post_attachment']; ?>" data-title="<?php echo esc_attr($post_data['post_title']); ?>"><?php echo $post_data['post_thumb']; ?></div>
		<?php
		} else if ($post_data['post_gallery']) {
			echo $post_data['post_gallery'];
		} else if ($post_data['post_video']) {
			echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], true);
		}
		?>
		<div class="folioInfoBlock">
			<?php if ($show_title) { ?>
			<h2><a href="<?php echo $post_data['post_link']; ?>"><?php echo $post_data['post_title']; ?></a></h2>
			<?php } ?>
			<p>
			<?php
			if (!in_array($post_data['post_format'], array('quote', 'link'))) {
				$post_data['post_excerpt'] = strip_tags($post_data['post_excerpt']);
			}
			echo $post_data['post_excerpt'];
			?>
			</p>
			<div class="moreWrapPortfolio">
				<div class="portfolioMore">
					<?php
					$postinfo_buttons = array('more');
					require(get_template_directory() . '/templates/page-part-postinfo.php'); 
					?>
				</div>
				<div class="infoPost">
					<?php _e('Posted ', 'themerex'); ?><a href="<?php echo $post_data['post_link']; ?>" class="post_date"><?php echo $post_data['post_date']; ?></a>
					<?php if ($post_data['post_categories_links']!='') { ?>
					<span class="separator">|</span>
					<span class="post_cats"><?php echo $post_data['post_categories_links']; ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
	</article>
<?php 
} else { 
	$dir = themerex_strtoproper(get_custom_option('hover_style', null, $post_data['post_id']));
?>
	<article class="isotopeElement <?php 
		echo 'post_format_'.$post_data['post_format'] 
			. 'hover_'.$dir.($dir=='Book' ? ' bookShowWrap' : '')
			. ($opt['number']%2==0 ? ' even' : ' odd') 
			. ($opt['number']==0 ? ' first' : '') 
			. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
			. ($opt['add_view_more'] ? ' viewmore' : '') 
			. (get_custom_option('show_filters')=='yes' 
				? ' flt_'.join(' flt_', get_custom_option('filter_taxonomy')=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
				: '');
		?>">
		<div class="hover hover<?php echo $dir; ?>Show">
			<?php if ($post_data['post_thumb']) { ?>
				<div class="thumb"><?php echo $post_data['post_thumb']; ?></div>
			<?php
			} else if ($post_data['post_gallery']) {
				echo $post_data['post_gallery'];
			} else if ($post_data['post_video']) {
				echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], true);
			}
			?>
			<div class="folioShowBlock">
				<div class="folioContentAfter">
					<?php if ($show_title) { ?>
					<h4><a href="<?php echo $post_data['post_link']; ?>"><?php echo $post_data['post_title']; ?></a></h4>
					<?php } ?>
					<p>
					<?php
					if (!in_array($post_data['post_format'], array('quote', 'link'))) {
						$post_data['post_excerpt'] = getShortString(strip_tags($post_data['post_excerpt']), $columns==2 ? 400 : 90);
					}
					echo $post_data['post_excerpt'];
					?>
					</p>
					<div class="masonryInfo">
						<?php _e('Posted ', 'themerex'); ?><a href="<?php echo $post_data['post_link']; ?>" class="post_date"><?php echo $post_data['post_date']; ?></a>
						<?php if ($post_data['post_categories_links']!='') { ?>
						<span class="separator">|</span>
						<span class="post_cats"><?php echo $post_data['post_categories_links']; ?></span>
						<?php } ?>
					</div>
					<div class="masonryMore">
						<?php
						$postinfo_buttons = array('more');
						require(get_template_directory() . '/templates/page-part-postinfo.php'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php } ?>
