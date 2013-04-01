$(document).ready(function(){
    $(".block-carousel .block .text ul li:first").addClass("active");

    $(".block-carousel .block .text ul li").click(function(){
				$(this).toggleClass("active");
        $(this).siblings("li").removeClass("active");
     });
});