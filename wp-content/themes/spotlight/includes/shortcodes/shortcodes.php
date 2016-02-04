<?php
/**
 * ThemeREX Shortcodes
*/

require_once( 'shortcodes_settings.php' );

if (class_exists('WPBakeryShortCode')) {
	require_once( 'shortcodes_vc.php' );
}

global $mult;
$mult = get_custom_option('retina_ready');


// ---------------------------------- [accordion] ---------------------------------------

add_shortcode('accordion', 'sc_accordion');

/*
[accordion id="unique_id" initial="1 - num_elements"]
	[accordion_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/accordion_item]
	[accordion_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/accordion_item]
	[accordion_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/accordion_item]
	[accordion_item title="Nec purus, cras tincidunt rhoncus"]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna. Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim.[/accordion_item]
[/accordion]
*/
$THEMEREX_sc_accordion_counter = 0;
$THEMEREX_sc_accordion_show_counter = false;
function sc_accordion($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"initial" => "1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	$initial = max(0, (int) $initial -1);
	global $THEMEREX_sc_accordion_counter, $THEMEREX_sc_accordion_show_counter;
	$THEMEREX_sc_accordion_counter = 0;
	wp_enqueue_script('jquery-ui-accordion', false, array('jquery','jquery-ui-core'), null, true);
	return '<div' . ($id ? ' id="' . $id . '"' : '') 
			. ' class="sc_accordion sc_accordion_style_1"'
			. ($s!='' ? ' style="'.$s.'"' : '') 
			. (!empty($initial) ? ' data-active="'.$initial.'"' : '').'>'
			. do_shortcode($content)
			. '</div>';
}


add_shortcode('accordion_item', 'sc_accordion_item');

//[accordion_item]
function sc_accordion_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"title" => "",
		"icon" => ""
	), $atts));
	global $THEMEREX_sc_accordion_counter, $THEMEREX_sc_accordion_show_counter;
	$THEMEREX_sc_accordion_counter++;
	return '<div' . ($id ? ' id="' . $id . '"' : '') 
			. ' class="sc_accordion_item'
			. ($THEMEREX_sc_accordion_counter % 2 == 1 ? ' odd' : ' even') 
			. ($THEMEREX_sc_accordion_counter == 1 ? ' first' : '') 
			. '">'
			. '<h4 class="sc_accordion_title">'
			. (!empty($icon) ? '<i class="icon '.$icon.'"></i>' : '')
			. $title 
			. '<i class="icon-left-open icon-status"></i>'
			. '</h4>'
			. '<div class="sc_accordion_content">'
				.'<h5>'.$title.'</h5>'
				. do_shortcode($content) 
			. '</div>'
			. '</div>';
}

// ---------------------------------- [/accordion] ---------------------------------------



// ---------------------------------- [audio] ---------------------------------------

add_shortcode("audio", "sc_audio");
						
//[audio id="unique_id" url="http://webglogic.com/audio/AirReview-Landmarks-02-ChasingCorporate.mp3" controls="0|1"]

function sc_audio($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"author" => "",
		"title" => "",
		"id" => "",
		"mp3" => '',
		"wav" => '',
		"src" => '',
		"url" => '',
		"controls" => "",
		"autoplay" => "",
		"width" => '100%',
		"height" => '65',
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	if ($src=='' && $url=='' && isset($atts[0])) {
		$src = $atts[0];
	}
	if ($src=='') {
		if ($url) $src = $url;
		else if ($mp3) $src = $mp3;
		else if ($wav) $src = $wav;
	}
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '');
	if(!empty($title) || !empty($author))
		$audio_info = '<div class="sc_audio_info"'.(!empty($width) ? ' style="width:'.(strpos($width, '%') === false ? $width.'px' : $width).'"' : '').'>'.(!empty($author) ? '<span class="sc_audio_author">'.$author.'</span>' : '').(!empty($title) ? '<span class="sc_audio_title">'.$title.'</span>' : '').'</div>';
		
	return '<audio' . ($id ? ' id="' . $id . '"' : '') . ' src="' . $src . '" class="sc_audio" ' . (sc_param_is_on($controls) ? ' controls="controls"' : '') . (sc_param_is_on($autoplay) && is_single() ? ' autoplay="autoplay"' : '') . ' width="' . $width . '" height="' . $height .'"'.($s!='' ? ' style="'.$s.'"' : '').'></audio>'.(!empty($audio_info) ? $audio_info : '');
}
// ---------------------------------- [/audio] ---------------------------------------





// ---------------------------------- [banner] ---------------------------------------


add_shortcode('banner', 'sc_banner');

/*
[banner id="unique_id" src="image_url" width="width_in_pixels" height="height_in_pixels" title="image's_title" align="left|right"]Banner text[/banner/
*/
function sc_banner($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"src" => "",
		"url" => "",
		"title" => "",
		"link" => "",
		"target" => "",
		"rel" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "-1",
		"height" => "-1"
    ), $atts));
	$src = $src!='' ? $src : $url;
	if ($src > 0) {
		$attach = wp_get_attachment_image_src( $src, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$src = $attach[0];
	}
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top > 0 ? 'margin-top:' . $top . 'px;' : '')
		.($bottom > 0 ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left > 0 ? 'margin-left:' . $left . 'px;' : '')
		.($right > 0 ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '')
		;
	$content = do_shortcode($content);
	return '<a href="' . (empty($link) ? '#' : $link) . '"' 
		. ' class="sc_banner' . ($width > 300 ? ' sc_banner_large' : '').'"'
		. (!empty($target) ? ' target="' . $target . '"' : '') 
		. (!empty($rel) ? ' rel="' . $rel . '"' : '')
		. ($align && $align!='none' ? ' sc_align' . $align : '')
		. ($s!='' ? ' style="'.$s.'"' : '')
		. '>'
		. '<img src="' . $src . '" class="sc_banner_image" border="0" alt="" />'
		. (trim($title) || trim($content) ? '<div class="sc_banner_caption"><div class="sc_caption_content">' : '')
		. (trim($title) ? '<span class="sc_banner_title">' . $title . '</span>' : '') 
		. (trim($content) ? '<span class="sc_banner_content">' . $content . '</span>' : '') 
		. (trim($title) || trim($content) ? '</div></div>' : '')
		. '</a>';
}

// ---------------------------------- [/banner] ---------------------------------------





// ---------------------------------- [blogger] ---------------------------------------

add_shortcode('blogger', 'sc_blogger');

/*
[blogger id="unique_id" ids="comma_separated_list" cat="category_id" orderby="date|views|comments" order="asc|desc" count="5" descr="0" dir="horizontal|vertical" style="regular|date|image_large|image_medium|image_small|accordion|list" border="0"]
*/
$THEMEREX_sc_blogger_busy = false;
$THEMEREX_sc_blogger_counter = 0;
function sc_blogger($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular",
		"ids" => "",
		"cat" => "",
		"count" => "3",
		"visible" => "",
		"offset" => "",
		"orderby" => "date",
		"order" => "desc",
		"descr" => "0",
		"readmore" => "",
		"dir" => "horizontal",
		"rating" => "no",
		"scroll" => "no",
		"info" => "yes",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"title" => "",
		"link_title" => "",
		"link_url" => "",
		"border" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 && $style == 'carousel' ? 'max-height:'.$height.'px' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '');
	
	global $THEMEREX_sc_blogger_busy, $THEMEREX_sc_blogger_counter, $post;

	$THEMEREX_sc_blogger_busy = true;
	$THEMEREX_sc_blogger_counter = 0;

	if (!in_array($style, array('regular','date','image_large','image_medium','image_small','default','accordion','list', 'classic', 'date', 'carousel')))
		$style='regular';	
	if (!empty($ids)) {
		$posts = explode(',', str_replace(' ', '', $ids));
		$count = count($posts);
	}
	if ($visible <= 0) $visible = $count;

	if (sc_param_is_on($scroll) && empty($id)) $id = 'sc_blogger_'.str_replace('.', '', mt_rand());
	
	$block_link = (!empty($link_title) && !empty($link_url)) ? '<a class="sc_blogger_block_link" href="'.$link_url.'">'.$link_title.'</a>' : '';
	
	$output = '<div'
			. ($id ? ' id="' . $id . '"' : '') 
			. ' class="sc_blogger'
				. ' sc_blogger_' . ($dir=='vertical' ? 'vertical' : 'horizontal')
				. ' style_' . (in_array($style, array('accordion_1', 'accordion_2')) ? 'accordion' : (themerex_strpos($style, 'image')!==false ? 'image style_' : '') . $style)
				. (in_array($style, array('accordion_1', 'accordion_2')) ? ' sc_accordion' : '')
				. (themerex_strpos($style, 'portfolio')!==false ? ' portfolioWrap' : '')
				. '"'
			. ($s!='' ? ' style="'.$s.'"' : '')
		. '>'.(!empty($block_link) && !empty($title) ? $block_link : '')
		.(!empty($title) ? '<h2 class="sc_blogger_block_title">'.$title.'</h2>' : '')
		. ($dir!='vertical' && $style!='date' && $style!='accordion' && $style!='list' && $style!='carousel' ? '<div class="columnsWrap">' : '<div class="sc_'.$style.($style == 'carousel' ? ' swiper-wrapper' : '').'">');

	$args = array(
		'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
		'posts_per_page' => $count,
		'ignore_sticky_posts' => 1,
		'order' => $order=='asc' ? 'asc' : 'desc',
		'orderby' => 'date',
	);

	if ($offset > 0 && empty($ids)) {
		$args['offset'] = $offset;
	}

	$args = addSortOrderInQuery($args, $orderby, $order);
	$args = addPostsAndCatsInQuery($args, $ids, $cat);
	
	if($style == 'image_large')
		$thumb_style = 'excerpt';
	else if($style == 'image_small' || $style == 'image_medium')
		$thumb_style = 'image_medium';
	else if($style == 'regular' || $style == 'default')
		$thumb_style = 'regular';
	else if($style == 'carousel')
		$thumb_style = 'carousel';
	else
		$thumb_style = 'blogger';
		
	if(in_array($style, array('image_large', 'image_small', 'image_medium', 'regular', 'default'))) {
		$layout = 'blogger';
	}
	else if ($style == 'date') {
		$layout = 'blogger_date';
	}
	else if ($style == 'accordion') {
		$layout = 'blogger_accordion';
	}
	else if ($style == 'list') {
		$layout = 'blogger_list';
	}
	else if ($style == 'carousel') {
		$layout = 'blogger_carousel';
	}
	else { // If Layout style == excerpt
		$layout = 'blogger_style_2';
	}
	$query = new WP_Query( $args );
	$found = $query->found_posts;
		
	while ( $query->have_posts() ) { $query->the_post();
		$THEMEREX_sc_blogger_counter++;
		$output .= showPostLayout(
			array(
				'layout' => $layout,
				'show' => false,
				'number' => $THEMEREX_sc_blogger_counter,
				'add_view_more' => false,
				'posts_on_page' => $count,
				"reviews" => sc_param_is_on($rating),
				'thumb_size' => $thumb_style,
				'thumb_crop' => themerex_strpos($style, 'masonry')===false,
				'strip_teaser' => false,
				// Additional options to layout generator
				"descr" => $descr,
				"readmore" => $readmore,
				"dir" => $dir,
				"scroll" => sc_param_is_on($scroll),
				"info" => sc_param_is_on($info),
				"orderby" => $orderby,
				"posts_visible" => $visible,
				"categories_list" => true,
				"style" => $style,
				"tags_list" => false,
				"border" => $border,
				"found" => $found
			)
		);
	}
	wp_reset_postdata();
	$output .= '</div>';
	$output .= $style == 'carousel' ? '<a href="#" class="prev_slide"><i class="icon-left-open-big"></i></a><a href="#" class="next_slide"><i class="icon-right-open-big"></i></a><div class="swiper_scrollbar"></div>' : '';
	$output .= empty($title) && !empty($block_link) ? '<div class="sc_blogger_link_after">'.$block_link.'</div>' : '';
	$output	.= '</div>';
	
	$THEMEREX_sc_blogger_busy = false;
	if ($style == 'accordion') {
		wp_enqueue_script('jquery-ui-accordion', false, array('jquery','jquery-ui-core'), null, true);
	}
	
	return $output;
}

