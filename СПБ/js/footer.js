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

