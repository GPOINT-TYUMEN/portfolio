<?php
header("Content-type: text/css");
$wp_load_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_load_include) && $i++ < 9) {
	$wp_load_include = "../$wp_load_include";
}
//required to include wordpress file
require($wp_load_include);

global $wlm_shortname;

//START to use custom fonts for body, menu and headings
if (get_option($wlm_shortname."_site_custom_fonts_enable") == 'true') {
		
	$site_content_font = get_option($wlm_shortname."_site_content_font");
	if ($site_content_font) {
		echo '
			body, td,
			.post-quote,
			.post-quote-a,
			.page-devider-b span,
			.label-a,
			.accordion-item-a-txt,
			.toggle-item-a-txt {
				font-family: "'.str_replace('+',' ',$site_content_font).'", Arial, Helvetica, sans-serif !important;
			}
			
			.page-header-search input[type="text"],
			.newsletter input[type="text"],
			.newsletter button,
			.main-news-i .main-news-category,
			.main-news-i .main-news-date,
			.article-category,
			.article-text,
			.twitter-i,
			.content-footer-txt,
			.content-footer-d,
			.featured-date,
			.recent-category,
			.breadcrumbs,
			.category-page-text,
			.pagination-a a,
			.pagination-b,
			.per-item-value,
			.most-commented-r,
			.latest-comments-txt,
			.tags-row a,
			.category-slider-overlay,
			.review-slider-overlay,
			.review-c,
			.image-slider-ctr,
			.page-author-txt,
			.page-author-social a,
			.comment-date,
			.comment-txt,
			.form-submit,
			.post-related-txt,
			.post-image-b,
			.rating-table-l,
			.rating-table-foot,
			ul.marked li,
			.page-search input[type="text"],
			.page-search button,
			.page-search-a,
			.grapth-a,
			.not-found {
				font-family: "'.str_replace('+',' ',$site_content_font).'", Arial, Helvetica, sans-serif !important;
			}
			
			.infoBoxLabel,
			.infoBoxTxt,
			.post-image-a,
			.category-slider-b, .category-slider-b a,
			.tabs-i,
			.tabs-content,
			table.table-style th,
			table.table-style td,
			.post-num,
			.not-found-b,
			.user-item-b a,
			.form-line input[type="text"],
			.form-line textarea,
			.call-to-action-l p,
			.info-block-lbl,
			.info-block p,
			.alert-a,
			.alert-b,
			.alert-c,
			.alert-d,
			.alert-e,
			.btn-type,
			.widget-title {
				font-family: "'.str_replace('+',' ',$site_content_font).'", Arial, Helvetica, sans-serif !important;
			}
		';
	}
		
	$site_headings_font = get_option($wlm_shortname."_site_headings_font");
	if ($site_headings_font) {
		echo '
			h1, h2, h3, h4, h5, h6 {
				font-family: "'.str_replace('+',' ',$site_headings_font).'", Arial, Helvetica, sans-serif !important;
			}
			h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
				font-family: "'.str_replace('+',' ',$site_headings_font).'", Arial, Helvetica, sans-serif !important;
			}
		';
	}

	$site_menu_font = get_option($wlm_shortname."_site_menu_font");
	if ($site_menu_font) {
		echo '
			.left-c-menu ul li a {
				font-family: "'.str_replace('+',' ',$site_menu_font).'", Arial, Helvetica, sans-serif !important;
			}
		';
	}

	$site_menu_font_size = get_option($wlm_shortname."_site_menu_font_size");
	if ($site_menu_font_size) {
		echo '
			.left-c-menu ul li a {
				font-size: '.$site_menu_font_size.'px !important;
			}
		';
	}

	$site_menu_font_weight = get_option($wlm_shortname."_site_menu_font_weight");
	if ($site_menu_font_weight) {
		echo '
			.left-c-menu ul li a {
				font-weight: '.$site_menu_font_weight.' !important;
			}
		';
	}
	
	
	
}
//END to use custom fonts for body, menu and headings


