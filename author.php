<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
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
<div class="large-<?php echo $cols['content'];?> columns" role="content" id="author-archive">
	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>
			<!--
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'awakening' ), '<span class="vcardo"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header>
			-->
			<!-- .archive-header -->

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<div class="entry-author panel">
	<div class="row">
		<div class="large-3 columns">
			<?php echo get_avatar( get_the_author_meta('user_email'), 95 ); ?>
		</div>
		<div class="large-9 columns">
			<h4><?php the_author_posts_link(); ?></h4>
			<p class="cover-description"><?php the_author_meta('description'); ?></p>
		</div>
	</div>
</div>	
<?php endif; ?>


			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php awakening_content_nav( 'nav-below' ); ?>

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