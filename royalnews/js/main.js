function init_blog() {
  jQuery('.articles-row').isotope({
    itemSelector : '.post'
  });
  jQuery(window).resize(function() {
  
    setTimeout(function() { 
     jQuery('.articles-row').isotope('reLayout');
     },150);
  });
}	

function init_button_more() {
	jQuery('#more-posts').bind('click', function(e) {
		var target = jQuery(this).attr('data-target');
		var container = jQuery(target);

		var content = jQuery('.articles-post',container).clone(); //instead of this do ajax request and get new elements, this line only for demo
		
		jQuery(target).isotope('insert', content);
		
		//init_pretty_photo();
		e.preventDefault();
	});
}

//jQuery(window).live('resize', function(){
jQuery(function() {
	//setTimeout(function() {
		if( jQuery(window).width()<1330 ) {
			jQuery('body').addClass('resize-a');
		} else {
		   jQuery('body').removeClass('resize-a');
		}
		if( jQuery(window).width()<1105 ) {
			jQuery('body').removeClass('resize-a');
			jQuery('body').addClass('resize-b');
		} else {
		   jQuery('body').removeClass('resize-b');
		}  
		if( jQuery(window).width()<780 ) {
			jQuery('body').removeClass('resize-a');
			jQuery('body').addClass('resize-c');
		} else {
		   jQuery('body').removeClass('resize-c');
		} 
		if( jQuery(window).width()<440 ) {   
			jQuery('body').addClass('resize-d');
		} else {
		   jQuery('body').removeClass('resize-d');
		}
	//},100);	
});

jQuery(window).trigger('resize');
jQuery(window).bind('resize', function() {
	//setTimeout(function() {
		if( jQuery(window).width()<1330 ) {
			jQuery('body').addClass('resize-a'); 
			
		} else {
		   jQuery('body').removeClass('resize-a');
		} 
		if( jQuery(window).width()<1124 ) {
			jQuery('body').removeClass('resize-a');
			jQuery('body').addClass('resize-b');
			jQuery('.left-c-menu').eq('0').css('border-top','0px');
			jQuery('.left-col').removeClass('small-menu');
		} else {
		   jQuery('body').removeClass('resize-b');
		   jQuery('.left-c-menu').eq('0').css('border-top','1px solid #3d3d3d');
		   
		} 
		if( jQuery(window).width()<780 ) {   
			jQuery('body').addClass('resize-c');
		} else {
		   jQuery('body').removeClass('resize-c');
		} 
		if( jQuery(window).width()<440 ) {   
			jQuery('body').addClass('resize-d');
		} else {
		   jQuery('body').removeClass('resize-d');
		}
    //},100);
});

function init_validation(target) {
	function validate(target) {
		var valid = true;
		jQuery(target).find('.req').each(function() {
			if(jQuery(this).val() == '') {
				valid = false;
				jQuery(this).addClass('errored');
			}
			else {
				jQuery(this).removeClass('errored');
			}
		});
		return valid;
	}
	
	jQuery('form.w_validation').live('submit', function(e) {
		var valid = validate(this);
		if(!valid) e.preventDefault();
	});
	
	if(target) {return validate(target);}
}


	//jQuery(document).on('click','li.menu-item a', function(){
	jQuery('#menu-all-pages a').bind('click', function() {
		jQuery(".nano").nanoScroller({ destroy: true });
		setTimeout(function(){
			jQuery(".nano").nanoScroller();	
		},500);
	});
	
	
	
