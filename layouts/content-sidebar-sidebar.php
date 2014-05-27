<?php $cols = awakening_get_columns_settings(); ?>  
<!-- Main Blog Content -->
<div class="large-<?php echo $cols['content'];?> columns" role="content">
	<div id="primary" class="site-content">
		<div id="content" role="main">	
<?php if ( have_posts() ) : ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
	<?php awakening_content_nav( 'nav-below' ); 	?>
<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; // end have_posts() check ?>
		</div><!-- #content -->
	</div><!-- #primary -->	
</div> <!-- .large-<?php echo $cols['content'];?> columns .content -->
<!-- End Main Content -->	
<?php get_sidebar('left'); ?>  
<?php get_sidebar(); ?>