//START to use custom background, font colors
if (get_option($wlm_shortname."_site_custom_colors_enable") == 'true') {
	
	$color_primary = get_option($wlm_shortname.'_color_primary');
	if ($color_primary){
		echo '
			.head-logo{background:'.$color_primary.';}
			ul li.current_page_item a, ul li.current-menu-parent > a {color:'.$color_primary.' !important;}
			ul.sub-menu li.current-menu-item a {color: '.$color_primary.' !important;}
			.post-border{background:none; border-bottom:2px solid '.$color_primary.' !important;}
			.main-news-i:first-child .post-border {background:url(../img/main-news-i.png) left top no-repeat !important; border-bottom:0 !important;}
			.main-news-i:first-child .main-news-text {background: '.$color_primary.';}
			.mp-block{border-top:2px solid '.$color_primary.' !important;}
			.main-news-i .main-news-category a:hover, .main-news-i .main-news-title:hover, .articles-post a:hover, .mp-block-i a:hover, .recent-category a:hover, .recent-title a:hover, .left-c-menu ul li.current ul li.current a, .breadcrumbs a:hover, .article-category a:hover, .most-commented-l a:hover, .review-c a:hover, .review-title a:hover, .latest-comments-lbl:hover, .page-author-lbl a:hover, .page-author-social a:hover, .comment-user a:hover, .post-related-lbl:hover, .post-image-b a:hover, ul.marked li a:hover, .search-results-r .article-title a:hover {color: '.$color_primary.';}
			.main-news-i .main-news-date a:hover {color: '.$color_primary.';}
			.mp-block-i span, .mp-block-i span a {color: '.$color_primary.';}
			.content-footer-d .logo-text{background: '.$color_primary.';}
			.newsletter button:hover {background: '.$color_primary.';}
			.category-page-title a:hover {color:'.$color_primary.';}
			.category-slider-a, .category-slider-a a {background:'.$color_primary.';}
			.per-item-b-value {background:'.$color_primary.';}
			.pagination-a a.current {color:'.$color_primary.'; border-color: '.$color_primary.';}
			.post-quote {border-top: 2px solid '.$color_primary.';}
			.form-submit {background:'.$color_primary.';}
			.category-page-text p a {color: '.$color_primary.';}
			.post-quote-a {border-left: 3px solid '.$color_primary.';}
			.page-author-info-a span {color: '.$color_primary.';}
			.page-search button {background: '.$color_primary.';}
			.accordion-item.current .accordion-item-a {border-bottom: 2px solid '.$color_primary.';}
			.toggle-item.current .toggle-item-a {border-bottom: 2px solid '.$color_primary.';}
			.call-to-action {border-left: 2px solid '.$color_primary.';}
			button.btn-a {background: '.$color_primary.';}
			.tabs-i.active {border-top: 2px solid '.$color_primary.';}
			input.wpcf7-submit{background: '.$color_primary.';}
			
			#forums-search .searchsubmit {background-color: '.$color_primary.';}
			button#bbp_topic_submit, button.button.submit {background-color: '.$color_primary.';}
			.bbp-reply-content a {color:'.$color_primary.';}
			#bbpress-forums .status-closed a, a.bbp-author-name {color:'.$color_primary.';}
			a.bbp-forum-title, a.bbp-topic-permalink, .bbp-topic-started-in a{color:'.$color_primary.' !important;}
			span.activity {
				background-color: '.$color_primary.' !important;
				border: 1px solid '.$color_primary.' !important;
			}
			.skinset-background div.bbp-template-notice, .skinset-background div#message.updated {
				background-color: '.$color_primary.' !important;
			}
			#buddypress .activity-header p a {color:'.$color_primary.';}
			#buddypress .item-title a {color:'.$color_primary.';}
			div.item-list-tabs ul li a span {
				border-color: '.$color_primary.' !important;
				background: '.$color_primary.' !important;
			}
			#subnav a.new-reply-link:hover {
				background-color:'.$color_primary.' !important;
				border:1px solid '.$color_primary.' !important;
			}
			input#members_search_submit{background: none repeat scroll 0% 0% '.$color_primary.' !important;}

			input#aw-whats-new-submit, input#group-creation-create, input#group-creation-previous, input#group-creation-next, input#upload, input#avatar-crop-submit, input#group-creation-finish, input#save, input#signup_submit, .submit input, input#bp-login-widget-submit, input#bbp_search_submit {
				background: none repeat scroll 0% 0% '.$color_primary.' !important;
			}
			
			.category-right input#searchsubmit, .left-c-sidebar input#searchsubmit {background: none repeat scroll 0% 0% '.$color_primary.' !important;}
		';
	}

	$color_topbar = get_option($wlm_shortname.'_color_topbar');
	if ($color_topbar){
		echo '
			.header-a {background:'.$color_topbar.';}
			/*.left-col{margin-top:21px;}*/
		';
	}
			
	$color_leftcol = get_option($wlm_shortname.'_color_leftcol');
	if ($color_leftcol){
		echo '
			.left-col {background:'.$color_leftcol.';}
			.left-c-sidebar form.searchform {
				background:'.$color_leftcol.';
				border:1px solid '.$color_leftcol.';
			}
		';
	}			
			
	$color_footer = get_option($wlm_shortname.'_color_footer');
	if ($color_footer){
		echo '
			.content-footer {background:'.$color_footer.';}
		';
	}
	
	$color_subfooter = get_option($wlm_shortname.'_color_subfooter');
	if ($color_subfooter){
		echo '
			.content-footer-d {background:'.$color_subfooter.';}
		';
	}
			
			
			
	//Left menu items color, links, active links
	$color_leftmenu_text = get_option($wlm_shortname.'_color_leftmenu_text');
	if ($color_leftmenu_text){
		echo '
			.left-c-menu ul li a {color: '.$color_leftmenu_text.'}
		';
	}

	$color_leftmenu_onhover_text = get_option($wlm_shortname.'_color_leftmenu_onhover_text');
	if ($color_leftmenu_onhover_text){
		echo '
			.left-c-menu ul li a:hover {color: '.$color_leftmenu_onhover_text.'}
		';
	}
	
	$color_leftmenu_active_text = get_option($wlm_shortname.'_color_leftmenu_active_text');
	if ($color_leftmenu_active_text){
		echo '
			ul li.current_page_item a, ul li.current-menu-parent > a {color:'.$color_leftmenu_active_text.' !important;}
			ul.sub-menu li.current-menu-item a {color:'.$color_leftmenu_active_text.' !important;}
		';
	}
	
	
	
	//Left menu widget text color, links, links on hover
	$color_leftcol_text = get_option($wlm_shortname.'_color_leftcol_text');
	if ($color_leftcol_text){
		echo '
			.left-coll-a .textwidget {color:'.$color_leftcol_text.';}
			.left-c-lbl {color:'.$color_leftcol_text.';}
			.twitter-text p {color:'.$color_leftcol_text.';}
			.left-c-sidebar #recentcomments{color:'.$color_leftcol_text.' !important;}
		';
	}
	
	$color_leftcol_links_text = get_option($wlm_shortname.'_color_leftcol_links_text');
	if ($color_leftcol_links_text){
		echo '
			.left-coll-a .textwidget a {color:'.$color_leftcol_links_text.';}
			.twitter-text p a {color:'.$color_leftcol_links_text.' !important;}
			.twitter-article .tweet_time a {color:'.$color_leftcol_links_text.' !important;}
			.left-c-sidebar ul li a {color:'.$color_leftcol_links_text.' !important;}
		';
	}
	
	$color_leftcol_links_onhover_text = get_option($wlm_shortname.'_color_leftcol_links_onhover_text');
	if ($color_leftcol_links_onhover_text){
		echo '
			.left-coll-a .textwidget a:hover {color:'.$color_leftcol_links_onhover_text.';}
			.twitter-text p a:hover {color:'.$color_leftcol_links_onhover_text.' !important;}
			.tweet-time a:hover {color:'.$color_leftcol_links_onhover_text.' !important;}
		';
	}

	
	
	//Footer text color, links, links on hover
	$color_footer_headings = get_option($wlm_shortname.'_color_footer_headings');
	if ($color_footer_headings){
		echo '
			.content-footer-a .content-footer-lbl {color: '.$color_footer_headings.';}
		';
	}
	
	$color_footer_text = get_option($wlm_shortname.'_color_footer_text');
	if ($color_footer_text){
		echo '
			.content-footer-a .content-footer-txt {color:'.$color_footer_text.';}
			.content-footer-a .featured-date {color:'.$color_footer_text.';}
		';
	}
	
	$color_footer_links_text = get_option($wlm_shortname.'_color_footer_links_text');
	if ($color_footer_links_text){
		echo '
			.content-footer-a a {color:'.$color_footer_links_text.' !important;}
		';
	}
	
	$color_footer_links_onhover_text = get_option($wlm_shortname.'_color_footer_links_onhover_text');
	if ($color_footer_links_onhover_text){
		echo '
			.content-footer-a a:hover {color:'.$color_footer_links_onhover_text.' !important;}
		';
	}

	
	//SubFooter text color, links, links on hover
	
	$color_subfooter_text = get_option($wlm_shortname.'_color_subfooter_text');
	if ($color_subfooter_text){
		echo '
			.content-footer-d {color:'.$color_subfooter_text.' !important;}
		';
	}
	
	$color_subfooter_links_text = get_option($wlm_shortname.'_color_subfooter_links_text');
	if ($color_subfooter_links_text){
		echo '
			.content-footer-d a {color:'.$color_subfooter_links_text.' !important;}
		';
	}
	
	$color_subfooter_links_onhover_text = get_option($wlm_shortname.'_color_subfooter_links_onhover_text');
	if ($color_subfooter_links_onhover_text){
		echo '
			.content-footer-d a:hover {color:'.$color_subfooter_links_onhover_text.' !important;}
		';
	}
}
//END to use custom background, font colors	
	
//custom css added from admin pabel
$custom_css = get_option($wlm_shortname.'_custom_css');
if ($custom_css) echo $custom_css;