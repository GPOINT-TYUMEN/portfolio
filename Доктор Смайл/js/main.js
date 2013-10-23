$(document).ready(function(){
	$("#carousel-block").carouFredSel({
		width: 810,
		height: 338,
		items: {
			visible: 1,
			width: 810,
			height: 338
		},
		scroll: 1,
		auto: false,
		prev: ".carousel-block .prev",
		next: ".carousel-block .next"
	});

	$("#info").carouFredSel({
		width: 474,
		height: 220,
		items: {
			visible: 1,
			minimum: 1,
			width: 474,
			height: 220
		},
		scroll: 1,
		auto: false,
		next: ".block-information .more"
	});

	$('input, select').styler();
});
