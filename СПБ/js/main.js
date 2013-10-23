$(document).ready(function () {
	$("#main-carousel").carouFredSel({
		width: 960,
		height: 353,
		items: {
			visible: 1,
			width: 960,
			height: 353
		},
		scroll: 1,
		auto: false,
		prev: ".main-carousel #prev",
		next: ".main-carousel #next",
		pagination: ".main-carousel .pagination"
	});
	$(".menu #mini-carousel").carouFredSel({
		width: 346,
		height: 255,
		items: {
			visible: 1,
			minimum: 1,
			width: 346,
			height: 255
		},
		scroll: 1,
		auto: false,
		pagination: ".menu .pagination"
	});
	$(".action #mini-carousel").carouFredSel({
		width: 360,
		height: 261,
		items: {
			visible: 1,
			minimum: 1,
			width: 360,
			height: 261
		},
		scroll: 1,
		auto: false,
		pagination: ".action .pagination"
	});
	$(".calendar #mini-carousel").carouFredSel({
		width: 360,
		height: 200,
		items: {
			visible: 1,
			minimum: 1,
			width: 360,
			height: 200
		},
		scroll: 1,
		auto: false,
		pagination: ".calendar .pagination"
	});
	$(".photo #mini-carousel").carouFredSel({
		width: 357,
		height: 207,
		items: {
			visible: 1,
			minimum: 1,
			width: 357,
			height: 207
		},
		scroll: 1,
		auto: false,
		pagination: ".photo .pagination"
	});
});

$(window).load(function() {
	$("#reviews").carouFredSel({
		width: 242,
		height: "auto",
		items: {
			visible: 1,
			minimum: 1,
			width: 242,
			height: "variable"
		},
		scroll: 1,
		auto: false,
		prev: ".reviews .prev",
		next: ".reviews .next"
	});
});

$("#promo-block .item").click(function(){
	if ( $(this).hasClass('active') ) {
		/*$(this).animate({
			width: 140
		}, function (){
			$(this).removeClass('active');
		});
		$(this).children().children().children(".flag").transition({
			rotate: -90,
			left: -13,
			top: -3
		}, 500);*/
	} else {
		$("#promo-block .active").animate({
			width: 140
		}, function (){
			$("#promo-block .item").removeClass('active');
		});
		$("#promo-block .active .flag").transition({
			rotate: -90,
			left: -15,
			top: -3
		}, 500);
		$(this).animate({
			width: 400
		}, function(){
			$(this).addClass('active');
		});
		$(this).find(".flag").transition({
			rotate: 0,
			left: -10,
			top: 38
		}, 500);
	}
});