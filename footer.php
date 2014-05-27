<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Awakening
 * @subpackage Awakening
 * @since Awakening 1.0
 */
?>

	</div> <!-- #main-row -->
 </div> <!-- .container -->
<!-- Footer -->
<footer>

		<?php
		/* A sidebar in the footer? Yep. You can customize
		 * your footer with three columns of widgets.
		 */
			get_sidebar( 'footer' );		
		?>		
		
	<div class="full-width copyright">	
	
		<div class="row" id="copyright-text">
		
			<div class="large-6 columns">
			<?php 
				wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'inline-list', 'container' => false, 'fallback_cb' => false ) ); 
			?>			
			</div>

			<div class="large-6 columns">
				<p class="copyright-text right">
				<?php $copyright = of_get_option('copyright_text'); ?>
				<?php if(isset($copyright) && $copyright!=""){ 
				echo $copyright; 
				} else {	  
				?> 
				&copy; All Rights Reserved.
				<?php
				}
				?> <span class="brand-note"> | <a href="http://www.opencodez.com/" target="_blank">Opencodez Themes</a></span>
				</p>
			</div>		

		</div>	
		
	</div><!-- #copyright --> 		
</footer>
<!-- End Footer -->
</div> <!-- #bodychild --> 
<?php wp_footer(); ?>
</body>
</html>