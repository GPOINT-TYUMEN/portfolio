<?php
$wlm_themename = "RoyalNews";
$wlm_shortname = "wlm";
$wlm_themeversion = "1.0";


	
if (!isset($content_width)) $content_width = 880;

add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');
set_post_thumbnail_size(100, 100, TRUE);
add_theme_support('menus');

// Make theme available for translation. Translations can be filed in the /languages/ directory
load_theme_textdomain('royalnews', get_template_directory() . '/languages');
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/".$locale.".php";
if ( is_readable( $locale_file ) ) require_once( $locale_file );

// Register Navigation
add_theme_support('nav-menus');
if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
		  'main_navigation' => 'Main Navigation',
		  'footer_navigation' => 'Footer Navigation'
  		)
  	);
}

function wlm_admin_enqueue_script() {
	wp_enqueue_script("admin_script", get_template_directory_uri()."/functions/js/metaboxes.js");
}
add_action( 'admin_enqueue_scripts', 'wlm_admin_enqueue_script' );



function wlm_enqueue_style() {
	//Enqueue custom web fonts
	wp_enqueue_style('stylesheet', get_stylesheet_uri(), array(), '1', 'all'); // enqueue main stylesheet file
	wp_enqueue_style('style_wlm_flexslider', get_template_directory_uri().'/css/flexslider.css', false, '2.2.0', 'screen');
	wp_enqueue_style('style_wlm_buddypress', get_template_directory_uri().'/buddypress/css/buddypress.css', false, '1.0', 'screen');
	wp_enqueue_style('style_wlm_bbpress', get_template_directory_uri().'/bbpress/css/bbpress.css', false, '1.0', 'screen');
	wp_enqueue_style('style_wlm_nanoscroller', get_template_directory_uri().'/css/nanoscroller.css', false, '1.0', 'screen');
	
	
	if (is_single()) {
		wp_enqueue_style('style_wlm_adgallery', get_template_directory_uri().'/css/jquery.ad-gallery.css', false, '1.2.7', 'screen');
	}

	
	$common_web_fonts_array = array("Arial", "Comic Sans MS", "Courier New", "Georgia", "Lucida Console", "Palatino Linotype", "Tahoma", "Times New Roman", "Verdana");
	
	global $wlm_shortname;
	if (get_option($wlm_shortname."_site_custom_fonts_enable") == 'true') {
		// enqueue the site headings font
		$site_content_font = get_option($wlm_shortname."_site_content_font");
		if (in_array($site_content_font, $common_web_fonts_array)) {
			$common_web_fonts_content = 1;
		} else { $common_web_fonts_content = 0; }	
		if  ( ($site_content_font != "Open+Sans") && ($site_content_font != "PT+Sans") && 
				($site_content_font) && 
					($common_web_fonts_content == 0) ) {
			wp_enqueue_style('style_custom_webfont_general', 'http://fonts.googleapis.com/css?family='.$site_content_font, false, '1.0', 'screen');
		}
		$site_headings_font = get_option($wlm_shortname."_site_headings_font");
		if (in_array($site_headings_font, $common_web_fonts_array)) {
			$common_web_fonts_headings = 1;
		} else { $common_web_fonts_headings = 0; }	
		if  ( ($site_headings_font != "Open+Sans") && ($site_content_font != "PT+Sans") && 
				($site_headings_font) && 
					($common_web_fonts_headings == 0) ) {
			wp_enqueue_style('style_custom_webfont_headings', 'http://fonts.googleapis.com/css?family='.$site_headings_font, false, '1.0', 'screen');
		}
		
		$site_menu_font = get_option($wlm_shortname."_site_menu_font");
		if (in_array($site_menu_font, $common_web_fonts_array)) {
			$common_web_fonts_menu = 1;
		} else { $common_web_fonts_menu = 0; }	
		if  ( ($site_menu_font != "Open+Sans") && ($site_content_font != "PT+Sans") && 
				($site_menu_font) && 
					($common_web_fonts_menu == 0) ) {
			wp_enqueue_style('style_custom_webfont_menu', 'http://fonts.googleapis.com/css?family='.$site_menu_font, false, '1.0', 'screen');
		}
	}
		
	//Enqueue custom css styles
	wp_enqueue_style('wlm_custom_style', get_template_directory_uri().'/functions/custom-css-main.php', false, '1.0.0', 'screen');	
}
function wlm_enqueue_script() {
	// jQuery Script
	wp_enqueue_script('jquery');
	
	// Comment Script
	if(is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script( 'comment-reply' );
	}

	//jQuery Site JS plugins
	if (is_page_template('template-contact.php')) {
		wp_enqueue_script('jquery_wlm_contact_form', get_template_directory_uri().'/js/jquery.form.js', false, '1.0', true);
	}

	//Twitter plugin
	global $wlm_shortname;
	wp_enqueue_script('jquery_wlm_twitterfeed', get_template_directory_uri().'/js/twitterfeed.js', false, '1.0', true);
	wp_localize_script('jquery_wlm_twitterfeed', 'twitter_load_parameters', array('theme_default_path' => get_template_directory_uri(), 'tweetscount' => get_option($wlm_shortname."_twitter_count")));
	
	//jQuery Tools plugin
	wp_enqueue_script('jquery_wlm_tools', get_template_directory_uri().'/js/jquery.tools.min.js', false, '1.0', false);	
	wp_enqueue_script('jquery_wlm_viewport', get_template_directory_uri().'/js/viewport.js', false, '1.0', true);
	if (is_single()) wp_enqueue_script('jquery_wlm_adgallery', get_template_directory_uri().'/js/jquery.ad-gallery.js', false, '1.2.7', true);

	//nanoScroller plugin for left sidebar
	wp_enqueue_script('jquery_wlm_overthrow', get_template_directory_uri().'/js/overthrow.min.js', false, '0.7.0', true);
	wp_enqueue_script('jquery_wlm_nanoscroller', get_template_directory_uri().'/js/jquery.nanoscroller.js', false, '0.8.4', true);

	//Sliders plugins
	wp_enqueue_script('jquery_wlm_bxSlider', get_template_directory_uri().'/js/jquery.bxslider.min.js', false, '4.1.2', true);
	wp_enqueue_script('jquery_wlm_flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', false, '2.2.0', true);
	wp_enqueue_script('jquery_wlm_single', get_template_directory_uri().'/js/sliders.js', false, '1.0', true);
	
	//post plugin
	wp_enqueue_script('wlm_like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );
	wp_localize_script('wlm_like_post', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
	));
	
	//custom main scripts
	wp_enqueue_script('jquery_wlm_main', get_template_directory_uri().'/js/main.js', false, '1.0', true);
	wp_localize_script('jquery_wlm_main', 'js_load_path', array('theme_default_path' => get_template_directory_uri())); // add parameters for the JavaScript
}
add_action('wp_enqueue_scripts', 'wlm_enqueue_style');
add_action('wp_enqueue_scripts', 'wlm_enqueue_script');



