<?php
/**
 * Sidebar Left
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>
<?php $cols = awakening_get_columns_settings(); ?>
<!-- Sidebar -->
<div class="large-<?php echo $cols['left'];?> columns sidebar-left" >
<?php if ( dynamic_sidebar('awakening_sidebar_left') ) : elseif( current_user_can( 'edit_theme_options' ) ) : ?>
	<h5><?php _e( 'No widgets found.', 'awakening' ); ?></h5>
	<p><?php printf( __( 'It seems you don\'t have any widgets in your sidebar! Would you like to %s now?', 'awakening' ), '<a href=" '. get_admin_url( '', 'widgets.php' ) .' ">populate your sidebar</a>' ); ?></p>

<?php endif; ?>
</div>
<!-- End Sidebar -->