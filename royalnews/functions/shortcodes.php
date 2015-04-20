<?php

//[title]Our Rating[/title]
function theme_title($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));
	return '<div class="category-page-title">'.do_shortcode($title).do_shortcode($content).'</div>';
}
add_shortcode('title', 'theme_title');

add_action( 'vc_before_init', 'title_integrateWithVC' );
function title_integrateWithVC() {
   vc_map( array(
      "name" => __("Title", "royalnews"),
      "base" => "title",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "royalnews"),
            "param_name" => "title",
            "value" => "",
            "description" => __("Enter the title.", "royalnews"),
         )
		),
	));
}

//[clear]
function theme_clear($atts, $content=null){
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'theme_clear');

add_action( 'vc_before_init', 'clear_integrateWithVC' );
function clear_integrateWithVC() {
   vc_map( array(
      "name" => __("Clear", "royalnews"),
      "base" => "clear",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "show_settings_on_create" => false
	));
}

//[featured_post heading="You may also like" title="Magni dolores eos qui ratione volup" image="/wp-content/uploads/2012/03/article-02-1.jpg" url="/template-featured-image-vertical/" content="Totam rem aperiam, inventore veritatis et quasi accusantium"]
function theme_featured_post($atts, $content=null){
	extract(shortcode_atts( array(
		"heading" => "",
		"title" => "",
		"image" => "",
		"image_id" => "",
		"url" => "",
		"content" => "",
		"content_vc" => ""
	), $atts));
	
	if ($image_id) {
		$image_attributes = wp_get_attachment_image_src( $image_id );
		$image = $image_attributes[0];
	}
	
	if ($content_vc) $content = $content_vc;
	
	return '
		<div class="post-related">
			<div class="post-related-a">'.$heading.'</div>  
				<div class="post-related-b">
					<div class="post-related-i">
						<div class="post-related-l">
							<a href="'.$url.'"><img src="'.mr_image_resize($image,65,50,'br','','').'" alt="'.$title.'" /></a>
						</div>
						<div class="post-related-r">
							<a href="'.$url.'" class="post-related-lbl">'.$title.'</a>
						<div class="post-related-txt">'.$content.'</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	';
}
add_shortcode('featured_post', 'theme_featured_post');

add_action( 'vc_before_init', 'featured_post_integrateWithVC' );
function featured_post_integrateWithVC() {
   vc_map( array(
      "name" => __("Featured Post", "royalnews"),
      "base" => "featured_post",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Heading", "royalnews"),
            "param_name" => "heading",
            "value" => "",
            "description" => __("Enter the heading.", "royalnews")
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "royalnews"),
            "param_name" => "title",
            "value" => "",
            "description" => __("Enter the title.", "royalnews")
         ),
         array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __("Image", "royalnews"),
            "param_name" => "image_id",
            "value" => "",
            "description" => __("Upload the image.", "royalnews")
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("URL", "royalnews"),
            "param_name" => "url",
            "value" => "",
            "description" => __("Enter the URL.", "royalnews")
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content", "royalnews"),
            "param_name" => "content_vc",
            "value" => "",
            "description" => __("Enter the content.", "royalnews")
         )
		),
	));
}



/*
[table]
<table>
<tr>
<th>#</th>
<th>Column 1</th>
<th>Column 2</th>
<th>Column 3</th>
<th>Column 4</th>
</tr>
<tr>
<td>1</td>
<td>Item #1</td>
<td>Description</td>
<td>100GB</td>
<td>1000$</td>
</tr>
<tr>
<td>2</td>
<td>Item #2</td>
<td>Description</td>
<td>200GB</td>
<td>2000$</td>
</tr>
<tr>
<td>3</td>
<td>Item #3</td>
<td>Description</td>
<td>300GB</td>
<td>3000$</td>
</tr>
<tr>
<td>4</td>
<td>Item #4</td>
<td>Description</td>
<td>400GB</td>
<td>4000$</td>
</tr>
</table>
[/table]
*/
function theme_table($atts, $content=null){
	return str_replace('<table>','<table class="table-style">',do_shortcode($content));
}
add_shortcode('table', 'theme_table');

add_action( 'vc_before_init', 'table_integrateWithVC' );
function table_integrateWithVC() {
   vc_map( array(
      "name" => __("Table ", "royalnews"),
      "base" => "table",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Table", "royalnews"),
            "param_name" => "content",
            "value" => "",
            "description" => __("Add the table html code.", "royalnews")
         )
		),
	));
}

