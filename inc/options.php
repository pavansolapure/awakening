<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$theme_footer_widgets = array(
		'3' => __('Three', 'options_check'),
		'4' => __('Four', 'options_check')
	);
	
	$theme_layout_array = array(
		'boxed' => __('Boxed', 'options_check'),
		'wide' => __('Wide', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	
	$imagepath =  get_template_directory_uri() . '/inc/admin/images/';

	$options = array();
	
	//Settings for Basic Settings Tab
	$options[] = array(
		'name' => __('Basic Settings', 'options_check'),
		'type' => 'heading');
		
	$options[] = array(
		'name' =>  __('Header Background', 'options_check'),
		'desc' => __('Change the header background CSS.', 'options_check'),
		'id' => 'site_header_background',
		'std' => $background_defaults,
		'type' => 'background' );			

	$options[] = array(
		'name' =>  __('Body Background', 'options_check'),
		'desc' => __('Change the body background CSS.', 'options_check'),
		'id' => 'body_background',
		'std' => $background_defaults,
		'type' => 'background' );			
		
	$options[] = array(
		'name' => __('Site Logo', 'options_check'),
		'desc' => __('If set this will be used as your sites logo.', 'options_check'),
		'id' => 'site_logo',
		'type' => 'upload');			
		
	$options[] = array(
		'name' => "Page Layout",
		'desc' => "These are layouts for your posts & archive. Pages will follow different templates that are available in template dropdown.",
		'id' => "page_layouts",
		'std' => "content-sidebar",
		'type' => "images",
		'options' => array(
			'full-width' => $imagepath . 'full-width.png',
			'sidebar-content' => $imagepath . 'sidebar-content.png',
			'content-sidebar' => $imagepath . 'content-sidebar.png',
			'sidebar-content-sidebar' => $imagepath . 'sidebar-content-sidebar.png',
			'sidebar-sidebar-content' => $imagepath . 'sidebar-sidebar-content.png',
			'content-sidebar-sidebar' => $imagepath . 'content-sidebar-sidebar.png')
	);		
	
		
	$options[] = array(
		'name' => __('Display Search in Top Menu', 'options_check'),
		'desc' => __('This option allows you to set whether you want a minified serach box in heade menu. Default is true.', 'options_check'),
		'id' => 'show_search_in_top_menu',
		'std' => '1',
		'type' => 'checkbox');		
	
	$options[] = array(
		'name' => __('Widget Areas in Extended Footer', 'options_check'),
		'desc' => __('This option allows you to set how many widget areas you want in footer. Default is 3.', 'options_check'),
		'id' => 'extended_footer_count',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $theme_footer_widgets);			
	

	$options[] = array(
		'name' => __('Copyright Text', 'options_check'),
		'desc' => __('Your sites copyright statement.', 'options_check'),
		'id' => 'copyright_text',
		'std' => '&copy; All rights reserved.',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Front Page Settings', 'options_check'),
		'type' => 'heading');	
		
	$options[] = array(
		'name' => __('Display Slider on Home page / Front Page', 'options_check'),
		'desc' => __('Check to display Slider. Defaults to true.', 'options_check'),
		'id' => 'display_slider',
		'std' => '1',
		'type' => 'checkbox');
		
		
	$options[] = array(
		'name' => __('Settings for Slider', 'options_check'),
		'desc' => __('Check to show next/prev controls on Slider. Defaults to true.', 'options_check'),
		'id' => 'display_slider_control',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		//'name' => __('Settings for Slider on Home page', 'options_check'),
		'desc' => __('Check to show pager on Slider. Defaults to true.', 'options_check'),
		'id' => 'display_slider_pager',
		'std' => '1',
		'type' => 'checkbox');		

	$options[] = array(
		//'name' => __('Settings for Slider on Home page', 'options_check'),
		'desc' => __('Check to Pause Slider on Mouse Hover. Defaults to false.', 'options_check'),
		'id' => 'slider_pause_on_hover',
		'std' => '0',
		'type' => 'checkbox');		

	$options[] = array(		
		'name' => __('Slider Dimensions.', 'options_check'),
		'desc' => __('Recommended : <b>1400,450</b>', 'options_check'),
		'id' => 'slider_dimension',
		'std' => '1400,450',
		'type' => 'text');		

	$options[] = array(		
		'name' => __('Slide Transition Speed.', 'options_check'),
		'desc' => __('This sets speed of image transition', 'options_check'),
		'id' => 'slider_transition_speed',
		'std' => '2000',
		'type' => 'text');	

	$options[] = array(		
		'name' => __('Data Transition Speed - IN', 'options_check'),
		'desc' => __('This sets speed of data in transition ', 'options_check'),
		'id' => 'data_in_transition_speed',
		'std' => '2500',
		'type' => 'text');			
		
	$options[] = array(		
		'name' => __('Data Transition Speed - OUT', 'options_check'),
		'desc' => __('This sets speed of data out transition ', 'options_check'),
		'id' => 'data_out_transition_speed',
		'std' => '1000',
		'type' => 'text');		
		
		
	$options[] = array(
		'name' => __('Blurb Settings - Following section allows you to configure your blurb on home page.', 'options_check'),
		'desc' => __('<b>Following section will allow you to set text and button settings</b>', 'options_check'),
		'type' => 'info');				
		
	$options[] = array(
		//'name' => __('Check to display Blurb Text on home page.', 'options_check'),
		'desc' => __('Check to display Blurb on home page.', 'options_check'),
		'id' => 'display_blurb',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		//'name' => __('Blurb Text', 'options_check'),
		'desc' => __('Enter text here to be displayed in Blurb Section.', 'options_check'),
		'id' => 'blurb_text',
		'std' => 'Welcome to Our Agency. We specialize in Web Design and Development. Check out our outstanding portfolio, and get in touch with Us!',
		'type' => 'textarea');	

	$options[] = array(
		//'name' => __('Check to display Blurb Button.', 'options_check'),
		'desc' => __('Check to display Blurb Button.', 'options_check'),
		'id' => 'display_blurb_button',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		//'name' => __('Blurb Button Title', 'options_check'),
		'desc' => __('Set title for Blurb Button.', 'options_check'),
		'id' => 'blurb_button_title',
		'std' => 'Get In Touch',
		'type' => 'text');		
		
	$options[] = array(
		//'name' => __('Select a Page to link to Blurb Button', 'options_check'),
		'desc' => __('Link for Blurb Button', 'options_check'),
		'id' => 'blurb_button_link_page',
		'type' => 'select',
		'options' => $options_pages);	

	$options[] = array(
		'name' => __('Widget Areas in Front Page', 'options_check'),
		'desc' => __('This option allows you to set how many widget areas you want in Frontpage. Default is 3.', 'options_check'),
		'id' => 'front_page_widget_section_count',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $theme_footer_widgets);		

	return $options;
}