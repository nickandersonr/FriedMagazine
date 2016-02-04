<?php
/**
 * The template for displaying the footer.
 *
 * @package spotlight
 */
global $logo_footer, $THEMEREX_footermenu, $THEMEREX_underconstruct, $check_404;
$site_footer = get_custom_option('footer_copyright');
?>
						<?php stopWrapper(); ?> <!-- /.content -->
						<?php 
						if (!$check_404) {
							get_sidebar();
						}
						if (get_custom_option('show_top_news') == 'yes')
							require(get_template_directory() . '/templates/page-part-topnews.php');
						?>

					<?php stopWrapper(); ?> <!-- /.main -->

				<?php stopWrapper(); ?> <!-- /.container -->

			<?php if ($THEMEREX_underconstruct != true) : ?>
			<div class="footerContentWrap">
				<?php
				$custom_footer = get_custom_option('custom_footer_show')=='yes' ? get_custom_option('custom_footer') : '';
				if (!empty($custom_footer)) {
					echo do_shortcode($custom_footer);
				}
				
				// ---------------- Footer sidebar ----------------------
				if (get_custom_option('show_sidebar_footer') == 'yes'  ) {
				?>
				<footer class="footerWrap">
					<div class="main footerWidget container">
						<div class="columnsWrap">
							<?php
							do_action( 'before_sidebar' );
							global $THEMEREX_current_sidebar;
							$THEMEREX_current_sidebar = 'footer_sidebar';
							if ( ! dynamic_sidebar( get_custom_option('sidebar_footer') ) ) {
								// Put here html if user no set widgets in sidebar
							}
							?>
						</div>
					</div>
					<?php if(!empty($site_footer) || !empty($THEMEREX_footermenu)) { ?>
					<div class="footerBottomWrap">
						<div class="container">
							<?php
								echo !empty($THEMEREX_footermenu) ? $THEMEREX_footermenu : '';
								echo !empty($site_footer) ? '<div class="site_footer copyright">'.$site_footer.'</div>' : '';
							?>
						</div>
					</div>
					<?php } ?>
				</footer><!-- ./blackStyle -->
				<?php } ?>
			
			</div><!-- /.footerContentWrap -->
			<?php endif; /* Under Construction */ ?>

		</div><!-- ./page_wrap -->

	</div><!-- ./main_content -->

<?php require(get_template_directory() . '/templates/page-part-login.php'); 
	
	$show_right_panel = get_custom_option('show_right_panel');
	if($show_right_panel == 'yes') {
		require(get_template_directory() . '/templates/page-part-customizer.php');
	}
			
?>

<?php require(get_template_directory() . '/templates/page-part-js-messages.php'); ?>

<?php //require(get_template_directory() . '/templates/page-part-customizer.php'); ?>

<?php
	$useragent = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	$prevVis = !empty($_COOKIE['prevVisited']) ? 1 : 0;
	echo $prevVis == 0 && $show_right_panel == 'yes' && strpos($useragent, 'iPhone') === false ? '<div class="right_panel_overlay"></div>' : '';
?>

<?php wp_footer(); ?>
</body>
</html>