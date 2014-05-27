<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>
<article id="post-0" class="post no-results not-found">

<?php if ( current_user_can( 'edit_posts' ) ) :
	// Show a different message to a logged-in user who can add posts.
?>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'No posts to display', 'awakening' ); ?></h1>
	</header>

	<div class="entry-content">
		<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'awakening' ), admin_url( 'post-new.php' ) ); ?></p>
	</div><!-- .entry-content -->

<?php else :
	// Show the default message to everyone else.
?>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'awakening' ); ?></h1>
	</header>

	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'awakening' ); ?></p>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row">
		<div class="large-6 columns">
			<div class="row collapse">
				<div class="large-8 mobile-three columns">
					<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'awakening' ); ?>"/>
				</div>
				<div class="large-4 mobile-one columns">
					<input type="submit" class="button prefix" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'awakening' ); ?>" />
				</div>
			</div>
		</div>
	</div>
</form>
	</div><!-- .entry-content -->
<?php endif; // end current_user_can() check ?>	
</article>	