function in_shortcode_blogger() {
	global $THEMEREX_sc_blogger_busy;
	return $THEMEREX_sc_blogger_busy;
}
// ---------------------------------- [/blogger] ---------------------------------------




// ---------------------------------- [br] ---------------------------------------

add_shortcode("br", "sc_br");
						
//[br clear="left|right|both"]

function sc_br($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"clear" => ""
    ), $atts));
	return '<br' . (in_array($clear, array('left', 'right', 'both')) ? ' clear="' . $clear . '"' : '') . ' />';
}
// ---------------------------------- [/br] ---------------------------------------




// ---------------------------------- [button] ---------------------------------------


add_shortcode('button', 'sc_button');

/*
[button id="unique_id" type="square|round" fullsize="0|1" style="border|classic" size="mini|medium|big|huge" icon="icon-name" link='#' target='']Button caption[/button]
*/
function sc_button($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"type" => "square",
		"style" => "classic",
		"size" => "medium",
		"fullsize" => "0",
		"icon" => "",
		"color" => "",
		"link" => "#",
		"align" => "",
		"rel" => "",
		"popup" => "no",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
    
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($color !== '' ? ($style != 'border' ? 'background-color:' . $color . ';' : 'color:'.$color. ';' ) : '')
		.($align == 'left' ? 'float: left;' : '')
		.($align == 'right' ? 'float: right;' : '');
	$class = 'sc_button style_'.$style.' size_'.$size.' type_'.$type;
	$class .= $style == 'border'  ? (sc_is_accent_color($color) ? ' trex_accent_color trex_accent_bd_color' : '') : (sc_is_accent_color($color) ? ' trex_accent_bg_color' : '');
		
	return '<div class="sc_button_wrap'.($fullsize == 'true' ? ' fullSize' : '').'" style="'.($align == 'center' || $align == 'right' ? 'display:block;' : 'overflow:hidden').''.($align == 'center' ? 'text-align:center;' : '').'"><a href="'.$link.'" '.(!empty($s) ? 'style="'.$s.'"' : '').' class="'.$class.'">'.do_shortcode($content).'</a></div>';
}

// ---------------------------------- [/button] ---------------------------------------





// ---------------------------------- [chat] ---------------------------------------


add_shortcode('chat', 'sc_chat');

/*
[chat id="unique_id"]
[chat_item id="unique_id" link="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/chat_item]
[chat_item id="unique_id" link="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/chat_item]
[/chat]
*/
function sc_chat($atts, $content=null){
	$mult = get_custom_option('retina_ready');
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"link" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"image" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '');
		
	if ($image > 0) {
		$attach = wp_get_attachment_image_src( $image, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$image = $attach[0];
	}
	$image = !empty($image) ? getResizedImageTag($image, 65*$mult, 65*$mult) : '';
	
	$title = $title=='' ? $link : $title;
	$content = do_shortcode($content);
	if (themerex_substr($content, 0, 2)!='<p') $content = '<p>' . $content . '</p>';
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_chat"' . ($s ? ' style="'.$s.'"' : '') . '>'
		. ($title == '' ? '' : ('<p class="sc_quote_title">' . ($link!='' ? '<a href="'.$link.'">' : '') . $title . ($link!='' ? '</a>' : '') . '</p>'))
		. (!empty($image) ? '<div class="chat_thumb">'.$image.'</div>' : '')
		. '<div class="chat_content">'.$content.'</div>'
		.'</div>';
}

// ---------------------------------- [/chat] ---------------------------------------




// ---------------------------------- [columns] ---------------------------------------


add_shortcode('columns', 'sc_columns');

/*
[columns id="unique_id" count="number"]
	[column_item id="unique_id" span="2 - number_columns"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/column_item]
	[column_item]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/column_item]
	[column_item]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/column_item]
	[column_item]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna. Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim.[/column_item]
[/columns]
*/
$THEMEREX_sc_columns_count = 0;
$THEMEREX_sc_columns_counter = 0;
$THEMEREX_sc_columns_after_span2 = $THEMEREX_sc_columns_after_span3 = $THEMEREX_sc_columns_after_span4 = false;
function sc_columns($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"count" => "2",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'padding-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'padding-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	global $THEMEREX_sc_columns_count, $THEMEREX_sc_columns_counter, $THEMEREX_sc_columns_after_span2, $THEMEREX_sc_columns_after_span3, $THEMEREX_sc_columns_after_span4;
	$THEMEREX_sc_columns_counter = 1;
	$THEMEREX_sc_columns_after_span2 = $THEMEREX_sc_columns_after_span3 = $THEMEREX_sc_columns_after_span4 = false;
	$THEMEREX_sc_columns_count = $count = max(1, min(6, (int) $count));
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="columnsWrap sc_columns sc_columns_count_' . $count . '"'.($s!='' ? ' style="'.$s.'"' : '').'>' . do_shortcode($content).'</div>';
}


add_shortcode('column_item', 'sc_column_item');

//[column_item]
function sc_column_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"span" => "1"
	), $atts));
	global $THEMEREX_sc_columns_count, $THEMEREX_sc_columns_counter, $THEMEREX_sc_columns_after_span2, $THEMEREX_sc_columns_after_span3, $THEMEREX_sc_columns_after_span4;
	$span = max(1, min(4, (int) $span));
	$output = '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="columns'.($span > 1 ? $span : 1).'_'.$THEMEREX_sc_columns_count.' sc_column_item sc_column_item_'.$THEMEREX_sc_columns_counter 
					. ($THEMEREX_sc_columns_counter % 2 == 1 ? ' odd' : ' even') 
					. ($THEMEREX_sc_columns_counter == 1 ? ' first' : '') 
					. ($span > 1 ? ' span_'.$span : '') 
					. ($THEMEREX_sc_columns_after_span2 ? ' after_span_2' : '') 
					. ($THEMEREX_sc_columns_after_span3 ? ' after_span_3' : '') 
					. ($THEMEREX_sc_columns_after_span4 ? ' after_span_4' : '') 
					. '">' . do_shortcode($content) . '</div>';
	$THEMEREX_sc_columns_counter += $span;
	$THEMEREX_sc_columns_after_span2 = $span==2;
	$THEMEREX_sc_columns_after_span3 = $span==3;
	$THEMEREX_sc_columns_after_span4 = $span==4;
	return $output;
}

// ---------------------------------- [/columns] ---------------------------------------





// ---------------------------------- [Contact form] ---------------------------------------

add_shortcode("contact_form", "sc_contact_form");

//[contact_form id="unique_id" title="Contact Form" description="Mauris aliquam habitasse magna a arcu eu mus sociis? Enim nunc? Integer facilisis, et eu dictumst, adipiscing tempor ultricies, lundium urna lacus quis."]
function sc_contact_form($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"description" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	wp_enqueue_script( 'form-contact', get_template_directory_uri().'/js/_form_contact.js', array('jquery'), null, true );
	global $THEMEREX_ajax_nonce, $THEMEREX_ajax_url;
	return '<div ' . ($id ? ' id="' . $id . '"' : '') . 'class="sc_contact_form"'.($s!='' ? ' style="'.$s.'"' : '') .'>'
			. ($title ? '<h2 class="title">' . $title . '</h2>' : '')
			. ($description ? '<div class="description">' . $description . '</div>' : '')
			. '<form' . ($id ? ' id="' . $id . '"' : '') . ' data-formtype="contact" method="post" action="' . $THEMEREX_ajax_url . '">'
				.'<div class="columnsWrap">'
					.'<div class="columns1_2">'
						.'<label class="required" for="sc_contact_form_username">' . __('Name', 'themerex') . '</label><input id="sc_contact_form_username" type="text" name="username">'
					.'</div>'
					.'<div class="columns1_2">'
						.'<label class="required" for="sc_contact_form_email">' . __('E-mail', 'themerex') . '</label><input id="sc_contact_form_email" type="text" name="email">'
					.'</div>'
				.'</div>'
				.'<div class="message">'
					.'<label class="required" for="sc_contact_form_message">' . __('Your Message', 'themerex') . '</label><textarea id="sc_contact_form_message" class="textAreaSize" name="message"></textarea>'
				.'</div>'
				.'<div class="sc_contact_form_button">'
					.'<div class="squareButton ico"><a href="#" class="sc_button style_border size_big type_rounded sc_contact_form_submit">' . __('Send Message', 'themerex') . '</a></div>'
				.'</div>'
				.'<div class="result sc_infobox"></div>'
			.'</form>'
		.'</div>';
}
// ---------------------------------- [/Contact form] ---------------------------------------





// ---------------------------------- [Countdown] ---------------------------------------

add_shortcode("countdown", "sc_countdown");

//[countdown date="" time=""]
function sc_countdown($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"date" => "",
		"time" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => "",
		"style" => ""
    ), $atts));
    
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '');
		
	wp_enqueue_script( 'jPlugin', get_template_directory_uri() . '/js/jquery.plugin.min.js', array(), null, true );
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), null, true );
	
	$temp_date = strtotime($date.$time);
	$event_date = date('d M Y H:i', $temp_date);
	$alphas = range('a', 'z');
	
	$block_id = '';    
	for($i=0; $i<12; $i++) {
		$block_id .= $alphas[rand(0, 25)];
	}

	return '<div class="countdown_block style_'.$style.'" '.(!empty($s) ? ' style="'.$s.'"' : '').'>
    			<div id="'.$block_id.'" class="countdown"'.(!empty($font_color) ? ' style="color:'.$font_color.'"' : '').'></div>
    			<script>jQuery(document).ready(function(){ trex_countdown_init("'.$block_id.'", "'.$event_date.'") });</script>
    		</div>';
}
// ---------------------------------- [/Countdown] ---------------------------------------




// ---------------------------------- [divider] ---------------------------------------
add_shortcode('divider', 'sc_divider');

function sc_divider($atts, $content=null) {
	extract(shortcode_atts( array(
		"id" => "",
		"top" => "10",
		"bottom" => "10",
		"type" => "std",
		"color" => ""
	), $atts));
	
	$style = ' style="';
	$style .= !empty($top) ? 'margin-top:'.$top.'px;' : '';
	$style .= !empty($bottom) ? 'margin-bottom:'.$bottom.'px;' : '';
	if(!in_array($type, array('dashed', 'dotted'))) {
		$style .= !empty($color) ? 'background:'.$color : '';
	}
	else {
		$style .= !empty($color) ? 'border-top: '.$type.' 1px '.$color.'; height:0; background: none; '.$color : '';
	}
	$style .= '"';
	
	return '<div'.(!empty($id) ? ' id="'.$id.'"' : '').' class="sc_divider style_'.($type).'"'.$style.'></div>';
}
// ---------------------------------- [/divider] ---------------------------------------


						


// ---------------------------------- [dropcaps] ---------------------------------------

add_shortcode('dropcaps', 'sc_dropcaps');

//[dropcaps id="unique_id" style="1-6"]paragraph text[/dropcaps]
function sc_dropcaps($atts, $content=null){
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1"
    ), $atts));
	$style = min(6, max(1, $style));
	$content = do_shortcode($content);
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_dropcaps sc_dropcaps_style_' . $style . '">' 
			. '<span class="sc_dropcap">' . themerex_substr($content, 0, 1) . '</span>' . themerex_substr($content, 1)
		. '</div>';
}
// ---------------------------------- [/dropcaps] ---------------------------------------





// ---------------------------------- [E-mail collector] ---------------------------------------

add_shortcode("emailer", "sc_emailer");