/**
 * Save like data
 */
add_action( 'wp_ajax_nopriv_wlm-post-like', 'wlm_post_like' );
add_action( 'wp_ajax_wlm-post-like', 'wlm_post_like' );
function wlm_post_like() {
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );

    if ( isset( $_POST['wlm_post_like'] ) ) {

        $post_id = $_POST['post_id']; // post id
        $post_like_count = get_post_meta( $post_id, "_post_like_count", true ); // post like count

        if ( is_user_logged_in() ) { // user is logged in
            global $current_user;
            $user_id = $current_user->ID; // current user
            $meta_POSTS = ( is_multisite() ) ? get_user_option( "_liked_posts", $user_id  ) : get_user_meta( $user_id, "_liked_posts" ); // post ids from user meta
            $meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
            $liked_POSTS = NULL; // setup array variable
            $liked_USERS = NULL; // setup array variable

            if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values
                $liked_POSTS = $meta_POSTS[0];
            }

            if ( !is_array( $liked_POSTS ) ) // make array just in case
                $liked_POSTS = array();

            if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
                $liked_USERS = $meta_USERS[0];
            }

            if ( !is_array( $liked_USERS ) ) // make array just in case
                $liked_USERS = array();

            $liked_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
            $liked_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
            $user_likes = count( $liked_POSTS ); // count user likes

            if ( !AlreadyLiked( $post_id ) ) { // like the post
                update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Add user ID to post meta
                update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
                if ( is_multisite() ) { // if multisite support
                    update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
                    update_user_option( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
                } else {
                    update_user_meta( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
                    update_user_meta( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
                }
                echo $post_like_count; // update count on front end

            } else { // unlike the post
                $pid_key = array_search( $post_id, $liked_POSTS ); // find the key
                $uid_key = array_search( $user_id, $liked_USERS ); // find the key
                unset( $liked_POSTS[$pid_key] ); // remove from array
                unset( $liked_USERS[$uid_key] ); // remove from array
                $user_likes = count( $liked_POSTS ); // recount user likes
                update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Remove user ID from post meta
                update_post_meta($post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
                if ( is_multisite() ) { // if multisite support
                    update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Remove post ID from user meta
                    update_user_option( $user_id, "_user_like_count", $user_likes ); // -1 count user meta
                } else {
                    update_user_meta( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
                    update_user_meta( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
                }
                echo "already".$post_like_count; // update count on front end

            }

        } else { // user is not logged in (anonymous)
            $ip = $_SERVER['REMOTE_ADDR']; // user IP address
            $meta_IPS = get_post_meta( $post_id, "_user_IP" ); // stored IP addresses
            $liked_IPS = NULL; // set up array variable

            if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
                $liked_IPS = $meta_IPS[0];
            }

            if ( !is_array( $liked_IPS ) ) // make array just in case
                $liked_IPS = array();

            if ( !in_array( $ip, $liked_IPS ) ) // if IP not in array
                $liked_IPS['ip-'.$ip] = $ip; // add IP to array

            if ( !AlreadyLiked( $post_id ) ) { // like the post
                update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Add user IP to post meta
                update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
                echo $post_like_count; // update count on front end

            } else { // unlike the post
                $ip_key = array_search( $ip, $liked_IPS ); // find the key
                unset( $liked_IPS[$ip_key] ); // remove from array
                update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Remove user IP from post meta
                update_post_meta( $post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
                echo "already".$post_like_count; // update count on front end

            }
        }
    }

    exit;
}

/**
 * Test if user already liked post
 */
function AlreadyLiked( $post_id ) { // test if user liked before
    if ( is_user_logged_in() ) { // user is logged in
        $user_id = get_current_user_id(); // current user
        $meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
        $liked_USERS = ""; // set up array variable

        if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
            $liked_USERS = $meta_USERS[0];
        }

        if( !is_array( $liked_USERS ) ) // make array just in case
            $liked_USERS = array();

        if ( in_array( get_current_user_id(), $liked_USERS ) ) { // True if User ID in array
            return true;
        }
        return false;

    } else { // user is anonymous, use IP address for voting

        $meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
        $ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
        $liked_IPS = ""; // set up array variable

        if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
            $liked_IPS = $meta_IPS[0];
        }

        if ( !is_array( $liked_IPS ) ) // make array just in case
            $liked_IPS = array();

        if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
            return true;
        }
        return false;
    }

}

