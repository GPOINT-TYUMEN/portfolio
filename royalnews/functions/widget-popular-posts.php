<?php
add_action('widgets_init', 'bb_popular_posts_widgets');

function bb_popular_posts_widgets()
{
	register_widget('bb_Popular_Posts_Widget');
}

class bb_Popular_Posts_Widget extends WP_Widget {
	
	function bb_Popular_Posts_Widget()
	{
		$widget_ops = array('classname' => 'block_sidebar_popular_posts', 'description' => 'Popular posts.');

		$control_ops = array('id_base' => 'bb_popular_posts-widget');

		$this->WP_Widget('bb_popular_posts-widget', 'RoyalNews: Popular posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $wlm_shortname, $post;
		
		extract($args);
		
        $title = apply_filters('widget_title', $instance['title']);
		$postscount = $instance['postscount'];
		$show_thumbnail = isset($instance['show_thumbnail']) ? 'true' : 'false';
		
		echo $before_widget;
                
		if($title) {
			echo $before_title.$title.$after_title;
		}

		/*$args_query = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $postscount,
			'orderby' => 'comment_count',
			'order' => 'DESC'
		);
		
		$i = 0;
		$wp_query_new = new WP_Query($args_query);
		if($wp_query_new->have_posts()): 
			while($wp_query_new->have_posts()): $wp_query_new->the_post();*/

		global $wpdb;
		global $wlm_shortname;
			
		$sql = 'select DISTINCT ID, post_title from '.$wpdb->posts.'
			WHERE '.$wpdb->posts.'.post_status="publish" 
			AND '.$wpdb->posts.'.post_type="post" 
			ORDER BY '.$wpdb->posts.'.comment_count DESC
			LIMIT 0,'.$postscount;

		$popular_posts = $wpdb->get_results($sql);
		foreach ($popular_posts as $post) {
			//if ($i <= $postscount) {
	?>
			<!-- // -->
			<div class="recent-item">
				<?php
					if(has_post_thumbnail($post->ID) && $show_thumbnail == 'true') {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID($post->ID) ), '', false);
						$image = mr_image_resize($image[0],559, 361, 'br', '', '');
				?>
				<a href="<?php echo get_permalink($post->ID); ?>" class="recent-img"><img src="<?php echo $image; ?>" alt="<?php echo get_the_title($post->ID); ?>" /></a>
				<?php } ?>
				
				<div class="recent-category"><?php the_category(', ',$post->ID); ?> - <?php echo get_the_time('m.d.Y',$post->ID); ?></div>
				<div class="recent-title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></div>
			</div>
			<!-- \\ -->
	<?php 
				//}
		}
		/*
			endwhile;
		endif;*/

		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['postscount'] = $new_instance['postscount'];
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
                    'title' => 'Popular Posts',
                    'postscount' => 3, 
                    'show_thumbnail' => 'on');
                
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
                <p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
                <p>
			<label for="<?php echo $this->get_field_id('postscount'); ?>">Number of popular posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('postscount'); ?>" name="<?php echo $this->get_field_name('postscount'); ?>" value="<?php echo $instance['postscount']; ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_thumbnail'], 'on'); ?> id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>">Show thumbnail</label>
		</p>
	<?php }
}
?>