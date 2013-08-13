<?php
/**
 * Content Single
 *
 * Loop content in single post template (single.php)
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>

<article>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
	<div class="featured-post">
		<?php _e( 'Featured post', 'awakening' ); ?>
	</div>
	<?php endif; ?>
	<header class="entry-header">
		<hgroup>
			<h1><?php the_title(); ?></h1>			
			<div class="post-meta"><?php
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
				<div class="right postcomments">
					<span class="post_comment"><a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'awakening'),__('One comment','awakening'),__('% comments','awakening')); ?></a></span>
				</div>				
			</div> 
		</hgroup>
	</header>
	
	<?php if(!is_page() && of_get_option('display_ad_code_in_post_start')=='1'): ?>
	<?php echo of_get_option('ad_code_in_post_start'); ?>
	<?php endif; ?>	
	
	<div class="entry-content">
	<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
	<?php if(!is_page() && of_get_option('display_ad_code_in_post_end')=='1'): ?>
	<?php echo of_get_option('ad_code_in_post_end'); ?>
	<?php endif; ?>	
	
		<p><?php wp_link_pages(); ?></p>
		<hr/>
		<div class="row cat-tag-info">
		<div class="large-6 columns" >
		<span class="left post_cats" title="<?php _e('Category', 'awakening' );?>">	
			 <?php the_category(', '); ?>
		</span>
		</div>
		<div class="large-6 columns" > 
		<span class="right post_tags" title="<?php _e('Tags', 'awakening' );?>">
			<?php the_tags('<span class="radius secondary label">','</span><span class="radius secondary label">','</span>'); ?>
		</span>
		</div>
		</div>
			
		<?php get_template_part('author-box'); ?>		
		
		<?php comments_template( '', true ); ?>
	</footer>

</article>
