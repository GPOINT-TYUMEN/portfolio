<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'sidebar_promo_load_widgets' );

/**
 * Register our widget.
 * 'sidebar_promo_Widget' is the widget class used below.
 */
function sidebar_promo_load_widgets() {
	register_widget( 'sidebar_promo_Widget' );
}

/**
 * sidebar_promo Widget class.
 */
class sidebar_promo_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function sidebar_promo_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'sidebar_promo', 'description' => 'Sidebar Promo.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'sidebar_promo-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'sidebar_promo-widget', 'RoyalNews: Sidebar Promo', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$url = $instance['url'];
		$image_url = $instance['image_url'];

		/* Before widget (defined by themes). */			
		echo $before_widget;

		//here will be displayed widget content for Footer 1st column 
?>					

	<a href="<?php echo $url; ?>" class="sidebar-promo">
	  <img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" style="height:auto;"/>
	</a>

<?php
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
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['image_url'] = strip_tags( $new_instance['image_url'] );
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'url' => '', 'image_url' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>


		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php echo 'URL'; ?></label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php echo 'Image URL (recommended size for Retina Display: 532x422px or 266x211px for default display).'; ?></label>
			<input id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $instance['image_url']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}
?>