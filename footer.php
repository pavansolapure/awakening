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
 
<!-- Footer -->
<footer>

	<div class="full-width" id="extended">	
		<?php
		/* A sidebar in the footer? Yep. You can customize
		 * your footer with three columns of widgets.
		 */
			get_sidebar( 'footer' );		
		?>		
	</div><!-- #extended -->	
	
	<div class="full-width copyright">	
	
		<div class="row" id="copyright-text">
		
			<div class="large-6 columns">
				<div class="row">
					<div class="large-12 columns left">
						<?php 
							wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'inline-list', 'container' => false, 'fallback_cb' => 'awakening_page_menu' ) ); 
						?>
					</div>
					<div class="large-12 columns left">
						  <p class="copyright-text">
						  <?php $copyright = of_get_option('copyright_text'); ?>
						  <?php if(isset($copyright) && $copyright!=""){ 
							echo $copyright; 
						  } else {	  
						  ?> 
						  All Rights Reserved.
						  <?php
						  }
						  ?> <span class="brand-note"> | Design by <a href="http://www.opencodez.com/" target="_blank">OpenCodez</a></span>
						  </p>
					</div>				
				</div>				
			</div>

			<div class="large-6 columns">
				<ul class="social-row inline-list right">				
				<?php if(of_get_option('rss_url')!=''):?>
					<li><a href="<?php echo of_get_option('rss_url');?>" alt="RSS" title="RSS" class="foundicon-rss"></a></li>
				<?php endif;?>
				
				<?php if(of_get_option('facebook_url')!=''):?>
					<li><a href="<?php echo of_get_option('facebook_url');?>" alt="Facebook" title="Facebook" class="foundicon-facebook"></a></li>
				<?php endif;?>
				
				<?php if(of_get_option('twitter_url')!=''):?>
					<li><a href="<?php echo of_get_option('twitter_url');?>" alt="Twitter" title="Twitter" class="foundicon-twitter"></a></li>
				<?php endif;?>
				
				<?php if(of_get_option('google_url')!=''):?>
					<li><a href="<?php echo of_get_option('google_url');?>" alt="Google Plus" title="Google Plus" class="foundicon-google-plus"></a></li>
				<?php endif;?>					
				
				<?php if(of_get_option('pinterest_url')!=''):?>
					<li><a href="<?php echo of_get_option('pinterest_url');?>" alt="Pinterest" title="Pinterest" class="foundicon-pinterest"></a></li>
				<?php endif;?>
				
				<?php if(of_get_option('linkedin_url')!=''):?>	
					<li><a href="<?php echo of_get_option('linkedin_url');?>" alt="Linkedin" title="Linkedin" class="foundicon-linkedin"></a></li>
				<?php endif;?>				
				</ul>	
			</div>		

		</div>	
		
	</div><!-- #copyright --> 		
</footer>
<!-- End Footer -->
</div> <!-- #bodychild --> 
<?php wp_footer(); ?>
</body>
</html>