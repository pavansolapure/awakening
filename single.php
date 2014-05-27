<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */

get_header(); ?>
<?php 
	$cols = awakening_get_columns_settings(); 
	$layout = $cols['layout'];
?>

<?php	
	if($layout ==  "sidebar-sidebar-content") {
		get_sidebar('left');
		get_sidebar();
	} else if($layout ==  "sidebar-content-sidebar" || $layout ==  "sidebar-content") {
		get_sidebar('left');
	}
?>

<div class="large-<?php echo $cols['content'];?> columns" role="content">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<nav class="nav-single">
				<div class="row">	
					<div class="large-6 columns">
					<span class="nav-previous left"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'awakening' ) . '</span> %title' ); ?></span>
					</div>	
					<div class="large-6 columns">
					<span class="nav-next right"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'awakening' ) . '</span>' ); ?></span>
					</div>	
				</div>	
				</nav><!-- .nav-single -->

				<?php //comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div> <!-- .large-<?php echo $cols['content'];?> columns .content -->	

<?php
	if($layout ==  "content-sidebar-sidebar") {
		get_sidebar('left');
		get_sidebar();
	} else if($layout ==  "sidebar-content-sidebar" || $layout ==  "content-sidebar") {
		get_sidebar();
	}	
?>
<?php get_footer(); ?>