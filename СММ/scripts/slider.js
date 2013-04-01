
$(document).ready(function() {

    $("#circle_1").click(function() {
        $(".foto_center").css({
            "background-image": "url(images/foto_center1.jpg)"
        });
        $(".foto_side").css({
            "background-image": "url(images/foto_side1.jpg)"
        });

        $(this).css({
            "background-image": "url(images/circle_red.gif)"
        });
        $("#circle_2").css({
            "background-image": "url(images/circle_orange.gif)"
        });
        $("#circle_3").css({
            "background-image": "url(images/circle_orange.gif)"
        });
    });

    $("#circle_2").click(function() {
        $(".foto_center").css({
            "background-image": "url(images/foto_center2.jpg)"
        });
        $(".foto_side").css({
            "background-image": "url(images/foto_side2.jpg)"
        })

        $(this).css({
            "background-image": "url(images/circle_red.gif)"
        });
        $("#circle_1").css({
            "background-image": "url(images/circle_orange.gif)"
        });
        $("#circle_3").css({
            "background-image": "url(images/circle_orange.gif)"
        });

        
    });

    $("#circle_3").click(function() {
        $(".foto_center").css({
            "background-image": "url(images/foto_center3.jpg)"
        });
        $(".foto_side").css({
            "background-image": "url(images/foto_side3.jpg)"
        });

        $(this).css({
            "background-image": "url(images/circle_red.gif)"
        });
        $("#circle_1").css({
            "background-image": "url(images/circle_orange.gif)"
        });
        $("#circle_2").css({
            "background-image": "url(images/circle_orange.gif)"
        });
    });

});