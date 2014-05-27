<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
		<!--
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'awakening' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header>
			-->
			<!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			awakening_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->
</div><!-- .large-<?php echo $cols['content'];?> .columns -->
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