<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jedna_Blog
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

	<?php
	// You can start editing here -- including this comment!
	
		?>
		<h2 class="comments-title d-flex justify-content-between" >
			<?php
				$jedna_blog_comment_count = get_comments_number();			
			?>
			<div 
				class="comment-count-icon"
				data-bs-toggle="collapse" 
				data-bs-target="#commentList" 
				aria-controls="commentList" 
				aria-expanded="false" 
				aria-label="Toggle comments" >
				<i class="fa-regular fa-comment"></i>
				<span class="px-1"><?php echo $jedna_blog_comment_count; ?></span>
			</div>

			<a href="#respond" class="btn btn-outline-secondary"
				data-bs-toggle="collapse" 
				data-bs-target="#commentForm" 
				aria-controls="commentForm" 
				aria-expanded="false" 
				aria-label="Toggle comment form">Leave a Comment</a>

		</h2><!-- .comments-title -->
	<?php if ( have_comments() ) : ?>
		<?php the_comments_navigation(); ?>

		<ol class="comment-list collapse" id="commentList">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jedna-blog' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().


	comment_form();
	?>

</div><!-- #comments -->