/*
[tabs]
	[tab_titles]
		[tab_title active="yes"]Title one[/tab_title]
		[tab_title icon="/wp-content/uploads/icon-tab.png"]Title icon[/tab_title]
		[tab_title]Title three[/tab_title]
	[/tab_titles]
	[tab_contents]
		[tab_content]Quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo. Unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam[/tab_content]
		[tab_content]Eaque ipsa quae ab illo inventore veritatis. Est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia, quis nostrum exercitationem ullam corporis suscipit laboriosam.[/tab_content]
		[tab_content]Natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo.[/tab_content]
	[/tab_contents]
[/tabs]
*/
function theme_tabs($atts, $content=null){
	return '
		<div class="tabs">
		  '.do_shortcode($content).'
		  <div class="clear"></div>
		</div>
	';
}
add_shortcode('tabs', 'theme_tabs');
function theme_tab_titles($atts, $content=null){
	return '
		<div class="tabs-a">
		  '.do_shortcode($content).'
		  <div class="clear"></div>
		</div>
	';
}
add_shortcode('tab_titles', 'theme_tab_titles');
function theme_tab_title($atts, $content=null){
	extract(shortcode_atts( array(
		"active" => "no", //yes, no
		"icon" => ""
	), $atts));
	$active_output = ($active == 'yes') ? ' active' : '';
	$icon_output = ($icon) ? '<img src="'.$icon.'" alt="'.do_shortcode($content).'" />' : '';
	return '
		<div class="tabs-i'.$active_output.'">'.$icon_output.do_shortcode($content).'<span class="tabs-overlay"></span></div>
	';
}
add_shortcode('tab_title', 'theme_tab_title');
function theme_tab_contents($atts, $content=null){	
	return '
		<div class="tabs-b">
		  '.do_shortcode($content).'
		</div>
	';
}
add_shortcode('tab_contents', 'theme_tab_contents');
function theme_tab_content($atts, $content=null){
	return '
		<div class="tabs-content">'.do_shortcode($content).'</div>
	';
}
add_shortcode('tab_content', 'theme_tab_content');



add_action( 'vc_before_init', 'tabs_integrateWithVC' );
function tabs_integrateWithVC() {
   vc_map( array(
      "name" => __("Tabs ", "royalnews"),
      "base" => "tabs",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Table", "royalnews"),
            "param_name" => "content",
            "value" => '
	[tab_titles]
		[tab_title active="yes"]Title one[/tab_title]
		[tab_title icon="/wp-content/uploads/icon-tab.png"]Title icon[/tab_title]
		[tab_title]Title three[/tab_title]
	[/tab_titles]
	[tab_contents]
		[tab_content]Quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo. Unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam[/tab_content]
		[tab_content]Eaque ipsa quae ab illo inventore veritatis. Est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia, quis nostrum exercitationem ullam corporis suscipit laboriosam.[/tab_content]
		[tab_content]Natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo.[/tab_content]
	[/tab_contents]
',
            "description" => __('Edit the Tabs shortcode', "royalnews"),
         )
		),
	));
}


/*
[info_box type="default"]Standard Block![/info_box]
[info_box type="info"]Information Block![/info_box]
[info_box type="notification"]Notification Block![/info_box]
[info_box type="accepted"]Accepted![/info_box]
[info_box type="warning"]Warning Block![/info_box]
*/
function theme_info_box($atts, $content=null){
	extract(shortcode_atts( array(
		"type" => "default" //default, info, notification, accepted, warning
	), $atts));
	
	if (!$type) $type = 'default';
	
	if ($type == 'default') { $type_output = 'a'; }
	else if ($type == 'info') { $type_output = 'b'; }
	else if ($type == 'notification') { $type_output = 'c'; }
	else if ($type == 'accepted') { $type_output = 'd'; }
	else if ($type == 'warning') { $type_output = 'e'; }
	
	
	return '
	  <div class="alert-'.$type_output.'"><span></span>'.do_shortcode($content).'</div>
	';
}
add_shortcode('info_box', 'theme_info_box');

add_action( 'vc_before_init', 'info_box_integrateWithVC' );
function info_box_integrateWithVC() {
   vc_map( array(
      "name" => __("Info Box ", "royalnews"),
      "base" => "info_box",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Info Box Type", "royalnews"),
            "param_name" => "type",
            "value" => array("default", "info", "notification", "accepted", "warning"),
            "description" => __('Select the info box type.', "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Info Box Content", "royalnews"),
            "param_name" => "content",
            "value" => __("Info box text...", "royalnews"),
            "description" => __("Enter Info Box Content.", "royalnews")
         )
		),
	));
}