jQuery(document).ready(function(){
	"use strict";
	
	init_validation();

	//call the nanoScroller script for scrolling effect on left sidebar
	jQuery('.nano').nanoScroller();
	
	jQuery('.left-c-menu  .menu-item:has(.sub-menu)').children('a').toggle(
		function() {
			jQuery(this).parent('.menu-item').children('.sub-menu').show(350);
		}, function() {
			jQuery(this).parent('.menu-item').children('.sub-menu').hide(350);
		}
	); 
  
  
  
	jQuery('.page-header-search input:text').focus(function(){
		var $value = jQuery(this).attr('value');
		if ( $value=='Search the site...' ) {
		  jQuery('.page-header-search input:text').attr('value','');    
		}
	});
  
	jQuery('.page-header-search input:text').blur(function(){
		var $value = jQuery(this).attr('value');
		if ( $value=='' ) {
		  jQuery('.page-header-search input:text').attr('value','Search the site...');    
		}
	});
  
	jQuery('.newsletter input:text').focus(function(){
		var $value = jQuery(this).attr('value');
		if ( $value=='ENTER YOUR EMAIL' ) {
		  jQuery('.newsletter input:text').attr('value','');    
		}
	});
  
  jQuery('.newsletter input:text').blur(function(){
    var $value = jQuery(this).attr('value');
    if ( $value=='' ) {
      jQuery('.newsletter input:text').attr('value','ENTER YOUR EMAIL');    
    }
  });  
  
	if (typeof ajax_load_parameters !== "undefined") {
		var pageNum = parseInt(ajax_load_parameters.startPage);
		var categoryID = parseInt(ajax_load_parameters.categoryID);
		//var postID = parseInt(ajax_load_parameters.postID);
	} else { 
		var pageNum = 10;
	}
  
	jQuery('#more-posts').bind('click', function(e) {
		var files_path = js_load_path.theme_default_path;
		jQuery.ajax({
		  url: files_path+"/posts_col1.php?&pagenum="+pageNum+"&categoryid="+categoryID,
		  cache: false,
		  success: function(html){
			jQuery(".load-content").eq('0').append(html);
		  }
		});
		jQuery.ajax({
		  url: files_path+"/posts_col2.php?&pagenum="+pageNum+"&categoryid="+categoryID,
		  cache: false,
		  success: function(html){
			jQuery(".load-content").eq('1').append(html);
		  }
		});
		jQuery.ajax({
		  url: files_path+"/posts_col3.php?&pagenum="+pageNum+"&categoryid="+categoryID,
		  cache: false,
		  success: function(html){
			jQuery(".load-content").eq('2').append(html);
		  }
		});
		pageNum = pageNum + 3;
		e.preventDefault();
	});

	jQuery('.article-image').hover(
		function() {
		if ( jQuery(this).closest('div').is('.flexslider') ) {
		} else {
		  jQuery(this).animate({
			  opacity: '0.8'
			}, 200);    
		}     
		}, function() {
		  if ( jQuery(this).closest('div').is('.flexslider') ) {
		  } else {
		  jQuery(this).animate({
			  opacity: '1'
			}, 200);
		  }  
		}
	);
  
	jQuery('.recent-img img').hover(
		function() {
		  jQuery(this).animate({
			  opacity: '0.8'
			}, 200);
		}, function() {
		  jQuery(this).animate({
			  opacity: '1'
			}, 200);
		}
	);
  
	jQuery('.main-news-i').hover(
		function() {
		if ( jQuery('body').is('.resize-d') ) {

		} else {
		jQuery(this).find('.post-num').animate({
			  top: '15px'
			}, 350);
		jQuery(this).find('.post-border').animate({
			  top: '15px'
			}, 400);    
		}
		}, function() {
		jQuery(this).find('.post-num').animate({
			  top: '-20px'
			}, 350);
		jQuery(this).find('.post-border').animate({
			  top: '0px'
			}, 400);    
		}
	);

	jQuery('.l-menu-open').click(function(){
		jQuery('.left-col').animate({
				width: '241px'
			}, 300, function(){
				jQuery('.left-col').addClass('small-menu');
			}); 
		jQuery('.left-c-menu').eq('0').css('border-top','0px');
		return false;
	});
  
	jQuery('.l-menu-hide').click(function(){
	   jQuery('.left-col').removeClass('small-menu');
	   
	   if (jQuery('body').is('.resize-c')) {
			jQuery('.left-col').animate({
				width: '69px'
			}, 300);   
	   } else {
			jQuery('.left-col').animate({
				width: '92px'
			}, 300);
	   }         
		return false;
	});

	jQuery('.tabs-i').click(function(){
		var $index = jQuery(this).index();
		jQuery('.tabs-i').removeClass('active').eq($index).addClass('active');
		jQuery('.tabs-content').hide().eq($index).fadeIn();
	});


	jQuery('.has-child>a').click(function(){
		var $parent = jQuery(this).closest('.has-child');
		if ( jQuery(this).is('.open') ) {
		  jQuery(this).removeClass('open');
		  $parent.find('ul').slideUp();      
		} else {
		  jQuery(this).addClass('open');
		  $parent.find('ul').slideDown();    
		}
		return false;
	});

	setTimeout(function() {
		jQuery('.image-slider').each(function(){
		  var $length = jQuery(this).find('.bx-pager-item').length;
		  jQuery(this).find('.image-slider-total').text($length);
		}); 
			
		jQuery('.image-slider .bx-next,.image-slider .bx-prev').on('click', function(){
		  var $parent = jQuery(this).closest('.image-slider');
		  var $current = $parent.find('.bx-pager a.active').data('slide-index');
		  $parent.find('.image-slider-current').text($current+1);
		});
	},150);
  
	jQuery(".articles-post,.search-results-i").live('mouseenter', function() { 
		jQuery(this).find('.post-info,.flex-prev,.flex-next').stop().fadeIn('fast');
	}).live('mouseleave', function () {
		jQuery(this).find('.post-info,.flex-next,.flex-prev').stop().hide();
	});
  
	jQuery(document).scroll(function(){
		jQuery('.per-item').each(function(){
		  var $parent = jQuery(this);
		  var $value = $parent.find('.per-item-data').text();
		  var $slider = $parent.find('.per-item-b-value');   
		  if (jQuery(this).is('.animated')) {
			if ($slider.is(':in-viewport')) {
			  $slider.animate({
				width: $value+'%'
			  }, 2500);    
			}    
		  } else {
			$slider.width($value+'%');
		  }
		});
	});

	jQuery(window).on('load ready resize', function(){
		//setTimeout(function() {
			if ( jQuery('body').is('.custom-background') ) {
				jQuery('.left-col').css('width','241px');
			}
			if ( jQuery('body').is('.resize-a') ) {
				jQuery('.left-col').css('width','241px');
			}
			if ( jQuery('body').is('.resize-b') ) {
				jQuery('.left-col').css('width','92px');
			}  
			if ( jQuery('body').is('.resize-c') ) {
				jQuery('.left-col').css('width','69px');
			}
		//},110);
	});
 
});