/**
 * Front end button
 */
function getPostLikeLink( $post_id, $additional_class=NULL ) {
    $like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
    $count = ( empty( $like_count ) || $like_count == "0" ) ? '0' : $like_count;
    if ( AlreadyLiked( $post_id ) ) {
        $class = __(  ' liked', 'royalnews' );
        $title = __( 'Unlike', 'royalnews' );
        $heart = '<i class="fa fa-heart"></i>';
    } else {
        $class = '';
        $title = __( 'Like', 'royalnews' );
        $heart = '<i class="fa fa-heart-o"></i>';
    }
	$additional_class_output = ($additional_class) ? $additional_class.' ' : '';
    $output = '<a href="#" class="'.$additional_class_output.'post-likes wlm-post-like likes'.esc_attr( $class ).'" data-post_id="'.esc_attr( $post_id ).'" title="'.esc_attr( $title ).'">'.$count.'</a><span class="wlm-load"></span>';
    return $output;
}




// Include theme' shortcodes
require_once(get_template_directory() . '/functions/shortcodes.php');

// Include popular posts widget
require_once(get_template_directory() . '/functions/widget-popular-posts.php');

// Include social links widget
require_once(get_template_directory() . '/functions/widget-social-links.php');

// Include newsletter widget
require_once(get_template_directory() . '/functions/widget-newsletter.php');

// Include recent posts widget
require_once(get_template_directory() . '/functions/widget-recent-posts.php');

// Include news block widget
require_once(get_template_directory() . '/functions/widget-news-block.php');

// Include sidebar promo widget
require_once(get_template_directory() . '/functions/widget-sidebar-promo.php');

// Include most commented news widget
require_once(get_template_directory() . '/functions/widget-most-commented.php');

// Include latest comments widget
require_once(get_template_directory() . '/functions/widget-latest-comments.php');

