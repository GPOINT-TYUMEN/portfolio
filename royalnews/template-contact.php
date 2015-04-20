<?php
/*
Template Name: Contact
*/
get_header();
?>

<?php if (get_option($wlm_shortname."_google_map") == 'true') { ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/infobox.js" type="text/javascript"></script>
<script type="text/javascript">
	function initialize() {
	  var myLatlng = new google.maps.LatLng(<?php echo get_option($wlm_shortname."_google_map_lat"); ?>, <?php echo get_option($wlm_shortname."_google_map_lng"); ?>);
	  var mapOptions = {
		zoom: 11,
		center: myLatlng
	  };

	  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	  var image = new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/img/lp.png',
	  new google.maps.Size(45, 52),
			new google.maps.Point(0,0),
			new google.maps.Point(0, 32));

	  var marker = new google.maps.Marker({
			 map: map,
			 draggable: true,
			 icon: image, 
			 position: new google.maps.LatLng(<?php echo get_option($wlm_shortname."_google_map_lat"); ?>, <?php echo get_option($wlm_shortname."_google_map_lng"); ?>),
			 visible: true
			});

			var boxText = document.createElement("div");
			boxText.style.cssText = "margin-top: 8px; background:#fff; padding: 10px 10px 10px 10px; border-radius:4px; -moz-border-radius:4px; -webkit-border-radius:4px; -webkit-box-shadow: 0px 0px 4px rgba(50, 50, 50, 0.19); -moz-box-shadow: 0px 0px 4px rgba(50, 50, 50, 0.19); box-shadow: 0px 0px 4px rgba(50, 50, 50, 0.19);";
			boxText.innerHTML = "<div class='infoBoxLabel'><?php _e('Contact info:','royalnews'); ?></div><div class='infoBoxTxt'><?php echo get_option($wlm_shortname."_contact_info"); ?></div>";

			var Options = {
				 content: boxText
				,disableAutoPan: false
				,maxWidth: 0
				,pixelOffset: new google.maps.Size(56, -48)
				,zIndex: null
				,boxStyle: {
				  background: "url('tipbox.gif') no-repeat"
				  ,width: "211px"
				  ,height: "61px"
				}
				,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
				,infoBoxClearance: new google.maps.Size(1, 1)
				,isHidden: false
				,pane: "floatPane"
				,enableEventPropagation: false
			};

			var ib = new InfoBox(Options);
			ib.open(map, marker);
	}
	google.maps.event.addDomListener(window, 'resize', initialize);
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php } ?>

          <header class="page-heading">
            <div class="label-a"><?php the_title(); ?></div>
            <div class="breadcrumbs">
              <a href="<?php echo home_url(); ?>"><?php _e('Home','royalnews'); ?></a> <?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
            </div>
            <div class="clear"></div>
          </header>
          
          <!-- // category content start // -->
          <section class="category-page full-width-post">
            <article class="category-page-text">
			    <?php if (get_option($wlm_shortname."_google_map") == 'true') { ?>
				<div class="contact-map">
					<div id="map-canvas"></div>
			    </div>
			    <?php } ?>
				<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile; // end of the loop.
				?>
            </article>
            
            <section class="contact-form">
				<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Contact Form')) : ?>
					<div class="comments-lbl"><?php _e('Send Message','royalnews'); ?></div>
					<form id="contact_form" method="post" action="<?php echo get_template_directory_uri(); ?>/functions/contact_form.php">
						 <div class="form">
						  <div class="form-line">
							<label><?php _e('Name','royalnews'); ?> <b>*</b></label>
							<input type="text" id="User" name="User" value="" class="req" />
						  </div>
						  <div class="form-line">
							<label><?php _e('Email','royalnews'); ?> <b>*</b></label>
							<input type="text" id="Email" name="Email" value="" class="req" />
						  </div>
						  <div class="form-line nth">
							<label><?php _e('Subject','royalnews'); ?></label>
							<input type="text" id="Subject" name="Subject" value="" />
						  </div>
						  <div class="clear"></div>
						  <div class="form-line textarea">
							<label><?php _e('Comment','royalnews'); ?> <b>*</b></label>
							<textarea cols="1" rows="1" id="Comment" name="Comment" class="req"></textarea>
						  </div>
						  <div class="clear"></div>
						  <button class="form-submit"><?php _e('Send message','royalnews'); ?></button>
						 </div>
					</form>
					<script type="text/javascript">
						jQuery(function () {
							jQuery('#contact_form').ajaxForm({
								beforeSubmit : function() {return init_validation('#contact_form');},
								success : function() {
									alert('<?php _e('Your message has been sent!','royalnews'); ?>');
									jQuery('#contact_form').resetForm();
								}
							});
						});
					</script>
				<?php endif; ?>
            </section>
                         
            <div class="clear"></div>
          </section>
          <!-- // category content end // -->  
        </div>
		
<?php get_footer(); ?>