//[emailer group=""]
function sc_emailer($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"group" => "",
		"open" => "yes",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '')
		;
	wp_enqueue_style( 'fontello-admin', get_template_directory_uri() . '/admin/css/fontello/css/fontello-admin.css', array(), null);
	return '<div class="sc_emailer inputSubmitAnimation' . ($align && $align!='none' ? ' sc_align' . $align : '') . (sc_param_is_on($open) ? ' ' : ' radCircle') . '"'.(!empty($s) ? ' style="'.$s.'"' : '').'>'
		. '<form><input type="text" class="sInput" name="email" value="" placeholder="'.__('Please, enter you email address.', 'themerex').'" class="sInput"></form>'
		. '<a href="#" class="sc_emailer_button searchIcon aIco mail" title="'.__('Submit', 'themerex').'" data-group="'.($group ? $group : __('E-mail collector group', 'themerex')).'"><i class="icon-mail-2"></i></a>'
		. '</div>';
}
// ---------------------------------- [/E-mail collector] ---------------------------------------





// --------------------- [Gallery] - only filter, not shortcode ------------------------

add_filter("post_gallery", "sc_gallery_filter", 10, 2);

function sc_gallery_filter($prm1, $atts) {
	if (in_shortcode_blogger()) return ' ';
	extract(shortcode_atts(array(
		"columns" => 0,
		"order" => "asc",
		"orderby" => "",
		"link" => "attachment",
		"include" => "",
		"exclude" => "",
		"ids" => ""
    ), $atts));

	$post = get_post();

	static $instance = 0;
	$instance++;
	
	$post_id = $post ? $post->ID : 0;
	
	if (empty($orderby)) $orderby = 'post__in';
	else $orderby = sanitize_sql_orderby( $orderby );

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $post_id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if (empty($columns) || $columns<2)
		$columns = count($attachments);
	$columns = max(2, min(4, intval($columns)));

	$thumb_sizes = getThumbSizes(array(
		'thumb_size' => 'classic'.$columns,
		'thumb_crop' => true,
		'sidebar' => false
	));
	
	$output = '<div id="sc_gallery_{$instance}" class="sc_gallery columnsWrap">';

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$thumb = getResizedImageTag(-$id, $thumb_sizes['w'], $thumb_sizes['h']);
		$full = wp_get_attachment_url($id);
		$url = get_permalink($id);
		$output .= '
			<div class="columns1_'.$columns.'">
				<div class="galleryPic">
					' . ($link=='file'
						? '<div class="thumb hoverIncrease" data-image="'.esc_attr($full).'" data-title="'.esc_attr($attachment->post_excerpt).'">
								'.$thumb.'
								<span class="hoverShadow"></span>
								<span class="hoverIcon"></span>
							</div>'
						: '<div class="thumb">
								<a href="' . $url . '">'.$thumb.'</a>
							</div>') .'
					<h4>'.esc_attr($attachment->post_excerpt).'</h4>
				</div>
			</div>';
	}

	$output .= '</div>';

	return $output;
	
}
// ---------------------------------- [/Gallery] ---------------------------------------



// ---------------------------------- [trx_gap] ---------------------------------------

add_shortcode("trx_gap", "sc_gap");
						
//[trx_gap]Fullwidth content[/trx_gap]

function sc_gap($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	return sc_gap_start() . do_shortcode($content) . sc_gap_end();
	//return closeAllWrappers(false) . do_shortcode($content) . openAllWrappers(false);
}

function sc_gap_start() {
	return '<!-- #TRX_GAP_START# -->';
}

function sc_gap_end() {
	return '<!-- #TRX_GAP_END# -->';
}

function sc_gap_wrapper($str) {
	// Move VC row and column and wrapper inside gap
	$str_new = preg_replace('/(<div\s+class="vc_row[^>]*>)[\r\n\s]*(<div\s+class="vc_col[^>]*>)[\r\n\s]*(<div\s+class="wpb_wrapper[^>]*>)[\r\n\s]*('.sc_gap_start().')/i', '\\4\\1\\2\\3', $str);
	if ($str_new != $str) $str = preg_replace('/('.sc_gap_end().')[\r\n\s]*(<\/div>)[\r\n\s]*(<\/div>)[\r\n\s]*(<\/div>)/i', '\\2\\3\\4\\1', $str_new);
	// Gap layout
	return str_replace(
			array(sc_gap_start(), sc_gap_end()),
			array(closeAllWrappers(false).'<div class="sc_gap">', '</div>'.openAllWrappers(false)),
			$str
			); 
}
// ---------------------------------- [/trx_gap] ---------------------------------------




// ---------------------------------- [Google maps] ---------------------------------------

add_shortcode("googlemap", "sc_google_map");

//[googlemap id="unique_id" address="your_address" width="width_in_pixels_or_percent" height="height_in_pixels"]
function sc_google_map($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "sc_googlemap",
		"width" => "100%",
		"height" => "240",
		"address" => "",
		"latlng" => "",
		"zoom" => 16,
		"style" => '',
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	if ((int) $width < 100 && $ed != '%') $width='100%';
	if ((int) $height < 50) $height='100';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width >= 0 ? 'width:' . $width . $ed . ';' : '')
		.($height >= 0 ? 'height:' . $height . 'px;' : '');
	wp_enqueue_script( 'googlemap', 'http://maps.google.com/maps/api/js?sensor=false', array(), null, true );
	wp_enqueue_script( 'googlemap_init', get_template_directory_uri().'/js/_googlemap_init.js', array(), null, true );
	return '<div id="' . $id . '" class="sc_googlemap"'.($s!='' ? ' style="'.$s.'"' : '') 
		.' data-address="'.esc_attr($address).'"'
		.' data-latlng="'.esc_attr($latlng).'"'
		.' data-zoom="'.esc_attr($zoom).'"'
		.' data-style="'.esc_attr($style).'"'
		.' data-point="'.esc_attr(get_custom_option('googlemap_marker')).'"'
		.'></div>';
}
// ---------------------------------- [/Google maps] ---------------------------------------





// ---------------------------------- [hide] ---------------------------------------


add_shortcode('hide', 'sc_hide');

/*
[hide selector="unique_id"]
*/
function sc_hide($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"selector" => ""
    ), $atts));
	$selector = trim(chop($selector));
	return $selector == '' ? '' : 
		'<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("' . $selector . '").hide();
			});
		</script>';
}
// ---------------------------------- [/hide] ---------------------------------------





// ---------------------------------- [highlight] ---------------------------------------


add_shortcode('highlight', 'sc_highlight');

/*
[highlight id="unique_id" color="fore_color's_name_or_#rrggbb" backcolor="back_color's_name_or_#rrggbb" style="custom_style"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/highlight]
*/
function sc_highlight($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"color" => "",
		"backcolor" => "",
		"style" => "",
		"type" => "1"
    ), $atts));
	$s = ($color != '' ? 'color:' . $color . ';' : '')
		.($backcolor != '' ? 'background-color:' . $backcolor . ';' : '')
		.($style != '' ? $style : '');
	return '<span' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_highlight'.($type>0 ? ' sc_highlight_style_'.$type : '').'"'.($s!='' ? ' style="'.$s.'"' : '').'>' . do_shortcode($content) . '</span>';
}
// ---------------------------------- [/highlight] ---------------------------------------





// ---------------------------------- [icon] ---------------------------------------


add_shortcode('icon', 'sc_icon');

/*
[icon id="unique_id" style='round|square' icon='' color="" bg_color="" size="" weight=""]
*/
function sc_icon($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"icon" => "",
		"color" => "",
		"size" => "",
		"weight" => "",
		"background" => "",
		"bg_color" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s =  ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		. ($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		. ($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		. ($right !== '' ? 'margin-right:' . $right . 'px;' : '')
	;
	$s2 = ($weight != '' ? 'font-weight:'. $weight.';' : '')
		. ((int) $size > 0 ? 'font-size:'.$size.'px;' : '')
		. ($color != '' ? 'color:'.$color.';' : '')
		. ($bg_color != '' ? 'background-color:'.$bg_color.';' : '')
		. ($background == 'round' && (int) $size > 0 ? ($s ? '' : 'display:inline-block;') . 'width:' . round($size*1.2) . 'px;height:' . round($size*1.2) . 'px;line-height:' . round($size*1.2) . 'px;' : '')
	;
	$output = $icon!='' ? '<span class="sc_icon '.$icon.($background && $background!='none' ? ' sc_icon_'.$background : ''). '"' . ($s || $s2 ? ' style="'.($s ? 'display:block;' : '') . $s . $s2 . '"' : '') . '></span>' : '';
	if(!empty($output) && $align == 'center') {
		$output = '<div class="sc_icon_wrap_centred">'.$output.'</div>';
	}
	return $output;
}

// ---------------------------------- [/icon] ---------------------------------------





// ---------------------------------- [image] ---------------------------------------


add_shortcode('image', 'sc_image');

/*
[image id="unique_id" src="image_url" width="width_in_pixels" height="height_in_pixels" title="image's_title" align="left|right"]
*/
function sc_image($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"src" => "",
		"url" => "",
		"title" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "-1",
		"height" => "-1"
    ), $atts));
	$src = $src!='' ? $src : $url;
	if ($src > 0) {
		$attach = wp_get_attachment_image_src( $src, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$src = $attach[0];
	}
    $top = $top == -1 ? 0 : $top;
    $bottom = $bottom == -1 ? 0 : $bottom;
    $left = $left == -1 ? 0 : $left;
    $right = $right == -1 ? 0 : $right;
    $height = $height == -1 ? '' : $height;
    $width = $width == -1 ? '' : $width;
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = (!empty($top) ? 'margin-top:' . $top . 'px;' : '')
		.(!empty($bottom) ? 'margin-bottom:' . $bottom . 'px;' : '')
		.(!empty($left) ? 'margin-left:' . $left . 'px;' : '')
		.(!empty($right) ? 'margin-right:' . $right . 'px;' : '')
		.(!empty($width) ? 'width:' . $width . $ed . ';' : '')
		.(!empty($height) ? 'height:' . $height . 'px;' : '')
		;
	return '<figure' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_image ' . ($align && $align!='none' ? ' sc_image_align_' . $align : '') . '"'.($s!='' ? ' style="'.$s.'"' : '').'>'
				.'<img src="' . $src . '" border="0" alt="" />'.(trim($title) ? '<figcaption><span>' . $title . '</span></figcaption>' : '') 
			. '</figure>';
}

// ---------------------------------- [/image] ---------------------------------------






// ---------------------------------- [infobox] ---------------------------------------


add_shortcode('infobox', 'sc_infobox');

/*
[infobox id="unique_id" style="regular|info|success|error|result" static="0|1"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/infobox]
*/
function sc_infobox($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular",
		"closeable" => "no",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '');
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_infobox sc_infobox_style_' . $style . (sc_param_is_on($closeable) ? ' sc_infobox_closeable' : '') . '"'.($s!='' ? ' style="'.$s.'"' : '').'>'
			.(sc_param_is_on($closeable) ? '<i class="icon-cancel icon"></i>' : '')
			. do_shortcode($content) 
			. '</div>';
}

// ---------------------------------- [/infobox] ---------------------------------------





// ---------------------------------- [line] ---------------------------------------


add_shortcode('line', 'sc_line');

/*
[line id="unique_id" style="none|solid|dashed|dotted|double|groove|ridge|inset|outset" top="margin_in_pixels" bottom="margin_in_pixels" width="width_in_pixels_or_percent" height="line_thickness_in_pixels" color="line_color's_name_or_#rrggbb"]
*/
function sc_line($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "solid",
		"color" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width >= 0 ? 'width:' . $width . $ed . ';' : '')
		.($height >= 0 ? 'border-top-width:' . $height . 'px;' : '')
		.($style != '' ? 'border-top-style:' . $style . ';' : '')
		.($color != '' ? 'border-top-color:' . $color . ';' : '');
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_line' . ($style != '' ? ' sc_line_style_' . $style : '') . '"'.($s!='' ? ' style="'.$s.'"' : '').'></div>';
}

// ---------------------------------- [/line] ---------------------------------------





// ---------------------------------- [list] ---------------------------------------

add_shortcode('list', 'sc_list');

