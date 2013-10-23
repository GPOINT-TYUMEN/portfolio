$(document).ready(function () {
	$("#info-block").carouFredSel({
		width: 818,
		height: 388,
		items: {
			visible: 1,
			minimum: 1,
			width: 818,
			height: 388
		},
		scroll: 1,
		auto: false,
		prev: ".info-block .prev",
		next: ".info-block .next"
	});
});
