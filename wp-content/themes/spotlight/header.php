<?php
/**
 * The Header for our theme.
 *
 * @package spotlight
 */
global $THEMEREX_sidemenu, $THEMEREX_mainmenu, $logo_image, $check_404, $THEMEREX_topmenu, $THEMEREX_underconstruct;
	themerex_init_template();	// Init theme template - prepare global variables
	
	$check_404 = is_404();
	$mult = get_custom_option('retina_ready');
	$logo_image = get_custom_option('logo_image');
	$site_logo = !empty($logo_image) ? '<img src="'.$logo_image.'" alt="">' : get_bloginfo('name');
	$site_url = get_site_url();
	$site_desc = get_bloginfo('description');
	$show_search = get_custom_option('show_searchform');
	$show_mobilemenu = get_custom_option('show_mobilemenu');
	$show_tagline = get_custom_option('show_tagline');
	$menu_style = get_custom_option('mainmenu_style');
	$show_banner = get_custom_option('show_banner');
	$fix_menu = get_custom_option('fix_menu');
	$main_sidebar = get_custom_option('show_sidebar_main');
	
	if(!empty($_GET['show_shop_sidebar']) && $_GET['show_shop_sidebar'] == true) {
		$main_sidebar = 'left';
	}
	
	$custom_header = get_custom_option('custom_header_show')=='yes' ? get_custom_option('custom_header') : '';
	$fullwidth_slider = get_custom_option('fullwidth_slider');
	$blog_style = get_custom_option('blog_style');
	
	$header_banner_code = get_custom_option('header_banner_code');
	$header_banner_img = get_custom_option('header_banner');
	$header_banner_img = !empty($header_banner_img) ? getResizedImageTag($header_banner_img, 728*$mult, 90*$mult) : '';
	$header_banner_url = get_custom_option('header_banner_url');
	if($header_banner_code) {
		$header_banner = !empty($header_banner_code) ? $header_banner_code : '';
	} else {
		$header_banner = !empty($header_banner_img) ? $header_banner_img : '';
		$header_banner = !empty($header_banner_url) ? '<a href="'.$header_banner_url.'">'.$header_banner.'</a>' : $header_banner;
	}
	$crumbs = showBreadcrumbs( array('home' => __('Home', 'themerex'), 'echo' => false, 'truncate_title' => 50 ));
	$section_align = get_custom_option('section_align');
	$show_user_panel = get_custom_option('section_1');
	if(function_exists('icl_get_languages')) {
		$lang_pane = icl_get_languages();
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if (($favicon = get_theme_option('favicon'))) { ?>
		<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />
    <?php
	}
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php 
	$class = $style = '';
	if (($body_style=get_custom_option('body_style'))=='boxed') {
		$customizer = get_theme_option('show_theme_customizer') == 'yes';
		if ($customizer && ($img = (int) getValueGPC('bg_image', 0)) > 0)
			$class = 'bg_image_'.$img;
		else if ($customizer && ($img = (int) getValueGPC('bg_pattern', 0)) > 0)
			$class = 'bg_pattern_'.$img;
		else if ($customizer && ($img = getValueGPC('bg_color', '')) != '')
			$style = 'background-color: '.$img.';';
		else {
			if (($img = get_custom_option('bg_custom_image')) != '')
				$style = 'background: url('.$img.') ' . str_replace('_', ' ', get_custom_option('bg_custom_image_position')) . ' no-repeat fixed;';
			else if (($img = get_custom_option('bg_custom_pattern')) != '')
				$style = 'background: url('.$img.') 0 0 repeat fixed;';
			else if (($img = get_custom_option('bg_image')) > 0)
				$class = 'bg_image_'.$img;
			else if (($img = get_custom_option('bg_pattern')) > 0)
				$class = 'bg_pattern_'.$img;
			if (($img = get_custom_option('bg_color')) != '')
				$style .= 'background-color: '.$img.';';
		}
	}
	body_class($body_style
		. ($THEMEREX_sidemenu ? ' sidemenu_left' : '')
		. ($class!='' ? ' ' . $class : '')
		. ($THEMEREX_underconstruct == 'true' ? ' underConstruct' : '')
	);
	if ($style!='') echo ' style="'.$style.'"';
	?>
>

	<?php do_action( 'before' ); ?>

	<!--[if lt IE 9]>
	<?php echo do_shortcode("[infobox style='error']<div style=\"text-align:center;\">".__("It looks like you're using an old version of Internet Explorer. For the best WordPress experience, please <a href=\"http://microsoft.com\" style=\"color:#191919\">update your browser</a> or learn how to <a href=\"http://browsehappy.com\" style=\"color:#222222\">browse happy</a>!", 'themerex')."</div>[/infobox]"); ?>
	<![endif]-->
	<div id="top-right">
	<?php dynamic_sidebar('top-right-widget-area'); ?>
	</div>
	<div class="main_content">
		<div class="page_wrap">
			<?php 
				if (($header_custom_image = get_header_image()) != '') {
					$header_style = ' style = "background: url('.$header_custom_image.');"';
				} else {
					$header_style = '';
				}
			?>
			<header <?php echo $header_style; echo $fix_menu == 'fixed' ? ' class="fixed_menu"' : ''; ?>>
				<?php if($THEMEREX_underconstruct != true) : ?>
				<?php if(!empty($fullwidth_slider)) : ?>
				<section class="custom_header_section">
					<?php echo do_shortcode($fullwidth_slider); ?>
				</section>
				<?php endif; ?>

				<?php if(!empty($THEMEREX_topmenu)  && $show_user_panel == 'yes' ) : ?>	
				<section class="section_1">
					<div class="container clear">
						<?php echo $THEMEREX_topmenu; ?>
						
						<?php if(get_custom_option('show_login') == 'yes') {
							if(!is_user_logged_in())
								echo '<a class="user-popup-link login_loguout_link" href="#user-popUp"><i class="icon icon-login-1"></i>'.__('Login', 'themerex').'</a>';
							else
								echo '<a class="login_loguout_link" href="'.wp_logout_url(get_permalink()).'"><i class="icon icon-login-1"></i>'.__('Logout', 'themerex').'</a>';
						}
						?>
						<?php 
							if(!empty($lang_pane) && count($lang_pane) > 1) {
								$langlist = $active_lang = '';
								foreach ($lang_pane as $lang) {
									if($lang['active'] == 1) {
										$active_lang = $lang;
									}
									$langlist .= '<li><a href="'.$lang['url'].'"'.($lang['active'] == '1' ? ' class="active"' : '').'>'.$lang['language_code'].'</a></li>';
								}
								echo '
									<div id="langlist">
										<span class="active_lang">'.$active_lang['language_code'].'</span>
										<ul id="lang_switch">'.$langlist.'</ul>
									</div>';
							}
						?>
						<?php
							if(function_exists('is_woocommerce')) {
								if(get_custom_option('show_shopping_cart') == 'yes') {
									echo '<div class="header_cart_holder">';
									echo '<a href="#" class="header_cart_show"><i class="icon-basket-1"></i>'.__('Cart&nbsp;', 'themerex').'$<span class="cart_ammount">'.WC()->cart->get_cart_subtotal().'</span><i class="icon-down-open"></i></a>';
								echo	the_widget('WC_Widget_Cart');			
									echo '</div>';
								}
							}
						?>
					</div>
				</section>
				<?php endif; ?>
				
				<section class="section_2 main_menu_<?php echo $menu_style; echo ' section_alignment_'.$section_align.(!empty($header_banner) && $show_banner == 'yes' ? '' : ' banner_disabled'); ?>">
					<?php echo $fix_menu == 'fixed' ? '<div class="fixed_wrap">' : ''; ?>
					<div class="container clear posr">
						<div class="logo_column">
							<a href="<?php echo $site_url; ?>" class="site_logo" id="sitename"><?php echo $site_logo; ?></a>
							<?php if($show_tagline == 'yes') { ?>
							<h6 class="site_tagline"><?php echo $site_desc; ?></h6>
							<?php } ?>
						</div>
						<?php if(!empty($header_banner) && $show_banner == 'yes') { ?>
						<div class="header_banner_wrap"><?php echo $header_banner; ?></div>
						<?php } ?>						
						<?php if($show_search == 'yes' || $show_tagline == 'yes' || $show_mobile_menu == 'yes') { ?>
						<div class="header_services_block">
							<?php if($show_search == 'yes') { ?>
								<a href="#" class="search_form_show"><i class="icon-search"></i></a>
							<?php } ?>
							<?php if($show_mobilemenu == 'yes') { ?>
								<a href="#" class="show_mobile_menu"><i class="icon-menu"></i></a>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="menu_column">
							<nav role="navigation" class="menuMainWrap topMenuStyleLine <?php echo $menu_style; ?>">
								<?php $THEMEREX_mainmenu = str_replace(array("\r", "\n"), '', $THEMEREX_mainmenu);
									echo $THEMEREX_mainmenu;
								?>
							</nav>
						</div>
						<?php if($show_search == 'yes') { ?>
							<?php echo get_search_form(); ?>
						<?php } ?>
					</div>
					<?php echo $fix_menu == 'fixed' ? '</div>' : ''; ?>
				</section>
						<?php if (get_custom_option('show_breadcrumbs')=='yes' && !is_404() && !empty($crumbs)) { ?>
				<section class="section_3">
					<div class="container">
						<?php			
							echo $crumbs;
						  ?>
					</div>
				</section>				
						<?php } ?>
						
				<?php endif; /*if under construction*/ ?>
						
				<?php if (!empty($custom_header)) : ?>
				<section class="section_4">
					<?php echo do_shortcode($custom_header); ?>
				</section>
				<?php endif; ?>
			</header>
    
			<?php
			startWrapper('<div id="page" class="container'.(is_singular() ? ' single' : '').'">');
			startWrapper('<div class="main ' . (!$check_404 ? getSidebarClass($main_sidebar) : '') . (get_custom_option('show_top_news') == 'yes' ? ' show_top_news' : ''). '" role="main">');
			startWrapper('<div class="content">');