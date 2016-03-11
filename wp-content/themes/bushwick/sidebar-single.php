<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Bushwick
 */

the_post();
?>
<div class="site-header">
    <a class="single_home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <?php // bloginfo( 'name' ); ?>
        <img id="logo" src="<?php echo get_template_directory_uri(); ?>/svg/friedlogo_white.svg" /> 
    </a>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );

			if ( ! is_attachment() ) :
		?>

		<div class="entry-meta">
			<?php
				printf(
					'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'bushwick' ), get_the_author() ) ),
					get_the_author()
				);
			?>
			<br>
			<?php
				printf(
					'<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
			?>
		</div><!-- .entry-meta -->

		<?php
			endif;

			bushwick_post_nav();
		?>
	</header><!-- .entry-header -->
</div><!-- .site-header -->

<?php
rewind_posts();
