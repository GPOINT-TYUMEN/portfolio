$(document).ready(function(){
    Cufon.set('fontFamily', 'Palatino Linotype');
    Cufon.replace('.header .carousel .splash', { textShadow: '0 2px 2px #43930e'});

    $("#carousel").carouFredSel({
    	circular: false,
    	infinite: false,
    	width: "variable",
    	height: "variable",
    	items: {
    		visible: 1,
    		width: 752,
    		height: 190
    	},
    	auto: false,
    	prev: "#carousel-prev",
    	next: "#carousel-next",
    	pagination: "#carousel-pag"
    });

    $("#close-chat").click(function(){
        $("#block-chat").animate({
          left: "-159px"
        }, function(){
          $("#close-chat").hide();
          $("#open-chat").show();
        });
    })
    $("#open-chat").click(function(){
      $("#block-chat").animate({
        left: "0px"
      }, function(){
        $("#open-chat").hide();
        $("#close-chat").show();
      })
    })
});
