<?php
/**
 * Awakening functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Awakening supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Awakening 1.0
 */
function awakening_setup() {

	// Load up our theme options page and related code. Options Framework	
	require_once(get_template_directory() . '/inc/options-panel.php');
	
	/*
	 * Makes Awakening available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Awakening, use a find and replace
	 * to change 'awakening' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'awakening', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'awakening' ) );	
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'awakening' ) );

	
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop	

}
add_action( 'after_setup_theme', 'awakening_setup' );


//Feedburner Widget
require(get_template_directory() . '/inc/widgets/awakening-feedburner-widget.php');

//Social Icons Widget
require(get_template_directory() . '/inc/widgets/awakening-social-box-widget.php');	

//Front Page Unit
require(get_template_directory() . '/inc/widgets/awakening-front-page-feature-text-widget.php');	

//Front Page Unit
require(get_template_directory() . '/inc/widgets/awakening-slide-widget.php');	

function awakening_load_custom_widgets() {
	register_widget( 'awakening_socialiconbox_widget' );
	register_widget( 'awakening_feedburner_widget' );
	register_widget( 'awakening_frontpage_featured_text_widget' );
	register_widget( 'awakening_slide_widget' );
	
}
add_action('widgets_init', 'awakening_load_custom_widgets');


/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Awakening 1.0
 */
function awakening_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	//wp_enqueue_script( 'awakening-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'awakening-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'awakening' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'awakening' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		//wp_enqueue_style( 'awakening-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}
	
	// Load JavaScripts
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '5.0.2', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri().'/js/modernizr.js', null, '2.6.2');
	wp_enqueue_script( 'fs-slider', get_template_directory_uri().'/js/jquery.fractionslider.min.js', null, '0.9.101', true );
	
	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'foundation-ie', get_template_directory_uri() . '/css/ie8-grid-foundation-4.css', array( 'awakening' ), '20121010' );
	$wp_styles->add_data( 'foundation-ie', 'conditional', 'lt IE 8' );	
	
	wp_enqueue_style( 'foundation-ie', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', array( 'awakening' ), '20121010' );
	$wp_styles->add_data( 'fa-ie', 'conditional', 'lt IE 8' );		

	// Load Stylesheets
	//wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css' );		
	wp_enqueue_style( 'foundation', get_template_directory_uri().'/css/foundation.css' );
	wp_enqueue_style( 'social', get_template_directory_uri().'/css/zocial.css' );
	wp_enqueue_style( 'foundation-icons', get_template_directory_uri().'/css/font-awesome.min.css' );
	wp_enqueue_style( 'fractionslider', get_template_directory_uri().'/css/fractionslider.css' );
	wp_enqueue_style( 'sliderelements', get_template_directory_uri().'/css/sliderstyles.css' );
	
	/*
	 * Loads our main stylesheet.
	 */	
	wp_enqueue_style( 'awakening', get_stylesheet_uri(), array('foundation') );	
}
add_action( 'wp_enqueue_scripts', 'awakening_scripts_styles' );

// queue up the necessary js
function awakening_admin_scripts($hooks)
{
	if ( 'widgets.php' == $hooks ) {
		wp_enqueue_media();			
		wp_enqueue_script( 'awakening-widgets', get_template_directory_uri() . '/js/widgets.js', array( 'jquery-ui-sortable' ) );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );	
		wp_enqueue_style( 'widget-frontpage-featured-text', get_template_directory_uri().'/css/widget-frontpage-featured-text.css' );		
	}
}
add_action('admin_enqueue_scripts', 'awakening_admin_scripts');

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Awakening 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function awakening_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'awakening' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'awakening_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Awakening 1.0
 */
function awakening_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'awakening_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Awakening 1.0
 */
