<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'news_block_load_widgets' );

/**
 * Register our widget.
 * 'news_block_Widget' is the widget class used below.
 */
function news_block_load_widgets() {
	register_widget( 'news_block_Widget' );
}

/**
 * news_block Widget class.
 */
class news_block_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function news_block_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'news_block', 'description' => 'News Block.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'news_block-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'news_block-widget', 'RoyalNews: News Block', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$id_array = $instance['id_array'];
		
		/* Before widget (defined by themes). */			
		echo $before_widget;
		
		//here will be displayed widget content for Footer 1st column 
?>					

	<!-- // news block start // -->
	<div class="mp-block">
		<?php
			/* Display the widget title if one was input (before and after defined by themes). */
			if ($title) echo '<div class="mp-block-lbl">'.$title.'</div> ';
		?>
		<div class="mp-block-content">	  
			<?php
				$items_chunks = explode(",", $id_array);
				$news_output = '';
				for ($m=0; $m<count($items_chunks); $m++) {
					$news_output .= '
						<div class="mp-block-i">
						  <span><a href="'.get_day_link(get_the_time('Y',trim($items_chunks[$m])), get_the_time('m',trim($items_chunks[$m])),get_the_time('d',trim($items_chunks[$m]))).'">'.get_the_time('d M', trim($items_chunks[$m])).'</a></span> <a href="'.get_permalink(trim($items_chunks[$m])).'">'.get_the_title(trim($items_chunks[$m])).'</a>
						</div>
					';
				}
				echo $news_output;
			?>
		</div>
	</div>
	<!-- \\ news block end \\ -->
		
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
		$instance['id_array'] = strip_tags( $new_instance['id_array'] );
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'description' => 'News Block' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'id_array' ); ?>"><?php echo 'ID Array (separated by comma)'; ?></label>
			<input id="<?php echo $this->get_field_id( 'id_array' ); ?>" name="<?php echo $this->get_field_name( 'id_array' ); ?>" value="<?php echo $instance['id_array']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>
