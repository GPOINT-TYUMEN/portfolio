function open_phone(el) {
	if ($(".header__phone").hasClass("open__phone")) {

	} else {
		$(el).find("span").hide();
		$(el).addClass("open__phone");
		$("#open__phone").show();
		$(el).find("a.dotted").hide();
	}
}

function form_order() {
	$("html, body").animate({ scrollTop: 1000 }, 1000);
	return false;
}

function top_page() {
	$("html, body").animate({ scrollTop: 0 }, 1000);
	return false;
}

function open_shcool(el) {
	$("#shcool").slideToggle(1000);
	$(el).toggleClass("active");
}

$(document).ready(function() {
	$('input, select').styler();

	if ( $(this).scrollTop() > 1){
		header.css({
			top: 0
		}, 700, function() {
			header.addClass("fixed");
		});
	}

	$('.tooltip').tooltipster({
		contentAsHTML: true,
		trigger: 'hover',
		animation: "grow",
		maxWidth: 500,
		position: "right"
	});

	var sum = 0;
	var summa = $('#summa');
	var total = $('#total');

	$(".form__item input[type=checkbox]").bind("change", function() {
		if ( $(this).is(":checked") ) {
			sum+=+$(this).val();
			summa.html(sum);
			total.html(sum-(sum/100*10));
		} else {
			sum+=-$(this).val();
			summa.html(sum);
			total.html(sum-(sum/100*10));
		}
	});



});

var header = $(".header_block");

$(window).scroll(function(){
	if ( $(this).scrollTop() > 1){
		header.animate({
			top: 0
		}, 700, function() {
			header.addClass("fixed");
		});
		return false;
	} else if($(this).scrollTop() <= 1 && header.hasClass("fixed")) {
		header.removeClass("fixed");
		header.animate({
			top: 33
		}, 700);
		return false;
	}
});