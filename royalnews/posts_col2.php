<?php
	$wp_load_include = "../wp-load.php";
	$i = 0;
	while (!file_exists($wp_load_include) && $i++ < 9) {
		$wp_load_include = "../$wp_load_include";
	}
	//required to include wordpress file
	require($wp_load_include);

	global $wlm_shortname;
	
	$posts_count = get_option($wlm_shortname."_blog_posts_count");
	if ($posts_count == 'All') $posts_count = '-1';	
	
	$col1_count = get_option($wlm_shortname."_home1_col1_newscount");
	$col2_count = get_option($wlm_shortname."_home1_col2_newscount");
	$col3_count = (get_option($wlm_shortname."_home1_col3_newscount") > 0) ? get_option($wlm_shortname."_home1_col3_newscount") : 1;

	$categoryid = (isset($_GET['categoryid'])) ? $_GET['categoryid'] : '';
	$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : '';

	$type = 'post';
	$args = array(
		'post_type' => $type,
		'post_status' => 'publish',
		'post__not_in'=>get_option('sticky_posts'),
		'posts_per_page' => 1,
		'cat' => $categoryid,
		'orderby' => 'menu_order date',
		'order' => 'DESC',
		'paged' => ($pagenum+2)
	);
	
	$blog_output = '';
		
	$temp = $wp_query;
	$wp_query = null;	
	
	$wp_query = new WP_Query($args);
	if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();

	/*
		$postID = get_the_ID();
		$post_excerpt_output = (get_option($wlm_shortname."_home1_post_excerpt") == 'true') ? '<div class="article-text">'.get_post_meta($post->ID, $wlm_shortname.'_custom_page_heading',true).'</div>' : '';
		
		$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
		$image_preview_url = $get_custom_options[0];
		$image_preview_output = ($image_preview_url) ? '<a href="'.get_permalink().'" class="article-image"><img src="'.mr_image_resize($image_preview_url,684,442,'br','','').'" alt="'.get_the_title().'" /></a>' : '';
?>
	<div class="articles-post">
		<div class="article-category">
			<?php the_category(' / '); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
			<a href="#" class="post-info post-comments"><?php echo $post->comment_count; ?></a>
			<?php echo getPostLikeLink(get_the_ID(),'post-info');?>
		</div>
		<?php echo $image_preview_output; ?>
		<div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		<?php echo $post_excerpt_output; ?>
	</div>
	<!-- \\ -->
	
<?php

			*/
	
	

	
	
	
			// get full image from featured image if was not see full image url in News
			$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
			$image_preview_url = $get_custom_options[0];

			//get meta data from meta box format_news
			$image_preview_output = '';
			$format_news_class = '';
			$format_news = get_post_meta($post->ID, '_format_news', TRUE);
			
			//check if it is used Standard or Small thumb
			if ($format_news == 'standard_thumb' || $format_news == 'mini_thumb') {
				
				if ( ($format_news == 'standard_thumb') || ($format_news == '') ) {
					$image_preview_output = ($image_preview_url) ? '<a href="'.get_permalink().'" class="article-image"><img src="'.mr_image_resize($image_preview_url,684,442,'br','','').'" alt="'.get_the_title().'" /></a>' : '';
					
					//check if it is selected standard thumb, but it is Slider, Gallery or Video template format then do
					$template_format = get_post_meta($post->ID, '_template_format', TRUE);
					if ( ($template_format == 'slider_post') || ($template_format == 'gallery_post') ) {
						$image_preview_output = '
							<div class="modify-slider article-slider">
							  <div class="flexslider">
								<ul class="slides">
						';
						
						//get all images from the post metaboxes
						$slider_images = miu_get_images($post->ID);
						for ($m=0; $m<=count($slider_images)-1; $m++) {
							$image_preview_output .= '
								<li>
								  <span><img src="'.mr_image_resize($slider_images[$m],684,442,'br','','').'" alt="'.get_the_title().'" /></span>
								</li>
							';
						}

						$image_preview_output .= '
								</ul>
							  </div>
							</div>
						';
					} else if ($template_format == 'video_post') {
						$custom = get_post_custom($post->ID);
						$post_video_url = (isset($custom[$wlm_shortname."_post_video_url"][0])) ? $custom[$wlm_shortname."_post_video_url"][0] : '';
						$image_preview_output = '
							<div class="video-embeded listing">
								<iframe src="'.$post_video_url.'" width="266" height="150" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							</div>
						';					  
					}
				} else {
					$image_preview_output = ($image_preview_url) ? '<a href="'.get_permalink().'" class="article-image"><img src="'.mr_image_resize($image_preview_url,110,108,'br','','').'" alt="'.get_the_title().'" /></a>' : '';
					$format_news_class =' small-scale-post';
				}
			}
		?>
			<!-- // articles row start // -->
			<div class="articles-row">				
				<?php
					$custom = get_post_custom($post->ID);
					
					$post_excerpt_output = '';
					if (get_option($wlm_shortname."_home1_post_excerpt") == 'true') {
						$custom_page_description = (isset($custom[$wlm_shortname."_small_news_description"][0])) ? $custom[$wlm_shortname."_small_news_description"][0] : '';
						$post_excerpt_output = ($custom_page_description) ? '<div class="article-text">'.$custom_page_description.'</div>' : '';
					}
				?>
				<!-- // -->
				<div class="articles-post<?php echo $format_news_class; ?>">
					<?php if ($format_news == 'mini_thumb') { ?>
						<?php echo $image_preview_output; ?>
					<?php } ?>
					<div class="article-category">
						<?php the_category(' / '); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
						<a href="<?php the_permalink(); ?>" class="post-info post-comments"><?php echo $post->comment_count; ?></a>
						<?php echo getPostLikeLink(get_the_ID(),'post-info');?>
					</div>
					<?php if ($format_news != 'mini_thumb') { ?>
						<?php echo $image_preview_output; ?>
					<?php } ?>
					<div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php echo $post_excerpt_output; ?>
				</div>
				<!-- // -->
				
			</div>
			
			
<?php
	endwhile; endif;
	$wp_query = null;
	$wp_query = $temp;
?>