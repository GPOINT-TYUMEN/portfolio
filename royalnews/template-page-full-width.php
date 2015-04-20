<?php
/*
Template Name: Page Full Width
*/
get_header();
?>

			<header class="page-heading">
				<div class="label-a"><?php the_title(); ?></div>
				<div class="breadcrumbs">
				  <a href="<?php echo home_url(); ?>"><?php _e('Home','royalnews'); ?></a> <?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
				</div>
				<div class="clear"></div>
			</header>
			  
			<!-- // content start // -->
			<section class="category-page full-width-post">			
				<article class="category-page-text">
					<?php
						while ( have_posts() ) : the_post();
							the_content();
						endwhile; // end of the loop.
					?>
				</article>
			</section>
            <div class="clear"></div>
	        <!-- // content end // -->

        </div>

<?php get_footer(); ?>