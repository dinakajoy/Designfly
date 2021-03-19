<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Designfly
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$designfly_tags = wp_get_post_tags( $post->ID );
if ( $designfly_tags ) {
?>

	<div class="comment-tags"><sapn><?php esc_html_e( 'TAGS: ', 'designfly' ); ?></span>
		<?php
			$html = '<div class="post_tags">';
			foreach ( $designfly_tags as $designfly_tag ) {
				$tag_link = get_tag_link( $designfly_tag->term_id );

				echo esc_html( "<a href='{$tag_link}' class='{$tag->slug}'>{$tag->name}</a>" );
			}
		?>
	</div>

<?php } ?>

<div id="comments" class="comments-area">
	<h3><?php esc_html_e( 'Comments ', 'designfly' ); ?></h3>

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
		<h4 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf(
						/* translators: %s: post title */
						esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'designfly' ),
						'<span>' . esc_html( get_the_title() ) . '</span>'
					);
				} else {
					printf(
						esc_html(
							/* translators: 1: number of comments, 2: post title */
							_nx(
								'%1$s thought on &ldquo;%2$s&rdquo;',
								'%1$s thoughts on &ldquo;%2$s&rdquo;',
								$comments_number,
								'comments title',
								'designfly'
							)
						),
						esc_html( number_format_i18n( $comments_number ) ),
						'<span>' . esc_html( get_the_title() ) . '</span>'
					);
				}
			?>
		</h4>

		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through?
				?>
				<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'designfly' ); ?></h2>
					<div class="nav-links clearfix">

						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'designfly' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'designfly' ) ); ?></div>

					</div><!-- .nav-links -->
				</nav><!-- #comment-nav-above -->
				<?php
			} // Check for comment navigation.
		?>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					apply_filters(
						'designfly_list_comments_args',
						[
							'style'      => 'ol',
							'short_ping' => true,
						]
					)
				);
			?>
		</ol><!-- .comment-list -->

		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through?
		?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'designfly' ); ?></h2>
				<div class="nav-links clearfix">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'designfly' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'designfly' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php
			} // Check for comment navigation.

	} else {
		?>
			<div><?php esc_html_e( 'No comments yet', 'designfly' ); ?></div>
		<?php
	} // Check for have_comments().

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'designfly' ); ?></p>
			<?php
		}

		/*
		* Format Comment Form
		*/
		$fields = array (
			'author' => '<div class="commenter-info"><p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input id="author" name="author" type="text" value="" maxlength="245" required="required"></p>',
			'email'	=> '<p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input id="email" name="email" type="email" value="" maxlength="100" aria-describedby="email-notes" required="required"></p>',
			'website' => '<p class="comment-form-url"><label for="url">Website</label> <input id="url" name="url" type="url" value="" maxlength="200"></p></div>'
		);

		$comments_args = array (
			'label_submit' => __( 'Submit', 'designfly' ),
			'title_reply' => __( 'Post your comment', 'designfly' ),
			'comment_notes_after' => '',
			'comment_field' => '<p class="comment-form-comment"><label for="comment"></label><br /><textarea id="comment" name="comment" aria-required="true" rows="5"></textarea></p>',
			'fields'	=> apply_filters( 'comment_form_default_fields', $fields )
		);
		comment_form( $comments_args );
	?>

</div><!-- #comments -->
