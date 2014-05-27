<?php
/**
 * Social Icon Box Widget
 *
 * File : awakening-social-box-widget.php
 * 
 * @package Awakening
 * @since Awakening 1.0.0
 */
?>
<?php

class awakening_socialiconbox_widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'social-icon-box', 'description' => __('Enable Social Icon Box for your site.', 'awakening') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-social-icon-box' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-social-icon-box', __('(Awakening) Socal Icon Box', 'awakening'), $widget_ops, $control_ops );				
        }
		
		/* Get Default values of fields. */
		function widget_defaults() {
			return array(
					'title' => '', 
					'show_facebook_icon' => '',
					'facebook_profile'=>'',						
					'show_twitter_icon' => '', 
					'twitter_profile' => '', 					
					'show_googleplus_icon' => '', 
					'googleplus_profile' => '', 							
					'show_linkedin_icon' => '', 
					'linkedin_profile' => '', 									
					'show_pinterest_icon' => '', 
					'pinterest_profile' => '',							
					'show_rss_icon' => '', 
					'rss_profile' => '',					
					'icon_style' =>''
			);
		}		

        public function form( $instance ) {	
			$instance = wp_parse_args( (array) $instance, $this->widget_defaults());	
			
			awakening_widget_field( $this, array ( 'field' => 'title', 'label' => __( 'Title:', 'awakening' ) ), $instance['title'] );
			
			//facebook
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'show_facebook_icon', 'label' => __( 'Enable Facebook: ', 'awakening' ),'type' => 'checkbox', 'class'=>''), $instance['show_facebook_icon'] );
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'facebook_profile', 'type' => 'url' ) , $instance['facebook_profile'] );
			awakening_widget_field( $this, array ( 'field' => 'facebook_profile', 'type' => 'label', 'desc' => __( '(e.g: http://facebook.com/my-profile) ', 'awakening' ) ) , '' );
			
			//twitter
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'show_twitter_icon', 'label' => __( 'Enable Twitter: ', 'awakening' ),'type' => 'checkbox', 'class'=>''), $instance['show_twitter_icon'] );
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'twitter_profile', 'type' => 'url' ) , $instance['twitter_profile'] );
			awakening_widget_field( $this, array ( 'field' => 'twitter_profile', 'type' => 'label', 'desc' => __( '(e.g: http://twitter.com/my-profile) ', 'awakening' ) ) ,'' );
			
			//googleplus
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'show_googleplus_icon', 'label' => __( 'Enable GooglePlus: ', 'awakening' ),'type' => 'checkbox', 'class'=>''), $instance['show_googleplus_icon'] );
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'googleplus_profile', 'type' => 'url' ) , $instance['googleplus_profile'] );
			awakening_widget_field( $this, array ( 'field' => 'googleplus_profile', 'type' => 'label', 'desc' => __( '(e.g: http://googleplus.com/my-profile) ', 'awakening' ) ) , '' );		
			
			//linkedin
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'show_linkedin_icon', 'label' => __( 'Enable LinkedIn: ', 'awakening' ),'type' => 'checkbox', 'class'=>''), $instance['show_linkedin_icon'] );
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'linkedin_profile', 'type' => 'url' ) , $instance['linkedin_profile'] );
			awakening_widget_field( $this, array ( 'field' => 'linkedin_profile', 'type' => 'label', 'desc' => __( '(e.g: http://linkedin.com/my-profile) ', 'awakening' ) ) ,'' );		

			//pinterest
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'show_pinterest_icon', 'label' => __( 'Enable Pinterest: ', 'awakening' ),'type' => 'checkbox', 'class'=>''), $instance['show_pinterest_icon'] );
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'pinterest_profile', 'type' => 'url' ) , $instance['pinterest_profile'] );
			awakening_widget_field( $this, array ( 'field' => 'pinterest_profile', 'type' => 'label', 'desc' => __( '(e.g: http://pinterest.com/my-profile) ', 'awakening' ) ) , '' );		

			//rss
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'show_rss_icon', 'label' => __( 'Enable RSS: ', 'awakening' ),'type' => 'checkbox', 'class'=>''), $instance['show_rss_icon'] );
			awakening_widget_field( $this, array ( 'ptag' => false, 'field' => 'rss_profile', 'type' => 'url' ) , $instance['rss_profile'] );
			awakening_widget_field( $this, array ( 'field' => 'rss_profile', 'type' => 'label', 'desc' => __( '(e.g: http://rss.com/my-profile) ', 'awakening' ) ) , '');	
			
			awakening_widget_field( $this, array ( 'field' => 'icon_style', 'type' => 'select', 
												   'label' => __( 'Icon Size: ', 'awakening' ),
												   'options' => array (
														array(	'key' => 'default',
																'name' => __( 'Default', 'awakening' ) ),
														array(	'key' => 'lg',
																'name' => __( 'Large', 'awakening' ) ),
														array(	'key' => 'sm',
																'name' => __( 'Small', 'awakening' ) ),
														array(	'key' => 'xs',
																'name' => __( 'Extra Small', 'awakening' ) )), 'class' => '' ), $instance['icon_style'] );	
        }

        public function update( $new_instance, $old_instance ) {	
			$instance = $old_instance;			
			$new_instance = wp_parse_args( (array) $new_instance, 
										array( 
												'title' => '', 
												'show_facebook_icon' => '',
												'facebook_profile'=>'',		
												'show_twitter_icon' => '', 
												'twitter_profile' => '', 
												'show_googleplus_icon' => '', 
												'googleplus_profile' => '', 
												'show_linkedin_icon' => '', 
												'linkedin_profile' => '', 		
												'show_pinterest_icon' => '', 
												'pinterest_profile' => '',			
												'show_rss_icon' => '', 
												'rss_profile' => ''											
											  ));
											  
			$instance['title'] = strip_tags(stripslashes($new_instance['title']));
			$instance['show_facebook_icon'] = $new_instance['show_facebook_icon'] ? 1 : 0;
			$instance['facebook_profile'] = $new_instance['facebook_profile'];
			
			$instance['show_twitter_icon'] = $new_instance['show_twitter_icon'] ? 1 : 0;
			$instance['twitter_profile'] = $new_instance['twitter_profile'];			

			$instance['show_googleplus_icon'] = $new_instance['show_googleplus_icon'] ? 1 : 0;
			$instance['googleplus_profile'] = $new_instance['googleplus_profile'];		

			$instance['show_linkedin_icon'] = $new_instance['show_linkedin_icon'] ? 1 : 0;
			$instance['linkedin_profile'] = $new_instance['linkedin_profile'];		

			$instance['show_pinterest_icon'] = $new_instance['show_pinterest_icon'] ? 1 : 0;
			$instance['pinterest_profile'] = $new_instance['pinterest_profile'];	

			$instance['show_rss_icon'] = $new_instance['show_rss_icon'] ? 1 : 0;
			$instance['rss_profile'] = $new_instance['rss_profile'];	
			
			$instance['icon_style'] = $new_instance['icon_style'];	

			return $instance;
        }

        public function widget( $args, $instance ) {
		
			extract( $args, EXTR_SKIP );
			$instance = wp_parse_args($instance, $this->widget_defaults());
			extract( $instance, EXTR_SKIP );
			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);	

			$btnSize = ($icon_style == "default") ? "" : "btn-".$icon_style;	
			
			echo $before_widget;
			?>
			<div class="social-icon-box-inner">				
			<?php
			if ( $title )
			echo $before_title . $title . $after_title;	
			?>			
				<?php if($show_facebook_icon): ?>
				<a target="_blank" href="<?php echo $facebook_profile ?>" class="zocial icon facebook <?php echo $btnSize;?>"></a>			
				<?php endif; ?> 
				
				<?php if($show_twitter_icon): ?> 
				<a target="_blank" href="<?php echo $twitter_profile ?>" class="zocial icon twitter <?php echo $btnSize;?>"></a>
				<?php endif; ?>
				
				<?php if($show_googleplus_icon): ?> 
				<a target="_blank" href="<?php echo $googleplus_profile ?>" class="zocial icon googleplus <?php echo $btnSize;?>"></a> 
				<?php endif; ?>
				
				<?php if($show_linkedin_icon): ?> 
				<a target="_blank" href="<?php echo $linkedin_profile ?>" class="zocial icon linkedin <?php echo $btnSize;?>"></a> 
				<?php endif;?>
				
				<?php if($show_pinterest_icon): ?> 
				<a target="_blank" href="<?php echo $pinterest_profile ?>" class="zocial icon pinterest <?php echo $btnSize;?>"></a> 
				<?php endif;?>
				
				<?php if($show_rss_icon): ?> 
				<a target="_blank" href="<?php echo $rss_profile ?>" class="zocial icon rss <?php echo $btnSize;?>"></a> 
				<?php endif;?>	
				
			</div>
			<?php
			echo $after_widget;
        }
}
?>