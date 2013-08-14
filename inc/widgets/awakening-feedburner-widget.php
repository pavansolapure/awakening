<?php
/**
 * Feedburner Widget
 *
 * File : awakening-feedburner-widget.php
 * 
 * @package Awakening
 * @since Awakening 1.0
 */
?>
<?php

class Feedburner_Widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'feedburner', 'description' => __('Enable Feedburner form on Your Website.', 'feedburner') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-feedburner' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-feedburner', __('Awakening Feedburner','awakening'), $widget_ops, $control_ops );					
        }

        public function form( $instance ) {
		
			$instance = wp_parse_args( (array) $instance, array( 'feedburner_unique_id' => '', 'feedburner_style' => '',  'feedburner_title_text' => '', 'feedburner_sub_text' => ''));
			
			if ( isset( $instance[ 'feedburner_unique_id' ] ) ) {
				$feedburner_unique_id = $instance[ 'feedburner_unique_id' ];
			}
			
			if ( isset( $instance[ 'feedburner_style' ] ) ) {
				$feedburner_style = $instance[ 'feedburner_style' ];
			}	
			
			if ( isset( $instance[ 'feedburner_title_text' ] ) ) {
				$feedburner_title_text = $instance[ 'feedburner_title_text' ];
			}	

			if ( isset( $instance[ 'feedburner_sub_text' ] ) ) {
				$feedburner_sub_text = $instance[ 'feedburner_sub_text' ];
			}				
			
			$styles = array("style_1"=> "Style 1", "style_2" => "Style 2");	
						
			?>			
		<p>  
			<label for="<?php echo $this->get_field_id( 'feedburner_unique_id' ); ?>"><?php _e('Feedburner Id:', 'awakening'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'feedburner_unique_id' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_unique_id' ); ?>" value="<?php echo $instance['feedburner_unique_id']; ?>" style="width:90%;" />  (e.g: opencodez)	
		</p>  	
		
		<p>  
			<label for="<?php echo $this->get_field_id( 'feedburner_title_text' ); ?>"><?php _e('Title Text:', 'awakening'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'feedburner_title_text' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_title_text' ); ?>" value="<?php echo $instance['feedburner_title_text']; ?>" style="width:90%;" />  (e.g: Subscribe Via Email)	
		</p> 		
		
		<p>  
			<label for="<?php echo $this->get_field_id( 'feedburner_sub_text' ); ?>"><?php _e('Sub Text:', 'awakening'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'feedburner_sub_text' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_sub_text' ); ?>" value="<?php echo $instance['feedburner_sub_text']; ?>" style="width:90%;" />  (e.g: Subscribe to our newsletter to get all the latest updates to your inbox..!)	
		</p> 			
		
		<p>
			<label for="<?php echo $this->get_field_id('feedburner_style'); ?>"><?php _e('Select Style:','awakening'); ?></label>
			<select id="<?php echo $this->get_field_id('feedburner_style'); ?>" name="<?php echo $this->get_field_name('feedburner_style'); ?>">			
		<?php
			foreach ( $styles as $style_id => $style_name ) {
				echo '<option value="' . $style_id . '"'
					. selected( $feedburner_style, $style_id, false )
					. '>'. $style_name . '</option>';
			}
		?>
			</select>
		</p>
		
			<?php
			   
        }

        public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['feedburner_unique_id'] = $new_instance['feedburner_unique_id'];
			$instance['feedburner_style'] = $new_instance['feedburner_style'];
			$instance['feedburner_title_text'] = $new_instance['feedburner_title_text'];
			$instance['feedburner_sub_text'] = $new_instance['feedburner_sub_text'];

			return $instance;
        }

        public function widget( $args, $instance ) {
			extract( $args );			
			$feedburner_unique_id = $instance['feedburner_unique_id'];		
			$feedburner_style = $instance['feedburner_style'];
			$feedburner_title_text = $instance['feedburner_title_text'];	
			$feedburner_sub_text = $instance['feedburner_sub_text'];		
			?>
			
			<div class="feedburner <?php echo "feedburner_".$feedburner_style; ?>">	
			<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_unique_id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">    
			<div class="row">
				<div class="large-12 columns ">				  
				  <div class="row">		
					<div class="large-12 columns">
						<h6><?php echo $feedburner_title_text; ?></h6>
						<p class="stext"><?php echo $feedburner_sub_text; ?></p>
					 </div>
				  </div>
				 
				  <div class="row">
					<div class="large-12 columns">
					  <input type="text" name="email"  class="email" placeholder="Enter your email address"/>
					  <input type="hidden" value="<?php echo $feedburner_unique_id; ?>" name="uri"/>
					  <input type="hidden" name="loc" value="en_US"/>
					</div>
				  </div>	
				  <div class="row">
					<div class="large-12 columns">
						<div class="large-1 columns">&nbsp;</div>
						<div class="large-10 columns">
						<input type="submit" class="emailButton" name="submit" value="Signup Now!" />
						</div>
						<div class="large-1 columns">&nbsp;</div>
					</div>	
				  </div>
				</div>
				</div>  
			</form>		
			</div>	
			<?php   		   			   
        }

}

function feedburner_register_widgets() {
	register_widget( 'Feedburner_Widget' );
}

add_action( 'widgets_init', 'feedburner_register_widgets' );
?>