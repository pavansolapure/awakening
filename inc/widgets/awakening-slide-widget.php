<?php
/**
 * Slide For A Slider
 *
 * File : awakening-slide-widget-text.php
 * 
 * @package Awakening
 * @since Awakening 1.0.0
 */
?>
<?php

class awakening_slide_widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'aw-slide', 'description' => __('Slide for Front Page Slider. This is exclusively for Front Page Slider Template', 'awakening') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 400, 'height' => 450, 'id_base' => 'widget-aw-slide' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-aw-slide', __('(Awakening) Slide for Slider', 'awakening'), $widget_ops, $control_ops );		
		
        }
		
		/* Get Default values of fields. */
		function widget_defaults() {
			return array(
				'slide_image' => '',
				'slide_image_transition' => 'fade',
				
				'slide_head_text' => '',
				'slide_head_transition_in' => 'left',
				'slide_head_transition_out' => 'right',
				'slide_head_text_style' => '',
				
				'slide_sub_text_1' => '',
				'slide_sub_text_1_transition_in' => 'left',
				'slide_sub_text_1_transition_out' => 'right',
				'slide_sub_text_1_style' => '',		

				'slide_sub_text_2' => '',
				'slide_sub_text_2_transition_in' => 'left',
				'slide_sub_text_2_transition_out' => 'right',
				'slide_sub_text_2_style' => '',	

				'slide_sub_text_3' => '',
				'slide_sub_text_3_transition_in' => 'left',
				'slide_sub_text_3_transition_out' => 'right',
				'slide_sub_text_3_style' => '',			
			);
		}		

        public function form( $instance ) {
	
			$instance = wp_parse_args( (array) $instance, $this->widget_defaults());

			awakening_widget_field( $this, array ( 'field' => 'slide_image', 'label' => __( 'Slide Image:', 'awakening' ), 'type' => 'media' ), $instance['slide_image'] );
			
			if ( $instance['slide_image'] )
				echo wp_get_attachment_image( $instance['slide_image'], awakening_thumbnail_size( 'medium' ), false, array( 'class' => 'widget-image' ) );
				
			$transitions = array (
				array(	'key' => 'fade',
						'name' => __( 'Fade', 'awakening' ) ),			
				array(	'key' => 'slideLeft',
						'name' => __( 'Slide Left', 'awakening' ) ),
				array(	'key' => 'slideRight',
						'name' => __( 'Slide Right', 'awakening' ) ),
				array(	'key' => 'slideTop',
						'name' => __( 'Slide Top', 'awakening' ) ),
				array(	'key' => 'slideBottom',
						'name' => __( 'Slide Bottom', 'awakening' ) ),
				array(	'key' => 'scrollLeft',
						'name' => __( 'Scroll Left', 'awakening' ) ),
				array(	'key' => 'scrollRight',
						'name' => __( 'Scroll Right', 'awakening' ) ),
				array(	'key' => 'scrollTop',
						'name' => __( 'Scroll Top', 'awakening' ) ),
				array(	'key' => 'scrollBottom',
						'name' => __( 'Scroll Bottom', 'awakening' ) )							
			);	
			
			$txt_transitions = array (
				array(	'key' => 'fade',
						'name' => __( 'Fade', 'awakening' ) ),			
				array(	'key' => 'left',
						'name' => __( 'Left', 'awakening' ) ),
				array(	'key' => 'right',
						'name' => __( 'Right', 'awakening' ) ),
				array(	'key' => 'top',
						'name' => __( 'Top', 'awakening' ) ),
				array(	'key' => 'bottom',
						'name' => __( 'Bottom', 'awakening' ) ),
				array(	'key' => 'scrollLeft',
						'name' => __( 'Scroll Left', 'awakening' ) ),
				array(	'key' => 'scrollRight',
						'name' => __( 'Scroll Right', 'awakening' ) ),
				array(	'key' => 'scrollTop',
						'name' => __( 'Scroll Top', 'awakening' ) ),
				array(	'key' => 'scrollBottom',
						'name' => __( 'Scroll Bottom', 'awakening' ) )							
			);			
			
		

			$styles = array (

				array(	'key' => 'large_bold_white',
						'name' => __( 'Large Bold White', 'awakening' ) ),

				array(	'key' => 'large_bold_black',
						'name' => __( 'Large Bold Black', 'awakening' ) ),

				array(	'key' => 'large_bold_grey',
						'name' => __( 'Large Bold Grey', 'awakening' ) ),			
							
				array(	'key' => 'large_bold_darkblue',
						'name' => __( 'Large Bold Dark Blue', 'awakening' ) ),	
						
				array(	'key' => 'largeblackbg',
						'name' => __( 'Large Black Background', 'awakening' ) ),

				array(	'key' => 'largepinkbg',
						'name' => __( 'Large Pink Background', 'awakening' ) ),

				array(	'key' => 'largewhitebg',
						'name' => __( 'Large White Background', 'awakening' ) ),
						
				array(	'key' => 'largegreenbg',
						'name' => __( 'Large Green Background', 'awakening' ) ),							
						
				array(	'key' => 'mediumlarge_light_white',
						'name' => __( 'Medium Large Light White', 'awakening' ) ),
						
				array(	'key' => 'mediumlarge_light_darkblue',
						'name' => __( 'Medium Large Light Dark Blue', 'awakening' ) ),
							
				array(	'key' => 'mediumwhitebg',
						'name' => __( 'Medium White Background', 'awakening' ) ),	

				array(	'key' => 'medium_bold_orange',
						'name' => __( 'Medium Bold Orange', 'awakening' ) ),	

				array(	'key' => 'medium_bg_orange',
						'name' => __( 'Medium Orange Background', 'awakening' ) ),

				array(	'key' => 'medium_bg_asbestos',
						'name' => __( 'Medium Asbestos Background', 'awakening' ) ),

				array(	'key' => 'medium_light_black',
						'name' => __( 'Medium Light Black', 'awakening' ) ),

				array(	'key' => 'modern_big_bluebg',
						'name' => __( 'Big Blue Background', 'awakening' ) ),

				array(	'key' => 'modern_big_redbg',
						'name' => __( 'Big Red Background', 'awakening' ) ),
						
				array(	'key' => 'very_big_white',
						'name' => __( 'Very Big White', 'awakening' ) ),	
						
				array(	'key' => 'smoothcircle',
						'name' => __( 'Circle', 'awakening' ) ),		

				array(	'key' => 'small_light_white',
						'name' => __( 'Small White', 'awakening' ) ),
									
			);				
			
			awakening_widget_field( $this, array ( 'field' => 'slide_image_transition', 'type' => 'select', 
												   'label' => __( 'Image Transition:', 'awakening' ), 
												   'options' => $transitions, 
												   'class' => '' ), $instance['slide_image_transition'] );				
				
			echo "<fieldset><legend><b>Head Item</b></legend>";
			
			awakening_widget_field( $this, array ( 'field' => 'slide_head_text', 'label' => __( 'Head Item Text:', 'awakening' ), 'type' => 'text'), $instance['slide_head_text'] );
			
			awakening_widget_field( $this, array ( 'field' => 'slide_head_transition_in', 'type' => 'select', 
												   'label' => __( 'Head Item Transition In:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_head_transition_in'] );	

			awakening_widget_field( $this, array ( 'field' => 'slide_head_transition_out', 'type' => 'select', 
												   'label' => __( 'Head Item Transition Out:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_head_transition_out'] );												   

			awakening_widget_field( $this, array ( 'field' => 'slide_head_text_style', 'type' => 'select', 
												   'label' => __( 'Head Item Style:', 'awakening' ), 
												   'options' => $styles, 
												   'class' => '' ), $instance['slide_head_text_style'] );		
			echo "</fieldset>";
			
			echo "<fieldset><legend><b>Sub Item 1</b></legend>";	
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_1', 'label' => __( 'Sub Item 1 Text:', 'awakening' ), 'type' => 'text'), $instance['slide_sub_text_1'] );			
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_1_transition_in', 'type' => 'select', 
												   'label' => __( 'Sub Item 1 Transition:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_sub_text_1_transition_in'] );		
												   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_1_transition_out', 'type' => 'select', 
												   'label' => __( 'Sub Item 1 Transition Out:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_sub_text_1_transition_out'] );													   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_1_style', 'type' => 'select', 
												   'label' => __( 'Sub Item 1 Style:', 'awakening' ), 
												   'options' => $styles, 
												   'class' => '' ), $instance['slide_sub_text_1_style'] );
			echo "</fieldset>";									   

			echo "<fieldset><legend><b>Sub Item 2</b></legend>";	
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_2', 'label' => __( 'Sub Item 2 Text:', 'awakening' ), 'type' => 'text'), $instance['slide_sub_text_2'] );			
			
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_2_transition_in', 'type' => 'select', 
												   'label' => __( 'Sub Item 2 Transition:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_sub_text_2_transition_in'] );		
												   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_2_transition_out', 'type' => 'select', 
												   'label' => __( 'Sub Item 2 Transition Out:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_sub_text_2_transition_out'] );													   
												   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_2_style', 'type' => 'select', 
												   'label' => __( 'Sub Item 2 Style:', 'awakening' ), 
												   'options' => $styles, 
												   'class' => '' ), $instance['slide_sub_text_2_style'] );	
			echo "</fieldset>";		
			echo "<fieldset><legend><b>Sub Item 3</b></legend>";										   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_3', 'label' => __( 'Sub Item 3 Text:', 'awakening' ), 'type' => 'text'), $instance['slide_sub_text_3'] );			
			
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_3_transition_in', 'type' => 'select', 
												   'label' => __( 'Sub Item 3 Transition:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_sub_text_3_transition_in'] );	
												   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_3_transition_out', 'type' => 'select', 
												   'label' => __( 'Sub Item 3 Transition Out:', 'awakening' ), 
												   'options' => $txt_transitions, 
												   'class' => '' ), $instance['slide_sub_text_3_transition_out'] );													   
												   
			awakening_widget_field( $this, array ( 'field' => 'slide_sub_text_3_style', 'type' => 'select', 
												   'label' => __( 'Sub Item 3 Style:', 'awakening' ), 
												   'options' => $styles, 
												   'class' => '' ), $instance['slide_sub_text_3_style'] );
			echo "</fieldset>";												
																						 
			   
        }

        public function update( $new, $old ) {				
			$instance = $old;
			
			$instance['slide_image'] =  $new['slide_image'];
			$instance['slide_image_transition'] = $new['slide_image_transition'];					
			
			$instance['slide_head_text'] =  $new['slide_head_text'];
			$instance['slide_head_transition_in'] = $new['slide_head_transition_in'];	
			$instance['slide_head_transition_out'] = $new['slide_head_transition_out'];			
			$instance['slide_head_text_style'] = $new['slide_head_text_style'];			

			$instance['slide_sub_text_1'] =  $new['slide_sub_text_1'];
			$instance['slide_sub_text_1_transition_in'] = $new['slide_sub_text_1_transition_in'];		
			$instance['slide_sub_text_1_transition_out'] = $new['slide_sub_text_1_transition_out'];
			$instance['slide_sub_text_1_style'] = $new['slide_sub_text_1_style'];		

			$instance['slide_sub_text_2'] =  $new['slide_sub_text_2'];
			$instance['slide_sub_text_2_transition_in'] = $new['slide_sub_text_2_transition_in'];
			$instance['slide_sub_text_2_transition_out'] = $new['slide_sub_text_2_transition_out'];	
			$instance['slide_sub_text_2_style'] = $new['slide_sub_text_2_style'];	

			$instance['slide_sub_text_3'] =  $new['slide_sub_text_3'];
			$instance['slide_sub_text_3_transition_in'] = $new['slide_sub_text_3_transition_in'];
			$instance['slide_sub_text_3_transition_out'] = $new['slide_sub_text_3_transition_out'];	
			$instance['slide_sub_text_3_style'] = $new['slide_sub_text_3_style'];				
					
		
			return $instance;			
        }

        public function widget( $args, $instance ) {	
		
			extract( $args, EXTR_SKIP );
			$instance = wp_parse_args($instance, $this->widget_defaults());
			extract( $instance, EXTR_SKIP );

			// do not add slide if image is empty
			if ( ! empty( $slide_image ) ) {
				echo $before_widget; 
				
				//start slide and add main image and set transition for it
				echo '<div class="slide" data-in="'.$slide_image_transition.'">'; 
						
				$rr = wp_get_attachment_image_src( $slide_image, 'full');				
				echo '<img 	src="'.$rr[0].'" data-fixed>';
				
				//check and add head/heading text
				if ( ! empty( $slide_head_text )):
					echo '<p class="'.$slide_head_text_style.'"			
							 data-position="30,30" 
							 data-in="'.$slide_head_transition_in.'" 
							 data-step="1" 
							 data-out="'.$slide_head_transition_out.'" 
							 data-ease-in="easeOutBounce">'.$slide_head_text.'</p>';
				endif;
				
				if ( ! empty( $slide_sub_text_1 )):
					echo '<p class="'.$slide_sub_text_1_style.'" 	
							 data-position="90,30" 
							 data-in="'.$slide_sub_text_1_transition_in.'" 
							 data-out="'.$slide_sub_text_1_transition_out.'" 
							 data-step="2">'.$slide_sub_text_1.'</p>';				
				endif;
				
				if ( ! empty( $slide_sub_text_2 )):
					echo '<p class="'.$slide_sub_text_2_style.'" 	
							 data-position="150,30" 
							 data-in="'.$slide_sub_text_2_transition_in.'" 
							 data-out="'.$slide_sub_text_2_transition_out.'" 
							 data-step="3">'.$slide_sub_text_2.'</p>';				
				endif;		

				if ( ! empty( $slide_sub_text_3 )):
					echo '<p class="'.$slide_sub_text_3_style.'" 	
							 data-position="210,30" 
							 data-in="'.$slide_sub_text_3_transition_in.'" 
							 data-out="'.$slide_sub_text_3_transition_out.'" 
							 data-step="4">'.$slide_sub_text_3.'</p>';				
				endif;			
				
				echo '</div> ';
				echo $after_widget;
			}
        }
}

?>