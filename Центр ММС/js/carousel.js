$(document).ready(function() {
	$("#carousel").carouFredSel({
		width: 750,
		height: 500,
		items: {
			visible: 1,
			minimum: 1,
			width: 750,
			height: 500
		},
		scroll: 1,
		auto: false,
		pagination: {
			container: "#thumbnails",
			anchorBuilder: function(nr) {
				var src = $("img", this).attr("src");
					src = src.replace("/large/", "/small/");
				return '<img src="' + src +'" />'
			}
		}
	});
})
