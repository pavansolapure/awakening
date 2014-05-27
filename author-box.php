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

<?php //&& is_multi_author()?>
<?php if ( is_singular() && get_the_author_meta( 'description' )) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
<div class="entry-author panel">
	<div class="row">
		<div class="large-3 columns">
			<?php echo get_avatar( get_the_author_meta('user_email'), 95 ); ?>
		</div>
		<div class="large-9 columns">
			<h4><?php the_author_posts_link(); ?></h4>
			<p class="cover-description"><?php the_author_meta('description'); ?></p>
		</div>
	</div>
</div>	
<?php endif; ?>	

