<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package spotlight
 */
?>

<?php 

$show_sidebar_main = in_array(get_custom_option('show_sidebar_main'), array('left', 'right')) ? true : false;
$is_shop_sidebar = !empty($_GET['show_shop_sidebar']) && $_GET['show_shop_sidebar'] == true ? true : false;
if($is_shop_sidebar) {
	$show_sidebar_main = true;
}

if ($show_sidebar_main) {
?>
	<div id="sidebar_main" class="widget_area sidebar_main sidebar" role="complementary">
		<?php
		do_action( 'before_sidebar' );
		global $THEMEREX_current_sidebar;		
		$THEMEREX_current_sidebar = 'main_sidebar';
		
		if($is_shop_sidebar) {
			! dynamic_sidebar( 'shop_sidebar' );
		} else {
			if ( ! dynamic_sidebar( get_custom_option('sidebar_main') ) ) { 
				//
			}
		}
		?>
	</div>
<?php
}
?>