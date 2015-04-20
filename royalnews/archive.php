<?php get_header(); ?>

			<header class="page-heading">
				<div class="label-a"><?php 
						//get page section title
						if ( is_archive() ) {
						if ( is_day() ) : 
					?><h1>
						<?php printf( __( 'Daily Archives: %s', 'royalnews' ), '<span>' . get_the_date() . '</span>' ); ?>
						</h1>
						
						<?php elseif ( is_month() ) : ?>
						<h1>
							<?php printf( __( 'Monthly Archives: %s', 'royalnews' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
						</h1>
						
						<?php elseif ( is_year() ) : ?>
						<h1>
							<?php printf( __( 'Yearly Archives: %s', 'royalnews' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
						</h1>
						
						<?php elseif ( is_category() ) : ?>
						<h1>
							<?php printf( __( 'Category Archives: %s', 'royalnews' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
						</h1>
						
						<?php
							elseif ( is_author() ) : 
								$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

								if ($curauth->first_name || $curauth->last_name) $curauth_name = $curauth->first_name.' '.$curauth->last_name;
								if (!$curauth->first_name || !$curauth->last_name) $curauth_name = $curauth->nickname;
						?>
						
						<h1><?php _e('Author archive','royalnews'); ?> <?php echo $curauth_name; ?></h1>
						
						<?php else : ?>
						<h2>
							<?php
								$custom_post_type = get_post_type($post->ID);
								if ($custom_post_type == 'post') { _e( 'Blog Archives', 'royalnews' ); }
							?>
						</h2>

					<?php 
							endif;
					
						} else if ( is_search() ) {
							echo '<h1>';
								printf( __( 'Search Results for: %s', 'royalnews' ), '<strong>' . get_search_query() . '</strong>' );
							echo '</h1>';
						} else {
							echo '<h1>';
								//get page section title
								if (get_post_meta($post->ID, 'custom_page_heading',true)) {
									echo get_post_meta($post->ID, 'custom_page_heading',true);
								} else {
									the_title();
								}
							echo '</h1>';
							
							if (get_post_meta($post->ID, 'custom_page_description',true)) {
								echo '<h1 class="title_description">&nbsp;/&nbsp;'.get_post_meta($post->ID, 'custom_page_description',true).'</h1>';
							}												
							
							if (is_404()) {
								echo '<h1>'.__('ERROR PAGE 404','royalnews').'</h1>';
							}
						}
					?>
				</div>
				<div class="breadcrumbs">
				  <a href="<?php echo home_url(); ?>"><?php _e('Home','royalnews'); ?></a> <?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
				</div>
				<div class="clear"></div>
			</header>

			<!-- // category content start // -->
			<section class="category-page">
				<article class="category-left">
					<?php
						//show news posts
						$col1_count = (int)(get_option('posts_per_page')/2);
						$col2_count = (int)(get_option('posts_per_page')/2);
						
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
							if ( ($i == 1) || ($i == ($col1_count+1)) ) {
							?>
							<!-- // articles row start // -->

							<div class="articles-row equal-heights<?php if ($i == ($col1_count+1) ) echo ' nth-row'; ?>">
							<?php } ?>
								
								<?php
									if ( (get_option($wlm_shortname."_home5_col2_newscount") == 0) && ($i > $col1_count) ) { echo ''; } else {
										$custom = get_post_custom($post->ID);
										$custom_page_description = (isset($custom[$wlm_shortname."_small_news_description"][0])) ? $custom[$wlm_shortname."_small_news_description"][0] : '';
										$post_excerpt_output = ($custom_page_description) ? '<div class="article-text">'.substr($custom_page_description,0,90).'</div>' : '';		
								?>
								<!-- // -->
								<div class="articles-post<?php echo $format_news_class; ?>">
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
								<?php } ?>
							
							<?php if ( ($i == ($col1_count)) || ($i == ($col1_count+$col2_count)) ) { ?>
									<div class="load-content"></div>
								</div>
							<?php } ?>
						
						<?php
							endwhile;
							endif;
						?>
								
						<?php 
							if (
								($i < ($col1_count)) ||
								( ($i > ($col1_count)) && ($i < ($col1_count+$col2_count)) ) ||
								( ($i > ($col1_count+$col2_count)) && ($i < ($col1_count+$col2_count+$col3_count)) )
							) {
						?>
							</div>
						<?php } ?>

					<!-- \\ articles row end \\ -->
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
					?>
								
				</article>
				
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
			</section>
			<!-- // category content end // -->

        </div>

<?php get_footer(); ?>