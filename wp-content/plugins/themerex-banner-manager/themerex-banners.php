<?php
/*
Plugin Name: Themerex Banner
Plugin URI: http://themeforest.net/user/themerex/
Description: Themerex Banner Rotator
Version: 1.0
Author: Themerex
Author Email: support@themerex.net
License:

  Copyright 2014 Themerex (support@themerex.net)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

require_once(plugin_dir_path(__FILE__).'post-type-banner.php');
require_once(plugin_dir_path(__FILE__).'widget-themerex-banners.php');

class ThemerexBanner {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Themerex Banner';
	const slug = 'themerex_banner';
	var $banner_heads = array();
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'install_themerex_banner' ) );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_themerex_banner' ) );
		add_action('wp_head', array(&$this, 'add_banner_head_code'));
	}
  
	/**
	 * Runs when the plugin is activated
	 */  
	function install_themerex_banner() {
		// do not generate any output here
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	function init_themerex_banner() {
		// Setup localization
		load_plugin_textdomain( self::slug, false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();

	
		if ( is_admin() ) {
			wp_enqueue_style('font-ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:400,300,700');
		} else {
			//this will run when on the frontend
		}

		/*
		 * TODO: Define custom functionality for your plugin here
		 *
		 * For more information: 
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_shortcode( 'trex_banner', array(&$this, 'sc_trex_banner') );
	}
	
	function sc_trex_banner($atts, $content = null) {
		extract(shortcode_atts(array(
			'ids' 	 => '',
			'count'	 => '',
			'group'  => '',
			'author' => ''
		), $atts));
		
		$banner_output = $this->trex_banner_request($ids, $group, $author, $count);
		return $banner_output;
	}
	
	function trex_banner_request($ids, $group, $author, $count = false) {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'orderby' => 'rand',
			'meta_query' => array(
				'relation' => 'AND',
	   			array(
	   			    'key' => 'display_from',
	   			    'value' => date('Y-m-d H:i:s'),
	   			    'compare' => '<='
	   			),
	   			array(
	   			    'key' => 'display_till',
	   			    'value' => date('Y-m-d H:i:s'),
	   			    'compare' => '>='
	   			),
	   			array(
	   				'key' => 'banner_show',
	   				'value' => 0,
	   				'compare' => '>'
	   			),
	   			'tax_query' => array(
	   				
	   			)
			)
		);
		$ids = !empty($ids) ? explode(',', str_replace(' ', '', $ids)) : '';
		if(!empty($count) && empty($ids)) {
			$args['posts_per_page'] = $count;
		}
		if( !empty($ids) ) {
			$args['post__in'] = $ids;
		} else {
			$group = !empty($group) ? explode(',', str_replace(' ', '', $group)) : '';
			$group_field = 'slug';
			$group_args = $author_args = false;
			
			$author = !empty($author) ? explode(',', str_replace(' ', '', $author)) : '';
			$author_field = 'slug';
			
			if(!empty($author)) {
				foreach ($author as $item) {
					if((int)$item > 0) 
						$author_field = 'id';
				}
				if( !empty($author) ) {
					$author_args = array(
						'taxonomy' => 'banner_author',
						'terms'	=> $author,
						'field' => $author_field
					);
				}
			}
			if(!empty($group)) {
				foreach ($group as $item) {					
					if((int)$item > 0) 
						$group_field = 'id';
				}
				
				if( !empty($group) ) {
					$group_args = array(
						'taxonomy' => 'banner_group',
						'terms'	=> $group,
						'field' => $group_field
					);
				}
			}
			if($author_args !== false || $group_args !== false) {
				$args['tax_query'] = array(
					'relation' => 'AND'
				);
				if($author_args !== false) {
					$args['tax_query'][] = $author_args;
				}
				if($group_args !== false) {
					$args['tax_query'][] = $group_args;
				}
			}
		}
		$output = '';
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$post_id = get_the_ID();
				$this->banner_impression( $post_id );
				$old_val = get_post_custom_values('banner_show', $post_id);
				$output .= $this->build_banner_output($post_id);
			}
		}
		
		wp_reset_postdata();
		return $output;
	}

	function action_callback_method_name() {
		// TODO define your action method here
	}

	function filter_callback_method_name() {
		// TODO define your filter method here
	}
	
	function get_banner_titles() {
		
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish'
		);
		
		$the_query = new WP_Query( $args );
		$banner_titles = array();
		
		if ( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$post_id = get_the_ID();
				$banner_titles[$post_id] = $this->build_banner_output($post_id, 'title');
			}
		}
		
		wp_reset_postdata();
		
		return !empty($banner_titles) ? $banner_titles : '';				
	}
	
	function build_banner_output( $post_id, $field = '' ) {
		if(empty($post_id))
			return false;
			
		/* Get Post Data */
		$banner_title = get_the_title($post_id);
		$banner_content = get_post_field('post_content', $post_id);
		if( !empty($banner_content) ) {
			$banner_content = apply_filters('the_content', $banner_content);
		}
		$post_custom = get_post_custom($post_id);
		$banner_head = !empty($post_custom['banner_head'][0]) ? $post_custom['banner_head'][0] : '';
		if(!empty($banner_head)) {
			$this->banner_heads[] = $banner_head;
		}
		$banner_width = !empty($post_custom['banner_width']) ? $post_custom['banner_width'][0] : '';
		$banner_height = !empty($post_custom['banner_height']) ? $post_custom['banner_height'][0] : '';
		$banner_link = !empty($post_custom['banner_url'][0]) ? $post_custom['banner_url'][0] : '';
		$banner_image = !empty($post_custom['_thumbnail_id']) ? wp_get_attachment_image_src( $post_custom['_thumbnail_id'][0], 'full' ) : '';
		$banner_style = '';
		$banner_style .= !empty($banner_width) && $banner_width != 'auto' ? 'width: '.$banner_width.'px;' : '';
		$banner_style .= !empty($banner_height) && $banner_height != 'auto' ? 'height: '.$banner_height.'px;' : '';
		$banner_style .= !empty($banner_image[0]) ? 'background: url('.$banner_image[0].') center center no-repeat;' : '';
		$banner_hover = !empty($post_custom['banner_hover_image'][0]) ? $post_custom['banner_hover_image'][0] : '';
		
		if(empty($field)) {
			$output = '<div class="trex_banner_block"'.( !empty($banner_width) && $banner_width != 'auto' ? 'style="width:'.$banner_width.'px"' : '' ).'>';
			$output .= !empty($banner_link) ? '<a target="_blank" href="'.$banner_link.'">' : '';
			$output .= '<div class="banner_inner" '.(!empty($banner_style) ? 'style="'.$banner_style.'"' : '').'>';
			$output .= !empty($banner_content) ? $banner_content : '';
			$output .= !empty($post_custom['banner_hover_image'][0]) ? '<div class="banner_hover" style="background: url('.$post_custom['banner_hover_image'][0].') center center no-repeat;"></div>' : '';
			$output .= '</div>';
			$output .= !empty($banner_link) ? '</a>' : '';
			$output .= '</div>';			
			return $output;
		} else {
			$ret = 'banner_'.$field;
			return $$ret;
		}
	}
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			$this->load_file( self::slug . 'trex-admin-script', '/js/admin.js', true );
			$this->load_file( self::slug . 'trex-admin-style', '/css/admin.css' );
		} else {
			//$this->load_file( self::slug . 'trex-script', '/js/widget.js', true );
			$this->load_file( self::slug . 'trex-style', '/css/trex-banners-style.css' );
		} // end if/else
		
		$banners = $this->get_banner_titles();
		
	} // end register_scripts_and_styles
	
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file
	
	
	// MySQL -> Date
	function SQLToDate($str) {
	    return (trim($str)=='' || trim($str)=='0000-00-00' ? '' : trim(substr($str,8,2).'.'.substr($str,5,2).'.'.substr($str,0,4).' '.substr($str,11)));
	}
	
	//  Date -> MySQL
	function DateToSQL($str) {
		if (trim($str)=='') return '';
		$str = strtr(trim($str),'/\-,','....');
		if (trim($str)=='00.00.0000' || trim($str)=='00.00.00') return '';
		$pos = strpos($str,'.');
		$d=trim(substr($str,0,$pos));
		$str = substr($str,$pos+1);
		$pos = strpos($str,'.');
		$m=trim(substr($str,0,$pos));
		$y=trim(substr($str,$pos+1));
		$y=($y<50?$y+2000:($y<1900?$y+1900:$y));
	    return ''.$y.'-'.(strlen($m)<2?'0':'').$m.'-'.(strlen($d)<2?'0':'').$d;
	}
	
	function banner_impression($post_id) {
		if(empty($post_id))
			return false;
		$post_views = get_post_custom_values('banner_show', $post_id);
		if($post_views[0] != 100000 && (int)$post_views[0] > 0) {
			$new_value = $post_views[0] - 1;
			update_post_meta($post_id, 'banner_show', $new_value, $post_views[0]);
		}
	}
	function add_banner_head_code() {
		if(!empty($this->banner_heads)) {
			foreach ($this->banner_heads as $head) {
				echo $head;
			}
		}
	}
	
  
} // end class
new ThemerexBanner();

?>