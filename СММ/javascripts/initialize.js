function change_nav_text() {
	text = $(".slide_nav a").first().html();
	if (text && text.length < 2) {
		$(".slide_nav a").each(function() {
			$(this).html("#" + $(this).html());
		});
	}
}

function set_size_active1(obj) {
	$(".size span a").each(function() {
		$(this).removeClass("active");
	});
	$(obj).addClass("active");
	$("#basket_size").val($(obj).html());
}

function set_size_active2(obj) {
	var parnt = $(obj).parent();
	parnt.children().each(function() {;
		$(this).removeClass("active");
	});
	$(obj).addClass("active");
	parnt.siblings('.order').find('#basket_size').val($(obj).html());
}

function change_goods_foto(path, obj) {
	$(".min div").each(function() {
		$(this).removeClass("active");
	});
	$(obj).parent("div").addClass("active");
	$(".big img").attr("src", path);
}

function runEffect() {
	$(".brand li a").each(function(ind, elem) {
		if (ind > 5) {
			$(elem).slideToggle(90);
		}
	});
	$(".controlling li").first().slideToggle(0);
	$(".controlling li").last().slideToggle(0);
};

function resize() {
	var img_w = 2240;
	var width = $(window).width();
	var margin = parseInt((img_w - width) / 2);

	if (margin < 0) {
		$(".slideshow_nav").css("width", img_w);
		$(".slideshow_nav img").css("margin-left", 0);
		$(".slideshow").css("width", img_w);
		$(".slideshow img").css("margin-left", 0);
	} else {
		$(".slideshow_nav").css("width", width);
		$(".slideshow_nav img").css("margin-left", -margin);
		$(".slideshow").css("width", width);
		$(".slideshow img").css("margin-left", -margin);
	}
}

function showTooltip(obj, act) {
	if (act == 1) {
		$(obj).siblings('div').css('display', 'block');
	} else {
		$(obj).siblings('div').css('display', 'none');
	}
}

function showFastBasket(obj) {
	$(obj).closest('.prise').children('.fast_basket').toggle();
}

function hideFastBasket(obj) {
	$(obj).closest('.fast_basket').css('display', 'none');
}

$(document).ready(function() {
	resize();

	$('.slideshow_nav').cycle({
		fx: 'fade',
		timeout: 4000,
		pager: '.slide_nav',
		after: change_nav_text
	});
	$('.slideshow').cycle({
		fx: 'fade'
	});

	$(window).resize(function() {
		resize();
	});

	runEffect();
	$(".all_brands").click(function() {
		runEffect();
		return false;
	});
});

Cufon.replace('.main_header')('.c_t_head');

