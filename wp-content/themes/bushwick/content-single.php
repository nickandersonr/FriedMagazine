<?php
/**
 * @package Bushwick
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    

	<?php if ( has_excerpt() ) : ?>
	<aside class="entry-summary">
		<?php the_excerpt(); ?>
	</aside><!-- .entry-summary -->
	<?php endif; ?>

	<div class="entry-content">
        <h1 class="title_section">
            <?php echo get_the_title( $post_id ); ?>
            <div class="page_author">
                <?php
                    bushwick_posted_on();
                    edit_post_link( __( 'Edit', 'bushwick' ), ' <span class="edit-link">', '</span>' );
                ?>
            </div>
            <hr class="style-eight" />
        </h1>
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bushwick' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			$category_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'bushwick' ) );
			$tag_list      = get_the_tag_list( '',  _x( ', ', 'used between list items, there is a space after the comma', 'bushwick' ) );

			if ( ! bushwick_categorized_blog() ) :
				// This blog only has 1 category so we just need to worry about tags in the meta text.
				if ( '' != $tag_list ) :
					$meta_text = __( '&copy;2016 Fried Magazine. All material belongs to their respective artist.', 'bushwick' );
				else :
					$meta_text = __( '&copy;2016 Fried Magazine. All material belongs to their respective artist.', 'bushwick' );
				endif;

			else :
				// But this blog has loads of categories so we should probably display them here.
				if ( '' != $tag_list ) :
					$meta_text = __( '&copy;2016 Fried Magazine. All material belongs to their respective artist.', 'bushwick' );
				else :
					$meta_text = __( '&copy;2016 Fried Magazine. All material belongs to their respective artist.', 'bushwick' );
				endif;

			endif; // End check for categories on this blog.

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);

			edit_post_link( __( 'Edit', 'bushwick' ), ' <span class="edit-link">', '</span>' );
		?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
