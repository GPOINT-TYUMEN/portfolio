var city = $("#city__menu");
var login = $("#login__menu");
var adress = $(".adress__form");
var railway = $(".railway__menu");
var nowitem = $(".now__item_popup");

function select_city() { // Открытие меню со списком городов
    city.toggle(); 
}

function login_menu() { // Открытие окошка входа
    if ($(".header__login").hasClass("active")) {
        login.hide();
        $(".header__login").addClass("has");
    } else {
        login.show();
        $(".header__login").addClass("active");
    }
}

function maps_more() { // Развернуть карту, по клику на кнопку карты
    $(".maps__block").animate({
        width: 944
    }, 800);
    $(".form__orders").addClass("hide").animate({
        width: 0,
        padding: "16px 0 18px"
    }, 800, function(){
        $(this).hide();
        initialize();
    });
    $("#map_more").hide();
    $("#map_close").show();
}

function maps_close() { // Свернуть карту, по клику на кнопку карты
	if ($(".maps__block").hasClass("maps__mini")) {
		$(".maps__block").animate({
	        width: 48
	    }, 800);
	    $(".form__orders").show().animate({
	        width: 832,
	        padding: "16px 18px 18px"
	    }, 800, function(){
	        $(this).removeClass("hide");
            initialize();
	    });
	    $("#map_more").show();
	    $("#map_close").hide();
	} else {
		$(".maps__block").animate({
	        width: 531
	    }, 800);
	    $(".form__orders").show().animate({
	        width: 346,
	        padding: "16px 18px 18px"
	    }, 800, function(){
	        $(this).removeClass("hide");
            initialize();
	    });
	    $("#map_more").show();
	    $("#map_close").hide();
	}
}

function live_menu(el) { // Открытие и закрытие меню любимых мест назначения
    $(el).closest("span").find(".live_menu").toggle();
    $(el).toggleClass("active");
}

function adress_form(el) { // Открытие формы для ввода подробного адреса
    $(".railway__menu").hide();
    $(".railway").removeClass("active");
    $(".air").removeClass("active");
    $(el).closest("li").find(".adress__form").addClass("active").show();
    $(el).closest("li").find("label").addClass("active");
}

function railway_menu(el) { // Открытие списка адресов вокзалов
    $(el).closest("li").find("div.railway__menu").addClass("active").show();
    $(el).addClass("active");
}

function wishes_select(el) {
    $(el).toggleClass("active");
    $(el).closest("li").find(".wishes__popup").toggle();
}

function wishes_popup_select(el) {
	$(el).closest(".wishes__popup").find("a").removeClass("active");
	$(el).toggleClass('active');
	$(el).closest(".wishes__popup").hide();
}

function open_now(el) {
	$(el).closest(".select__time").find(".now__item_popup").show();
}

function open_time(el) {
    $(el).closest(".select__times").find(".now__item_popup").show();
}

function select_now(el) {
	$(".select__time .dotted").text($(el).text());
	$(".now__item_popup").hide();
}

function select_time(el) {
    $(".select__times .dotted").text($(el).text());
    $(".now__item_popup").hide();
}

function result_now() {
	$(".now__item_popup").hide();
}

$(document).mouseup(function(e) { // Функция закрытия попапов по клику вне попапа
    if (city.css('display') == 'block') { // Закрытие меню со списком городов
        if (!city.is(e.target)
        && city.has(e.target).length === 0)
        {   
            city.hide();
        }
    }

    if ($(".header__login").hasClass("active")) { // Закрытие окошка входа
        if (!login.is(e.target) && login.has(e.target).length === 0) {   
            login.hide();
            $(".get_code").show();
    		$(".password_in").hide();
            $(".header__login").removeClass("active");
        }
    }

    if (adress.hasClass('active')) { // Закрытие формы для ввода подробного адреса
        if (!adress.is(e.target)
        && adress.has(e.target).length === 0)
        {   
            adress.hide().removeClass("active");
            $(".form__input").removeClass("active");
            $(".form__where").removeClass("active");
        }
    }

    if (railway.hasClass('active')) { // Закрытие списка адресов вокзалов
        if (!railway.is(e.target)
        && railway.has(e.target).length === 0)
        {   
            railway.hide().removeClass("active");
            $(".railway").removeClass("active");
            $(".air").removeClass("active");
        }
    }

    if (nowitem.css('display') == 'block') { // Закрытие окошка входа
        if (!nowitem.is(e.target)
        && nowitem.has(e.target).length === 0)
        {   
            nowitem.hide();
        }
    }
});

