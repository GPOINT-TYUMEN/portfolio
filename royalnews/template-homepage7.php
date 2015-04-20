<?php
/*
Template Name: Home 7
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
          
          <!-- // category content start // -->
          <div class="category-page">
            
            <section class="category-left">
			
			<?php
				//check if to show sticky posts
				if (get_option($wlm_shortname."_home7_sticky_posts") == 'true') {

					$get_custom_options = get_option($wlm_shortname.'_blog_page_id');
					$cat_id_inclusion = (isset($get_custom_options['blog_to_cat_'.get_the_ID()])) ? trim($get_custom_options['blog_to_cat_'.get_the_ID()]) : '';

					//get category slug using cat ID
					function get_cat_slug($cat_id) {
						$cat_id = (int) $cat_id;
						$category = &get_category($cat_id);
						return $category->slug;
					}

					echo '
						<div class="modify-slider category-slider-page7">  
						  <div class="flexslider">
							<ul class="slides">
					';

					$posts_per_page = get_option($wlm_shortname."_home7_sticky_count");
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
					
					$i = 0;
					$i++;
					if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
						// get full image from featured image if was not see full image url in News
						$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
						$image_preview_url = $get_custom_options[0];
						
						$custom = get_post_custom($post->ID);
						$custom_page_description = (isset($custom[$wlm_shortname."_small_news_description"][0])) ? $custom[$wlm_shortname."_small_news_description"][0] : '';

						if ($i<=$posts_per_page) {
							$i++;
							?>
							  <li>
								<!-- // -->
								<div class="category-slider-r">
								 <img src="<?php echo mr_image_resize($image_preview_url,1106,608,'br','',''); ?>" alt="<?php the_title(); ?>" />
								  <div class="review-slider-overlay">
									<div class="review-slider-a"><?php the_category(' / '); ?> - <?php echo get_the_time('M d, Y'); ?></div>
									<div class="review-slider-b"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
									
									<?php
										//$custom = get_post_custom($post->ID);
										if ( (isset($custom[$wlm_shortname.'_review_style'][0]))  && ($custom[$wlm_shortname.'_review_style'][0] == 'on') ) {
											//get stars reviews fields
											$fields_count = 0;
											$stars_medium = 0;
											for ($ii=1;$ii<=10;$ii++) {
												if ( (isset($custom[$wlm_shortname.'_review_rate_title'.$ii][0])) && (isset($custom[$wlm_shortname.'_review_rate_count'.$ii][0])) ) {
													$fields_count++;
													if ( (isset($custom[$wlm_shortname.'_review_rate_type'][0]))  && ($custom[$wlm_shortname.'_review_rate_type'][0] == 'Percentage (from 1 to 100)') ) {
														$stars_medium = $stars_medium + round($custom[$wlm_shortname.'_review_rate_count'.$ii][0]/20);
													} else if ( (isset($custom[$wlm_shortname.'_review_rate_type'][0]))  && ($custom[$wlm_shortname.'_review_rate_type'][0] == 'Stars (from 1 to 5)') ) {
														$stars_medium = $stars_medium + $custom[$wlm_shortname.'_review_rate_count'.$ii][0];
													}
												}
											}
											$stars_medium = round($stars_medium/$fields_count);
											
											$stars_output = '';
											$stars_count = 1;
											for ($stars=1;$stars<=$stars_medium;$stars++) {
												$stars_output .= '<li class="li-rated"></li>';
												$stars_count++;
											}
											for ($stars=$stars_count;$stars<=5;$stars++) {
												$stars_output .= '<li></li>';
											}

											if ($stars_output) {
												echo '
													<div class="review-slider-s">
													  <ul class="rating">
														'.$stars_output.'
													  </ul>
													</div>
												';
											}
										}
									?>
									<div class="clear"></div>
									<div class="review-slider-c"><?php echo $custom_page_description; ?></div>
								  </div>
								</div>
								<!-- \\ -->
							  </li>
							<?php
						}
					endwhile; endif;
					$wp_query = null;
					$wp_query = $temp;
					
					echo '
							</ul>
						  </div>
						</div> 

					  <div class="page-devider"></div>
					';
				}
				//END check if to show sticky posts
			?>
			
			 <div class="reviews-row">
			 
			<?php
				//show news posts
				wp_reset_postdata();
				$posts_per_page =  get_option($wlm_shortname."_home7_newscount");
				$get_custom_options = get_option($wlm_shortname.'_blog_page_id'); 
				$cat_id_inclusion = (isset($get_custom_options['blog_to_cat_'.get_the_ID()])) ? trim($get_custom_options['blog_to_cat_'.get_the_ID()]) : '';
				
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
				
				$i = 0;
				$items_output = '';

				$wp_query = new WP_Query($args); 
				if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
					// get full image from featured image if was not see full image url in News
					$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
					$image_preview_url = $get_custom_options[0];

					//get meta data from meta box format_news
					$image_preview_output = '';
					$format_news_class = '';
					$format_news = get_post_meta($post->ID, '_format_news', TRUE);

					//check if it is used Standard or Small thumb
					$image_preview_output = ($image_preview_url) ? '<a href="'.get_permalink().'" class="review-l"><img src="'.mr_image_resize($image_preview_url,684,442,'br','','').'" alt="'.get_the_title().'" /></a>' : '';


					$custom = get_post_custom($post->ID);
					
					$post_excerpt_output = '';
					if (get_option($wlm_shortname."_home7_post_excerpt") == 'true') {
						$custom_page_description = (isset($custom[$wlm_shortname."_small_news_description"][0])) ? $custom[$wlm_shortname."_small_news_description"][0] : '';
						$post_excerpt_output = ($custom_page_description) ? '<div class="article-text">'.$custom_page_description.'</div>' : '';
					}
				?>
					
						<!-- // -->
						<div class="review-i">
						  <?php echo $image_preview_output; ?>
						  <div class="review-r">
							<div class="review-c"><?php _e('Reviews','royalnews'); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a></div>
							<div class="review-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

							<?php
								//$custom = get_post_custom($post->ID);
								if (($custom[$wlm_shortname.'_review_style'][0]) == 'on') {
									//get stars reviews fields
									$fields_count = 0;
									$stars_medium = 0;
									for ($i=1;$i<=10;$i++) {
										if ( (isset($custom[$wlm_shortname.'_review_rate_title'.$i][0])) && (isset($custom[$wlm_shortname.'_review_rate_count'.$i][0])) ) {
											$fields_count++;
											if ($custom[$wlm_shortname.'_review_rate_type'][0] == 'Percentage (from 1 to 100)') {
												$stars_medium = $stars_medium + round($custom[$wlm_shortname.'_review_rate_count'.$i][0]/20);
											} else if ($custom[$wlm_shortname.'_review_rate_type'][0] == 'Stars (from 1 to 5)') {
												$stars_medium = $stars_medium + $custom[$wlm_shortname.'_review_rate_count'.$i][0];
											}
										}
									}
									$stars_medium = round($stars_medium/$fields_count);
									
									$stars_output = '';
									$stars_count = 1;
									for ($stars=1;$stars<=$stars_medium;$stars++) {
										$stars_output .= '<li class="li-rated"></li>';
										$stars_count++;
									}
									for ($stars=$stars_count;$stars<=5;$stars++) {
										$stars_output .= '<li></li>';
									}

									if ($stars_output) {
										echo '
											<div class="review-rating">
											  <ul class="rating">
												'.$stars_output.'
											  </ul>
											</div>
										';
									}
								}
							?>

							<div class="clear"></div>
							<?php echo $post_excerpt_output; ?>
						  </div>
						  <div class="clear"></div>  
						</div>
						<!-- \\ -->
				
					<?php
						endwhile;
						endif;
					?>
					
					<div class="clear"></div>
					
					<?php
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
					?>
				
				</div>
            </section>
            
            <aside class="category-right">
              <div class="articles-row nth-row">
			  
				<?php
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Default Sidebar") ) :
					endif;
				?>

              </div>
              <!-- \\ articles row end \\ -->
              <div class="clear"></div>            
            </aside>
            <div class="clear"></div>
          </div>
          <!-- // category content end // -->

        </div>

		
		
		
		

		

	<?php if (get_option($wlm_shortname."_home7_popular") == 'true') { ?>
    <!-- // maeterials slider start // -->
	<section class="main-content-b">
	  <div class="materials-slider">
		<div class="materials-devider"></div>
		<div class="materials-slider-lbl"><?php echo get_option($wlm_shortname."_home7_popular_title"); ?></div>
		<div id="popular-slider">
		  <?php
			$type = 'post';
			$args = array(
				'post_type' => $type,
				'post_status' => 'publish',
				'post__not_in'=>get_option('sticky_posts'),
				'posts_per_page' => get_option($wlm_shortname.'_home7_popular_count'),
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