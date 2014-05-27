<?php
/**
 * Template Name: Three Column - Content/Sidebar/Sidebar
 *
 * Page template for
 *
 * @package Awakening
 * @since Awakening 1.0
 */

get_header(); ?>
<?php $cols = awakening_get_columns_settings(); ?>  

	<!-- Main Content -->	
	<div class="large-<?php echo $cols['content'];?> columns" role="main">
	<div id="primary" class="site-content">
		<div id="content" role="main">	
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>			
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>								
		<?php endwhile; ?>
	<?php else : ?>
		<h2><?php _e('No posts.', 'awakening' ); ?></h2>
		<p class="lead"><?php _e('Sorry about this, I couldn\'t seem to find what you were looking for.', 'awakening' ); ?></p>		
	<?php endif; ?>			
	<?php custom_pagination(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->	
	</div>	
	<!-- End Main Content -->	
<?php get_sidebar('left'); ?>	
<?php get_sidebar(); ?>
<?php get_footer(); ?>