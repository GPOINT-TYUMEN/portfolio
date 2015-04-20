<?php
// Breadcrumbs function code
function theme_breadcrumbs() {
	$delimiter = '';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    global $post;
	global $wlm_shortname;
    $home =  home_url();
 
    if ( is_category() ) {
      global $wp_query;
	  global $wlm_shortname;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo ' / <span>'.__('Archive by category','weblionmedia');
		echo " '";
			single_cat_title();
		echo "' ";
	  echo '</span>';
	  
    } elseif ( is_day() ) {
		echo ' &rarr; <a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
		echo ' &rarr; <a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
		echo ' &rarr; <span>'.get_the_time('d').'</span>'; 
    } elseif ( is_month() ) {
		echo ' &rarr; <a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
		echo ' &rarr; <span>'.get_the_time('F').'</span>'; 
    } elseif ( is_year() ) {
		echo ' &rarr; <span>'.get_the_time('Y').'</span>';
    } elseif ( is_single() && !is_attachment() ) {
	  $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
	  if (!$cat) {
		if( get_post_type() == 'portfolio' ) { 	
			
		}
	  } else {
		echo ' &rarr; '.get_category_parents($cat, TRUE, '');
	  }
		echo ' &rarr; <span>'.get_the_title().'</span>'; 
    } elseif ( is_attachment() ) {
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); $cat = $cat[0];
		
		echo ' &rarr; '.get_category_parents($cat, TRUE, '');
		echo ' &rarr; <a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		echo ' &rarr; <span>'.get_the_title().'</span>';
    } elseif ( is_page() && !$post->post_parent ) {
		echo ' &rarr; <span>'.get_the_title().'</span>';
    } elseif ( is_page() && $post->post_parent ) {
		  $parent_id  = $post->post_parent;
		  $breadcrumbs = array();
		  while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = ' / <a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		  }
		  $breadcrumbs = array_reverse($breadcrumbs);
		  foreach ($breadcrumbs as $crumb) 
			echo $crumb . ' ' . $delimiter . ' ';
			echo ' &rarr; <span>'.get_the_title().'</span>';
    } elseif ( is_search() ) {
		echo ' &rarr; <span>'.__( 'Search Results for', 'weblionmedia' ).' &#39;' . get_search_query() . '&#39;'.'</span>';
    } elseif ( is_tag() ) {
		echo ' &rarr; <span>'.__( 'Posts tagged', 'weblionmedia' ).' &#39;';
		single_tag_title();
		echo '</span>'; 
    } elseif ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		echo ' &rarr; <span>'.__( 'Articles posted by', 'weblionmedia' ) .' <strong>'. $userdata->display_name.'</strong></span>'; 
    } elseif ( is_404() ) {
		echo ' &rarr; <span>';
		_e( 'ERROR 404', 'weblionmedia' );
		echo '</span>';
    }
  }
}
