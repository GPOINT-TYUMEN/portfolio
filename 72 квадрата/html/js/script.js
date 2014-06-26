$(document).ready(function(){
	$("#show").hide();
	$("#button-top").hide(function(){
		$("#button-top").empty();
	});
	$("#hide").click(function(){
		$("#top-line").hide();
		$("#hide").hide();
		$("#show").show();
		$(".block-form").animate({ "height": "69px" }, "slow", function(){
				$("#button-top").html("<button type='submit'><i></i>Найти</button>");
				$("#button-top").show();
			});
		});
	$("#show").click(function(){
		$("#top-line").show();
		$("#show").hide();
		$(".block-form").animate({ "height": "100%" }, "slow", function(){
			$("#hide").show();
			$("#button-bottom").html("<button type='submit'><i></i>Найти предложения</button>")
		});
		$("#button-top").empty(function(){
			$("#button-top").hide();
		});
	});
	if ($('#filter-enterprises').length) $('#filter-enterprises').containedStickyScroll();
	$('#districs label:nth-child(n+5)').hide();
	$('#additional-districs').click(function(){
		$('#districs label:nth-child(n+5)').show();
		$(this).hide();
		return false;
	});
	if ($('#YMapsID-4650').length) {
		if (! $('#block-images').length) {
			$('#map').addClass('map-side');
		}
	}
	$('#del-photo').click(function(){
		$('#accept').show();
		return false;
	});
});