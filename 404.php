<?php
/**
 * The template for displaying 404 pages (Not Found).
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
	<div id="primary" class="site-content">
		<div id="content" role="main">
	
			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'awakening' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'awakening' ); ?></p>
					<div class="row">
						<div class="small-6 columns">
							<?php get_search_form(); ?>
						</div>
					</div>
					
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- .large-9 .columns -->
<?php get_sidebar(); ?>	<?php
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
?><?php get_footer(); ?>