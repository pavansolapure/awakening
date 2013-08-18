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

 if ( ! function_exists( 'awakening_setup' ) ):	
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
endif;
add_action( 'after_setup_theme', 'awakening_setup' );

//Google Custom Search Widget
require(get_template_directory() . '/inc/widgets/google-cse-widget.php');

//Feedburner Widget
require(get_template_directory() . '/inc/widgets/awakening-feedburner-widget.php');

//Category Widget adhering to Foundation CSS
require(get_template_directory() . '/inc/widgets/awakening-category-widget.php');

//Archive Widget adhering to Foundation CSS
require(get_template_directory() . '/inc/widgets/awakening-archive-widget.php');	

if ( ! function_exists( 'awakening_load_custom_widgets' ) ):	
function awakening_load_custom_widgets() {
	register_widget( 'GoogleCSE_Widget' );	
	register_widget( 'Feedburner_Widget' );
	register_widget( 'Awakening_Widget_Archives' );
	register_widget( 'Awakening_Widget_Categories' );
}
endif;
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
	wp_enqueue_script( 'awakening-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

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

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'awakening-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'awakening-ie', get_template_directory_uri() . '/css/ie8-grid-foundation-4.css', array( 'awakening-style' ), '20121010' );
	$wp_styles->add_data( 'awakening-ie', 'conditional', 'lt IE 8' );
	
	// Load JavaScripts
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', array('zepto'), '4.0', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri().'/js/vendor/custom.modernizr.js', null, '2.1.0');
	wp_enqueue_script( 'zepto', get_template_directory_uri().'/js/vendor/zepto.js', null, '2.1.0', true);


	// Load Stylesheets
	wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css' );		
	wp_enqueue_style( 'foundation', get_template_directory_uri().'/css/foundation.css' );
	wp_enqueue_style( 'social-foundation', get_template_directory_uri().'/css/social_foundicons.css' );
	wp_enqueue_style( 'app', get_stylesheet_uri(), array('foundation') );	
}
add_action( 'wp_enqueue_scripts', 'awakening_scripts_styles' );

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
	
	//Front Page Widget Section
	
	register_sidebar( array(
		'id' => 'awakening_front_page_one',
		'name' => __( 'Front Page Widget One', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and first widget.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="front-page-widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'id' => 'awakening_front_page_two',
		'name' => __( 'Front Page Widget Two', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and second widget.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="front-page-widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'id' => 'awakening_front_page_three',
		'name' => __( 'Front Page Widget Three', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and third widget.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="front-page-widget-title">',
		'after_title' => '</h5>',
	) );

	if(of_get_option('front_page_widget_section_count')=='4') {
	register_sidebar( array(
		'id' => 'awakening_front_page_four',
		'name' => __( 'Front Page Widget Four', 'awakening' ),
		'description' => __( 'This widget area is active only on frontpage and fourth widget.', 'awakening' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="front-page-widget-title">',
		'after_title' => '</h5>',
	) );	
	} else {
		unregister_sidebar( 'awakening_front_page_four' );
	}	
	
	
}
add_action( 'widgets_init', 'awakening_widgets_init' );

if ( ! function_exists( 'awakening_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Awakening 1.0
 */
function awakening_content_nav( $html_id ) {
	//Call Custom Pagination here instead of calling it on each and every page where its required
	custom_pagination();	
}
endif;

if ( ! function_exists( 'awakening_comment' ) ) :
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
endif;

if ( ! function_exists( 'awakening_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own awakening_entry_meta() to override in a child theme.
 *
 * @since Awakening 1.0
 */
function awakening_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'awakening' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'awakening' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'awakening' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'awakening' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'awakening' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'awakening' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

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

class theme_navigation extends Walker_Nav_Menu {
	
	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown\">\n";
	}
		
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( !empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'has-dropdown';
		}		
		$output .= "<li class=\"divider\"></li>";
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

if ( ! function_exists( 'awakening_page_menu' ) ) :

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

endif;


if ( ! function_exists( 'custom_pagination' ) ) :

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
endif;


	
if ( ! function_exists( 'awakening_wp_head' ) ) :
function awakening_wp_head() {

    // write css depending up on the layout
	$theme_layout = of_get_option('theme_layout'); 
	if("boxed" == $theme_layout) {
	?>
	<style type="text/css" media="all"> #bodychild{	width:80%;}</style>
	<?php	
	}
}
add_action( 'wp_head', 'awakening_wp_head');
endif;	

if ( ! function_exists( 'awakening_wp_footer' ) ) :
function awakening_wp_footer() {
	$tracking_code = of_get_option('google_analytics_code'); 
	if(isset($tracking_code)) {
		echo $tracking_code;
	}
	?>	
	<script type='text/javascript'>
	$(document).foundation();
	</script>
	<?php
}
add_action( 'wp_footer', 'awakening_wp_footer',100);
endif;	

if ( ! function_exists( 'awakening_excerpt_read_more' ) ) :

function awakening_excerpt_read_more($text) {
   return str_replace('[...]', '<span><a href="'.get_permalink().'" class="readmore">Continue reading &rarr;</a></span>', $text); }
add_filter('the_excerpt', 'awakening_excerpt_read_more');

endif;

if ( ! function_exists( 'awakening_custom_excerpt_length' ) ) :

function awakening_custom_excerpt_length($length) {
	return 85;
}
add_filter('excerpt_length', 'awakening_custom_excerpt_length');

endif;
