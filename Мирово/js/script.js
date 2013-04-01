$(document).ready(function(){
	Cufon.set('fontFamily','PF Agora Serif Pro');
	Cufon.replace('.header .phone .block .code');
	Cufon.replace('.header .phone .block .tel');
	Cufon.replace('.body .carousel ul li span');
	Cufon.replace('.body h2');
	Cufon.replace('.block-info .promo .block .item .title');
	Cufon.replace('.footer .slogan');
	Cufon.replace('.block-contacts .schedule .phone');
	Cufon.replace('.block-contacts .schedule .adress');
	Cufon.replace('.block-contacts .schedule .mail');
	Cufon.replace('.block-about .block-text .block .link a');
	Cufon.replace('.body .block-write .block .info h4', { fontWeight: 'normal'});
	Cufon.set('fontFamily','PF Monumenta Pro');
	Cufon.replace('.body .block-contacts h3');
	Cufon.replace('.block-about .block-text .block h3');
	Cufon.replace('.body .block-partner h3');
	Cufon.replace('.block-gallery .block-img .block h3');
	Cufon.replace('.body .block-write h3');
});
$(function() {
	$("#carousel").carouFredSel({
		width: 1000,
		height: 352,
		items: {
			width: 1000,
			height: 352
		},
		auto: {
			fx: "crossfade",
			duration: 800
		}
	});
});
$(function() {
	$("#carousel-gallery").carouFredSel({
		width: 1000,
		height: 534,
		items: {
			width: 1000,
			height: 534
		},
		auto : false,
		prev: {
			button	: "#carousel-gallery-prev",
			key		: "left"
		},
		next: {
			button	: "#carousel-gallery-next",
			key		: "right"
		}
	});

	$("#arrow-hide").click(function(){
		$(".block-img").animate({
			right: "-368px"
		}, function(){
			$(".block-img").addClass('background-none');
			$("#arrow-hide").hide();
			$("#arrow-show").show();
		})
	});
	$("#arrow-show").click(function(){
		$(".block-img").animate({
			right: "0px"
		}, function(){
			$("#arrow-show").hide();
			$("#arrow-hide").show();
		});
		$(".block-img").removeClass('background-none');
	});
});