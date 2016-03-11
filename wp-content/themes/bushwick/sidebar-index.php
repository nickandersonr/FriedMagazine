<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Bushwick
 */
?>

<header id="masthead" class="site-header" role="banner">
	<div class="site-branding">
		<h1 class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <?php // bloginfo( 'name' ); ?>
                <img id="logo" src="<?php echo get_template_directory_uri(); ?>/svg/friedlogo_white.svg" /> 
            </a>
        </h1>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	</div>
</header><!-- #masthead -->
