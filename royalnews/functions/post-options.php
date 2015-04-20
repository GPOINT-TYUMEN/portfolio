<?php
global $wlm_shortname;

// Add meta box goes into our admin_init function
function pagelayout_add_custom_box() {
    add_meta_box( 'pagelayout_sectionid', __( 'Page Layout', 'weblionmedia' ),
        'pagelayout_inner_custom_box', 'post', 'side' );
}
add_action('add_meta_boxes', 'pagelayout_add_custom_box');

function pagelayout_inner_custom_box($post) {
    $page_layout = get_post_meta($post->ID, '_page_layout', TRUE);
    if (!$page_layout) $page_layout = 'standard_page_layout';
    ?>
    <input type="hidden" name="page_layout_noncename" id="page_layout_noncename" value="<?php echo wp_create_nonce( 'page_layout'.$post->ID );?>" />
    <input type="radio"  <?php if ($page_layout == 'standard_page_layout') echo "checked=1";?> id="page-layout-1" class="page-layout" name="page_layout" value="standard_page_layout"/><label for="page-layout-1"  class="page-layout-icon page-layout-standard"><?php echo __( 'Post With Right Sidebar', 'weblionmedia' ); ?></label><br>
   <input type="radio"  <?php if ($page_layout == 'page_layout_fullwidth') echo "checked=1";?> id="page-layout-2" class="page-layout" name="page_layout" value="page_layout_fullwidth"/><label for="page-layout-2" class="page-layout-icon page-layout-standard"><?php echo __( 'Full Width Post Page', 'weblionmedia' ) ?></label><br>
<?php
}

function save_page_layout_data($post_id) {
    // verify this came from the our screen and with proper authorization.
    /*if ( !wp_verify_nonce( $_POST['page_layout_noncename'], 'page_layout'.$post_id )) {
        return $post_id;
    }*/

    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // Check permissions
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;


    // OK, we're authenticated: we need to find and save the data
    $post = get_post($post_id);
	if (isset($_POST['page_layout'])) {
		if ($post->post_type == 'post') {
			update_post_meta($post_id, '_page_layout', esc_attr($_POST['page_layout']) );
			return(esc_attr($_POST['page_layout']));
		}
		return $post_id;
	}
}
// Add to admin_init function
add_action('save_post', 'save_page_layout_data');



// Add meta box goes into our admin_init function
function pax_add_custom_box() {
    add_meta_box( 'pax_sectionid', __( 'Thumb Image Size', 'weblionmedia' ),
        'pax_inner_custom_box', 'post', 'side' );
}
add_action('add_meta_boxes', 'pax_add_custom_box');


function pax_inner_custom_box($post) {
    $format_news = get_post_meta($post->ID, '_format_news', TRUE);
    if (!$format_news) $format_news = 'standard_thumb';
    ?>
    <input type="hidden" name="format_news_noncename" id="format_news_noncename" value="<?php echo wp_create_nonce( 'format_news'.$post->ID );?>" />
    <input type="radio"  <?php if ($format_news == 'standard_thumb') echo "checked=1";?> id="post-format-1" class="post-format" name="format_news" value="standard_thumb"/><label for="post-format-1"  class="post-format-icon post-format-standard"><?php echo __( 'Standard Thumb', 'weblionmedia' ); ?></label><br>
   <input type="radio"  <?php if ($format_news == 'mini_thumb') echo "checked=1";?> id="post-format-2" class="post-format" name="format_news" value="mini_thumb"/><label for="post-format-2" class="post-format-icon post-format-standard"><?php echo __( 'Small Thumb', 'weblionmedia' ) ?></label><br>
    <input type="radio"  <?php if ($format_news == 'no_thumb') echo "checked=1";?> id="post-format-3" class="post-format" name="format_news" value="no_thumb"/><label for="post-format-3" class="post-format-icon post-format-standard"><?php echo __( 'No Thumb', 'weblionmedia' ) ?></label><br>
<?php
}

function save_post_format_data($post_id) {
    // verify this came from the our screen and with proper authorization.
    /*if ( !wp_verify_nonce( $_POST['format_news_noncename'], 'format_news'.$post_id )) {
        return $post_id;
    }*/

    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // Check permissions
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;


    // OK, we're authenticated: we need to find and save the data
    $post = get_post($post_id);
	if (isset($_POST['format_news'])) {
		if ($post->post_type == 'post') {
			update_post_meta($post_id, '_format_news', esc_attr($_POST['format_news']) );
			return(esc_attr($_POST['format_news']));
		}
		return $post_id;
	}
}
// Add to admin_init function
add_action('save_post', 'save_post_format_data');

// Add meta box goes into our admin_init function
function template_post_box() {
    add_meta_box( 'template_sectionid', __( 'Post Format', 'weblionmedia' ),
        'template_post_inner_box', 'post', 'side' );
}
add_action('add_meta_boxes', 'template_post_box');