function awakening_widgets_init() {

	// Header Right
	register_sidebar( array(
			'id' => 'awakening_header_right',
			'name' => __( 'Header Right', 'awakening' ),
			'description' => __( 'This sidebar is located on the right-hand side of header area.', 'awakening' ),
			'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="header-widget-title">',
			'after_title' => '</h5>',
		) );
		
	// Sidebar Right
	register_sidebar( array(
			'id' => 'awakening_sidebar_right',
			'name' => __( 'Sidebar Right', 'awakening' ),
			'description' => __( 'This sidebar is located on the right-hand side of each page. This is Default Side bar.', 'awakening' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
		
	// Sidebar Left
	register_sidebar( array(
			'id' => 'awakening_sidebar_left',
			'name' => __( 'Sidebar Left', 'awakening' ),
			'description' => __( 'This sidebar is located on the left-hand side of each page.', 'awakening' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );		
		
	// Sidebar Footer
	register_sidebar( array(
			'id' => 'extended_footer_one',
			'name' => __( 'Footer One', 'awakening' ),
			'description' => __( 'This sidebar is located on Footer and its First section. Occupies 4 Columns out of 12.', 'awakening' ),
			'before_widget' => '<div class="row"><div class="large-12 columns footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h5 class="footer-widget-title">',
			'after_title' => '</h5>',
		) );	
	// Sidebar Footer
	register_sidebar( array(
			'id' => 'extended_footer_two',
			'name' => __( 'Footer Two', 'awakening' ),
			'description' => __( 'This sidebar is located on Footer and its Second section.Occupies 4 Columns out of 12.', 'awakening' ),
			'before_widget' => '<div class="row"><div class="large-12 columns footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h5 class="footer-widget-title">',
			'after_title' => '</h5>',
		) );
	// Sidebar Footer
	register_sidebar( array(
			'id' => 'extended_footer_three',
			'name' => __( 'Footer Three', 'awakening' ),
			'description' => __( 'This sidebar is located on Footer and its Third section. Occupies 4 Columns out of 12.', 'awakening' ),
			'before_widget' => '<div class="row"><div class="large-12 columns footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h5 class="footer-widget-title">',
			'after_title' => '</h5>',
		) );		
	
	if(of_get_option('extended_footer_count')=='4') {
			register_sidebar( array(
			'id' => 'extended_footer_four',
			'name' => __( 'Footer Four', 'awakening' ),
			'description' => __( 'This sidebar is located on Footer and its Third section. Occupies 4 Columns out of 12.', 'awakening' ),
			'before_widget' => '<div class="row"><div class="large-12 columns footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h5 class="footer-widget-title">',
			'after_title' => '</h5>',
		) );
	} else {
		unregister_sidebar( 'extended_footer_four' );
	}	
	
	
	//Here we are providing widget area as a row. 
	//So we must calculate the number of widgets first in this row to adjust the number of columns for each widget.
	//if 3 or less widgets, 4 columns will be alloated, else 3 columns ... not sure how this is working I just gave it a try and it worked ;)
	$mysidebars = wp_get_sidebars_widgets();
	if(isset($mysidebars['awakening_front_page_widget_row_one'])){
	$total_widgets = count( $mysidebars['awakening_front_page_widget_row_one'] );	
	if($total_widgets <= 3) $cols = 4;
	else $cols = 3;	
	}  else $cols = 3;	
	
	//Front Page Widget Row Section	1
	register_sidebar( array(
		'id' => 'awakening_front_page_widget_row_one',
		'name' => __( 'Front Page Widget Row One', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and first widget area/row.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="large-'.$cols.' columns front-page-row-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );	
	
	if(isset($mysidebars['awakening_front_page_widget_row_two'])){
	$total_widgets = count( $mysidebars['awakening_front_page_widget_row_two'] );	
	if($total_widgets <= 3) $cols = 4;
	else $cols = 3;		
	} else $cols = 3;	
	//Front Page Widget Row Section	2
	register_sidebar( array(
		'id' => 'awakening_front_page_widget_row_two',
		'name' => __( 'Front Page Widget Row Two', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and second widget area/row.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="large-'.$cols.' columns front-page-row-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );	
	
	if(isset($mysidebars['awakening_front_page_widget_row_three'])){
	$total_widgets = count( $mysidebars['awakening_front_page_widget_row_three'] );	
	if($total_widgets <= 3) $cols = 4;
	else $cols = 3;	
	} else $cols = 3;		
	//Front Page Widget Row Section	2
	register_sidebar( array(
		'id' => 'awakening_front_page_widget_row_three',
		'name' => __( 'Front Page Widget Row Two', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and second widget area/row.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="large-'.$cols.' columns front-page-row-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );	

	//Front Page Slider Area Widget Only for Front Page	
	register_sidebar( array(
			'id' => 'slider_widget',
			'name' => __( 'Slider Widget Area', 'awakening' ),
			'description' => __( 'This widget area is exclusively for front page template and expects only Slide Widgets', 'awakening' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		) );			
	
}
add_action( 'widgets_init', 'awakening_widgets_init' );

/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Awakening 1.0
 */
function awakening_content_nav( $html_id ) {
	//Call Custom Pagination here instead of calling it on each and every page where its required
	custom_pagination();	
}


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own awakening_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Awakening 1.0
 */
function awakening_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'awakening' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'awakening' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
		<div class="row comment-row radius" >
			<div class="large-3 columns">
				<?php echo get_avatar( $comment, 100 ); ?>	
			</div>
			<div class="large-9 columns">
				<div class="row" >
					<div class="large-12 columns text-left">
						<span>
						<?php
						printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'awakening' ) . '</span>' : ''
						);
						?>				
						<?php
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'awakening' ), get_comment_date(), get_comment_time() )
					);
				?>
					</span>
				<hr/>						
					</div>
					<div class="large-12 columns">
					
					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'awakening' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'awakening' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->

					<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'awakening' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
			
			
					</div>					
				</div>	
			</div>			
		</div>			
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}


/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Awakening 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function awakening_body_class( $classes ) {
	$background_color = get_background_color();

	if (is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
	}
	
	if ( is_active_sidebar( 'awakening_sidebar_right' ) && is_active_sidebar( 'awakening_sidebar_left' ) )
		$classes[] = 'two-sidebars';	

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'awakening-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'awakening_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Awakening 1.0
 */
function awakening_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'awakening_sidebar_right' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'awakening_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Awakening 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function awakening_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'awakening_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Awakening 1.0
 */
function awakening_customize_preview_js() {
	wp_enqueue_script( 'awakening-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'awakening_customize_preview_js' );



//Custom Stuff

/**
 * Top Bar Walker
 *
 * @since 1.0.0
 */
class Top_Bar_Walker extends Walker_Nav_Menu {
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 1.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
    */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }

    /**
     * @see Walker_Nav_Menu::start_el()
     * @since 1.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */

    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $item_html = '';
        parent::start_el( $item_html, $object, $depth, $args ); 

        $output .= ( $depth == 0 ) ? '<li class="divider"></li>' : '';

        $classes = empty( $object->classes ) ? array() : ( array ) $object->classes;    

        if ( in_array('label', $classes) ) {
            $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '<label>$1</label>', $item_html );
        }

        if ( in_array('divider', $classes) ) {
            $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
        }

        $output .= $item_html;
    }

    /**
     * @see Walker::display_element()
     * @since 1.0.0
     * 
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $element->has_children = !empty( $children_elements[$element->ID] );
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

}

// Create a graceful fallback to wp_page_menu
function theme_page_menu() {

	$args = array(
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'right',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => '',
	'items_wrap' => ''
	);

	wp_page_menu($args);
}


function custom_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  
	 
     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination-centered'><ul class=pagination>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         //if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Prev</a></li>";		 
		 if($paged > 1 && $showitems < $pages) echo "<li>".get_previous_posts_link("&lsaquo; Prev")."</li>";	 		 

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='current'><a href=''>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }
		 
		 if ($paged < $pages && $showitems < $pages) echo "<li>".get_next_posts_link("Next &rsaquo;")."</li>";
         //if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>Next &rsaquo;</a></</li>";  		 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul></div> <!-- .pagination-centered -->";
     }
}

function awakening_wp_head() {
	$body_background = of_get_option('body_background');	
	$customcss = array();
	$bcss = '';
	if(!empty($body_background['color']) || !empty($body_background['image'])) {
		$bcss = 'body.custom-background { background:';
		$bcss .= (!empty($body_background['color'])) ? " ".$body_background['color'] : '';
		$bcss .= (!empty($body_background['image'])) ? " url('".$body_background['image']."')" : '';
		$bcss .= (!empty($body_background['image']) && !empty($body_background['repeat'])) ? " ".$body_background['repeat'] : '';
		$bcss .= (!empty($body_background['image']) && !empty($body_background['attachment'])) ? " ".$body_background['attachment'] : '';
		$bcss .= (!empty($body_background['image']) && !empty($body_background['position'])) ? " ".$body_background['position'] : '';
		$bcss .= ';}';
		$customcss[] = $bcss;
	}
	
	$header_background = of_get_option('site_header_background');	
	if(!empty($header_background['color']) || !empty($header_background['image'])) {
		$bcss = '.site-header { background:';
		$bcss .= (!empty($header_background['color'])) ? " ".$header_background['color'] : '';
		$bcss .= (!empty($header_background['image'])) ? " url('".$header_background['image']."')" : '';
		$bcss .= (!empty($header_background['image']) && !empty($header_background['repeat'])) ? " ".$header_background['repeat'] : '';
		$bcss .= (!empty($header_background['image']) && !empty($header_background['attachment'])) ? " ".$header_background['attachment'] : '';
		$bcss .= (!empty($header_background['image']) && !empty($header_background['position'])) ? " ".$header_background['position'] : '';
		$bcss .= ';}';	
		$customcss[] = $bcss;
	}

if(!empty($customcss)) { ?>
<style type="text/css" media="all"> 
<?php 
	$cnt = count($customcss);
	foreach($customcss as $index => $css) {
		echo $css;
		if($index < $cnt-1) echo "\r\n";
	}
?> 
</style>	
<?php }

}
add_action( 'wp_head', 'awakening_wp_head', 100);


function awakening_wp_footer() {
	$tracking_code = of_get_option('google_analytics_code'); 
	if(isset($tracking_code)) {
		echo $tracking_code;
	}
	?>    
	<script type='text/javascript'>
	jQuery.noConflict();	
	jQuery(window).load(function(){
		jQuery(document).foundation();
	});	
	
	jQuery(document).ready(function(){
		jQuery('.slider').fractionSlider({			
			'controls': 			<?php echo (of_get_option('display_slider_control')) ? 'true':'false'; ?>, 
			'pager': 				<?php echo (of_get_option('display_slider_pager')) ? 'true':'false'; ?>, 
			'responsive': 			true,
			'dimensions': 			"<?php echo of_get_option('slider_dimension'); ?>",
			'pauseOnHover': 		<?php echo (of_get_option('slider_pause_on_hover')) ? 'true':'false'; ?>, 
			'slideEndAnimation': 	true,
			'speedIn' : <?php echo of_get_option('data_in_transition_speed'); ?>,
			'speedOut' : <?php echo of_get_option('data_out_transition_speed'); ?>,
			'slideTransitionSpeed' : <?php echo of_get_option('slider_transition_speed'); ?>
		});
	});	
	
	//This is used when a 2 level custom menu is placed in header widget area.
	jQuery(document).ready(function(){
	  jQuery('.header-widget.widget_nav_menu li').hover(function () {
		 clearTimeout(jQuery.data(this,'timer'));
		 jQuery('ul',this).stop(true,true).slideDown(200);
	  }, function () {
		jQuery.data(this,'timer', setTimeout(jQuery.proxy(function() {
		  jQuery('ul',this).stop(true,true).slideUp(200);
		}, this), 100));
	  });
	});
	
	jQuery(document).ready(function($) { //noconflict wrapper
		$('.form-submit input#submit').addClass('small radius button');
	});//end noconflict		
    	
	</script>
	<?php
}
add_action( 'wp_footer', 'awakening_wp_footer',100);

add_filter('the_excerpt','awakening_excerpt');
function awakening_excerpt(){
	global $post;
	$link='<span class="label secondary"><a href="'.get_permalink().'" > Read More +</a></span>';
	$excerpt=get_the_excerpt();		
	if ( preg_match('/<!--more(.*?)?-->/', $post->post_content) ) {	
		echo $excerpt.$link;
	} else {
		echo $excerpt;
	}
}
function awakening_excerpt_read_more($text) {
   return '  <span class="label secondary"><a href="'.get_permalink().'" > Read More +</a></span>';
}
add_filter('excerpt_more', 'awakening_excerpt_read_more');


function awakening_custom_excerpt_length($length) {
	return 85;
}
add_filter('excerpt_length', 'awakening_custom_excerpt_length');

// return entry meta information for posts, used by multiple loops.

function awakening_entry_meta() {
	echo '<span class="byline author">'. __('Written by', 'reverie') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .', </a></span>';
	echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. get_the_time('F jS, Y') .'</time>';
}

function awakening_get_columns_settings() {

	$layout = of_get_option('page_layouts');
	$col_settings = array();	
	$col_settings['layout'] = $layout;
	switch($layout) {
		case "full-width":
			$col_settings['content'] = 12;
			break;
		case "sidebar-content":
			$col_settings['content'] = 8;
			$col_settings['left'] = 4;			  
			break;
		case "content-sidebar":
			$col_settings['content'] = 8;
			$col_settings['right'] = 4;					
			break;
		case "content-sidebar-sidebar":	
		case "sidebar-sidebar-content":
		case "sidebar-content-sidebar":			
			$col_settings['content'] = 7;
			$col_settings['right'] = 3;	
			$col_settings['left'] = 2;				
			break;	
		default:
			$col_settings['content'] = 8;
			$col_settings['right'] = 4;				
	}	
	
	//alter setting if page is being displayed
	if(is_page()) {
		if (is_page_template( 'page-templates/content-sidebar.php' ) ){
			$col_settings['content'] = 8;
			$col_settings['right'] = 4;	
		} else if (is_page_template( 'page-templates/sidebar-content.php' ) ){
			$col_settings['content'] = 8;
			$col_settings['left'] = 4;			
		} else if(is_page_template( 'page-templates/content-sidebar-sidebar.php' ) 
				  || is_page_template( 'page-templates/sidebar-content-sidebar.php' )
				  || is_page_template( 'page-templates/sidebar-sidebar-content.php' )){
			$col_settings['content'] = 7;
			$col_settings['right'] = 3;	
			$col_settings['left'] = 2;			
		} else if (is_page_template( 'page-templates/full-width.php' ) ){
			$col_settings['content'] = 12;
		}		
	}	
	return $col_settings;			
}


function awakening_widget_field( $widget, $args = array(), $value ) {
	$args = wp_parse_args($args, array ( 
		'field' => 'title',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'class' => 'widefat',
		'options' => array(),
		'label_all' => '',
		'ptag' => true,
		) );
	extract( $args, EXTR_SKIP );

	$field_id =  esc_attr( $widget->get_field_id( $field ) );
	$field_name = esc_attr( $widget->get_field_name( $field ) );
	
	if ( $ptag )
		echo '<p>';
	if ( ! empty( $label ) ) {
		echo '<label for="' . $field_id . '">';
		echo $label . '</label>';
	}
	switch ( $type ) {
		case 'media':
			echo '<input class="media-upload-url" id="' . $field_id;
			echo '" name="' . $field_name . '" type="hidden" value="';
			echo esc_attr( $value ) . '" />';
			echo '<input class="media-upload-btn" id="' . $field_id;
			echo '_btn" name="' . $field_name . '_btn" type="button" value="'. __( 'Choose', 'awakening' ) . '">';
			echo '<input class="media-upload-del" id="' . $field_id;
			echo '_del" name="' . $field_name . '_del" type="button" value="'. __( 'Remove', 'awakening' ) . '">';
			break;
		case 'text':
		case 'hidden':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" value="';
			echo esc_attr( $value ) . '" />';
			break;
		case 'url':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" value="';
			echo esc_url( $value ) . '" />';
			break;
		case 'textarea':
			echo '<textarea class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" row="10" col="20">';
			echo esc_textarea( $value ) . '</textarea>';
			break;
		case 'number':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="text" size="3" value="';
			echo esc_attr( $value ) . '" />';
			break;
		case 'checkbox':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" value="1" ';
			echo checked( '1', $value, false ) . ' /> ';
			echo '<label for="' . $field_id . '"> ' . $desc . '</label>';
			break;
		case 'label':
			echo '<label for="' . $field_id . '"> ' . $desc . '</label>';
			break;			
		case 'category':
			echo '<select id="' . $field_id . '" name="' . $field_name . '">';
			if ( ! empty( $label_all ) ) {
				if ( 0 == $value )
					$selected = 'selected="selected"';				
			 	else
				 	$selected = '';
			 	echo '<option value="0" ' . $selected;
			 	echo '>' . $label_all . '</option>';				
			}
			foreach ( $options as $option ) {
				if ( $option->term_id == $value )
					$selected = 'selected="selected"';
				else
					$selected = '';	
				echo '<option value="' . $option->term_id . '" ' . $selected;
				echo '>' . $option->name . '</option>';
			}
			echo '</select>';
			break;
		case 'select':
			echo '<select id="' . $field_id . '" name="' . $field_name . '">';
			foreach ( $options as $option ) {
				if ( $option['key'] == $value )
					$selected = 'selected="selected"';
				else
					$selected = '';	
				echo '<option value="' . $option['key'] . '" ' . $selected;
				echo '>' . $option['name'] . '</option>';
			}
			echo '</select>';
			break;			
		case 'icon-select':
			ksort($options, SORT_STRING);
			echo '<div class="icon-select"><select class="widget-icon widget-lib-font-awesome" id="' . $field_id . '" name="' . $field_name . '">';
			foreach ( $options as $k=>$v ) {
				if ( $k == $value )
					$selected = 'selected="selected"';
				else
					$selected = '';	
				echo '<option value="' . $k . '" ' . $selected. '>' . $v.'&nbsp;&nbsp;'.$k . '</option>';
			}
			echo '</select></div>';
			break;		

		// Color picker
		case "color":
			$default_color = '';
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="text" value="';
			echo esc_attr( $value ) . '"'.$default_color.' />';			
 	
			break;			
	}
	if ( $ptag )
		echo '</p>';
}


function awakening_thumbnail_array() {
	$sizes = array (
		array(	'key' => '',
				'name' => __( 'Thumbnail', 'awakening' ) ),
		array(	'key' => 'medium',
				'name' => __( 'Medium', 'awakening' ) ),
		array(	'key' => 'large',
				'name' => __( 'Large', 'awakening' ) ),
		array(	'key' => 'full',
				'name' => __( 'Full', 'awakening' ) ),
		array(	'key' => 'custom',
				'name' => __( 'Custom', 'awakening' ) ),
		array(	'key' => 'none',
				'name' => __( 'None', 'awakening' ) ),
	);
	global $_wp_additional_image_sizes;

	if ( isset( $_wp_additional_image_sizes ) )
		foreach( $_wp_additional_image_sizes as $name => $item) 
			$sizes[] = array( 'key' => $name, 'name' => $name );
	return apply_filters( 'awakening_thumbnail_array', $sizes );
}

function awakening_thumbnail_size( $option, $x = 96, $y = 96 ) {

	if ( empty( $option ) )
		return 'thumbnail';
	elseif ( 'custom' == $option ) {
		if (($x > 0) && ($y > 0) )
			return array( $x, $y);
		else
			return 'thumbnail';		
	}
	else 
		return $option;
}

?>
