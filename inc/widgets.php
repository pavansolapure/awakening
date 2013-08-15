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
get_template_part( 'inc/widgets/google-cse', 'widget' );

//Archive Widget adhering to Foundation CSS
get_template_part( 'inc/widgets/awakening-archive', 'widget' );

//Category Widget adhering to Foundation CSS
get_template_part( 'inc/widgets/awakening-category', 'widget' );

//Feedburner Widget
get_template_part( 'inc/widgets/awakening-feedburner', 'widget' );
?>