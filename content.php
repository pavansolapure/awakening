<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'awakening' ); ?>
		</div>
	<?php endif; ?>

	<header>
		<hgroup>
			<h3><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'awakening' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			
		<div class="post-meta entry-header">
				<?php
					printf( __( '<span class="post_date">%2$s by %3$s', 'awakening' ),'meta-prep meta-prep-author',
					sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>',
					get_permalink(),
					esc_attr( get_the_time() ),
					get_the_date()
					),
					sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a>',
					get_author_posts_url( get_the_author_meta( 'ID' ) ),
					sprintf( esc_attr__( 'View all posts by %s', 'awakening' ), get_the_author() ),
					get_the_author()
					)
					);
				?>         
			<div class="right">
				<span class="post_comment">
				<a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'awakening'),__('One comment','awakening'),__('% comments','awakening')); ?></a>
				</span>
			</div>				
		</div> 
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
	  
	 