<?php
/**
 * Google Custom Search Widget
 *
 * File : google-cse-form.php
 * 
 * @package Awakening
 * @since Awakening 1.0
 */
?>
<?php

class GoogleCSE_Widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'google custom search', 'description' => __('Enable Google Custom Search on Your Website.', 'google custom search') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-google-cse' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-google-cse', __('Awakening Google Custom Search', 'awakening'), $widget_ops, $control_ops );		
			
			/* Add options to database */	
			add_option($google_cse_unique_id);
			add_option($search_results_page_url);			
			
        }

        public function form( $instance ) {
			if ( isset( $instance[ 'google_cse_unique_id' ] ) ) {
				$google_cse_unique_id = $instance[ 'google_cse_unique_id' ];
			}
			
			if ( isset( $instance[ 'search_results_page_url' ] ) ) {
				$search_results_page_url = $instance[ 'search_results_page_url' ];
			}				
			?>			
		<p>  
			<label for="<?php echo $this->get_field_id( 'google_cse_unique_id' ); ?>"><?php _e('Search Engine Id:', 'awakening'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'google_cse_unique_id' ); ?>" name="<?php echo $this->get_field_name( 'google_cse_unique_id' ); ?>" value="<?php echo $instance['google_cse_unique_id']; ?>" style="width:90%;" />  (e.g: 095382442174838362754:hisuukncdfg )	
		</p>  			
		<p>  
			<label for="<?php echo $this->get_field_id( 'search_results_page_url' ); ?>"><?php _e('Results Page URI:', 'awakening'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'google_cse_unique_id' ); ?>" name="<?php echo $this->get_field_name( 'search_results_page_url' ); ?>" value="<?php echo $instance['search_results_page_url']; ?>" style="width:90%;" />  (e.g: http://mysite.com/page-cse)	
		</p> 			
			<?php
			   
        }

        public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['google_cse_unique_id'] = $new_instance['google_cse_unique_id'];
			$instance['search_results_page_url'] = $new_instance['search_results_page_url'];

			return $instance;
        }

        public function widget( $args, $instance ) {
			extract( $args );			
			$google_cse_unique_id = $instance['google_cse_unique_id'];
			$search_results_page_url = $instance['search_results_page_url'];			   
			?>
			<form method="get" id="cse-search-box" action="<?php echo $search_results_page_url; ?>">
				<div class="row">
				<input type="hidden" name="cx" value="<?php echo $google_cse_unique_id; ?>" />
				<input type="hidden" name="cof" value="FORID:11" />
				<input type="hidden" name="ie" value="UTF-8" />
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="large-8 mobile-three columns">
								<input type="text" name="q" id="q"  autocomplete="off" />
							</div>
							<div class="large-4 mobile-one columns">
								<input type="submit" class="button prefix" name="sa" id="searchsubmit" value="Search" />
							</div>
						</div>
					</div>
				</div>
			</form>
			<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>			   
			<?php   		   			   
        }

}

function gcse_register_widgets() {
	register_widget( 'GoogleCSE_Widget' );
}

add_action( 'widgets_init', 'gcse_register_widgets' );
?>