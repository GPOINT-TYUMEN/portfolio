
$(document).ready(function(){

Cufon.set('fontFamily','Markiz de Sad script');
Cufon.replace('.header .slogan');
Cufon.set('fontFamily','Nokia Sans S60');
Cufon.replace('.header .phone .code');
Cufon.replace('.header .phone .tel');
Cufon.replace('.carousel .jcarousel-clip li .info p');
Cufon.replace('.container h2');
Cufon.replace('.block-proposal .our-proposal .order a');
Cufon.replace('.block-reviews .head .link a');

});

function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

};

jQuery(document).ready(function() {
    jQuery("#mycarousel").jcarousel({
        initCallback: mycarousel_initCallback,
        scroll: 1,
        auto: 10,
        wrap: 'circular',
        buttonNextHTML: null,
        buttonPrevHTML: null
    });

    $(".certificate").click(function(){
          var from = $("#edit-user-name-ot-kogo").val();
          var to = $("#edit-user-name-komy").val();
          var total = $("#edit-total").val();
          var phone = $("#edit-user-phone").val();
          var email = $("#edit-email").val();
          var text = $("#edit-mail-body").html();
        $.post("/mail.php",
            {
              from: from,
              to: to,
              total: total,
              phone: phone,
              email: email,
              text: text
/*                from: $("#edit-user-name-ot-kogo").val(),
                to: $("#edit-user-name-komy").val(),
                total: $("#edit-total").val(),
                phone: $("#edit-user-phone").val(),
                email: $("#edit-email").val(),
                text: $("#edit-mail-body").html(),*/
            },
            function(data) {
                if(data.error == false) {
                    $(".shadow").show();

                    var height = 713;
                    var margin = $(".block-form").css("margin-top");
                    var top = 0;
                    var temp = 100;

                    while (height >= 100 ) {
                            height -= temp - 3;
                            $(".form").css("height", height);
                            top += temp - 41;
                            $(".form").css("top", top);
                    }

                    $("#form").hide();
                    $(".button").hide();
                    $(".thanks").show();
                } else {
                    alert("Ошибка при отправке!");
                }
            },
            "json"
        );
        return false;
    });
});
