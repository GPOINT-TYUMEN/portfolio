// animations
function animation_first(){
	$('.animate').show();
	$('.l,.r').fadeIn(1000);
	$('.l-c,.r-c').fadeIn(1100);
	$('.l,.r').fadeOut(1000);
	$('.l-c,.r-c').fadeOut(1100, function(){
		$('.animate').hide();
	});
}

function animation_second(){
	$('.animate').show();
	$('.l').show();
	$("#l_3").animate({ top: '0%'}, {duration: 1700, easing: 'easeOutQuint'});
	$("#l_4").animate({ bottom: '0%'}, {duration: 1700, easing: 'easeOutQuint'});
	$("#l_2").animate({ bottom: '0%'}, {duration: 2000, easing: 'easeOutQuint'});
	$("#l_5").animate({ bottom: '0%'}, {duration: 2300, easing: 'easeOutQuint'});
	$("#l_1").animate({ bottom: '0%'}, {duration: 2600, easing: 'easeOutQuint'});

	$("#l_3").animate({ top: '-120%'}, {duration: 1700, easing: 'easeOutQuint'});
	$("#l_4").animate({ bottom: '-100%'}, {duration: 1700, easing: 'easeOutQuint'});
	$("#l_2").animate({ bottom: '-100%'}, {duration: 2000, easing: 'easeOutQuint'});
	$("#l_5").animate({ bottom: '-100%'}, {duration: 2300, easing: 'easeOutQuint'});
	$("#l_1").animate({ bottom: '-100%'}, {duration: 2600, easing: 'easeOutQuint', complete: function(){
		$('.animate').hide();
	}
	});


}


(function ($) {
	$.fn.ahAlign = function() {
		return this.each(function(i){
			var ah = $(this).width() + parseInt($(this).css('paddingLeft')) + parseInt($(this).css('paddingRight'));
			var ph = $(this).parent().width() + parseInt($(this).parent().css('paddingLeft')) + parseInt($(this).parent().css('paddingRight'));
			var mh = (ph - ah) / 2;
			$(this).css('left', mh);
		});
	};
})(jQuery);

(function ($) {
	$.fn.avAlign = function() {
		return this.each(function(i){
			var ah = $(this).height() + parseInt($(this).css('paddingTop')) + parseInt($(this).css('paddingBottom'));
			var ph = $(this).parent().height() + parseInt($(this).parent().css('paddingTop')) + parseInt($(this).parent().css('paddingBottom'));
			var mh = (ph - ah) / 2;
			$(this).css('top', mh);
		});
	};
})(jQuery);

function Fon(){
	w = $("body").width();
	h = $("body").height();
	if (h <= 900) {
		if (w >= 1600) {
			$("#bg").ezBgResize();
			$('#bg img').ahAlign();
			$('#bg img').avAlign();
		} else {
			$("#bg").css({"width":"100%", "height":"100%", "position":"absolute", "left":"0px", "top":"0px"});
			$("#bg img").css({"width":"auto", "height":"auto"});
			$('#bg img').ahAlign();
			$('#bg img').avAlign();
		};
	} else if (h > 900) {
		if (w >= 1600) {
			$("#bg").ezBgResize();
			$('#bg img').ahAlign();
			$('#bg img').avAlign();
		} else {
			$("#bg").css({"width":"100%", "height":"100%", "position":"absolute", "left":"0px", "top":"0px"});
			$("#bg img").css({"width":"auto", "height":h + "px"});
			$('#bg img').ahAlign();
			$('#bg img').avAlign();
		};
	};
};

