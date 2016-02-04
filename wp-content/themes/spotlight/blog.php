<?php
/*
Template Name: Blog streampage
*/
get_header();

global $THEMEREX_only_reviews, $THEMEREX_only_video, $THEMEREX_only_audio, $THEMEREX_only_gallery, $trex_is_author;
global $wp_query, $post;

$blog_style = get_custom_option('blog_style');
$blog_class = $blog_style;
$is_404 = is_404();

$show_sidebar_main = get_custom_option('show_sidebar_main');
$ppp = (int) get_custom_option('posts_per_page');
$excerpt_length = get_custom_option('post_excerpt_maxlength');

$page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
$wp_query_need_restore = false;

$args = $wp_query->query_vars;
$args['post_status'] = current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish';

$page_title = get_the_title();
$show_title = get_custom_option('show_post_title');
if($show_title != 'no' && is_singular()) {
	echo !empty($page_title) ? '<h1 class="page_title">'.$page_title.'</h1>' : '';
}

if ( is_page() || isset($THEMEREX_only_reviews) || isset($THEMEREX_only_video) || isset($THEMEREX_only_audio) || isset($THEMEREX_only_gallery) ) {
	$args['post_type'] = 'post';
	unset($args['p']);
	unset($args['page_id']);
	unset($args['pagename']);
	unset($args['name']);
	$args['posts_per_page'] = $ppp;
	if ($page_number > 1) {
		$args['paged'] = $page_number;
		$args['ignore_sticky_posts'] = 1;
	}
	if (isset($THEMEREX_only_reviews)) {
		$args['meta_query'] = array(
			   array(
				   'key' => 'reviews_avg',
				   'value' => 0,
				   'compare' => '>',
				   'type' => 'NUMERIC'
			   )
		);
	} else if (isset($THEMEREX_only_video)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-video' )
			)
		);
	} else if (isset($THEMEREX_only_audio)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-audio' )
			)
		);
	} else if (isset($THEMEREX_only_gallery)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-gallery' )
			)
		);
	}
	$args = addSortOrderInQuery($args);
	query_posts( $args );
	$wp_query_need_restore = true;
}
if($blog_style == 'portfolio') {
	$args['meta_key'] = '_thumbnail_id';
	query_posts( $args );
}
$per_page = count($wp_query->posts);

$post_number = 0;

$parent_cat_id = (int) get_custom_option('category_id');
$accent_color = '';

$thumb_size = get_custom_option('blog_style');

$flt_ids = array();
/* Remove this condition after creating all of templates */
if(themerex_strpos($blog_style, 'masonry') !== false) {
	$blog_style = 'masonry';
}
else if(themerex_strpos($blog_style, 'excerpt') !== false) {
	$blog_style = 'excerpt';
}
else if(themerex_strpos($blog_style, 'reviews') !== false) {
	$blog_style = 'reviews';
}

if(!file_exists(get_template_directory() . '/templates/post-layout-'.$blog_style.'.php')) {
	$blog_style = 'default';
}

$generated_id = 'isotpe_block_'.mt_rand(1, 9999);
$show_isotope = !in_array(get_custom_option('blog_style'), array('excerpt', 'default', 'classic')) ? true : false;
if($is_404) {
	$show_isotope = false;
}
$iso_columns = in_array($blog_style, array('reviews', 'excerpt', 'masonry')) ? true : false;
$data_columns = in_array($thumb_size, array('masonry2', 'masonry3', 'masonry_reviews2', 'masonry_reviews3', 'reviews2', 'reviews3')) ? substr($thumb_size, -1) : '';

echo '<div class="blog_style_'.(is_404() ? '' : get_custom_option('blog_style')).(!empty($iso_columns) ? ' iso_section_indent' : '').'">';

if($trex_is_author == true) {
	if(file_exists(get_template_directory() . '/templates/page-part-author-info.php')) {
		require(get_template_directory() . '/templates/page-part-author-info.php');
	}
}
/* TODO */
?>
	<div class="isotope_section">
		<?php if( get_custom_option('show_filters')!== 'no' ) { ?>
		<div class="isotopeFiltr"></div>
		<?php } ?>
		<section id="<?php echo $generated_id; ?>" class="<?php echo $show_isotope ? 'isotope' :  ''.' '.get_custom_option('blog_style'); ?> posts_container <?php echo $blog_style == 'portfolio' ? ' multiWidth' : '' ?>" data-columns="<?php echo $data_columns; ?>">
