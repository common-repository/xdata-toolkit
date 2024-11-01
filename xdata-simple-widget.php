<?php
/**
 * Plugin Name: XData Simple Widget
 * Plugin URI: http://www.buildautomate.com/en/xdatatoolkit/widgets/xdata-simple-widget
 * Description: The XData Simple Widget is for displaying an XData Query Interface.  Requires the XData Toolkit v1.6.1 Minimum.
 * Version: 1.9
 * Author: build.Automate, Inc.
 * Author URI: http://www.buildautomate.com/en
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

include_once dirname( __FILE__ ) . '/models/QueryInterfaces.php';
add_action( 'widgets_init', 'xdata_toolkit_widgets' );


function xdata_toolkit_widgets() {
	register_widget( 'XData_Simple_Widget' );
}

class XData_Simple_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function XData_Simple_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays an XData Query Interface.', 'xdatasimplewidget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'xdata-simple-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'xdata-simple-widget', __('XData Simple Widget', 'xdatasimplewidget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$queryInterface = $instance['queryInterface'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		if($queryInterface)
			echo '<p>';
			echo (do_shortcode('[xdataqueryinterface queryint="'.$queryInterface.'" type="page" linked_item="no"]'));			
			echo '</p>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['queryInterface'] = strip_tags($new_instance['queryInterface']);

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Example', 'xdatasimplewidget'), 'name' => __('John Doe', 'xdatasimplewidget'), 'sex' => 'male', 'show_sex' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
				
		
		<label for="<?php echo $this->get_field_id( 'queryInterface' ); ?>"><?php _e('Query Interface:', 'xdatasimplewidget'); ?></label> 
	<?php
		$content = '<select name="'.$this->get_field_name( 'queryInterface' ).'" id="'.$this->get_field_id( 'queryInterface' ).'" class="widefat" style="width:100%;">';
		
		$QueryInterfaces = new QueryInterfaces();		
		$queryInterfaces = $QueryInterfaces->getQueryInterfaces();
		
		foreach($queryInterfaces as $queryInterface)
		{
				$content .= '<option value="'.$queryInterface->qi_global_var.'" ';
				if($instance['queryInterface'] == $queryInterface->qi_global_var)
				{
					$content .= " selected";
				}
				$content .= '>';
				$content .= $queryInterface->qi_global_var;
				$content .= '</option>';
		}
		$content .= '</select>';
		echo $content;
	
	}
}

?>