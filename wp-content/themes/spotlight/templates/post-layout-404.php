<?php
/*
 * The template for displaying "Page 404"
 * 
 * @package spotlight
*/
$page_id = getTemplatePageId('404');
$post_thumb = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );

?>
<section class="post no_margin post404<?php echo !empty($post_thumb) ? ' post_thumb' : ''; ?>" style="background-image: url(<?php echo $post_thumb ?>);">
	<div class="container">
		<article class="post_content">
			<div class="page404">
				<div class="titleError"><?php _e( '404', 'themerex' ); ?></div>
				<div class="error_page_wrap">
					<div class="h2"><?php _e('The requested page cannot be found', 'themerex'); ?></div>
					<p><?php _e('Go back, or return to <a href="'.home_url().'">'.home_url().'</a> to choose a new page.', 'themerex'); ?>
					<br><?php _e('Please report any broken links to our team.', 'themerex'); ?></p>
					<a href="<?php echo home_url(); ?>" class="sc_button style_border style_404 size_huge type_rounded"><?php echo __( 'Go Back Home', 'themerex' ); ?></a>
				</div>
			</div>
		</article>
	</div>
</section>