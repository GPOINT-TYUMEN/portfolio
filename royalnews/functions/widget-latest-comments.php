<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'comments_posts_load_widgets' );

/**
 * Register our widget.
 * 'Last_Comments_Widget' is the widget class used below.
 */
function comments_posts_load_widgets() {
	register_widget( 'comments_Posts_Widget' );
}

/**
 * comments_Posts Widget class.
 */
class comments_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function comments_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'comments Posts', 'description' => 'The most recent comments' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'comments-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'comments-posts-widget', 'RoyalNews: Latest Comments', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		$excerptlength = $instance['excerptlength'];

		/* Before widget (defined by themes). */			
		echo $before_widget;		
		
		/* Display the widget title if one was input (before and after defined by themes). */
		//if ( $title ) echo $before_title . $title . $after_title;
		
		global $wpdb;
		global $wlm_shortname;

		$sql = "SELECT $wpdb->comments.*, $wpdb->posts.post_title FROM $wpdb->comments JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_status = 'publish' ORDER BY comment_date_gmt DESC LIMIT ".$number;
			
		$comments = $wpdb->get_results($sql);
		$output = '';
		$output .= '
			<!-- // latest comments start // -->
			<div class="side-block">
			  <div class="side-block-lbl">'.$title.'</div>
			  <div class="latest-comments-row">
		';

		if ($excerptlength>0) $excerptLen = $excerptlength;
		
		$i = 0;
		if ( $comments ) : foreach ( (array) $comments as $comment) :			
			$title = $comment->post_title;
			
			$aRecentComment = get_comment($comment->comment_ID);
			$contnet = $aRecentComment->comment_content;
			
			if ($excerptlength>0){ 
				$contnet = trim( substr( $aRecentComment->comment_content, 0, $excerptLen ));
			
				if(strlen($aRecentComment->comment_content)>$excerptLen){
					$contnet .= "...";
				}
			}
			
			$i++;
			$output .=  '
				<!-- // -->
				<div class="latest-comments-i">
				  <div class="latest-comments-l">'.$i.'</div>
				  <div class="latest-comments-r">
					<div class="latest-comments-user">Stiven Fox</div>
					<a href="'.get_comment_link($comment->comment_ID).'" class="latest-comments-lbl">'.$title.'</a>
				  </div>
				  <div class="clear"></div>
				  <div class="latest-comments-txt">
					<span class="latest-comments-arrow"></span>
					'.$contnet .'
				  </div>
				</div>
				<!-- \\ -->
			';
			
			endforeach; 
		endif;		
		
		$output .= '
				</div>
			</div>
		';

		echo $output;

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and comments count to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['excerptlength'] = strip_tags( $new_instance['excerptlength'] );
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Latest Comments', 'number' => '3', 'excerptlength' => '50', 'description' => 'The most recent comments' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo 'Count:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'excerptlength' ); ?>"><?php echo 'Excerpt length:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'excerptlength' ); ?>" name="<?php echo $this->get_field_name( 'excerptlength' ); ?>" value="<?php echo $instance['excerptlength']; ?>" style="width:100%;" />
		</p>		
	

	<?php
	}
}

?>