/*
[list id="unique_id" style="regular|check|mark|error"]
	[list_item id="unique_id" title="title_of_element"]Et adipiscing integer.[/list_item]
	[list_item]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in.[/list_item]
	[list_item]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer.[/list_item]
	[list_item]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus.[/list_item]
[/list]
*/
$THEMEREX_sc_list_icon = '';
$THEMEREX_sc_list_style = '';
$THEMEREX_sc_list_counter = 0;
function sc_list($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "arrows",
		"icon" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	global $THEMEREX_sc_list_counter, $THEMEREX_sc_list_icon, $THEMEREX_sc_list_style;
	if (trim($style) == '' || (trim($icon) == '' && $style=='iconed')) $style = 'iconed';
	if ($style == 'arrows' && trim($icon) == '') $icon = 'icon-right-open-big';
	$THEMEREX_sc_list_counter = 0;
	$THEMEREX_sc_list_icon = $icon;
	$THEMEREX_sc_list_style = $style;
	return '<' . ($style=='ol' ? 'ol' : 'ul') . ($id ? ' id="' . $id . '"' : '') . ' class="sc_list sc_list_style_' . $style . '"' . ($s!='' ? ' style="'.$s.'"' : '') . '>'
			. do_shortcode($content) 
			. '</' .($style=='ol' ? 'ol' : 'ul') . '>';
}


add_shortcode('list_item', 'sc_list_item');

//[list_item]
function sc_list_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"icon" => "",
		"title" => "",
		"link" => "",
		"target" => ""
	), $atts));
	global $THEMEREX_sc_list_counter, $THEMEREX_sc_list_icon, $THEMEREX_sc_list_style;
	$THEMEREX_sc_list_counter++;
	if (trim($icon) == '') $icon = $THEMEREX_sc_list_icon;
	return '<li' . ($id ? ' id="' . $id . '"' : '') 
		. ' class="sc_list_item' . ($icon!='' ? ' '.$icon : '') 
		. ($THEMEREX_sc_list_counter % 2 == 1 ? ' odd' : ' even') 
		. ($THEMEREX_sc_list_counter == 1 ? ' first' : '')  
		. '"' 
		. ($title ? ' title="' . $title . '"' : '') 
		. '>'
		.(in_array($THEMEREX_sc_list_style, array('ol', 'ol_filled')) ? '<span class="sc_list_num">'.$THEMEREX_sc_list_counter.'</span>' : '') 
		. (!empty($link) ? '<a href="' . $link . '"' . (!empty($target) ? ' target="' . $target . '"' : '') . '>' : '')
		. do_shortcode($content)
		. (!empty($link) ? '</a>': '')
		. '</li>';
}

// ---------------------------------- [/list] ---------------------------------------




// ---------------------------------- [popup] ---------------------------------------

add_shortcode('popup', 'sc_popup');

/*
[popup id="unique_id" class="class_name" style="css_styles"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/popup]
*/
function sc_popup($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"style" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.$style;
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_popup sc_popup_light mfp-with-anim mfp-hide' . ($class ? ' '.$class : '') . '"'.($s!='' ? ' style="'.$s.'"' : '').'>' 
			. do_shortcode($content) 
			. '</div>';
}
// ---------------------------------- [/popup] ---------------------------------------






// ---------------------------------- [trx_price] ---------------------------------------


add_shortcode('trx_price', 'sc_price');

/*
[trx_price id="unique_id" currency="$" money="29.99" period="monthly"]

*/
function sc_price($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"money" => "",
		"currency" => "$",
		"period" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$output = '';
	if (!empty($money)) {
		$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
			.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
			.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
			.($right !== '' ? 'margin-right:' . $right . 'px;' : '');
		$m = explode('.', str_replace(',', '.', $money));
		if (count($m)==1) $m[1] = '';
		$output = '
			<div class="sc_price_item">
				<span class="sc_price_currency">'.$currency.'</span>
				<div class="sc_price_money">'.$m[0].'</div>
				<div class="sc_price_info">
					<div class="sc_price_penny">'.$m[1].'</div>
					<div class="sc_price_period">'.$period.'</div>
				</div>
			</div>
		';
	}
	return $output;
}

// ---------------------------------- [/trx_price] ---------------------------------------





// ---------------------------------- [trx_price_table] ---------------------------------------

add_shortcode('trx_price_table', 'sc_price_table');

/*
[trx_price_table id="unique_id" align="left|right|center"]
	[trx_price_item id="unique_id"]
		[trx_price_data id="unique_id" type="title|price|footer|united"]Et adipiscing integer.[/trx_price_data]
		[trx_price_data id="unique_id" type="title|price|footer"]Et adipiscing integer.[/trx_price_data]
		[trx_price_data id="unique_id" type="title|price|footer"]Et adipiscing integer.[/trx_price_data]
	[/trx_price_item]
	[trx_price_item]
		[trx_price_data id="unique_id" type="title|price|footer"]Et adipiscing integer.[/trx_price_data]
		[trx_price_data id="unique_id" type="title|price|footer"]Et adipiscing integer.[/trx_price_data]
		[trx_price_data id="unique_id" type="title|price|footer"]Et adipiscing integer.[/trx_price_data]
	[/trx_price_item]
[/trx_price_table]
*/
$THEMEREX_sc_price_table_counter = 0;
$THEMEREX_sc_price_data_row = 0;
function sc_price_table($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"align" => "",
		"count" => 1,
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'padding-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'padding-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '');
		
	global $THEMEREX_sc_price_table_counter;
	$THEMEREX_sc_price_table_counter = 0;
	$count = max(1, $count);
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_pricing_table columns_' . $count . ($align && $align!='none' ? ' align'.themerex_strtoproper($align) : '') . '"'.(!empty($s) ? ' style="'.$s.'"' : '').'>'
			. do_shortcode($content)
		. '</div>';
}


add_shortcode('trx_price_item', 'sc_price_item');

//[trx_price_item]
function sc_price_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"animation" => "yes"
	), $atts));
	global $THEMEREX_sc_price_table_counter, $THEMEREX_sc_price_data_row;
	$THEMEREX_sc_price_data_row = 0;
	$THEMEREX_sc_price_table_counter++;
	return '<div class="sc_pricing_columns sc_pricing_column_'.$THEMEREX_sc_price_table_counter.'"><ul'.(sc_param_is_on($animation) || $animation == 'highlight' ? ' class="columnsAnimate'.($animation == 'highlight' ? ' highlight' : '').'"' : '') . ($id ? ' id="' . $id . '"' : '') . '>'
		. do_shortcode($content) 
		. '</ul></div>';
}


add_shortcode('trx_price_data', 'sc_price_data');

//[trx_price_data]
function sc_price_data($atts, $content=null) {
	global $THEMEREX_sc_price_data_row;
	$THEMEREX_sc_price_data_row++;
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"type" => "",
		"image" => "",
		"money" => "",
		"currency" => "$",
		"period" => "",
		"link" => ""
	), $atts));
	if($type == 'united')
		$THEMEREX_sc_price_data_row++;
	if (!in_array($type, array('title', 'price', 'titled', 'united', 'image', 'footer'))) $type="";
	if ($type=='price' && $money!='') {
		$m = explode('.', str_replace(',', '.', $money));
		if (count($m)==1) $m[1] = '';
		$content = '
			<div class="sc_price_item">
				<span class="sc_price_currency">'.$currency.'</span>
				<div class="sc_price_money">'.$m[0].'</div>
				<div class="sc_price_info">
					<div class="sc_price_period">'.$period.'</div>
				</div>
			</div>';
	} else if ($type=='image' && $image!='') {
		if ($image > 0) {
			$attach = wp_get_attachment_image_src( $image, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$image = $attach[0];
		}
		$type = 'title_img';
		$content = '<img src="' . $image . '" border="0" alt="" />';
		$content = !empty($link) ? '<a href="'.$link.'">'.$content.'<i class="icon-basket-1"></i></a>' : $content;
	} else if ($type == 'titled') {
		$m = explode('.', str_replace(',', '.', $money));
		if (count($m)==1) $m[1] = '';
		$content = '
			<div class="sc_price_item">
				<div class="sc_price_title">'.$content.'</div>
				<div class="sc_price_wrap">
					<span class="sc_price_currency">'.$currency.'</span>
					<span class="sc_price_money">'.$m[0].'</span>
					'.(!empty($period) ? '<span class="sc_price_period_divider">/</span><span class="sc_price_period">'.$period.'</span>' : '').'
				</div>
			</div>';
	} else
		$content = do_shortcode($content);
		
		$content = $type == 'united' ?  '<div class="table_united">'.$content.'</div>' : $content;
		
	return '<li' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_pricing_data' . ($type!='' ? ' sc_pricing_'.$type : '') .' '. ($THEMEREX_sc_price_data_row%2 == 0 ? 'even' : 'odd').'">' .$content . '</li>';
}

// ---------------------------------- [/trx_price_table] --------------------------------------




// ---------------------------------- [quote] ---------------------------------------


add_shortcode('quote', 'sc_quote');

/*
[quote id="unique_id" style="1|2" cite="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/quote]
*/
function sc_quote($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"cite" => ""
    ), $atts));
	$cite_param = $cite != '' ? ' cite="' . $cite . '"' : '';
	$title = $title=='' ? $cite : $title;
	$content = do_shortcode($content);
	if (themerex_substr($content, 0, 2)!='<p') $content = '<p>' . $content . '</p>';
	return '<span class="icon icon-quote-1 sc_quote_icon"></span><blockquote' . ($id ? ' id="' . $id . '"' : '') . $cite_param . ' class="sc_quote"' . '>'
		. $content
		. ($title == '' ? '' : ('<p class="sc_quote_title">' . ($cite!='' ? '<a href="'.$cite.'">' : '') . $title . ($cite!='' ? '</a>' : '') . '</p>'))
		.'</blockquote>';
}

// ---------------------------------- [/quote] ---------------------------------------






// ---------------------------------- [review panel] ---------------------------------------

