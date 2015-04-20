<?php
/*
Template Name: Home 6
*/
get_header();
global $paged;
global $wlm_shortname;
?>

          <header class="page-heading">
            <div class="label-a"><?php the_title(); ?></div>
            <div class="breadcrumbs">
              <a href="<?php echo home_url(); ?>"><?php _e('Home','royalnews'); ?></a> <?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
            </div>
            <div class="clear"></div>
          </header>
          
	<?php
		//show news posts
		wp_reset_postdata();
		$get_custom_options = get_option($wlm_shortname.'_blog_page_id'); 
		$cat_id_inclusion = (isset($get_custom_options['blog_to_cat_'.get_the_ID()])) ? trim($get_custom_options['blog_to_cat_'.get_the_ID()]) : '';
		
		$col1_count = $col2_count = $col3_count = (int)(get_option($wlm_shortname."_home6_newscount") / 3);
		//echo $col1_count .'='. $col2_count .'='. $col3_count;
		$posts_per_page = $col1_count+$col2_count+$col3_count;
		
		$type = 'post';
		$args = array (
			'post_type' => $type,
			'post_status' => 'publish',
			'cat' => $cat_id_inclusion,
			'post__not_in' => get_option('sticky_posts'),
			'posts_per_page' => $posts_per_page,
			'orderby' => 'menu_order date',
			'order' => 'DESC',
			'paged' => $paged
		);

		$temp = $wp_query;  // assign original query to temp variable for later use   
		$wp_query = null;
		$wp_query = new WP_Query($args); 
		
		$i = 0;
		$items_output = '';
		
		if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
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
								<iframe src="'.$post_video_url.'" width="266" height="150" allowfullscreen></iframe>
							</div>
						';					  
					}
				} else {
					$image_preview_output = ($image_preview_url) ? '<a href="'.get_permalink().'" class="article-image"><img src="'.mr_image_resize($image_preview_url,110,108,'br','','').'" alt="'.get_the_title().'" /></a>' : '';
					$format_news_class =' small-scale-post';
				}
			}

			$i++;		
			if ( ($i == 1) || ($i == ($col1_count+1)) || ($i == ($col1_count+$col2_count+1)) ) {
		?>
			<!-- // articles row start // -->
			<div class="articles-row<?php if ($i == ($col1_count+$col2_count+1) ) echo ' nth-row'; ?>">
			<?php } ?>
				
				<?php
					$custom = get_post_custom($post->ID);
					
					$post_excerpt_output = '';
					if (get_option($wlm_shortname."_home6_post_excerpt") == 'true') {
						$custom_page_description = (isset($custom[$wlm_shortname."_small_news_description"][0])) ? $custom[$wlm_shortname."_small_news_description"][0] : '';
						$post_excerpt_output = ($custom_page_description) ? '<div class="article-text">'.$custom_page_description.'</div>' : '';
					}
				?>
				<!-- // -->
				<div class="articles-post<?php echo $format_news_class; ?> video-post">
					<div class="article-category">
						<?php the_category(' / '); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
						<a href="#" class="post-info post-comments"><?php echo $post->comment_count; ?></a>
						<?php echo getPostLikeLink(get_the_ID(),'post-info');?>
					</div>
					<?php echo $image_preview_output; ?>
					<div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php echo $post_excerpt_output; ?>
				</div>
				<!-- // -->
			
			<?php if ( ($i == ($col1_count)) || ($i == ($col1_count+$col2_count)) || ($i == ($col1_count+$col2_count+$col3_count)) ) { ?>
				<div class="load-content"></div>
			</div>
			<?php } ?>

			<?php
				endwhile; endif;
			?>
			
			<?php if (
						($i < ($col1_count)) ||
						( ($i > ($col1_count)) && ($i < ($col1_count+$col2_count)) ) ||
						( ($i > ($col1_count+$col2_count)) && ($i < ($col1_count+$col2_count+$col3_count)) )
					) {
			?>
			</div>
			<?php } ?>

			
			

			<?php
				if (get_option($wlm_shortname."_home6_pagination") == 'AJAX') {
					//show news posts
					wp_reset_postdata();
					$get_custom_options = get_option($wlm_shortname.'_blog_page_id'); 
					$cat_id_inclusion = trim($get_custom_options['blog_to_cat_'.get_the_ID()]);
					$col1_count = get_option($wlm_shortname."_home6_col1_newscount");
					$col2_count = get_option($wlm_shortname."_home6_col2_newscount");
					$col3_count = get_option($wlm_shortname."_home6_col3_newscount");
					$posts_per_page = $col1_count+$col2_count+$col3_count;
					
					$type = 'post';
					$args = array(
						'post_type' => $type,
						'post_status' => 'publish',
						'cat' => $cat_id_inclusion,
						'post__not_in'=>get_option('sticky_posts'),
						'posts_per_page' => 1,
						'orderby' => 'menu_order date',
						'order' => 'DESC'
					);
					$wp_query = new WP_Query($args);
					$max_pages = $wp_query->max_num_pages;
					
					// queue the JavaScript file
					wp_enqueue_script(
						'ajax_load_posts',
						get_template_directory_uri().'/js/getposts.js',
						array('jquery'),
						'1.0',
						true
					);
					// add parameters for the JavaScript
					wp_localize_script(
						'ajax_load_posts',
						'ajax_load_parameters',
						array(
							'startPage' => $posts_per_page,
							'maxPages' => $max_pages,
							'categoryID' => $cat_id_inclusion,
							'postID' => get_the_ID()
						)
					);
					$wp_query = null;
					$wp_query = $temp;
			?>

		<!-- \\ articles row end \\ -->
		<div class="clear"></div>

		<a href="#" class="more-posts" id="more-posts">
			<span class="more-posts-i"></span>
			<span class="more-posts-t"><?php _e('View more materials','royalnews'); ?></span>
        </a>
		<?php
			} else if (get_option($wlm_shortname."_home6_pagination") == 'Page Numbers') {
				echo '<div class="clear"></div>';
				//get pagination
				$blog_as_homepage_pagination = get_option($wlm_shortname.'_blog_as_homepage_pagination');
				if ($blog_as_homepage_pagination) {
					if(function_exists('wp_pagenavi_homepage')) { 
						wp_pagenavi_homepage(get_page_by_title($blog_as_homepage_pagination));
					}
				} else {
					if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
				}
				wp_reset_postdata();
								
				$wp_query = null;
				$wp_query = $temp;
			} else {
		?>
					<div class="post-controls2">
						<div class="clear"></div>
						<?php 
							previous_posts_link(__('<< Previous Page','royalnews'));
					
							next_posts_link(__('Next Page >>','royalnews'));
						?>
						<div class="clear"></div>
					</div>
		<?php
			}
		?>
		<div class="clear"></div>
    </div>

	
	
	
	
	
		

	<?php if (get_option($wlm_shortname."_home6_popular") == 'true') { ?>
    <!-- // maeterials slider start // -->
	<section class="main-content-b">
	  <div class="materials-slider">
		<div class="materials-devider"></div>
		<div class="materials-slider-lbl"><?php echo get_option($wlm_shortname."_home6_popular_title"); ?></div>
		<div id="popular-slider">
		  <?php
			$type = 'post';
			$args = array(
				'post_type' => $type,
				'post_status' => 'publish',
				'post__not_in'=>get_option('sticky_posts'),
				'posts_per_page' => get_option($wlm_shortname.'_home6_popular_count'),
				'sort_column' => 'comment_count',
				'order' => 'desc'
			);

			$temp = $wp_query;  // assign original query to temp variable for later use   
			$wp_query = null;
			$wp_query = new WP_Query($args); 
			
			$i = 0;
			$items_output = '';
			
			if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
				// get full image from featured image if was not see full image url in News
				$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
				
				$image_preview_url = '';
				if ($get_custom_options[0]) {  
					$image_preview_url = '<a href="'.get_permalink().'" class="article-image"><img src="'.mr_image_resize($get_custom_options[0],684,442,'br','','').'" alt="'.get_the_title().'" /></a>';
				}
		  ?>
		  <!-- // -->
		  <div class="materials-item">
			<div class="materials-item-a">
			  <div class="articles-post">
				<div class="article-category">
				  <?php the_category(', '); ?> - <a href="<?php echo get_day_link(get_the_time('Y',$post->ID), get_the_time('m',$post->ID),get_the_time('d',$post->ID)); ?>"><?php echo get_the_time('d.m.Y', $post->ID); ?></a>
				  <a href="<?php the_permalink(); ?>" class="post-info post-comments"><?php echo $post->comment_count; ?></a>
				  <?php echo getPostLikeLink(get_the_ID(),'post-info');?>
				</div>
				<?php echo $image_preview_url; ?>
				<div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			  </div>
			</div>
		  </div>
		  <!-- \\ -->
		  <?php endwhile; endif; ?>
		</div>
	  </div>
    </section>
    <!-- \\ maeterials slider end \\ -->
	<?php } ?>
	
	
	
	
	
<?php get_footer(); ?>