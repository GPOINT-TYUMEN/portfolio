<?php
/*
Template Name: Home 1
*/
get_header();
global $paged;
?>

	<?php if (get_option($wlm_shortname."_home1_slider") == 'true') { ?>
    <!-- // main news start // -->
    <section class="main-news">
		<?php		
			$get_custom_options = get_option($wlm_shortname.'_blog_page_id');
			$cat_id_inclusion = (isset($get_custom_options['blog_to_cat_'.get_the_ID()])) ? trim($get_custom_options['blog_to_cat_'.get_the_ID()]) : '';

			//get category slug using cat ID
			function get_cat_slug($cat_id) {
				$cat_id = (int) $cat_id;
				$category = &get_category($cat_id);
				return $category->slug;
			}

			$posts_per_page = (count(get_option('sticky_posts') > 3)) ? count(get_option('sticky_posts')) : 3;

			
			$type = 'post';
			if ($cat_id_inclusion){
				$args = array(
					'post_type' => $type,
					'post_status' => 'publish',
					'category_name' => get_cat_slug($cat_id_inclusion),
					'post__in' => get_option('sticky_posts'),
					'posts_per_page' => $posts_per_page
				);
			} else {
				$args = array(
					'post_type' => $type,
					'post_status' => 'publish',
					'post__in' => get_option('sticky_posts'),
					'posts_per_page' => $posts_per_page
				);			
			}

			$temp = $wp_query;  // assign original query to temp variable for later use   
			$wp_query = null;
			$wp_query = new WP_Query($args); 
			
			
			$items_output = '';
			$i = 0;
			if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
				// get full image from featured image if was not see full image url in News
				$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
				$image_preview_url = $get_custom_options[0];

				$i++;
				if ($i <= $posts_per_page) {
			?>
				
				<?php
					if ($i == 1) {
				?>
				<!-- // -->
				<div class="main-news-i">
				  <div class="main-news-img">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo mr_image_resize($image_preview_url,920,800,'br','',''); ?>" alt="<?php the_title(); ?>" /></a>
					<span class="main-news-text">
					  <label class="post-num">01</label>
					  <label class="post-border"></label>                 
					  <span class="main-news-text-a">
						<span class="main-news-category big"><?php the_category(' / '); ?></span>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="main-news-title"><?php the_title(); ?></a>
						<span class="main-news-date"><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('M d, Y'); ?></a></span>
					  </span>
					</span>
				  </div>           
				</div>
				<!-- \\ -->
				<?php } ?>
				
				
				<?php if ($i == 2) { ?>
				<!-- // -->
				<div class="main-news-i">
				  <div class="main-news-img">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo mr_image_resize($image_preview_url,442,422,'br','',''); ?>" alt="<?php the_title(); ?>" /></a>
					<span class="main-news-text">
					  <label class="post-num">02</label>
					  <label class="post-border"></label>
					  <span class="main-news-text-a">                   
					   <span class="main-news-category"><?php the_category(' / '); ?></span>
						<a href="<?php the_permalink(); ?>" class="main-news-title"><?php the_title(); ?></a>
						<span class="main-news-date"><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('M d, Y'); ?></a></span>
					  </span>
					</span>
				  </div>           
				</div>
				<!-- \\ -->
				<?php } ?>
				
				<?php if ($i == 3) { ?>
				<!-- // -->
				<div class="main-news-i">
				  <div class="main-news-img">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo mr_image_resize($image_preview_url,442,422,'br','',''); ?>" alt="<?php the_title(); ?>" /></a>
					<span class="main-news-text">
					  <label class="post-num">03</label>
					  <label class="post-border"></label>
					  <span class="main-news-text-a">
						<span class="main-news-category"><?php the_category(' / '); ?></span>
						<a href="<?php the_permalink(); ?>" class="main-news-title"><?php the_title(); ?></a>
						<span class="main-news-date"><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('M d, Y'); ?></a></span>
					  </span>
					</span>
				  </div>
				</div>
				<!-- \\ -->
				<?php } ?>
			<?php } //end while?>
			
		<?php
			endwhile; endif;
			$wp_query = null;
			$wp_query = $temp;
		?>
    </section>
    <div class="clear"></div>
    <!-- // main news end // -->
          
    <div class="page-devider"></div><div class="tets"></div>
	<?php } //end to check if the sticky posts to show ?>
	
	<?php
		//show news posts
		wp_reset_postdata();
		$get_custom_options = get_option($wlm_shortname.'_blog_page_id');
		$cat_id_inclusion = (isset($get_custom_options['blog_to_cat_'.get_the_ID()])) ? trim($get_custom_options['blog_to_cat_'.get_the_ID()]) : '';
		
		$col1_count = get_option($wlm_shortname."_home1_col1_newscount");
		$col2_count = get_option($wlm_shortname."_home1_col2_newscount");
		$col3_count = (get_option($wlm_shortname."_home1_col3_newscount") > 0) ? get_option($wlm_shortname."_home1_col3_newscount") : 1;
		$posts_per_page = $col1_count+$col2_count+$col3_count;		
		
		$type = 'post';
		$args = array (
			'post_type' => $type,
			'post_status' => 'publish',
			'cat' => '-699',  //$cat_id_inclusion,
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
								<iframe src="'.$post_video_url.'" width="266" height="150" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
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

				<?php if (get_option($wlm_shortname."_home1_slider") == 'true') { ?>
					<?php if ($i == ($col1_count+$col2_count+1)) { //Main News section ?>
						<?php if (get_option($wlm_shortname."_home1_mainnews") == 'true') { ?>
						<!-- // news block start // -->
						<div class="mp-block">
						  <div class="mp-block-lbl"><?php echo get_option($wlm_shortname."_home1_mainnews_title"); ?></div>  
						  <div class="mp-block-content">
							<?php
								$items_chunks = explode(",", get_option($wlm_shortname."_home1_mainnews_items"));
								for ($m=0; $m<count($items_chunks); $m++) {
							?>
							<div class="mp-block-i">
							  <span><a href="<?php echo get_day_link(get_the_time('Y',trim($items_chunks[$m])), get_the_time('m',trim($items_chunks[$m])),get_the_time('d',trim($items_chunks[$m]))); ?>"><?php echo get_the_time('d M', trim($items_chunks[$m])); ?></a></span> <a href="<?php the_permalink(trim($items_chunks[$m])); ?>"><?php echo get_the_title(trim($items_chunks[$m])); ?></a>
							</div>
							<?php } ?>
						  </div>
						</div>
						<!-- \\ news block end \\ -->
						<?php } ?>
					<?php } ?>
				<?php } //end to check if to display the MAIN NEWS section ?>
				
				<?php
					if ( (get_option($wlm_shortname."_home1_col3_newscount") == 0) && ($i > ($col1_count+$col2_count)) ) { echo ''; } else {
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
				<?php } ?>
			
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
				$wp_query = null;
				$wp_query = $temp;

				wp_reset_postdata();
				$col1_count = get_option($wlm_shortname."_home1_col1_newscount");
				$col2_count = get_option($wlm_shortname."_home1_col2_newscount");
				$col3_count = get_option($wlm_shortname."_home1_col3_newscount");
				$posts_per_page = $col1_count+$col2_count+$col3_count;
				
				$get_custom_options = get_option($wlm_shortname.'_blog_page_id');
				$cat_id_inclusion = (isset($get_custom_options['blog_to_cat_'.get_the_ID()])) ? trim($get_custom_options['blog_to_cat_'.get_the_ID()]) : '';
		
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
    </div>

	<?php if (get_option($wlm_shortname."_home1_popular") == 'true') { ?>
    <!-- // maeterials slider start // -->
	<section class="main-content-b">
	  <div class="materials-slider">
		<div class="materials-devider"></div>
		<div class="materials-slider-lbl"><?php echo get_option($wlm_shortname."_home1_popular_title"); ?></div>
		<div id="popular-slider">
		  <?php
			$type = 'post';
			$args = array(
				'post_type' => $type,
				'post_status' => 'publish',
				'post__not_in'=>get_option('sticky_posts'),
				'posts_per_page' => get_option($wlm_shortname.'_home1_popular_count'),
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