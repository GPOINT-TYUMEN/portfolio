$(document).ready(function () {
	$("#carousel-comments").carouFredSel({
		width: 940,
		height: 280,
		items: {
			visible: 1,
			minimum: 1,
			width: 940,
			height: 280
		},
		scroll: 1,
		auto: false,
		prev: ".carousel-comments .prev",
		next: ".carousel-comments .next",
		pagination: ".carousel-comments .pagination"
	});
});
