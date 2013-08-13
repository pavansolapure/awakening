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
<meta name="viewport" content="width=device-width" />
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
<!-- Start Top Bar --> 
<nav class="top-bar">   
<ul class="title-area">
  <!-- Title Area -->
  <li class="name">
	<h1></h1>
  </li>
  <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
</ul>	
<section class="top-bar-section">			
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'right', 'container' => false, 'fallback_cb' => 'theme_page_menu', 'walker' => new theme_navigation() ) ); ?>			
</section>
</nav><!-- #site-navigation -->
<!-- End Top Bar --> 

<?php $header =  get_header_textcolor();
$header_background = of_get_option('header_background');
$site_logo = of_get_option('site_logo');
if ( $header !== "blank" ) : ?>
<header class="site-header" role="banner" style="background:url('<?php echo esc_url($header_background); ?>');">
<?php if ( $site_logo != '' ) : ?>
		 <div class="row">
			<div class="large-3 columns">
			 <a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo('description'); ?>" /></a>            
			 </div>
			 <div class="large-6 columns"></div>			 
			 <div class="large-3 columns"></div>					 	 
		 </div>
<?php endif; ?>
<?php if ( $site_logo == '' || !isset($site_logo) ) : ?>
<div class="row">
  <div class="large-6 columns">			 			 
	  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>	  
	  </h1>
	  <?php 
		if("" != bloginfo( 'description' )) {
		?>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php
		}
	  ?>	  
  </div>
  <div class="large-3 columns" ></div>
  <div class="large-3 columns" ></div>
</div> 		
<?php endif; ?>
</header>
<?php endif; ?>   
<!-- End Header and Nav -->

<?php if(of_get_option('display_ad_code_after_header')=='1'): ?>
<div class="row top-ad" >
	<div class="large-12 columns">
	<?php echo of_get_option('ad_code_in_header'); ?>
	</div>
</div>
<?php endif; ?>	

<div class="row" id="main-row">

