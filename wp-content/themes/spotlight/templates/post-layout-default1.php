<?php
/*
 * The template for displaying one article of blog streampage with style "Excerpt"
 * 
 * @package spotlight
*/
$show_title = get_custom_option('show_post_title', null, $post_data['post_id'])=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));
?>
<article <?php post_class('post_format_'.$post_data['post_format'].' post'.$opt['post_class'].' divider'.($opt['number']%2==0 ? ' even' : ' odd') . ($opt['number']==0 ? ' first' : '') . ($opt['number']==$opt['posts_on_page']? ' last' : '') . ($opt['add_view_more'] ? ' viewmore' : '')); ?>>

	<header class="post_info infoPost">
		<?php _e('Posted ', 'themerex'); ?><a href="<?php echo $post_data['post_link']; ?>" class="post_date"><?php echo $post_data['post_date']; ?></a>
		<span class="separator">|</span>
		<?php _e('by', 'themerex'); ?> <a href="<?php echo $post_data['post_author_url']; ?>" class="post_author"><?php echo $post_data['post_author']; ?></a>
		<?php if ($post_data['post_categories_links']!='') { ?>
		<span class="separator">|</span>
		<span class="post_cats"><?php _e('in', 'themerex'); ?> <?php echo $post_data['post_categories_links']; ?></span>
		<?php } ?>

		<?php if ($show_title) { ?>
		<h1 class="post_title"><a href="<?php echo $post_data['post_link']; ?>"><?php echo $post_data['post_title']; ?></a></h1>
		<?php } ?>
	</header>
	<div class="entry_content">
		<?php
		if (!$post_data['post_protected']) {
			if (!empty($opt['dedicated'])) {
				echo $opt['dedicated'];
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
			} else if ($post_data['post_video']) {
				echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], true);
			}
//			if ( $post_data['post_audio'] )
//				echo $post_data['post_audio'];
		}
		?>

	<?php
	if ($post_data['post_protected']) {
		echo $post_data['post_excerpt']; 
	} else {
		if ($post_data['post_excerpt']) {
			?>
			<div class="post<?php echo themerex_strtoproper($post_data['post_format']); ?>">
				<?php echo getShortString($post_data['post_excerpt'], $post_data['post_format']=='quote' ? 0 : get_theme_option('post_excerpt_maxlength')); ?>
			</div>
			<?php
		}
	} 
	?>
	</div>
	<footer>
		<?php if (!$post_data['post_protected']) { ?>
		<div class="postSharing">
			<?php require(get_template_directory() . '/templates/page-part-postinfo.php'); ?>
		</div>
		<?php } ?>
	</footer>
	<div class="article_divider"></div>
</article>