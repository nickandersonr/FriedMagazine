<?php
/**
 * The Header for our theme.
 *
 * @package Bushwick
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,300,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="custom/css/custom.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/custom.css" media="Screen" type="text/css" />
</head>

<body <?php body_class(); ?>>

<?php
get_template_part( 'sidebar', is_single() ? 'single' : 'index' );
get_sidebar();
