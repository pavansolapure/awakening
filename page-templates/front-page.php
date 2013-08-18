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
	$divclass = (of_get_option('front_page_widget_section_count')=='4') ? '3' : '4';
	$imagepath =  get_template_directory_uri() . '/images/';

	$display_slider = of_get_option('display_slider');
	if(isset($display_slider) && $display_slider==true) {
		get_template_part( 'slides', 'index' );
	}
?>


		<div class="large-12 large-centered columns">		
		<!--blurb-->
		<?php if(of_get_option('display_blurb') == '1'): ?>	
		 <div class="blurb"> 
			<p><?php echo of_get_option('blurb_text'); ?></p>
			<a href="<?php echo get_permalink( of_get_option('blurb_button_link_page')); ?>" class="button alert round "><?php echo of_get_option('blurb_button_title'); ?></a>
		 </div>	
		<?php endif; ?>	
		<!--blurb-->		 
		<div class="customdivider"><img src="<?php echo $imagepath;?>/sep-shadow.png" alt=""></div>
		</div>	
	
		<div class="large-<?php echo $divclass; ?> columns">
		<?php if ( is_active_sidebar( 'awakening_front_page_one' ) ) : ?>
		<?php dynamic_sidebar( 'awakening_front_page_one' ); ?>	
		<?php endif; ?>	
		</div>
	
		<div class="large-<?php echo $divclass; ?> columns">
		<?php if ( is_active_sidebar( 'awakening_front_page_two' ) ) : ?>
		<?php dynamic_sidebar( 'awakening_front_page_two' ); ?>	
		<?php endif; ?>	
		</div>

		<div class="large-<?php echo $divclass; ?> columns">
		<?php if ( is_active_sidebar( 'awakening_front_page_three' ) ) : ?>
		<?php dynamic_sidebar( 'awakening_front_page_three' ); ?>	
		<?php endif; ?>	
		</div>
		
		<?php if($divclass=='3'): ?>
		<div class="large-<?php echo $divclass; ?> columns">
		<?php if ( is_active_sidebar( 'awakening_front_page_four' ) ) : ?>
		<?php dynamic_sidebar( 'awakening_front_page_four' ); ?>	
		<?php endif; ?>	
		</div>
		<?php endif; ?>		
	

<?php get_footer(); ?>