//[info_block title="Choice Royal News Theme!" text="Natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore." button_link="/contact-us/" button_text="View Details" button_target="_self" button_color="a"]
function theme_info_block($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"text" => "",
		"button_link" => "#",
		"button_text" => "",
		"button_target" => "_self", //_self, _blank
		"button_color" => "a" //a, b, c, d, e, f, g, k, l, m
	), $atts));
	
	return '
	  <div class="info-block">
		<div class="info-block-lbl">'.$title.'</div>
		<p>'.$text.'</p>  
		<a href="'.$button_link.'" target="'.$button_target.'"><button class="btn-type btn-'.$button_color.'">'.$button_text.'</button></a>
	  </div>
	';
}
add_shortcode('info_block', 'theme_info_block');

add_action( 'vc_before_init', 'info_block_integrateWithVC' );
function info_block_integrateWithVC() {
   vc_map( array(
      "name" => __("Info Block ", "royalnews"),
      "base" => "info_block",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "royalnews"),
            "param_name" => "title",
            "value" => __("Title", "royalnews"),
            "description" => __('Enter the title.', "royalnews"),
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content", "royalnews"),
            "param_name" => "text",
            "value" => __("Info Block Text...", "royalnews"),
            "description" => __("Enter info block text.", "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Link", "royalnews"),
            "param_name" => "button_link",
            "value" => "#",
            "description" => __("Enter info block button link.", "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", "royalnews"),
            "param_name" => "button_text",
            "value" => __("View Details", "royalnews"),
            "description" => __("Enter info block button text.", "royalnews"),
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Target", "royalnews"),
            "param_name" => "button_target",
            "value" => array("_self", "_blank"),
            "description" => __("Enter info block button target.", "royalnews"),
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Color", "royalnews"),
            "param_name" => "button_color",
            "value" => array("Blue"=>"a", "Yellow"=>"b", "Green"=>"c", "Light Blue"=>"d", "Red"=>"e", "Brown"=>"f", "Pink"=>"g", "Orange"=>"k", "Dark Blue"=>"l", "Grey"=>"m"),
            "description" => __("Enter info block button color.", "royalnews"),
         )
		),
	));
}




// [call_to_action title="Choice Royal News Theme!" text="Natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore." button_link="/contact-us/" button_text="View Details" button_target="_self" button_color="a"]
function theme_call_to_action($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"text" => "",
		"button_link" => "#",
		"button_text" => "",
		"button_target" => "_self", //_self, _blank
		"button_color" => "a" //a, b, c, d, e, f, g, k, l, m
	), $atts));
	
	return '
	  <div class="call-to-action">
		<div class="call-to-action-l">
		  <h5>'.$title.'</h5>
		  <p>'.$text.'</p>
		</div>
		<div class="call-to-action-r"><a href="'.$button_link.'" target="'.$button_target.'"><button class="btn-type btn-'.$button_color.'">'.$button_text.'</button></a></div> 
		<div class="clear"></div> 
	  </div>
	';
}
add_shortcode('call_to_action', 'theme_call_to_action');


add_action( 'vc_before_init', 'call_to_action_integrateWithVC' );
function call_to_action_integrateWithVC() {
   vc_map( array(
      "name" => __("Call To Action", "royalnews"),
      "base" => "call_to_action",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "royalnews"),
            "param_name" => "title",
            "value" => __("Title", "royalnews"),
            "description" => __('Enter the call to action title.', "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content", "royalnews"),
            "param_name" => "text",
            "value" => __("Call To Action Text...", "royalnews"),
            "description" => __("Enter call to action text.", "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Link", "royalnews"),
            "param_name" => "button_link",
            "value" => "#",
            "description" => __("Enter call to action button link.", "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", "royalnews"),
            "param_name" => "button_text",
            "value" => __("View Details", "royalnews"),
            "description" => __("Enter call to action button text.", "royalnews")
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Target", "royalnews"),
            "param_name" => "button_target",
            "value" => array("_self", "_blank"),
            "description" => __("Enter call to action button target.", "royalnews")
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Color", "royalnews"),
            "param_name" => "button_color",
            "value" => array("Blue"=>"a", "Yellow"=>"b", "Green"=>"c", "Light Blue"=>"d", "Red"=>"e", "Brown"=>"f", "Pink"=>"g", "Orange"=>"k", "Dark Blue"=>"l", "Grey"=>"m"),
            "description" => __("Enter call to action button color.", "royalnews")
         )
		),
	));
}


/*
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="a" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="b" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="c" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="d" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="e" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="f" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="g" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="k" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="l" target="_blank"]
[button title="Button" link="http://themeforest.net/user/weblionmedia/portfolio" color="m" target="_blank"]
*/
function theme_button($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "Button title",
		"link" => "#",
		"target" => "", //_self, _blank
		"color" => "a" //a, b, c, d, e, f, g, k, l, m
	), $atts));
	
	return '
		<a href="'.$link.'" target="'.$target.'"><button class="btn-type btn-'.$color.'">'.$title.'</button></a>
	';
}
add_shortcode('button', 'theme_button');

