$(document).ready(function() {
	$("input, select").styler();

	$("#slider").slider({
		range: "max",
		min: 1,
		max: 760,
		value: 152
	});
})
