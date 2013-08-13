<?php
	$imagepath =  get_template_directory_uri() . '/images/';
	$slider_img_1 = of_get_option('slider_img_1');
	$slider_img_2 = of_get_option('slider_img_2');
	$slider_img_3 = of_get_option('slider_img_3');	
	$slider_img_4 = of_get_option('slider_img_4');	
	
	if(($slider_img_1 == "")) unset($slider_img_1);
	if(($slider_img_2 == "")) unset($slider_img_2);
	if(($slider_img_3 == "")) unset($slider_img_3);
	if(($slider_img_4 == "")) unset($slider_img_4);
	
	$caption_1 = trim(of_get_option('slider_image_caption_1'));
	$caption_2 = trim(of_get_option('slider_image_caption_2'));
	$caption_3 = trim(of_get_option('slider_image_caption_3'));
	$caption_4 = trim(of_get_option('slider_image_caption_4'));
	
	if(($caption_1 == "")) unset($caption_1);
	if(($caption_2 == "")) unset($caption_2);
	if(($caption_3 == "")) unset($caption_3);
	if(($caption_4 == "")) unset($caption_4);	
	
?>
<?php if(isset($slider_img_1) || isset($slider_img_2) || isset($slider_img_3) || isset($slider_img_4)) :?>
<div class="large-12 large-centered columns">	
	<div class="slideshow-wrapper">
		<div class="preloader"></div>
		<ul data-orbit>
		  <?php if(isset($slider_img_1)): ?>	
		  <li>
			<img src="<?php echo esc_url($slider_img_1);?>" />
			<?php if(isset($caption_1)):?>
				<div class="orbit-caption"><?php echo $caption_1; ?></div>
			<?php endif;?>
		  </li>
		  <?php endif;?>
		  <?php if(isset($slider_img_2)): ?>
		  <li>
			<img src="<?php echo esc_url($slider_img_2);?>" />
			<?php if(isset($caption_2)):?>
				<div class="orbit-caption"><?php echo $caption_2; ?></div>
			<?php endif;?>
		  </li>
		  <?php endif;?>
		  <?php if(isset($slider_img_3)): ?>
		  <li>
			<img src="<?php echo esc_url($slider_img_3);?>" />
			<?php if(isset($caption_3)):?>
				<div class="orbit-caption"><?php echo $caption_3; ?></div>
			<?php endif;?>
		  </li>
		  <?php endif;?>
		  <?php if(isset($slider_img_4)): ?>
		  <li>
			<img src="<?php echo esc_url($slider_img_4);?>" />
			<?php if(isset($caption_4)):?>
				<div class="orbit-caption"><?php echo $caption_4; ?></div>
			<?php endif;?>				
		  </li>	
		  <?php endif;?>	
		</ul>
	</div>
</div>	
<?php endif;?>

