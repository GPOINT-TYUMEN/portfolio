<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'titlez_links_load_widgets' );

/**
 * Register our widget.
 * 'titlez_links_Widget' is the widget class used below.
 */
function titlez_links_load_widgets() {
	register_widget( 'titlez_links_Widget' );
}

/**
 * titlez_links Widget class.
 */
class titlez_links_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function titlez_links_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'titlez_links', 'description' => 'RoyalNews Title.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'titlez-links-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'titlez-links-widget', 'RoyalNews: Title', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		
		/* Before widget (defined by themes). */			
		echo $before_widget;
		
		/* Display the widget title if one was input (before and after defined by themes). */
		//if ($title) echo $before_title . $title . $after_title;
		
		echo '
			<!-- // title start // -->
			<div class="side-block">
			  <div class="side-block-lbl">'.$title.'</div>
			</div>
			<!-- \\ title end \\ -->
		';
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'description' => 'RoyalNews Title' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>		

	<?php
	}
}
?>