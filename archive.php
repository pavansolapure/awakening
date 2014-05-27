<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Awakening already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'awakening' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'awakening' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'awakening' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'awakening' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'awakening' ) ) . '</span>' );
					else :
						_e( 'Archives', 'awakening' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

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