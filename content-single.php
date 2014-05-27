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

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<hgroup>
			<h1><?php the_title(); ?></h1>			
			<?php awakening_entry_meta(); ?>
		</hgroup>
	</header>
	
	<div class="entry-content">
	<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	
	
	<footer class="entry-meta">
	
		<?php get_template_part('author-box'); ?>	
	
		<p><?php wp_link_pages(); ?></p>
		<!--
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
		-->	
				
		
	
		
		<?php comments_template( '', true ); ?>
	</footer>

</article>
