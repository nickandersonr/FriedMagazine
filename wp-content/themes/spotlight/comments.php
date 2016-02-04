<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 *
 * @package spotlight
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	global $vote_form;
	
	$show_reviews = true;
	if(is_page() || get_custom_option('show_reviews') == 'no')
		$show_reviews = false;
	
	if ( post_password_required() )
		return;
	if ( have_comments() ) {
		global $post_comments;
		$post_comments = get_comments_number();
?>

	<section class="comments divider">
		<h2 class="comments_title"><?php echo $post_comments; ?> <?php echo $post_comments==1 ? __('Comment', 'themerex') : __('Comments', 'themerex'); ?></h2>
		<ul class="comments_list commBody">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use vc_theme_comment() to format the comments.
			 */
			wp_list_comments( array( 'callback' => 'single_comment_output') );
		?>
		</ul><!-- .comments_list -->
		<?php if ( !comments_open() && get_comments_number()!=0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p class="no_comments"><?php _e( 'Comments are closed.', 'themerex' ); ?></p>
		<?php }	?>
		<div class="nav_comments"><?php paginate_comments_links(); ?></div>
	</section><!-- .comments -->
	<div class="sc_divider"></div>
<?php } ?>

<section class="formValid">
	<h2 class="comments_title"><?php echo __('Leave a comment', 'themerex'); ?></h2>
	<div class="commForm commentsForm<?php echo $show_reviews ? '' : ' noReviews'; ?>">

		<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : '' );

		/*Votes*/
		$criterias_list = get_custom_option('reviews_criterias');
		$vote_max = get_custom_option('reviews_max_level');
		$vote_form = comment_vote_system(array('criterias' => $criterias_list, 'max' => $vote_max));
		/*******/
		
		$comments_args = array(
				// change the id of send button 
				'id_submit'=>'send_comment',
				// change the title of send button 
				'label_submit'=>__('Post comment', 'themerex'),
				// change the title of the reply section
				'title_reply'=> '',
				// remove "Logged in as"
				'logged_in_as' => '',
				// remove text before textarea
				'comment_notes_before' => '',
				// remove text after textarea
				'comment_notes_after' => '',
				// redefine your own textarea (the comment body)
				'comment_field' => '<div class="message form_row">'
									. '<label for="comment" class="required">' . __('Comment', 'themerex') . '</label>'
									. '<textarea id="comment" name="comment" class="textAreaSize" aria-required="true"></textarea>'
									. '</div>',
				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="'.($show_reviews ? 'comment_form_column' : 'columnsWrap').'"><div class="form_row'.($show_reviews ? '' : ' columns1_2').'">'
							. '<label for="author"' . ( $req ? ' class="required"' : '' ). '>' . __( 'Name', 'themerex' ) . '</label>'
							. '<input id="author" name="author" type="text" value="' . esc_attr( isset($commenter['comment_author']) ? $commenter['comment_author'] : '' ) . '" size="30"' . $aria_req . ' />'
							. '</div>',
					'email' => '<div class="form_row'.($show_reviews ? '' : ' columns1_2').'">'
							. '<label for="email"' . ( $req ? ' class="required"' : '' ) . '>' . __( 'Email', 'themerex' ) . '</label>'
							. '<input id="email" name="email" type="text" value="' . esc_attr(  isset($commenter['comment_author_email']) ? $commenter['comment_author_email'] : '' ) . '" size="30"' . $aria_req . ' />'
							. '</div>'
				))
		);
		if(!is_user_logged_in()) {
			$comments_args['comment_field'] .= '</div>';
		}
		//$comments_args['comment_notes_after'] = '<div class="comment_form_column">'.$vote_form.'</div>';
		if(!is_page() && get_custom_option('show_reviews') == 'yes')	
			add_action( 'comment_form_top', 'get_vote_form', 10);
		function get_vote_form() {
			global $vote_form;
			echo '<div class="comment_form_column vote_form">'.$vote_form.'</div>';
		}
		comment_form($comments_args);
		?>
	</div>
</section><!-- .formValid -->
<?php 

function single_comment_output( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post_comments;
	switch ( $comment->comment_type ) :
		case 'pingback' :
			?>
			<li class="trackback">
				<p><?php _e( 'Trackback:', 'themerex' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'themerex' ), '<span class="edit-link">', '<span>' ); ?></p>
			<?php
			break;
		case 'trackback' :
			?>
			<li class="pingback">
				<p><?php _e( 'Pingback:', 'themerex' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'themerex' ), '<span class="edit-link">', '<span>' ); ?></p>
			<?php
			break;
		default :
			$vote_max = get_custom_option('reviews_max_level');
			$vote_points = get_comment_meta( $comment->comment_ID, 'vote_points', true);
			$review_positive = get_comment_meta( $comment->comment_ID, 'review_positive', true);
			$review_negative = get_comment_meta( $comment->comment_ID, 'review_negative', true);
			$vote_results = trex_vote_results($vote_points, $vote_max);
			$author_id = $comment->user_id;
			$author_link = get_author_posts_url( $author_id );
			$results_list = (array)json_decode($vote_points);
			?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<?php if(count($results_list) == 1) 
					echo $vote_results;
				?>				
				<div class="comment_author_avatar avatar"><?php echo get_avatar( $comment, 65 ); ?></div>
				<div class="comment_wrap">
					<div class="comment_header">
						<div class="comment_reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>				
						<span class="comment_author">
						<?php 
							if ($author_id) echo '<a href="' . $author_link . '">';
							comment_author(); 
							if ($author_id) echo '</a>';
						?>
						</span>
						<span class="comment_date"><i class="icon-clock-1"></i><?php echo get_comment_date('Y M d / H:i'); ?></span>
						<?php if ($depth < $args['max_depth']) { ?>
						<?php } ?>
					</div>
				<div class="authorInfo">
					<?php if ( $comment->comment_approved == 0 ) { ?>
					<div class="comment_not_approved"><?php _e( 'Your comment is awaiting moderation.', 'themerex' ); ?></div>
					<?php } ?>
					<?php comment_text(); ?>
					<div class="comment_content">
						<?php
						if(count($results_list) > 1)
							echo $vote_results;
						if(!empty($review_positive) || !empty($review_negative)) {
							echo '<div class="comment_reviews">';
							if(!empty($review_positive)) {
								echo '<div class="review_pos review">
										<span class="label"><i class="icon-plus-squared"></i>'.__('Positives', 'themerex').'</span>
								<div class="review_text">'.$review_positive.'</div></div>';
							}
							if(!empty($review_negative)) {
								echo '<div class="review_neg review">
										<span class="label"><i class="icon-minus-squared"></i>'.__('Negatives', 'themerex').'</span>
								<div class="review_text">'.$review_negative.'</div></div>';
							}
							echo '</div>';
						}
						?>
					</div>
				</div>
			</div>
			<?php
			break;
	endswitch;
}
?>
