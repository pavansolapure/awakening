<?php if ( is_active_sidebar( 'slider_widget' ) ) : ?>
<div class="slider-wrapper">
	<div class="responisve-container">
		<div class="slider">
			<div class="fs_loader"></div>
			<?php dynamic_sidebar( 'slider_widget' ); ?>
		</div>
	</div>
</div>	
<?php endif; ?>	