add_action( 'vc_before_init', 'button_integrateWithVC' );
function button_integrateWithVC() {
   vc_map( array(
      "name" => __("Button", "royalnews"),
      "base" => "button",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "royalnews"),
            "param_name" => "title",
            "value" => __("Button title", "royalnews"),
            "description" => __('Enter button title.', "royalnews")
         ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Link", "royalnews"),
            "param_name" => "link",
            "value" => "#",
            "description" => __("Enter button link.", "royalnews"),
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Target", "royalnews"),
            "param_name" => "target",
            "value" => array("_self", "_blank"),
            "description" => __("Enter button target.", "royalnews"),
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Color", "royalnews"),
            "param_name" => "color",
            "value" => array("Blue"=>"a", "Yellow"=>"b", "Green"=>"c", "Light Blue"=>"d", "Red"=>"e", "Brown"=>"f", "Pink"=>"g", "Orange"=>"k", "Dark Blue"=>"l", "Grey"=>"m"),
            "description" => __("Enter button color.", "royalnews"),
         )
		),
	));
}



/*
[accordion]
	[accordion_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/accordion_item]
	[accordion_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/accordion_item]
	[accordion_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/accordion_item]
[/accordion]
*/
function theme_accordion($atts, $content=null){
	$accordion_id = uniqid();
	return '
		<!-- Accordion -->
		<div class="accordion" id="accordion_'.$accordion_id.'">
			'.do_shortcode($content).'			
			<script type="text/javascript">
				jQuery(\'#accordion_'.$accordion_id.'\').tabs(\'#accordion_'.$accordion_id.' div.accordion-item-b\', {
					tabs : \'.accordion-item\',
					effect : \'slide\',
					toggle: false,
					initialIndex : 0
				});
			</script>
		</div>
		<!-- / Accordion -->
	';
}
add_shortcode('accordion', 'theme_accordion');
function theme_accordion_item($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));
	
	
	
	return '
		<!-- // -->
		<div class="accordion-item">
			<div class="accordion-item-a">
			  <div class="accordion-item-a-icon"></div>                    
			  <div class="accordion-item-a-txt">'.$title.'</div>
			  <div class="clear"></div>
			</div>
			<div class="accordion-item-b">
			  <p>'.do_shortcode($content).'</p>
			</div>
		</div>
		<!-- \\ -->
	';
}
add_shortcode('accordion_item', 'theme_accordion_item');



add_action( 'vc_before_init', 'accordion_integrateWithVC' );
function accordion_integrateWithVC() {
   vc_map( array(
      "name" => __("Accordion", "royalnews"),
      "base" => "accordion",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Accordion code", "royalnews"),
            "param_name" => "content",
            "value" => '
	[accordion_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/accordion_item]
	[accordion_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/accordion_item]
	[accordion_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/accordion_item]
			',
            "description" => __('Edit the accordion code.', "royalnews")
         )
	  )
	));
}




/*
[toggles]
	[toggle_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/toggle_item]
	[toggle_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/toggle_item]
	[toggle_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/toggle_item]
[/toggles]
*/
function theme_toggles($atts, $content=null){
	$toggle_id = uniqid();
	return '
		<!-- Toggles -->
		<div class="toggle" id="toggle_'.$toggle_id.'">
			'.do_shortcode($content).'			
			<script type="text/javascript">
				jQuery(\'#toggle_'.$toggle_id.'\').tabs(\'#toggle_'.$toggle_id.' div.toggle-item-b\', {
					tabs : \'.toggle-item\',
					effect : \'slide\',
					toggle: true,
					initialIndex : 0
				});
			</script>
		</div>
		<!-- / Toggles -->
	';
}
add_shortcode('toggles', 'theme_toggles');
function theme_toggle_item($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));
	

	
	return '
		<!-- // -->
		<div class="toggle-item">
			<div class="toggle-item-a">
			  <div class="toggle-item-a-icon"></div>                    
			  <div class="toggle-item-a-txt">'.$title.'</div>
			  <div class="clear"></div>
			</div>
			<div class="toggle-item-b">
			  <p>'.do_shortcode($content).'</p>
			</div>
		</div>
		<!-- \\ -->
	';
}
add_shortcode('toggle_item', 'theme_toggle_item');

add_action( 'vc_before_init', 'toggles_integrateWithVC' );
function toggles_integrateWithVC() {
   vc_map( array(
      "name" => __("Toggles", "royalnews"),
      "base" => "toggles",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Toggles code", "royalnews"),
            "param_name" => "content",
            "value" => '
	[toggle_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/toggle_item]
	[toggle_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/toggle_item]
	[toggle_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/toggle_item]
			',
            "description" => __('Edit the toggles code.', "royalnews")
         )
	  )
	));
}


