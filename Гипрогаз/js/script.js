$(document).ready(function(){
	$(".header .links span a.dotted").click(function(){
		$(".header .popup").show();
	});
	$(".header .popup a.close").click(function(){
		$(".header .popup").hide();
	});
	$(".header .popup a.dotted").click(function(){
		$(".header .popup").hide();
	});
	$(".block-news sup a.dotted").click(function(){
		$(".block-news .popup").show();
	});
	$(".block-news .popup a.close").click(function(){
		$(".block-news .popup").hide();
	});
});
