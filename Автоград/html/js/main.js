$(document).ready(function(){
    $('.auto__text').addClass("hiddenopacity").viewportChecker({
    	classToAdd: 'visibleopacity animated fadeInUp',
    	offset: 100,
    	callbackFunction: function(elem) {
    		setTimeout(function () {
    			$('.auto__img').addClass("visibleopacity animated fadeInUp");
    		}, 1000);
    	}
    });

    $('.img_auto').addClass("hiddenopacity").viewportChecker({
        classToAdd: 'visibleopacity animated fadeInUp',
        offset: 100,
        callbackFunction: function(elem) {
            setTimeout(function () {
                $('.img_man').addClass("visibleopacity animated fadeInUp");
            }, 1000);
        }
    });

    $('#nav').onePageNav({
	    currentClass: 'active',
	    changeHash: false,
	    scrollSpeed: 750,
	    scrollThreshold: 0.5,
	    filter: '',
	    easing: 'swing'
	});

    $('input, select').styler();

    var $menu = $("#menu");
 
    $(window).scroll(function(){
        if ( $(this).scrollTop() > 101 && $menu.hasClass("header__menu") ){
            $menu.addClass("fixed");
        } else if($(this).scrollTop() <= 101 && $menu.hasClass("fixed")) {
            $menu.removeClass("fixed");
        }
    });

    setTimeout(function () {
        // Проверим, есть ли запись в куках о посещении посетителя  
        // Если запись есть - ничего не делаем  
        if (!$.cookie('ford focus')) {  
            // Покажем всплывающее окно  
            $('#form-3').fadeIn(500);  
        }  

        // Запомним в куках, что посетитель к нам уже заходил  
        $.cookie('ford focus', true, {  
            expires: 365,  
            path: '/'  
        });
    }, 90000)
});

function more() {
    $("html, body").animate({ scrollTop: 1493 }, 1000);
    return false;
}

function close_popup() {
    $(".popup").fadeOut(500);
}

function open_form1() {
    $("#form-1").fadeIn(500);
}

function open_form2() {
    $("#form-2").fadeIn(500);
}