/*
[columns]
	[one_half title="1/2 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.[/one_half]
	[one_half title="1/2 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.[/one_half]
[/columns]

[columns]
	[one_third title="1/3 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam.[/one_third]
	[one_third title="1/3 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam.[/one_third]
	[one_third title="1/3 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam.[/one_third]
[/columns]

[columns]
	[two_third title="2/3 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, consectetur, adipisci velit, sed eritatis et quasi.[/two_third]
	[one_half title="1/3 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam.[/one_half]
[/columns]

[columns]
	[one_fourth title="1/4 Column"]Eaque ipsa quae ab illo7 inventore. Veritatis et quasi architecto beatae vitae.[/one_fourth]
	[one_fourth title="1/4 Column"]Eaque ipsa quae ab illo7 inventore. Veritatis et quasi architecto beatae vitae.[/one_fourth]
	[one_fourth title="1/4 Column"]Eaque ipsa quae ab illo7 inventore. Veritatis et quasi architecto beatae vitae.[/one_fourth]
	[one_fourth title="1/4 Column"]Eaque ipsa quae ab illo7 inventore. Veritatis et quasi architecto beatae vitae.[/one_fourth]
[/columns]

[columns]
	[three_fourth title="3/4 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae. Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, consectetu.[/three_fourth]
	[one_fourth title="1/4 Column"]Eaque ipsa quae ab illo inventore. Veritatis et quasi architecto beatae vitae.[/one_fourth]
[/columns]
*/
function theme_columns($atts, $content = null, $shortcodename = '') {	
	return '
		<div class="row">
			'.do_shortcode($content).'
			<!--div class="clear"></div-->
		</div>
	';
}
add_shortcode('columns', 'theme_columns');

function theme_column($atts, $content = null, $shortcodename = '') {	
	extract(shortcode_atts( array(
		"title" => "",
		"titlesize" => "h5", //h1, h2, h3, h4, h5, h6
		"use_paragraph" => "yes" //yes, no
	), $atts));
	
	$clear_code = '';
	if ($shortcodename == "one_half")  {
		$shortcodename = "span6";
	} else if ($shortcodename == "one_third") {
		$shortcodename = "span4";
	} else if ($shortcodename == "two_third") {
		$shortcodename = "span8";
	} else if ($shortcodename == "one_fourth") {
		$shortcodename = "span3";
	} else if ($shortcodename == "three_fourth") {
		$shortcodename = "span9";
	}
	
	$title_output = ($title) ? '<'.$titlesize.'>'.$title.'</'.$titlesize.'>' : '';
	$paragraph_begin = ($use_paragraph == "yes") ? '<p>' : "";
	$paragraph_end   = ($use_paragraph == "yes") ? '</p>' : "";

	return '
		<div class="'.$shortcodename.'">
			'.$title_output.'
			'.$paragraph_begin.do_shortcode($content).$paragraph_end.'
		</div>
	';
}
add_shortcode('one_half', 'theme_column');
add_shortcode('one_third', 'theme_column');
add_shortcode('two_third', 'theme_column');
add_shortcode('one_fourth', 'theme_column');
add_shortcode('three_fourth', 'theme_column');


//[dropcap1]A[/dropcap1]
function theme_dropcap1($atts, $content=null){
	return '
		<span class="grapth-a">'.do_shortcode($content).'</span>
	';
}
add_shortcode('dropcap1', 'theme_dropcap1');

add_action( 'vc_before_init', 'dropcap1_integrateWithVC' );
function dropcap1_integrateWithVC() {
   vc_map( array(
      "name" => __("Dropcap 1", "royalnews"),
      "base" => "dropcap1",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Dropcap character code", "royalnews"),
            "param_name" => "content",
            "value" => "",
            "description" => ""
         )
	  )
	));
}

//[dropcap2]B[/dropcap2]
function theme_dropcap2($atts, $content=null){
	return '
		<span class="grapth-b">'.do_shortcode($content).'</span>
	';
}
add_shortcode('dropcap2', 'theme_dropcap2');

add_action( 'vc_before_init', 'dropcap2_integrateWithVC' );
function dropcap2_integrateWithVC() {
   vc_map( array(
      "name" => __("Dropcap 2", "royalnews"),
      "base" => "dropcap2",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Dropcap character code", "royalnews"),
            "param_name" => "content",
            "value" => "",
            "description" => ""
         )
	  )
	));
}


