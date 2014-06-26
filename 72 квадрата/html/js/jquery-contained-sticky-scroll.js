(function( $ ){

  $.fn.containedStickyScroll = function( options ) {
  
	var defaults = {  
		oSelector : this.selector,
		unstick : true,
		easing: 'linear',
		duration: 0,
		queue: false,
		closeChar: '^',
		closeTop: 0,
		closeRight: 0  
	}  
                  
	var options =  $.extend(defaults, options);
  
  	jQuery(window).scroll(function() {
  		getObject = options.oSelector;
        if(jQuery(window).scrollTop() > (jQuery(getObject).parent().offset().top) )
        {
			jQuery(getObject).addClass('fixed');
        }
        else {
			jQuery(getObject).removeClass('fixed');
        }
	});

  };
})( jQuery );
