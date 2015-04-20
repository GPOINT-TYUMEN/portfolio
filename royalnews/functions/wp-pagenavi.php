<?php
/*
Plugin Name: WP-PageNavi
Plugin URI: http://lesterchan.net/portfolio/programming/php/
Description: Adds a more advanced paging navigation to your WordPress blog.
Version: 2.50
Author: Lester 'GaMerZ' Chan
Author URI: http://lesterchan.net
*/


/*  
	Copyright 2009  Lester Chan  (email : lesterchan@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


### Create Text Domain For Translations
//add_action('init', 'pagenavi_textdomain');
function pagenavi_textdomain() {
	load_plugin_textdomain('wp-pagenavi', false, 'wp-pagenavi');
}


### Function: Page Navigation Option Menu
/*add_action('admin_menu', 'pagenavi_menu');
function pagenavi_menu() {
	if (function_exists('add_options_page')) {
		add_options_page(__('PageNavi', 'royalnews'), __('PageNavi', 'royalnews'), 'manage_options', 'wp-pagenavi/pagenavi-options.php') ;
	}
}*/


### Function: Enqueue PageNavi Stylesheets
//add_action('wp_print_styles', 'pagenavi_stylesheets');
function pagenavi_stylesheets() {
	if(@file_exists(TEMPLATEPATH.'/pagenavi-css.css')) {
		wp_enqueue_style('wp-pagenavi', get_stylesheet_directory_uri().'/pagenavi-css.css', false, '2.50', 'all');
	} else {
		wp_enqueue_style('wp-pagenavi', plugins_url('wp-pagenavi/pagenavi-css.css'), false, '2.50', 'all');
	}	
}


### Function: Page Navigation
function wp_pagenavi($before = '', $after = '') {

	global $wpdb, $wp_query;
	
	$page_text = '';
	
	if (!is_single()) {
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$pagenavi_options = get_option('pagenavi_options');
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = intval($pagenavi_options['num_pages']);
		$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
		$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = (n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = n_round($end_page, 10) + ($larger_per_page);
		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}
		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}
		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}
		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}
		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);

			$output1 = ''; //begin of the pagination output
			$output2 = ''; //the pagination with numbers itself
			$output3 = ''; //end of the pagination output
			
			//begin of the output
			$output1 .= $before.'
				<div class="pagination">
					<div class="pagination-a">
			';

			switch(intval($pagenavi_options['style'])) {
				case 1:
					if(!empty($pages_text)) {
						//do nothing
					}
					if ($start_page >= 2 && $pages_to_show < $max_page) {
						$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
						$output2 .= '<a class="pagination-ctrl pagination-prev" href="'.esc_url(get_pagenum_link()).'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
						
						if(!empty($pagenavi_options['dotleft_text'])) {
						}
					}
					if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
						for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						}
					}

					if ($start_page != $paged) {
						$output2 .= '<a class="pagination-ctrl pagination-prev" href="'.esc_url(get_pagenum_link($paged-1)).'" class="prev">'.__('Previous','royalnews').'</a>';
					}
					
					$current_page_text = 1;
					for($i = $start_page; $i  <= $end_page; $i++) {
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							if ($i == $end_page) {
								$output2 .= '<a class="current" href="'.esc_url(get_pagenum_link($i)).'" title="'.$page_text.'">'.$current_page_text.'</a>';
							} else {
								$output2 .= '<a class="current" href="'.esc_url(get_pagenum_link($i)).'" title="'.$page_text.'">'.$current_page_text.'</a>';
							}
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							if ($i == $end_page) {
								$output2 .= '<a href="'.esc_url(get_pagenum_link($i)).'" title="'.$page_text.'">'.$page_text.'</a>';
							} else {
								$output2 .= '<a href="'.esc_url(get_pagenum_link($i)).'" title="'.$page_text.'">'.$page_text.'</a>';
							}
						}
					}

					if ($end_page > $current_page_text) {
						//$output1 .= '<a href="'.esc_url(get_pagenum_link($current_page_text+1)).'" class="next">'.__('Next','royalnews').'</a>';
						$output2 .= '<a class="pagination-ctrl pagination-next next" href="'.esc_url(get_pagenum_link($current_page_text+1)).'">'.__('Next','royalnews').'</a>';
					}
					
					if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
						for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text'].'....');
						}
					}
					if ($end_page < $max_page) {
						if(!empty($pagenavi_options['dotright_text'])) {

						}
						$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					}
					break;
			}
			
			//end of the pagination output
			$output3 .= '
					 </div>
					<div class="pagination-b">'.$pages_text.'</div>
					<div class="clear"></div>
				</div>
			'.$after;
			
			echo $output1.$output2.$output3;
		}
	}
}