//[image title="Image title" src="/wp-content/uploads/2014/05/page-image.gif" align="left"]
function theme_image($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"src" => "",
		"src_id" => "",
		"align" => "none" //left, right, none
	), $atts));
	
	if ($src_id) {
		$image_attributes = wp_get_attachment_image_src( $src_id );
		$src = $image_attributes[0];
	}
	
	
	$align_output = '';
	if ($align == 'left') {
		$align_output = 'l';
	} else if ($align == 'right') {
		$align_output = 'r';
	} else { $align_output = $align; }
	
	return '
		<img src="'.$src.'" class="float-'.$align_output.'" alt="'.$title.'" />
	';
}
add_shortcode('image', 'theme_image');

add_action( 'vc_before_init', 'image_integrateWithVC' );
function image_integrateWithVC() {
   vc_map( array(
      "name" => __("Image", "royalnews"),
      "base" => "image",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Image Title", "royalnews"),
            "param_name" => "title",
            "value" => "",
            "description" => __("Enter image title.", "royalnews")
         ),
		 array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __("Upload image", "royalnews"),
            "param_name" => "src_id",
            "value" => "",
            "description" => __("Upload image", "royalnews")
         ),
		 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Image Align", "royalnews"),
            "param_name" => "align",
            "value" => array("left", "right", "none"),
            "description" => ""
         )
	  )
	));
}


//[quote]Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam.[/quote]
function theme_quote($atts, $content=null){
	return '
		<div class="post-quote">'.do_shortcode($content).'</div>
	';
}
add_shortcode('quote', 'theme_quote');

add_action( 'vc_before_init', 'quote_integrateWithVC' );
function quote_integrateWithVC() {
   vc_map( array(
      "name" => __("Quote 1", "royalnews"),
      "base" => "quote",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Quote Content", "royalnews"),
            "param_name" => "content",
            "value" => "",
            "description" => __("Enter quote content.", "royalnews")
         )
	  )
	));
}



//[quote2]Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam.[/quote2]
function theme_quote2($atts, $content=null){
	return '
		<div class="post-quote-a">'.do_shortcode($content).'</div>
	';
}
add_shortcode('quote2', 'theme_quote2');

add_action( 'vc_before_init', 'quote2_integrateWithVC' );
function quote2_integrateWithVC() {
   vc_map( array(
      "name" => __("Quote 2", "royalnews"),
      "base" => "quote2",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Quote Content", "royalnews"),
            "param_name" => "content",
            "value" => "",
            "description" => __("Enter quote content.", "royalnews")
         )
	  )
	));
}



/*
[post_slider]
	[slider_item title="Slide 1" image="/wp-content/uploads/2014/05/pic_standart_1_1.jpg" url="http://www.themeforest.com"][/slider_item]
	[slider_item title="Slide 2" image="/wp-content/uploads/2014/05/pic_standart_1_1.jpg" url=""][/slider_item]
	[slider_item title="Slide 3" image="/wp-content/uploads/2014/05/pic_standart_1_1.jpg" url="http://www.google.com"][/slider_item]
[/post_slider]
*/
function theme_post_slider($atts, $content=null){
	extract(shortcode_atts( array(
		/*"slides_count" => "0"*/
	), $atts));
	return '
		<div class="flex-holder">  
		  <div class="image-slider-ctr"><span>&nbsp;'.__('Next','royalnews').'&nbsp;</span></div>
		  <!--div class="image-slider-ctr"><span class="image-slider-current">1</span> of <span class="image-slider-total">3</span></div-->
		  <div class="flexslider">
			<ul class="slides">
				'.do_shortcode($content).'
			</ul>
		  </div>
		</div>
	';
}
add_shortcode('post_slider', 'theme_post_slider');
function theme_post_slider_item($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"image" => "",
		"url" => ""
	), $atts));
	
	$url_begin_output = ($url) ? '<a href="'.$url.'">' : '';
	$url_end_output = ($url) ? '</a>' : '';

	return '
		<li class="category-flex-slider">
			'.$url_begin_output.'<img src="'.$image.'" alt="'.$title.'" />'.$url_end_output.'
		</li>
	';
}
add_shortcode('slider_item', 'theme_post_slider_item');

add_action( 'vc_before_init', 'post_slider_integrateWithVC' );
function post_slider_integrateWithVC() {
   vc_map( array(
      "name" => __("Post Slider", "royalnews"),
      "base" => "post_slider",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Post Slider Code", "royalnews"),
            "param_name" => "content",
            "value" => '
	[slider_item title="Slide 1" image="/wp-content/uploads/2014/05/pic_standart_1_1.jpg" url="http://www.themeforest.com"][/slider_item]
	[slider_item title="Slide 2" image="/wp-content/uploads/2014/05/pic_standart_1_1.jpg" url=""][/slider_item]
	[slider_item title="Slide 3" image="/wp-content/uploads/2014/05/pic_standart_1_1.jpg" url="http://www.google.com"][/slider_item]
			',
            "description" => __("Enter post slider content.", "royalnews")
         )
	  )
	));
}



