$(document).ready(function () {
	$("#menu-carousel").carouFredSel({
		width: 561,
		height: 362,
		items: {
			visible: 1,
			minimum: 1,
			width: 561,
			height: 362
		},
		scroll: 1,
		auto: false,
		prev: ".new-menu-carousel .prev",
		next: ".new-menu-carousel .next",
		pagination: ".new-menu-carousel .pagination"
	});

});

$("#open-menu").click(function(){
	if ( $(".line-menu").hasClass("active") ) {
		$("#more-menu").hide("blind", 1000);
		$("#new-menu-carousel").show("blind", 1000);
		$(".menu-block").animate({
			height: 472
		}, 1000);
		$(".line-menu").removeClass("active");
		$(this).text("Развернуть меню");
	} else {
		$("#more-menu").show("blind", 1000);
		$("#new-menu-carousel").hide("blind", 1000);
		$(".menu-block").animate({
			height: 0
		}, 1000);
		$(".line-menu").addClass("active");
		$(this).text("Свернуть меню");
	}
});

var $scrollingDiv = $("#filter-menu");

$(window).scroll(function() {
	var y = $(this).scrollTop(),
	maxY = $('footer').offset().top,
	scrollHeight = $scrollingDiv.height();
	offset = 34;
	$scrollingDiv.css({height: scrollHeight});
	$scrollingDiv.addClass("fixed");
	if(y<maxY-650){
		$scrollingDiv
		.stop()
		.css({"top": ($(window).scrollTop()+offset) + "px"});
	}
});
