<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Text widget class
 *
 * @since 2.8.0
 */
class Theme_Custom_Header_Widgets extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widgets_custom_header', 'description' => __('Add a custom widget, you can integrate a HTML code directly. Example: your banner or google adsense.', 'inpress_admin'));
		$control_ops = array('width' => 200, 'height' => 150);
		parent::__construct('widcustom', '[ '.THEME_NAME.' ] '.__('Custom HTML Widget', 'inpress_admin'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		
                extract($args);		
                $code = apply_filters( 'widget_code', empty( $instance['customcode'] ) ? '' : $instance['customcode'], $instance );
		echo $before_widget;
		?>
			<div class="widcustomheader"><?php echo !empty( $instance['filter'] ) ? wpautop( $code ) : $code; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		if ( current_user_can('unfiltered_html') )
			$instance['customcode'] =  $new_instance['customcode'];
		else
			$instance['customcode'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['widcustomheader']) ) ); // wp_filter_post_kses() expects slashed
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'customcode' => '' ) );
		$code = esc_textarea($instance['customcode']);
?>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('customcode'); ?>" name="<?php echo $this->get_field_name('customcode'); ?>"><?php echo $code; ?></textarea>

<?php
	}
}

?>