/*
[team]
[team_member image="/wp-content/uploads/2014/05/user-r-01.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Sara Villiams" position="CEO" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-02.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Diana Dowson" position="Manager" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-03.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Robert Simpson" position="Designer" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-04.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Ryan Fox" position="Developer" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-05.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Gareth King" position="Blogger" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-06.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Jodi Gobs" position="Photographer" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[/team]
*/
function theme_team($atts, $content=null){
	return '
		<div class="users-row">
			'.do_shortcode($content).'
		</div>
	';
}
add_shortcode('team', 'theme_team');
function theme_team_member($atts, $content=null){
	extract(shortcode_atts( array(
		"image" => "",
		"url" => "#",
		"name" => "",
		"position" => "",
		"twitter" => "",
		"facebook" => "",
		"pinterest" => "",
		"googleplus" => "",
		"last_in_column" => "no" //yes, no
	), $atts));
	
	$twitter_output = ($twitter) ? '<a href="'.$twitter.'" class="user-twitter"></a>' : '';
	$facebook_output = ($facebook) ? '<a href="'.$facebook.'" class="user-facebook"></a>' : '';
	$pinterest_output = ($pinterest) ? '<a href="'.$pinterest.'" class="user-pinterest"></a>' : '';
	$googleplus_output = ($googleplus) ? '<a href="'.$googleplus.'" class="user-gplus"></a>' : '';
	
	$last_item = ($last_in_column == "yes") ? ' nth' : '';
	return '
		<!-- // -->
		<div class="user-item'.$last_item.'">
			<div class="user-item-a"><a href="'.$url.'"><img src="'.$image.'" alt="'.$name.'" /></a></div>
			<div class="user-item-b"><a href="'.$url.'">'.$name.'</a></div>
			<div class="user-item-c">'.$position.'</div>
			<div class="user-item-d">
				'.$twitter_output.'
				'.$facebook_output.'
				'.$pinterest_output.'
				'.$googleplus_output.'
			</div>
		</div>
		<!-- \\ -->
	';
}
add_shortcode('team_member', 'theme_team_member');


add_action( 'vc_before_init', 'team_member_integrateWithVC' );
function team_member_integrateWithVC() {
   vc_map( array(
      "name" => __("Team Member", "royalnews"),
      "base" => "team",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Team Member Code", "royalnews"),
            "param_name" => "content",
            "value" => '
[team_member image="/wp-content/uploads/2014/05/user-r-01.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Sara Villiams" position="CEO" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-02.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Diana Dowson" position="Manager" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-03.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Robert Simpson" position="Designer" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-04.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Ryan Fox" position="Developer" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-05.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Gareth King" position="Blogger" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
[team_member image="/wp-content/uploads/2014/05/user-r-06.jpg" url="http://themeforest.net/user/weblionmedia/portfolio" name="Jodi Gobs" position="Photographer" twitter="http://www.twitter.com" facebook="http://www.facebook.com" pinterest="http://www.pinterest.com" googleplus="http://www.google.com/plus/"]
			',
            "description" => __("Enter post slider content.", "royalnews")
         )
	  )
	));
}



//[divider]
function theme_divider($atts, $content=null){
	return '
		<div class="page-devider"></div>
	';
}
add_shortcode('divider', 'theme_divider');

add_action( 'vc_before_init', 'divider_integrateWithVC' );
function divider_integrateWithVC() {
   vc_map( array(
      "name" => __("Divider 1", "royalnews"),
      "base" => "divider",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "show_settings_on_create" => false
	));
}

//[divider2]
function theme_divider2($atts, $content=null){
	return '
		<div class="page-devider-a"></div>
	';
}
add_shortcode('divider2', 'theme_divider2');

add_action( 'vc_before_init', 'divider2_integrateWithVC' );
function divider2_integrateWithVC() {
   vc_map( array(
      "name" => __("Divider 2", "royalnews"),
      "base" => "divider2",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "show_settings_on_create" => false
	));
}

//[divider3]
function theme_divider3($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));
	return '
		<div class="page-devider-b"><span>'.$title.'</span></div>
	';
}
add_shortcode('divider3', 'theme_divider3');

add_action( 'vc_before_init', 'divider3_integrateWithVC' );
function divider3_integrateWithVC() {
   vc_map( array(
      "name" => __("Divider 3", "royalnews"),
      "base" => "divider3",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "show_settings_on_create" => false
	));
}


