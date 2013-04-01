$(document).ready(function(){

	$('#show_issuu').click(function(){
		$(this).parent().slideUp(500);
		$('#block_issuu').slideDown(500);
		return false;
	});

	$(".partner-block .item > .img > img").hover(function(){
		$(this).parent().siblings('.popup').show();
	});
	$(".popup > .img > img").mouseout(function(){
		$(this).parents('.popup').hide();
	});
	
});