function template_post_inner_box($post) {
    $template_format = get_post_meta($post->ID, '_template_format', TRUE);
    if (!$template_format) $template_format = 'blog_post';
    ?>
    <input type="hidden" name="template_format_noncename" id="template_format_noncename" value="<?php echo wp_create_nonce( 'template_format'.$post->ID );?>" />
    <input type="radio"  <?php if ($template_format == 'blog_post') echo "checked=1";?> id="post-format-1" class="post-format" name="template_format" value="blog_post"/><label for="post-format-1"  class="post-format-icon post-format-standard"><?php echo __( 'Standard Post', 'weblionmedia' ); ?></label><br />
    <input type="radio"  <?php if ($template_format == 'slider_post') echo "checked=1";?> id="post-format-2" class="post-format" name="template_format" value="slider_post"/><label for="post-format-2"  class="post-format-icon post-format-standard"><?php echo __( 'Slider Post', 'weblionmedia' ); ?></label><br />
    <input type="radio"  <?php if ($template_format == 'gallery_post') echo "checked=1";?> id="post-format-3" class="post-format" name="template_format" value="gallery_post"/><label for="post-format-3"  class="post-format-icon post-format-standard"><?php echo __( 'Gallery Post', 'weblionmedia' ); ?></label><br />
    <input type="radio"  <?php if ($template_format == 'video_post') echo "checked=1";?> id="post-format-4" class="post-format" name="template_format" value="video_post"/><label for="post-format-4"  class="post-format-icon post-format-standard"><?php echo __( 'Video Post', 'weblionmedia' ); ?></label><br />
    <input type="radio"  <?php if ($template_format == 'review_post') echo "checked=1";?> id="post-format-5" class="post-format" name="template_format" value="review_post"/><label for="post-format-5"  class="post-format-icon post-format-standard"><?php echo __( 'Review Post', 'weblionmedia' ); ?></label><br />
	<?php
}

function save_template_format_data($post_id) {
    // verify this came from the our screen and with proper authorization.
   /* if ( !wp_verify_nonce( $_POST['template_format_noncename'], 'template_format'.$post_id )) {
        return $post_id;
    }*/
    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // Check permissions
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;


    // OK, we're authenticated: we need to find and save the data
    $post = get_post($post_id);
	if (isset($_POST['template_format'])) {
		if ($post->post_type == 'post') {
			update_post_meta($post_id, '_template_format', esc_attr($_POST['template_format']) );
			return(esc_attr($_POST['template_format']));
		}
		return $post_id;
	}
}

// Add to admin_init function
add_action('save_post', 'save_template_format_data');


