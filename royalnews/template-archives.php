<?php
/*
Template Name: Archives
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
          
          <!-- // category content start // -->
          <div class="category-page">
            
            <section class="category-left">

              <h2><?php _e('Here is an archive of your posts organized by year and month.','royalnews'); ?></h2>      
              <div class="category-page-text">
                <p><?php _e('Please click on needed Year or Month link','royalnews'); ?></p>
                <div class="page-devider"></div>
                
                <!-- // archive start  // -->
                <div class="archive">
				
					<?php
						global $wpdb;
						$limit = 0;
						$year_prev = null;
						$n = 0;
						$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
						foreach($months as $month) :
							$year_current = $month->year;
							$n++;
							if ($year_current != $year_prev){
								if ($year_prev != null){
								}
								
								if ($n>1) echo '</ul>';
					?>
								<div class="lbl-a"><a href="<?php echo home_url(); ?>/<?php echo $month->year; ?>/"><?php echo $month->year; ?> Year</a></div>
									<ul class="marked">
					<?php 
							}
					?>
							<li><a href="<?php echo home_url(); ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>"><span class="archive-month"><?php echo date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span></a></li>
					<?php
							$year_prev = $year_current;
							if(++$limit >= 18) { break; }
						endforeach;
					?>
					</ul>
                </div>
                <!-- \\ archive end  \\ -->
                
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

<?php get_footer(); ?>