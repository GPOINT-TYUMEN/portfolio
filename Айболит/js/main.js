$(document).ready(function() {
	$('input, select').styler();
	
	$("#carousel-banner").carouFredSel({
		circular: false,
		infinite: false,
		width: 958,
		height: 330,
		items: {
			visible: 1,
			minimum: 1,
			width: 958,
			height: 330
		},
		scroll: 1,
		auto: false,
		pagination: ".carousel-banner .pagination"
	});
	
	$("#carousel-product").carouFredSel({
		width: 916,
		height: 225,
		items: {
			visible: 4,
			minimum: 4,
			width: 200,
			height: 225
		},
		scroll: 1,
		auto: 3000,
		prev: ".carousel-product .prev",
		next: ".carousel-product .next"
	});
	
	$("#block-partner").carouFredSel({
		width: 916,
		height: 80,
		items: {
			visible: 4,
			minimum: 4,
			width: 230,
			height: 80
		},
		scroll: 1,
		auto: 3000,
		prev: ".block-partner .prev",
		next: ".block-partner .next"
	});
	
	$("#jobs").carouFredSel({
		width: 244,
		height: 250,
		items: {
			visible: 1,
			minimum: 1,
			width: 244,
			height: 250
		},
		scroll: {
			items: 1,
			fx: "fade"
		},
		auto: false,
		next: ".jobs .next"
	});
})
