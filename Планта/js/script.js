$(document).ready(function(){
	$(".block-city .city").click(function(){
		$(".block-city .popup").show();
	});
	$(".block-city .popup a").click(function(){
		$(".block-city .popup").hide();
	});
	$(".main-menu ul li.catalog a").click(function(){
		$(".main-menu ul .popup").show();
	});
	$(".main-menu ul .popup .title a").click(function(){
		$(".main-menu ul .popup").hide();
	});
	$(".block-search .category span").click(function(){
		$(".block-search .category .popup").show();
	});
	$(".block-search .category .popup a").click(function(){
		$(".block-search .category .popup").hide();
	});
});