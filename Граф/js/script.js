$(document).ready(function(){
$("#photo").carouFredSel({
	direction: "up",
	width: 217,
	circular: true,
	infinite: false,
	height: "variable",
	items: {
		visible: 3,
		minimum: 1,
		height: "variable"
	},
	scroll: {
		mousewheel: true,
		items: 1
	}
});
});