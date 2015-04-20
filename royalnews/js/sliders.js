jQuery(document).ready(function() {
	jQuery('.flexslider').flexslider({
	  animation: "fade",
	  slideshow: false
	});
});

setTimeout(function() {  
	jQuery(function(){
	  jQuery('#popular-slider').bxSlider({
		slideWidth: 287,
		speed: 1200,
		pause: 6500,
		minSlides: 1,
		maxSlides: 3,
		moveSlides: 2,
		auto: true,
		slideMargin: 19      
	  });
	});
	jQuery(function(){
	  jQuery('.article-slider-a').bxSlider({
		speed: 600,
		minSlides: 1,
		maxSlides: 1,
		moveSlides: 1,
		auto: false,
		slideMargin: 0     
	  });
	});   
},150);