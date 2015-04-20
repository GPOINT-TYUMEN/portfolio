<?php get_header(); ?>

			<header class="page-heading">
				<div class="label-a"><?php the_title(); ?></div>
				<div class="breadcrumbs">
				  <a href="<?php echo home_url(); ?>"><?php _e('Home','royalnews'); ?></a> <?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
				</div>
				<div class="clear"></div>
			</header>
			  
			<!-- // category content start // -->
			<?php $current_page_layout = get_post_meta(get_the_ID(), '_page_layout', TRUE); ?>
			<div class="category-page<?php if ($current_page_layout == 'page_layout_fullwidth') echo ' full-width-post'; ?> single-post">
				<section class="category-left<?php if ($current_page_layout == 'page_layout_fullwidth') echo '_no_full_width'; ?>">
					<div <?php post_class(); ?>>
					<?php
						if (have_posts()) : while (have_posts()) : the_post();						
							// get full image from featured image if was not see full image url in News
							$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
							$image_preview_url = $get_custom_options[0];

							//get meta data from meta box format_news
							$image_preview_output = '';
							$format_news_class = '';
							$format_news = get_post_meta($post->ID, '_format_news', TRUE);
							
							$template_format = get_post_meta($post->ID, '_template_format', TRUE);

							//echo ' Template_format: '.$template_format;

							if ($template_format == 'blog_post') {
								if ($current_page_layout == 'page_layout_fullwidth') {
									$image_preview_output = ($image_preview_url) ? '<img src="'.mr_image_resize($image_preview_url,1680, 748,'br','','').'" alt="'.get_the_title().'" />' : '';
								} else {
									$image_preview_output = ($image_preview_url) ? '<img src="'.mr_image_resize($image_preview_url,1106,568,'br','','').'" alt="'.get_the_title().'" />' : '';
								}
							} else if ($template_format == 'gallery_post') {
							
							?>
							  <script type="text/javascript">
							  jQuery(function() {
								var galleries = jQuery('.ad-gallery').adGallery();
								jQuery('#switch-effect').change(
								  function() {
									galleries[0].settings.effect = jQuery(this).val();
									return false;
								  }
								);
							  });
							  </script>
							  <div class="article-category no-margin">
								<?php the_category(' / '); ?> - <?php _e('By','royalnews'); ?> <?php the_author_posts_link(); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
								<div class="article-likes">
								  <a class="post-comments" href="#"><?php echo $post->comment_count; ?></a>
								  <?php echo getPostLikeLink(get_the_ID());?>
								</div>
								<div class="clear"></div>                 
							  </div>						
							<?php
								$image_preview_output = '
								  <div id="gallery" class="ad-gallery">
									<div class="ad-image-wrapper">
									</div>
									<div class="ad-controls">
									</div>
									<div class="ad-nav">
									  <div class="ad-thumbs">
										<ul class="ad-thumb-list">
								';
								
								//get all images from the post metaboxes
								$slider_images = miu_get_images($post->ID);
								for ($m=0; $m<=count($slider_images)-1; $m++) {
									$image_preview_output .= '
									  <li>
										<a href="'.mr_image_resize($slider_images[$m],553,318,'br','','').'" class="category-image-slider">
										  <img src="'.mr_image_resize($slider_images[$m],88,64,'br','','').'" class="image'.(int)($m+1).'" alt="'.get_the_title().'" />
										</a>
									  </li>
									';
								}
								

								$image_preview_output .= '
										</ul>
									  </div>
									</div>
								  </div>
								';
								echo $image_preview_output;
							} else if ($template_format == 'slider_post') {
							?>
							  <div class="article-category no-margin">
								<?php the_category(' / '); ?> - <?php _e('By','royalnews'); ?> <?php the_author_posts_link(); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
								<div class="article-likes">
								  <a class="post-comments" href="#"><?php echo $post->comment_count; ?></a>
								  <?php echo getPostLikeLink(get_the_ID());?>
								</div>
								<div class="clear"></div>                 
							  </div>						
							<?php
								$image_preview_output = '
									<div class="modify-slider">  
									  <div class="flexslider">
										<ul class="slides">
								';
								
								//get all images from the post metaboxes
								$slider_images = miu_get_images($post->ID);
								for ($m=0; $m<=count($slider_images)-1; $m++) {
									$image_preview_output .= '
									  <li class="category-image-slider">
										<img src="'.mr_image_resize($slider_images[$m],1106,636,'br','','').'" alt="'.get_the_title().'" />
									  </li>
									';
								}

								$image_preview_output .= '
										</ul>
									  </div>
									</div>
								';
								echo $image_preview_output;
							} else if ($template_format == 'video_post') {
								$custom = get_post_custom($post->ID);
								$post_video_url = (isset($custom[$wlm_shortname."_post_video_url"][0])) ? $custom[$wlm_shortname."_post_video_url"][0] : '';
								$image_preview_output .= '
									<div class="video-embeded">
										<iframe src="'.$post_video_url.'" width="553" height="318" allowfullscreen></iframe>
									</div>
								';
								echo $image_preview_output;
							} else {
								$image_preview_output .= ($image_preview_url) ? '<img src="'.mr_image_resize($image_preview_url,1106,568,'br','','').'" alt="'.get_the_title().'" />' : '';
							}
					?>

					  
					  
					<?php if ($template_format == 'blog_post') { ?>
					  <div class="category-image<?php if ($current_page_layout == 'page_layout_fullwidth') { echo ' full-width-post'; } ?>">
						<?php echo $image_preview_output; ?>
					  </div>
					  <div class="article-category no-margin">
						<?php the_category(' / '); ?> - <?php _e('By','royalnews'); ?> <?php the_author_posts_link(); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
						<div class="article-likes">
						  <a class="post-comments" href="<?php the_permalink(); ?>"><?php echo $post->comment_count; ?></a>
						  <?php echo getPostLikeLink(get_the_ID());?>
						</div>
						<div class="clear"></div>                 
					  </div>
					<?php } ?>
					  
					  <article class="category-page-text">
						
						<?php
						
							//the reviews section
							$custom = get_post_custom($post->ID);
							if ( (isset($custom[$wlm_shortname.'_review_style'][0]))  && ($custom[$wlm_shortname.'_review_style'][0] == 'on') ) {
								if ( (isset($custom[$wlm_shortname.'_review_rate_type'][0]))  && ($custom[$wlm_shortname.'_review_rate_type'][0] == 'Percentage (from 1 to 100)') ) {
									//get percentage reviews fields
									$percentage_fields_output = '';
									$percentage_medium = 0;
									$fields_count = 0;
									for ($i=1;$i<=10;$i++) {
										if ( (isset($custom[$wlm_shortname.'_review_rate_title'.$i][0])) && (isset($custom[$wlm_shortname.'_review_rate_count'.$i][0])) ) {
											$fields_count++;
											$percentage_fields_output .= '
											   <!-- // -->
											  <div class="rating-table-per-l">
												<div class="per-item animated">
												  <div class="per-item-a">
													<div class="per-item-lbl">'.$custom[$wlm_shortname.'_review_rate_title'.$i][0].'</div>
													<div class="per-item-value"><span class="per-item-data">'.$custom[$wlm_shortname.'_review_rate_count'.$i][0].'</span>%</div>
													<div class="clear"></div>
												  </div>
												  <div class="per-item-b">
													<div class="per-item-b-value"></div>
												  </div>
												  <div class="clear"></div>
												</div>              
											  </div>
											  <!-- \\ -->
											';
											$percentage_medium = $percentage_medium + $custom[$wlm_shortname.'_review_rate_count'.$i][0];
										}
									}
									$percentage_medium = round($percentage_medium/$fields_count);
									
									//get section title
									$section_title_output = (isset($custom[$wlm_shortname.'_review_section_title'][0])) ? '<div class="category-page-title">'.$custom[$wlm_shortname.'_review_section_title'][0].'</div>' : '';
									
									
									$percentage_rate_word = __('Great','royalnews');
									if ($percentage_medium >= 90 && $percentage_medium <= 100) { $percentage_rate_word = __('Great','royalnews'); }
									else if ($percentage_medium >= 70 && $percentage_medium < 90) { $percentage_rate_word = __('Good','royalnews'); }
									else if ($percentage_medium >= 50 && $percentage_medium < 70) { $percentage_rate_word = __('Average','royalnews'); }
									else if ($percentage_medium >= 30 && $percentage_medium < 50) { $percentage_rate_word = __('Poor','royalnews'); }
									else if ($percentage_medium < 30) { $percentage_rate_word = __('Terrible','royalnews'); }	
									
									//get review summary
									$sumamry_output = ($custom[$wlm_shortname.'_review_summary'][0]) ? '
  										  <div class="rating-table-foot">
											<div class="rating-table-foot-l"><b>'.__('Summary:','royalnews').'</b> '.$custom[$wlm_shortname.'_review_summary'][0].'</div>
											<div class="rating-table-foot-r">
											  <div class="rating-table-foot-a"><b>'.$percentage_medium.'%</b></div>
											  <div class="rating-table-foot-b">'.$percentage_rate_word.'</div>
											</div>
											<div class="clear"></div>
										  </div>    
										' : '';

									echo '
										<!-- // rating table start // -->
										'.$section_title_output.'
										<div class="rating-table-per">
											'.$percentage_fields_output.'
											'.$sumamry_output.'
										</div>
										<!-- // rating table end // -->
									';
									
									the_content();
									wp_link_pages(array('before' => '<br /><p><strong>'.__('Pages:','royalnews').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));

								} else if ( (isset($custom[$wlm_shortname.'_review_rate_type'][0]))  && ($custom[$wlm_shortname.'_review_rate_type'][0] == 'Stars (from 1 to 5)') ) {
									//get stars reviews fields
									$stars_fields_output = '';
									$stars_medium = 0;
									$fields_count = 0;
									for ($i=1;$i<=10;$i++) {
										if ( (isset($custom[$wlm_shortname.'_review_rate_title'.$i][0])) && (isset($custom[$wlm_shortname.'_review_rate_count'.$i][0])) ) {
											$fields_count++;
											$stars_output = '';
											$stars_count = 1;
											for ($stars=1;$stars<=$custom[$wlm_shortname.'_review_rate_count'.$i][0];$stars++) {
												$stars_output .= '<li class="li-rated"></li>';
												$stars_count++;
											}
											for ($stars=$stars_count;$stars<=5;$stars++) {
												$stars_output .= '<li></li>';
											}
											$stars_medium = $stars_medium + $custom[$wlm_shortname.'_review_rate_count'.$i][0];
											$stars_fields_output .= '
											  <!-- // -->
											  <div class="rating-table-line">
												<div class="rating-table-l">'.$custom[$wlm_shortname.'_review_rate_title'.$i][0].'</div>
												<div class="rating-table-r">
												  <ul class="rating">
													'.$stars_output.'
												  </ul>                    
												</div>
												<div class="clear"></div>
											  </div>
											  <!-- \\ -->
											';
										}
									}
									$stars_medium = round($stars_medium/$fields_count,1);
									
									//get section title
									$section_title_output = (isset($custom[$wlm_shortname.'_review_section_title'][0])) ? '<div class="category-page-title">'.$custom[$wlm_shortname.'_review_section_title'][0].'</div>' : '';
									
									$star_rate_word = __('Great','royalnews');
									if ($stars_medium >= 4.5 && $stars_medium <= 5) { $star_rate_word = __('Great','royalnews'); }
									else if ($stars_medium >= 4 && $stars_medium < 4.5) { $star_rate_word = __('Good','royalnews'); }
									else if ($stars_medium >= 3 && $stars_medium < 4) { $star_rate_word = __('Average','royalnews'); }
									else if ($stars_medium >= 2 && $stars_medium < 3) { $star_rate_word = __('Poor','royalnews'); }
									else if ($stars_medium < 2) { $star_rate_word = __('Terrible','royalnews'); }									

									//get review summary
									$sumamry_output = ($custom[$wlm_shortname.'_review_summary'][0]) ? '
  										  <div class="rating-table-foot">
											<div class="rating-table-foot-l"><b>'.__('Summary:','royalnews').'</b> '.$custom[$wlm_shortname.'_review_summary'][0].$fields_count.'</div>
											<div class="rating-table-foot-r">
											  <div class="rating-table-foot-a"><b>'.$stars_medium.'</b></div>
											  <div class="rating-table-foot-b">'.$star_rate_word.'</div>
											</div>
											<div class="clear"></div>
										  </div>    
										' : '';
									
									the_content();
									wp_link_pages(array('before' => '<p><strong>'.__('Pages:','royalnews').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
										
									echo '
										<!-- // rating table start // -->
										'.$section_title_output.'
										<div class="rating-table">
											'.$stars_fields_output.'
											'.$sumamry_output.'
										</div>
										<!-- // rating table end // -->
									';
								}
							} else { 
								the_content();
								wp_link_pages(array('before' => '<p><strong>'.__('Pages:','royalnews').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
							}
						?>
					  </article>  
					 
					<?php if ( (get_option($wlm_shortname."_blog_tags") == 'true') || (get_option($wlm_shortname."_blog_page_socials") == 'true') ) { ?>
					  <div class="page-devider"></div>
					<?php } ?>
					 
					 <?php if (get_option($wlm_shortname."_blog_tags") == 'true') the_tags('<div class="tags-row page-tags"><a href="#">'.__('Tags:','royalnews').'</a> ',' ','</div>'); ?>
					  
					  <?php if (get_option($wlm_shortname."_blog_page_socials") == 'true') { ?>
					  <div class="page-social">
						<a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?>&nbsp;<?php echo urlencode(get_permalink()); ?>" class="article-social-twitter" title="Twitter"></a>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" class="article-social-facebook" title="Facebook"></a>
						<?php
							$image_src = $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'thumbnail' );
							if($image_src) $image_src = '&amp;media='.$image_src[0];
						?><a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); echo $image_src; ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" class="article-social-pinterest" title="Pinterest" data-pin-do="buttonPin" data-pin-config="above"></a>
						<a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" class="article-social-googleplus" title="Google+"></a>
					  </div>
					  <?php } ?>
					  
					  <div class="clear"></div>
					 
					 <div class="page-devider"></div>
					 
					
					<?php if (get_option($wlm_shortname."_blog_page_author") == 'true') { ?>
						<!-- // page-author start // -->
						<?php
							$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata($post->post_author);
							if ($curauth->first_name || $curauth->last_name) $curauth_name = $curauth->first_name.' '.$curauth->last_name;
							if (!$curauth->first_name || !$curauth->last_name) $curauth_name = $curauth->nickname;
							
							if (get_the_author_meta('description', $curauth->ID)) {
						?>
						<div class="page-author">
						  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $curauth->ID)); ?>" class="page-author-pic"><?php echo get_avatar(get_the_author_meta('email', $curauth->ID), $size='87'); ?></a>
						  <div class="page-author-about">
							<div class="page-author-lbl">
								<?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'"><strong>'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</strong></a>'; } ?>
							</div>
							<div class="page-author-txt">
							  <?php echo get_the_author_meta('description', $curauth->ID); ?>
							</div>
							<?php
								$user_facebook = get_the_author_meta('user_facebook', $curauth->ID);
								$user_twitter = get_the_author_meta('user_twitter', $curauth->ID);
								$user_vimeo = get_the_author_meta('user_vimeo', $curauth->ID);
								$user_gplus = get_the_author_meta('user_gplus', $curauth->ID);
								$user_rss = get_the_author_meta('user_rss', $curauth->ID);

								$user_facebook_output = '';
								$user_twitter_output = '';
								$user_vimeo_output = '';
								$user_gplus_output = '';
								$user_rss_output = '';
								
								if ($user_facebook || $user_twitter || $user_gplus || $user_vimeo || $user_rss) {
									if ($user_facebook) { $user_facebook_output = '<a href="'.$user_facebook.'" class="fb">'.__('Facebook','weblionmedia').'</a>'; }
									if ($user_twitter) { $user_twitter_output = '<a href="'.$user_twitter.'" class="tw">'.__('Twitter','weblionmedia').'</a>'; }
									if ($user_vimeo) { $user_vimeo_output = '<a href="'.$user_vimeo.'" class="vimeo">'.__('Vimeo','weblionmedia').'</a>'; }
									if ($user_gplus) { $user_gplus_output = '<a href="'.$user_gplus.'" class="gplus">'.__('Google+','weblionmedia').'</a>'; }
									if ($user_rss) { $user_rss_output = '<a href="'.$user_rss.'" class="rss">'.__('RSS','weblionmedia').'</a>'; }
									
									echo '
										<div class="page-author-social">
											'.$user_facebook_output.'
											'.$user_twitter_output.'
											'.$user_vimeo_output.'
											'.$user_gplus_output.'
											'.$user_rss_output.'
										</div>
									';
								}
							?>
						  </div>
						  <div class="clear"></div> 
						</div>
						<?php } ?>
						<!-- // page-author end // -->
					<?php } ?>
					 
					
					<?php if (get_option($wlm_shortname."_blog_page_controls") == 'true') { ?>
					<div class="post-controls">
						<?php 
							previous_post_link('%link', '<span class="post-controls-arrow"></span><span class="post-controls-a">'.__('Previous article','royalnews').'</span><span class="post-controls-b">%title');
					
							next_post_link('%link', '<span class="post-controls-arrow"></span><span class="post-controls-a">'.__('Next article','royalnews').'</span><span class="post-controls-b">%title');
						?>
						<div class="clear"></div>
					</div>
					<?php } ?>					
					
					
					<?php if (get_option($wlm_shortname."_blog_related_posts") == 'true') { ?>
						 <!-- // materials slider start // -->
						 <?php
							$blog_related_count = get_option($wlm_shortname."_blog_related_count");
							$news_posts = get_related_news($post->ID, $blog_related_count);
							if ($news_posts->have_posts()):
						?>
						 <div class="materials-slider-inner slider-one-coll">
						   <div class="materials-slider">
							 <div class="materials-devider"></div>
							 <div class="materials-slider-lbl"><?php _e('Related posts','royalnews'); ?></div>
								<div id="popular-slider">
									<?php
										$ii = 0;
										$posts_array = array();
										$posts_array[0] = 0;
										while ($news_posts->have_posts() && $ii <= $blog_related_count): $news_posts->the_post();
											$ii++;
											if (in_array(get_the_ID(), $posts_array, true)) {
												// do nothing
											} else {
												$posts_array[$ii] = get_the_ID();
												$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), '', false  );
												
												$image_thumb = '';
												if ($full_image[0]) {  
													$image_thumb = '<a href="'.get_permalink().'" class="article-image"><img src="'.mr_image_resize($full_image[0],532,344,'br','','').'" alt="'.get_the_title().'" class="related_post_images" /></a>';
												}

									?>
									<!-- // -->
									<div class="materials-item">
									  <div class="materials-item-a">
										<div class="articles-post">
										  <div class="article-category">
											<?php the_category(', '); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
											<a href="#" class="post-info post-comments"><?php echo $news_posts->comment_count; ?></a>
											<?php echo getPostLikeLink(get_the_ID(),'post-info');?>
										  </div>
										  <?php echo $image_thumb; ?>
										  <div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></div>
										</div>
									  </div>
									</div>
									<!-- \\ -->
									<?php
											} //end to check if the post was included in array
										endwhile; 
										wp_reset_postdata();
									?>
								</div>
							</div>
						 </div>
						 <?php endif; ?>
						 <!-- \\ maeterials slider end \\ -->					 
						<div class="page-devider"></div>
					<?php } ?>
					
					<?php if (get_option($wlm_shortname."_blog_comments") == 'true') { ?>	
						<?php comments_template('', true); ?>
					<?php } ?>
					 	 
					<?php
						endwhile; 
						endif; //end of the loop.
					?>
					</div>
				</div>
			</section>

            <?php if ($current_page_layout != 'page_layout_fullwidth') { ?>
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
			<?php } ?>
			
            <div class="clear"></div>
          </div>
          <!-- // category content end // -->
			
<?php get_footer(); ?>