<?php 

header("Content-type: text/css; charset=utf-8"); 

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );

$options = get_option('iw_opt');

?>

	/* start customstyles.php */

	<?php echo $iw_opt['css-code']; ?>
	
	<?php if( isset($iw_opt['primary-color']) and $iw_opt['primary-color'] != '#2c3e50' ) : ?>
		
		/* primary color */
		
		body,
		nav .wrapper #bars .fa-bars,
		.carousel .carousel-control i{
			color: <?php echo $iw_opt['primary-color']; ?> !important;
		}
		@media (max-width: 767px){
			.carousel h2 a{
			color: <?php echo $iw_opt['primary-color']; ?> !important;
			}
		}
		
		section#top,
		section#chess article,
		section#breakingnews ul li div.cat{
			background-color: <?php echo $iw_opt['primary-color']; ?> !important;
		}
		
		.wrapper, .wrapper #mainmenu,
		header .wrapper #logo,
		header .wrapper #sublogo,
		nav div.rowstyle,
		hr, .hr,
		section#content main section.comments .commentlist li.comment:not(:first-child),
		section#content main section.comments .commentlist li.comment:not(:last-child),
		section#breakingnews ul,
		.wpcf7 input[type="text"], 
		.wpcf7 input[type="email"], 
		.wpcf7 select, 
		.wpcf7 textarea{
			border-color: <?php echo $iw_opt['primary-color']; ?> !important;
		}
		
		section#breakingnews ul li div.cat:after{
			border-left-color: <?php echo $iw_opt['primary-color']; ?> !important;
		}
		
	<?php endif; ?>
	
	<?php if( isset($iw_opt['secondary-color']) and $iw_opt['secondary-color'] != '#ffcc0d' ) : ?>
		
		/* secondary color */
		
		section#top a:hover,
		#mainmenu > li > a:hover,
		.widget h4,
		section#content main #featured p time,
		#content a:hover, #content a:focus,
		footer a:hover, footer a:focus,
		nav .wrapper #bars .fa-square,
		nav #respmenu a:hover,
		section#chess article .info ul,
		section#content aside .wrapper p time,
		#breakingnews a:hover,
		.carousel .textinfo{
			color: <?php echo $iw_opt['secondary-color']; ?> !important;
		}
		
		nav .wrapper #mainmenu li.menu-item-has-children ul.sub-menu,
		.countcomments{
			background-color: <?php echo $iw_opt['secondary-color']; ?> !important;
		}
		
		#mainmenu li a.hover:before,
		section#content header.topinfo h1:after,
		section#content article .textinfo:after, 
		section#content header.topinfo .textinfo:after,
		section#content main section.comments h3:after,
		section#content.authors #users h2:after,
		section#content.authors h1:after,
		section#content article .textcontent a:hover, 
		section#content header.topinfo .textcontent a:hover,
		section#content main #featured h2:after,
		section#chess article .quote .textquote:after,
		section#content main #articlelist article.format-quote .textquote:after,
		.textinfo:after,
		section#content main .relatedposts h3:after{
			border-bottom-color: <?php echo $iw_opt['secondary-color']; ?> !important;
		}
		
		#mainmenu li.menu-item-has-children ul.sub-menu a.hover:before {
		  border-bottom-color: white !important;
		}
		
		.countcomments:after{
			border-right-color: <?php echo $iw_opt['secondary-color']; ?> !important;
		}
		
		.widget h4:before,
		section#content aside .wrapper{
			border-color: <?php echo $iw_opt['secondary-color']; ?> !important; 
		}
		
	<?php endif; ?>

	<?php if( $iw_opt['single-dropcaps'] ) : ?>

		.single-article .textcontent p:first-child:first-letter{
			background-color: <?php echo $iw_opt['secondary-color']; ?> !important;
			font-size: 210%;
			float: left;
			margin-right: 8px;
			padding: 8px;
		}

		.single-article .textcontent blockquote p:first-child:first-letter {
			font-size:100%;
			float:none;
			background-color:transparent !important;
			margin:0;
			padding:0;
	}

	<?php endif; ?>
	
	<?php 
	
	//only for the logo shadow
	if( !$iw_opt['boxed'] and
		isset($iw_opt['opt-background']['background-color']) and 
		( $iw_opt['opt-background']['background-color'] != '' or
		$iw_opt['primary-color'] != '#2c3e50' ) 
	) :
	
		$bg = ($iw_opt['opt-background']['background-color'] != '')	? $iw_opt['opt-background']['background-color'] : '#ffffff';
		$pr = ($iw_opt['primary-color'] != '#2c3e50' ) 				? $iw_opt['primary-color'] 						: '#2c3e50';
	
	?>
		/* logo shadow */
	
		header .wrapper #logo{
			text-shadow: 2px 2px 0 <?php echo $bg ?>, 4px 4px 0px <?php echo $pr ?> !important;
		}
		
	<?php endif; ?>
	
	<?php if( !$iw_opt['boxed'] and 
		isset($iw_opt['opt-background']['background-color']) and 
		$iw_opt['opt-background']['background-color'] != '' 
	) : ?>
	
		/* background */
	
		.widget h4{
			background-image: none !important;
		}
		
		.widget h4 span{
			background: <?php echo $iw_opt['opt-background']['background-color'] ?> !important;
		}
		
		#loader{
			background: <?php echo $iw_opt['opt-background']['background-color'] ?> !important;
		}
	<?php endif; ?>
	