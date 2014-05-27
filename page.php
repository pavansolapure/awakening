<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */

get_header(); ?>

<?php
 if(is_front_page()) {	
	get_template_part( 'page-templates/front', 'page' );
 } else {
?> 
 
<?php 
	$cols = awakening_get_columns_settings();
	$layout = $cols['layout']; 
?>
<?php
	if($layout ==  "sidebar-sidebar-content") {
		get_sidebar('left');
		get_sidebar();
	}	
?>

<?php
	if($layout ==  "sidebar-content-sidebar") {
		get_sidebar('left');
	} else if($layout ==  "sidebar-content") {
		get_sidebar();
	}	
?>
<div class="large-<?php echo $cols['content'];?> columns" role="content">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- .large-<?php echo $cols['content'];?> .column -->
<?php
	if($layout ==  "content-sidebar-sidebar") {
		get_sidebar('left');
	}	
?>
<?php	
	if($layout ==  "content-sidebar" || 
	   $layout ==  "sidebar-content-sidebar" ||
	   $layout ==  "content-sidebar-sidebar") {		
		get_sidebar();
	}
?>
<?php get_footer(); ?>
<?php } ?>