add_shortcode('review_panel', 'sc_review_panel');
$THEMEREX_reviews_max = '';
$THEMEREX_criterias_list = array();
/*
[review_panel id="unique_id" post_id=""]
*/
function sc_review_panel($atts, $content=null){
    extract(shortcode_atts(array(
		"id" => "",
		"post_id" => "",
		"title" => "",
		"max" => "100",
		"desc" => "",
		"align" => "",
		"width" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
    
    global $THEMEREX_reviews_max, $THEMEREX_criterias_list;  
    $THEMEREX_reviews_max = $max != 0 ? $max : 100;
    
	$width = (int) str_replace('%', '', $width);
	
	$s = ($top > 0 ? 'padding-top:' . $top . 'px;' : '')
		.($bottom > 0 ? 'padding-bottom:' . $bottom . 'px;' : '')
		.($left > 0 ? 'padding-left:' . $left . 'px;' : '')
		.($right > 0 ? 'padding-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width.'px;' : '')
		.($align == 'left' || $align == 'right' ? 'float: '.$align : ($align == 'center' ? 'margin: 0 auto;' : ''));
	
	if(!empty($post_id)) {
		$title = empty($title) ? get_the_title($post_id) : $title;
		if(empty($desc)) {
			$post = get_post($post_id);
			$post_excerpt = !empty($post->post_excerpt) ? $post->post_excerpt : '';
			$post_excerpt = do_shortcode($post_excerpt);
			$desc = $post_excerpt;
		}
		$post_cust = get_post_custom($post_id);
		$post_opts = !empty($post_cust['post_custom_options'][0]) ? unserialize($post_cust['post_custom_options'][0]) : '';
		$review_marks = !empty($post_opts['reviews_marks']) ? $post_opts['reviews_marks'] : '';
		$reviews_points = !empty($review_marks) ? explode(',', $review_marks) : '';
		$review_criterias = get_custom_option('reviews_criterias', '', $post_id);
		$criterias_points = array();
		if(!empty($review_criterias) && !empty($reviews_points)) {
			foreach ($review_criterias as $key => $criteria) {
				$criterias_points[$criteria] = $reviews_points[$key];
			}
		}		
		if(!empty($criterias_points)) {
			$content = trex_vote_results($criterias_points, $max, $width);
		}
	}
	else {
		$content = do_shortcode($content);
		$content = trex_vote_results($THEMEREX_criterias_list, $max, $width);
	}
	
	
	$output = '<div class="sc_review_panel" style="'.$s.'">
				'.(!empty($title) ? '<h3 class="sc_review_title">'.$title.'</h3>' : '').'
				<div class="sc_review_inner">';
	$output .= $content;
	$output .= '</div>
			   '.(!empty($desc) ? '<div class="sc_review_desc">'.$desc.'</div>' : '').'
			</div>';
		
	return $output;
}

add_shortcode('review_item', 'sc_review_item');

/*
[review_item max='10' points='10' label='']
*/
function sc_review_item($atts, $content=null){
    global $THEMEREX_reviews_max, $THEMEREX_criterias_list;
	extract(shortcode_atts(array(
		'points' => '',
		'label' => ''
	), $atts));
	
	$points_perc = !empty($points) ? ($points/$THEMEREX_reviews_max) * 100 : '';
	$THEMEREX_criterias_list[$label] = $points_perc;
}
// ---------------------------------- [/review panel] ---------------------------------------





// ---------------------------------- [section] and [block] ---------------------------------------

add_shortcode('section', 'sc_section');
add_shortcode('block', 'sc_section');

/*
[section id="unique_id" class="class_name" style="css-styles" dedicated="yes|no"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/section]
*/
$THEMEREX_sc_section_dedicated = '';

function sc_section($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"style" => "",
		"align" => "none",
		"columns" => "none",
		"dedicated" => "no",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"text_align" => "",
		"background_color" => "",
		"background_image" => "",
		"background_pos_x" => "",
		"background_pos_y" => "",
		"background_repeat" => "",
		"background_size" => "",
		"content_wrap" => "",
		"parallax" => false
    ), $atts));

	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);

	if ($background_image > 0) {
		$attach = wp_get_attachment_image_src( $background_image, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$background_image = $attach[0];
	}
	
	$bg_pos = !empty($background_pos_x) ? $background_pos_x : '0';
	$bg_pos .= !empty($background_pos_y) ? ' '.$background_pos_y : ' 0';
	
	$s = ($width >= 0 ? 'max-width:' . $width . $ed . ';' : '')
		.($height >= 0 ? 'height:' . $height . 'px;' : '')
		.($top !== '' ? 'margin-top:' . $top . 'px !important;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px !important;' : '')
		.($background_color !== '' ? 'background-color:' .$background_color. ';' : '' )
		.($background_image !== '' ? 'background-image:url(' .$background_image. ');' : '' )
		.($background_repeat !== '' ? 'background-repeat: '.$background_repeat.';' : '' )
		.($background_size !== '' ? 'background-size: '.$background_size.';' : '' )
		.($bg_pos !== '' ? 'background-position: '.$bg_pos.';' : '' )
		;
	if(in_array($align, array('left', 'right')))
		$s .= 'float:'.$align.';';
	if($align == 'center') {
		$s .= 'margin: 0 auto;';
	}
	else {
		$s .=($left !== '' ? 'margin-left:' . $left . 'px !important;' : '')
			.($right !== '' ? 'margin-right:' . $right . 'px !important;' : '')
		.$style;
	}
	$s .= $text_align !== '' ? 'text-align:' . $text_align . ';' : '';

	$output = '<div' . ($id ? ' id="' . $id . '"' : '') 
		. ' class="sc_section' 
			. ($class ? ' ' . $class : '')
			. (!empty($columns) && $columns!='none' ? ' columns'.$columns : '') 
			. (sc_param_is_on($parallax) ? ' sc_section_parallax' : '')
		. '"'
		.($s!='' ? ' style="'.$s.'"' : '').'>' 
		. (sc_param_is_on($content_wrap) ? '<div class="container">' : '')
		. do_shortcode($content) 
		. (sc_param_is_on($content_wrap) ? '</div>' : '')
		. '</div>';
	if (sc_param_is_on($dedicated)) {
		global $THEMEREX_sc_section_dedicated;
		if (empty($THEMEREX_sc_section_dedicated)) {
			$THEMEREX_sc_section_dedicated = $output;
		}
		$output = '';
	}
	return $output;
}

function clear_dedicated_content() {	
	global $THEMEREX_sc_section_dedicated;
	$THEMEREX_sc_section_dedicated = '';
}

function get_dedicated_content() {	
	global $THEMEREX_sc_section_dedicated;
	return $THEMEREX_sc_section_dedicated;
}
// ---------------------------------- [/section] ---------------------------------------




// ---------------------------------- [themerex_sidebar] ---------------------------------------


add_shortcode('themerex_sidebar', 'sc_trex_sidebar');

/*
[themerex_sidebar name='sc_trex_sidebar']
*/
function sc_trex_sidebar($atts, $content=null){
	extract(shortcode_atts(array(
		'name' => '',
		"layout" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
	), $atts));
	
	$s = ($top > 0 ? 'padding-top:' . $top . 'px;' : '')
		.($bottom > 0 ? 'padding-bottom:' . $bottom . 'px;' : '')
		.($left > 0 ? 'padding-left:' . $left . 'px;' : '')
		.($right > 0 ? 'padding-right:' . $right . 'px;' : '');
	
	global $THEMEREX_current_sidebar;
	$THEMEREX_current_sidebar = $layout ==  'columns' ? 'shortcode_sidebar' : '';
	
	if(!empty($name)) {
		ob_start();
		dynamic_sidebar($name);
		$sidebar_content = ob_get_contents();
		ob_end_clean();
	}
	$sidebar_content = $layout == 'columns' ? '<div class="columnsWrap">'.$sidebar_content.'</div>' : $sidebar_content;
	
	return '<div class="sc_sidebar_selector"'.(!empty($s) ? ' style="'.$s.'"' : '').'>'.$sidebar_content.'</div>';
}
// ---------------------------------- [/themerex_sidebar] ---------------------------------------





// ---------------------------------- [skills] ---------------------------------------


add_shortcode('skills', 'sc_skills');

/*
[skills id="unique_id" type="bar|pie|arc|counter" dir="horizontal|vertical" layout="rows|columns" count="" maximum="100" align="left|right"]
	[skills_item title="Scelerisque pid" level="50%"]
	[skills_item title="Scelerisque pid" level="50%"]
	[skills_item title="Scelerisque pid" level="50%"]
[/skills]
*/

$THEMEREX_sc_skills_children = array();

function sc_skills($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"type" => "bar",
		"dir" => "",
		"layout" => "",
		"align" => "",
		"color" => "",
		"maximum" => "100",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($width >= 0 ? 'width:' . $width . $ed . ';' : '')
		.($height >= 0 ? 'height:' . $height . 'px;' : '')
		.($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($align != '' && $align != 'none' ? 'float:' . $align . ';' : '');
	global $THEMEREX_sc_skills_children;
	$THEMEREX_sc_skills_children = '';
	
	$wrapper_class = 'sc_skills sc_skills_type_'.$type;
	
	$content = do_shortcode($content);
	
	$wrapper_class .= $layout == 'columns' ? '' : '';
	$wrapper_class .= ' '.$dir;
	
	foreach ($THEMEREX_sc_skills_children as $label => $value) {
		$child_count = count($THEMEREX_sc_skills_children);
		$perc_val = ($value['level'] * 100) / $maximum;
		$perc_val = $perc_val > 100 ? 100 : $perc_val;
		
		$perc_val = $dir == 'vertical' ? ($height * $perc_val) / 100 : $perc_val;
		
		$column_width = 100/$child_count;
		$item_color = !empty($value['color']) ? $value['color'] : $color;
		$item_color = sc_is_accent_color($item_color) ? false : $item_color;
		$value['level'] = $maximum == 100 ? $value['level'].'%' : $value['level'];
		
		$content .= '<div class="sc_skills_item'.($layout == 'columns' ? ' columns1_'.$child_count : '').'"'.($dir == 'vertical' ? ' style="width:'.$column_width.'%;"' : '').'>';
		if($type == 'bar') {
			if($dir == 'horizontal') {
				$content .= '<div class="sc_skills_item_title">'.$label.'</div>';
				$content .= '<div class="sc_skills_item_level">'.$value['level'].'</div>';
			}
			$content .= '<div class="sc_skills_item_progress" data-val="'.$perc_val.'" style="'.($dir == 'vertical' ? ' height:'.$height.'px;' : (!empty($item_color) ? 'background-color:'.$item_color.';' : '')).'">'.($dir == 'horizontal' ? '<span class="sc_skills_item_progress_title">'.$label.'</span>' : '<div class="progress_inner" style="'.(!empty($item_color) ? 'background-color:'.$item_color : '').'"></div>').'</div>';
			if($dir == 'vertical') {
				$content .= '<div class="sc_skills_item_level">'.$value['level'].'</div>';
				$content .= '<div class="sc_skills_item_title">'.$label.'</div>';
			}
		}
		else if($type == 'circles') {
			$content .= '<div class="sc_skills_item_level" style="line-height:'.$value['width'].'px;" data-val="'.(int)$value['level'].'" data-ed="'.($maximum == 100 ? '%' : '').'" data-step="'.(number_format($value['level']/50, 0)).'"></div>';
			$content .= '<input type="hidden" class="knob_review" value="'.$perc_val.'" data-thickness="'.($value['width'] > 100 ? '.09' : '.12').'" data-readOnly=true data-width="'.$value['width'].'" data-height="'.$value['width'].'" data-fgColor='.(!empty($value['color']) ? $value['color'] : $color).'>';
			$content .= '<div class="sc_skills_item_title">'.$label.'</div>';
		}
		else if($type == 'counter') {
			$content .= '<div class="sc_skills_item_progress'.(!empty($value['style']) ? ' sc_skills_item_style_'.$value['style'] : '').'" data-val="'.(int)$value['level'].'" data-ed="'.($maximum == 100 ? '%' : '').'"'.(!empty($item_color) ? ' style="color:'.$item_color.'"' : '').' data-step="'.(number_format($value['level']/50, 0)).'">0</div>';
			$content .= '<div class="sc_skills_item_title">'.$label.'</div>';
		}
 		$content .= '</div>';
	}
	$content = $layout == 'columns' ? '<div class="columnsWrap">'.$content.'</div>' : $content;
	$content = $dir == 'vertical' ? '<div class="sc_skills_item_wrap">'.$content.'</div>' : $content;
	
	if(!empty($content)) {
		$output = '<div class="'.$wrapper_class.'" data-type="'.$type.'" data-dir="'.$dir.'"'.($dir == 'vertical' ? ' style="height:'.$height.'px"' : '').'>'.$content.'</div>';
	}
	return $output;
}


add_shortcode('skills_item', 'sc_skills_item');

//[skills_item]
function sc_skills_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"title" => "",
		"level" => "",
		"color" => "",
		"width" => "178",
		"style" => ""
	), $atts));
	
	global $THEMEREX_sc_skills_children;
	
	$color = sc_clear_accent_color($color);
	$THEMEREX_sc_skills_children[$title] = array('color' => $color, 'level' => $level, 'width' => $width);
	
	if(!empty($style)) {
		$THEMEREX_sc_skills_children[$title]['style'] = $style;
	}
	return;
}

// ---------------------------------- [/skills] ---------------------------------------






// ---------------------------------- [slider] ---------------------------------------

add_shortcode('slider', 'sc_slider');

/*
[slider id="unique_id" engine="revo|royal|" alias="revolution_slider_alias|royal_slider_id" titles="0|1|2" cat="category_id or slug" count="posts_number" ids="comma_separated_id_list" offset="" width="" height="" align="" top="" bottom=""]
[slider_item src="image_url"]
[/slider]
*/

$THEMEREX_sc_slider_engine = '';
$THEMEREX_sc_slider_width = 0;
$THEMEREX_sc_slider_height = 0;
$THEMEREX_sc_slider_links = false;

