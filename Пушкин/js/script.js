$(document).ready(function(){
	var $menu = $("#menu");
 
	$(window).scroll(function(){
		if ( $(this).scrollTop() > 100 && $menu.hasClass("menu") ){
			$menu.addClass("fixed");
		} else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
			$menu.removeClass("fixed");
		}
	});
});