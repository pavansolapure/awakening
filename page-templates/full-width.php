<?php
/**
 * Template Name: Full Width Template
 *
 * Page template for
 *
 * @package Awakening
 * @since Awakening 0.1
 */

get_header(); ?>



	<!-- Main Content -->	
	<div class="large-12 columns" role="main">
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
	</div>	
	<!-- End Main Content -->	


<?php get_footer(); ?>