function sc_slider($atts, $content=null){
	global $mult;
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"engine" => "swiper",
		"alias" => "",
		"ids" => "",
		"cat" => "",
		"count" => "0",
		"offset" => "",
		"orderby" => "date",
		"order" => 'desc',
		"border" => "none",
		"controls" => "no",
		"pagination" => "no",
		"caption" => "no",
		"links" => "no",
		"align" => "",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"info" => "yes",
		"progressbar" => "",
		"date_before" => "",
		"date_after" => ""
    ), $atts));
	global $THEMEREX_sc_slider_engine, $THEMEREX_sc_slider_width, $THEMEREX_sc_slider_height, $THEMEREX_sc_slider_links, $trex_accent_color;
	$THEMEREX_sc_slider_engine = $engine;
	$THEMEREX_sc_slider_width = $width;
	$THEMEREX_sc_slider_height = $height;
	$THEMEREX_sc_slider_links = sc_param_is_on($links);
	
	$show_pagination = in_array($pagination, array('default', 'thumbs', 'icons')) ? true : false;
	
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.(!empty($width) ? 'width:' . $width . (themerex_strpos($width, '%')!==false ? '' : 'px').';' : '')
		.(!empty($height) ? 'height:' . $height . (themerex_strpos($height, '%')!==false ? '' : 'px').';' : '');
	$output = '';
	
	if($pagination == 'thumbs' || $pagination == 'icons')
		$output .= '<div class="slider_wrap">';
	$output .= ($border!='none' 
				? '<div class="sc_border sc_border_'.$border.($align!='' && $align!='none' ? ' sc_align'.$align : '').'">' 
				: '')
			. '<div' . ($id ? ' id="' . $id . '"' : '') 
			. ' class="sc_slider'
				. ' sc_slider_' . $engine
				. (sc_param_is_on($controls) ? ' sc_slider_controls' : ' sc_slider_nocontrols')
				. ((!empty($width) && $width < 600) ? ' sc_slider_compact' : '')
				. ($pagination == 'default' ? ' sc_slider_pagination' : ' sc_slider_nopagination')
				. ' pagination_style_'.$pagination
				. (sc_param_is_on($progressbar) ? ' sc_slider_progress' : '')
				. ($border=='none' && $align!='' && $align!='none' ? ' sc_align'.$align : '')
				. ($engine=='swiper' ? ' swiper-container' : '')
				. '"'
			. ($s!='' ? ' style="'.$s.'"' : '')
		. '>';
		
	if ($engine=='revo') {
		if (revslider_exists() && !empty($alias))
			$output .= do_shortcode('[rev_slider '.$alias.']');
		else
			$output = '';
	} else if ($engine=='royal') {
		if (royalslider_exists() && !empty($alias))
			$output .= do_shortcode('[[new_royalslider id="'.$alias.'"]');
		else
			$output = '';
	} else if ($engine=='swiper') {
		
		$output .= '<ul class="slides'.($engine=='swiper' ? ' swiper-wrapper' : '').'">';

		$content = empty($ids) || empty($cat) ? do_shortcode($content) : '';
		
		if ($content) {
			$output .= $content;
		} else {
			global $post;
	
			if (!empty($ids)) {
				$posts = explode(',', $ids);
				$count = count($posts);
			}
		
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $count,
				'ignore_sticky_posts' => 1,
				'order' => $order=='asc' ? 'asc' : 'desc',
			);
			if ($offset > 0 && empty($ids)) {
				$args['offset'] = $offset;
			}
			$args = addSortOrderInQuery($args, $orderby, $order, true);
			$args = addPostsAndCatsInQuery($args, $ids, $cat);
			if(!empty($date_before))
				$args['date_query']['before'] = $date_before;
			if(!empty($date_after))
				$args['date_query']['after'] = $date_after;
			
			$query = new WP_Query( $args );			
			$pagination_posts = $show_pagination ? array() : '';
			$i = 0;
		
			while ( $query->have_posts() ) { 
				$query->the_post();
				$post_id = get_the_ID();
				$post_link = get_permalink();
				$post_attachment = wp_get_attachment_url(get_post_thumbnail_id($post_id));
				$post_accent_color = '';
				$post_category = '';
				$post_category_link = '';
				$post_title = getPostTitle($post_id);
				$post_title = '<span>'.str_replace(' ', '</span><span>', $post_title).'</span>';
				$post_obj = get_post($post_id);
				$post_content = $post_obj->post_content;
				$post_format = get_post_format($post_id);
				if($post_format == 'video') {
					$post_video = getPostVideo($post_content);
					$post_video_frame = '<iframe class="video_frame"'
					. ' src="' . getVideoPlayerURL($post_video) . '"'
					. ' width="100%"'
					. (!empty($height) ? ' height='.$height.'px' : '')
					. ' frameborder="0" webkitAllowFullScreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowFullScreen="allowFullScreen"></iframe>';
					
				}
				$post_author_data = get_userdata($post_obj->post_author);				
				$post_author = $post_author_data->user_nicename;		
				$author_link = get_author_posts_url($post_obj->post_author);
				$post_date = '<i class="icon-clock-1"></i>'.date('M d, Y', strtotime($post_obj->post_date));
				$post_comments = $post_obj->comment_count;
				$post_comments_link = '<a href="'.$post_link.'"><i class="icon-comment-1"></i>'.$post_comments.'</a>';
				$post_info = '<div class="slide_info">'.__('By ', 'themerex').'<a href="'.$author_link.'">'.$post_author.'</a><span class="separator">|</span>'.$post_date.'<span class="separator">|</span>'.$post_comments_link.'</div>';
				$output .= '<li'.($engine=='swiper' ? ' class="swiper-slide'.($post_format == 'video' ? ' format-video' : '').'"' : '').' style="background-image:url(' . $post_attachment . ');'.(!empty($width) ? 'width:' . $width . (themerex_strpos($width, '%')!==false ? '' : 'px').';' : '').(!empty($height) ? 'height:' . $height . (themerex_strpos($height, '%')!==false ? '' : 'px').';' : '').'"'.($post_format == 'video' && !empty($post_video_frame) ? ' data-video="'.esc_attr($post_video_frame).'"' : '').' >';
				$output .= '<a href="'.$post_link.'" class="sc_slider_post_link"></a>';
				$output .= '<div class="slider_info_wrap" '.(!empty($height) ? 'style="height:'.$height.'px"' : '').'>';
			if (!sc_param_is_off($caption)) {
				$post_hover_bg  = get_custom_option('theme_color', null, $post_id);
				$post_bg = '';
				$output .= '<div class="sc_slider_info' . ($caption=='fixed' ? ' sc_slider_info_fixed' : '') . ($engine=='swiper' ? ' content-slide' : '') . '">';
				$post_descr = getPostDescription();
			
				$output .= '<h2 class="sc_slider_subtitle">'.$post_title.'</h2>';
				$output .= $info == 'yes' ? $post_info : '';
				$output .= '</div>';
			}
				$output .= '</div>';
				$output .= '</li>';
				if($show_pagination) {
					$post_format = get_post_format($post_id);
					$format_icon = getPostFormatIcon($post_format);
					$pagination_posts[$i] = '<li class="pagination_post swiper-slide'.($i == 0 ? ' current' : '').'">';
					if($pagination == 'thumbs')
						$pagination_posts[$i] .= !empty($post_attachment) ? '<div class="post_thumb">'.getResizedImageTag($post_attachment, 50*$mult, 50*$mult).'</div>' : '';
					else {
						$pagination_posts[$i] .= '<div class="post_icon"><i class="'.$format_icon.'"></i></div>';
						$post_info = $post_date.'<span class="separator">|</span><i class="icon-comment-1"></i>'.$post_comments;
					}
					$pagination_posts[$i] .= '<div class="pagi_wrap">';
					$pagination_posts[$i] .= '<h4>'.getPostTitle($post_id).'</h4>';
					$pagination_posts[$i] .= !empty($post_info) && $pagination != 'thumbs' ? '<div class="post_info">'.$post_info.'</div>' : '';
					$pagination_posts[$i] .= '</div>';
					$pagination_posts[$i] .= '</li>';
				}
				$i++;
			}
			wp_reset_postdata();
		}
	
		$output .= '</ul>';
		if($show_pagination) {
			if(!empty($pagination_posts)) {
				$pagination_output = '';
				foreach($pagination_posts as $pagi_post) {
					$pagination_output .= $pagi_post;
				}
			}
		}
		if (sc_param_is_on($controls)) {
			$output .= '
				<ul class="flex-direction-nav">
					<li><a class="flex-prev" href="#">'.(!empty($width) && $width < 600 ? '<span class="icon-left-open-big"></span>' : '').'</a></li>
					<li><a class="flex-next" href="#">'.(!empty($width) && $width < 600 ? '<span class="icon-right-open-big"></span>' : '').'</a></li>
				</ul>';
		}
	
	} else
		$output = '';
	$output .= !empty($output) ? ($border!='none' ? '</div>' : '') . '</div>' : '';	
	$output .= '<div class="flex-control-nav"'.(!empty($pagination_output) ? ' style="height:'.$height.'px"' : '').'>'.(!empty($pagination_output) ? '<div class="swipe_scroll_vertical"></div><ul class="slides swiper-wrapper">'.$pagination_output.'</ul></div>' : '').'</div>';
	
	return $output;
}


add_shortcode('slider_item', 'sc_slider_item');

//[slider_item]
function sc_slider_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"src" => "",
		"url" => ""
	), $atts));
	global $THEMEREX_sc_slider_engine, $THEMEREX_sc_slider_width, $THEMEREX_sc_slider_height, $THEMEREX_sc_slider_links;
	$src = $src!='' ? $src : $url;
	if ($src > 0) {
		$attach = wp_get_attachment_image_src( $src, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$src = $attach[0];
	}
	return '<li' . ($THEMEREX_sc_slider_engine=='swiper' ? ' class="swiper-slide"' : '')
		. ' style="background-image:url(' . $src . ');'
			. (!empty($THEMEREX_sc_slider_width) ? 'width:' . $THEMEREX_sc_slider_width . (themerex_strpos($THEMEREX_sc_slider_width, '%')!==false ? '' : 'px').';' : '')
			. (!empty($THEMEREX_sc_slider_height) ? 'height:' . $THEMEREX_sc_slider_height . (themerex_strpos($THEMEREX_sc_slider_height, '%')!==false ? '' : 'px').';' : '')
		.'">' 
		.'<div class="slider_inner"'.(!empty($THEMEREX_sc_slider_height) ? ' style="height:'.$THEMEREX_sc_slider_height.'px;"' : '').'>'
		. (sc_param_is_on($THEMEREX_sc_slider_links) ? '<a href="'.($url ? $url : '#').'"'.(!empty($THEMEREX_sc_slider_height) ? ' style="height:'.$THEMEREX_sc_slider_height.'px;"' : '').'></a>' : '')
		. '</div>'
		. '</li>';
}
// ---------------------------------- [/slider] ---------------------------------------





// ---------------------------------- [table] ---------------------------------------


add_shortcode('table', 'sc_table');

/*
[table id="unique_id" style="regular"]
Table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/
[/table]
*/
function sc_table($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	$content = str_replace(
				array('<p><table', 'table></p>', '><br />'),
				array('<table', 'table>', '>'),
				html_entity_decode($content, ENT_COMPAT, 'UTF-8'));
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_table sc_table_style_' . $style . '"'.($s!='' ? ' style="'.$s.'"' : '') .'>' 
			. do_shortcode($content) 
			. '</div>';
}

// ---------------------------------- [/table] ---------------------------------------




// ---------------------------------- [tabs] ---------------------------------------

add_shortcode("tabs", "sc_tabs");

