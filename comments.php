<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_meliora
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="c-comments comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( comments_open() ) :
		comment_form( array(
			'label_submit'  => 'Post',
			'title_reply'   => 'Add a comment',
			'comment_field' => '<p class="comment-form-comment"><label for="comment">Comment*</label> <textarea id="comment" name="comment" cols="45" rows="3" maxlength="20000" required="required" spellcheck="false"></textarea></p>'
		) );
		?>
        <h2 class="comments-title">
			<?php
			esc_html_e( 'Comments', 'wp-meliora' )
			?>
        </h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>
<?php if ( have_comments() ) : ?>
            <ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'walker'      => new Wp_meliora_walker_comment(),
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 70,
					)
				);
				?>
            </ol><!-- .comment-list -->
		<?php endif; ?>
		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-meliora' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().
	?>

</div><!-- #comments -->