// Include latest comments widget
require_once(get_template_directory() . '/functions/widget-tags.php');

// Include latest comments widget
require_once(get_template_directory() . '/functions/widget-twitter.php');

// Include title widget
require_once(get_template_directory() . '/functions/widget-title.php');





// Include breadcrumbs
require_once(get_template_directory() . '/functions/breadcrumbs.php');

// Include pagenavi
require_once( get_template_directory() . '/functions/wp-pagenavi.php' );

// Include resize script
require_once(get_template_directory() . '/functions/mr-image-resize.php');




// Include admin pro panel
require_once(TEMPLATEPATH . '/admin/admin-functions.php');
require_once(TEMPLATEPATH . '/admin/admin-interface.php');
require_once(TEMPLATEPATH . '/admin/theme-settings.php');

// Load post options
require_once(TEMPLATEPATH . '/functions/post-options.php');

// Register sidebars
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Left Sidebar',
		'id' => 'left-sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="left-c-lbl">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name' => 'Right Sidebar',
		'id' => 'right-sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="page-lbl">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name' => 'Footer Column 1',
		'id' => 'footer-column-one',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="content-footer-lbl">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name' => 'Footer Column 2',
		'id' => 'footer-column-two',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="content-footer-lbl">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name' => 'Footer Column 3',
		'id' => 'footer-column-three',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="content-footer-lbl">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default-sidebar-template',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => 'BuddyPress Sidebar',
		'id' => 'buddypress-sidebar-template',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	/*register_sidebar(array(
		'name' => 'bbPress Sidebar',
		'id' => 'bbpress-sidebar-template',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));*/
	register_sidebar(array(
		'name' => 'Contact Form',
		'id' => 'contact-form-template',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
}


if ( !function_exists( 'royalnews_comment' ) ) :
	function royalnews_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
?>

	<!-- the comment -->
	<li>
		<div class="comment-item" id="comment-<?php comment_ID(); ?>">
			<div class="comment-l"><?php echo str_replace('avatar ','',get_avatar( $comment, $size='61' )); ?></div>
			
			<div class="comment-r">
				<div class="comment-user"><?php echo get_comment_author_link(); ?></div>
				<div class="comment-date"><?php echo get_comment_date('M d, Y'); ?></div>
				<div class="comment-txt"><?php comment_text(); ?></div>
				<?php comment_reply_link( array_merge( $args, array( 'class' => 'comment-btn', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<div class="clear"></div>
		</div>
<?php
	}
endif;

function comment_form_theme( $args = array(), $post_id = null ) {
	global $user_identity, $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields =  array(
	
			
		'author' => '
			<div class="form-line">
                <label>'.__('Name','royalnews').' <b>'.($req ? '*' : '').'</b></label>
                <input type="text" class="req" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
            </div>
			',
		'email' => '
			<div class="form-line">
                <label>'.__('Email','royalnews').' <b>'.($req ? '*' : '').'</b></label>
                <input type="text" class="req" id="email" name="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
            </div>
			',
		'url' => '
			<div class="form-line">
                <label>'.__('Website','royalnews').'</label>
                <input type="text" class="req" id="url" name="url" value="' .  esc_attr( $commenter['comment_author_url'] ) . '" />
            </div>
			'
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '
			  <div class="form-line">
				<label>Comment <b>*</b></label>
				<textarea cols="1" rows="1" id="comment" name="comment" class="req"></textarea>
			  </div>
		',				
		'must_log_in'          => '<p style="margin-left:0px;">' .  sprintf( __( "You must be <a href='%s'>logged in</a> to post a comment.", 'royalnews' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p style="margin-left:0px;">' . sprintf( __( "Logged in as <a href='%1'>%2</a>. <a href='%3' title='Log out of this account'>Log out?</a><br /><br />", 'royalnews' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'id_form'              => 'cont_form',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave Comment','royalnews' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'royalnews' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'royalnews' ),
		'label_submit'         => __( 'Post Comment', 'royalnews' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<!-- end comments -->

			<!-- comment form -->
			<div class="block_leave_comment" id="respond">
				<div class="comments-lbl"><?php _e('Leave Comment','royalnews'); ?></div>
				
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<div class="form">
						<form class="w_validation" action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo $args['comment_notes_before']; ?>
								<?php
									do_action( 'comment_form_before_fields' );
									foreach ( (array) $args['fields'] as $name => $field ) {
										echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
									}
									do_action( 'comment_form_after_fields' );
								?>
							<?php endif; ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							
							<input type="submit" class="form-submit" value="<?php _e('Submit Comment','royalnews'); ?>"> <?php echo str_replace('<a','<a class="comment-btn cancel"',get_cancel_comment_reply_link( $args['cancel_reply_link'] )); ?>

							<?php comment_id_fields(); ?>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
					</div>
				<?php endif; ?>
			</div><!---/ comment form -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}


require_once dirname( __FILE__ ) . '/functions/class-tgm-plugin-activation.php';
if( ! defined('THEMENAME' ) ) { define( 'THEMENAME', 'royalnews' ); }

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Multi Image Upload', // The plugin name
			'slug'     				=> 'multi-image-upload', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/functions/plugins/multi-image-upload.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'                      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'                    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'                          => '', // If set, overrides default API URL and points to an external URL
		)
	);
	
	$config = array(
		'domain'                        => 'royalnews',         	// Text domain - likely want to be the same as your theme.
		'default_path'                  => '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug'              => 'themes.php', 				// Default parent menu slug
		'parent_url_slug'               => 'themes.php', 				// Default parent URL slug
		'menu'                          => 'install-required-plugins', 	// Menu slug
		'has_notices'                   => true,                       	// Show admin notices or not
		'is_automatic'                  => false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'                       => array(
			'page_title'                       	=> __( 'Install Required Plugins', 'royalnews' ),
			'menu_title'                       	=> __( 'Install Plugins', 'royalnews' ),
			'installing'                       	=> __( 'Installing Plugin: %s', 'royalnews' ), // %1$s = plugin name
			'oops'                             	=> __( 'Something went wrong with the plugin API.', 'royalnews' ),
			'notice_can_install_required'     	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  		=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 			=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 				=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           	=> __( 'Return to Required Plugins Installer', 'royalnews' ),
			'plugin_activated'                 	=> __( 'Plugin activated successfully.', 'royalnews' ),
			'complete' 				=> __( 'All plugins installed and activated successfully. %s', 'royalnews' ), // %1$s = dashboard link
			'nag_type'				=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
    );

	tgmpa( $plugins, $config );

}


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/functions/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'my_theme_register_js_composer_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_js_composer_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'			=> 'WPBakery Visual Composer', // The plugin name
            'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
            'source'			=> get_stylesheet_directory() . '/functions/plugins/js_composer.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        )
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'		=> 'royalnews', // Text domain - likely want to be the same as your theme.
        'default_path'		=> '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug'	=> 'themes.php', // Default parent menu slug
        'parent_url_slug'	=> 'themes.php', // Default parent URL slug
        'menu'			=> 'install-required-plugins', // Menu slug
        'has_notices'		=> true, // Show admin notices or not
        'is_automatic'		=> false, // Automatically activate plugins after installation or not
        'message'		=> '', // Message to output right before the plugins table
        'strings'		=> array(
            'page_title'			=> __( 'Install Required Plugins', 'royalnews' ),
            'menu_title'			=> __( 'Install Plugins', 'royalnews' ),
            'installing'			=> __( 'Installing Plugin: %s', 'royalnews' ), // %1$s = plugin name
            'oops'				=> __( 'Something went wrong with the plugin API.', 'royalnews' ),
            'notice_can_install_required'	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'		=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'		=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'		=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'				=> __( 'Return to Required Plugins Installer', 'royalnews' ),
            'plugin_activated'			=> __( 'Plugin activated successfully.', 'royalnews' ),
            'complete'				=> __( 'All plugins installed and activated successfully. %s', 'royalnews' ), // %1$s = dashboard link
            'nag_type'				=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa( $plugins, $config );
}
 
/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'your_prefix_vcSetAsTheme' );
function your_prefix_vcSetAsTheme() {
	vc_set_as_theme();
}



add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
function deregister_cf7_styles() {
    if ( !is_page('contact-us') ) {
        wp_deregister_style( 'contact-form-7' );
    }
}

// Add specific CSS class to body by filter
add_filter('body_class','my_body_class_class_names');
function my_body_class_class_names($classes) {
	// add 'class-name' to the $classes array
	unset($classes);
	$classes[] = 'custom-background';
	
	global $wlm_shortname;
	//$theme_background = get_option($wlm_shortname."_theme_background");
	//$classes[] = ($theme_background == 'Boxed') ? 'theme_layout_boxed' : '';
	
	// return the $classes array
	return $classes;
}


function wlm_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'royalnews' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wlm_wp_title', 10, 2 );


//add menu_order into posts options
function post_menu_order_add() {
	add_post_type_support('post', 'page-attributes');
}
add_action('init', 'post_menu_order_add');



/*add extra inputs for user profile*/
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Extra profile information','royalnews'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter"><?php _e('Facebook','royalnews'); ?></label></th>
			<td>
				<input type="text" name="user_facebook" id="user_facebook" value="<?php echo esc_attr( get_the_author_meta( 'user_facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Facebook URL.','royalnews'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e('Twitter','royalnews'); ?></label></th>
			<td>
				<input type="text" name="user_twitter" id="user_twitter" value="<?php echo esc_attr( get_the_author_meta( 'user_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Twitter URL.','royalnews'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e('Vimeo','royalnews'); ?></label></th>
			<td>
				<input type="text" name="user_vimeo" id="user_vimeo" value="<?php echo esc_attr( get_the_author_meta( 'user_vimeo', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Vimeo URL.','royalnews'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e('Google+','royalnews'); ?></label></th>
			<td>
				<input type="text" name="user_gplus" id="user_gplus" value="<?php echo esc_attr( get_the_author_meta( 'user_gplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Google+ URL.','royalnews'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e('RSS','royalnews'); ?></label></th>
			<td>
				<input type="text" name="user_rss" id="user_rss" value="<?php echo esc_attr( get_the_author_meta( 'user_rss', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your RSS URL.','royalnews'); ?></span>
			</td>
		</tr>
	</table>
<?php }
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
	update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
	update_user_meta( $user_id, 'user_vimeo', $_POST['user_vimeo'] );
	update_user_meta( $user_id, 'user_gplus', $_POST['user_gplus'] );
	update_user_meta( $user_id, 'user_rss', $_POST['user_rss'] );
}


