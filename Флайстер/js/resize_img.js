
function resize() {
    var width = $(window).width();
    if (width < 1400) {
        $(".slideshow_nav").css("width", width);
        $(".slideshow").css("width", width);
    } else {
        $(".slideshow_nav").css("width", 1400);
        $(".slideshow").css("width", 1400);
    }
    
    $(".slideshow_nav").css("height", $(".slideshow_nav").find("img").height());
    $(".slideshow").css("height", $(".slideshow_nav").find("img").height());
}

$(document).ready(function() {
    
    resize();
    
    //$(window).resize(function() {
    //    resize();
    //});
    
});