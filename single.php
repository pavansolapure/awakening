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
	$layout = of_get_option('page_layouts'); 
	$col=9; 
	$side_bar_to_display = "right";
	if(isset($layout)) {
		switch($layout) {
			case "full-width":
				$col=12; 
				$side_bar_to_display = "none";
				break;
			case "sidebar-content":
				$col=9; 
				$side_bar_to_display = "left";
				break;
			case "content-sidebar":
				$col=9; 
				$side_bar_to_display = "right";
				break;
			case "content-sidebar-sidebar":	
			case "sidebar-sidebar-content":	
			case "sidebar-content-sidebar":	
				$col=6; 
				$side_bar_to_display = "both";	
				break;						
		}		
	}
?>

<?php	
	if($layout ==  "sidebar-sidebar-content") {
		get_sidebar('left');
		get_sidebar();
	} else if($layout ==  "sidebar-content-sidebar" || $layout ==  "sidebar-content") {
		get_sidebar('left');
	}
?>

<div class="large-<?php echo $col;?> columns" role="content">
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
</div> <!-- .large-<?php echo $col;?> columns .content -->	

<?php
	if($layout ==  "content-sidebar-sidebar") {
		get_sidebar('left');
		get_sidebar();
	} else if($layout ==  "sidebar-content-sidebar" || $layout ==  "content-sidebar") {
		get_sidebar();
	}	
?>
<?php get_footer(); ?>