<?php get_header(); ?>

			<header class="page-heading">
				<div class="label-a"><?php the_title(); ?></div>
				<div class="breadcrumbs">
				  <a href="<?php echo home_url(); ?>"><?php _e('home','royalnews'); ?></a> <?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
				</div>
				<div class="clear"></div>
			</header>
			  
			<!-- // category content start // -->
			<section class="category-page">			
				<div class="category-left">
					<article class="category-page-text">
						<?php
							while ( have_posts() ) : the_post();
								the_content();
							endwhile; // end of the loop.
						?>
					</article>
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


<?php get_footer(); ?>