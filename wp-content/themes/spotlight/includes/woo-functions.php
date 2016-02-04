<?php

add_action('woocommerce_before_shop_loop_item_title', 'trex_product_cats');

function trex_product_cats() {
	global $post;
	$post_id = $post->ID;
	$post_cats = wp_get_post_terms($post_id, 'product_cat');
	$cats_out = '';
	$i = 0;
	
	if(!empty($post_cats)) {
		foreach ($post_cats as $term) {
			$i++;
			$term_link = get_term_link($term, 'product_cat');
			$cats_out .= !empty($term_link) ? '<a href="'.$term_link.'">'.$term->name.'</a>' : '';
			$cats_out .= count($post_cats) > 1 && $i < count($post_cats) ? ',&nbsp;' : '';
			
		}
	}
	echo !empty($cats_out) ? '<div class="product_cats">'.$cats_out.'</div>' : '';
}


add_action('woocommerce_before_shop_loop', 'trex_loop_divider', 70 );
add_action('woocommerce_after_shop_loop', 'trex_loop_divider', 5 );

function trex_loop_divider() {
	echo '<div class="woo_divider"></div>';
}

add_action('woocommerce_product_thumbnails_columns', 'trex_singe_img_columns', 20);

function trex_singe_img_columns($cols) {
	return 5;
}

add_filter('woocommerce_output_related_products_args', 'trex_related_poducts_args');
function trex_related_poducts_args($args) {
	$show_sidebar_main = in_array(get_custom_option('show_sidebar_main'), array('left', 'right')) ? true : false;
	
	if($show_sidebar_main) {
		$args['posts_per_page'] = 3;
	}
	else {
		$args['posts_per_page'] = 3;
	}	
	
	$args['columns'] = 3;
	return $args;
}

remove_action('get_product_search_form', 'trex_product_search_form_before');
add_filter('get_product_search_form', 'trex_product_search_form');
function trex_product_search_form($form) {
	$form = '<form role="search" method="get" id="searchform" action="'.esc_url( home_url( '/'  ) ).'">
		<div>
			<input type="text" value="'.get_search_query().'" name="s" id="s" placeholder="'.__( 'Search for products', 'woocommerce' ).'" />
			<button class="form_submit"><i class="icon-search"></i></button>
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
	
	return $form;
}

function trex_product_search_form_before() {
echo 'test';
	return 'dsfsds';
}

?>