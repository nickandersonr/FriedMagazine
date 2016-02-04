<?php
//===================================== Post author info =====================================
if (get_custom_option("show_post_author") == 'yes') {
	$post_author = get_the_author();
    $post_author_id = get_the_author_meta('ID');
	$post_author_email = get_the_author_meta('user_email', $post_author_id);
	$post_author_name = get_the_author_meta('display_name', $post_author_id);
	$post_author_pos = get_the_author_meta('user_position', $post_author_id);
	$post_author_url = get_the_author_meta('user_url', $post_author_id);
	$avatar_size = is_author() ? 306 : 54;
	$post_author_avatar = get_avatar($post_author_email, $avatar_size*min(2, max(1, get_theme_option("retina_ready"))));
	$post_author_descr = do_shortcode(nl2br(get_the_author_meta('description', $post_author_id)));
	
?>
	<section class="author vcard <?php echo is_author() ? 'author_page' : 'single' ?>" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<div class="section_inner">
		<div class="author_info">
			<div class="avatar"><a href="<?php echo $post_author_url; ?>" itemprop="image"><?php echo $post_author_avatar; ?></a></div>		
			<div class="info_wrap">
				<?php if(!empty($post_author_name)) { ?>
				<div class="name"><h3><?php echo $post_author_name; ?></h3></div>
				<?php } ?>		
				<?php if(!empty($post_author_pos)) { ?>
				<div class="position"><h6><?php echo $post_author_pos; ?></h6></div>
				<?php } ?>
				<div class="user_links">
					<ul>
						<li><a href="mailto:<?php echo $post_author_email; ?>" data-tooltip="E-mail"><span class="icon-mail"></span></a></li>
						<li><a href="<?php echo $post_author_url; ?>" data-tooltip="<?php echo __('Author Link', 'themrex'); ?>"><span class="icon-link"></span></a></li>
						<?php showUserSocialLinks(array('author_id'=>$post_author_id, 'allowed'=>array('twitter','facebook'), 'style'=>'icons', 'before'=>'<li>', 'after'=>'</li>')); ?>
					</ul>
					<span class="tooltip"></span>
				</div>
			</div>
		</div>
		<div class="author_bio" itemprop="description"><p><?php echo $post_author_descr; ?></p></div>
		</div>
	</section>
<?php
	echo !is_author() ? '<div class="sc_divider"></div>' : '';
}
?>
