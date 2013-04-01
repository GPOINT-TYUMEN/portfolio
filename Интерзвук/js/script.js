$(document).ready(function(){
	$("#carousel").carouFredSel({
		width: 940,
		height: 321,
		items: {
			visible: 1,
			minimum: 1,
			width: 940,
			height: 321
		},
		scroll: 1,
		pagination: "#pagination"
	});
	$("#brand").carouFredSel({
		width: 820,
		height: 30,
		items: {
			minimum: 1,
			width: 145,
			height: 30
		},
		scroll: 1,
		next: "#next-brand",
		prev: "#prev-brand"
	});
	$("#view-img").carouFredSel({
		circular: false,
		infinite: false,
		width: 165,
		height: 30,
		items: {
			minimum: 3,
			width: 55,
			height: 30
		},
		scroll: 1,
		auto: false,
		prev: "#prev",
		next: "#next"
	});
});