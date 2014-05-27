<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="bodychild">

<?php $header =  get_header_textcolor();
//check and get if any header image set from WP Settings
$wp_header_image = get_header_image();		
if(empty($header_background) && !empty($wp_header_image)):
	$header_background = get_header_image();
endif;
$site_logo = of_get_option('site_logo');
if ( $header !== "blank" ) : ?>
<header class="site-header" role="banner">

<div class="row logo-row">
	<!--Logo-->
	<div class="small-6 large-4 columns">
		<?php if ( $site_logo != '' ) : ?>
			<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo('description'); ?>" /></a> 
		<?php else:?>	
		<h1 class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?></a>	  
		</h1> 
		<?php if("" != bloginfo( 'description' )) :?>
		<p class="site-description small"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<!--Header Widget-->
	<div class="small-6 large-8 columns right show-for-medium-ups">	
	<?php if ( is_active_sidebar( 'awakening_header_right' ) ) : ?>
		<?php dynamic_sidebar( 'awakening_header_right' ); ?>	
	<?php endif; ?>	
	
	</div>
</div>
</header>
<?php endif; ?>   

<div class="site-top-nav">
<!-- Start Top Bar --> 
<div class="contain-to-grid">
<div class="row">
<div class="large-12 columns">
<nav class="top-bar" data-topbar>   
<ul class="title-area">
  <!-- Title Area -->
  <li class="name">  
	<?php $show_search_in_top_menu = of_get_option('show_search_in_top_menu');
		  if(isset($show_search_in_top_menu) && $show_search_in_top_menu==true):		
	?>	
	<form method="get" id="topbar-search-sm" class="show-for-small" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	 <div class="row">
		<div class="small-12 columns">
			<input type="search" name="s" id="s" class="search-fields" placeholder="<?php esc_attr_e( 'Search', 'awakening' ); ?>"/>
		</div>
	 </div>
	</form>		
	<?php endif;?>	
  </li>  
  <li class="toggle-topbar menu-icon"><a href="#"><span>MENU</span></a></li>
</ul>	
<section class="top-bar-section">			
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'left', 'container' => false, 'fallback_cb' => false, 'walker' => new Top_Bar_Walker() ) ); ?>		
    <?php if(isset($show_search_in_top_menu) && $show_search_in_top_menu==true): ?>	
	<ul class="right show-for-large-up">
		<!-- Search | has-form wrapper -->
		<li class="has-form">	
			<form method="get" id="topbar-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="row">
					<div class="small-12 columns">
						<input type="search" name="s" id="s" class="search-fields" placeholder="<?php esc_attr_e( 'Search', 'awakening' ); ?>"/>
					</div>
				</div>
			</form>	
		</li>
	</ul>	
	<?php endif;?>
</section>
</nav>
</div>
</div>
</div>
<!-- End Top Bar -->
</div><!-- .site-top-nav -->
<!-- End Header and Nav -->
	<?php
		/**
		 * We need to put our slider code here as we are doing a full width slider 	
		*/
		if (is_page_template( 'page-templates/front-page.php' ) || is_front_page() ) {
			$display_slider = of_get_option('display_slider');
			if(isset($display_slider) && $display_slider==true) {
				get_template_part( 'slides', 'index' );
			}			
		}			
	?>
<div class="container" role="document">
	<div class="row">