(function($) {

	$(document).ready(function() {
		var size = document.documentElement.clientHeight;
		if (size < 700) {
			$(".footer-index").addClass("fixed");
			$(".history .footer").addClass("fixed");
		} else {
			if ($(".footer-index").hasClass("fixed")) {
				$(".footer-index").removeClass("fixed");
			}
			if ($(".history .footer").hasClass("fixed")) {
				$(".history .footer").removeClass("fixed");
			}
		}

		//window.onresize = function(event) {
		//	var size = document.documentElement.clientHeight;
		//	if (size < 670) {
		//		$(".footer-index").addClass("fixed");
		//		$(".history .footer").addClass("fixed");
		//	} else {
		//		if ($(".footer-index").hasClass("fixed")) {
		//			$(".footer-index").removeClass("fixed");
		//		}
		//		if ($(".history .footer").hasClass("fixed")) {
		//			$(".history .footer").removeClass("fixed");
		//		}
		//	}
		//}

		window.onresize = function(event) {
			var size = document.documentElement.clientHeight;
			if (size < 700) {
				$(".teaser-xenon .footer").addClass("fixed");
			} else {
				if ($(".teaser-xenon .footer").hasClass("fixed")) {
					$(".teaser-xenon .footer").removeClass("fixed");
				}
			}
		}

		$('#main_popup img').ahAlign();
		$('#main_popup img').avAlign();

		$(".popup-i").css({"width":"0px","height":"0px","overflow":"hidden","padding":"0px"});

		// Tabs
		$(window).bind('load', function() {
			$('.faq-tabs a.current').parent().next().css('background','none');
			$('.faq-tabs a.current').parent().prev().css('background','none');
			
			$('.js-placeholder').each(function(){
				if($(this).attr('value')!='') {
					$(this).parent().find('label').hide();
				}
			})
			
		});

		// Popup
		$('.agree a').bind('click', function() {
			$('.popup-t').show();
		});
		$('.popup-button a').bind('click', function() {
			$('.popup-t').hide();
		});
		
		// Uploader
		$('.uploader input').change(function() {
			$('.uploader input').each(function() {
				var name = this.value;
				reWin = /.*\\(.*)/;
				var fileTitle = name.replace(reWin, "$1");
				reUnix = /.*\/(.*)/;
				fileTitle = fileTitle.replace(reUnix, "$1");
				$(this).parents('.uploader').find('.filename').html(fileTitle);
			});
		});
		
		// Placeholder
		$('.js-placeholder').focus(function() {
			$(this).parent().find('label').hide();
		});
		$('.js-placeholder').blur(function() {
			if($(this).attr('value')=='') {
				$(this).parent().find('label').show();
			}
		});
		
		// Select
		$('.js-select').bind('click', function(e) {
			e.stopPropagation();
			var $sel = $(this).next();
			if($sel.css('display') == 'none') {
				$('.select-hide').removeClass('select-hide');
				$('.select-list').hide();
				$('.form-block').css('z-index','1');
				$sel.show();
				$(this).parents('.form-block').css('z-index','50');
				$(this).parents('.select').addClass('select-hide');
			} else {
				$sel.hide();
				$(this).parents('.form-block').css('z-index','1');
				$('.select-hide').removeClass('select-hide');
			}
		});
		$('.select-list li').bind('click', function() {
			var $val = $(this).text();
			$(this).parents('.select').find('.select-current-inner').text($val);
			$(this).parents('.select-list').hide();
			$('.form-block').css('z-index','1');
			$('.select-hide').removeClass('select-hide');
		});
		$(document).bind('click', function() {
			$('.select-list').hide();
			$('.form-block').css('z-index','1');
			$('.select-hide').removeClass('select-hide');
		});
		
		// Style Forms
		$('.form-checkbox input[type=radio], .agree input').uniform();
		$("#info").click(function(){
			if ($('.popup-lss').hasClass("hide")){
				$('.popup-lss').show();
				$('.popup-lss').removeClass("hide");
			} else {
				$('.popup-lss').hide();
				$('.popup-lss').addClass("hide");
			}
		});
		$(".info-block .info").click(function(){
			$(".popup-i").css({"width":"262px","height":"169px","overflow":"hidden","padding":"31px 0 0 28px"});
			if ($('.popup-i').hasClass("hide")){
				$('.popup-i').show();
				$('.popup-i').removeClass("hide");
			} else {
				$('.popup-i').hide();
				$('.popup-i').addClass("hide");
			}
		});
		$(".block-top .block ul li a").click(function(){
			if ($(this).parent('.block-top .block ul>li').hasClass("hide")){
				$('.block-top .block ul li .submenu').hide();
				$(".block-top .block ul>li").removeClass("active");
				$(".block-top .block ul>li").addClass("hide");
				$(this).next('.block-top .block ul li .submenu').show();
				$(this).parent(".block-top .block ul>li").removeClass("hide");
				$(this).parent(".block-top .block ul>li").addClass("active");
			} else {
				$(this).next('.block-top .block ul li .submenu').hide();
				$(this).parent(".block-top .block ul>li").addClass("hide");
				$(this).parent(".block-top .block ul>li").removeClass("active");
			}
		});
		$(document).mouseup(function(e) {
			   
			if(($(e.target).parent(".block-top .block .promo").length == 0)
				&& ($(e.target).parent(".promo-active .popup").length == 0)
				&& ($(e.target).parent(".popup .form-block").length == 0) && ($(e.target).parent(".popup .form-buttons").length == 0)
				&&  ($(e.target).parent(".popup .form-buttons .button-pass").length == 0)){

				$(".block-top .block .promo").removeClass('promo-active');
		}
	 	});


		$(".block-menu ul li a").click(function(){
			$(this).parent().children(".submenu").hide();
			$(this).parent().children(".sub-menu").show();
			$(".block-menu ul li").removeClass("hide");
			$(this).parent('li').addClass("hide");
		});

		$(".block-menu ul li").mouseover(function(){

			if ($(".block-menu ul li .sub-menu").css('display') == 'none')
			{
				$(".block-menu ul li .submenu").hide();
				$(this).children(".submenu").show();
			}

		});

		// $(".block-menu ul li .submenu").mouseover(function(){
		// 		$(".block-menu ul li .submenu").css("display","none");
		// });

		// $(".block-menu ul li .submenu").mouseout(function(){
		// 	$(this).hide();
		// })

$(".block-menu ul li .submenu li a").click(function(){
	$(this).parent().parent().next(".sub-menu").show("fast",function(){
		$(".block-menu ul li .submenu").hide();
		$(".block-menu ul li").removeClass("hide");
		$(this).parent('li').addClass("hide");
	});
	$(this).next(".sub-menu").show("fast",function(){
		$(".block-menu ul li .submenu").hide();
		$(".block-menu ul li").removeClass("hide");
				//$(this).parent('li').addClass("hide");
			});
});



$(document).mouseup(function(e) {

	if (($(e.target).parent('.block-menu ul li .sub-menu').length == 0)
		&& ($(e.target).parent('.block-menu ul li .sub-menu .block ').length == 0)
		&& ($(e.target).parent('.sub-menu .block li').length == 0)
		){
		$(".block-menu ul li .sub-menu").hide();
	$(".block-menu ul li").removeClass("hide");
}

if (($(e.target).parent('.block-menu ul li .submenu').length == 0) ){
	$(".block-menu ul li .submenu").hide();
}

});

$(".votes a#l_2").click(function(){
	$("div.like#like_2").show();
	$("div.like#like_1").hide();
});
$(".votes a#l_1").click(function(){
	$("div.like#like_1").show();
	$("div.like#like_2").hide();
});

$(document).mouseup(function(e) {

	if (($(e.target).parent('.block-votes .block .item .like').length == 0)
		&& ($(e.target).parent('.block-votes .block .item .like a').length == 0)
		){
		$(".block-votes .block .item .like").hide();
	$(".block-votes .block .item").removeClass("hide");
}

if (($(e.target).parent('.block-votes .block .item .like').length == 0) ){
	$(".block-votes .block .item .like").hide();
}

});

});

$(window).load(function() {
	Fon();
});

$(window).resize(function() {
	$('#main_popup img').ahAlign();
	$('#main_popup img').avAlign();
	Fon();
});

})(jQuery);