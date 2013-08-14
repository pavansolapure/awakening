<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to awakening_comment() which is
 * located in the functions.php file.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h5 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'awakening' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h5>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'awakening_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'awakening' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'awakening' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'awakening' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'awakening' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	
	<?php 
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_args = array( 'title_reply'=>'Speak Your Mind',

	'fields' => apply_filters( 'comment_form_default_fields', 
				array(

				'author' => '<div class="row collapse">
								<div class="small-3 large-2 columns">
									<span class="prefix">Name ' . ($req ? '<span>*</span>' : '' ). '</span>
								</div>
								<div class="small-9 large-7 columns left">
									<input id="author" name="author" type="text" size="35" placeholder="Enter your Name" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . '/>
								</div>
							</div>', 		

				'email' => '<div class="row collapse">
								<div class="small-3 large-2 columns">
									<span class="prefix">Email ' . ($req ? '<span>*</span>' : '' ). '</span>
								</div>
								<div class="small-9 large-7 columns left">
									<input d="email" name="email" type="text" size="35" placeholder="Enter your Email" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . '/>
								</div>
							</div>', 		
							
				'url' => '<div class="row collapse">
								<div class="small-3 large-2 columns">
									<span class="prefix">Website ' . '</span>
								</div>
								<div class="small-9 large-7 columns left">
									<input d="url" name="url" type="text" size="35" placeholder="Enter your Website (Optional)" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' . $aria_req . '/>
								</div>
							</div>', 	

							

		 ) ),
	
		'comment_field' => '<div class="row">
								<div class="large-12 columns">									
									<textarea id="comment" name="comment" placeholder=""  aria-required="true" rows="7" cols="60"></textarea>
								</div>
							</div>',	

		'comment_notes_after' => '<p id="allowed_tags" class="small"><strong>XHTML:</strong> You can use these tags: <code>'. allowed_tags() .'</code></p>',

	);
?>
<div class="row" role="commentform">
<div class="large-10 columns">
<?php	
	comment_form($comment_args); 
?>
</div>
</div> <!--.row commentform-->


</div><!-- #comments .comments-area -->