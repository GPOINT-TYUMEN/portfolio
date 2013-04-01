$(document).ready(function(){
	$("#arrow").toggle(
	function(){
		$(".pop-map").animate({
			top: 0,
		});
	},
	function(){
		$(".pop-map").animate({
			top: -399,
		});
	});


	$("#special").carouFredSel({
		circular: false,
		infinite: false,
		width: 680,
		height: 238,
		items: {
			visible: 1,
			width: 680,
			height: 238
		},
		scroll: 1,
		auto: 5000,
		prev: "#special-prev",
		next: "#special-next",
		pagination: "#special-pag"
	});
});