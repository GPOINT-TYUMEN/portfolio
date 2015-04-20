<?php
/*
Template Name: Error 404
*/
get_header();
?>

          <header class="page-heading">
            <div class="label-a"><?php _e('Page Not Found','royalnews'); ?></div>
            <div class="breadcrumbs">
              <a href="<?php echo home_url(); ?>"><?php _e('Home','royalnews'); ?></a> - <?php _e('404','royalnews'); ?>
            </div>
            <div class="clear"></div>
          </header>

          <!-- // category content start // -->
          <section class="category-page full-width-post">

            <article class="not-found">
              <div class="not-found-a"><?php _e('404','royalnews'); ?></div>
              <div class="not-found-b"><?php _e('We are sorry, but the page you are<br />looking for can <span>not be found</span>','royalnews'); ?></div>
              <div class="not-found-c"><?php _e('You can try searching our site or visit the homepage','royalnews'); ?></div>
              <div class="not-found-d">
                <div class="page-header-search">
					<form action="<?php echo home_url(); ?>" method="get" class="search">
						<div class="button"><input type="submit" tabindex="2" value=""></div>
						<div class="field"><input type="text" name="s" id="s" tabindex="1" class="w_def_text" title="<?php _e('Search','weblionmedia'); ?>"></div>
						<div class="clear"></div>
					</form>
                </div>
              </div>  
            </article>

            <div class="clear"></div>
          </section>
          <!-- // category content end // -->
          
        </div>
	
<?php get_footer(); ?>