/*
[tabs id="unique_id" tab_names="Planning|Development|Support" style="1|2" initial="1 - num_tabs"]
	[tab]Randomised words which don't look even slightly believable. If you are going to use a passage. You need to be sure there isn't anything embarrassing hidden in the middle of text established fact that a reader will be istracted by the readable content of a page when looking at its layout.[/tab]
	[tab]Fact reader will be distracted by the <a href="#" class="main_link">readable content</a> of a page when. Looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using content here, content here, making it look like readable English will uncover many web sites still in their infancy. Various versions have evolved over. There are many variations of passages of Lorem Ipsum available, but the majority.[/tab]
	[tab]Distracted by the  readable content  of a page when. Looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using content here, content here, making it look like readable English will uncover many web sites still in their infancy. Various versions have  evolved over.  There are many variations of passages of Lorem Ipsum available.[/tab]
[/tabs]
*/
$THEMEREX_sc_tab_counter = 0;
$THEMEREX_sc_tab_height = 0;
$THEMEREX_sc_tab_id = '';
$THEMEREX_sc_tab_titles = '';
$THEMEREX_sc_tab_style = '';
$THEMEREX_sc_tabs_icons = '';
function sc_tabs($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"tab_names" => "",
		"initial" => "1",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"style" => "horizontal"
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.(!empty($width) ? 'width:' . $width . (themerex_strpos($width, '%')!==false ? '' : 'px').';' : '')
		;
	global $THEMEREX_sc_tab_counter,
		   $THEMEREX_sc_tab_id,
		   $THEMEREX_sc_tab_height,
		   $THEMEREX_sc_tab_titles,
		   $THEMEREX_sc_tab_style,
		   $THEMEREX_sc_tabs_icons;
		   
	$THEMEREX_sc_tab_style = $style;
	$THEMEREX_sc_tab_counter = 0;
	$THEMEREX_sc_tab_height = $height;
	$THEMEREX_sc_tab_names = $tab_names;
	$THEMEREX_sc_tab_id = $id ? $id : 'sc_tabs_'.str_replace('.', '', mt_rand());
	$THEMEREX_sc_tab_titles = array();
	if (!empty($tab_names)) {
		$title_chunks = explode("|", $tab_names);
		for ($i = 0; $i < count($title_chunks); $i++) {
			$THEMEREX_sc_tab_titles[] = array(
				'id' => $THEMEREX_sc_tab_id.'_'.($i+1),
				'title' => $title_chunks[$i]
			);
		}
	}
	$content = do_shortcode($content);
	$title_chunks = explode("|", $tab_names);
	$initial = max(1, min(count($THEMEREX_sc_tab_titles), (int) $initial));
	$tabs_output = '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_tabs tab_style_'.$style.'"'.($s!='' ? ' style="'.$s.'"' : '') .' data-active=' . ($initial-1) . '>'
					.'<ul class="sc_tabs_titles">';

	$titles_output = '';
	for ($i = 0; $i < count($THEMEREX_sc_tab_titles); $i++) {
		$classes = array('tab_names');
		$tab_icon = !empty($THEMEREX_sc_tabs_icons[$i]) ? $THEMEREX_sc_tabs_icons[$i] : '';
		if ($i == 0) $classes[] = 'first';
		else if ($i == count($THEMEREX_sc_tab_titles) - 1) $classes[] = 'last';
		$titles_output .= '<li class="'.join(' ', $classes).'"><a href="#'.$THEMEREX_sc_tab_titles[$i]['id'].'" class="theme_button" id="'.$THEMEREX_sc_tab_titles[$i]['id'].'_tab">'.(!empty($tab_icon) ? '<i class="icon '.$tab_icon.'"></i>' : ''). $THEMEREX_sc_tab_titles[$i]['title'] . '</a></li>';
	}

	wp_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);

	$tabs_output .= $titles_output
		. '</ul>' 
		. $content 
		.'</div>';
	return $tabs_output;
}


add_shortcode("tab", "sc_tab");

//[tab id="tab_id"]
function sc_tab($atts, $content = null) {
	 extract(shortcode_atts(array(
	 	'icon' => '',
		"tab_id" => "",		// get it from VC
		"title" => ""		// get it from VC
    ), $atts));
	if (in_shortcode_blogger()) return '';
	global $THEMEREX_sc_tab_counter, 
		   $THEMEREX_sc_tab_id,
		   $THEMEREX_sc_tab_height,
		   $THEMEREX_sc_tab_titles,
		   $THEMEREX_sc_tab_style,
		   $THEMEREX_sc_tabs_icons;
		   
	$THEMEREX_sc_tabs_icons[$THEMEREX_sc_tab_counter] = !empty($icon) ? $icon : '';
	$THEMEREX_sc_tab_counter++;
	if (empty($id))
		$id = !empty($tab_id) ? $tab_id : $THEMEREX_sc_tab_id.'_'.$THEMEREX_sc_tab_counter;

	if (isset($THEMEREX_sc_tab_titles[$THEMEREX_sc_tab_counter-1])) {
		$THEMEREX_sc_tab_titles[$THEMEREX_sc_tab_counter-1]['id'] = $id;
		if (!empty($title))
			$THEMEREX_sc_tab_titles[$THEMEREX_sc_tab_counter-1]['title'] = $title;
	} else {
		$THEMEREX_sc_tab_titles[] = array(
			'id' => $id,
			'title' => $title
		);
	}

	$tab_title = $THEMEREX_sc_tab_titles[$THEMEREX_sc_tab_counter-1]['title'];
	
	return '<div id="' . $id . '" class="sc_tabs_content' . ($THEMEREX_sc_tab_counter % 2 == 1 ? ' odd' : ' even') . ($THEMEREX_sc_tab_counter == 1 ? ' first' : '') . '">'
		.($THEMEREX_sc_tab_style == 'horizontal' ? '<h4>'.$tab_title.'</h4>' : '')
		. do_shortcode($content)
		. '</div>';
}
// ---------------------------------- [/tabs] ---------------------------------------






// ---------------------------------- [trx_team] ---------------------------------------


add_shortcode('trx_team', 'sc_team');

/*
[trx_team id="unique_id" style="normal|big"]
	[trx_team_item user="user_login"]
[/trx_team]
*/
$THEMEREX_sc_team_count = 0;
$THEMEREX_sc_team_counter = 0;
function sc_team($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"count" => 0,
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . ((int) $left > 0 ? 'px' : '') . ';' : '')
		.($right !== '' ? 'margin-right:' . $right . ((int) $right > 0 ? 'px' : '') . ';' : '')
		;
	global $THEMEREX_sc_team_count, $THEMEREX_sc_team_counter;
	$THEMEREX_sc_team_count = $count = max(1, min(5, $count));
	$THEMEREX_sc_team_counter = 0;
	$content = do_shortcode($content);
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_team'.(!empty($class) ? ' '.$class : '').'"'.($s!='' ? ' style="'.$s.'"' : '') .'>'
				. '<div class="sc_columns columnsWrap">'
					. $content
				. '</div>'
			. '</div>';
}


add_shortcode('trx_team_item', 'sc_team_item');

//[trx_team_item]
function sc_team_item($atts, $content=null) {
	global $mult;
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"class" => "",
		"user" => "",
		"name" => "",
		"position" => "",
		"photo" => "",
		"email" => "",
		"socials" => ""
	), $atts));
	global $THEMEREX_sc_team_counter, $THEMEREX_sc_team_count;
	$THEMEREX_sc_team_counter++;
	$descr = do_shortcode($content);
	if (!empty($user) && $user!='none' && ($user_obj = get_user_by('login', $user)) != false) {
		$meta = get_user_meta($user_obj->ID);
		if (empty($email))		$email = $user_obj->data->user_email;
		if (empty($name))		$name = $user_obj->data->display_name;
		if (empty($position))	$position = isset($meta['user_position'][0]) ? $meta['user_position'][0] : '';
		if (empty($descr))		$descr = isset($meta['description'][0]) ? $meta['description'][0] : '';
		if (empty($socials))	$socials = showUserSocialLinks(array('author_id'=>$user_obj->ID, 'echo'=>false, 'before'=>'<li>', 'after' => '</li>'));
	} else {
		global $THEMEREX_user_social_list;
		$allowed = explode('|', $socials);
		$socials = '';
		for ($i=0; $i<count($allowed); $i++) {
			$s = explode('=', $allowed[$i]);
			if (!empty($s[1]) && array_key_exists($s[0], $THEMEREX_user_social_list)) {
				$img = get_template_directory_uri().'/images/socials/'.$s[0].'.png';
				$socials .= '<li><a href="' . $s[1] . '" class="social_icons social_' . $s[0] . ' ' . $s[0] . '" target="_blank" style="background-image: url('.$img.');">'
						. '<span style="background-image: url('.$img.');"></span>'
						. '</a></li>';
			}
		}
	}
	if (empty($photo)) {
		if (!empty($email)) $photo = get_avatar($email, 370);
	} else {
		if ($photo > 0) {
			$attach = wp_get_attachment_image_src( $photo, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$photo = $attach[0];
		}
		$photo = getResizedImageTag($photo, 251*$mult, 251*$mult);
	}
	if (!empty($name) && !empty($position)) {
		return '<div class="columns1_'.$THEMEREX_sc_team_count . (!empty($class) ? ' '.$class : '').'">'
				. '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_team_item sc_team_item_' . $THEMEREX_sc_team_counter . ($THEMEREX_sc_team_counter % 2 == 1 ? ' odd' : ' even') . ($THEMEREX_sc_team_counter == 1 ? ' first' : '') . '">'
					. '<div class="sc_team_item_avatar">'
						. $photo
						. '<div class="sc_team_item_description">' . $descr . '</div>'
					. '</div>'
					. '<h3 class="sc_team_item_title">' . $name . '</h3>'
					. '<div class="sc_team_item_position theme_accent2">' . $position . '</div>'
					. (!empty($socials) ? '<ul class="sc_team_item_socials">' . $socials . '</ul>' : '')
				. '</div>'
			. '</div>';
	}
	return '';
}

// ---------------------------------- [/trx_team] ---------------------------------------






// ---------------------------------- [testimonials] ---------------------------------------


add_shortcode('testimonials', 'sc_testimonials');

/*
[testimonials id="unique_id" user="user_login" style="callout|flat"]Testimonials text[/testimonials]
or
[testimonials id="unique_id" email="" name="" position="" photo="photo_url"]Testimonials text[/testimonials]
*/

$THEMEREX_sc_testimonials_count = 0;
$THEMEREX_sc_testimonials_width = 0;
$THEMEREX_sc_testimonials_height = 0;
function sc_testimonials($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"style" => "1",
		"align" => "",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
    
    $top = !empty($top) ? ((int)$top > 0 ? $top.'px' : $top) : '';
    $bottom = !empty($bottom) ? ((int)$bottom > 0 ? $bottom.'px' : $bottom) : '';
    $left = !empty($left) ? ((int)$left > 0 ? $left.'px' : $left) : '';
    $right = !empty($right) ? ((int)$right > 0 ? $right.'px' : $right) : '';
    
    if($align == 'center') {
    	$left = $right = 'auto';
    }
    
	$s = ($top !== '' ? 'padding-top:' . $top . ';' : '')
		.($bottom !== '' ? 'padding-bottom:' . $bottom . ';' : '')
		.($left !== '' ? 'margin-left:' . $left . ';' : '')
		.($right !== '' ? 'margin-right:' . $right . ';' : '')
		;
	$s .= (!empty($width) ? 'width:' . $width . (themerex_strpos($width, '%')!==false ? '' : 'px').';' : '');
		
	global $THEMEREX_sc_testimonials_count, $THEMEREX_sc_testimonials_width, $THEMEREX_sc_testimonials_height;
	$THEMEREX_sc_testimonials_count = 0;
	$THEMEREX_sc_testimonials_width = $width;
	$THEMEREX_sc_testimonials_height = $height;
	$content = do_shortcode($content);
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_testimonials sc_testimonials_style_'.$style.'"' . ($s!='' ? ' style="'.$s.'"' : '') . '>'
			.($title && $style>1 ? '<h2 class="sc_testimonials_title'.(!empty($style) ? ' sc_testimonials_style_'.$style : '').'">'.$title.'</h2>' : '')
			. ($title && $style==1 ? '<h2 class="sc_testimonials_title">'.$title.'</h2>' : '')
			. ($THEMEREX_sc_testimonials_count>1 ? '<div class="sc_slider sc_slider_swiper sc_slider_controls sc_slider_nopagination swiper-container">' : '')
				. '<ul class="sc_testimonials_items'.($THEMEREX_sc_testimonials_count>1 ? ' slides swiper-wrapper' : '').'"'.(!empty($height) ? ' style="height:'.$height.'px"' : '').'>'
				. $content
				. '</ul>'
			. ($THEMEREX_sc_testimonials_count>1 ? '<ul class="flex-direction-nav"><li><a class="flex-prev" href="#"><i class="icon-left-open-big"></i></a></li><li><a class="flex-next" href="#"><i class="icon-right-open-big"></i></a></li></ul>' : '')
		. '		</div>
			</div>';
}


