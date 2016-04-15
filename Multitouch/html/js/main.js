$(document).ready(function() {
    $("#carousel").carouFredSel({
        width: 960,
        height: 311,
        items: {
            visible: 1,
            minimum: 1,
            width: 960,
            height: 311
        },
        scroll: 1,
        auto: false,
        pagination: {
            container: "#pagination",
            anchorBuilder: false
        }
    });
});

function popup_close() {
    $(".b-popup").fadeOut(400);
}

function popup__promo() {
    $(".b-popup").hide();
    $("#popup_promo").fadeIn(400);
}

function popup__order() {
    $(".b-popup").hide();
    $("#popup_order").fadeIn(400);
}

function goToByScroll(id) {
    id = id.replace("link", "");
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top
    }, 800);
}

$(".b-header__menu a").click(function(e) {
    e.preventDefault();
    goToByScroll($(this).attr("id"));
});

function goToByScrolls(id) {
    id = id.replace("links", "");
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top
    }, 800);
}

$(".b-footer__menu a").click(function(e) {
    e.preventDefault();
    goToByScrolls($(this).attr("id"));
});