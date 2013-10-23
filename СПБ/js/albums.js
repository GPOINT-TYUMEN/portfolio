$(document).ready(function () {
	$("#carousel-album").carouFredSel({
		width: 820,
		height: 390,
		items: {
			visible: 1,
			minimum: 1,
			width: 820,
			height: 390
		},
		scroll: 1,
		auto: false,
		prev: ".carousel-album .prev",
		next: ".carousel-album .next",
		pagination: ".carousel-album .pagination"
	});
});