function get_related_news($post_id, $blog_related_count) {
	$args = '';
	$args = wp_parse_args($args, array(
		'showposts' => $blog_related_count,
		'post__not_in' => array($post_id),
		'ignore_sticky_posts' => 1,
        'category__in' => wp_get_post_categories($post_id),
		'orderby' => 'rand'
	));
	$query_posts = new WP_Query($args);
  	return $query_posts;
}


/* Add menu sepparators in admin dashboard */
function admin_dashboard_separators() {
   echo '<style type="text/css">
   		#adminmenu li.wp-menu-separator {margin: 0;}
   		.admin-color-fresh #adminmenu li.wp-menu-separator {background: #444;}
   		.admin-color-midnight #adminmenu li.wp-menu-separator {background: #4a5258;}
   		.admin-color-light #adminmenu li.wp-menu-separator {background: #c2c2c2;}
   		.admin-color-blue #adminmenu li.wp-menu-separator {background: #3c85a0;}
   		.admin-color-coffee #adminmenu li.wp-menu-separator {background: #83766d;}
   		.admin-color-ectoplasm #adminmenu li.wp-menu-separator {background: #715d8d;}
   		.admin-color-ocean #adminmenu li.wp-menu-separator {background: #8ca8af;}
   		.admin-color-sunrise #adminmenu li.wp-menu-separator {background: #a43d39;}
         </style>';
}
add_action( 'admin_head', 'admin_dashboard_separators' );



/*-----------------------------------------------------------------------------------*/
/* File Uploading
/*-----------------------------------------------------------------------------------*/

function siteoptions_uploader_function($id,$std,$mod){

	$uploader = '';
    $upload = get_option($id);
	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="of-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n";

return $uploader;
}


// add class attribute to next_posts_link/previous_posts_link
function next_ant_add_class($format){
  $format = str_replace('href=', 'class="post-controls-next" href=', $format);
  $format = str_replace('</a>', '</span></a>', $format);
  return $format;
}
function prev_ant_add_class($format){
  $format = str_replace('href=', 'class="post-controls-prev" href=', $format);
  $format = str_replace('</a>', '</span></a>', $format);
  return $format;
}
add_filter('next_post_link', 'next_ant_add_class');
add_filter('previous_post_link', 'prev_ant_add_class');

add_filter('bp_activity_do_mentions', '__return_false');

// Adding Shortcodes to the_excerpt() function
add_filter('the_excerpt', 'do_shortcode');
// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');
?>