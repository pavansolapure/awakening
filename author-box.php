<?php
/**
 * Author Box
 *
 * Loop content in single post template (author-box.php)
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>


<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
	<div class="author-info">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'awakening_author_bio_avatar_size', 68 ) ); ?>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h2><?php printf( __( 'About %s', 'awakening' ), get_the_author() ); ?></h2>
			<p><?php the_author_meta( 'description' ); ?></p>
			<div class="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'awakening' ), get_the_author() ); ?>
				</a>
			</div><!-- .author-link	-->
		</div><!-- .author-description -->
	</div><!-- .author-info -->
<?php endif; ?>	

