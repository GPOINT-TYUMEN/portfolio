$(document).ready(function() {
	$('select').styler();
})

$(window).load(function() {
	$(".registration").click(function() {
		$(this).hide();
		$(".active").show();
		$("#block").show();
		$("#block").css({
			height: 0
		});
		$("#block").animate({
			height: '1600px',
		}, 1000, function() {
			$("#block").css({
				height: "100%"
			});
		});
	});
	

	$("input[name$='doc']").click(function(){
	
		var radio_value = $(this).val();
		
		if(radio_value=='yes') {
			$("#doc").show();
		}
		else if(radio_value=='no') {
			$("#doc").hide();
		}
	});
	
	$("input[name$='exhibition']").click(function(){
	
		var radio_value = $(this).val();
		
		if(radio_value=='yes') {
			$("#exhibition").show();
		}
		else if(radio_value=='no') {
			$("#exhibition").hide();
		}
	});
	
	$("input[name$='hotel']").click(function(){
	
		var radio_value = $(this).val();
		
		if(radio_value=='yes') {
			$("#hotel").show();
		}
		else if(radio_value=='no') {
			$("#hotel").hide();
		}
	});
	
	$(".tabs a").click(function() {
		$(".tabs .item").toggleClass("active");
	});

})