$meta_box_post = array(
	'id' => 'my-meta-box',
	'title' => 'Post/Reviews Options',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Post Options',
			'desc' => '',
			'id' => 'info_post_options',
			'type' => 'info'
		),
		array(
			'name' => 'Small News Description',
			'desc' => 'Add item description used in news page listing.',
			'id' => $wlm_shortname.'_small_news_description',
			'type' => 'textarea'
		),
		array(
			'name' => 'Video URL',
			'desc' => '<br/>Add in this field the video url and select the Post Format "Video Post" in right sidebar.<br />
				<small>
					&nbsp;&nbsp;&nbsp;a. YouTube format: <strong>http://www.youtube.com/embed/uxHXATYpt2w</strong><br />
					&nbsp;&nbsp;&nbsp;b. Vimeo format: <strong>http://player.vimeo.com/video/42011464</strong><br />
				</small>
			',
			'id' => $wlm_shortname.'_post_video_url',
			'type' => 'text'
		),
		
		
		array(
		'name' => '<hr><hr><hr>',
			'id' => 'divider',
			'type' => 'divider'
		),		
		array(
			'name' => 'Reviews Options',
			'desc' => 'Reviews data is used in template name "Home 7" and in in single post page. You can add up to 10 titles and count fields. Leave them empty if you will not use all.',
			'id' => 'info_reviews',
			'type' => 'info'
		),
		array(
			'name' => 'Activate Reviews Section',
			'desc' => 'Check this box to activate the Reviews style and the below options on the current post.',
			'id' => $wlm_shortname.'_review_style',
			'type' => 'checkbox'
		),
		array(
			'name' => 'Section Title',
			'desc' => 'Title will be displayed above the reviews section.',
			'id' => $wlm_shortname.'_review_section_title',
			'type' => 'text'
		),
		array(
			'name' => 'Summary',
			'desc' => 'Enter the summary for the entire review.',
			'id' => $wlm_shortname.'_review_summary',
			'type' => 'textarea'
		),
		array(
			'name' => 'Rating Type',
			'desc' => 'Display rating by Stars or Percentage',
			'id' => $wlm_shortname.'_review_rate_type',
			'type' => 'select',
			'options' => array('stars' => 'Stars (from 1 to 5)', 'percentage' => 'Percentage (from 1 to 100)')
		),
		array(
			'name' => '1) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title1',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count1',
			'type' => 'select_rate'
		),
		array(
			'name' => '2) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title2',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count2',
			'type' => 'select_rate'
		),
		array(
			'name' => '3) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title3',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count3',
			'type' => 'select_rate'
		),
		array(
			'name' => '4) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title4',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count4',
			'type' => 'select_rate'
		),
		array(
			'name' => '5) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title5',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count5',
			'type' => 'select_rate'
		),
		array(
			'name' => '6) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title6',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count6',
			'type' => 'select_rate'
		),
		array(
			'name' => '7) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title7',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count7',
			'type' => 'select_rate'
		),
		array(
			'name' => '8) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title8',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count8',
			'type' => 'select_rate'
		),
		array(
			'name' => '9) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title9',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count9',
			'type' => 'select_rate'
		),
		array(
			'name' => '10) Rate Title and Count',
			'desc' => 'Title',
			'id' => $wlm_shortname.'_review_rate_title10',
			'type' => 'text'
		),
		array(
			'name' => '',
			'desc' => 'Count',
			'id' => $wlm_shortname.'_review_rate_count10',
			'type' => 'select_rate'
		),

	)
);
add_action('admin_menu', 'mytheme_add_box_post');
// Add meta box
function mytheme_add_box_post() {
    global $meta_box_post;
    add_meta_box($meta_box_post['id'], $meta_box_post['title'], 'mytheme_show_box_post', $meta_box_post['page'], $meta_box_post['context'], $meta_box_post['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box_post() {
    global $meta_box_post, $post, $wlm_shortname;
    
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($meta_box_post['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label></th>',
                '<td>';
        switch ($field['type']) {
			case 'info':
                echo '<u>'.$field['desc'].'</u>';
				break;
			case 'divider':
                echo '<hr><hr><hr>';
				break;
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="'. $meta. '" size="30" style="width:30%" /><br />', '', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">'. $meta . '</textarea>', '', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'select_rate':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				echo '<option></option>';
                for ($i=1;$i<=100;$i++) {
                    echo '<option', $meta == $i ? ' selected="selected"' : '', '>', $i, '</option>';
                }
                echo '</select><br />'.$field['desc'];
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> '.$field['desc'];
                break;
				
			 case 'custom_sidebars':
			
				$custom = get_post_custom($post->ID);
				$current_sidebar = $custom["current_sidebar"][0];	

               	echo '<select name="'.$field['id'].'">';	
				echo '<option value=""></option>';		
				
				
				$get_custom_options = get_option($wlm_shortname.'_sidebars_cp');
				$m = 0;
				for($i = 1; $i <= 200; $i++) 
				{
					if ($get_custom_options[$wlm_shortname.'_sidebars_cp_url_'.$i])
					{	
						if ( $current_sidebar == $get_custom_options[$wlm_shortname.'_sidebars_cp_url_'.$i] ) { 
							?>
								<option selected value='<?php echo $get_custom_options[$wlm_shortname.'_sidebars_cp_url_'.$i]; ?>'>&nbsp;&nbsp;&nbsp;<?php echo $get_custom_options[$wlm_shortname.'_sidebars_cp_url_'.$i]; ?></option>";
							<?php	
						} else {
							?>
								<option value='<?php echo $get_custom_options[$wlm_shortname.'_sidebars_cp_url_'.$i]; ?>'>&nbsp;&nbsp;&nbsp;<?php echo $get_custom_options[$wlm_shortname.'_sidebars_cp_url_'.$i]; ?></option>";
							<?php 
						}
					}
				}
				
				echo '</select>';
				echo '<br/><span>'.$field['desc'].'</span>';
                break;		
				
			 case 'blog_post_type':
			
				$custom = get_post_custom($post->ID);
				$blog_post_type = $custom["blog_post_type"][0];	

               	echo '<select name="'.$field['id'].'">';
			
				$post_type_1_selected = ($blog_post_type == 'Post Type 1') ? 'selected ' : '';
				$post_type_2_selected = ($blog_post_type == 'Post Type 2') ? 'selected ' : '';
				$post_type_3_selected = ($blog_post_type == 'Post Type 3') ? 'selected ' : '';
				
				if (!$post_type_1_selected && $post_type_2_selected && $post_type_2_selected) {
					$post_type_1_selected = ' selected ';
				}

				echo '
					<option '.$post_type_1_selected.'value="Post Type 1">&nbsp;&nbsp;&nbsp;Post Type 1</option>";
					<option '.$post_type_2_selected.'value="Post Type 2">&nbsp;&nbsp;&nbsp;Post Type 2</option>";
					<option '.$post_type_3_selected.'value="Post Type 3">&nbsp;&nbsp;&nbsp;Post Type 3</option>";
				';

				echo '</select>';
				echo '<br/><span>'.$field['desc'].'</span>';
                break;

        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}

add_action('save_post', 'mytheme_save_data_post');

// Save data from meta box
function mytheme_save_data_post($post_id) {
    global $meta_box_post;
    
    // verify nonce
    /*if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }*/

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
	if (isset($_POST['post_type'])){
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}
    
    foreach ($meta_box_post['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
		if (isset( $_POST[$field['id']])) {
			$new = $_POST[$field['id']];
		} else {
			$new = '';
		}
		
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
?>