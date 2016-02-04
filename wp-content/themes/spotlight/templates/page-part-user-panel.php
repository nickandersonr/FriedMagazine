<?php if (get_custom_option('show_user_menu')=='yes') { ?>
<ul class="usermenu_list">

	<?php if (get_custom_option('show_currency')=='yes') { ?>
	<li class="usermenu_currency">
		<a href="#">$</a>
		<ul>
			<li><a href="#"><b>$</b> Dollar</a></li>
			<li><a href="#"><b>€</b> Euro</a></li>
			<li><a href="#"><b>£</b> Pounds</a></li>
		</ul>
	</li>
	<?php } ?>

	<?php if (get_custom_option('show_cart')=='yes') { ?>
	<li class="usermenu_cart">
		<a href="#"><span>Cart </span><b>$77</b></a>
		<ul>
			<li>cart</li>
		</ul>
	</li>
	<?php } ?>

	<?php if (get_custom_option('show_languages')=='yes' && function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0');
		if (!empty($languages)) {
			$lang_list = '';
			$lang_active = '';
			foreach ($languages as $lang) {
				$lang_title = esc_attr($lang['translated_name']);	//esc_attr($lang['native_name']);
				if ($lang['active']) {
					$lang_active = $lang_title;
				}
				$lang_list .= "\n".'<li><a rel="alternate" hreflang="' . $lang['language_code'] . '" href="' . apply_filters('WPML_filter_link', $lang['url'], $lang) . '">'
					.'<img src="' . $lang['country_flag_url'] . '" alt="' . $lang_title . '" title="' . $lang_title . '" />'
					. $lang_title
					.'</a></li>';
			}
			?>
			<li class="usermenu_language">
				<a href="#"><span><?php echo $lang_active; ?></span></a>
				<ul><?php echo $lang_list; ?></ul>
			</li>
	<?php
		}
	}
	?>

	<?php if (get_custom_option('show_login')=='yes') { ?>
		<?php if( !is_user_logged_in() ) { ?>
			<li class="usermenu_login"><a href="#user-popUp" class="user-popup-link">Login</a></li>
		<?php } else { ?>
			<?php
			$current_user = wp_get_current_user();
			?>
			<li class="usermenu_controlPanel">
				<a href="#"><span><?php echo $current_user->display_name; ?></span></a>
				<ul>
					<?php if (current_user_can('publish_posts')) { ?>
					<li><a href="<?php echo home_url(); ?>/wp-admin/post-new.php?post_type=post" class="icon icon-doc-inv">New post</a></li>
					<?php } ?>
					<li><a href="<?php echo get_edit_user_link(); ?>" class="icon icon-cog-1">Settings</a></li>
					<li><a href="<?php echo wp_logout_url(home_url()); ?>" class="icon icon-logout">Log out</a></li>
				</ul>
			</li>
		<?php } ?>
	<?php } ?>

</ul>
<?php } ?>