//[divider4]
function theme_divider4($atts, $content=null){
	return '
		<div class="page-devider-aa"></div>
	';
}
add_shortcode('divider4', 'theme_divider4');

add_action( 'vc_before_init', 'divider4_integrateWithVC' );
function divider4_integrateWithVC() {
   vc_map( array(
      "name" => __("Divider 4", "royalnews"),
      "base" => "divider4",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "show_settings_on_create" => false
	));
}

//[latest_reviews][review title="New iOS review" url="#" percentage="79"][review title="New macbook pro" url="#" percentage="60"][review title="The last of us" url="" percentage="90"][/latest_reviews]
function theme_latest_reviews($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));
	return '
		<!-- // latest reviews start // -->
		<div class="side-block">
		  <div class="side-block-lbl">'.$title.'</div>
		  <div class="sidebar-reviews">
			<!-- // -->
			'.do_shortcode($content).'
			<!-- // -->
		  </div>
		</div>
	';
}
add_shortcode('latest_reviews', 'theme_latest_reviews');
function theme_review($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"url" => "#",
		"percentage" => ""
	), $atts));
	
	return '
		<div class="per-item animated">
		  <div class="per-item-a">
			<div class="per-item-lbl"><a href="'.$url.'">'.$title.'</a></div>
			<div class="per-item-value"><span class="per-item-data">'.$percentage.'</span>%</div>
			<div class="clear"></div>
		  </div>
		  <div class="per-item-b">
			<div class="per-item-b-value"></div>
		  </div>
		  <div class="clear"></div>
		</div>
	';
}
add_shortcode('review', 'theme_review');

add_action( 'vc_before_init', 'latest_reviews_integrateWithVC' );
function latest_reviews_integrateWithVC() {
   vc_map( array(
      "name" => __("Latest Reviews", "royalnews"),
      "base" => "latest_reviews",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Latest Reviews Code", "royalnews"),
            "param_name" => "content",
            "value" => '
	[review title="New iOS review" url="#" percentage="79"]
	[review title="New macbook pro" url="#" percentage="60"]
	[review title="The last of us" url="" percentage="90"]
			',
            "description" => __("Enter post slider content.", "royalnews")
         )
	  )
	));
}



//[promo title="Promo Advertising" image="/wp-content/uploads/2014/05/sidebar-promo.jpg" url="http://themeforest.net/user/WebLionMedia/portfolio?ref=weblionmedia"]
function theme_sidebar_promo($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"image" => "",
		"image_id" => "",
		"url" => ""
	), $atts));
	
	if ($image_id) {
		$image_attributes = wp_get_attachment_image_src( $image_id );
		$image = $image_attributes[0];
	}
	
	return '
		<a href="'.$url.'" class="sidebar-promo">
			<img src="'.$image.'" alt="'.$title.'" />
		</a>
	';
}
add_shortcode('promo', 'theme_sidebar_promo');



//[news_block title="Main News" id_array="4,11,56,102"]
function theme_news_block($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"id_array" => ""
	), $atts));
	

	$items_chunks = explode(",", $id_array);
	$news_output = '';
	for ($m=0; $m<count($items_chunks); $m++) {
		$news_output .= '
			<div class="mp-block-i">
			  <span><a href="'.get_day_link(get_the_time('Y',trim($items_chunks[$m])), get_the_time('m',trim($items_chunks[$m])),get_the_time('d',trim($items_chunks[$m]))).'">'.get_the_time('d M', trim($items_chunks[$m])).'</a></span> <a href="'.get_permalink(trim($items_chunks[$m])).'">'.get_the_title(trim($items_chunks[$m])).'</a>
			</div>
		';
	}
	
	return '
		<!-- // news block start // -->
		<div class="mp-block">
		  <div class="mp-block-lbl">'.$title.'</div>  
		  <div class="mp-block-content">
			'.$news_output.'
		  </div>
		</div>
		<!-- \\ news block end \\ -->
	';
}
add_shortcode('news_block', 'theme_news_block');

add_action( 'vc_before_init', 'news_block_integrateWithVC' );
function news_block_integrateWithVC() {
   vc_map( array(
      "name" => __("News Block", "royalnews"),
      "base" => "news_block",
      "class" => "",
      "category" => __("RoyalNews", "royalnews"),
	  "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "royalnews"),
            "param_name" => "title",
            "value" => "",
            "description" => __("Enter title.", "royalnews")
         ),
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Posts IDs", "royalnews"),
            "param_name" => "id_array",
            "value" => __("", "royalnews"),
            "description" => __("Enter posts IDs divided by comma (ex: 4,11,56,102).", "royalnews")
         )
	  )
	));
}



?>