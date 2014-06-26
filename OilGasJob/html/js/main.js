$(document).ready(function() {
	$("#tabs").tabs();
	$("input, select").styler();

	$("#carousel_logo").carouFredSel({
		direction: "up",
		width: 219,
		height: 299,
		items: {
			visible: 3,
			width: 219,
			height: 100
		},
		scroll: 1,
		auto: false,
		prev: ".carousel_logo_prev",
		next: ".carousel_logo_next"
	});
})
