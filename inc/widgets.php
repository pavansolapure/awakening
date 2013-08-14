<?php
/**
 * Widgets
 *
 * File : widgets.php
 * This loads all the custom widgets from one place.
 * 
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>

<?php

//Google Custom Search Widget
require_once dirname( __FILE__ ) . '/widgets/google-cse-widget.php';

//Archive Widget adhering to Foundation CSS
require_once dirname( __FILE__ ) . '/widgets/awakening-archive-widget.php';

//Category Widget adhering to Foundation CSS
require_once dirname( __FILE__ ) . '/widgets/awakening-category-widget.php';

//Feedburner Widget
require_once dirname( __FILE__ ) . '/widgets/awakening-feedburner-widget.php';
?>