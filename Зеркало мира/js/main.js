$(document).ready(function() {
	$("#carousel").carouFredSel({
		circular: false,
		infinite: false,
		width: 978,
		height: 462,
		items: {
			visible: 1,
			minimum: 1,
			width: 978,
			height: 462
		},
		scroll: 1,
		auto: false,
		prev: {
			button: ".carousel .prev",
			key: "left"
		},
		next: {
			button: ".carousel .next",
			key: "right"
		}
	});
	$("#carousel-bottom").carouFredSel({
		circular: false,
		infinite: false,
		width: 612,
		height: 431,
		items: {
			visible: 1,
			minimum: 1,
			width: 612,
			height: 431
		},
		scroll: 1,
		auto: 3000,
		prev: ".carousel-bottom .prev",
		next: ".carousel-bottom .next"
	});
	
	$(".review .item .comments").dotdotdot({
		ellipsis: " ..."
	});
})

$(window).load(function(){
	$(".menu a,#carousel a.button").mPageScroll2id({
		scrollSpeed: 1000
	});
	
	$("#content_1").click(function() {
		$(".review .item:nth-child(2) .comments").hide();
		var content = $(".review .item:nth-child(2) .comments").triggerHandler("originalContent");
			$("#foo_1").append(content);
	});
	
	$("#content_2").click(function() {
		$(".review .item:nth-child(3) .comments").hide();
		var content = $(".review .item:nth-child(3) .comments").triggerHandler("originalContent");
			$("#foo_2").append(content);
	});
	
	$("#content_3").click(function() {
		$(".review .item:nth-child(4) .comments").hide();
		var content = $(".review .item:nth-child(4) .comments").triggerHandler("originalContent");
			$("#foo_3").append(content);
	});
});