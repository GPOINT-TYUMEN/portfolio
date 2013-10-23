$(document).ready(function(){
	$("#carousel").carouFredSel({
	width: "100%",
	items: {
		visible: 1,
		minimum: 1,
		width: 1024,
		height: "39%"
	},
	responsive: true,
	scroll: 1,
	auto: false,
	pagination: ".carousel .pagination"
});
})