<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('index-card'); ?> >
	<header>
		<hgroup>
			<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'awakening' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php if ( !is_sticky()) : ?>
			<?php awakening_entry_meta(); ?> 
		<?php endif; ?>
		</hgroup>
	</header>

	<?php if ( has_post_thumbnail()) : ?>
		<div class="featured-img">
		<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
		</div>
	<?php endif; ?>
	
	<div class="entry-summary">
	<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<div style="clear:both;"/>
</article>

<!--<hr>-->
	  
	 