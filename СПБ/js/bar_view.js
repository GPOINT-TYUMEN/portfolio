$(document).ready(function () {
	$("#carousel-photo").carouFredSel({
		width: 580,
		height: 390,
		items: {
			visible: 1,
			minimum: 1,
			width: 580,
			height: 390
		},
		scroll: {
			onBefore: function(data) {
				$(this).trigger("currentPosition", function(pos) {
					var txt = "<p>" + (pos+1) + " <em>из</em> " + $("> *", this).length + "</p>";
					$("#foo2_log").html(txt);
				});
			}
		},
		auto: false,
		prev: ".carousel-photo .prev",
		next: ".carousel-photo .next"
	});
	var count = $('#carousel-photo .item').size();
	$("#foo2_log").children().append(count);

	$( "#tabs" ).tabs({
		collapsible: true
	});
});

$(window).load(function() {
	$("#carousel-stock").carouFredSel({
		width: 520,
		height: "auto",
		items: {
			visible: 3,
			width: 180,
			height: "variable"
		},
		scroll: 3,
		auto: false,
		pagination: ".stock .pagination"
	});
});

$(".block-photo .tabs .it").click(function() {
	if ( $(this).hasClass("active") ) {
		//ничего не делать
	} else {
		$(".block-photo .tabs .it").removeClass("active");
		$(this).addClass("active");
	}
});