$(document).ready(function() {
    $(".phone__input").mask("+7 (999) 999-99-99",{placeholder:"+7 (   )"}); // Плагин для поля телефона

    $("#tabs").tabs(); // Плагин табов переключения форм заказа такси "Заказать такси" и "Арендовать такси"

    $('input, select').styler(); // Плагин для нестандартных чекбоксов и селектов

    $('.quont-minus').click(function () { // Плюс и минус
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });

    $('.quont-plus').click(function () { // Плюс и минус
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });

    $('#rating').raty({
        space: false,
        path: 'img/',
        readOnly: true,
        score: 3
    });

    $('.rating_list').raty({
        space: false,
        path: 'img/',
        readOnly: true,
        score: 3
    });

    $(".review_block .rating").raty({
        space: false,
        path: 'img/',
        readOnly: true,
        score: 3
    });

    $("#get_code").on("click", function(){
    	$(".get_code").hide();
    	$(".password_in").show();
    });

    var projects = [{
        label: "Казанский вокзал",
        value: "ул. Строителей"
    }];

    $("#street").autocomplete({
        source: projects,
        open: function(event, ui) {
            $($('ul#ui-id-3').addClass("railway__menu").removeAttr('style').hide()).appendTo('#railway__menu').show();
            $(this).parent().parent().find("label").addClass("active");
        },
        create: function() {
            $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                return $('<li>').addClass("railway__item").append('<p><a>' + item.label + '</a></p><span>' + item.value + '</span>').appendTo(ul);
            };
        },
        close: function(event, ui) {
            if ($(".adress__form").hasClass("active")) {
                //
            } else {
                $(this).parent().parent().find("label").removeClass("active");
            }
        },
        select: function(event,ui) {
            $(this).parent().parent().find(".adress__form").addClass("active").show();
            $(this).parent().parent().find("label").addClass("active");
        }
    });

    $("#street_who").autocomplete({
        source: projects,
        open: function(event, ui) {
            $($('ul#ui-id-4').addClass("railway__menu").removeAttr('style').hide()).appendTo('#railway__menu__who').show();
            $(this).parent().parent().find("label").addClass("active");
        },
        create: function() {
            $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                return $('<li>').addClass("railway__item").append('<p><a>' + item.label + '</a></p><span>' + item.value + '</span>').appendTo(ul);
            };
        },
        close: function(event, ui) {
            if ($(".adress__form").hasClass("active")) {
                //
            } else {
                $(this).parent().parent().find("label").removeClass("active");
            }
        },
        select: function(event,ui) {
            $(this).parent().parent().find(".adress__form").addClass("active").show();
            $(this).parent().parent().find("label").addClass("active");
        }
    });
});

$(window).load(function() { // Плагин нестандартного скролла
    $(".railway__menu").mCustomScrollbar();
    $(".list_body").mCustomScrollbar();
    $(".list__review").mCustomScrollbar();
});

function initialize() {
    var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(57.1214717, 65.6008042),
        zoomControl: true,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.DEFAULT,
          position: google.maps.ControlPosition.LEFT_CENTER
        },
        disableDefaultUI: true
    }
    var map = new google.maps.Map(document.getElementById('google__maps'),mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);


function city_select(el) {
    $(".active_city").text($(el).text());
    $("#city__menu li").removeClass("active");
    $(el).parent().addClass("active");
    $("#city__menu").hide();
}

function order_from1() {
	$("#tabs").fadeOut();
	$(".form__orders").animate({
		width: 832
	}, 700, function() {
		$(".form_step_two").fadeIn();
	});
	$(".maps__block").animate({
		width: 48
	}, 700, function() {
		$(".maps__block").addClass("maps__mini");
        initialize();
	})
}

$(".list__item .select a").on("click", function() {
	$(".form_step_two").fadeOut(800);
	$(".form__orders").animate({
		width: 346
	}, 800, function() {
		$(".form_step_three").fadeIn();
	})
	$(".maps__block").animate({
		width: 531
	}, 800, function() {
		$(this).removeClass("maps__mini");
        initialize();
	})
});

function order_from2() {
	$(".form_step_three").fadeOut(function(){
		$(".form_step_four").fadeIn();
	});
}

function close_popup() {
    $(".popup").fadeOut();
}

function review_open() {
    $(".popup").fadeIn();
}