<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>
<!-- Sidebar -->
<div class="large-3 columns sidebar-right">	
<?php if ( dynamic_sidebar('awakening_sidebar_right') ) : elseif( current_user_can( 'edit_theme_options' ) ) : ?>
	<h5><?php _e( 'No widgets found.', 'awakening' ); ?></h5>
	<p><?php printf( __( 'It seems you don\'t have any widgets in your sidebar! Would you like to %s now?', 'awakening' ), '<a href=" '. get_admin_url( '', 'widgets.php' ) .' ">populate your sidebar</a>' ); ?></p>
<?php endif; ?>	
</div>
<!-- End Sidebar -->