<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'recent_posts_load_widgets' );

/**
 * Register our widget.
 * 'Last_Comments_Widget' is the widget class used below.
 */
function recent_posts_load_widgets() {
	register_widget( 'recent_Posts_Widget' );
}

/**
 * recent_Posts Widget class.
 */
class recent_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function recent_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => '', 'description' => 'Latest Blog Posts' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'latest-blog-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'latest-blog-posts-widget', 'RoyalNews: Recent Posts', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];
		$cat = $instance['cat'];
		$show_thumbnail = isset($instance['show_thumbnail']) ? 'true' : 'false';
		

		/* Before widget (defined by themes). */			
		echo $before_widget;		

		
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) echo $before_title . $title . $after_title;		

		echo '<div class="featured-row">';
		
		global $wpdb;
		global $wlm_shortname;
		
		$sql = 'select DISTINCT ID, post_title from '.$wpdb->posts.'
			WHERE '.$wpdb->posts.'.post_status="publish" 
			AND '.$wpdb->posts.'.post_type="post" 
			ORDER BY '.$wpdb->posts.'.post_date DESC
			LIMIT 0,'.$count;

		$recent_posts = $wpdb->get_results($sql);
		
		//$recent_posts = new WP_Query('showposts='.($count-1).'&orderby=post_date&order=DESC');
		//if($recent_posts->have_posts()):while($recent_posts->have_posts()): $recent_posts->the_post();
		foreach ($recent_posts as $post) {
	?>
			<!-- // -->
			<div class="featured-i footer-posts">
				<?php
					if(has_post_thumbnail($post->ID) && $show_thumbnail == 'true') {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false);
						$image = mr_image_resize($image[0],58, 45, 'br', '', '');
				?>
				<div class="featured-l">
					<a href="<?php echo get_permalink($post->ID) ?>"><img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>" /></a>
				</div>
				<?php } ?>
				<div class="featured-r">
					<a href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title; ?></a>
					<span class="featured-date"><?php echo get_the_time('m.d.Y', $post->ID); ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<!-- \\ -->
	<?php 
		}
			/*endwhile;
		endif;*/

		echo '</div>';
			
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
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'count' => '3', 'show_thumbnail' => 'on', 'description' => 'Recent Blog Posts' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php echo 'Count:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php echo 'Category ID (optional):'; ?></label>
			<input id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo $instance['cat']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_thumbnail'], 'on'); ?> id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>">Show thumbnail</label>
		</p>
		
	<?php
	}
}

?>