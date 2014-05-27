<?php
/**
 * Template Name: Front Page Template
 *
 * Page template for Front Page
 *
 * @package Awakening
 * @since Awakening 1.0
 */

get_header(); ?>

<?php
	$imagepath =  get_template_directory_uri() . '/images/';	
?>


		<div class="large-12 large-centered columns">		
		<!--blurb-->
		<?php if(of_get_option('display_blurb') == '1'): ?>	
		 <div class="blurb"> 
			<p><?php echo of_get_option('blurb_text'); ?></p>
			<a href="<?php echo get_permalink( of_get_option('blurb_button_link_page')); ?>" class="button tiny alert round "><?php echo of_get_option('blurb_button_title'); ?></a>
		 </div>	
		<?php endif; ?>	
		<!--blurb-->		 
		<div class="customdivider"><img src="<?php echo $imagepath;?>/sep-shadow.png" alt=""></div>
		</div>	
		
		<div class="large-12 large-centered columns">
		<div class="row">
			<?php if ( is_active_sidebar( 'awakening_front_page_widget_row_one' ) ) : ?>
			<?php dynamic_sidebar( 'awakening_front_page_widget_row_one' ); ?>	
			<?php endif; ?>	
		</div>
		</div>
	
		<div class="large-12 large-centered columns">
		<div class="row">
			<?php if ( is_active_sidebar( 'awakening_front_page_widget_row_two' ) ) : ?>
			<?php dynamic_sidebar( 'awakening_front_page_widget_row_two' ); ?>	
			<?php endif; ?>	
		</div>
		</div>

		<div class="large-12 large-centered columns">	
		<div class="row">
			<?php if ( is_active_sidebar( 'awakening_front_page_widget_row_three' ) ) : ?>
			<?php dynamic_sidebar( 'awakening_front_page_widget_row_three' ); ?>	
			<?php endif; ?>	
		</div>
		</div>		
	

<?php get_footer(); ?>