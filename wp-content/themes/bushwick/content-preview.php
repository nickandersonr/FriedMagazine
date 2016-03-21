<?php
/**
 * @package Bushwick
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-preview' ); ?>>
    
    <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
      <div id="custom-bg" style="background-image: url('<?php echo $image[0]; ?>')">

      </div>
        <a class="featured_img" href="<?php the_permalink(); ?>" style="background: url('<?php echo $image[0]; ?>'); background-size: cover;">

        </a>
    <?php endif; ?>
    
    <div class="entry_info">
        <?php the_title( '<header class="entry-header"><h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1></header><!-- .entry-header -->' ); ?>

        <div class="entry-permalink">
            <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php _e( 'Read', 'bushwick' ); ?></a>
        </div><!-- .entry-permalink -->
        
        <footer class="entry-meta">
            <?php
                bushwick_posted_on();
                edit_post_link( __( 'Edit', 'bushwick' ), ' <span class="edit-link">', '</span>' );
            ?>
        </footer><!-- .entry-meta -->
        
    </div>
    
	
</article><!-- #post-## -->
