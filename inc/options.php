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
		'name' => __('Header Background', 'options_check'),
		'desc' => __('If set this will be used as your sites header background.', 'options_check'),
		'id' => 'header_background',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('Site Logo', 'options_check'),
		'desc' => __('If set this will be used as your sites logo.', 'options_check'),
		'id' => 'site_logo',
		'type' => 'upload');			
		
	$options[] = array(
		'name' => __('Theme Layout', 'options_check'),
		'desc' => __('This option allows you to set theme layout Boxed or Full Width/Wide.', 'options_check'),
		'id' => 'theme_layout',
		'std' => 'Boxed',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $theme_layout_array);			
		
	$options[] = array(
		'name' => "Page Layout",
		'desc' => "These are layouts for your posts & archive. Pages will follow different templates that are available in template dropdown.",
		'id' => "page_layouts",
		'std' => "2c-r-fixed",
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
		'name' => __('Settings for Slider on Home page', 'options_check'),
		'desc' => __('Check to display Slider. Defaults to true.', 'options_check'),
		'id' => 'display_slider',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Slider Image 1', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1010x400', 'options_check'),
		'id' => 'slider_img_1',
		'type' => 'upload');
		
	$options[] = array(		
		'desc' => __('Enter text here to be displayed in Caption of Image 1.', 'options_check'),
		'id' => 'slider_image_caption_1',
		'std' => 'Caption 1',
		'type' => 'textarea');			

	$options[] = array(
		'name' => __('Slider Image 2', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1010x400', 'options_check'),
		'id' => 'slider_img_2',
		'type' => 'upload');
		
	$options[] = array(		
		'desc' => __('Enter text here to be displayed in Caption of Image 2.', 'options_check'),
		'id' => 'slider_image_caption_2',
		'std' => 'Caption 2',
		'type' => 'textarea');		

	$options[] = array(
		'name' => __('Slider Image 3', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1010x400', 'options_check'),
		'id' => 'slider_img_3',
		'type' => 'upload');	
		
	$options[] = array(		
		'desc' => __('Enter text here to be displayed in Caption of Image 3.', 'options_check'),
		'id' => 'slider_image_caption_3',
		'std' => 'Caption 3',
		'type' => 'textarea');		
		
	$options[] = array(
		'name' => __('Slider Image 4', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1010x400', 'options_check'),
		'id' => 'slider_img_4',
		'type' => 'upload');	
		
	$options[] = array(		
		'desc' => __('Enter text here to be displayed in Caption of Image 4.', 'options_check'),
		'id' => 'slider_image_caption_4',
		'std' => 'Caption 4',
		'type' => 'textarea');		
		
	$options[] = array(
		'name' => __('Blurb Settings - Following section allows you to configure your blurb on home page.', 'options_check'),
		//'desc' => __('<b>Following section will allow you to set text and button settings</b>', 'options_check'),
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
		

	//Settings for Social Tab		
	$options[] = array(
		'name' => __('Social', 'options_check'),
		'type' => 'heading');		

	$options[] = array(
		'name' => __('Social Settings', 'options_check'),
		'desc' => __('Check to display Social Icons in Footer.', 'options_check'),
		'id' => 'display_social_icons',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Facebook', 'options_check'),
		'desc' => __('Your Facebook Profile.', 'options_check'),
		'id' => 'facebook_url',
		'std' => 'http://www.facebook.com/your-user-name',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Google Plus', 'options_check'),
		'desc' => __('Your Google Plus Profile.', 'options_check'),
		'id' => 'google_url',
		'std' => 'http://plus.google.com/your-user-name',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Twitter', 'options_check'),
		'desc' => __('Your Twitter Profile.', 'options_check'),
		'id' => 'twitter_url',
		'std' => 'http://twitter.com/your-user-name',
		'type' => 'text');		

	$options[] = array(
		'name' => __('LinkedIn', 'options_check'),
		'desc' => __('Your LinkedIn Profile.', 'options_check'),
		'id' => 'linkedin_url',
		'std' => 'http://linkedin.com/your-user-name',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Pinterest', 'options_check'),
		'desc' => __('Your Pinterest Profile.', 'options_check'),
		'id' => 'pinterest_url',
		'std' => 'http://pinterest.com/your-user-name',
		'type' => 'text');		

	$options[] = array(
		'name' => __('RSS', 'options_check'),
		'desc' => __('Your RSS url.', 'options_check'),
		'id' => 'rss_url',
		'std' => 'http://rss.com/your-user-name',
		'type' => 'text');			
		
	//Settings for Ads and Tracking Tab		
	$options[] = array(
		'name' => __('Ads & Tracking', 'options_check'),
		'type' => 'heading');			

	$options[] = array(
		'name' => __('Ads Setting', 'options_check'),
		'desc' => __('Check to display ads after header', 'options_check'),
		'id' => 'display_ad_code_after_header',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		//'name' => __('Ads Setting', 'options_check'),
		'desc' => __('Code to display ads immediately after header on all pages/posts.', 'options_check'),
		'id' => 'ad_code_in_header',
		'std' => '<img src="http://placehold.it/970x90"></img>',
		'type' => 'textarea');			
		
	$options[] = array(
		//'name' => __('Ads Setting', 'options_check'),
		'desc' => __('Check to display ads in Starting of Individual Post', 'options_check'),
		'id' => 'display_ad_code_in_post_start',
		'std' => '1',
		'type' => 'checkbox');				
		
	$options[] = array(
		//'name' => __('Tracking Code', 'options_check'),
		'desc' => __('Code to display ads in single post - After title on the top start of the post', 'options_check'),
		'id' => 'ad_code_in_post_start',
		'std' => '<img src="http://placehold.it/250x250"></img>',
		'type' => 'textarea');		


	$options[] = array(
		//'name' => __('Ads Setting', 'options_check'),
		'desc' => __('Check to display ads in the end of Individual Post', 'options_check'),
		'id' => 'display_ad_code_in_post_end',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		//'name' => __('Tracking Code', 'options_check'),
		'desc' => __('Code to display ads in single post - After post in the bottom', 'options_check'),
		'id' => 'ad_code_in_post_end',
		'std' => '<img src="http://placehold.it/468x60"></img>',
		'type' => 'textarea');			
		
	$options[] = array(
		'name' => __('Tracking Code', 'options_check'),
		'desc' => __('Google Analytics Tracking code goes here. It will be included in to your footer', 'options_check'),
		'id' => 'google_analytics_code',
		'std' => '',
		'type' => 'textarea');		

	return $options;
}