### Function: Blog HomePage Navigation
function wp_pagenavi_homepage($pageID) {
	global $wpdb, $wp_query, $post;
	
	$page_text = '';
	
	$blog_name_id = $pageID;
	$page = get_post($blog_name_id);
	
	$blog_page_link = '';
	$site_url_link = '';
	if (is_front_page() || is_home()) {
		$page = get_post($blog_name_id);
		$blog_page_link = home_url().'/'.$page->post_name;	
		$site_url_link = home_url();
	} else {
		$blog_page_link = '';
		$site_url_link = '';	
	}	
	
	if (!is_single()) {
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$pagenavi_options = get_option('pagenavi_options');
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if (empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = intval($pagenavi_options['num_pages']);
		$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
		$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = (n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = n_round($end_page, 10) + ($larger_per_page);
		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}
		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}
		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}
		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}
		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);

			$output1 = ''; //begin of the pagination output
			$output2 = ''; //the pagination with numbers itself
			$output3 = ''; //end of the pagination output
			
			//begin of the pagination output
			$output1 .= '
				<div class="pagination">
					<div class="pagination-a">
			';

			switch(intval($pagenavi_options['style'])) {
				case 1:
					if(!empty($pages_text)) {
						//do nothing
					}
					if ($start_page >= 2 && $pages_to_show < $max_page) {
						$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
						$a_href = str_replace($site_url_link, $blog_page_link, esc_url(get_pagenum_link()));
						$a_href = str_replace($page->post_name.'/'.$page->post_name, $page->post_name, $a_href);
						$output2 .= '<a class="pagination-ctrl pagination-prev" href="'.$a_href.'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
						if(!empty($pagenavi_options['dotleft_text'])) {
						}
					}
					if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
						for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						}
					}

					if ($start_page != $paged) {
						$output2 .= '<a class="pagination-ctrl pagination-prev" href="'.esc_url(get_pagenum_link($paged-1)).'">'.__('Previous','royalnews').'</a>';
					}
			
					for($i = $start_page; $i  <= $end_page; $i++) {
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							if ($i == $end_page) {
								$a_href = str_replace($site_url_link, $blog_page_link, esc_url(get_pagenum_link($i)));
								$a_href = str_replace($page->post_name.'/'.$page->post_name, $page->post_name, $a_href);
								$output2 .= '<a class="current" href="'.$a_href.'" title="'.$page_text.'">'.$current_page_text.'</a>';
							} else {
								$a_href = str_replace($site_url_link, $blog_page_link, esc_url(get_pagenum_link($i)));
								$a_href = str_replace($page->post_name.'/'.$page->post_name, $page->post_name, $a_href);
								$output2 .= '<a class="current" href="'.$a_href.'" title="'.$current_page_text.'">'.$current_page_text.'</a>';
							}
						} else {
							$a_href = str_replace($site_url_link, $blog_page_link, esc_url(get_pagenum_link($i)));
							$a_href = str_replace($page->post_name.'/'.$page->post_name, $page->post_name, $a_href);
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							if ($i == $end_page) {
								$output2 .= '<a href="'.$a_href.'" title="'.$page_text.'">'.$page_text.'</a>';
							} else {
								$output2 .= '<a href="'.$a_href.'" title="'.$page_text.'">'.$page_text.'</a>';
							}
						}
					}

					if ($end_page > $current_page_text) {
						$a_href = str_replace($site_url_link, $blog_page_link, esc_url(get_pagenum_link($current_page_text+1)));
						$a_href = str_replace($page->post_name.'/'.$page->post_name, $page->post_name, $a_href);
						$output2 .= '
							<a class="pagination-ctrl pagination-next" href="'.$a_href.'" class="next">'.__('Next','royalnews').'</a>
							<div class="clear"></div>
						';
					}
					
					if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
						for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text'].'....');
						}
					}
					if ($end_page < $max_page) {
						$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
						$a_href = str_replace($site_url_link, $blog_page_link, esc_url(get_pagenum_link($max_page)));
						$a_href = str_replace($page->post_name.'/'.$page->post_name, $page->post_name, $a_href);
						//$output2 .= '<a class="pagination-ctrl pagination-prev" href="'.$a_href.'" title="'.$last_page_text.'">'.$last_page_text.'</a>';
						if(!empty($pagenavi_options['dotright_text'])) {
						}
					}
					break;
			}
			
			//end of the pagination output
			$output3 .= '
					 </div>
					<div class="pagination-b">'.$pages_text.'</div>
					<div class="clear"></div>
				</div>
			';
			
			echo $output1.$output2.$output3;
		}
	}
}

### Function: Page Navigation: Drop Down Menu (Deprecated)
function wp_pagenavi_dropdown() { 
	wp_pagenavi(); 
}

### Function: Round To The Nearest Value
function n_round($num, $tonearest) {
   return floor($num/$tonearest)*$tonearest;
}

### Function: Page Navigation Options
add_action('init', 'pagenavi_init');
function pagenavi_init() {
	pagenavi_textdomain();
	// Add Options
	$pagenavi_options = array();
	$pagenavi_options['pages_text'] = __('Page %CURRENT_PAGE% of %TOTAL_PAGES%','royalnews');
	$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['first_text'] = __('First','royalnews');
	$pagenavi_options['last_text'] = __('Last','royalnews');
	$pagenavi_options['next_text'] = __('Next','royalnews');
	$pagenavi_options['prev_text'] = __('Prev','royalnews');
	$pagenavi_options['dotright_text'] = __('...','royalnews');
	$pagenavi_options['dotleft_text'] = __('...','royalnews');
	$pagenavi_options['style'] = 1;
	$pagenavi_options['num_pages'] = 5;
	$pagenavi_options['always_show'] = 1;
	$pagenavi_options['num_larger_page_numbers'] = 3;
	$pagenavi_options['larger_page_numbers_multiple'] = 10;
	add_option('pagenavi_options', $pagenavi_options, '', 'no');
}
?>