<?php get_header(); ?>

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
				<div class="category-page-text">
					<div class="page-search">
						<form action="<?php echo home_url(); ?>" method="get">
							<button><?php _e('Search','royalnews'); ?></button>
							<div class="field"><input type="text" name="s" id="s" tabindex="1" value="<?php the_search_query(); ?>"></div>
							<div class="page-search-a"><?php _e("If you're not happy with the results, please do another search","royalnews"); ?></div>
						</form>                  
					</div>
				
					<div class="page-devider"></div>
					
					
					<?php
						$s = $_GET['s'];
						
						$args=array(
							'post_type' => array('post'),
							's' => $s,
							'post_status' => 'publish',
							'paged' => $paged
						);
						
						$wp_query = new WP_Query($args);
					?>
					
					<!-- // search results start // -->
					<div class="search-results">
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							// get full image from featured image if was not see full image url in News
							$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
							$image_preview_url = $get_custom_options[0];
							$image_preview_output = ($image_preview_url) ? '<a href="'.get_permalink().'" class="search-results-l"><img src="'.mr_image_resize($image_preview_url,322,230,'br','','').'" alt="'.get_the_title().'" /></a>' : '';

							$custom = get_post_custom($post->ID);
							$custom_page_description = (isset($custom[$wlm_shortname."_small_news_description"][0])) ? $custom[$wlm_shortname."_small_news_description"][0] : '';
							$post_excerpt_output = ($custom_page_description) ? '<div class="article-text">'.substr($custom_page_description,0,90).'</div>' : '';
						?>
						  <!-- // -->
						  <div class="search-results-i">
							<?php echo $image_preview_output; ?>
							<div class="search-results-r">
							  <div class="article-category">
								<?php the_category(', '); ?> - <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo get_the_time('m.d.Y'); ?></a>
								<a href="#" class="post-info post-comments"><?php echo $post->comment_count; ?></a>
								<?php echo getPostLikeLink(get_the_ID(),'post-info');?>
							  </div> 
							  <div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							  <?php echo $post_excerpt_output; ?>
							</div>
							<div class="clear"></div>
						  </div>
						  <!-- \\ -->
						<?php
							endwhile;
							endif;
						?>
					</div>
				</div>
				
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

<?php get_footer(); ?>