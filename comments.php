<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Taarifa
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

<div id="comments" class="comments-area">
	<div class="comments-area-in">
		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<h2 class="comments-title">
				<?php
				$taarifa_comment_count = get_comments_number();
				if ( '1' === $taarifa_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'taarifa' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $taarifa_comment_count, 'comments title', 'taarifa' ) ),
						number_format_i18n( $taarifa_comment_count ),
						'<span>' . get_the_title() . '</span>'
					);
				}
				?>
			</h2><!-- .comments-title -->

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'avatar_size'	=> 80,
					'style'      => 'ol',
					'short_ping' => true,
					'max_depth'		=> 5,
				) );       
				?>
			</ol><!-- .comment-list -->

			<?php
			the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'taarifa' ); ?></p>
				<?php
			endif;

		endif; // Check for have_comments().
		
		$req = get_option( 'require_name_email' );		
		$comment_args = array(
			'title_reply' => __( 'Leave a comment' ),	
			'comment_field' =>  '<p class="comment-form-comment comment-form-fields"><textarea id="comment" name="comment" aria-required="true" placeholder="' . __( 'Your comment', 'taarifa' ) . ( $req ? '*' : '' ) . '">' . '</textarea></p>',			
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
			'submit_field' => '<div class="comment-form-submit cta-2">%1$s %2$s</div>'				
		);

		comment_form( $comment_args );
		?>
	</div>
	<!-- .comments-area-in -->
	
</div><!-- #comments -->