add_shortcode('testimonials_item', 'sc_testimonials_item');

function sc_testimonials_item($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"name" => "",
		"position" => "",
		"photo" => "",
		"email" => ""
    ), $atts));
	global $THEMEREX_sc_testimonials_count, $THEMEREX_sc_testimonials_width, $THEMEREX_sc_testimonials_height;
	$THEMEREX_sc_testimonials_count++;
	if (empty($photo)) {
		if (!empty($email))
			$photo = get_avatar($email, 130);
	} else
		if ($photo > 0) {
			$attach = wp_get_attachment_image_src( $photo, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$photo = $attach[0];
		}
		$photo = getResizedImageTag($photo, 130, 130);
	if (empty($photo)) $photo = '<img src="'.get_template_directory_uri().'/images/no-ava.png" alt="">';
	return '<li' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_testimonials_item swiper-slide" style="'.(!empty($THEMEREX_sc_testimonials_width) ? 'width:' . $THEMEREX_sc_testimonials_width . (themerex_strpos($THEMEREX_sc_testimonials_width, '%')!==false ? '' : 'px').';' : '').(!empty($THEMEREX_sc_testimonials_height) ? 'height:' . $THEMEREX_sc_testimonials_height . (themerex_strpos($THEMEREX_sc_testimonials_height, '%')!==false ? '' : 'px').';' : '').'">'
				. '<div class="sc_testimonials_item_content">'
					. '<div class="sc_testimonials_item_quote"><div class="sc_testimonials_item_text">'.do_shortcode($content).'</div></div>'
					. '<div class="sc_testimonials_item_author">'
						. '<div class="sc_testimonials_item_avatar">'.$photo.'</div>'
						. '<div class="sc_testimonials_item_name">'.$name.'</div>'
						. '<div class="sc_testimonials_item_position">'.$position.'</div>'
					. '</div>'
				. '</div>'
			. '</li>';
}

// ---------------------------------- [/testimonials] ---------------------------------------





// ---------------------------------- [title] ---------------------------------------


add_shortcode('title', 'sc_title');

/*
[title id="unique_id" style='regular|iconed' icon='' image='' background="on|off" type="1-6"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/title]
*/
function sc_title($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"type" => "1",
		"style" => "regular",
		"background" => "none",
		"bg_color" => "",
		"bd_color" => "",
		"icon" => "",
		"image" => "",
		"picture" => "",
		"size" => "medium",
		"position" => "left",
		"align" => "left",
		"weight" => "inherit",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"transform" => "",
		"font_size" => "",
		"letter_spacing" => "",
		"link" => '',
		"color" => ""
    ), $atts));
	$s = ($top !== '' ? 'padding-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'padding-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($font_size !== '' ? 'font-size:' . $font_size . 'px;' : '')
		.($letter_spacing !== '' ? 'letter-spacing:' . $letter_spacing . 'px;' : '')
		.($align && $align!='inherit' ? 'text-align:' . $align .';' : '')
		.($transform && $align!='' ? 'text-transform:' . $transform .';' : '')
		.($color ? 'color:' . $color .';' : '')
		.($weight && $weight!='inherit' ? 'font-weight:' . $weight .';' : '');
	$type = min(6, max(1, $type));
	if ($size == 'small' && $position == 'top') $position='left';
	if ($picture > 0) {
		$attach = wp_get_attachment_image_src( $picture, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$picture = $attach[0];
	}
	$pic = $style=='regular' 
		? '' 
		: '<span class="sc_title_icon sc_title_'.$position.' sc_icon_'.$size
			.($icon!='' && $icon!='none' ? ' '.$icon : '')
			.(!empty($background) && $background!='none' ? ' sc_title_bg sc_bg_'.$background : '')
			.(empty($bg_color) ? ' sc_title_without_bg' : '')
			.'"'
			.(!empty($background) && $background!='none' ? ' style="background-color:'.$bg_color.'; '.(!empty($bd_color) ? ' border: 1px solid '.$bd_color : '').'"' : '').'>'
			.($picture ? '<img src="'.$picture.'" />' : '')
			.($image && $image!='none' ? '<img src="'.get_template_directory_uri().'/images/icons/'.$image.'.png" />' : '')
			.'</span>';
	return '<h' . $type . ($id ? ' id="' . $id . '"' : '')
		  . ' class="sc_title sc_title_'.$style.'"'
		  . ($s!='' ? ' style="'.$s.'"' : '')
		  . '>'
		  .(!empty($link) ? '<a href="'.$link.'">' : '')
		  . $pic
		  . '<span class="sc_title_wrap">'.do_shortcode($content).'</span>'
		  .(!empty($link) ? '</a>' : '')
		  . '</h' . $type . '>';
}

// ---------------------------------- [/title] ---------------------------------------






// ---------------------------------- [toggles] ---------------------------------------


add_shortcode('toggles', 'sc_toggles');

/*
[toggles id="unique_id" initial="1 - num_elements"]
	[toggles_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/toggles_item]
	[toggles_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/toggles_item]
	[toggles_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/toggles_item]
	[toggles_item title="Nec purus, cras tincidunt rhoncus"]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna. Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim.[/toggles_item]
[/toggles]
*/
$THEMEREX_sc_toggle_counter = 0;
$THEMEREX_sc_toggle_style = 1;
$THEMEREX_sc_toggle_large = false;
$THEMEREX_sc_toggle_show_counter = false;
function sc_toggles($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"counter" => "off",
		"large" => "off",
		"shadow" => "off",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	global $THEMEREX_sc_toggle_counter, $THEMEREX_sc_toggle_style, $THEMEREX_sc_toggle_large, $THEMEREX_sc_toggle_show_counter;
	$THEMEREX_sc_toggle_counter = 0;
	$THEMEREX_sc_toggle_style = max(1, min(3, $style));
	$THEMEREX_sc_toggle_large = sc_param_is_on($large);
	$THEMEREX_sc_toggle_show_counter = sc_param_is_on($counter);
	wp_enqueue_script('jquery-effects-slide', false, array('jquery','jquery-effects-core'), null, true);
	return '<div' . ($id ? ' id="' . $id . '"' : '') 
			. ' class="sc_toggles sc_toggles_style_' . $style
			. (sc_param_is_on($shadow) ? ' sc_shadow' : '') 
			. (sc_param_is_on($counter) ? ' sc_show_counter' : '') 
			. (sc_param_is_on($large) ? ' sc_toggles_large' : '') 
			. '"'
			. ($s!='' ? ' style="'.$s.'"' : '') 
			. '>'
			. do_shortcode($content)
			. '</div>';
}


add_shortcode('toggles_item', 'sc_toggles_item');

//[toggles_item]
function sc_toggles_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"title" => "",
		"open" => ""
	), $atts));
	global $THEMEREX_sc_toggle_counter, $THEMEREX_sc_toggle_large, $THEMEREX_sc_toggle_show_counter;
	$THEMEREX_sc_toggle_counter++;
	return '<div' . ($id ? ' id="' . $id . '"' : '') 
				. ' class="sc_toggles_item'.(sc_param_is_on($open) ? ' sc_active' : '')
				. ($THEMEREX_sc_toggle_large ? ' sc_toggles_item_large' : '') 
				. ($THEMEREX_sc_toggle_counter % 2 == 1 ? ' odd' : ' even') 
				. ($THEMEREX_sc_toggle_counter == 1 ? ' first' : '') . '">'
				. '<h'.($THEMEREX_sc_toggle_large ? '3' : '4').' class="sc_toggles_title">'
				. ($THEMEREX_sc_toggle_show_counter ? '<span class="sc_items_counter">'.$THEMEREX_sc_toggle_counter.'</span>' : '')
				. $title 
				. '</h'.($THEMEREX_sc_toggle_large ? '3' : '4').'>'
				. '<div class="sc_toggles_content"'.(sc_param_is_on($open) ? ' style="display:block;"' : '').'>' 
				. do_shortcode($content) 
				. '</div>'
			. '</div>';
}
// ---------------------------------- [/toggles] ---------------------------------------





// ---------------------------------- [tooltip] ---------------------------------------


add_shortcode('tooltip', 'sc_tooltip');

/*
[tooltip id="unique_id" title="Tooltip text here"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/tooltip]
*/
function sc_tooltip($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => ""
    ), $atts));
	return '<span' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_tooltip_parent">' . do_shortcode($content) . '<span class="sc_tooltip">' . $title . '</span></span>';
}
// ---------------------------------- [/tooltip] ---------------------------------------

						


// ---------------------------------- [video] ---------------------------------------

add_shortcode("trex_video", "sc_video");

//[video id="unique_id" url="http://player.vimeo.com/video/20245032?title=0&amp;byline=0&amp;portrait=0" width="" height=""]
function sc_video($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"url" => '',
		"src" => '',
		"image" => '',
		"title" => 'off',
		"autoplay" => 'off',
		"width" => '100%',
		"height" => '295',
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	if ($src=='' && $url=='' && isset($atts[0])) {
		$src = $atts[0];
	}
	if ($image > 0) {
		$attach = wp_get_attachment_image_src( $image, 'full' );
		if (isset($attach[0]) && $attach[0]!='')
			$image = $attach[0];
	}
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width !== '' ? 'width:'.$width.'px;' : '')
		.($height !== '' ? 'height:'.$height.'px;' : '');

	$url = getVideoPlayerURL($src!='' ? $src : $url);
	$output = '';
	$video = '<video' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_video" src="' . $url . '" width="' . $width . '" height="' . $height . '"' . ($image || (sc_param_is_on($autoplay) && is_single()) ? ' autoplay="autoplay"' : '') . ($s!='' ? ' style="'.$s.'"' : '') . ' controls="controls"><source type="video/mp4" src="'.$url.'"></source></video>';
	if ($image) {
		$video = substituteVideo($video, $width, $height);
		$output = getVideoFrame($video, $image, sc_param_is_on($title), $s);
	} else
		$output = $video;
	return $output;
/*
	return '<iframe' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_video" src="' . $url . '" width="' . $width . '" height="' . $height . '"'.($s!='' ? ' style="'.$s.'"' : '').' frameborder="0" webkitAllowFullScreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowFullScreen="allowFullScreen"></iframe>';
*/
}
// ---------------------------------- [/video] ---------------------------------------



add_shortcode('arrow_link', 'sc_arrow_link');

/*
[arrow_link target="_blank" url="#" label="link text" color="#000"]
*/
function sc_arrow_link($atts, $content=null){
	extract(shortcode_atts(array(
		'url' => '',
		'target' => '',
		'color' => '',
		'label' => ''
	), $atts));
	
	$output = '';
	if(!empty($url) && !empty($label)) {
		$link_atts = 'href="'.$url.'"'
		.(!empty($target) ? ' target="'.$target.'"' : '')
		.(!empty($color) ? ' style="color:'.$color.';"' : '');
		$output .= '<a class="sc_arrow_link" '.(!empty($link_atts) ? ' '.$link_atts : '').'>'.$label.'<span class="sc_arrow"></span></a>';
	}
	return $output;	
}




global $THEMEREX_helpers_tooltip;
add_shortcode('helper', 'sc_trex_helper');

/*
[helper id='any_id' style='1|2|3']Any Description Goes Here[/helper]
*/

function sc_trex_helper($atts, $content=null){
	extract(shortcode_atts(array(
		'id' => '',
		'style' => '1',
		'point_pos' => 'lt',
		'tooltip_pos' => 'lb',
	), $atts));
	
	global $THEMEREX_helpers_tooltip;
	
	$THEMEREX_helpers_tooltip .= !empty($id) ? '<div class="sc_themerex_helper" id="sc_helper_popup_'.$id.'" data-style="'.$style.'" data-point="'.$point_pos.'" data-tooltip="'.$tooltip_pos.'" data-id="'.$id.'">'.$content.'</div>' : '';
	return '';
}

?>