<?php
while ( have_posts() ) { the_post();
	
	$post_number++;
	
	if($post_number == 1 && $blog_style == 'excerpt') {
		$thumb_size = get_custom_option('blog_style').'_first';
	}
	else {
		$thumb_size = get_custom_option('blog_style');
	}
	clear_dedicated_content();
	$data_args = array(
		'layout' => ($post_number == 1 && $blog_style == 'excerpt') ? $blog_style.'_first' : $blog_style,
		'number' => $post_number,
		'add_view_more' => false,
		'posts_on_page' => $per_page,
		// Get post data
		'thumb_size' => $thumb_size,
		'thumb_crop' => themerex_strpos($blog_style, 'masonry')===false,
		'strip_teaser' => false,
		'parent_cat_id' => $parent_cat_id,
		'iso_columns' => in_array($blog_style, array('excerpt', 'masonry', 'reviews')) ? true : false,
		'sidebar' => !in_array($show_sidebar_main, array('none', 'fullwidth'))
	);
	$post_data = getPostData($data_args);
	showPostLayout($data_args, $post_data);
	if (get_custom_option('show_filters')=='yes') {
		if (get_custom_option('filter_taxonomy')=='tags') {			// Use tags as filter items
			if (count($post_data['post_tags_list']) > 0) {
				foreach ($post_data['post_tags_list'] as $tag) {
					$flt_ids[$tag->term_id] = $tag->name;
				}
			}
		}
	}
}
if (!$post_number) {
	if ( $is_404 ) {
		showPostLayout( array('layout' => '404'), false );
	} else if ( is_search() ) {
		showPostLayout( array('layout' => 'no-search-results'), false );
	} else {
		showPostLayout( array('layout' => 'no-articles'), false );
	}
} else {
	// Isotope filters list
	$ppp = (int) get_custom_option('posts_per_page');
	$filters = '';
	if (get_custom_option('show_filters')=='yes' && !empty($show_isotope)) {
		if (get_custom_option('filter_taxonomy')=='categories') {			// Use categories as filter items
			$cat_id = (int) get_query_var('cat');
			$portfolio_parent = max(0, is_category() ? getParentCategoryByProperty($cat_id, 'show_filters', 'yes') : 0);
			$iso_args = array(
				'type'                     => 'post',
				'child_of'                 => $portfolio_parent,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 0,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false);
			$portfolio_list = get_categories($iso_args);
			
			if (count($portfolio_list) > 0) {
				$filters .= '<li class="squareButton'.($portfolio_parent==$cat_id ? ' active' : '').'"><a href="#" data-filter="*">'.__('All', 'themerex').'</a></li>';
				foreach ($portfolio_list as $cat) {
					$filters .= '<li class="squareButton'.($cat->term_id==$cat_id ? ' active' : '').'"><a href="#" data-filter=".flt_'.$cat->term_id.'">'.$cat->name.'</a></li>';
				}
			}
		} else {														// Use tags as filter items
			if (count($flt_ids) > 0) {
				$filters .= '<li class="squareButton active"><a href="#" data-filter="*">'.__('All', 'themerex').'</a></li>';
				foreach ($flt_ids as $flt_id=>$flt_name) {
					$filters .= '<li class="squareButton"><a href="#" data-filter=".flt_'.$flt_id.'">'.$flt_name.'</a></li>';
				}
			}
		}
	}
	// Pagination
	?>
		</section>
	<?php
	if ($filters) {
		$filters = '<ul>' . $filters . '</ul>';
		?>
		<script type="text/javascript">
			var ppp = <?php echo $ppp; ?>;
			jQuery(document).ready(function () {
				jQuery(".isotopeFiltr").append('<?php echo $filters; ?>');
			});
		</script>
		<?php
	}
	$pagination_style = get_custom_option('blog_pagination');
	if($pagination_style != 'hide') {
		if (in_array($pagination_style, array('viewmore', 'infinite'))) {
			if ($page_number < $wp_query->max_num_pages) {
				?>
				<div id="viewmore" class="pagination_<?php echo $pagination_style; ?>">
					<a href="#" id="viewmore_link" class="theme_button view_more_button"><span class="icon-spin3 animate-spin viewmore_loading"></span><span class="viewmore_text_1"><?php _e('Load more', '	themerex'); ?></span><span class="viewmore_text_2"><?php _e('Loading ...', 'themerex'); ?></span></a>
					<script type="text/javascript">
						var THEMEREX_VIEWMORE_PAGE = <?php echo $page_number; ?>;
						var THEMEREX_VIEWMORE_DATA = '<?php echo serialize($args); ?>';
						var THEMEREX_VIEWMORE_VARS = '<?php echo serialize(array(
						'blog_style' => $blog_style,
						'iso_columns' => in_array($blog_style, array('excerpt', 'masonry')) ? true : false,
						'excerpt_length' => $excerpt_length,
						'show_sidebar_main' => $show_sidebar_main,
						'parent_cat_id' => $parent_cat_id,
						'thumb_size' => get_custom_option('blog_style'),
						'ppp' => $ppp
						)); ?>';
					</script>
				</div>
				<?php
			}
		} else
			showPagination(array('class'=>'theme_paginaton'));
	}
}

if ( $wp_query_need_restore ) wp_reset_query();
wp_reset_postdata();
?>
		</div>
<?php

echo '</div>';

get_footer();
