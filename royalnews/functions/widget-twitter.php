<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'twitter1_load_widgets' );

/**
 * Register our widget.
 * 'twitter1_Widget' is the widget class used below.
 */
function twitter1_load_widgets() {
	register_widget( 'twitter1_Widget' );
}

/**
 * twitter1 Widget class.
 */
class twitter1_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function twitter1_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twitter1', 'description' => 'Last Twitter Updates.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'twitter1-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'twitter1-widget', 'RoyalNews: Twitter', $widget_ops, $control_ops );
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
		if ($title) echo $before_title . $title . $after_title;

		echo '
			<!-- // twitter start // -->
			<!--div class="left-c-lbl">Twitter widget</div-->
			<div class="block_twitter">
				<div id="twitter-feed" class="tweets"></div>
			</div>
			<!-- \\ twitter end \\ -->
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
		$defaults = array( 'title' => '', 'description' => 'Last twitter1 Updates' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>